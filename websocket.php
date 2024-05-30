<?php
require 'vendor/autoload.php';
require_once(__DIR__ . '/config/database.php');

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class ChatServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $connection)
    {
        $this->clients->attach($connection);
        $connection->send(json_encode(['identification' => true, 'id' => $connection->resourceId]));
    }

    public function onMessage(ConnectionInterface $from, $message)
    {

        $data = json_decode($message, true);
        if (isset($data['identification'])) {
            $data = $data['identification'];
            $iv = substr(md5(md5('huhu')), 0, 16);
            $decryptedUsername = openssl_decrypt(base64_decode($data), 'AES-256-CBC', md5('haha'), OPENSSL_RAW_DATA, $iv);
            $from->username = $decryptedUsername;
            echo "Kết nối mới đã được thiết lập: {$from->resourceId}, {$decryptedUsername}\n";
        } else {
            // Lấy thông tin từ tin nhắn
            $receivers = $data['receiver'];
            $timestamp = $data['timestamp'];
            $room = $data['room'];
            $content = $data['content'];
            $insertIdsAndReceivers = [];

            try {
                $conn = createConn();
                $conn->begin_transaction();
                foreach ($receivers as $receiver) {
                    $getQuery = "INSERT INTO message (`sender`, `receiver`, `content`,`room_id`,`timestamp`) VALUES (?, ?, ?,?,?)";
                    $data = executeQuery($conn, $getQuery, [$from->username, $receiver, $content, $room, $timestamp]);
                    $insertIdsAndReceivers[] = array(
                        'insert_id' => $data->insert_id,
                        'receiver' => $receiver
                    );
                }
                $conn->commit();
            } catch (Exception $e) {
                $conn->rollback();
            }
            // Gửi tin nhắn cho người nhận và phòng chat

            foreach ($this->clients as $client) {
                if ($client !== $from) {
                    foreach ($insertIdsAndReceivers as $receiver) {
                        // Kiểm tra người nhận và phòng chat
                        if ($receiver['receiver'] === $client->username) {
                            $client->send(json_encode(['name' => $from->username, 'content' => $content, 'timestamp' => $timestamp, 'room' => $room, 'id' => [$receiver['insert_id']]], JSON_UNESCAPED_UNICODE));
                        }
                    }
                } else {
                    $listID = [];
                    foreach ($insertIdsAndReceivers as $receiver) {
                        array_push($listID, $receiver['insert_id']);
                    }
                    $client->send(json_encode(['name' => $from->username, 'content' => $content, 'timestamp' => $timestamp, 'room' => $room, 'self' => true, 'id' => $listID], JSON_UNESCAPED_UNICODE));
                }
            }
        }
    }

    public function onClose(ConnectionInterface $connection)
    {
        $this->clients->detach($connection);
        echo "Kết nối đã đóng: {$connection->resourceId}\n";
    }

    public function onError(ConnectionInterface $connection, \Exception $e)
    {
        echo "Có lỗi xảy ra: {$e->getMessage()}\n";
        $connection->close();
    }
}

$server = new \Ratchet\App('localhost', 8000);
$server->route('/chat', new ChatServer(), ['*']);
$server->run();

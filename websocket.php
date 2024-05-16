<?php
require 'vendor/autoload.php';

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
        echo "Kết nối mới đã được thiết lập: {$connection->resourceId}\n";
    }

    public function onMessage(ConnectionInterface $from, $message)
    {

        $data = json_decode($message, true);
        if (isset($data['identification'])) {
            $data = $data['identification'];
            $iv = substr(md5(md5('huhu')), 0, 16);
            $decryptedUsername = openssl_decrypt(base64_decode($data), 'AES-256-CBC', md5('haha'), OPENSSL_RAW_DATA, $iv);
            $from->username = $decryptedUsername;
        } else {
            // Lấy thông tin từ tin nhắn
            $receiver = $data['receiver'];
            $timestamp = $data['timestamp'];
            $room = $data['room'];

            // Xử lý tin nhắn ở đây

            // Gửi tin nhắn cho người nhận và phòng chat
            foreach ($this->clients as $client) {
                if ($client !== $from) {
                    // Kiểm tra người nhận và phòng chat
                    if ($receiver === $client->username) {
                        $client->send($message);
                    }
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

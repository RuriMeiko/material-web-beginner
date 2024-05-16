<?php
require_once(DIR . '/config/database.php');


function createChatRoom($amin, $user, $name)
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    try {
        $conn->begin_transaction();
        $getQuery = "INSERT INTO chatroom (name) VALUES (?)";
        $data = executeQuery($conn, $getQuery, [$amin]);
        $conn->commit();

        if ($data) {
            return $data;
        } else {
            return ["err"];
        }
    } catch (Exception $e) {
        $conn->rollback();
    }
}


function getListChat($username)
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }

    $conn = createConn();
    try {
        $iv = substr(md5(md5('huhu')), 0, 16);
        $decryptedUsername = openssl_decrypt(base64_decode($username), 'AES-256-CBC', md5('haha'), OPENSSL_RAW_DATA, $iv);
        $getQuery = "SELECT chatroom.id as chatId, message.id, message.content, chatroom.name, message.timestamp, message.sender = room_member.user_id AS fromMe FROM message,chatroom,room_member WHERE chatroom.id = room_member.room_id AND room_member.user_id = (?) and message.room_id=chatroom.id   ORDER BY message.timestamp DESC";
        $data = executeQuery($conn, $getQuery, [$decryptedUsername]);

        if ($data) {
            return $data;
        } else {
            return ["err"];
        }
    } catch (Exception $e) {
    }
}


function getRoomMember($username)
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }

    $conn = createConn();
    try {
        $iv = substr(md5(md5('huhu')), 0, 16);
        $decryptedUsername = openssl_decrypt(base64_decode($username), 'AES-256-CBC', md5('haha'), OPENSSL_RAW_DATA, $iv);
        $getQuery = "SELECT chatroom.id AS chatId, room_member.user_id AS memberId 
        FROM chatroom 
        JOIN room_member ON chatroom.id = room_member.room_id 
        WHERE chatroom.id IN (
          SELECT room_id 
          FROM room_member 
          WHERE user_id = (?)
        )";
        $data = executeQuery($conn, $getQuery, [$decryptedUsername]);

        if ($data) {
            return $data;
        } else {
            return ["err"];
        }
    } catch (Exception $e) {
    }
}

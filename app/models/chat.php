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
        $getQuery = "SELECT 
                            MIN(msg.id) AS messageId, 
                            msg.chatId,
                            msg.content,
                            msg.name,
                            msg.timestamp,
                            msg.sender,
                            MAX(msg.fromMe) AS fromMe
                        FROM (
                            SELECT 
                                chatroom.id AS chatId,
                                message.id,
                                message.content,
                                chatroom.name,
                                message.timestamp,
                                message.sender,
                                CASE 
                                    WHEN message.sender = (?) THEN TRUE
                                    ELSE FALSE
                                END AS fromMe
                            FROM chatroom
                            LEFT JOIN message ON chatroom.id = message.room_id
                            INNER JOIN room_member ON chatroom.id = room_member.room_id
                            WHERE room_member.user_id = (?)
                        ) AS msg
                        GROUP BY msg.content, msg.timestamp, msg.chatId, msg.name
                        ORDER BY msg.timestamp DESC;
                    ";
        $data = executeQuery($conn, $getQuery, [$decryptedUsername, $decryptedUsername]);

        if ($data) {
            return $data;
        } else {
            return ["err"];
        }
    } catch (Exception $e) {
        echo $e;
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
                        ) 
                        AND room_member.user_id != (?)
                    ";
        $data = executeQuery($conn, $getQuery, [$decryptedUsername, $decryptedUsername]);

        if ($data) {
            return $data;
        } else {
            return ["err"];
        }
    } catch (Exception $e) {
        echo $e;
    }
}

function deleteChatRoom($id)
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    try {
        $conn->begin_transaction();
        $getQuery = "DELETE FROM chatroom WHERE id = ?;
                    DELETE FROM room_member WHERE room_id = ?";
        $data = executeQuery($conn, $getQuery, [$id, $id]);
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

function changeNameChatRoom($name, $id)
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    try {
        $conn->begin_transaction();
        $getQuery = "UPDATE chat_rooms SET name = ? WHERE id = ?;";
        $data = executeQuery($conn, $getQuery, [$name, $id]);
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

function ChatRoom($name, $id)
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    try {
        $conn->begin_transaction();
        $getQuery = "UPDATE chat_rooms SET name = ? WHERE id = ?;";
        $data = executeQuery($conn, $getQuery, [$name, $id]);
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

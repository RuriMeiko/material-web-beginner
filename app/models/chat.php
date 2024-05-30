<?php
require_once(DIR . '/config/database.php');



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
        // $getQuery = "SELECT 
        //                     MIN(msg.id) AS messageId, 
        //                     msg.chatId,
        //                     msg.content,
        //                     msg.name,
        //                     msg.timestamp,
        //                     msg.sender,
        //                     MAX(msg.fromMe) AS fromMe
        //                 FROM (
        //                     SELECT 
        //                         chatroom.id AS chatId,
        //                         message.id,
        //                         message.content,
        //                         chatroom.name,
        //                         message.timestamp,
        //                         message.sender,
        //                         CASE 
        //                             WHEN message.sender = (?) THEN TRUE
        //                             ELSE FALSE
        //                         END AS fromMe
        //                     FROM chatroom
        //                     LEFT JOIN message ON chatroom.id = message.room_id
        //                     INNER JOIN room_member ON chatroom.id = room_member.room_id
        //                     WHERE room_member.user_id = (?)
        //                 ) AS msg
        //                 GROUP BY msg.content, msg.timestamp, msg.chatId, msg.name
        //                 ORDER BY msg.timestamp DESC;
        //             ";

            $getQuery = "SELECT 
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
                                AND (message.sender = (?) OR message.receiver = (?))
                            ORDER BY message.timestamp DESC;
                        ";
        $data = executeQuery($conn, $getQuery, [$decryptedUsername, $decryptedUsername, $decryptedUsername, $decryptedUsername]);

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

function getAllContact($user_name) {
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    try {
        $conn->begin_transaction();
        $getQuery = "SELECT DISTINCT name, avt, username
                        FROM (
                            SELECT name, avt, username
                            FROM message
                            JOIN user_info ON message.receiver = user_info.username
                            WHERE message.sender = (?)
                        
                            UNION
                        
                            SELECT name, avt, username
                            FROM message
                            JOIN user_info ON message.sender = user_info.username
                            WHERE message.receiver = (?)
                        ) AS combined
                        GROUP BY name;
                    ";
        $data = executeQuery($conn, $getQuery, [$user_name, $user_name]);
        $conn->commit();

        return ["success" => true, "data" => $data];

    } catch (Exception $e) {
        $conn->rollback();
        return ["success" => false, "error" => $e];
    }
}

function createRoom($roomname, $members, $avt) {
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    try {
        $conn->begin_transaction();
        // Insert the chatroom and get its ID.
        $insertRoomQuery = "INSERT INTO chatroom (name, avt) VALUES (?, ?)";
        executeQuery($conn, $insertRoomQuery, [$roomname, $avt]);
        $room_id = $conn->insert_id; // Get the inserted ID for the chatroom.
        
        // Insert each member with the chatroom ID.
        $insertMemberQuery = "INSERT INTO room_member (room_id, user_id)
                                SELECT * FROM (SELECT (?) AS temp_room_id, (?) AS temp_user_id) AS tmp
                                WHERE NOT EXISTS (
                                    SELECT 1 FROM room_member WHERE room_id = (?) AND user_id = (?)
                                )";
        foreach ($members as $member) {
            executeQuery($conn, $insertMemberQuery, [$room_id, $member, $room_id, $member]);
        }
        $conn->commit();

        return ["success" => true, "room_id" => $room_id];
    } catch (Exception $e) {
        $conn->rollback();
        return ["success" => false, "room_id" => $room_id];
    }
}

function deleteChatRoom($id) {
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    try {
        $conn->begin_transaction();
        $roomMembersRemoveQuery =  "DELETE FROM room_member WHERE room_id = (?)";
        executeQuery($conn, $roomMembersRemoveQuery, [$id]);
        $chatroomRemoveQuery = "DELETE FROM chatroom WHERE id = (?)";
        executeQuery($conn, $chatroomRemoveQuery, [$id]);

        $conn->commit();

        return ["success" => true];
    } catch (Exception $e) {
        $conn->rollback();
        return ["success" => false, 'error' => $e];

    }
}

function changeNameRoom($name, $id) {
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }

    $conn = createConn();
    try {
        $conn->begin_transaction();
        $getQuery = "UPDATE chatroom SET name = (?) WHERE id = (?);";
        $data = executeQuery($conn, $getQuery, [$name, $id]);
        $conn->commit();

        return ["success" => true];
    } catch (Exception $e) {
        $conn->rollback();
        return ["success" => false, "error" => $e];
    }
}

function addMember($room_id, $user_id) {
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    try {
        $conn->begin_transaction();
        $getQuery = "INSERT INTO room_member (room_id, user_id)
                        SELECT * FROM (SELECT (?) AS temp_room_id, (?) AS temp_user_id) AS tmp
                        WHERE NOT EXISTS (
                            SELECT 1 FROM room_member WHERE room_id = (?) AND user_id = (?)
                        )
                    ";
        $data = executeQuery($conn, $getQuery, [$room_id, $user_id, $room_id, $user_id]);
        $conn->commit();

        return ["success" => true];
    } catch (Exception $e) {
        $conn->rollback();
        return ["success" => false, "error" => $e];
    }
}

function outRoom($room_id, $user_id) {
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    try {
        $conn->begin_transaction();
        $getQuery = "DELETE FROM room_member WHERE room_id = (?) AND user_id = (?);";
        $data = executeQuery($conn, $getQuery, [$room_id, $user_id]);
        $conn->commit();

        return ["success" => true];

    } catch (Exception $e) {
        $conn->rollback();
        return ["success" => false, "error" => $e];
    }
}

function searchUser($search) {
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    try {
        $conn->begin_transaction();
        $getQuery = "SELECT name, avt FROM user_info WHERE username = (?)";
        $data = executeQuery($conn, $getQuery, [$search]);
        $conn->commit();

        return ["success" => true, "data" => $data];

    } catch (Exception $e) {
        $conn->rollback();
        return ["success" => false, "error" => $e];
    }
}


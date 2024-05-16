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
                    DELETE FROM room_member WHERE id = ?";
        $data = executeQuery($conn, $getQuery, [$id,$id]);
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

function updateChatRoom($name,$id)
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    try {
        $conn->begin_transaction();
        $getQuery = "UPDATE chat_rooms SET name = ? WHERE id = ?;";
        $data = executeQuery($conn, $getQuery, [$name,$id]);
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

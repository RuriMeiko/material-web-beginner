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

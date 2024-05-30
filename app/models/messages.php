<?php
require_once(DIR . '/config/database.php');


function deleteMessage($id)
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    try {
        $conn->begin_transaction();
        foreach (json_decode($id) as $key => $value) {
            $getQuery = "DELETE FROM message WHERE id = ?";
            $data = executeQuery($conn, $getQuery, [$value]);
        }
        $conn->commit();

        return 'OK';
    } catch (Exception $e) {
        $conn->rollback();
        return 'FAIL';

    }
}

function updateMessage($name, $id)
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

        return $data;
    } catch (Exception $e) {
        $conn->rollback();
    }
}

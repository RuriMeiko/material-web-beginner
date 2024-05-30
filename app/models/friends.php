<?php
require_once(DIR . '/config/database.php');
function getAccount($limit)
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    $getQuery = "SELECT * FROM `user_info` LIMIT ?";
    $data = executeQuery($conn, $getQuery, [$limit]);
    if ($data) {
        return $data;
    } else {
        return ["err"];
    }
}

function addFriend($user_1, $user_2, $status)
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    try {
        $conn = createConn();
        $conn->begin_transaction();
        $getQuery = "INSERT INTO friendship (user1_id, user2_id, status) VALUES (?, ?, ?);";
        $data = executeQuery($conn, $getQuery, [$user_1, $user_2, $status]);
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


function getFriends($user_1)
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    try {
        $conn = createConn();
        $conn->begin_transaction();
        $getQuery = "SELECT user2_id,  FROM friendship WHERE user1_id = ? AND status = ? ";
        $data = executeQuery($conn, $getQuery, [$user_1, 'friend']);
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

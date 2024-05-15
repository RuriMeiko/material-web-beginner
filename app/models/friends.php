<?php
require_once (DIR . '/config/database.php');
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
    $conn = createConn();
    $getQuery = "INSERT INTO friendship (user1_id, user2_id, status) VALUES (?, ?, ?);";
    $data = executeQuery($conn, $getQuery, [$user_1, $user_2, $status]);
    if ($data) {
        return $data;
    } else {
        return ["err"];
    }
}


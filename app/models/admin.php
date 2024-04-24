<?php
require_once(DIR . '/config/database.php');


function getAllUsers($offset, $limit){
    $conn = createConn();
    $getQuery = "SELECT * FROM user_info LIMIT ? OFFSET ? ";
    $data = executeQuery($conn, $getQuery, [$limit, $offset]);
    if ($data){
        return $data;
    } else {
        return ["err"];
    }
}
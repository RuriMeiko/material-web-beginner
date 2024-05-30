<?php
require_once (DIR . '/config/database.php');


function getAllUsers($offset, $limit)
{
    
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return false;
    }

    // Kiểm tra role của người dùng
    $role = getData($_COOKIE['session']);
    if ($role[0]['role'] !== 0) {
        http_response_code(403);
        return false;
    }
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    $getQuery = "SELECT user_info.*, user_login.role, user_login.state  FROM user_info, user_login WHERE user_info.username = user_login.username LIMIT ? OFFSET ? ";
    $data = executeQuery($conn, $getQuery, [$limit, $offset]);
    if ($data) {
        return $data;
    } else {
        return ["err"];
    }
}

function getCoutUsers()
{
    
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return false;
    }

    // Kiểm tra role của người dùng
    $role = getData($_COOKIE['session']);
    if ($role[0]['role'] !== 0) {
        http_response_code(403);
        return false;
    }
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    $getQuery = "SELECT COUNT(*) FROM user_info";
    $data = executeQuery($conn, $getQuery);
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function updateRoles($accounts, $newRole)
{
    
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return false;
    }

    // Kiểm tra role của người dùng
    $role = getData($_COOKIE['session']);
    if ($role[0]['role'] !== 0) {
        http_response_code(403);
        return false;
    }
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return false;
    }
    $conn = createConn();
    $success = true;
    $accounts = json_decode($accounts);
    if (!is_array($accounts)) {
        return false;
    }
    try {
        $conn->begin_transaction();
        foreach ($accounts as $account) {
            $updateQuery = "UPDATE user_login SET role = ? WHERE username = ?";
            $updateResult = executeQuery($conn, $updateQuery, [$newRole, $account]);

            if (!$updateResult) {
                $success = false;
                break;
            }
        }
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
    }

    return $success;
}


function updateStates($accounts, $newState)
{
    
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return false;
    }

    // Kiểm tra role của người dùng
    $role = getData($_COOKIE['session']);
    if ($role[0]['role'] !== 0) {
        http_response_code(403);
        return false;
    }
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return false;
    }
    $conn = createConn();
    $success = true;
    $accounts = json_decode($accounts);
    if (!is_array($accounts)) {
        return false;
    }
    try {
        $conn->begin_transaction();
        foreach ($accounts as $account) {
            $updateQuery = "UPDATE user_login SET State = ? WHERE username = ?";
            $updateResult = executeQuery($conn, $updateQuery, [$newState, $account]);

            if (!$updateResult) {
                $success = false;
                break;
            }
        }
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
    }

    return $success;
}


function getChatRoomCount()
{
    
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return false;
    }

    // Kiểm tra role của người dùng
    $role = getData($_COOKIE['session']);
    if ($role[0]['role'] !== 0) {
        http_response_code(403);
        return false;
    }
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    $getQuery = "SELECT COUNT(*) FROM chatroom";
    $data = executeQuery($conn, $getQuery);
    if ($data) {
        return $data;
    } else {
        return false;
    }
}
function getAllChatRooms($offset, $limit)
{
    
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return false;
    }

    // Kiểm tra role của người dùng
    $role = getData($_COOKIE['session']);
    if ($role[0]['role'] !== 0) {
        http_response_code(403);
        return false;
    }
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    $getQuery = "SELECT chatroom.id, chatroom.name,chatroom.state, COUNT(room_member.user_id) AS member_count 
            FROM chatroom 
            LEFT JOIN room_member ON chatroom.id = room_member.room_id 
            GROUP BY chatroom.id, chatroom.name
            LIMIT ? OFFSET ?;";
    $data = executeQuery($conn, $getQuery, [$limit, $offset]);
    if ($data) {
        return $data;
    } else {
        return ["err"];
    }
}

function updateRoomStates($rooms, $newState)
{
    
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return false;
    }

    // Kiểm tra role của người dùng
    $role = getData($_COOKIE['session']);
    if ($role[0]['role'] !== 0) {
        http_response_code(403);
        return false;
    }
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return false;
    }
    $conn = createConn();
    $success = true;
    $rooms = json_decode($rooms);
    if (!is_array($rooms)) {
        return false;
    }
    try {
        $conn->begin_transaction();
        foreach ($rooms as $room) {
            $roomId = intval($room);
            $updateQuery = "UPDATE chatroom SET state = ? WHERE id = ?";
            $updateResult = executeQuery($conn, $updateQuery, [$newState, $roomId]);

            if (!$updateResult) {
                $success = false;
                break;
            }
        }
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
    }

    return [$success,$updateResult];
}

function statistical()
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return false;
    }

    // Kiểm tra role của người dùng
    $role = getData($_COOKIE['session']);
    if ($role[0]['role'] !== 0) {
        http_response_code(403);
        return false;
    }

    $conn = createConn();

    try {
        $conn->begin_transaction();

        $qr = "SELECT COUNT(DISTINCT username) AS count FROM user_info";
        $total = executeQuery($conn, $qr);

        $qr = "SELECT COUNT(DISTINCT username) AS count FROM user_login WHERE state = 0";
        $unban = executeQuery($conn, $qr);

        $qr = "SELECT COUNT(DISTINCT username) AS count FROM user_login WHERE state = 1";
        $ban = executeQuery($conn, $qr);

        $qr = "SELECT COUNT(DISTINCT name) AS count FROM chatroom";
        $roomtotal = executeQuery($conn, $qr);
        $qr = "SELECT COUNT(DISTINCT name) AS count FROM chatroom WHERE state = 1";
        $roomban = executeQuery($conn, $qr);
        $qr = "SELECT COUNT(DISTINCT name) AS count FROM chatroom WHERE state = 0";
        $roomuban = executeQuery($conn, $qr);

        $conn->commit();
        closeConn($conn);

        return ["total" => $total[0]['count'], "unban" => $unban[0]['count'], "ban" => $ban[0]['count'],"roomtotal" => $roomtotal[0]['count'], "roomuban" => $roomuban[0]['count'], "roomban" => $roomban[0]['count']];
    } catch (Exception $e) {
        $conn->rollback();
        closeConn($conn);

        return false;
    }
}

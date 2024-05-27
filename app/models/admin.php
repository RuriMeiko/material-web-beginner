<?php
require_once(DIR . '/config/database.php');


function getAllUsers($offset, $limit)
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    $getQuery = "SELECT user_info.*, user_login.role  FROM user_info, user_login WHERE user_info.username = user_login.username LIMIT ? OFFSET ? ";
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


function updateTalbe($data)
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return false;
    }
    $conn = createConn();

    try {
        $conn->begin_transaction();
        $jsonDecode = json_decode($data, true);
        foreach ($jsonDecode['data']  as $item) {
            $updateQuery = "UPDATE `tieu_chuan` SET `content`= ? WHERE `id`= ?";
            executeQuery($conn, $updateQuery, [$item['text'], $item['data']['id']]);
            $deleteQuery = "DELETE FROM `tieu_chi` WHERE `loai`=0";
            executeQuery($conn, $deleteQuery);
            foreach ($item['children'] as $tieuchi) {
                $id_tieu_chuan = $item['data']['id'];
                $content = $tieuchi['data']['content'];
                $diem = $tieuchi['data']['score'];
                $username = null;
                $id = $tieuchi['id'];

                $updateQuery = "INSERT INTO `tieu_chi` (`id_tieu_chuan`, `content`, `diem`, `loai`, `username`, `id`) 
                                VALUES (?, ?, ?, 0, ?, ?)";

                executeQuery($conn, $updateQuery, [$id_tieu_chuan, $content, $diem, $username, $id]);
            }
        }
        $conn->commit();
        return true;
    } catch (Exception $e) {
        return false;

        $conn->rollback();
    }
}


function getTalbe()
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return false;
    }
    $conn = createConn();

    try {
        $conn->begin_transaction();

        $updateQuery = "SELECT * FROM `tieu_chuan`";
        $datatieuchuan = executeQuery($conn, $updateQuery);
        
        $conn->commit();
        return $datatieuchuan;
    } catch (Exception $e) {
        return false;

        $conn->rollback();
    }
}

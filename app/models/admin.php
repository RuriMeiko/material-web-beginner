<?php
require_once(DIR . '/config/database.php');
require_once('profile.php');


function getAllUsers($offset, $limit)
{
    if (!isset($_COOKIE['session'])) {
        if (getData($_COOKIE['session'])['role'] !== 0) {
            http_response_code(403);
            return ["err"];
        }
        http_response_code(403);
        return ["err"];
    }
    $conn = createConn();
    $getQuery = "SELECT user_info.*, user_login.role, user_login.ban, (tieu_chi.username IS NOT NULL) AS hasReview FROM user_info JOIN user_login ON user_info.username = user_login.username LEFT JOIN tieu_chi ON tieu_chi.username = user_info.username GROUP BY user_info.username LIMIT ? OFFSET ? ";
    $data = executeQuery($conn, $getQuery, [$limit, $offset]);
    closeConn($conn);
    if ($data) {

        return $data;
    } else {

        return ["err"];
    }
}


function getCoutUsers()
{
    if (!isset($_COOKIE['session'])) {
        if (getData($_COOKIE['session'])['role'] !== 0) {
            http_response_code(403);
            return false;
        }
        http_response_code(403);
        return false;
    }
    $conn = createConn();
    $getQuery = "SELECT COUNT(*) FROM user_info";
    $data = executeQuery($conn, $getQuery);
    closeConn($conn);

    if ($data) {

        return $data;
    } else {
        return false;
    }
}



function updateRoles($accounts, $newRole)
{
    if (!isset($_COOKIE['session'])) {
        if (getData($_COOKIE['session'])['role'] !== 0) {
            http_response_code(403);
            return false;
        }
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
        return false;
    }
    closeConn($conn);

    return $success;
}

function updateBlock($accounts, $ban)
{
    if (!isset($_COOKIE['session'])) {
        if (getData($_COOKIE['session'])['role'] !== 0) {
            http_response_code(403);
            return false;
        }
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
            $updateQuery = "UPDATE user_login SET ban = ? WHERE username = ?";
            $updateResult = executeQuery($conn, $updateQuery, [$ban, $account]);
            if (!$updateResult) {
                $success = false;
                break;
            }
        }
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
    }
    closeConn($conn);

    return $success;
}


function updateTalbe($data)
{
    if (!isset($_COOKIE['session'])) {
        if (getData($_COOKIE['session'])['role'] !== 0) {
            http_response_code(403);
            return false;
        }
        http_response_code(403);
        return false;
    }
    $conn = createConn();

    try {
        $conn->begin_transaction();
        $jsonDecode = json_decode($data, true);
        $deleteQuery = "DELETE FROM `tieu_chi`";
        executeQuery($conn, $deleteQuery);
        foreach ($jsonDecode['data']  as $item) {
            $updateQuery = "UPDATE `tieu_chuan` SET `content`= ? WHERE `id`= ?";
            executeQuery($conn, $updateQuery, [$item['text'], $item['data']['id']]);

            foreach ($item['children'] as $tieuchi) {
                $id_tieu_chuan = $item['data']['id'];
                $content = $tieuchi['data']['content'];
                $diem = $tieuchi['data']['score'];
                $indexId = $tieuchi['data']['index'];
                $id = $tieuchi['id'];

                $updateQuery = "INSERT INTO `tieu_chi` (`id_tieu_chuan`, `indexId` , `content`, `diem`, `loai`, `username`, `id`) 
                                VALUES (?, ?, ?, ?, 0, null, ?)";

                executeQuery($conn, $updateQuery, [$id_tieu_chuan, $indexId, $content, $diem, $id]);
            }
        }
        $conn->commit();
        closeConn($conn);
        return true;
    } catch (Exception $e) {
        $conn->rollback();
        closeConn($conn);
        return false;
    }
}


function getTalbe()
{
    if (!isset($_COOKIE['session'])) {
        if (getData($_COOKIE['session'])['role'] !== 0) {
            http_response_code(403);
            return false;
        }
        http_response_code(403);
        return false;
    }
    $conn = createConn();

    try {
        $conn->begin_transaction();
        $dataReturn = [];
        $updateQuery = "SELECT * FROM `tieu_chuan`";
        $datatieuchuan = executeQuery($conn, $updateQuery);
        foreach ($datatieuchuan as $tieuchuan) {
            $updateQuery = "SELECT `tieu_chi`.*, `tieu_chuan`.content AS 'tentieuchuan' FROM `tieu_chi`, `tieu_chuan` WHERE `tieu_chuan`.id = `tieu_chi`.id_tieu_chuan AND loai = 0 AND `tieu_chuan`.id = ? ORDER BY `tieu_chi`.`indexId`";
            $datatieuchuan = executeQuery($conn, $updateQuery, [$tieuchuan['id']]);
            array_push($dataReturn, [$tieuchuan['id'] => $datatieuchuan]);
        }

        $conn->commit();
        closeConn($conn);

        return $dataReturn;
    } catch (Exception $e) {
        $conn->rollback();
        closeConn($conn);

        return false;
    }
}



function checkVail($value, $conn)
{
    try {
        foreach ($value as $index => $item) {
            if (!isset($item['oritieuchiid']) || !isset($item['idtieuchi']) || !isset($item['diem'])) return false;
            $oritieuchiid = $item['oritieuchiid'];

            $diem = $item['diem'];

            $checkQuery = "SELECT * FROM `tieu_chi` WHERE `id` = ?";
            $data = executeQuery($conn, $checkQuery, [$oritieuchiid]);
            if (!$data) {
                return false;
            }
            if ($diem > $data[0]['diem'] || $diem < 0) {
                return false;
            };
            return true;
        }
    } catch (Exception $e) {
        return false;
    }
}


function reviewTable($data)
{
    if (!isset($_COOKIE['session'])) {
        if (getData($_COOKIE['session'])['role'] !== 0) {
            http_response_code(403);
            return false;
        }
        http_response_code(403);
        return false;
    }
    $conn = createConn();
    $iv = substr(md5(md5('huhu')), 0, 16);
    $decryptedUsername = openssl_decrypt(base64_decode($_COOKIE['session']), 'AES-256-CBC', md5('haha'), OPENSSL_RAW_DATA, $iv);
    try {
        $conn->begin_transaction();
        $jsonDecode = json_decode($data, true);
        if (!isset($jsonDecode['dataSend']) || !isset($jsonDecode['status'])) {
            closeConn($conn);
            return false;
        }
        if (!checkVail($jsonDecode['dataSend'], $conn)) {
            closeConn($conn);
            return false;
        }
        $deleteQuery = "DELETE FROM `tieu_chi` WHERE `username`= ?";
        executeQuery($conn, $deleteQuery, [$decryptedUsername]);
        foreach ($jsonDecode['dataSend'] as $index => $item) {
            $diem = $item['diem'];
            $id = $item['idtieuchi'];

            $updateQuery = "UPDATE `tieu_chi` SET `diem`= ?, `reviewUsername`= ?,`isGood`= ? WHERE `id`= ?";

            executeQuery($conn, $updateQuery, [$diem, $decryptedUsername, $jsonDecode['status'] ? 1 : 0, $id]);
        }
        $conn->commit();
        closeConn($conn);

        return true;
    } catch (Exception $e) {
        $conn->rollback();
        closeConn($conn);

        return false;
    }
}


function statistical()
{
    if (!isset($_COOKIE['session'])) {
        if (getData($_COOKIE['session'])['role'] !== 0) {
            http_response_code(403);
            return false;
        }
        http_response_code(403);
        return false;
    }
    $conn = createConn();

    try {
        $conn->begin_transaction();
        $qr = "SELECT COUNT(DISTINCT username) AS count
        FROM tieu_chi WHERE isGood = 0";
        $notOK  = executeQuery($conn, $qr);
        $qr = "SELECT COUNT(DISTINCT username) AS count
        FROM tieu_chi WHERE isGood = 1";
        $ok  = executeQuery($conn, $qr);

        return ["good" => $ok[0]['count'], "notgood" => $notOK[0]['count']];
    } catch (Exception $e) {
        $conn->rollback();
        closeConn($conn);

        return false;
    }
}

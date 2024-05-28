<?php
require_once(DIR . '/config/database.php');
function generateUUID()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}

function checkVail($value, $conn)
{
    try {
        foreach ($value as $index => $item) {
            if (!isset($item['idtieuchuan']) || !isset($item['idtieuchi']) || !isset($item['diem'])) return false;
            $id_tieu_chuan = $item['idtieuchuan'];
            $id_tieu_chi = $item['idtieuchi'];

            $diem = $item['diem'];

            $checkQuery = "SELECT * FROM `tieu_chuan` WHERE `id` =  ?";
            $data = executeQuery($conn, $checkQuery, [$id_tieu_chuan]);
            if (!$data) {
                return false;
            }
            $checkQuery = "SELECT * FROM `tieu_chi` WHERE `id` = ?";
            $data = executeQuery($conn, $checkQuery, [$id_tieu_chi]);
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

function updateTalbe($data)
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return false;
    }
    $conn = createConn();
    $iv = substr(md5(md5('huhu')), 0, 16);
    $decryptedUsername = openssl_decrypt(base64_decode($_COOKIE['session']), 'AES-256-CBC', md5('haha'), OPENSSL_RAW_DATA, $iv);
    try {
        $conn->begin_transaction();
        $jsonDecode = json_decode($data, true);
        if (!checkVail($jsonDecode, $conn)) {
            closeConn($conn);
            return false;
        }
        $deleteQuery = "DELETE FROM `tieu_chi` WHERE `username`= ?";
        executeQuery($conn, $deleteQuery, [$decryptedUsername]);
        foreach ($jsonDecode as $index => $item) {
            $id_tieu_chuan = $item['idtieuchuan'];
            $diem = $item['diem'];
            $id =  generateUUID();

            $updateQuery = "INSERT INTO `tieu_chi` (`id_tieu_chuan`, `indexId`,`content`, `diem`, `loai`, `username`, `id`) 
                                VALUES (?, ?, ?, ?, 1, ?, ?)";

            executeQuery($conn, $updateQuery, [$id_tieu_chuan, $index, null, $diem, $decryptedUsername, $id]);
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


function getTalbe($username)
{
    if (!isset($_COOKIE['session'])) {
        http_response_code(403);
        return false;
    }
    $conn = createConn();

    try {
        $conn->begin_transaction();
        $dataReturnP1 = [];
        $dataReturnP2 = [];

        $updateQuery = "SELECT * FROM `tieu_chuan`";
        $datatieuchuan = executeQuery($conn, $updateQuery);
        foreach ($datatieuchuan as $tieuchuan) {
            $updateQuery = "SELECT `tieu_chi`.*, `tieu_chuan`.content AS 'tentieuchuan' FROM `tieu_chi`, `tieu_chuan` WHERE `tieu_chuan`.id = `tieu_chi`.id_tieu_chuan AND loai = 0 AND `tieu_chuan`.id = ? ORDER BY `tieu_chi`.`indexId`";
            $datatieuchuan = executeQuery($conn, $updateQuery, [$tieuchuan['id']]);
            $updateQueryP2 = "SELECT `tieu_chi`.*, `tieu_chuan`.content AS 'tentieuchuan' FROM `tieu_chi`, `tieu_chuan` WHERE `tieu_chuan`.id = `tieu_chi`.id_tieu_chuan AND loai = 1 AND `tieu_chuan`.id = ? AND `tieu_chi`.username = ? ORDER BY `tieu_chi`.`indexId`";
            $datatieuchuanP2 = executeQuery($conn, $updateQueryP2, [$tieuchuan['id'], $username[0]]);
            array_push($dataReturnP1, [$tieuchuan['id'] => $datatieuchuan]);
            array_push($dataReturnP2, [$tieuchuan['id'] => $datatieuchuanP2]);
        }

        $conn->commit();
        closeConn($conn);

        return ['Title' => $dataReturnP1, 'DataReturn' => $dataReturnP2];
    } catch (Exception $e) {
        $conn->rollback();
        closeConn($conn);

        return false;
    }
}

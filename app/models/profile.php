<?php
require_once (DIR . '/config/database.php');


function updateUser($username, $password, $name, $gender, $birthday, $location, $imageUrl)
{
    if (!isset($_COOKIE['session'])) {
        return 'NO_AUTH';
    }
    $conn = createConn();

    try {
        $conn->begin_transaction();

        if ($password === '' && $imageUrl === '') {
            $updateQuery = "UPDATE `user_info` SET `name` = ?, `gender` = ?, `birthday` = ?, `location` = ? WHERE username = ?";
            executeQuery($conn, $updateQuery, [$name, $gender, $birthday, $location, $username]);
        } elseif ($password === '') {
            $updateQuery = "UPDATE `user_info` SET `name` = ?, `gender` = ?, `birthday` = ?, `location` = ?, `avt` = ? WHERE username = ?";
            executeQuery($conn, $updateQuery, [$name, $gender, $birthday, $location, $imageUrl, $username]);
        } elseif ($imageUrl === '') {
            $updateQuery = "UPDATE `user_info` SET  `name` = ?, `gender` = ?, `birthday` = ?, `location` = ? WHERE username = ?";
            executeQuery($conn, $updateQuery, [$name, $gender, $birthday, $location, $username]);
            $updateQuery = "UPDATE `user_login` SET `hashpassword` = ? WHERE username = ?";
            executeQuery($conn, $updateQuery, [password_hash($password, PASSWORD_DEFAULT), $username]);
        } else {
            $updateQuery = "UPDATE `user_info` SET `name` = ?, `gender` = ?, `birthday` = ?, `location` = ?, `avt` = ? WHERE username = ?";
            executeQuery($conn, $updateQuery, [$name, $gender, $birthday, $location, $imageUrl, $username]);
            $updateQuery = "UPDATE `user_login` SET `hashpassword` = ? WHERE username = ?";
            executeQuery($conn, $updateQuery, [password_hash($password, PASSWORD_DEFAULT), $username]);
        }
        $conn->commit();
        return 'OK';

    } catch (Exception $e) {
        $conn->rollback();
        return 'FAIL: ' . $e;
    }
}
;

function getData($username)
{
    $conn = createConn();

    $checkQuery = "SELECT user_info.* ,  user_login.role ,user_login.state FROM user_info , user_login WHERE user_login.username=user_info.username AND user_login.username = ?";
    $iv = substr(md5(md5('huhu')), 0, 16);
    $decryptedUsername = openssl_decrypt(base64_decode($username), 'AES-256-CBC', md5('haha'), OPENSSL_RAW_DATA, $iv);
    $checkResult = executeQuery($conn, $checkQuery, [$decryptedUsername]);

    if ($checkResult) {
        return $checkResult;
    } else {
        return false;
    }
}
;

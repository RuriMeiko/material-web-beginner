<?php
require_once(DIR . '/config/database.php');
require_once('login.php');


function updateUser($username, $name, $gender, $birthday, $location, $imageUrl)
{
    if (!isset($_COOKIE['session'])) {
        return 'NO_AUTH';
    }
    $conn = createConn();

    try {
        $conn->begin_transaction();

        if ($imageUrl) {
            $updateQuery = "UPDATE `user_info` SET `name` = ?, `gender` = ?, `birthday` = ?, `location` = ?, `avt` = ? WHERE username = ?";
            executeQuery($conn, $updateQuery, [$name, $gender, $birthday, $location, $imageUrl, $username]);
        } else {
            $updateQuery = "UPDATE `user_info` SET `name` = ?, `gender` = ?, `birthday` = ?, `location` = ? WHERE username = ?";
            executeQuery($conn, $updateQuery, [$name, $gender, $birthday, $location, $username]);
        }
        $conn->commit();
        return 'OK';
    } catch (Exception $e) {
        $conn->rollback();
        return 'FAIL: ' . $e;
    }
};

function updatePass($username, $currpassword, $password)
{
    if (!isset($_COOKIE['session'])) {
        return 'NO_AUTH';
    }
    $conn = createConn();
    if (loginUser($username, $currpassword))
        try {
            if ($currpassword === $password) return 'DUP_PASSWORD';
            $conn->begin_transaction();

            $updateQuery = "UPDATE `user_login` SET `hashpassword` = ? WHERE username = ?";
            executeQuery($conn, $updateQuery, [password_hash($password, PASSWORD_DEFAULT), $username]);
            $conn->commit();
            return 'OK';
        } catch (Exception $e) {
            $conn->rollback();
            return 'FAIL: ' . $e;
        }
    else
        return 'PASSWORDNOTMATCH';
}

function getData($username)
{
    $conn = createConn();

    $checkQuery = "SELECT user_info.* ,  user_login.role FROM user_info , user_login WHERE user_login.username=user_info.username AND user_login.username = ?";
    $iv = substr(md5(md5('huhu')), 0, 16);
    $decryptedUsername = openssl_decrypt(base64_decode($username), 'AES-256-CBC', md5('haha'), OPENSSL_RAW_DATA, $iv);
    $checkResult = executeQuery($conn, $checkQuery, [$decryptedUsername]);

    if ($checkResult) {
        return $checkResult;
    } else {
        return false;
    }
};

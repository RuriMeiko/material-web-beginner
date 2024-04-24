<?php
require_once(DIR . '/config/database.php');


function updateUser($username, $password, $hoten, $gioitinh, $namsinh, $quequan, $imageUrl)
{
    $conn = createConn();

    if ($password === '' && $imageUrl === '') {
        $insertQuery = "UPDATE `data` SET `hoten` = ?, `gioitinh` = ?, `namsinh` = ?, `quequan` = ? WHERE username = ?";
        $insertResult = executeQuery($conn, $insertQuery, [$hoten, $gioitinh, $namsinh, $quequan, $username]);
    } elseif ($password === '') {

        $insertQuery = "UPDATE `data` SET `hoten` = ?, `gioitinh` = ?, `namsinh` = ?, `quequan` = ?, `avt` = ? WHERE username = ?";
        $insertResult = executeQuery($conn, $insertQuery, [$hoten, $gioitinh, $namsinh, $quequan, $imageUrl, $username]);
    } elseif ($imageUrl === '') {

        $insertQuery = "UPDATE `data` SET `hashpassword` = ?, `hoten` = ?, `gioitinh` = ?, `namsinh` = ?, `quequan` = ? WHERE username = ?";
        $insertResult = executeQuery($conn, $insertQuery, [password_hash($password, PASSWORD_DEFAULT), $hoten, $gioitinh, $namsinh, $quequan, $username]);
    } else {

        $insertQuery = "UPDATE `data` SET `hashpassword` = ?, `hoten` = ?, `gioitinh` = ?, `namsinh` = ?, `quequan` = ?, `avt` = ? WHERE username = ?";
        $insertResult = executeQuery($conn, $insertQuery, [password_hash($password, PASSWORD_DEFAULT), $hoten, $gioitinh, $namsinh, $quequan, $imageUrl, $username]);
    }

    if ($insertResult) {
        http_response_code(200);
        echo "<script>
        window.alert('Cập nhật thành công!')
        window.location.href = '/profile';
      </script>";
    } else {
        http_response_code(500);
        echo "<script>
        window.alert('Có lỗi xảy ra!')
      </script>";
    }
};

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

function getAllUsers($offset, $limit){
    $conn = createConn();
    $getQuery = "SELECT DISTINCT u.username, u.name, u.location, u.gender, u.birddate, ul.role
    FROM user_info u
    JOIN user_login ul ON u.username = ul.username
    LIMIT ? OFFSET ?";
    $data = executeQuery($conn, $getQuery, [$limit, $offset]);
    if ($data){
        return $data;
    } else {
        return ["err"];
    }
}
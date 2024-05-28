<?php
require_once(DIR . '/config/database.php');

function loginUser($username, $password)
{
    $conn = createConn();

    $checkQuery = "SELECT * FROM user_login WHERE username = ?";
    $checkResult = executeQuery($conn, $checkQuery, [$username]);
    if ($checkResult[0]['ban'] === 1) return "Ban";
    if ($checkResult && isset($checkResult[0]['hashpassword']) && password_verify($password, $checkResult[0]['hashpassword'])) {
        http_response_code(200);
        $iv = substr(md5(md5('huhu')), 0, 16);

        $encodeUsername = base64_encode(
            openssl_encrypt(
                $username,
                'AES-256-CBC',
                md5('haha'),
                OPENSSL_RAW_DATA,
                $iv
            )
        );
        closeConn($conn);

        return $encodeUsername;
    }
    else {
        closeConn($conn);

        return "Wrong";
    }
};


function registerUser($username, $password, $name, $birthday, $gender, $location)
{
    $conn = createConn();

    $checkQuery = "SELECT * FROM user_info WHERE username = ?";
    $checkResult = executeQuery($conn, $checkQuery, [$username]);

    if ($checkResult) {
        return 'DUPLICATE';
    } else {
        try {
            $conn->begin_transaction();
            $insertQuery = "INSERT INTO user_login(username,hashpassword) VALUES (?, ?)";
            executeQuery($conn, $insertQuery, [$username, password_hash($password, PASSWORD_DEFAULT)]);

            $insertQuery = "INSERT INTO user_info(username,name,birthday,gender,location) VALUES (?, ?, ?, ?, ?)";
            executeQuery($conn, $insertQuery, [$username, $name, $birthday, $gender, $location]);


            $conn->commit();
            closeConn($conn);

            return 'OK';
        } catch (Exception $e) {
            
            $conn->rollback();
            closeConn($conn);
            return 'FAIL: ' . $e;
        }
    }
};

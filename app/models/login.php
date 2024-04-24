<?php
require_once(DIR . '/config/database.php');

function loginUser($username, $password)
{
    $conn = createConn();

    $checkQuery = "SELECT * FROM user_login WHERE username = ?";
    $checkResult = executeQuery($conn, $checkQuery, [$username]);
    if ($checkResult && isset($checkResult[0]['hashpassword']) && password_verify($password, $checkResult[0]['hashpassword'])) {
        http_response_code(200);
        $iv = substr(md5(md5('huhu')), 0, 16);

        $encodeUsername = base64_encode(openssl_encrypt(
            $username,
            'AES-256-CBC',
            md5('haha'),
            OPENSSL_RAW_DATA,
            $iv
        ));
        setcookie("session", $encodeUsername, time() + 3600, "/");
        header("Location: /profile");
    } else {
        http_response_code(403);
        echo json_encode(["mess" => "failed to login"]);
    }
};


function registerUser($username, $password, $name, $birddate, $gender, $location)
{
    $conn = createConn();

    $checkQuery = "SELECT * FROM user_info WHERE username = ?";
    $checkResult = executeQuery($conn, $checkQuery, [$username]);

    if ($checkResult) {
        http_response_code(403);
        echo "Tài khoản đã tồn tại!";
    } else {
        try {
            $conn->begin_transaction();
            $insertQuery = "INSERT INTO user_login(username,hashpassword) VALUES (?, ?)";
            executeQuery($conn, $insertQuery, [$username, password_hash($password, PASSWORD_DEFAULT)]);

            $insertQuery = "INSERT INTO user_info(username,name,birddate,gender,location) VALUES (?, ?, ?, ?, ?)";
            executeQuery($conn, $insertQuery, [$username, $name, $birddate, $gender, $location]);


            $conn->commit();
            http_response_code(200);
            echo "Gâu gâu!";
        } catch (Exception $e) {
            $conn->rollback();
            http_response_code(403);
            echo "Có lỗi xảy ra!" . $e;
        }
    }
};

<?php
require_once (DIR . '/app/models/login.php');

if (isset($_POST)) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $birthday = $_POST["birthday"];
    $gender = $_POST["gender"];
    $location = $_POST["location"];
    $status = registerUser($username, $password, $name, $birthday, $gender, $location);
    switch ($status) {
        case 'DUPLICATE':
            http_response_code(403);
            echo "Tài khoản đã tồn tại!";
            break;
        case 'OK':
            http_response_code(200);
            echo "OK";
            break;
        default:
            http_response_code(500);
            echo "Có lỗi xảy ra!" . $status;
            break;
    }

}

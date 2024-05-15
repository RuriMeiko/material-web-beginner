<?php
require_once (DIR . '/app/models/chat.php');
if (isset($_POST)) {
    if (isset($_POST["admin"])){
        $amin = $_POST["admin"];
        $user = $_POST["user"];
        $name = $_POST["name"];
        $status = createChatRoom($user, $amin, $name);
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
                echo "Có lỗi xảy ra!";
                break;
        }
    }

} 

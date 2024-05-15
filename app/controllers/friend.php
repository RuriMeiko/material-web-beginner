<?php
require_once (DIR . '/app/models/friends.php');
if (isset($_POST)) {
    if(isset($_POST["status"])){
        if ($_POST["status"]=="addf") {
            $user_1 = $_POST["user_1"];
            $user_2 = $_POST["user_2"];
            $state = $_POST["state"];
            $status = addfriend($user_1,$user_2,$state);
        }
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

}



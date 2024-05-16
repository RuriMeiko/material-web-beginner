<?php
require_once (DIR . '/app/models/messages.php');
if (isset($_POST)) {
    if (isset($_POST["status"])) {
        if ($_POST["status"] == "sendM") {
            $content = $_POST["content"];
            $receiver = $_POST["receiver"];
            $sender = $_POST["sender"];
            $status = createMessage($content, $receiver, $sender);
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
        } else {
            http_response_code(500);
            echo "không xác định được hành vi !";
        }
    
    } else {
        http_response_code(500);
        echo "không có status";
    }

}

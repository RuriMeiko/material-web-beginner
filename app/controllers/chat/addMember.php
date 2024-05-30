<?php
require_once (DIR . '/app/models/chat.php');

if (isset($_POST)) {
    $room_id = $_POST["room_id"];
    $user_id = $_POST["user_id"];
    $status = addMember($room_id, $user_id);
    
    if ($status['success']) {
        http_response_code(200);
        echo "OK";
    }else {
        http_response_code(500);
        echo "Có lỗi xảy ra!" . json_encode($status);
    }

}

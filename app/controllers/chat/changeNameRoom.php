<?php
require_once (DIR . '/app/models/chat.php');

if (isset($_POST)) {
    $room_name = $_POST["room_name"];
    $room_id = $_POST["room_id"];
    $status = changeNameRoom($room_name, $room_id);
    
    if ($status['success']) {
        http_response_code(200);
        echo "OK";
    }else {
        http_response_code(500);
        echo "Có lỗi xảy ra!" . json_encode($status);
    }

}

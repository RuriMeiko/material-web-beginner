<?php
require_once (DIR . '/app/models/chat.php');

if (isset($_POST)) {
    $search = $_POST["search"];
    $status = searchUser($search);
    
    if ($status['success']) {
        http_response_code(200);
        echo json_encode($status['data']);
    }else {
        http_response_code(500);
        echo "Có lỗi xảy ra!" . json_encode($status);
    }

}

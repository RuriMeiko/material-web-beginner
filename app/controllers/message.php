<?php
require_once(DIR . '/app/models/messages.php');
if (isset($_POST)) {
    if (isset($_POST["status"])) {

        if ($_POST["status"] == "delM") {
            $id = $_POST["id"];
            $status = deleteMessage($id);
            switch ($status) {

                case 'OK':
                    http_response_code(200);
                    echo json_encode(['status' => "OK"]);
                    break;
                default:
                    http_response_code(500);
                    echo json_encode(['status' => "Có lỗi xảy ra!"]);
                    break;
            }
        } else {
            http_response_code(500);
            echo json_encode(['status' => "không xác định được hành vi !"]);
        }
    } else {
        http_response_code(500);
        echo json_encode(['status' => ""]);
    }
}

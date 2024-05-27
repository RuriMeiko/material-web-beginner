<?php
require_once(DIR . '/app/models/admin.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu JSON từ phần thân yêu cầu
    $jsonData = file_get_contents('php://input');

    // Chuyển đổi dữ liệu JSON thành mảng PHP
    $data = json_decode($jsonData, true);


    // Gọi hàm từ model để cập nhật role cho từng tài khoản
    $success = updateTalbe($jsonData);

    if ($success) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => $success], JSON_UNESCAPED_UNICODE);
    } else {
        // Trả về thông báo lỗi
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật bảng'], JSON_UNESCAPED_UNICODE);
    }
} else 
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data = getTalbe();
    if ($data) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => $data], JSON_UNESCAPED_UNICODE);
    } else {
        // Trả về thông báo lỗi
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật bảng'], JSON_UNESCAPED_UNICODE);
    }
}

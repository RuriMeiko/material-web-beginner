<?php
require_once(DIR . '/app/models/fastcheck.php');

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

    if (!isset($username)) {
        $iv = substr(md5(md5('huhu')), 0, 16);
        if (isset($_COOKIE['session'])) {
            $username = [openssl_decrypt(base64_decode($_COOKIE['session']), 'AES-256-CBC', md5('haha'), OPENSSL_RAW_DATA, $iv)];
        }
    }
    $data = getTalbe($username);
    if ($_SERVER['REQUEST_URI'] == '/api/fastcheck') {
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => $data], JSON_UNESCAPED_UNICODE);
        } else {
            // Trả về thông báo lỗi
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi lấy thông tin bảng'], JSON_UNESCAPED_UNICODE);
        }
    }
}

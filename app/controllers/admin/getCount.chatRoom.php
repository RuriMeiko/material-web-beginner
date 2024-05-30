<?php
require_once(DIR . '/app/models/admin.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Gọi hàm từ model để cập nhật role cho từng tài khoản
    $success = getChatRoomCount();

    if ($success) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => $success[0]['COUNT(*)']]);
    } else {
        // Trả về thông báo lỗi
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật role']);
    }
}

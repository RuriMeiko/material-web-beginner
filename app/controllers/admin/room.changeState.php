<?php
require_once(DIR . '/app/models/admin.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nhận dữ liệu từ client (danh sách tài khoản và role mới)
    $rooms = $_POST['rooms'];
    $newState = $_POST['newState'];

    // Gọi hàm từ model để cập nhật role cho từng tài khoản
    $success = updateRoomStates($rooms, $newState);

    if ($success) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Cập nhật trạng thái thành công']);
    } else {
        // Trả về thông báo lỗi
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật trạng thái']);
    }
}

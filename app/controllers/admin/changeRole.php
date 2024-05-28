<?php
require_once(DIR . '/app/models/admin.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accounts']) && isset($_POST['newRole'])) {
    // Nhận dữ liệu từ client (danh sách tài khoản và role mới)
    $accounts = $_POST['accounts'];
    $newRole = $_POST['newRole'];

    // Gọi hàm từ model để cập nhật role cho từng tài khoản
    $success = updateRoles($accounts, $newRole);

    if ($success) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Cập nhật role thành công']);
    } else {
        // Trả về thông báo lỗi
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật role']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật role']);
}

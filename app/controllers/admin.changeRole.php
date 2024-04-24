<?php
require_once(DIR . '/app/models/updateRoleModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nhận dữ liệu từ client (danh sách tài khoản và role mới)
    $accounts = $_POST['accounts'];
    $newRole = $_POST['newRole'];

    // Gọi hàm từ model để cập nhật role cho từng tài khoản
    $success = updateRoles($accounts, $newRole);

    if ($success) {
        // Trả về thông báo thành công
        echo json_encode(['success' => true, 'message' => 'Cập nhật role thành công']);
    } else {
        // Trả về thông báo lỗi
        echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật role']);
    }
}
?>
<?php
require_once(DIR . '/app/models/admin.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accounts']) && isset($_POST['block'])) {
    // Nhận dữ liệu từ client (danh sách tài khoản và role mới)
    $accounts = $_POST['accounts'];
    $block = $_POST['block'];

    // Gọi hàm từ model để cập nhật role cho từng tài khoản
    $success = updateBlock($accounts, $block);

    if ($success) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Cập nhật trạng thái thành công']);
    } else {
        // Trả về thông báo lỗi
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật trạng thái']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật trạng thái']);
}

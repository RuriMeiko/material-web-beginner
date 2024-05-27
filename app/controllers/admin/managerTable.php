<?php
require_once(DIR . '/app/models/admin.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu JSON từ phần thân yêu cầu
    $jsonData = file_get_contents('php://input');

    // Chuyển đổi dữ liệu JSON thành mảng PHP
    $data = json_decode($jsonData, true);

    // Xử lý dữ liệu và trả về phản hồi JSON
    $response = array('message' => 'Success');
    echo json_encode($response);

    // Gọi hàm từ model để cập nhật role cho từng tài khoản
    // $success = updateRoles($accounts, $newRole);

    // if ($success) {
    //     header('Content-Type: application/json');
    //     echo json_encode(['success' => true, 'message' => 'Cập nhật role thành công']);
    // } else {
    //     // Trả về thông báo lỗi
    //     header('Content-Type: application/json');
    //     echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật role']);
    // }
}

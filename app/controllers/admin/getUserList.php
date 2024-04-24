<?php
require_once(DIR . '/app/models/admin.php');
if (isset($_POST)) {
    // Lấy thông tin từ form
    $obset = $_POST['obset'];
    $range = $_POST['range'];
    echo json_encode(getAllUsers($obset,$range));
}

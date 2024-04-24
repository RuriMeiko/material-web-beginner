<?php
require_once(DIR . '/app/models/profile.php');
if (isset($_POST)) {
    // Lấy thông tin từ form
    $obset = $_POST['obset'];
    $range = $_POST['range'];
    echo json_encode(getAllUsers($obset,$range));

}

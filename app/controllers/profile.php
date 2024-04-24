<?php
require_once(DIR . '/app/models/profile.php');
require_once DIR . '/lib/tiktok.php';
function checkTime()
{
    $currentHour = date('H') + 7;
    $timeOfDay = '';

    if ($currentHour >= 5 && $currentHour < 12) {
        $timeOfDay = "buổi sáng! ";
    } else if ($currentHour >= 12 && $currentHour < 18) {
        $timeOfDay = "buổi trưa! ";
    } else {
        $timeOfDay = "buổi tối! ";
    }

    return $timeOfDay;
}
if (!isset($_COOKIE['session'])) {
    // Người dùng chưa đăng nhập
    header("Location: /");
} else {
    $datanguoidung = getData($_COOKIE['session']);
    if ($datanguoidung[0]['role'] === 0) {
        header("Location: /admin");
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy thông tin từ form
    $username = $_POST['username'];

    $password = $_POST['password'];
    $hoten = $_POST['name'];
    $namsinh = $_POST['birddate'];
    $gioitinh = $_POST['gender'];
    $quequan = $_POST['location'];
    $imageUrl = '';
    // Lấy thông tin ảnh từ form
    if (isset($_FILES['avatar'])) {
        $file = $_FILES['avatar'];
        $fileName = $file['name'];
        $fileTmpPath = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $destination = DIR . '/temp/' . $fileName;
        if (move_uploaded_file($fileTmpPath, $destination)) {
            // Confirm that the uploaded file is an image
            $imageInfo = getimagesize($destination);
            if ($imageInfo !== false) {

                // Upload the image to TikTok
                $imageUrl = uploadImageToTiktok($destination);
                if (file_exists($destination)) {
                    // Delete the uploaded file
                    unlink($destination);
                }
            }
        }
    }
    updateUser($username, $password, $hoten, $gioitinh, $namsinh, $quequan, $imageUrl);
}

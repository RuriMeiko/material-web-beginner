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
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Lấy thông tin từ form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $location = $_POST['location'];
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
                $uploader = new TiktokUploader('9BrXKhM5zk3UXppyxHP2EtgbdLWZJg9W', '5fff60a14df53716dee76bed468a5ae0');
                // Upload the image to TikTok
                $imageUrl = $uploader->uploadImage($destination);
                $uploader->close();
           
            }
        }
    }
    updateUser($username, $password, $name, $gender, $birthday, $location, $imageUrl);
}

<?php
require_once(DIR . '/app/models/profile.php');
require_once DIR . '/lib/tiktok.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy thông tin từ form
    $username = $_POST['username'];

    $password = $_POST['password'];
    $namsinh = $_POST['birthdayDate'];
    $gioitinh = $_POST['gioitinh'];
    $hoten = $_POST['hoten'];
    $quequan = $_POST['quequan'];
    $imageUrl = '';
    // Lấy thông tin ảnh từ form
    if (isset($_FILES['avatar'])) {
        $file = $_FILES['avatar'];
        $fileName = $file['name'];
        $fileTmpPath = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $destination = './temp/' . $fileName;
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

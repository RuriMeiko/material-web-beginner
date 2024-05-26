<?php
require_once(DIR . '/app/models/profile.php');
require_once DIR . '/lib/imgbb.php';
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
    if (isset($_POST['newpassword'])) {
        $username = $_POST['username'];

        if (!isset($_POST['username'])) {
            http_response_code(500);
            echo 'MISSING_USERNAME';
            exit($username);
        }
        $status = updatePass($username, $_POST['currentpassword'], $_POST['newpassword']);
        switch ($status) {
            case 'NO_AUTH':
                http_response_code(500);
                echo 'SESSION EXPIRED';
                exit();
            case 'OK':
                http_response_code(200);
                setcookie("session", "", time() - 3600, "/");
                echo 'OK';
                exit();
            case 'PASSWORDNOTMATCH':
                http_response_code(403);
                echo 'PASSWORDNOTMATCH';
                exit();
            case 'DUP_PASSWORD':
                http_response_code(203);
                echo 'PASSWORDNOTMATCH';
                exit();
            default:
                http_response_code(500);
                echo "Có lỗi xảy ra!" . $status;
                exit();
        }
    } else {
        // Lấy thông tin từ form
        $username = $_POST['username'];
        if (!isset($_POST['username'])) {
            http_response_code(403);
            echo 'MISSING_USERNAME';
            exit();
        }
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $birthday = $_POST['birthday'];
        $location = $_POST['location'];
        $imageUrl = false;
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
                    // $uploader = new TiktokUploader('9BrXKhM5zk3UXppyxHP2EtgbdLWZJg9W', '5ca17b36dce64b6d5409402b0ec8db37');
                    // Upload the image to TikTok

                    $imageUrl = uploadImageAndGetUrl($destination, '453737ca30a98c774a0e36e3e04014b6');
                }
            }
        }
        $status = updateUser($username, $name, $gender, $birthday, $location, $imageUrl);
        switch ($status) {
            case 'NO_AUTH':
                http_response_code(403);
                echo 'SESSION EXPIRED';
                exit();
            case 'OK':
                http_response_code(200);
                echo 'OK';
                exit();
            default:
                http_response_code(500);
                echo "Có lỗi xảy ra!" . $status;
                exit();
        }
    }
}

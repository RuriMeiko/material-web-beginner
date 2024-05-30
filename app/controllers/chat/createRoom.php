<?php
require_once (DIR . '/app/models/chat.php');
require_once DIR . '/lib/imgbb.php';


if (isset($_POST)) {
    $room_name = $_POST["room_name"];
    $members = $_POST["members"];

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
                // $uploader = new TiktokUploader('9BrXKhM5zk3UXppyxHP2EtgbdLWZJg9W', '5ca17b36dce64b6d5409402b0ec8db37');
                // Upload the image to TikTok

                $imageUrl = uploadImageAndGetUrl($destination, '453737ca30a98c774a0e36e3e04014b6');
            }
        }
    }

    var_dump($imageUrl);

    $status = createRoom($room_name, json_decode($members, true), $imageUrl);

    if ($status['success']) {
        http_response_code(200);
        echo "OK" ;
    } else {
        http_response_code(500);
        echo "Có lỗi xảy ra!" . json_encode($status);
    }

}

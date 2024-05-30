<?php
function uploadImageAndGetUrl($image_path, $api_key)
{
    // Đọc nội dung của tệp hình ảnh
    $image_data = file_get_contents($image_path);

    // Tạo một mảng dữ liệu để gửi yêu cầu tải lên
    $data = array(
        'key' => $api_key,
        'image' => base64_encode($image_data)
    );

    // Gửi yêu cầu POST đến API ImgBB
    $ch = curl_init('https://api.imgbb.com/1/upload');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Kiểm tra và lấy display_url từ phản hồi JSON
    $result = json_decode($response, true);
    if ($result && isset($result['data']['display_url'])) {
        return $result['data']['display_url'];
    } else {
        return false;
    }
}

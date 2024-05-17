<?php
require_once(DIR . '/app/models/chat.php');
$mergedMessages = [];
$mergedMembers = [];

if (isset($_COOKIE['session'])) {
    $listChat = getListChat($_COOKIE['session']);
    $roommember = getRoomMember($_COOKIE['session']);
    
    foreach ($listChat as $message) {
        if (!isset($mergedMessages[$message['chatId']])) {
            $mergedMessages[$message['chatId']] = [];
        }
        $mergedMessages[$message['chatId']][] = $message;
    }
  
    foreach ($roommember as $member) {
        if (!isset($mergedMembers[$member['chatId']])) {
            $mergedMembers[$member['chatId']] = [];
        }
        $mergedMembers[$member['chatId']][] = $member;
    }

}


foreach ($mergedMessages as $name => $messages) {
    usort($messages, function ($a, $b) {
        return strtotime($a['timestamp']) - strtotime($b['timestamp']);
    });
    $mergedMessages[$name] = $messages;
}
if (isset($_POST)) {
    if (isset($_POST["admin"])) {
        $amin = $_POST["admin"];
        $user = $_POST["user"];
        $name = $_POST["name"];
        $status = createChatRoom($user, $amin, $name);
        switch ($status) {
            case 'DUPLICATE':
                http_response_code(403);
                echo "Tài khoản đã tồn tại!";
                break;
            case 'OK':
                http_response_code(200);
                echo "OK";
                break;
            default:
                http_response_code(500);
                echo "Có lỗi xảy ra!";
                break;
        }
    }
}

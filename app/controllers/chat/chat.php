<?php
require_once (DIR . '/app/models/chat.php');
$mergedMessages = [];
$mergedMembers = [];
$allContacts = [];

if (isset($_COOKIE['session'])) {
    $listChat = getListChat($_COOKIE['session']);
    $roommember = getRoomMember($_COOKIE['session']);
    $contacts = getAllContact($_COOKIE['session']);

    if ($contacts[0]!="err") {
        foreach ($contacts as $contact) {
            if (!isset($allContacts[$contact['username']])) {
                $allContacts[$contact['username']] = [];
            }
            $allContacts[$contact['username']][] = $contact;
        }
    }

    if ($listChat[0]!="err") {
        foreach ($listChat as $message) {
            if (!isset($mergedMessages[$message['chatId']])) {
                $mergedMessages[$message['chatId']] = [];
            }
            $mergedMessages[$message['chatId']][] = $message;
        }
    } 
    
    if ($roommember[0]!="err") {
        foreach ($roommember as $member) {
            if (!isset($mergedMembers[$member['chatId']])) {
                $mergedMembers[$member['chatId']] = [];
            }
            $mergedMembers[$member['chatId']][] = $member;
        }
    }
}

foreach ($mergedMessages as $name => $messages) {
    usort($messages, function ($a, $b) {
        return strtotime($a['timestamp']) - strtotime($b['timestamp']);
    });
    $mergedMessages[$name] = $messages;
}

// if (isset($_POST)) {
//     if (isset($_POST["admin"])) {
//         $admin = $_POST["admin"];
//         $user = $_POST["user"];
//         $name = $_POST["name"];
//         $status = createChatRoom($user, $admin, $name);
//         switch ($status) {
//             case 'DUPLICATE':
//                 http_response_code(403);
//                 echo "Tài khoản đã tồn tại!";
//                 break;
//             case 'OK':
//                 http_response_code(200);
//                 echo "OK";
//                 break;
//             default:
//                 http_response_code(500);
//                 echo "Có lỗi xảy ra!";
//                 break;
//         }
//     }
// }




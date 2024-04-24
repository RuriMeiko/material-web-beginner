<?php

$currentCookie = "csrftoken=9BrXKhM5zk3UXppyxHP2EtgbdLWZJg9W;sessionid_ss_ads=01982ca5639bd13404897ceb8563d4ce";

function updateCookie($currentCookie, $newCookie) {
    $currentCookies = $currentCookie ? explode(";", $currentCookie) : [];
    $newCookies = explode(";", $newCookie);

    $updatedCookies = array_map(function ($current) use ($newCookies) {
        $currentKey = explode("=", $current)[0];
        $newCookieValue = array_filter($newCookies, function ($newC) use ($currentKey) {
            return strpos(trim($newC), $currentKey) === 0;
        });

        return $newCookieValue ? reset($newCookieValue) : $current;
    }, $currentCookies);

    return implode("; ", $updatedCookies);
}

function getCsrfToken($cookieString) {
    $cookies = explode(";", $cookieString);
    foreach ($cookies as $cookie) {
        list($name, $value) = explode("=", trim($cookie));
        if ($name === "csrftoken") {
            return $value;
        }
    }
    return null;
}

function uploadImageToTiktok($file_path) {
    try {
        $file_buffer = file_get_contents($file_path);

        $headers = [
            "x-csrftoken: " . getCsrfToken($GLOBALS["currentCookie"]),
            "Cookie: " . $GLOBALS["currentCookie"]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://ads.tiktok.com/api/v2/i18n/material/image/upload/?aadvid=" . generateUUID());
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            "Filedata" => new CURLFile($file_path, mime_content_type($file_path), basename($file_path))
        ]);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpCode == 200) {
            $responseData = json_decode($response, true);
            if ($responseData["msg"] === "success" && $responseData["data"]) {
                unlink($file_path);
                return $responseData["data"]["url"];
            }
        } else {
            echo "Failed to upload: " . $response;
        }

        echo "Upload unsuccessful: " . $response;
        return null;
    } catch (Exception $error) {
        uploadImageToTiktok($file_path);
        echo "Error uploading file: " . $error->getMessage();
        throw $error;
    }
}

function generateUUID() {
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}

?>
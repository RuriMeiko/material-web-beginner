<?php
class TiktokUploader
{
    private $csrftoken;
    private $sessionId;
    private $ch;

    public function __construct($csrftoken, $sessionId)
    {
        $this->csrftoken = $csrftoken;
        $this->sessionId = $sessionId;

        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    }

    public function uploadImage($file_path)
    {
        try {
            $headers = [
                "x-csrftoken: " . $this->csrftoken,
                "Cookie: csrftoken=" . $this->csrftoken . ';sessionid_ss_ads=' . $this->sessionId
            ];

            curl_setopt($this->ch, CURLOPT_URL, "https://ads.tiktok.com/api/v2/i18n/material/image/upload/?aadvid=" . $this->generateUUID());
            curl_setopt($this->ch, CURLOPT_POST, true);
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, [
                "Filedata" => new CURLFile($file_path, mime_content_type($file_path), basename($file_path))
            ]);
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($this->ch);
            $httpCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

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
            return;
        } catch (Exception $error) {
            $this->uploadImage($file_path);
            echo "Error uploading file: " . $error->getMessage();
            throw $error;
        }
    }

    private function generateUUID()
    {
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

    public function close()
    {
        curl_close($this->ch);
    }
}

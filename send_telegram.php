<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

$botToken = '7766040127:AAG8c7Ah04SOPbh_5FR08-yJpnYNm6fg2Bc';
$chatId = '5090790866';

$data = json_decode(file_get_contents('php://input'), true);
$message = $data['message'] ?? '';

$url = "https://api.telegram.org/bot{$botToken}/sendMessage";
$postData = json_encode([
    'chat_id' => $chatId,
    'text' => $message,
    'parse_mode' => 'HTML'
]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

http_response_code($httpCode);
echo $response;
?>
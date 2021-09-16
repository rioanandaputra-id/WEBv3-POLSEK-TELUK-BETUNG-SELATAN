<?php
libxml_use_internal_errors(true);
$ch  = curl_init("https://mail.hostinger.com/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
$response = curl_exec($ch);
$dom = new DOMDocument();
$dom->loadHTML($response);
foreach ($dom->getElementsByTagName('input') as $link) {
    if ($link->getAttribute('name') == '_token') {
        $token = $link->getAttribute('value');
    }
}
$data = array(
    '_user' => 'admin@simpeltbs.com',
    '_pass' => 'EMAIL-oke21',
    '_task' => 'login',
    '_action' => 'login',
    '_timezone' => 'Asia/Jakarta',
    '_url' => '',
    '_token' => $token
);
curl_setopt($ch, CURLOPT_URL, "https://mail.hostinger.com/?_task=mail&_mbox=INBOX");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$response = curl_exec($ch);
echo $response;

<?php
// stream_proxy.php - Simple PHP Stream Proxy

// 1. Check if url is passed
if (!isset($_GET['url'])) {
    http_response_code(400);
    die("❌ Missing URL parameter");
}

$url = $_GET['url'];

// 2. Allow only http/https
if (!preg_match('/^https?:\/\//', $url)) {
    http_response_code(400);
    die("❌ Invalid URL");
}

// 3. Init cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HEADER, false);

// 4. Fetch content
$response = curl_exec($ch);

// 5. Get content type and forward it
$ctype = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
if ($ctype) {
    header("Content-Type: $ctype");
}

// 6. Close cURL and output result
curl_close($ch);
echo $response;
?>

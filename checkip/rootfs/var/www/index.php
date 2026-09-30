<?php
$nonce = base64_encode(random_bytes(16));

header("Content-Security-Policy: default-src 'none'; style-src 'nonce-$nonce'; base-uri 'none'; form-action 'none'; frame-ancestors 'none'");
header('Strict-Transport-Security: max-age=63072000; includeSubDomains; preload');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: no-referrer');
header('Permissions-Policy: geolocation=(), camera=(), microphone=()');
header('Cross-Origin-Opener-Policy: same-origin');
header('Cross-Origin-Resource-Policy: same-origin');
header('Cache-Control: no-store');
header_remove('X-Powered-By');

if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
    $ip = trim($ips[0]);
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$accept = $_SERVER['HTTP_ACCEPT'] ?? '';
$wantsHtml = strpos($accept, 'text/html') !== false;

if (!$wantsHtml) {
    header('Content-Type: text/plain; charset=utf-8');
    echo $ip;
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Your IP</title>
<style nonce="<?= $nonce ?>">
  html, body {
    height: 100%;
    margin: 0;
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
    font-family: monospace;
  }
  .ip {
    font-size: clamp(1.5rem, 4vw, 2rem);
  }
</style>
</head>
<body>
  <div class="ip"><?= htmlspecialchars($ip) ?></div>
</body>
</html>
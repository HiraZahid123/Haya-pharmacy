<?php
// test_whatsapp.php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/whatsapp.php';

// Enable error reporting for debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// THE NUMBER YOU ENTERED (Full international format for your test)
$testNumber = '923290292886'; 
$message = "تم تفعيل كارت الشريك بنجاح 👋\nنحن سعداء بانضمامك إلينا في صيدلية حيا 💚";

echo "<h3>Testing WhatsApp API...</h3>";

function debugWhatsApp($to, $msg) {
    echo "---<br>";
    echo "<b>Original Number:</b> $to<br>";
    
    $instanceId = getenv('ULTRAMSG_INSTANCE');
    $token      = getenv('ULTRAMSG_TOKEN');
    $defaultCode= getenv('WHATSAPP_DEFAULT_CODE') ?: '964';

    // Normalization logic
    $finalTo = preg_replace('/[^0-9]/', '', $to);
    
    // For this test script, if it's already 92... just use it
    if (!str_starts_with($finalTo, '92') && !str_starts_with($finalTo, '964')) {
        if (str_starts_with($finalTo, '0')) {
             $finalTo = $defaultCode . substr($finalTo, 1);
        } else {
             $finalTo = $defaultCode . $finalTo;
        }
    }

    echo "<b>Normalized for API:</b> $finalTo<br>";

    $url = "https://api.ultramsg.com/{$instanceId}/messages/chat";
    $params = http_build_query([
        'token'   => $token,
        'to'      => $finalTo,
        'body'    => $msg,
        'priority'=> 1,
    ]);

    echo "<b>Full URL:</b> $url<br>";

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $params,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded'],
        CURLOPT_TIMEOUT        => 15,
        CURLOPT_SSL_VERIFYPEER => false, // Try with false to rule out SSL issues
    ]);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "<b>HTTP Status:</b> $httpCode<br>";
    if ($error) {
        echo "<b>CURL Error:</b> $error<br>";
    }
    echo "<b>Raw Response:</b> <pre>" . htmlspecialchars($response) . "</pre>";
}

// Test with the number that failed
debugWhatsApp($testNumber, $message);

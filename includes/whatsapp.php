<?php
// includes/whatsapp.php
// UltraMsg WhatsApp API — send a message to a phone number

// Credentials are now loaded via .env/config.php
// (ULTRAMSG_INSTANCE, ULTRAMSG_TOKEN, WHATSAPP_DEFAULT_CODE)

/**
 * Send a WhatsApp message via UltraMsg API.
 *
 * @param string $to      Phone number — must start with country code, no + or spaces.
 *                        e.g. "9647801234567" for Iraq, "966501234567" for Saudi
 * @param string $message The message body (plain text, emojis supported)
 * @return bool           true on success, false on any error
 */
function sendWhatsApp(string $to, string $message): bool
{
    $instanceId = getenv('ULTRAMSG_INSTANCE');
    $token      = getenv('ULTRAMSG_TOKEN');
    $defaultCode= getenv('WHATSAPP_DEFAULT_CODE') ?: '964';

    if (!$instanceId || !$token) {
        return false;
    }

    // 1. Remove all non-numeric characters
    $to = preg_replace('/[^0-9]/', '', $to);

    // DEBUG LOG: Track calls
    $logMsg = date('[Y-m-d H:i:s] ') . "Sending to: $to | Msg: " . substr($message, 0, 20) . "...\n";
    file_put_contents(__DIR__ . '/wa_log.txt', $logMsg, FILE_APPEND);

    // 2. Handle Iraqi Local Format (07... or 7...)
    // If it starts with 07... (local Iraqi), replace 0 with 964
    if (str_starts_with($to, '07')) {
        $to = $defaultCode . substr($to, 1);
    } 
    // If it starts with 7... and is 10 digits total, add 964
    elseif (str_starts_with($to, '7') && strlen($to) === 10) {
        $to = $defaultCode . $to;
    }
    // If it starts with 0 but it's NOT Iraqi (e.g. your Pakistani test number),
    // we prefix default code IF it's not international already.
    // (Note: for your Pakistani test, use +92... to be safe)
    elseif (str_starts_with($to, '0')) {
        $to = $defaultCode . ltrim($to, '0');
    }

    $url = "https://api.ultramsg.com/{$instanceId}/messages/chat";

    $params = http_build_query([
        'token'   => $token,
        'to'      => $to,
        'body'    => $message,
        'priority'=> 1,
    ]);

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $params,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded'],
        CURLOPT_TIMEOUT        => 10,
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($response === false || $httpCode !== 200) {
        return false;
    }

    $data = json_decode($response, true);
    // UltraMsg returns {"sent":"true"} on success
    return isset($data['sent']) && $data['sent'] === 'true';
}

/**
 * Build the registration success WhatsApp message.
 * (Same message for both Partner and Pioneer cards.)
 *
 * @param string $cardType 'partner' | 'pioneer'
 * @return string
 */
function buildRegistrationMessage(string $cardType = 'partner'): string
{
    return "مرحباً 👋\n"
         . "تم تفعيل كارت الشريك بنجاح\n"
         . "يمكنك الآن الاستفادة من العروض والمزايا الحصرية في صيدلية حيا.\n"
         . "📍 يمكنك زيارة الصيدلية   https://maps.app.goo.gl/YgrpjGwZ7YvbxWfd6 \n"
         . "أو\n"
         . "🛒 الطلب مباشرة عبر واتساب\n"
         . "نحن سعداء بانضمامك إلينا 💚\n"
         . "صيدلية حيا\n"
         . "شريكك لحياة صحية";
}

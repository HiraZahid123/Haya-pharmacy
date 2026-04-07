<?php
// includes/whatsapp.php
// UltraMsg WhatsApp API — send a message to a phone number

define('ULTRAMSG_INSTANCE', 'instance168850');
define('ULTRAMSG_TOKEN',    'c4npviqo68qkkfwb');

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
    // Normalise number: remove + and spaces
    $to = preg_replace('/[^0-9]/', '', $to);

    // If number starts with 0, try to strip leading zero
    // (country code expected — e.g. 9647...  not 07...)
    if (str_starts_with($to, '0')) {
        $to = ltrim($to, '0');
    }

    $url = 'https://api.ultramsg.com/' . ULTRAMSG_INSTANCE . '/messages/chat';

    $params = http_build_query([
        'token'   => ULTRAMSG_TOKEN,
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

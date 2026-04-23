<?php
// handlers/register-pioneer.php
// Handles pioneer card registration form submission via AJAX POST

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/whatsapp.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    jsonResponse(false, 'Method not allowed.');
}

// ── Collect and validate inputs ───────────────────────────────
$name     = clean($_POST['name']      ?? '');
$mobile   = clean($_POST['mobile']    ?? '');
$dob      = clean($_POST['dob']       ?? '');
$gender   = clean($_POST['gender']    ?? '');
$business = clean($_POST['business']  ?? '');

// Normalize Arabic numbers to English
$arabicNum = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
$englishNum = ['0','1','2','3','4','5','6','7','8','9'];
$mobile = str_replace($arabicNum, $englishNum, $mobile);

// Strip anything that is not a digit or a plus sign
$mobile = preg_replace('/[^0-9+]/', '', $mobile);

$errors = [];

if (mb_strlen($name) < 3) {
    $errors[] = 'الاسم يجب أن يكون 3 أحرف على الأقل';
}
if (!preg_match('/^[0-9+]{7,20}$/', $mobile)) {
    $errors[] = 'رقم الهاتف غير صحيح';
}

// Validation for DOB and gender
if (empty($dob)) {
    $errors[] = 'تاريخ الميلاد مطلوب';
}
if (empty($gender) || !in_array($gender, ['male', 'female'])) {
    $errors[] = 'يرجى اختيار الجنس';
}

if (!empty($errors)) {
    jsonResponse(false, implode(' | ', $errors));
}

// ── Check for duplicate phone number ─────────────────────────
try {
    $db   = getDB();

    // Auto-create/update table hotfix
    $db->exec("
        CREATE TABLE IF NOT EXISTS `pioneers_cards` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `card_number` varchar(50) NOT NULL,
            `full_name` varchar(255) NOT NULL,
            `mobile_number` varchar(20) NOT NULL,
            `business_name` varchar(255) DEFAULT NULL,
            `gender` varchar(20) DEFAULT NULL,
            `date_of_birth` date DEFAULT NULL,
            `created_at` datetime NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY (`card_number`),
            UNIQUE KEY (`mobile_number`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");
    
    // Check if business_name column exists (migration hotfix)
    $checkCol = $db->query("SHOW COLUMNS FROM `pioneers_cards` LIKE 'business_name'");
    if (!$checkCol->fetch()) {
        $db->exec("ALTER TABLE `pioneers_cards` ADD COLUMN `business_name` varchar(255) DEFAULT NULL AFTER `mobile_number` ");
    }


    $stmt = $db->prepare('SELECT id FROM pioneers_cards WHERE mobile_number = ?');
    $stmt->execute([$mobile]);
    if ($stmt->fetch()) {
        jsonResponse(false, 'رقم الهاتف هذا مسجل بالفعل في قائمة الانتظار');
    }

    // ── Generate card number & insert ────────────────────────────
    $cardNumber = generateCardNumber(PIONEER_PREFIX, 'pioneers_cards');

    $insert = $db->prepare(
        'INSERT INTO pioneers_cards (card_number, full_name, mobile_number, business_name, gender, date_of_birth, created_at)
         VALUES (?, ?, ?, ?, ?, ?, NOW())'
    );
    $insert->execute([$cardNumber, $name, $mobile, $business, $gender, $dob]);

    // ── Send WhatsApp welcome message (fire-and-forget) ───────
    @sendWhatsApp($mobile, buildRegistrationMessage('pioneer'));

    jsonResponse(true, 'تم التسجيل بنجاح', [
        'name' => $name,
    ]);
} catch (PDOException $e) {
    jsonResponse(false, 'حدث خطأ أثناء التسجيل: ' . $e->getMessage());
}

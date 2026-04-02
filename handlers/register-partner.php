<?php
// handlers/register-partner.php
// Handles partner card registration form submission via AJAX POST

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

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

// Normalize Arabic numbers to English
$arabicNum = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
$englishNum = ['0','1','2','3','4','5','6','7','8','9'];
$mobile = str_replace($arabicNum, $englishNum, $mobile);

// Strip anything that is not a digit or a plus sign
$mobile = preg_replace('/[^0-9+]/', '', $mobile);

// Map Arabic gender to standard values for stats
if ($gender === 'ذكر') {
    $gender = 'male';
} elseif ($gender === 'أنثى' || $gender === 'انثى') {
    $gender = 'female';
}

$errors = [];

if (mb_strlen($name) < 3) {
    $errors[] = 'الاسم يجب أن يكون 3 أحرف على الأقل';
}
if (!preg_match('/^[0-9+]{7,20}$/', $mobile)) {
    $errors[] = 'رقم الهاتف غير صحيح';
}

// Make DOB and gender optional if not provided
if (!empty($dob) && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dob)) {
    $errors[] = 'تاريخ الميلاد غير صحيح';
}
if (!empty($gender) && !in_array($gender, ['male', 'female'])) {
    $errors[] = 'الجنس غير صحيح';
}

if (!empty($errors)) {
    jsonResponse(false, implode(' | ', $errors));
}

// ── Check for duplicate phone number ─────────────────────────
$db   = getDB();
$stmt = $db->prepare('SELECT id FROM partners_cards WHERE mobile_number = ?');
$stmt->execute([$mobile]);
if ($stmt->fetch()) {
    jsonResponse(false, 'رقم الهاتف هذا مسجل بالفعل في برنامج الشركاء');
}

// ── Generate card number & insert ────────────────────────────
try {
    $cardNumber = generateCardNumber(PARTNER_PREFIX, 'partners_cards');

    $insert = $db->prepare(
        'INSERT INTO partners_cards (card_number, full_name, mobile_number, gender, date_of_birth, created_at)
         VALUES (?, ?, ?, ?, ?, NOW())'
    );
    $insert->execute([$cardNumber, $name, $mobile, $gender, $dob]);

    jsonResponse(true, 'تم التسجيل بنجاح', [
        'card_number' => $cardNumber,
        'name'        => $name,
    ]);
} catch (PDOException $e) {
    jsonResponse(false, 'حدث خطأ أثناء التسجيل: ' . $e->getMessage());
}

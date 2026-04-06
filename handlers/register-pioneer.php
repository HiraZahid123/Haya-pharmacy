<?php
// handlers/register-pioneer.php
// Handles pioneer card registration form submission via AJAX POST

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    jsonResponse(false, 'Method not allowed.');
}

// ── Collect and validate inputs ───────────────────────────────
$name   = clean($_POST['name']   ?? '');
$mobile = clean($_POST['mobile'] ?? '');
$dob    = clean($_POST['dob']    ?? '');
$gender = clean($_POST['gender'] ?? '');

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
$db   = getDB();
$stmt = $db->prepare('SELECT id FROM pioneers_cards WHERE mobile_number = ?');
$stmt->execute([$mobile]);
if ($stmt->fetch()) {
    jsonResponse(false, 'رقم الهاتف هذا مسجل بالفعل في قائمة الانتظار');
}

// ── Generate card number & insert ────────────────────────────
try {
    $cardNumber = generateCardNumber(PIONEER_PREFIX, 'pioneers_cards');

    $insert = $db->prepare(
        'INSERT INTO pioneers_cards (card_number, full_name, mobile_number, gender, date_of_birth, created_at)
         VALUES (?, ?, ?, ?, ?, NOW())'
    );
    $insert->execute([$cardNumber, $name, $mobile, $gender, $dob]);

    jsonResponse(true, 'تم التسجيل بنجاح', [
        'name' => $name,
    ]);
} catch (PDOException $e) {
    jsonResponse(false, 'حدث خطأ أثناء التسجيل: ' . $e->getMessage());
}

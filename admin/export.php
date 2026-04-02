<?php
// admin/export.php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
requireAdmin();

$type = $_GET['type'] ?? '';
$db = getDB();

if ($type === 'pioneers' || $type === 'partners') {
    $table = ($type === 'pioneers') ? 'pioneers_cards' : 'partners_cards';
    $filename = $type . "_registrations_" . date('Y-m-d') . ".csv";

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);

    $output = fopen('php://output', 'w');
    // Add BOM for Excel Arabic support
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

    // Headers (Match UI Order: Date/Time, Name, DOB, Phone, Gender)
    fputcsv($output, ['التاريخ والوقت', 'الاسم الكامل', 'تاريخ الميلاد', 'رقم الهاتف', 'الجنس']);

    $query = "SELECT created_at, full_name, date_of_birth, mobile_number, gender FROM $table ORDER BY created_at DESC";
    $stmt = $db->query($query);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Format time for Iraq
        $row['created_at'] = iraqTime($row['created_at']);
        $row['gender'] = ($row['gender'] === 'male') ? 'ذكر' : 'أنثى';
        fputcsv($output, array_values($row));
    }
    fclose($output);
    exit;
} else if ($type === 'feedback') {
    $filename = "feedback_responses_" . date('Y-m-d') . ".csv";

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);

    $output = fopen('php://output', 'w');
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM

    fputcsv($output, ['النوع', 'تقييم الزيارة', 'تقييم الفريق', 'رقم الهاتف', 'التعليق', 'تاريخ الإرسال']);

    $query = "SELECT feedback_type, q1_emoji, q2_emoji, phone_number, comment, submitted_at FROM feedback_responses ORDER BY submitted_at DESC";
    $stmt = $db->query($query);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Translate type
        $row['feedback_type'] = ($row['feedback_type'] === 'visit') ? 'زيارة' : 'توصيل';
        
        // Translate Emojis (Simple map)
        $map = ['happy' => 'سعيد', 'neutral' => 'عادي', 'sad' => 'سيء'];
        $row['q1_emoji'] = $map[$row['q1_emoji']] ?? $row['q1_emoji'];
        $row['q2_emoji'] = $map[$row['q2_emoji']] ?? $row['q2_emoji'];

        // Format time
        $row['submitted_at'] = iraqTime($row['submitted_at']);
        
        fputcsv($output, array_values($row));
    }
    fclose($output);
    exit;
} else if ($type === 'questionnaire') {
    $filename = "health_screening_" . date('Y-m-d') . ".csv";

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);

    $output = fopen('php://output', 'w');
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM

    fputcsv($output, ['الجنس', 'الفيتامينات', 'الغدة الدرقية', 'السكري', 'ضغط الدم', 'تاريخ الإرسال']);

    $query = "SELECT gender, vitamin_risk, thyroid_risk, diabetes_risk, bp_risk, created_at FROM standalone_survey_results ORDER BY created_at DESC";
    $stmt = $db->query($query);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $row['gender'] = ($row['gender'] === 'male') ? 'ذكر' : 'أنثى';
        // Values are already saved in Arabic in the new standalone_survey_results table
        $row['thyroid_risk'] = $row['thyroid_risk'] ?: '—';
        $row['created_at'] = date('Y-m-d H:i', strtotime($row['created_at']));
        
        fputcsv($output, array_values($row));
    }
    fclose($output);
    exit;
}

<?php
session_start();
require_once '../includes/db.php';

// Check if logged in
if (!isset($_SESSION['admin_id'])) {
    exit("Unauthorized");
}

// Filters
$branch_id = $_GET['branch_id'] ?? '';
$start_date = $_GET['start_date'] ?? '';
$end_date = $_GET['end_date'] ?? '';
$sentiment = $_GET['sentiment'] ?? '';
$has_comment = $_GET['has_comment'] ?? '';
$has_phone = $_GET['has_phone'] ?? '';
$survey_type_filter = $_GET['survey_type'] ?? '';

$where_clauses = [];
$params = [];

if ($branch_id) {
    $where_clauses[] = "r.branch_id = ?";
    $params[] = $branch_id;
}
if ($start_date) {
    $where_clauses[] = "DATE(r.created_at) >= ?";
    $params[] = $start_date;
}
if ($end_date) {
    $where_clauses[] = "DATE(r.created_at) <= ?";
    $params[] = $end_date;
}
if ($sentiment) {
    if ($sentiment === 'sad') {
        $where_clauses[] = "(r.question_1_answer = 1 OR r.question_2_answer = 1 OR r.question_3_answer = 1 OR r.question_4_answer = 1)";
    } elseif ($sentiment === 'neutral') {
        $where_clauses[] = "(r.question_1_answer = 2 OR r.question_2_answer = 2 OR r.question_3_answer = 2 OR r.question_4_answer = 2)";
    } elseif ($sentiment === 'happy') {
        $where_clauses[] = "(r.question_1_answer = 3 OR r.question_2_answer = 3 OR r.question_3_answer = 3 OR r.question_4_answer = 3)";
    }
}
if ($has_comment === 'yes') {
    $where_clauses[] = "r.comment IS NOT NULL AND r.comment != ''";
} elseif ($has_comment === 'no') {
    $where_clauses[] = "(r.comment IS NULL OR r.comment = '')";
}
if ($has_phone === 'yes') {
    $where_clauses[] = "r.phone IS NOT NULL AND r.phone != ''";
} elseif ($has_phone === 'no') {
    $where_clauses[] = "(r.phone IS NULL OR r.phone = '')";
}
if ($survey_type_filter) {
    $where_clauses[] = "r.survey_type = ?";
    $params[] = $survey_type_filter;
}

$where_sql = count($where_clauses) > 0 ? "WHERE " . implode(" AND ", $where_clauses) : "";

// Fetch data
$query = "SELECT r.created_at, b.branch_name, r.survey_type, r.question_1_answer, r.question_2_answer, r.question_3_answer, r.question_4_answer, r.comment, r.phone 
          FROM responses r 
          JOIN branches b ON r.branch_id = b.id 
          $where_sql 
          ORDER BY r.created_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Send CSV headers
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=pharmacy_feedback_' . date('Y-m-d') . '.csv');

$output = fopen('php://output', 'w');

// Add BOM for Excel UTF-8 support
fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

// Header row
fputcsv($output, ['Date', 'Branch', 'Survey Type', 'Q1 (Rating)', 'Q2 (Rating)', 'Q3 (Rating)', 'Q4 (Rating)', 'Comment', 'Phone']);

// Data rows
foreach ($data as $row) {
    fputcsv($output, $row);
}

fclose($output);
exit();

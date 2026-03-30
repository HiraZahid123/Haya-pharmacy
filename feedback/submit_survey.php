<?php
session_start();
try {
    require_once 'includes/db.php';

    // Get Branch ID
    $branch_slug = $_SESSION['branch_slug'] ?? 'main-branch';
    $stmt = $pdo->prepare("SELECT id FROM branches WHERE branch_slug = ?");
    $stmt->execute([$branch_slug]);
    $branch = $stmt->fetch();

    if (!$branch) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid branch: ' . $branch_slug]);
        exit();
    }

    $branch_id = $branch['id'];
    $survey_type = $_SESSION['survey_type'] ?? 'visit';

    // Get answers from Session
    $q1 = $_SESSION['q1'] ?? null;
    $q2 = $_SESSION['q2'] ?? null;
    $q3 = $_SESSION['q3'] ?? null;
    $q4 = $_SESSION['q4'] ?? null;
    $comment = $_SESSION['comment'] ?? '';
    $phone = $_SESSION['phone'] ?? '';

    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO responses (branch_id, survey_type, question_1_answer, question_2_answer, question_3_answer, question_4_answer, comment, phone, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$branch_id, $survey_type, $q1, $q2, $q3, $q4, $comment, $phone]);

    // Clear session after submission (preserve branch_slug and survey_type)
    $current_branch = $_SESSION['branch_slug'] ?? 'main-branch';
    $current_type = $_SESSION['survey_type'] ?? 'visit';
    session_unset();
    $_SESSION['branch_slug'] = $current_branch;
    $_SESSION['survey_type'] = $current_type;

    echo json_encode(['status' => 'success']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}

<?php
session_start();
if (isset($_GET['branch'])) {
    $_SESSION['branch_slug'] = $_GET['branch'];
}
if (isset($_GET['type'])) {
    $_SESSION['survey_type'] = $_GET['type'];
}
$branch_slug = $_SESSION['branch_slug'] ?? 'main-branch';
$survey_type = $_SESSION['survey_type'] ?? 'visit';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Survey</title>
    <link rel="icon" type="image/png" href="assets/images/logo.png">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts: Tajawal -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css?v=2.7">
</head>

<body>
    <!-- Global Background Patterns -->
    <div class="bg-pattern pattern-top-left"></div>
    <div class="bg-pattern pattern-top-right"></div>
    <div class="bg-pattern pattern-bottom-left"></div>
    <div class="bg-pattern pattern-bottom-right"></div>

    <div class="header-container">
        <div class="desktop-spacer"></div>
        <h1 class="header-title">شاركنا رأيك</h1>
        <img src="assets/images/wide.png" alt="Haya Logo" class="desktop-header-logo">
    </div>
</body>
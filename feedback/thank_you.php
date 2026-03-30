<?php
// thank_you.php
session_start();
$branch_slug = $_SESSION['branch_slug'] ?? 'main-branch';
$survey_type = $_SESSION['survey_type'] ?? 'visit';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شكراً لك - Pharmacy Survey</title>
    <link rel="icon" type="image/png" href="assets/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css?v=2.1">
</head>

<body class="d-flex align-items-center justify-content-center">
    <!-- Background Patterns -->
    <div class="bg-pattern-comments pattern-top-left-comments"></div>
    <div class="bg-pattern-comments pattern-top-right-comments"></div>
    <div class="bg-pattern-comments pattern-bottom-left-comments"></div>
    <div class="bg-pattern-comments pattern-bottom-right-comments"></div>

    <div class="text-center">
        <!-- Vertical Logo -->
        <div class="mb-3">
            <img src="assets/images/Logo-copy.png" alt="Haya Logo" class="thanks-logo">
        </div>

        <!-- Large Thanks Text -->
        <h1 class="thanks-title">شكراً لك</h1>

        <!-- Subtitle -->
        <p class="thanks-subtitle">صيدلية حيا شريكك لحياة صحية </p>
    </div>

    <script>
        setTimeout(() => {
            window.location.href = 'index.php?branch=<?php echo htmlspecialchars($branch_slug); ?>&type=<?php echo htmlspecialchars($survey_type); ?>';
        }, 10000);
    </script>
</body>

</html>
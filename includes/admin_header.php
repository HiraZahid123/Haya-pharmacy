<?php
// includes/admin_header.php
require_once __DIR__ . '/../includes/functions.php';
requireAdmin();

$activePage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | صيدلية حيا</title>
    <link rel="icon" type="image/png" href="<?= SITE_URL ?>/assets/images/favicon.png">
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/main.css?v=0.02">
    <style>
    /* Force Madani Font strictly on Admin Area */
        .admin-body,
        .admin-body input,
        .admin-body button,
        .admin-body select,
        .admin-body textarea,
        .admin-table-wrap table,
        .admin-table-wrap th,
        .admin-table-wrap td,
        .admin-title-row h1 {
            font-family: 'Madani Arabic Demo', sans-serif !important;
        }
        .admin-nav { 
            background: #005445; /* Brand Dark Green */
            padding: 1.5rem 4rem; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            color: #fff; 
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .admin-nav-links { display: flex; gap: 2.5rem; }
        .admin-nav-links a { 
            color: rgba(255,255,255,0.7); 
            font-weight: 600; 
            text-decoration: none; 
            font-size: 0.95rem; 
            transition: color 0.2s;
        }
        .admin-nav-links a:hover, .admin-nav-links a.active { color: #fff; }
        .admin-content { 
            /* Base background moved to main.css .admin-content but ensuring padding here */
            padding: 3rem 4rem; 
            max-width: 1400px; 
            margin: 0 auto; 
            min-height: 80vh; 
        }
        
        .logout-btn { 
            background: rgba(255,255,255,0.1); 
            padding: 0.5rem 1.25rem; 
            border-radius: 0.75rem; 
            font-size: 0.85rem; 
            font-weight: 700; 
            transition: background 0.2s;
        }
        .logout-btn:hover { background: rgba(255,255,255,0.2); }

        @media (max-width: 992px) {
            .admin-nav { padding: 1.5rem 2rem; flex-direction: column; gap: 1rem; position: relative; }
            .admin-nav-logo-wrap { position: static; transform: none; left: auto; top: auto; margin-bottom: 0.5rem; }
            .admin-nav-links { gap: 1.5rem; }
            .admin-content { padding: 2rem 1.5rem; }
        }

        @media (max-width: 576px) {
            .admin-nav-links { flex-wrap: wrap; justify-content: center; gap: 1rem; }
            .admin-nav-links a { font-size: 0.85rem; }
            .logout-btn { display: inline-flex; justify-content: center; margin-top: 0.5rem; }
        }
    </style>
</head>
<body class="admin-body">
    <header class="admin-nav">
        <nav class="admin-nav-links">
            <a href="pioneers.php" class="<?= $activePage == 'pioneers.php' ? 'active' : '' ?>">الأوائل</a>
             <a href="partners.php" class="<?= $activePage == 'partners.php' ? 'active' : '' ?>">الشركاء</a>
            <!--<a href="feedback.php" class="<?= $activePage == 'feedback.php' ? 'active' : '' ?>">التقييمات</a>
            <a href="questionnaire.php" class="<?= $activePage == 'questionnaire.php' ? 'active' : '' ?>">الفحص الصحي</a> -->
        </nav>

        <div class="admin-nav-logo-wrap">
            <img src="<?= SITE_URL ?>/assets/images/Mask group.svg" class="admin-nav-logo">
        </div>

        <a href="logout.php" class="logout-btn">تسجيل خروج</a>
    </header>
    <main class="admin-content">

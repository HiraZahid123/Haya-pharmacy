<?php
// admin/index.php — Admin Login Page
require_once __DIR__ . '/../config/config.php';
session_start();

// If already logged in, go to dashboard
if (!empty($_SESSION[ADMIN_SESSION_KEY])) {
    header('Location: pioneers.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../includes/db.php';
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM admin_users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION[ADMIN_SESSION_KEY] = true;
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_user'] = $user['username'];
            header('Location: pioneers.php');
            exit;
        } else {
            $error = 'اسم المستخدم أو كلمة المرور غير صحيحة';
        }
    } else {
        $error = 'يرجى إدخال جميع البيانات';
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول المسئول | صيدلية حيا</title>
    <link rel="icon" type="image/png" href="<?= SITE_URL ?>/assets/images/favicon.png">
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/main.css?v=0.02">
    <style>
        body { 
            background: #E9E0D9; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            min-height: 100vh; 
            position: relative;
            overflow: hidden;
        }
        .login-pattern {
            position: absolute;
            inset: 0;
            opacity: 0.1;
            background-image: 
                url('<?= SITE_URL ?>/assets/images/haya pattern 3.svg'), 
                url('<?= SITE_URL ?>/assets/images/haya pattern  4.svg');
            background-position: left bottom, right bottom;
            background-repeat: no-repeat;
            background-size: 450px;
            pointer-events: none;
        }
        .login-card { 
            background: #fff; 
            padding: 3rem; 
            border-radius: 2rem; 
            box-shadow: var(--shadow-lg); 
            width: 100%; 
            max-width: 450px; 
            position: relative; 
            z-index: 10;
            animation: modalIn 0.6s ease both;
        }
        .login-logo { height: 4.5rem; display: block; margin: 0 auto 1.5rem; }
        .login-title { text-align: center; margin-bottom: 2rem; color: var(--color-primary); font-weight: 900; }
        .alert { 
            background: #fff5f5; 
            color: #e53e3e; 
            padding: 0.85rem; 
            border-radius: 12px; 
            margin-bottom: 1.5rem; 
            font-size: 0.9rem; 
            text-align: center; 
            border: 1px solid #feb2b2;
            animation: shake 0.4s ease;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        .form-group label { color: var(--color-muted-fg); font-weight: 700; }
        .footer-hint { text-align: center; margin-top: 2rem; font-size: 0.85rem; color: var(--color-muted-fg); }
        
        @media (max-width: 576px) {
            .login-card { padding: 2rem 1.5rem; border-radius: 1.5rem; margin: 1rem; max-width: calc(100% - 2rem); }
            .login-title { font-size: 1.5rem; margin-bottom: 1.5rem; }
            .login-pattern { background-size: 300px; }
        }
    </style>
</head>
<body>
    <div class="login-pattern"></div>
    <div class="login-card">
        <img src="<?= SITE_URL ?>/assets/images/haya-logo.png" alt="صيدلية حيا" class="login-logo">
        <h2 class="login-title">لوحة تحكم المسئول</h2>
        
        <?php if ($error): ?>
            <div class="alert"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label class="form-label">اسم المستخدم</label>
                <input type="text" name="username" class="form-control" placeholder="admin" required autofocus>
            </div>
            <div class="form-group">
                <label class="form-label">كلمة المرور</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" class="form-submit" style="margin-top: 1.5rem;">دخول آمن</button>
        </form>

        <p class="footer-hint">© <?= date('Y') ?> صيدلية حيا - جميع الحقوق محفوظة</p>
    </div>
</body>
</html>

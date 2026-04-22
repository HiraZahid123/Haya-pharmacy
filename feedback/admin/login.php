<?php
session_start();
require_once '../includes/db.php';

if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "يرجى إدخال اسم المستخدم وكلمة المرور.";
    } else {
        $stmt = $pdo->prepare("SELECT id, username, password FROM admins WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "اسم المستخدم أو كلمة المرور غير صحيحة.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - حيا للصيدليات</title>
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css?v=2.6">
    <style>
        .bg-pattern {
            position: fixed !important;
            width: 300px !important;
            height: 300px !important;
            opacity: 1.0 !important;
            z-index: 1 !important;
            background-size: contain !important;
            background-repeat: no-repeat !important;
            pointer-events: none !important;
            display: block !important;
        }
        .pattern-top-left {
            top: 0 !important;
            left: 0 !important;
            background-image: url('../assets/images/haya-pattern-1.svg') !important;
        }
        .pattern-top-right {
            top: 0 !important;
            right: 0 !important;
            background-image: url('../assets/images/haya-pattern-2.svg') !important;
        }
        .pattern-bottom-left {
            bottom: 0 !important;
            left: 0 !important;
            background-image: url('../assets/images/haya-pattern-3.svg') !important;
        }
        .pattern-bottom-right {
            bottom: 0 !important;
            right: 0 !important;
            background-image: url('../assets/images/haya-pattern-4.svg') !important;
        }
        .login-wrapper { 
            position: relative !important;
            z-index: 10 !important; 
        }
    </style>
</head>

<body class="login-page">
    <!-- Background Patterns -->
    <div class="bg-pattern pattern-top-left"></div>
    <div class="bg-pattern pattern-top-right"></div>
    <div class="bg-pattern pattern-bottom-left"></div>
    <div class="bg-pattern pattern-bottom-right"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <img src="../assets/images/Logo-copy.png" alt="Haya Logo" class="login-logo">
            <h4>تسجيل الدخول</h4>

            <?php if ($error): ?>
                <div class="alert alert-danger rounded-3 mb-3"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3 text-start">
                    <input type="text" class="form-control" name="username" required placeholder="اسم المستخدم">
                </div>
                <div class="mb-4 text-start">
                    <input type="password" class="form-control" name="password" required placeholder="كلمة المرور">
                </div>
                <button type="submit" class="btn-login">دخول</button>
            </form>
        </div>
    </div>
</body>

</html>
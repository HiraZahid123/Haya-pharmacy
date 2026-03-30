<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$message = '';
$error = '';

// Handle Add Branch
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_branch'])) {
    $name = trim($_POST['branch_name']);
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
    if (!empty($name)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO branches (branch_name, branch_slug) VALUES (?, ?)");
            $stmt->execute([$name, $slug]);
            $message = "تم إضافة الفرع بنجاح!";
        } catch (PDOException $e) {
            $error = "خطأ: " . $e->getMessage();
        }
    } else {
        $error = "اسم الفرع مطلوب.";
    }
}

// Handle Delete Branch
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_branch'])) {
    $del_id = (int)$_POST['branch_id'];
    $pdo->prepare("DELETE FROM branches WHERE id = ?")->execute([$del_id]);
    $message = "تم حذف الفرع.";
}

$stmt = $pdo->query("SELECT * FROM branches ORDER BY created_at DESC");
$branches = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الفروع - لوحة مؤشرات رضا العملاء</title>
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/admin-style.css?v=2.4">
</head>

<body>

    <!-- Top Bar -->
    <div class="admin-topbar">
        <span class="topbar-title">لوحة مؤشرات رضا العملاء</span>
        <img src="../assets/images/Mask group.svg" alt="Haya Logo" class="topbar-logo">
    </div>

    <!-- Nav Tabs -->
   <nav class="admin-nav">
        <button class="nav-hamburger" id="navHamburger">
            <i class="bi bi-list"></i>
        </button>
        <div class="admin-nav-links" id="navLinks">
            <a href="dashboard.php" class="nav-link">الرسوم البيانية</a>
            <a href="responses.php" class="nav-link">ادارة الاستبيان</a>
            <a href="branches.php" class="nav-link active">إدارة الفروع</a>
            <div class="nav-logout">
                <a href="logout.php" class="btn-logout"><i class="bi bi-box-arrow-left"></i> خروج</a>
            </div>
        </div>
    </nav>

    <div class="admin-content">
        <?php if ($message): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <?php echo htmlspecialchars($message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                <?php echo htmlspecialchars($error); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="table-card mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="section-title mb-0 fs-3" style="color: #015645; font-weight: 800;">إدارة الفروع</div>
                <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#addBranchModal">
                    <i class="bi bi-plus-lg"></i> إضافة فرع
                </button>
            </div>
            <table class="branch-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الفرع</th>
                        <th>رابط المسح</th>
                        <th>تاريخ الإضافة</th>
                        <th>رابط الاستبيان</th>
                        <th>إجراء</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($branches as $b): ?>
                        <tr>
                            <td><?php echo $b['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($b['branch_name']); ?></strong></td>
                            <td><code style="font-size:12px; background:#f5f0ea; padding: 3px 8px; border-radius:4px;"><?php echo htmlspecialchars($b['branch_slug']); ?></code></td>
                            <td class="text-muted" style="font-size:12px;"><?php echo date('Y-m-d', strtotime($b['created_at'])); ?></td>
                            <td>
                                <a href="../index.php?branch=<?php echo urlencode($b['branch_slug']); ?>" target="_blank" class="btn-apply" style="font-size:12px;">
                                    <i class="bi bi-box-arrow-up-right"></i> زيارة
                                </a>
                                <a href="../index.php?branch=<?php echo urlencode($b['branch_slug']); ?>&type=delivery" target="_blank" class="btn-apply" style="font-size:12px; background:#c09068; margin-right:5px;">
                                    <i class="bi bi-truck"></i> توصيل
                                </a>
                            </td>
                            <td>
                                <form method="POST" onsubmit="return confirm('هل تريد حذف هذا الفرع؟')">
                                    <input type="hidden" name="branch_id" value="<?php echo $b['id']; ?>">
                                    <button type="submit" name="delete_branch" class="btn-reset" style="color:#dc3545;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (!$branches): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">لا توجد فروع بعد.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Add Branch Modal -->
    <div class="modal fade" id="addBranchModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title text-white">إضافة فرع جديد</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="branch_name" class="form-label">اسم الفرع (بالإنجليزية)</label>
                            <input type="text" class="form-control" id="branch_name" name="branch_name" required placeholder="e.g. City Center">
                            <small class="text-muted">سيتم توليد المعرف تلقائياً</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" name="add_branch" class="btn-apply px-4">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Hamburger Menu Toggle
        document.getElementById('navHamburger').addEventListener('click', function() {
            document.getElementById('navLinks').classList.toggle('open');
        });
    </script>
</body>

</html>
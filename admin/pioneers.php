<?php
// admin/pioneers.php — List of Pioneers registrations (Figma Matching)
require_once __DIR__ . '/../includes/admin_header.php';

$db = getDB();

// ── Filtering Logic ──────────────────────────────────────────
$genderFilter = $_GET['gender'] ?? '';
$dateFrom     = $_GET['date_from'] ?? '';
$dateTo       = $_GET['date_to'] ?? '';

$query = "SELECT * FROM pioneers_cards WHERE 1=1";
$params = [];

if ($genderFilter) {
    $query .= " AND gender = ?";
    $params[] = $genderFilter;
}
if ($dateFrom) {
    $query .= " AND DATE(created_at) >= ?";
    $params[] = $dateFrom;
}
if ($dateTo) {
    $query .= " AND DATE(created_at) <= ?";
    $params[] = $dateTo;
}

$query .= " ORDER BY created_at DESC";
$stmt = $db->prepare($query);
$stmt->execute($params);
$pioneers = $stmt->fetchAll();

$stats = getCardStats('pioneers_cards');
?>

<div class="admin-main-card">
    <div class="admin-title-row">
        <h1>قائمة المسجلين في بطاقة الأوائل</h1>
    </div>

    <!-- Figma Stats Cards -->
    <div class="stats-grid">
        <!-- تسجيلات اليوم -->
        <a href="?date_from=<?= date('Y-m-d') ?>" class="stat-card <?= $dateFrom == date('Y-m-d') ? 'active' : '' ?>">
            <div class="stat-card-label">تسجيلات اليوم</div>
            <div class="stat-card-row">
                <div class="stat-card-icon no-bg">
                    <img src="<?= SITE_URL ?>/assets/images/new.svg" alt="Total Icon" style="width: 4.5rem; height: 4.5rem;">
                </div>
                <div class="stat-card-val"><?= number_format($stats['today']) ?></div>
            </div>
        </a>

        <!-- إناث -->
        <a href="?gender=female" class="stat-card <?= $genderFilter == 'female' ? 'active' : '' ?>">
            <div class="stat-card-label">إناث</div>
            <div class="stat-card-row">
                <div class="stat-card-icon no-bg">
                    <img src="<?= SITE_URL ?>/assets/images/female.svg" alt="Total Icon" style="width: 4.5rem; height: 4.5rem;">
                </div>
                <div class="stat-card-val"><?= number_format($stats['females']) ?></div>
            </div>
        </a>

        <!-- ذكور -->
        <a href="?gender=male" class="stat-card <?= $genderFilter == 'male' ? 'active' : '' ?>">
            <div class="stat-card-label">ذكور</div>
            <div class="stat-card-row">
                <div class="stat-card-icon no-bg">
                    <img src="<?= SITE_URL ?>/assets/images/male.svg" alt="Total Icon" style="width: 4.5rem; height: 4.5rem;">
                </div>
                <div class="stat-card-val"><?= number_format($stats['males']) ?></div>
            </div>
        </a>

        <!-- إجمالي المسجلين -->
        <a href="pioneers.php" class="stat-card <?= (!$genderFilter && !$dateFrom) ? 'active' : '' ?>">
            <div class="stat-card-label">إجمالي المسجلين</div>
            <div class="stat-card-row">
                <div class="stat-card-icon no-bg">
                    <img src="<?= SITE_URL ?>/assets/images/Smile.svg" alt="Total Icon" style="width: 4.5rem; height: 4.5rem;">
                </div>
                <div class="stat-card-val"><?= number_format($stats['total']) ?></div>
            </div>
        </a>
    </div>

    <div class="admin-table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="padding-right:0;">التاريخ والوقت</th>
                    <th>الاسم</th>
                    <th>تاريخ الميلاد</th>
                    <th>رقم التليفون</th>
                    <th style="padding-left:0;">الجنس</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pioneers)): ?>
                    <tr><td colspan="5" style="text-align:center; padding: 3rem; color: #999;">لا توجد سجلات مطابقة</td></tr>
                <?php else: ?>
                    <?php foreach ($pioneers as $p): 
                        $dt = new DateTime($p['created_at'], new DateTimeZone('UTC'));
                        $dt->setTimezone(new DateTimeZone('Asia/Baghdad'));
                        $displayDate = $dt->format('Y-m-d');
                        $displayTime = $dt->format('g:i');
                    ?>
                        <tr>
                            <td class="time-cell">
                                <span style="display:block;"><?= $displayDate ?></span>
                                <span style="font-weight: 800; color: #555;"><?= $displayTime ?></span>
                            </td>
                            <td class="name-cell"><?= htmlspecialchars($p['full_name']) ?></td>
                            <td><?= htmlspecialchars($p['date_of_birth']) ?></td>
                            <td dir="ltr"><?= htmlspecialchars($p['mobile_number']) ?></td>
                            <td><?= $p['gender'] == 'male' ? 'ذكر' : 'أنثى' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Export & Filter controls -->
    <div class="admin-footer-actions">
        <a href="export.php?type=pioneers" class="haya-btn-gold" style="padding: 1rem 3rem;">تصدير بيانات CSV</a>
        
        <form method="GET" class="admin-filter-form">
             <input type="date" name="date_from" value="<?= htmlspecialchars($dateFrom) ?>" class="modal-input" style="width: 200px; padding: 0.8rem; font-size: 1rem;">
             <span style="color: #005445; font-weight: 800;">إلى</span>
             <input type="date" name="date_to" value="<?= htmlspecialchars($dateTo) ?>" class="modal-input" style="width: 200px; padding: 0.8rem; font-size: 1rem;">
             <button type="submit" class="haya-btn-dark-green" style="padding: 0.8rem 2.5rem; font-size: 1rem; border-radius: 12px;">فلترة</button>
        </form>
    </div>
</div>

</main>
</body>
</html>

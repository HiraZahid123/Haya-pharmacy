<?php
// admin/partners.php — List of Partners registrations (Figma Matching with Card Number)
require_once __DIR__ . '/../includes/admin_header.php';

$db = getDB();

// ── Filtering Logic ──────────────────────────────────────────
$genderFilter = $_GET['gender'] ?? '';
$dateFrom     = $_GET['date_from'] ?? '';
$dateTo       = $_GET['date_to'] ?? '';

$query = "SELECT * FROM partners_cards WHERE 1=1";
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
$partners = $stmt->fetchAll();

$stats = getCardStats('partners_cards');
?>

<div class="admin-main-card">
    <div class="admin-title-row">
        <h1>قائمة المسجلين في بطاقة الشريك</h1>
    </div>

    <!-- Figma Stats Cards -->
    <div class="stats-grid">
        <!-- تسجيلات اليوم -->
        <a href="?date_from=<?= date('Y-m-d') ?>" class="stat-card <?= $dateFrom == date('Y-m-d') ? 'active' : '' ?>" style="text-decoration: none; color: inherit;">
            <div class="stat-card-label">تسجيلات اليوم</div>
            <div class="stat-card-row">
                <div class="stat-card-val"><?= number_format($stats['today']) ?></div>
                <div class="stat-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                </div>
            </div>
        </a>

        <!-- إناث -->
        <a href="?gender=female" class="stat-card <?= $genderFilter == 'female' ? 'active' : '' ?>" style="text-decoration: none; color: inherit;">
            <div class="stat-card-label">إناث</div>
            <div class="stat-card-row">
                <div class="stat-card-val"><?= number_format($stats['females']) ?></div>
                <div class="stat-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="5"></circle><path d="M12 12v9"></path><path d="M9 17h6"></path></svg>
                </div>
            </div>
        </a>

        <!-- ذكور -->
        <a href="?gender=male" class="stat-card <?= $genderFilter == 'male' ? 'active' : '' ?>" style="text-decoration: none; color: inherit;">
            <div class="stat-card-label">ذكور</div>
            <div class="stat-card-row">
                <div class="stat-card-val"><?= number_format($stats['males']) ?></div>
                <div class="stat-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="14" r="5"></circle><path d="M19 5L13.5 10.5"></path><path d="M14 5h5v5"></path></svg>
                </div>
            </div>
        </a>

        <!-- إجمالي المسجلين -->
        <a href="partners.php" class="stat-card <?= (!$genderFilter && !$dateFrom) ? 'active' : '' ?>" style="text-decoration: none; color: inherit;">
            <div class="stat-card-label">إجمالي المسجلين</div>
            <div class="stat-card-row">
                <div class="stat-card-val"><?= number_format($stats['total']) ?></div>
                <div class="stat-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
            </div>
        </a>
    </div>

    <style>
        .stat-card.active { border: 2px solid var(--color-accent); background: #fdfaf3; }
    </style>

    <div class="admin-table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="padding-right:0;">التاريخ والوقت</th>
                    <th>الاسم</th>
                    <th>تاريخ الميلاد</th>
                    <th>رقم التليفون</th>
                    <th>الجنس</th>
                    <th style="padding-left:0;">رقم الكارت</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($partners)): ?>
                    <tr><td colspan="6" style="text-align:center; padding: 3rem; color: #999;">لا توجد سجلات مطابقة</td></tr>
                <?php else: ?>
                    <?php foreach ($partners as $p): ?>
                        <tr>
                            <td dir="ltr" style="font-size: 0.9rem; color: #666;"><?= iraqTime($p['created_at']) ?></td>
                            <td style="color: #005445; font-weight: 700;"><?= htmlspecialchars($p['full_name']) ?></td>
                            <td><?= htmlspecialchars($p['date_of_birth']) ?></td>
                            <td dir="ltr"><?= htmlspecialchars($p['mobile_number']) ?></td>
                            <td><?= $p['gender'] == 'male' ? 'ذكر' : 'أنثى' ?></td>
                            <td style="font-weight: 700; color: #666;"><?= htmlspecialchars($p['card_number']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="admin-footer-actions">
        <a href="export.php?type=partners" class="cta-btn-green" style="width: auto; padding: 0.8rem 2rem; border-radius: 12px; font-size: 0.95rem;">تصدير بيانات CSV</a>
        
        <form method="GET" class="admin-filter-form">
             <input type="date" name="date_from" value="<?= htmlspecialchars($dateFrom) ?>" class="form-control" style="width: 150px; font-size: 0.85rem;">
             <span style="color: #999;">إلى</span>
             <input type="date" name="date_to" value="<?= htmlspecialchars($dateTo) ?>" class="form-control" style="width: 150px; font-size: 0.85rem;">
             <button type="submit" class="cta-btn-gold" style="width: auto; padding: 0.5rem 1.5rem; border-radius: 8px; font-size: 0.85rem;">فلترة</button>
        </form>
    </div>
</div>

</main>
</body>
</html>

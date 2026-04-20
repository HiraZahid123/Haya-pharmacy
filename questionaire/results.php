<?php
require_once 'survey_config.php';
require_once '../config/config.php'; // For DB Config

// Basic risk calculation logic
$responses = isset($_SESSION['survey_responses']) ? $_SESSION['survey_responses'] : [];

// Grouping pages by category
$thyroidPages = [
    'heart-sweat.php', 'fatigue.php', 'temp-sensitivity.php', 
    'skin-hair.php', 'weight-change.php', 'period-regularity.php'
];
$diabetesPages = [
    'age-diabetes.php', 'diabetes-family.php', 'physical-activity.php', 
    'fruits-veg.php', 'high-blood-sugar.php', 'blood-pressure-history.php',
    'age-40plus.php', 'symptoms-check.php', 'activity-150min.php', 
    'bmi-check-bp.php', 'high-salt-foods.php', 'smoking-shisha.php', 
    'diabetes-cholesterol.php'
];
$bpPages = [
    'vitamin-deficiency.php', 'vitamin-diet.php', 'blood-pressure-meds.php', 
    'vitamin-fatigue.php', 'vitamin-hair.php', 'vitamin-muscle.php', 
    'vitamin-skin-nails.php', 'vitamin-appetite.php'
];
$vitaminPages = []; // Since the vitamin files were repurposed for BP questions as per user request

function countYes($pages, $res) {
    if (empty($pages)) return 0;
    $c = 0;
    foreach($pages as $p) {
        if(isset($res[$p]) && strtolower($res[$p]) === 'yes') $c++;
    }
    return $c;
}

$thyroidScore  = countYes($thyroidPages, $responses);
$diabetesScore = countYes($diabetesPages, $responses);
$bpScore       = countYes($bpPages, $responses);
$vitaminScore  = 0; // Or keep it if we have some other pages

// Calculate Levels and Percentages
function getRiskInfo($score, $total, $type = '') {
    if ($total == 0) return ['level'=>'خطر منخفض', 'desc'=>'تشير هذه النتيجة إلى احتمال أقل لوقوع المرض.', 'pct'=>0];
    $pct = ($score / $total) * 100;
    
    if ($pct == 0) {
        return ['level'=>'سليم', 'desc'=>'تشير الإجابات لعدم وجود خطر واضح.', 'pct'=>2]; 
    } else if ($pct <= 33) {
        return ['level'=>'خطر منخفض', 'desc'=>'تشير هذه النتيجة إلى احتمال أقل لوجود المشكلة. يُنصح بالمتابعة العادية.', 'pct'=>$pct];
    } else if ($pct <= 66) {
        return ['level'=>'خطر متوسط', 'desc'=>'تشير هذه النتيجة إلى احتمال ملحوظ لوجود المشكلة. يُنصح بإجراء التحاليل المخبرية.', 'pct'=>$pct];
    } else {
        $level = ($pct > 80 && ($type == 'diabetes' || $type == 'bp')) ? 'خطر مرتفع جداً' : 'خطر مرتفع';
        return ['level'=>$level, 'desc'=>'تشير هذه النتيجة إلى احتمال كبير ولا ينبغي تجاهلها. يُنصح باستشارة الطبيب فوراً.', 'pct'=>$pct];
    }
}

$thyroidData  = getRiskInfo($thyroidScore, count($thyroidPages));
$diabetesData = getRiskInfo($diabetesScore, count($diabetesPages), 'diabetes');
$bpData       = getRiskInfo($bpScore, count($bpPages), 'bp');
$vitaminData  = getRiskInfo($vitaminScore, 0); // Placeholder since pages were moved to BP

// Save to DB logic (unchanged but using updated scores)
if (!empty($responses) && !isset($responses['SAVED_TO_DB'])) {
    $gender = $responses['gender.php'] ?? null;
    $age = $responses['age.php'] ?? null;
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO standalone_survey_results 
                (gender, age_category, thyroid_score, thyroid_risk, diabetes_score, diabetes_risk, bp_score, bp_risk, vitamin_score, vitamin_risk, survey_data)
                VALUES (:gender, :age, :t_score, :t_risk, :d_score, :d_risk, :b_score, :b_risk, :v_score, :v_risk, :data)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':gender' => $gender,
            ':age' => $age,
            ':t_score' => $thyroidScore,
            ':t_risk' => $thyroidData['level'],
            ':d_score' => $diabetesScore,
            ':d_risk' => $diabetesData['level'],
            ':b_score' => $bpScore,
            ':b_risk' => $bpData['level'],
            ':v_score' => $vitaminScore,
            ':v_risk' => $vitaminData['level'],
            ':data' => json_encode($responses, JSON_UNESCAPED_UNICODE)
        ]);
        $_SESSION['survey_responses']['SAVED_TO_DB'] = true;
    } catch(Exception $e) {
        error_log("Failed to save survey: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>نتائج الفحص الصحي - صيدلية هيا</title>
  <style>
    @font-face {
      font-family: 'MadaniArabic';
      src: url('../assets/fonts/MadaniArabicDemo.otf') format('opentype');
      font-weight: normal; font-style: normal; font-display: swap;
    }
  
    @font-face {
      font-family: 'MadaniArabic';
      src: local('Arial'), local('Helvetica'), local('system-ui'), local('sans-serif');
      unicode-range: U+0020-007E, U+0660-0669, U+06F0-06F9;
    }
    @font-face {
      font-family: 'Madani Arabic Demo';
      src: local('Arial'), local('Helvetica'), local('system-ui'), local('sans-serif');
      unicode-range: U+0020-007E, U+0660-0669, U+06F0-06F9;
    }
  </style>

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html, body {
      width: 100%; height: 100%; overflow: hidden;
      font-family: 'MadaniArabic', sans-serif;
      background-color: #E9E0D9; color: #015645;
    }

    .page {
      position: relative; width: 100%; height: 100vh;
      display: flex; align-items: center; justify-content: center; overflow: hidden;
    }

    .pat-side {
      position: fixed; top: 0; width: 288px; height: 100vh;
      pointer-events: none; z-index: 0;
    }
    .pat-side.left  { left: 0; }
    .pat-side.right { right: 0; }
    .pat-img { width: 100%; height: 100%; object-fit: cover; }

    .card {
      position: relative; z-index: 1;
      background-color: #F6EDEA;
      border-radius: 14px;
      border: 1px solid rgba(187, 153, 96, 0.18);
      width: min(1280px, calc(100vw - 64px));
      height: min(850px, calc(100vh - 100px));
      display: flex; flex-direction: column;
      padding: 40px 60px 30px;
      overflow: hidden;
    }

    .main-title {
      color: #BB9960;
      font-size: clamp(22px, 2.5vw, 32px);
      font-weight: 800;
      text-align: center;
      margin-bottom: 40px;
    }

    .results-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 25px;
      width: 100%;
      flex: 1;
      overflow-y: auto;
      padding-bottom: 15px;
    }
    .results-grid::-webkit-scrollbar { display: none; }

    .res-card {
      background: #EBE1DC;
      border-radius: 16px;
      padding: 24px;
      display: flex; flex-direction: column; gap: 15px;
      position: relative;
    }

    .res-top {
      display: flex; justify-content: space-between; align-items: center;
    }

    .res-title-box {
      display: flex; align-items: center; gap: 12px;
      color: #015645; font-size: 20px; font-weight: 800;
    }
    .res-icon { width: 32px; height: 32px; object-fit: contain; }

    .badge {
      padding: 4px 16px; border-radius: 20px;
      font-size: 13px; font-weight: 700; color: #fff;
      background-color: #BB9960;
    }

    .res-desc {
      font-size: 14px; line-height: 1.6; color: #015645;
      text-align: right; font-weight: 500;
    }
    .res-desc b { font-weight: 800; }

    .res-footer {
      margin-top: auto; display: flex; flex-direction: column; gap: 8px;
    }
    .res-label { font-size: 13px; font-weight: 700; color: #015645; }

    .bar-outer {
      width: 100%; height: 8px; background-color: #fff; border-radius: 10px; overflow: hidden;
    }
    .bar-inner {
      height: 100%; background-color: #BB9960; border-radius: 10px;
      transition: width 1s ease-out;
    }

    .disclaimer {
      margin-top: 20px; text-align: right;
      border-top: 1.5px solid rgba(187, 153, 96, 0.15);
      padding-top: 20px;
    }
    .disclaimer h3 { color: #015645; font-size: 18px; font-weight: 800; margin-bottom: 6px; }
    .disclaimer p { font-size: 14px; color: #015645; line-height: 1.6; font-weight: 500; }

    @media (max-width: 900px) {
      .results-grid { grid-template-columns: 1fr; }
      .card { width: calc(100vw - 32px); padding: 30px 20px; }
    }
  
    @font-face {
      font-family: 'MadaniArabic';
      src: local('Arial'), local('Helvetica'), local('system-ui'), local('sans-serif');
      unicode-range: U+0020-007E, U+0660-0669, U+06F0-06F9;
    }
    @font-face {
      font-family: 'Madani Arabic Demo';
      src: local('Arial'), local('Helvetica'), local('system-ui'), local('sans-serif');
      unicode-range: U+0020-007E, U+0660-0669, U+06F0-06F9;
    }
  </style>
</head>
<body>
<div class="page">
  <div class="pat-side left"><img src="../assets/images/p-left.svg" class="pat-img" alt="" /></div>
  <div class="pat-side right"><img src="../assets/images/p-right.svg" class="pat-img" alt="" /></div>

  <div class="card">
    <h1 class="main-title">شكراً لمشاركتك ويانا بالفحص الصحي</h1>

    <div class="results-grid">
      <!-- Thyroid -->
      <div class="res-card">
        <div class="res-top">
          <div class="res-title-box">
            <span>الغدة الدرقية</span>
            <img src="../assets/images/1.svg" class="res-icon" alt="" />
          </div>
          <span class="badge"><?= htmlspecialchars($thyroidData['level']) ?></span>
        </div>
        <p class="res-desc">
          <b><?= htmlspecialchars($thyroidData['level']) ?>:</b> <?= htmlspecialchars($thyroidData['desc']) ?>
        </p>
        <div class="res-footer">
          <span class="res-label">المستوى</span>
          <div class="bar-outer"><div class="bar-inner" style="width: <?= $thyroidData['pct'] ?>%"></div></div>
        </div>
      </div>

      <!-- Vitamins -->
      <div class="res-card">
        <div class="res-top">
          <div class="res-title-box">
            <span>نقص الفيتامينات</span>
            <img src="../assets/images/iconn.svg" class="res-icon" alt="" />
          </div>
          <span class="badge"><?= htmlspecialchars($vitaminData['level']) ?></span>
        </div>
        <p class="res-desc">
          <b><?= htmlspecialchars($vitaminData['level']) ?>:</b> <?= htmlspecialchars($vitaminData['desc']) ?>
        </p>
        <div class="res-footer">
          <span class="res-label">المستوى</span>
          <div class="bar-outer"><div class="bar-inner" style="width: <?= $vitaminData['pct'] ?>%"></div></div>
        </div>
      </div>

      <!-- Diabetes -->
      <div class="res-card">
        <div class="res-top">
          <div class="res-title-box">
            <span>السكري</span>
            <img src="../assets/images/4.svg" class="res-icon" alt="" />
          </div>
          <span class="badge"><?= htmlspecialchars($diabetesData['level']) ?></span>
        </div>
        <p class="res-desc">
          <b><?= htmlspecialchars($diabetesData['level']) ?>:</b> <?= htmlspecialchars($diabetesData['desc']) ?>
        </p>
        <div class="res-footer">
          <span class="res-label">المستوى</span>
          <div class="bar-outer"><div class="bar-inner" style="width: <?= $diabetesData['pct'] ?>%"></div></div>
        </div>
      </div>

      <!-- BP -->
      <div class="res-card">
        <div class="res-top">
          <div class="res-title-box">
            <span>ضغط الدم</span>
            <img src="../assets/images/2.svg" class="res-icon" alt="" />
          </div>
          <span class="badge"><?= htmlspecialchars($bpData['level']) ?></span>
        </div>
        <p class="res-desc">
          <b><?= htmlspecialchars($bpData['level']) ?>:</b> <?= htmlspecialchars($bpData['desc']) ?>
        </p>
        <div class="res-footer">
          <span class="res-label">المستوى</span>
          <div class="bar-outer"><div class="bar-inner" style="width: <?= $bpData['pct'] ?>%"></div></div>
        </div>
      </div>
    </div>

    <div class="disclaimer">
      <h3>ملاحظة مهمة</h3>
      <p>هذا التقرير هو لأغراض التوعية والإرشاد فقط بناءً على إجاباتك في الاستبيان. ولا يُعتبر تشخيصاً طبياً ولا يغني عن استشارة الطبيب.</p>
    </div>
  </div>
</div>
</body>
</html>


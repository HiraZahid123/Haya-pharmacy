<?php
require_once 'survey_config.php';
require_once '../config/config.php'; // For DB Config

// Basic risk calculation logic
$responses = isset($_SESSION['survey_responses']) ? $_SESSION['survey_responses'] : [];

// If there's no data at all, maybe they haven't started. 
// Just in case, we still show the page, but values will be 0.
$thyroidPages = ['heart-sweat.php', 'fatigue.php', 'temp-sensitivity.php', 'skin-hair.php', 'weight-change.php', 'period-regularity.php'];
$diabetesPages = ['age-diabetes.php', 'diabetes-family.php', 'physical-activity.php', 'fruits-veg.php', 'blood-pressure-meds.php', 'high-blood-sugar.php'];
$bpPages = ['blood-pressure-history.php', 'age-40plus.php', 'symptoms-check.php', 'bmi-check-bp.php', 'high-salt-foods.php', 'smoking-shisha.php', 'activity-150min.php', 'diabetes-cholesterol.php'];
$vitaminPages = ['vitamin-deficiency.php', 'vitamin-diet.php', 'vitamin-fatigue.php', 'vitamin-hair.php', 'vitamin-muscle.php', 'vitamin-skin-nails.php', 'vitamin-appetite.php'];

function countYes($pages, $res) {
    global $responses;
    $c = 0;
    foreach($pages as $p) {
        if(isset($res[$p]) && strtolower($res[$p]) === 'yes') $c++;
    }
    return $c;
}

$thyroidScore  = countYes($thyroidPages, $responses);
$diabetesScore = countYes($diabetesPages, $responses);
$bpScore       = countYes($bpPages, $responses);
$vitaminScore  = countYes($vitaminPages, $responses);

// Calculate Levels and Percentages
function getRiskInfo($score, $total) {
    if ($total == 0) return ['level'=>'خطر منخفض', 'desc'=>'تشير هذه النتيجة إلى احتمال أقل لوقوع المرض.', 'pct'=>0];
    $pct = ($score / $total) * 100;
    
    if ($pct == 0) {
        return ['level'=>'سليم', 'desc'=>'تشير الإجابات لعدم وجود خطر واضح.', 'pct'=>2]; // Small visible bar
    } else if ($pct <= 33) {
        return ['level'=>'خطر منخفض', 'desc'=>'تشير هذه النتيجة إلى احتمال أقل لوجود المشكلة. يُنصح بالمتابعة العادية.', 'pct'=>$pct];
    } else if ($pct <= 66) {
        return ['level'=>'خطر متوسط', 'desc'=>'تشير هذه النتيجة إلى احتمال ملحوظ لوجود المشكلة. يُنصح بإجراء التحاليل المخبرية.', 'pct'=>$pct];
    } else {
        return ['level'=>'خطر مرتفع', 'desc'=>'تشير هذه النتيجة إلى احتمال كبير ولا ينبغي تجاهلها. يُنصح باستشارة الطبيب فوراً.', 'pct'=>$pct];
    }
}

$thyroidData  = getRiskInfo($thyroidScore, count($thyroidPages));
$diabetesData = getRiskInfo($diabetesScore, count($diabetesPages));
$bpData       = getRiskInfo($bpScore, count($bpPages));
$vitaminData  = getRiskInfo($vitaminScore, count($vitaminPages));

// Overrides for specific risk scenarios or extra high
if ($diabetesData['pct'] > 80) $diabetesData['level'] = 'خطر مرتفع جداً';
if ($bpData['pct'] > 80) $bpData['level'] = 'خطر مرتفع جداً';

// Save to DB if not saved yet
if (!empty($responses) && !isset($responses['SAVED_TO_DB'])) {
    
    $gender = $responses['gender.php'] ?? null;
    $age = $responses['age.php'] ?? null; // Usually 'yes' or 'no' or specific string based on earlier implementation
    
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
        // Silently fail or log in real life, ignoring for end user display
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
      font-weight: normal;
      font-style: normal;
      font-display: swap;
    }
  </style>

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html, body {
      width: 100%;
      height: 100%;
      overflow: hidden;
      font-family: 'MadaniArabic', sans-serif;
      background-color: #E9E0D9;
      color: #015645;
    }

    .page {
      position: relative;
      width: 100%;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .pat-side {
      position: fixed;
      top: -44px;
      width: 288px;
      height: 100vh;
      pointer-events: none;
      z-index: 0;
    }
    .pat-side.left  { left: 0; }
    .pat-side.right { right: 0; transform: scaleX(-1); }

    .pat-layer {
      position: absolute;
      top: 0;
      left: 0;
      width: 288px;
      display: block;
    }
    .p-l1 { height: 940.5px; transform: rotate(-180deg); opacity: 1; }
    .p-l2 { height: 459.7px; opacity: 0.5; }

    .card {
      position: relative;
      z-index: 1;
      background-color: #F6EDEA;
      border-radius: 14px;
      border: 1px solid rgba(187, 153, 96, 0.18);
      width: min(1100px, calc(100vw - 360px));
      height: calc(100vh - 80px);
      max-height: 780px;
      padding: 30px 50px 24px;
      display: flex;
      flex-direction: column;
      align-items: center;
      overflow: hidden;
    }

    .main-title {
      color: #BB9960;
      font-size: clamp(20px, 2vw, 28px);
      font-weight: 700;
      text-align: center;
      width: 100%;
      line-height: 1.5;
      margin-bottom: 45px;
    }

    .results-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
      width: 100%;
      margin-bottom: 45px;
      flex: 1;
      overflow-y: auto;
      padding-bottom: 10px;
    }
    
    .results-grid::-webkit-scrollbar { display: none; }
    .results-grid { -ms-overflow-style: none; scrollbar-width: none; }

    .res-item {
      background: #EBE1DC;
      border-radius: 12px;
      padding: 18px;
      display: flex;
      flex-direction: column;
      gap: 12px;
      height: fit-content;
    }

    .res-header {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 8px;
      width: 100%;
    }

    .res-title-box {
      display: flex;
      align-items: center;
      gap: 10px;
      color: #015645;
      font-size: clamp(16px, 1.3vw, 20px);
      font-weight: 700;
    }

    .res-icon {
      width: 28px;
      height: 28px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .res-icon img { width: 100%; height: 100%; object-fit: contain; }

    .badge {
      padding: 3px 14px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 700;
      color: #fff;
      background-color: #BB9960;
    }
    
    /* Low Risk Color Helper */
    .badge.green-bg { background-color: #BB9960; }
    .badge.red-bg { background-color: #BB9960; }

    .res-desc {
      font-size: 13px;
      line-height: 1.6;
      color: #015645;
      font-weight: 500;
      text-align: right;
    }
    .res-desc b { color: #015645; font-weight: 700; }

    .res-footer {
      margin-top: auto;
      display: flex;
      flex-direction: column;
      gap: 6px;
    }
    .res-label { font-size: 11px; color: #015645; font-weight: 600; }

    .res-bar-bg {
      width: 100%;
      height: 5px;
      background-color: #fff;
      border-radius: 3px;
      overflow: hidden;
    }
    .res-bar-fill {
      height: 100%;
      border-radius: 3px;
      transition: width 0.8s ease-out;
    }

    .disclaimer {
      width: 100%;
      text-align: right;
      padding-top: 15px;
      border-top: 1px solid rgba(187, 153, 96, 0.1);
    }
    .disclaimer h3 {
      color: #015645;
      font-size: 15px;
      margin-bottom: 4px;
      font-weight: 700;
    }
    .disclaimer p {
      font-size: 12px;
      line-height: 1.5;
      color: #015645;
      font-weight: 500;
    }

    @media (max-width: 1000px) {
      .card { width: calc(100vw - 180px); padding: 25px 30px; }
      .results-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 600px) {
      .card {
        width: calc(100vw - 32px);
        padding: 20px 15px;
        border-radius: 12px;
        height: calc(100vh - 40px);
        max-height: none;
      }
      .res-item { padding: 15px; }
    }
  </style>

  <link rel="icon" type="image/svg+xml" href="../assets/images/favicon.svg">
</head>
<body>

<?php
  function getBadgeClass($pct) {
      if ($pct <= 33) return 'green-bg';
      if ($pct > 66) return 'red-bg';
      return '';
  }
?>

<div class="page">
  <div class="pat-side left" aria-hidden="true">
    <img src="../assets/images/haya pattern  4.svg" class="pat-layer p-l1" alt="" />
    <img src="../assets/images/haya pattern 3.svg" class="pat-layer p-l2" alt="" />
  </div>
  <div class="pat-side right" aria-hidden="true">
    <img src="../assets/images/haya pattern  4.svg" class="pat-layer p-l1" alt="" />
    <img src="../assets/images/haya pattern 3.svg" class="pat-layer p-l2" alt="" />
  </div>

  <div class="card" role="main">
    <h1 class="main-title">شكراً لمشاركتك ويانا بالفحص الصحي</h1>

    <div class="results-grid">

      <!-- Thyroid -->
      <div class="res-item">
        <div class="res-header">
          <div class="res-title-box">
             <span class="res-icon">
               <img src="../assets/images/1.svg" alt="Thyroid Icon" />
             </span>
             الغدة الدرقية
          </div>
          <span class="badge <?= getBadgeClass($thyroidData['pct']) ?>"><?= htmlspecialchars($thyroidData['level']) ?></span>
        </div>
        <p class="res-desc">
          <b><?= htmlspecialchars($thyroidData['level']) ?>.</b> <?= htmlspecialchars($thyroidData['desc']) ?>
        </p>
        <div class="res-footer">
          <span class="res-label">المستوى</span>
          <div class="res-bar-bg">
            <div class="res-bar-fill" style="width: <?= $thyroidData['pct'] ?>%; background-color: #BB9960;"></div>
          </div>
        </div>
      </div>

      <!-- Blood Pressure -->
      <div class="res-item">
        <div class="res-header">
          <div class="res-title-box">
             <span class="res-icon">
               <img src="../assets/images/2.svg" alt="Blood Pressure Icon" />
             </span>
             ضغط الدم
          </div>
          <span class="badge <?= getBadgeClass($bpData['pct']) ?>"><?= htmlspecialchars($bpData['level']) ?></span>
        </div>
        <p class="res-desc">
          <b><?= htmlspecialchars($bpData['level']) ?>.</b> <?= htmlspecialchars($bpData['desc']) ?>
        </p>
        <div class="res-footer">
          <span class="res-label">المستوى</span>
          <div class="res-bar-bg">
            <div class="res-bar-fill" style="width: <?= $bpData['pct'] ?>%; background-color: #BB9960;"></div>
          </div>
        </div>
      </div>

      <!-- Vitamins -->
      <div class="res-item">
        <div class="res-header">
          <div class="res-title-box">
             <span class="res-icon">
               <img src="../assets/images/iconn.svg" alt="Vitamin Icon" />
             </span>
             نقص الفيتامينات
          </div>
          <span class="badge <?= getBadgeClass($vitaminData['pct']) ?>"><?= htmlspecialchars($vitaminData['level']) ?></span>
        </div>
        <p class="res-desc">
          <b><?= htmlspecialchars($vitaminData['level']) ?>.</b> <?= htmlspecialchars($vitaminData['desc']) ?>
        </p>
        <div class="res-footer">
          <span class="res-label">المستوى</span>
          <div class="res-bar-bg">
            <div class="res-bar-fill" style="width: <?= $vitaminData['pct'] ?>%; background-color: #BB9960;"></div>
          </div>
        </div>
      </div>

      <!-- Diabetes -->
      <div class="res-item">
        <div class="res-header">
          <div class="res-title-box">
             <span class="res-icon">
               <img src="../assets/images/4.svg" alt="Diabetes Icon" />
             </span>
             السكري
          </div>
          <span class="badge <?= getBadgeClass($diabetesData['pct']) ?>"><?= htmlspecialchars($diabetesData['level']) ?></span>
        </div>
        <p class="res-desc">
          <b><?= htmlspecialchars($diabetesData['level']) ?>.</b> <?= htmlspecialchars($diabetesData['desc']) ?>
        </p>
        <div class="res-footer">
          <span class="res-label">المستوى</span>
          <div class="res-bar-bg">
            <div class="res-bar-fill" style="width: <?= $diabetesData['pct'] ?>%; background-color: #BB9960;"></div>
          </div>
        </div>
      </div>

    </div>

    <!-- Footer Disclaimer -->
    <div class="disclaimer">
      <h3>ملاحظة مهمة</h3>
      <p>
        **هذا التقرير هو لأغراض التوعية والإرشاد فقط** بناءً على إجاباتك في الاستبيان.
        ولا يُعتبر تشخيصاً طبياً ولا يغني عن **استشارة الطبيب**.
      </p>
    </div>

  </div>
</div>

</body>
</html>

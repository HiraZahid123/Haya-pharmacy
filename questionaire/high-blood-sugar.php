<?php require_once 'survey_config.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>استبيان أعراض الغدة الدرقية</title>
  <meta name="description" content="استبيان طبي لتقييم أعراض الغدة الدرقية للمرضى - حياء فارماسي" />
  <style>
    @font-face {
      font-family: 'MadaniArabic';
      src: url('../assets/fonts/MadaniArabicDemo.otf') format('opentype');
      font-weight: normal;
      font-style: normal;
      font-display: swap;
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
      flex-direction: column;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      padding: 24px 0 20px;
    }

    .top-logo-area {
      position: absolute;
      top: 30px;
      left: 40px;
      z-index: 10;
    }

    .header-logo-mini {
      height: 45px;
      object-fit: contain;
    }

    .upper-header {
      width: min(1280px, calc(100vw - 64px));
      display: flex;
      justify-content: flex-start;
      align-items: center;
      margin-bottom: 25px;
      z-index: 2;
    }

    .header-title-box {
      display: flex;
      align-items: center;
      gap: 12px;
      color: #BB9960;
    }

    .header-title {
      font-size: clamp(20px, 2.2vw, 28px);
      font-weight: 800;
      margin: 0;
    }

    .header-icon-svg {
      width: 42px;
      height: 42px;
      object-fit: contain;
    }

    .pat-side {
      position: fixed;
      top: 0;
      width: 288px;
      height: 100vh;
      pointer-events: none;
      z-index: 0;
    }
    .pat-side.left  { left: 0; }
    .pat-side.right { right: 0; }

    .pat-img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .card {
      position: relative;
      z-index: 1;
      background-color: #F6EDEA;
      border-radius: 14px;
      border: 1px solid rgba(187, 153, 96, 0.18);
      width: min(1280px, calc(100vw - 64px));
      height: min(815px, calc(100vh - 150px));
      display: flex;
      flex-direction: column;
      padding-top: 20px;
    }

    .card-body {
      padding: 60px;
      display: flex;
      flex-direction: column;
      align-items: center;
      flex: 1;
      min-height: 0;
    }

    .question {
      color: #000;
      font-size: clamp(20px, 2vw, 26px);
      font-weight: 800;
      text-align: right;
      width: 100%;
      margin-bottom: 45px;
    }

    .options-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      width: 100%;
      max-width: 960px;
      margin-bottom: 20px;
    }

    .opt-btn {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: flex-start;
      gap: 12px;
      padding: 0 24px;
      height: 60px;
      border-radius: 100px;
      font-family: inherit;
      font-size: 17px;
      font-weight: 700;
      cursor: pointer;
      background-color: transparent;
      color: #015645;
      border: 1.5px solid #015645;
      transition: all 0.2s;
      width: 100%;
      outline: none;
    }

    .opt-btn.on {
      background-color: #015645;
      color: #fff;
      border-color: #015645;
    }

    .opt-label {
      font-family: inherit;
      font-weight: 700;
      text-align: right;
    }

    .opt-check {
      width: 32px;
      height: 32px;
      border: 1.5px solid #015645;
      background-color: #fff;
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      transition: all 0.2s;
    }
    .opt-btn.on .opt-check {
      background-color: #fff;
      border-color: #fff;
    }

    .spacer { flex: 1; min-height: 10px; }

    .nav-row {
      width: 100%;
      max-width: 960px;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .nav-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 12px 35px;
      border-radius: 9999px;
      font-family: inherit;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      text-decoration: none;
      outline: none;
    }

    .next-btn {
      background-color: #BB9960;
      color: #fff;
      border: none;
      width: 200px;
      height: 56px;
    }
    .prev-btn {
      background-color: #F6EDEA;
      color: #BB9960;
      border: 1.5px solid rgba(187, 153, 96, 0.4);
      width: 200px;
      height: 56px;
    }

    .next-btn:hover { background-color: #a38552; transform: translateY(-1px); }
    .prev-btn:hover { background-color: #fff; transform: translateY(-1px); }

    .nav-btn svg { width: 18px; height: 18px; }

    .progress-wrap { display: flex; flex-direction: column; align-items: center; gap: 8px; margin-top: 10px; }
    .bars { display: flex; flex-direction: row; gap: 8px; }
    .bar { width: 64px; height: 8px; border-radius: 12px; }
    .bar.on  { background-color: #BB9960; }
    .bar.off { background-color: #E6DCD5; }
    .prog-label { font-size: 14px; color: #B0A299; font-family: inherit; font-weight: 500; }

    @media (max-width: 900px) {
      .card { width: calc(100vw - 120px); }
      .options-grid { grid-template-columns: 1fr; gap: 12px; }
    }

    @media (max-width: 600px) {
      .card { width: calc(100vw - 32px); height: calc(100vh - 80px); }
      .card-body { padding: 24px 20px 22px; }
      .opt-btn { height: 52px; font-size: 15px; }
      .bar { width: 35px; }
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

  <link rel="icon" type="image/svg+xml" href="../assets/images/favicon.svg">
</head>
<body>
<div class="page">

  <!-- Side Patterns -->
  <div class="pat-side left" aria-hidden="true">
    <img src="../assets/images/p-left.svg" class="pat-img" alt="" />
  </div>
  <div class="pat-side right" aria-hidden="true">
    <img src="../assets/images/p-right.svg" class="pat-img" alt="" />
  </div>

  <!-- Logo -->
  <div class="top-logo-area">
    <img src="../assets/images/haya-logo.png" class="header-logo-mini" alt="Haya Pharmacy" />
  </div>

  <!-- Upper Header -->
  <div class="upper-header">
    <div class="header-title-box">
      <img src="../assets/images/titli.svg" class="header-icon-svg" alt="" />
      <h1 class="header-title">استبيان أعراض الغدة الدرقية</h1>
    </div>
  </div>

  <!-- Card -->
  <div class="card" role="main">
    <div class="card-body">
      <form id="surveyForm" method="POST" style="width: 100%; display: flex; flex-direction: column; align-items: center; flex: 1;">
        <input type="hidden" name="survey_answer" id="survey_answer" value="<?= isset($_SESSION['survey_responses']['high-blood-sugar.php']) ? $_SESSION['survey_responses']['high-blood-sugar.php'] : '' ?>">

        <h2 class="question">هل تعاني من عدم تحمّل البرودة أو عدم تحمّل الحرارة؟</h2>

        <!-- Yes / No Options -->
        <div class="options-grid">
          <!-- نعم -->
          <button type="button" class="opt-btn <?= (isset($_SESSION['survey_responses']['high-blood-sugar.php']) && $_SESSION['survey_responses']['high-blood-sugar.php'] == 'yes') ? 'on' : '' ?>" onclick="selectSingle(this, 'yes')" id="opt-yes">
            <span class="opt-check"></span>
            <span class="opt-label">نعم</span>
          </button>

          <!-- لا -->
          <button type="button" class="opt-btn <?= (isset($_SESSION['survey_responses']['high-blood-sugar.php']) && $_SESSION['survey_responses']['high-blood-sugar.php'] == 'no') ? 'on' : '' ?>" onclick="selectSingle(this, 'no')" id="opt-no">
            <span class="opt-check"></span>
            <span class="opt-label">لا</span>
          </button>
        </div>

        <div class="spacer"></div>

        <!-- Navigation Buttons -->
        <div class="nav-row">
          <a href="<?= getPrevStepUrl() ?>" class="nav-btn prev-btn" style="flex-direction: row-reverse;">
            <span style="font-size: 18px;">السابق</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="#BB9960" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>

          <button type="submit" class="nav-btn next-btn" style="flex-direction: row-reverse;">
            <span style="font-size: 18px;">التالي</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M15 18l-6-6 6-6" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
        </div>

        <!-- Progress Indicator -->
        <div class="progress-wrap">
          <?= getProgressBarsHtml() ?>
          <span class="prog-label">السؤال</span>
        </div>
      </form>
    </div>
  </div>

</div>

<script>
  const CHECK_ICON = `<svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 5.5L4.5 9L13 1" stroke="#015645" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>`;

  window.onload = function() {
    const saved = document.getElementById('survey_answer').value;
    if (saved) {
      const btn = document.getElementById('opt-' + saved);
      if (btn) {
        btn.classList.add('on');
        btn.querySelector('.opt-check').innerHTML = CHECK_ICON;
      }
    }
  }

  function selectSingle(btn, value) {
    document.querySelectorAll('.opt-btn').forEach(b => {
      b.classList.remove('on');
      b.querySelector('.opt-check').innerHTML = '';
    });
    btn.classList.add('on');
    btn.querySelector('.opt-check').innerHTML = CHECK_ICON;
    document.getElementById('survey_answer').value = value;
  }
</script>
</body>
</html>


<?php require_once 'survey_config.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>استبيان صيدلية حيا - الجنس</title>
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

    /* ── Full viewport, NO scroll ── */
    html, body {
      width: 100%;
      height: 100%;
      overflow: hidden;
      font-family: 'MadaniArabic', sans-serif;
      background-color: #E9E0D9;
    }

    /* ── Page shell: fills 100vh exactly ── */
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
      height: 45px; /* Reduced size */
      object-fit: contain;
    }

    .upper-header {
      width: 1280px;
      max-width: calc(100vw - 64px);
      display: flex;
      justify-content: flex-start; /* Move contents to the left */
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

    /* ══════════════════════════════
       PRECISE SIDE PATTERNS (Figma Specs)
    ══════════════════════════════ */
    

    /* ══════════════════════════════
       MAIN SURVEY CARD
    ══════════════════════════════ */
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
      flex: 1;
      min-height: 0;
      max-height: min(780px, calc(100vh - 140px));
      display: flex;
      flex-direction: column;
      padding: 32px 60px 28px;
    }

    /* ── Question ── */
    .question {
      color: #000;
      font-size: clamp(20px, 2vw, 26px);
      font-weight: 800;
      text-align: right;
      width: 100%;
      margin-bottom: 45px;
      padding-right: 40px; /* Added padding to keep it inside the card */
    }

    /* ══════════════════════════════
       OPTIONS GRID (1 Row, 2 Columns)
    ══════════════════════════════ */
    .options-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      width: 100%;
      max-width: 960px;
      margin-top: 60px; /* Added margin to center vertically */
      margin-bottom: 20px;
    }

    .opt-btn {
      display: flex;
      flex-direction: row; /* In RTL, this puts the first element on the right */
      align-items: center;
      justify-content: space-between; /* Put space between text and checkbox */
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
    }

    /* Selected State */
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
      margin-left: 0;
    }
    .opt-btn.on .opt-check {
      background-color: #fff;
      border-color: #fff;
    }

    /* ── Flex spacer pushes bottom down ── */
    .spacer { flex: 1; min-height: 16px; }

    /* ══════════════════════════════
       NAVIGATION BUTTONS
    ══════════════════════════════ */
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
      padding: 12px 32px;
      border-radius: 9999px;
      font-family: 'MadaniArabic', sans-serif;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      outline: none;
      transition: all 0.15s;
      text-decoration: none;
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

    .nav-btn svg {
      width: 16px;
      height: 16px;
      stroke-width: 2.2;
    }

    /* ══════════════════════════════
       PROGRESS BARS
    ══════════════════════════════ */
    .progress-wrap { display: flex; flex-direction: column; align-items: center; gap: 8px; margin-top: 12px; }
    .bars { display: flex; flex-direction: row; gap: 8px; }
    .bar { width: 64px; height: 8px; border-radius: 12px; }
    .bar.on  { background-color: #BB9960; }
    .bar.off { background-color: #E6DCD5; }
    .prog-label { font-size: 14px; color: #B0A299; font-family: inherit; font-weight: 500; margin-top: 4px; }

    /* ══════════════════════════════
       RESPONSIVE
    ══════════════════════════════ */
    @media (max-width: 900px) {
      .card { width: calc(100vw - 180px); padding: 32px 36px 28px; }
      .options-grid { grid-template-columns: 1fr; gap: 12px; }
    }

    @media (max-width: 600px) {
      .card { width: calc(100vw - 32px); padding: 24px 20px 22px; height: calc(100vh - 80px); }
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

  <div class="top-logo-area">
    <img src="../assets/images/haya-logo.png" class="header-logo-mini" alt="Haya Pharmacy" />
  </div>

  <div class="upper-header">
    <div class="header-title-box">
      <img src="../assets/images/question.svg" class="header-icon-svg" alt="" />
      <h1 class="header-title">أسئلة عامة</h1>
    </div>
  </div>

  <div class="card" role="main">
    <form id="surveyForm" method="POST" style="width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; flex: 1;">
      <input type="hidden" name="survey_answer" id="survey_answer" value="<?= isset($_SESSION['survey_responses']['gender.php']) ? $_SESSION['survey_responses']['gender.php'] : '' ?>">
      
      <h2 class="question">الجنس</h2>

      <!-- Options Grid -->
      <div class="options-grid">
        <!-- ذكر -->
        <button type="button" class="opt-btn <?= (isset($_SESSION['survey_responses']['gender.php']) && $_SESSION['survey_responses']['gender.php'] == 'male') ? 'on' : '' ?>" onclick="selectSingle(this, 'male')" id="opt-male">
          <span class="opt-check"></span>
          <span class="opt-label">ذكر</span>
        </button>

        <!-- أنثى -->
        <button type="button" class="opt-btn <?= (isset($_SESSION['survey_responses']['gender.php']) && $_SESSION['survey_responses']['gender.php'] == 'female') ? 'on' : '' ?>" onclick="selectSingle(this, 'female')" id="opt-female">
          <span class="opt-check"></span>
          <span class="opt-label">أنثى</span>
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

<script>
  const CHECK_ICON = `<svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 5.5L4.5 9L13 1" stroke="#015645" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>`;

  window.onload = function() {
    const saved = document.getElementById('survey_answer').value;
    if (saved) {
      const btn = document.getElementById('opt-' + saved);
      if (btn) btn.querySelector('.opt-check').innerHTML = CHECK_ICON;
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



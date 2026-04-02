<?php require_once 'survey_config.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>استبيان فحص ضغط الدم - التدخين</title>
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

    /* ── Full viewport, NO scroll ── */
    html, body {
      width: 100%;
      height: 100%;
      overflow: hidden;
      font-family: 'MadaniArabic', sans-serif;
      background-color: #E9E0D9;
      color: #015645;
    }

    /* ── Page shell: fills 100vh exactly ── */
    .page {
      position: relative;
      width: 100%;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    /* ══════════════════════════════
       PRECISE SIDE PATTERNS
    ══════════════════════════════ */
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

    /* ══════════════════════════════
       MAIN SURVEY CARD
    ══════════════════════════════ */
    .card {
      position: relative;
      z-index: 1;
      background-color: #F6EDEA;
      border-radius: 14px;
      border: 1px solid rgba(187, 153, 96, 0.18);

      width: min(1100px, calc(100vw - 360px));
      height: calc(100vh - 80px);
      max-height: 780px;

      padding: 40px 60px 36px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* ── Title ── */
    .title {
      color: #BB9960;
      font-size: clamp(17px, 1.6vw, 24px);
      font-weight: 700;
      text-align: right;
      width: 100%;
      line-height: 1.5;
      margin-bottom: 40px;
    }

    /* ── Question ── */
    .question {
      color: #015645;
      font-size: clamp(15px, 1.35vw, 20px);
      font-weight: 600;
      text-align: right;
      width: 100%;
      line-height: 1.7;
      margin-bottom: 60px;
    }

    /* ══════════════════════════════
       YES / NO TOGGLE BUTTONS
    ══════════════════════════════ */
    .toggle-row {
      display: flex;
      flex-direction: row-reverse;
      gap: 26px;
      width: 100%;
      max-width: 786px;
      align-items: center;
      justify-content: center;
      margin-bottom: 0;
    }

    .tog-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      width: 380px;
      height: 54px;
      border-radius: 50px;
      font-family: 'MadaniArabic', sans-serif;
      font-size: 17px;
      font-weight: 600;
      cursor: pointer;
      outline: none;
      transition: all 0.15s ease;
      flex-shrink: 0;
      border: 2px solid #015645;
    }

    .tog-btn.on {
      background-color: #015645;
      color: #fff;
    }
    .tog-btn.off {
      background-color: #ffffff;
      color: #015645;
    }

    .t-icon {
      width: 22px;
      height: 22px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .t-icon svg { width: 22px; height: 22px; }
    .t-icon.empty-box {
      border: 2px solid #015645;
      border-radius: 4px;
      width: 22px;
      height: 22px;
    }
    .tog-btn.on .t-icon.empty-box { border-color: #fff; }

    /* ── Flex spacer pushes bottom down ── */
    .spacer { flex: 1; min-height: 16px; }

    /* ══════════════════════════════
       NAVIGATION BUTTONS
    ══════════════════════════════ */
    .nav-row {
      width: 100%;
      max-width: 786px;
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
      gap: 8px;
      padding: 11px 24px;
      border-radius: 9999px;
      font-family: 'MadaniArabic', sans-serif;
      font-size: clamp(13px, 1.1vw, 15px);
      font-weight: 600;
      border: none;
      cursor: pointer;
      outline: none;
      transition: opacity 0.15s;
      text-decoration: none;
    }
    .nav-btn:hover { opacity: 0.88; }

    .prev-btn { background-color: #BB9960; color: #fff; }
    .next-btn { background-color: #015645; color: #fff; }

    .nav-btn svg { width: 15px; height: 15px; flex-shrink: 0; }

    /* ══════════════════════════════
       PROGRESS BARS
    ══════════════════════════════ */
    .progress-wrap {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 7px;
    }
    .bars {
      display: flex;
      flex-direction: row;
      gap: 5px;
      align-items: center;
    }
    .bar {
      width: 48px;
      height: 5px;
      border-radius: 3px;
    }
    .bar.on  { background-color: #015645; }
    .bar.off { background-color: #CEC8C2; }

    .prog-label {
      font-size: 12px;
      font-weight: 400;
      color: #9E948E;
    }

    @media (max-width: 1200px) {
      .tog-btn { width: 38vw; height: 56px; font-size: 16px; }
      .toggle-row { gap: 2vw; }
    }

    @media (max-width: 900px) {
      .card { width: calc(100vw - 180px); padding: 32px 36px 28px; }
      .tog-btn { width: 38vw; height: 52px; font-size: 15px; border-radius: 30px; }
      .bar { width: 30px; }
    }

    @media (max-width: 600px) {
      .card {
        width: calc(100vw - 32px);
        padding: 24px 20px 22px;
        border-radius: 12px;
        height: calc(100vh - 40px);
      }
      .tog-btn { width: 40vw; height: 46px; font-size: 13px; border-radius: 25px; gap: 6px; }
      .toggle-row { gap: 10px; }
    }
  </style>
</head>
<body>
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
    <form id="surveyForm" method="POST" style="width: 100%; display: flex; flex-direction: column; align-items: center; height: 100%;">
      <input type="hidden" name="survey_answer" id="survey_answer" value="<?= isset($_SESSION['survey_responses']['smoking-shisha.php']) ? $_SESSION['survey_responses']['smoking-shisha.php'] : 'no' ?>">

      <h1 class="title">استبيان فحص ضغط الدم</h1>

      <p class="question">هل تدخن التبغ أو تستخدم الشيشة بانتظام؟</p>

      <div class="toggle-row">
        <!-- لا — NO -->
        <button type="button" id="btn-no" class="tog-btn <?= (isset($_SESSION['survey_responses']['smoking-shisha.php']) && $_SESSION['survey_responses']['smoking-shisha.php'] == 'no') ? 'on' : ((!isset($_SESSION['survey_responses']['smoking-shisha.php'])) ? 'on' : 'off') ?>" onclick="pick('no')" aria-label="لا">
          <span class="t-icon" id="icon-no"></span>
          لا
        </button>

        <!-- نعم — YES -->
        <button type="button" id="btn-yes" class="tog-btn <?= (isset($_SESSION['survey_responses']['smoking-shisha.php']) && $_SESSION['survey_responses']['smoking-shisha.php'] == 'yes') ? 'on' : 'off' ?>" onclick="pick('yes')" aria-label="نعم">
          <span class="t-icon empty-box" id="icon-yes"></span>
          نعم
        </button>
      </div>

      <div class="spacer"></div>

      <div class="nav-row">
        <button type="submit" class="nav-btn next-btn" id="btn-next">
          <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9.5 3L5 7.5L9.5 12" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          السؤال التالي
        </button>

        <a href="<?= getPrevStepUrl() ?>" class="nav-btn prev-btn" id="btn-prev">
          السؤال السابق
          <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5.5 3L10 7.5L5.5 12" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>

      <div class="progress-wrap">
        <?= getProgressBarsHtml() ?>
        <span class="prog-label">السؤال</span>
      </div>
    </form>
  </div>
</div>

<script>
  const CHECK_SVG = `<svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 10.5L8 14.5L16 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>`;

  window.onload = function() {
    const saved = document.getElementById('survey_answer').value;
    pick(saved);
  }

  function pick(answer) {
    const bNo   = document.getElementById('btn-no');
    const bYes  = document.getElementById('btn-yes');
    const iNo   = document.getElementById('icon-no');
    const iYes  = document.getElementById('icon-yes');

    if (answer === 'no') {
      bNo.className  = 'tog-btn on';
      bYes.className = 'tog-btn off';
      iNo.className  = 't-icon'; iNo.innerHTML = CHECK_SVG;
      iYes.className = 't-icon empty-box'; iYes.innerHTML = '';
    } else {
      bYes.className = 'tog-btn on';
      bNo.className  = 'tog-btn off';
      iYes.className = 't-icon'; iYes.innerHTML = CHECK_SVG;
      iNo.className  = 't-icon empty-box'; iNo.innerHTML = '';
    }
    document.getElementById('survey_answer').value = answer;
  }
</script>
</body>
</html>

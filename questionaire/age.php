<?php require_once 'survey_config.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>استبيان الفحص الصحي الذكي</title>
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
      width: min(1000px, calc(100vw - 360px));
      height: calc(100vh - 60px);
      max-height: 820px;
      display: flex;
      flex-direction: column;
    }

    .banner-box {
      position: relative;
      margin: 18px 18px 0;
      height: 220px;
      border-radius: 12px;
      overflow: hidden;
    }

    .banner-bg {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .banner-overlay {
      position: absolute;
      inset: 0;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      padding: 0 45px;
      background: rgba(1, 86, 69, 0.45);
    }

    /* Column for text and button on the Right side */
    .banner-info {
        display: flex;
        flex-direction: column;
        align-items: flex-start; /* Aligns items to the Right edge in RTL */
        gap: 15px;
        text-align: right;
    }

    .banner-title {
        color: #fff;
        font-size: clamp(20px, 2.2vw, 30px);
        font-weight: 700;
        margin: 0;
    }

    .banner-btn {
        background-color: #014739;
        color: #fff;
        padding: 9px 30px;
        border-radius: 50px;
        border: none;
        font-family: inherit;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
    }

    .banner-logo {
        height: 75px;
        object-fit: contain;
    }

    .card-body {
        padding: 30px 60px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
    }

    .question {
      color: #015645;
      font-size: clamp(18px, 1.5vw, 22px);
      font-weight: 700;
      text-align: right;
      width: 100%;
      margin-bottom: 25px;
    }

    .options-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 18px;
      width: 100%;
      max-width: 820px;
      margin-bottom: 20px;
    }

    .opt-btn {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: flex-start; /* Checkbox on right, Text next to it */
      gap: 15px;
      padding: 0 20px;
      height: 58px;
      border-radius: 50px;
      font-family: inherit;
      font-size: 17px;
      font-weight: 600;
      cursor: pointer;
      background-color: #fff;
      color: #015645;
      border: 1.5px solid #015645;
      transition: all 0.2s;
      width: 100%;
    }

    .opt-btn.on {
      background-color: #015645;
      color: #fff;
    }

    .opt-label {
        font-family: 'Verdana', sans-serif;
        font-weight: 600;
        text-align: right;
    }

    .age-num {
        unicode-bidi: isolate;
        display: inline-block;
    }

    .opt-check {
      width: 24px;
      height: 24px;
      border: 1.5px solid #015645;
      border-radius: 5px;
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
      max-width: 820px;
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
    }

    .next-btn { background-color: #015645; color: #fff; border: none; }
    .prev-btn { background-color: transparent; color: #015645; border: 1.5px solid #015645; }

    .next-btn:hover, .prev-btn:hover { opacity: 0.9; transform: translateY(-1px); }

    .nav-btn svg { width: 18px; height: 18px; }

    .progress-wrap { display: flex; flex-direction: column; align-items: center; gap: 8px; }
    .bars { display: flex; flex-direction: row; gap: 7px; }
    .bar { width: 50px; height: 6px; border-radius: 4px; }
    .bar.on  { background-color: #015645; }
    .bar.off { background-color: #E2D9D2; }
    .prog-label { font-size: 12px; color: #B0A299; font-family: inherit; }

    @media (max-width: 900px) {
      .card { width: calc(100vw - 120px); }
      .options-grid { grid-template-columns: 1fr; }
      .banner-box { height: 160px; }
      .banner-logo { height: 50px; }
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

  <div class="card">
    <div class="banner-box">
        <img src="../assets/images/q-img.svg" class="banner-bg" alt="" />
        <div class="banner-overlay">
            <div class="banner-info">
                <h3 class="banner-title">استبيان الفحص الصحي الذكي</h3>
                <button class="banner-btn">ابدأ الآن</button>
            </div>
            <img src="../assets/images/haya-logo-wide-white.png" class="banner-logo" alt="Haya Pharmacy" />
        </div>
    </div>

    <div class="card-body">
        <form id="surveyForm" method="POST" style="width: 100%; display: flex; flex-direction: column; align-items: center; flex: 1;">
            <input type="hidden" name="survey_answer" id="survey_answer" value="<?= isset($_SESSION['survey_responses']['age.php']) ? $_SESSION['survey_responses']['age.php'] : '' ?>">
            
            <h2 class="question">شكد عمرك؟</h2>

            <div class="options-grid">
              <!-- أطهر من 18 -->
              <button type="button" class="opt-btn <?= (isset($_SESSION['survey_responses']['age.php']) && $_SESSION['survey_responses']['age.php'] == 'under-18') ? 'on' : '' ?>" onclick="selectAge(this, 'under-18')" id="opt-under-18">
                <span class="opt-check"></span>
                <span class="opt-label">أقل من 18</span>
              </button>
              
              <!-- 18-30 -->
              <button type="button" class="opt-btn <?= (isset($_SESSION['survey_responses']['age.php']) && $_SESSION['survey_responses']['age.php'] == '18-30') ? 'on' : '' ?>" onclick="selectAge(this, '18-30')" id="opt-18-30">
                <span class="opt-check"></span>
                <span class="opt-label"><span class="age-num">18-30</span></span>
              </button>
              
              <!-- 31-45 -->
              <button type="button" class="opt-btn <?= (isset($_SESSION['survey_responses']['age.php']) && $_SESSION['survey_responses']['age.php'] == '31-45') ? 'on' : '' ?>" onclick="selectAge(this, '31-45')" id="opt-31-45">
                <span class="opt-check"></span>
                <span class="opt-label"><span class="age-num">31-45</span></span>
              </button>
              
              <!-- 46 وفوق -->
              <button type="button" class="opt-btn <?= (isset($_SESSION['survey_responses']['age.php']) && $_SESSION['survey_responses']['age.php'] == '46-plus') ? 'on' : '' ?>" onclick="selectAge(this, '46-plus')" id="opt-46-plus">
                <span class="opt-check"></span>
                <span class="opt-label">46 وفوق</span>
              </button>
            </div>

            <div class="spacer"></div>

            <div class="nav-row">
              <button type="submit" class="nav-btn next-btn">
                السؤال التالي
                <svg viewBox="0 0 24 24" fill="none" style="margin-right: 8px;"><path d="M15 18l-6-6 6-6" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </button>
              <a href="<?= getPrevStepUrl() ?>" class="nav-btn prev-btn">
                <svg viewBox="0 0 24 24" fill="none" style="margin-left: 8px;"><path d="M9 18l6-6-6-6" stroke="#015645" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                السابق
              </a>
            </div>

            <div class="progress-wrap">
              <?= getProgressBarsHtml() ?>
              <span class="prog-label">السؤال</span>
            </div>
        </form>
    </div>
  </div>
</div>

<script>
  const CHECK_ICON = `<svg width="14" height="11" viewBox="0 0 14 11" fill="none"><path d="M1 5.5L4.5 9L13 1" stroke="#015645" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>`;

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

  function selectAge(btn, value) {
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

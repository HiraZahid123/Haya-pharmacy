<?php require_once 'survey_config.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>استبيان صيدلية حيا - الأمراض المزمنة</title>
  <meta name="description" content="استبيان طبي لتقييم اعراض الغدة الدرقية للمرضى - حياء فارماسي" />
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
       PRECISE SIDE PATTERNS (Figma Specs)
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

    /* ── Question ── (Updated for this page) */
    .question {
      color: #015645;
      font-size: clamp(18px, 1.5vw, 22px);
      font-weight: 700;
      text-align: right;
      width: 100%;
      line-height: 1.7;
      margin-bottom: 30px;
    }

    /* ══════════════════════════════
       OPTIONS GRID (2 Columns)
    ══════════════════════════════ */
    .options-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      width: 100%;
      max-width: 800px;
      margin-bottom: 20px;
    }

    .opt-btn {
      display: flex;
      flex-direction: row; 
      align-items: center;
      justify-content: flex-start;
      padding: 0 24px;
      height: 58px;
      border-radius: 50px;
      font-family: 'MadaniArabic', sans-serif;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      outline: none;
      transition: all 0.15s ease;
      background-color: #ffffff;
      color: #015645;
      border: 1.5px solid #015645;
      width: 100%;
    }

    /* Selected State */
    .opt-btn.on {
      background-color: #015645;
      color: #fff;
      border-color: #015645;
    }

    .opt-label {
        margin-right: 12px;
        text-align: right;
    }

    .opt-check {
      width: 22px;
      height: 22px;
      border: 1.5px solid #015645;
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.15s ease;
      flex-shrink: 0;
    }
    .opt-btn.on .opt-check {
      border-color: #fff;
      background-color: transparent; 
    }

    /* ── Flex spacer pushes bottom down ── */
    .spacer { flex: 1; min-height: 16px; }

    /* ══════════════════════════════
       NAVIGATION BUTTONS
    ══════════════════════════════ */
    .nav-row {
      width: 100%;
      max-width: 800px;
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
      background-color: #015645;
      color: #fff;
      border: none;
    }
    .prev-btn {
      background-color: transparent;
      color: #015645;
      border: 1.5px solid #015645;
    }

    .nav-btn:hover { opacity: 0.9; transform: translateY(-1px); }

    .nav-btn svg {
      width: 16px;
      height: 16px;
      stroke-width: 2.2;
    }

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
      gap: 6px;
      align-items: center;
    }
    .bar {
      width: 50px;
      height: 5px;
      border-radius: 3px;
    }
    .bar.on  { background-color: #015645; }
    .bar.off { background-color: #E0D6CD; }

    .prog-label {
      font-size: 12px;
      font-weight: 400;
      color: #9E948E;
    }

    /* ══════════════════════════════
       RESPONSIVE
    ══════════════════════════════ */
    @media (max-width: 900px) {
      .card { width: calc(100vw - 180px); padding: 32px 36px 28px; }
      .options-grid { grid-template-columns: 1fr; gap: 12px; }
      .opt-btn { height: 52px; font-size: 15px; }
    }

    @media (max-width: 600px) {
      .card { width: calc(100vw - 32px); padding: 24px 20px 22px; height: calc(100vh - 40px); }
      .opt-btn { height: 48px; font-size: 14px; padding: 0 16px; }
      .nav-row { gap: 10px; }
      .nav-btn { padding: 10px 20px; font-size: 13px; flex: 1; }
      .bar { width: 35px; }
    }
  </style>
</head>
<body>
<div class="page">

  <!-- Side Patterns -->
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
      <input type="hidden" name="survey_answer" id="survey_answer" value="<?= isset($_SESSION['survey_responses']['chronic-diseases.php']) ? $_SESSION['survey_responses']['chronic-diseases.php'] : '' ?>">

      <h2 class="question">عندك أمراض مزمنة مشخصة؟</h2>

      <!-- Options Grid -->
      <div class="options-grid">
        <button type="button" class="opt-btn" onclick="toggleOpt(this, 'diabetes')" id="opt-diabetes">
          <span class="opt-check"></span>
          <span class="opt-label">سكري</span>
        </button>

        <button type="button" class="opt-btn" onclick="toggleOpt(this, 'thyroid')" id="opt-thyroid">
          <span class="opt-check"></span>
          <span class="opt-label">غدة درقية</span>
        </button>

        <button type="button" class="opt-btn" onclick="toggleOpt(this, 'pressure')" id="opt-pressure">
          <span class="opt-check"></span>
          <span class="opt-label">ضغط</span>
        </button>

        <button type="button" class="opt-btn" onclick="toggleOpt(this, 'none')" id="opt-none">
          <span class="opt-check"></span>
          <span class="opt-label">لا يوجد</span>
        </button>
      </div>

      <div class="spacer"></div>

      <!-- Navigation Buttons -->
      <div class="nav-row">
        <button type="submit" class="nav-btn next-btn" id="btn-next">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 18L9 12L15 6" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          السؤال التالي
        </button>

        <a href="<?= getPrevStepUrl() ?>" class="nav-btn prev-btn">
          السابق
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 18L15 12L9 6" stroke="#015645" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
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
  const CHECK_ICON = `<svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 5.5L4.5 9L13 1" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>`;

  window.onload = function() {
    const saved = document.getElementById('survey_answer').value;
    if (saved) {
      const activeIds = saved.split(',');
      activeIds.forEach(id => {
          const btn = document.getElementById('opt-' + id);
          if (btn) {
              btn.classList.add('on');
              btn.querySelector('.opt-check').innerHTML = CHECK_ICON;
          }
      });
    }
  }

  function updateHidden() {
      const active = [];
      document.querySelectorAll('.opt-btn.on').forEach(btn => {
          active.push(btn.id.replace('opt-', ''));
      });
      document.getElementById('survey_answer').value = active.join(',');
  }

  function toggleOpt(btn, type) {
    const isNone = (type === 'none');
    const wasOn = btn.classList.contains('on');

    if (isNone) {
      if (!wasOn) {
        document.querySelectorAll('.opt-btn').forEach(b => {
          b.classList.remove('on');
          b.querySelector('.opt-check').innerHTML = '';
        });
        btn.classList.add('on');
        btn.querySelector('.opt-check').innerHTML = CHECK_ICON;
      } else {
        btn.classList.remove('on');
        btn.querySelector('.opt-check').innerHTML = '';
      }
    } else {
      if (!wasOn) {
        const noneBtn = document.getElementById('opt-none');
        noneBtn.classList.remove('on');
        noneBtn.querySelector('.opt-check').innerHTML = '';
        btn.classList.add('on');
        btn.querySelector('.opt-check').innerHTML = CHECK_ICON;
      } else {
        btn.classList.remove('on');
        btn.querySelector('.opt-check').innerHTML = '';
      }
    }
    updateHidden();
  }
</script>
</body>
</html>

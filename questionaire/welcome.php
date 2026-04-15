<?php require_once 'survey_config.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>استبيان الفحص الصحي الذكي - مرحباً بكم</title>
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
      padding: 24px;
      border-radius: 14px;
      border: 1px solid rgba(187, 153, 96, 0.18);
      width: min(1400px, calc(100vw - 200px));
      height: calc(100vh - 80px);
      max-height: 820px;
      display: flex;
      flex-direction: column;
    }

    .hero-container {
      position: relative;
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 80px;
      overflow: hidden; /* Keeps the hero bg within its sharp corners */
      border-radius: 0; /* Explicitly sharp corners as requested */
    }

    .hero-bg {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
    }

    .hero-overlay {
      position: absolute;
      inset: 0;
      background: rgba(1, 86, 69, 0.55); /* Teal overlay as seen in image */
      z-index: 0;
    }

    .hero-content {
      position: relative;
      z-index: 1;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 30px;
      max-width: 600px;
    }

    .hero-title {
      color: #fff;
      font-size: clamp(32px, 4vw, 56px);
      font-weight: 700;
      line-height: 1.2;
    }

    .start-btn {
      background-color: #014739;
      color: #fff;
      padding: 18px 60px;
      border-radius: 99px;
      border: none;
      font-family: inherit;
      font-size: clamp(16px, 1.5vw, 22px);
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .start-btn:hover {
      background-color: #015645;
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    .hero-logo {
      position: relative;
      z-index: 1;
      height: clamp(80px, 10vw, 140px);
      object-fit: contain;
    }

    @media (max-width: 1100px) {
      .hero-container {
        flex-direction: column;
        justify-content: center;
        text-align: center;
        padding: 40px;
        gap: 50px;
      }
      .hero-content {
        align-items: center;
      }
      .hero-logo {
        order: -1;
      }
    }
  </style>

  <link rel="icon" type="image/svg+xml" href="../assets/images/favicon.svg">
</head>
<body>
<div class="page">
  <div class="pat-side left" aria-hidden="true">
    <img src="../assets/images/p-left.svg" class="pat-img" alt="" />
  </div>
  <div class="pat-side right" aria-hidden="true">
    <img src="../assets/images/p-right.svg" class="pat-img" alt="" />
  </div>

  <div class="card">
    <div class="hero-container">
      <img src="../assets/images/q-img.svg" class="hero-bg" alt="" />
      <div class="hero-overlay"></div>

      <div class="hero-content">
        <h1 class="hero-title">استبيان الفحص الصحي الذكي</h1>
        <form method="POST">
            <input type="hidden" name="survey_answer" value="started">
            <button type="submit" class="start-btn">ابدأ الآن</button>
        </form>
      </div>

      <img src="../assets/images/haya-logo-wide-white.png" class="hero-logo" alt="Haya Pharmacy" />
    </div>
  </div>
</div>
</body>
</html>

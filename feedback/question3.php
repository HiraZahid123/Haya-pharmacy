<?php require_once 'includes/header.php'; ?>

<div class="survey-card" id="survey-container">
    <!-- Question Content -->
    
    <div id="question-view">
        <div class="card-header-custom d-flex justify-content-center align-items-center">
            <div class="question-text">
                <div class="d-desktop"><?php echo ($survey_type === 'delivery') ? 'كيف تقيّم سرعة التوصيل؟' : 'كيف تقيّم وقت الانتظار؟'; ?></div>
                <div class="d-mobile">هل وصل طلبك كاملا و بحالة جيدة؟</div>
            </div>
        </div>

        <div class="emojis-container mt-5" dir="ltr">
            <div class="emoji-wrapper">
                <button class="emoji-btn <?php echo ($_SESSION['q3'] ?? '') == '1' ? 'selected' : ''; ?>" data-value="1" data-step="3">
                    <img src="assets/images/Bad-1.svg" class="emoji-img" alt="Bad">
                </button>
                <div class="emoji-label d-mobile">لم يصل</div>
                <div class="emoji-label d-desktop"></div>
            </div>
            <div class="emoji-wrapper">
                <button class="emoji-btn <?php echo ($_SESSION['q3'] ?? '') == '2' ? 'selected' : ''; ?>" data-value="2" data-step="3">
                    <img src="assets/images/Neutral-1.svg" class="emoji-img" alt="Neutral">
                </button>
                <div class="emoji-label d-mobile">بعضه وصل</div>
                <div class="emoji-label d-desktop"></div>
            </div>
            <div class="emoji-wrapper">
                <button class="emoji-btn <?php echo ($_SESSION['q3'] ?? '') == '3' ? 'selected' : ''; ?>" data-value="3" data-step="3">
                    <img src="assets/images/Ok.svg" class="emoji-img" alt="Ok">
                </button>
                <div class="emoji-label d-mobile">نعم كامل و بحالة جيدة ✅</div>
                <div class="emoji-label d-desktop"></div>
            </div>
        </div>
        <div id="selection-error">الرجاء اختيار تقييم قبل الانتقال للصفحة التالية</div>
    </div>

    <div class="buttons-container">
        <a href="question2.php" class="btn-custom btn-back">
            <i class="bi bi-chevron-right"></i> رجوع
        </a>
        <a href="question4.php" class="btn-custom btn-next" id="next-link">
            التالي <i class="bi bi-chevron-left"></i>
        </a>
    </div>

    <!-- Progress Dots -->
    <div class="progress-container" dir="rtl">
        <div class="progress-line active"></div>
        <div class="progress-line active"></div>
        <div class="progress-line active"></div>
        <div class="progress-line"></div>
        <div class="progress-line"></div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
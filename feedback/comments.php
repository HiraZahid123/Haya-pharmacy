<?php require_once 'includes/header.php'; ?>

<script>
    document.body.classList.add('comments-step-active');
</script>

<div class="survey-card comments-step-active" id="survey-container">
    <!-- Question Content -->
    <div id="comments-view">
        <div class="comments-header text-center">
            <img src="assets/images/Logo-copy.png" alt="Haya Logo Vertical" class="logo-vertical">
        </div>
        <div class="mb-3">
            <label for="comment-input" class="form-label-custom">اكتب تعليقك هنا (اختياري)</label>
            <textarea class="form-control" id="comment-input" rows="2"><?php echo htmlspecialchars($_SESSION['comment'] ?? ''); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="phone-input" class="form-label-custom">رقم الموبايل (اختياري)</label>
            <input type="tel" class="form-control" id="phone-input" value="<?php echo htmlspecialchars($_SESSION['phone'] ?? ''); ?>">
        </div>
    </div>

    <div class="buttons-container">
        <button class="btn-custom btn-next" id="submit-btn" style="width: 250px; justify-content: center;">
            إرسال
        </button>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
// assets/js/partners.js
// Identical logic to pioneers.js — targets partners registration endpoint

(function () {
    'use strict';

    var SITE_URL = window.HAYA_SITE_URL || '/Haya-Pharmacy';

    // ─── Welcome Banner ───────────────────────────────────────────
    function initWelcomeBanner() {
        var banner = document.getElementById('welcomeBanner');
        if (!banner) return;
        if (sessionStorage.getItem('haya_partners_welcomed')) {
            banner.remove();
            return;
        }
        banner.classList.add('open');
        var closeBtn = document.getElementById('welcomeCloseBtn');
        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                sessionStorage.setItem('haya_partners_welcomed', '1');
                banner.classList.remove('open');
                setTimeout(function () { banner.remove(); }, 400);
            });
        }
    }

    // ─── Modal ────────────────────────────────────────────────────
    function initModal() {
        var overlay = document.getElementById('regModal');
        var openBtns = document.querySelectorAll('.open-reg-modal');
        var closeBtn = document.getElementById('modalClose');
        var form = document.getElementById('regForm');
        var formWrap = document.getElementById('modalFormWrap');
        var successWrap = document.getElementById('modalSuccess');

        if (!overlay) return;

        // Choice Buttons (Gender selection)
        document.querySelectorAll('.option-btn-choice').forEach(btn => {
            btn.addEventListener('click', function () {
                const targetId = this.dataset.target;
                const value = this.dataset.value;
                const input = document.getElementById(targetId);

                this.parentElement.querySelectorAll('.option-btn-choice').forEach(b => {
                    b.style.background = '#fff';
                    b.style.color = '#333';
                    b.style.borderColor = '#ddd';
                });
                this.style.background = '#005445';
                this.style.color = '#fff';
                this.style.borderColor = '#005445';

                if (input) input.value = value;
            });
        });

        // Automatically show modal on page load
        if (!sessionStorage.getItem('haya_partners_modal_shown')) {
            setTimeout(function () {
                overlay.classList.add('open');
                document.body.style.overflow = 'hidden';
                sessionStorage.setItem('haya_partners_modal_shown', '1');
            }, 1500);
        }

        openBtns.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                overlay.classList.add('open');
                document.body.style.overflow = 'hidden';
            });
        });

        if (closeBtn) closeBtn.addEventListener('click', closeModal);

        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) closeModal();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeModal();
        });

        function closeModal() {
            overlay.classList.remove('open');
            document.body.style.overflow = '';
            setTimeout(function () {
                if (form) form.reset();
                clearErrors();
                if (formWrap) formWrap.classList.remove('hide');
                if (successWrap) successWrap.classList.remove('show');
            }, 400);
        }

        if (form) {
            var phoneInput = document.getElementById('reg_mobile');
            if (phoneInput) {
                phoneInput.addEventListener('input', function () {
                    this.value = this.value.replace(/[^0-9+\s\u0660-\u0669\u06F0-\u06F9]/g, '');
                });
            }

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                if (!validateForm()) return;

                var submitBtn = form.querySelector('.pt-btn-submit');
                submitBtn.disabled = true;
                submitBtn.textContent = 'جارٍ التسجيل...';

                fetch(SITE_URL + '/handlers/register-partner.php', {
                    method: 'POST',
                    body: new FormData(form)
                })
                    .then(function (res) { return res.json(); })
                    .then(function (json) {
                        if (json.success) {
                            if (formWrap) formWrap.classList.add('hide');
                            if (successWrap) {
                                var cardNumEl = document.getElementById('successCardNumber');
                                if (cardNumEl) cardNumEl.textContent = json.card_number || '';
                                successWrap.classList.remove('hide');
                                successWrap.classList.add('show');
                            }
                        } else {
                            showGlobalError(json.message || 'حدث خطأ، حاول مرة أخرى');
                        }
                    })
                    .catch(function () {
                        showGlobalError('حدث خطأ في الاتصال، حاول مرة أخرى');
                    })
                    .finally(function () {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'سجل الآن';
                    });
            });
        }
    }

    function validateForm() {
        clearErrors();
        var valid = true;
        var name = document.querySelector('[name="name"]');
        var mobile = document.querySelector('[name="mobile"]');
        var gender = document.querySelector('[name="gender"]');
        var dob = document.querySelector('[name="dob"]');
        var secret = document.querySelector('[name="secret_id"]');

        if (!name || !name.value.trim() || name.value.trim().length < 3) {
            showError('err_name', 'الاسم الكامل مطلوب (3 أحرف على الأقل)');
            valid = false;
        }
        if (!mobile || !/^[0-9+ ]{7,20}$/.test(mobile.value.trim())) {
            showError('err_mobile', 'أدخل رقم هاتف صحيح');
            valid = false;
        }
        if (!gender || !gender.value) {
            showError('err_gender', 'يرجى اختيار الجنس');
            valid = false;
        }
        if (!dob || !dob.value) {
            showError('err_dob', 'يرجى اختيار تاريخ الميلاد');
            valid = false;
        }
        if (!secret || !secret.value.trim()) {
            showError('err_id', 'يرجى إدخال الرقم السري');
            valid = false;
        }
        return valid;
    }

    function showError(id, msg) {
        var el = document.getElementById(id);
        if (el) { el.textContent = msg; el.classList.add('show'); }
        var input = document.getElementById(id.replace('err_', 'reg_'));
        if (input) input.classList.add('error');
    }

    function clearErrors() {
        document.querySelectorAll('.form-error').forEach(function (el) { el.classList.remove('show'); });
        document.querySelectorAll('.form-control').forEach(function (el) { el.classList.remove('error'); });
        var ge = document.getElementById('globalError');
        if (ge) ge.style.display = 'none';
    }

    function showGlobalError(msg) {
        var ge = document.getElementById('globalError');
        if (ge) { ge.textContent = msg; ge.style.display = 'block'; }
    }

    function setupCountdown() {
        const targetDate = new Date();
        targetDate.setDate(targetDate.getDate() + 7); // 7 days from now
        targetDate.setHours(23, 59, 59);

        const daysEl = document.getElementById('days');
        const hoursEl = document.getElementById('hours');
        const minsEl = document.getElementById('mins');
        const secsEl = document.getElementById('secs');

        if (!daysEl || !hoursEl || !minsEl || !secsEl) return;

        function updateTimer() {
            const now = new Date().getTime();
            const distance = targetDate.getTime() - now;

            if (distance < 0) {
                clearInterval(interval);
                return;
            }

            const d = Math.floor(distance / (1000 * 60 * 60 * 24));
            const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const s = Math.floor((distance % (1000 * 60)) / 1000);

            daysEl.textContent = String(d).padStart(2, '0');
            hoursEl.textContent = String(h).padStart(2, '0');
            minsEl.textContent = String(m).padStart(2, '0');
            secsEl.textContent = String(s).padStart(2, '0');
        }

        const interval = setInterval(updateTimer, 1000);
        updateTimer();
    }

    function initScrollNavbar() {
        var topBar = document.querySelector('.haya-top-bar');
        var logoImg = document.querySelector('.haya-main-logo img');

        if (!topBar || !logoImg) return;

        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                topBar.classList.add('scrolled');
                logoImg.src = SITE_URL + '/assets/images/haya-logo-wide-white.png';
            } else {
                topBar.classList.remove('scrolled');
                logoImg.src = SITE_URL + '/assets/images/haya-logo.png';
            }
        });
    }



    document.addEventListener('DOMContentLoaded', function () {
        initModal();
        initScrollNavbar();
    });

}());

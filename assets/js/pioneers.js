// assets/js/pioneers.js
// Handles Pioneer (Al-Awaeil) registration

(function () {
    'use strict';

    var SITE_URL = window.HAYA_SITE_URL || '/Haya-Pharmacy';

    function initModal() {
        var overlay = document.getElementById('regModal');
        var openBtns = document.querySelectorAll('.open-reg-modal');
        var closeBtn = document.getElementById('modalClose');
        var form = document.getElementById('regForm');
        var formWrap = document.getElementById('modalFormWrap');
        var successWrap = document.getElementById('modalSuccess');

        if (!overlay) return;

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

        function closeModal() {
            overlay.classList.remove('open');
            document.body.style.overflow = '';
            setTimeout(function () {
                if (form) form.reset();
                if (formWrap) formWrap.classList.remove('hide');
                if (successWrap) successWrap.classList.remove('show');
            }, 400);
        }

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                if (!validateForm()) return;

                var submitBtn = form.querySelector('.haya-btn-modal-submit');
                submitBtn.disabled = true;
                submitBtn.textContent = 'جارٍ التسجيل...';

                fetch(SITE_URL + '/handlers/register-pioneer.php', {
                    method: 'POST',
                    body: new FormData(form)
                })
                    .then(function (res) { return res.json(); })
                    .then(function (json) {
                        if (json.success) {
                            if (formWrap) formWrap.classList.add('hide');
                            if (successWrap) successWrap.classList.add('show');
                        } else {
                            alert(json.message || 'حدث خطأ، حاول مرة أخرى');
                        }
                    })
                    .catch(function () {
                        alert('حدث خطأ في الاتصال، حاول مرة أخرى');
                    })
                    .finally(function () {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'سجل الآن';
                    });
            });
        }
    }

    function validateForm() {
        var name = document.getElementById('reg_name');
        var mobile = document.getElementById('reg_mobile');
        var gender = document.getElementById('reg_gender');
        var dob = document.getElementById('reg_dob');

        if (!name || !name.value.trim()) return false;
        if (!mobile || !mobile.value.trim()) return false;
        if (!gender || !gender.value) {
            alert('يرجى اختيار الجنس');
            return false;
        }
        if (!dob || !dob.value) return false;

        return true;
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

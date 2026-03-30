document.addEventListener('DOMContentLoaded', function () {
    const emojiButtons = document.querySelectorAll('.emoji-btn');
    const submitBtn = document.getElementById('submit-btn');

    emojiButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const value = this.getAttribute('data-value');
            const step = this.getAttribute('data-step');
            emojiButtons.forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');
            const errorMsg = document.getElementById('selection-error');
            if (errorMsg) {
                errorMsg.classList.remove('visible');
            }
            saveProgress(step, value);
        });
    });

    // Validation for Next button
    const nextLink = document.getElementById('next-link');
    if (nextLink) {
        nextLink.addEventListener('click', function (e) {
            const emojisContainer = document.querySelector('.emojis-container');
            if (emojisContainer) {
                const selected = document.querySelector('.emoji-btn.selected');
                if (!selected) {
                    e.preventDefault();
                    const errorMsg = document.getElementById('selection-error');
                    if (errorMsg) {
                        errorMsg.classList.add('visible');
                    }
                    emojisContainer.classList.add('shake');
                    setTimeout(() => emojisContainer.classList.remove('shake'), 500);
                }
            }
        });
    }

    const phoneInput = document.getElementById('phone-input');
    if (phoneInput) {
        phoneInput.addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }

    // Final Submission
    if (submitBtn) {
        submitBtn.addEventListener('click', function () {
            const comment = document.getElementById('comment-input').value;
            const phone = document.getElementById('phone-input').value;
            saveProgress('comment', comment, () => {
                saveProgress('phone', phone, () => {
                    submitFinalData();
                });
            });
        });
    }

    function saveProgress(key, value, callback) {
        const formData = new FormData();
        formData.append('key', key);
        formData.append('value', value);

        fetch('save_progress.php', {
            method: 'POST',
            body: formData,
            keepalive: true
        })
            .then(() => {
                if (callback) callback();
            })
            .catch(err => console.error('Save failed', err));
    }

    function submitFinalData() {
        fetch('submit_survey.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' }
        })
            .then(response => response.json())
            .then(res => {
                if (res.status === 'success') {
                    window.location.href = 'thank_you.php';
                } else {
                    alert("Error: " + res.message);
                }
            })
            .catch(err => {
                console.error(err);
                alert("حدث خطأ أثناء الإرسال");
            });
    }
});

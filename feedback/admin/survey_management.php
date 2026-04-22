<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Mock dynamic data for sections and questions
$sections = [
    [
        'title' => 'القسم 1: تقييم الخدمات الفندقية (بموجبه ...)',
        'questions' => [
            'هل تم توفير الخدمة في الوقت المحدد؟',
            'مدى رضاك عن تعاون موظفي الاستقبال؟',
            'النظافة العامة للمرفق؟',
            'مدى سهولة إجراءات الدخول والخروج؟',
            'مدى توفر كافة احتياجاتك الطبية؟'
        ]
    ],
    [
        'title' => 'القسم 2: مرافق الغرفة الفندقية (القاعة ب... 2024)',
        'questions' => [
            'نظام التكييف في الغرفة؟',
            'إضاءة الغرفة وتوزيعها؟',
            'نظافة وجاهزية دورة المياه؟',
            'توفير مستلزمات النظافة الشخصية؟',
            'مدى توفر المحتويات والضوابط المكتوبة؟'
        ]
    ],
    [
        'title' => 'القسم 3: فريق التمريض',
        'questions' => [
            'سرعة استجابة التمريض؟',
            'بشاشة وتعاون طاقم التمريض؟',
            'مدى تقديم الشرح الطبي للخدمة؟',
            'الدقة في مواعيد الأدوية والعناية؟'
        ]
    ],
    [
        'title' => 'القسم 4: الكوادر المساندة',
        'questions' => [
            'نظافة الغرفة والأسرة؟',
            'سرعة الاستجابة لطلبات الخدمة؟',
            'جودة الوجبات المقدمة؟',
            'طريقة تقديم الطعام وتغليفه؟',
            'مدى مراعاة الهدوء في الأروقة؟'
        ]
    ]
];

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة محتوى الاستبيان - حيا</title>
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/admin-style.css?v=2.7">
</head>


<body>

    <!-- Top Bar -->
    <div class="admin-topbar">
        <span class="topbar-title">لوحة استبيان رضا المرضى</span>
        <img src="../assets/images/Mask group.svg" alt="Haya Logo" class="topbar-logo">
    </div>

    <!-- Nav Tabs -->
    <nav class="admin-nav">
        <button class="nav-hamburger" id="navHamburger">
            <i class="bi bi-list"></i>
        </button>
        <div class="admin-nav-links" id="navLinks">
            <a href="dashboard.php" class="nav-link">لوحة القيادة</a>
            <a href="responses.php" class="nav-link">الرسوم البيانية</a>
            <a href="branches.php" class="nav-link">إدارة الفروع</a>
            <div class="nav-logout">
                <a href="logout.php" class="btn-logout"><i class="bi bi-box-arrow-left"></i> خروج</a>
            </div>
        </div>
    </nav>

    <div class="admin-content">

        <!-- Survey Hero -->
        <div class="survey-hero">
            <h1>مسح العرض للمرضى</h1>
        </div>

        <div class="info-section">
            <h5 class="section-header-main" style="color: #015645; font-weight: 800; text-align: right; margin-bottom: 25px;">معلومات عامة</h5>
            <div class="info-cards-grid">
                <!-- Age Card (Green) -->
                <div class="info-panel bg-card-green">
                    <div class="info-panel-header" style="text-align: right;">شكد عمرك؟</div>
                    <div class="info-options-grid-2col">
                        <div class="option-item-new">
                            <input type="checkbox" class="custom-chk">
                            <span class="option-text">30-18</span>
                        </div>
                        <div class="option-item-new">
                            <input type="checkbox" class="custom-chk">
                            <span class="option-text">قل من 18</span>
                        </div>
                        <div class="option-item-new">
                            <input type="checkbox" class="custom-chk">
                            <span class="option-text">46 وفوق</span>
                        </div>
                        <div class="option-item-new">
                            <input type="checkbox" class="custom-chk">
                            <span class="option-text">45-31</span>
                        </div>
                    </div>
                </div>

                <!-- Gender Card (Yellow) -->
                <div class="info-panel bg-card-yellow">
                    <div class="info-panel-header" style="text-align: right;">الجنس</div>
                    <div class="info-options-list">
                        <div class="option-item-new">
                            <input type="checkbox" class="custom-chk">
                            <span class="option-text">ذكر</span>
                        </div>
                        <div class="option-item-new">
                            <input type="checkbox" class="custom-chk">
                            <span class="option-text">أنثى</span>
                        </div>
                    </div>
                </div>

                <!-- Married Card (Pink/Red) -->
                <div class="info-panel bg-card-red">
                    <div class="info-panel-header" style="text-align: right;">متزوج/ة؟</div>
                    <div class="info-options-list">
                        <div class="option-item-new">
                            <input type="checkbox" class="custom-chk">
                            <span class="option-text">نعم</span>
                        </div>
                        <div class="option-item-new">
                            <input type="checkbox" class="custom-chk">
                            <span class="option-text">لا</span>
                        </div>
                    </div>
                </div>

                <!-- Diseases Card (Blue) -->
                <div class="info-panel bg-card-blue">
                    <div class="info-panel-header" style="text-align: right;">عندك أمراض مزمنة مشخصة؟</div>
                    <div class="info-options-grid-2col">
                        <div class="option-item-new">
                            <input type="checkbox" class="custom-chk">
                            <span class="option-text">سكري</span>
                        </div>
                        <div class="option-item-new">
                            <input type="checkbox" class="custom-chk">
                            <span class="option-text">غدة درقية</span>
                        </div>
                        <div class="option-item-new">
                            <input type="checkbox" class="custom-chk">
                            <span class="option-text">ضغط</span>
                        </div>
                        <div class="option-item-new">
                            <input type="checkbox" class="custom-chk">
                            <span class="option-text">لا يوجد</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phase Title -->
        <div class="phase-title">المرحلة 3: الأسئلة حسب الأعراض</div>

        <!-- Dynamic Sections -->
        <div class="question-section">
            <div class="section-header" style="text-align: right; font-weight: 800; color: #015645;">القسم A: أعراض نقص الفيتامينات (للكبار خصوصاً 30+)</div>
            <div class="questions-list">
                <?php 
                $new_questions = [
                    'تحس بتعب دائم حتى لو تنام زين؟',
                    'عندك تساقط شعر ملحوظ؟',
                    'تشنجات او الم بالعضلات؟',
                    'بشرتك باهتة او عندك تشقق بالأظافر؟',
                    'عندك نقص شهية أو ضعف تركيز؟'
                ];
                foreach ($new_questions as $q): ?>
                    <div class="question-row">
                        <input type="checkbox" class="custom-chk">
                        <div class="question-text"><?php echo $q; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Alert box for showing success message within each section -->
            <div class="alert alert-success d-none mt-3 save-alert" role="alert">
                تم الحفظ بنجاح!
            </div>
            <div class="section-actions d-flex justify-content-between">
                <button type="button" class="btn-reset reset-btn" style="background: #c09068;"><i class="bi bi-arrow-counterclockwise"></i> خلف</button>
                <button type="button" class="btn-apply save-btn"><i class="bi bi-arrow-right"></i> السؤال التالي</button>
            </div>
        </div>

        <!-- Section B -->
        <div class="question-section mt-5">
            <div class="section-header" style="text-align: right; font-weight: 800; color: #015645;">القسم B: أعراض الغدة الدرقية (للإناث 18-40 تركيز أكبر)</div>
            <div class="questions-list">
                <?php 
                $section_b_questions = [
                    'دورتج الشهرية غير منتظمة؟',
                    'يزيد وزنج أو ينقص بدون سبب واضح؟',
                    'تحسين بخمول أو نعاس طول الوقت؟',
                    'تحسين بخفقان قلب أو تعرق زائد؟',
                    'عندج تساقط شعر قوي او جفاف بالبشرة؟'
                ];
                foreach ($section_b_questions as $q): ?>
                    <div class="question-row">
                        <input type="checkbox" class="custom-chk">
                        <div class="question-text"><?php echo $q; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="alert alert-success d-none mt-3 save-alert" role="alert">
                تم الحفظ بنجاح!
            </div>
            <div class="section-actions d-flex justify-content-between">
                <button type="button" class="btn-reset reset-btn" style="background: #c09068;"><i class="bi bi-arrow-counterclockwise"></i> خلف</button>
                <button type="button" class="btn-apply save-btn"><i class="bi bi-arrow-right"></i> السؤال التالي</button>
            </div>
        </div>

        <!-- Section C -->
        <div class="question-section mt-5">
            <div class="section-header" style="text-align: right; font-weight: 800; color: #015645;">القسم C: قبل السكري</div>
            <div class="questions-list">
                <?php 
                $section_c_questions = [
                    'عندك عطش مستمر؟',
                    'تدخل للحمام هواية؟',
                    'عندك تاريخ عائلي بالسكري؟',
                    'عندك زيادة وزن خصوصاً بالبطن؟',
                    'تحسين بنعاس بعد الأكل مباشرة؟'
                ];
                foreach ($section_c_questions as $q): ?>
                    <div class="question-row">
                        <input type="checkbox" class="custom-chk">
                        <div class="question-text"><?php echo $q; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="alert alert-success d-none mt-3 save-alert" role="alert">
                تم الحفظ بنجاح!
            </div>
            <div class="section-actions d-flex justify-content-between">
                <button type="button" class="btn-reset reset-btn" style="background: #c09068;"><i class="bi bi-arrow-counterclockwise"></i> خلف</button>
                <button type="button" class="btn-apply save-btn"><i class="bi bi-arrow-right"></i> السؤال التالي</button>
            </div>
        </div>

        <!-- Section D -->
        <div class="question-section mt-5">
            <div class="section-header" style="text-align: right; font-weight: 800; color: #015645;">القسم D: اضطراب ضغط الدم</div>
            <div class="questions-list">
                <?php 
                $section_d_questions = [
                    'يجيلك صداع متكرر؟',
                    'تجيك دوخة او زغللة بالعين؟',
                    'تحسين بخفقان قلب؟',
                    'عندك تاريخ عائلي بالضغط؟',
                    'تحسين بتعب مفاجئ او برودة بالاطراف؟'
                ];
                foreach ($section_d_questions as $q): ?>
                    <div class="question-row">
                        <input type="checkbox" class="custom-chk">
                        <div class="question-text"><?php echo $q; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="alert alert-success d-none mt-3 save-alert" role="alert">
                تم الحفظ بنجاح!
            </div>
            <div class="section-actions d-flex justify-content-between">
                <button type="button" class="btn-reset reset-btn" style="background: #c09068;"><i class="bi bi-arrow-counterclockwise"></i> خلف</button>
                <button type="button" class="btn-apply save-btn"><i class="bi bi-arrow-right"></i> السؤال التالي</button>
            </div>
        </div>

    </div>

    <!-- Bootstrap Toast for Global Notifications -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="actionToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toastMessage">
                    تم الإجراء بنجاح.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Hamburger Menu Toggle
        document.getElementById('navHamburger').addEventListener('click', function() {
            document.getElementById('navLinks').classList.toggle('open');
        });

        // Mock Button Functionality (Save / Reset)
        const toastEl = document.getElementById('actionToast');
        const toastMessage = document.getElementById('toastMessage');
        const toast = new bootstrap.Toast(toastEl);

        function showSystemToast(msg, isSuccess = true) {
            toastMessage.textContent = msg;
            toastEl.classList.remove('text-bg-success', 'text-bg-warning');
            toastEl.classList.add(isSuccess ? 'text-bg-success' : 'text-bg-warning');
            toast.show();
        }

        document.querySelectorAll('.save-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const section = this.closest('.question-section');
                const alertBox = section.querySelector('.save-alert');

                if (alertBox) {
                    alertBox.classList.remove('d-none');
                    setTimeout(() => {
                        alertBox.classList.add('d-none');
                    }, 2000);
                }

                showSystemToast('تم حفظ إعدادات القسم بنجاح!');

                // Scroll to next section
                const nextSection = section.nextElementSibling;
                if (nextSection && nextSection.classList.contains('question-section')) {
                    nextSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
        });

        document.querySelectorAll('.reset-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const section = this.closest('.question-section');
                section.querySelectorAll('.custom-chk').forEach(chk => chk.checked = false);
                showSystemToast('تم التراجع عن التغييرات، وعادت للإعداد الافتراضي.', false);

                // Scroll to previous section
                const prevSection = section.previousElementSibling;
                if (prevSection && prevSection.classList.contains('question-section')) {
                    prevSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
        });
    </script>
</body>

</html>
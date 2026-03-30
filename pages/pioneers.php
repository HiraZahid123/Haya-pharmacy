<?php
// pages/partners.php — Full Figma Rebuild (node 279-3835)
require_once __DIR__ . '/../config/config.php';
session_start();

$pageTitle = 'بطاقة الأوائل - صيدلية حيا';
$hideStandardHeader = true;
include __DIR__ . '/../includes/header.php';
?>

<header class="haya-top-bar">
    <div class="haya-top-container">
        <!-- Left: Social Icons (Matching Screenshot) -->
        <div class="haya-top-socials">
            <a href="https://www.instagram.com/hayaph_2026/" target="_blank" class="haya-social-item"><i class="fab fa-instagram"></i></a>
            <a href="https://www.tiktok.com/@haya.ph1?_r=1&_t=zs-93aovdh9fvu" target="_blank" class="haya-social-item"><i class="fab fa-tiktok"></i></a>
            <a href="https://www.snapchat.com/add/haya_ph2026" target="_blank" class="haya-social-item"><i class="fab fa-snapchat-ghost"></i></a>
            <a href="https://www.facebook.com/profile.php?id=61585951153868" target="_blank" class="haya-social-item"><i class="fab fa-facebook-f"></i></a>
            <a href="https://wa.link/11ohbt" target="_blank" class="haya-social-item"><i class="fab fa-whatsapp"></i></a>
        </div>

        <button class="header-hamburger-partners" id="partnersMenuToggle" aria-label="Menu">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Right: Logo -->
        <div class="haya-main-logo">
            <img src="<?= SITE_URL ?>/assets/images/haya-logo.png" alt="Haya Logo">
        </div>
    </div>
</header>

<div class="haya-partners-page">

    <!-- Hero Section -->
    <section class="haya-partners-hero">
        <div class="haya-hero-bg-pattern"></div>
        <div class="haya-hero-container">
            <!-- Left: Content -->
            <div class="haya-hero-content">
                <h1 class="haya-hero-title"> احصل على بطاقة الأوائل
                     من صيدلية حيا</h1>
                <p class="haya-hero-subtitle">ن من أوائل عملاء صيدلية حيا واحصل على بطاقة الأوائل التي صُممت لتمنحك مزايا حصرية وعروضًا خاصة.
                </p>

                <p class="haya-hero-subtitle">
                    تقديرًا لثقتك ووجودك معنا في بداية رحلتنا، ندعوك للتسجيل الآن والانضمام إلى قائمة الانتظار للاستفادة من الخصومات والخدمات المميزة عند افتتاح الصيدلية.
                </p>
                <a href="#" class="haya-btn-dark-green open-reg-modal">سجّل للحصول على البطاقة</a>
            </div>
            <!-- Right: Visual -->
            <div class="haya-hero-visual">
                <img src="<?= SITE_URL ?>/assets/images/Group 1000004111.svg" alt="Health Symbol" class="haya-hero-health-symbol">
                <img src="<?= SITE_URL ?>/assets/images/loyalty-cards.png" alt="Pioneers Cards" class="pioneers-cards-visual">
            </div>
        </div>

        <!-- Features Integrated into Hero -->
        <div class="haya-hero-features">
            <h2 class="haya-hero-features-title">ميزات "الأوائل"</h2>
            <div class="haya-features-container">
                <!-- Row 1: 3 Items -->
                <div class="haya-features-row top">
                    <div class="haya-feature-card">
                        <div class="haya-feature-icon-circle">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <div class="haya-feature-text">توصيل مجاني</div>
                    </div>
                    <div class="haya-feature-card">
                        <div class="haya-feature-icon-circle">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <div class="haya-feature-text">فحص مجاني شهري</div>
                    </div>


                    <div class="haya-feature-card">
                        <div class="haya-feature-icon-circle">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <div class="haya-feature-text">خصم إضافي 10% على المنتجات و الأجهزة</div>
                    </div>
                </div>
                <!-- Row 2: 2 Wide Items -->
                <div class="haya-features-row bottom">

                    <div class="haya-feature-card wide">
                        <div class="haya-feature-icon-circle">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <div class="haya-feature-text">
                            <strong>عروض حصرية للأعضاء</strong>
                            <span>عروض أسبوعية أو شهرية متاحة حصرياً لأعضاء حيا "الأوائل" فقط</span>
                        </div>
                    </div>
                    <div class="haya-feature-card wide">
                        <div class="haya-feature-icon-circle">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <div class="haya-feature-text">
                            <strong>قائمة أولوية للمنتجات غير المتوفرة</strong>
                            <span>إضافة العضو إلى قائمة إشعار فوري على WhatsApp عند توفر المنتجات غير المتاحة (Out of Stock Priority List)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Terms & Conditions Section -->
    <section class="haya-partners-terms">
        <div class="haya-terms-container">
            <h2 class="haya-terms-main-title">الشروط والأحكام الخاصة بعضوية الأوائل</h2>

            <div class="haya-terms-grid">
                <!-- Row 1 -->
                <div class="haya-terms-row">
                    <div class="haya-terms-row-subject">الصلاحية والتفعيل (غير قابلة للتجديد)</div>
                    <div class="haya-terms-row-content">
                        <div class="haya-term-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p>تسري صلاحية بطاقة العضوية لمدة <strong>ستة (6) أشهر</strong> فقط، تبدأ من تاريخ تفعيل البطاقة.</p>
                        </div>
                        <div class="haya-term-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p><strong>سياسة التجديد:</strong> هذه العضوية مخصصة لفترة محددة وهي <strong>غير قابلة للتجديد</strong> بنفس المزايا المجانية الحالية عند انتهائها. بعد انقضاء الستة أشهر، يمكن للعميل التقديم على باقات العضوية الجديدة المتوفرة في الصيدلية في حينه.</p>
                        </div>
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="haya-terms-row">
                    <div class="haya-terms-row-subject">الفحوصات والاستشارات المجانية</div>
                    <div class="haya-terms-row-content">
                        <div class="haya-term-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p>يحق للعضو أو أحد أفراد عائلته من حاملي البطاقة الحصول على <strong>فحص مجاني واحد شهرياً</strong>.</p>
                        </div>
                        <div class="haya-term-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p>يختار العضو خدمة واحدة فقط من بين: (<strong>Skin Analyzer / InBody / Hair Analyzer</strong>).</p>
                        </div>
                        <div class="haya-term-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p><strong>شرط عدم التراكم:</strong> <span class="text-underline">تسقط الاستفادة من الفحص الشهري بانتهاء الشهر التقويمي، ولا يحق للعضو المطالبة بالخدمات غير المستخدمة أو تدويرها للأشهر التالية.</span></p>
                        </div>
                        <div class="haya-term-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p>تخضع الفحوصات لتوفر الأجهزة والمواعيد المتاحة لدى الصيدلية.</p>
                        </div>
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="haya-terms-row">
                    <div class="haya-terms-row-subject">السياسة السعرية والخصومات</div>
                    <div class="haya-terms-row-content">
                        <div class="haya-term-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p><strong>الأدوية:</strong> التزاماً بالقوانين والأنظمة الصحية في العراق، تخضع جميع الأدوية لسياسة <strong>التسعيرة الجبرية</strong>، ولا يشملها أي نوع من أنواع الخصومات والعروض الترويجية تحت أي ظرف.</p>
                        </div>
                        <div class="haya-term-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p>تقتصر الخصومات على المستلزمات غير الدوائية (كالتجميل والمكملات الغذائية) التي تحددها إدارة الصيدلية حصراً.</p>
                        </div>
                    </div>
                </div>

                <!-- Row 4 -->
                <div class="haya-terms-row">
                    <div class="haya-terms-row-subject">خدمة التوصيل</div>
                    <div class="haya-terms-row-content">
                        <div class="haya-term-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p>توفر الصيدلية خدمة <strong>التوصيل المجاني</strong> للأعضاء داخل النطاق الجغرافي لمدينة <strong>بغداد</strong> حصراً.</p>
                        </div>
                        <div class="haya-term-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p><span class="text-underline">يحق للصيدلية تحديد حد أدنى لقيمة الطلبات للاستفادة من ميزة التوصيل المجاني.</span></p>
                        </div>
                    </div>
                </div>

                <!-- Row 5 -->
                <div class="haya-terms-row">
                    <div class="haya-terms-row-subject">التواصل والخصوصية</div>
                    <div class="haya-terms-row-content">
                        <div class="haya-term-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p>يقر العضو بموافقته الصريحة على استلام الرسائل الترويجية، العروض، والتحديثات الطبية عبر تطبيق واتساب (<strong>WhatsApp</strong>) أو أي من وسائل الاتصال المسجلة.</p>
                        </div>
                        <div class="haya-term-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p>تلتزم الصيدلية بالحفاظ على خصوصية بيانات العضو وعدم مشاركتها مع أي أطراف خارجية.</p>
                        </div>
                    </div>
                </div>

                <!-- Row 6 -->
                <div class="haya-terms-row">
                    <div class="haya-terms-row-subject">أحكام عامة</div>
                    <div class="haya-terms-row-content">
                        <div class="haya-term-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p><strong>تعديل الشروط:</strong> تحتفظ إدارة الصيدلية بالحق في تعديل أو تغيير أي من هذه الشروط والأحكام، أو تعديل باقة المزايا، مع إخطار الأعضاء بأي تغييرات جوهرية.</p>
                        </div>
                        <div class="haya-term-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p><strong>إساءة الاستخدام:</strong> يحق للصيدلية إلغاء العضوية فوراً في حال ثبوت إساءة استخدام البطاقة أو تقديم معلومات غير صحيحة.</p>
                        </div>
                        <div class="haya-term-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p><strong>الإخلاء من المسؤولية:</strong> الفحوصات المقدمة (<strong>InBody/Skin/Hair</strong>) هي فحوصات استرشادية، ولا تغني عن الاستشارة الطبية المتخصصة في الحالات المرضية.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Haya Section -->
    <section class="haya-partners-why">
        <div class="haya-why-container">
            <h2 class="haya-why-title">ليش تختار صيدلية حَيّا؟</h2>
            <div class="haya-why-grid">
                <div class="haya-why-item">
                    <div class="pt-why-icon-wrap-award">
                        <img src="<?= SITE_URL ?>/assets/images/award.svg" alt="Award" class="pt-why-icon-award">
                    </div> 
                    <span class="haya-why-text">صيدلانية مرخصة</span>
                </div>
                <div class="haya-why-item">
                    <div class="pt-why-icon-wrap">
                        <img src="<?= SITE_URL ?>/assets/images/gem.svg" alt="Gem" class="pt-why-icon">
                    </div> <span class="haya-why-text">أدوية مضمونة واصلية</span>
                </div>

                <div class="haya-why-item">
                    <div class="pt-why-icon-wrap">
                        <img src="<?= SITE_URL ?>/assets/images/user-icon.svg" alt="Direct Service" class="pt-why-icon">
                    </div>
                    <span class="haya-why-text">خدمة مباشرة بدون تعقيد</span>
                </div>

            </div>
        </div>
    </section>

    <!-- Ready to Order Section -->
    <section class="haya-partners-cta">
        <div class="haya-cta-container">
            <h2 class="haya-cta-title">جاهز تطلب؟</h2>
            <div class="haya-cta-buttons">
                <!-- Contact Button -->
                
                <!-- WhatsApp Button -->
                <a href="https://wa.link/11ohbt" target="_blank" class="haya-btn-cta-green">
                        <img src="<?= SITE_URL ?>/assets/images/sheet.svg" alt="Direct Service" class="pt-why-icon">
                    اطلب الآن عبر واتساب
                </a>
                <a href="tel:+9647700000000" class="haya-btn-cta-gold">
                        <img src="<?= SITE_URL ?>/assets/images/phone.svg" alt="Direct Service" class="pt-why-icon">
                    اتصل بالخط الساخن
                </a>
            </div>
        </div>
    </section>

    <!-- Partners Footer Bar -->
    <div class="haya-partners-footer-bar">
        <span>خدمتنا داخل بغداد فقط</span>
    </div>

</div>

<div id="regModal" class="reg-modal-overlay">
    <div class="reg-modal-content">
        <button id="modalClose" class="modal-close-btn" aria-label="Close">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

        <div id="modalFormWrap">
            <form id="regForm" method="POST" novalidate>
                <div class="modal-form-group">
                    <label class="modal-label">الاسم</label>
                    <input type="text" id="reg_name" name="reg_name" class="modal-input" placeholder="محمد" required>
                </div>

                <div class="modal-form-group">
                    <label class="modal-label">تاريخ الميلاد</label>
                    <input type="date" id="reg_dob" name="reg_dob" class="modal-input" placeholder="07/03/2000" required>
                </div>

                <div class="modal-form-group">
                    <label class="modal-label">رقم التليفون</label>
                    <input type="tel" id="reg_mobile" name="reg_mobile" class="modal-input" placeholder="+20 10xxxxxxxxx" required>
                </div>

                <div class="modal-form-group">
                    <label class="modal-label">ذكر/أنثى</label>
                    <div class="modal-select-wrap">
                        <select id="reg_gender" name="reg_gender" class="modal-input modal-select" required>
                            <option value="" disabled selected>اختر الجنس</option>
                            <option value="male">ذكر</option>
                            <option value="female">أنثى</option>
                        </select>
                    </div>
                </div>

                <div class="modal-btn-wrap">
                    <button type="submit" class="haya-btn-modal-submit">
                        <i class="fas fa-user-plus"></i>
                        سجل الآن
                    </button>
                </div>
            </form>
        </div>

        <div id="modalSuccess" class="success-message-wrap">
            <div class="success-top-content" style="text-align: right; padding-right: 9rem;">
                <h2 class="success-title">شكرا لك</h2>
                <div class="success-body-rows">
                    <p class="success-body-text">تم تسجيلك بنجاح في قائمة الانتظار لبطاقة الأوائل من صيدلية حيا.</p>
                    <p class="success-body-text">هذه البطاقة تمنح حامليها مزايا حصرية وعروض خاصة .</p>
                    <p class="success-body-text">سنقوم بالتواصل معك قريباً لإعلامك عند توفر البطاقة.</p>
                </div>
                <div class="success-footer-note">
                    شكراً لاهتمامك، ونتطلع لخدمتك قريباً 💚
                </div>
            </div>

            <div class="success-logos-row">
                <div class="success-logo-item">
                    <span>صيدلية حيا</span>
                </div>
                <div class="success-logo-item">
                    <span class="partner-text">شريكك لحياة صحية</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= SITE_URL ?>/assets/js/pioneers.js?v=0.01"></script>
</body>

</html>
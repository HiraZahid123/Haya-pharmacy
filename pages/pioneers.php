<?php
// pages/partners.php — Full Figma Rebuild (node 279-3835)
require_once __DIR__ . '/../config/config.php';
session_start();

$pageTitle = 'بطاقة الأوائل - صيدلية حيا';
$hideStandardHeader = true;
$extraCss = ['partner-2.css'];
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
                <p class="haya-hero-subtitle">كن من أوائل عملاء صيدلية حيا واحصل على بطاقة الأوائل التي صُممت لتمنحك مزايا حصرية وعروضًا خاصة.
                </p>

                <p class="haya-hero-subtitle">
                    تقديرًا لثقتك ووجودك معنا في بداية رحلتنا، ندعوك للتسجيل الآن والانضمام إلى قائمة الانتظار للاستفادة من الخصومات والخدمات المميزة عند افتتاح الصيدلية.
                </p>
                <a href="#" class="haya-btn-dark-green open-reg-modal">سجل الان</a>
            </div>
            <!-- Right: Visual -->
            <div class="haya-hero-visual">
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
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="5" x2="5" y2="19"></line><circle cx="6.5" cy="6.5" r="2.5"></circle><circle cx="17.5" cy="17.5" r="2.5"></circle></svg>
                        </div>
                        <div class="haya-feature-text">خصم إضافي 10% على المنتجات و الأجهزة (غير شامل الأدوية)</div>
                    </div>
                    <div class="haya-feature-card">
                        <div class="haya-feature-icon-circle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>
                        </div>
                        <div class="haya-feature-text">فحص مجاني شهري</div>
                    </div>
                    <div class="haya-feature-card">
                        <div class="haya-feature-icon-circle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                        </div>
                        <div class="haya-feature-text">توصيل مجاني</div>
                    </div>
                </div>
                <!-- Row 2: 2 Wide Items -->
                <div class="haya-features-row bottom">

                    <div class="haya-feature-card wide">
                        <div class="haya-feature-icon-circle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        </div>
                        <div class="haya-feature-text">
                            <strong>عروض حصرية للأعضاء</strong>
                            <span>عروض أسبوعية أو شهرية متاحة حصرياً لأعضاء حيا "الأوائل" فقط</span>
                        </div>
                    </div>
                    <div class="haya-feature-card wide">
                        <div class="haya-feature-icon-circle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
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
                            <img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Tick" class="haya-tick-icon">
                            <p>تسري صلاحية بطاقة العضوية لمدة <strong>ستة (6) أشهر</strong> فقط، تبدأ من تاريخ تفعيل البطاقة.</p>
                        </div>
                        <div class="haya-term-list-item">
                            <img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Tick" class="haya-tick-icon">
                            <p><strong>سياسة التجديد:</strong> هذه العضوية مخصصة لفترة محددة وهي <strong>غير قابلة للتجديد</strong> بنفس المزايا المجانية الحالية عند انتهائها. بعد انقضاء الستة أشهر، يمكن للعميل التقديم على باقات العضوية الجديدة المتوفرة في الصيدلية في حينه.</p>
                        </div>
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="haya-terms-row">
                    <div class="haya-terms-row-subject">الفحوصات والاستشارات المجانية</div>
                    <div class="haya-terms-row-content">
                        <div class="haya-term-list-item">
                            <img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Tick" class="haya-tick-icon">
                            <p>يحق للعضو أو أحد أفراد عائلته من حاملي البطاقة الحصول على <strong>فحص مجاني واحد شهرياً</strong>.</p>
                        </div>
                        <div class="haya-term-list-item">
                            <img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Tick" class="haya-tick-icon">
                            <p>يختار العضو خدمة واحدة فقط من بين: (<strong> فحص الشعر Hair analyzer - تحليل الجسم بجهاز Inbody - فحص البشرة Skin analyzer</strong>).</p>
                        </div>

                        <div class="haya-term-list-item">
                            <img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Tick" class="haya-tick-icon">
                            <p>تخضع الفحوصات لتوفر الأجهزة والمواعيد المتاحة لدى الصيدلية.</p>
                        </div>
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="haya-terms-row">
                    <div class="haya-terms-row-subject">السياسة السعرية والخصومات</div>
                    <div class="haya-terms-row-content">
                        <div class="haya-term-list-item">
                            <img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Tick" class="haya-tick-icon">
                            <p><strong>الأدوية:</strong> التزاماً بالقوانين والأنظمة الصحية في العراق، تخضع جميع الأدوية لسياسة <strong>التسعيرة الجبرية</strong>، ولا يشملها أي نوع من أنواع الخصومات والعروض الترويجية تحت أي ظرف.</p>
                        </div>
                        <div class="haya-term-list-item">
                            <img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Tick" class="haya-tick-icon">
                            <p>تقتصر الخصومات على المستلزمات غير الدوائية (كالتجميل والمكملات الغذائية) التي تحددها إدارة الصيدلية حصراً.</p>
                        </div>
                    </div>
                </div>

                <!-- Row 4 -->
                <div class="haya-terms-row">
                    <div class="haya-terms-row-subject">خدمة التوصيل</div>
                    <div class="haya-terms-row-content">
                        <div class="haya-term-list-item">
                            <img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Tick" class="haya-tick-icon">
                            <p>توفر الصيدلية خدمة <strong>التوصيل المجاني</strong> للأعضاء داخل النطاق الجغرافي لمدينة <strong>بغداد</strong> حصراً.</p>
                        </div>
                        <div class="haya-term-list-item">
                            <img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Tick" class="haya-tick-icon">
                            <p>يحق للصيدلية تحديد حد أدنى لقيمة الطلبات للاستفادة من ميزة التوصيل المجاني.</p>
                        </div>
                    </div>
                </div>

                <!-- Row 5 -->
                <div class="haya-terms-row">
                    <div class="haya-terms-row-subject">التواصل والخصوصية</div>
                    <div class="haya-terms-row-content">
                        <div class="haya-term-list-item">
                            <img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Tick" class="haya-tick-icon">
                            <p>يقر العضو بموافقته الصريحة على استلام الرسائل الترويجية، العروض، والتحديثات الطبية عبر تطبيق واتساب (<strong>WhatsApp</strong>) أو أي من وسائل الاتصال المسجلة.</p>
                        </div>
                        <div class="haya-term-list-item">
                            <img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Tick" class="haya-tick-icon">
                            <p>تلتزم الصيدلية بالحفاظ على خصوصية بيانات العضو وعدم مشاركتها مع أي أطراف خارجية.</p>
                        </div>
                    </div>
                </div>

                <!-- Row 6 -->
                <div class="haya-terms-row">
                    <div class="haya-terms-row-subject">أحكام عامة</div>
                    <div class="haya-terms-row-content">
                        <div class="haya-term-list-item">
                            <img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Tick" class="haya-tick-icon">
                            <p><strong>تعديل الشروط:</strong> تحتفظ إدارة الصيدلية بالحق في تعديل أو تغيير أي من هذه الشروط والأحكام، أو تعديل باقة المزايا، مع إخطار الأعضاء بأي تغييرات جوهرية.</p>
                        </div>
                        <div class="haya-term-list-item">
                            <img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Tick" class="haya-tick-icon">
                            <p><strong>إساءة الاستخدام:</strong> يحق للصيدلية إلغاء العضوية فوراً في حال ثبوت إساءة استخدام البطاقة أو تقديم معلومات غير صحيحة.</p>
                        </div>
                        <div class="haya-term-list-item">
                            <img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Tick" class="haya-tick-icon">
                            <p><strong>الإخلاء من المسؤولية:</strong> الفحوصات المقدمة (<strong> فحص الشعر Hair analyzer - تحليل الجسم بجهاز Inbody - فحص البشرة Skin analyzer</strong>) هي فحوصات استرشادية، ولا تغني عن الاستشارة الطبية المتخصصة في الحالات المرضية.</p>
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
                    اتصل بالخط السريع
                </a>
            </div>
        </div>
    </section>

    <!-- Partners Footer Bar -->
    <div class="haya-partners-footer-bar">
        <span>خدمتنا داخل بغداد فقط</span>
    </div>

</div>

<div id="regModal" class="pt-modal-overlay hide">
    <div class="pt-modal-content">
        <div id="modalFormWrap">
            <div class="pt-modal-header-pattern"></div>
            <form id="regForm" class="pt-register-form">
                <div class="pt-form-group">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <label for="reg_name" style="margin-bottom: 0;">الاسم</label>
                        <button type="button" class="pt-modal-close" id="modalClose" style="position: static; margin: 0; font-size: 2rem;">&times;</button>
                    </div>
                    <input type="text" id="reg_name" name="name" placeholder="محمد" required class="pt-form-control">
                    <span class="form-error" id="err_name"></span>
                </div>

                <div class="pt-form-group">
                    <label for="reg_dob">تاريخ الميلاد</label>
                    <input type="date" id="reg_dob" name="dob" placeholder="07/03/2000" required class="pt-form-control">
                    <span class="form-error" id="err_dob"></span>
                </div>

                <div class="pt-form-group">
                    <label for="reg_mobile">رقم التليفون</label>
                    <div class="haya-phone-input-group">
                        <div class="haya-phone-prefix">
                            <img src="<?= SITE_URL ?>/assets/images/iq-flag.png" alt="IQ" class="haya-flag-img">
                            <span class="haya-country-code">+964</span>
                        </div>
                        <input type="tel" id="reg_mobile" name="mobile" placeholder="7xx xxx xxxx" required class="pt-form-control haya-input-phone">
                    </div>
                    <span class="form-error" id="err_mobile"></span>
                </div>


                <div class="pt-form-group">
                    <label for="reg_gender">ذكر/أنثى</label>
                    <select id="reg_gender" name="gender" required class="pt-form-control pt-form-select">
                        <option value="" disabled selected>اختيار الجنس</option>
                        <option value="male">ذكر</option>
                        <option value="female">أنثى</option>
                    </select>
                    <span class="form-error" id="err_gender"></span>
                </div>

                <div id="globalError" class="global-error"></div>

                <button type="submit" class="pt-btn-submit">
                    <i class="fas fa-user-plus"></i>
                    سجل الان
                </button>
            </form>
        </div>

        <div id="modalSuccess" class="pt-modal-success hide">
            <div class="success-bg-ornament">
                <img src="<?= SITE_URL ?>/assets/images/partner-card.svg" alt="">
            </div>
            <div class="success-top-content">
                <div class="success-icon"><img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Success" style="width: 5rem; height: auto;"></div>
                <h2 class="success-title">تم تسجيلك بنجاح في قائمة الانتظار لبطاقة الأوائل من صيدلية حيا.

                <div class="success-body-rows">
                    <p class="success-body-text">هذه البطاقة تمنح حامليها مزايا حصرية وعروض خاصة عند افتتاح الصيدلية.</p>
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
            
            <div class="success-footer-btn">
                <button onclick="location.reload()" class="pt-btn-green" style="padding: 0.8rem 3rem; font-size: 1rem;">إغلاق</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= SITE_URL ?>/assets/js/pioneers.js?v=1.1"></script>
</body>

</html>
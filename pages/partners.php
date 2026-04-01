<?php
// pages/partners.php — Thank You Page for Al-Awaeil (REBUILT TO MATCH FIGMA)
require_once __DIR__ . '/../config/config.php';
session_start();

$pageTitle      = 'شكراً لك من صيدلية حيا';
$hideStandardHeader = true;
$extraCss       = ['partner-2.css'];
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
                <h1 class="haya-hero-title">إلى جيراننا في النجاح..<br>
                شركاء (حيا)<br>
                تحية طيبة من أسرة صيدلية حيا..</h1>
                <p class="haya-hero-subtitle">
                    نحن نؤمن بأن نجاح منطقتنا يبدأ من تعاوننا معاً. يسعدنا أن نُهديكم وعائلاتكم وموظفيكم "بطاقة شركاء حيا" الحصرية، كتقدير منا لجيراننا المميزين.
هذه البطاقة ليست مجرد عضوية، بل هي التزام منا بتقديم أفضل رعاية صحية وخدمات استشارية مجانية لجيراننا الأعزاء في الأعمال المجاورة.

<br>
</p>
<p class="haya-hero-subtitle">
    أهلا و مرحبا بك في أسرة  <span style="font-weight: bold; font-size: 1.2em;">صيدلية حيا</span>
</p>

                                <a href="#" class="haya-btn-dark-green open-reg-modal">فعّل البطاقة الآن</a>

            </div>
            <!-- Right: Visual -->
            <div class="haya-hero-visual">
                <img src="<?= SITE_URL ?>/assets/images/Group 1000004111.svg" alt="Health Symbol" class="haya-hero-health-symbol">
                <img src="<?= SITE_URL ?>/assets/images/partner-card.svg" alt="Pioneers Cards" class="pioneers-cards-visual">
            </div>
        </div>

        <!-- Features Integrated into Hero -->
        <div class="haya-hero-features">
            <h2 class="haya-hero-features-title">ميزات "الشر يك"</h2>
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
                        <div class="haya-feature-text">خصم إضافي 15% على المنتجات و الأجهزة</div>
                    </div>
                </div>
                <!-- Row 2: 2 Wide Items -->
                <div class="haya-features-row bottom">

                    <div class="haya-feature-card wide">
                        <div class="haya-feature-icon-circle">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <div class="haya-feature-text">
                            <p>
                                <span class="feature-title">عروض حصرية للأعضاء</span>
                                <span>عروض أسبوعية أو شهرية متاحة حصرياً لأعضاء حيا "الأوائل" فقط</span>
                            </p>
                        </div>
                    </div>
                    <div class="haya-feature-card wide">
                        <div class="haya-feature-icon-circle">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <div class="haya-feature-text">
                            <p>
                                <span class="feature-title">قائمة أولوية للمنتجات غير المتوفرة</span>
                                <span>إضافة العضو إلى قائمة إشعار فوري على WhatsApp عند توفر المنتجات غير المتاحة (Out of Stock Priority List)</span>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Terms & Conditions Section -->
    <section class="haya-partners-terms">
        <div class="haya-terms-container">
            <h2 class="haya-terms-main-title">الشروط والأحكام الخاصة بعضوية الشريك</h2>

            <div class="haya-terms-grid">
                <!-- Row 1 -->
                <div class="haya-terms-row">
                    <div class="haya-terms-row-subject">الصلاحية والتفعيل (غير قابلة للتجديد)</div>
                    <div class="haya-terms-row-content">
                        <div class="haya-term-list-item">
                            <img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Tick" class="haya-tick-icon">
                            <!-- <p>تسري صلاحية بطاقة العضوية لمدة <strong>ستة (6) أشهر</strong> فقط، تبدأ من تاريخ تفعيل البطاقة.</p> -->
                             <p>تسري صلاحية بطاقة العضوية لمدة <strong>اثني عشر  شهراً</strong> فقط، تبدأ من تاريخ تفعيل البطاقة.</p>
                        </div>
                        <div class="haya-term-list-item">
                            <img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Tick" class="haya-tick-icon">
                            <!-- <p><strong>سياسة التجديد:</strong> هذه العضوية مخصصة لفترة محددة وهي <strong>غير قابلة للتجديد</strong> بنفس المزايا المجانية الحالية عند انتهائها. بعد انقضاء الستة أشهر، يمكن للعميل التقديم على باقات العضوية الجديدة المتوفرة في الصيدلية في حينه.</p> -->
                             <p><strong>سياسة التجديد:</strong> هذه العضوية مخصصة لفترة محددة وهي <strong>غير قابلة للتجديد</strong> بنفس المزايا المجانية الحالية عند انتهائها. بعد انقضاء الستة أشهر، يمكن للعميل التقديم على باقات العضوية الجديدة المتوفرة في الصيدلية في حينها.</p>
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
                            <p>يختار العضو خدمة واحدة فقط من بين: (<strong>Skin Analyzer / InBody / Hair Analyzer</strong>).</p>
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
                            <p><strong>الإخلاء من المسؤولية:</strong> الفحوصات المقدمة (InBody/Skin/Hair) هي فحوصات استرشادية، ولا تغني عن الاستشارة الطبية المتخصصة في الحالات المرضية.</p>
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



<!-- ── Registration Modal ────────────────────────────────────────── -->
<div class="pt-modal-overlay" id="regModal">
    <div class="pt-modal-content">
        <!-- Close button moved to form head -->

        
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
                    <input type="tel" id="reg_mobile" name="mobile" placeholder="+964 7xx xxx xxxx" required class="pt-form-control">
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

                <div class="pt-form-group">
                    <label for="reg_id">رقم سري</label>
                    <input type="text" id="reg_id" name="secret_id" placeholder="372662897449" required class="pt-form-control">
                    <span class="form-error" id="err_id"></span>
                </div>

                <div id="globalError" class="global-error"></div>

                <button type="submit" class="pt-btn-submit">
                    <i class="fas fa-user-plus"></i>
                    فعل الآن
                </button>
            </form>
        </div>

        <div id="modalSuccess" class="pt-modal-success hide">
            <div class="success-top-content">
                <div class="success-icon"><img src="<?= SITE_URL ?>/assets/images/tick.svg" alt="Success" style="width: 5rem; height: auto;"></div>
                <h2 class="success-title">تم تفعيل كارت الشريك بنجاح</h2>
                
                <div class="success-body-rows">
                    <p class="success-body-text">يمكنك الآن الاستفادة من مزايا وخصومات كارت الشريك في صيدلية حيا.</p>
                    <p class="success-body-text">استخدم بطاقتك عند زيارتك للصيدلية للحصول على العروض والخدمات الحصرية.</p>
                    <p class="success-body-text">رقم بطاقتك الخاصة بالشركاء هو:</p>
                </div>

                <div class="success-card-num-wrap">
                    <div class="success-card-num" id="successCardNumber"></div>
                </div>

                <div class="success-footer-note">
                    نتطلع لخدمتك 💚
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

<script src="<?= SITE_URL ?>/assets/js/partners.js"></script>
</body>
</html>
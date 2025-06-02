<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام التأمين الذكي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Custom styles for chat widget */
        .chat-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .chat-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--gradient-primary);
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
            transition: all 0.3s ease;
        }

        .chat-button:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
        }

        .chat-modal {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 320px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: none;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(0);
            }
        }

        .chat-header {
            padding: 1rem;
            background: var(--gradient-primary);
            color: white;
            border-radius: 15px 15px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-messages {
            height: 300px;
            overflow-y: auto;
            padding: 1rem;
        }

        .chat-input {
            padding: 1rem;
            border-top: 1px solid #eee;
        }

        .chat-input input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 20px;
            margin-bottom: 0.5rem;
        }

        /* Hide raw CSS */
        .raw-css {
            display: none !important;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: var(--text-color);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://wallpaperbat.com/img/27381153-types-of-personal-insurance-coverage.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 150px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(44, 62, 80, 0.8), rgba(52, 73, 94, 0.8));
        }

        .hero-section h1 {
            font-size: 4rem;
            margin-bottom: 2rem;
            font-weight: 700;
            background: linear-gradient(45deg, #fff, #ffd700);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-section p {
            font-size: 1.5rem;
            margin-bottom: 3rem;
        }

        .cta-button {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 18px 40px;
            border-radius: 30px;
            font-weight: bold;
            text-decoration: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }

        /* Navigation */
        .navbar {
            background: rgba(255,255,255,0.95);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color) !important;
        }

        .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
            transition: color 0.3s ease;
            padding: 0.5rem 1rem;
        }

        .nav-link:hover {
            color: var(--accent-color) !important;
        }

        /* Insurance Types */
        .insurance-type {
            background: white;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .insurance-type:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        }

        .insurance-type img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .insurance-type:hover img {
            transform: scale(1.05);
        }

        .insurance-type h3 {
            margin: 20px 0 15px;
            color: var(--primary-color);
            font-weight: 600;
        }

        .insurance-type p {
            color: #666;
            line-height: 1.6;
        }

        /* Calculator Form */
        .form-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 25px rgba(0,0,0,0.1);
            padding: 40px;
            transition: transform 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 20px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .form-select {
            border-radius: 10px;
            padding: 12px 20px;
            border: 1px solid #e0e0e0;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        /* Result Card */
        .result-card {
            background: var(--light-bg);
            border-radius: 20px;
            padding: 25px;
            margin-top: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Animations */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="rtl">
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="header-info">
                        <div class="header-item">
                            <i class="fas fa-phone"></i>
                            <span>9200xxxxxxx</span>
                        </div>
                        <div class="header-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@smart-insurance.com</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="header-links">
                        <a href="#" class="header-link">
                            <i class="fas fa-user"></i>
                            <span class="rainbow-text">تسجيل الدخول</span>
                        </a>
                        <a href="#" class="header-link">
                            <i class="fas fa-user-plus"></i>
                            <span class="rainbow-text">إنشاء حساب</span>
                        </a>
                        <a href="#" class="header-link">
                            <i class="fas fa-language"></i>
                            <span class="rainbow-text">العربية</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/images/logo.png" alt="نظام التأمين الذكي" height="40">
                <span class="brand-text">نظام التأمين الذكي</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#services">أنواع التأمين</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#calculator">آلة حاسبة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#why-choose">لماذا نحن</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#digital-services">خدماتنا الإلكترونية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">آراء العملاء</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">اتصل بنا</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="hero-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="animate-fade-in">نظام التأمين الذكي</h1>
                        <p class="animate-fade-in">نقدم حلولاً تأمينية مبتكرة وخدمات رقمية متطورة</p>
                        <div class="hero-buttons">
                            <a href="#calculator" class="btn btn-primary btn-lg">
                                <i class="fas fa-calculator me-2"></i>
                                احسب قسطك
                            </a>
                            <a href="#contact" class="btn btn-outline-primary btn-lg ms-3">
                                <i class="fas fa-phone me-2"></i>
                                اتصل بنا
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        <img src="https://wallpaperbat.com/img/27381153-types-of-personal-insurance-coverage.jpg" alt="نظام التأمين الذكي" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Links Section -->
    <section class="quick-links py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="quick-link-card">
                        <div class="quick-link-icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <h4>تقديم طلب تأمين</h4>
                        <p>تقديم طلبات التأمين إلكترونياً</p>
                        <a href="#calculator" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>
                            ابدأ الآن
                        </a>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="quick-link-card">
                        <div class="quick-link-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h4>استعلام عن شهادة</h4>
                        <p>عرض تفاصيل شهادات التأمين</p>
                        <a href="#calculator" class="btn btn-success">
                            <i class="fas fa-arrow-left me-2"></i>
                            ابدأ الآن
                        </a>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="quick-link-card">
                        <div class="quick-link-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h4>تواصل معنا</h4>
                        <p>خدمة العملاء على مدار الساعة</p>
                        <a href="#contact" class="btn btn-info">
                            <i class="fas fa-arrow-left me-2"></i>
                            ابدأ الآن
                        </a>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="quick-link-card">
                        <div class="quick-link-icon">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <h4>الأسئلة الشائعة</h4>
                        <p>إجابات على أهم الأسئلة</p>
                        <a href="#faq" class="btn btn-warning">
                            <i class="fas fa-arrow-left me-2"></i>
                            ابدأ الآن
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">الأسئلة الشائعة</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            ما هي أنواع التأمين المتاحة؟
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <p>نقدم عدة أنواع من التأمين بما في ذلك تأمين الحياة، تأمين الصحة، تأمين السيارات، وتأمين المنازل.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            كيف يمكنني حساب قسط التأمين؟
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <p>يمكنك استخدام آلة حاسبة القسط المتاحة على موقعنا لحساب القسط بناءً على نوع التأمين ومعلوماتك الشخصية.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            ما هي مدة التغطية؟
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <p>تتراوح مدة التغطية من شهر إلى سنة حسب نوع التأمين ومتطلباتك.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Insurance Types Section -->
    <section id="insurance-types" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 animate-fade-in">أنواع التأمين المتاحة</h2>
            <div class="row justify-content-center">
                <!-- Life Insurance -->
                <div class="col-md-4 mb-4">
                    <div class="modern-card animate-fade-in">
                        <img src="assets/images/life-insurance.jpg" class="card-img-top" alt="تأمين الحياة">
                        <div class="modern-card-content">
                            <h5 class="card-title mb-3">تأمين الحياة</h5>
                            <p class="card-text">حماية مستقبلك وأسرتك مع تأمين الحياة الشامل</p>
                            <a href="#" class="btn btn-primary">اكتشف المزيد</a>
                        </div>
                    </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="modern-card text-center animate-fade-in">
                            <div class="modern-card-content">
                                <i class="fas fa-hand-holding-usd text-warning fs-1 mb-3"></i>
                                <h3>أسعار تنافسية</h3>
                                <p>نقدم أفضل الأسعار مع أفضل مستوى من الحماية</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Insurance Types Section -->
        <section id="insurance-types" class="py-5">
            <div class="container">
                <h2 class="text-center mb-5 animate-fade-in">أنواع التأمين المتاحة</h2>
                <div class="row justify-content-center">
                    <!-- Life Insurance -->
                    <div class="col-md-4 mb-4">
                        <div class="modern-card animate-fade-in">
                            <img src="assets/images/life-insurance.jpg" class="card-img-top" alt="تأمين الحياة">
                            <div class="modern-card-content">
                                <h5 class="card-title mb-3">تأمين الحياة</h5>
                                <p class="card-text">حماية مستقبلك وأسرتك مع تأمين الحياة الشامل</p>
                                <a href="#" class="btn btn-primary">اكتشف المزيد</a>
                            </div>
                        </div>
                    </div>
                    <!-- Home Insurance -->
                    <div class="col-md-4 mb-4">
                        <div class="modern-card animate-fade-in">
                            <img src="assets/images/home-insurance.png" class="card-img-top" alt="تأمين المنازل">
                            <div class="modern-card-content">
                                <h5 class="card-title mb-3">تأمين المنازل</h5>
                                <p class="card-text">حماية منزلك وأثاثك من المخاطر المختلفة</p>
                                <a href="#" class="btn btn-primary">اكتشف المزيد</a>
                            </div>
                        </div>
                    </div>
                    <!-- Health Insurance -->
                    <div class="col-md-4 mb-4">
                        <div class="modern-card animate-fade-in">
                            <img src="assets/images/health-insurance.png" class="card-img-top" alt="تأمين صحي">
                            <div class="modern-card-content">
                                <h5 class="card-title mb-3">تأمين صحي</h5>
                                <p class="card-text">حماية صحية شاملة لك ولعائلتك</p>
                                <a href="#" class="btn btn-primary">اكتشف المزيد</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="py-5">
            <div class="container">
                <h2 class="text-center mb-5" data-aos="fade-up">خدماتنا</h2>
                <div class="row">
                    <div class="col-md-4 mb-4 animate-on-scroll">
                        <div class="modern-card">
                            <div class="modern-card-content">
                                <i class="fas fa-shield-alt text-primary fs-1 mb-3"></i>
                                <h3>حماية شاملة</h3>
                                <p>نقدم حماية متكاملة لك ولعائلتك ضد جميع المخاطر المحتملة</p>
                                <ul class="service-details">
                                    <li>تأمين شامل ضد الحوادث</li>
                                    <li>حماية 24/7</li>
                                    <li>دعم فني متخصص</li>
                                    <li>استجابة سريعة</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 animate-on-scroll">
                        <div class="modern-card">
                            <div class="modern-card-content">
                                <i class="fas fa-clock text-success fs-1 mb-3"></i>
                                <h3>خدمة 24/7</h3>
                                <p>خدمة عملاء متاحة على مدار الساعة لمساعدتك في أي وقت</p>
                                <ul class="service-details">
                                    <li>دعم فني متخصص</li>
                                    <li>استجابة سريعة</li>
                                    <li>خدمة طوارئ</li>
                                    <li>دعم عبر تطبيقات الهواتف</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 animate-on-scroll">
                        <div class="modern-card">
                            <div class="modern-card-content">
                                <i class="fas fa-hand-holding-usd text-warning fs-1 mb-3"></i>
                                <h3>أسعار تنافسية</h3>
                                <p>نقدم أفضل الأسعار مع أفضل مستوى من الحماية</p>
                                <ul class="service-details">
                                    <li>أسعار تنافسية</li>
                                    <li>خطط مخصصة</li>
                                    <li>خصومات على التأمين الجماعي</li>
                                    <li>استرداد نقدي</li>
                                </ul>
                            </div>
                        </div>
                    </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="py-5">
            <div class="container">
                <h2 class="text-center mb-5" data-aos="fade-up"> آراء العملاء</h2>
                <div class="row">
                    <div class="col-md-4 mb-4 animate-on-scroll">
                        <div class="testimonial-card">
                            <div class="testimonial-avatar">
                                <img src="https://ui-avatars.com/api/?name=أحمد+محمد&background=0D6EFD&color=fff" alt="أحمد محمد">
                            </div>
                            <div class="testimonial-content">
                                <p class="testimonial-text">"خدمة ممتازة وفريق عمل محترف. ساعدوني في اختيار أفضل خطة تأمين."</p>
                                <div class="testimonial-info">
                                    <h4>أحمد محمد</h4>
                                    <p>مدير تنفيذي، شركة ABC</p>
                                    <div class="rating">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 animate-on-scroll">
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <div class="rating">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                </div>
                                <p class="testimonial-text">"خبرة ممتازة في مجال التأمين. ساعدوني في تقليل التكاليف مع الحفاظ على مستوى الحماية."</p>
                                <div class="testimonial-author">
                                    <img src="https://ui-avatars.com/api/?name=محمد+علي&background=0DCAF0&color=fff&size=128" alt="محمد علي" class="testimonial-image">
                                    <div class="author-info">
                                        <h4>محمد علي</h4>
                                        <p>مدير مالي - شركة DEF</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-5">
            <div class="container">
                <h2 class="text-center mb-5" data-aos="fade-up">📞 اتصل بنا</h2>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <p>9200xxxxxxx</p>
                            </div>
                            <div class="contact-item">
                                <i class="fab fa-whatsapp"></i>
                                <p>05xxxxxxx</p>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <p>info@smart-insurance.com</p>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-clock"></i>
                                <p>العمل على مدار الساعة</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form id="contactForm" class="contact-form">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" placeholder="الاسم" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="tel" class="form-control" placeholder="رقم الهاتف" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea class="form-control" rows="5" placeholder="استفسارك أو طلبك" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="cta-button w-100">
                                        <i class="fas fa-calendar-check me-2"></i>
                                        احجز استشارة مجانية
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Insurance Types Section -->
        <section id="services" class="py-5">
            <div class="container">
                <h2 class="text-center mb-5" data-aos="fade-up">خدماتنا</h2>
                <div class="row">
                    <div class="col-md-4 mb-4 animate-on-scroll">
                        <div class="insurance-type">
                            <div class="insurance-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <img src="https://th.bing.com/th/id/R.599260a9e5de9dd208fab409a6fbae0c?rik=QamKqc3db5v%2b4g&pid=ImgRaw&r=0" alt="تأمين الحياة" class="img-fluid mb-3">
                            <h3>💗 تأمين الحياة</h3>
                            <p class="mb-2">حماية مالية عند الوفاة أو العجز</p>
                            <p class="mb-2">خطط تأمين متنوعة تناسب جميع الفئات</p>
                            <p class="mb-2">تعويضات سريعة وموثوقة</p>
                            <a href="#calculator" class="btn btn-primary">
                                <i class="fas fa-calculator me-2"></i>
                                احسب قسطك
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4 animate-on-scroll">
                        <div class="insurance-type">
                            <div class="insurance-icon">
                                <i class="fas fa-hospital"></i>
                            </div>
                            <img src="https://images4.alphacoders.com/137/thumb-1920-1377871.png" alt="تأمين صحي" class="img-fluid mb-3">
                            <h3>🏥 تأمين صحي</h3>
                            <p class="mb-2">تغطية صحية شاملة</p>
                            <p class="mb-2">العلاج والرعاية على مدار الساعة</p>
                            <p class="mb-2">خدمات طبية متخصصة</p>
                            <a href="#calculator" class="btn btn-success">
                                <i class="fas fa-calculator me-2"></i>
                                احسب قسطك
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4 animate-on-scroll">
                        <div class="insurance-type">
                            <div class="insurance-icon">
                                <i class="fas fa-car"></i>
                            </div>
                            <img src="https://www.quoteinspector.com/media/car-insurance/car-insurance-21684592354.jpg" alt="تأمين السيارات" class="img-fluid mb-3">
                            <h3>🚗 تأمين السيارات</h3>
                            <p class="mb-2">حماية شاملة ضد الحوادث والسرقة</p>
                            <p class="mb-2">خدمة المساعدة على الطريق</p>
                            <p class="mb-2">تقييم فوري للحوادث</p>
                            <a href="#calculator" class="btn btn-warning">
                                <i class="fas fa-calculator me-2"></i>
                                احسب قسطك
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4 animate-on-scroll">
                        <div class="insurance-type">
                            <div class="insurance-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <img src="https://vmbs.com.au/wp-content/uploads/2022/12/Home-insurance-1024x682.png" alt="تأمين المنازل" class="img-fluid mb-3">
                            <h3>🏠 تأمين المنازل</h3>
                            <p class="mb-2">حماية من المخاطر الطبيعية</p>
                            <p class="mb-2">تغطية ممتلكاتك الشخصية</p>
                            <p class="mb-2">صيانة وترميم سريع</p>
                            <a href="#calculator" class="btn btn-info">
                                <i class="fas fa-calculator me-2"></i>
                                احسب قسطك
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4 animate-on-scroll">
                        <div class="insurance-type">
                            <div class="insurance-icon">
                                <i class="fas fa-balance-scale"></i>
                            </div>
                            <img src="https://th.bing.com/th/id/OIP.u3TrYLpUN-v5R33y0B3E7AAAAA?w=400&h=173&rs=1&pid=ImgDetMain" alt="تأمين ضد الغير" class="img-fluid mb-3">
                            <h3>⚖️ تأمين ضد الغير</h3>
                            <p class="mb-2">تغطية المسؤولية المدنية</p>
                            <p class="mb-2">دعم قانوني متكامل</p>
                            <p class="mb-2">حماية من التزامات الغير</p>
                            <a href="#calculator" class="btn btn-danger">
                                <i class="fas fa-calculator me-2"></i>
                                احسب قسطك
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4 animate-on-scroll">
                        <div class="insurance-type">
                            <div class="insurance-icon">
                                <i class="fas fa-plane"></i>
                            </div>
                            <img src="https://wallpapers.com/images/hd/aeroplane-pictures-c5vb2yx6uwmis3xs.jpg" alt="تأمين السفر" class="img-fluid mb-3">
                            <h3>✈️ تأمين السفر</h3>
                            <p class="mb-2">حماية شاملة أثناء السفر</p>
                            <p class="mb-2">الدعم الطبي والقانوني</p>
                            <p class="mb-2">مساعدة طارئة على مدار الساعة</p>
                            <a href="#calculator" class="btn btn-secondary">
                                <i class="fas fa-calculator me-2"></i>
                                احسب قسطك
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Insurance Types Section -->
        <section id="insurance-types" class="py-5">
            <div class="container">
                <h2 class="text-center mb-5" data-aos="fade-up">أنواع التأمين المتاحة</h2>
                <div class="row justify-content-center">
                    <!-- Life Insurance -->
                    <div class="col-md-4 mb-4">
                        <div class="card insurance-card" data-aos="fade-up">
                            <img src="assets/images/life-insurance.jpg" class="card-img-top" alt="تأمين الحياة">
                            <div class="card-body">
                                <h5 class="card-title mb-3">تأمين الحياة</h5>
                                <p class="card-text">حماية مستقبلك وأسرتك مع تأمين الحياة الشامل</p>
                                <a href="#" class="btn btn-primary">اكتشف المزيد</a>
                            </div>
                        </div>
                    </div>
                    <!-- Home Insurance -->
                    <div class="col-md-4 mb-4">
                        <div class="card insurance-card" data-aos="fade-up" data-aos-delay="100">
                            <img src="assets/images/home-insurance.png" class="card-img-top" alt="تأمين المنازل">
                            <div class="card-body">
                                <h5 class="card-title mb-3">تأمين المنازل</h5>
                                <p class="card-text">حماية منزلك وأثاثك من المخاطر المختلفة</p>
                                <a href="#" class="btn btn-primary">اكتشف المزيد</a>
                            </div>
                        </div>
                    </div>
                    <!-- Health Insurance -->
                    <div class="col-md-4 mb-4">
                        <div class="card insurance-card" data-aos="fade-up" data-aos-delay="200">
                            <img src="assets/images/health-insurance.png" class="card-img-top" alt="تأمين صحي">
                            <div class="card-body">
                                <h5 class="card-title mb-3">تأمين صحي</h5>
                                <p class="card-text">حماية صحية شاملة لك ولعائلتك</p>
                                <a href="#" class="btn btn-primary">اكتشف المزيد</a>
                            </div>
                        </div>
                    </div>
                    <!-- Travel Insurance -->
                    <div class="col-md-4 mb-4">
                        <div class="card insurance-card" data-aos="fade-up" data-aos-delay="300">
                            <img src="assets/images/travel-insurance.jpg" class="card-img-top" alt="تأمين السفر">
                            <div class="card-body">
                                <h5 class="card-title mb-3">تأمين السفر</h5>
                                <p class="card-text">حماية متكاملة أثناء رحلاتك</p>
                                <a href="#" class="btn btn-primary">اكتشف المزيد</a>
                            </div>
                        </div>
                    </div>
                    <!-- Third Party Insurance -->
                    <div class="col-md-4 mb-4">
                        <div class="card insurance-card" data-aos="fade-up" data-aos-delay="400">
                            <img src="assets/images/third-party-insurance.jpg" class="card-img-top" alt="تأمين ضد الغير">
                            <div class="card-body">
                                <h5 class="card-title mb-3">تأمين ضد الغير</h5>
                                <p class="card-text">حماية من المسؤولية المدنية</p>
                                <a href="#" class="btn btn-primary">اكتشف المزيد</a>
                            </div>
                        </div>
                    </div>
                    <!-- Car Insurance -->
                    <div class="col-md-4 mb-4">
                        <div class="card insurance-card" data-aos="fade-up" data-aos-delay="500">
                            <img src="assets/images/car-insurance.jpg" class="card-img-top" alt="تأمين السيارات">
                            <div class="card-body">
                                <h5 class="card-title mb-3">تأمين السيارات</h5>
                                <p class="card-text">حماية شاملة لسيارتك</p>
                                <a href="#" class="btn btn-primary">اكتشف المزيد</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="footer-title">معلومات الاتصال</h4>
                        <div class="footer-content">
                            <p><i class="fas fa-phone"></i> +966 123 456 789</p>
                            <p><i class="fas fa-envelope"></i> info@insurance.com</p>
                            <p><i class="fas fa-map-marker-alt"></i> الرياض، المملكة العربية السعودية</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4 class="footer-title">روابط سريعة</h4>
                        <div class="footer-links">
                            <a href="#home">الرئيسية</a>
                            <a href="#calculator">الآلة الحاسبة</a>
                            <a href="#insurance-types">أنواع التأمين</a>
                            <a href="#contact">اتصل بنا</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4 class="footer-title">تابعنا</h4>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-whatsapp"></i> واتساب</a>
                            <a href="#"><i class="fab fa-twitter"></i> تويتر</a>
                            <a href="#"><i class="fab fa-facebook"></i> فيسبوك</a>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <p class="text-muted">&copy; <?php echo date('Y'); ?> نظام التأمين الذكي. جميع الحقوق محفوظة.</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Calculator Section -->
        <section id="calculator" class="py-5">
            <div class="container">
                <h2 class="text-center mb-5" data-aos="fade-up">احسب قسطك الآن</h2>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="modern-card">
                            <div class="modern-card-content">
                                <div class="calculator-info text-center">
                                    <p>احسب قسط التأمين الخاص بك بسهولة وسرعة</p>
                                    <a href="#contact" class="cta-button">احجز موعد استشاري</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 animate-on-scroll">
                        <h2>عن الشركة</h2>
                        <p>نحن شركة متخصصة في تقديم حلول تأمين متكاملة تلبي احتياجات عملائنا. نحن نسعى لتحقيق أعلى مستويات الرضا من خلال خدماتنا المتميزة والموثوقة.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check-circle text-primary"></i> خبرة أكثر من 10 سنوات</li>
                            <li><i class="fas fa-check-circle text-primary"></i> فريق متخصص ومحترف</li>
                            <li><i class="fas fa-check-circle text-primary"></i> خدمات مخصصة لكل عميل</li>
                        </ul>
                    </div>
                    <div class="col-md-6 animate-on-scroll">
                        <img src="https://wallpaperbat.com/img/27381153-types-of-personal-insurance-coverage.jpg" 
                             class="img-fluid rounded" 
                             alt="عن الشركة">
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-5">
            <div class="container">
                <h2 class="text-center mb-5" data-aos="fade-up">اتصل بنا</h2>
                <div class="row justify-content-center">
                    <div class="col-md-8 animate-on-scroll">
                        <div class="card">
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">الاسم</label>
                                        <input type="text" class="form-control" id="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">البريد الإلكتروني</label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">رقم الهاتف</label>
                                        <input type="tel" class="form-control" id="phone" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">الرسالة</label>
                                        <textarea class="form-control" id="message" rows="5" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">إرسال</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-light py-4 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h5>نظام التأمين الذكي</h5>
                        <p>نحن نقدم حلول تأمين متكاملة لحماية أصولك ومستقبلك.</p>
                    </div>
                    <div class="col-md-4">
                        <h5>روابط سريعة</h5>
                        <ul class="list-unstyled">
                            <li><a href="#home" class="text-dark">الرئيسية</a></li>
                            <li><a href="#calculator" class="text-dark">الآلة الحاسبة</a></li>
                            <li><a href="#insurance-types" class="text-dark">أنواع التأمين</a></li>
                            <li><a href="#contact" class="text-dark">اتصل بنا</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>اتصل بنا</h5>
                        <p><i class="fas fa-phone"></i> +966 123 456 789</p>
                        <p><i class="fas fa-envelope"></i> info@insurance.com</p>
                        <p><i class="fas fa-map-marker-alt"></i> الرياض، المملكة العربية السعودية</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Chat Widget -->
        <div id="chatModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">دردشة معنا</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="chatMessages"></div>
                        <input type="text" id="userMessage" placeholder="اكتب رسالتك...">
                        <button id="sendButton" onclick="sendMessage()">إرسال</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript Dependencies -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>                                <h4>نتيجة الحساب</h4>
                                <p>القسط الشهري: ${data.premium} ريال</p>
                                <p>التوصية: ${data.recommendation}</p>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    const resultDiv = document.getElementById('result');
                    resultDiv.innerHTML = `<div class="alert alert-danger">حدث خطأ أثناء الحساب. يرجى المحاولة مرة أخرى.</div>`;
                });
            });

            // Contact form submission
            document.querySelector('#contact form').addEventListener('submit', function(e) {
                e.preventDefault();
                // Add contact form submission logic here
                alert('تم إرسال رسالتك بنجاح!');
            });
        </script>
    </body>
</html>

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title id="page-title">ارض السمر</title>
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="lang.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <nav class="main-nav">
      <ul>
        <li><a href="home.php" id="nav-home">الرئيسية</a></li>
        <li><a href="services.php" id="nav-services">خدمات</a></li>
        <li><a href="help.php" id="nav-help">مساعدة</a></li>
        <li><a href="blog.php" id="nav-blog">مدونة</a></li>
        <li><a href="about.php" id="nav-about">من نحن</a></li>
      </ul>
      <div class="lang-switch">
        <a href="#" onclick="setLang('ar'); return false;" id="ar-btn">العربية</a>
        <span> | </span>
        <a href="#" onclick="setLang('en'); return false;" id="en-btn">ENG</a>
      </div>
      <?php if (isset($_SESSION['user_id'])): ?>
        <span style="color:white; margin-left:15px;" id="welcome-msg">مرحباً،</span> <span style="color:white; margin-left:5px;" id="user-name"><?php echo htmlspecialchars($_SESSION['user_name'] ?? $_SESSION['user']); ?></span>
        <a href="logout.php" class="logout-btn" id="logout-btn">تسجيل الخروج</a>
      <?php else: ?>
        <a href="login.php" class="login-btn" id="nav-login">تسجيل دخول</a>
        <a href="register.php" class="register-btn" id="nav-register">تسجيل</a>
      <?php endif; ?>
    </nav>
  </header>

  <section class="hero">
  <h1 id="help-title">مساعدة</h1>
  <p id="help-desc">هنا تجد إجابات لأكثر الأسئلة شيوعاً ودليل استخدام الموقع.</p>
</section>

<section class="long-text">
  <h2 id="faq-title">الأسئلة الشائعة</h2>
  <ul>
    <li id="faq-q1"><strong>كيف أسجل في الموقع؟</strong> يمكنك التسجيل عبر الضغط على زر "تسجيل" في الأعلى وملء البيانات المطلوبة.</li>
    <li id="faq-q2"><strong>هل يمكنني إضافة أماكن سياحية؟</strong> حالياً يمكنك فقط تصفح الأماكن، وسنضيف ميزة الإضافة قريباً.</li>
    <li id="faq-q3"><strong>كيف أتواصل مع الدعم؟</strong> يمكنك مراسلتنا عبر صفحة "من نحن" أو البريد الإلكتروني الظاهر هناك.</li>
  </ul>
  <h2 id="guide-title">دليل الاستخدام</h2>
  <p id="guide-desc">
    تصفح الأقسام من القائمة الرئيسية، شاهد الصور والفيديوهات، واقرأ المعلومات عن كل منطقة سياحية. إذا واجهت أي مشكلة يمكنك العودة لهذه الصفحة أو التواصل معنا.
  </p>
</section>

<footer>
  <span id="footer-text">جميع الحقوق محفوظة &copy; ارض السمر 2025</span>
</footer>
</body>
</html>
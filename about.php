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
    <img src="images/Image.png" alt="ارض السمر" id="hero-img">
    <h1 id="about-title">من نحن</h1>
    <p id="about-desc">
      نحن في <strong>ارض السمر</strong> نسعى لتقديم أفضل تجربة سياحية في السودان من خلال توفير معلومات دقيقة، حجوزات سهلة، وجولات منظمة لأجمل المناطق الطبيعية والتاريخية.<br>
      فريقنا يضم خبراء في السياحة والسفر، ونعمل دائماً على تطوير خدماتنا لتلبية تطلعاتكم وجعل رحلتكم أكثر راحة وأماناً.
    </p>
  </section>

  <section class="features">
    <div class="feature">
      <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="رؤيتنا">
      <h3 id="vision-title">رؤيتنا</h3>
      <p id="vision-desc">أن نكون الوجهة الأولى للسياحة في السودان ونساهم في إبراز جمال وتاريخ بلادنا للعالم.</p>
    </div>
    <div class="feature">
      <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="رسالتنا">
      <h3 id="mission-title">رسالتنا</h3>
      <p id="mission-desc">تقديم خدمات سياحية عالية الجودة وتسهيل تجربة السفر لكل زائر ومقيم.</p>
    </div>
    <div class="feature">
      <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" alt="قيمنا">
      <h3 id="values-title">قيمنا</h3>
      <p id="values-desc">الشفافية، الجودة، الأمانة، والابتكار في كل ما نقدمه من خدمات.</p>
    </div>
  </section>

  <footer>
    <span id="footer-text">جميع الحقوق محفوظة © 2025 ارض السمر</span>
  </footer>
</body>
</html>
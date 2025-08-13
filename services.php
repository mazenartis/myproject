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

 <!-- ...existing code... -->
<div class="feature">
  <img src="d1.jpeg" alt="فندق النيل الأزرق">
  <h3 id="hotel1-title">فندق النيل الأزرق</h3>
  <p id="hotel1-desc">
    يقع في قلب الخرطوم ويتميز بغرف واسعة وإطلالة رائعة على النيل. يوفر خدمة واي فاي مجانية، مطعم شرقي، ومسبح خارجي.
  </p>
  <ul>
    <li id="hotel1-feature1">واي فاي مجاني</li>
    <li id="hotel1-feature2">مسبح</li>
    <li id="hotel1-feature3">قريب من المعالم السياحية</li>
  </ul>
  <a href="booking.php" class="btn" id="hotel1-btn">احجز في هذا الفندق</a>
</div>
<div class="feature">
  <img src="images/hotel2.jpg" alt="فندق السلام روتانا">
  <h3 id="hotel2-title">فندق السلام روتانا</h3>
  <p id="hotel2-desc">
    فندق خمس نجوم في الخرطوم، يقدم غرف فاخرة، مركز لياقة بدنية، ومطاعم عالمية. مناسب للعائلات ورجال الأعمال.
  </p>
  <ul>
    <li id="hotel2-feature1">خدمة غرف 24 ساعة</li>
    <li id="hotel2-feature2">مركز أعمال</li>
    <li id="hotel2-feature3">مواقف سيارات مجانية</li>
  </ul>
  <a href="booking.php" class="btn" id="hotel2-btn">احجز في هذا الفندق</a>
</div>
<!-- ...existing code... -->
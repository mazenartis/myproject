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
    <h1 id="blog-title">مدونة ارض السمر</h1>
    <p id="blog-desc">تابع أحدث المقالات والنصائح حول السياحة في السودان وأجمل الوجهات.</p>
  </section>

  <section class="long-text">
    <h2 id="latest-articles-title">أحدث المقالات</h2>
    <article>
      <h3 id="article1-title">أفضل 5 أماكن سياحية في السودان</h3>
      <p id="article1-desc">
        السودان يزخر بالعديد من الأماكن السياحية الرائعة مثل أهرامات مروي، سواكن، جبل مرة، شواطئ البحر الأحمر، وحدائق سنار. اكتشف معنا تفاصيل كل مكان ولماذا ننصحك بزيارته!
      </p>
    </article>
    <article>
      <h3 id="article2-title">نصائح هامة قبل السفر إلى السودان</h3>
      <p id="article2-desc">
        تعرف على أهم النصائح التي ستجعل رحلتك أكثر أماناً ومتعة، من اختيار الوقت المناسب للسفر، إلى التعامل مع السكان المحليين، وأفضل طرق التنقل.
      </p>
    </article>
    <article>
      <h3 id="article3-title">تجربة ضيافة سودانية أصيلة</h3>
      <p id="article3-desc">
        الضيافة السودانية معروفة عالمياً. في هذا المقال نشاركك بعض القصص والتجارب مع أهل السودان الكرماء، وأشهر الأطباق التي يجب أن تجربها.
      </p>
    </article>
  </section>

  <footer>
    <span id="footer-text">جميع الحقوق محفوظة © 2025 ارض السمر</span>
  </footer>
</body>
</html>
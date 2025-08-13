<?php
session_start();

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "❌ هذا الإيميل مستخدم من قبل.";
    } else {
        $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', 'user')";
        if (mysqli_query($conn, $query)) {
            header("Location: login.php");
            exit;
        } else {
            echo "❌ خطأ في التسجيل.";
        }
    }
}
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
<section class="hero">
  <img src="images/Image.png" alt="ارض السمر" id="hero-img">
  <h1 id="register-title">تسجيل حساب جديد</h1>
  <p id="register-desc1">أنشئ حسابك الآن للاستفادة من جميع خدمات ارض السمر.</p>
  <span id="register-desc2">تسجيل الدخول سهل وسريع. املأ المعلومات أدناه وابدأ رحلتك معنا</span>

  <form action="" method="POST" class="register-form">
    <label for="name" id="label-name">الاسم الكامل</label>
    <input type="text" id="name" name="name" required>
    <label for="email" id="label-email">البريد الإلكتروني</label>
    <input type="email" id="email" name="email" required>
    <label for="password" id="label-password">كلمة المرور</label>
    <input type="password" id="password" name="password" required>
    <button type="submit" name="submit" class="btn" id="register-btn">تسجيل</button>
    <span id="register-desc3">إذا كان لديك حساب بالفعل، يمكنك تسجيل الدخول من خلال الرابط أدناه.</span>
    <a href="login.php" id="login-btn">تسجيل الدخول</a>
  </form>
</section>

<footer>
  <span id="footer-text">جميع الحقوق محفوظة © 2025 ارض السمر</span>
</footer>
<!-- ...existing code... -->

</body>
</html>
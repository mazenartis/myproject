<?php
session_start();
include 'connect.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "الرجاء تعبئة جميع الحقول.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['user'] = $row['name'];
                $_SESSION['user_role'] = $row['role'];
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];

                // Redirect based on role
                if ($row['role'] === 'admin') {
                    header("Location: admin_dashboard.php");
                } else {
                    header("Location: home.php");
                }
                exit;
            } else {
                $error = "كلمة المرور غير صحيحة.";
            }
        } else {
            $error = "البريد الإلكتروني غير مسجل.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title id="page-title"> login </title>
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
    <img src="images/Image.png" alt="ارض السمر">
    <h1 id="login-title">تسجيل دخول</h1>
    <p id="login-desc1">ادخل بياناتك للوصول إلى حسابك والاستفادة من خدمات ارض السمر.</p>

    <!-- رسائل الخطأ -->
    <?php if (!empty($error)): ?>
      <p style="color: red; text-align: center; font-weight: bold;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" class="register-form">
      <label for="email" id="login-label-email">البريد الإلكتروني</label>
      <input type="email" id="email" name="email" required>

      <label for="password" id="login-label-password">كلمة المرور</label>
      <input type="password" id="password" name="password" required>

      <button type="submit" class="btn" id="login-btn">تسجيل دخول</button>
      <span id="login-desc2">ليس لديك حساب؟ </span><a href="register.php" id="register-link">سجل الآن</a>
    </form>
  </section>

  <footer>
    <span id="footer-text">جميع الحقوق محفوظة © 2025 ارض السمر</span>
  </footer>
</body>
</html>

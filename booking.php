<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// تفعيل عرض الأخطاء لتسهيل التصحيح (يمكن تعطيله لاحقاً)
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php'; // ملف الاتصال مع قاعدة البيانات (تعريف $conn)



// كود معالجة الحجز
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $destination = mysqli_real_escape_string($conn, $_POST['destination']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $nights = intval($_POST['nights']);
    $payment = mysqli_real_escape_string($conn, $_POST['payment']);
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO bookings (user_id, name, phone, destination, date, nights, payment)
              VALUES ('$user_id', '$name', '$phone', '$destination', '$date', $nights, '$payment')";

    if (mysqli_query($conn, $query)) {
        // إعداد رسالة ترحيب مخصصة
        $_SESSION['success_message'] = "مرحباً {$_SESSION['user_name']}، شكراً! تم الحجز بنجاح. سعيدون باختيارك أرض السمر ^_^";
        header("Location: home.php");
        exit;
    } else {
        echo "<div style='color:red; text-align:center;'>❌ حدث خطأ أثناء تنفيذ الحجز: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <title id="page-title">ارض السمر</title>
  <link rel="stylesheet" href="style.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="lang.js"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap"
    rel="stylesheet"
  />
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
    <h1 id="booking-title">حجز جديد</h1>
    <p id="booking-desc">املأ البيانات التالية لإتمام حجزك في ارض السمر.</p>
  </section>

  <section class="register-form">
    <form action="" method="POST">
      <label for="name" id="label-name">الاسم الكامل</label>
      <input type="text" id="name" name="name" required />

      <label for="phone" id="label-phone">رقم الهاتف</label>
      <input type="tel" id="phone" name="phone" required />

      <label for="destination" id="label-destination">الوجهة السياحية</label>
      <select id="destination" name="destination" required>
        <option value="بورسودان" data-translate-key="option-portsudan">بورسودان</option>
        <option value="مروى" data-translate-key="option-meroe">مروى</option>
        <option value="محمية الدندر" data-translate-key="option-dinder">محمية الدندر</option>
        <option value="جبل مره" data-translate-key="option-jablmarra">جبل مره</option>
      </select>

      <label for="date" id="label-date">تاريخ الوصول</label>
      <input type="date" id="date" name="date" required />

      <label for="nights" id="label-nights">عدد الليالي</label>
      <input type="number" id="nights" name="nights" min="1" required />

      <label for="payment" id="payment-method">طريقة الدفع</label>
      <select id="payment" name="payment" required>
        <option value="cash" id="option-cash" data-translate-key="option-cash">نقداً عند الوصول</option>
        <option value="bank" id="option-bank" data-translate-key="option-bank">تحويل بنكي</option>
        <option value="online" id="option-online" data-translate-key="option-online">دفع إلكتروني</option>
      </select>

      <button type="submit" class="btn" id="booking-btn">إرسال الحجز</button>
    </form>
  </section>

  <footer>
    <span id="footer-text">جميع الحقوق محفوظة © 2025 ارض السمر</span>
  </footer>
</body>
</html>

<?php
session_start();

include 'connect.php';

// تحقق من تسجيل الدخول وكون المستخدم أدمن
if (!isset($_SESSION['user']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    // echo "<p>دور المستخدم الحالي: " . htmlspecialchars($_SESSION['user_role'] ?? 'غير معرف') . "</p>";
    header("Location: login.php");
    exit;
}

// جلب كل الحجوزات
$query = "SELECT * FROM bookings ORDER BY date DESC";
$result = mysqli_query($conn, $query);

$destination_translation_keys = [
    "بورتسودان" => "option-portsudan",
    "بورسودان" => "option-portsudan",
    "محمية الدندر" => "option-dinder",
    "مروي" => "option-meroe",
    "مروى" => "option-meroe",
    "جبل مره" => "option-jablmarra",
];
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title id="page-title">لوحة تحكم الأدمن</title>
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
  <h2 class="center-text" id="admin-dashboard-title">لوحة تحكم الأدمن</h2>
  <p class="center-text margin-bottom-1rem">
    <a href="booking.php" class="btn btn-add-booking" id="add-booking-btn" data-translate-key="add-booking-btn">إضافة حجز جديد</a>
  </p>
  <table border="1" class="table-main">
    <tr class="table-header">
      <th id="th-name">الاسم</th>
      <th id="th-phone">الهاتف</th>
      <th id="th-destination">الوجهة</th>
      <th id="th-date">تاريخ الوصول</th>
      <th id="th-nights">عدد الليالي</th>
      <th id="th-payment">الدفع</th>
      <th id="th-cancelcancel-edit-booking">إلغاء الحجز و تعديل</th>
    </tr>
<?php while ($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?= htmlspecialchars($row['name']); ?></td>
        <td><?= htmlspecialchars($row['phone']); ?></td>
        <td><span data-translate-key="<?= $destination_translation_keys[$row['destination']] ?? 'option-unknown'; ?>"><?= htmlspecialchars($row['destination']); ?></span></td>
        <td><?= htmlspecialchars($row['date']); ?></td>
        <td><?= htmlspecialchars($row['nights']); ?></td>
        <td><span data-translate-key="option-<?= strtolower(str_replace(' ', '', $row['payment'])); ?>"><?= htmlspecialchars($row['payment']); ?></span></td>
        <td>
          <form action="cancel_booking.php" method="POST" onsubmit="return confirm('هل أنت متأكد أنك تريد إلغاء الحجز؟');" class="form-inline" style="margin-right:5px;">
            <input type="hidden" name="booking_id" value="<?= $row['id']; ?>">
            <input type="hidden" name="redirect" value="admin_dashboard">
            <button type="submit" class="btn-cancel" id="cancel-btn" data-translate-key="cancel-btn">إلغاء</button>
          </form>
          <a href="edit_booking.php?id=<?= $row['id']; ?>" class="btn-edit edit-btn" data-translate-key="edit-btn">تعديل</a>

        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>

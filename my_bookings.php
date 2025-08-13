<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM bookings WHERE user_id = $user_id ORDER BY date DESC";
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
  <title id="page-title">حجوزاتي</title>
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
  
  <h2 style="text-align:center;" id="my-bookings-title">حجوزاتي</h2>
  <table border="1" style="width:90%; margin:auto; text-align:center; border-collapse:collapse;">
    <tr style="background:#6b5437; color:white;">
      <th id="th-name">الاسم</th>
      <th id="th-phone">الهاتف</th>
      <th id="th-destination">الوجهة</th>
      <th id="th-date">تاريخ الوصول</th>
      <th id="th-nights">عدد الليالي</th>
      <th id="th-payment">طريقة الدفع</th>
      <th id="th-status">الحالة</th>
      <th id="th-actions">الإجراء</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?= htmlspecialchars($row['name']); ?></td>
        <td><?= htmlspecialchars($row['phone']); ?></td>
        <td><span data-translate-key="<?= $destination_translation_keys[$row['destination']] ?? 'option-unknown'; ?>"><?= htmlspecialchars($row['destination']); ?></span></td>
        <td><?= htmlspecialchars($row['date']); ?></td>
        <td><?= htmlspecialchars($row['nights']); ?></td>
        <td><span data-translate-key="option-<?= strtolower(str_replace(' ', '', $row['payment'])); ?>"><?= htmlspecialchars($row['payment']); ?></span></td>
        <td><span data-translate-key="<?php
          // Get the status value or default to 'نشط'
          $status = $row['status'] ?? 'نشط';
          
          // Map database status values to translation keys
          switch (strtolower(trim($status))) {
            case 'نشط':
            case 'active':
              echo 'status-active'; // This will work for both Arabic and English through lang.js
              break;
            case 'مكتمل':
            case 'completed':
              echo 'status-مكتمل'; // This will work for both Arabic and English through lang.js
              break;
            case 'ملغي':
            case 'cancelled':
              echo 'status-ملغي'; // This will work for both Arabic and English through lang.js
              break;
            default:
              echo 'status-active'; // Default to active status
          }
        ?>"><?= ($row['status'] ?? 'نشط'); ?></span></td>
        <td>
          <?php if (($row['status'] ?? 'نشط') == 'نشط'): ?>
            <form action="cancel_booking.php" method="POST" onsubmit="return confirm('هل أنت متأكد أنك تريد إلغاء الحجز؟');">
              <input type="hidden" name="booking_id" value="<?= $row['id']; ?>">
              <button type="submit" style="background:red; color:white; border:none; padding:5px 10px; border-radius:5px;" id="cancel-btn" data-translate-key="cancel-btn"></button>
            </form>
          <?php else: ?>
            <span style="color:green;" id="completed-text" data-translate-key="completed-text"></span>
          <?php endif; ?>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>

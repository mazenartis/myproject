<?php
session_start();
include 'connect.php';

// تحقق من تسجيل الدخول وكون المستخدم أدمن
if (!isset($_SESSION['user']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$booking_id = $_GET['id'] ?? null;
if (!$booking_id) {
    header("Location: admin_dashboard.php");
    exit;
}

$errors = [];
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // استقبال بيانات النموذج
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $destination = $_POST['destination'] ?? '';
    $date = $_POST['date'] ?? '';
    $nights = intval($_POST['nights'] ?? 0);
    $payment = $_POST['payment'] ?? '';
    $status = $_POST['status'] ?? '';

    // تحقق من صحة البيانات الأساسية (يمكن توسيعها حسب الحاجة)
    if (empty($name)) {
        $errors[] = "الاسم مطلوب.";
    }
    if (empty($phone)) {
        $errors[] = "الهاتف مطلوب.";
    }
    if (empty($destination)) {
        $errors[] = "الوجهة مطلوبة.";
    }
    if (empty($date)) {
        $errors[] = "تاريخ الوصول مطلوب.";
    }
    if ($nights <= 0) {
        $errors[] = "عدد الليالي يجب أن يكون أكبر من صفر.";
    }
    if (empty($payment)) {
        $errors[] = "معلومات الدفع مطلوبة.";
    }
    if (empty($status)) {
        $errors[] = "الحالة مطلوبة.";
    }

    if (empty($errors)) {
        // تحديث بيانات الحجز في قاعدة البيانات بدون حقل الحالة
        $stmt = $conn->prepare("UPDATE bookings SET name=?, phone=?, destination=?, date=?, nights=?, payment=?, status=? WHERE id=?");
        if ($stmt === false) {
            $errors[] = "❌ خطأ في تحضير الاستعلام: " . htmlspecialchars($conn->error);
        } else {
            $stmt->bind_param("ssssissi", $name, $phone, $destination, $date, $nights, $payment, $status, $booking_id);
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "✅ تم تحديث بيانات الحجز بنجاح.";
                header("Location: admin_dashboard.php");
                exit;
            } else {
                $errors[] = "❌ حدث خطأ أثناء تحديث بيانات الحجز.";
            }
            $stmt->close();
        }
    }
} else {
    // جلب بيانات الحجز الحالية لعرضها في النموذج
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE id=?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();
    $stmt->close();

    if (!$booking) {
        header("Location: admin_dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title id="page-title">تعديل بيانات الحجز</title>
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

<h2 class="center-text" id="edit-booking-title">تعديل بيانات الحجز</h2>

<?php if (!empty($errors)): ?>
    <div class="error-messages">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="edit_booking.php?id=<?= htmlspecialchars($booking_id) ?>" method="POST" class="register-form">
    <label for="name" id="label-name">الاسم:</label>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($booking['name'] ?? '') ?>" required>

    <label for="phone" id="label-phone">الهاتف:</label>
    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($booking['phone'] ?? '') ?>" required>

    <label for="destination" id="label-destination">الوجهة:</label>
    <input type="text" id="destination" name="destination" value="<?= htmlspecialchars($booking['destination'] ?? '') ?>" required>

    <label for="date" id="label-date">تاريخ الوصول:</label>
    <input type="date" id="date" name="date" value="<?= htmlspecialchars($booking['date'] ?? '') ?>" required>

    <label for="nights" id="label-nights">عدد الليالي:</label>
    <input type="number" id="nights" name="nights" min="1" value="<?= htmlspecialchars($booking['nights'] ?? '') ?>" required>

    <label for="payment" id="payment-method">الدفع:</label>
    <input type="text" id="payment" name="payment" value="<?= htmlspecialchars($booking['payment'] ?? '') ?>" required>

    <label for="status" id="label-status">الحالة:</label>
    <select id="status" name="status" required>
        <option value="نشط" <?= (isset($booking['status']) && $booking['status'] === 'نشط') ? 'selected' : '' ?> data-translate-key="status-active">نشط</option>
        <option value="مكتمل" <?= (isset($booking['status']) && $booking['status'] === 'مكتمل') ? 'selected' : '' ?> data-translate-key="status-completed">مكتمل</option>
        <option value="ملغي" <?= (isset($booking['status']) && $booking['status'] === 'ملغي') ? 'selected' : '' ?> data-translate-key="status-cancelled">ملغي</option>
    </select>

    <button type="submit" class="btn" id="update-booking-btn">تحديث الحجز</button>
</form>

<footer>
    <span id="footer-text">جميع الحقوق محفوظة © 2025 ارض السمر</span>
</footer>

</body>
</html>

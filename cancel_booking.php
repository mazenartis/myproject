<?php
session_start();
include 'connect.php';

// تحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// تأكد من أن الطلب جاء عبر POST ويحتوي على booking_id
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['booking_id'])) {
    $booking_id = intval($_POST['booking_id']);
    $user_id = $_SESSION['user_id'];
    $user_role = $_SESSION['user_role'] ?? '';

    if ($user_role === 'admin') {
        // الادمن يمكنه حذف أي حجز
        $delete = mysqli_query($conn, "DELETE FROM bookings WHERE id = $booking_id");
        if ($delete) {
            $_SESSION['success_message'] = "✅ تم حذف الحجز بنجاح.";
        } else {
            $_SESSION['success_message'] = "❌ حدث خطأ أثناء حذف الحجز.";
        }
    } else {
        // تحقق أن الحجز يخص المستخدم العادي
        $check = mysqli_query($conn, "SELECT * FROM bookings WHERE id = $booking_id AND user_id = $user_id");
        if (mysqli_num_rows($check) == 1) {
            $delete = mysqli_query($conn, "DELETE FROM bookings WHERE id = $booking_id AND user_id = $user_id");
            if ($delete) {
                $_SESSION['success_message'] = "✅ تم حذف الحجز بنجاح.";
            } else {
                $_SESSION['success_message'] = "❌ حدث خطأ أثناء حذف الحجز.";
            }
        } else {
            $_SESSION['success_message'] = "❌ لا يمكنك حذف هذا الحجز.";
        }
    }
} else {
    $_SESSION['success_message'] = "❌ طلب غير صالح.";
}

// إعادة التوجيه إلى الصفحة المناسبة بعد الحذف
$redirect = $_POST['redirect'] ?? '';
if ($redirect === 'admin_dashboard' && ($_SESSION['user_role'] ?? '') === 'admin') {
    header("Location: admin_dashboard.php");
} else {
    header("Location: my_bookings.php");
}
exit;

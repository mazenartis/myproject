<?php
session_start();
include 'connect.php';

// تحقق من صلاحية المستخدم كمدير
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $booking_id = intval($_GET['id']);
    $query = "DELETE FROM bookings WHERE id = $booking_id";
    if (mysqli_query($conn, $query)) {
        $_SESSION['success_message'] = "تم إلغاء الحجز بنجاح.";
    } else {
        $_SESSION['error_message'] = "حدث خطأ أثناء إلغاء الحجز: " . mysqli_error($conn);
    }
} else {
    $_SESSION['error_message'] = "لم يتم تحديد الحجز للإلغاء.";
}

header("Location: admin_dashboard.php");
exit;
?>

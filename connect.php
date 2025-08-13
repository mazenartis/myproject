<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "dbard";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("فشل الاتصال: " . mysqli_connect_error());
}

// ضبط الترميز للاتصال
mysqli_set_charset($conn, "utf8");
?>

<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "zarcafe_db";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("خطا در اتصال به دیتابیس: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>


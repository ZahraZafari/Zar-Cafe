<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$jobs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM job_applications"))['total'];
$franchise = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM franchise_requests"))['total'];
$contacts = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM contact_messages"))['total'];
$branches = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM branches"))['total'];
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت | زرکافه</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="admin-style.css">
</head>

<body class="admin-body">
    <div class="admin-container">
        <div class="admin-sidebar">
            <div class="logo-area">
                <img src="../images/logo.png" alt="زرکافه">
            </div>
            <a href="index.php" class="active">داشبورد</a>
            <a href="branches_admin.php">مدیریت شعب</a>
            <a href="products_admin.php">مدیریت محصولات</a>
            <a href="jobs_admin.php">درخواست استخدام</a>
            <a href="contacts_admin.php">پیام‌های تماس</a>
            <a href="franchise_admin.php">درخواست نمایندگی</a>
            <a href="logout.php" class="logout-link">خروج</a>
        </div>

        <div class="admin-content">
            <h1>خلاصه فعالیت‌ها</h1>

            <div class="admin-stats">
                <a href="jobs_admin.php" class="admin-stat-link">
                    <div class="admin-stat">
                        <h3>درخواست استخدام</h3>
                        <div><?php echo $jobs; ?></div>
                    </div>
                </a>
                <a href="franchise_admin.php" class="admin-stat-link">
                    <div class="admin-stat">
                        <h3>درخواست نمایندگی</h3>
                        <div><?php echo $franchise; ?></div>
                    </div>
                </a>
                <a href="contacts_admin.php" class="admin-stat-link">
                    <div class="admin-stat">
                        <h3>پیام‌های تماس</h3>
                        <div><?php echo $contacts; ?></div>
                    </div>
                </a>
                <a href="branches_admin.php" class="admin-stat-link">
                    <div class="admin-stat">
                        <h3>شعب فعال</h3>
                        <div><?php echo $branches; ?></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
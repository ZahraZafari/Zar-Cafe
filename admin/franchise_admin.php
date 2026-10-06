<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    mysqli_query($conn, "DELETE FROM franchise_requests WHERE id=$id");
    header("Location: franchise_admin.php");
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>درخواست نمایندگی | زرکافه</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="admin-style.css">
</head>

<body class="admin-body">
    <div class="admin-container">
        <div class="admin-sidebar">
            <div class="logo-area">
                <img src="../images/logo.png" alt="زرکافه">
            </div>
            <a href="index.php">داشبورد</a>
            <a href="branches_admin.php">مدیریت شعب</a>
            <a href="products_admin.php">مدیریت محصولات</a>
            <a href="jobs_admin.php">درخواست استخدام</a>
            <a href="contacts_admin.php">پیام‌های تماس</a>
            <a href="franchise_admin.php" class="active">درخواست نمایندگی</a>
            <a href="logout.php" class="logout-link">خروج</a>
        </div>

        <div class="admin-content">
            <h1>درخواست‌های نمایندگی</h1>

            <div class="admin-card">
                <h2>لیست تمام درخواست‌ها</h2>
                <table class="admin-table">
                    <tr>
                        <th>نام</th>
                        <th>تلفن</th>
                        <th>ایمیل</th>
                        <th>شهر هدف</th>
                        <th>توضیحات</th>
                        <th>تاریخ ثبت</th>
                        <th>عملیات</th>
                    </tr>
                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM franchise_requests ORDER BY id DESC");
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<tr>
                                <td><strong>" . htmlspecialchars($row['fullname']) . "</strong></td>
                                <td>" . htmlspecialchars($row['phone']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>" . htmlspecialchars($row['target_city']) . "</td>
                                <td style='max-width:200px;'>" . htmlspecialchars($row['description']) . "</td>
                                <td>" . htmlspecialchars($row['created_at']) . "</td>
                                <td><a href='?del={$row['id']}' class='admin-btn-danger' onclick='return confirm(\"حذف شود؟\")'>حذف</a></td>
                              </tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
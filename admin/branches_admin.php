<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $addr = mysqli_real_escape_string($conn, $_POST['addr']);
    $slug = str_replace(' ', '-', $name);
    mysqli_query($conn, "INSERT INTO branches (name, city, address, slug) VALUES ('$name', '$city', '$addr', '$slug')");
    header("Location: branches_admin.php");
}

if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    mysqli_query($conn, "DELETE FROM branches WHERE id=$id");
    header("Location: branches_admin.php");
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>مدیریت شعب | زرکافه</title>
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
            <a href="branches_admin.php" class="active">مدیریت شعب</a>
            <a href="products_admin.php">مدیریت محصولات</a>
            <a href="jobs_admin.php">درخواست استخدام</a>
            <a href="contacts_admin.php">پیام‌های تماس</a>
            <a href="franchise_admin.php">درخواست نمایندگی</a>
            <a href="logout.php" class="logout-link">خروج</a>
        </div>

        <div class="admin-content">
            <h1>مدیریت شعب</h1>

            <div class="admin-card">
                <h2>افزودن شعبه جدید</h2>
                <form method="post" class="admin-form-grid">
                    <input type="text" name="name" placeholder="نام شعبه" required>
                    <input type="text" name="city" placeholder="شهر" required>
                    <input type="text" name="addr" placeholder="آدرس دقیق" required>
                    <button type="submit" name="add" class="admin-btn-primary">ثبت شعبه</button>
                </form>
            </div>

            <div class="admin-card">
                <h2>لیست شعب</h2>
                <table class="admin-table">
                    <tr>
                        <th>نام شعبه</th>
                        <th>شهر</th>
                        <th>آدرس</th>
                        <th>عملیات</th>
                    </tr>
                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM branches ORDER BY id DESC");
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<tr>
                                <td>{$row['name']}</td>
                                <td>{$row['city']}</td>
                                <td>{$row['address']}</td>
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
<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $cat = mysqli_real_escape_string($conn, $_POST['category_id']);
    mysqli_query($conn, "INSERT INTO products (name, price, category_id) VALUES ('$name', '$price', '$cat')");
    header("Location: products_admin.php");
}

if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
    header("Location: products_admin.php");
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>مدیریت محصولات | زرکافه</title>
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
            <a href="products_admin.php" class="active">مدیریت محصولات</a>
            <a href="jobs_admin.php">درخواست استخدام</a>
            <a href="contacts_admin.php">پیام‌های تماس</a>
            <a href="franchise_admin.php">درخواست نمایندگی</a>
            <a href="logout.php" class="logout-link">خروج</a>
        </div>

        <div class="admin-content">
            <h1>مدیریت محصولات</h1>

            <div class="admin-card">
                <h2>افزودن محصول جدید</h2>
                <form method="post" class="admin-form-grid">
                    <input type="text" name="name" placeholder="نام محصول" required>
                    <input type="text" name="price" placeholder="قیمت (تومان)" required>
                    <select name="category_id" required>
                        <option value="">دسته‌بندی را انتخاب کنید</option>
                        <?php
                        $cats = mysqli_query($conn, "SELECT * FROM categories");
                        while ($c = mysqli_fetch_assoc($cats)) {
                            echo "<option value='{$c['id']}'>{$c['name']}</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" name="add" class="admin-btn-primary">ثبت محصول</button>
                </form>
            </div>

            <div class="admin-card">
                <h2>لیست محصولات</h2>
                <table class="admin-table">
                    <tr>
                        <th>نام محصول</th>
                        <th>قیمت</th>
                        <th>دسته‌بندی</th>
                        <th>عملیات</th>
                    </tr>
                    <?php
                    $res = mysqli_query($conn, "SELECT p.*, c.name as cat_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC");
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<tr>
                                <td>{$row['name']}</td>
                                <td>" . number_format($row['price']) . " تومان</td>
                                <td>{$row['cat_name']}</td>
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
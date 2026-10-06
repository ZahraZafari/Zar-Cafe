<?php
session_start();
include '../includes/db.php';

if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $res = mysqli_query($conn, "SELECT * FROM admins WHERE username='$user' AND password='$pass'");

    if (mysqli_num_rows($res) > 0) {
        $_SESSION['admin'] = $user;
        header("Location: index.php");
        exit();
    } else {
        $error = "نام کاربری یا رمز عبور اشتباه است.";
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>ورود مدیر | زرکافه</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="admin-login-page">
    <div class="admin-login-card">
        <h2>ورود به مدیریت</h2>
        <?php if (isset($error)): ?>
            <div class="admin-error-msg"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <input type="text" name="user" placeholder="نام کاربری" required>
            </div>
            <div class="form-group">
                <input type="password" name="pass" placeholder="رمز عبور" required>
            </div>
            <button type="submit" name="login" class="admin-btn-login">ورود به پنل</button>
        </form>
    </div>
</body>

</html>
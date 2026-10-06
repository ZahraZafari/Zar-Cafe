<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>زرکافه | طعم اصیل لحظه‌ها</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>

  <header class="header">
    <div class="container header__inner">

      <a class="brand" href="index.php" aria-label="صفحه اصلی">
        <img class="brand__logo" src="images/logo.png" alt="لوگوی زرکافه">
      </a>

      <nav class="nav" aria-label="منوی اصلی">
        <ul class="nav__list">
          <li><a class="nav__link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">خانه</a></li>
          <li><a class="nav__link <?php echo ($current_page == 'menu.php') ? 'active' : ''; ?>" href="menu.php">منو</a></li>
          <li><a class="nav__link <?php echo ($current_page == 'branches.php' || $current_page == 'branch-detail.php') ? 'active' : ''; ?>" href="branches.php">شعب</a></li>
          <li><a class="nav__link <?php echo ($current_page == 'jobs.php') ? 'active' : ''; ?>" href="jobs.php">استخدام</a></li>
          <li><a class="nav__link <?php echo ($current_page == 'feedback.php') ? 'active' : ''; ?>" href="feedback.php">انتقادات</a></li>
          <li><a class="nav__link <?php echo ($current_page == 'franchise.php') ? 'active' : ''; ?>" href="franchise.php">نمایندگی</a></li>
          <li><a class="nav__link <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>" href="about.php">درباره ما</a></li>

        </ul>
      </nav>

      <div class="header__cta">
        <a class="btn btn--primary" href="menu.php">مشاهده منو</a>
        <a class="btn btn--ghost" href="contact.php">تماس با ما</a>
      </div>

    </div>
  </header>

  <main class="main">
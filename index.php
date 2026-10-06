<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<section class="hero-full">
  <div class="hero-full__bg">
    <img src="images/home.png" alt="زرکافه - طعم اصیل">
  </div>

  <div class="container hero-full__container">
    <div class="hero-full__content">
      <span class="hero-full__badge">ZAR CAFE</span>
      <h1 class="hero-full__title">همان همیشگی، اما با طعمی زرین</h1>
      <p class="hero-full__text">
        تجربه‌ای متفاوت از قهوه و شیرینی در محیطی که برای شما طراحی شده است.
      </p>

      <div class="hero-full__actions">
        <a href="menu.php" class="btn btn--primary">مشاهده منوی دیجیتال</a>
        <a href="branches.php" class="btn btn--ghost">پیدا کردن شعب</a>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2 class="section__title">منوی پیشنهادی</h2>
    <p class="section__muted">دسته‌بندی‌های محبوب زرکافه</p>

    <div class="home-categories">
      <div class="home-category-card">
        <div class="home-category-card__img">
          <img src="images/products/ایس-امریکانو.png" alt="نوشیدنی سرد">
        </div>
        <h3>نوشیدنی سرد</h3>
      </div>

      <div class="home-category-card">
        <div class="home-category-card__img">
          <img src="images/products/کرک.png" alt="نوشیدنی گرم">
        </div>
        <h3>نوشیدنی گرم</h3>
      </div>

      <div class="home-category-card">
        <div class="home-category-card__img">
          <img src="images/products/کیک-شکلاتی.png" alt="کیک و دسر">
        </div>
        <h3>کیک و دسر</h3>
      </div>
    </div>
  </div>
</section>

<section class="section section--soft">
  <div class="container">
    <h2 class="section__title">پرطرفدارترین‌ها</h2>
    <p class="section__muted">محبوب‌ترین انتخاب‌های همراهان زرکافه</p>

    <div class="home-products-grid">
      <div class="card">
        <div class="card__media">
          <img class="card__img" src="images/products/شیک-مخصوص.png" alt="میلک شیک">
        </div>
        <div class="card__body">
          <h3 class="card__title">میلک‌شیک مخصوص</h3>
          <p class="card__desc">ترکیب بستنی درجه یک و سس شکلات اختصاصی</p>
          <span class="price">پیشنهاد باریستا</span>
        </div>
      </div>

      <div class="card">
        <div class="card__media">
          <img class="card__img" src="images/products/اسپرسو-سینگل.png" alt="قهوه دمی">
        </div>
        <div class="card__body">
          <h3 class="card__title">اسپرسو</h3>
          <p class="card__desc">دانه ۱۰۰٪ عربیکا با رست تازه</p>
          <span class="price">اصیل و قوی</span>
        </div>
      </div>

      <div class="card">
        <div class="card__media">
          <img class="card__img" src="images/products/کروسان-شکلات.png" alt="کیک شکلاتی">
        </div>
        <div class="card__body">
          <h3 class="card__title">کروسان شکلاتی</h3>
          <p class="card__desc">تازه، ترد و پر از شکلات بلژیکی</p>
          <span class="price">تازه پخت</span>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
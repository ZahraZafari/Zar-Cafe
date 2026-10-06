<?php
include 'includes/db.php';
include 'includes/header.php';

$activeCat = isset($_GET['cat']) ? intval($_GET['cat']) : 0;

$catIcons = [
  'نوشیدنی گرم'      => 'hot.svg',
  'دمنوش'            => 'herbal.svg',
  'نوشیدنی سرد'      => 'cold.svg',
  'میلک شیک'         => 'milkshake.svg',
  'گلاسه و بستنی'    => 'icecream.svg',
  'آبمیوه و اسموتی'  => 'smoothie.svg',
  'کیک و دسر'        => 'cake.svg',
  'پیتزا'            => 'pizza.svg',
  'برگر'             => 'burger.svg',
  'غذای اصلی'        => 'main.svg',
  'غذای ایرانی'      => 'irani.svg',
  'استیک'            => 'steak.svg',
  'ساندویچ'          => 'sandwich.svg',
  'پاستا'            => 'pasta.svg',
  'صبحانه'           => 'breakfast.svg',
  'پیش غذا'          => 'appetizer.svg',
  'سالاد'            => 'salad.svg',
];

$iconBasePath = 'images/menu/';
$defaultIcon  = 'default.svg';

$catsRes = mysqli_query($conn, "SELECT id, name FROM categories ORDER BY id ASC");

$res = null;
if ($activeCat > 0) {
  $sql = "SELECT id, name, description, price, image FROM products WHERE category_id = $activeCat ORDER BY id ASC";
  $res = mysqli_query($conn, $sql);
}
?>

<section class="menu-page">
  <div class="container">

    <header class="menu-header">
      <h1 class="menu-title">منوی دیجیتال زرکافه</h1>
      <p class="menu-subtitle">انتخاب کن، امتحان کن، عاشقش شو، دوباره بخواه.</p>
    </header>

    <div class="catbar" aria-label="دسته‌بندی‌ها">
      <div class="catbar-track">
        <?php while ($c = mysqli_fetch_assoc($catsRes)) {
          $catName = $c['name'];
          $iconFile = $catIcons[$catName] ?? $defaultIcon;
          $isActive = ($activeCat === intval($c['id']));
        ?>
          <a class="catpill <?php echo $isActive ? 'active' : ''; ?>"
            href="menu.php?cat=<?php echo intval($c['id']); ?>">
            <span class="catpill-ico">
              <img src="<?php echo $iconBasePath . htmlspecialchars($iconFile); ?>" alt="">
            </span>
            <span class="catpill-txt"><?php echo htmlspecialchars($catName); ?></span>
          </a>
        <?php } ?>
      </div>
    </div>

    <div class="product-grid">
      <?php if ($res && mysqli_num_rows($res) > 0) { ?>
        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
          <article class="p-card">
            <div class="p-media">
              <img src="images/products/<?php echo htmlspecialchars($row['image']); ?>"
                alt="<?php echo htmlspecialchars($row['name']); ?>" loading="lazy">
            </div>
            <div class="p-body">
              <div class="p-title-row">
                <h3 class="p-name"><?php echo htmlspecialchars($row['name']); ?></h3>
                <?php if ($row['price'] > 0) { ?>
                  <span class="p-price"><?php echo number_format((int)$row['price']); ?></span>
                <?php } ?>
              </div>
              <?php if (!empty($row['description'])) { ?>
                <p class="p-desc"><?php echo htmlspecialchars($row['description']); ?></p>
              <?php } ?>
            </div>
          </article>
        <?php } ?>
      <?php } elseif ($activeCat > 0) { ?>
        <p class="no-products">محصولی در این دسته‌بندی یافت نشد.</p>
      <?php } else { ?>
        <p class="select-hint">لطفاً برای مشاهده محصولات، یک دسته‌بندی را انتخاب کنید.</p>
      <?php } ?>
    </div>

  </div>
</section>

<?php include 'includes/footer.php'; ?>
<?php
include 'includes/db.php';
include 'includes/header.php';
?>

<main class="branches-page" style="background-color: #fdfcfb;">
    <div class="container">
        <header class="branches-head">
            <h1 class="branches-title">شعب زرکافه</h1>
        </header>

        <div class="branches-list">
            <?php
            $sql = "SELECT * FROM branches ORDER BY id ASC";
            $res = mysqli_query($conn, $sql);

            if ($res && mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $image = !empty($row['image']) ? $row['image'] : 'branch-def.jpg';
                    $slug = !empty($row['slug']) ? $row['slug'] : $row['id'];
            ?>
                    <a href="branch-detail.php?slug=<?php echo urlencode($slug); ?>" class="branch-item-link">
                        <article class="branch-horizontal-card">

                            <div class="branch-image-side">
                                <img src="images/<?php echo htmlspecialchars($image); ?>" alt="">
                                <div class="branch-overlay-name">
                                    <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                                </div>
                            </div>

                            <div class="branch-info-side">
                                <div class="info-row">
                                    <span class="info-text"><?php echo htmlspecialchars($row['address']); ?></span>
                                    <span class="info-svg-icon">
                                        <img src="images/menu/pin.svg" class="branch-icon-svg" alt="location">
                                    </span>
                                </div>

                                <?php if (!empty($row['phone'])): ?>
                                    <div class="info-row">
                                        <span class="info-text"><?php echo htmlspecialchars($row['phone']); ?></span>
                                        <span class="info-svg-icon">
                                            <img src="images/menu/phone.svg" class="branch-icon-svg" alt="phone">
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </article>
                    </a>
            <?php
                }
            }
            ?>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
<?php
include 'includes/db.php';
include 'includes/header.php';

$slug = isset($_GET['slug']) ? mysqli_real_escape_string($conn, $_GET['slug']) : '';

$sql = "SELECT * FROM branches WHERE slug = '$slug' LIMIT 1";
$result = mysqli_query($conn, $sql);
$branch = mysqli_fetch_assoc($result);
?>

<main class="branch-detail-page" style="padding: 60px 0; background: #fdfcfb; min-height: 80vh;">
    <div class="container">
        <?php if ($branch): ?>

            <div class="branch-detail-wrapper" style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; background: #fff; padding: 40px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">

                <div class="branch-detail__img" style="display: flex; align-items: center; justify-content: center;">
                    <img src="images/<?= htmlspecialchars(!empty($branch['image']) ? $branch['image'] : 'branch-def.jpg') ?>"
                        alt="<?= htmlspecialchars($branch['name']) ?>"
                        style="width:100%; height: auto; max-height: 450px; border-radius: 22px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); object-fit: cover;">
                </div>

                <div class="branch-detail__info" style="text-align: right; direction: rtl;">
                    <h1 style="font-size: 2.2rem; color: #4a2c2a; margin-bottom: 25px; font-weight: bold;"><?= htmlspecialchars($branch['name']) ?></h1>

                    <div style="display: grid; gap: 15px;">

                        <div style="padding: 15px; background: #fafafa; border-radius: 12px; border-right: 4px solid #e85b63;">
                            <strong style="color: #e85b63;">شهر:</strong>
                            <span><?= htmlspecialchars($branch['city']) ?></span>
                        </div>

                        <div style="padding: 15px; background: #fafafa; border-radius: 12px; border-right: 4px solid #e85b63;">
                            <strong style="color: #e85b63;">آدرس:</strong>
                            <span><?= htmlspecialchars($branch['address']) ?></span>
                        </div>

                        <div style="padding: 15px; background: #fafafa; border-radius: 12px; border-right: 4px solid #e85b63;">
                            <strong style="color: #e85b63;">تلفن تماس:</strong>
                            <a href="tel:<?= $branch['phone'] ?>" style="color: inherit; text-decoration: none; direction: ltr; display: inline-block; unicode-bidi: embed;">
                                <?= htmlspecialchars($branch['phone']) ?>
                            </a>
                        </div>

                        <div style="padding: 15px; background: #fafafa; border-radius: 12px; border-right: 4px solid #e85b63;">
                            <strong style="color: #e85b63;">ساعت کاری:</strong>
                            <span><?= htmlspecialchars($branch['working_hours']) ?></span>
                        </div>

                        <?php if (!empty($branch['features'])): ?>
                            <div style="padding: 15px; background: #fafafa; border-radius: 12px; border-right: 4px solid #e85b63;">
                                <strong style="color: #e85b63;">امکانات شعبه:</strong>
                                <span style="display: block; margin-top: 5px; line-height: 1.6;"><?= nl2br(htmlspecialchars($branch['features'])) ?></span>
                            </div>
                        <?php endif; ?>

                    </div>

                    <div style="text-align: center; margin-top: 35px;">
                        <a href="branches.php" class="btn-back-red">
                            بازگشت به لیست شعب
                        </a>
                    </div>
                </div>

            </div>

        <?php else: ?>
            <div style="text-align:center; padding:100px 0;">
                <h2 style="color: #4a2c2a;">شعبه مورد نظر پیدا نشد.</h2>
                <br>
                <a href="branches.php" style="color: #e85b63; font-weight: bold;">بازگشت به لیست شعب</a>
            </div>
        <?php endif; ?>
    </div>
</main>


<?php include 'includes/footer.php'; ?>
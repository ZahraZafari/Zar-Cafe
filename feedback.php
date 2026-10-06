<?php
include 'includes/db.php';
include 'includes/header.php';

$msg = "";

if (isset($_GET['status']) && $_GET['status'] == 'success') {
    $msg = "<div class='success-box'>نظر شما با موفقیت ثبت شد. متشکریم</div>";
}

if (isset($_POST['submit'])) {
    $phone   = mysqli_real_escape_string($conn, $_POST['phone']);
    $type    = mysqli_real_escape_string($conn, $_POST['order_type']);
    $exp     = mysqli_real_escape_string($conn, $_POST['experience']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    $sql = "INSERT INTO feedbacks (phone, order_type, experience, comment) 
            VALUES ('$phone', '$type', '$exp', '$comment')";

    if (mysqli_query($conn, $sql)) {
        header("Location: feedback.php?status=success");
        exit();
    }
}
?>

<div class="feedback-page">
    <div class="container">
        <div class="feedback-box">
            <?php echo $msg; ?>

            <div class="feedback-head">
                <h1>انتقادات و پیشنهادات</h1>
                <p>خوشحال می‌شویم نظر، پیشنهاد یا انتقاد خود را اینجا بنویسید و به بهتر شدن زرکافه کمک کنید 😊</p>
            </div>

            <form method="post" id="feedbackForm" novalidate>
                <div class="feedback-grid">
                    <div class="form-group">
                        <label for="phone">شماره تماس</label>
                        <input type="tel" id="phone" name="phone" class="form-control" placeholder="09" required maxlength="11">
                    </div>

                    <div class="form-group">
                        <label for="order_type">نوع سفارش</label>
                        <select id="order_type" name="order_type" class="form-control" required>
                            <option value="" selected disabled>انتخاب کنید...</option>
                            <option value="حضوری">حضوری (شعبه‌های زرکافه)</option>
                            <option value="وب سایت">وب‌سایت زرکافه</option>
                        </select>
                    </div>

                    <div class="form-group form-group-full">
                        <label>امروز پیش ما چه تجربه‌ای داشتید؟</label>
                        <div class="experience-options">
                            <label class="exp-card">
                                <input type="radio" name="experience" value="خوشایند" required>
                                <span>تجربه خوشایند</span>
                            </label>
                            <label class="exp-card">
                                <input type="radio" name="experience" value="ناخوشایند" required>
                                <span>تجربه ناخوشایند</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group form-group-full">
                        <label for="comment">متن نظر / پیشنهاد / انتقاد</label>
                        <textarea id="comment" name="comment" class="form-control" rows="6" placeholder="لطفاً تجربه خود را با ما در میان بگذارید..." required></textarea>
                    </div>
                </div>

                <button type="submit" name="submit" class="feedback-btn">ثبت بازخورد</button>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        const form = document.getElementById('feedbackForm');
        const phone = document.getElementById('phone');
        const orderType = document.getElementById('order_type');
        const comment = document.getElementById('comment');

        phone.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 11);
        });

        function validateForm() {
            if (phone.value.length !== 11 || !phone.value.startsWith('09')) {
                phone.setCustomValidity('شماره تماس باید ۱۱ رقم و با 09 شروع شود.');
            } else {
                phone.setCustomValidity('');
            }

            if (!orderType.value) {
                orderType.setCustomValidity('لطفاً نوع سفارش را انتخاب کنید.');
            } else {
                orderType.setCustomValidity('');
            }

            if (comment.value.trim().length < 5) {
                comment.setCustomValidity('لطفاً متن نظر یا پیشنهاد خود را وارد کنید.');
            } else {
                comment.setCustomValidity('');
            }

            const exp = document.querySelector('input[name="experience"]:checked');
            document.querySelectorAll('input[name="experience"]').forEach(el => {
                if (!exp) {
                    el.setCustomValidity('لطفاً نوع تجربه خود را انتخاب کنید.');
                } else {
                    el.setCustomValidity('');
                }
            });
        }

        [phone, orderType, comment].forEach(el => {
            el.addEventListener('input', validateForm);
            el.addEventListener('change', validateForm);
        });

        document.querySelectorAll('input[name="experience"]').forEach(el => {
            el.addEventListener('change', validateForm);
        });

        form.addEventListener('submit', function(e) {
            validateForm();
            if (!form.checkValidity()) {
                e.preventDefault();
                form.reportValidity();
            }
        });
    })();
</script>

<?php include 'includes/footer.php'; ?>
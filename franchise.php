<?php
include 'includes/db.php';
include 'includes/header.php';

$msg = "";

if (isset($_GET['status']) && $_GET['status'] == 'success') {
    $msg = "<div class='success-box'>درخواست شما با موفقیت ثبت شد. کارشناسان ما به‌زودی با شما تماس می‌گیرند.</div>";
}

if (isset($_POST['submit'])) {
    $name  = mysqli_real_escape_string($conn, $_POST['fullname']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $target_city  = mysqli_real_escape_string($conn, $_POST['city']);
    $desc  = mysqli_real_escape_string($conn, $_POST['description']);

    $sql = "INSERT INTO franchise_requests (fullname, phone, email, target_city, description) 
            VALUES ('$name', '$phone', '$email', '$target_city', '$desc')";

    if (mysqli_query($conn, $sql)) {
        header("Location: franchise.php?status=success");
        exit();
    } else {
        $msg = "<div class='error-box'>خطا در ثبت درخواست. لطفاً دوباره تلاش کنید.</div>";
    }
}
?>

<div class="franchise-page">
    <div class="container">
        <div class="franchise-wrapper">

            <div class="franchise-hero">
                <h1>اخذ نمایندگی زرکافه</h1>
                <p>
                    اگر علاقه‌مند به همکاری و راه‌اندازی شعبه زرکافه هستید، فرم زیر را تکمیل کنید.
                    پس از بررسی اطلاعات، کارشناسان ما با شما تماس خواهند گرفت.
                </p>
            </div>

            <?php echo $msg; ?>

            <div class="franchise-card">
                <form method="post" id="franchiseForm" novalidate>
                    <div class="franchise-grid">

                        <div class="form-group">
                            <label for="fullname">نام و نام خانوادگی</label>
                            <input
                                type="text"
                                id="fullname"
                                name="fullname"
                                class="form-control"
                                required
                                minlength="2">
                        </div>

                        <div class="form-group">
                            <label for="phone">شماره تماس</label>
                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                class="form-control"
                                placeholder="09"
                                required
                                maxlength="11">
                        </div>

                        <div class="form-group">
                            <label for="email">ایمیل</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                placeholder="example@email.com">
                        </div>

                        <div class="form-group">
                            <label for="city">شهر مورد نظر برای تأسیس</label>
                            <input
                                type="text"
                                id="city"
                                name="city"
                                class="form-control"
                                placeholder="مثلاً: تهران"
                                required>
                        </div>

                        <div class="form-group form-group-full">
                            <label for="description">توضیحات تکمیلی</label>
                            <textarea
                                id="description"
                                name="description"
                                class="form-control"
                                rows="6"
                                placeholder="مثلاً: ملک شخصی، متراژ، موقعیت، سابقه کاری، سرمایه تقریبی و هر توضیحی که فکر می‌کنید مفید است."></textarea>
                        </div>

                    </div>

                    <div class="submit-area">
                        <button type="submit" name="submit" class="franchise-btn">ارسال درخواست نمایندگی</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    (function() {
        const form = document.getElementById('franchiseForm');
        const fullname = document.getElementById('fullname');
        const phone = document.getElementById('phone');
        const email = document.getElementById('email');
        const city = document.getElementById('city');
        const description = document.getElementById('description');

        phone.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 11);
        });

        function validateForm() {
            if (fullname.value.trim().length < 2) {
                fullname.setCustomValidity('لطفاً نام و نام خانوادگی معتبر وارد کنید.');
            } else {
                fullname.setCustomValidity('');
            }

            if (phone.value.length !== 11 || !phone.value.startsWith('09')) {
                phone.setCustomValidity('شماره تماس باید ۱۱ رقم و با 09 شروع شود.');
            } else {
                phone.setCustomValidity('');
            }

            if (email.value.trim() !== '' && !email.value.includes('@')) {
                email.setCustomValidity('لطفاً ایمیل معتبر وارد کنید.');
            } else {
                email.setCustomValidity('');
            }

            if (city.value.trim().length < 2) {
                city.setCustomValidity('لطفاً شهر مورد نظر را وارد کنید.');
            } else {
                city.setCustomValidity('');
            }
        }

        [fullname, phone, email, city, description].forEach(el => {
            el.addEventListener('input', validateForm);
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
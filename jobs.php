<?php
include 'includes/db.php';
include 'includes/header.php';

$msg = "";

if (isset($_GET['status']) && $_GET['status'] == 'success') {
    $msg = "<div style='background: #e6fffa; color: #2c7a7b; padding: 15px; border-radius: 10px; margin-bottom: 20px; text-align: center; border: 1px solid #b2f5ea;'>درخواست شما با موفقیت ثبت شد. به‌زودی با شما تماس می‌گیریم.</div>";
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['fullname']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['city']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);

    $final_desc = "پست درخواستی: " . $position . " - " . $desc;

    $sql = "INSERT INTO job_applications (fullname, phone, address, description) 
            VALUES ('$name', '$phone', '$address', '$final_desc')";

    if (mysqli_query($conn, $sql)) {
        header("Location: jobs.php?status=success");
        exit();
    }
}
?>

<div class="jobs-page">
    <div class="container">

        <div class="jobs-hero">
            <h1>همکاری با زرکافه</h1>
            <p>اگر پرانرژی، خلاق و عاشق دنیای قهوه هستید، جایتان در تیم ما خالی است. فرم زیر را پر کنید تا با شما در تماس باشیم.</p>
        </div>

        <div class="form-card">
            <?php echo $msg; ?>

            <form method="post" id="jobForm" novalidate>
                <div class="form-grid">

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
                            required
                            maxlength="11"
                            placeholder="09">
                    </div>

                    <div class="form-group">
                        <label for="city">آدرس محل سکونت</label>
                        <input
                            type="text"
                            id="city"
                            name="city"
                            class="form-control"
                            required
                            placeholder="مثلا: تهران، خ انقلاب، ...">
                    </div>

                    <div class="form-group">
                        <label for="position">پست درخواستی</label>
                        <select id="position" name="position" class="form-control" required>
                            <option value="" selected disabled>انتخاب کنید...</option>
                            <option value="باریستا">باریستا</option>
                            <option value="صندوق‌دار">صندوق‌دار</option>
                            <option value="خدمات">خدمات</option>
                            <option value="مدیر شعبه">مدیر شعبه</option>
                        </select>
                    </div>

                    <div class="form-group form-group--full">
                        <label for="description">سوابق کاری و توضیحات تکمیلی</label>
                        <textarea
                            id="description"
                            name="description"
                            class="form-control"
                            rows="5"
                            required
                            placeholder="سوابق مرتبط، مدت زمان کار، مهارت‌ها و... را بنویسید."></textarea>
                    </div>

                </div>

                <div class="submit-area">
                    <button type="submit" name="submit" class="btn-submit">ارسال رزومه و درخواست همکاری</button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    (function() {
        const form = document.getElementById('jobForm');
        const fullname = document.getElementById('fullname');
        const phone = document.getElementById('phone');
        const position = document.getElementById('position');
        const description = document.getElementById('description');
        const city = document.getElementById('city');

        phone.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 11);
        });

        const checkValidation = () => {
            if (fullname.value.trim().length < 2) {
                fullname.setCustomValidity('لطفاً نام و نام خانوادگی معتبر (حداقل ۲ حرف برای نام) وارد کنید.');
            } else {
                fullname.setCustomValidity('');
            }

            const phoneVal = phone.value;
            if (phoneVal.length !== 11 || !phoneVal.startsWith('09')) {
                phone.setCustomValidity('شماره تماس باید ۱۱ رقم و با 09 شروع شود.');
            } else {
                phone.setCustomValidity('');
            }

            if (!city.value.trim()) {
                city.setCustomValidity('لطفاً آدرس محل سکونت را وارد کنید.');
            } else {
                city.setCustomValidity('');
            }

            if (!position.value) {
                position.setCustomValidity('لطفاً یک پست درخواستی انتخاب کنید.');
            } else {
                position.setCustomValidity('');
            }

            if (description.value.trim().length < 5) {
                description.setCustomValidity('لطفاً سوابق کاری خود را بنویسید.');
            } else {
                description.setCustomValidity('');
            }
        };

        [fullname, phone, position, description, city].forEach(el => {
            el.addEventListener('input', checkValidation);
            el.addEventListener('change', checkValidation);
        });

        form.addEventListener('submit', function(e) {
            checkValidation();
            if (!form.checkValidity()) {
                e.preventDefault();
                form.reportValidity();
            }
        });
    })();
</script>

<?php include 'includes/footer.php'; ?>
<?php
include 'includes/db.php';
include 'includes/header.php';

$msg = "";

if (isset($_POST['submit'])) {
    $name    = mysqli_real_escape_string($conn, $_POST['fullname']);
    $phone   = mysqli_real_escape_string($conn, $_POST['phone']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $emailValue = ($email === '') ? "NULL" : "'" . $email . "'";

    $sql = "INSERT INTO contact_messages (fullname, phone, email, subject, message)
            VALUES ('$name', '$phone', $emailValue, '$subject', '$message')";

    if (mysqli_query($conn, $sql)) {
        $msg = "<div class='success-box'>پیام شما با موفقیت ثبت شد. به‌زودی با شما تماس می‌گیریم.</div>";
    } else {
        $msg = "<div class='error-box'>متأسفانه خطایی رخ داد. لطفاً دوباره تلاش کنید.</div>";
    }
}
?>

<section class="contact-page">
    <div class="container">
        <div class="contact-hero">
            <h1>تماس با ما</h1>
            <p>سؤال، پیشنهاد یا پیگیری دارید؟ همینجا پیام بدهید؛ ما سریع برمی‌گردیم.</p>
        </div>

        <?php echo $msg; ?>

        <div class="contact-grid">
            <div class="contact-card contact-info">
                <h2>اطلاعات تماس</h2>

                <div class="contact-info-list">
                    <div class="contact-info-item">
                        <div class="label">شعبه مرکزی</div>
                        <div class="value">خیابان طالقانی، خیابان ایرانشهر، پارک هنرمندان</div>
                    </div>

                    <div class="contact-info-item">
                        <div class="label">تلفن</div>
                        <div class="value">
                            <a href="tel:02112345678">021-88310462</a>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="label">ایمیل</div>
                        <div class="value">
                            <a href="mailto:info@zarcafe.com">info@zarcafe.com</a>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="label">ساعت پاسخگویی</div>
                        <div class="value">هر روز 9 تا 22</div>
                    </div>
                </div>
            </div>

            <div class="contact-card contact-form-card">
                <h2>ارسال پیام مستقیم</h2>
                <p class="contact-form-hint">لطفاً اطلاعات را کامل وارد کنید تا بهتر راهنمایی‌تان کنیم.</p>

                <form method="post" id="contactForm" novalidate>
                    <div class="contact-form-grid">
                        <div class="form-group">
                            <label for="fullname">نام و نام خانوادگی</label>
                            <input type="text" id="fullname" name="fullname" class="form-control" required minlength="2">
                        </div>

                        <div class="form-group">
                            <label for="phone">شماره تماس</label>
                            <input type="tel" id="phone" name="phone" class="form-control"
                                placeholder="09" required maxlength="11">
                        </div>

                        <div class="form-group">
                            <label for="email">ایمیل</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="example@email.com">
                        </div>

                        <div class="form-group">
                            <label for="subject">موضوع</label>
                            <select id="subject" name="subject" class="form-control" required>
                                <option value="" selected disabled>انتخاب کنید...</option>
                                <option value="پشتیبانی سفارش">پشتیبانی سفارش</option>
                                <option value="پیشنهاد / انتقاد">پیشنهاد / انتقاد</option>
                                <option value="همکاری / استخدام">همکاری / استخدام</option>
                                <option value="نمایندگی">نمایندگی</option>
                                <option value="سایر">سایر</option>
                            </select>
                        </div>

                        <div class="form-group form-group-full">
                            <label for="message">متن پیام</label>
                            <textarea id="message" name="message" class="form-control" rows="6"
                                placeholder="متن پیام‌تان را اینجا بنویسید..." required></textarea>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="contact-btn">ارسال پیام</button>
                </form>
            </div>
        </div>

    </div>
</section>

<script>
    (function() {
        const form = document.getElementById('contactForm');
        const fullname = document.getElementById('fullname');
        const phone = document.getElementById('phone');
        const email = document.getElementById('email');
        const subject = document.getElementById('subject');
        const message = document.getElementById('message');

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

            if (!subject.value) {
                subject.setCustomValidity('لطفاً موضوع را انتخاب کنید.');
            } else {
                subject.setCustomValidity('');
            }

            if (message.value.trim().length < 5) {
                message.setCustomValidity('لطفاً متن پیام را وارد کنید.');
            } else {
                message.setCustomValidity('');
            }
        }

        [fullname, phone, email, subject, message].forEach(el => {
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
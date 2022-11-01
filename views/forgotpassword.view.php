<?php require_once("views/layout/header.php"); ?>
<section class="bg-grey py-5 login_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="login_box mx-auto rounded bg-white text-center">
                    <?php if(isset($id) && $id == null): ?>
                    <form method="POST" id="save-employee-data-form">
                        <h3 class="text-capitalize mb-4 f-w-500">Recover Password</h3>

                        <div class="alert alert-success m-t-10 d-none" id="success-msg"></div>

                        <div class="form-group text-left">
                            <label for="email" class="f-w-500">Email Address</label>
                            <input type="email" name="email" class="form-control height-50 f-15 light_text" autofocus=""
                                placeholder="e.g. admin@example.com" id="email" autocomplete="off" required>
                        </div>

                        <div class="row">
                            <div class="col-6">


                                <img src="<?=ROOT?>/forgotpassword/captcha"
                                    alt="captcha" id="captchaimg" />
                                <div class=" form-group forgot_pswd mt-2 text-center">
                                    <a href="javascript:void(0)"
                                        onclick="document.getElementById('captchaimg').src='<?=ROOT?>/forgotpassword/captcha?'+Math.random();document.getElementById('captcha').focus();"
                                        id=" change-image">Not readable?
                                        Change text.</a>
                                </div>
                            </div>
                            <div class="col-6">
                                <input type="text" name="captcha" id="captcha"
                                    class="form-control f-27 light_text text-center" style="height: 78px;"
                                    placeholder="Captcha" required />
                            </div>

                        </div>

                        <button type="submit" id="submit-login"
                            class="btn-primary f-w-500 rounded w-100 height-50 f-18">
                            Send Reset Link <i class="bi bi-arrow-right-circle-fill"></i>
                        </button>
                        <div class="forgot_pswd mt-3">
                            <a href="<?=ROOT?>/login"
                                class="justify-content-center">Log In</a>
                        </div>
                    </form>
                    <?php endif; ?>
                    <?php if(isset($id) && $id == "reset" && isset($_GET['token']) && mb_strlen($_GET['token']) == 32): ?>
                    <form method="POST" id="edit-pw">
                        <h3 class="text-capitalize mb-4 f-w-500">Recover Password</h3>

                        <div class="alert alert-success m-t-10 d-none" id="success-msg"></div>

                        <div class="form-group text-left">
                            <label for="password" class="f-w-500">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control height-35 f-14"
                                    autocomplete="off" required>

                                <div class="input-group-append">
                                    <button id="random_password" type="button" data-toggle="tooltip"
                                        data-original-title="Generate Random Password"
                                        class="btn btn-outline-secondary border-grey height-35">
                                        <i class="bi bi-shuffle"></i>
                                    </button>
                                </div>
                                <div class="input-group-append">
                                    <button type="button" data-toggle="tooltip" data-original-title="Show/Hide Value"
                                        class="btn btn-outline-secondary border-grey height-35 toggle-password">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                            </div>
                            <small class="form-text text-muted">Must have at least 8 characters</small>

                        </div>

                        <div class="row">
                            <div class="col-6">


                                <img src="<?=ROOT?>/forgotpassword/captcha"
                                    alt="captcha" id="captchaimg2" />
                                <div class=" form-group forgot_pswd mt-2 text-center">
                                    <a href="javascript:void(0)"
                                        onclick="document.getElementById('captchaimg2').src='<?=ROOT?>/forgotpassword/captcha?'+Math.random();document.getElementById('captcha2').focus();"
                                        id=" change-image">Not readable?
                                        Change text.</a>
                                </div>
                            </div>
                            <div class="col-6">
                                <input type="text" name="captcha" id="captcha2"
                                    class="form-control f-27 light_text text-center" style="height: 78px;"
                                    placeholder="Captcha" required />
                            </div>

                        </div>

                        <button type="submit" id="submit-password"
                            class="btn-primary f-w-500 rounded w-100 height-50 f-18">
                            Reset Password <i class="bi bi-arrow-right-circle-fill"></i>
                        </button>
                        <div class="forgot_pswd mt-3">
                            <a href="<?=ROOT?>/login"
                                class="justify-content-center">Log In</a>
                        </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once("views/layout/footer.php"); ?>

<script>
    $('#submit-password').click(function(e) {
        e.preventDefault();
        var token =
            "<?=isset($_GET['token']) ? $_GET['token']: "" ?>";
        var url =
            "<?=ROOT?>/forgotpassword/reset?token=" + token;
        var form = $('#edit-pw');
        var button = $('#submit-password');
        button.html(
            '<i class="bi bi-arrow-right-circle-fill"></i> Resetting Password...'
        );
        button.attr('disabled', true);
        if (form[0].checkValidity()) {
            var formData = new FormData(form[0]);
            formData.append('token', token);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.status == "success") {

                        $('#email').val('');
                        $('#captcha').val('');
                        document.getElementById('captchaimg2').src =
                            '<?=ROOT?>/forgotpassword/captcha ? ' +
                            Math.random();
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href =
                                    "<?=ROOT?>/login";
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message,
                        })
                        $('#email').val('');
                        $('#captcha').val('');
                        document.getElementById('captchaimg2').src =
                            '<?=ROOT?>/forgotpassword/captcha?' +
                            Math.random();
                    }
                }
            });
        } else {

            form[0].reportValidity();

        }
    });


    $('#submit-login').click(function(e) {
        e.preventDefault();
        var url = "<?=ROOT?>/forgotpassword";
        var form = $('#save-employee-data-form');
        var button = $('#submit-login');

        button.html('Sending...');
        button.attr('disabled', true);
        if (form[0].checkValidity()) {
            var formData = new FormData(form[0]);

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.status == "success") {
                        $('#success-msg').removeClass('d-none');
                        $('#success-msg').html(data.message);
                        $('#email').val('');
                        $('#captcha').val('');
                        document.getElementById('captchaimg').src =
                            '<?=ROOT?>/forgotpassword/captcha?' +
                            Math.random();
                        button.html(
                            'Send Reset Link <i class="bi bi-arrow-right-circle-fill"></i>');
                        button.attr('disabled', false);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message,
                        })
                        $('#email').val('');
                        $('#captcha').val('');
                        document.getElementById('captchaimg').src =
                            '<?=ROOT?>/forgotpassword/captcha?' +
                            Math.random();
                    }
                }
            });
        } else {

            form[0].reportValidity();

        }
    });

    $('#random_password').click(function() {
        var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var passwordLength = 14;
        var password = "";
        for (var i = 0; i <= passwordLength; i++) {
            var randomNumber = Math.floor(Math.random() * chars.length);
            password += chars.substring(randomNumber, randomNumber + 1);
        }
        $('#password').val(password);
    });

    $('.toggle-password').click(function() {
        var classTogle = $(this)

        var password = $('#password');
        if (password.attr('type') == 'password') {
            password.attr('type', 'text');
            classTogle.html(`<i class="bi bi-eye-slash-fill"></i>`);
        } else {
            password.attr('type', 'password');
            classTogle.html(
                `<i class="bi bi-eye-fill"></i>`
            );
        }
    });
</script>
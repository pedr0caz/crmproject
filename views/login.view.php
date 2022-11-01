<?php require_once("views/layout/header.php"); ?>
<?php if (!isset($_SESSION["user_id"])) {?>
<form id="login-form" action="" method="POST">
	<section class="bg-grey py-5 login_section">

		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="login_box mx-auto rounded bg-white text-center">
						<h3 class="text-capitalize mb-4 f-w-500">Log In</h3>
						<?php isset($error_message) ? $error_message : ''; ?>
						<div class="form-group text-left">
							<label for="email">Email Address</label>
							<input tabindex="1" type="email" name="email" class="form-control height-50 f-15 light_text"
								autofocus="" placeholder="Email Address" id="email" autocomplete="off" required>

						</div>
						<div id="password-section">
							<div class="form-group text-left">
								<label for="password">Password</label>
								<div class="input-group">
									<input type="password" name="password" id="password"
										placeholder="Must have at least 8 characters" tabindex="3"
										class="form-control height-50 f-15 light_text" required>
									<div class="input-group-append">
										<button type="button" data-toggle="tooltip"
											data-original-title="Show/Hide Value"
											class="btn btn-outline-secondary border-grey height-50 toggle-password">
											<i class="bi bi-eye-fill"></i>
										</button>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-6">


									<img src="<?=ROOT?>/login/captcha"
										alt="captcha" id="captchaimg" />
									<div class=" form-group forgot_pswd mt-2 text-center">
										<a href="javascript:void(0)"
											onclick="document.getElementById('captchaimg').src='<?=ROOT?>/login/captcha?'+Math.random();document.getElementById('captcha').focus();"
											id="change-image">Not readable?
											Change text.</a>
									</div>
								</div>
								<div class="col-6">
									<input type="text" name="captcha" id="captcha"
										class="form-control f-27 light_text text-center" style="height: 78px;"
										placeholder="Captcha" />
								</div>

							</div>
							<div class=" form-group forgot_pswd mb-3 text-right">
								<a href="<?=ROOT;?>/forgotpassword">Forgot
									your password?</a>
							</div>
							<div class="form-group text-left">
								<input id="checkbox-signup" type="checkbox" name="remember" data-np-checked="1">
								<label for="checkbox-signup">Stay logged in</label>
							</div>

							<button type="submit" id="submit-login"
								class="btn-primary f-w-500 rounded w-100 height-50 f-18">
								Log In
								<i class="bi bi-arrow-right"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</form>
<?php } ?>
<?php require_once("views/layout/footer.php"); ?>

<script>
	$(document).ready(function() {
		$('.toggle-password').click(function() {
			var classTogle = $(this)

			var password = $('#password');
			if (password.attr('type') == 'password') {
				password.attr('type', 'text');
				classTogle.html(`<i class="bi bi-eye-slash" style="font-size: 16px;"></i>`);
			} else {
				password.attr('type', 'password');
				classTogle.html(`<i class="bi bi-eye" style="font-size: 16px;"></i>`);
			}
		});

		$('#login-form').submit(function(e) {
			e.preventDefault();
			var email = $('#email').val();
			var password = $('#password').val();
			var captcha = $('#captcha').val();
			var remember = $('#checkbox-signup').val();
			var submit = $('#submit-login').val();
			$.ajax({
				url: '<?=ROOT?>/login',
				type: 'POST',
				data: {
					email: email,
					password: password,
					captcha: captcha,
					remember: remember,
					submit: submit
				},

				success: function(data) {
					console.log(data);
					if (data.status == 'success') {
						Swal.fire({
							icon: 'success',
							title: 'Login Success',
							showConfirmButton: true,
							timer: 1500
						}).then((result) => {

							window.location.href =
								"<?=ROOT?>/home";

						})
					}
					if (data.status == 'error') {
						Swal.fire({
							icon: 'error',
							title: 'Login Failed',
							text: data.message,
							showConfirmButton: true,
							timer: 1500
						});
						$('#captchaimg').attr('src',
							'<?=ROOT?>/login/captcha?' +
							Math.random());
					}

				},
				error: function(data) {
					console.log(data);
				}

			});
		});
	});
</script>
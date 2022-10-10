<!DOCTYPE html>
<!-- 
Jampack
Author: Hencework
Contact: contact@hencework.com
-->
<html lang="en">

<head>
	<!-- Meta Tags -->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<meta name="description" content="A modern CRM " />

	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

	<!-- CSS -->
	<link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<!-- Wrapper -->
	<div class="hk-wrapper hk-pg-auth" data-footer="simple">
		<!-- Top Navbar -->
		<nav class="hk-navbar navbar navbar-expand-xl navbar-light fixed-top">
			<div class="container-xxl">
				<!-- Start Nav -->
				<div class="nav-start-wrap">
					<a class="navbar-brand" href="index.html">
						<img class="brand-img d-inline-block" src="dist/img/logo-light.png" alt="brand" />
					</a>
				</div>
				<!-- /Start Nav -->


				<!-- /End Nav -->
			</div>

		</nav>
		<!-- /Top Navbar -->

		<!-- Main Content -->
		<div class="hk-pg-wrapper">
			<!-- Page Body -->
			<div class="hk-pg-body">
				<!-- Container -->
				<div class="container-xxl">
					<!-- Row -->
					<div class="row">

						<div class="col-xl-5 col-lg-6 col-md-7 col-sm-10 position-relative mx-auto">
							<div class="auth-content py-md-0 py-8">
								<form class="w-100">
									<div class="row">
										<div class="col-lg-10 mx-auto">
											<h4 class="mb-4">Sign in to your account</h4>
											<div class="row gx-3">
												<div class="form-group col-lg-12">
													<div class="form-label-group">
														<label>User Name</label>
													</div>
													<input class="form-control" placeholder="Enter username or email ID"
														value="" type="text">
												</div>
												<div class="form-group col-lg-12">
													<div class="form-label-group">
														<label>Password</label>
														<a href="#" class="fs-7 fw-medium">Forgot Password ?</a>
													</div>
													<div class="input-group password-check">
														<span class="input-affix-wrapper">
															<input class="form-control"
																placeholder="Enter your password" value=""
																type="password">
															<a href="#" class="input-suffix text-muted">
																<span class="feather-icon"><i class="form-icon"
																		data-feather="eye"></i></span>
																<span class="feather-icon d-none"><i class="form-icon"
																		data-feather="eye-off"></i></span>
															</a>
														</span>
													</div>
												</div>
											</div>
											<div class="d-flex justify-content-center">
												<div class="form-check form-check-sm mb-3">
													<input type="checkbox" class="form-check-input" id="logged_in"
														checked>
													<label class="form-check-label text-muted fs-7" for="logged_in">Keep
														me logged in</label>
												</div>
											</div>
											<a href="#" class="btn btn-primary btn-uppercase btn-block">Login</a>

										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- /Row -->
				</div>
				<!-- /Container -->
			</div>
			<!-- /Page Body -->

			<!-- Page Footer -->

			<!-- / Page Footer -->

		</div>
		<!-- /Main Content -->
	</div>
	<!-- /Wrapper -->

	<!-- jQuery -->
	<script src="vendors/jquery/dist/jquery.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

	<!-- FeatherIcons JS -->
	<script src="dist/js/feather.min.js"></script>

	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>

	<!-- Simplebar JS -->
	<script src="vendors/simplebar/dist/simplebar.min.js"></script>

	<!-- Init JS -->
	<script src="dist/js/init.js"></script>
</body>

</html>
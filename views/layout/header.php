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
	<title>Jampack - Admin CRM Dashboard Template</title>
	<meta name="description"
		content="A modern CRM Dashboard Template with reusable and flexible components for your SaaS web applications by hencework. Based on Bootstrap." />

	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

	<!-- Daterangepicker CSS -->
	<link href="vendors/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />

	<!-- Data Table CSS -->
	<link href="vendors/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
	<link href="vendors/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet"
		type="text/css" />

	<!-- CSS -->
	<link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<!-- Wrapper -->
	<div class="hk-wrapper" data-layout="vertical" data-layout-style="default" data-menu="light" data-footer="simple">
		<!-- Top Navbar -->
		<nav class="hk-navbar navbar navbar-expand-xl navbar-light fixed-top">
			<div class="container-fluid">
				<!-- Start Nav -->
				<div class="nav-start-wrap">
					<button
						class="btn btn-icon btn-rounded btn-flush-dark flush-soft-hover navbar-toggle d-xl-none"><span
							class="icon"><span class="feather-icon"><i
									data-feather="align-left"></i></span></span></button>

					<!-- Search -->
					<form class="dropdown navbar-search">
						<div class="dropdown-toggle no-caret" data-bs-toggle="dropdown" data-dropdown-animation
							data-bs-auto-close="outside">
							<a href="#"
								class="btn btn-icon btn-rounded btn-flush-dark flush-soft-hover  d-xl-none"><span
									class="icon"><span class="feather-icon"><i
											data-feather="search"></i></span></span></a>
							<div class="input-group d-xl-flex d-none">
								<span class="input-affix-wrapper input-search affix-border">
									<input type="text" class="form-control  bg-transparent"
										data-navbar-search-close="false" placeholder="Search..." aria-label="Search">
									<span class="input-suffix"><span>/</span>
										<span class="btn-input-clear"><i class="bi bi-x-circle-fill"></i></span>
										<span class="spinner-border spinner-border-sm input-loader text-primary"
											role="status">
											<span class="sr-only">Loading...</span>
										</span>
									</span>
								</span>
							</div>
						</div>
						<div class="dropdown-menu p-0">
							<!-- Mobile Search -->
							<div class="dropdown-item d-xl-none bg-transparent">
								<div class="input-group mobile-search">
									<span class="input-affix-wrapper input-search">
										<input type="text" class="form-control" placeholder="Search..."
											aria-label="Search">
										<span class="input-suffix">
											<span class="btn-input-clear"><i class="bi bi-x-circle-fill"></i></span>
											<span class="spinner-border spinner-border-sm input-loader text-primary"
												role="status">
												<span class="sr-only">Loading...</span>
											</span>
										</span>
									</span>
								</div>
							</div>
							<!--/ Mobile Search -->

						</div>
					</form>
					<!-- /Search -->
				</div>
				<!-- /Start Nav -->

				<!-- End Nav -->
				<div class="nav-end-wrap">
					<ul class="navbar-nav flex-row">
						<li class="nav-item">
							<a href="email.html" class="btn btn-icon btn-rounded btn-flush-dark flush-soft-hover"><span
									class="icon"><span class=" position-relative"><span class="feather-icon"><i
												data-feather="inbox"></i></span><span
											class="badge badge-sm badge-soft-primary badge-sm badge-pill position-top-end-overflow-1">4</span></span></span></a>
						</li>
						<li class="nav-item">
							<div class="dropdown dropdown-notifications">
								<a href="#"
									class="btn btn-icon btn-rounded btn-flush-dark flush-soft-hover dropdown-toggle no-caret"
									data-bs-toggle="dropdown" data-dropdown-animation role="button" aria-haspopup="true"
									aria-expanded="false"><span class="icon"><span class="position-relative"><span
												class="feather-icon"><i data-feather="bell"></i></span><span
												class="badge badge-success badge-indicator position-top-end-overflow-1"></span></span></span></a>
								<div class="dropdown-menu dropdown-menu-end p-0">
									<h6 class="dropdown-header px-4 fs-6">Notifications<a href="#"
											class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"><span
												class="icon"><span class="feather-icon"><i
														data-feather="settings"></i></span></span></a>
									</h6>
									<div data-simplebar class="dropdown-body  p-2">
										<a href="javascript:void(0);" class="dropdown-item">
											<div class="media">
												<div class="media-head">
													<div class="avatar avatar-rounded avatar-sm">
														<img src="dist/img/avatar2.jpg" alt="user" class="avatar-img">
													</div>
												</div>
												<div class="media-body">
													<div>
														<div class="notifications-text">Morgan Freeman accepted your
															invitation to join the team</div>
														<div class="notifications-info">
															<span class="badge badge-soft-success">Collaboration</span>
															<div class="notifications-time">Today, 10:14 PM</div>
														</div>
													</div>
												</div>
											</div>
										</a>
										<a href="javascript:void(0);" class="dropdown-item">
											<div class="media">
												<div class="media-head">
													<div
														class="avatar  avatar-icon avatar-sm avatar-success avatar-rounded">
														<span class="initial-wrap">
															<span class="feather-icon"><i
																	data-feather="inbox"></i></span>
														</span>
													</div>
												</div>
												<div class="media-body">
													<div>
														<div class="notifications-text">New message received from Alan
															Rickman</div>
														<div class="notifications-info">
															<div class="notifications-time">Today, 7:51 AM</div>
														</div>
													</div>
												</div>
											</div>
										</a>
										<a href="javascript:void(0);" class="dropdown-item">
											<div class="media">
												<div class="media-head">
													<div
														class="avatar  avatar-icon avatar-sm avatar-pink avatar-rounded">
														<span class="initial-wrap">
															<span class="feather-icon"><i
																	data-feather="clock"></i></span>
														</span>
													</div>
												</div>
												<div class="media-body">
													<div>
														<div class="notifications-text">You have a follow up with
															Jampack Head on Friday, Dec 19 at 9:30 am</div>
														<div class="notifications-info">
															<div class="notifications-time">Yesterday, 9:25 PM</div>
														</div>
													</div>
												</div>
											</div>
										</a>
										<a href="javascript:void(0);" class="dropdown-item">
											<div class="media">
												<div class="media-head">
													<div class="avatar avatar-sm avatar-rounded">
														<img src="dist/img/avatar3.jpg" alt="user" class="avatar-img">
													</div>
												</div>
												<div class="media-body">
													<div>
														<div class="notifications-text">Application of Sarah Williams is
															waiting for your approval</div>
														<div class="notifications-info">
															<div class="notifications-time">Today 10:14 PM</div>
														</div>
													</div>
												</div>
											</div>
										</a>
										<a href="javascript:void(0);" class="dropdown-item">
											<div class="media">
												<div class="media-head">
													<div class="avatar avatar-sm avatar-rounded">
														<img src="dist/img/avatar10.jpg" alt="user" class="avatar-img">
													</div>
												</div>
												<div class="media-body">
													<div>
														<div class="notifications-text">Winston Churchil shared a
															document with you</div>
														<div class="notifications-info">
															<span class="badge badge-soft-violet">File Manager</span>
															<div class="notifications-time">2 Oct, 2021</div>
														</div>
													</div>
												</div>
											</div>
										</a>
										<a href="javascript:void(0);" class="dropdown-item">
											<div class="media">
												<div class="media-head">
													<div
														class="avatar  avatar-icon avatar-sm avatar-danger avatar-rounded">
														<span class="initial-wrap">
															<span class="feather-icon"><i
																	data-feather="calendar"></i></span>
														</span>
													</div>
												</div>
												<div class="media-body">
													<div>
														<div class="notifications-text">Last 2 days left for the project
															to be completed</div>
														<div class="notifications-info">
															<span class="badge badge-soft-orange">Updates</span>
															<div class="notifications-time">14 Sep, 2021</div>
														</div>
													</div>
												</div>
											</div>
										</a>
									</div>
									<div class="dropdown-footer"><a href="#"><u>View all notifications</u></a></div>
								</div>
							</div>
						</li>
						<li class="nav-item">
							<div class="dropdown ps-2">
								<a class=" dropdown-toggle no-caret" href="#" role="button" data-bs-display="static"
									data-bs-toggle="dropdown" data-dropdown-animation data-bs-auto-close="outside"
									aria-expanded="false">
									<div class="avatar avatar-rounded avatar-xs">
										<img src="dist/img/avatar12.jpg" alt="user" class="avatar-img">
									</div>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<div class="p-2">
										<div class="media">
											<div class="media-head me-2">
												<div class="avatar avatar-primary avatar-sm avatar-rounded">
													<span class="initial-wrap">Hk</span>
												</div>
											</div>
											<div class="media-body">
												<div class="dropdown">
													<a href="#" class="d-block dropdown-toggle link-dark fw-medium"
														data-bs-toggle="dropdown" data-dropdown-animation
														data-bs-auto-close="inside">Hencework</a>
													<div class="dropdown-menu dropdown-menu-end">
														<div class="p-2">
															<div class="media align-items-center active-user mb-3">
																<div class="media-head me-2">
																	<div
																		class="avatar avatar-primary avatar-xs avatar-rounded">
																		<span class="initial-wrap">Hk</span>
																	</div>
																</div>
																<div class="media-body">
																	<a href="#"
																		class="d-flex align-items-center link-dark">Hencework
																		<i
																			class="ri-checkbox-circle-fill fs-7 text-primary ms-1"></i></a>
																	<a href="#"
																		class="d-block fs-8 link-secondary"><u>Manage
																			your account</u></a>
																</div>
															</div>
															<div class="media align-items-center mb-3">
																<div class="media-head me-2">
																	<div class="avatar avatar-xs avatar-rounded">
																		<img src="dist/img/avatar12.jpg" alt="user"
																			class="avatar-img">
																	</div>
																</div>
																<div class="media-body">
																	<a href="#" class="d-block link-dark">Jampack
																		Team</a>
																	<a href="#"
																		class="d-block fs-8 link-secondary">contact@hencework.com</a>
																</div>
															</div>
															<button class="btn btn-block btn-outline-light btn-sm">
																<span><span class="icon"><span class="feather-icon"><i
																				data-feather="plus"></i></span></span>
																	<span>Add Account</span></span>
															</button>
														</div>
													</div>
												</div>
												<div class="fs-7">contact@hencework.com</div>
												<a href="#" class="d-block fs-8 link-secondary"><u>Sign Out</u></a>
											</div>
										</div>
									</div>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="profile.html">Profile</a>
									<a class="dropdown-item" href="#"><span class="me-2">Offers</span><span
											class="badge badge-sm badge-soft-pink">2</span></a>
									<div class="dropdown-divider"></div>
									<h6 class="dropdown-header">Manage Account</h6>
									<a class="dropdown-item" href="#"><span class="dropdown-icon feather-icon"><i
												data-feather="credit-card"></i></span><span>Payment methods</span></a>
									<a class="dropdown-item" href="#"><span class="dropdown-icon feather-icon"><i
												data-feather="check-square"></i></span><span>Subscriptions</span></a>
									<a class="dropdown-item" href="#"><span class="dropdown-icon feather-icon"><i
												data-feather="settings"></i></span><span>Settings</span></a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#"><span class="dropdown-icon feather-icon"><i
												data-feather="tag"></i></span><span>Raise a ticket</span></a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">Terms & Conditions</a>
									<a class="dropdown-item" href="#">Help & Support</a>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<!-- /End Nav -->
			</div>
		</nav>
		<!-- /Top Navbar -->

		<!-- Vertical Nav -->
		<div class="hk-menu">
			<!-- Brand -->
			<div class="menu-header">
				<span>
					<a class="navbar-brand" href="index.html">
						<img class="brand-img img-fluid" src="dist/img/brand-sm.svg" alt="brand" />
						<img class="brand-img img-fluid" src="dist/img/Jampack.svg" alt="brand" />
					</a>
					<button class="btn btn-icon btn-rounded btn-flush-dark flush-soft-hover navbar-toggle">
						<span class="icon">
							<span class="svg-icon fs-5">
								<svg xmlns="http://www.w3.org/2000/svg"
									class="icon icon-tabler icon-tabler-arrow-bar-to-left" width="24" height="24"
									viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
									stroke-linecap="round" stroke-linejoin="round">
									<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
									<line x1="10" y1="12" x2="20" y2="12"></line>
									<line x1="10" y1="12" x2="14" y2="16"></line>
									<line x1="10" y1="12" x2="14" y2="8"></line>
									<line x1="4" y1="4" x2="4" y2="20"></line>
								</svg>
							</span>
						</span>
					</button>
				</span>
			</div>
			<!-- /Brand -->

			<!-- Main Menu -->
			<div data-simplebar class="nicescroll-bar">
				<div class="menu-content-wrap">
					<div class="menu-group">
						<ul class="navbar-nav flex-column">
							<li class="nav-item active">
								<a class="nav-link" href="index.html">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg"
												class="icon icon-tabler icon-tabler-template" width="24" height="24"
												viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
												stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none" />
												<rect x="4" y="4" width="16" height="4" rx="1" />
												<rect x="4" y="12" width="6" height="8" rx="1" />
												<line x1="14" y1="12" x2="20" y2="12" />
												<line x1="14" y1="16" x2="20" y2="16" />
												<line x1="14" y1="20" x2="20" y2="20" />
											</svg>
										</span>
									</span>
									<span class="nav-link-text">Dashboard</span>
									<span class="badge badge-sm badge-soft-pink ms-auto">Hot</span>
								</a>
							</li>
						</ul>
					</div>
					<div class="menu-gap"></div>
					<div class="menu-group">

						<ul class="navbar-nav flex-column">
							<li class="nav-item">
								<a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse"
									data-bs-target="#dash_chat">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg"
												class="icon icon-tabler icon-tabler-message-dots" width="24" height="24"
												viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
												stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none" />
												<path
													d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
												<line x1="12" y1="11" x2="12" y2="11.01" />
												<line x1="8" y1="11" x2="8" y2="11.01" />
												<line x1="16" y1="11" x2="16" y2="11.01" />
											</svg>
										</span>
									</span>
									<span class="nav-link-text">Chat</span>
								</a>
								<ul id="dash_chat" class="nav flex-column collapse  nav-children">
									<li class="nav-item">
										<ul class="nav flex-column">
											<li class="nav-item">
												<a class="nav-link" href="chats.html"><span
														class="nav-link-text">Chats</span></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="chats-group.html"><span
														class="nav-link-text">Groups</span></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="chats-contact.html"><span
														class="nav-link-text">Contacts</span></a>
											</li>
										</ul>
									</li>
								</ul>
							</li>

							<li class="nav-item">
								<a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse"
									data-bs-target="#dash_profile">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg"
												class="icon icon-tabler icon-tabler-user-search" width="24" height="24"
												viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
												stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none" />
												<circle cx="12" cy="7" r="4" />
												<path d="M6 21v-2a4 4 0 0 1 4 -4h1" />
												<circle cx="16.5" cy="17.5" r="2.5" />
												<path d="M18.5 19.5l2.5 2.5" />
											</svg>
										</span>
									</span>
									<span class="nav-link-text position-relative">Profile
										<span
											class="badge badge-danger badge-indicator position-absolute top-0 start-100"></span>
									</span>
								</a>
								<ul id="dash_profile" class="nav flex-column collapse  nav-children">
									<li class="nav-item">
										<ul class="nav flex-column">
											<li class="nav-item">
												<a class="nav-link" href="profile.html">
													<span class="nav-link-text">Profile</span>
												</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="edit-profile.html">
													<span class="nav-link-text">Edit Profile</span>
												</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="account.html">
													<span class="nav-link-text">Account</span>
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /Main Menu -->
		</div>
		<div id="hk_menu_backdrop" class="hk-menu-backdrop"></div>
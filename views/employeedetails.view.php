<?php require_once("layout/header.php"); ?>
<?php require_once("layout/navbar.php"); ?>
<section class="main-container bg-additional-grey" id="fullscreen">
	<div class="preloader-container justify-content-center align-items-center" style="display: none;">
		<div class="spinner-border" role="status" aria-hidden="true"></div>
	</div>
	<div class="d-flex d-lg-block filter-box project-header bg-white">
		<div class="mobile-close-overlay w-100 h-100" id="close-client-overlay"></div>
		<div class="project-menu" id="mob-client-detail">
			<a class="d-none close-it" href="javascript:;" id="close-client-detail">
				<svg class="svg-inline--fa fa-times fa-w-11" aria-hidden="true" focusable="false" data-prefix="fa"
					data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"
					data-fa-i2svg="">
					<path fill="currentColor"
						d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
					</path>
				</svg>
			</a>
			<nav class="tabs --jsfied">
				<ul class="-primary">
					<li>
						<a href="<?=ROOT?>/employeedetails/<?=$id?>"
							class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab profile <?php if(!isset($_GET['tab'])) {
							    echo "active";
							} ?>" id="profile"><span>Profile</span></a>
					</li>
					<li>
						<a href="<?=ROOT?>/employeedetails/<?=$id?>?tab=projects"
							class="text-dark-grey text-capitalize border-right-grey p-sub-menu projects <?php if(isset($_GET['tab']) && $_GET['tab'] == "projects") {
							    echo "active";
							}?>" id="projects"><span>Projects</span></a>
					</li>
					<li>
						<a href="<?=ROOT?>/employeedetails/<?=$id?>?tab=tasks"
							class="text-dark-grey text-capitalize border-right-grey p-sub-menu tasks <?php if(isset($_GET['tab']) && $_GET['tab'] == "tasks") {
							    echo "active";
							}?>" id="tasks"><span>Tasks</span></a>
					</li>
					<li>
						<a href=" <?=ROOT?>/employeedetails/<?=$id?>?tab=documents"
							class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab documents <?php if(isset($_GET['tab']) && $_GET['tab'] == "documents") {
							    echo "active";
							}?>" id="documents"><span>Documents</span></a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<div class="content-wrapper pt-0 border-top-0 client-detail-wrapper" style="position: relative; zoom: 1;">
		<style>
			.card-img {
				width: 120px;
				height: 120px;
			}

			.card-img img {
				width: 120px;
				height: 120px;
				object-fit: cover;
			}
		</style>
		<?php if(!isset($_GET['tab'])) { ?>
		<div class="d-lg-flex">
			<div class="project-left w-100 py-0 py-lg-5 py-md-0">
				<!-- ROW START -->
				<div class="row">
					<!--  USER CARDS START -->
					<div class="col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4 mb-md-0">
						<div class="row">
							<div class="col-xl-6 col-md-6 mb-4 mb-lg-0">
								<div class="card border-0 b-shadow-4">
									<div class="card-horizontal align-items-center">
										<div class="card-img">
											<img class=""
												src="<?=$employee['image'] ? ROOT."/".$employee['image'] : 'https://www.gravatar.com/avatar/a456ed61bc3c5d05f3ad79d85069098a.png?s=200&d=mp'?>"
												alt="">
										</div>
										<div class="card-body border-0 pl-0">
											<div class="row">
												<div class="col-10">
													<h4 class="card-title f-15 f-w-500 text-darkest-grey mb-0">
														<?=$employee['name']?>
													</h4>
												</div>
												<div class="col-2 text-right">
													<button type="button" class="btn btn-primary btn-sm"
														data-toggle="modal" data-target="#exampleModal">
														Edit
												</div>
											</div>
											<p class="f-13 font-weight-normal text-dark-grey mb-0">
												<?=$employee['designation_name']?>
											</p>
											<p class="card-text f-12 text-lightest"> <?php foreach($teams as $team): ?>
												•
												<?=$team['team_name']?>
												<?php endforeach; ?>
											</p>
											<div class="card-footer bg-white border-top-grey pl-0">
												<div class="d-flex flex-wrap ">
													<span class="pl-3">
														<label class="f-11 text-dark-grey mb-12 text-capitalize"
															for="usr">Open Tasks</label>
														<p class="mb-0 f-18 f-w-500"><?=$NumberOfIncompleteTasks['task_count']?>
														</p>
													</span>
													<span class="pl-3">
														<label class="f-11 text-dark-grey mb-12 text-capitalize"
															for="usr">Projects</label>
														<p class="mb-0 f-18 f-w-500"><?=$NumberOfProjects['project_count'];?>
														</p>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card bg-white border-0 b-shadow-4  mt-4">
									<div
										class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
										<h4 class="f-18 f-w-500 mb-0">Profile Info</h4>
									</div>
									<div class="card-body ">
										<div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
											<p class="mb-0 text-lightest f-14 w-30 text-capitalize">Employee ID</p>
											<p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?=$employee['employee_id']?>
											</p>
										</div>
										<div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
											<p class="mb-0 text-lightest f-14 w-30 text-capitalize">Full Name</p>
											<p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?=$employee['name']?>
											</p>
										</div>
										<div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
											<p class="mb-0 text-lightest f-14 w-30 text-capitalize">Email</p>
											<p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?=$employee['email']?>
											</p>
										</div>
										<div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
											<p class="mb-0 text-lightest f-14 w-30 text-capitalize">Mobile</p>
											<p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?=$employee['mobile']?>
											</p>
										</div>
										<div class="col-12 px-0 pb-3 d-block d-lg-flex d-md-flex">
											<p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">
												Gender
											</p>
											<p class="mb-0 text-dark-grey f-14 w-70">
												<?=$employee['gender']?>
											</p>
										</div>
										<div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
											<p class="mb-0 text-lightest f-14 w-30 text-capitalize">Date of Birth</p>
											<p class="mb-0 text-dark-grey f-14 w-70 text-wrap"> <?=$employee['date_of_birth']?>
											</p>
										</div>
										<div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
											<p class="mb-0 text-lightest f-14 w-30 text-capitalize">Slack Username</p>
											<p class="mb-0 text-dark-grey f-14 w-70 text-wrap"> <?=$employee['slack_username']?>
											</p>
										</div>
										<div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
											<p class="mb-0 text-lightest f-14 w-30 text-capitalize">Address</p>
											<p class="mb-0 text-dark-grey f-14 w-70 text-wrap"> <?=$employee['address']?>
											</p>
										</div>
										<div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
											<p class="mb-0 text-lightest f-14 w-30 text-capitalize">Skills</p>
											<p class="mb-0 text-dark-grey f-14 w-70 text-wrap"> <?=$employee['skills']?>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6">
								<div class="row">
									<div class="col-md-12 mb-4">
										<div class="card bg-white border-0 b-shadow-4">
											<div
												class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
												<h4 class="f-18 f-w-500 mb-0">Tasks</h4>
											</div>
											<div class="card-body p-0 ">
												<div class="text-center text-lightest p-20" style="height: 250px">
													<i class="side-icon f-21 bi bi-pie-chart"></i>
													<div class="f-15 mt-4">
														- Not enough data -
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="project-right my-4 my-lg-0">
				<div class="bg-white">
					<div class="p-activity-heading d-flex align-items-center justify-content-between b-shadow-4 p-20">
						<p class="mb-0 f-18 f-w-500">Activity</p>
					</div>
					<div class="p-activity-detail cal-info b-shadow-4" data-menu-vertical="1" data-menu-scroll="1"
						data-menu-dropdown-timeout="500" id="projectActivityDetail">
						<?php foreach($getUserActivity as $activity):?>
						<div class="card border-0 b-shadow-4 p-20 rounded-0">
							<div class="card-horizontal">
								<div class="card-header m-0 p-0 bg-white rounded">
									<span class="f-12 p-1 "><?=date('M', strtotime($activity['created_at']))?></span>
									<span class="f-13 f-w-500 rounded-bottom"><?=date('d', strtotime($activity['created_at']))?></span>
								</div>
								<div class="card-body border-0 p-0 ml-3">
									<h4 class="card-title f-14 font-weight-normal text-capitalize"><?=$activity['activity']?>
									</h4>
									<p class="card-text f-12 text-dark-grey">
										<?=date('H:i', strtotime($activity['created_at']))?>
									</p>
								</div>
							</div>
						</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php  if(isset($_GET['tab']) && $_GET['tab'] == 'projects') { ?>
		<div class="d-flex flex-column w-tables rounded mt-3 bg-white">

			<div id="projects-table_wrapper">
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-hover border-0 w-100" id="projects-table">
							<thead>
								<tr>
									<th>Id</th>
									<th>Project Name</th>
									<th>Members</th>
									<th>Deadline</th>
									<th>Client</th>
									<th>Progress</th>
									<th>Status</th>
									<th>Action </th>
								</tr>
							</thead>
							<tbody>
								<?php
                         if (empty($projects)) {
                             echo ' <tr id="row-1" role="row" class="odd">
                             <td>empty</td></tr>';
                         } else {
                             foreach ($projects as $project) { ?>
								<tr>

									<td><?=$project['project_id']?>
									</td>
									<td>
										<div class="media align-items-center">
											<div class="media-body">
												<h5 class="mb-0 f-13 text-darkest-grey"><a
														href="<?=ROOT?>/project/<?=$project['project_id']?>"><?=$project['project_name']?></a>
												</h5>
												<p class="mb-0"></p>
											</div>
										</div>
									</td>
									<td>


										<div class="position-relative">
											<?php
                                            $left = 0;
                                 foreach($employeeModel->getMembersOfProject($project['project_id']) as $member):
                                     $left = $left + 13;
                                     ?>

											<div class="taskEmployeeImg rounded-circle position-absolute"
												style="top:-10px; left:  <?=$left?>px">
												<a
													href="<?=ROOT?>/employees/<?=$member['user_id'];?>">
													<img src="<?php
                                                 if ($member['image']) {
                                                     echo ROOT.'/'.$member['image'];
                                                 } else {
                                                     echo 'https://www.gravatar.com/avatar/f7e016ba33bbc6009459c4f37ce1c0e4.png?s=200&amp;d=mp';
                                                 }?>"
														title="<?=$member['name']?>" /></a>
											</div>
											<?php endforeach;?>

										</div>
									</td>
									<td><?=$project['deadline'];?>
									</td>
									<td>
										<div class="media align-items-center mw-250">
											<a href="<?=ROOT?>/client/<?=$project['client_id']?>"
												class="position-relative">
												<img src="<?php
                                                 if ($project['image']) {
                                                     echo ROOT.'/'.$project['image'];
                                                 } else {
                                                     echo 'https://www.gravatar.com/avatar/f7e016ba33bbc6009459c4f37ce1c0e4.png?s=200&amp;d=mp';
                                                 }?>" class="mr-2 taskEmployeeImg rounded-circle"
													alt="<?=$project['client_name']?>"
													title="<?=$project['client_name']?>">
											</a>
											<div class="media-body">
												<h5 class="mb-0 f-12"><a
														href="<?=ROOT?>/client/<?=$project['client_id']?>"
														class="text-darkest-grey"><?=$project['client_name']?></a>
												</h5>
												<p class="mb-0 f-12 text-dark-grey">
													<?=$project['company_name']?>
												</p>
											</div>
										</div>
									</td>
									<td>
										<div class="progress" style="height: 15px;">
											<div class="progress-bar f-12 
                                            <?php if($project['completion_percent'] < 50) {
                                                echo 'bg-danger';
                                            } elseif($project['completion_percent'] > 50 && $project['completion_percent'] < 80) {
                                                echo 'bg-warning';
                                            } else {
                                                echo 'bg-success';
                                            }?>" role="progressbar"
												style="width: <?=$project['completion_percent']?>%;"
												aria-valuenow="<?=$project['completion_percent']?>"
												aria-valuemin="0" aria-valuemax="100"><?=$project['completion_percent']?>%
											</div>
										</div>
									</td>
									<td>
										<?=$project['status']?>
									</td>
									<td>
										<div class="task_view">

											<div class="dropdown">
												<a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle"
													type="link" id="dropdownMenuLink-1" data-toggle="dropdown"
													aria-haspopup="true" aria-expanded="false">
													<i class="icon-options-vertical icons"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right"
													aria-labelledby="dropdownMenuLink-1" tabindex="0"
													x-placement="bottom-end"
													style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-169px, 26px, 0px);">
													<a href="http://localhost/script/public/account/projects/1"
														class="dropdown-item"><svg
															class="svg-inline--fa fa-eye fa-w-18 mr-2"
															aria-hidden="true" focusable="false" data-prefix="fa"
															data-icon="eye" role="img"
															xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
															data-fa-i2svg="">
															<path fill="currentColor"
																d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
															</path>
														</svg>
														<!-- <i class="fa fa-eye mr-2"></i> Font Awesome fontawesome.com -->View</a><a
														class="dropdown-item openRightModal"
														href="http://localhost/script/public/account/projects/1/edit">
														<svg class="svg-inline--fa fa-edit fa-w-18 mr-2"
															aria-hidden="true" focusable="false" data-prefix="fa"
															data-icon="edit" role="img"
															xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
															data-fa-i2svg="">
															<path fill="currentColor"
																d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z">
															</path>
														</svg>
														<!-- <i class="fa fa-edit mr-2"></i> Font Awesome fontawesome.com -->
														Edit
													</a><a class="dropdown-item"
														href="http://localhost/script/public/account/projects/1?tab=gantt">
														<svg class="svg-inline--fa fa-project-diagram fa-w-20 mr-2"
															aria-hidden="true" focusable="false" data-prefix="fa"
															data-icon="project-diagram" role="img"
															xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
															data-fa-i2svg="">
															<path fill="currentColor"
																d="M384 320H256c-17.67 0-32 14.33-32 32v128c0 17.67 14.33 32 32 32h128c17.67 0 32-14.33 32-32V352c0-17.67-14.33-32-32-32zM192 32c0-17.67-14.33-32-32-32H32C14.33 0 0 14.33 0 32v128c0 17.67 14.33 32 32 32h95.72l73.16 128.04C211.98 300.98 232.4 288 256 288h.28L192 175.51V128h224V64H192V32zM608 0H480c-17.67 0-32 14.33-32 32v128c0 17.67 14.33 32 32 32h128c17.67 0 32-14.33 32-32V32c0-17.67-14.33-32-32-32z">
															</path>
														</svg>
														<!-- <i class="fa fa-project-diagram mr-2"></i> Font Awesome fontawesome.com -->
														Gantt Chart
													</a><a class="dropdown-item" target="_blank"
														href="http://localhost/script/public/gantt-chart/DmnnWALTrJlZacdHh81zClIAPXp41uTE">
														<svg class="svg-inline--fa fa-share-square fa-w-18 mr-2"
															aria-hidden="true" focusable="false" data-prefix="fa"
															data-icon="share-square" role="img"
															xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
															data-fa-i2svg="">
															<path fill="currentColor"
																d="M568.482 177.448L424.479 313.433C409.3 327.768 384 317.14 384 295.985v-71.963c-144.575.97-205.566 35.113-164.775 171.353 4.483 14.973-12.846 26.567-25.006 17.33C155.252 383.105 120 326.488 120 269.339c0-143.937 117.599-172.5 264-173.312V24.012c0-21.174 25.317-31.768 40.479-17.448l144.003 135.988c10.02 9.463 10.028 25.425 0 34.896zM384 379.128V448H64V128h50.916a11.99 11.99 0 0 0 8.648-3.693c14.953-15.568 32.237-27.89 51.014-37.676C185.708 80.83 181.584 64 169.033 64H48C21.49 64 0 85.49 0 112v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48v-88.806c0-8.288-8.197-14.066-16.011-11.302a71.83 71.83 0 0 1-34.189 3.377c-7.27-1.046-13.8 4.514-13.8 11.859z">
															</path>
														</svg>
														<!-- <i class="fa fa-share-square mr-2"></i> Font Awesome fontawesome.com -->
														Public Gantt Chart
													</a><a class="dropdown-item" target="_blank"
														href="http://localhost/script/public/task-board/DmnnWALTrJlZacdHh81zClIAPXp41uTE">
														<svg class="svg-inline--fa fa-share-square fa-w-18 mr-2"
															aria-hidden="true" focusable="false" data-prefix="fa"
															data-icon="share-square" role="img"
															xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
															data-fa-i2svg="">
															<path fill="currentColor"
																d="M568.482 177.448L424.479 313.433C409.3 327.768 384 317.14 384 295.985v-71.963c-144.575.97-205.566 35.113-164.775 171.353 4.483 14.973-12.846 26.567-25.006 17.33C155.252 383.105 120 326.488 120 269.339c0-143.937 117.599-172.5 264-173.312V24.012c0-21.174 25.317-31.768 40.479-17.448l144.003 135.988c10.02 9.463 10.028 25.425 0 34.896zM384 379.128V448H64V128h50.916a11.99 11.99 0 0 0 8.648-3.693c14.953-15.568 32.237-27.89 51.014-37.676C185.708 80.83 181.584 64 169.033 64H48C21.49 64 0 85.49 0 112v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48v-88.806c0-8.288-8.197-14.066-16.011-11.302a71.83 71.83 0 0 1-34.189 3.377c-7.27-1.046-13.8 4.514-13.8 11.859z">
															</path>
														</svg>
														<!-- <i class="fa fa-share-square mr-2"></i> Font Awesome fontawesome.com -->
														Public Task Board
													</a><a class="dropdown-item archive" href="javascript:;"
														data-user-id="1">
														<svg class="svg-inline--fa fa-archive fa-w-16 mr-2"
															aria-hidden="true" focusable="false" data-prefix="fa"
															data-icon="archive" role="img"
															xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
															data-fa-i2svg="">
															<path fill="currentColor"
																d="M32 448c0 17.7 14.3 32 32 32h384c17.7 0 32-14.3 32-32V160H32v288zm160-212c0-6.6 5.4-12 12-12h104c6.6 0 12 5.4 12 12v8c0 6.6-5.4 12-12 12H204c-6.6 0-12-5.4-12-12v-8zM480 32H32C14.3 32 0 46.3 0 64v48c0 8.8 7.2 16 16 16h480c8.8 0 16-7.2 16-16V64c0-17.7-14.3-32-32-32z">
															</path>
														</svg>
														<!-- <i class="fa fa-archive mr-2"></i> Font Awesome fontawesome.com -->
														Archive
													</a><a class="dropdown-item delete-table-row" href="javascript:;"
														data-user-id="1">
														<svg class="svg-inline--fa fa-trash fa-w-14 mr-2"
															aria-hidden="true" focusable="false" data-prefix="fa"
															data-icon="trash" role="img"
															xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
															data-fa-i2svg="">
															<path fill="currentColor"
																d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z">
															</path>
														</svg>
														<!-- <i class="fa fa-trash mr-2"></i> Font Awesome fontawesome.com -->
														Delete
													</a>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<?php }
                             }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php } elseif(isset($_GET['tab']) && $_GET['tab'] == 'tasks') { ?>
		<div class="row py-0 py-md-0 py-lg-3">
			<div class="col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4">



				<!-- Add Task Export Buttons Start -->
				<div class="d-flex justify-content-between action-bar">
					<div id="table-actions" class="align-items-center">
						<a href="http://localhost/script/public/account/tasks/create?default_assign=1"
							class="btn-primary rounded f-14 p-2 mr-3 openRightModal float-left"
							data-redirect-url="http://localhost/script/public/account/employees/1?tab=tasks">
							<svg class="svg-inline--fa fa-plus fa-w-14 mr-1" aria-hidden="true" focusable="false"
								data-prefix="fa" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 448 512" data-fa-i2svg="">
								<path fill="currentColor"
									d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
								</path>
							</svg><!-- <i class="fa fa-plus mr-1"></i> Font Awesome fontawesome.com -->
							Add Task
						</a>

					</div>


				</div>

				<!-- Task Box Start -->
				<div class="d-flex flex-column w-tables rounded mt-3 bg-white">

					<div id="allTasks-table_wrapper" class="">
						<div class="row">
							<div class="col-sm-12">
								<table class="table table-hover border-0 w-100 dataTable no-footer" id="tasks-table"
									role="grid" aria-describedby="allTasks-table_info" style="width: 1589px;">
									<thead>
										<tr role="row">

											<th>Id</th>

											<th>Task</th>
											<th>Project</th>
											<th>Due Date</th>

											<th>Assigned To
											</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr id="row-1" role="row" class="odd">

											<td class="sorting_1">1</td>

											<td>
												<div class="media align-items-center">
													<div class="media-body">
														<h5 class="mb-0 f-13 text-darkest-grey"><a
																href="http://localhost/script/public/account/tasks/1"
																class="openRightModal">Test</a></h5>
														<p class="mb-0"> </p>
													</div>
												</div>
											</td>
											<td><a href="http://localhost/script/public/account/projects/1"
													class="text-darkest-grey">Test</a></td>
											<td><span class="text-danger">18-10-2022</span></td>

											<td>
												<div class="position-relative">
													<div class="taskEmployeeImg rounded-circle " style="left:  0px"><a
															href="http://localhost/script/public/account/employees/1"><img
																data-toggle="tooltip" data-original-title="Pedro"
																src="https://www.gravatar.com/avatar/7fcefe645acaa3363d8f10bdfba33c0d.png?s=200&amp;d=mp"></a>
													</div>
												</div>
											</td>
											<td>
												<div
													class="dropdown bootstrap-select form-control select-picker change-status">
													<select class="form-control select-picker change-status"
														data-task-id="1" tabindex="null">
														<option
															data-content="<i class='fa fa-circle mr-2' style='color: #d21010'></i> Incomplete"
															value="incomplete">Incomplete</option>
														<option selected=""
															data-content="<i class='fa fa-circle mr-2' style='color: #679c0d'></i> Completed"
															value="completed">Completed</option>
													</select><button type="button" tabindex="-1"
														class="btn dropdown-toggle btn-light" data-toggle="dropdown"
														role="combobox" aria-owns="bs-select-4" aria-haspopup="listbox"
														aria-expanded="false" title="Completed">
														<div class="filter-option">
															<div class="filter-option-inner">
																<div class="filter-option-inner-inner"><svg
																		class="svg-inline--fa fa-circle fa-w-16 mr-2"
																		style="color: #679c0d;" aria-hidden="true"
																		focusable="false" data-prefix="fa"
																		data-icon="circle" role="img"
																		xmlns="http://www.w3.org/2000/svg"
																		viewBox="0 0 512 512" data-fa-i2svg="">
																		<path fill="currentColor"
																			d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
																		</path>
																	</svg>
																	<!-- <i class="fa fa-circle mr-2" style="color: #679c0d"></i> Font Awesome fontawesome.com -->
																	Completed</div>
															</div>
														</div>
													</button>
													<div class="dropdown-menu"
														style="max-height: 198.5px; overflow: hidden; min-height: 0px; position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;"
														x-placement="bottom-start">
														<div class="inner show" role="listbox" id="bs-select-4"
															tabindex="-1" aria-activedescendant="bs-select-4-1"
															style="max-height: 180.5px; overflow-y: auto; min-height: 0px;">
															<ul class="dropdown-menu inner show" role="presentation"
																style="margin-top: 0px; margin-bottom: 0px;">
																<li><a role="option" class="dropdown-item"
																		id="bs-select-4-0" tabindex="0"><span
																			class="text"><svg
																				class="svg-inline--fa fa-circle fa-w-16 mr-2"
																				style="color: #d21010;"
																				aria-hidden="true" focusable="false"
																				data-prefix="fa" data-icon="circle"
																				role="img"
																				xmlns="http://www.w3.org/2000/svg"
																				viewBox="0 0 512 512" data-fa-i2svg="">
																				<path fill="currentColor"
																					d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
																				</path>
																			</svg>
																			<!-- <i class="fa fa-circle mr-2" style="color: #d21010"></i> Font Awesome fontawesome.com -->
																			Incomplete</span></a></li>
																<li class="selected active"><a role="option"
																		class="dropdown-item active selected"
																		id="bs-select-4-1" tabindex="0" aria-setsize="2"
																		aria-posinset="2" aria-selected="true"><span
																			class="text"><svg
																				class="svg-inline--fa fa-circle fa-w-16 mr-2"
																				style="color: #679c0d;"
																				aria-hidden="true" focusable="false"
																				data-prefix="fa" data-icon="circle"
																				role="img"
																				xmlns="http://www.w3.org/2000/svg"
																				viewBox="0 0 512 512" data-fa-i2svg="">
																				<path fill="currentColor"
																					d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
																				</path>
																			</svg>
																			<!-- <i class="fa fa-circle mr-2" style="color: #679c0d"></i> Font Awesome fontawesome.com -->
																			Completed</span></a></li>
															</ul>
														</div>
													</div>
												</div>
											</td>
											<td class=" text-right pr-20">
												<div class="task_view">

													<div class="dropdown">
														<a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle"
															type="link" id="dropdownMenuLink-1" data-toggle="dropdown"
															aria-haspopup="true" aria-expanded="false">
															<i class="icon-options-vertical icons"></i>
														</a>
														<div class="dropdown-menu dropdown-menu-right"
															aria-labelledby="dropdownMenuLink-1" tabindex="0"
															x-placement="bottom-end"
															style="position: absolute; transform: translate3d(-137px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
															<a href="http://localhost/script/public/account/tasks/1"
																class="dropdown-item openRightModal"><svg
																	class="svg-inline--fa fa-eye fa-w-18 mr-2"
																	aria-hidden="true" focusable="false"
																	data-prefix="fa" data-icon="eye" role="img"
																	xmlns="http://www.w3.org/2000/svg"
																	viewBox="0 0 576 512" data-fa-i2svg="">
																	<path fill="currentColor"
																		d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
																	</path>
																</svg>
																<!-- <i class="fa fa-eye mr-2"></i> Font Awesome fontawesome.com -->View</a><a
																class="dropdown-item openRightModal"
																href="http://localhost/script/public/account/tasks/1/edit">
																<svg class="svg-inline--fa fa-edit fa-w-18 mr-2"
																	aria-hidden="true" focusable="false"
																	data-prefix="fa" data-icon="edit" role="img"
																	xmlns="http://www.w3.org/2000/svg"
																	viewBox="0 0 576 512" data-fa-i2svg="">
																	<path fill="currentColor"
																		d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z">
																	</path>
																</svg>
																<!-- <i class="fa fa-edit mr-2"></i> Font Awesome fontawesome.com -->
																Edit
															</a><a class="dropdown-item delete-table-row"
																href="javascript:;" data-user-id="1">
																<svg class="svg-inline--fa fa-trash fa-w-14 mr-2"
																	aria-hidden="true" focusable="false"
																	data-prefix="fa" data-icon="trash" role="img"
																	xmlns="http://www.w3.org/2000/svg"
																	viewBox="0 0 448 512" data-fa-i2svg="">
																	<path fill="currentColor"
																		d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z">
																	</path>
																</svg>
																<!-- <i class="fa fa-trash mr-2"></i> Font Awesome fontawesome.com -->
																Delete
															</a><a class="dropdown-item openRightModal"
																href="http://localhost/script/public/account/tasks/create?duplicate_task=1">
																<svg class="svg-inline--fa fa-clone fa-w-16"
																	aria-hidden="true" focusable="false"
																	data-prefix="fa" data-icon="clone" role="img"
																	xmlns="http://www.w3.org/2000/svg"
																	viewBox="0 0 512 512" data-fa-i2svg="">
																	<path fill="currentColor"
																		d="M464 0c26.51 0 48 21.49 48 48v288c0 26.51-21.49 48-48 48H176c-26.51 0-48-21.49-48-48V48c0-26.51 21.49-48 48-48h288M176 416c-44.112 0-80-35.888-80-80V128H48c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48h288c26.51 0 48-21.49 48-48v-48H176z">
																	</path>
																</svg>
																<!-- <i class="fa fa-clone"></i> Font Awesome fontawesome.com -->
																Duplicate
															</a>
														</div>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>

							</div>
						</div>

					</div>

				</div>
				<!-- Task Box End -->
			</div>
		</div>
		<?php } elseif(isset($_GET['tab']) && $_GET['tab'] == 'documents') { ?>
		<div class="content-wrapper pt-0 border-top-0 client-detail-wrapper" style="position: relative; zoom: 1;">
			<style>
				.file-action {
					visibility: hidden;
				}

				.file-card:hover .file-action {
					visibility: visible;
				}
			</style>

			<!-- TAB CONTENT START -->
			<div class="tab-pane fade show active mt-5" role="tabpanel" aria-labelledby="nav-email-tab">
				<div class="card bg-white border-0 b-shadow-4">
					<div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
						<h4 class="f-18 f-w-500 mb-0">Documents</h4>



					</div>

					<div class="card-body ">
						<div class="row">
							<div class="col-md-12">
								<a class="f-15 f-w-500" href="javascript:;" id="add-task-file"><i
										class="icons icon-plus font-weight-bold mr-1"></i>Add Files</a>
							</div>
						</div>

						<form method="POST" id="save-taskfile-data-form" class="d-none" autocomplete="off"
							enctype="application/x-www-form-urlencoded">

							<div class="row">
								<div class="col-md-12">
									<div class="form-group my-3">
										<label class="f-14 text-dark-grey mb-12" data-label="true" for="file_name">File
											name
											<sup class="f-14 mr-1">*</sup>

										</label>

										<input type="text" class="form-control height-35 f-14" placeholder="" value=""
											name="name" id="file_name" autocomplete="off" data-np-invisible="1"
											data-np-checked="1">

									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group my-3">
										<label class="f-14 text-dark-grey mb-12" data-label="true"
											for="employee_file">Upload File
											<sup class="f-14 mr-1">*</sup>

											<svg class="svg-inline--fa fa-question-circle fa-w-16" data-toggle="popover"
												data-placement="top"
												data-content="only .txt, .pdf, .doc, .xls, .xlsx, .docx, .rtf, .png, .jpg, .jpeg formats are allowed."
												data-html="true" data-trigger="hover" aria-hidden="true"
												focusable="false" data-prefix="fa" data-icon="question-circle"
												role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
												data-fa-i2svg="" data-original-title="" title="">
												<path fill="currentColor"
													d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zM262.655 90c-54.497 0-89.255 22.957-116.549 63.758-3.536 5.286-2.353 12.415 2.715 16.258l34.699 26.31c5.205 3.947 12.621 3.008 16.665-2.122 17.864-22.658 30.113-35.797 57.303-35.797 20.429 0 45.698 13.148 45.698 32.958 0 14.976-12.363 22.667-32.534 33.976C247.128 238.528 216 254.941 216 296v4c0 6.627 5.373 12 12 12h56c6.627 0 12-5.373 12-12v-1.333c0-28.462 83.186-29.647 83.186-106.667 0-58.002-60.165-102-116.531-102zM256 338c-25.365 0-46 20.635-46 46 0 25.364 20.635 46 46 46s46-20.636 46-46c0-25.365-20.635-46-46-46z">
												</path>
											</svg>
											<!-- <i class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-content="only .txt, .pdf, .doc, .xls, .xlsx, .docx, .rtf, .png, .jpg, .jpeg formats are allowed." data-html="true" data-trigger="hover"></i> Font Awesome fontawesome.com -->
										</label>

										<input type="file" id="input-file-now"
											data-allowed-file-extensions=".txt pdf doc xls xlsx docx rtf png jpg jpeg"
											class="dropify" name="file" />

									</div>
								</div>
								<div class="col-md-12">
									<div class="w-100 justify-content-end d-flex mt-2">
										<a href="javascript:;" class="btn-cancel rounded f-14 p-2 border-0 mr-3"
											id="cancel-document">
											Cancel
										</a>
										<button type="button" class="btn-primary rounded f-14 p-2" id="submit-document">
											<svg class="svg-inline--fa fa-check fa-w-16 mr-1" aria-hidden="true"
												focusable="false" data-prefix="fa" data-icon="check" role="img"
												xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
												data-fa-i2svg="">
												<path fill="currentColor"
													d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
												</path>
											</svg><!-- <i class="fa fa-check mr-1"></i> Font Awesome fontawesome.com -->
											Submit
										</button>




									</div>
								</div>
							</div>
						</form>

						<div class="d-flex flex-wrap mt-3" id="task-file-list">
							<?php foreach($employeeFiles as $file):
							    $time = date_diff(date_create('now'), date_create($file['created_at']));
							    if ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') == 0) {
							        $time = $time->format('%s seconds ago');
							    } elseif ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') > 0) {
							        $time = $time->format('%i minutes ago');
							    } elseif ($time->format('%a') == 0 && $time->format('%h') > 0) {
							        $time = $time->format('%h hours ago');
							    } else {
							        $time = $time->format('%a days ago');
							    }
							    ?>
							<div class="card bg-white border-grey file-card mr-3 mb-3">
								<div class="card-horizontal">
									<div class="card-img mr-0">
										<?php
							                $fileE = explode('.', $file['filename']);
							    $extension = ltrim($fileE[count($fileE) - 1]);
							    if($extension == 'pdf') {
							        $img = '<svg class="svg-inline--fa fa-file-pdf fa-w-12 text-lightest" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="file-pdf" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z"></path></svg>';
							    } elseif($extension == 'docx') {
							        $img = '<svg class="svg-inline--fa fa-file-word fa-w-12 text-lightest" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="file-word" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M377.9 105l-98-98c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.4-2.5-12.5-7-17zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2z"></path></svg>';
							    } elseif($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif') {
							        $img = '<img src="'.ROOT.'/'.$file["filename"].'">';
							    } else {
							        $img = '<svg class="svg-inline--fa fa-file-pdf fa-w-12 text-lightest" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="file-pdf" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z"></path></svg>';
							    }
							    ?>
										<?=$img?>
									</div>
									<div class="card-body pr-2">
										<div class="d-flex flex-grow-1">
											<h4 class="card-title f-12 text-dark-grey mr-3 text-truncate"
												data-toggle="tooltip" data-original-title="asdsad"><?=$file['name']?>
											</h4>
											<div class="dropdown ml-auto file-action">
												<button
													class="btn btn-lg f-14 p-0 text-lightest text-capitalize rounded  dropdown-toggle"
													type="button" data-toggle="dropdown" aria-haspopup="true"
													aria-expanded="false">
													<svg class="svg-inline--fa fa-ellipsis-h fa-w-16" aria-hidden="true"
														focusable="false" data-prefix="fa" data-icon="ellipsis-h"
														role="img" xmlns="http://www.w3.org/2000/svg"
														viewBox="0 0 512 512" data-fa-i2svg="">
														<path fill="currentColor"
															d="M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z">
														</path>
													</svg>
													<!-- <i class="fa fa-ellipsis-h"></i> Font Awesome fontawesome.com -->
												</button>

												<div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
													aria-labelledby="dropdownMenuLink" tabindex="0">

													<a class="cursor-pointer d-block text-dark-grey f-13 pt-3 px-3 "
														target="_blank"
														href="<?=ROOT?>/<?=$file['filename']?>">View</a>

													<a class="cursor-pointer d-block text-dark-grey f-13 py-3 px-3 "
														href="<?=ROOT?>/<?=$file['filename']?>">Download</a>

													<a class="cursor-pointer d-block text-dark-grey pb-3 f-13 px-3 edit-file"
														href="javascript:;" data-file-id="1">Edit</a>

													<a class="cursor-pointer d-block text-dark-grey f-13 pb-3 px-3 delete-file"
														data-row-id="1" href="javascript:;">Delete</a>
												</div>
											</div>
										</div>
										<div class="card-date f-11 text-lightest">
											<?=$time?>
										</div>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<!-- TAB CONTENT END -->

			<script>
				$('#add-task-file').click(function() {
					$(this).closest('.row').addClass('d-none');
					$('#save-taskfile-data-form').removeClass('d-none');
				});

				$(document).ready(function() {
					// Basic
					$('.dropify').dropify();



					// Used events
					var drEvent = $('#input-file-events').dropify();

					drEvent.on('dropify.beforeClear', function(event, element) {
						return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
					});

					drEvent.on('dropify.afterClear', function(event, element) {
						alert('File deleted');
					});

					drEvent.on('dropify.errors', function(event, element) {
						console.log('Has Errors');
					});

					var drDestroy = $('#input-file-to-destroy').dropify();
					drDestroy = drDestroy.data('dropify')
					$('#toggleDropify').on('click', function(e) {
						e.preventDefault();
						if (drDestroy.isDropified()) {
							drDestroy.destroy();
						} else {
							drDestroy.init();
						}
					})
				});



				$('#submit-document').click(function() {
					var form = $('#save-taskfile-data-form');
					var formData = new FormData(form[0]);
					$.ajax({
						url: '<?=ROOT;?>/employeedetails/<?=$id;?>?action=uploadfile',
						type: 'POST',
						data: formData,
						processData: false,
						contentType: false,
						success: function(response) {
							if (response.status) {
								console.log(response.data);
								$('#task-file-list').append(response.data);
								$('#save-taskfile-data-form').addClass('d-none');
								$('#add-task-file').closest('.row').removeClass('d-none');
								$('#save-taskfile-data-form')[0].reset();
								$('.dropify-clear').trigger('click');
							}
						}
					});

				});

				$('body').on('click', '.delete-file', function() {
					var id = $(this).data('row-id');
					Swal.fire({
						title: "Are you sure?",
						text: "You will not be able to recover the deleted record!",
						icon: 'warning',
						showCancelButton: true,
						focusConfirm: false,
						confirmButtonText: "Yes, delete it!",
						cancelButtonText: "Cancel",
						customClass: {
							confirmButton: 'btn btn-primary mr-3',
							cancelButton: 'btn btn-secondary'
						},
						showClass: {
							popup: 'swal2-noanimation',
							backdrop: 'swal2-noanimation'
						},
						buttonsStyling: false
					}).then((result) => {
						if (result.isConfirmed) {
							var url = "employee-docs/:id";
							url = url.replace(':id', id);


							$.ajax({
								type: 'POST',
								url: url,
								data: {
									'_token': token,
									'_method': 'DELETE'
								},
								success: function(response) {
									if (response.status == "success") {
										$('#task-file-list').html(response.view);
									}
								}
							});
						}
					});
				});
			</script>
		</div>
		<?php }?>
	</div>
</section>
<?php require_once("layout/footer.php");


?>

<script>
	$(document).ready(function() {
		$('#projects-table').DataTable({
			initComplete: function() {
				this.api()
					.columns()
					.every(function() {
						var column = this;
						var select = $('<select><option value=""></option></select>')
							.appendTo($(column.footer()).empty())
							.on('change', function() {
								var val = $.fn.dataTable.util.escapeRegex($(this).val());

								column.search(val ? '^' + val + '$' : '', true, false)
									.draw();
							});

						column
							.data()
							.unique()
							.sort()
							.each(function(d, j) {
								select.append('<option value="' + d + '">' + d +
									'</option>');
							});
					});
			},
		});

		$('#tasks-table').DataTable({
			initComplete: function() {
				this.api()
					.columns()
					.every(function() {
						var column = this;
						var select = $('<select><option value=""></option></select>')
							.appendTo($(column.footer()).empty())
							.on('change', function() {
								var val = $.fn.dataTable.util.escapeRegex($(this).val());

								column.search(val ? '^' + val + '$' : '', true, false)
									.draw();
							});

						column
							.data()
							.unique()
							.sort()
							.each(function(d, j) {
								select.append('<option value="' + d + '">' + d +
									'</option>');
							});
					});
			},
		});
	});
</script>
<?php require_once("layout/header.php"); ?>
<?php require_once("layout/navbar.php"); ?>
<section class="main-container bg-additional-grey" id="fullscreen">
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
				<!-- <i class="fa fa-times"></i> Font Awesome fontawesome.com -->
			</a>
			<nav class="tabs --jsfied">
				<ul class="-primary">
					<li>
						<a href="http://localhost/script/public/account/projects/1"
							class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab overview active"><span>Overview</span></a>
					</li>
					<li>
						<a href="http://localhost/script/public/account/projects/1?tab=members"
							class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab members"><span>Members</span></a>
					</li>
					<li>
						<a href="http://localhost/script/public/account/projects/1?tab=files"
							class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab files"><span>Files</span></a>
					</li>
					<li>
						<a href="http://localhost/script/public/account/projects/1?tab=tasks"
							class="text-dark-grey text-capitalize border-right-grey p-sub-menu tasks"><span>Tasks</span></a>
					</li>
					<li>
						<a href="http://localhost/script/public/account/projects/1?tab=taskboard"
							class="text-dark-grey text-capitalize border-right-grey p-sub-menu taskboard"><span>Task
								Board</span></a>
					</li>
					<li>
						<a href="http://localhost/script/public/account/projects/1?tab=discussion"
							class="text-dark-grey text-capitalize border-right-grey p-sub-menu discussion"><span>Discussion</span></a>
					</li>
					<li>
						<a href="http://localhost/script/public/account/projects/1?tab=notes"
							class="text-dark-grey text-capitalize border-right-grey p-sub-menu notes"><span>Notes</span></a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<!-- PAGE TITLE END -->
	<div class="content-wrapper pt-0 border-top-0 client-detail-wrapper">
		<script src="<?=ROOT?>/js/Chart.min.js"></script>
		<script src="<?=ROOT?>/js/gauge.js"></script>
		<div class="d-lg-flex">
			<div class="project-left w-100 py-0 py-lg-5 py-md-0 ">
				<!-- PROJECT PROGRESS AND CLIENT START -->
				<div class="row">
					<!-- PROJECT PROGRESS START -->
					<div class="col-8">
						<div class="row">
							<div class="col-12 mb-4">
								<div class="card bg-white border-0 b-shadow-4">
									<div
										class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
										<h4 class="f-18 f-w-500 mb-0">Client</h4>
									</div>
									<div
										class="card-body d-block d-xl-flex d-lg-block d-md-flex  justify-content-between align-items-center">
										<div class="p-client-detail">
											<div class="card border-0 ">
												<div class="card-horizontal">
													<div class="card-img m-0">
														<img class=""
															src=" https://www.gravatar.com/avatar/f7e016ba33bbc6009459c4f37ce1c0e4.png?s=200&amp;d=mp"
															alt="Chines">
													</div>
													<div class="card-body border-0 p-0 ml-4 ml-xl-4 ml-lg-3 ml-md-3">
														<h4
															class="card-title f-15 font-weight-normal mb-0 text-capitalize">
															<a href="http://localhost/script/public/account/clients/5"
																class="text-dark"><?=$project['name'];?></a>
														</h4>
														<p class="card-text f-14 text-lightest mb-0">
															<?=$project['company_name'];?>
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12 ">
								<div class="card bg-white border-0 b-shadow-4">
									<div
										class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
										<h4 class="f-18 f-w-500 mb-0">Project Progress</h4>
									</div>
									<div
										class="card-body d-flex d-xl-flex d-lg-block d-md-flex  justify-content-between align-items-center">
										<div id="progressGauge"></div>
										<script>
											// Element inside which you want to see the chart

											// Element inside which you want to see the chart
											var elementGauge = document.querySelector("#progressGauge")

											// Properties of the gauge
											var gaugeOptions = {
												hasNeedle: false,
												needleColor: 'gray',
												needleUpdateSpeed: 1000,
												arcColors: ['rgb(44, 177, 0)', 'rgb(232, 238, 243)'],
												arcDelimiters: [50],
												rangeLabel: ['0', '100'],
												centralLabel: '50%'
											}
											// Drawing and updating the chart
											GaugeChart.gaugeChart(elementGauge, 100, gaugeOptions).updateNeedle(50);
										</script>
										<!-- PROGRESS START DATE START -->
										<div class="p-start-date mb-xl-0 mb-lg-3">
											<h5 class="text-lightest f-14 font-weight-normal">Start Date</h5>
											<p class="f-15 mb-0"><?=$project['start_date'];?>
											</p>
										</div>
										<!-- PROGRESS START DATE END -->
										<!-- PROGRESS END DATE START -->
										<div class="p-end-date">
											<h5 class="text-lightest f-14 font-weight-normal">Deadline</h5>
											<p class="f-15 mb-0">
												<?php
                                                    $deadline = $project['deadline'];
if($deadline > date('Y-m-d')) {
    echo $project['deadline'];
} else {
    echo ' <span class="badge badge-danger">Expired</span>';
    echo '<br>';
    echo '<span class="text-danger">'.$project['deadline'].'</span>';
}

?>
											</p>
										</div>
										<!-- PROGRESS END DATE END -->
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- PROJECT PROGRESS END -->
					<!-- CLIENT START -->
					<div class="col-4 h-75 ">
						<div class="d-flex align-content-center flex-lg-row-reverse mb-4">
							<div class="ml-lg-3 ml-md-0 ml-0 mr-3 mr-lg-0 mr-md-3">
								<select class="form-control change-status height-35">
									<option <?php if($project['status'] == 'in progress') {
									    echo 'selected';
									} ?> value="in
										progress"> In
										Progress
									</option>
									<option <?php if($project['status'] == 'on hold') {
									    echo 'selected';
									} ?>
										value="on hold">On Hold
									</option>
									<option <?php if($project['status'] == 'not started') {
									    echo 'selected';
									} ?>
										value="not started"> Not
										Started
									</option>
									<option <?php if($project['status'] == 'canceled') {
									    echo 'selected';
									} ?>
										value="canceled">Canceled
									</option>
									<option <?php if($project['status'] == 'finished') {
									    echo 'selected';
									} ?>
										value="finished">
										Finished
									</option>
								</select>
							</div>
							<div class="ml-lg-3 ml-md-0 ml-0 mr-3 mr-lg-0 mr-md-3">
								<div class="dropdown">
									<button
										class="btn btn-lg bg-white border height-35 f-15 px-2 py-1 text-dark-grey text-capitalize rounded  dropdown-toggle"
										type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action <i class="icon-options-vertical icons"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
										aria-labelledby="dropdownMenuLink" tabindex="0">
										<a class="dropdown-item openRightModal"
											href="http://localhost/script/public/account/projects/1/edit">Edit
											Project</a>
									</div>
								</div>
							</div>
						</div>
						<div class="card bg-white border-0 b-shadow-4">
							<div
								class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
								<h4 class="f-18 f-w-500 mb-0">Tasks</h4>
							</div>
							<?php
                                if(empty($getProjectTasks)) {
                                    echo '<div class="card-body p-20">';
                                    echo ' <i class="side-icon f-21 bi bi-pie-chart"></i>';
                                    echo '<div class="f-15 mt-4">';
                                    echo 'No Tasks Found';
                                    echo '</div>';
                                    echo '</div>';
                                } else {
                                    ?>
							<canvas id="task-chart" height="250" width="250"
								style="display: block; box-sizing: border-box; height: 250px; width: 250px;"></canvas>
						</div>
						<script>
							var ctx = document.getElementById("task-chart");
							var myChart = new Chart(ctx, {
								type: 'pie',
								data: {
									labels: [
										"Incomplete",
										"Completed",
									],
									datasets: [{
										label: 'Dataset 1',
										data: [
											0,
											1,
										],
										backgroundColor: [
											"#d21010",
											"#679c0d",
										],
									}]
								},
								options: {
									responsive: true,
									plugins: {
										legend: {
											position: 'right',
										},
										title: {
											display: false,
											text: 'Chart.js Pie Chart'
										}
									}
								},
							});
						</script>

						<?php
                                }
?>
					</div>
				</div>
				<!-- CLIENT END -->
			</div>
			<div class="row mt-4">
				<div class="col-md-12 mb-4">
					<div class="card bg-white border-0 b-shadow-4">
						<div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
							<h4 class="f-18 f-w-500 mb-0">Project Details</h4>
						</div>
						<div class="card-body d-flex justify-content-between align-items-center">
							<div class="text-dark-grey mb-0 ql-editor p-0">
								<?=$project['project_summary'];?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- PROJECT DETAILS END -->
		</div>
		<!-- PROJECT RIGHT START -->
		<div class="project-right pt-0 pb-4 p-lg-0">
			<div class="bg-white">
				<!-- ACTIVITY HEADING START -->
				<div class="p-activity-heading d-flex align-items-center justify-content-between b-shadow-4 p-20">
					<p class="mb-0 f-18 f-w-500">Activity</p>
				</div>
				<!-- ACTIVITY HEADING END -->
				<!-- ACTIVITY DETAIL START -->
				<div class="p-activity-detail cal-info b-shadow-4 scroll ps ps--active-y" data-menu-vertical="1"
					data-menu-scroll="1" data-menu-dropdown-timeout="500" id="projectActivityDetail"
					style="height: 386px; overflow: hidden;">
					<?php foreach($getProjectActivity as $activity):?>
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
				<!-- ACTIVITY DETAIL END -->
			</div>
		</div>
		<!-- PROJECT RIGHT END -->
	</div>
	<script>
		$(document).ready(function() {
			$('.change-status').change(function() {
				var status = $(this).val();
				var url = "http://localhost/script/public/account/projects/updateStatus/1";
				var token = '85qlEY6AY59ZB2DXR6JwWyMqqgZx6GjTjDVohelZ'

				$.easyAjax({
					url: url,
					type: "POST",
					container: '.content-wrapper',
					blockUI: true,
					data: {
						status: status,
						_token: token
					}
				});
			});

			$('body').on('click', '#pinnedItem', function() {
				var type = $('#pinnedItem').attr('data-pinned');
				var id = '1';
				var pinType = 'project';

				var dataPin = type.trim(type);
				if (dataPin == 'pinned') {
					Swal.fire({
						title: "Are you sure?",
						icon: 'warning',
						showCancelButton: true,
						focusConfirm: false,
						confirmButtonText: "Yes, unpin it!",
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
							var url =
								"http://localhost/script/public/account/projects/destroy-pin/:id";
							url = url.replace(':id', id);

							var token = "85qlEY6AY59ZB2DXR6JwWyMqqgZx6GjTjDVohelZ";
							$.easyAjax({
								type: 'POST',
								url: url,
								data: {
									'_token': token,
									'type': pinType
								},
								success: function(response) {
									if (response.status == "success") {
										window.location.reload();
									}
								}
							})
						}
					});

				} else {
					Swal.fire({
						title: "Are you sure?",
						icon: 'warning',
						showCancelButton: true,
						focusConfirm: false,
						confirmButtonText: "Yes, pin it!",
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
							var url =
								"http://localhost/script/public/account/projects/store-pin?type=" +
								pinType;

							var token = "85qlEY6AY59ZB2DXR6JwWyMqqgZx6GjTjDVohelZ";
							$.easyAjax({
								type: 'POST',
								url: url,
								data: {
									'_token': token,
									'project_id': id
								},
								success: function(response) {
									if (response.status == "success") {
										window.location.reload();
									}
								}
							});
						}
					});
				}
			});

			$('body').on('click', '.restore-project', function() {
				Swal.fire({
					title: "Are you sure?",
					text: "Do you want to restore this project.",
					icon: 'warning',
					showCancelButton: true,
					focusConfirm: false,
					confirmButtonText: "Yes, Restore it!",
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
						var url =
							"http://localhost/script/public/account/projects/archive-restore/1";

						var token = "85qlEY6AY59ZB2DXR6JwWyMqqgZx6GjTjDVohelZ";

						$.easyAjax({
							type: 'POST',
							url: url,
							data: {
								'_token': token
							},
							success: function(response) {
								if (response.status == "success") {
									window.location.reload();
								}
							}
						});
					}
				});
			});

			$('body').on('click', '#new-chat', function() {
				let clientId = $(this).data('client-id');
				const url = "http://localhost/script/public/account/messages/create?clientId=" +
					clientId;
				$(MODAL_LG + ' ' + MODAL_HEADING).html('...');
				$.ajaxModal(MODAL_LG, url);
			});

		});
	</script>
	</div>
</section>
<?php require_once("layout/footer.php");

<?php
require_once('views/layout/header.php');
require_once('views/layout/navbar.php');
?>



<section class="main-container bg-additional-grey" id="fullscreen">


	
	<div class="content-wrapper">
	
		<?php if($_SESSION['user_role'] <= 2):?>
		<div class="d-block d-lg-flex d-md-flex justify-content-between action-bar">
			<div id="table-actions" class="flex-grow-1 align-items-center">
				<a href="<?=ROOT?>/task/create"
					class="btn-primary rounded f-14 p-2 mr-3 openRightModal float-left">
					<i class="bi bi-plus"></i>
					<?=TASKS_ADD;?>
				</a>

				<button type="button" class="btn-secondary rounded f-14 p-2 mr-3 float-left" id="filter-my-task">
					<i class="bi bi-person-fill"></i></i>
					<?=TASKS_MY_TASKS;?>
				</button>
				<button type="button" class="btn-secondary rounded f-14 p-2 mr-3 float-left" id="filter-my-task2">
					<i class="bi bi-person-fill"></i></i>
					Hide Completed
				</button>

			</div>

		</div>
		<?php endif; ?>
		<div class="d-flex flex-column w-tables rounded mt-3 bg-white">

			<div id="allTasks-table_wrapper" class="">
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-hover border-0 w-100 dataTable no-footer" id="tasks-table" role="grid"
							aria-describedby="allTasks-table_info" style="width: 1589px;">
							<thead>
								<tr role="row">

									<th>Id</th>

									<th><?=G_TASK;?></th>
									<th><?=G_PROJECT;?></th>
									<th><?=G_DUE_DATE;?></th>

									<th><?=G_ASSIGNED_TO;?>
									</th>
									<th><?=G_STATUS;?></th>
									<th><?=G_ACTION;?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($tasks as $getEmployeeTask): ?>
								<tr
									data-id='<?=$getEmployeeTask['task_id']?>'>

									<td
										data-search="<?=$getEmployeeTask['task_id']?>">
										<?=$getEmployeeTask['task_id']?>
									</td>

									<td
										data-search="<?=$getEmployeeTask['heading']?>">
										<div class="media align-items-center">
											<div class="media-body">
												<h5 class="mb-0 f-13 text-darkest-grey"><a
														href="<?=ROOT?>/task/<?=$getEmployeeTask['task_id']?>"
														class="openRightModal"><?=$getEmployeeTask['heading']?></a>
												</h5>
												<p class="mb-0"> </p>
											</div>
										</div>
									</td>
									<td
										data-search="<?=$getEmployeeTask['project_name']?>">
										<a href="<?=ROOT?>/project/<?=$getEmployeeTask['project_id']?>"
											class="text-darkest-grey"><?=$getEmployeeTask['project_name']?></a>
									</td>
									<td data-search="<?=strtotime($getEmployeeTask['due_date']);?>"
										data-order="<?=strtotime($getEmployeeTask['due_date']);?>">
										<?php
                                                $due_data = $getEmployeeTask['due_date'];
								    if($due_data > date('Y-m-d')) {
								        echo ucwords(strftime('%d %B %Y', strtotime($due_data)));
								    } else {
								        echo ' <span class="badge badge-danger">'.G_EXPIRED.'</span>';
								        echo '<br>';
								        echo '<span class="text-danger">'.ucwords(strftime('%d %B %Y', strtotime($due_data))).'</span>';
								    }

								    ?>
									</td>

									<td data-search="<?php foreach($employeesModel->getTaskEmployees($getEmployeeTask['task_id']) as $member) {
									    echo $member['employee_name'] . ' ' . $member['user_id'] . ', ';
									} ?> ">
										<div class="position-relative">
											<?php
									$left = 0;
								    foreach($employeesModel->getTaskEmployees($getEmployeeTask['task_id']) as $member):
								        $left = $left + 13;
								        ?>

											<div class="taskEmployeeImg rounded-circle position-absolute"
												style="top:-10px; left:  <?=$left?>px">
												<a
													href="<?=ROOT?>/employee/<?=$member['user_id'];?>">
													<img src="<?php
								                    if ($member['employee_image']) {
								                        echo ROOT.'/'.$member['employee_image'];
								                    } else {
								                        echo 'https://www.gravatar.com/avatar/f7e016ba33bbc6009459c4f37ce1c0e4.png?s=200&amp;d=mp';
								                    }?>"
														title="<?=$member['employee_name']?>" /></a>
											</div>
											<?php endforeach;?>

										</div>
									</td>
									<?php $labelJSON = json_decode($getEmployeeTask['column_name'], true); ?>
									<td data-search="<?=$labelJSON[LANG_ISO];?>"
										data-order="<?=$getEmployeeTask['board_column_id']?>">
										<?php if($_SESSION['user_role'] == 1) : ?>
										<select class="selectpicker" id="status_task">
											<?php foreach($taskLabels as $taskLabel):
											    $labelTranslate = json_decode($taskLabel['column_name'], true);?>

											<option
												data-content="<i class='bi bi-circle-fill  mr-2'  style='color:<?=$taskLabel['label_color']?>'></i>  <?=$labelTranslate[LANG_ISO]?>"
												value=" <?=$taskLabel['id']?>"
												<?php if($taskLabel['id'] == $getEmployeeTask['board_column_id']) {
												    echo 'selected';
												} ?>>
												<?=$labelTranslate[LANG_ISO]?>
											</option>
											<?php endforeach; ?>
										</select>
										<?php else:
										    foreach($taskLabels as $taskLabel):
										        $labelTranslate = json_decode($taskLabel['column_name'], true);
										        if($taskLabel['id'] == $getEmployeeTask['board_column_id']) {
										            echo '<span class="badge badge-pill" style="background-color:'.$taskLabel['label_color'].'">'.$labelTranslate[LANG_ISO].'</span>';
										        }
										    endforeach;
										endif; ?>
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
													<a href="<?=ROOT?>/task/<?=$getEmployeeTask['task_id']?>"
														class="dropdown-item openRightModal">
														<i class="bi bi-eye-fill mr-2"></i>
														<?=G_VIEW;?></a>
													<?php if($_SESSION['user_role'] == 1 || $getEmployeeTask['added_by'] == $_SESSION['user_id']): ?>
													<a class="dropdown-item openRightModal"
														href="<?=ROOT;?>/task/<?=$getEmployeeTask['task_id']?>?edit">
														<i class="bi bi-pencil-fill mr-2"></i>
														<?=G_EDIT;?>
													</a><a class="dropdown-item delete-table-row" href="javascript:;"
														data-task-id="<?=$getEmployeeTask['task_id']?>">
														<i class="bi bi-trash-fill mr-2"></i>
														<?=G_DELETE;?>
													</a>
													<?php endif; ?>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>

					</div>
				</div>

			</div>

		</div>
	</div>

</section>

<?php

require_once('views/layout/footer.php');

?>

<script>
	$(document).ready(function() {


		var tasksTable = $('#tasks-table').DataTable({
			"order": [
				[0, "desc"]
			],
			"columnDefs": [{
				"orderable": false,
				"targets": [5]
			}],
			language: {
				url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/<?=LANG;?>.json'
			},
		})

		$('#filter-my-task').on('click', function() {
			var task = $('#filter-my-task').hasClass('btn-info');
			if (task) {
				$('#filter-my-task').removeClass('btn-info');
				$('#filter-my-task').addClass('btn-secondary');
				tasksTable.columns(4).search('').draw();

			} else {
				tasksTable.columns(4).search(
					'<?=$_SESSION['user_id'];?>'
				).draw();
				$('#filter-my-task').removeClass('btn-secondary').addClass('btn-info');
			}
		});

		$('#filter-my-task2').on('click', function() {
			var task = $('#filter-my-task2').hasClass('btn-info');
			if (task) {



				$('#filter-my-task2').removeClass('btn-info');
				$('#filter-my-task2').addClass('btn-secondary');
				tasksTable.columns(5).search('').draw();
			} else {
				var searchSource = 'Incomplete, In Progress, Em Progresso, Incompleto';
				var searchTerm = searchSource.split(', ').join(')|(');
				$('#filter-my-task2').removeClass('btn-secondary').addClass('btn-info');
				tasksTable.column(5).search("^(" + searchTerm + ")$", true, false, true).draw();


			}
		});





		$('body').on('change', '#status_task', function() {
			var status = $(this).val();
			var id = $(this).closest('tr').data('id');
			console.log(status);
			$.ajax({
				url: '<?=ROOT;?>/task/' + id +
					'?action=change_task_status',
				type: "POST",
				data: {
					status: status,
					task_id: id
				},

				success: function(data) {
					console.log(data.status);
					if (data.status == 'success') {
						Swal.fire({
							icon: 'success',
							title: 'Task Status Changed',
							showConfirmButton: true,
							timer: 1500
						}).then((result) => {

							location.reload();
						})

					} else {
						Swal.fire({
							icon: 'error',
							title: 'Something went wrong',
							showConfirmButton: true,
							timer: 1500
						})
					}

				}
			});

		});

		$('body').on('click', '.delete-table-row', function() {
			var id = $(this).data('task-id');
			Swal.fire({
				title: '<?=SWAL_TITLE_DELETE;?>',
				text: "<?=SWAL_YOU_WONT_BE_ABLE_REVERT;?>",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: '<?=SWAL_CONFIRM_DELETE;?>'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: '<?=ROOT;?>/task/' +
							id +
							'?action=delete_task',
						type: "POST",
						data: {
							task_id: id
						},

						success: function(data) {
							console.log(data);
							if (data.status == 'success') {
								Swal.fire({
									icon: 'success',
									title: 'Task Deleted',
									showConfirmButton: true,
									timer: 1500
								}).then((result) => {
									location.reload();
								})

							} else {
								Swal.fire({
									icon: 'error',
									title: 'Something went wrong',
									showConfirmButton: true,
									timer: 1500
								})
							}

						}
					});
				}
			})
		});

	});
</script>
<?php require_once("layout/header.php"); ?>
<?php require_once("layout/navbar.php"); ?>
<section class="main-container bg-additional-grey" id="fullscreen">

	<!-- PAGE TITLE START -->
	<div class="page-title d-block d-lg-none">
		<div class="page-heading">
			<h2 class="mb-0 pr-3 text-dark f-18 font-weight-bold">Import Client
				<span class="text-lightest f-12 f-w-500 ml-2">
					<a href="http://localhost/script/public" class="text-lightest">Home</a> •
					<a href="/account/clients" class="text-lightest">Clients</a> •
					Import Client
				</span>
			</h2>
		</div>
	</div>
	<!-- PAGE TITLE END -->
	<div class="content-wrapper">
		<div class="row" id="import_table">
			<div class="col-sm-12">
				<form method="POST" id="import-client-data-form" autocomplete="off">
					<div class="add-client bg-white rounded">
						<h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
							Import Client
						</h4>
						<div class="row py-20">
							<div class="col-md-12">
								<div class="form-group my-3">
									<label class="f-14 text-dark-grey mb-12" data-label="" for="client_import">Upload
										File (file must be a file of type: xls, xlsx, csv)
									</label>

									<input type="file" id="input-file-now" data-allowed-file-extensions="xls xlsx csv"
										class="dropify" name="file" />
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group my-3 mr-0 mr-lg-12">
									<label class="f-14 text-dark-grey mb-12" data-label="" for="heading">File Contains
										Headings Row
									</label>
									<div class="custom-control custom-switch">
										<input type="checkbox" name="heading" class="custom-control-input" id="heading"
											autocomplete="off" data-np-invisible="1" data-np-checked="1">
										<label class="custom-control-label cursor-pointer f-14" for="heading"></label>
									</div>
								</div>
							</div>
						</div>
						<div class="w-100 border-top-grey d-block d-lg-flex d-md-flex justify-content-start px-4 py-3">
							<button type="button" class="btn-primary rounded f-14 p-2 mr-3" id="import-client-form">
								<i class="bi bi-arrow-90deg-right"></i> Import
								Upload and Move to Next Step
							</button>

							<a href="http://localhost/script/public/account/clients"
								class="btn-cancel rounded f-14 p-2 border-0">
								Back
							</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="bg-white rounded p-2" id="afterSubmitting" style="display:none">
			<div class="alert alert-warning" role="alert" id="process-warning">
				Do not close or refresh this page until the import is complete </div>
			<div class="alert alert-success" role="alert" id="importSuccess" style="display:none">
			</div>
			<div class="alert alert-success" role="alert" id="progressSuccess" style="display:none">
			</div>
			<div class="alert alert-danger" role="alert" id="failedJobsCount" style="display:none">
			</div>
			<div id="progressError" style="display:none"></div>
			<div id="progress">
				<p>Import in progress... <strong id="progressAmount">Please wait...</strong></p>

			</div>


		</div>
		<script>
			$(document).ready(function() {
				$('.dropify').dropify();
				var eventPicker;

				$('body').on('click', '#import-client-form', function() {
					const url =
						"<?=ROOT;?>/addclient/import?file";
					var form = $('#import-client-data-form');
					var formData = new FormData(form[0]);
					$('#process-client-form').prop('disabled', true);
					$.ajax({
						url: url,
						type: 'POST',
						data: formData,
						contentType: false,
						processData: false,
						success: function(response) {
							console.log(response);
							if (response.status == 'success') {
								$('#import_table').html(response.html);
								if (response.test.length > 0) {
									var test = response.test;
									console.log(test);
									for (var i = 0; i < test.length; i++) {
										// ﻿name <- dá print a invisible character - LEL
										var trueIndex = i + 1;
										$('#columnName_' + trueIndex).selectpicker('val',
											test[i]);
										$('#box_' + i).removeClass('unmatched');
										$('#box_' + i).addClass('matched');

									}

								}

								$('.selectpicker').selectpicker('refresh');
								$('#process-client-form').prop('disabled', true);


							} else {

								Swal.fire({
									icon: 'error',
									title: 'Something went wrong',
									text: response.message,
								})
							}
							/* if (response.status == 'success') {
							    $('#import_table').html(response.view);
							} */
						}
					});
				});


			});
			$('body').on('change', '.selectpicker', function() {

				var value = $(this).val();
				var id = $(this).attr('id');
				var index = id.replace('columnName_', '');
				var trueIndex = index - 1;
				console.log(trueIndex);
				$('#box_' + trueIndex).removeClass('unmatched');
				$('#box_' + trueIndex).addClass('matched');
				var eventPicker = $('.selectpicker').selectpicker().length;

				for (var i = 1; i <= eventPicker; i++) {
					if (i != index) {
						var value2 = $('#columnName_' + i).val();
						if (value == value2) {
							$('#columnName_' + i).val('');
							$('#columnName_' + i).selectpicker('refresh');

						}
					}
					if ($('#columnName_' + i).val() !== "" && $('#columnName_' + index).val() !== null) {

						$('#process-client-form').prop('disabled', false);
					} else {

						$('#process-client-form').prop('disabled', true);
					}
				}

			});

			$('body').on('click', '#process-client-form', function() {
				const url =
					"<?=ROOT;?>/addclient/import?data";
				var form = $('#process-client-data-form');
				var formData = new FormData(form[0]);
				$('#process-client-form').val('Processing...');
				$('#import_table').hide();
				$('#afterSubmitting').show();

				$.ajax({
					url: url,
					type: 'POST',
					data: formData,
					contentType: false,
					processData: false,
					timeout: 1000 * 60 * 60,
					success: function(response) {
						console.log(response);
						if (response.status == 'success') {
							Swal.fire({
								icon: 'success',
								title: 'Success',
								text: response.message,
							}).then((result) => {
								if (result.isConfirmed) {
									window.location.href =
										"<?=ROOT;?>/client";
								}
							})
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: response.message,
								isConfirmed: true,


							}).then((result) => {
								if (result.isConfirmed) {
									window.location.href =
										"<?=ROOT;?>/addclient/import";
								}
							})
						}
					}

				});
			});
		</script>
	</div>
</section>

<script>

</script>
<?php require_once("layout/footer.php"); ?>
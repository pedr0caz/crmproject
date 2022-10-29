<?php require_once("views/layout/header.php"); ?>
<?php require_once("views/layout/navbar.php"); ?>
<section class="main-container bg-additional-grey" id="fullscreen">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <form method="POST" id="save-notice-data-form" autocomplete="off" data-np-checked="1"
                    data-np-autofill-type="other" data-np-watching="1">


                    <div class="add-client bg-white rounded">
                        <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                            Notice Details</h4>
                        <div class="row p-20">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group my-3">
                                            <div class="d-flex">
                                                <div class="form-check-inline custom-control custom-radio mt-2 mr-3">
                                                    <input type="radio" value="employee" class="custom-control-input"
                                                        id="toEmployee" name="to" checked="" autocomplete="off"
                                                        data-np-invisible="1" data-np-checked="1">
                                                    <label class="custom-control-label pt-1 cursor-pointer"
                                                        for="toEmployee">To Employees</label>
                                                </div>

                                                <div class="form-check-inline custom-control custom-radio mt-2 mr-3">
                                                    <input type="radio" value="client" class="custom-control-input"
                                                        id="toClient" name="to" autocomplete="off" data-np-invisible="1"
                                                        data-np-checked="1">
                                                    <label class="custom-control-label pt-1 cursor-pointer"
                                                        for="toClient">To Clients</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <label class="f-14 text-dark-grey mb-12" data-label="true"
                                                for="heading">Notice Heading
                                                <sup class="f-14 mr-1">*</sup>

                                            </label>

                                            <input type="text" class="form-control height-35 f-14"
                                                placeholder="e.g. New year celebrations at office." value=""
                                                name="heading" id="heading" autocomplete="off" data-np-checked="1">

                                        </div>
                                    </div>

                                    <div class="col-md-6 department">
                                        <label class="f-14 text-dark-grey mb-12 mt-3" data-label=""
                                            for="team_id">Department

                                        </label>
                                        <div class="form-group mb-0">

                                            <select name="team_id" id="team_id" data-live-search="true"
                                                class="form-control selectpicker" data-size="4"
                                                title="Select Department">
                                                <?php foreach($teams as $team): ?>
                                                <option
                                                    value="<?=$team['id'];?>">
                                                    <?=$team['name'];?>
                                                </option>

                                                <?php endforeach; ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group my-3">
                                            <label class="f-14 text-dark-grey mb-12 my-3" data-label=""
                                                for="description-textt">Notice Details

                                            </label>

                                            <textarea name="description" id="description-text"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="w-100 border-top-grey d-block d-lg-flex d-md-flex justify-content-start px-4 py-3">
                            <button type="button" class="btn-primary rounded f-14 p-2 mr-3" id="save-notice">
                                <i class="bi bi-check-lg mr-2 "></i>
                                Save
                            </button>


                            <a href="" class="btn-cancel rounded f-14 p-2 border-0">
                                Cancel
                            </a>
                        </div>

                    </div>
                </form>

            </div>
        </div>

        <script>
            $(document).ready(function() {

                ClassicEditor
                    .create(document.querySelector('#description-text')).then(editor => {
                        noticeDetails = editor;

                    })
                    .catch(error => {
                        console.error(error);
                    });

                // show/hide project detail
                $(document).on('change', 'input[type=radio][name=to]', function() {
                    $('#team_id').selectpicker('val', '');
                    $('.department').toggleClass('d-none');

                });

                $('#save-notice').click(function() {
                    var form = $('#save-notice-data-form');
                    var formData = new FormData(form[0]);
                    formData.append('description', noticeDetails.getData());


                    $.ajax({
                        url: '<?=ROOT;?>/notice/save',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log(response);
                            if (response.status == 'success') {
                                Swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href =
                                            '<?=ROOT;?>/notice/' +
                                            response.id;
                                    }
                                })

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message,
                                })
                            }
                        }
                    });
                });

            });
        </script>
    </div>



</section>

<?php require_once("views/layout/footer.php"); ?>
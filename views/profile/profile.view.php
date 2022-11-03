<?php require_once("views/layout/header.php"); ?>
<?php require_once("views/layout/navbar.php"); ?>
<section class="main-container bg-additional-grey" id="fullscreen">
    <div class="s-b-inner s-b-notifications bg-white b-shadow-4 rounded">
        <div class="s-b-n-header" id="tabs">
            <nav class="tabs px-4 border-bottom-grey">
                <div class="nav" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link f-15 profile <?=!isset($_GET['files']) ? 'active' : '' ;?>"
                        href="<?=ROOT;?>/profile" role="tab"
                        aria-controls="nav-profiles" aria-selected="true">Profile </a>
                    <a class="nav-item nav-link f-15 files <?=isset($_GET['files']) ? 'active' : '' ;?>"
                        href="profile/tab?files" role="tab" aria-controls="nav-profile" aria-selected="true"
                        ajax="false"><?=PROFILE_MY_FILES;?> </a>
                </div>
            </nav>
        </div>
        <div class="s-b-n-content">
            <?php if(isset($id) && $id == null) { ?>
            <div class="tab-content" id="nav-tabContent" style="position: static; zoom: 1;">
                <div class="tab-pane fade show active" id="nav-email" role="tabpanel" aria-labelledby="nav-email-tab">
                    <form id="profile-form" method="POST">
                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="col-xl-12 col-lg-12 col-md-12 ntfcn-tab-content-left w-100 p-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group my-3 mr-0 mr-lg-2 mr-md-2 cropper">
                                            <label class="f-14 text-dark-grey mb-12" data-label="" for="profile-image">
                                                <?=G_PROFILE_PICTURE;?>
                                                <i class="bi bi-question-circle-fill f-12 text-primary"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="This is the image that will be displayed on your profile."></i>
                                            </label>
                                            <input type="file" id="input-file-now-custom-2" class="dropify"
                                                name="uploadfile" data-height="131"
                                                data-allowed-file-extensions="gif png jpg jpeg"
                                                <?=$user['image'] ? 'data-default-file="'.ROOT.'/'.$user['image'].'"':  'data-default-file="'.ROOT.'/images/avatar.png"';?>/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">

                                        <div class="form-group my-3 mr-0 mr-lg-2 mr-md-2">
                                            <label class="f-14 text-dark-grey mb-12"
                                                for="usr"><?=G_NAME;?></label>
                                            <input type="text" class="form-control height-35  f-14"
                                                placeholder="e.g. John Doe" name="name" id="name"
                                                value="<?=$user['name'];?>"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class=" col-lg-4">
                                        <div class="form-group my-3 mr-0 mr-lg-2 mr-md-2">
                                            <label class="f-14 text-dark-grey mb-12" data-label="true"
                                                for="email"><?=G_EMAIL;?>
                                                <sup class="f-14 mr-1">*</sup>
                                            </label>
                                            <input type="text" class="form-control height-35 f-14"
                                                placeholder="e.g. johndoe@example.com"
                                                value="<?=$user['email'];?>"
                                                name="email" id="email" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="f-14 text-dark-grey mb-12 mt-3" data-label=""
                                            for="password"><?=G_PASSWORD;?>

                                        </label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="password"
                                                class="form-control height-35 f-14" autocomplete="off"
                                                data-np-checked="1">
                                            <div class="input-group-append">
                                                <button type="button" data-toggle="tooltip"
                                                    data-original-title="Show/Hide Value"
                                                    class="btn btn-outline-secondary border-grey height-35 toggle-password">
                                                    <i class="bi bi-eye-slash"></i>
                                                    <!-- <i class="fa fa-eye"></i> Font Awesome fontawesome.com -->
                                                </button>
                                            </div>
                                            <div class="input-group-append">
                                                <button id="random_password" type="button" data-toggle="tooltip"
                                                    data-original-title="<?=G_GENERATE_PASSWORD;?>"
                                                    class="btn btn-outline-secondary border-grey height-35">
                                                    <i class="bi bi-shuffle font-weight-bolder"></i>
                                                    <!-- <i class="fa fa-random"></i> Font Awesome fontawesome.com -->
                                                </button>
                                            </div>
                                        </div>
                                        <small
                                            class="form-text text-muted"><?=G_PASSWORD_LEAVE_BLANK;?></small>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="f-14 text-dark-grey mb-12 mt-3" data-label=""
                                            for="gender"><?=G_GENDER;?>
                                        </label>
                                        <div class="form-group mb-0">
                                            <select name="gender" id="gender" data-live-search="true"
                                                class="form-control selectpicker" data-size="8">
                                                <option value="male">
                                                    <?=G_GENDER_MALE;?>
                                                </option>
                                                <option value="female">
                                                    <?=G_GENDER_FEMALE;?>
                                                </option>
                                                <option value="others">
                                                    <?=G_GENDER_OTHER;?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="f-14 text-dark-grey mb-12 mt-3" data-label=""
                                            for="phone_code"><?=G_COUNTRY;?>
                                        </label>
                                        <div class="form-group mb-0">
                                            <select name="country_id" id="phone_code" data-live-search="true"
                                                class="form-control selectpicker" data-size="4"
                                                data-dropdown-align-right="true">
                                                <?php foreach($countries as $country):?>
                                                <option
                                                    value="<?=$country['id'];?>"
                                                    data-tokens="<?=$country['iso3'];?>"
                                                    <?=$user['country_id'] == $country['id'] ? 'selected' : '';?>>
                                                    <?=$country['nicename'];?>
                                                </option>
                                                <?php endforeach;?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group my-3">
                                            <label class="f-14 text-dark-grey mb-12" data-label=""
                                                for="mobile"><?=G_MOBILE;?>
                                            </label>
                                            <input type="tel" class="form-control height-35 f-14"
                                                placeholder="e.g. 1234567890"
                                                value="<?=$user['mobile'];?>"
                                                name="mobile" id="mobile" autocomplete="off">
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-4">
									<label class="f-14 text-dark-grey mb-12 mt-3" data-label="" for="locale">Change
									    Language
									</label>
									<div class="form-group mb-0">
									
									    <select name="locale" id="locale" data-live-search="true"
									        class="form-control selectpicker" data-size="8">
									        <option selected=""
									            data-content="<span class='flag-icon flag-icon-gb flag-icon-squared'></span> English"
									            value="en">English</option>
									    </select>
									
									
									</div>
									</div> -->



                                </div>
                            </div>
                            <!-- Buttons Start -->
                            <div class="w-100 border-top-grey set-btns">
                                <div class="settings-btns py-3 d-flex justify-content-start px-4">
                                    <button type="button" class="btn-primary rounded f-14 p-2 mr-3" id="save-form">
                                        <i class="bi bi-check-circle mr-2"></i>
                                        <?=G_SAVE;?>
                                    </button>

                                </div>
                            </div>
                            <!-- Buttons End -->

                        </div>
                    </form>
                    <script>
                        $(document).ready(function() {

                            $('.dropify').dropify({
                                messages: {
                                    'default': 'Choose a file',
                                    'replace': 'Drag and drop or click to replace',
                                    'remove': 'Remove',
                                    'error': 'Ooops, something wrong happended.'
                                }
                            });


                            $('#random_password').click(function() {
                                var chars =
                                    "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
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
                                    classTogle.html(
                                        `<i class="bi bi-eye" style="font-size: 16px;"></i>`
                                    );
                                } else {
                                    password.attr('type', 'password');
                                    classTogle.html(
                                        `<i class="bi bi-eye-slash" style="font-size: 16px;"></i>`
                                    );
                                }
                            });

                            $('#save-form').on('click', function(e) {
                                var url =
                                    "<?=ROOT;?>/profile/update?submit";
                                var form = $('#profile-form');
                                var formData = new FormData(form[0]);
                                $.ajax({
                                    url: url,
                                    type: "POST",
                                    data: formData,
                                    contentType: false,
                                    cache: false,
                                    processData: false,

                                    success: function(response) {
                                        console.log(response);
                                        if (response.status == 'success') {
                                            Swal.fire({
                                                title: 'Success!',
                                                text: response.message,
                                                icon: 'success',
                                                confirmButtonText: 'Ok'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    location.reload();
                                                }
                                            })
                                        } else {
                                            Swal.fire({
                                                title: 'Error!',
                                                text: response.message,
                                                icon: 'error',
                                                confirmButtonText: 'Ok'
                                            })
                                        }
                                    }
                                });
                            });



                        });
                    </script>
                </div>
                <!-- TAB CONTENT END -->
            </div>
            <?php } elseif(isset($id) && $id == 'tab' && isset($_GET['files'])) { ?>
            <div class="tab-content" id="nav-tabContent" style="position: static; zoom: 1;">
                <div class="card bg-white border-0 b-shadow-4">
                    <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
                        <h4 class="f-18 f-w-500 mb-0">
                            <?=G_DOCUMENTS;?>
                        </h4>



                    </div>

                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-12">
                                <a class="f-15 f-w-500" href="javascript:;" id="add-task-file"><i
                                        class="icons icon-plus font-weight-bold mr-1"></i><?=G_ADD_FILES;?></a>
                            </div>
                        </div>

                        <form method="POST" id="save-taskfile-data-form" class="d-none" autocomplete="off"
                            enctype="application/x-www-form-urlencoded">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group my-3">
                                        <label class="f-14 text-dark-grey mb-12" data-label="true"
                                            for="file_name"><?=G_FILE_NAME;?>
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
                                            for="employee_file"><?=G_UPLOAD_FILE;?>
                                            <sup class="f-14 mr-1">*</sup>
                                            <i class="bi bi-question-circle-fill" data-toggle="popover"
                                                data-placement="top"
                                                data-content="only .txt, .pdf, .doc, .xls, .xlsx, .docx, .rtf, .png, .jpg, .jpeg formats are allowed."
                                                data-html="true" data-trigger="hover"></i>

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
                                            <?=G_CANCEL;?>
                                        </a>
                                        <button type="button" class="btn-primary rounded f-14 p-2" id="submit-document">
                                            <i class="bi bi-check mr-2"></i>
                                            <?=G_SAVE;?>
                                        </button>




                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="d-flex flex-wrap mt-3" id="task-file-list">
                            <?php foreach($files as $file):
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
                                    $img = ' <i class="bi bi-file-pdf mr-2 text-lightest" style="font-size: 16px;"></i>';
                                } elseif($extension == 'docx') {
                                    $img = ' <i class="bi bi-filetype-docx mr-2 text-lightest" style="font-size: 16px;"></i>';
                                } elseif($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif') {
                                    $img = '<img src="'.ROOT.'/'.$file["filename"].'">';
                                } else {
                                    $img = ' <i class="bi bi-file-earmark mr-2 text-lightest" style="font-size: 16px;"></i>';
                                }
                                ?>
                                        <?=$img?>
                                    </div>
                                    <div class="card-body pr-2">
                                        <div class="d-flex flex-grow-1">
                                            <h4 class="card-title f-12 text-dark-grey mr-3 text-truncate"
                                                data-toggle="tooltip" data-original-title="asdsad">
                                                <?=$file['name']?>
                                            </h4>
                                            <div class="dropdown ml-auto file-action">
                                                <button
                                                    class="btn btn-lg f-14 p-0 text-lightest text-capitalize rounded  dropdown-toggle"
                                                    type="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>

                                                <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
                                                    aria-labelledby="dropdownMenuLink" tabindex="0">

                                                    <a class="cursor-pointer d-block text-dark-grey f-13 pt-3 px-3 "
                                                        target="_blank"
                                                        href="<?=ROOT?>/<?=$file['filename']?>"><?=G_VIEW;?></a>

                                                    <a class="cursor-pointer d-block text-dark-grey f-13 py-3 px-3 "
                                                        href="<?=ROOT?>/<?=$file['filename']?>"><?=G_DOWNLOAD;?></a>


                                                    <a class="cursor-pointer d-block text-dark-grey f-13 pb-3 px-3 delete-file"
                                                        data-row-id="1"
                                                        href="javascript:;"><?=G_DELETE;?></a>
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
            <?php } ?>
        </div>
    </div>
</section>
<?php require_once("views/layout/footer.php"); ?>


<script>
    $('#add-task-file').click(function() {
        $(this).closest('.row').addClass('d-none');
        $('#save-taskfile-data-form').removeClass('d-none');
    });

    $('.dropify').dropify();

    $('#submit-document').click(function() {

        var form = $('#save-taskfile-data-form');
        var formData = new FormData(form[0]);
        $.ajax({
            url: '<?=ROOT;?>/profile/file?uploadfile',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                if (response.status) {

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
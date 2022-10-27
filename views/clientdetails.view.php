<?php require_once("layout/header.php"); ?>
<?php require_once("layout/navbar.php"); ?>
<section class="main-container bg-additional-grey" id="fullscreen">
    <!-- FILTER START -->
    <!-- PROJECT HEADER STARTmplete -->
    <div class="d-flex filter-box project-header bg-white">
        <div class="project-menu d-lg-flex" id="mob-client-detail">
            <a href="<?=ROOT?>/clientdetails/<?=$id?>"
                class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab profile <?php if(!isset($_GET['tab'])) {
                    echo 'active';
                }?>"><span>Profile</span></a>
            <a href=" <?=ROOT?>/clientdetails/<?=$id?>?tab=projects"
                class="text-dark-grey text-capitalize border-right-grey p-sub-menu projects <?php if(isset($_GET['tab']) && $_GET['tab'] == "projects") {
                    echo 'active';
                }?>"><span>Projects</span></a>
            <a href="<?=ROOT?>/clientdetails/<?=$id?>?tab=documents"
                class="text-dark-grey text-capitalize border-right-grey p-sub-menu documents <?php if(isset($_GET['tab']) && $_GET['tab'] == "documents") {
                    echo 'active';
                }?>"><span>Documents</span></a>
            <a href="<?=ROOT?>/clientdetails/<?=$id?>?tab=notes"
                class="text-dark-grey text-capitalize border-right-grey p-sub-menu notes <?php if(isset($_GET['tab']) && $_GET['tab'] == "notes") {
                    echo 'active';
                }?>"><span>Notes</span></a>
        </div>
    </div>

    <div class="content-wrapper border-top-0 client-detail-wrapper">
        <?php if (!isset($_GET['tab'])) { ?>
        <!-- ROW START -->
        <div class="row">
            <div class="col-sm-12">
            </div>
            <!--  USER CARDS START -->
            <div class="col-xl-7 col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4 mb-md-0">
                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-md-6 mb-4 mb-lg-0">
                        <div class="card border-0 b-shadow-4">
                            <div class="card-horizontal align-items-center">
                                <div class="card-img">
                                    <img class=""
                                        src="<?=$client['image'] ? ROOT.'/'.$client['image'] : 'https://www.gravatar.com/avatar/f7e016ba33bbc6009459c4f37ce1c0e4.png?s=200&amp;d=mp';?>"
                                        alt="">
                                </div>
                                <div class="card-body border-0 pl-0">
                                    <div class="row">
                                        <div class="col-10">
                                            <h4 class="card-title f-15 f-w-500 text-darkest-grey mb-0">
                                                <?=$client['name']?>
                                            </h4>
                                        </div>
                                        <div class="col-2 text-right">
                                            <div class="dropdown">
                                                <button class="btn f-14 px-0 py-0 text-dark-grey dropdown-toggle"
                                                    type="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
                                                    aria-labelledby="dropdownMenuLink" tabindex="0">
                                                    <a class="dropdown-item openRightModal"
                                                        href="<?=ROOT?>/clientdetails/<?=$id?>5/edit">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="f-13 font-weight-normal text-dark-grey mb-0">
                                        <?=$client['company_name'];?>
                                    </p>
                                    <p class="card-text f-12 text-lightest">Last login at
                                        <?=date('d M Y H:i', strtotime($client['last_login']))?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-6">
                        <div class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
                            <div class="d-block text-capitalize">
                                <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Total Projects
                                </h5>
                                <div class="d-flex">
                                    <p class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid"><span
                                            id=""><?=$client['project_count'];?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  USER CARDS END -->
            <!--  WIDGETS END -->
        </div>
        <!-- ROW END -->
        <!-- ROW START -->
        <div class="row mt-4">
            <div class="col-xl-12 col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4">
                <div class="card bg-white border-0 b-shadow-4">
                    <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
                        <h4 class="f-18 f-w-500 mb-0">Profile Info</h4>
                    </div>
                    <div class="card-body ">
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Full Name</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                <?=$client['name']?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Email</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                <?=$client['email'] ?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Company Name</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                <?=$client['company_name'] ?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Mobile</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                <?=$client['mobile'] ?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-block d-lg-flex d-md-flex">
                            <p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">
                                Gender
                            </p>
                            <p class="mb-0 text-dark-grey f-14 w-70">
                                <?=$client['gender'] ?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Office Phone Number</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                <?=$client['office'] ?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Official Website</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                <?=$client['website'] ?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Address</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                <?=$client['address'] ?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">State</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                <?=$client['state'] ?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">City</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                <?=$client['city'] ?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Postal code</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                <?=$client['postal_code'] ?: '--'?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }
        if (isset($_GET['tab']) && $_GET['tab'] == "projects") {
            ?>
        <div class="col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4">
            <!-- Add Task Export Buttons Start -->
            <div class="d-flex" id="table-actions">
                <a href="<?=ROOT?>"
                    class="btn-primary rounded f-14 p-2 mr-3 openRightModal"
                    data-redirect-url="<?=ROOT?>//account/clients/5?tab=projects">
                    <i class="bi bi-plus-circle"></i>
                    Add Project
                </a>
            </div>
            <!-- Add Task Export Buttons End -->
            <!-- Task Box Start -->
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
                                    foreach ($projects as $project) { ?>
                                    <tr>
                                        <td><?=$project['project_id']?>
                                        </td>
                                        <td>
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h5 class="mb-0 f-13 text-darkest-grey"><a
                                                            href="<?=ROOT?>/projectdetails/<?=$project['project_id']?>"><?=$project['project_name']?></a>
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
                                                        href="<?=ROOT?>/employeedetails/<?=$member['user_id'];?>">
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
                                        <td>
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
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <?=$project['completion_percent']?>%
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?=ucwords($project['status']);?>
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
                                                        <a href="<?=ROOT?>/projectdetails/<?=$project['project_id']?>"
                                                            class="dropdown-item">
                                                            <i class="bi bi-eye-fill mr-2"></i>
                                                            View
                                                        </a>
                                                        <a class="dropdown-item openRightModal"
                                                            href="<?=ROOT;?>/editproject/<?=$project['project_id']?>">
                                                            <i class="bi bi-pencil-fill mr-2"></i>
                                                            Edit
                                                        </a>
                                                        </a>
                                                        <a class="dropdown-item" target="_blank" href="">
                                                            <i class="bi bi-printer-fill mr-2"></i>
                                                            Public Task Board
                                                        </a>
                                                        </a>
                                                        <a class="dropdown-item delete-table-row" href="javascript:;"
                                                            data-user-id="1">
                                                            <i class="bi bi-trash-fill mr-2"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } elseif(isset($_GET['tab']) && $_GET['tab'] == "documents") {
            ?>
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
                                            <label class="f-14 text-dark-grey mb-12" data-label="true"
                                                for="file_name">File
                                                name
                                                <sup class="f-14 mr-1">*</sup>
                                            </label>
                                            <input type="text" class="form-control height-35 f-14" placeholder=""
                                                value="" name="name" id="file_name" autocomplete="off"
                                                data-np-invisible="1" data-np-checked="1">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group my-3">
                                            <label class="f-14 text-dark-grey mb-12" data-label="true"
                                                for="employee_file">
                                                Upload File
                                                <sup class="f-14 mr-1">*</sup>
                                                <i class="bi bi-question-circle-fill f-12 text-dark-grey"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Upload file size should be less than 10MB"></i>
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
                                            <button type="button" class="btn-primary rounded f-14 p-2"
                                                id="submit-document">
                                                <i class="bi bi-save2-fill mr-2"></i>
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
                                                            href="<?=ROOT?>/<?=$file['filename']?>">View</a>
                                                        <a class="cursor-pointer d-block text-dark-grey f-13 py-3 px-3 "
                                                            href="<?=ROOT?>/<?=$file['filename']?>">Download</a>

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
                            return confirm("Do you really want to delete \"" + element.file.name +
                                "\" ?");
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
            <?php
        }
?>
        </div>
    </div>
</section>
<?php require_once("layout/footer.php");
?>
<script>
    $('#projects-table').DataTable();
</script>
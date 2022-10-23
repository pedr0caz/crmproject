<?php
require_once("layout/header.php");
require_once("layout/navbar.php");
?>
<section class="main-container bg-additional-grey" id="fullscreen">




    <div class="content-wrapper">
        <div id="task-detail-section">


            <div class="row">
                <div class="col-sm-9">
                    <div class="card bg-white border-0 b-shadow-4">
                        <div
                            class="card-header bg-white  border-bottom-grey text-capitalize justify-content-between p-20">
                            <div class="row">
                                <div class="col-lg-8 col-10">

                                    <h3 class="heading-h1 mb-3"><?=$task['heading'];?>
                                    </h3>


                                </div>
                                <div class="col-lg-4 col-2 text-right">
                                    <div class="dropdown">
                                        <button
                                            class="btn btn-lg f-14 px-2 py-1 text-dark-grey text-capitalize rounded  dropdown-toggle"
                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <svg class="svg-inline--fa fa-ellipsis-h fa-w-16" aria-hidden="true"
                                                focusable="false" data-prefix="fa" data-icon="ellipsis-h" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                data-fa-i2svg="">
                                                <path fill="currentColor"
                                                    d="M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z">
                                                </path>
                                            </svg><!-- <i class="fa fa-ellipsis-h"></i> Font Awesome fontawesome.com -->
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
                                            aria-labelledby="dropdownMenuLink" tabindex="0">



                                            <a class="dropdown-item openRightModal"
                                                href="<?=ROOT;?>/edittask/<?=$id?>">Edit
                                                Task</a>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="col-12 px-0 pb-3 d-block d-lg-flex d-md-flex">
                                <p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">Project</p>
                                <p class="mb-0 text-dark-grey f-14 w-70">

                                    <a href="<?=ROOT;?>/projectdetails/<?=$task['project_id']?>"
                                        class="text-dark-grey">
                                        <?=$task['project_name'] ? $task['project_name'] : '<span class="badge badge-info">No Project Assigned</span>'; ?></a>
                                </p>

                            </div>
                            <div class="col-12 px-0 pb-3 d-block d-lg-flex d-md-flex">
                                <p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">
                                    Priority</p>
                                <p class="mb-0 text-dark-grey f-14 w-70">

                                    <!-- <i class="fa fa-circle mr-1 text-red f-10"></i> Font Awesome fontawesome.com -->
                                    <?php
                                    if ($task['task_priority'] == "low") {
                                        echo '<svg class="svg-inline--fa fa-circle fa-w-16 mr-2 text-green f-10" aria-hidden="true"
                                        focusable="false" data-prefix="fa" data-icon="circle" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                        </path>
                                    </svg>';
                                        echo 'Low';
                                    } elseif ($task['task_priority'] == "medium") {
                                        echo '<svg class="svg-inline--fa fa-circle fa-w-16 mr-2 text-yellow  f-10" aria-hidden="true"
                                        focusable="false" data-prefix="fa" data-icon="circle" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                        </path>
                                    </svg>';
                                        echo 'Medium';
                                    } elseif ($task['task_priority'] == "high") {
                                        echo '<svg class="svg-inline--fa fa-circle fa-w-16 mr-2 text-red f-10" aria-hidden="true"
                                        focusable="false" data-prefix="fa" data-icon="circle" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                        </path>
                                    </svg>';
                                        echo 'High';
                                    }
?>
                                </p>
                            </div>

                            <div class="col-12 px-0 pb-3 d-block d-lg-flex d-md-flex">
                                <p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">
                                    Assigned To</p>
                                <?php foreach($taskEmployees as $taskEmployee): ?>
                                <div class="taskEmployeeImg rounded-circle mr-1">
                                    <a
                                        href="<?=ROOT;?>/employeedetails/<?=$taskEmployee['user_id']?>">
                                        <img title="<?=$taskEmployee['user_name'];?>"
                                            src="<?=$taskEmployee['user_image'] ? $taskEmployee['user_image'] : 'https://www.gravatar.com/avatar/3ea58e77e21cabdfeabbfd844cbabbca.png?s=200&amp;d=mp';?>">
                                    </a>
                                </div>
                                <?php endforeach; ?>

                            </div>
                            <div class="col-12 px-0 pb-3 d-block d-lg-flex d-md-flex">
                                <p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">
                                    Assigned By</p>

                                <style>
                                    .disabled-link {
                                        pointer-events: none;
                                    }
                                </style>

                                <div class="media align-items-center mw-250">
                                    <a href="http://localhost/script/public/account/employees/1"
                                        class="position-relative ">
                                        <img src="<?=$task['user_image'] ? $task['user_image'] : 'https://www.gravatar.com/avatar/3ea58e77e21cabdfeabbfd844cbabbca.png?s=200&amp;d=mp';?>"
                                            class="mr-2 taskEmployeeImg rounded-circle" alt="Pedro" title="Pedro">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="mb-0 f-12">
                                            <a href="http://localhost/script/public/account/employees/1"
                                                class="text-darkest-grey "><?=$task['user_name']?></a>
                                            <?php if ($task['user_id'] == $_SESSION['user_id']) {?>
                                            <span class="badge badge-secondary">It's you</span>
                                            <?php } ?>
                                        </h5>
                                        <p class="mb-0 f-12 text-dark-grey">

                                        </p>
                                    </div>
                                </div>

                            </div>




                            <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Task category</p>
                                <div class="mb-0 text-dark-grey f-14 w-70 text-wrap ql-editor p-0"><?=$task['category_name']?>
                                </div>
                            </div>
                            <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Description</p>
                                <div class="mb-0 text-dark-grey f-14 w-70 text-wrap ql-editor p-0">
                                    <?=$task['description']?>
                                </div>
                            </div>



                        </div>
                    </div>

                    <!-- TASK TABS START -->
                    <div class="bg-additional-grey rounded my-3">

                        <div class="s-b-inner s-b-notifications bg-white b-shadow-4 rounded">

                            <div class="s-b-n-header task-tabs" id="tabs">
                                <nav class="tabs px-4 border-bottom-grey">
                                    <div class="nav" id="nav-tab" role="tablist">

                                        <a class="nav-item nav-link f-15 active ajax-tab" id="filestab" role="tab"
                                            aria-selected="true">
                                            Files
                                        </a>


                                        <a class="nav-item nav-link f-15 ajax-tab" id="commentstab" role="tab"
                                            aria-selected="true">
                                            Comment
                                        </a>



                                        <a class="nav-item nav-link f-15 ajax-tab" id="historytab" role="tab"
                                            aria-selected="true">
                                            History
                                        </a>

                                    </div>
                                </nav>
                            </div>


                            <div class="s-b-n-content">
                                <div class="tab-content" id="nav-tabContent">

                                    <style>
                                        .file-action {
                                            visibility: hidden;
                                        }

                                        .file-card:hover .file-action {
                                            visibility: visible;
                                        }
                                    </style>

                                    <!-- TAB CONTENT START -->
                                    <div class="tab-pane fade show active" role="tabpanel" id="files">
                                        <div class="p-20">

                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a class="f-15 f-w-500" href="javascript:;"
                                                            id="add-task-file"><i
                                                                class="icons icon-plus font-weight-bold mr-1"></i>Add
                                                            Files</a>
                                                    </div>
                                                </div>

                                                <form method="POST" id="save-taskfile-data-form" class="d-none"
                                                    autocomplete="off" enctype="application/x-www-form-urlencoded">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group my-3">
                                                                <label class="f-14 text-dark-grey mb-12"
                                                                    data-label="true" for="file_name">File
                                                                    name
                                                                    <sup class="f-14 mr-1">*</sup>

                                                                </label>

                                                                <input type="text" class="form-control height-35 f-14"
                                                                    placeholder="" value="" name="name" id="file_name"
                                                                    autocomplete="off" data-np-invisible="1"
                                                                    data-np-checked="1">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group my-3">
                                                                <label class="f-14 text-dark-grey mb-12"
                                                                    data-label="true" for="employee_file">Upload File
                                                                    <sup class="f-14 mr-1">*</sup>

                                                                    <svg class="svg-inline--fa fa-question-circle fa-w-16"
                                                                        data-toggle="popover" data-placement="top"
                                                                        data-content="only .txt, .pdf, .doc, .xls, .xlsx, .docx, .rtf, .png, .jpg, .jpeg formats are allowed."
                                                                        data-html="true" data-trigger="hover"
                                                                        aria-hidden="true" focusable="false"
                                                                        data-prefix="fa" data-icon="question-circle"
                                                                        role="img" xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 512 512" data-fa-i2svg=""
                                                                        data-original-title="" title="">
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
                                                                <a href="javascript:;"
                                                                    class="btn-cancel rounded f-14 p-2 border-0 mr-3"
                                                                    id="cancel-document">
                                                                    Cancel
                                                                </a>
                                                                <button type="button"
                                                                    class="btn-primary rounded f-14 p-2"
                                                                    id="submit-document">
                                                                    <svg class="svg-inline--fa fa-check fa-w-16 mr-1"
                                                                        aria-hidden="true" focusable="false"
                                                                        data-prefix="fa" data-icon="check" role="img"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 512 512" data-fa-i2svg="">
                                                                        <path fill="currentColor"
                                                                            d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                                                        </path>
                                                                    </svg>
                                                                    <!-- <i class="fa fa-check mr-1"></i> Font Awesome fontawesome.com -->
                                                                    Submit
                                                                </button>




                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                <div class="d-flex flex-wrap mt-3" id="task-file-list">
                                                    <?php foreach($taskFiles as $file):
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
                                                    <div class="card bg-white border-grey file-card mr-3 mb-3"
                                                        data-fileid="<?=$file['id']?>">
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
                                                                        data-toggle="tooltip"
                                                                        data-original-title="asdsad"><?=$file['name']?>
                                                                    </h4>
                                                                    <div class="dropdown ml-auto file-action">
                                                                        <button
                                                                            class="btn btn-lg f-14 p-0 text-lightest text-capitalize rounded  dropdown-toggle"
                                                                            type="button" data-toggle="dropdown"
                                                                            aria-haspopup="true" aria-expanded="false">
                                                                            <svg class="svg-inline--fa fa-ellipsis-h fa-w-16"
                                                                                aria-hidden="true" focusable="false"
                                                                                data-prefix="fa" data-icon="ellipsis-h"
                                                                                role="img"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 512 512" data-fa-i2svg="">
                                                                                <path fill="currentColor"
                                                                                    d="M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z">
                                                                                </path>
                                                                            </svg>
                                                                            <!-- <i class="fa fa-ellipsis-h"></i> Font Awesome fontawesome.com -->
                                                                        </button>

                                                                        <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
                                                                            aria-labelledby="dropdownMenuLink"
                                                                            tabindex="0">

                                                                            <a class="cursor-pointer d-block text-dark-grey f-13 pt-3 px-3 "
                                                                                target="_blank"
                                                                                href="<?=ROOT?>/<?=$file['filename']?>">View</a>

                                                                            <a class="cursor-pointer d-block text-dark-grey f-13 py-3 px-3 "
                                                                                href="<?=ROOT?>/<?=$file['filename']?>">Download</a>


                                                                            <a class="cursor-pointer d-block text-dark-grey f-13 pb-3 px-3 delete-file"
                                                                                data-row-id="<?=$file['id']?>"
                                                                                href="javascript:;">Delete</a>
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
                                    <div class="tab-pane fade" role="tabpanel" id="comments">
                                        <div class="row p-20">
                                            <div class="col-md-12">
                                                <a class="f-15 f-w-500" href="javascript:;" id="add-comment"><i
                                                        class="icons icon-plus font-weight-bold mr-1"></i>Add
                                                    Comment</a>
                                            </div>
                                        </div>

                                        <form method="POST" id="save-comment-data-form" class="d-none"
                                            autocomplete="off">


                                            <div class="col-md-12 p-20 ">
                                                <div class="media">

                                                    <img src="<?=$_SESSION['user_image'] ? $_SESSION['user_image'] : 'https://www.gravatar.com/avatar/3ea58e77e21cabdfeabbfd844cbabbca.png?s=200&d=mp'; ?>"
                                                        class="align-self-start mr-3 taskEmployeeImg rounded"
                                                        alt="<?=$_SESSION['user_name']?>">
                                                    <div class="media-body bg-white">
                                                        <div class="form-group">
                                                            <textarea name="comment" id="editor"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-100 justify-content-end d-flex mt-2">
                                                    <a href="javascript:;"
                                                        class="btn-cancel rounded f-14 p-2 border-0 mr-3"
                                                        id="cancel-comment">
                                                        Cancel
                                                    </a>
                                                    <button type="button" class="btn-primary rounded f-14 p-2"
                                                        id="submit-comment">
                                                        <svg class="svg-inline--fa fa-location-arrow fa-w-16 mr-1"
                                                            aria-hidden="true" focusable="false" data-prefix="fa"
                                                            data-icon="location-arrow" role="img"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                            data-fa-i2svg="">
                                                            <path fill="currentColor"
                                                                d="M444.52 3.52L28.74 195.42c-47.97 22.39-31.98 92.75 19.19 92.75h175.91v175.91c0 51.17 70.36 67.17 92.75 19.19l191.9-415.78c15.99-38.39-25.59-79.97-63.97-63.97z">
                                                            </path>
                                                        </svg>
                                                        <!-- <i class="fa fa-location-arrow mr-1"></i> Font Awesome fontawesome.com -->
                                                        Submit
                                                    </button>

                                                </div>

                                            </div>
                                        </form>


                                        <div class="d-flex flex-wrap justify-content-between p-20" id="comment-list">
                                            <?php foreach($taskComments as $comment): ?>
                                            <div class="card w-100 rounded-0 border-0 comment">
                                                <div class="card-horizontal">
                                                    <div class="card-img my-1 ml-0">
                                                        <img src="<?=$comment['user_image'] ? $comment['user_image'] : 'https://www.gravatar.com/avatar/3ea58e77e21cabdfeabbfd844cbabbca.png?s=200&d=mp'; ?>"
                                                            alt="<?=$comment['user_name']?>">
                                                    </div>
                                                    <div class="card-body border-0 pl-0 py-1">
                                                        <div class="d-flex flex-grow-1">
                                                            <h4 class="card-title f-15 f-w-500 text-dark mr-3"><?=$comment['user_name']?>

                                                            </h4>
                                                            <p class="card-date f-11 text-lightest mb-0">
                                                                <?php
                                                                   
                                                $time = date_diff(date_create('now'), date_create($comment['created_at']));
                                                if ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') == 0) {
                                                    $time = $time->format('%s seconds ago');
                                                } elseif ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') > 0) {
                                                    $time = $time->format('%i minutes ago');
                                                } elseif ($time->format('%a') == 0 && $time->format('%h') > 0) {
                                                    $time = $time->format('%h hours ago');
                                                } else {
                                                    $time = $time->format('%a days ago');
                                                }
                                                echo $time;
                                                ?>
                                                            </p>
                                                            <?php if($comment['user_id'] == $_SESSION['user_id']): ?>
                                                            <div class="dropdown ml-auto comment-action">
                                                                <button
                                                                    class="btn btn-lg f-14 p-0 text-lightest text-capitalize rounded  dropdown-toggle"
                                                                    type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <svg class="svg-inline--fa fa-ellipsis-h fa-w-16"
                                                                        aria-hidden="true" focusable="false"
                                                                        data-prefix="fa" data-icon="ellipsis-h"
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


                                                                    <a class="cursor-pointer d-block text-dark-grey f-13 pb-3 px-3 delete-comment"
                                                                        data-row-id="<?=$comment['id']?>"
                                                                        href="javascript:;">Delete</a>
                                                                </div>

                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="card-text f-14 text-dark-grey text-justify">
                                                            <?=$comment['comment']?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" role="tabpanel" id="history">
                                        <div class="d-flex flex-wrap p-20">
                                            <?php foreach($taskHistory as $history): ?>
                                            <div class="card file-card w-100 rounded-0 border-0 comment">
                                                <div class="card-horizontal">
                                                    <div class="card-img my-1 ml-0">
                                                        <img src="<?=$history['user_image'] ? $history['user_image'] : 'https://www.gravatar.com/avatar/3ea58e77e21cabdfeabbfd844cbabbca.png?s=200&d=mp'; ?>"
                                                            alt="<?=$history['user_name']?>">
                                                    </div>
                                                    <div class="card-body border-0 pl-0 py-1 mb-2">
                                                        <div class="d-flex flex-grow-1">
                                                            <h4
                                                                class="card-title f-12 font-weight-normal text-dark mr-3 mb-1">
                                                                <?=$history['details']?>
                                                            </h4>
                                                            </h4>
                                                        </div>
                                                        <div class="card-text f-11 text-lightest text-justify">
                                                            <?php
                                                            if($history['board_column_name']) {
                                                                echo '<span class="badge badge-primary"
																style="background-color:'.$history['board_column_color'].'">'.$history['board_column_name'].'</span>';
                                                            }
                                                ?>

                                                            <span class="f-11 text-lightest">
                                                                <?php
                                                                   
                                                       $time = date_diff(date_create('now'), date_create($history['created_at']));
                                                if ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') == 0) {
                                                    $time = $time->format('%s seconds ago');
                                                } elseif ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') > 0) {
                                                    $time = $time->format('%i minutes ago');
                                                } elseif ($time->format('%a') == 0 && $time->format('%h') > 0) {
                                                    $time = $time->format('%h hours ago');
                                                } else {
                                                    $time = $time->format('%a days ago');
                                                }
                                                echo $time;
                                                ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- TASK TABS END -->



                </div>

                <div class="col-sm-3">
                    <div class="card bg-white border-0 b-shadow-4">

                        <div class="card-body ">
                            <p class="f-w-500">
                                <select class="selectpicker" name="task_status" id="task_status">
                                    <?php foreach($taskLabels as $taskLabel): ?>
                                    <option
                                        data-content="<i class='bi bi-circle-fill  mr-2'  style='color:<?=$taskLabel['label_color']?>'></i>  <?=$taskLabel['column_name']?>"
                                        value="<?=$taskLabel['id']?>"
                                        <?php if($taskLabel['id'] == $task['board_column_id']) {
                                            echo 'selected';
                                        } ?>>
                                        <?=$taskLabel['column_name']?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </p>


                            <div class="col-12 px-0 pb-3 d-lg-flex d-block">
                                <p class="mb-0 text-lightest w-50 f-14 text-capitalize">Start Date
                                </p>
                                <p class="mb-0 text-dark-grey w-50 f-14">
                                    <?=$task['start_date'];?>
                                </p>
                            </div>
                            <div class="col-12 px-0 pb-3 d-lg-flex d-block">
                                <p class="mb-0 text-lightest w-50 f-14 text-capitalize">Due Date
                                </p>
                                <p class="mb-0 text-dark-grey w-50 f-14">
                                    <?php
                                         $deadline = $task['due_date'];
if($deadline > date('Y-m-d')) {
    echo $deadline;
} else {
    echo ' <span class="badge badge-danger">Expired</span>';
    echo '<br>';
    echo '<span class="text-danger">'.$deadline.'</span>';
}?>

                                </p>
                            </div>




                        </div>
                    </div>

                </div>

            </div>


            <script>
                $(document).ready(function() {

                    let editor;
                    ClassicEditor
                        .create(document.querySelector('#editor')).then((newEditor) => {
                            editor = newEditor;
                        })
                        .catch(error => {
                            console.error(error);
                        });


                    $('#add-comment').click(function() {
                        $(this).closest('.row').addClass('d-none');
                        $('#save-comment-data-form').removeClass('d-none');
                    });

                    $('#cancel-comment').click(function() {
                        $('#save-comment-data-form').addClass('d-none');
                        $('#add-comment').closest('.row').removeClass('d-none');
                    });


                    $('#submit-comment').click(function() {
                        let comment = editor.getData();
                        $.ajax({
                            url: '<?=ROOT;?>/taskdetails/<?=$id;?>?action=addcomment',
                            container: '#save-comment-data-form',
                            type: "POST",
                            disableButton: true,
                            blockUI: true,
                            buttonSelector: "#submit-comment",
                            data: {
                                comment: comment,
                            },
                            success: function(response) {
                                console.log(response);

                                if (response.status ==
                                    "success") {
                                    $('#save-comment-data-form').addClass('d-none');
                                    $('#add-comment').closest('.row').removeClass('d-none');
                                    $('#comment-list').prepend(response.data);

                                }

                            }
                        });
                    });




                    //    change task status
                    $('body').on('change', '#task_status', function() {
                        var status = $(this).val();

                        $.ajax({
                            url: '<?=ROOT;?>/taskdetails/<?=$id;?>?action=change_task_status',
                            type: "POST",
                            data: {
                                status: status,
                                task_id: <?=$task['task_id']?>
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
                                        if (result.isConfirmed) {
                                            location.reload();
                                        } else if (result.dismiss === Swal
                                            .DismissReason.timer) {
                                            location.reload();
                                        }

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

                    $(".ajax-tab").click(function(event) {
                        event.preventDefault();

                        $('.task-tabs .ajax-tab').removeClass('active');

                        $(this).addClass('active');
                        var tab = $(this).attr('id');
                        $('#comments').removeClass('active');
                        $('#comments').removeClass('show');
                        $('#files').removeClass('active');
                        $('#files').removeClass('show');

                        $('#history').removeClass('active');
                        $('#history').removeClass('show');

                        if (tab == 'commentstab') {

                            $('#comments').addClass('active');
                            $('#comments').addClass('show');


                        } else if (tab == 'filestab') {

                            $('#files').addClass('active');
                            $('#files').addClass('show');


                        } else if (tab == 'historytab') {

                            $('#history').addClass('active');
                            $('#history').addClass('show');


                        }



                    });




                    $('body').on('click', '.delete-comment', function() {
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
                                $.ajax({
                                    type: 'POST',
                                    url: '<?=ROOT;?>/taskdetails/<?=$id;?>?action=deletecomment',
                                    data: {
                                        id: id
                                    },
                                    success: function(response) {
                                        console.log(response);
                                        if (response.status == "success") {
                                            location.reload();
                                        }
                                    }
                                });
                            }
                        });
                    });




                    $('#add-task-file').click(function() {
                        $(this).closest('.row').addClass('d-none');
                        $('#save-taskfile-data-form').removeClass('d-none');
                    });


                    // Basic
                    $('.dropify').dropify();



                    // Used events
                    var drEvent = $('#input-file-events').dropify();

                    drEvent.on('dropify.beforeClear', function(event, element) {
                        return confirm("Do you really want to delete \"" + element.file
                            .name + "\" ?");
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




                    $('#submit-document').click(function() {
                        var form = $('#save-taskfile-data-form');
                        var formData = new FormData(form[0]);
                        $.ajax({
                            url: '<?=ROOT;?>/taskdetails/<?=$id?>?action=uploadfile',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                console.log(response);
                                if (response.status) {
                                    console.log(response.data);
                                    $('#task-file-list').append(response.data);
                                    $('#save-taskfile-data-form').addClass('d-none');
                                    $('#add-task-file').closest('.row').removeClass(
                                        'd-none');
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
                                console.log("ok")
                                $.ajax({
                                    type: 'POST',
                                    url: '<?=ROOT;?>/taskdetails/<?=$id?>?action=deletefile',
                                    data: {
                                        id
                                    },
                                    dataType: 'text',
                                    success: function(response) {
                                        response = JSON.parse(response);
                                        if (response.status) {
                                            Swal.fire({
                                                title: "Deleted!",
                                                text: "Your record has been deleted.",
                                                icon: "success",
                                                customClass: {
                                                    confirmButton: 'btn btn-primary'
                                                },
                                                buttonsStyling: false
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    location.reload();
                                                }
                                            });
                                        }
                                    }
                                });
                            }
                        });
                    });



                });
            </script>
        </div>
    </div>



</section>

<?php
require_once("layout/footer.php");

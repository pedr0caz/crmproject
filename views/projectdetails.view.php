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
                        <a href="<?=ROOT;?>/projectdetails/<?=$id?>"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab overview <?php if(!isset($_GET['tab'])) {
                                echo "active";
                            } ?>"><span>Overview</span></a>
                    </li>
                    <li>
                        <a href="<?=ROOT;?>/projectdetails/<?=$id?>?tab=members"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab members <?php if(isset($_GET['tab']) && $_GET['tab'] == "members") {
                                echo "active";
                            }?>"><span>Members</span></a>
                    </li>
                    <li>
                        <a href="<?=ROOT;?>/projectdetails/<?=$id?>?tab=files"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab files  <?php if(isset($_GET['tab']) && $_GET['tab'] == "files") {
                                echo "active";
                            }?>"><span>Files</span></a>
                    </li>
                    <li>
                        <a href="<?=ROOT;?>/projectdetails/<?=$id?>?tab=tasks"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu tasks  <?php if(isset($_GET['tab']) && $_GET['tab'] == "tasks") {
                                echo "active";
                            }?>"><span>Tasks</span></a>
                    </li>
                    <li>
                        <a href="<?=ROOT;?>/projectdetails/<?=$id?>?tab=taskboard"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu taskboard  <?php if(isset($_GET['tab']) && $_GET['tab'] == "taskboard") {
                                echo "active";
                            }?>"><span>Task
                                Board</span></a>
                    </li>
                    <li>
                        <a href="<?=ROOT;?>/projectdetails/<?=$id?>?tab=discussion"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu discussion  <?php if(isset($_GET['tab']) && $_GET['tab'] == "discussion") {
                                echo "active";
                            }?>"><span>Discussion</span></a>
                    </li>
                    <li>
                        <a href="<?=ROOT;?>/projectdetails/<?=$id?>?tab=notes"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu notes  <?php if(isset($_GET['tab']) && $_GET['tab'] == "notes") {
                                echo "active";
                            }?>"><span>Notes</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- PAGE TITLE END -->
    <div class="content-wrapper pt-0 border-top-0 client-detail-wrapper">
        <?php if(!isset($_GET['tab'])) { ?>
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
                                                            src="<?=$project['image'] ? ROOT.'/'.$project['image'] : 'https://www.gravatar.com/avatar/f7e016ba33bbc6009459c4f37ce1c0e4.png?s=200&amp;d=mp'?>"
                                                            alt="Chines">
                                                    </div>
                                                    <div class="card-body border-0 p-0 ml-4 ml-xl-4 ml-lg-3 ml-md-3">
                                                        <h4
                                                            class="card-title f-15 font-weight-normal mb-0 text-capitalize">
                                                            <a href="<?=ROOT?>/clientdetails/<?=$project['client_id']?>"
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
                                                centralLabel: '<?=$getProjectProgress?>%'
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
                                            href="<?=ROOT;?>/projectdetails/<?=$id?>1/edit">Edit
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
                                    echo '<div class="card-body p-0 ">';
                                    echo '<div class="m-auto" style="height: 220px; width: 250px">';
                                    echo '<canvas id="task-chart" height="250" width="250"
                                    style="display: block; box-sizing: border-box; height: 250px; width: 250px;"></canvas>';
                                    echo '</div>';
                                    echo '</div>';
                                }?>
                            <script>
                                <?php
                                $myArray = array();
            foreach($taskStatus as $status) {
                $myArray[$status['slug']] = $status;
            } ?>

                                var ctx = document.getElementById("task-chart");
                                var myChart = new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: [
                                            <?php foreach($myArray as $slug) {
                                                echo '"'.$slug['column_name'].'",';
                                            } ?>
                                        ],
                                        datasets: [{
                                            label: 'Dataset 1',
                                            data: [
                                                <?php foreach($myArray as $slug) {
                                                    echo $slug['status_count'].',';
                                                } ?>
                                            ],
                                            backgroundColor: [
                                                <?php foreach($myArray as $slug) {
                                                    echo '"'.$slug['label_color'].'",';
                                                } ?>
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

                        </div>
                    </div>
                    <!-- CLIENT END -->
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 mb-4">
                        <div class="card bg-white border-0 b-shadow-4">
                            <div
                                class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
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
                    var url =
                        "<?=ROOT;?>/projectdetails/<?=$id?>updateStatus/1";
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
                                    "<?=ROOT;?>/projectdetails/<?=$id?>destroy-pin/:id";
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
                                    "<?=ROOT;?>/projectdetails/<?=$id?>store-pin?type=" +
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
                                "<?=ROOT;?>/projectdetails/<?=$id?>archive-restore/1";

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



            });
        </script>
        <?php }
        if(isset($_GET['tab']) && $_GET['tab'] == 'tasks') { ?>


        <?php } elseif(isset($_GET['tab']) && $_GET['tab'] == 'files') { ?>

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
                                            data-html="true" data-trigger="hover" aria-hidden="true" focusable="false"
                                            data-prefix="fa" data-icon="question-circle" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""
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
                                    <a href="javascript:;" class="btn-cancel rounded f-14 p-2 border-0 mr-3"
                                        id="cancel-document">
                                        Cancel
                                    </a>
                                    <button type="button" class="btn-primary rounded f-14 p-2" id="submit-document">
                                        <svg class="svg-inline--fa fa-check fa-w-16 mr-1" aria-hidden="true"
                                            focusable="false" data-prefix="fa" data-icon="check" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
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
                        <?php foreach($getProjectFiles as $file):
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
                                            data-toggle="tooltip" data-original-title="asdsad"><?=$file['name']?>
                                        </h4>
                                        <div class="dropdown ml-auto file-action">
                                            <button
                                                class="btn btn-lg f-14 p-0 text-lightest text-capitalize rounded  dropdown-toggle"
                                                type="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <svg class="svg-inline--fa fa-ellipsis-h fa-w-16" aria-hidden="true"
                                                    focusable="false" data-prefix="fa" data-icon="ellipsis-h" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                    data-fa-i2svg="">
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
                    url: '<?=ROOT;?>/projectdetails/<?=$id?>?action=uploadfile',
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
                        console.log("ok")
                        $.ajax({
                            type: 'POST',
                            url: '<?=ROOT;?>/projectdetails/<?=$id?>?action=deletefile',
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
        </script>


        <?php } elseif(isset($_GET['tab']) && $_GET['tab'] == 'notes') { ?>

        <?php } elseif(isset($_GET['tab']) && $_GET['tab'] == 'members') { ?>


        <!-- ROW START -->
        <div class="row py-5">
            <div class="col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4">
                <button type="button" class="btn-primary rounded f-14 p-2 type-btn mb-3" id="add-project-member">
                    <svg class="svg-inline--fa fa-plus fa-w-14 mr-1" aria-hidden="true" focusable="false"
                        data-prefix="fa" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
                        </path>
                    </svg><!-- <i class="fa fa-plus mr-1"></i> Font Awesome fontawesome.com -->
                    Add Members team
                </button>




                <div class="card bg-white border-0 b-shadow-4">
                    <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
                        <h4 class="f-18 f-w-500 mb-0">Members</h4>



                    </div>

                    <div
                        class="card-body border-0 p-0 d-flex justify-content-between align-items-center table-responsive-sm">
                        <table id="example" class="table border-0 pb-3 admin-dash-table table-hover">
                            <thead class="">
                                <tr>
                                    <th class="pl-20">#</th>
                                    <th>Name</th>


                                    <th class="text-right pr-20">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="row-1">
                                    <td class="pl-20">1</td>
                                    <td>
                                        <style>
                                            .disabled-link {
                                                pointer-events: none;
                                            }
                                        </style>

                                        <div class="media align-items-center mw-250">
                                            <a href="http://localhost/script/public/account/employees/4"
                                                class="position-relative ">
                                                <img src="https://www.gravatar.com/avatar/b4dda2fb5d3ab52705af21229f9b4b93.png?s=200&amp;d=mp"
                                                    class="mr-2 taskEmployeeImg rounded-circle" alt="John" title="John">
                                            </a>
                                            <div class="media-body">
                                                <h5 class="mb-0 f-12">
                                                    <a href="http://localhost/script/public/account/employees/4"
                                                        class="text-darkest-grey ">John</a>
                                                </h5>
                                                <p class="mb-0 f-12 text-dark-grey">
                                                    Team Lead
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-right pr-20">

                                        <button type="button" class="btn-secondary rounded f-14 p-2 delete-row"
                                            data-row-id="1">
                                            <svg class="svg-inline--fa fa-trash fa-w-14 mr-1" aria-hidden="true"
                                                focusable="false" data-prefix="fa" data-icon="trash" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                data-fa-i2svg="">
                                                <path fill="currentColor"
                                                    d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z">
                                                </path>
                                            </svg>
                                            <!-- <i class="fa fa-trash mr-1"></i> Font Awesome fontawesome.com -->
                                            Delete
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- ROW END -->

        <script>
            $('.delete-row').click(function() {

                var id = $(this).data('row-id');
                var url =
                    "<?=ROOT?>projectdetails/<?=$id;?>?action=delete_member";

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
                        $.easyAjax({
                            type: 'POST',
                            url: url,
                            data: {
                                '_token': token,
                                '_method': 'DELETE'
                            },
                            success: function(response) {
                                if (response.status == "success") {
                                    $('#row-' + id).fadeOut();
                                }
                            }
                        });
                    }
                });

            });
        </script>

        <?php } ?>
    </div>
</section>
<?php require_once("layout/footer.php");

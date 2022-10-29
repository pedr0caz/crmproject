<?php require_once("views/layout/header.php"); ?>
<?php require_once("views/layout/navbar.php"); ?>
<section class="main-container bg-additional-grey" id="fullscreen">
    <div class="d-flex d-lg-block filter-box project-header bg-white">
        <div class="mobile-close-overlay w-100 h-100" id="close-client-overlay"></div>
        <div class="project-menu" id="mob-client-detail">

            <nav class="tabs --jsfied">
                <ul class="-primary">
                    <li>
                        <a href="<?=ROOT;?>/project/<?=$id?>"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab overview <?php if(!isset($_GET['tab'])) {
                                echo "active";
                            } ?>"><span>Overview</span></a>
                    </li>
                    <li>
                        <a href="<?=ROOT;?>/project/<?=$id?>?tab=members"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab members <?php if(isset($_GET['tab']) && $_GET['tab'] == "members") {
                                echo "active";
                            }?>"><span>Members</span></a>
                    </li>
                    <li>
                        <a href="<?=ROOT;?>/project/<?=$id?>?tab=files"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab files  <?php if(isset($_GET['tab']) && $_GET['tab'] == "files") {
                                echo "active";
                            }?>"><span>Files</span></a>
                    </li>
                    <li>
                        <a href="<?=ROOT;?>/project/<?=$id?>?tab=tasks"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu tasks  <?php if(isset($_GET['tab']) && $_GET['tab'] == "tasks") {
                                echo "active";
                            }?>"><span>Tasks</span></a>
                    </li>
                    <li>
                        <a href="<?=ROOT;?>/project/<?=$id?>?tab=taskboard"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu taskboard  <?php if(isset($_GET['tab']) && $_GET['tab'] == "taskboard") {
                                echo "active";
                            }?>"><span>Task
                                Board</span></a>
                    </li>
                    <li>
                        <a href="<?=ROOT;?>/project/<?=$id?>?tab=discussion"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu discussion  <?php if(isset($_GET['tab']) && $_GET['tab'] == "discussion") {
                                echo "active";
                            }?>"><span>Discussion</span></a>
                    </li>
                    <?php if($_SESSION['user_role'] <= 2): ?>
                    <li>
                        <a href="<?=ROOT;?>/project/<?=$id?>?tab=notes"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu notes  <?php if(isset($_GET['tab']) && $_GET['tab'] == "notes") {
                                echo "active";
                            }?>"><span>Notes</span></a>
                    </li>
                    <?php endif; ?>
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
                                                            <a href="<?=ROOT?>/client/<?=$project['client_id']?>"
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
                                                arcDelimiters: [ <?=$getProjectProgress >= 99.99 ? 99.99 : $getProjectProgress + 0.01;?> ],
                                                rangeLabel: ['0', '100'],
                                                centralLabel: '<?=$getProjectProgress?>%'
                                            }
                                            // Drawing and updating the chart
                                            GaugeChart.gaugeChart(elementGauge, 150, gaugeOptions)
                                        </script>
                                        <!-- PROGRESS START DATE START -->
                                        <div class="p-start-date mb-xl-0 mb-lg-3">
                                            <h5 class="text-lightest f-14 font-weight-normal">Start Date</h5>
                                            <p class="f-15 mb-0">
                                                <?=$project['start_date'];?>
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
                                <?php if($_SESSION['user_role'] <= 1) { ?>
                                <select class="form-control selectpicker change-status height-35">
                                    <option
                                        data-content="<i class='bi bi-circle-fill  mr-2  text-blue'></i> In Progress"
                                        value="in progress">In Progress</option>
                                    <option data-content="<i class='bi bi-circle-fill  mr-2  text-warning'></i> On Hold"
                                        value="on hold">On Hold</option>
                                    <option selected=""
                                        data-content="<i class='bi bi-circle-fill mr-2 text-dark-grey'></i> Not Started"
                                        value="not started">Not Started</option>
                                    <option data-content="<i class='bi bi-circle-fill mr-2 text-red'></i> Canceled"
                                        value="canceled">Canceled</option>
                                    <option
                                        data-content="<i class='bi bi-circle-fill  mr-2  text-dark-green'></i> Finished"
                                        value="finished">Finished</option>
                                </select>


                                <?php } else {
                                    if ($project['status'] == 'in progress') {
                                        echo "<i class='bi bi-circle-fill  mr-2  text-blue'></i> In Progress";
                                    } elseif ($project['status'] == 'on hold') {
                                        echo "<i class='bi bi-circle-fill  mr-2  text-warning'></i> On Hold";
                                    } elseif ($project['status'] == 'not started') {
                                        echo "<i class='bi bi-circle-fill mr-2 text-dark-grey'></i> Not Started";
                                    } elseif ($project['status'] == 'canceled') {
                                        echo "<i class='bi bi-circle-fill mr-2 text-red'></i> Canceled";
                                    } elseif ($project['status'] == 'finished') {
                                        echo "<i class='bi bi-circle-fill  mr-2  text-dark-green'></i> Finished";
                                    }
                                }?>

                            </div>
                            <div class="ml-lg-3 ml-md-0 ml-0 mr-3 mr-lg-0 mr-md-3">
                                <?php if($_SESSION['user_role'] <= 1) { ?>
                                <div class="dropdown">
                                    <button
                                        class="btn btn-lg bg-white border height-35 f-15 px-2 py-1 text-dark-grey text-capitalize rounded  dropdown-toggle"
                                        type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action <i class="icon-options-vertical icons"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
                                        aria-labelledby="dropdownMenuLink" tabindex="0">
                                        <a class="dropdown-item openRightModal"
                                            href="<?=ROOT;?>/project/<?=$id?>?edit">Edit
                                            Project</a>
                                    </div>
                                </div>
                                <?php } ?>
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
                        <?php if(empty($getProjectActivity)): ?>
                        <div class="p-20">
                            <i class="side-icon f-21 bi bi-pie-chart"></i>
                            <div class="f-15 mt-4">
                                No Activity Found
                            </div>
                        </div>
                        <?php else: ?>
                        <?php foreach($getProjectActivity as $activity):?>
                        <div class="card border-0 b-shadow-4 p-20 rounded-0">
                            <div class="card-horizontal">
                                <div class="card-header m-0 p-0 bg-white rounded">
                                    <span
                                        class="f-12 p-1 "><?=date('M', strtotime($activity['created_at']))?></span>
                                    <span
                                        class="f-13 f-w-500 rounded-bottom"><?=date('d', strtotime($activity['created_at']))?></span>
                                </div>
                                <div class="card-body border-0 p-0 ml-3">
                                    <h4 class="card-title f-14 font-weight-normal text-capitalize">
                                        <?=$activity['activity']?>
                                    </h4>
                                    <p class="card-text f-12 text-dark-grey">
                                        <?=date('H:i', strtotime($activity['created_at']))?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
        <?php }
        if(isset($_GET['tab']) && $_GET['tab'] == 'tasks') { ?>
        <div class="content-wrapper">
            <?php if($_SESSION['user_role'] <= 2): ?>
            <div class="d-block d-lg-flex d-md-flex justify-content-between action-bar">
                <div id="table-actions" class="flex-grow-1 align-items-center">
                    <a href="<?=ROOT?>/task/create?project_id=<?=$project['project_id']?>"
                        class="btn-primary rounded f-14 p-2 mr-3 openRightModal float-left">
                        <i class="bi bi-plus-circle mr-2" style="font-size: 16px;"></i>
                        Add Task
                    </a>
                    <button type="button" class="btn-secondary rounded f-14 p-2 mr-3 float-left" id="filter-my-task">
                        <i class="bi bi-person-fill mr-2" style="font-size: 16px;"></i>
                        My Task
                    </button>

                </div>
            </div>
            <?php endif; ?>
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
                                    <?php foreach($tasks as $projectTasks): ?>
                                    <tr
                                        data-id='<?=$projectTasks['task_id']?>'>
                                        <td
                                            data-search="<?=$projectTasks['task_id']?>">
                                            <?=$projectTasks['task_id']?>
                                        </td>
                                        <td
                                            data-search="<?=$projectTasks['heading']?>">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h5 class="mb-0 f-13 text-darkest-grey"><a
                                                            href="<?=ROOT?>/task/<?=$projectTasks['task_id']?>"
                                                            class="openRightModal"><?=$projectTasks['heading']?></a>
                                                    </h5>
                                                    <p class="mb-0"> </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            data-search="<?=$projectTasks['project_name']?>">
                                            <a href="<?=ROOT?>/project/<?=$projectTasks['project_id']?>"
                                                class="text-darkest-grey"><?=$projectTasks['project_name']?></a>
                                        </td>
                                        <td data-search="<?=strtotime($projectTasks['due_date']);?>"
                                            data-order="<?=strtotime($projectTasks['due_date']);?>">
                                            <?php
                                            $due_data = $projectTasks['due_date'];
                                        if($due_data > date('Y-m-d')) {
                                            echo $due_data;
                                        } else {
                                            echo ' <span class="badge badge-danger">Expired</span>';
                                            echo '<br>';
                                            echo '<span class="text-danger">'.$due_data.'</span>';
                                        }
                                        ?>
                                        </td>
                                        <td data-search="<?php foreach($employeeModel->getTaskEmployees($projectTasks['task_id']) as $member) {
                                            echo $member['employee_name'];
                                        } ?> ">
                                            <div class="position-relative">
                                                <?php
                                                $left = 0;
                                        foreach($employeeModel->getTaskEmployees($projectTasks['task_id']) as $member):
                                            $left = $left + 13;
                                            ?>
                                                <div class="taskEmployeeImg rounded-circle position-absolute"
                                                    style="top:-10px; left:  <?=$left?>px">
                                                    <a
                                                        href="<?=ROOT?>/employeedetails/<?=$member['user_id'];?>">
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
                                        <td
                                            data-order="<?=$projectTasks['board_column_id']?>">
                                            <?php if($_SESSION['user_role'] <= 1): ?>
                                            <select class="selectpicker" id="status_task">
                                                <?php foreach($taskLabels as $taskLabel): ?>
                                                <option
                                                    data-content="<i class='bi bi-circle-fill  mr-2'  style='color:<?=$taskLabel['label_color']?>'></i>  <?=$taskLabel['column_name']?>"
                                                    value=" <?=$taskLabel['id']?>"
                                                    <?php if($taskLabel['id'] == $projectTasks['board_column_id']) {
                                                        echo 'selected';
                                                    } ?>>
                                                    <?=$taskLabel['column_name']?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php else:
                                                foreach($taskLabels as $taskLabel):
                                                    if($taskLabel['id'] == $projectTasks['board_column_id']) {
                                                        echo '<span class="badge badge-pill" style="background-color:'.$taskLabel['label_color'].'">'.$taskLabel['column_name'].'</span>';
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
                                                        <a href="<?=ROOT?>/task/<?=$projectTasks['task_id']?>"
                                                            class="dropdown-item openRightModal">

                                                            <i class="bi bi-eye-fill mr-2"
                                                                style="font-size: 16px;"></i>View
                                                        </a>
                                                        <?php if($_SESSION['user_role'] == 1 || $projectTasks['added_by'] == $_SESSION['user_id']): ?>

                                                        <a class="dropdown-item openRightModal"
                                                            href="<?=ROOT;?>/task/<?=$projectTasks['task_id']?>?edit">

                                                            <i class="bi bi-pen-fill mr-2" style="font-size: 16px;"></i>
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item delete-table-row" href="javascript:;"
                                                            data-task-id="<?=$projectTasks['task_id']?>">
                                                            <i class="bi bi-trash-fill mr-2"
                                                                style="font-size: 16px;"></i>
                                                            <!-- <i class="fa fa-trash mr-2"></i> Font Awesome fontawesome.com -->
                                                            Delete
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
                    <?php if($_SESSION['user_role'] <= 2): ?>
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
                                    <label class="f-14 text-dark-grey mb-12" data-label="true" for="employee_file">
                                        Upload File
                                        <sup class="f-14 mr-1">*</sup>

                                        <i class="bi bi-question-circle mr-2" style="font-size: 16px;"
                                            data-toggle="popover" data-placement="top"
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
                                        Cancel
                                    </a>
                                    <button type="button" class="btn-primary rounded f-14 p-2" id="submit-document">

                                        <i class="bi bi-check mr-2" style="font-size: 16px;"></i>
                                        <!-- <i class="fa fa-check mr-1"></i> Font Awesome fontawesome.com -->
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php endif; ?>
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

                                                <i class="bi bi-three-dots-vertical" style="font-size: 16px;"></i>
                                                <!-- <i class="fa fa-ellipsis-h"></i> Font Awesome fontawesome.com -->
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
                                                aria-labelledby="dropdownMenuLink" tabindex="0">
                                                <a class="cursor-pointer d-block text-dark-grey f-13 pt-3 px-3 "
                                                    target="_blank"
                                                    href="<?=ROOT?>/<?=$file['filename']?>">View</a>
                                                <a class="cursor-pointer d-block text-dark-grey f-13 py-3 px-3 "
                                                    href="<?=ROOT?>/<?=$file['filename']?>">Download</a>
                                                <?php if($file['user_id'] == $_SESSION['user_id'] || $_SESSION['user_role'] == 1): ?>
                                                <a class="cursor-pointer d-block text-dark-grey f-13 pb-3 px-3 delete-file"
                                                    data-row-id="<?=$file['id']?>"
                                                    href="javascript:;">Delete</a>
                                                <?php endif; ?>
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
                    url: '<?=ROOT;?>/project/<?=$id?>?action=uploadfile',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
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
                        console.log("ok")
                        $.ajax({
                            type: 'POST',
                            url: '<?=ROOT;?>/project/<?=$id?>?action=deletefile',
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
        <?php } elseif(isset($_GET['tab']) && $_GET['tab'] == 'taskboard') { ?>
        <link rel="stylesheet" href="<?=ROOT;?>/css/dragula.css"
            type="text/css">
        <link rel="stylesheet" href="<?=ROOT;?>/css/drag.css"
            type="text/css">
        <link rel="stylesheet"
            href="<?=ROOT;?>/css/bootstrap-colorpicker.css">
        <style>
            #colorpicker .form-group {
                width: 87%;
            }

            .b-p-tasks {
                min-height: 100px;
            }

            .content-wrapper {
                padding: 0;
            }
        </style>
        <!-- CONTENT WRAPPER START -->
        <div class="w-task-board-box px-4 py-2 pt-3 bg-white">
            <div class="w-task-board-panel d-flex" id="taskboard-columns">
                <?php foreach($taskLabels as $label):
                    ?>
                <div class="board-panel rounded bg-additional-grey border-grey mr-3">
                    <div class="d-flex m-3 b-p-header">
                        <p class="mb-0 f-15 mr-3 text-dark-grey font-weight-bold">
                            <i class="bi bi-circle-fill mr-2"
                                style="color: <?=$label['label_color'];?>"></i>
                            <?=$label['column_name'];?>
                        </p>
                    </div>
                    <div class="b-p-body">
                        <?php foreach($tasks as $task): ?>
                        <?php if($task['board_column_id'] == $label['id']): ?>
                        <div class="b-p-tasks" id="drag-container-1" data-column-id="1">
                            <div class="card rounded bg-white border-grey b-shadow-4 m-1 mb-2  task-card"
                                data-task-id="2" id="drag-task-2">
                                <div class="card-body p-2">
                                    <div class="d-flex justify-content-between mb-1">
                                        <a href="<?=ROOT;?>/task/<?=$task['task_id'];?>"
                                            class="f-12 f-w-500 text-dark mb-0 text-wrap openRightModal"><?=$task['heading'];?></a>
                                        <p class="f-12 font-weight-bold text-dark-grey mb-0">
                                            #<?=$task['task_id'];?>
                                        </p>
                                    </div>
                                    <div class="d-flex mb-1 justify-content-between">
                                        <div>

                                            <i class="bi bi-layers" style="font-size: 16px;"></i>
                                            <!-- <i class="fa fa-layer-group f-11 text-lightest"></i> Font Awesome fontawesome.com --><span
                                                class="ml-2 f-11 text-lightest"><?=$task['heading'];?></span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex flex-wrap">
                                            <?php foreach($employeeModel->getTaskEmployees($task['task_id']) as $member): ?>
                                            <div class="avatar-img mr-1 rounded-circle">
                                                <a href="<?=ROOT;?>/employeedetails/<?=$member['user_id'];?>"
                                                    alt="<?=$member['employee_name'];?>"
                                                    title="<?=$member['employee_name'];?>"
                                                    data-toggle="tooltip"
                                                    data-original-title="<?=$member['employee_name'];?>"
                                                    data-placement="right"><img src="<?php
                                                    if ($member['employee_image']) {
                                                        echo ROOT.'/'.$member['employee_image'];
                                                    } else {
                                                        echo 'https://www.gravatar.com/avatar/f7e016ba33bbc6009459c4f37ce1c0e4.png?s=200&amp;d=mp';
                                                    }?>"></a>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="d-flex text-red">
                                            <i class="f-11 bi bi-calendar"></i><span class="f-12 ml-1"><?php if($task['due_date']) {
                                                $diff = date_diff(date_create('now'), date_create($task['due_date']));
                                                if($diff->format('%R%a') < 0) {
                                                    echo '<span class="badge badge-pill badge-danger">Overdue</span>';
                                                } else {
                                                    echo '<span class="badge badge-pill badge-primary">'.$diff->format('%a days left').'</span>';
                                                }
                                            }?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
        <?php } elseif(isset($_GET['tab']) && $_GET['tab'] == 'discussion') { ?>
        <style>
            .chat {
                margin-top: auto;
                margin-bottom: auto;
            }

            .card {
                height: 700px;
                border-radius: 15px !important;
                background-color: rgba(23, 31, 41, 0.8) !important;
            }

            .contacts_body {
                padding: 0.75rem 0 !important;
                overflow-y: auto;
                white-space: nowrap;
            }

            .msg_card_body {
                overflow-y: auto;
            }

            .card-header {
                border-radius: 15px 15px 0 0 !important;
                border-bottom: 0 !important;
            }

            .card-footer {
                border-radius: 0 0 15px 15px !important;
                border-top: 0 !important;
            }

            .container {
                align-content: center;
            }


            .type_msg {
                background-color: rgba(0, 0, 0, 0.3) !important;
                border: 0 !important;
                color: white !important;
                height: 60px !important;
                overflow-y: auto;
            }

            .type_msg:focus {
                box-shadow: none !important;
                outline: 0px !important;
            }



            .send_btn {
                border-radius: 0 15px 15px 0 !important;
                background-color: rgba(0, 0, 0, 0.3) !important;
                border: 0 !important;
                color: white !important;
                cursor: pointer;
            }





            .user_img {
                height: 70px;
                width: 70px;
                border: 1.5px solid #f5f6fa;

            }

            .user_img_msg {
                height: 40px;
                width: 40px;
                border: 1.5px solid #f5f6fa;

            }

            .img_cont {
                position: relative;
                height: 70px;
                width: 70px;
            }

            .img_cont_msg {
                height: 40px;
                width: 40px;
            }


            .offline {
                background-color: #c23616 !important;
            }

            .user_info {
                margin-top: auto;
                margin-bottom: auto;
                margin-left: 15px;
            }

            .user_info span {
                font-size: 20px;
                color: white;
            }

            .user_info p {
                font-size: 10px;
                color: rgba(255, 255, 255, 0.6);
            }

            .video_cam {
                margin-left: 50px;
                margin-top: 5px;
            }

            .video_cam span {
                color: white;
                font-size: 20px;
                cursor: pointer;
                margin-right: 20px;
            }

            .msg_cotainer {
                margin-top: auto;
                margin-bottom: auto;
                margin-left: 10px;
                border-radius: 25px;
                background-color: #82ccdd;
                padding: 10px;
                position: relative;
                max-width: 50%;
            }

            .msg_cotainer_send {
                margin-top: auto;
                margin-bottom: auto;
                margin-right: 10px;
                border-radius: 25px;
                background-color: #78e08f;
                padding: 10px;
                position: relative;
                max-width: 50%;
            }

            .msg_time {
                position: absolute;
                left: 11px;
                bottom: -15px;
                color: rgba(255, 255, 255, 0.5);
                font-size: 10px;
            }

            .msg_time_send {
                position: absolute;
                right: 0;
                bottom: -15px;
                color: rgba(255, 255, 255, 0.5);
                font-size: 10px;
                min-width: 108px;
            }

            .msg_head {
                position: relative;
            }
        </style>
        <div class="content-wrapper">
            <div class="container-fluid h-100">

                <div class="col-md-12 chat">
                    <div class="card">
                        <div class="card-header msg_head">
                            <div class="d-flex bd-highlight">

                                <div class="user_info">
                                    <span>Discussion chat</span>
                                    <p><?=$getChatCount;?> Messages
                                    </p>
                                </div>

                            </div>


                        </div>
                        <div class="card-body msg_card_body" id="chatBox">
                            <?php if(!empty($chats)) {
                                foreach($chats as $chat) {
                                    if($chat['user_id'] == $_SESSION['user_id']) { ?>
                            <div class="d-flex justify-content-end mb-4"
                                data-row-id="<?=$chat['id'];?>">
                                <div class="msg_cotainer_send">
                                    <?php echo $chat['message']; ?>
                                    <span class="msg_time_send"> <?php if ($chat['created_at']) {
                                        $date = date_format(date_create($chat['created_at']), 'd M Y');
                                        $time = date_format(date_create($chat['created_at']), 'h:i A');
                                        if($date == date('d M Y')) {
                                            echo 'Today, '.$time;
                                        } else {
                                            echo $date.', '.$time;
                                        }
                                    }
                                        ?></span>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="<?php
                            if ($chat['image']) {
                                echo ROOT.'/'.$chat['image'];
                            } else {
                                echo 'https://www.gravatar.com/avatar/f7e016ba33bbc6009459c4f37ce1c0e4.png?s=200&amp;d=mp';
                            }?>" class="rounded-circle user_img_msg">
                                    <div
                                        style="font-size: 10px; color:white; position: relative; text-align: center; right: 2%;">
                                        You
                                    </div>
                                </div>

                            </div>
                            <?php } else { ?>
                            <div class="d-flex justify-content-start mb-4"
                                data-row-id="<?=$chat['id'];?>">
                                <div class=" img_cont_msg">
                                    <img src="<?php
                            if ($chat['image']) {
                                echo ROOT.'/'.$chat['image'];
                            } else {
                                echo 'https://www.gravatar.com/avatar/f7e016ba33bbc6009459c4f37ce1c0e4.png?s=200&amp;d=mp';
                            }?>" class="rounded-circle user_img_msg">
                                    <div style="font-size: 10px; color:white; position: relative; width: 150px;">
                                        <?=$chat['name'];?>
                                    </div>
                                </div>
                                <div class="msg_cotainer">
                                    <?php echo $chat['message']; ?>
                                    <span class="msg_time"><?php if ($chat['created_at']) {
                                        $date = date_format(date_create($chat['created_at']), 'd M Y');
                                        $time = date_format(date_create($chat['created_at']), 'H:i');
                                        if($date == date('d M Y')) {
                                            echo 'Today, '.$time;
                                        } else {
                                            echo $date.', '.$time;
                                        }
                                    }
                                ?></span>
                                </div>
                            </div>
                            <?php }
                            }
                            } ?>




                        </div>
                        <div class="card-footer">
                            <div class="input-group">

                                <textarea name="message" id="message" class="form-control type_msg"
                                    placeholder="Type your message..."></textarea>
                                <div class="input-group-append">
                                    <span class="input-group-text send_btn"><i
                                            class="bi bi-arrow-90deg-right"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var scrollDown = function() {
                let chatBox = document.getElementById('chatBox');
                chatBox.scrollTo(0, chatBox.scrollHeight)

            }

            scrollDown();

            $(document).ready(function() {

                $(".send_btn").on('click', function() {
                    console.log('clicked');
                    message = $("#message").val();
                    if (message == "") return;
                    $.ajax({
                        url: '<?=ROOT;?>/project/<?=$id?>?msg=add',
                        type: 'POST',
                        data: {
                            message: message
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.status == 'success') {
                                $("#message").val("");
                            }
                        }
                    });
                });





                // auto refresh / reload
                let fechData = function() {
                    var elArray = $('.msg_card_body [data-row-id]').toArray();
                    var maxId = Math.max.apply(Math, elArray.map(function(o) {
                        return $(o).data("row-id");
                    }));

                    $.ajax({
                        url: '<?=ROOT;?>/project/<?=$id?>?msg=fetch',
                        type: 'POST',
                        data: {
                            lastid: maxId
                        },
                        success: function(response) {

                            if (response.status == 'success') {

                                if (response.data.length > 0) {
                                    $("#message").val("");
                                    response.data.forEach((item) => {
                                        var image = item.image ?
                                            '<?=ROOT?>/' +
                                            item.image :
                                            'https://www.gravatar.com/avatar/f7e016ba33bbc6009459c4f37ce1c0e4.png?s=200&amp;d=mp';
                                        var date = new Date(item.created_at);
                                        var today = new Date();
                                        var time = date.getHours() + ":" + date
                                            .getMinutes();
                                        var formatdate = date <= today ? 'Today ' +
                                            time :
                                            date.toDateString();
                                        var session_id =
                                            '<?=$_SESSION['user_id'];?>';



                                        if (item.user_id != session_id) {
                                            console.log('me');
                                            $("#chatBox").append(`
                            <div class="d-flex justify-content-start mb-4" data-row-id="${item.id}">
                                <div class="img_cont_msg">
                                    <img src="${image}" class="rounded-circle user_img_msg">
                                    <div
                                        style="font-size: 10px; color:white; position: relative; width: 150px;">
                                        ${item.name}
                                    </div>
                                </div>
                                <div class="msg_cotainer"> ${item.message}
                                    <span class="msg_time">${formatdate}</span>
                                </div>
                            </div>`);
                                        } else {
                                            console.log('else');
                                            $("#chatBox").append(`
                            <div class="d-flex justify-content-end mb-4" data-row-id="${item.id}">
                                <div class="msg_cotainer_send"> ${item.message}
                                    <span class="msg_time_send">${formatdate}</span>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="${image}" class="rounded-circle user_img_msg">
                                    <div
                                        style="font-size: 10px; color:white; position: relative; text-align: center; right: 2%;">
                                        You
                                    </div>
                                </div>
                            </div>`);
                                        }

                                    });
                                    scrollDown();
                                }
                            }

                        }

                    });
                }
                fechData();
                setInterval(fechData, 1000);
            });
        </script>
    </div>
    <?php } elseif(isset($_GET['tab']) && $_GET['tab'] == 'members') { ?>
    <!-- ROW START -->
    <div class="row py-5">
        <div class="col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4">
            <?php if($_SESSION['user_role'] == 1): ?>
            <button type="button" class="btn-primary rounded f-14 p-2 type-btn mb-3" id="add-project-member"
                data-toggle="modal" data-target="#myModal">
                <i class="bi bi-plus" style="font-size: 16px;"></i>
                <!-- <i class="fa fa-plus mr-1"></i> Font Awesome fontawesome.com -->
                Edit Project Teams
            </button>
            <?php endif; ?>
            <div class="card bg-white border-0 b-shadow-4">
                <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
                    <h4 class="f-18 f-w-500 mb-0">Members</h4>
                </div>
                <div
                    class="card-body border-0 p-0 d-flex justify-content-between align-items-center table-responsive-sm">
                    <table id="example" class="table border-0 pb-3 admin-dash-table table-hover">
                        <thead class="">
                            <tr>
                                <th class="pl-20">Team</th>
                                <th>Name</th>
                                <?php if($_SESSION['user_role'] == 1): ?>
                                <th class="text-right pr-20">Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  $i = 0;
        foreach($getProjectMembers as $employeeProject): ?>
                            <tr id="row-<?=$i;?>">
                                <td class="pl-20">
                                    <?=$employeeProject['team_name'];?>
                                </td>
                                <td>
                                    <style>
                                        .disabled-link {
                                            pointer-events: none;
                                        }
                                    </style>
                                    <div class="media align-items-center mw-250">
                                        <a href="<?=ROOT?>/employeedetails/<?=$employeeProject['user_id'];?>"
                                            class="position-relative">
                                            <img src="<?=$employeeProject['image'] ? ROOT.'/'.$employeeProject['image'] : 'https://www.gravatar.com/avatar/b4dda2fb5d3ab52705af21229f9b4b93.png?s=200&amp;d=mp';?>"
                                                class="mr-2 taskEmployeeImg rounded-circle"
                                                alt="<?=$employeeProject['name'];?>"
                                                title="<?=$employeeProject['name'];?>">
                                        </a>
                                        <div class="media-body">
                                            <h5 class="mb-0 f-12">
                                                <a href="<?=ROOT?>/employeedetails/<?=$employeeProject['user_id'];?>"
                                                    class="text-darkest-grey "><?=$employeeProject['name'];?></a>
                                            </h5>
                                            <p class="mb-0 f-12 text-dark-grey">
                                                <?=$employeeProject['employee_designation'];?>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <?php if($_SESSION['user_role'] == 1): ?>
                                <td class="text-right pr-20">
                                    <button type="button" class="btn-secondary rounded f-14 p-2 delete-row"
                                        data-row-id="<?=$employeeProject['user_id'];?>"
                                        data-row-teamid="<?=$employeeProject['team_id'];?>">

                                        <i class="bi bi-trash" style="font-size: 16px;"></i>
                                        <!-- <i class="fa fa-trash mr-1"></i> Font Awesome fontawesome.com -->
                                        Delete
                                    </button>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php $i++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Add Project Members</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="addProjectMemberForm" autocomplete="off">
                        <div class="row">

                            <div class="col-md-12" id="select-department-section">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true"
                                        for="selectDepartment">Edit Departments
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>
                                    <div class="input-group">

                                        <select class="form-control selectpicker show-tick height-50" multiple=""
                                            name="team_id[]" id="department_list_id" data-live-search="true"
                                            data-size="8">
                                            <?php foreach($getDepartments as $team): ?>
                                            <option
                                                data-content="<span class='badge badge-pill badge-light border p-2'><?=$team['team_name'];?></span>"
                                                value="<?=$team['id'];?>">
                                                <?=$team['team_name'];?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn-cancel rounded f-14 p-2 border-0 mr-3" data-dismiss="modal">
                        Close
                    </a>
                    <button type="button" class="btn-primary rounded f-14 p-2" id="save-project-department">
                        <i class="bi bi-check mr-1"></i>
                        Save
                    </button>

                </div>
            </div>
        </div>
    </div>

    <script>
        $('.delete-row').click(function() {
            var id = $(this).data('row-id');
            var teamid = $(this).data('row-teamid');
            var tr = $(this).closest('tr');
            var url =
                "<?=ROOT?>/project/<?=$id;?>?action=delete_member";
            Swal.fire({
                title: "Are you sure?",
                text: "Removing this members from the project will also remove him from the team he is assigned to.",
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
                        url: url,
                        data: {
                            user_id: id,
                            team_id: teamid
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.status == "success") {
                                tr.remove();
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Member has been removed from the project and team",
                                    icon: 'success',
                                    showCancelButton: false,
                                    focusConfirm: false,
                                    confirmButtonText: "Ok",
                                    customClass: {
                                        confirmButton: 'btn btn-primary mr-3',
                                    },
                                    showClass: {
                                        popup: 'swal2-noanimation',
                                        backdrop: 'swal2-noanimation'
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

        $('#save-project-department').on('click', function() {
            var url =
                "<?=ROOT?>/project/<?=$id;?>?action=edit_departments";
            var department = $('#department_list_id').val();
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    department: department
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == "success") {
                        Swal.fire({
                            title: "Saved!",
                            text: "Departments have been saved",
                            icon: 'success',
                            showCancelButton: false,
                            focusConfirm: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: 'btn btn-primary mr-3',
                            },
                            showClass: {
                                popup: 'swal2-noanimation',
                                backdrop: 'swal2-noanimation'
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
        });
    </script>
    <?php } ?>
    </div>
</section>
<?php require_once("views/layout/footer.php");
?>
<script>
    $(document).ready(function() {
        $('#tasks-table').DataTable();

        var changeStatus = $('.change-status');
        changeStatus.selectpicker('val',
            '<?=$project['status'];?>');
        $('.selectpicker').selectpicker('refresh');

        changeStatus.on('change', function() {
            var status = $(this).val();
            var url =
                "<?=ROOT?>/project/<?=$id;?>?action=change_status";
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    status: status,
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == "success") {
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: 'success',
                            showCancelButton: false,
                            focusConfirm: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: 'btn btn-primary mr-3',
                            },
                            showClass: {
                                popup: 'swal2-noanimation',
                                backdrop: 'swal2-noanimation'
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
        });
    });

    $('#status_task').on('change', function() {
        var status = $(this).val();
        var id = $(this).closest('tr').data('id');
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
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
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

    selectedDepartments = <?php echo json_encode($teams); ?> ;
    $('#department_list_id').selectpicker('val', selectedDepartments);
</script>
<?php require_once("views/layout/header.php"); ?>
<?php require_once("views/layout/navbar.php"); ?>
<section class="main-container bg-additional-grey" id="fullscreen">

    <div class="d-flex d-lg-block filter-box project-header bg-white">

        <div class="project-menu" id="mob-client-detail">

            <nav class="tabs --jsfied">
                <ul class="-primary">
                    <li>
                        <a href="<?=ROOT?>/employee/<?=$id?>"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab profile <?php if(!isset($_GET['tab'])) {
                                echo "active";
                            } ?>"
                            id="profile"><span><?=G_PROFILE;?></span></a>
                    </li>
                    <li>
                        <a href="<?=ROOT?>/employee/<?=$id?>?tab=projects"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu projects <?php if(isset($_GET['tab']) && $_GET['tab'] == "projects") {
                                echo "active";
                            }?>"
                            id="projects"><span><?=G_PROJECTS;?></span></a>
                    </li>
                    <li>
                        <a href="<?=ROOT?>/employee/<?=$id?>?tab=tasks"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu tasks <?php if(isset($_GET['tab']) && $_GET['tab'] == "tasks") {
                                echo "active";
                            }?>"
                            id="tasks"><span><?=G_TASKS;?></span></a>
                    </li>
                    <li>
                        <a href=" <?=ROOT?>/employee/<?=$id?>?tab=documents"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab documents <?php if(isset($_GET['tab']) && $_GET['tab'] == "documents") {
                                echo "active";
                            }?>"
                            id="documents"><span><?=G_DOCUMENTS;?></span></a>
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
                                                        <?=G_EDIT;?>
                                                </div>
                                            </div>
                                            <p class="f-13 font-weight-normal text-dark-grey mb-0">
                                                <?=$employee['designation_name']?>
                                            </p>
                                            <p class="card-text f-12 text-lightest">
                                                <?php foreach($teams as $team): ?>
                                                •
                                                <?=$team['team_name']?>
                                                <?php endforeach; ?>
                                            </p>
                                            <div class="card-footer bg-white border-top-grey pl-0">
                                                <div class="d-flex flex-wrap ">
                                                    <span class="pl-3">
                                                        <label class="f-11 text-dark-grey mb-12 text-capitalize"
                                                            for="usr"><?=G_OPEN_TASKS;?></label>
                                                        <p class="mb-0 f-18 f-w-500">
                                                            <?=$NumberOfIncompleteTasks['task_count']?>
                                                        </p>
                                                    </span>
                                                    <span class="pl-3">
                                                        <label class="f-11 text-dark-grey mb-12 text-capitalize"
                                                            for="usr"><?=G_PROJECTS;?></label>
                                                        <p class="mb-0 f-18 f-w-500">
                                                            <?=$NumberOfProjects['project_count'];?>
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
                                        <h4 class="f-18 f-w-500 mb-0">
                                            <?=G_PROFILE;?>
                                        </h4>
                                    </div>
                                    <div class="card-body ">
                                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">
                                                <?=G_EMPLOYEE;?> ID
                                            </p>
                                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                                <?=$employee['employee_id']?>
                                            </p>
                                        </div>
                                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">
                                                <?=G_NAME;?>
                                            </p>
                                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                                <?=$employee['name']?>
                                            </p>
                                        </div>
                                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">
                                                <?=G_EMAIL;?>
                                            </p>
                                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                                <?=$employee['email']?>
                                            </p>
                                        </div>
                                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">
                                                <?=G_MOBILE;?>
                                            </p>
                                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                                <?=$employee['mobile']?>
                                            </p>
                                        </div>
                                        <div class="col-12 px-0 pb-3 d-block d-lg-flex d-md-flex">
                                            <p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">
                                                <?=G_GENDER;?>
                                            </p>
                                            <p class="mb-0 text-dark-grey f-14 w-70">
                                                <?php if($employee['gender'] == "male") {
                                                    echo G_GENDER_MALE;
                                                } elseif($employee['gender'] == "female") {
                                                    echo G_GENDER_FEMALE;
                                                } else {
                                                    echo G_GENDER_OTHER;
                                                }
            ?>
                                            </p>
                                        </div>
                                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">
                                                <?=G_DATE_OF_BIRTH;?>
                                            </p>
                                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                                <?=$employee['date_of_birth']?>
                                            </p>
                                        </div>
                                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">
                                                <?=G_SLACK_USERNAME;?>
                                            </p>
                                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                                <?=$employee['slack_username']?>
                                            </p>
                                        </div>
                                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">
                                                <?=G_ADDRESS;?>
                                            </p>
                                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                                <?=$employee['address']?>
                                            </p>
                                        </div>
                                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">
                                                <?=G_SKILLS;?>
                                            </p>
                                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                                <?=$employee['skills']?>
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
                                                <h4 class="f-18 f-w-500 mb-0">
                                                    <?=G_TASKS;?>
                                                </h4>
                                            </div>
                                            <div class="card-body p-0 ">
                                                <div class="text-center text-lightest p-20" style="height: 250px">
                                                    <i class="side-icon f-21 bi bi-pie-chart"></i>
                                                    <div class="f-15 mt-4">
                                                        <?=G_NOT_ENOUGH_DATA;?>
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
                        <p class="mb-0 f-18 f-w-500"><?=G_ACTIVITY;?>
                        </p>
                    </div>
                    <div class="p-activity-detail cal-info b-shadow-4" data-menu-vertical="1" data-menu-scroll="1"
                        data-menu-dropdown-timeout="500" id="projectActivityDetail">
                        <?php foreach($getUserActivity as $activity):
                            $activityJSON = json_decode($activity['activity'], true);
                            ?>
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
                                        <?=$activityJSON[LANG_ISO]?>
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
                                    <th><?=G_PROJECT;?></th>
                                    <th><?=G_MEMBERS;?></th>
                                    <th><?=G_DEADLINE;?></th>
                                    <th><?=G_CLIENT;?></th>
                                    <th><?=G_PROGRESS;?></th>
                                    <th><?=G_STATUS;?></th>
                                    <th><?=G_ACTION;?> </th>
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
                                                    href="<?=ROOT?>/employee/<?=$member['user_id'];?>">
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
                                     echo ' <span class="badge badge-danger">'.G_EXPIRED.'</span>';
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
                                                                      }?>"
                                                    class="mr-2 taskEmployeeImg rounded-circle"
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
                                        <?php
                                        if($project['status'] == 'in progress') {
                                            echo "<i class='bi bi-circle-fill  mr-2  text-blue'></i> ".PROJECT_INPROGRESS;
                                        } elseif($project['status'] == 'finished') {
                                            echo "<i class='bi bi-circle-fill  mr-2  text-success'></i> ".PROJECT_FINISHED;
                                        } elseif($project['status'] == 'on hold') {
                                            echo "<i class='bi bi-circle-fill  mr-2  text-warning'></i> ".PROJECT_ONHOLD;
                                        } elseif($project['status'] == 'canceled') {
                                            echo "<i class='bi bi-circle-fill  mr-2  text-danger'></i> ".PROJECT_CANCELLED;
                                        } else {
                                            echo "<i class='bi bi-circle-fill  mr-2  text-dark-grey'></i> ".PROJECT_NOTSTARTED;
                                        }
                                 ?>
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
                                                    <a href="<?=ROOT?>/project/<?=$project['project_id']?>"
                                                        class="dropdown-item">
                                                        <i class="bi bi-eye-fill mr-2"></i>
                                                        <?=G_VIEW?></a><a
                                                        class="dropdown-item openRightModal"
                                                        href="<?=ROOT;?>/project/<?=$project['project_id']?>?edit">
                                                        <i class="bi bi-pencil-fill mr-2"></i>
                                                        <?=G_EDIT;?>
                                                    </a>
                                                    </a><a class="dropdown-item" target="_blank" href="">
                                                        <i class="bi bi-printer-fill mr-2"></i>
                                                        <?=G_PUBLIC_TASKBOARD;?>
                                                    </a>
                                                    </a><a class="dropdown-item delete-table-row" href="javascript:;"
                                                        data-user-id="1">
                                                        <i class="bi bi-trash-fill mr-2"></i>
                                                        <?=G_DELETE;?>
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
        <?php } elseif(isset($_GET['tab']) && $_GET['tab'] == 'tasks') { ?>
        <div class="row py-0 py-md-0 py-lg-3">
            <div class="col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4">



                <!-- Add Task Export Buttons Start -->
                <div class="d-flex justify-content-between action-bar">
                    <div id="table-actions" class="align-items-center">
                        <a href="<?=ROOT;?>/task/create?user=<?=$id;?>"
                            class="btn-primary rounded f-14 p-2 mr-3 openRightModal float-left"
                            data-redirect-url="<?=ROOT;?>/task/create?user=<?=$id;?>">
                            <i class="bi bi-plus-circle mr-2"></i>
                            <?=G_ADD_TASK;?>
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
                                        <?php foreach($getEmployeeTasks as $getEmployeeTask): ?>
                                        <tr>

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
                                            <td
                                                data-search="<?=$getEmployeeTask['due_date']?>">
                                                <?php
                                                $due_data = $getEmployeeTask['due_date'];
                                            if($due_data > date('Y-m-d')) {
                                                echo $due_data;
                                            } else {
                                                echo ' <span class="badge badge-danger">'.G_EXPIRED.'</span>';
                                                echo '<br>';
                                                echo '<span class="text-danger">'.$due_data.'</span>';
                                            }

                                            ?>
                                            </td>

                                            <td data-search="<?php foreach($employeeModel->getTaskEmployees($getEmployeeTask['task_id']) as $member) {
                                                echo $member['employee_name'];
                                            } ?> ">
                                                <div class="position-relative">
                                                    <?php
                                            $left = 0;
                                            foreach($employeeModel->getTaskEmployees($getEmployeeTask['task_id']) as $member):
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
                                            <td>
                                                <select class="selectpicker">
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
                                                                <?=G_VIEW;?></a><a
                                                                class="dropdown-item openRightModal"
                                                                href="<?=ROOT?>/task/<?=$getEmployeeTask['task_id']?>?edit">
                                                                <i class="bi bi-pencil-fill mr-2"></i>
                                                                <?=G_EDIT;?>
                                                            </a><a class="dropdown-item delete-table-row"
                                                                href="javascript:;" data-user-id="1">
                                                                <i class="bi bi-trash-fill mr-2"></i>

                                                                <?=G_DELETE;?>
                                                            </a>
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
                            <?php foreach($employeeFiles as $file):
                                $time = date_diff(date_create('now'), date_create($file['created_at']));
                                if ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') == 0) {
                                    $time = $time->format('%s '.G_SECONDS.' '.G_AGO);
                                } elseif ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') > 0) {
                                    $time = $time->format('%i '.G_MINUTES.' '.G_AGO);
                                } elseif ($time->format('%a') == 0 && $time->format('%h') > 0) {
                                    $time = $time->format('%h '.G_HOURS.' '.G_AGO);
                                } else {
                                    $time = $time->format('%a '.G_DAYS.' '.G_AGO);
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
                        url: '<?=ROOT;?>/employee/<?=$id;?>?action=uploadfile',
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
                        title: "<?=SWAL_TITLE_DELETE;?>",
                        text: "You will not be able to recover the deleted record!",
                        icon: 'warning',
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText: "<?=SWAL_CONFIRM_DELETE;?>",
                        cancelButtonText: "<?=G_CANCEL;?>",
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
                            var url = "";
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
<?php require_once("views/layout/footer.php");


?>

<script>
    $(document).ready(function() {
        var projects = $('#projects-table').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/<?=LANG;?>.json'
            }
        });

        var tasks = $('#tasks-table').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/<?=LANG;?>.json'
            }
        });

        $('#statusTask').on('change', function() {
            if ($(this).val() == 'all') {
                tasks.search('').draw();
            } else {
                tasks.search($(this).val()).draw();
            }

        });
    });
</script>
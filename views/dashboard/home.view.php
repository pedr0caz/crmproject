<?php require_once("views/layout/header.php"); ?>
<?php require_once("views/layout/navbar.php"); ?>

<section class="main-container bg-additional-grey" id="fullscreen">


    <!-- CONTENT WRAPPER START -->
    <div class="px-4 py-2 border-top-0 emp-dashboard">
        <!-- WELOCOME START -->
        <div class="d-lg-flex d-md-flex d-block py-4">
            <!-- WELOCOME NAME START -->
            <div class="">
                <h4 class=" mb-0 f-21 text-capitalize font-weight-bold">
                    <?=G_WELCOME?>
                    <?=$_SESSION['user_name'];?>
                </h4>
            </div>
            <!-- WELOCOME NAME END -->

            <!-- CLOCK IN CLOCK OUT START -->
            <div
                class="ml-auto d-flex clock-in-out mb-3 mb-lg-0 mb-md-0 m mt-4 mt-lg-0 mt-md-0 justify-content-between">
                <p
                    class="mb-0 text-lg-right text-md-right f-18 font-weight-bold text-dark-grey d-grid align-items-center">
                    <?=date('H:i a')?><span
                        class="f-10 font-weight-normal"><?=strftime('%A')?></span>


                </p>





            </div>
            <!-- CLOCK IN CLOCK OUT END -->
        </div>
        <!-- WELOCOME END -->
        <!-- EMPLOYEE DASHBOARD DETAIL START -->
        <div class="row emp-dash-detail">
            <!-- EMP DASHBOARD INFO NOTICES START -->
            <div class="col-xl-5 col-lg-12 col-md-12 e-d-info-notices">
                <div class="row">
                    <!-- EMP DASHBOARD INFO START -->
                    <div class="col-md-12">
                        <div class="card border-0 b-shadow-4 mb-3 e-d-info">
                            <div class="card-horizontal align-items-center">
                                <div class="card-img">
                                    <img class=""
                                        src="<?=$_SESSION['user_image'] ? $_SESSION['user_image'] : 'https://www.gravatar.com/avatar/a456ed61bc3c5d05f3ad79d85069098a.png?s=200&d=mp';?>"
                                        alt="Card image">
                                </div>
                                <div class="card-body border-0 pl-0">
                                    <h4 class="card-title f-18 f-w-500 mb-0">
                                        <?=$_SESSION['user_name'];?>
                                    </h4>
                                    <p class="f-14 font-weight-normal text-dark-grey mb-2">
                                        <?php
if ($_SESSION['user_role'] <= 2) {
    echo "<span class='badge badge-info'>" . $designationD . "</span> ";
   
    echo "<br>";
    foreach ($department as $dept) {
        echo "<span class='badge badge-primary'>" . $dept['team_name'] . "</span> ";
    }
} else {
    echo G_CLIENT;
}?>
                                    </p>

                                </div>
                            </div>

                            <div class="card-footer bg-white border-top-grey py-3">
                                <div class="d-flex flex-wrap justify-content-between">
                                    <span>
                                        <label class="f-12 text-dark-grey mb-12 text-capitalize" for="usr">
                                            <?=DASHBOARD_OPEN_TASKS;?>
                                        </label>
                                        <p class="mb-0 f-18 f-w-500">
                                            <a href="" class="text-dark">
                                                <?=count($tasks);?>
                                            </a>
                                        </p>
                                    </span>
                                    <span>
                                        <label class="f-12 text-dark-grey mb-12 text-capitalize" for="usr">
                                            <?=G_PROJECTS?> </label>
                                        <p class="mb-0 f-18 f-w-500">
                                            <a href=""
                                                class="text-dark"><?=count($projects);?></a>
                                        </p>
                                    </span>
                                    <span>

                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- EMP DASHBOARD INFO END -->


                    <!-- EMP DASHBOARD BIRTHDAY START -->
                    <div class="col-sm-12">
                        <div class="card bg-white border-0 b-shadow-4 e-d-info mb-3">
                            <div
                                class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
                                <h4 class="f-18 f-w-500 mb-0">
                                    <?=DASHBOARD_BIRTHDAYS;?>
                                </h4>



                            </div>

                            <div class="card-body p-0 h-200">
                                <table id="example" class="table">
                                    <tbody>
                                        <?php foreach ($birthdays as $birthday) : ?>
                                        <tr>
                                            <td class="pl-20">
                                                <style>
                                                    .disabled-link {
                                                        pointer-events: none;
                                                    }
                                                </style>

                                                <div class="media align-items-center mw-250">
                                                    <a href="<?=ROOT;?>/employee/<?=$birthday['id'];?>"
                                                        class="position-relative ">
                                                        <img src="<?=$birthday['image'] ? $birthday['image'] : 'https://www.gravatar.com/avatar/a456ed61bc3c5d05f3ad79d85069098a.png?s=200&d=mp';?>"
                                                            class="mr-2 taskEmployeeImg rounded-circle">
                                                    </a>
                                                    <div class="media-body">
                                                        <h5 class="mb-0 f-12">
                                                            <a href="<?=ROOT;?>/employee/<?=$birthday['id'];?>"
                                                                class="text-darkest-grey "><?=$birthday['name'];?></a>
                                                        </h5>
                                                        <p class="mb-0 f-12 text-dark-grey">
                                                            <?=$birthday['designation'];?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="pr-20"><span class="badge badge-secondary p-2">
                                                    🎂
                                                    <?=strftime('%d', strtotime($birthday['date_of_birth']));?>
                                                    <?=ucfirst(strftime('%b', strtotime($birthday['date_of_birth'])));?></span>
                                            </td>
                                            <td class="pr-20">
                                                <span class="badge badge-light p-2">
                                                    <?=countdays($birthday['date_of_birth']);?>
                                                </span>

                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- EMP DASHBOARD BIRTHDAY END -->


                    <!-- EMP DASHBOARD NOTICE START -->
                    <div class="col-md-12">
                        <div class="mb-3 b-shadow-4 rounded bg-white pb-2">
                            <!-- NOTICE HEADING START -->
                            <div class="d-flex align-items-center b-shadow-4 p-20">
                                <p class="mb-0 f-18 f-w-500">
                                    <?=G_NOTICES;?>
                                </p>
                            </div>
                            <!-- NOTICE HEADING END -->
                            <!-- NOTICE DETAIL START -->
                            <div class="b-shadow-4 cal-info scroll ps" data-menu-vertical="1" data-menu-scroll="1"
                                data-menu-dropdown-timeout="500" id="empDashNotice" style="overflow: hidden;">
                                <?php if(empty($notices)) : ?>
                                <div class="p-20">
                                    <p class="mb-0 f-14 f-w-500">
                                        <?=DASHBOARD_NO_NOTICES;?>
                                    </p>
                                </div>
                                <?php endif; ?>
                                <?php foreach($notices as $notice):
                                        
                                    ?>
                                <div class="card border-0 b-shadow-4 p-20 rounded-0">
                                    <div class="card-horizontal">
                                        <div class="card-header m-0 p-0 bg-white rounded">
                                            <span class="f-12 p-1 ">
                                                <?=ucfirst(strftime('%b', strtotime($notice['created_at'])));?></span>
                                            <span
                                                class="f-13 f-w-500 rounded-bottom"><?=date('d', strtotime($notice['created_at']))?></span>
                                        </div>

                                        <div class="card-body border-0 p-0 ml-3">
                                            <h4 class="card-title f-14 font-weight-normal text-capitalize mb-0">
                                                <a href="<?=ROOT;?>/notice/<?=$notice['id'];?>"
                                                    class="openRightModal text-darkest-grey"><?=$notice['heading']?></a>
                                            </h4>
                                        </div>

                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- NOTICE DETAIL END -->
                        </div>
                    </div>
                    <!-- EMP DASHBOARD NOTICE END -->

                </div>
            </div>
            <!-- EMP DASHBOARD INFO NOTICES END -->
            <!-- EMP DASHBOARD TASKS PROJECTS EVENTS START -->
            <div class="col-xl-7 col-lg-12 col-md-12 e-d-tasks-projects-events">
                <!-- EMP DASHBOARD TASKS PROJECTS START -->
                <div class="row mb-3 mt-xl-0 mt-lg-4 mt-md-4 mt-4">
                    <div class="col-md-6">
                        <div
                            class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center mb-4 mb-md-0 mb-lg-0">
                            <div class="d-block text-capitalize">
                                <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">
                                    <?=G_TASKS;?>
                                </h5>
                                <div class="d-flex">
                                    <a href="">
                                        <p class="mb-0 f-21 font-weight-bold text-blue d-grid mr-5">

                                            <?=$incompleteTasks;?>
                                            <span class="f-12 font-weight-normal text-lightest">
                                                <?=G_INCOMPLETE;?>
                                            </span>
                                        </p>
                                    </a>
                                    <a href="">
                                        <p class="mb-0 f-21 font-weight-bold text-red d-grid">
                                            <?=$overdueTasks;?><span
                                                class="f-12 font-weight-normal text-lightest"><?=G_OVERDUE;?></span>
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="d-block">

                                <i class="bi bi-list text-lightest f-27"></i>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div
                            class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center mt-3 mt-lg-0 mt-md-0">
                            <div class="d-block text-capitalize">
                                <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">
                                    <?=G_PROJECTS;?>
                                </h5>
                                <div class="d-flex">
                                    <a href="">
                                        <p class="mb-0 f-21 font-weight-bold text-blue d-grid mr-5">
                                            <?=$incompleteProjects;?><span
                                                class="f-12 font-weight-normal text-lightest"><?=G_INPROGRESS;?></span>
                                        </p>
                                    </a>

                                    <a href="">
                                        <p class="mb-0 f-21 font-weight-bold text-red d-grid">
                                            <?=$overdueProjects;?><span
                                                class="f-12 font-weight-normal text-lightest"><?=G_OVERDUE;?></span>
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="d-block">
                                <i class="bi bi-stack text-lightest f-27"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- EMP DASHBOARD TASKS PROJECTS END -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card border-0 b-shadow-4 mb-3 e-d-info">
                            <div class="card bg-white border-0 b-shadow-4">
                                <div
                                    class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
                                    <h4 class="f-18 f-w-500 mb-0">
                                        <?php if(isset($_SESSION['user_client_id'])) {
                                            echo DASHBOARD_MY_TASKS_CLIENT;
                                        } else {
                                            echo DASHBOARD_MY_TASKS;
                                        } ;?>
                                    </h4>



                                </div>

                                <div class="card-body p-0 h-200">
                                    <table id="example" class="table">
                                        <thead class="">
                                            <tr>
                                                <th><?=G_TASK?>#</th>
                                                <th><?=G_TASK?></th>
                                                <th><?=G_STATUS?>
                                                </th>
                                                <th class="text-right pr-20">
                                                    <?=G_DUE_DATE?>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($tasks) {?>
                                            <?php foreach($tasks as $task):?>
                                            <tr>
                                                <td class="pl-20">
                                                    #<?=$task['task_id']?>
                                                </td>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <h5 class="f-12 mb-1 text-darkest-grey"><a
                                                                    href="<?=ROOT?>/task/<?=$task['task_id']?>"
                                                                    class="openRightModal"><?=$task['heading'];?></a>
                                                            </h5>
                                                            <p class="mb-0">
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="pr-20">
                                                    <?php if($task['board_column_id'] == '3') {?>
                                                    <span
                                                        class="badge badge-pill badge-primary"><?=G_INPROGRESS?></span>

                                                    <?php } elseif($task['board_column_id'] == '2') {?>
                                                    <span
                                                        class="badge badge-pill badge-success"><?=G_COMPLETED?></span>
                                                    <?php } elseif($task['board_column_id'] == '1') {?>
                                                    <span
                                                        class="badge badge-pill badge-warning"><?=G_INCOMPLETE?></span>
                                                    <?php } ?>
                                                </td>
                                                <td class="pr-20" align="right">
                                                    <?php if($task['due_date']) {
                                                        $diff = date_diff(date_create('now'), date_create($task['due_date']));
                                                        if($diff->format('%R%a') < 0) {
                                                            echo '<span class="badge badge-pill badge-danger">'.G_OVERDUE.'</span>';
                                                        } else {
                                                            echo '<span class="badge badge-pill badge-primary">'.$diff->format('%a '.G_DAYS.' left').'</span>';
                                                        }
                                                    }?>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                            <?php } else { ?>
                                            <tr>
                                                <td colspan="4" class="shadow-none">
                                                    <div
                                                        class="align-items-center d-flex flex-column text-lightest p-20 w-100">
                                                        <i class="bi bi-exclamation-circle f-50"></i>
                                                        <div class="f-15 mt-4">
                                                            -
                                                            <?=G_NO_RECORDS_FOUND;?>.
                                                            -
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- EMP DASHBOARD EVENTS END -->
            </div>
            <!-- EMP DASHBOARD TASKS PROJECTS EVENTS END -->
        </div>
        <!-- EMPLOYEE DASHBOARD DETAIL END -->


    </div>
    <!-- CONTENT WRAPPER END -->


</section>
<?php require_once("views/layout/footer.php");
?>
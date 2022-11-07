<?php require_once("views/layout/header.php"); ?>
<?php require_once("views/layout/navbar.php"); ?>

<section class="main-container bg-additional-grey" id="fullscreen">



    <div class="px-4 py-2 border-top-0 emp-dashboard">

        <div class="d-lg-flex d-md-flex d-block py-4">
  
            <div class="">
                <h4 class=" mb-0 f-21 text-capitalize font-weight-bold">
                    <?=MENU_ADMIN_DASHBOARD;?>
                </h4>
            </div>
    
            <div
                class="ml-auto d-flex clock-in-out mb-3 mb-lg-0 mb-md-0 m mt-4 mt-lg-0 mt-md-0 justify-content-between">
                <p
                    class="mb-0 text-lg-right text-md-right f-18 font-weight-bold text-dark-grey d-grid align-items-center">
                    <?=date('H:i a')?><span
                        class="f-10 font-weight-normal"><?=strftime('%A')?></span>


                </p>





            </div>

        </div>

        <div class="row emp-dash-detail">

            <div class="col-xl-5 col-lg-12 col-md-12 e-d-info-notices">
                <div class="row">
                    <div class="col-4 mb-2">
                        <a href="">
                            <div
                                class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
                                <div class="d-block text-capitalize">
                                    <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">
                                        <?=G_TOTAL . " " . G_CLIENTS?>
                                    </h5>

                                    <div class="d-flex">
                                        <p class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid"><span
                                                id=""><?=count($clients);?></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-block">
                                    <i class="bi bi-person-badge-fill f-18 text-lightest"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-4 mb-2">
                        <a href="">
                            <div
                                class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
                                <div class="d-block text-capitalize">
                                    <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">
                                        <?=G_TOTAL . " " . G_EMPLOYEES?>
                                    </h5>
                                    <div class="d-flex">
                                        <p class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid"><span
                                                id=""><?=count($employees);?></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-block">
                                    <i class="bi bi-person-fill f-18 text-lightest"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-4 mb-2">
                        <a href="">
                            <div
                                class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
                                <div class="d-block text-capitalize">
                                    <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">
                                        <?=G_TOTAL . " " . G_PROJECTS?>
                                    </h5>
                                    <div class="d-flex">
                                        <p class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid"><span
                                                id=""><?=count($projects);?></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-block">
                                    <i class="bi bi-pie-chart-fill f-18 text-lightest"></i>
                                </div>
                            </div>
                        </a>
                    </div>






                </div>
                <div class="row">






              
                    <div class="col-md-12">
                        <div class="mb-3 b-shadow-4 rounded bg-white pb-2">
                         
                            <div class="d-flex align-items-center b-shadow-4 p-20">
                                <p class="mb-0 f-18 f-w-500">
                                    <?=G_NOTICES;?>
                                </p>
                            </div>
                          
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

                   
                        </div>
                    </div>
           

                </div>
            </div>
        
            <div class="col-xl-7 col-lg-12 col-md-12 e-d-tasks-projects-events">
             
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
     

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card border-0 b-shadow-4 mb-3 e-d-info">
                            <div class="card bg-white border-0 b-shadow-4">
                                <div
                                    class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
                                    <h4 class="f-18 f-w-500 mb-0">
                                        <?=G_TASKS;?>
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
                                            <?php foreach($tasks as $task):
                                                if($task['board_column_id'] == 2) {
                                                    continue;
                                                }
                                                ?>
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
                                                    <?php if($task['due_date'] && $task['board_column_id'] != '2') {
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



            </div>

        </div>



    </div>



</section>
<?php require_once("views/layout/footer.php");
?>
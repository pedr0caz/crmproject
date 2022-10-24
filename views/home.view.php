<?php require_once("layout/header.php"); ?>
<?php require_once("layout/navbar.php"); ?>

<section class="main-container bg-additional-grey" id="fullscreen">

    <div class="preloader-container justify-content-center align-items-center" style="display: none;">
        <div class="spinner-border" role="status" aria-hidden="true"></div>
    </div>



    <!-- CONTENT WRAPPER START -->
    <div class="px-4 py-2 border-top-0 emp-dashboard">
        <!-- WELOCOME START -->
        <div class="d-lg-flex d-md-flex d-block py-4">
            <!-- WELOCOME NAME START -->
            <div class="">
                <h4 class=" mb-0 f-21 text-capitalize font-weight-bold">Welcome <?=$_SESSION['user_name'];?>
                </h4>
            </div>
            <!-- WELOCOME NAME END -->

            <!-- CLOCK IN CLOCK OUT START -->
            <div
                class="ml-auto d-flex clock-in-out mb-3 mb-lg-0 mb-md-0 m mt-4 mt-lg-0 mt-md-0 justify-content-between">
                <p
                    class="mb-0 text-lg-right text-md-right f-18 font-weight-bold text-dark-grey d-grid align-items-center">
                    <?=date('H:i a')?><span
                        class="f-10 font-weight-normal"><?=date("l")?></span>


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
                                    <h4 class="card-title f-18 f-w-500 mb-0">Pedro</h4>
                                    <p class="f-14 font-weight-normal text-dark-grey mb-2">
                                        --</p>

                                </div>
                            </div>

                            <div class="card-footer bg-white border-top-grey py-3">
                                <div class="d-flex flex-wrap justify-content-between">
                                    <span>
                                        <label class="f-12 text-dark-grey mb-12 text-capitalize" for="usr">
                                            Open Tasks </label>
                                        <p class="mb-0 f-18 f-w-500">
                                            <a href="" class="text-dark">
                                                <?=count($tasks);?>
                                            </a>
                                        </p>
                                    </span>
                                    <span>
                                        <label class="f-12 text-dark-grey mb-12 text-capitalize" for="usr">
                                            Projects </label>
                                        <p class="mb-0 f-18 f-w-500">
                                            <a href="" class="text-dark">1</a>
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
                                <h4 class="f-18 f-w-500 mb-0">Birthdays</h4>



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
                                                    <a href="<?=ROOT;?>/employeedetails/<?=$birthday['id'];?>"
                                                        class="position-relative ">
                                                        <img src="<?=$birthday['image'] ? $birthday['image'] : 'https://www.gravatar.com/avatar/a456ed61bc3c5d05f3ad79d85069098a.png?s=200&d=mp';?>"
                                                            class="mr-2 taskEmployeeImg rounded-circle">
                                                    </a>
                                                    <div class="media-body">
                                                        <h5 class="mb-0 f-12">
                                                            <a href="<?=ROOT;?>/employeedetails/<?=$birthday['id'];?>"
                                                                class="text-darkest-grey "><?=$birthday['name'];?></a>
                                                        </h5>
                                                        <p class="mb-0 f-12 text-dark-grey">
                                                            <?=$birthday['designation'];?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="pr-20"><span class="badge badge-secondary p-2">
                                                    <svg class="svg-inline--fa fa-birthday-cake fa-w-14"
                                                        aria-hidden="true" focusable="false" data-prefix="fa"
                                                        data-icon="birthday-cake" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                        data-fa-i2svg="">
                                                        <path fill="currentColor"
                                                            d="M448 384c-28.02 0-31.26-32-74.5-32-43.43 0-46.825 32-74.75 32-27.695 0-31.454-32-74.75-32-42.842 0-47.218 32-74.5 32-28.148 0-31.202-32-74.75-32-43.547 0-46.653 32-74.75 32v-80c0-26.5 21.5-48 48-48h16V112h64v144h64V112h64v144h64V112h64v144h16c26.5 0 48 21.5 48 48v80zm0 128H0v-96c43.356 0 46.767-32 74.75-32 27.951 0 31.253 32 74.75 32 42.843 0 47.217-32 74.5-32 28.148 0 31.201 32 74.75 32 43.357 0 46.767-32 74.75-32 27.488 0 31.252 32 74.5 32v96zM96 96c-17.75 0-32-14.25-32-32 0-31 32-23 32-64 12 0 32 29.5 32 56s-14.25 40-32 40zm128 0c-17.75 0-32-14.25-32-32 0-31 32-23 32-64 12 0 32 29.5 32 56s-14.25 40-32 40zm128 0c-17.75 0-32-14.25-32-32 0-31 32-23 32-64 12 0 32 29.5 32 56s-14.25 40-32 40z">
                                                        </path>
                                                    </svg>
                                                    <!-- <i class="fa fa-birthday-cake"></i> Font Awesome fontawesome.com -->
                                                    <?=date('d', strtotime($birthday['date_of_birth']))?>
                                                    <?=date('M', strtotime($birthday['date_of_birth']))?></span>
                                            </td>
                                            <td class="pr-20">
                                                <span class="badge badge-light p-2"><?php if(date("d-m-Y", strtotime($birthday['date_of_birth'])) == date("d-m-Y")) {
                                                    echo "Today";
                                                } else {
                                                    echo date_diff(date_create($birthday['date_of_birth']), date_create('today'))->format('in %a days');
                                                } ?>
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
                                <p class="mb-0 f-18 f-w-500"> Notices </p>
                            </div>
                            <!-- NOTICE HEADING END -->
                            <!-- NOTICE DETAIL START -->
                            <div class="b-shadow-4 cal-info scroll ps" data-menu-vertical="1" data-menu-scroll="1"
                                data-menu-dropdown-timeout="500" id="empDashNotice" style="overflow: hidden;">
                                <?php foreach($notices as $notice):
                                        
                                    ?>
                                <div class="card border-0 b-shadow-4 p-20 rounded-0">
                                    <div class="card-horizontal">
                                        <div class="card-header m-0 p-0 bg-white rounded">
                                            <span class="f-12 p-1 "> <?=date('M', strtotime($notice['created_at']))?></span>
                                            <span class="f-13 f-w-500 rounded-bottom"><?=date('d', strtotime($notice['created_at']))?></span>
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
                                <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Tasks</h5>
                                <div class="d-flex">
                                    <a href="http://localhost/script/public/account/tasks?assignee=me">
                                        <p class="mb-0 f-21 font-weight-bold text-blue d-grid mr-5">
                                            0<span class="f-12 font-weight-normal text-lightest">
                                                Pending </span>
                                        </p>
                                    </a>
                                    <a href="http://localhost/script/public/account/tasks?assignee=me&amp;overdue=yes">
                                        <p class="mb-0 f-21 font-weight-bold text-red d-grid">0<span
                                                class="f-12 font-weight-normal text-lightest">Overdue</span>
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="d-block">
                                <svg class="svg-inline--fa fa-list fa-w-16 text-lightest f-27" aria-hidden="true"
                                    focusable="false" data-prefix="fa" data-icon="list" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M80 368H16a16 16 0 0 0-16 16v64a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16v-64a16 16 0 0 0-16-16zm0-320H16A16 16 0 0 0 0 64v64a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16V64a16 16 0 0 0-16-16zm0 160H16a16 16 0 0 0-16 16v64a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16v-64a16 16 0 0 0-16-16zm416 176H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-320H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 160H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z">
                                    </path>
                                </svg>
                                <!-- <i class="fa fa-list text-lightest f-27"></i> Font Awesome fontawesome.com -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div
                            class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center mt-3 mt-lg-0 mt-md-0">
                            <div class="d-block text-capitalize">
                                <h5 class="f-15 f-w-500 mb-20 text-darkest-grey"> Projects </h5>
                                <div class="d-flex">
                                    <a href="">
                                        <p class="mb-0 f-21 font-weight-bold text-blue d-grid mr-5">
                                            1<span class="f-12 font-weight-normal text-lightest">In Progress</span>
                                        </p>
                                    </a>

                                    <a href="">
                                        <p class="mb-0 f-21 font-weight-bold text-red d-grid">
                                            0<span class="f-12 font-weight-normal text-lightest">Overdue</span>
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="d-block">
                                <svg class="svg-inline--fa fa-layer-group fa-w-16 text-lightest f-27" aria-hidden="true"
                                    focusable="false" data-prefix="fa" data-icon="layer-group" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M12.41 148.02l232.94 105.67c6.8 3.09 14.49 3.09 21.29 0l232.94-105.67c16.55-7.51 16.55-32.52 0-40.03L266.65 2.31a25.607 25.607 0 0 0-21.29 0L12.41 107.98c-16.55 7.51-16.55 32.53 0 40.04zm487.18 88.28l-58.09-26.33-161.64 73.27c-7.56 3.43-15.59 5.17-23.86 5.17s-16.29-1.74-23.86-5.17L70.51 209.97l-58.1 26.33c-16.55 7.5-16.55 32.5 0 40l232.94 105.59c6.8 3.08 14.49 3.08 21.29 0L499.59 276.3c16.55-7.5 16.55-32.5 0-40zm0 127.8l-57.87-26.23-161.86 73.37c-7.56 3.43-15.59 5.17-23.86 5.17s-16.29-1.74-23.86-5.17L70.29 337.87 12.41 364.1c-16.55 7.5-16.55 32.5 0 40l232.94 105.59c6.8 3.08 14.49 3.08 21.29 0L499.59 404.1c16.55-7.5 16.55-32.5 0-40z">
                                    </path>
                                </svg>
                                <!-- <i class="fa fa-layer-group text-lightest f-27"></i> Font Awesome fontawesome.com -->
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
                                    <h4 class="f-18 f-w-500 mb-0">My Task</h4>



                                </div>

                                <div class="card-body p-0 h-200">
                                    <table id="example" class="table">
                                        <thead class="">
                                            <tr>
                                                <th>Task#</th>
                                                <th>Task</th>
                                                <th>Status</th>
                                                <th class="text-right pr-20">Due Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($tasks) {?>
                                            <?php foreach($tasks as $task):?>
                                            <tr>
                                                <td class="pl-20">
                                                    #<?=$task['id']?>
                                                </td>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <h5 class="f-12 mb-1 text-darkest-grey"><a
                                                                    href="<?=ROOT?>/taskdetails/<?=$task['id']?>"
                                                                    class="openRightModal"><?=$task['heading'];?></a>
                                                            </h5>
                                                            <p class="mb-0">
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="pr-20">
                                                    <?php if($task['board_column_slug'] == 'inprogress') {?>
                                                    <span class="badge badge-pill badge-primary">In Progress</span>

                                                    <?php } elseif($task['board_column_slug'] == 'completed') {?>
                                                    <span class="badge badge-pill badge-success">Completed</span>
                                                    <?php } elseif($task['board_column_slug'] == 'incomplete') {?>
                                                    <span class="badge badge-pill badge-warning">incomplete</span>
                                                    <?php } ?>
                                                </td>
                                                <td class="pr-20" align="right">
                                                    <?php if($task['due_date']) {
                                                        $diff = date_diff(date_create('now'), date_create($task['due_date']));
                                                        if($diff->format('%R%a') < 0) {
                                                            echo '<span class="badge badge-pill badge-danger">Overdue</span>';
                                                        } else {
                                                            echo '<span class="badge badge-pill badge-primary">'.$diff->format('%a days left').'</span>';
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
                                                        <svg class="svg-inline--fa fa-task fa-w-16 f-21 w-100"
                                                            aria-hidden="true" focusable="false" data-prefix="fa"
                                                            data-icon="task" role="img"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                            data-fa-i2svg="">
                                                            <g>
                                                                <path fill="currentColor"
                                                                    d="M156.5,447.7l-12.6,29.5c-18.7-9.5-35.9-21.2-51.5-34.9l22.7-22.7C127.6,430.5,141.5,440,156.5,447.7z M40.6,272H8.5 c1.4,21.2,5.4,41.7,11.7,61.1L50,321.2C45.1,305.5,41.8,289,40.6,272z M40.6,240c1.4-18.8,5.2-37,11.1-54.1l-29.5-12.6 C14.7,194.3,10,216.7,8.5,240H40.6z M64.3,156.5c7.8-14.9,17.2-28.8,28.1-41.5L69.7,92.3c-13.7,15.6-25.5,32.8-34.9,51.5 L64.3,156.5z M397,419.6c-13.9,12-29.4,22.3-46.1,30.4l11.9,29.8c20.7-9.9,39.8-22.6,56.9-37.6L397,419.6z M115,92.4 c13.9-12,29.4-22.3,46.1-30.4l-11.9-29.8c-20.7,9.9-39.8,22.6-56.8,37.6L115,92.4z M447.7,355.5c-7.8,14.9-17.2,28.8-28.1,41.5 l22.7,22.7c13.7-15.6,25.5-32.9,34.9-51.5L447.7,355.5z M471.4,272c-1.4,18.8-5.2,37-11.1,54.1l29.5,12.6 c7.5-21.1,12.2-43.5,13.6-66.8H471.4z M321.2,462c-15.7,5-32.2,8.2-49.2,9.4v32.1c21.2-1.4,41.7-5.4,61.1-11.7L321.2,462z M240,471.4c-18.8-1.4-37-5.2-54.1-11.1l-12.6,29.5c21.1,7.5,43.5,12.2,66.8,13.6V471.4z M462,190.8c5,15.7,8.2,32.2,9.4,49.2h32.1 c-1.4-21.2-5.4-41.7-11.7-61.1L462,190.8z M92.4,397c-12-13.9-22.3-29.4-30.4-46.1l-29.8,11.9c9.9,20.7,22.6,39.8,37.6,56.9 L92.4,397z M272,40.6c18.8,1.4,36.9,5.2,54.1,11.1l12.6-29.5C317.7,14.7,295.3,10,272,8.5V40.6z M190.8,50 c15.7-5,32.2-8.2,49.2-9.4V8.5c-21.2,1.4-41.7,5.4-61.1,11.7L190.8,50z M442.3,92.3L419.6,115c12,13.9,22.3,29.4,30.5,46.1 l29.8-11.9C470,128.5,457.3,109.4,442.3,92.3z M397,92.4l22.7-22.7c-15.6-13.7-32.8-25.5-51.5-34.9l-12.6,29.5 C370.4,72.1,384.4,81.5,397,92.4z">
                                                                </path>
                                                                <circle fill="currentColor" cx="256" cy="364" r="28">
                                                                    <animate attributeType="XML"
                                                                        repeatCount="indefinite" dur="2s"
                                                                        attributeName="r" values="28;14;28;28;14;28;">
                                                                    </animate>
                                                                    <animate attributeType="XML"
                                                                        repeatCount="indefinite" dur="2s"
                                                                        attributeName="opacity" values="1;0;1;1;0;1;">
                                                                    </animate>
                                                                </circle>
                                                                <path fill="currentColor" opacity="1"
                                                                    d="M263.7,312h-16c-6.6,0-12-5.4-12-12c0-71,77.4-63.9,77.4-107.8c0-20-17.8-40.2-57.4-40.2c-29.1,0-44.3,9.6-59.2,28.7 c-3.9,5-11.1,6-16.2,2.4l-13.1-9.2c-5.6-3.9-6.9-11.8-2.6-17.2c21.2-27.2,46.4-44.7,91.2-44.7c52.3,0,97.4,29.8,97.4,80.2 c0,67.6-77.4,63.5-77.4,107.8C275.7,306.6,270.3,312,263.7,312z">
                                                                    <animate attributeType="XML"
                                                                        repeatCount="indefinite" dur="2s"
                                                                        attributeName="opacity" values="1;0;0;0;0;1;">
                                                                    </animate>
                                                                </path>
                                                                <path fill="currentColor" opacity="0"
                                                                    d="M232.5,134.5l7,168c0.3,6.4,5.6,11.5,12,11.5h9c6.4,0,11.7-5.1,12-11.5l7-168c0.3-6.8-5.2-12.5-12-12.5h-23 C237.7,122,232.2,127.7,232.5,134.5z">
                                                                    <animate attributeType="XML"
                                                                        repeatCount="indefinite" dur="2s"
                                                                        attributeName="opacity" values="0;0;1;1;0;0;">
                                                                    </animate>
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <!-- <i class="fa fa-task f-21 w-100"></i> Font Awesome fontawesome.com -->

                                                        <div class="f-15 mt-4">
                                                            - No record found. -
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
<?php require_once("layout/footer.php");

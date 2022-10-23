<?php
require_once('layout/header.php');
require_once('layout/navbar.php');
?>




<section class="main-container bg-additional-grey" id="fullscreen">


    <!-- PAGE TITLE END -->
    <!-- CONTENT WRAPPER START -->
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-block d-lg-flex d-md-flex justify-content-between action-bar">
            <div id="table-actions" class="flex-grow-1 align-items-center">
                <a href="<?=ROOT?>/addtask"
                    class="btn-primary rounded f-14 p-2 mr-3 openRightModal float-left">
                    <svg class="svg-inline--fa fa-plus fa-w-14 mr-1" aria-hidden="true" focusable="false"
                        data-prefix="fa" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
                        </path>
                    </svg>
                    <!-- <i class="fa fa-plus mr-1"></i> Font Awesome fontawesome.com -->
                    Add Task
                </a>
                <button type="button" class="btn-secondary rounded f-14 p-2 mr-3 float-left" id="filter-my-task">
                    <svg class="svg-inline--fa fa-user fa-w-14 mr-1" aria-hidden="true" focusable="false"
                        data-prefix="fa" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z">
                        </path>
                    </svg>
                    <!-- <i class="fa fa-user mr-1"></i> Font Awesome fontawesome.com -->
                    My Task
                </button>
                <div class="dt-buttons btn-group">
                    <button class="btn btn-secondary buttons-excel" tabindex="0" aria-controls="allTasks-table"
                        type="button">
                        <span>
                            <svg class="svg-inline--fa fa-file-export fa-w-18" aria-hidden="true" focusable="false"
                                data-prefix="fa" data-icon="file-export" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M384 121.9c0-6.3-2.5-12.4-7-16.9L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128zM571 308l-95.7-96.4c-10.1-10.1-27.4-3-27.4 11.3V288h-64v64h64v65.2c0 14.3 17.3 21.4 27.4 11.3L571 332c6.6-6.6 6.6-17.4 0-24zm-379 28v-32c0-8.8 7.2-16 16-16h176V160H248c-13.2 0-24-10.8-24-24V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V352H208c-8.8 0-16-7.2-16-16z">
                                </path>
                            </svg>
                            <!-- <i class="fa fa-file-export"></i> Font Awesome fontawesome.com --> Export
                        </span>
                    </button>
                </div>
            </div>
            <form action="" class="align-self-center" id="quick-action-form" style="display: none">
                <input type="hidden" name="_token" value="hCEtHiQcxLFMNpNMIjEHGEzqtv0J2YpLtfTtii9W" autocomplete="off"
                    data-np-invisible="1" data-np-checked="1">
                <div class="d-flex align-items-center" id="quick-actions">
                    <div class="select-status mr-3 pl-lg-3">
                        <div class="dropdown bootstrap-select disabled form-control select-picker">
                            <select name="action_type" class="form-control select-picker" id="quick-action-type"
                                disabled="">
                                <option value="">No Action</option>
                                <option value="change-status">Change Status</option>
                                <option value="delete">Delete</option>
                            </select>
                            <button type="button" tabindex="-1"
                                class="btn dropdown-toggle disabled btn-light bs-placeholder" data-toggle="dropdown"
                                role="combobox" aria-owns="bs-select-12" aria-haspopup="listbox" aria-expanded="false"
                                data-id="quick-action-type" aria-disabled="true" title="No Action">
                                <div class="filter-option">
                                    <div class="filter-option-inner">
                                        <div class="filter-option-inner-inner">No Action</div>
                                    </div>
                                </div>
                            </button>
                            <div class="dropdown-menu ">
                                <div class="inner show" role="listbox" id="bs-select-12" tabindex="-1">
                                    <ul class="dropdown-menu inner show" role="presentation"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="select-status mr-3 d-none quick-action-field" id="change-status-action">
                        <div class="dropdown bootstrap-select form-control select-picker">
                            <select name="status" class="form-control select-picker">
                                <option value="1">Incomplete</option>
                                <option value="2">Completed</option>
                            </select>
                            <button type="button" tabindex="-1" class="btn dropdown-toggle btn-light"
                                data-toggle="dropdown" role="combobox" aria-owns="bs-select-13" aria-haspopup="listbox"
                                aria-expanded="false" title="Incomplete">
                                <div class="filter-option">
                                    <div class="filter-option-inner">
                                        <div class="filter-option-inner-inner">Incomplete</div>
                                    </div>
                                </div>
                            </button>
                            <div class="dropdown-menu ">
                                <div class="inner show" role="listbox" id="bs-select-13" tabindex="-1">
                                    <ul class="dropdown-menu inner show" role="presentation"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="select-status">
                        <button type="button" disabled="" class="btn-primary rounded f-14 p-2" id="quick-action-apply">
                            Apply
                        </button>
                        <input type="password" class="autocomplete-password" style="opacity: 0;position: absolute;"
                            autocomplete="off" data-np-invisible="1" data-np-checked="1">
                        <input type="search" class="autocomplete-password" style="opacity: 0;position: absolute;"
                            autocomplete="off" data-np-invisible="1" data-np-checked="1">
                    </div>
                </div>
            </form>
            <div class="btn-group mt-3 mt-lg-0 mt-md-0 ml-lg-3" role="group">
                <a href="http://localhost/script/public/account/tasks" class="btn btn-secondary f-14 btn-active"
                    data-toggle="tooltip" data-original-title="Tasks"><i class="side-icon bi bi-list-ul"></i></a>
                <a href="http://localhost/script/public/account/tasks/taskboards" class="btn btn-secondary f-14"
                    data-toggle="tooltip" data-original-title="Task Board"><i class="side-icon bi bi-kanban"></i></a>
                <a href="http://localhost/script/public/account/tasks/task-calendar" class="btn btn-secondary f-14"
                    data-toggle="tooltip" data-original-title="Calendar"><i class="side-icon bi bi-calendar"></i></a>
                <a href="javascript:;" class="btn btn-secondary f-14 show-pinned" data-toggle="tooltip"
                    data-original-title="Pinned"><i class="side-icon bi bi-pin-angle"></i></a>
            </div>
        </div>
        <div class="d-flex flex-column w-tables rounded mt-3 bg-white">

            <div id="allTasks-table_wrapper" class="">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover border-0 w-100 dataTable no-footer" id="tasks-table" role="grid"
                            aria-describedby="allTasks-table_info" style="width: 1589px;">
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
                                <?php foreach($tasks as $getEmployeeTask): ?>
                                <tr
                                    data-id='<?=$getEmployeeTask['task_id']?>'>

                                    <td
                                        data-search="<?=$getEmployeeTask['task_id']?>">
                                        <?=$getEmployeeTask['task_id']?>
                                    </td>

                                    <td
                                        data-search="<?=$getEmployeeTask['heading']?>">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <h5 class="mb-0 f-13 text-darkest-grey"><a
                                                        href="<?=ROOT?>/taskdetails/<?=$getEmployeeTask['task_id']?>"
                                                        class="openRightModal"><?=$getEmployeeTask['heading']?></a>
                                                </h5>
                                                <p class="mb-0"> </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        data-search="<?=$getEmployeeTask['project_name']?>">
                                        <a href="http://localhost/script/public/account/projects/1"
                                            class="text-darkest-grey"><?=$getEmployeeTask['project_name']?></a>
                                    </td>
                                    <td data-search="<?=strtotime($getEmployeeTask['due_date']);?>"
                                        data-order="<?=strtotime($getEmployeeTask['due_date']);?>">
                                        <?php
                                                $due_data = $getEmployeeTask['due_date'];
                                    if($due_data > date('Y-m-d')) {
                                        echo $due_data;
                                    } else {
                                        echo ' <span class="badge badge-danger">Expired</span>';
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
                                        data-order="<?=$getEmployeeTask['board_column_id']?>">
                                        <select class="selectpicker" id="status_task">
                                            <?php foreach($taskLabels as $taskLabel): ?>

                                            <option
                                                data-content="<i class='bi bi-circle-fill  mr-2'  style='color:<?=$taskLabel['label_color']?>'></i>  <?=$taskLabel['column_name']?>"
                                                value=" <?=$taskLabel['id']?>"
                                                <?php if($taskLabel['id'] == $getEmployeeTask['board_column_id']) {
                                                    echo 'selected';
                                                } ?>>
                                                <?=$taskLabel['column_name']?>
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
                                                    <a href="<?=ROOT?>/taskdetails/<?=$getEmployeeTask['task_id']?>"
                                                        class="dropdown-item openRightModal"><svg
                                                            class="svg-inline--fa fa-eye fa-w-18 mr-2"
                                                            aria-hidden="true" focusable="false" data-prefix="fa"
                                                            data-icon="eye" role="img"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                            data-fa-i2svg="">
                                                            <path fill="currentColor"
                                                                d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                                            </path>
                                                        </svg>
                                                        <!-- <i class="fa fa-eye mr-2"></i> Font Awesome fontawesome.com -->View</a><a
                                                        class="dropdown-item openRightModal"
                                                        href="<?=ROOT;?>/edittask/<?=$getEmployeeTask['task_id']?>">
                                                        <svg class="svg-inline--fa fa-edit fa-w-18 mr-2"
                                                            aria-hidden="true" focusable="false" data-prefix="fa"
                                                            data-icon="edit" role="img"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                            data-fa-i2svg="">
                                                            <path fill="currentColor"
                                                                d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z">
                                                            </path>
                                                        </svg>
                                                        <!-- <i class="fa fa-edit mr-2"></i> Font Awesome fontawesome.com -->
                                                        Edit
                                                    </a><a class="dropdown-item delete-table-row" href="javascript:;"
                                                        data-task-id="<?=$getEmployeeTask['task_id']?>">
                                                        <svg class="svg-inline--fa fa-trash fa-w-14 mr-2"
                                                            aria-hidden="true" focusable="false" data-prefix="fa"
                                                            data-icon="trash" role="img"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                            data-fa-i2svg="">
                                                            <path fill="currentColor"
                                                                d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z">
                                                            </path>
                                                        </svg>
                                                        <!-- <i class="fa fa-trash mr-2"></i> Font Awesome fontawesome.com -->
                                                        Delete
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
    </div>
    <!-- CONTENT WRAPPER END -->
</section>

<?php

require_once('layout/footer.php');

?>

<script>
    $(document).ready(function() {
        $('#tasks-table').DataTable({
            "order": [
                [0, "desc"]
            ],
            "columnDefs": [{
                "orderable": false,
                "targets": [5]
            }]
        });

        $('#status_task').on('change', function() {
            var status = $(this).val();
            var id = $(this).closest('tr').data('id');
            $.ajax({
                url: '<?=ROOT;?>/taskdetails/' + id +
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
                        url: '<?=ROOT;?>/taskdetails/' +
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

    });
</script>
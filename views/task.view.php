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
                    <i class="bi bi-plus"></i> Add Task
                    Add Task
                </a>
                <button type="button" class="btn-secondary rounded f-14 p-2 mr-3 float-left" id="filter-my-task">
                    <i class="bi bi-person-fill"></i></i>
                    My Task
                </button>

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
                                                        class="dropdown-item openRightModal">
                                                        <i class="bi bi-eye-fill mr-2"></i>
                                                        View</a><a class="dropdown-item openRightModal"
                                                        href="<?=ROOT;?>/edittask/<?=$getEmployeeTask['task_id']?>">
                                                        <i class="bi bi-pencil-fill mr-2"></i>
                                                        Edit
                                                    </a><a class="dropdown-item delete-table-row" href="javascript:;"
                                                        data-task-id="<?=$getEmployeeTask['task_id']?>">
                                                        <i class="bi bi-trash-fill mr-2"></i>
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
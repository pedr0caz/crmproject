<?php require_once("layout/header.php"); ?>
<?php require_once("layout/navbar.php"); ?>
<section class="main-container bg-additional-grey" id="fullscreen">
    <!-- PAGE TITLE END -->
    <!-- CONTENT WRAPPER START -->
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-flex justify-content-between action-bar">
            <div id="table-actions" class="d-block d-lg-flex align-items-center">
                <a href="http://localhost/script/public/account/employees/create"
                    class="btn-primary rounded f-14 p-2 mr-3 openRightModal">
                    <svg class="svg-inline--fa fa-plus fa-w-14 mr-1" aria-hidden="true" focusable="false"
                        data-prefix="fa" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
                        </path>
                    </svg>
                    <!-- <i class="fa fa-plus mr-1"></i> Font Awesome fontawesome.com -->
                    Add Employee
                </a>
                <button type="button" class="btn-secondary rounded f-14 p-2 mr-3 invite-member mb-2 mb-lg-0">
                    <svg class="svg-inline--fa fa-plus fa-w-14 mr-1" aria-hidden="true" focusable="false"
                        data-prefix="fa" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
                        </path>
                    </svg>
                    <!-- <i class="fa fa-plus mr-1"></i> Font Awesome fontawesome.com -->
                    Invite Employee
                </button>
                <button type="button" class="btn-secondary rounded f-14 p-2 mr-3 mb-2 mb-lg-0" id="designation-setting">
                    <svg class="svg-inline--fa fa-plus fa-w-14 mr-1" aria-hidden="true" focusable="false"
                        data-prefix="fa" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
                        </path>
                    </svg>
                    <!-- <i class="fa fa-plus mr-1"></i> Font Awesome fontawesome.com -->
                    Add Designation
                </button>
                <button type="button" class="btn-secondary rounded f-14 p-2 mr-3 department-setting mb-2 mb-lg-0">
                    <svg class="svg-inline--fa fa-plus fa-w-14 mr-1" aria-hidden="true" focusable="false"
                        data-prefix="fa" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
                        </path>
                    </svg>
                    <!-- <i class="fa fa-plus mr-1"></i> Font Awesome fontawesome.com -->
                    Add Department
                </button>
                <a href="http://localhost/script/public/account/employees/import"
                    class="btn-secondary rounded f-14 p-2 mr-3 openRightModal mb-2 mb-lg-0">
                    <svg class="svg-inline--fa fa-file-upload fa-w-12 mr-1" aria-hidden="true" focusable="false"
                        data-prefix="fa" data-icon="file-upload" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm65.18 216.01H224v80c0 8.84-7.16 16-16 16h-32c-8.84 0-16-7.16-16-16v-80H94.82c-14.28 0-21.41-17.29-11.27-27.36l96.42-95.7c6.65-6.61 17.39-6.61 24.04 0l96.42 95.7c10.15 10.07 3.03 27.36-11.25 27.36zM377 105L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128v-6.1c0-6.3-2.5-12.4-7-16.9z">
                        </path>
                    </svg>
                    <!-- <i class="fa fa-file-upload mr-1"></i> Font Awesome fontawesome.com -->
                    Import
                </a>
            </div>
        </div>
        <!-- Add Task Export Buttons End -->
        <!-- Task Box Start -->
        <div class="d-flex flex-column w-tables rounded mt-3 bg-white">

            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-hover border-0 w-100 " id="example">
                        <thead>
                            <tr>
                                <th title="Id">Id</th>
                                <th title="Employee ID">Employee ID</th>
                                <th title="Name">Name</th>
                                <th title="Email">Email</th>
                                <th width="20%" title="User Role">User Role</th>
                                <th title="Status">Status</th>
                                <th title="Action">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employees as $employee):?>
                            <tr>
                                <td><?=$employee['user_id'];?>
                                </td>
                                <td><?=$employee['employee_id'];?>
                                </td>
                                <td>
                                    <div class="media align-items-center mw-250">
                                        <a href="<?=ROOT;?>/employeedetails/<?=$employee['user_id'];?>"
                                            class="position-relative ">
                                            <img src="<?=$employee['image'] ? ROOT."/".$employee['image'] : 'https://www.gravatar.com/avatar/a456ed61bc3c5d05f3ad79d85069098a.png?s=200&d=mp'?>"
                                                class="mr-2 taskEmployeeImg rounded-circle" alt="Dassad" title="Dassad">
                                        </a>
                                        <div class="media-body">
                                            <h5 class="mb-0 f-12">
                                                <a href="<?=ROOT;?>/employeedetails/<?=$employee['user_id'];?>"
                                                    class="text-darkest-grey "><?=$employee['name']?></a>
                                            </h5>
                                            <p class="mb-0 f-12 text-dark-grey">
                                                <?=$employee['designation_name']?>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td><?=$employee['email'];?>
                                </td>
                                <td>
                                    <select class="form-control">
                                        <?php foreach ($roles as $role):?>
                                        <option
                                            value="<?=$role['id'];?>"
                                            <?php if($role['id'] == $employee['role_id']) {
                                                echo 'selected';
                                            }?>>
                                            <?=ucfirst($role['name']);?>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                                <td>
                                    <?php if($employee['status'] == "active") {
                                        echo '<span class="badge badge-success">Active</span>';
                                    } else {
                                        echo '<span class="badge badge-danger">Inactive</span>';
                                    }?>
                                </td>
                                <td>
                                    <div class="task_view">

                                        <div class="dropdown">
                                            <a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle"
                                                type="link" id="dropdownMenuLink-6" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="icon-options-vertical icons"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuLink-6" tabindex="0"><a
                                                    href="http://localhost/script/public/account/employees/6"
                                                    class="dropdown-item"><svg
                                                        class="svg-inline--fa fa-eye fa-w-18 mr-2" aria-hidden="true"
                                                        focusable="false" data-prefix="fa" data-icon="eye" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                        data-fa-i2svg="">
                                                        <path fill="currentColor"
                                                            d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                                        </path>
                                                    </svg>
                                                    <!-- <i class="fa fa-eye mr-2"></i> Font Awesome fontawesome.com -->View</a><a
                                                    class="dropdown-item openRightModal"
                                                    href="http://localhost/script/public/account/employees/6/edit">
                                                    <svg class="svg-inline--fa fa-edit fa-w-18 mr-2" aria-hidden="true"
                                                        focusable="false" data-prefix="fa" data-icon="edit" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                        data-fa-i2svg="">
                                                        <path fill="currentColor"
                                                            d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z">
                                                        </path>
                                                    </svg>
                                                    <!-- <i class="fa fa-edit mr-2"></i> Font Awesome fontawesome.com -->
                                                    Edit
                                                </a><a class="dropdown-item delete-table-row" href="javascript:;"
                                                    data-user-id="6">
                                                    <svg class="svg-inline--fa fa-trash fa-w-14 mr-2" aria-hidden="true"
                                                        focusable="false" data-prefix="fa" data-icon="trash" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                        data-fa-i2svg="">
                                                        <path fill="currentColor"
                                                            d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z">
                                                        </path>
                                                    </svg>
                                                    <!-- <i class="fa fa-trash mr-2"></i> Font Awesome fontawesome.com -->
                                                    Delete
                                                </a></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- Task Box End -->
    </div>
    <!-- CONTENT WRAPPER END -->
</section>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            initComplete: function() {
                this.api()
                    .columns()
                    .every(function() {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                column.search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function(d, j) {
                                select.append('<option value="' + d + '">' + d +
                                    '</option>');
                            });
                    });
            },
        });
    });
</script>
<?php require_once("layout/footer.php");

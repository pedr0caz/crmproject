<?php require_once("views/layout/header.php"); ?>
<?php require_once("views/layout/navbar.php"); ?>
<section class="main-container bg-additional-grey" id="fullscreen">
    <!-- PAGE TITLE END -->
    <!-- CONTENT WRAPPER START -->
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-flex justify-content-between action-bar">
            <div id="table-actions" class="d-block d-lg-flex align-items-center">
                <a href="<?=ROOT;?>/employee/create"
                    class="btn-primary rounded f-14 p-2 mr-3 openRightModal">
                    <i class="bi bi-plus-circle mr-1"></i>
                    <?=G_ADD;?>
                    <?=G_EMPLOYEE;?>

                </a>

                <button type="button" class="btn-secondary rounded f-14 p-2 mr-3 mb-2 mb-lg-0" id="designation-setting"
                    data-toggle="modal" data-target="#myModal">
                    <i class="bi bi-plus-circle mr-1"></i>
                    <?=G_ADD;?>
                    <?=G_DESIGNATION;?>
                </button>
                <button type="button" class="btn-secondary rounded f-14 p-2 mr-3 department-setting mb-2 mb-lg-0"
                    data-toggle="modal" data-target="#myModal2">
                    <i class="bi bi-plus-circle mr-1"></i>
                    <?=G_ADD;?>
                    <?=G_DEPARTMENT;?>
                </button>

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
                                <th title="Employee ID">
                                    <?=G_EMPLOYEE;?> ID
                                </th>
                                <th title="Name"><?=G_NAME;?></th>
                                <th title="Email"><?=G_EMAIL;?></th>
                                <th width="20%" title="User Role">
                                    <?=G_USER_ROLE;?>
                                </th>
                                <th title="Status"><?=G_STATUS;?>
                                </th>
                                <th title="Action"><?=G_ACTION;?>
                                </th>
                                <th class="d-none">Teams</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employees as $employee):?>
                            <tr
                                data-id="<?=$employee['user_id'];?>">
                                <td><?=$employee['user_id'];?>
                                </td>
                                <td><?=$employee['employee_id'];?>
                                </td>
                                <td>
                                    <div class="media align-items-center mw-250">
                                        <a href="<?=ROOT;?>/employee/<?=$employee['user_id'];?>"
                                            class="position-relative ">
                                            <img src="<?=$employee['image'] ? ROOT."/".$employee['image'] : 'https://www.gravatar.com/avatar/a456ed61bc3c5d05f3ad79d85069098a.png?s=200&d=mp'?>"
                                                class="mr-2 taskEmployeeImg rounded-circle"
                                                alt="<?=$employee['name']?>"
                                                title="<?=$employee['name']?>">
                                        </a>
                                        <div class="media-body">
                                            <h5 class="mb-0 f-12">
                                                <a href="<?=ROOT;?>/employee/<?=$employee['user_id'];?>"
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
                                    <select class="form-control selectpicker" id="role_user">
                                        <?php foreach ($roles as $role):
                                            $displayName = json_decode($role['display_name'], true);
                                            
                                            if($role['id'] == 3) {
                                                continue;
                                            }
                                            ?>
                                        <option
                                            value="<?=$role['id'];?>"
                                            <?php if($role['id'] == $employee['role_id']) {
                                                echo 'selected';
                                            }?>>
                                            <?=$displayName[LANG_ISO];?>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                                <td>
                                    <?php if($employee['status'] == "active") {
                                        echo '<span class="badge badge-success">'.G_ACTIVE.'</span>';
                                    } else {
                                        echo '<span class="badge badge-danger">'.G_INACTIVE.'</span>';
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
                                                    href="<?=ROOT?>/employee/<?=$employee['user_id'];?>"
                                                    class="dropdown-item">
                                                    <i class="bi bi-eye-fill mr-2"></i>
                                                    <?=G_VIEW;?></a>
                                                <a class="dropdown-item openRightModal"
                                                    href="<?=ROOT?>/employee/<?=$employee['user_id'];?>?edit">
                                                    <i class="bi bi-pencil-fill mr-2"></i>
                                                    <?=G_EDIT;?>
                                                </a><a class="dropdown-item delete-table-row" href="javascript:;"
                                                    data-user-id="6">
                                                    <i class="bi bi-trash-fill mr-2"></i>
                                                    <?=G_DELETE;?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="d-none">
                                    <?= $employee['team_name']?>

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
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/<?=LANG;?>.json'
            }
        });
        $('body').on('change', '#role_user', function() {
            var role_id = $(this).val();
            var user_id = $(this).closest('tr').data('id');
            console.log(role_id, user_id);
            $.ajax({
                url: '<?=ROOT?>/employee/' + user_id +
                    '?role',
                type: 'POST',
                data: {
                    role_id: role_id,
                    user_id: user_id
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Role Updated',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '<?=G_SOMETHING_WENT_WRONG;?>',
                            footer: '<a href>Why do I have this issue?</a>'
                        })
                    }
                }
            });
        });
        $('body').on('click', '.delete-table-row', function() {
            var user_id = $(this).closest('tr').data('id');
            Swal.fire({
                title: '<?=SWAL_TITLE_DELETE;?>',
                text: "<?=SWAL_YOU_WONT_BE_ABLE_REVERT;?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?=SWAL_CONFIRM_DELETE;?>'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?=ROOT?>/employee/' +
                            user_id + '?delete',
                        type: 'POST',
                        data: {
                            user_id: user_id
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                location.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: '<?=G_SOMETHING_WENT_WRONG;?>',
                                    footer: '<a href>Why do I have this issue?</a>'
                                })
                            }
                        }
                    });
                }
            })
        });
    });
</script>
<?php require_once("views/layout/footer.php");

?>

<div class="modal" id="myModal">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading">
                    <?=G_DESIGNATION;?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <table id="example" class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th class="w-75"><?=G_DESIGNATION;?></th>
                            <th class="text-right"><?=G_ACTION;?>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="designation_model">
                        <?php foreach($designations as $designation): ?>
                        <tr
                            id="row-<?=$designation['id'];?>">
                            <td><?=$designation['id'];?>
                            </td>
                            <td data-row-id="<?=$designation['id'];?>"
                                contenteditable="true">
                                <?=$designation['name'];?>
                            </td>
                            <td class="text-right">
                                <button type="button" class="btn-secondary rounded f-14 p-2 delete-row"
                                    data-row-id="<?=$designation['id'];?>">
                                    <i class="bi bi-trash2-fill"></i>
                                    <?=G_DELETE;?>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <form method="POST" id="createDesignation" autocomplete="off" data-np-autofill-type="other"
                    data-np-watching="1">


                    <div class="row border-top-grey ">
                        <div class="col-sm-12">
                            <div class="form-group my-3">
                                <label class="f-14 text-dark-grey mb-12" data-label="true"
                                    for="designation_name"><?=G_NAME;?>
                                    <sup class="f-14 mr-1">*</sup>

                                </label>

                                <input type="text" class="form-control height-35 f-14" placeholder="e.g. Team Lead"
                                    value="" name="designation_name" id="designation_name">

                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn-cancel rounded f-14 p-2 border-0 mr-3" data-dismiss="modal">
                    <?=G_CLOSE;?>
                </a>
                <button type="button" class="btn-primary rounded f-14 p-2" id="save-designation">
                    <i class="bi bi-save2-fill m-1"></i>
                    <?=G_SAVE;?>
                </button>


            </div>

            <script>
                $('body').on('click', '.delete-row', function(event) {
                    event.preventDefault();

                    var catId = $(this).data('row-id');
                    Swal.fire({
                        title: "<?=SWAL_TITLE_DELETE;?>",
                        text: "You will not be able to recover the deleted record!",
                        icon: 'warning',
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText: "<?=SWAL_CONFIRM_DELETE;?>",
                        cancelButtonText: "<?=G_CANCEL;?> ",
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
                                url: '<?=ROOT;?>/employee/create?emplooyeDesignation=delete',
                                data: {
                                    'catId': catId

                                },
                                success: function(response) {
                                    console.log(response);
                                    if (response.status == 'success') {

                                        $('tr[id="row-' + catId + '"]').remove();


                                    } else {
                                        Swal.fire({
                                            title: "<?=G_ERROR;?>",
                                            text: '<?=G_SOMETHING_WENT_WRONG;?>',
                                            icon: 'error',
                                            showCancelButton: false,
                                            focusConfirm: false,
                                            confirmButtonText: "Ok",
                                            customClass: {
                                                confirmButton: 'btn btn-primary mr-3',
                                                cancelButton: 'btn btn-secondary'
                                            },
                                            showClass: {
                                                popup: 'swal2-noanimation',
                                                backdrop: 'swal2-noanimation'
                                            },
                                            buttonsStyling: false
                                        });
                                    }
                                }
                            });
                        }
                    });

                });


                $('body').on('click', '#save-designation', function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: '<?=ROOT;?>/employee/create?emplooyeDesignation=add',
                        container: '#createDesignation',
                        type: "POST",
                        disableButton: true,
                        blockUI: true,
                        buttonSelector: "#save-designation",
                        data: $('#createDesignation').serialize(),
                        success: function(response) {
                            console.log(response);
                            if (response.status == 'success') {
                                $('#designation_name').val('');

                                $('#designation_model').append(
                                    ` <tr id="row-` + response.catId + `">
                                <td> ` + response.catId + `
                                </td>
                                <td data-row-id="` + response.catId + `"
                                    contenteditable="true">` + response.catName + `
                                </td>
                                <td class="text-right">
                                    <button type="button" class="btn-secondary rounded f-14 p-2 delete-row"
                                    data-row-id="` + response.catId + `">
                                    <i class="bi bi-trash2-fill mr-1"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                                        `
                                )

                            } else {
                                Swal.fire({
                                    title: "<?=G_ERROR;?>",
                                    text: '<?=G_SOMETHING_WENT_WRONG;?>',
                                    icon: 'error',
                                    showCancelButton: false,
                                    focusConfirm: false,
                                    confirmButtonText: "Ok",
                                    customClass: {
                                        confirmButton: 'btn btn-primary mr-3',
                                        cancelButton: 'btn btn-secondary'
                                    },
                                    showClass: {
                                        popup: 'swal2-noanimation',
                                        backdrop: 'swal2-noanimation'
                                    },
                                    buttonsStyling: false
                                });
                            }
                        }
                    })
                });


                $('body').on('focus', '#myModal [contenteditable=true]', function() {

                    $(this).data("initialText", $(this).html());
                    let rowId = $(this).data('row-id');

                });

                $('body').on('blur', '#myModal [contenteditable=true]', function() {
                    let id = $(this).data('row-id');
                    let initialText = $(this).data('initialText');
                    let value = $(this).html();
                    if (initialText != value) {
                        $.ajax({
                            url: '<?=ROOT;?>/employee/create?emplooyeDesignation=edit',
                            container: '#row-' + id,
                            type: "POST",
                            data: {
                                'designation_name': value,
                                'id': id
                            },
                            blockUI: true,
                            success: function(response) {

                                if (response.status == 'success') {



                                } else {
                                    Swal.fire({
                                        title: "<?=G_ERROR;?>",
                                        text: '<?=G_SOMETHING_WENT_WRONG;?>',
                                        icon: 'error',
                                        showCancelButton: false,
                                        focusConfirm: false,
                                        confirmButtonText: "Ok",
                                        customClass: {
                                            confirmButton: 'btn btn-primary mr-3',
                                            cancelButton: 'btn btn-secondary'
                                        },
                                        showClass: {
                                            popup: 'swal2-noanimation',
                                            backdrop: 'swal2-noanimation'
                                        },
                                        buttonsStyling: false
                                    });
                                }
                            }
                        })
                    }
                });
            </script>
        </div>
    </div>
</div>

<div class="modal" id="myModal2">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading">
                    <?=G_DEPARTMENT;?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <table id="example" class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th class="w-75"><?=G_DEPARTMENT;?></th>
                            <th class="text-right"><?=G_ACTION;?>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="department_model">
                        <?php foreach($departments as $department): ?>
                        <tr
                            id="row-<?=$department['id'];?>">
                            <td><?=$department['id'];?>
                            </td>
                            <td data-row-id="<?=$department['id'];?>"
                                contenteditable="true">
                                <?=$department['name'];?>
                            </td>
                            <td class="text-right">
                                <button type="button" class="btn-secondary rounded f-14 p-2 delete-row"
                                    data-row-id="<?=$department['id'];?>">
                                    <i class="bi bi-trash2-fill mr-1"></i>
                                    <?=G_DELETE;?>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <form method="POST" id="createDepartment" autocomplete="off" data-np-autofill-type="other"
                    data-np-watching="1">


                    <div class="row border-top-grey ">
                        <div class="col-sm-12">
                            <div class="form-group my-3">
                                <label class="f-14 text-dark-grey mb-12" data-label="true"
                                    for="department_name"><?=G_NAME;?>
                                    <sup class="f-14 mr-1">*</sup>

                                </label>

                                <input type="text" class="form-control height-35 f-14" placeholder="e.g. Team Lead"
                                    value="" name="department_name" id="department_name">

                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn-cancel rounded f-14 p-2 border-0 mr-3" data-dismiss="modal">
                    <?=G_CLOSE;?>
                </a>
                <button type="button" class="btn-primary rounded f-14 p-2" id="save-department">
                    <i class="bi bi-save mr-1"></i>
                    <?=G_SAVE;?>
                </button>


            </div>

            <script>
                $('body').on('click', '#myModal2 .delete-row', function(event) {
                    event.preventDefault();

                    var catId = $(this).data('row-id');
                    Swal.fire({
                        title: "<?=SWAL_TITLE_DELETE;?>",
                        text: "You will not be able to recover the deleted record!",
                        icon: 'warning',
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText: "<?=SWAL_CONFIRM_DELETE;?>" ,
                        cancelButtonText: "<?=G_CANCEL;?>" ,
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
                                url: '<?=ROOT;?>/employee/create?emplooyeDepartment=delete',
                                data: {
                                    'catId': catId

                                },
                                success: function(response) {
                                    console.log(response);
                                    if (response.status == 'success') {

                                        $('tr[id="row-' + catId + '"]').remove();


                                    } else {
                                        Swal.fire({
                                            title: "<?=G_ERROR;?>",
                                            text: '<?=G_SOMETHING_WENT_WRONG;?>',
                                            icon: 'error',
                                            showCancelButton: false,
                                            focusConfirm: false,
                                            confirmButtonText: "Ok",
                                            customClass: {
                                                confirmButton: 'btn btn-primary mr-3',
                                                cancelButton: 'btn btn-secondary'
                                            },
                                            showClass: {
                                                popup: 'swal2-noanimation',
                                                backdrop: 'swal2-noanimation'
                                            },
                                            buttonsStyling: false
                                        });
                                    }
                                }
                            });
                        }
                    });

                });


                $('body').on('click', '#save-department', function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: '<?=ROOT;?>/employee/create?emplooyeDepartment=add',
                        container: '#createDepartment',
                        type: "POST",
                        disableButton: true,
                        blockUI: true,
                        buttonSelector: "#save-department",
                        data: $('#createDepartment').serialize(),
                        success: function(response) {
                            console.log(response);
                            if (response.status == 'success') {
                                $('#department_name').val('');

                                $('#department_model').append(
                                    ` <tr id="row-` + response.catId + `">
                                <td> ` + response.catId + `
                                </td>
                                <td data-row-id="` + response.catId + `"
                                    contenteditable="true">` + response.catName + `
                                </td>
                                <td class="text-right">
                                    <button type="button" class="btn-secondary rounded f-14 p-2 delete-row"
                                    data-row-id="` + response.catId + `">
                                    <i class="bi bi-trash2-fill mr-1"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                                        `
                                )

                            } else {
                                Swal.fire({
                                    title: "<?=G_ERROR;?>",
                                    text: '<?=G_SOMETHING_WENT_WRONG;?>',
                                    icon: 'error',
                                    showCancelButton: false,
                                    focusConfirm: false,
                                    confirmButtonText: "Ok",
                                    customClass: {
                                        confirmButton: 'btn btn-primary mr-3',
                                        cancelButton: 'btn btn-secondary'
                                    },
                                    showClass: {
                                        popup: 'swal2-noanimation',
                                        backdrop: 'swal2-noanimation'
                                    },
                                    buttonsStyling: false
                                });
                            }
                        }
                    })
                });


                $('body').on('focus', '#myModal2 [contenteditable=true]', function() {

                    $(this).data("initialText", $(this).html());
                    let rowId = $(this).data('row-id');

                });

                $('body').on('blur', '#myModal2 [contenteditable=true]', function() {
                    let id = $(this).data('row-id');
                    let initialText = $(this).data('initialText');
                    let value = $(this).html();
                    if (initialText != value) {
                        $.ajax({
                            url: '<?=ROOT;?>/employee/create?emplooyeDepartment=edit',
                            container: '#row-' + id,
                            type: "POST",
                            data: {
                                'department_name': value,
                                'id': id
                            },
                            blockUI: true,
                            success: function(response) {

                                if (response.status == 'success') {



                                } else {
                                    Swal.fire({
                                        title: "<?=G_ERROR;?>",
                                        text: '<?=G_SOMETHING_WENT_WRONG;?>',
                                        icon: 'error',
                                        showCancelButton: false,
                                        focusConfirm: false,
                                        confirmButtonText: "Ok",
                                        customClass: {
                                            confirmButton: 'btn btn-primary mr-3',
                                            cancelButton: 'btn btn-secondary'
                                        },
                                        showClass: {
                                            popup: 'swal2-noanimation',
                                            backdrop: 'swal2-noanimation'
                                        },
                                        buttonsStyling: false
                                    });
                                }
                            }
                        })
                    }
                });
            </script>
        </div>
    </div>
</div>
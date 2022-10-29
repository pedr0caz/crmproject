<?php require_once("layout/header.php"); ?>
<?php require_once("layout/navbar.php"); ?>
<section class="main-container bg-additional-grey" id="fullscreen">

    <!-- PAGE TITLE END -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <form method="POST" action="<?=ROOT;?>/addemployee"
                    enctype="multipart/form-data" id="save-employee-data-form">

                    <div class="add-client bg-white rounded">
                        <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                            Account Details
                        </h4>
                        <div class="row p-20">
                            <div class="col-lg-9 col-xl-10">
                                <div class="row">

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group my-3">
                                            <label class="f-14 text-dark-grey mb-12" data-label="true"
                                                for="name">Employee Name
                                                <sup class="f-14 mr-1">*</sup>
                                            </label>
                                            <input type="text" class="form-control height-35 f-14"
                                                placeholder="e.g. John Doe" value="" name="name" id="name"
                                                autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group my-3">
                                            <label class="f-14 text-dark-grey mb-12" data-label="true"
                                                for="email">Employee Email
                                                <sup class="f-14 mr-1">*</sup>
                                            </label>
                                            <input type="text" class="form-control height-35 f-14"
                                                placeholder="e.g. johndoe@example.com" value="" name="email" id="email"
                                                autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <label class="f-14 text-dark-grey mb-12 mt-3" data-label="true"
                                            for="password">Password
                                            <sup class="f-14 mr-1">*</sup>
                                        </label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="password"
                                                class="form-control height-35 f-14" autocomplete="off" required>

                                            <div class="input-group-append">
                                                <button id="random_password" type="button" data-toggle="tooltip"
                                                    data-original-title="Generate Random Password"
                                                    class="btn btn-outline-secondary border-grey height-35">
                                                    <i class="bi bi-shuffle"></i>
                                                </button>
                                            </div>
                                            <div class="input-group-append">
                                                <button type="button" data-toggle="tooltip"
                                                    data-original-title="Show/Hide Value"
                                                    class="btn btn-outline-secondary border-grey height-35 toggle-password">
                                                    <i class="bi bi-eye-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">Must have at least 8 characters</small>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <label class="f-14 text-dark-grey mb-12 my-3" data-label="true"
                                            for="category_id">Designation
                                            <sup class="f-14 mr-1">*</sup>
                                        </label>
                                        <div class="input-group">

                                            <select name="designation_id" class="form-control selectpicker"
                                                id="employee_designation" data-live-search="true" data-size="4"
                                                title="Choose Designation">

                                                <?php foreach($designations as $designation): ?>
                                                <option
                                                    value="<?=$designation['id']?>">
                                                    <?=$designation['name']?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>


                                            <div class="input-group-append">
                                                <button id="designation-setting-add" type="button"
                                                    class="btn btn-outline-secondary border-grey" data-toggle="modal"
                                                    data-target="#myModal">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <label class="f-14 text-dark-grey mb-12 my-3" data-label="true"
                                            for="department_id">Department
                                            <sup class="f-14 mr-1">*</sup>
                                        </label>
                                        <div class="input-group">

                                            <select name="department_id[]" class="form-control selectpicker show-tick"
                                                id="employee_department" data-live-search="true" data-size="4"
                                                title="Choose Department" multiple>

                                                <?php foreach($departments as $department): ?>
                                                <option
                                                    data-content="<span class='badge badge-pill badge-light border p-2'><?=$department['name']?></span>"
                                                    value="<?=$department['id']?>">
                                                    <?=$department['name']?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>


                                            <div class="input-group-append">
                                                <button id="department-setting-add" type="button"
                                                    class="btn btn-outline-secondary border-grey" data-toggle="modal"
                                                    data-target="#myModal2">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">

                                <label class=" f-14 text-dark-grey mb-12 mt-3" data-label="">Profile
                                    Picture
                                </label>

                                <div class="form-group">
                                    <input class="form-control height-35" type="file" name="uploadfile" value="" />
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <label class="f-14 text-dark-grey mb-12 mt-3" data-label="" for="country">Country
                                    <sup class="f-14 mr-1">*</sup>
                                </label>
                                <div class="form-group mb-0">
                                    <select name="country_id" class="form-control selectpicker height-35 f-14"
                                        data-live-search="true" data-size="5" required>
                                        <option value="">--</option>
                                        <?php foreach($countries as $country): ?>

                                        <option
                                            value="<?php echo $country['id']; ?>">
                                            <?php echo $country['nicename']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label="" for="mobile">Mobile
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>
                                    <input type="tel" class="form-control height-35 f-14" placeholder="e.g. 987654321"
                                        value="" name="mobile" id="mobile" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label class="f-14 text-dark-grey mb-12 mt-3" data-label="" for="gender">Gender
                                    <sup class="f-14 mr-1">*</sup>
                                </label>
                                <div class="input-group">

                                    <select name="gender" class="form-control  selectpicker  height-35 f-14" id="gender"
                                        required>

                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>



                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group my-3" style="position: relative;">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true"
                                        for="joining_date">Joining
                                        Date
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>
                                    <input type="date" class="form-control  date-picker height-35 f-14"
                                        placeholder="Select Date" name="joining_date" id="joining_date"
                                        autocomplete="off" required>

                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group my-3" style="position: relative;">
                                    <label class="f-14 text-dark-grey mb-12" data-label="" for="date_of_birth">Date of
                                        Birth
                                    </label>
                                    <input type="date" class="form-control  date-picker height-35 f-14"
                                        placeholder="Select Date" value="" name="date_of_birth" id="date_of_birth"
                                        autocomplete="off">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group my-3">
                                <div class="form-group my-3 mr-0 mr-lg-2 mr-md-2">
                                    <label class="f-14 text-dark-grey mb-12" data-label="" for="address">Address
                                    </label>
                                    <textarea class="form-control f-14 pt-2" rows="3"
                                        placeholder="e.g. 132, My Street, Kingston, New York 12401" name="address"
                                        id="address"></textarea>
                                </div>
                            </div>
                        </div>

                        <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-top-grey">
                            Other Details
                        </h4>
                        <div class="row p-20">
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12 w-100" for="usr">Can user login to
                                        app?</label>
                                    <div class="d-flex">
                                        <div class="form-check-inline custom-control custom-radio mt-2 mr-3">
                                            <input type="radio" value="enable" class="custom-control-input"
                                                id="login-yes" name="login" checked="" autocomplete="off">
                                            <label class="custom-control-label pt-1 cursor-pointer"
                                                for="login-yes">Yes</label>
                                        </div>
                                        <div class="form-check-inline custom-control custom-radio mt-2 mr-3">
                                            <input type="radio" value="disable" class="custom-control-input"
                                                id="login-no" name="login" autocomplete="off">
                                            <label class="custom-control-label pt-1 cursor-pointer"
                                                for="login-no">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-3 col-md-6">
                                <label class="f-14 text-dark-grey mb-12 my-3" data-label="" for="slack_username">Slack
                                    Username
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text f-14 bg-white-shade">@</span>
                                    </div>
                                    <input type="text" class="form-control height-35 f-14" name="slack_username"
                                        id="slack_username" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label="" for="tags">Skills
                                    </label>
                                    <tags class="tagify  form-control height-35 f-14" tabindex="-1">
                                        <span contenteditable="" data-placeholder="e.g. communication, ReactJS"
                                            aria-placeholder="e.g. communication, ReactJS" class="tagify__input"
                                            role="textbox" aria-autocomplete="both" aria-multiline="false"></span>
                                    </tags>
                                    <input type="text" class="form-control height-35 f-14"
                                        placeholder="e.g. communication, ReactJS" value="" name="tags" id="tags"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="w-100 border-top-grey d-block d-lg-flex d-md-flex justify-content-start px-4 py-3">
                            <button type="button" name="submit" class="btn-primary rounded f-14 p-2 mr-3"
                                id="save-employee-form">
                                <i class="bi bi-save-fill mr-2"></i>
                                Save
                            </button>

                            <a href="<?ROOT;?>/employees" class="btn-cancel rounded f-14 p-2 border-0">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>

<?php require_once("layout/footer.php");

?>

<div class="modal" id="myModal">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading">Designation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <table id="example" class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th class="w-75">Designation</th>
                            <th class="text-right">Action</th>
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
                                    <i class="bi bi-trash-fill mr-2"></i>
                                    Delete
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
                                <label class="f-14 text-dark-grey mb-12" data-label="true" for="designation_name">Name
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
                    Close
                </a>
                <button type="button" class="btn-primary rounded f-14 p-2" id="save-designation">
                    <i class="bi bi-save-fill mr-2"></i>
                    Save
                </button>


            </div>

            <script>
                $('body').on('click', '.delete-row', function(event) {
                    event.preventDefault();

                    var catId = $(this).data('row-id');
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
                            $.ajax({
                                type: 'POST',
                                url: '<?=ROOT;?>/addemployee/0?emplooyeDesignation=delete',
                                data: {
                                    'catId': catId

                                },
                                success: function(response) {
                                    console.log(response);
                                    if (response.status == 'success') {

                                        $('tr[id="row-' + catId + '"]').remove();
                                        $('#employee_designation option[value="' +
                                            catId + '"]').remove();
                                        $('#employee_designation').selectpicker(
                                            'refresh');

                                    } else {
                                        Swal.fire({
                                            title: "Error!",
                                            text: "Something went wrong!",
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
                        url: '<?=ROOT;?>/addemployee/0?emplooyeDesignation=add',
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
                                var ole = $('#employee_designation')
                                ole.append('<option value="' + response.catId +
                                    '">' + response
                                    .catName +
                                    '</option>');
                                $('#employee_designation').selectpicker('refresh');
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
                                    <i class="bi bi-trash-fill mr-2"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                                        `
                                )

                            } else {
                                Swal.fire({
                                    title: "Error!",
                                    text: "Something went wrong!",
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
                            url: '<?=ROOT;?>/addemployee/0?emplooyeDesignation=edit',
                            container: '#row-' + id,
                            type: "POST",
                            data: {
                                'designation_name': value,
                                'id': id
                            },
                            blockUI: true,
                            success: function(response) {

                                if (response.status == 'success') {

                                    var ole = $('#employee_designation option[value=' +
                                        id + ']')
                                    ole.text(value);
                                    $('#employee_designation').selectpicker('refresh');

                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "Something went wrong!",
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
                <h5 class="modal-title" id="modelHeading">Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <table id="example" class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th class="w-75">Department</th>
                            <th class="text-right">Action</th>
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
                                    <i class="bi bi-trash-fill mr-2"></i>
                                    Delete
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
                                <label class="f-14 text-dark-grey mb-12" data-label="true" for="department_name">Name
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
                    Close
                </a>
                <button type="button" class="btn-primary rounded f-14 p-2" id="save-department">
                    <i class="bi bi-save mr-2"></i>
                    Save
                </button>


            </div>

            <script>
                $('body').on('click', '#myModal2 .delete-row', function(event) {
                    event.preventDefault();

                    var catId = $(this).data('row-id');
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
                            $.ajax({
                                type: 'POST',
                                url: '<?=ROOT;?>/addemployee/0?emplooyeDepartment=delete',
                                data: {
                                    'catId': catId

                                },
                                success: function(response) {
                                    console.log(response);
                                    if (response.status == 'success') {

                                        $('tr[id="row-' + catId + '"]').remove();
                                        $('#employee_department option[value="' +
                                            catId + '"]').remove();
                                        $('#employee_department').selectpicker(
                                            'refresh');

                                    } else {
                                        Swal.fire({
                                            title: "Error!",
                                            text: "Something went wrong!",
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
                        url: '<?=ROOT;?>/addemployee/0?emplooyeDepartment=add',
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
                                var ole = $('#employee_department')
                                var appendOption = ole.append(
                                    '<option value="' +
                                    response.catId +
                                    '">' + response
                                    .catName +
                                    '</option>')
                                $('#employee_department option').last().attr('data-content',
                                    '<span class="badge badge-pill badge-light border p-2">' +
                                    response.catName +
                                    '</span>');
                                $('#employee_department').selectpicker('refresh');
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
                                    <i class="bi bi-trash-fill mr-2"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                                        `
                                )

                            } else {
                                Swal.fire({
                                    title: "Error!",
                                    text: "Something went wrong!",
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
                            url: '<?=ROOT;?>/addemployee/0?emplooyeDepartment=edit',
                            container: '#row-' + id,
                            type: "POST",
                            data: {
                                'department_name': value,
                                'id': id
                            },
                            blockUI: true,
                            success: function(response) {

                                if (response.status == 'success') {

                                    var ole = $('#employee_department option[value=' +
                                        id + ']')
                                    ole.text(value);
                                    $('#employee_department').selectpicker('refresh');

                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "Something went wrong!",
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

<script>
    $(document).ready(function() {
        $('#random_password').click(function() {
            var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            var passwordLength = 14;
            var password = "";
            for (var i = 0; i <= passwordLength; i++) {
                var randomNumber = Math.floor(Math.random() * chars.length);
                password += chars.substring(randomNumber, randomNumber + 1);
            }
            $('#password').val(password);
        });

        $('.toggle-password').click(function() {
            var classTogle = $(this)

            var password = $('#password');
            if (password.attr('type') == 'password') {
                password.attr('type', 'text');
                classTogle.html(`<i class="bi bi-eye-slash-fill"></i>`);
            } else {
                password.attr('type', 'password');
                classTogle.html(
                    `<i class="bi bi-eye-fill"></i>`
                );
            }
        });

        $('#save-employee-form').click(function(event) {
            event.preventDefault();
            var form = $('#save-employee-data-form');
            if (form[0].checkValidity()) {
                var formData = new FormData(form[0]);

                $.ajax({
                    url: '<?=ROOT;?>/addemployee/save',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire({
                                title: 'Success',
                                text: response.message,
                                icon: 'success',
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
                            }).then(function(result) {
                                if (result.value) {
                                    window.location.href =
                                        '<?=ROOT;?>/employee';
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: response.message,
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
            } else {
                form[0].reportValidity();
            }

        });


    });
</script>
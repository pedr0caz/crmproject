<?php require_once("layout/header.php"); ?>
<?php require_once("layout/navbar.php"); ?>
<section class="main-container bg-additional-grey" id="fullscreen">

    <!-- PAGE TITLE END -->
    <div class="content-wrapper">
        <link rel="stylesheet" href="http://localhost/script/public/vendor/css/tagify.css">
        <div class="row">
            <div class="col-sm-12">
                <form method="POST" action="<?=ROOT;?>/addemployee"
                    enctype="multipart/form-data">

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
                                                autocomplete="off" data-np-checked="1">
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
                                                autocomplete="off" data-np-checked="1">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <label class="f-14 text-dark-grey mb-12 mt-3" data-label="true"
                                            for="password">Password
                                            <sup class="f-14 mr-1">*</sup>
                                        </label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="password"
                                                class="form-control height-35 f-14" autocomplete="off"
                                                data-np-checked="1">

                                            <div class="input-group-append">
                                                <button id="random_password" type="button" data-toggle="tooltip"
                                                    data-original-title="Generate Random Password"
                                                    class="btn btn-outline-secondary border-grey height-35">
                                                    <svg class="svg-inline--fa fa-random fa-w-16" aria-hidden="true"
                                                        focusable="false" data-prefix="fa" data-icon="random" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        data-fa-i2svg="">
                                                        <path fill="currentColor"
                                                            d="M504.971 359.029c9.373 9.373 9.373 24.569 0 33.941l-80 79.984c-15.01 15.01-40.971 4.49-40.971-16.971V416h-58.785a12.004 12.004 0 0 1-8.773-3.812l-70.556-75.596 53.333-57.143L352 336h32v-39.981c0-21.438 25.943-31.998 40.971-16.971l80 79.981zM12 176h84l52.781 56.551 53.333-57.143-70.556-75.596A11.999 11.999 0 0 0 122.785 96H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12zm372 0v39.984c0 21.46 25.961 31.98 40.971 16.971l80-79.984c9.373-9.373 9.373-24.569 0-33.941l-80-79.981C409.943 24.021 384 34.582 384 56.019V96h-58.785a12.004 12.004 0 0 0-8.773 3.812L96 336H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h110.785c3.326 0 6.503-1.381 8.773-3.812L352 176h32z">
                                                        </path>
                                                    </svg>
                                                    <!-- <i class="fa fa-random"></i> Font Awesome fontawesome.com -->
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

                                            <select name="designation_id" class="form-control"
                                                id="employee_designation">
                                                <option value="">--</option>
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

                                            <select name="department_id" class="form-control" id="employee_department">
                                                <option value="">--</option>
                                                <?php foreach($departments as $department): ?>
                                                <option
                                                    value="<?=$department['id']?>">
                                                    <?=$department['team_name']?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>


                                            <div class="input-group-append">
                                                <button id="designation-setting-add" type="button"
                                                    class="btn btn-outline-secondary border-grey">Add</button>
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
                                </label>
                                <div class="form-group mb-0">
                                    <select name="country_id" class="form-control height-35 f-14">
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
                                    </label>
                                    <input type="tel" class="form-control height-35 f-14" placeholder="e.g. 987654321"
                                        value="" name="mobile" id="mobile" autocomplete="off" data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label class="f-14 text-dark-grey mb-12 mt-3" data-label="" for="gender">Gender
                                </label>
                                <div class="input-group">

                                    <select name="gender" class="form-control height-35 f-14" id="employee_designation">
                                        <option value="">--</option>
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
                                        placeholder="Select Date" value="18-10-2022" name="joining_date"
                                        id="joining_date" autocomplete="off" data-np-checked="1">

                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group my-3" style="position: relative;">
                                    <label class="f-14 text-dark-grey mb-12" data-label="" for="date_of_birth">Date of
                                        Birth
                                    </label>
                                    <input type="date" class="form-control  date-picker height-35 f-14"
                                        placeholder="Select Date" value="" name="date_of_birth" id="date_of_birth"
                                        autocomplete="off" data-np-checked="1">

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
                                                id="login-yes" name="login" checked="" autocomplete="off"
                                                data-np-checked="1">
                                            <label class="custom-control-label pt-1 cursor-pointer"
                                                for="login-yes">Yes</label>
                                        </div>
                                        <div class="form-check-inline custom-control custom-radio mt-2 mr-3">
                                            <input type="radio" value="disable" class="custom-control-input"
                                                id="login-no" name="login" autocomplete="off" data-np-checked="1">
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
                                        id="slack_username" autocomplete="off" data-np-checked="1">
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
                                        autocomplete="off" data-np-checked="1">
                                </div>
                            </div>
                        </div>
                        <div class="w-100 border-top-grey d-block d-lg-flex d-md-flex justify-content-start px-4 py-3">
                            <button type="submit" name="submit" class="btn-primary rounded f-14 p-2 mr-3"
                                id="save-employee-form">
                                <svg class="svg-inline--fa fa-check fa-w-16 mr-1" aria-hidden="true" focusable="false"
                                    data-prefix="fa" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                    </path>
                                </svg>
                                <!-- <i class="fa fa-check mr-1"></i> Font Awesome fontawesome.com -->
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

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Designation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <table id="example" class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Designation</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($designations as $designation) { ?>
                        <tr id="cat-1">
                            <td><?=$designation['id'];?>
                            </td>
                            <td data-row-id="1"><?=$designation['name'];?>
                            </td>

                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <form method="POST" id="createProjectCategory" autocomplete="off" data-np-checked="1"
                    data-np-autofill-type="other" data-np-watching="1">




                    <div class="row border-top-grey ">
                        <div class="col-sm-12">
                            <div class="form-group my-3">
                                <label class="f-14 text-dark-grey mb-12" data-label="true"
                                    for="category_name">Designation
                                    <sup class="f-14 mr-1">*</sup>

                                </label>

                                <input type="text" class="form-control height-35 f-14" placeholder="Ex: Team Lead"
                                    value="" name="category_name" id="category_name" data-np-checked="1">

                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
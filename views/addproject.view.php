<?php require_once("layout/header.php"); ?>
<?php require_once("layout/navbar.php"); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
<section class="main-container bg-additional-grey" id="fullscreen">
    <div class="preloader-container justify-content-center align-items-center" style="display: none;">
        <div class="spinner-border" role="status" aria-hidden="true"></div>
    </div>

    <!-- PAGE TITLE END -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">

                <form method="POST" action="<?=ROOT;?>/addproject"
                    autocomplete="off" data-np-checked="1" data-np-autofill-type="other" data-np-watching="1">

                    <div class="add-client bg-white rounded">
                        <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                            Project Details
                        </h4>
                        <?php if (isset($error)) {
                            echo "<div class='alert alert-danger' role='alert'>
                            $error
                            </div>";
                        } ?>

                        <input type="hidden" name="template_id" value="" autocomplete="off" data-np-checked="1">
                        <div class="row p-20">
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group my-3 mr-0 mr-lg-2 mr-md-2">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true"
                                        for="project_name">Project Name
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>
                                    <input type="text" class="form-control height-35 f-14"
                                        placeholder="Write a project name" value="" name="project_name"
                                        id="project_name" autocomplete="off" data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group my-3" style="position: relative;">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true" for="start_date">Start
                                        Date
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>
                                    <input type="date" class="form-control  date-picker height-35 f-14"
                                        placeholder="Select Date" value="" name="start_date" id="start_date"
                                        autocomplete="off" data-np-checked="1">

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3" id="deadlineBox">
                                <div class="form-group my-3" style="position: relative;">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true" for="deadline">Deadline
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>
                                    <input type="date" class="form-control  date-picker height-35 f-14"
                                        placeholder="Select Date" value="" name="deadline" id="deadline"
                                        autocomplete="off" data-np-checked="1">

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group">
                                    <div class="d-flex mt-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="without_deadline"
                                                id="without_deadline" autocomplete="off" data-np-checked="1">
                                            <label
                                                class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 pt-2 text-wrap"
                                                for="without_deadline">
                                                There is no project deadline
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="f-14 text-dark-grey mb-12 my-3" data-label="" for="category_id">Project
                                    Category
                                </label>
                                <div class="input-group">
                                    <select class="form-control " data-size="8" name="category_id"
                                        id="project_category_id">

                                        <option value="">--</option>
                                        <?php foreach ($projectCategory as $category) {
                                            echo '<option value="' . $category['id'] . '">' . $category['category_name'] . '</option>';
                                        } ?>


                                    </select>



                                    <div class="input-group-append">


                                        <button type="button" class="btn btn-outline-secondary border-grey"
                                            data-toggle="modal" data-target="#myModal2">
                                            Add
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="f-14 text-dark-grey mb-12 my-3" data-label="" for="department">Department
                                </label>
                                <div class="input-group">
                                    <select class="form-control " data-size="8" name="team_id" id="department_list_id">
                                        <option value="">--</option>
                                        <?php foreach ($departments as $department) {
                                            echo '<option value="' . $department['id'] . '">' . $department['team_name'] . '</option>';
                                        } ?>
                                        } ?>
                                    </select>



                                    <div class="input-group-append">


                                        <button type="button" class="btn btn-outline-secondary border-grey"
                                            data-toggle="modal" data-target="#myModal">
                                            Add
                                        </button>
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-4  py-3 ">
                                <label class="f-14 text-dark-grey mb-12" data-label="false" for="client_id">Client
                                </label>
                                <div class="input-group">

                                    <select class="form-control " data-size="8" name="client_id" id="client_list_id">
                                        <option value="">--</option>
                                        <?php foreach ($clients as $client) {
                                            echo '<option value="' . $client['client_id'] . '">' . $client['name'] . '</option>';
                                        } ?>


                                    </select>



                                    <div class="input-group-append">


                                        <a href="<?=ROOT;?>/addclient"
                                            class="btn btn-outline-secondary border-grey">
                                            Add
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12 my-3" data-label=""
                                        for="project_summary">Project Summary
                                    </label>

                                    <textarea name="project_summary" id="editor"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12 my-3" data-label="" for="notes">Notes
                                    </label>
                                    <textarea name="notes" id="editor2"></textarea>
                                </div>
                            </div>


                        </div>


                    </div>
                    <div class="w-100 border-top-grey d-block d-lg-flex d-md-flex justify-content-start px-4 py-3">
                        <button name="submit" type="submit" class="btn-primary rounded f-14 p-2 mr-3"
                            id="save-project-form">
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

                        <a href="<?=ROOT?>/project"
                            class="btn-cancel rounded f-14 p-2 border-0">
                            Cancel
                        </a>
                    </div>
            </div>
            </form>
        </div>
    </div>

    </div>
</section>
<?php require_once("layout/footer.php");?>
<!-- Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <table id="example" class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th class="w-75">Department</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($departments as $department) { ?>
                        <tr
                            id="<?=$department['id'];?>">
                            <td><?=$department['id'];?>
                            </td>
                            <td data-row-id="1"><?=$department['team_name'];?>
                            </td>

                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <form method="POST" id="createProjectCategory" autocomplete="off" data-np-checked="1"
                    data-np-autofill-type="other" data-np-watching="1">
                    <input type="password" class="autocomplete-password" style="opacity: 0;position: absolute;"
                        data-np-checked="1">
                    <input type="search" class="autocomplete-password" style="opacity: 0;position: absolute;"
                        data-np-checked="1">



                    <div class="row border-top-grey ">
                        <div class="col-sm-12">
                            <div class="form-group my-3">
                                <label class="f-14 text-dark-grey mb-12" data-label="true" for="department_name">Name
                                    <sup class="f-14 mr-1">*</sup>

                                </label>

                                <input type="text" class="form-control height-35 f-14" placeholder="e.g. Human Resource"
                                    value="" name="team_name" id="department_name" data-np-checked="1">

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

<div class="modal" id="myModal2">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Project Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <table id="example" class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($projectCategory as $category) { ?>
                        <tr id="cat-1">
                            <td><?=$category['id'];?>
                            </td>
                            <td data-row-id="1"><?=$category['category_name'];?>
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
                                <label class="f-14 text-dark-grey mb-12" data-label="true" for="category_name">Category
                                    Name
                                    <sup class="f-14 mr-1">*</sup>

                                </label>

                                <input type="text" class="form-control height-35 f-14"
                                    placeholder="Enter a category name" value="" name="category_name" id="category_name"
                                    data-np-checked="1">

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

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor2'))
        .catch(error => {
            console.error(error);
        });




    document.getElementById('project_category_id').onchange = function() {
        fetch('addproject/0', {
            // mode: 'no-cors',
            method: 'GET',
            headers: {
                Accept: 'application/json',
            },
        }, ).then((response) => {
            return response.json();
        }).then((data) => {
            var curvalue = document.getElementById('project_category_id').value;
            document.getElementById('project_category_id').innerHTML = '';
            data.projectCategory.forEach((element) => {
                console.log(element);
                document.getElementById('project_category_id').innerHTML +=
                    `<option value="${element.id}">${element.category_name}</option>`;
            });
            document.getElementById('project_category_id').value = curvalue;

        })

    };

    document.getElementById('client_list_id').onchange = function() {
        fetch('addproject/0', {
            // mode: 'no-cors',
            method: 'GET',
            headers: {
                Accept: 'application/json',
            },
        }, ).then((response) => {
            return response.json();
        }).then((data) => {
            var curvalue = document.getElementById('client_list_id').value;

            document.getElementById('client_list_id').innerHTML = '';
            data.clients.forEach((element) => {
                console.log(element);
                document.getElementById('client_list_id').innerHTML +=
                    `<option value="${element.client_id}">${element.name}</option>`;
            });
            document.getElementById('client_list_id').value = curvalue;

        })

    };

    document.getElementById('department_list_id').onchange = function() {
        fetch('addproject/0', {
            // mode: 'no-cors',
            method: 'GET',
            headers: {
                Accept: 'application/json',
            },
        }, ).then((response) => {
            return response.json();
        }).then((data) => {
            var curvalue = document.getElementById('department_list_id').value;
            console.log(curvalue);
            document.getElementById('department_list_id').innerHTML = '';
            data.departments.forEach((element) => {
                console.log(element);
                document.getElementById('department_list_id').innerHTML +=
                    `<option value="${element.id}">${element.team_name}</option>`;
            });

            document.getElementById('department_list_id').value = curvalue;


        })

    };
</script>
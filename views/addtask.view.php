<?php
require_once("layout/header.php");
require_once("layout/navbar.php");
?>
<section class="main-container bg-additional-grey" id="fullscreen">




    <div class="content-wrapper">


        <div class="row">
            <div class="col-sm-12">
                <form method="POST" id="save-task-data-form" autocomplete="off" data-np-checked="1"
                    data-np-autofill-type="other" data-np-watching="1">



                    <div class="add-client bg-white rounded">
                        <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                            Task Info</h4>
                        <div class="row p-20">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true" for="heading">Title
                                        <sup class="f-14 mr-1">*</sup>

                                    </label>

                                    <input type="text" class="form-control height-35 f-14"
                                        placeholder="Enter a task title" value="" name="heading" id="heading"
                                        autocomplete="off" data-np-invisible="1" data-np-checked="1">

                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label class="f-14 text-dark-grey mb-12 my-3" data-label="" for="category_id">Task
                                    category

                                </label>
                                <div class="input-group">

                                    <div class="dropdown bootstrap-select form-control select-picker"><select
                                            class="form-control select-picker" name="category_id" id="task_category_id"
                                            data-live-search="true" data-size="8">
                                            <option value="">--</option>
                                            <option value="1">PHP
                                            </option>

                                        </select><button type="button" tabindex="-1"
                                            class="btn dropdown-toggle btn-light bs-placeholder" data-toggle="dropdown"
                                            role="combobox" aria-owns="bs-select-2" aria-haspopup="listbox"
                                            aria-expanded="false" data-id="task_category_id" title="--">
                                            <div class="filter-option">
                                                <div class="filter-option-inner">
                                                    <div class="filter-option-inner-inner">--</div>
                                                </div>
                                            </div>
                                        </button>
                                        <div class="dropdown-menu ">
                                            <div class="bs-searchbox"><input type="search" class="form-control"
                                                    autocomplete="off" role="combobox" aria-label="Search"
                                                    aria-controls="bs-select-2" aria-autocomplete="list"
                                                    data-np-invisible="1" data-np-checked="1"></div>
                                            <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="input-group-append">
                                        <button id="create_task_category" type="button"
                                            class="btn btn-outline-secondary border-grey">Add</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label class="f-14 text-dark-grey mb-12 mt-3" data-label="" for="project_id">Project

                                </label>
                                <div class="form-group mb-0">

                                    <div class="dropdown bootstrap-select form-control select-picker"><select
                                            name="project_id" id="project_id" data-live-search="true"
                                            class="form-control select-picker" data-size="8">
                                            <option value="">--</option>
                                            <option value="1">
                                                Test
                                            </option>
                                        </select><button type="button" tabindex="-1"
                                            class="btn dropdown-toggle btn-light bs-placeholder" data-toggle="dropdown"
                                            role="combobox" aria-owns="bs-select-3" aria-haspopup="listbox"
                                            aria-expanded="false" data-id="project_id" title="--">
                                            <div class="filter-option">
                                                <div class="filter-option-inner">
                                                    <div class="filter-option-inner-inner">--</div>
                                                </div>
                                            </div>
                                        </button>
                                        <div class="dropdown-menu ">
                                            <div class="bs-searchbox"><input type="search" class="form-control"
                                                    autocomplete="off" role="combobox" aria-label="Search"
                                                    aria-controls="bs-select-3" aria-autocomplete="list"
                                                    data-np-invisible="1" data-np-checked="1"></div>
                                            <div class="inner show" role="listbox" id="bs-select-3" tabindex="-1">
                                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-5 col-lg-4">
                                <div class="form-group my-3" style="position: relative;">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true"
                                        for="task_start_date">Start Date
                                        <sup class="f-14 mr-1">*</sup>

                                    </label>

                                    <input type="date" class="form-control  date-picker height-35 f-14"
                                        placeholder="Select Date" value="19-10-2022" name="start_date"
                                        id="task_start_date" autocomplete="off" data-np-checked="1">


                                </div>
                            </div>

                            <div class="col-md-5 col-lg-4 dueDateBox">
                                <div class="form-group my-3" style="position: relative;">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true" for="due_date">Due Date
                                        <sup class="f-14 mr-1">*</sup>

                                    </label>

                                    <input type="date" class="form-control  date-picker height-35 f-14"
                                        placeholder="Select Date" value="19-10-2022" name="due_date" id="due_date"
                                        autocomplete="off" data-np-checked="1">



                                </div>
                            </div>


                            <div class="col-md-12 col-lg-12">
                            </div>

                            <div class="col-md-12 col-lg-8">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label="" for="selectAssignee">Assigned
                                        To

                                    </label>
                                    <div class="input-group">

                                        <div class="dropdown bootstrap-select show-tick form-control multiple-users">
                                            <select class="form-control multiple-users" multiple="" name="user_id[]"
                                                id="selectAssignee" data-live-search="true" data-size="8">
                                                <option
                                                    data-content="<span class='badge badge-pill badge-light border'><div class='d-inline-block mr-1'><img class='taskEmployeeImg rounded-circle' src='https://www.gravatar.com/avatar/3ea58e77e21cabdfeabbfd844cbabbca.png?s=200&amp;d=mp' ></div> Asdsad</span>"
                                                    value="6">Asdsad</option>
                                                <option
                                                    data-content="<span class='badge badge-pill badge-light border'><div class='d-inline-block mr-1'><img class='taskEmployeeImg rounded-circle' src='https://www.gravatar.com/avatar/a456ed61bc3c5d05f3ad79d85069098a.png?s=200&amp;d=mp' ></div> Dassad</span>"
                                                    value="7">Dassad</option>
                                                <option
                                                    data-content="<span class='badge badge-pill badge-light border'><div class='d-inline-block mr-1'><img class='taskEmployeeImg rounded-circle' src='https://www.gravatar.com/avatar/b4dda2fb5d3ab52705af21229f9b4b93.png?s=200&amp;d=mp' ></div> John</span>"
                                                    value="4">John</option>
                                                <option selected=""
                                                    data-content="<span class='badge badge-pill badge-light border'><div class='d-inline-block mr-1'><img class='taskEmployeeImg rounded-circle' src='https://www.gravatar.com/avatar/7fcefe645acaa3363d8f10bdfba33c0d.png?s=200&amp;d=mp' ></div> Pedro<span class=&quot;ml-2 badge badge-secondary&quot;>It's you</span></span>"
                                                    value="1">Pedro</option>
                                            </select><button type="button" tabindex="-1"
                                                class="btn dropdown-toggle btn-light" data-toggle="dropdown"
                                                role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox"
                                                aria-expanded="false" data-id="selectAssignee" title="PedroIt's you">
                                                <div class="filter-option">
                                                    <div class="filter-option-inner">
                                                        <div class="filter-option-inner-inner"><span
                                                                class="badge badge-pill badge-light border">
                                                                <div class="d-inline-block mr-1"><img
                                                                        class="taskEmployeeImg rounded-circle"
                                                                        src="https://www.gravatar.com/avatar/7fcefe645acaa3363d8f10bdfba33c0d.png?s=200&amp;d=mp">
                                                                </div> Pedro<span
                                                                    class="ml-2 badge badge-secondary">It's you</span>
                                                            </span></div>
                                                    </div>
                                                </div>
                                            </button>
                                            <div class="dropdown-menu ">
                                                <div class="bs-searchbox"><input type="search" class="form-control"
                                                        autocomplete="off" role="combobox" aria-label="Search"
                                                        aria-controls="bs-select-1" aria-autocomplete="list"
                                                        data-np-invisible="1" data-np-checked="1"></div>
                                                <div class="bs-actionsbox">
                                                    <div class="btn-group btn-group-sm btn-block"><button type="button"
                                                            class="actions-btn bs-select-all btn btn-light">Select
                                                            All</button><button type="button"
                                                            class="actions-btn bs-deselect-all btn btn-light">Deselect
                                                            All</button></div>
                                                </div>
                                                <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1"
                                                    aria-multiselectable="true">
                                                    <ul class="dropdown-menu inner show" role="presentation"></ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group-append">
                                            <button id="assign-self" type="button"
                                                class="btn btn-outline-secondary border-grey" data-toggle="tooltip"
                                                data-original-title="Assign to me">
                                                <img src="https://www.gravatar.com/avatar/7fcefe645acaa3363d8f10bdfba33c0d.png?s=200&amp;d=mp"
                                                    width="23" class="img-fluid rounded-circle">
                                            </button>
                                        </div>

                                        <div class="input-group-append">
                                            <button id="add-employee" type="button"
                                                class="btn btn-outline-secondary border-grey">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label="" for="description">Description

                                    </label>

                                    <textarea name="description" id="description-text" class="d-none"></textarea>
                                </div>
                            </div>

                        </div>

                        <h4
                            class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-top-grey other-details-button">

                            Other Details
                        </h4>

                        <div class="row p-20" id="other-details">

                            <div class="col-sm-12">
                                <div class="row">

                                    <div class="col-md-12 col-lg-4">
                                        <div class="form-group my-3">
                                            <label class="f-14 text-dark-grey mb-12" data-label=""
                                                for="task_labels">Label

                                            </label>
                                            <div class="input-group">

                                                <div
                                                    class="dropdown bootstrap-select show-tick select-picker form-control">
                                                    <select class="select-picker form-control" multiple=""
                                                        name="task_labels[]" id="task_labels" data-live-search="true"
                                                        data-size="8">
                                                    </select><button type="button" tabindex="-1"
                                                        class="btn dropdown-toggle btn-light bs-placeholder"
                                                        data-toggle="dropdown" role="combobox" aria-owns="bs-select-4"
                                                        aria-haspopup="listbox" aria-expanded="false"
                                                        data-id="task_labels" title="Nothing selected">
                                                        <div class="filter-option">
                                                            <div class="filter-option-inner">
                                                                <div class="filter-option-inner-inner">Nothing selected
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <div class="dropdown-menu ">
                                                        <div class="bs-searchbox"><input type="search"
                                                                class="form-control" autocomplete="off" role="combobox"
                                                                aria-label="Search" aria-controls="bs-select-4"
                                                                aria-autocomplete="list" data-np-invisible="1"
                                                                data-np-checked="1"></div>
                                                        <div class="inner show" role="listbox" id="bs-select-4"
                                                            tabindex="-1" aria-multiselectable="true">
                                                            <ul class="dropdown-menu inner show" role="presentation">
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="input-group-append">
                                                    <button id="createTaskLabel" type="button"
                                                        class="btn btn-outline-secondary border-grey">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-4">
                                        <label class="f-14 text-dark-grey mb-12 mt-3" data-label=""
                                            for="milestone-id">Milestones

                                        </label>
                                        <div class="form-group mb-0">

                                            <div class="dropdown bootstrap-select form-control select-picker"><select
                                                    name="milestone_id" id="milestone-id"
                                                    class="form-control select-picker" data-size="8">
                                                    <option value="">--</option>
                                                </select><button type="button" tabindex="-1"
                                                    class="btn dropdown-toggle btn-light bs-placeholder"
                                                    data-toggle="dropdown" role="combobox" aria-owns="bs-select-5"
                                                    aria-haspopup="listbox" aria-expanded="false" data-id="milestone-id"
                                                    title="--">
                                                    <div class="filter-option">
                                                        <div class="filter-option-inner">
                                                            <div class="filter-option-inner-inner">--</div>
                                                        </div>
                                                    </div>
                                                </button>
                                                <div class="dropdown-menu ">
                                                    <div class="inner show" role="listbox" id="bs-select-5"
                                                        tabindex="-1">
                                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6">
                                        <label class="f-14 text-dark-grey mb-12 mt-3" data-label=""
                                            for="board_column_id">Status

                                        </label>
                                        <div class="form-group mb-0">

                                            <div class="dropdown bootstrap-select form-control select-picker"><select
                                                    name="board_column_id" id="board_column_id" data-live-search="true"
                                                    class="form-control select-picker" data-size="8">
                                                    <option selected="" value="1">
                                                        Incomplete
                                                    </option>
                                                    <option value="2">
                                                        Completed
                                                    </option>
                                                </select><button type="button" tabindex="-1"
                                                    class="btn dropdown-toggle btn-light" data-toggle="dropdown"
                                                    role="combobox" aria-owns="bs-select-6" aria-haspopup="listbox"
                                                    aria-expanded="false" data-id="board_column_id" title="Incomplete">
                                                    <div class="filter-option">
                                                        <div class="filter-option-inner">
                                                            <div class="filter-option-inner-inner">Incomplete</div>
                                                        </div>
                                                    </div>
                                                </button>
                                                <div class="dropdown-menu ">
                                                    <div class="bs-searchbox"><input type="search" class="form-control"
                                                            autocomplete="off" role="combobox" aria-label="Search"
                                                            aria-controls="bs-select-6" aria-autocomplete="list"
                                                            data-np-invisible="1" data-np-checked="1"></div>
                                                    <div class="inner show" role="listbox" id="bs-select-6"
                                                        tabindex="-1">
                                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6">
                                        <label class="f-14 text-dark-grey mb-12 mt-3" data-label=""
                                            for="priority">Priority

                                        </label>
                                        <div class="form-group mb-0">

                                            <div class="dropdown bootstrap-select form-control select-picker"><select
                                                    name="priority" id="priority" class="form-control select-picker"
                                                    data-size="8">
                                                    <option value="high">High</option>
                                                    <option value="medium" selected="">Medium</option>
                                                    <option value="low">Low</option>
                                                </select><button type="button" tabindex="-1"
                                                    class="btn dropdown-toggle btn-light" data-toggle="dropdown"
                                                    role="combobox" aria-owns="bs-select-7" aria-haspopup="listbox"
                                                    aria-expanded="false" data-id="priority" title="Medium">
                                                    <div class="filter-option">
                                                        <div class="filter-option-inner">
                                                            <div class="filter-option-inner-inner">Medium</div>
                                                        </div>
                                                    </div>
                                                </button>
                                                <div class="dropdown-menu ">
                                                    <div class="inner show" role="listbox" id="bs-select-7"
                                                        tabindex="-1">
                                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>







                            <div class="col-lg-12">
                                <div class="form-group my-3 mr-0 mr-lg-2 mr-md-2">
                                    <label class="f-14 text-dark-grey mb-12" data-label=""
                                        for="task-file-upload-dropzone">Add Files

                                    </label>



                                </div>
                                <input type="hidden" name="image_url" id="image_url" autocomplete="off"
                                    data-np-invisible="1" data-np-checked="1">
                            </div>
                            <input type="hidden" name="taskID" id="taskID" autocomplete="off" data-np-invisible="1"
                                data-np-checked="1">
                            <input type="hidden" name="addedFiles" id="addedFiles" autocomplete="off"
                                data-np-invisible="1" data-np-checked="1">

                        </div>

                        <div class="w-100 border-top-grey d-block d-lg-flex d-md-flex justify-content-start px-4 py-3">
                            <button type="button" class="btn-primary rounded f-14 p-2 mr-3" id="save-task-form">
                                <svg class="svg-inline--fa fa-check fa-w-16 mr-1" aria-hidden="true" focusable="false"
                                    data-prefix="fa" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                    </path>
                                </svg><!-- <i class="fa fa-check mr-1"></i> Font Awesome fontawesome.com -->
                                Save
                            </button>

                            <input type="password" class="autocomplete-password" style="opacity: 0;position: absolute;"
                                autocomplete="off" data-np-invisible="1" data-np-checked="1">
                            <input type="search" class="autocomplete-password" style="opacity: 0;position: absolute;"
                                autocomplete="off" data-np-invisible="1" data-np-checked="1">


                            <a href="http://localhost/script/public/account/tasks"
                                class="btn-cancel rounded f-14 p-2 border-0">
                                Cancel
                            </a>
                        </div>


                    </div>
                </form>

            </div>
        </div>


        <script src="http://localhost/script/public/vendor/jquery/dropzone.min.js"></script>
        <script>
            $(document).ready(function() {
                var add_task_files = "all";




                if ($('.custom-date-picker').length > 0) {
                    datepicker('.custom-date-picker', {
                        position: 'bl',
                        ...datepickerConfig
                    });
                }

                if (add_task_files == "all" || add_task_files == "added") {

                    Dropzone.autoDiscover = false;
                    //Dropzone class
                    taskDropzone = new Dropzone("div#task-file-upload-dropzone", {
                        dictDefaultMessage: "Choose a file",
                        url: "http://localhost/script/public/account/tasks/task-files",
                        headers: {
                            'X-CSRF-TOKEN': 'vS5MhYJZVhVCSYQswcdVXWuQ380764yTqWCy3aXb'
                        },
                        paramName: "file",
                        maxFilesize: DROPZONE_MAX_FILESIZE,
                        maxFiles: 10,
                        autoProcessQueue: false,
                        uploadMultiple: true,
                        addRemoveLinks: true,
                        parallelUploads: 10,
                        acceptedFiles: DROPZONE_FILE_ALLOW,
                        init: function() {
                            taskDropzone = this;
                        }
                    });
                    taskDropzone.on('sending', function(file, xhr, formData) {
                        var ids = $('#taskID').val();
                        formData.append('task_id', ids);
                        $.easyBlockUI();
                    });
                    taskDropzone.on('uploadprogress', function() {
                        $.easyBlockUI();
                    });
                    taskDropzone.on('completemultiple', function() {
                        window.location.href = "http://localhost/script/public/account/tasks"
                    });
                }


                $("#selectAssignee").selectpicker({
                    actionsBox: true,
                    selectAllText: "Select All",
                    deselectAllText: "Deselect All",
                    multipleSeparator: " ",
                    selectedTextFormat: "count > 8",
                    countSelectedText: function(selected, total) {
                        return selected + " members selected ";
                    }
                });

                quillImageLoad('#description');


                const dp1 = datepicker('#task_start_date', {
                    position: 'bl',
                    onSelect: (instance, date) => {
                        if (typeof dp2.dateSelected !== 'undefined' && dp2.dateSelected.getTime() <
                            date
                            .getTime()) {
                            dp2.setDate(date, true)
                        }
                        if (typeof dp2.dateSelected === 'undefined') {
                            dp2.setDate(date, true)
                        }
                        dp2.setMin(date);
                    },
                    ...datepickerConfig
                });

                const dp2 = datepicker('#due_date', {
                    position: 'bl',
                    onSelect: (instance, date) => {
                        dp1.setMax(date);
                    },
                    ...datepickerConfig
                });

                $('#save-task-data-form').on('change', '#project_id', function() {
                    let id = $(this).val();
                    if (id == '') {
                        id = 0;
                    }
                    let url =
                        "http://localhost/script/public/account/projects/milestones/byProject/:id";
                    url = url.replace(':id', id);

                    $.easyAjax({
                        url: url,
                        container: '#save-task-data-form',
                        type: "GET",
                        blockUI: true,
                        success: function(response) {
                            if (response.status == 'success') {
                                $('#milestone-id').html(response.data);
                                $('#milestone-id').selectpicker('refresh');
                            }
                        }
                    });
                });

                $('#save-task-data-form').on('change', '#project_id', function() {
                    let id = $(this).val();
                    if (id === '') {
                        id = 0;
                    }
                    let url = "http://localhost/script/public/account/projects/members/:id";
                    url = url.replace(':id', id);
                    $.easyAjax({
                        url: url,
                        type: "GET",
                        container: '#save-task-data-form',
                        blockUI: true,
                        redirect: true,
                        success: function(data) {
                            $('#selectAssignee').html(data.data);
                            $('#selectAssignee').selectpicker('refresh');
                        }
                    })
                });

                $('#save-task-data-form').on('change', '#project_id', function() {
                    let id = $(this).val();
                    if (id === '') {
                        id = 0;
                    }
                    let url = "http://localhost/script/public/account/projects/labels/:id";
                    url = url.replace(':id', id);
                    $.easyAjax({
                        url: url,
                        type: "GET",
                        container: '#save-task-data-form',
                        blockUI: true,
                        redirect: true,
                        success: function(data) {
                            $('#task_labels').html(data.data);
                            $('#task_labels').selectpicker('refresh');
                        }
                    })
                });

                $('#save-task-form').click(function() {
                    let note = document.getElementById('description').children[0].innerHTML;
                    document.getElementById('description-text').value = note;

                    const url = "http://localhost/script/public/account/tasks?taskId=";

                    $.easyAjax({
                        url: url,
                        container: '#save-task-data-form',
                        type: "POST",
                        disableButton: true,
                        blockUI: true,
                        buttonSelector: "#save-task-form",
                        data: $('#save-task-data-form').serialize(),
                        success: function(response) {
                            if (response.status === 'success') {
                                if (typeof taskDropzone !== 'undefined' && taskDropzone
                                    .getQueuedFiles().length > 0) {
                                    taskID = response.taskID;
                                    $('#taskID').val(response.taskID);
                                    taskDropzone.processQueue();
                                } else {
                                    window.location.href = response.redirectUrl;
                                }
                            }
                        }
                    });
                });

                $('#assign-self').click(function() {
                    $('#selectAssignee').val('1');
                    $('#selectAssignee').selectpicker('refresh');
                });

                $('#without_duedate').click(function() {
                    $('.dueDateBox').toggle();
                });

                $('#create_task_category').click(function() {
                    const url = "http://localhost/script/public/account/tasks/taskCategory/create";
                    $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
                    $.ajaxModal(MODAL_LG, url);
                });

                $('#department-setting').click(function() {
                    const url = "http://localhost/script/public/account/departments/create";
                    $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
                    $.ajaxModal(MODAL_LG, url);
                });

                $('#client_view_task').change(function() {
                    $('#clientNotification').toggleClass('d-none');
                });

                $('#set_time_estimate').change(function() {
                    $('#set-time-estimate-fields').toggleClass('d-none');
                });


                $('#repeat-task').change(function() {
                    $('#repeat-fields').toggleClass('d-none');
                });

                $('#dependent-task').change(function() {
                    $('#dependent-fields').toggleClass('d-none');
                });

                $('.toggle-other-details').click(function() {
                    $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-up');
                    $('#other-details').toggleClass('d-none');
                });


                $('#createTaskLabel').click(function() {
                    const url =
                        "http://localhost/script/public/account/tasks/task-label/create?task_id=";
                    $(MODAL_XL + ' ' + MODAL_HEADING).html('...');
                    $.ajaxModal(MODAL_XL, url);
                });

                $('#add-project').click(function() {
                    $(MODAL_XL).modal('show');

                    const url = "http://localhost/script/public/account/projects/create";

                    $.easyAjax({
                        url: url,
                        blockUI: true,
                        container: MODAL_XL,
                        success: function(response) {
                            if (response.status == "success") {
                                $(MODAL_XL + ' .modal-body').html(response.html);
                                $(MODAL_XL + ' .modal-title').html(response.title);
                                init(MODAL_XL);
                            }
                        }
                    });
                });

                $('#add-employee').click(function() {
                    $(MODAL_XL).modal('show');

                    const url = "http://localhost/script/public/account/employees/create";

                    $.easyAjax({
                        url: url,
                        blockUI: true,
                        container: MODAL_XL,
                        success: function(response) {
                            if (response.status == "success") {
                                $(MODAL_XL + ' .modal-body').html(response.html);
                                $(MODAL_XL + ' .modal-title').html(response.title);
                                init(MODAL_XL);
                            }
                        }
                    });
                });

                init(RIGHT_MODAL);
            });

            function checkboxChange(parentClass, id) {
                let checkedData = '';
                $('.' + parentClass).find("input[type= 'checkbox']:checked").each(function() {
                    checkedData = (checkedData !== '') ? checkedData + ', ' + $(this).val() : $(this).val();
                });
                $('#' + id).val(checkedData);
            }
        </script>
    </div>



</section>

<?php
require_once("layout/footer.php");

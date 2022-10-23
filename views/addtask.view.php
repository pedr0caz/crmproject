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
                            Task Info
                        </h4>
                        <div class="row p-20">
                            <div class="col-3">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true" for="heading">Title
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>
                                    <input type="text" class="form-control height-35 f-14"
                                        placeholder="Enter a task title" value="" name="heading" id="heading"
                                        autocomplete="off" data-np-invisible="1" data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12 " data-label="" for="category_id">Task
                                        category
                                    </label>

                                    <div class="input-group">
                                        <div class="dropdown bootstrap-select form-control">
                                            <select class="selectpicker form-control  f-14" name="task_id"
                                                id="task_category" data-live-search="true">
                                                <option value="6">Asdsad</option>

                                            </select>
                                        </div>
                                        <div class="input-group-append">
                                            <button id="create_task_category" type="button"
                                                class="btn btn-outline-secondary border-grey height-35">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true"
                                        for="task_start_date">Start Date
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>
                                    <input type="date" class="form-control  date-picker height-35 f-14"
                                        placeholder="Select Date" name="start_date" id="task_start_date"
                                        autocomplete="off" data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true" for="due_date">Due
                                        Date
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>
                                    <input type="date" class="form-control  date-picker height-35 f-14"
                                        placeholder="Select Date" name="due_date" id="due_date" autocomplete="off"
                                        data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-3">
                                <label class="f-14 text-dark-grey mb-12 mt-3" data-label="" for="project_id">Project
                                </label>
                                <div class="form-group mb-0">
                                    <div class="input-group">
                                        <div class="dropdown bootstrap-select show-tick form-control">
                                            <select class="selectpicker form-control height-35 f-14" name="project_id"
                                                id="project_id" data-live-search="true">
                                                <option>--</option>
                                                <?php foreach ($projects as $project) : ?>
                                                <option
                                                    value="<?php echo $project["project_id"]; ?>">
                                                    <?php echo $project["project_name"]; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label="" for="selectAssignee">Assigned
                                        To</label>
                                    <div class="input-group">
                                        <div class="dropdown bootstrap-select show-tick form-control multiple-users">
                                            <select class="selectpicker form-control height-35 f-14" multiple=""
                                                name="user_id[]" id="selectAssignee" data-live-search="true">
                                                <?php foreach($employees as $employee) : ?>
                                                <option
                                                    value="<?php echo $employee["user_id"]; ?>">
                                                    <?php echo $employee["name"];?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-3">
                                <label class="f-14 text-dark-grey mb-12 mt-3" data-label="" for="board_column_id">Status
                                </label>
                                <div class="form-group mb-0">
                                    <select class="selectpicker form-control height-35 f-14" name="task_status"
                                        id="task_status">
                                        <?php foreach($taskLabels as $taskLabel): ?>
                                        <option
                                            data-content="<i class='bi bi-circle-fill  mr-2'  style='color:<?=$taskLabel['label_color']?>'></i>  <?=$taskLabel['column_name']?>"
                                            value="<?=$taskLabel['id']?>"
                                            <?php if($taskLabel['id'] == $task['board_column_id']) {
                                                echo 'selected';
                                            } ?>>
                                            <?=$taskLabel['column_name']?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <label class="f-14 text-dark-grey mb-12 mt-3" data-label="" for="priority">Priority
                                </label>
                                <div class="form-group mb-0">
                                    <select class="selectpicker form-control height-35 f-14" name="priority"
                                        id="priority">
                                        <option
                                            data-content="<i class='bi bi-circle-fill  mr-2'  style='color:#f1c40f'></i>  Low"
                                            value="1">Low</option>
                                        <option
                                            data-content="<i class='bi bi-circle-fill  mr-2'  style='color:#e67e22'></i>  Medium"
                                            value="2">Medium</option>
                                        <option
                                            data-content="<i class='bi bi-circle-fill  mr-2'  style='color:#e74c3c'></i>  High"
                                            value="3">High</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label="" for="description">Description
                                    </label>
                                    <textarea name="description" id="editor"></textarea>
                                </div>
                            </div>




                        </div>
                        <div class="w-100 border-top-grey d-block d-lg-flex d-md-flex justify-content-start px-4 py-3">
                            <button type="button" class="btn-primary rounded f-14 p-2 mr-3" id="save-task-form">
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
                            <a href="http://localhost/script/public/account/tasks"
                                class="btn-cancel rounded f-14 p-2 border-0">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#project_id').on('change', function() {
                    var project_id = parseInt($(this).val());

                    if (Number.isInteger(project_id)) {
                        console.log(" run")
                        $.ajax({
                            url: '<?=ROOT;?>/addtask/0?project_id=' +
                                project_id,
                            type: 'POST',
                            success: function(data) {
                                $('select[id="selectAssignee"]').empty();
                                $.each(data, function(key, value) {
                                    var user = $('<option />').html(
                                        "<img src='' />" + value.name).val(
                                        value.id);
                                    $('select[id="selectAssignee"]').append(user);
                                });
                                $('select[id="selectAssignee"]').selectpicker("destroy");
                                $('select[id="selectAssignee"]').selectpicker("refresh");


                            }
                        });
                    } else {
                        $('select[id="selectAssignee"]').empty();
                        console.log("nu run")
                        $.ajax({
                            url: '<?=ROOT;?>/addtask/0?noproject',
                            type: 'POST',
                            success: function(data) {
                                $('select[id="selectAssignee"]').empty();
                                $.each(data, function(key, value) {
                                    var user = $('<option />').html(
                                        "<img src='' />" + value.name).val(
                                        value.id);
                                    $('select[id="selectAssignee"]').append(user);
                                });
                                $('select[id="selectAssignee"]').selectpicker("destroy");
                                $('select[id="selectAssignee"]').selectpicker("refresh");


                            }
                        });
                    }
                });

                let editor;
                ClassicEditor
                    .create(document.querySelector('#editor')).then((newEditor) => {
                        editor = newEditor;
                    })
                    .catch(error => {
                        console.error(error);
                    });



                // Basic
                $('.dropify').dropify();




            });
        </script>
    </div>
</section>
<?php
require_once("layout/footer.php");

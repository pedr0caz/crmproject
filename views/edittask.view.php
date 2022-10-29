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
                            Edit Task Info
                        </h4>
                        <div class="row p-20">
                            <div class="col-3">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true" for="heading">Title
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>
                                    <input type="text" class="form-control height-35 f-14"
                                        placeholder="Enter a task title"
                                        value="<?=$task['heading'];?>"
                                        name="heading" id="heading" autocomplete="off" data-np-invisible="1"
                                        data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12 " data-label="" for="category_id">Task
                                        category
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>

                                    <div class="input-group">
                                        <div class="dropdown bootstrap-select form-control">
                                            <select class="selectpicker form-control  f-14" name="task_id"
                                                id="task_category" data-live-search="true">
                                                <?php foreach ($taskCategories as $category) : ?>
                                                <option
                                                    value="<?=$category['id'];?>"
                                                    <?php if ($category['id'] == $task['task_id']) : ?>
                                                    selected
                                                    <?php endif; ?>
                                                    >
                                                    <?=$category['category_name'];?>
                                                    <?php endforeach; ?>


                                            </select>
                                        </div>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary border-grey"
                                                data-toggle="modal" data-target="#myModal2">
                                                Add
                                            </button>
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
                                        placeholder="Select Date"
                                        value="<?=$task['start_date'];?>"
                                        name="start_date" id="task_start_date" autocomplete="off" data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true" for="due_date">Due
                                        Date
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>
                                    <input type="date" class="form-control  date-picker height-35 f-14"
                                        placeholder="Select Date"
                                        value="<?=$task['due_date'];?>"
                                        name="due_date" id="due_date" autocomplete="off" data-np-checked="1">
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
                                                <option value="">--</option>
                                                <?php foreach ($projects as $project) : ?>
                                                <option
                                                    value="<?=$project['project_id'];?>"
                                                    <?php if ($project['project_id'] == $task['project_id']) : ?>
                                                    selected
                                                    <?php endif; ?>
                                                    >
                                                    <?=$project['project_name'];?>
                                                    <?php endforeach; ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label="" for="selectAssignee">Assigned
                                        To <sup class="f-14 mr-1">*</sup></label>

                                    <div class="input-group">
                                        <div class="dropdown bootstrap-select show-tick form-control multiple-users">
                                            <select class="selectpicker form-control height-35 f-14" multiple=""
                                                name="user_id[]" id="selectAssignee" data-live-search="true">
                                                <?php foreach($employees as $employee) : ?>
                                                <?php $image = $employee['image'] ? ROOT.'/'.$employee['image'] : 'https://www.gravatar.com/avatar/a456ed61bc3c5d05f3ad79d85069098a.png?s=200&d=mp'; ?>

                                                <option
                                                    data-content="<span class='badge badge-pill badge-light border p-2'><img src='<?=$image;?>' class='rounded-circle mr-1' width='20' height='20'><?=$employee['name'];?></span>"
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
                                    <sup class="f-14 mr-1">*</sup>
                                </label>

                                <div class="form-group mb-0">
                                    <select class="selectpicker form-control height-35 f-14" name="task_status"
                                        id="task_status">
                                        <?php foreach($taskLabels as $taskLabel): ?>
                                        <option
                                            data-content="<i class='bi bi-circle-fill  mr-2'  style='color:<?=$taskLabel['label_color']?>'></i>  <?=$taskLabel['column_name']?>"
                                            value="<?php echo $taskLabel["id"]; ?>"
                                            <?php if ($taskLabel['id'] == $task['board_column_id']) : ?>
                                            selected
                                            <?php endif; ?>
                                            >
                                            <?=$taskLabel['column_name']?>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <label class="f-14 text-dark-grey mb-12 mt-3" data-label="" for="priority">Priority
                                    <sup class="f-14 mr-1">*</sup>
                                </label>

                                <div class="form-group mb-0">
                                    <select class="selectpicker form-control height-35 f-14" name="priority"
                                        id="priority">
                                        <option
                                            data-content="<i class='bi bi-circle-fill  mr-2'  style='color:#f1c40f'></i>  Low"
                                            value="1" <?php if($task['priority'] == 'Low') {
                                                echo 'selected';
                                            } ?>>Low
                                        </option>
                                        <option
                                            data-content="<i class='bi bi-circle-fill  mr-2'  style='color:#e67e22'></i>  Medium"
                                            value="2" <?php if($task['priority'] == 'Medium') {
                                                echo 'selected';
                                            } ?>>Medium
                                        </option>
                                        <option
                                            data-content="<i class='bi bi-circle-fill  mr-2'  style='color:#e74c3c'></i>  High"
                                            value="3" <?php if($task['priority'] == 'High') {
                                                echo 'selected';
                                            } ?>>High
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label="" for="description">Description
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>
                                    <textarea name="description" id="editor"></textarea>
                                </div>
                            </div>




                        </div>
                        <div class="w-100 border-top-grey d-block d-lg-flex d-md-flex justify-content-start px-4 py-3">
                            <button type="button" name="submit" class="btn-primary rounded f-14 p-2 mr-3"
                                id="save-task-form">
                                <i class="bi bi-check mr-2"></i>
                                Edit
                            </button>
                            <a href="<?=ROOT;?>/taskdetails/<?=$id;?>"
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
                var
                    selectedEmployees = <?php echo json_encode($taskEmployeesIds); ?> ;
                $('#selectAssignee').selectpicker('val', selectedEmployees);

                $('#project_id').on('change', function() {
                    var project_id = parseInt($(this).val());

                    if (Number.isInteger(project_id)) {

                        $.ajax({
                            url: '<?=ROOT;?>/task/create?project_id=' +
                                project_id,
                            type: 'POST',
                            success: function(data) {
                                $('select[id="selectAssignee"]').empty();
                                $.each(data, function(key, value) {
                                    var image = value.image ?
                                        '<?=ROOT;?>/' +
                                        value.image :
                                        'https://www.gravatar.com/avatar/a456ed61bc3c5d05f3ad79d85069098a.png?s=200&d=mp';
                                    var user = $('<option />').attr('value',
                                        value.user_id).text(value.name).attr(
                                        'data-content',
                                        "<span class='badge badge-pill badge-light border p-2'><img src='" +
                                        image +
                                        "' class='rounded-circle mr-1' width='20' height='20'>" +
                                        value.name + "</span>");
                                    $('select[id="selectAssignee"]').append(user);
                                });
                                $('select[id="selectAssignee"]').selectpicker(
                                    "destroy");
                                $('select[id="selectAssignee"]').selectpicker(
                                    "refresh");


                            }
                        });
                    } else {
                        $('select[id="selectAssignee"]').empty();

                        $.ajax({
                            url: '<?=ROOT;?>/task/create?noproject',
                            type: 'POST',
                            success: function(data) {
                                $('select[id="selectAssignee"]').empty();
                                $.each(data, function(key, value) {
                                    var image = value.image ?
                                        '<?=ROOT;?>/' +
                                        value.image :
                                        'https://www.gravatar.com/avatar/a456ed61bc3c5d05f3ad79d85069098a.png?s=200&d=mp';
                                    var user = $('<option />').attr('value',
                                        value.user_id).text(value.name).attr(
                                        'data-content',
                                        "<span class='badge badge-pill badge-light border p-2'><img src='" +
                                        image +
                                        "' class='rounded-circle mr-1' width='20' height='20'>" +
                                        value.name + "</span>");
                                    $('select[id="selectAssignee"]').append(user);
                                });
                                $('select[id="selectAssignee"]').selectpicker(
                                    "destroy");
                                $('select[id="selectAssignee"]').selectpicker(
                                    "refresh");


                            }
                        });
                    }
                });

                let editor;
                ClassicEditor
                    .create(document.querySelector('#editor')).then((newEditor) => {
                        editor = newEditor;
                        editor.setData(
                            '<?=$task['description'];?>'
                        );
                    })
                    .catch(error => {
                        console.error(error);
                    });



                // Basic
                $('.dropify').dropify();

                $('#save-task-form').click(function() {

                    var form = $('#save-task-data-form');
                    var formData = new FormData(form[0]);
                    let description = editor.getData();
                    formData.append('description', description);
                    $.ajax({
                        url: '<?=ROOT;?>/task/<?=$id;?>?edit&submit',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log(response);
                            if (response.status == "success") {
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href =
                                            "<?=ROOT;?>/task/" +
                                            response.task_id;
                                    }
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Fill all the fields!',
                                    confirmButtonText: 'Ok'
                                })
                            }
                        }
                    });
                });



            });
        </script>
    </div>
</section>
<?php
require_once("layout/footer.php");
    ?>

<div class="modal" id="myModal2">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Task category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <table id="example" class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody id="category_model">
                            <?php foreach ($taskCategories as $category) : ?>
                            <tr
                                data-tr-id="<?=$category['id']?>">
                                <td><?=$category['id']?>
                                </td>
                                <td data-row-id="<?=$category['id'];?>"
                                    contenteditable="true">
                                    <?=$category['category_name']?>
                                </td>
                                <td class="text-right">
                                    <button type="button" class="btn-secondary rounded f-14 p-2 delete-category"
                                        data-cat-id="<?=$category['id']?>">
                                        <i class="bi bi-trash-fill"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <form method="POST" id="createTaskCategory" autocomplete="off" data-np-checked="1"
                        data-np-autofill-type="other" data-np-watching="1">


                        <div class="row border-top-grey ">
                            <div class="col-sm-12">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true"
                                        for="category_name">Category Name
                                        <sup class="f-14 mr-1">*</sup>

                                    </label>

                                    <input type="text" class="form-control height-35 f-14"
                                        placeholder="Enter a category name" value="" name="category_name"
                                        id="category_name" data-np-checked="1">

                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn-cancel rounded f-14 p-2 border-0 mr-3" data-dismiss="modal">
                        Close
                    </a>
                    <button type="button" class="btn-primary rounded f-14 p-2" id="save-category">
                        <i class="bi bi-save-fill"></i>
                        Save
                    </button>


                </div>

                <script>
                    $(document).ready(function() {
                        $('.delete-category').click(function() {

                            var catId = $(this).data('cat-id');
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
                                        url: '<?=ROOT;?>/task/create?taskCategory=delete',
                                        data: {
                                            'catId': catId

                                        },
                                        success: function(response) {
                                            console.log(response);
                                            if (response.status == 'success') {

                                                $('#category_model tr[data-tr-id="' +
                                                    catId +
                                                    '"]').remove();
                                                $('#task_category option[value="' +
                                                    catId + '"]').remove();
                                                $('#task_category').selectpicker(
                                                    'refresh');

                                            }
                                        }
                                    });
                                }
                            });

                        });

                        $('#save-category').click(function() {
                            $.ajax({
                                url: '<?=ROOT;?>/task/create?taskCategory=add',
                                container: '#createTaskCategory',
                                type: "POST",
                                disableButton: true,
                                blockUI: true,
                                buttonSelector: "#save-category",
                                data: $('#createTaskCategory').serialize(),
                                success: function(response) {
                                    console.log(response);
                                    if (response.status == 'success') {
                                        $('#category_name').val('');
                                        var ole = $('#task_category')
                                        ole.append('<option value="' + response.catId +
                                            '">' + response
                                            .catName +
                                            '</option>');
                                        $('#task_category').selectpicker('refresh');
                                        $('#category_model').append(
                                            ` <tr>
                                <td> ` + response.catId + `
                                </td>
                                <td data-row-id="` + response.catId + `"
                                    contenteditable="true">` + response.catName + `
                                </td>
                                <td class="text-right">
                                    <button type="button" class="btn-secondary rounded f-14 p-2 delete-category"
                                        data-cat-id="` + response.catId + `">
                                        <i class="bi bi-trash-fill mr-2"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                                        `
                                        )

                                    }
                                }
                            })
                        });

                        $('[contenteditable=true]').focus(function() {
                            $(this).data("initialText", $(this).html());
                            let rowId = $(this).data('row-id');
                        }).blur(function() {
                            if ($(this).data("initialText") !== $(this).html()) {
                                let id = $(this).data('row-id');
                                let value = $(this).html();

                                $.ajax({
                                    url: '<?=ROOT;?>/task/create?taskCategory=edit',
                                    container: '#row-' + id,
                                    type: "POST",
                                    data: {
                                        'category_name': value,
                                        'id': id
                                    },
                                    blockUI: true,
                                    success: function(response) {

                                        if (response.status == 'success') {

                                            var ole = $('#task_category option[value=' +
                                                id + ']')
                                            ole.text(value);
                                            $('#task_category').selectpicker('refresh');

                                        }
                                    }
                                })
                            }
                        });


                    });
                </script>
            </div>
        </div>
    </div>
</div>
<?php require_once("views/layout/header.php"); ?>
<?php require_once("views/layout/navbar.php"); ?>
<section class="main-container bg-additional-grey" id="fullscreen">

    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <form method="POST" id="project-form"
                    action="<?=ROOT;?>/addproject" autocomplete="off"
                    data-np-checked="1" data-np-autofill-type="other" data-np-watching="1">
                    <div class="add-client bg-white rounded">
                        <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                            <?=PROJECT_DETAILS;?>
                        </h4>

                        <div class="row p-20">
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group my-3 mr-0 mr-lg-2 mr-md-2">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true"
                                        for="project_name"><?=PROJECT_NAME;?>
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>
                                    <input type="text" class="form-control height-35 f-14"
                                        placeholder="Write a project name"
                                        value="<?=$project['project_name'];?>"
                                        name="project_name" id="project_name" autocomplete="off" data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group my-3" style="position: relative;">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true"
                                        for="start_date"><?=PROJECT_START_DATE;?>
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>
                                    <input type="date" class="form-control  date-picker height-35 f-14"
                                        placeholder="Select Date"
                                        value="<?=$project['start_date'];?>"
                                        name="start_date" id="start_date" autocomplete="off" data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3" id="deadlineBox">
                                <div class="form-group my-3" style="position: relative;">
                                    <label class="f-14 text-dark-grey mb-12" data-label="true"
                                        for="deadline"><?=G_DEADLINE;?>
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>
                                    <input type="date" class="form-control  date-picker height-35 f-14"
                                        placeholder="Select Date"
                                        value="<?=$project['deadline'];?>"
                                        name="deadline" id="deadline" autocomplete="off" data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="f-14 text-dark-grey mb-12 my-3" data-label=""
                                    for="category_id"><?=PROJECT_CATEGORY;?>
                                    <sup class="f-14 mr-1">*</sup>
                                </label>
                                <div class="input-group">
                                    <select class="form-control selectpicker" data-live-search="true"
                                        title="Choose Category" data-size="8" name="category_id"
                                        id="project_category_id">

                                        <?php foreach($projectCategory as $category): ?>
                                        <option
                                            value="<?=$category['id'];?>"
                                            <?php if($category['id'] == $project['category_id']) {
                                                echo "selected";
                                            }?>>
                                            <?=$category['category_name'];?>
                                        </option>
                                        <?php endforeach; ?>

                                    </select>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary border-grey"
                                            data-toggle="modal" data-target="#myModal">
                                            <?=G_ADD;?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="f-14 text-dark-grey mb-12 my-3" data-label=""
                                    for="department"><?=G_DEPARTMENT;?>
                                    <sup class="f-14 mr-1">*</sup>
                                </label>
                                <div class="input-group">
                                    <select class="form-control selectpicker show-tick" data-size="4"
                                        data-live-search="true" name="team_id[]" id="department_list_id"
                                        title="Search Departments" multiple>
                                        <?php foreach($departments as $department):?>
                                        <option
                                            value="<?=$department['id'];?>">
                                            <?=$department['team_name'];?>
                                        </option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <label class="f-14 text-dark-grey mb-12 my-3" data-label="false"
                                    for="client_id"><?=G_CLIENT;?>
                                    <sup class="f-14 mr-1">*</sup>
                                </label>
                                <div class="input-group">
                                    <select class="form-control selectpicker show-tick" data-size="4"
                                        data-live-search="true" title="Choose Client" name="client_id"
                                        id="client_list_id">
                                        <?php foreach($clients as $client):?>
                                        <option
                                            value="<?=$client['client_id'];?>"
                                            <?php if($client['client_id'] == $project['client_id']) {
                                                echo "selected";
                                            }?>>
                                            <?=$client['name'];?>
                                        </option>
                                        <?php endforeach; ?>

                                    </select>
                                    <div class="input-group-append">
                                        <a href="<?=ROOT;?>/addclient"
                                            class="btn btn-outline-secondary border-grey">
                                            <?=G_ADD;?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12 my-3" data-label=""
                                        for="project_summary"><?=PROJECT_SUMMARY;?>
                                        <sup class="f-14 mr-1">*</sup>
                                    </label>
                                    <textarea name="project_summary" id="editor"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12 my-3" data-label=""
                                        for="notes"><?=G_NOTES;?>
                                    </label>
                                    <textarea name="notes" id="editor2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 border-top-grey d-block d-lg-flex d-md-flex justify-content-start px-4 py-3">
                            <button name="submit" type="button" class="btn-primary rounded f-14 p-2 mr-3"
                                id="save-project-form">
                                <i class="bi bi-save2-fill mr-2"></i>
                                <?=G_SAVE;?>
                            </button>
                            <a href="<?=ROOT?>/project"
                                class="btn-cancel rounded f-14 p-2 border-0">
                                <?=G_CANCEL;?>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require_once("views/layout/footer.php");?>

<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading">
                    <?=PROJECT_CATEGORY;?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <table id="example" class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th><?=G_CATEGORY_NAME;?></th>
                            <th class="text-right"><?=G_ACTION;?>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="category_model">
                        <?php foreach($projectCategory as $category):?>
                        <tr
                            id="row-<?=$category['id'];?>">
                            <td><?=$category['id'];?>
                            </td>
                            <td data-row-id="<?=$category['id'];?>"
                                contenteditable="true">
                                <?=$category['category_name'];?>
                            </td>
                            <td class="text-right">
                                <button type="button" class="btn-secondary rounded f-14 p-2 delete-category"
                                    data-row-id="<?=$category['id'];?>">
                                    <i class="bi bi-trash-fill mr-2"></i>
                                    <?=G_DELETE;?>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <form method="POST" id="createProjectCategory" autocomplete="off" data-np-autofill-type="register"
                    data-np-checked="1" data-np-watching="1">
                    <div class="row border-top-grey ">
                        <div class="col-sm-12">
                            <div class="form-group my-3">
                                <label class="f-14 text-dark-grey mb-12" data-label="true"
                                    for="category_name"><?=G_CATEGORY_NAME;?>
                                    <sup class="f-14 mr-1">*</sup>
                                </label>
                                <input type="text" class="form-control height-35 f-14"
                                    placeholder="Enter a category name" value="" name="category_name"
                                    id="category_name">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn-cancel rounded f-14 p-2 border-0 mr-3" data-dismiss="modal">
                    <?=G_CANCEL;?>
                </a>
                <button type="button" class="btn-primary rounded f-14 p-2" id="save-category">
                    <i class="bi bi-save2-fill mr-2"></i>
                    <?=G_SAVE;?>
                </button>
            </div>
            <script>
                $('body').on('click', '.delete-category', function(event) {
                    event.preventDefault();

                    var catId = $(this).data('row-id');
                    Swal.fire({
                        title: "<?=SWAL_TITLE_DELETE;?>",
                        text: "You will not be able to recover the deleted record!",
                        icon: 'warning',
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText: "<?=SWAL_CONFIRM_DELETE;?>",
                        cancelButtonText: "<?=G_CANCEL;?>",
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
                                url: '<?=ROOT;?>/project/create?projectCategory=delete',
                                data: {
                                    'catId': catId

                                },
                                success: function(response) {
                                    console.log(response);
                                    if (response.status == 'success') {

                                        $('tr[id="row-' + catId + '"]').remove();
                                        $('#project_category_id option[value="' +
                                            catId + '"]').remove();
                                        $('#project_category_id').selectpicker(
                                            'refresh');

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


                $('body').on('click', '#save-category', function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: '<?=ROOT;?>/addproject/0?projectCategory=add',
                        container: '#createProjectCategory',
                        type: "POST",
                        disableButton: true,
                        blockUI: true,
                        buttonSelector: "#save-category",
                        data: $('#createProjectCategory').serialize(),
                        success: function(response) {
                            console.log(response);
                            if (response.status == 'success') {
                                $('#department_name').val('');
                                var ole = $('#project_category_id')
                                ole.append('<option value="' + response.catId +
                                    '">' + response
                                    .catName +
                                    '</option>');
                                $('#project_category_id').selectpicker('refresh');
                                $('#category_model').append(
                                    ` <tr id="row-` + response.catId + `">
                                <td> ` + response.catId + `
                                </td>
                                <td data-row-id="` + response.catId + `"
                                    contenteditable="true">` + response.catName + `
                                </td>
                                <td class="text-right">
                                    <button type="button" class="btn-secondary rounded f-14 p-2 delete-category"
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
                            url: '<?=ROOT;?>/project/create?projectCategory=edit',
                            container: '#row-' + id,
                            type: "POST",
                            data: {
                                'category_name': value,
                                'id': id
                            },
                            blockUI: true,
                            success: function(response) {

                                if (response.status == 'success') {

                                    var ole = $('#project_category_id option[value=' +
                                        id + ']')
                                    ole.text(value);
                                    $('#project_category_id').selectpicker('refresh');

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
<script>
    var
        selectedDepartments = <?php echo json_encode($teams); ?> ;
    $('#department_list_id').selectpicker('val', selectedDepartments);

    let project_description;
    let notes;
    ClassicEditor
        .create(document.querySelector('#editor'), {
            language: '<?=LANG_ISO;?>'
        }).then(editor => {
            project_description = editor;
            project_description.setData(
                `<?=$project['project_summary'];?>`
            );


        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#editor2'), {
            language: "<?=LANG_ISO;?>"
        }).then(editor => {
            notes = editor;
            notes.setData(
                `<?=$project['notes'];?>`
            );

        })
        .catch(error => {
            console.error(error);
        });

    $('#save-project-form').click(function(event) {
        event.preventDefault();
        var form = $('#project-form');
        if (form[0].checkValidity()) {
            var formData = new FormData(form[0]);
            formData.append('project_description', project_description.getData());
            formData.append('notes', notes.getData());

            $.ajax({
                url: '<?=ROOT;?>/project/<?=$id;?>?submit&edit',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
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
                                    '<?=ROOT;?>/project/' +
                                    response.id;
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
</script>
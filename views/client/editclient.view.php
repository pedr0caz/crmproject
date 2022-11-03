<?php require_once("views/layout/header.php"); ?>
<?php require_once("views/layout/navbar.php"); ?>

<section class="main-container bg-additional-grey" id="fullscreen">

    <!-- PAGE TITLE END -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <form method="POST" id="save-client-data-form" autocomplete="off" data-np-checked="1"
                    data-np-autofill-type="other" data-np-watching="1">

                    <div class="add-client bg-white rounded">
                        <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                            <?=CLIENTS_ADD;?>
                        </h4>
                        <div class="row p-20">
                            <div class="col-lg-9 col-xl-10">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group my-3">
                                            <label class="f-14 text-dark-grey mb-12" data-label="true" for="name">
                                                <?=G_NAME;?>
                                                <sup class="f-14 mr-1">*</sup>
                                            </label>
                                            <input type="text" class="form-control height-35 f-14"
                                                placeholder="e.g. John Doe"
                                                value="<?=$client['name'];?>"
                                                name="name" id="name" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group my-3">
                                            <label class="f-14 text-dark-grey mb-12" data-label="" for="email">
                                                <?=G_EMAIL;?>
                                                <i class="bi bi-question-circle-fill f-14 text-dark-grey ml-1"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="<?=CLIENT_EMAIL?>"></i>
                                            </label>
                                            <input type="email" autocomplete="off" class="form-control height-35 f-14"
                                                placeholder="e.g. johndoe@example.com"
                                                value="<?=$client['email'];?>"
                                                name="email" id="email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="f-14 text-dark-grey mb-12 mt-3" data-label="" for="password">
                                            <?=G_PASSWORD;?>
                                            <i class="bi bi-question-circle-fill f-14 text-dark-grey ml-1"
                                                data-toggle="tooltip" data-placement="top" title="Field required"></i>
                                        </label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="password"
                                                class="form-control height-35 f-14" autocomplete="off"
                                                data-np-checked="1">
                                            <div class="input-group-append">
                                                <button type="button" data-toggle="tooltip"
                                                    data-original-title="Show/Hide Value"
                                                    class="btn btn-outline-secondary border-grey height-35 toggle-password">
                                                    <i class="bi bi-eye-slash"></i>
                                                    <!-- <i class="fa fa-eye"></i> Font Awesome fontawesome.com -->
                                                </button>
                                            </div>
                                            <div class="input-group-append">
                                                <button id="random_password" type="button" data-toggle="tooltip"
                                                    data-original-title="<?=G_GENERATE_PASSWORD;?>"
                                                    class="btn btn-outline-secondary border-grey height-35">
                                                    <i class="bi bi-shuffle font-weight-bolder"></i>
                                                    <!-- <i class="fa fa-random"></i> Font Awesome fontawesome.com -->
                                                </button>
                                            </div>
                                        </div>
                                        <small
                                            class="form-text text-muted"><?=G_PASSWORD_LEAVE_BLANK;?></small>
                                        <small
                                            class="form-text text-muted"><?=G_PASSWORD_LENGTH;?></small>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="f-14 text-dark-grey mb-12 mt-3" data-label=""
                                            for="country"><?=G_COUNTRY;?>
                                            <sup class="f-14 mr-1">*</sup>
                                        </label>
                                        <div class="form-group mb-0">
                                            <select name="country_id" id="country_name"
                                                class="form-control selectpicker height-35 f-14" data-live-search="true"
                                                data-size="5" required title="Choose country">

                                                <?php foreach($countries as $country): ?>

                                                <option
                                                    value="<?php echo $country['id']; ?>">
                                                    <?php echo $country['nicename']; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group my-3">
                                            <label class="f-14 text-dark-grey mb-12" data-label=""
                                                for="mobile"><?=G_MOBILE;?>
                                            </label>
                                            <input type="tel" class="form-control height-35 f-14"
                                                placeholder="e.g. 987654321"
                                                value="<?=$client['mobile'];?>"
                                                name="mobile" id="mobile" autocomplete="off" data-np-checked="1">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="f-14 text-dark-grey mb-12 mt-3" data-label=""
                                            for="gender"><?=G_GENDER;?>
                                            <sup class="f-14 mr-1">*</sup>
                                        </label>
                                        <div class="input-group">

                                            <select name="gender" class="form-control  selectpicker  height-35 f-14"
                                                id="gender" required>


                                                <option value="male" <?=$user['gender'] == 'male' ?: 'selected';?>>
                                                    <?=G_GENDER_MALE;?>
                                                </option>
                                                <option value="female" <?=$user['gender'] == 'female' ?: 'selected';?>>
                                                    <?=G_GENDER_FEMALE;?>
                                                </option>
                                                <option value="other" <?=$user['gender'] == 'other' ?: 'selected';?>>
                                                    <?=G_GENDER_OTHER;?>
                                                </option>
                                            </select>



                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-3 col-xl-2">
                                <div class="form-group my-3 mr-0 mr-lg-2 mr-md-2 cropper">
                                    <label class="f-14 text-dark-grey mb-12" data-label="" for="image">
                                        <?=G_PROFILE_PICTURE;?>
                                        <i class="bi bi-question-circle-fill f-14 text-dark-grey ml-1"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Profile picture of the client"></i>
                                        <!-- <i class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-content="only .jpg, .jpeg, .png formats are allowed." data-html="true" data-trigger="hover" data-original-title="" title=""></i> Font Awesome fontawesome.com -->
                                    </label>
                                    <input type="file" id="input-file-now-custom-2" class="dropify" data-height="131"
                                        data-allowed-file-extensions="gif png jpg jpeg"
                                        <?=$client['image'] ? 'data-default-file="'.ROOT.'/'.$client['image'].'"': null;?>/>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="f-14 text-dark-grey mb-12 mt-3" data-label=""
                                    for="category"><?=CLIENT_CATEGORY;?>
                                </label>
                                <div class="input-group">

                                    <select name="category_id" class="form-control selectpicker" id="client_category"
                                        data-live-search="true" data-size="4" title="Choose Category">

                                        <?php foreach($clientCategories as $designation): ?>
                                        <option
                                            value="<?=$designation['id']?>">
                                            <?=$designation['name']?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>


                                    <div class="input-group-append">
                                        <button id="designation-setting-add" type="button"
                                            class="btn btn-outline-secondary border-grey" data-toggle="modal"
                                            data-target="#myModal2"><?=G_ADD;?></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3 ml-2">
                            <div class="form-group my-3">
                                <label class="f-14 text-dark-grey mb-12 w-100"
                                    for="usr"><?=G_USER_LOGIN_ALLOW;?></label>
                                <div class="d-flex">
                                    <div class="form-check-inline custom-control custom-radio mt-2 mr-3">
                                        <input type="radio" value="enable" class="custom-control-input" id="login-yes"
                                            name="login" autocomplete="off"
                                            <?=$client['login'] == 'enable' ? 'checked=""' : '';?>
                                        data-np-invisible="1" data-np-checked="1">
                                        <label class="custom-control-label pt-1 cursor-pointer"
                                            for="login-yes"><?=G_YES;?></label>
                                    </div>
                                    <div class="form-check-inline custom-control custom-radio mt-2 mr-3">
                                        <input type="radio" value="disable" class="custom-control-input" id="login-no"
                                            name="login"
                                            <?=$client['login'] == 'disable' ? 'checked=""' : '';?>
                                        autocomplete="off" data-np-invisible="1"
                                        data-np-checked="1">
                                        <label class="custom-control-label pt-1 cursor-pointer"
                                            for="login-no"><?=G_NO;?></label>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-top-grey">
                            <?=CLIENT_COMPANY_DETAILS;?>
                        </h4>
                        <div class="row p-20">
                            <div class="col-md-4">
                                <div class="form-group my-3 mb-3 mt-3 mt-lg-0 mt-md-0">
                                    <label class="f-14 text-dark-grey mb-12" data-label=""
                                        for="company_name"><?=CLIENT_COMPANY_NAME;?>
                                    </label>
                                    <input type="text" class="form-control height-35 f-14"
                                        placeholder="e.g. Acme Corporation"
                                        value="<?=$client['company_name'];?>"
                                        name="company_name" id="company_name" autocomplete="off" data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group my-3 mb-3 mt-3 mt-lg-0 mt-md-0">
                                    <label class="f-14 text-dark-grey mb-12" data-label=""
                                        for="website"><?=G_WEBSITE;?>
                                    </label>
                                    <input type="text" class="form-control height-35 f-14"
                                        placeholder="e.g. https://www.spacex.com/"
                                        value="<?=$client['website'];?>"
                                        name="website" id="website" autocomplete="off" data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group my-3 mb-3 mt-3 mt-lg-0 mt-md-0">
                                    <label class="f-14 text-dark-grey mb-12" data-label=""
                                        for="gst_number"><?=CLIENT_COMPANY_VAT;?>
                                    </label>
                                    <input type="text" class="form-control height-35 f-14"
                                        placeholder="e.g. 18AABCU960XXXXX"
                                        value="<?=$client['gst_number'];?>"
                                        name="gst_number" id="gst_number" autocomplete="off" data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label=""
                                        for="office"><?=CLIENT_OFFICE_NUMBER;?>
                                    </label>
                                    <input type="text" class="form-control height-35 f-14" placeholder="e.g. +19876543"
                                        value="<?=$client['office'];?>"
                                        name="office" id="office" autocomplete="off" data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label=""
                                        for="city"><?=G_CITY;?>
                                    </label>
                                    <input type="text" class="form-control height-35 f-14" placeholder="e.g. Hawthorne"
                                        value="<?=$client['city'];?>"
                                        name="city" id="city" autocomplete="off" data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label=""
                                        for="state"><?=G_STATE;?>
                                    </label>
                                    <input type="text" class="form-control height-35 f-14" placeholder="e.g. California"
                                        value="<?=$client['state'];?>"
                                        name="state" id="state" autocomplete="off" data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12" data-label=""
                                        for="postalCode"><?=G_ZIP;?>
                                    </label>
                                    <input type="text" class="form-control height-35 f-14" placeholder="e.g. 90250"
                                        value="<?=$client['postal_code'];?>"
                                        name="postal_code" id="postalCode" autocomplete="off" data-np-checked="1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group my-3">
                                    <div class="form-group my-3 mr-0 mr-lg-2 mr-md-2">
                                        <label class="f-14 text-dark-grey mb-12" data-label=""
                                            for="address"><?=CLIENT_COMPANY_ADDRESS;?>
                                        </label>
                                        <textarea class="form-control f-14 pt-2" rows="3" placeholder="e.g. Rocket Road"
                                            name="address"
                                            id="address"><?=$client['address'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group my-3">
                                    <div class="form-group my-3 mr-0 mr-lg-2 mr-md-2">
                                        <label class="f-14 text-dark-grey mb-12" data-label=""
                                            for="shipping_address"><?=CLIENT_COMPANY_SHIPPING_ADDRESS;?>
                                        </label>
                                        <textarea class="form-control f-14 pt-2" rows="3" placeholder="e.g. Rocket Road"
                                            name="shipping_address"
                                            id="shipping_address"><?=$client['shipping_address'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12 my-3" data-label=""
                                        for="note"><?=G_NOTE;?>
                                    </label>


                                    <textarea name="note" id="editor"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 border-top-grey d-block d-lg-flex d-md-flex justify-content-start px-4 py-3">
                            <button type="button" class="btn-primary rounded f-14 p-2 mr-3" id="save-client-form">
                                <i class="bi bi-save mr-1"></i>

                                <?=G_SAVE;?>
                            </button>

                            <a href="" class="btn-cancel rounded f-14 p-2 border-0">
                                <?=G_CANCEL;?>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                var
                    country_id = <?php echo json_encode($client['country_id']); ?> ;
                var
                    gender = <?php echo json_encode($client['gender']); ?> ;
                var
                    category_id = <?php echo json_encode($client['category_id']); ?> ;

                $('#country_name').selectpicker('val', country_id);
                $('#gender').selectpicker('val', gender);
                $('#client_category').selectpicker('val', category_id);
                $('.selectpicker').selectpicker('refresh');
                let editor;
                ClassicEditor
                    .create(document.querySelector('#editor')).then((newEditor) => {
                        editor = newEditor;
                        editor.setData(
                            `<?=$client['note'];?>`
                        );
                    })
                    .catch(error => {
                        console.error(error);
                    });

                $('.dropify').dropify({
                    messages: {
                        'default': 'Choose a file',
                        'replace': 'Drag and drop or click to replace',
                        'remove': 'Remove',
                        'error': 'Ooops, something wrong happended.'
                    }
                });



                $('#save-client-form').click(function() {
                    var form = $('#save-client-data-form');
                    let note = editor.getData();
                    var formData = new FormData(form[0]);
                    formData.append('note', note);
                    if (form[0].checkValidity()) {
                        $.ajax({
                            url: '<?=ROOT;?>/client/<?=$id;?>?edit&submit',
                            container: '#save-client-data-form',
                            type: "POST",
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
                                                "<?=ROOT;?>/client/" +
                                                response.id;
                                        }
                                    })
                                } else if (response.status == "error") {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Fill all the fields!',
                                        confirmButtonText: 'Ok'
                                    })
                                }
                            }
                        })
                    } else {
                        form[0].reportValidity();
                    }
                });

                $('#random_password').click(function() {
                    var chars =
                        "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
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
                        classTogle.html(`<i class="bi bi-eye" style="font-size: 16px;"></i>`);
                    } else {
                        password.attr('type', 'password');
                        classTogle.html(`<i class="bi bi-eye-slash" style="font-size: 16px;"></i>`);
                    }
                });



            });
        </script>
    </div>
</section>

<?php require_once("views/layout/footer.php");
?>
<div class="modal" id="myModal2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading">
                    <?=CLIENT_CATEGORY;?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <table id="example" class="table table-bordered client-cat-table">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th><?=G_CATEGORY_NAME;?></th>
                            <th class="text-right"><?=G_ACTION;?>
                        </tr>
                    </thead>
                    <tbody id="category_model">
                        <?php foreach($clientCategories as $categories): ?>
                        <tr
                            id="row-<?=$categories['id'];?>">
                            <td><?=$categories['id'];?>
                            </td>
                            <td data-row-id="<?=$categories['id'];?>"
                                contenteditable="true">
                                <?=$categories['name'];?>
                            </td>
                            <td class="text-right">
                                <button type="button" class="btn-secondary rounded f-14 p-2 delete-category"
                                    data-row-id="<?=$categories['id'];?>">
                                    <i class="bi bi-trash mr-1"></i>
                                    <?=G_DELETE;?>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <form method="POST" id="createProjectCategory" autocomplete="off" data-np-checked="1"
                    data-np-autofill-type="other" data-np-watching="1">

                    <div class="row border-top-grey ">
                        <div class="col-sm-12">
                            <div class="form-group my-3">
                                <label class="f-14 text-dark-grey mb-12" data-label="true"
                                    for="category_name"><?=G_CATEGORY_NAME;?>
                                    <sup class="f-14 mr-1">*</sup>
                                </label>
                                <input type="text" class="form-control height-35 f-14"
                                    placeholder="e.g. Potential Client" value="" name="category_name" id="category_name"
                                    data-np-checked="1">
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
                    <i class="bi bi-save mr-1"></i>

                    <?=G_SAVE;?>
                </button>

            </div>
            <script>
                $('body').on('click', '#myModal2 .delete-category', function(event) {
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
                                url: '<?=ROOT;?>/client/create?clientCategory=delete',
                                data: {
                                    'catId': catId

                                },
                                success: function(response) {
                                    console.log(response);
                                    if (response.status == 'success') {

                                        $('tr[id="row-' + catId + '"]').remove();
                                        $('#client_category option[value="' +
                                            catId + '"]').remove();
                                        $('#client_category').selectpicker(
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


                $('body').on('click', '#save-category', function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: '<?=ROOT;?>/client/create?clientCategory=add',
                        container: '#createProjectCategory',
                        type: "POST",
                        disableButton: true,
                        blockUI: true,
                        buttonSelector: "#save-category",
                        data: $('#createProjectCategory').serialize(),
                        success: function(response) {
                            console.log(response);
                            if (response.status == 'success') {
                                $('#category_name').val('');
                                var ole = $('#client_category')
                                ole.append('<option value="' + response.catId +
                                    '">' + response
                                    .catName +
                                    '</option>');
                                $('#client_category').selectpicker('refresh');
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
                                    <i class="bi bi-trash mr-1"></i>
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
                            url: '<?=ROOT;?>/client/create?clientCategory=edit',
                            container: '#row-' + id,
                            type: "POST",
                            data: {
                                'category_name': value,
                                'id': id
                            },
                            blockUI: true,
                            success: function(response) {
                                if (response.status == 'success') {

                                    var ole = $('#client_category option[value=' +
                                        id + ']')
                                    ole.text(value);
                                    $('#client_category').selectpicker('refresh');

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
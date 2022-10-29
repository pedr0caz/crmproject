<?php require_once("views/layout/header.php"); ?>
<?php require_once("views/layout/navbar.php"); ?>

<section class="main-container bg-additional-grey" id="fullscreen">

    <!-- PAGE TITLE END -->
    <!-- CONTENT WRAPPER START -->
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-block d-lg-flex d-md-flex justify-content-between action-bar dd">
            <div id="table-actions" class="flex-grow-1 align-items-center">
                <a href="<?=ROOT;?>/client/create"
                    class="btn-primary rounded f-14 p-2 mr-3 openRightModal float-left mb-2 mb-lg-0 mb-md-0">
                    <i class="bi bi-plus-circle" style="font-size:16px;"></i>
                    <!-- <i class="fa fa-plus mr-1"></i> Font Awesome fontawesome.com -->
                    Add Client
                </a>
                <a href="<?=ROOT;?>/client/import"
                    class="btn-secondary rounded f-14 p-2 mr-3 float-left mb-2 mb-lg-0 mb-md-0">
                    <i class="bi bi-upload" style="font-size:16px;"></i>

                    Import
                </a>

            </div>


        </div>
        <!-- Add Task Export Buttons End -->
        <!-- Task Box Start -->
        <div class="d-flex flex-column w-tables rounded mt-3 bg-white">
            <div id="clients-table_wrapper" class="">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover border-0 w-100 " id="clients-table" role="grid"
                            aria-describedby="clients-table_info" style="width: 1587px;">
                            <thead>
                                <tr role="row">

                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($clients as $client) {
                                    ?>

                                <tr>

                                    <td><?=$client['client_id'];?>
                                    </td>
                                    <td>
                                        <div class="media align-items-center mw-250">
                                            <a href="<?=ROOT;?>/client/<?=$client['client_id'];?>"
                                                class="position-relative">
                                                <img src="<?php if ($client['image']) {
                                                    echo ROOT."/".$client['image'];
                                                } else {
                                                    echo 'https://www.gravatar.com/avatar/a456ed61bc3c5d05f3ad79d85069098a.png?s=200&d=mp';
                                                }?>" class="mr-2 taskEmployeeImg rounded-circle"
                                                    alt="<?=$client['name'];?>"
                                                    title="<?=$client['name'];?>">
                                            </a>
                                            <div class="media-body">
                                                <h5 class="mb-0 f-12"><a
                                                        href="<?=ROOT;?>/client/<?=$client['client_id'];?>"
                                                        class="text-darkest-grey"><?=$client['name'];?></a>
                                                </h5>
                                                <p class="mb-0 f-12 text-dark-grey">
                                                    <?=$client['company_name'];?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?=$client['email'];?>
                                    </td>
                                    <td> <?php if ($client['status'] == "active") {
                                        echo '<span class="badge badge-success">Active</span>';
                                    } else {
                                        echo '<span class="badge badge-danger">Inactive</span>';
                                    }?>
                                    </td>
                                    <td><?=$client['created_at'];?>
                                    </td>
                                    <td class=" text-right pr-20">
                                        <div class="task_view">

                                            <div class="dropdown">
                                                <a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle"
                                                    type="link" id="dropdownMenuLink-5" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-options-vertical icons"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="dropdownMenuLink-5" tabindex="0"><a
                                                        href="<?=ROOT;?>/client/<?=$client['client_id'];?>"
                                                        class="dropdown-item">
                                                        <i class="bi bi-eye-fill mr-1"></i>
                                                        View</a><a class="dropdown-item openRightModal"
                                                        href="<?=ROOT;?>/client/<?=$client['client_id'];?>?edit">
                                                        <i class="bi bi-pencil-fill mr-1"></i>
                                                        <!-- <i class="fa fa-edit mr-2"></i> Font Awesome fontawesome.com -->
                                                        Edit
                                                    </a><a class="dropdown-item delete-table-row" href="javascript:;"
                                                        data-user-id="<?=$client['user_id'];?>"
                                                        data-client-id="<?=$client['client_id'];?>">
                                                        <i class="bi bi-trash-fill mr-1"></i>
                                                        <!-- <i class="fa fa-trash mr-2"></i> Font Awesome fontawesome.com -->
                                                        Delete
                                                    </a></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>

</section>

<?php require_once("views/layout/footer.php");
?>

<script>
    $(document).ready(function() {
        $('#clients-table').DataTable();

        $('body').on('click', '.delete-table-row', function() {
            var user_id = $(this).data('user-id');
            var client_id = $(this).data('client-id');
            var row = $(this).closest('tr');
            var table = $('#clients-table').DataTable();
            var url =
                '<?=ROOT;?>/client/' + client_id + '?delete';
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            client_id: client_id,
                            user_id: user_id
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.status == 'success') {
                                console.log('success');
                                table.row(row).remove().draw();
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Client has been deleted.',
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                })
                            } else {
                                console.log('error');
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Something went wrong.',
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                })
                            }
                        }
                    });
                }
            });
        });
    });
</script>
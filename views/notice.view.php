<?php require_once("layout/header.php"); ?>
<?php require_once("layout/navbar.php"); ?>
<section class="main-container bg-additional-grey" id="fullscreen">

    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <?php if ($_SESSION["user_role"] == "1") : ?>
        <div class="d-flex justify-content-between action-bar">
            <div id="table-actions" class="flex-grow-1 align-items-center mt-3">
                <a href="<?=ROOT;?>/notice/create"
                    class="btn-primary rounded f-14 p-2 mr-3 openRightModal float-left">
                    <i class="bi bi-plus-lg"></i>
                    Add New Notice
                </a>
            </div>
        </div>
        <?php endif; ?>
        <div class="d-flex flex-column w-tables rounded mt-3 bg-white">
            <div id="notice-board-table_wrapper" class="">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover border-0 w-100 " id="notice-board-table" role="grid"
                            aria-describedby="notice-board-table_info">
                            <thead>
                                <tr role="row">

                                    <th>Notice</th>
                                    <th>Date
                                    </th>
                                    <th>To</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($notices as $notice) : ?>
                                <tr id="row-1">
                                    <td><a class=" text-darkest-grey"
                                            href="<?=ROOT;?>/notice/<?=$notice['id'];?>"><?=$notice['heading'];?></a>
                                    </td>
                                    <td>
                                        <?=$notice['created_at'];?>
                                    </td>
                                    <td><?php   if ($notice['toGroup'] == 2) {
                                        echo $notice['team_name'] ? $notice['team_name'] : $notice['display_name'];
                                    } else {
                                        echo "Client";
                                    }?></td>
                                    <td>
                                        <div class="task_view">
                                            <div class="dropdown">
                                                <a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle"
                                                    type="link" id="dropdownMenuLink-1" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-options-vertical icons"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="dropdownMenuLink-1" tabindex="0">
                                                    <a href="<?=ROOT;?>/notice/<?=$notice['id'];?>"
                                                        class="dropdown-item openRightModal">
                                                        <i class="bi bi-eye-fill mr-2"></i>
                                                        View
                                                    </a>
                                                    <?php if($_SESSION['user_role'] == 1): ?>
                                                    <a class="dropdown-item openRightModal"
                                                        href="<?=ROOT;?>/notice/<?=$notice['id'];?>?edit">
                                                        <i class="bi bi-pencil-fill mr-2"></i>
                                                        Edit
                                                    </a>
                                                    <a class="dropdown-item delete-table-row" href="javascript:;"
                                                        data-notice-id="<?=$notice['id'];?>">
                                                        <i class="bi bi-trash-fill mr-2"></i>
                                                        Delete
                                                    </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Task Box End -->
    </div>
    <!-- CONTENT WRAPPER END -->
</section>
<?php require_once("layout/footer.php");
?>

<script>
    $(document).ready(function() {
        $('#notice-board-table').DataTable({
            "order": [
                [1, "desc"]
            ]
        });

        $('.delete-table-row').click(function() {
            var noticeId = $(this).data('notice-id');
            var url = "<?=ROOT;?>/notice/" + noticeId +
                "?delete";
            var data = {
                id: noticeId
            };
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
                        data: data,
                        success: function(response) {
                            if (response.status == "success") {
                                Swal.fire(
                                    'Deleted!',
                                    'Your Notice has been deleted.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            }
                        }
                    });
                }
            });


        });

    });
</script>
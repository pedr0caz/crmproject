<?php require_once("layout/header.php"); ?>
<?php require_once("layout/navbar.php"); ?>

<section class="main-container bg-additional-grey" id="fullscreen">

    <div class="preloader-container justify-content-center align-items-center" style="display: none;">
        <div class="spinner-border" role="status" aria-hidden="true"></div>
    </div>




    <!-- CONTENT WRAPPER START -->
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-block d-lg-flex d-md-flex justify-content-between action-bar">
            <div id="table-actions" class="flex-grow-1 align-items-center mb-2 mb-lg-0 mb-md-0">
                <a href="<?=ROOT?>/addproject"
                    class="btn-primary rounded f-14 p-2 mr-3 openRightModal float-left mb-2 mb-lg-0 mb-md-0">
                    <i class="bi bi-plus-circle"></i> Add Project
                    Add Project
                </a>



                <a href="<?=ROOT;?>/project/import"
                    class="btn-secondary rounded f-14 p-2 mr-3 float-left mb-2 mb-lg-0 mb-md-0">
                    <i class="bi bi-upload"></i> Import
                    Import
                </a>


            </div>



        </div>
        <!-- Add Task Export Buttons End -->
        <!-- Task Box Start -->
        <div class="d-flex flex-column w-tables rounded mt-3 bg-white">

            <div id="projects-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover border-0 w-100 dataTable no-footer" id="projects-table"
                            role="grid" aria-describedby="projects-table_info" style="width: 1587px;">
                            <thead>
                                <tr role="row">

                                    <th>Id</th>
                                    <th>Project Name</th>
                                    <th>Members</th>
                                    <th>Deadline</th>
                                    <th>Client</th>
                                    <th>Progress</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   
                                         foreach ($projects as $project) { ?>
                                <tr id="row-1" role="row" class="odd">

                                    <td class="sorting_1">
                                        <?=$project['project_id']?>
                                    </td>
                                    <td>
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <h5 class="mb-0 f-13 text-darkest-grey"><a
                                                        href="<?=ROOT?>/projectdetails/<?=$project['project_id']?>"><?=$project['project_name']?></a>
                                                </h5>
                                                <p class="mb-0"></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="position-relative">
                                            <?php
                                            $left = 0;
                                             foreach($employeeModel->getMembersOfProject($project['project_id']) as $member):
                                                 $left = $left + 13;
                                                 ?>

                                            <div class="taskEmployeeImg rounded-circle position-absolute"
                                                style="top:-10px; left:  <?=$left?>px">
                                                <a
                                                    href="<?=ROOT?>/employeedetails/<?=$member['user_id'];?>">
                                                    <img src="<?php
                                                             if ($member['image']) {
                                                                 echo ROOT.'/'.$member['image'];
                                                             } else {
                                                                 echo 'https://www.gravatar.com/avatar/f7e016ba33bbc6009459c4f37ce1c0e4.png?s=200&amp;d=mp';
                                                             }?>"
                                                        title="<?=$member['name']?>" /></a>
                                            </div>
                                            <?php endforeach;?>

                                        </div>
                                    </td>
                                    <td>
                                        <p class="f-15 mb-0">
                                            <?php
                                                $deadline = $project['deadline'];
                                             if($deadline > date('Y-m-d')) {
                                                 echo $project['deadline'];
                                             } else {
                                                 echo ' <span class="badge badge-danger">Expired</span>';
                                                 echo '<br>';
                                                 echo '<span class="text-danger">'.$project['deadline'].'</span>';
                                             }

                                             ?>
                                        </p>
                                    </td>
                                    <td>
                                        <div class="media align-items-center mw-250">
                                            <a href="<?=ROOT?>/clientdetails/<?=$project['client_id']?>"
                                                class="position-relative">
                                                <img src="<?php
                                                                      if ($project['image']) {
                                                                          echo ROOT.'/'.$project['image'];
                                                                      } else {
                                                                          echo 'https://www.gravatar.com/avatar/f7e016ba33bbc6009459c4f37ce1c0e4.png?s=200&amp;d=mp';
                                                                      }?>"
                                                    class="mr-2 taskEmployeeImg rounded-circle"
                                                    alt="<?=$project['name']?>"
                                                    title="<?=$project['name']?>">
                                            </a>
                                            <div class="media-body">
                                                <h5 class="mb-0 f-12"><a
                                                        href="<?=ROOT?>/clientdetails/<?=$project['client_id']?>"
                                                        class="text-darkest-grey"><?=$project['name']?></a>
                                                </h5>
                                                <p class="mb-0 f-12 text-dark-grey">
                                                    <?=$project['company_name']?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 15px;">
                                            <div class="progress-bar f-12 
                                            <?php if ($project['completion_percent'] < 50) {
                                                echo 'bg-danger';
                                            } elseif ($project['completion_percent'] > 50 && $project['completion_percent'] < 80) {
                                                echo 'bg-warning';
                                            } else {
                                                echo 'bg-success';
                                            }?>" role="progressbar"
                                                style="width: <?=$project['completion_percent']?>%;"
                                                aria-valuenow="<?=$project['completion_percent']?>"
                                                aria-valuemin="0" aria-valuemax="100">
                                                <?=$project['completion_percent']?>%
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?=ucwords($project['status'])?>
                                    </td>
                                    <td>
                                        <div class="task_view">

                                            <div class="dropdown">
                                                <a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle"
                                                    type="link" id="dropdownMenuLink-1" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-options-vertical icons"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="dropdownMenuLink-1" tabindex="0"
                                                    x-placement="bottom-end"
                                                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-169px, 26px, 0px);">
                                                    <a href="<?=ROOT?>/projectdetails/<?=$project['project_id']?>"
                                                        class="dropdown-item">
                                                        <i class="bi bi-eye-fill mr-2"></i>
                                                        View</a>
                                                    <a class="dropdown-item openRightModal"
                                                        href="<?=ROOT;?>/editproject/<?=$project['project_id']?>">
                                                        <i class="bi bi-pencil-fill mr-2"></i>
                                                        Edit
                                                    </a>
                                                    </a><a class="dropdown-item" target="_blank" href="">
                                                        <i class="bi bi-printer-fill mr-2"></i>
                                                        Public Task Board
                                                    </a>
                                                    </a><a class="dropdown-item delete-table-row" href="javascript:;"
                                                        data-user-id="1">
                                                        <i class="bi bi-trash-fill mr-2"></i>
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once("layout/footer.php");
?>

<script>
    $(document).ready(function() {
        $('#projects-table').DataTable();


    });
</script>
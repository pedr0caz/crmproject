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
                    <svg class="svg-inline--fa fa-plus fa-w-14 mr-1" aria-hidden="true" focusable="false"
                        data-prefix="fa" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
                        </path>
                    </svg><!-- <i class="fa fa-plus mr-1"></i> Font Awesome fontawesome.com -->
                    Add Project
                </a>



                <a href="<?=ROOT;?>/project/import"
                    class="btn-secondary rounded f-14 p-2 mr-3 float-left mb-2 mb-lg-0 mb-md-0">
                    <svg class="svg-inline--fa fa-file-upload fa-w-12 mr-1" aria-hidden="true" focusable="false"
                        data-prefix="fa" data-icon="file-upload" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm65.18 216.01H224v80c0 8.84-7.16 16-16 16h-32c-8.84 0-16-7.16-16-16v-80H94.82c-14.28 0-21.41-17.29-11.27-27.36l96.42-95.7c6.65-6.61 17.39-6.61 24.04 0l96.42 95.7c10.15 10.07 3.03 27.36-11.25 27.36zM377 105L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128v-6.1c0-6.3-2.5-12.4-7-16.9z">
                        </path>
                    </svg><!-- <i class="fa fa-file-upload mr-1"></i> Font Awesome fontawesome.com -->
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
                                     if (empty($projects)) {
                                         echo ' <tr id="row-1" role="row" class="odd">
                                         <td>empty</td></tr>';
                                     } else {
                                         foreach ($projects as $project) { ?>
                                <tr id="row-1" role="row" class="odd">

                                    <td class="sorting_1"><?=$project['project_id']?>
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
                                                aria-valuemin="0" aria-valuemax="100"><?=$project['completion_percent']?>%
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
                                                        class="dropdown-item"><svg
                                                            class="svg-inline--fa fa-eye fa-w-18 mr-2"
                                                            aria-hidden="true" focusable="false" data-prefix="fa"
                                                            data-icon="eye" role="img"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                            data-fa-i2svg="">
                                                            <path fill="currentColor"
                                                                d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                                            </path>
                                                        </svg>
                                                        <!-- <i class="fa fa-eye mr-2"></i> Font Awesome fontawesome.com -->View</a><a
                                                        class="dropdown-item openRightModal"
                                                        href="<?=ROOT;?>/editproject/<?=$project['project_id']?>">
                                                        <svg class="svg-inline--fa fa-edit fa-w-18 mr-2"
                                                            aria-hidden="true" focusable="false" data-prefix="fa"
                                                            data-icon="edit" role="img"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                            data-fa-i2svg="">
                                                            <path fill="currentColor"
                                                                d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z">
                                                            </path>
                                                        </svg>
                                                        <!-- <i class="fa fa-edit mr-2"></i> Font Awesome fontawesome.com -->
                                                        Edit
                                                    </a>
                                                    </a><a class="dropdown-item" target="_blank" href="">
                                                        <svg class="svg-inline--fa fa-share-square fa-w-18 mr-2"
                                                            aria-hidden="true" focusable="false" data-prefix="fa"
                                                            data-icon="share-square" role="img"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                            data-fa-i2svg="">
                                                            <path fill="currentColor"
                                                                d="M568.482 177.448L424.479 313.433C409.3 327.768 384 317.14 384 295.985v-71.963c-144.575.97-205.566 35.113-164.775 171.353 4.483 14.973-12.846 26.567-25.006 17.33C155.252 383.105 120 326.488 120 269.339c0-143.937 117.599-172.5 264-173.312V24.012c0-21.174 25.317-31.768 40.479-17.448l144.003 135.988c10.02 9.463 10.028 25.425 0 34.896zM384 379.128V448H64V128h50.916a11.99 11.99 0 0 0 8.648-3.693c14.953-15.568 32.237-27.89 51.014-37.676C185.708 80.83 181.584 64 169.033 64H48C21.49 64 0 85.49 0 112v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48v-88.806c0-8.288-8.197-14.066-16.011-11.302a71.83 71.83 0 0 1-34.189 3.377c-7.27-1.046-13.8 4.514-13.8 11.859z">
                                                            </path>
                                                        </svg>
                                                        <!-- <i class="fa fa-share-square mr-2"></i> Font Awesome fontawesome.com -->
                                                        Public Task Board
                                                    </a>
                                                    </a><a class="dropdown-item delete-table-row" href="javascript:;"
                                                        data-user-id="1">
                                                        <svg class="svg-inline--fa fa-trash fa-w-14 mr-2"
                                                            aria-hidden="true" focusable="false" data-prefix="fa"
                                                            data-icon="trash" role="img"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                            data-fa-i2svg="">
                                                            <path fill="currentColor"
                                                                d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z">
                                                            </path>
                                                        </svg>
                                                        <!-- <i class="fa fa-trash mr-2"></i> Font Awesome fontawesome.com -->
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php }
                                         }?>
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
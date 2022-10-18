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



                <a href="http://localhost/script/public/account/projects/import"
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

                                    <th title="Id" class="sorting_desc" tabindex="0" aria-controls="projects-table"
                                        rowspan="1" colspan="1" style="width: 55px;" aria-sort="descending"
                                        aria-label="Id: activate to sort column ascending">Id</th>
                                    <th title="Project Name" class="sorting" tabindex="0" aria-controls="projects-table"
                                        rowspan="1" colspan="1" style="width: 189px;"
                                        aria-label="Project Name: activate to sort column ascending">Project Name</th>
                                    <th width="15%" title="Members" class="sorting" tabindex="0"
                                        aria-controls="projects-table" rowspan="1" colspan="1" style="width: 202px;"
                                        aria-label="Members: activate to sort column ascending">Members</th>
                                    <th title="Deadline" class="sorting" tabindex="0" aria-controls="projects-table"
                                        rowspan="1" colspan="1" style="width: 134px;"
                                        aria-label="Deadline: activate to sort column ascending">Deadline</th>
                                    <th width="15%" title="Client" class="sorting" tabindex="0"
                                        aria-controls="projects-table" rowspan="1" colspan="1" style="width: 202px;"
                                        aria-label="Client: activate to sort column ascending">Client</th>
                                    <th title="Progress" class="sorting" tabindex="0" aria-controls="projects-table"
                                        rowspan="1" colspan="1" style="width: 136px;"
                                        aria-label="Progress: activate to sort column ascending">Progress</th>
                                    <th width="16%" title="Status" class="sorting" tabindex="0"
                                        aria-controls="projects-table" rowspan="1" colspan="1" style="width: 218px;"
                                        aria-label="Status: activate to sort column ascending">Status</th>
                                    <th title="Action" class="text-right pr-20 sorting_disabled" rowspan="1" colspan="1"
                                        style="width: 98px;" aria-label="Action">Action</th>
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
                                                        href="<?=ROOT?>project/<?=$project['project_id']?>"><?=$project['project_name']?></a>
                                                </h5>
                                                <p class="mb-0"></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="position-relative">
                                            <div class="taskEmployeeImg rounded-circle " style="left:  0px"><a
                                                    href="<?=ROOT?>//account/employees/4"><img
                                                        data-toggle="tooltip" data-original-title="John"
                                                        src="https://www.gravatar.com/avatar/b4dda2fb5d3ab52705af21229f9b4b93.png?s=200&amp;d=mp"></a>
                                            </div>
                                            <div class="taskEmployeeImg rounded-circle position-absolute"
                                                style="left:  13px"><a
                                                    href="<?=ROOT?>//account/employees/1"><img
                                                        data-toggle="tooltip" data-original-title="Pedro"
                                                        src="https://www.gravatar.com/avatar/7fcefe645acaa3363d8f10bdfba33c0d.png?s=200&amp;d=mp"></a>
                                            </div>
                                            <div class="taskEmployeeImg rounded-circle position-absolute"
                                                style="left:  26px"><a
                                                    href="<?=ROOT?>//account/employees/6"><img
                                                        data-toggle="tooltip" data-original-title="Asdsad"
                                                        src="https://www.gravatar.com/avatar/3ea58e77e21cabdfeabbfd844cbabbca.png?s=200&amp;d=mp"></a>
                                            </div>
                                            <div class="taskEmployeeImg rounded-circle position-absolute"
                                                style="left:  39px"><a
                                                    href="<?=ROOT?>//account/employees/7"><img
                                                        data-toggle="tooltip" data-original-title="Dassad"
                                                        src="https://www.gravatar.com/avatar/a456ed61bc3c5d05f3ad79d85069098a.png?s=200&amp;d=mp"></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>11-10-2022</td>
                                    <td>
                                        <div class="media align-items-center mw-250">
                                            <a href="<?=ROOT?>//account/clients/5"
                                                class="position-relative">
                                                <img src="https://www.gravatar.com/avatar/f7e016ba33bbc6009459c4f37ce1c0e4.png?s=200&amp;d=mp"
                                                    class="mr-2 taskEmployeeImg rounded-circle" alt="Chines"
                                                    title="Chines">
                                            </a>
                                            <div class="media-body">
                                                <h5 class="mb-0 f-12"><a
                                                        href="<?=ROOT?>//account/clients/5"
                                                        class="text-darkest-grey">Chines</a>
                                                </h5>
                                                <p class="mb-0 f-12 text-dark-grey">
                                                    Space X
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 15px;">
                                            <div class="progress-bar f-12 bg-danger" role="progressbar"
                                                style="width: 0%;" aria-valuenow="0" aria-valuemin="0"
                                                aria-valuemax="100">0%</div>
                                        </div>
                                    </td>
                                    <td>
                                        Not
                                        Started
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

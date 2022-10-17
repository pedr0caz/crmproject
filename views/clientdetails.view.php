<?php require_once("layout/header.php"); ?>
<?php require_once("layout/navbar.php"); ?>

<section class="main-container bg-additional-grey" id="fullscreen">
    <div class="preloader-container justify-content-center align-items-center" style="display: none;">
        <div class="spinner-border" role="status" aria-hidden="true"></div>
    </div>
    <!-- FILTER START -->
    <!-- PROJECT HEADER STARTmplete -->
    <div class="d-flex filter-box project-header bg-white">
        <div class="mobile-close-overlay w-100 h-100" id="close-client-overlay"></div>
        <div class="project-menu d-lg-flex" id="mob-client-detail">
            <a class="d-none close-it" href="javascript:;" id="close-client-detail">
                <svg class="svg-inline--fa fa-times fa-w-11" aria-hidden="true" focusable="false" data-prefix="fa"
                    data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"
                    data-fa-i2svg="">
                    <path fill="currentColor"
                        d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                    </path>
                </svg>
                <!-- <i class="fa fa-times"></i> Font Awesome fontawesome.com -->
            </a>
            <a href="<?=ROOT?>/clientdetails/<?=$id?>"
                class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab profile"><span>Profile</span></a>
            <a href=" <?=ROOT?>/clientdetails/<?=$id?>?tab=projects"
                class="text-dark-grey text-capitalize border-right-grey p-sub-menu projects"><span>Projects</span></a>
            <a href="<?=ROOT?>/clientdetails/<?=$id?>?tab=documents"
                class="text-dark-grey text-capitalize border-right-grey p-sub-menu documents"><span>Documents</span></a>
            <a href="<?=ROOT?>/clientdetails/<?=$id?>?tab=notes"
                class="text-dark-grey text-capitalize border-right-grey p-sub-menu notes"><span>Notes</span></a>
            <a href="<?=ROOT?>/clientdetails/<?=$id?>?tab=tickets"
                class="text-dark-grey text-capitalize border-right-grey p-sub-menu tickets"><span>Tickets</span></a>
        </div>
        <a class="mb-0 d-block d-lg-none text-dark-grey ml-auto mr-2 border-left-grey"
            onclick="openClientDetailSidebar()">
            <svg class="svg-inline--fa fa-ellipsis-v fa-w-6" aria-hidden="true" focusable="false" data-prefix="fa"
                data-icon="ellipsis-v" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"
                data-fa-i2svg="">
                <path fill="currentColor"
                    d="M96 184c39.8 0 72 32.2 72 72s-32.2 72-72 72-72-32.2-72-72 32.2-72 72-72zM24 80c0 39.8 32.2 72 72 72s72-32.2 72-72S135.8 8 96 8 24 40.2 24 80zm0 352c0 39.8 32.2 72 72 72s72-32.2 72-72-32.2-72-72-72-72 32.2-72 72z">
                </path>
            </svg>
            <!-- <i class="fa fa-ellipsis-v "></i> Font Awesome fontawesome.com -->
        </a>
    </div>
    <!-- FILTER END -->
    <!-- PROJECT HEADER END -->
    <!-- PAGE TITLE START -->
    <div class="page-title d-block d-lg-none">
        <div class="page-heading">
            <h2 class="mb-0 pr-3 text-dark f-18 font-weight-bold"><?=$client['name']?>
                <span class="text-lightest f-12 f-w-500 ml-2">
                    <a href="<?=ROOT?>/"
                        class="text-lightest">Home</a> •
                    <a href="<?=ROOT?>/clientdetails"
                        class="text-lightest">Client Details</a> •
                    <?=$client['name']?>
                </span>
            </h2>
        </div>
    </div>
    <!-- PAGE TITLE END -->
    <div class="content-wrapper border-top-0 client-detail-wrapper">
        <?php if (!isset($_GET['tab'])) { ?>

        <!-- ROW START -->
        <div class="row">
            <div class="col-sm-12">
            </div>
            <!--  USER CARDS START -->
            <div class="col-xl-7 col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4 mb-md-0">
                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-md-6 mb-4 mb-lg-0">
                        <div class="card border-0 b-shadow-4">
                            <div class="card-horizontal align-items-center">
                                <div class="card-img">
                                    <img class=""
                                        src="https://www.gravatar.com/avatar/f7e016ba33bbc6009459c4f37ce1c0e4.png?s=200&amp;d=mp"
                                        alt="">
                                </div>
                                <div class="card-body border-0 pl-0">
                                    <div class="row">
                                        <div class="col-10">
                                            <h4 class="card-title f-15 f-w-500 text-darkest-grey mb-0">
                                                Chines
                                            </h4>
                                        </div>
                                        <div class="col-2 text-right">
                                            <div class="dropdown">
                                                <button class="btn f-14 px-0 py-0 text-dark-grey dropdown-toggle"
                                                    type="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <svg class="svg-inline--fa fa-ellipsis-h fa-w-16" aria-hidden="true"
                                                        focusable="false" data-prefix="fa" data-icon="ellipsis-h"
                                                        role="img" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor"
                                                            d="M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z">
                                                        </path>
                                                    </svg>
                                                    <!-- <i class="fa fa-ellipsis-h"></i> Font Awesome fontawesome.com -->
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
                                                    aria-labelledby="dropdownMenuLink" tabindex="0">
                                                    <a class="dropdown-item openRightModal"
                                                        href="<?=ROOT?>/clientdetails/<?=$id?>5/edit">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="f-13 font-weight-normal text-dark-grey mb-0">
                                        Space X
                                    </p>
                                    <p class="card-text f-12 text-lightest">Last login at
                                        --
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-6">
                        <div class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
                            <div class="d-block text-capitalize">
                                <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Total Projects
                                </h5>
                                <div class="d-flex">
                                    <p class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid"><span
                                            id="">1</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  USER CARDS END -->
            <!--  WIDGETS END -->
        </div>
        <!-- ROW END -->
        <!-- ROW START -->
        <div class="row mt-4">
            <div class="col-xl-12 col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4">
                <div class="card bg-white border-0 b-shadow-4">
                    <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
                        <h4 class="f-18 f-w-500 mb-0">Profile Info</h4>
                    </div>
                    <div class="card-body ">
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Full Name</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?=$client['name']?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Email</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?=$client['email'] ?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Company Name</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?=$client['company_name'] ?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Mobile</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?=$client['mobile'] ?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-block d-lg-flex d-md-flex">
                            <p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">
                                Gender
                            </p>
                            <p class="mb-0 text-dark-grey f-14 w-70">
                                <?=$client['gender'] ?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Office Phone Number</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?=$client['office'] ?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Official Website</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?=$client['website'] ?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">GST/VAT Number</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">--</p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Address</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?=$client['address'] ?: '--'?>
                            </p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">State</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">--</p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">City</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">--</p>
                        </div>
                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Postal code</p>
                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">--</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }
        
        if (isset($_GET['tab']) && $_GET['tab'] == "projects") {
            ?>
        <div class="col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4">
            <!-- Add Task Export Buttons Start -->
            <div class="d-flex" id="table-actions">
                <a href="<?=ROOT?>//account/projects/create?default_client=5"
                    class="btn-primary rounded f-14 p-2 mr-3 openRightModal"
                    data-redirect-url="<?=ROOT?>//account/clients/5?tab=projects">
                    <svg class="svg-inline--fa fa-plus fa-w-14 mr-1" aria-hidden="true" focusable="false"
                        data-prefix="fa" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
                        </path>
                    </svg><!-- <i class="fa fa-plus mr-1"></i> Font Awesome fontawesome.com -->
                    Add Project
                </a>

                <div class="dt-buttons btn-group"><button class="btn btn-secondary buttons-excel" tabindex="0"
                        aria-controls="projects-table" type="button"><span><svg
                                class="svg-inline--fa fa-file-export fa-w-18" aria-hidden="true" focusable="false"
                                data-prefix="fa" data-icon="file-export" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M384 121.9c0-6.3-2.5-12.4-7-16.9L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128zM571 308l-95.7-96.4c-10.1-10.1-27.4-3-27.4 11.3V288h-64v64h64v65.2c0 14.3 17.3 21.4 27.4 11.3L571 332c6.6-6.6 6.6-17.4 0-24zm-379 28v-32c0-8.8 7.2-16 16-16h176V160H248c-13.2 0-24-10.8-24-24V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V352H208c-8.8 0-16-7.2-16-16z">
                                </path>
                            </svg><!-- <i class="fa fa-file-export"></i> Font Awesome fontawesome.com -->
                            Export</span></button> </div>
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
                                        <th title="Project Name" class="sorting" tabindex="0"
                                            aria-controls="projects-table" rowspan="1" colspan="1" style="width: 189px;"
                                            aria-label="Project Name: activate to sort column ascending">Project Name
                                        </th>
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
                                        <th title="Action" class="text-right pr-20 sorting_disabled" rowspan="1"
                                            colspan="1" style="width: 98px;" aria-label="Action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="row-1" role="row" class="odd">

                                        <td class="sorting_1">1</td>
                                        <td>
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h5 class="mb-0 f-13 text-darkest-grey"><a
                                                            href="<?=ROOT?>//account/projects/1">Test</a>
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
                                </tbody>
                            </table>

                        </div>
                    </div>


                </div>
                <!-- Task Box End -->
            </div>
            <?php
        }
?>
        </div>
    </div>
</section>
<?php require_once("layout/footer.php");

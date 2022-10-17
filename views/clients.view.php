<?php require_once("layout/header.php"); ?>
<?php require_once("layout/navbar.php"); ?>
<?php if (empty($id) || !is_numeric($id)) {
    echo $id;
} ?>
<section class="main-container bg-additional-grey" id="fullscreen">
    <div class="preloader-container justify-content-center align-items-center" style="display: none;">
        <div class="spinner-border" role="status" aria-hidden="true"></div>
    </div>
    <!-- PAGE TITLE START -->
    <div class="page-title d-block d-lg-none">
        <div class="page-heading">
            <h2 class="mb-0 pr-3 text-dark f-18 font-weight-bold">Clients
                <span class="text-lightest f-12 f-w-500 ml-2">
                    <a href="http://localhost/script/public" class="text-lightest">Home</a> •
                    Clients
                </span>
            </h2>
        </div>
    </div>
    <!-- PAGE TITLE END -->
    <!-- CONTENT WRAPPER START -->
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-block d-lg-flex d-md-flex justify-content-between action-bar dd">
            <div id="table-actions" class="flex-grow-1 align-items-center">
                <a href="http://localhost/script/public/account/clients/create"
                    class="btn-primary rounded f-14 p-2 mr-3 openRightModal float-left mb-2 mb-lg-0 mb-md-0">
                    <svg class="svg-inline--fa fa-plus fa-w-14 mr-1" aria-hidden="true" focusable="false"
                        data-prefix="fa" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
                        </path>
                    </svg>
                    <!-- <i class="fa fa-plus mr-1"></i> Font Awesome fontawesome.com -->
                    Add Client
                </a>
                <a href="http://localhost/script/public/account/clients/import"
                    class="btn-secondary rounded f-14 p-2 mr-3 float-left mb-2 mb-lg-0 mb-md-0">
                    <svg class="svg-inline--fa fa-file-upload fa-w-12 mr-1" aria-hidden="true" focusable="false"
                        data-prefix="fa" data-icon="file-upload" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm65.18 216.01H224v80c0 8.84-7.16 16-16 16h-32c-8.84 0-16-7.16-16-16v-80H94.82c-14.28 0-21.41-17.29-11.27-27.36l96.42-95.7c6.65-6.61 17.39-6.61 24.04 0l96.42 95.7c10.15 10.07 3.03 27.36-11.25 27.36zM377 105L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128v-6.1c0-6.3-2.5-12.4-7-16.9z">
                        </path>
                    </svg>
                    <!-- <i class="fa fa-file-upload mr-1"></i> Font Awesome fontawesome.com -->
                    Import
                </a>
                <div class="dt-buttons btn-group">
                    <button class="btn btn-secondary buttons-excel" tabindex="0" aria-controls="clients-table"
                        type="button">
                        <span>
                            <svg class="svg-inline--fa fa-file-export fa-w-18" aria-hidden="true" focusable="false"
                                data-prefix="fa" data-icon="file-export" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M384 121.9c0-6.3-2.5-12.4-7-16.9L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128zM571 308l-95.7-96.4c-10.1-10.1-27.4-3-27.4 11.3V288h-64v64h64v65.2c0 14.3 17.3 21.4 27.4 11.3L571 332c6.6-6.6 6.6-17.4 0-24zm-379 28v-32c0-8.8 7.2-16 16-16h176V160H248c-13.2 0-24-10.8-24-24V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V352H208c-8.8 0-16-7.2-16-16z">
                                </path>
                            </svg>
                            <!-- <i class="fa fa-file-export"></i> Font Awesome fontawesome.com --> Export
                        </span>
                    </button>
                </div>
            </div>


        </div>
        <!-- Add Task Export Buttons End -->
        <!-- Task Box Start -->
        <div class="d-flex flex-column w-tables rounded mt-3 bg-white">
            <div id="clients-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover border-0 w-100 dataTable no-footer" id="clients-table"
                            role="grid" aria-describedby="clients-table_info" style="width: 1587px;">
                            <thead>
                                <tr role="row">

                                    <th title="Id" class="sorting_desc" tabindex="0" aria-controls="clients-table"
                                        rowspan="1" colspan="1" style="width: 94px;" aria-sort="descending"
                                        aria-label="Id: activate to sort column ascending">Id</th>
                                    <th title="Name" class="sorting" tabindex="0" aria-controls="clients-table"
                                        rowspan="1" colspan="1" style="width: 378px;"
                                        aria-label="Name: activate to sort column ascending">Name</th>
                                    <th title="Email" class="sorting" tabindex="0" aria-controls="clients-table"
                                        rowspan="1" colspan="1" style="width: 293px;"
                                        aria-label="Email: activate to sort column ascending">Email</th>
                                    <th title="Status" class="sorting" tabindex="0" aria-controls="clients-table"
                                        rowspan="1" colspan="1" style="width: 167px;"
                                        aria-label="Status: activate to sort column ascending">Status</th>
                                    <th title="Created" class="sorting" tabindex="0" aria-controls="clients-table"
                                        rowspan="1" colspan="1" style="width: 192px;"
                                        aria-label="Created: activate to sort column ascending">Created</th>
                                    <th title="Action" class="text-right pr-20 sorting_disabled" rowspan="1" colspan="1"
                                        style="width: 150px;" aria-label="Action">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($clients as $client) {
                                    ?>

                                <tr id="row-5" role="row" class="odd">
                                    <td></td>
                                    <td></td>
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

<?php require_once("layout/footer.php");

<?php require_once("layout/header.php"); ?>
<?php require_once("layout/navbar.php"); ?>

<section class="main-container bg-additional-grey" id="fullscreen">




    <div class="content-wrapper">
        <div id="notice-detail-section">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card bg-white border-0 b-shadow-4">
                        <div
                            class="card-header bg-white  border-bottom-grey text-capitalize justify-content-between p-20">
                            <div class="row">
                                <div class="col-lg-10 col-10">
                                    <h3 class="heading-h1 mb-3">Notice Details</h3>
                                </div>
                                <div class="col-lg-2 col-2 text-right">

                                    <div class="dropdown">
                                        <button
                                            class="btn btn-lg f-14 px-2 py-1 text-dark-grey text-capitalize rounded  dropdown-toggle"
                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
                                            aria-labelledby="dropdownMenuLink" tabindex="0">

                                            <a class="dropdown-item openRightModal" href="">Edit</a>
                                            <a class="dropdown-item delete-notice">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Notice Heading</p>
                                <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">Alice thought to herself. 'I dare say
                                    you're wondering why I don't.</p>
                            </div>
                            <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Date</p>
                                <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">23-10-2022</p>
                            </div>

                            <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                <p class="mb-0 text-lightest f-14 w-30 text-capitalize">To</p>
                                <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">Employee</p>
                            </div>

                            <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Description</p>
                                <div class="mb-0 text-dark-grey f-14 w-70 text-wrap ql-editor p-0">W</div>
                            </div>


                            <div class="col-12 px-0 pb-3 d-flex">
                                <p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">
                                    Read By</p>
                                <p class="mb-0 text-dark-grey f-14">
                                    --
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



</section>
<?php require_once("layout/footer.php");
?>
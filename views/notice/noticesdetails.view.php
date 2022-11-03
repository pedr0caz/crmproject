<?php require_once("views/layout/header.php"); ?>
<?php require_once("views/layout/navbar.php"); ?>

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
                                    <h3 class="heading-h1 mb-3">
                                        <?=NOTICE_DETAILS;?>
                                    </h3>
                                </div>
                                <div class="col-lg-2 col-2 text-right">
                                    <?php if ($_SESSION["user_role"] == "1") : ?>
                                    <div class="dropdown">
                                        <button
                                            class="btn btn-lg f-14 px-2 py-1 text-dark-grey text-capitalize rounded  dropdown-toggle"
                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
                                            aria-labelledby="dropdownMenuLink" tabindex="0">

                                            <a class="dropdown-item openRightModal"
                                                href="<?=ROOT?>/notice/<?=$id?>?edit"><?=G_EDIT;?></a>
                                            <a
                                                class="dropdown-item delete-notice"><?=G_DELETE;?></a>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                <p class="mb-0 text-lightest f-14 w-30 text-capitalize">
                                    <?=NOTICE_HEADING;?>
                                </p>
                                <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                    <?=$notice['heading'];?>
                                </p>
                            </div>
                            <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                <p class="mb-0 text-lightest f-14 w-30 text-capitalize">
                                    <?=G_DATE;?>
                                </p>
                                <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                    <?=$notice['created_at'];?>
                                </p>
                            </div>

                            <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                <p class="mb-0 text-lightest f-14 w-30 text-capitalize">
                                    <?=G_TO;?>
                                </p>
                                <p class="mb-0 text-dark-grey f-14 w-70 text-wrap">
                                    <?php
                                        if ($notice['toGroup'] == 2) {
                                            echo $notice['display_name'];
                                        } else {
                                            echo G_CLIENT;
                                        }
?>
                                </p>
                            </div>

                            <div class="col-12 px-0 pb-3 ">
                                <p class="mb-0 text-lightest f-14 w-30 text-capitalize">
                                    <?=G_DESCRIPTION;?></p>
                                <div class="mb-0 text-dark-grey f-14 w-70 text-wrap ql-editor p-0 mt-3">
                                    <?=$notice['description'];?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



</section>
<?php require_once("views/layout/footer.php");
?>
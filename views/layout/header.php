<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet"
        href="<?=ROOT?>/css/simple-line-icons.css">

    <link rel="stylesheet" href="<?=ROOT?>/css/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css">
    <link rel="stylesheet" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css">

    <link type=" text/css" rel="stylesheet" media="all"
        href="<?=ROOT?>/css/main.css">

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="<?=ROOT?>/js/modernizr.min.js"></script>

</head>

<body id="body">
    <?php if(isset($_SESSION['user_id'])): ?>
    <header class="main-header clearfix bg-white" id="header">

        <div class="navbar-left float-left d-flex align-items-center">

            <div class="page-title d-none d-lg-flex">
                <div class="page-heading">
                    <h2 class="mb-0 pr-3 text-dark f-18 font-weight-bold">
                        <?=$title?>
                        <span class="text-lightest f-12 f-w-500 ml-2">
                            <a href="" class="text-lightest">Home</a> •
                            <?=ucfirst($title);?>
                        </span>
                    </h2>
                </div>
            </div>

        </div>

        <div class="page-header-right float-right d-flex align-items-center">
            <ul>

                <li>
                    <div class="mr-2">
                        <select class="selectpicker" id="flag" data-width="fit">
                            <option value="en" data-width="fit"
                                data-content='<span class="flag-icon flag-icon-gb"></span>'>
                            </option>
                            <option value="pt" data-width="fit" data-content='<span
                                    class="flag-icon flag-icon-pt"></span>'>
                            </option>
                        </select>
                    </div>
                </li>



                <!-- <li>
                    <div class="notification_box dropdown">
                        <a class="d-block dropdown-toggle header-icon-box show-user-notifications" type="link"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-bell-fill text-dark-grey f-20"></i>
                        </a>
                
                        <div class="dropdown-menu dropdown-menu-right notification-dropdown border-0 shadow-lg py-0 bg-additional-grey"
                            tabindex="0">
                            <div
                                class="d-flex px-3 justify-content-between align-items-center border-bottom-grey py-1 bg-white">
                                <div class="___class_+?50___">
                                    <p class="f-14 mb-0 text-dark f-w-500">New notifications</p>
                                </div>
                            </div>
                            <div id="notification-list">
                            </div>
                        </div>
                    </div>
                </li> -->

                <li>
                    <div class="logout_box" style="    margin-top: 5px;">
                        <a class="d-block header-icon-box"
                            href="<?=ROOT?>/logout">
                            <i class="bi bi-power f-w-500 text-dark-grey f-20"></i>

                        </a>
                    </div>
                </li>

            </ul>
        </div>

    </header>
    <?php endif; ?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Simple Line Icons -->
    <link rel="stylesheet"
        href="<?=ROOT?>/css/simple-line-icons.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="<?=ROOT?>/css/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css">
    <link rel="stylesheet" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css">
    <!-- Template CSS -->
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
            <!-- PAGE TITLE START -->
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
            <!-- PAGE TITLE END -->
            <div class="d-block d-lg-none menu-collapse cursor-pointer position-relative" onclick="openMobileMenu()">
                <div class="mc-wrap">
                    <div class="mcw-line"></div>
                    <div class="mcw-line center"></div>
                    <div class="mcw-line"></div>
                </div>
            </div>
        </div>
        <!-- NAVBAR LEFT(MOBILE MENU COLLAPSE) END-->
        <!-- NAVBAR RIGHT(SEARCH, ADD, NOTIFICATION, LOGOUT) START-->
        <div class="page-header-right float-right d-flex align-items-center">
            <ul>
                <!-- START TIMER END -->
                <!-- ADD START -->
                <li>
                    <div class="mr-2">
                        <select class="selectpicker" id="flag" data-width="fit">
                            <option data-width="fit" <?=$_SESSION["lang"] == "en" ? 'selected' : '';?>
                                data-content='<span class="flag-icon flag-icon-gb"></span>'>
                            </option>
                            <option data-width="fit" <?=$_SESSION["lang"] == "pt" ? 'selected' : '';?>data-content='<span
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
                <!-- NOTIFICATIONS END -->
                <!-- LOGOUT START -->
                <li>
                    <div class="logout_box" style="    margin-top: 5px;">
                        <a class="d-block header-icon-box"
                            href="<?=ROOT?>/logout">
                            <i class="bi bi-power f-w-500 text-dark-grey f-20"></i>
                            <!-- <i class="fa fa-power-off f-16 text-dark-grey"></i> Font Awesome fontawesome.com -->
                        </a>
                    </div>
                </li>
                <!-- LOGOUT END -->
            </ul>
        </div>

    </header>
    <?php endif; ?>
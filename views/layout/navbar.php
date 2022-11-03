<aside class="sidebar-dark">
    <!-- MOBILE CLOSE SIDEBAR PANEL START -->
    <div class="mobile-close-sidebar-panel w-100 h-100" onclick="closeMobileMenu()" id="mobile_close_panel"></div>
    <!-- MOBILE CLOSE SIDEBAR PANEL END -->
    <!-- MAIN SIDEBAR START -->
    <div class="main-sidebar" id="mobile_menu_collapse">
        <!-- SIDEBAR BRAND START -->
        <div class="sidebar-brand-box dropdown cursor-pointer ">
            <div class="dropdown-toggle sidebar-brand d-flex align-items-center justify-content-between  w-100"
                type="link" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- SIDEBAR BRAND NAME START -->
                <div class="sidebar-brand-name">
                    <h1 class="mb-0 f-16 f-w-500 text-white-shade mt-0" data-placement="bottom" data-toggle="tooltip"
                        data-original-title="">CRM
                        <i class="icon-arrow-down icons pl-2"></i>
                    </h1>
                    <div class="mb-0 position-relative pro-name">
                        <span class="bg-light-green rounded-circle"></span>
                        <p class="f-13 text-lightest mb-0" data-placement="bottom" data-toggle="tooltip"
                            data-original-title="<?=$_SESSION['user_name'];?>">
                            <?=$_SESSION['user_name'];?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- DROPDOWN - INFORMATION -->
            <div class="dropdown-menu dropdown-menu-right sidebar-brand-dropdown ml-3"
                aria-labelledby="dropdownMenuLink" tabindex="0">
                <div class="d-flex justify-content-between align-items-center profile-box">
                    <div class="profileInfo d-flex align-items-center mr-1 flex-wrap">
                        <div class="profileImg mr-2">
                            <img class="h-100"
                                src="<?=$_SESSION['user_image'] ? ROOT."/".$_SESSION['user_image'] : ROOT.'/images/avatar.png'?>"
                                alt="<?=$_SESSION['user_name'];?>">
                        </div>
                        <div class="ProfileData">
                            <h3 class="f-15 f-w-500 text-dark" data-placement="bottom" data-toggle="tooltip"
                                data-original-title="<?=$_SESSION['user_name'];?>">
                                <?=$_SESSION['user_name'];?>
                            </h3>
                            <p class="mb-0 f-12 text-dark-grey"></p>
                        </div>
                    </div>
                    <a href="<?=ROOT;?>/profile">
                        <i class="side-icon bi bi-pencil-square"></i>
                    </a>
                </div>

                <a class="dropdown-item d-flex justify-content-between align-items-center f-15 text-dark"
                    href="<?=ROOT;?>/logout">
                    Logout <i class="side-icon bi bi-power"></i>
                </a>
            </div>
        </div>
        <!-- SIDEBAR BRAND END -->
        <!-- SIDEBAR MENU START -->
        <div class="sidebar-menu " id="sideMenuScroll">
            <ul>
                <!-- NAV ITEM - DASHBOARD COLLAPSE MENU-->
                <li class="accordionItem closeIt">
                    <a class="nav-item text-lightest f-15 sidebar-text-color accordionItemHeading  <?php if (str_contains($controller, 'home')) {
                        echo 'active';
                    }?>" title="Dashboard">
                        <i class="side-icon bi bi-house"></i>
                        <span
                            class="pl-3"><?=MENU_DASHBOARD;?></span>
                    </a>
                    <div class="accordionItemContent pb-2 a">
                        <!-- COLLAPSE - INFORMATION -->
                        <a class="f-14 text-lightest"
                            href="<?=ROOT?>/adminhome"
                            title="Admin Dashboard"><?=MENU_DASHBOARD;?></a>
                        <!-- COLLAPSE - INFORMATION -->
                        <a class="f-14 text-lightest"
                            href="<?=ROOT?>/home"
                            title="Private Dashboard"><?=MENU_PRIVATE_DASHBOARD;?></a>
                    </div>
                </li>
                <?php if($_SESSION['user_role'] == 1): ?>
                <li class="accordionItem openIt">
                    <a class="nav-item text-lightest f-15 sidebar-text-color <?php if (str_contains($controller, 'client')) {
                        echo 'active';
                    }?>" href="<?=ROOT?>/client"
                        title="Clients">
                        <i class="side-icon bi bi-people"></i>
                        <span class="pl-3"><?=MENU_CLIENTS;?></span>
                    </a>
                </li>
                <li class="accordionItem closeIt">
                    <a class="nav-item text-lightest f-15 sidebar-text-color  <?php if (str_contains($controller, 'employee')) {
                        echo 'active';
                    }?>"
                        href="<?=ROOT;?>/employee" title="Employees">
                        <i class="side-icon bi bi-person"></i>
                        <span
                            class="pl-3"><?=MENU_EMPLOYEES;?></span>
                    </a>
                </li>
                <?php endif; ?>
                <!-- NAV ITEM - WORK COLLAPASE MENU -->
                <li class="accordionItem closeIt">
                    <a class="nav-item text-lightest f-15 sidebar-text-color accordionItemHeading  <?php if (str_contains($controller, 'project') || str_contains($controller, 'task')) {
                        echo 'active';
                    }?>" title="Work">
                        <i class="side-icon bi bi-briefcase"></i>
                        <span class="pl-3"><?=MENU_WORK;?></span>
                    </a>
                    <div class="accordionItemContent pb-2">
                        <!-- COLLAPSE - INFORMATION -->
                        <a class="f-14 text-lightest"
                            href="<?=ROOT?>/project"
                            title="Projects"><?=MENU_PROJECTS;?></a>
                        <!-- COLLAPSE - INFORMATION -->
                        <a class="f-14 text-lightest"
                            href="<?=ROOT?>/task"
                            title="Tasks"><?=MENU_TASKS;?></a>
                        <!-- COLLAPSE - INFORMATION -->
                    </div>
                </li>
                <!-- NAV ITEM - FINANCE COLLAPASE MENU -->
                <!-- NAV ITEM - EVENTS -->
                <li class="accordionItem closeIt">
                    <a class="nav-item text-lightest f-15 sidebar-text-color  <?php if (str_contains($controller, 'event')) {
                        echo 'active';
                    }?>" href="<?=ROOT?>/event"
                        title="Events">
                        <i class="side-icon bi bi-calendar"></i>
                        <span class="pl-3"><?=MENU_EVENTS;?></span>
                    </a>
                </li>
                <!-- NAV ITEM - MESSAGES -->
                <li class="accordionItem closeIt message-menu">
                    <a class="nav-item text-lightest f-15 sidebar-text-color  <?php if (str_contains($controller, 'message')) {
                        echo 'active';
                    }?>"
                        href="<?=ROOT?>/messages" title="Messages">
                        <i class="side-icon bi bi-chat"></i>
                        <span class="pl-3"><?=MENU_MESSAGES;?></span>
                    </a>
                </li>
                <!-- NAV ITEM - GDPR -->
                <!-- NAV ITEM - NOTICES -->
                <li class="accordionItem closeIt">
                    <a class="nav-item text-lightest f-15 sidebar-text-color  <?php if (str_contains($controller, 'notice')) {
                        echo 'active';
                    }?>" href="<?=ROOT?>/notice"
                        title="Notice Board">
                        <i class="side-icon bi bi-clipboard"></i>
                        <span
                            class="pl-3"><?=MENU_NOTICE_BOARD;?></span>
                    </a>
                </li>

                <li class="accordionItem closeIt">
                    <a class="nav-item text-lightest f-15 sidebar-text-color  <?php if (str_contains($controller, 'profile')) {
                        echo 'active';
                    }?>"
                        href="<?=ROOT?>/profile"
                        title="Notice Board">
                        <i class="side-icon bi bi-person-badge-fill"></i>
                        <span class="pl-3"><?=MENU_PROFILE;?></span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- SIDEBAR MENU END -->
    </div>
</aside>
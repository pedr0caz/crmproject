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
                            data-original-title="Pedro">Pedro</p>
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
                                src="https://www.gravatar.com/avatar/7fcefe645acaa3363d8f10bdfba33c0d.png?s=200&amp;d=mp"
                                alt="Pedro">
                        </div>
                        <div class="ProfileData">
                            <h3 class="f-15 f-w-500 text-dark" data-placement="bottom" data-toggle="tooltip"
                                data-original-title="Pedro">Pedro</h3>
                            <p class="mb-0 f-12 text-dark-grey"></p>
                        </div>
                    </div>
                    <a href="settings/profile-settings">
                        <i class="side-icon bi bi-pencil-square"></i>
                    </a>
                </div>

                <a class="dropdown-item d-flex justify-content-between align-items-center f-15 text-dark invite-member"
                    href="javascript:;">
                    <span>Invite member to Flag Project</span>
                    <i class="side-icon bi bi-person-plus"></i>
                </a>

                <a class="dropdown-item d-flex justify-content-between align-items-center f-15 text-dark"
                    href="javascript:;">
                    <label for="dark-theme-toggle">Dark Theme</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="dark-theme-toggle" autocomplete="off"
                            data-np-invisible="1" data-np-checked="1">
                        <label class="custom-control-label f-14" for="dark-theme-toggle"></label>
                    </div>
                </a>
                <a class="dropdown-item d-flex justify-content-between align-items-center f-15 text-dark"
                    href="http://localhost/script/public/logout" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
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

                    <a class="nav-item text-lightest f-15 sidebar-text-color accordionItemHeading " title="Dashboard">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-house" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z">
                            </path>
                            <path fill-rule="evenodd"
                                d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z">
                            </path>
                        </svg>
                        <span class="pl-3">Dashboard</span>

                    </a>

                    <div class="accordionItemContent pb-2">
                        <!-- COLLAPSE - INFORMATION -->
                        <a class="f-14 text-lightest" href="dashboard" title="Admin Dashboard">Admin Dashboard</a>
                        <!-- COLLAPSE - INFORMATION -->
                        <a class="f-14 text-lightest" href="dashboard-member" title="Private Dashboard">Private
                            Dashboard</a>
                    </div>
                </li>


                <li class="accordionItem openIt">

                    <a class="nav-item text-lightest f-15 sidebar-text-color active" href="clients" title="Clients">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-building" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z">
                            </path>
                            <path
                                d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z">
                            </path>
                        </svg>
                        <span class="pl-3">Clients</span>
                    </a>


                </li>

                <!-- NAV ITEM - HR COLLAPASE MENU -->
                <li class="accordionItem closeIt">

                    <a class="nav-item text-lightest f-15 sidebar-text-color accordionItemHeading " title="HR">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-people" viewBox="0 0 16 16">
                            <path
                                d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z">
                            </path>
                        </svg>
                        <span class="pl-3">HR</span>

                    </a>

                    <div class="accordionItemContent pb-2">
                        <!-- COLLAPSE - INFORMATION -->
                        <a class="f-14 text-lightest" href="employees" title="Employees">Employees</a>

                    </div>
                </li>

                <!-- NAV ITEM - WORK COLLAPASE MENU -->
                <li class="accordionItem closeIt">

                    <a class="nav-item text-lightest f-15 sidebar-text-color accordionItemHeading " title="Work">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-briefcase" viewBox="0 0 16 16">
                            <path
                                d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z">
                            </path>
                        </svg>
                        <span class="pl-3">Work</span>

                    </a>

                    <div class="accordionItemContent pb-2">

                        <!-- COLLAPSE - INFORMATION -->
                        <a class="f-14 text-lightest" href="projects" title="Projects">Projects</a>

                        <!-- COLLAPSE - INFORMATION -->
                        <a class="f-14 text-lightest" href="tasks" title="Tasks">Tasks</a>
                        <!-- COLLAPSE - INFORMATION -->
                        <a class="f-14 text-lightest" href="timelogs" title="Time Logs">Time Logs</a>

                    </div>
                </li>

                <!-- NAV ITEM - FINANCE COLLAPASE MENU -->







                <!-- NAV ITEM - EVENTS -->
                <li class="accordionItem closeIt">

                    <a class="nav-item text-lightest f-15 sidebar-text-color" href="events" title="Events">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-calendar-event" viewBox="0 0 16 16">
                            <path
                                d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z">
                            </path>
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z">
                            </path>
                        </svg>
                        <span class="pl-3">Events</span>
                    </a>


                </li>

                <!-- NAV ITEM - MESSAGES -->
                <li class="accordionItem closeIt message-menu">

                    <a class="nav-item text-lightest f-15 sidebar-text-color" href="messages" title="Messages">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-chat-left-text" viewBox="0 0 16 16">
                            <path
                                d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z">
                            </path>
                            <path
                                d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z">
                            </path>
                        </svg>
                        <span class="pl-3">Messages</span>
                    </a>


                </li>

                <!-- NAV ITEM - GDPR -->

                <!-- NAV ITEM - NOTICES -->
                <li class="accordionItem closeIt">

                    <a class="nav-item text-lightest f-15 sidebar-text-color" href="notices" title="Notice Board">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-clipboard" viewBox="0 0 16 16">
                            <path
                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z">
                            </path>
                            <path
                                d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z">
                            </path>
                        </svg>
                        <span class="pl-3">Notice Board</span>
                    </a>


                </li>




            </ul>
        </div>
        <!-- SIDEBAR MENU END -->
    </div>

</aside>
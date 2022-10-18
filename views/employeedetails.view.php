<?php require_once("layout/header.php"); ?>
<?php require_once("layout/navbar.php"); ?>
<section class="main-container bg-additional-grey" id="fullscreen">
    <div class="preloader-container justify-content-center align-items-center" style="display: none;">
        <div class="spinner-border" role="status" aria-hidden="true"></div>
    </div>
    <div class="d-flex d-lg-block filter-box project-header bg-white">
        <div class="mobile-close-overlay w-100 h-100" id="close-client-overlay"></div>
        <div class="project-menu" id="mob-client-detail">
            <a class="d-none close-it" href="javascript:;" id="close-client-detail">
                <svg class="svg-inline--fa fa-times fa-w-11" aria-hidden="true" focusable="false" data-prefix="fa"
                    data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"
                    data-fa-i2svg="">
                    <path fill="currentColor"
                        d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                    </path>
                </svg>
            </a>
            <nav class="tabs --jsfied">
                <ul class="-primary">
                    <li>
                        <a href="<?=ROOT?>/employeedetails/<?=$id?>"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab profile <?php if(!isset($_GET['tab'])) {
                                echo "active";
                            } ?>" id="profile"><span>Profile</span></a>
                    </li>
                    <li>
                        <a href="<?=ROOT?>/employeedetails/<?=$id?>?tab=projects"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu projects <?php if(isset($_GET['tab']) && $_GET['tab'] == "projects") {
                                echo "active";
                            }?>" id="projects"><span>Projects</span></a>
                    </li>
                    <li>
                        <a href="<?=ROOT?>/employeedetails/<?=$id?>tab=tasks"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu tasks <?php if(isset($_GET['tab']) && $_GET['tab'] == "tasks") {
                                echo "active";
                            }?>" id="tasks"><span>Tasks</span></a>
                    </li>
                    <li>
                        <a href=" <?=ROOT?>/employeedetails/<?=$id?>tab=documents"
                            class="text-dark-grey text-capitalize border-right-grey p-sub-menu ajax-tab documents <?php if(isset($_GET['tab']) && $_GET['tab'] == "documents") {
                                echo "active";
                            }?>" id="documents"><span>Documents</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="content-wrapper pt-0 border-top-0 client-detail-wrapper" style="position: relative; zoom: 1;">
        <style>
            .card-img {
                width: 120px;
                height: 120px;
            }

            .card-img img {
                width: 120px;
                height: 120px;
                object-fit: cover;
            }
        </style>
        <?php if(!isset($_GET['tab'])) { ?>
        <div class="d-lg-flex">
            <div class="project-left w-100 py-0 py-lg-5 py-md-0">
                <!-- ROW START -->
                <div class="row">
                    <!--  USER CARDS START -->
                    <div class="col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4 mb-md-0">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 mb-4 mb-lg-0">
                                <div class="card border-0 b-shadow-4">
                                    <div class="card-horizontal align-items-center">
                                        <div class="card-img">
                                            <img class=""
                                                src="<?=$employee['image'] ? ROOT."/".$employee['image'] : 'https://www.gravatar.com/avatar/a456ed61bc3c5d05f3ad79d85069098a.png?s=200&d=mp'?>"
                                                alt="">
                                        </div>
                                        <div class="card-body border-0 pl-0">
                                            <div class="row">
                                                <div class="col-10">
                                                    <h4 class="card-title f-15 f-w-500 text-darkest-grey mb-0">
                                                        <?=$employee['name']?>
                                                    </h4>
                                                </div>
                                                <div class="col-2 text-right">
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#exampleModal">
                                                        Edit
                                                </div>
                                            </div>
                                            <p class="f-13 font-weight-normal text-dark-grey mb-0">
                                                <?=$employee['designation_name']?>
                                            </p>
                                            <p class="card-text f-12 text-lightest"> <?php foreach($teams as $team): ?>
                                                •
                                                <?=$team['team_name']?>
                                                <?php endforeach; ?>
                                            </p>
                                            <div class="card-footer bg-white border-top-grey pl-0">
                                                <div class="d-flex flex-wrap ">
                                                    <span class="pl-3">
                                                        <label class="f-11 text-dark-grey mb-12 text-capitalize"
                                                            for="usr">Open Tasks</label>
                                                        <p class="mb-0 f-18 f-w-500"><?=$NumberOfIncompleteTasks['task_count']?>
                                                        </p>
                                                    </span>
                                                    <span class="pl-3">
                                                        <label class="f-11 text-dark-grey mb-12 text-capitalize"
                                                            for="usr">Projects</label>
                                                        <p class="mb-0 f-18 f-w-500"><?=$NumberOfProjects['project_count'];?>
                                                        </p>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-white border-0 b-shadow-4  mt-4">
                                    <div
                                        class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
                                        <h4 class="f-18 f-w-500 mb-0">Profile Info</h4>
                                    </div>
                                    <div class="card-body ">
                                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Employee ID</p>
                                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?=$employee['employee_id']?>
                                            </p>
                                        </div>
                                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Full Name</p>
                                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?=$employee['name']?>
                                            </p>
                                        </div>
                                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Email</p>
                                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?=$employee['email']?>
                                            </p>
                                        </div>
                                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Mobile</p>
                                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?=$employee['mobile']?>
                                            </p>
                                        </div>
                                        <div class="col-12 px-0 pb-3 d-block d-lg-flex d-md-flex">
                                            <p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">
                                                Gender
                                            </p>
                                            <p class="mb-0 text-dark-grey f-14 w-70">
                                                <?=$employee['gender']?>
                                            </p>
                                        </div>
                                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Date of Birth</p>
                                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap"> <?=$employee['date_of_birth']?>
                                            </p>
                                        </div>
                                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Slack Username</p>
                                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap"> <?=$employee['slack_username']?>
                                            </p>
                                        </div>
                                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Address</p>
                                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap"> <?=$employee['address']?>
                                            </p>
                                        </div>
                                        <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                            <p class="mb-0 text-lightest f-14 w-30 text-capitalize">Skills</p>
                                            <p class="mb-0 text-dark-grey f-14 w-70 text-wrap"> <?=$employee['skills']?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="card bg-white border-0 b-shadow-4">
                                            <div
                                                class="card-header bg-white border-0 text-capitalize d-flex justify-content-between p-20">
                                                <h4 class="f-18 f-w-500 mb-0">Tasks</h4>
                                            </div>
                                            <div class="card-body p-0 ">
                                                <div class="text-center text-lightest p-20" style="height: 250px">
                                                    <i class="side-icon f-21 bi bi-pie-chart"></i>
                                                    <div class="f-15 mt-4">
                                                        - Not enough data -
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="project-right my-4 my-lg-0">
                <div class="bg-white">
                    <div class="p-activity-heading d-flex align-items-center justify-content-between b-shadow-4 p-20">
                        <p class="mb-0 f-18 f-w-500">Activity</p>
                    </div>
                    <div class="p-activity-detail cal-info b-shadow-4" data-menu-vertical="1" data-menu-scroll="1"
                        data-menu-dropdown-timeout="500" id="projectActivityDetail">
                        <?php foreach($getUserActivity as $activity):?>
                        <div class="card border-0 b-shadow-4 p-20 rounded-0">
                            <div class="card-horizontal">
                                <div class="card-header m-0 p-0 bg-white rounded">
                                    <span class="f-12 p-1 "><?=date('M', strtotime($activity['created_at']))?></span>
                                    <span class="f-13 f-w-500 rounded-bottom"><?=date('d', strtotime($activity['created_at']))?></span>
                                </div>
                                <div class="card-body border-0 p-0 ml-3">
                                    <h4 class="card-title f-14 font-weight-normal text-capitalize"><?=$activity['activity']?>
                                    </h4>
                                    <p class="card-text f-12 text-dark-grey">
                                        <?=date('H:i', strtotime($activity['created_at']))?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php  if(isset($_GET['tab']) && $_GET['tab'] == 'projects') { ?>
        <div class="d-flex flex-column w-tables rounded mt-3 bg-white">

            <div id="projects-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover border-0 w-100" id="projects-table" role="grid"
                            aria-describedby="projects-table_info" style="width: 1587px;">
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
        <?php } ?>
    </div>
</section>
<?php require_once("layout/footer.php");


?>

<script>
    $(document).ready(function() {
        $('#projects-table').DataTable({
            initComplete: function() {
                this.api()
                    .columns()
                    .every(function() {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                column.search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function(d, j) {
                                select.append('<option value="' + d + '">' + d +
                                    '</option>');
                            });
                    });
            },
        });
    });
</script>
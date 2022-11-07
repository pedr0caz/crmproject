<?php
require_once("views/layout/header.php");
require_once("views/layout/navbar.php");
?>
<section class="main-container bg-additional-grey" id="fullscreen">




    <div class="content-wrapper">
        <div id="task-detail-section">


            <div class="row">
                <div class="col-sm-9">
                    <div class="card bg-white border-0 b-shadow-4">
                        <div
                            class="card-header bg-white  border-bottom-grey text-capitalize justify-content-between p-20">
                            <div class="row">
                                <div class="col-lg-8 col-10">

                                    <h3 class="heading-h1 mb-3">
                                        <?=$task['heading'];?>
                                    </h3>


                                </div>
                                <div class="col-lg-4 col-2 text-right">
                                    <div class="dropdown">
                                        <button
                                            class="btn btn-lg f-14 px-2 py-1 text-dark-grey text-capitalize rounded  dropdown-toggle"
                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <?php if($_SESSION['user_role'] == 1 || $_SESSION['user_id'] == $task['user_id']): ?>
                                        <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
                                            aria-labelledby="dropdownMenuLink" tabindex="0">



                                            <a class="dropdown-item openRightModal"
                                                href="<?=ROOT;?>/task/<?=$id?>?edit"><?=G_EDIT;?></a>



                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="col-12 px-0 pb-3 d-block d-lg-flex d-md-flex">
                                <p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">
                                    <?=G_PROJECT;?>
                                </p>
                                <p class="mb-0 text-dark-grey f-14 w-70">

                                    <a href="<?=ROOT;?>/project/<?=$task['project_id']?>"
                                        class="text-dark-grey">
                                        <?=$task['project_name'] ? $task['project_name'] : '<span class="badge badge-info">'.TASK_NO_PROJECT_ASSINGNED.'</span>'; ?></a>
                                </p>

                            </div>
                            <div class="col-12 px-0 pb-3 d-block d-lg-flex d-md-flex">
                                <p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">
                                    <?=G_PRIORITY;?>
                                </p>
                                <p class="mb-0 text-dark-grey f-14 w-70">


                                    <?php
                                    if ($task['task_priority'] == "low") {
                                        echo '<i class="bi bi-circle-fill mr-1 text-green f-10"></i>';
                                        echo G_PRIORITY_LOW;
                                    } elseif ($task['task_priority'] == "medium") {
                                        echo '<i class="bi bi-circle-fill mr-1 text-yellow f-10"></i>';
                                        echo G_PRIORITY_MEDIUM;
                                    } elseif ($task['task_priority'] == "high") {
                                        echo '<i class="bi bi-circle-fill mr-1 text-red f-10"></i>';
                                        echo G_PRIORITY_HIGH;
                                    }
?>
                                </p>
                            </div>

                            <div class="col-12 px-0 pb-3 d-block d-lg-flex d-md-flex">
                                <p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">
                                    <?=G_ASSIGNED_TO;?>
                                </p>
                                <?php foreach($taskEmployees as $taskEmployee): ?>
                                <div class="taskEmployeeImg rounded-circle mr-1">
                                    <a
                                        href="<?=ROOT;?>/employee/<?=$taskEmployee['user_id']?>">
                                        <img title="<?=$taskEmployee['user_name'];?>"
                                            src="<?=$taskEmployee['user_image'] ? ROOT.'/'.$taskEmployee['user_image'] : 'https://www.gravatar.com/avatar/3ea58e77e21cabdfeabbfd844cbabbca.png?s=200&amp;d=mp';?>">
                                    </a>
                                </div>
                                <?php endforeach; ?>

                            </div>
                            <div class="col-12 px-0 pb-3 d-block d-lg-flex d-md-flex">
                                <p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">
                                    <?=G_ASSIGNED_BY;?>
                                </p>

                                <style>
                                    .disabled-link {
                                        pointer-events: none;
                                    }
                                </style>

                                <div class="media align-items-center mw-250">
                                    <a href="<?=ROOT;?>/employee/<?=$task['user_id']?>"
                                        class="position-relative ">
                                        <img src="<?=$task['user_image'] ? ROOT.'/'.$task['user_image'] : 'https://www.gravatar.com/avatar/3ea58e77e21cabdfeabbfd844cbabbca.png?s=200&amp;d=mp';?>"
                                            class="mr-2 taskEmployeeImg rounded-circle"
                                            alt="<?=$task['user_name']?>"
                                            title="<?=$task['user_name']?>">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="mb-0 f-12">
                                            <a href="<?=ROOT;?>/employee/<?=$task['user_id']?>"
                                                class="text-darkest-grey "><?=$task['user_name']?></a>
                                            <?php if ($task['user_id'] == $_SESSION['user_id']) {?>
                                            <span
                                                class="badge badge-secondary"><?=G_ITS_YOU;?></span>
                                            <?php } ?>
                                        </h5>
                                        <p class="mb-0 f-12 text-dark-grey">

                                        </p>
                                    </div>
                                </div>

                            </div>




                            <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                <p class="mb-0 text-lightest f-14 w-30 text-capitalize">
                                    <?=TASK_CATEGORY;?>
                                </p>
                                <div class="mb-0 text-dark-grey f-14 w-70 text-wrap ql-editor p-0">
                                    <?=$task['category_name']?>
                                </div>
                            </div>
                            <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
                                <p class="mb-0 text-lightest f-14 w-30 text-capitalize">
                                    <?=G_DESCRIPTION;?>
                                </p>
                                <div class="mb-0 text-dark-grey f-14 w-70 text-wrap ql-editor p-0">
                                    <?=$task['description']?>
                                </div>
                            </div>



                        </div>
                    </div>


                    <div class="bg-additional-grey rounded my-3">

                        <div class="s-b-inner s-b-notifications bg-white b-shadow-4 rounded">

                            <div class="s-b-n-header task-tabs" id="tabs">
                                <nav class="tabs px-4 border-bottom-grey">
                                    <div class="nav" id="nav-tab" role="tablist">

                                        <a class="nav-item nav-link f-15 active ajax-tab" id="filestab" role="tab"
                                            aria-selected="true">
                                            <?=G_FILES;?>
                                        </a>


                                        <a class="nav-item nav-link f-15 ajax-tab" id="commentstab" role="tab"
                                            aria-selected="true">
                                            <?=G_COMMENT;?>
                                        </a>



                                        <a class="nav-item nav-link f-15 ajax-tab" id="historytab" role="tab"
                                            aria-selected="true">
                                            <?=G_HISTORY;?>
                                        </a>

                                    </div>
                                </nav>
                            </div>


                            <div class="s-b-n-content">
                                <div class="tab-content" id="nav-tabContent">

                                    <style>
                                        .file-action {
                                            visibility: hidden;
                                        }

                                        .file-card:hover .file-action {
                                            visibility: visible;
                                        }
                                    </style>


                                    <div class="tab-pane fade show active" role="tabpanel" id="files">
                                        <div class="p-20">

                                            <div class="card-body ">
                                                <?php if($_SESSION['user_role'] <= 2): ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a class="f-15 f-w-500" href="javascript:;"
                                                            id="add-task-file"><i
                                                                class="icons icon-plus font-weight-bold mr-1"></i><?=G_ADD_FILES;?></a>
                                                    </div>
                                                </div>

                                                <form method="POST" id="save-taskfile-data-form" class="d-none"
                                                    autocomplete="off" enctype="application/x-www-form-urlencoded">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group my-3">
                                                                <label class="f-14 text-dark-grey mb-12"
                                                                    data-label="true"
                                                                    for="file_name"><?=G_FILE_NAME;?>
                                                                    <sup class="f-14 mr-1">*</sup>

                                                                </label>

                                                                <input type="text" class="form-control height-35 f-14"
                                                                    placeholder="" value="" name="name" id="file_name"
                                                                    autocomplete="off" data-np-invisible="1"
                                                                    data-np-checked="1">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group my-3">
                                                                <label class="f-14 text-dark-grey mb-12"
                                                                    data-label="true"
                                                                    for="employee_file"><?=G_UPLOAD_FILE;?>
                                                                    <sup class="f-14 mr-1">*</sup>

                                                                    <i class="bi bi-question-circle-fill"></i>
                                                                </label>

                                                                <input type="file" id="input-file-now"
                                                                    data-allowed-file-extensions=".txt pdf doc xls xlsx docx rtf png jpg jpeg"
                                                                    class="dropify" name="file" />

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="w-100 justify-content-end d-flex mt-2">
                                                                <a href="javascript:;"
                                                                    class="btn-cancel rounded f-14 p-2 border-0 mr-3"
                                                                    id="cancel-document">
                                                                    <?=G_CANCEL;?>
                                                                </a>
                                                                <button type="button"
                                                                    class="btn-primary rounded f-14 p-2"
                                                                    id="submit-document">
                                                                    <i class="bi bi-check mr-2"></i>
                                                                    <?=G_SAVE;?>
                                                                </button>




                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <?php endif; ?>
                                                <div class="d-flex flex-wrap mt-3" id="task-file-list">
                                                    <?php foreach($taskFiles as $file):
                                                        $time = date_diff(date_create('now'), date_create($file['created_at']));
                                                        if ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') == 0) {
                                                            $time = $time->format('%s '.G_SECONDS.' '.G_AGO);
                                                        } elseif ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') > 0) {
                                                            $time = $time->format('%i '.G_MINUTES.' '.G_AGO);
                                                        } elseif ($time->format('%a') == 0 && $time->format('%h') > 0) {
                                                            $time = $time->format('%h '.G_HOURS.' '.G_AGO);
                                                        } else {
                                                            $time = $time->format('%a '.G_DAYS.' '.G_AGO);
                                                        }
                                                        ?>
                                                    <div class="card bg-white border-grey file-card mr-3 mb-3"
                                                        data-fileid="<?=$file['id']?>">
                                                        <div class="card-horizontal">
                                                            <div class="card-img mr-0">
                                                                <?php
                                                                    $fileE = explode('.', $file['filename']);
                                                        $extension = ltrim($fileE[count($fileE) - 1]);
                                                        if($extension == 'pdf') {
                                                            $img = ' <i class="bi bi-file-pdf mr-2 text-lightest" style="font-size: 16px;"></i>';
                                                        } elseif($extension == 'docx') {
                                                            $img = ' <i class="bi bi-filetype-docx mr-2 text-lightest" style="font-size: 16px;"></i>';
                                                        } elseif($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif') {
                                                            $img = '<img src="'.ROOT.'/'.$file["filename"].'">';
                                                        } else {
                                                            $img = ' <i class="bi bi-file-earmark mr-2 text-lightest" style="font-size: 16px;"></i>';
                                                        }
                                                        ?>
                                                                <?=$img?>
                                                            </div>
                                                            <div class="card-body pr-2">
                                                                <div class="d-flex flex-grow-1">
                                                                    <h4 class="card-title f-12 text-dark-grey mr-3 text-truncate"
                                                                        data-toggle="tooltip"
                                                                        data-original-title="asdsad">
                                                                        <?=$file['name']?>
                                                                    </h4>
                                                                    <div class="dropdown ml-auto file-action">
                                                                        <button
                                                                            class="btn btn-lg f-14 p-0 text-lightest text-capitalize rounded  dropdown-toggle"
                                                                            type="button" data-toggle="dropdown"
                                                                            aria-haspopup="true" aria-expanded="false">
                                                                            <i class="bi bi-three-dots-vertical"></i>
                                                                        </button>

                                                                        <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
                                                                            aria-labelledby="dropdownMenuLink"
                                                                            tabindex="0">

                                                                            <a class="cursor-pointer d-block text-dark-grey f-13 pt-3 px-3 "
                                                                                target="_blank"
                                                                                href="<?=ROOT?>/<?=$file['filename']?>"><?=G_VIEW;?></a>

                                                                            <a class="cursor-pointer d-block text-dark-grey f-13 py-3 px-3 "
                                                                                href="<?=ROOT?>/<?=$file['filename']?>"><?=G_DOWNLOAD;?></a>
                                                                            <?php if($file['user_id'] == $_SESSION['user_id'] || $_SESSION['user_role'] == 1): ?>

                                                                            <a class="cursor-pointer d-block text-dark-grey f-13 pb-3 px-3 delete-file"
                                                                                data-row-id="<?=$file['id']?>"
                                                                                href="javascript:;"><?=G_DELETE;?></a>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-date f-11 text-lightest">
                                                                    <?=$time?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" role="tabpanel" id="comments">
                                        <?php if($_SESSION['user_role'] <= 2): ?>
                                        <div class="row p-20">
                                            <div class="col-md-12">
                                                <a class="f-15 f-w-500" href="javascript:;" id="add-comment"><i
                                                        class="icons icon-plus font-weight-bold mr-1"></i><?=G_ADD;?>
                                                    <?=G_COMMENT;?></a>
                                                </a>
                                            </div>
                                        </div>

                                        <form method="POST" id="save-comment-data-form" class="d-none"
                                            autocomplete="off">


                                            <div class="col-md-12 p-20 ">
                                                <div class="media">

                                                    <img src="<?=$_SESSION['user_image'] ? ROOT.'/'.$_SESSION['user_image'] : 'https://www.gravatar.com/avatar/3ea58e77e21cabdfeabbfd844cbabbca.png?s=200&d=mp'; ?>"
                                                        class="align-self-start mr-3 taskEmployeeImg rounded"
                                                        alt="<?=$_SESSION['user_name']?>">
                                                    <div class="media-body bg-white">
                                                        <div class="form-group">
                                                            <textarea name="comment" id="editor"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-100 justify-content-end d-flex mt-2">
                                                    <a href="javascript:;"
                                                        class="btn-cancel rounded f-14 p-2 border-0 mr-3"
                                                        id="cancel-comment">
                                                        <?=G_CANCEL;?>
                                                    </a>
                                                    <button type="button" class="btn-primary rounded f-14 p-2"
                                                        id="submit-comment">
                                                        <i class="bi bi-check mr-2"></i>
                                                        <?=G_SAVE;?>
                                                    </button>

                                                </div>

                                            </div>
                                        </form>
                                        <?php endif; ?>

                                        <div class="d-flex flex-wrap justify-content-between p-20" id="comment-list">
                                            <?php foreach($taskComments as $comment): ?>
                                            <div class="card w-100 rounded-0 border-0 comment">
                                                <div class="card-horizontal">
                                                    <div class="card-img my-1 ml-0">
                                                        <img src="<?=$comment['user_image'] ? ROOT.'/'.$comment['user_image'] : 'https://www.gravatar.com/avatar/3ea58e77e21cabdfeabbfd844cbabbca.png?s=200&d=mp'; ?>"
                                                            alt="<?=$comment['user_name']?>">
                                                    </div>
                                                    <div class="card-body border-0 pl-0 py-1">
                                                        <div class="d-flex flex-grow-1">
                                                            <h4 class="card-title f-15 f-w-500 text-dark mr-3">
                                                                <?=$comment['user_name']?>

                                                            </h4>
                                                            <p class="card-date f-11 text-lightest mb-0">
                                                                <?php
                                                                   
                                                $time = date_diff(date_create('now'), date_create($comment['created_at']));
                                                if ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') == 0) {
                                                    $time = $time->format('%s '.G_SECONDS.' '.G_AGO);
                                                } elseif ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') > 0) {
                                                    $time = $time->format('%i '.G_MINUTES.' '.G_AGO);
                                                } elseif ($time->format('%a') == 0 && $time->format('%h') > 0) {
                                                    $time = $time->format('%h '.G_HOURS.' '.G_AGO);
                                                } else {
                                                    $time = $time->format('%a '.G_DAYS.' '.G_AGO);
                                                }
                                                echo $time;
                                                ?>
                                                            </p>
                                                            <?php if($comment['user_id'] == $_SESSION['user_id']): ?>
                                                            <div class="dropdown ml-auto comment-action">
                                                                <button
                                                                    class="btn btn-lg f-14 p-0 text-lightest text-capitalize rounded  dropdown-toggle"
                                                                    type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <i class="bi bi-three-dots-vertical"></i>
                                                                </button>

                                                                <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
                                                                    aria-labelledby="dropdownMenuLink" tabindex="0">


                                                                    <a class="cursor-pointer d-block text-dark-grey f-13 pb-3 px-3 delete-comment"
                                                                        data-row-id="<?=$comment['id']?>"
                                                                        href="javascript:;"><?=G_DELETE;?></a>
                                                                </div>

                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="card-text f-14 text-dark-grey text-justify">
                                                            <?=$comment['comment']?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" role="tabpanel" id="history">
                                        <div class="d-flex flex-wrap p-20">
                                            <?php foreach($taskHistory as $history):
                                                $historyJSON = json_decode($history['details'], true);
                                                ?>
                                            <div class="card file-card w-100 rounded-0 border-0 comment">
                                                <div class="card-horizontal">
                                                    <div class="card-img my-1 ml-0">
                                                        <img src="<?=$history['user_image'] ? ROOT.'/'.$history['user_image'] : 'https://www.gravatar.com/avatar/3ea58e77e21cabdfeabbfd844cbabbca.png?s=200&d=mp'; ?>"
                                                            alt="<?=$history['user_name']?>">
                                                    </div>
                                                    <div class="card-body border-0 pl-0 py-1 mb-2">
                                                        <div class="d-flex flex-grow-1">
                                                            <h4
                                                                class="card-title f-12 font-weight-normal text-dark mr-3 mb-1">
                                                                <?=$historyJSON[LANG_ISO]?>
                                                            </h4>
                                                            </h4>
                                                        </div>
                                                        <div class="card-text f-11 text-lightest text-justify">
                                                            <?php
                                                            if($history['board_column_name']) {
                                                                $labelTranslate = json_decode($history['board_column_name'], true);
                                                                echo '<span class="badge badge-primary"
																style="background-color:'.$history['board_column_color'].'">'.$labelTranslate[LANG_ISO].'</span>';
                                                            }
                                                ?>

                                                            <span class="f-11 text-lightest">
                                                                <?php
                                                                   
                                                       $time = date_diff(date_create('now'), date_create($history['created_at']));
                                                if ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') == 0) {
                                                    $time = $time->format('%s '.G_SECONDS.' '.G_AGO);
                                                } elseif ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') > 0) {
                                                    $time = $time->format('%i '.G_MINUTES.' '.G_AGO);
                                                } elseif ($time->format('%a') == 0 && $time->format('%h') > 0) {
                                                    $time = $time->format('%h '.G_HOURS.' '.G_AGO);
                                                } else {
                                                    $time = $time->format('%a '.G_DAYS.' '.G_AGO);
                                                }
                                                echo $time;
                                                ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>




                </div>

                <div class="col-sm-3">
                    <div class="card bg-white border-0 b-shadow-4">

                        <div class="card-body ">
                            <p class="f-w-500">
                                <?php if($_SESSION['user_role'] <= 1): ?>
                                <select class="selectpicker" name="task_status" id="task_status">
                                    <?php foreach($taskLabels as $taskLabel):
                                        $labelTranslate = json_decode($taskLabel['column_name'], true);
                                        ?>
                                    <option
                                        data-content="<i class='bi bi-circle-fill  mr-2'  style='color:<?=$taskLabel['label_color']?>'></i>  <?=$labelTranslate[LANG_ISO]?>"
                                        value="<?=$taskLabel['id']?>"
                                        <?php if($taskLabel['id'] == $task['board_column_id']) {
                                            echo 'selected';
                                        } ?>>
                                        <?=$labelTranslate[LANG_ISO]?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php else:
                                    $labelTranslate = json_decode($task['column_name'], true);
                                    ?>
                                <i class='bi bi-circle-fill  mr-2'
                                    style='color:<?=$task['label_color']?>'></i><?=$labelTranslate[LANG_ISO];?>
                                <?php endif; ?>
                            </p>


                            <div class="col-12 px-0 pb-3 d-lg-flex d-block">
                                <p class="mb-0 text-lightest w-50 f-14 text-capitalize">
                                    <?=G_START_DATE;?>
                                </p>
                                <p class="mb-0 text-dark-grey w-50 f-14">
                                    <?=ucwords(strftime('%d %B %Y', strtotime($task['start_date'])));?>
                                </p>
                            </div>
                            <div class="col-12 px-0 pb-3 d-lg-flex d-block">
                                <p class="mb-0 text-lightest w-50 f-14 text-capitalize">
                                    <?=G_DUE_DATE;?>
                                </p>
                                <p class="mb-0 text-dark-grey w-50 f-14">
                                    <?php
                                         $deadline = $task['due_date'];
if($deadline > date('Y-m-d')) {
    echo ucwords(strftime('%d %B %Y', strtotime($deadline)));
} else {
    echo ' <span class="badge badge-danger">'.G_EXPIRED.'</span>';
    echo '<br>';
    echo '<span class="text-danger">'.ucwords(strftime('%d %B %Y', strtotime($deadline))).'</span>';
}?>

                                </p>
                            </div>




                        </div>
                    </div>

                </div>

            </div>


            <script>
                $(document).ready(function() {

                    let editor;
                    ClassicEditor
                        .create(document.querySelector('#editor'), {
                            language: '<?=LANG_ISO;?>'
                        }).then((newEditor) => {
                            editor = newEditor;
                        })
                        .catch(error => {
                            console.error(error);
                        });


                    $('#add-comment').click(function() {
                        $(this).closest('.row').addClass('d-none');
                        $('#save-comment-data-form').removeClass('d-none');
                    });

                    $('#cancel-comment').click(function() {
                        $('#save-comment-data-form').addClass('d-none');
                        $('#add-comment').closest('.row').removeClass('d-none');
                    });


                    $('#submit-comment').click(function() {
                        let comment = editor.getData();
                        $.ajax({
                            url: '<?=ROOT;?>/task/<?=$id;?>?action=addcomment',
                            container: '#save-comment-data-form',
                            type: "POST",
                            disableButton: true,
                            blockUI: true,
                            buttonSelector: "#submit-comment",
                            data: {
                                comment: comment,
                            },
                            success: function(response) {
                                console.log(response);

                                if (response.status ==
                                    "success") {
                                    $('#save-comment-data-form').addClass('d-none');
                                    $('#add-comment').closest('.row').removeClass('d-none');
                                    $('#comment-list').prepend(response.data);
                                    location.reload();

                                }

                            }
                        });
                    });




                    // change task status
                    $('body').on('change', '#task_status', function() {
                        var status = $(this).val();

                        $.ajax({
                            url: '<?=ROOT;?>/task/<?=$id;?>?action=change_task_status',
                            type: "POST",
                            data: {
                                status: status,
                                task_id:
                                <?=$task['task_id']?>
                            },

                            success: function(data) {
                                console.log(data.status);
                                if (data.status == 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Task Status Changed',
                                        showConfirmButton: true,
                                        timer: 1500
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        } else if (result.dismiss === Swal
                                            .DismissReason.timer) {
                                            location.reload();
                                        }

                                    })

                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Something went wrong',
                                        showConfirmButton: true,
                                        timer: 1500
                                    })
                                }

                            }
                        });

                    });

                    $(".ajax-tab").click(function(event) {
                        event.preventDefault();

                        $('.task-tabs .ajax-tab').removeClass('active');

                        $(this).addClass('active');
                        var tab = $(this).attr('id');
                        $('#comments').removeClass('active');
                        $('#comments').removeClass('show');
                        $('#files').removeClass('active');
                        $('#files').removeClass('show');

                        $('#history').removeClass('active');
                        $('#history').removeClass('show');

                        if (tab == 'commentstab') {

                            $('#comments').addClass('active');
                            $('#comments').addClass('show');


                        } else if (tab == 'filestab') {

                            $('#files').addClass('active');
                            $('#files').addClass('show');


                        } else if (tab == 'historytab') {

                            $('#history').addClass('active');
                            $('#history').addClass('show');


                        }



                    });




                    $('body').on('click', '.delete-comment', function() {
                        var id = $(this).data('row-id');
                        Swal.fire({
                            title: "<?=SWAL_TITLE_DELETE;?>",
                            text: "You will not be able to recover the deleted record!",
                            icon: 'warning',
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonText: "<?=SWAL_CONFIRM_DELETE;?>",
                            cancelButtonText: "<?=G_CANCEL;?>",
                            customClass: {
                                confirmButton: 'btn btn-primary mr-3',
                                cancelButton: 'btn btn-secondary'
                            },
                            showClass: {
                                popup: 'swal2-noanimation',
                                backdrop: 'swal2-noanimation'
                            },
                            buttonsStyling: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: 'POST',
                                    url: '<?=ROOT;?>/task/<?=$id;?>?action=deletecomment',
                                    data: {
                                        id: id
                                    },
                                    success: function(response) {
                                        console.log(response);
                                        if (response.status == "success") {
                                            location.reload();
                                        }
                                    }
                                });
                            }
                        });
                    });




                    $('#add-task-file').click(function() {
                        $(this).closest('.row').addClass('d-none');
                        $('#save-taskfile-data-form').removeClass('d-none');
                    });


                    // Basic
                    $('.dropify').dropify();



                    // Used events
                    var drEvent = $('#input-file-events').dropify();

                    drEvent.on('dropify.beforeClear', function(event, element) {
                        return confirm("Do you really want to delete \"" + element.file
                            .name + "\" ?");
                    });

                    drEvent.on('dropify.afterClear', function(event, element) {
                        alert('File deleted');
                    });

                    drEvent.on('dropify.errors', function(event, element) {
                        console.log('Has Errors');
                    });

                    var drDestroy = $('#input-file-to-destroy').dropify();
                    drDestroy = drDestroy.data('dropify')
                    $('#toggleDropify').on('click', function(e) {
                        e.preventDefault();
                        if (drDestroy.isDropified()) {
                            drDestroy.destroy();
                        } else {
                            drDestroy.init();
                        }
                    })




                    $('#submit-document').click(function() {
                        var form = $('#save-taskfile-data-form');
                        var formData = new FormData(form[0]);
                        $.ajax({
                            url: '<?=ROOT;?>/task/<?=$id?>?action=uploadfile',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                console.log(response);
                                if (response.status) {
                                    console.log(response.data);
                                    $('#task-file-list').append(response.data);
                                    $('#save-taskfile-data-form').addClass('d-none');
                                    $('#add-task-file').closest('.row').removeClass(
                                        'd-none');
                                    $('#save-taskfile-data-form')[0].reset();
                                    $('.dropify-clear').trigger('click');
                                }
                            }
                        });

                    });

                    $('body').on('click', '.delete-file', function() {
                        var id = $(this).data('row-id');
                        Swal.fire({
                            title: "<?=SWAL_TITLE_DELETE;?>",
                            text: "You will not be able to recover the deleted record!",
                            icon: 'warning',
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonText: "<?=SWAL_CONFIRM_DELETE;?>",
                            cancelButtonText: "<?=G_CANCEL;?>",
                            customClass: {
                                confirmButton: 'btn btn-primary mr-3',
                                cancelButton: 'btn btn-secondary'
                            },
                            showClass: {
                                popup: 'swal2-noanimation',
                                backdrop: 'swal2-noanimation'
                            },
                            buttonsStyling: false
                        }).then((result) => {

                            if (result.isConfirmed) {
                                console.log("ok")
                                $.ajax({
                                    type: 'POST',
                                    url: '<?=ROOT;?>/task/<?=$id?>?action=deletefile',
                                    data: {
                                        id
                                    },
                                    dataType: 'text',
                                    success: function(response) {
                                        response = JSON.parse(response);
                                        if (response.status) {
                                            Swal.fire({
                                                title: "Deleted!",
                                                text: "Your record has been deleted.",
                                                icon: "success",
                                                customClass: {
                                                    confirmButton: 'btn btn-primary'
                                                },
                                                buttonsStyling: false
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    location.reload();
                                                }
                                            });
                                        }
                                    }
                                });
                            }
                        });
                    });



                });
            </script>
        </div>
    </div>



</section>

<?php
require_once("views/layout/footer.php");
?>
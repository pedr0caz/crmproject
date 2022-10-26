<?php

if (empty($id) || !is_numeric($id)) {
    http_response_code(400);
    $title = "Bad Request";
    require("views/error400.view.php");
    exit;
}


if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 1) {
        require("models/project.model.php");
        require("models/task.model.php");
        require("models/employee.model.php");
        require("models/discussion.model.php");

        $projectsModel = new Project();
        $project = $projectsModel->getProject($id);
        if (empty($project)) {
            http_response_code(404);
            $title = "Not Found";
            require("views/error404.view.php");
            exit;
        }
        $getProjectActivity = $projectsModel->getProjectActivity($id);
        $getProjectTasks = $projectsModel->getProjectTasks($id);
        $getSlugs = $projectsModel->getTaskColumns();
        $taskStatus = $projectsModel->getTaskStatus($id);
        $getProjectProgress = $projectsModel->getProjectProgress($id);
        $getProjectFiles = $projectsModel->getFiles($id);
        $getProjectMembers = $projectsModel->getProjectTeamMembers($id);
  
        $task = new Task();
        $tasks = $task->getProjectTasks($id);
        $taskLabels = $task->getLabels();
        $employeeModel = new Employee();
        $chatModel = new Discussion();
        $chats = $chatModel->getChat($id);
        $getChatCount = $chatModel->getChatCount($id);

        $title = "Project - " . $project["project_name"];

        if (isset($_GET['action']) && $_GET["action"] == "uploadfile") {
            if (!isset($_FILES["file"])) {
                die("No file selected");
            }
            $filepath = $_FILES["file"]["tmp_name"];
            $fileSize = $_FILES["file"]["size"];
            $fileinfot = finfo_open(FILEINFO_MIME_TYPE);
            $fileType = finfo_file($fileinfot, $filepath);
            $allowedTypes = [
                'image/png' => 'png',
                'image/jpeg' => 'jpg',
                'application/pdf' => 'pdf',
                'application/msword' => 'doc',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
                'application/vnd.ms-excel' => 'xls',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
                'application/vnd.ms-powerpoint' => 'ppt',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
                'text/plain' => 'txt'
             ];
            if (!array_key_exists($fileType, $allowedTypes)) {
                die("File type not allowed");
            }
            $filename = basename($filepath);
            $extension = $allowedTypes[$fileType];
            $targetDirectory = 'uploads/';
            $newFilepath = $targetDirectory . $filename . "." . $extension;
            if (!copy($filepath, $newFilepath)) {
                die("Error copying file");
            }
            unlink($filepath);
            $data = $projectsModel->newFile($id, $_SESSION['user_id'], $_POST['name'], $newFilepath);

            if ($data) {
                $time = date_diff(date_create('now'), date_create($data['created_at']));
                if ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') == 0) {
                    $time = $time->format('%s seconds ago');
                } elseif ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') > 0) {
                    $time = $time->format('%i minutes ago');
                } elseif ($time->format('%a') == 0 && $time->format('%h') > 0) {
                    $time = $time->format('%h hours ago');
                } else {
                    $time = $time->format('%a days ago');
                }
                $data = '<div class="card bg-white border-grey file-card mr-3 mb-3">
                <div class="card-horizontal">
                    <div class="card-img mr-0">
                        <img src="'.ROOT."/".$data['filename'].'">
                    </div>
                    <div class="card-body pr-2">
                        <div class="d-flex flex-grow-1">
                            <h4 class="card-title f-12 text-dark-grey mr-3 text-truncate" data-toggle="tooltip" >'.$data['name'].'</h4>
                            <div class="dropdown ml-auto file-action">
                                <button class="btn btn-lg f-14 p-0 text-lightest text-capitalize rounded  dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                    <!-- <i class="fa fa-ellipsis-h"></i> Font Awesome fontawesome.com -->
                                </button>

                                <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0" aria-labelledby="dropdownMenuLink" tabindex="0">

                                    <a class="cursor-pointer d-block text-dark-grey f-13 pt-3 px-3 " target="_blank" href="'.ROOT."/".$data['filename'].'">View</a>

                                    <a class="cursor-pointer d-block text-dark-grey f-13 py-3 px-3 " href="'.ROOT."/".$data['filename'].'">Download</a>

                                    <a class="cursor-pointer d-block text-dark-grey f-13 pb-3 px-3 delete-file" data-row-id="1" href="javascript:;">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-date f-11 text-lightest">
                            '.$time.'
                        </div>
                    </div>
                </div>
            </div>';

                
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['status' => 'success', 'message' => 'File uploaded successfully', 'data' => $data]);
            }
        } elseif (isset($_GET['action']) && $_GET["action"] == "deletefile") {
            $data = $projectsModel->deleteFile($_POST['id']);
            if ($data) {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['status' => 'success', 'message' => 'File deleted successfully']);
            } else {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['status' => 'error', 'message' => 'Error deleting file']);
            }
        } elseif (isset($_GET['msg']) && $_GET["msg"] == "add") {
            if (isset($_POST['message']) && mb_strlen($_POST['message'] > 0)) {
                $newChat =  $chatModel->newChat($_POST['message'], $id, $_SESSION['user_id']);
                if ($newChat) {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['status' => 'success', 'message' => 'Message sent successfully', 'data' => $newChat]);
                } else {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['status' => 'error', 'message' => 'Error sending message']);
                }
            }
        } elseif (isset($_GET['msg']) && $_GET["msg"] == "fetch") {
            if (isset($_POST['lastid']) && mb_strlen($_POST['lastid'] > 0 && is_numeric($_POST['lastid']))) {
                $fetchChat =  $chatModel->getChatAjax($id, $_POST['lastid']);
            
                if ($fetchChat) {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['status' => 'success', 'message' => 'Message sent successfully', 'data' => $fetchChat]);
                }
            }
        } elseif (isset($_GET['action']) && $_GET["action"] == "change_status") {
            if (isset($_POST['status']) && mb_strlen($_POST['status'] > 0)) {
                $status =  $projectsModel->changeProjectStatus($_POST['status'], $id);
             
                if ($status['status']) {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['status' => 'success', 'message' => 'Project status changed successfully']);
                } else {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['status' => 'error', 'message' => 'Error changing project status']);
                }
            }
        } else {
            require("views/projectdetails.view.php");
        }
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

<?php



if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"])) {
        require("models/project.model.php");
        require("models/employee.model.php");
        require("models/client.model.php");
        require("models/discussion.model.php");
        require("models/task.model.php");
        $projectsModel = new Project();
        $employeeModel = new Employee();
        $client = new Client();
        $task = new Task();
        $chatModel = new Discussion();

        $projectCategory = $projectsModel->getProjectCategory();
        $clients = $client->getClients();
        $departments = $projectsModel->getDepartments();
        $getDepartments = $projectsModel->getDepartments();
        $taskLabels = $task->getLabels();

        if (isset($id) && $id == null) {
            if ($_SESSION["user_role"] == "1") {
                $projects = $projectsModel->getProjects();
                $employees = $employeeModel->getEmployees();
            } elseif ($_SESSION["user_role"] == "2") {
                $projects = $employeeModel->getProjectsOfEmployee($_SESSION["user_id"]);
                $employees = $employeeModel->getEmployees();
            } elseif ($_SESSION["user_role"] == "3") {
                $projects = $projectsModel->getProjectByClientID($_SESSION["user_client_id"]);
            }

            $title = "Projects";
            require("views/project/projects.view.php");
        } elseif ($_SESSION["user_role"] <= 1 && isset($id) && $id == "create") {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_GET['submit'])) {
                    if (isset($_POST["project_name"]) && mb_strlen($_POST["project_name"]) > 0 &&
                    isset($_POST["category_id"]) && is_numeric($_POST["category_id"]) &&
                    isset($_POST["client_id"]) && is_numeric($_POST["client_id"]) &&
                    isset($_POST["start_date"]) && mb_strlen($_POST["start_date"]) > 0 &&
                    isset($_POST["deadline"]) && mb_strlen($_POST["deadline"]) > 0 &&
                    isset($_POST["team_id"]) &&
                    isset($_POST["project_description"]) && mb_strlen($_POST["project_description"]) > 0) {
                        $project = $projectsModel->newProject($_POST);
                 
                        if ($project["status"]) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'message' => 'Project added successfully', 'id' => $project["id"]]);
                            exit;
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error', 'message' => $project["message"]]);
                            exit;
                        }
                    } else {
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['status' => 'error', 'message' => 'Please fill all the fields']);
                        exit;
                    }
                } elseif (isset($_GET['projectCategory']) && $_GET['projectCategory'] == "edit") {
                    if (isset($_POST['category_name']) && !empty($_POST['category_name']) && isset($_POST['id']) && !empty($_POST['id'])) {
                        $category = $projectsModel->editCategory($_POST['id'], $_POST['category_name']);
                        if ($category) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'data' => $_POST['category_name']]);
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error']);
                        }
                    }
                } elseif (isset($_GET['projectCategory']) && $_GET['projectCategory'] == "add") {
                    if (isset($_POST['category_name']) && !empty($_POST['category_name'])) {
                        $category_name = $_POST['category_name'];
                        $category = $projectsModel->newCategory($category_name);
                        if ($category) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'catId' => $category, 'catName' => $category_name ]);
                        }
                    }
                } elseif (isset($_GET['projectCategory']) && $_GET['projectCategory'] == "delete") {
                    if (isset($_POST['catId']) && !empty($_POST['catId'])) {
                        $category_id = $_POST['catId'];
                        $category = $projectsModel->deleteCategory($category_id);
                        if ($category) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'catId' => $category]);
                        }
                    }
                }
            } else {
                $title = "Add Project";
                require("views/project/addproject.view.php");
            }
        } elseif (isset($id) && is_numeric($id)) {
            if ($_SESSION["user_role"] == "1") {
                $project = $projectsModel->getProject($id);
            } elseif ($_SESSION["user_role"] == "2") {
                $project = $projectsModel->getProjectID($id, $_SESSION["user_id"]);
            } elseif ($_SESSION["user_role"] == "3") {
                $project = $projectsModel->getProjectIDClient($id, $_SESSION['user_client_id']);
            }
            if (empty($project)) {
                http_response_code(404);
                $title = "Not Found";
                require("views/project/error404.view.php");
                exit;
            }

            

            if (!isset($_GET['edit'])) {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_GET['action']) && $_GET["action"] == "uploadfile" && $_SESSION["user_role"] <= 2) {
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
                            $html = '<div class="card bg-white border-grey file-card mr-3 mb-3">
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
                            echo json_encode(['status' => 'success', 'message' => 'File uploaded successfully', 'data' => $html]);
                        }
                    } elseif (isset($_GET['action']) && $_GET["action"] == "deletefile" && $_SESSION["user_role"] <= 2) {
                        if ($_SESSION["user_role"] == 1) {
                            $data = $projectsModel->deleteFileAdmin($_POST['id']);
                        } else {
                            $data = $projectsModel->deleteFile($_POST['id'], $_SESSION['user_id']);
                        }
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
                    } elseif (isset($_GET['action']) && $_GET["action"] == "change_status" && $_SESSION["user_role"] <= 1) {
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
                    } elseif (isset($_GET['action']) && $_GET["action"] == "delete_member" && $_SESSION["user_role"] <= 1) {
                        if (isset($_POST['user_id']) && isset($_POST['team_id']) &&
                            mb_strlen($_POST['user_id'] > 0) && mb_strlen($_POST['team_id'] > 0)) {
                            $deleteMember =  $projectsModel->deleteMemberFromProject($_POST['team_id'], $_POST['user_id']);
                           
                            if ($deleteMember) {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'success', 'message' => 'Member deleted successfully']);
                            } else {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'error', 'message' => 'Error deleting member']);
                            }
                        }
                    } elseif (isset($_GET['action']) && $_GET["action"] == "edit_departments" && $_SESSION["user_role"] <= 1) {
                        if (isset($_POST['department']) && mb_strlen($_POST['department'] > 0)) {
                            $editDepartments =  $projectsModel->editTeamsOnProject($id, $_POST['department']);
            
                            if ($editDepartments) {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'success', 'message' => 'Departments edited successfully']);
                            } else {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'error', 'message' => 'Error editing departments']);
                            }
                        }
                    }
                } else {
                    $getProjectActivity = $projectsModel->getProjectActivity($id);
                    $getProjectTasks = $projectsModel->getProjectTasks($id);
                    $getSlugs = $projectsModel->getTaskColumns();
                    $taskStatus = $projectsModel->getTaskStatus($id);
                    $getProjectProgress = $projectsModel->getProjectProgress($id);
                    $getProjectFiles = $projectsModel->getFiles($id);
                    $getProjectMembers = $projectsModel->getProjectTeamMembers($id);
                    $tasks = $task->getProjectTasks($id);
                    $chats = $chatModel->getChat($id);
                    $getChatCount = $chatModel->getChatCount($id);
                    $teams = json_decode($project['teams_id'], true);

                    $title = "Project - " . $project["project_name"];
                    require("views/project/projectdetails.view.php");
                }
            } elseif (isset($_GET['edit']) && $_SESSION['user_role'] == 1) {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_GET['submit'])) {
                        if (isset($_POST["project_name"]) && mb_strlen($_POST["project_name"]) > 0 &&
                            isset($_POST["category_id"]) && is_numeric($_POST["category_id"]) &&
                            isset($_POST["client_id"]) && is_numeric($_POST["client_id"]) &&
                            isset($_POST["start_date"]) && mb_strlen($_POST["start_date"]) > 0 &&
                            isset($_POST["deadline"]) && mb_strlen($_POST["deadline"]) > 0 &&
                            isset($_POST["team_id"]) &&
                            isset($_POST["project_description"]) && mb_strlen($_POST["project_description"]) > 0) {
                            $project = $projectsModel->editProject($id, $_POST);
             
                            if ($project["status"]) {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'success', 'message' => 'Project changed successfully', 'id' => $project["id"]]);
                                exit;
                            } else {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'error', 'message' => $project["message"]]);
                                exit;
                            }
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error', 'message' => 'Please fill all the fields']);
                            exit;
                        }
                    }
                } else {
                    $teams = json_decode($project['teams_id'], true);
                    $title = "Edit Project";
                    require("views/project/editproject.view.php");
                }
            }
        } else {
            http_response_code(400);
            $title = "Bad Request";
            require("views/error404.view.php");
            exit;
        }
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

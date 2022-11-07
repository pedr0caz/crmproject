<?php

if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"])) {
        require("models/employee.model.php");
        require("models/users.model.php");
        require("models/task.model.php");
        require("models/project.model.php");
        $employeesModel = new Employee();
        $taskModel = new Task();
        $projectsModel = new Project();
        $employees = $employeesModel->getEmployees();
        $taskLabels = $taskModel->getLabels();
        $taskCategories = $taskModel->getCategoriesTask();
        if (isset($id) && $id == null) {
            if ($_SESSION["user_role"] == 1) {
                $tasks = $taskModel->getTasksAdmin();
            } elseif ($_SESSION["user_role"] == 2) {
                $tasks = $taskModel->getTasks($_SESSION["user_id"]);
            } elseif ($_SESSION["user_role"] == 3) {
                $tasks = $taskModel->getTasksOfProjects($_SESSION["user_client_id"]);
            }
           
        
            $title = TASKS_TITLE;
            require("views/task/task.view.php");
        } elseif ($_SESSION["user_role"] <= 2 && isset($id) && $id == "create") {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {
                    $project_id = $_GET['project_id'];
                    if ($_SESSION["user_role"] == 1) {
                        $employees = $employeesModel->getMembersOfProject($project_id);
                    } elseif ($_SESSION["user_role"] == 2) {
                        $employees = $employeesModel->getMembersOfMyProjects($project_id, $_SESSION["user_id"]);
                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($employees);
                    exit;
                } elseif (isset($_GET['noproject'])) {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($employees);
                    exit;
                } elseif (isset($_GET['taskCategory']) && $_GET['taskCategory'] == 'delete' && $_SESSION['user_role'] == 1) {
                    if (isset($_POST['catId']) && !empty($_POST['catId'])) {
                        $category_id = $_POST['catId'];
                        $category = $taskModel->deleteCategoryTask($category_id);
                        if ($category) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'catId' => $category]);
                            exit;
                        }
                    }
                } elseif (isset($_GET['taskCategory']) && $_GET['taskCategory'] == 'add' && $_SESSION['user_role'] == 1) {
                    if (isset($_POST['category_name']) && !empty($_POST['category_name'])) {
                        $category_name = $_POST['category_name'];
                        $category = $taskModel->newCategoryTask($category_name);
                        if ($category) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'catId' => $category, 'catName' => $category_name ]);
                            exit;
                        }
                    }
                } elseif (isset($_GET['taskCategory']) && $_GET['taskCategory'] == 'edit' && $_SESSION['user_role'] == 1) {
                    if (isset($_POST['category_name']) && !empty($_POST['category_name']) && isset($_POST['id']) && !empty($_POST['id'])) {
                        $category = $taskModel->editCategoryTask($_POST['id'], $_POST['category_name']);
                        if ($category) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'data' => $_POST['category_name']]);
                            exit;
                        }
                    }
                } elseif (isset($_GET['submit'])) {
                    if (isset($_POST['heading']) && !empty($_POST['heading']) &&
                        isset($_POST['description']) && !empty($_POST['description']) &&
                        isset($_POST['task_id']) && !empty($_POST['task_id']) &&
                        isset($_POST['start_date']) && !empty($_POST['start_date']) &&
                        isset($_POST['due_date']) && !empty($_POST['due_date']) &&
                        isset($_POST['task_status']) && !empty($_POST['task_status']) &&
                        isset($_POST['priority']) && !empty($_POST['priority']) &&
                        isset($_POST['user_id']) && !empty($_POST['user_id'])) {
                        $task_cat_id = $_POST['task_id'];
                        $heading = $_POST['heading'];
                        $description = $_POST['description'];
                        $start_date = $_POST['start_date'];
                        $due_date = $_POST['due_date'];
                        $task_status = $_POST['task_status'];
                        $priority = $_POST['priority'];
                        $project_id = $_POST['project_id'] ? $_POST['project_id'] : null;
                        if ($project_id != null) {
                            if ($_SESSION["user_role"] == 2) {
                                $employees = $employeesModel->getMembersOfMyProjects($project_id, $_SESSION["user_id"]);
                                if (empty($employees)) {
                                    header('Content-Type: application/json; charset=utf-8');
                                    echo json_encode(['status' => 'error', 'message' => TASK_NOT_ALLOWED_TO_THIS_PROJECT]);
                                    die();
                                }
                            }
                        }
                        if ($priority == 1) {
                            $priority = 'Low';
                        } elseif ($priority == 2) {
                            $priority = 'Medium';
                        } elseif ($priority == 3) {
                            $priority = 'High';
                        }
                        $added_by = $_SESSION['user_id'];
                        $users_assigned = $_POST['user_id'];
        
                        $task = $taskModel->addTask($heading, $description, $due_date, $start_date, $project_id, $priority, $task_status, $added_by, $users_assigned, $task_cat_id);
                      
                        if ($task) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'task_id' => $task, 'message' => TASK_ADDED_SUCCESS]);
                            exit;
                        }
                    } else {
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['status' => 'error']);
                        exit;
                    }
                }
            } else {
                if ($_SESSION["user_role"] == 1) {
                    $projects = $projectsModel->getProjects();
                } elseif ($_SESSION["user_role"] == 2) {
                    $projects = $employeesModel->getProjectsOfEmployee($_SESSION["user_id"]);
                }

                $title = G_ADD_TASK;
                require("views/task/addtask.view.php");
            }
        } elseif (isset($id) && is_numeric($id)) {
            $edit = false;
            if ($_SESSION["user_role"] == 1) {
                $edit = true;
                $task = $taskModel->getTaskAdmin($id);
                $projects = $projectsModel->getProjects();
            } elseif ($_SESSION["user_role"] == 2) {
                $task = $taskModel->getTask($id, $_SESSION["user_id"]);
                if ($task['added_by'] == $_SESSION["user_id"]) {
                    $edit = true;
                }
                $projects = $employeesModel->getProjectsOfEmployee($_SESSION["user_id"]);
            } else {
                $task = $taskModel->getTasksOfProject($_SESSION["user_client_id"], $id);
                $projects = $projectsModel->getProjectByClientID($_SESSION["user_client_id"]);
            }

            if (empty($task)) {
                http_response_code(404);
                $title = "Not Found";
                require("views/error404.view.php");
                exit;
            }
            $taskEmployees = $taskModel->getEmployeeAssignedToTask($id);

            if (!isset($_GET['edit'])) {
                if ($_SERVER["REQUEST_METHOD"] == "POST"  && $_SESSION["user_role"] <= 3) {
                    if (isset($_GET["action"]) && $_GET["action"] == "change_task_status" && $_SESSION["user_role"] == 1) {
                        $result = $taskModel->changeTaskStatus($id, $_POST["status"]);
                        if ($result) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'message' => TASK_STATUS_SUCESSS]);
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error', 'message' => TASK_STATUS_ERROR]);
                        }
                    } elseif (isset($_GET["action"]) && $_GET["action"] == "uploadfile" && $_SESSION["user_role"] <= 2) {
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
                        $data =  $taskModel->newFile($id, $_SESSION['user_id'], $_POST['name'], $newFilepath);
        
                        if ($data) {
                            $time = date_diff(date_create('now'), date_create($data['created_at']));
                            if ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') == 0) {
                                $time = $time->format('%s '.G_SECONDS.' '.G_AGO);
                            } elseif ($time->format('%a') == 0 && $time->format('%h') == 0 && $time->format('%i') > 0) {
                                $time = $time->format('%i '.G_MINUTES.' '.G_AGO);
                            } elseif ($time->format('%a') == 0 && $time->format('%h') > 0) {
                                $time = $time->format('%h '.G_HOURS.' '.G_AGO);
                            } else {
                                $time = $time->format('%a '.G_DAYS.' '.G_AGO);
                            }
                            $data = '<div class="card bg-white border-grey file-card mr-3 mb-3" data-fileid="'.$data['id'].'">
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
                                        </button>
        
                                        <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0" aria-labelledby="dropdownMenuLink" tabindex="0">
        
                                            <a class="cursor-pointer d-block text-dark-grey f-13 pt-3 px-3 " target="_blank" href="'.ROOT."/".$data['filename'].'">'.G_VIEW.'</a>
        
                                            <a class="cursor-pointer d-block text-dark-grey f-13 py-3 px-3 " href="'.ROOT."/".$data['filename'].'">Download</a>
        
                                            <a class="cursor-pointer d-block text-dark-grey f-13 pb-3 px-3 delete-file" data-row-id="'.$data['id'].'" href="javascript:;">'.G_DELETE.'</a>
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
                            echo json_encode(['status' => 'success', 'message' => SWAL_FILE_ADDED, 'data' => $data]);
                        }
                    } elseif (isset($_GET['action']) && $_GET["action"] == "deletefile" && $_SESSION["user_role"] <= 2) {
                        if (isset($_POST['id']) && !empty($_POST['id'])) {
                            if ($_SESSION["user_role"] == 1) {
                                $data = $taskModel->deleteFileAdmin($_POST['id'], $id);
                            } else {
                                $data = $taskModel->deleteFile($_POST['id'], $id, $_SESSION['user_id']);
                            }
                            if ($data) {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'success', 'message' => SWAL_FILE_REMOVED]);
                            } else {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'error', 'message' => SWAL_FILE_ERROR]);
                            }
                        }
                    } elseif (isset($_GET['action']) && $_GET['action'] == "addcomment" && $_SESSION["user_role"] <= 2) {
                        if (isset($_POST['comment']) && mb_strlen($_POST['comment']) > 2) {
                            $comment = $taskModel->addCommentTask($id, $_SESSION['user_id'], $_POST['comment']);
                      
                            if ($comment) {
                                $image_user = $comment['user_image'] ? ROOT.'/'.$comment['user_image'] : 'https://www.gravatar.com/avatar/3ea58e77e21cabdfeabbfd844cbabbca.png?s=200&d=mp';
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
                         
                            
                                $dataMessage = '<div class="card w-100 rounded-0 border-0 comment">
                            <div class="card-horizontal">
                                <div class="card-img my-1 ml-0">
                                <img src="'.$image_user.'"
                                alt="'.$comment['user_name'].'">
                                </div>
                                <div class="card-body border-0 pl-0 py-1">
                                    <div class="d-flex flex-grow-1">
                                        <h4 class="card-title f-15 f-w-500 text-dark mr-3">'.$comment['user_name'].'
                                        </h4>
                                        <p class="card-date f-11 text-lightest mb-0">
                                        '.$time.'
                                        </p>
                                        <div class="dropdown ml-auto comment-action">
                                            <button class="btn btn-lg f-14 p-0 text-lightest text-capitalize rounded  dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             
                                            <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0" aria-labelledby="dropdownMenuLink" tabindex="0">
                                                <a class="cursor-pointer d-block text-dark-grey f-13 py-3 px-3 edit-comment" href="javascript:;" data-row-id="'.$comment['id'].'">Edit</a>
                                                <a class="cursor-pointer d-block text-dark-grey f-13 pb-3 px-3 delete-comment" data-row-id="'.$comment['id'].'" href="javascript:;">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-text f-14 text-dark-grey text-justify">
                                        '.$comment['comment'].'
                                    </div>
                                </div>
                            </div>
                        </div>';
                                header('Content-Type: application/json; charset=utf-8');
        
                                echo json_encode(['status' => 'success', 'message' => TASK_COMMENT_ADDED , 'data' =>  $dataMessage]);
                            } else {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'error', 'message' => TASK_COMMENT_ERROR]);
                            }
                        }
                    } elseif (isset($_GET['action']) && $_GET['action'] == "deletecomment" && $_SESSION['user_role'] <= 2) {
                        $comment = $taskModel->deleteCommentTask($_POST['id']);
                        if ($comment) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'message' => TASK_COMMENT_DELETED]);
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error', 'message' => TASK_COMMENT_DELETE_ERROR]);
                        }
                    } elseif (isset($_GET['action']) && $_GET['action'] == "delete_task" && $_SESSION['user_role'] <= 2) {
                        if ($_SESSION['user_role'] == 1) {
                            $task = $taskModel->deleteTaskAdmin($_POST['task_id']);
                        } else {
                            $task = $taskModel->deleteTask($_POST['task_id'], $_SESSION['user_id']);
                        }
                   
                        if ($task) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'message' => TASK_DELETED_SUCCESS]);
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error', 'message' => TASK_DELETE_ERROR]);
                        }
                    }
                } else {
                    $taskFiles = $taskModel->getTaskFiles($id);
                    $taskComments = $taskModel->getCommentsTask($id);
                    $taskHistory = $taskModel->getTaskHistory($id);
                    $title = TASK_DETAILS;
                    require("views/task/taskdetails.view.php");
                }
            } elseif (isset($_GET['edit']) && $_SESSION['user_role'] <= 2) {
                if ($edit == false) {
                    http_response_code(400);
                    $title = "Bad Request";
                    require("views/error400.view.php");
                    exit;
                }
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_GET['submit'])) {
                        if (isset($_POST['heading']) && !empty($_POST['heading']) &&
                            isset($_POST['description']) && !empty($_POST['description']) &&
                            isset($_POST['task_id']) && !empty($_POST['task_id']) &&
                            isset($_POST['start_date']) && !empty($_POST['start_date']) &&
                            isset($_POST['due_date']) && !empty($_POST['due_date']) &&
                            isset($_POST['task_status']) && !empty($_POST['task_status']) &&
                            isset($_POST['priority']) && !empty($_POST['priority']) &&
                            isset($_POST['user_id']) && !empty($_POST['user_id'])) {
                            $task_cat_id = $_POST['task_id'];
                            $heading = $_POST['heading'];
                            $description = $_POST['description'];
                            $start_date = $_POST['start_date'];
                            $due_date = $_POST['due_date'];
                            $task_status = $_POST['task_status'];
                            $priority = $_POST['priority'];
                            $project_id = $_POST['project_id'] ? $_POST['project_id'] : null;
                            if ($priority == 1) {
                                $priority = 'Low';
                            } elseif ($priority == 2) {
                                $priority = 'Medium';
                            } elseif ($priority == 3) {
                                $priority = 'High';
                            }
                            $added_by = $_SESSION['user_id'];
                            $users_assigned = $_POST['user_id'];
        
                            $task = $taskModel->editTask($id, $heading, $description, $due_date, $start_date, $project_id, $priority, $task_status, $added_by, $users_assigned, $task_cat_id);
                            if ($task) {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'success', 'task_id' => $id, 'message' => TASK_EDITED_SUCCESS]);
                            }
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error']);
                        }
                    }
                } else {
                    $taskEmployeesIds = array();
                    foreach ($taskEmployees as $employee) {
                        $taskEmployeesIds[] = $employee["user_id"];
                    }
                
                    $title  = G_EDIT . ' ' . G_TASK;
                    require("views/task/edittask.view.php");
                }
            } else {
                http_response_code(400);
                $title = "Bad Request";
                require("views/error400.view.php");
                exit;
            }
        } else {
            http_response_code(400);
            $title = "Bad Request";
            require("views/error400.view.php");
            exit;
        }
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

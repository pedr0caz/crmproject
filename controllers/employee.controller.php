<?php

if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"])) {
        require("models/employee.model.php");
        require("models/users.model.php");
        require("models/task.model.php");
        $user = new User();
        $employeeModel = new Employee();
        $taskModel = new Task();
        $countries = $user->getCountries();
        $roles = $employeeModel->getRoles();
        $designations = $employeeModel->getDesignations();
        $departments = $employeeModel->getDepartments();
        $taskLabels = $taskModel->getLabels();
        if (isset($id) && $id == null && $_SESSION['user_role'] <= 1) {
            $title = "Employees";
            $employees = $employeeModel->getEmployees();
            require_once("views/employee/employee.view.php");
        } elseif ($_SESSION["user_role"] <= 1 && isset($id) && $id == "create") {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_GET['submit'])) {
                    if (isset($_POST["name"]) && mb_strlen($_POST["name"]) > 0 &&
                    isset($_POST["email"]) && mb_strlen($_POST["email"]) > 0 && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
                    isset($_POST["password"]) && mb_strlen($_POST["password"]) > 8 &&
                    isset($_POST["designation_id"]) && is_numeric($_POST["designation_id"])  &&
                    isset($_POST["department_id"])  &&
                    isset($_POST["mobile"]) && mb_strlen($_POST["mobile"]) > 0 && is_numeric($_POST["mobile"]) &&
                    isset($_POST["country_id"]) && is_numeric($_POST["country_id"]) &&
                    isset($_POST["gender"]) && mb_strlen($_POST["gender"]) > 0 &&
                    isset($_POST["joining_date"]) && mb_strlen($_POST["joining_date"]) > 0) {
                        if (isset($_FILES["uploadfile"]) && $_FILES["uploadfile"]["size"] > 0) {
                            $filepath = $_FILES["uploadfile"]["tmp_name"];
                            $fileSize = $_FILES["uploadfile"]["size"];
                            $fileinfot = finfo_open(FILEINFO_MIME_TYPE);
                            $fileType = finfo_file($fileinfot, $filepath);
                            $allowedTypes = [
                                'image/png' => 'png',
                                'image/jpeg' => 'jpg',
                                'image/jpg' => 'jpg',
                                'image/gif' => 'gif'
    
                             ];
                            if (!array_key_exists($fileType, $allowedTypes)) {
                                header('Content-Type: application/json; charset=utf-8');
                                die(json_encode(['status' => 'error', 'message' => 'File type not allowed']));
                            }
                            $filename = basename($filepath);
                            $extension = $allowedTypes[$fileType];
                            $targetDirectory = 'uploads/';
                            $newFilepath = $targetDirectory . $filename . "." . $extension;
                            if (!copy($filepath, $newFilepath)) {
                                die(json_encode(['status' => 'error', 'message' => 'File upload failed']));
                            }
                            unlink($filepath);
                        } else {
                            $newFilepath = null;
                        }
    
                        $employee = $employeeModel->newEmployee($_POST, $newFilepath);
                  
                        if ($employee["status"]) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'message' => 'Employee added successfully']);
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error', 'message' => $employee["message"]]);
                        }
                    } else {
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['status' => 'error', 'message' => 'Please fill all the fields']);
                        exit;
                    }
                } elseif (isset($_GET['emplooyeDesignation']) &&  $_GET['emplooyeDesignation'] == 'edit') {
                    if (isset($_POST['designation_name']) && !empty($_POST['designation_name']) && isset($_POST['id']) && !empty($_POST['id'])) {
                        $designation = $employeeModel->editDesignation($_POST['id'], $_POST['designation_name']);
                        if ($designation) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'data' => $_POST['designation_name']]);
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error']);
                        }
                    }
                } elseif (isset($_GET['emplooyeDesignation']) && $_GET['emplooyeDesignation'] == 'delete') {
                    if (isset($_POST['catId']) && !empty($_POST['catId'])) {
                        $designation_id = $_POST['catId'];
                        $designation = $employeeModel->deleteDesignation($designation_id);
                        if ($designation) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'catId' => $designation]);
                        }
                    }
                } elseif (isset($_GET['emplooyeDesignation']) && $_GET['emplooyeDesignation'] == 'add') {
                    if (isset($_POST['designation_name']) && !empty($_POST['designation_name'])) {
                        $designation_name = $_POST['designation_name'];
                        $designation = $employeeModel->newDesignation($designation_name);
                        if ($designation) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'catId' => $designation, 'catName' => $designation_name ]);
                        }
                    }
                } elseif (isset($_GET['emplooyeDepartment']) &&  $_GET['emplooyeDepartment'] == 'edit') {
                    if (isset($_POST['department_name']) && !empty($_POST['department_name']) && isset($_POST['id']) && !empty($_POST['id'])) {
                        $department = $employeeModel->editDepartment($_POST['id'], $_POST['department_name']);
                        if ($department) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'data' => $_POST['department_name']]);
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error']);
                        }
                    }
                } elseif (isset($_GET['emplooyeDepartment']) && $_GET['emplooyeDepartment'] == 'delete') {
                    if (isset($_POST['catId']) && !empty($_POST['catId'])) {
                        $department_id = $_POST['catId'];
                        $department = $employeeModel->deleteDepartment($department_id);
                        if ($department) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'catId' => $department]);
                        }
                    }
                } elseif (isset($_GET['emplooyeDepartment']) && $_GET['emplooyeDepartment'] == 'add') {
                    if (isset($_POST['department_name']) && !empty($_POST['department_name'])) {
                        $department_name = $_POST['department_name'];
                        $department = $employeeModel->newDepartment($department_name);
                        if ($department) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'catId' => $department, 'catName' => $department_name ]);
                        }
                    }
                }
            } else {
                $title = "Add Employee";
                require("views/employee/addemployee.view.php");
            }
        } elseif (isset($id) && is_numeric($id) && $_SESSION['user_role'] <= 1) {
            $employee = $employeeModel->getEmployee($id);
            if (empty($employee)) {
                http_response_code(404);
                $title = "Not Found";
                require("views/error404.view.php");
                exit;
            }
            if (!isset($_GET['edit'])) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_GET["delete"]) && isset($_POST["user_id"]) && !empty($_POST["user_id"]) && is_numeric($_POST["user_id"]) && $_POST["user_id"] != $_SESSION["user_id"]) {
                        $user_id = $_POST["user_id"];
                        $result = $employeeModel->deleteEmployee($user_id);
                        if ($result["status"]) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'message' => 'Deleted successfully']);
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error', 'message' => 'Cannot be deleted']);
                        }
                    } elseif (isset($_GET["role"]) && isset($_POST["user_id"]) && !empty($_POST["user_id"]) && isset($_POST["role_id"]) && !empty($_POST["role_id"])) {
                        $user_id = $_POST["user_id"];
                        $result = $employeeModel->changeRole($user_id, $_POST["role_id"]);
                        if ($result['status']) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'message' => 'Role was changed']);
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error', 'message' => 'Error trying to change role']);
                        }
                    } elseif (isset($_GET['action']) && $_GET["action"] == "uploadfile") {
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
                        $data = $employeeModel->newFile($id, $_POST['name'], $newFilepath);
            
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
                    }
                } else {
                    $teams = $employeeModel->getEmployeeTeams($id);
                    $NumberOfProjects = $employeeModel->getNumberOfProjects($id);
                    $NumberOfIncompleteTasks = $employeeModel->getNumberOfTasks($id);
                    $getUserActivity = $employeeModel->getActivity($id);
                    $projects = $employeeModel->getProjectsOfEmployee($id);
                    $employeeFiles = $employeeModel->getFiles($id);
                    $getEmployeeTasks = $employeeModel->getEmployeeTasks($id);

                    $title = "Employee Details" . " - " . $employee["name"];

                    require("views/employee/employeedetails.view.php");
                }
            } elseif (isset($_GET['edit']) && $_SESSION['user_role'] <= 1) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                } else {
                    $title = "Edit Employee";
                    require("views/employee/editemployee.view.php");
                }
            }
        }
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

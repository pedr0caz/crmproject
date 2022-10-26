<?php

if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 1) {
        require("models/employee.model.php");
        require("models/users.model.php");

        $user = new User();
        $employeeModel = new Employee();
        $countries = $user->getCountries();
        $designations = $employeeModel->getDesignations();
        $departments = $employeeModel->getDepartments();
        if (isset($id) && $id != null && $id == "save" && $_SERVER["REQUEST_METHOD"] == "POST") {
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
        } else {
            $title = "Add Employee";
            require("views/addemployee.view.php");
        }
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

<?php


if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"])) {
        require_once("models/users.model.php");
        require("models/employee.model.php");
        require("models/client.model.php");
               
        $userModel = new User();
        $employeeModel = new Employee();
        $clientModel = new Client();
        $user = $userModel->getUser($_SESSION["user_id"]);
        $countries = $userModel->getCountries();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_GET['submit'])) {
                if (isset($_POST['name']) && mb_strlen($_POST['name']) > 2 &&
                isset($_POST['email']) && mb_strlen($_POST['email']) > 2 && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
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
                        $newFilepath = $user["image"];
                    }
                    if ($_POST["password"] != "") {
                        $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    } else {
                        $_POST["password"] = $user["password"];
                    }


                   
                    $result = $userModel->updateUser($_SESSION["user_id"], $_POST["name"], $_POST["email"], $_POST["mobile"], $_POST["country_id"], $newFilepath);
                    if ($result["status"]) {
                        $_SESSION["user_name"] = $_POST["name"];
                        $_SESSION["user_email"] = $_POST["email"];
                        $_SESSION["user_image"] = $newFilepath;
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['status' => 'success', 'message' => 'Details updated successfully']);
                        exit;
                    } else {
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['status' => 'error', 'message' => $result["message"]]);
                        exit;
                    }
                } else {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['status' => 'error', 'message' => 'Please fill all fields']);
                    exit;
                }
            } elseif (isset($_GET['uploadfile'])) {
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
                if ($_SESSION["user_role"] <= 2) {
                    $data = $employeeModel->newFile($_SESSION["user_id"], $_POST['name'], $newFilepath);
                } else {
                    $data = $clientModel->newFile($_SESSION["user_id"], $_POST['name'], $newFilepath);
                }
               
    
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
                    echo json_encode(['status' => 'success', 'message' => SWAL_FILE_ADDED, 'data' => $data]);
                }
            }
        } else {
            if ($_SESSION['user_role'] <= 2) {
                $files = $employeeModel->getFiles($_SESSION["user_id"]);
            } else {
                $files = $clientModel->getFiles($_SESSION["user_id"]);
            }
            $title = G_PROFILE;
            require("views/profile/profile.view.php");
        }
    }
}

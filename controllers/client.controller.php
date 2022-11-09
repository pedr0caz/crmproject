<?php
if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"])) {
        require("models/client.model.php");
        require("models/project.model.php");
        require("models/employee.model.php");
        require("lib/mail.php");
        $clientModel = new Client();
        $employeeModel = new Employee();
        $projectsModel = new Project();
        $mail = new MailTemplate();
        $clientCategories = $clientModel->getCategories();
        $countries = $clientModel->getCountries();
        if (isset($id) && $id == null &&  $_SESSION["user_role"] == 1) {
            if ($_SESSION["user_role"] == 1) {
                $clients = $clientModel->getClients();
            }
            $title = G_CLIENTS;
            require("views/client/clients.view.php");
        } elseif ($_SESSION["user_role"] <= 1 && isset($id) && $id == "create") {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                foreach ($_POST as $key=>$value) {
                    if (is_array($_POST[$key])) {
                        foreach ($_POST[$key] as $k=>$v) {
                            $_POST[$key][$k] = htmlspecialchars($v);
                        }
                    } else {
                        $_POST[$key] = htmlspecialchars($value);
                    }
                }
                if (isset($_GET["submit"])) {
                    if (isset($_POST["name"]) && mb_strlen($_POST["name"]) > 0 &&
                    isset($_POST["email"]) && mb_strlen($_POST["email"]) > 0 && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
                    isset($_POST["password"]) && mb_strlen($_POST["password"]) > 8 &&
                    isset($_POST["country_id"]) && is_numeric($_POST["country_id"]) &&
                    isset($_POST["mobile"]) && mb_strlen($_POST["mobile"]) > 0 && is_numeric($_POST["mobile"]) &&
                    isset($_POST["category_id"]) && is_numeric($_POST["category_id"])) {
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
                            $filename = uniqid() . "-" . time();
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

                        

                        $client = $clientModel->newClient($_POST, $newFilepath);
                        
                        if ($client["status"]) {
                            if (isset($_POST["login"]) && $_POST["login"] == "enable" && isset($_POST["password"]) && mb_strlen($_POST["password"]) > 8) {
                                $body = "<p>Hi " . $_POST["name"] . ",</p>
                                <p>Your account has been activated to login by an admin</p>
                                <br>
                                <p>Password is :</p>
                                <p>" . $_POST["password"] . "</p>";
                                $subject = "Account for access to CRM is activated";
                                $to = $_POST["email"];
                                $mail->sendMail($to, $subject, $body);
                            }
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'message' => 'Client added successfully', 'id' => $client["id"]]);
                            exit;
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error', 'message' => 'Client not added']);
                            exit;
                        }
                    } else {
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['status' => 'error', 'message' => 'Fill all fields']);
                    }
                } elseif (isset($_GET['clientCategory']) &&  $_GET['clientCategory'] == 'edit') {
                    if (isset($_POST['category_name']) && !empty($_POST['category_name']) && isset($_POST['id']) && !empty($_POST['id'])) {
                        $category = $clientModel->editCategory($_POST['id'], $_POST['category_name']);
                        if ($category) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'data' => $_POST['category_name']]);
                            exit;
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error']);
                            exit;
                        }
                    }
                } elseif (isset($_GET['clientCategory']) &&  $_GET['clientCategory'] == 'add') {
                    if (isset($_POST['category_name']) && !empty($_POST['category_name'])) {
                        $category = $clientModel->newCategory($_POST['category_name']);
                        if ($category) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'catId' => $category , 'catName' => $_POST['category_name'] ]);
                            exit;
                        }
                    }
                } elseif (isset($_GET['clientCategory']) &&  $_GET['clientCategory'] == 'delete') {
                    if (isset($_POST['catId']) && !empty($_POST['catId'])) {
                        $category_id = $_POST['catId'];
                        $category = $clientModel->deleteCategory($category_id);
                        if ($category) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'catId' => $category]);
                            exit;
                        }
                    }
                }
            } else {
                $title = G_ADD . ' ' . G_CLIENT;
                require("views/client/addclient.view.php");
            }
        } elseif ($_SESSION["user_role"] <= 1 && isset($id) && $id != null && $id == "import") {
            if (isset($_GET['file'])) {
                if ($_FILES['file']['name'] != '') {
                    if (isset($_POST['heading'])) {
                        $heading = true;
                    } else {
                        $heading = false;
                    }
                    $file_array = explode(".", $_FILES['file']['name']);
                    $extension = end($file_array);
                    if ($extension == 'csv') {
                        $file_data = fopen($_FILES['file']['tmp_name'], 'r');
                        $html = '<div class="col-sm-12">';
                        $html .= '<form method="POST" id="process-client-data-form" >';
                        $html .= '<div class="add-client bg-white rounded">';
                        $html .= '<h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">'.CLIENT_IMPORT_UPLOAD.'</h4>';
                        $html .= '<div class="col-12">';
                        $html .= '<p class="mt-3"><p class="mt-3">'.CLIENT_IMPORT_UPLOAD_INFO.'</p>';
                        $html .= '<div class="alert alert-warning" id="requiredColumnsUnmatched" style="">'.CLIENT_IMPORT_UPLOAD_INFO2.'</div>';
                        $html .= '</div>';
                        $html .= '<div class="col-12" style="overflow-x: auto;">';
                        $html .= '<table>';
                        $html .= '<tbody>';
                        $html .= '<tr>';
                        $test = [];
                        $file_header = $heading ? fgetcsv($file_data) : null;
                        while (($row = fgetcsv($file_data)) !== false) {
                            $test[] = $row;
                        }
                        $test2 = [];
                        $test3 = [];
                        for ($count = 0; $count < count($test[0]); $count++) {
                            $file_header ? $test3[] = $file_header[$count] : null;
                            $html .= '<td valign="top">
                            <div class="row importBox border-grey unmatched" id="box_'.$count .'" data-key="'.$count .'">
                                <div class="importOptions w-100">
                                    <div class="col-sm-12 p-0">
                                    </div>
                                    <div class="selectColumnNameBox" id="selectColumnNameBox_'.$count .'" style="">
                                        <div class="col-sm-12 p-0">
                                            <div class="form-group">
                                                <label class="control-label">'.CLIENT_IMPORT_COLUMN_NAME.'</label>
                                                <div id=selectOptionList_'.$count .'>
                                                    <select class="form-control selectpicker mb-2 dropup" name="columnName_'.($count + 1).'" title="Choose Column Name" data-size="5" data-live-search="true"  id="columnName_'.($count + 1).'">
                                                   
                                                        <option value="name">'.CLIENT_NAME.'</option>
                                                        <option value="email">Email</option>
                                                        <option value="mobile">'.G_MOBILE.'</option>
                                                        <option value="gender">'.G_GENDER.'</option>
                                                        <option value="company_name">'.CLIENT_COMPANY_NAME.'</option>
                                                        <option value="address">'.CLIENT_COMPANY_ADDRESS.'</option>
                                                        <option value="city">'.G_CITY.'</option>
                                                        <option value="state">'.G_STATE.'</option>
                                                        <option value="postal_code">'.G_ZIP.'</option>
                                                        <option value="company_phone">'.G_PHONE .'</option>
                                                        <option value="company_website">'.CLIENT_COMPANY_WEB.'</option>
                                                        <option value="gst_number">'.CLIENT_COMPANY_VAT.'</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            $html .= '<div class="importSample w-100">';
                            foreach ($test as $key => $value) {
                                $html .= '<p class="sample">'.$value[$count].'</p>';
                                $test2[$count][] = $value[$count];
                            }
                            $html .= '</div>';
                            $html .= '</div>';
                            $html .= '</td>';
                        }

                        $html .= '</tr></tbody></table></div>';
                        $html .= '<div class="w-100 border-top-grey d-block d-lg-flex d-md-flex justify-content-start px-4 py-3">
                        <button type="button" disabled="disabled" class="btn-primary rounded f-14 p-2 mr-3" id="process-client-form">
                            <i class="bi bi-check-circle mr-2"></i>
                            '.G_SAVE.'
                        </button>
                      
                        <a href="" class="btn-cancel rounded f-14 p-2 border-0">
                        '.G_CANCEL.'
                        </a>
                    </div>';
                       
                        fclose($file_data);
                        $_SESSION['tmp_import'] = $test2;
                        $result = array_map(function ($v) {
                            return trim($v, "\xEF\xBB\xBF");
                        }, $test3);
    
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['status' => 'success', 'html' =>  $html, 'test' => $result]);
                    } else {
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['status' => 'error', 'message' => 'Invalid file type']);
                    }
                } else {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['status' => 'error', 'message' => 'Invalid file type']);
                }
            } elseif (isset($_GET['data'])) {
                if (isset($_POST['columnName_1'])) {
                    for ($i = 1; $i <= count($_POST); $i++) {
                        $columnName = $_POST['columnName_'.$i];
                        $columnData = $_SESSION['tmp_import'][$i-1];
                        $data[$columnName] = $columnData;
                    }
                  
                    $data = array_key_exists('name', $data) && array_key_exists('email', $data) ? $data : false;

                    if ($data) {
                        $client = new Client();
                        $result = $client->importClient($data);
                     
                        if ($result['status']) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'message' => $result['message']]);
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error', 'message' => $result['message']]);
                        }
                    } else {
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['status' => 'error', 'message' => G_SOMETHING_WENT_WRONG]);
                    }
                }
            } else {
                $title = G_IMPORT . ' ' . G_CLIENT;
                require("views/client/importclient.view.php");
            }
        } elseif ($_SESSION["user_role"] <= 1 && isset($id) && is_numeric($id)) {
            $client = $clientModel->getClient($id);
            if (empty($client)) {
                http_response_code(404);
                $title = "Not Found";
                require("views/error404.view.php");
                exit;
            }
            if (!isset($_GET['edit'])) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    foreach ($_POST as $key=>$value) {
                        if (is_array($_POST[$key])) {
                            foreach ($_POST[$key] as $k=>$v) {
                                $_POST[$key][$k] = htmlspecialchars($v);
                            }
                        } else {
                            $_POST[$key] = htmlspecialchars($value);
                        }
                    }
                    if (isset($_GET['delete'])) {
                        if (isset($_POST['user_id']) && !empty($_POST['user_id']) && is_numeric($_POST['user_id'])) {
                            if ($client['user_id'] != $_POST['user_id']) {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'error', 'message' => 'Invalid user']);
                                exit;
                            } else {
                                $client = $clientModel->deleteClient($_POST['user_id']);
           
                                if ($client["status"]) {
                                    header('Content-Type: application/json; charset=utf-8');
                                    echo json_encode(['status' => 'success', 'message' => 'Client was deleted']);
                                    exit;
                                } else {
                                    header('Content-Type: application/json; charset=utf-8');
                                    echo json_encode(['status' => 'error', 'message' => 'Error trying to delete']);
                                    exit;
                                }
                            }
                        }
                    } elseif (isset($_GET['notes'])) {
                        if ($_GET['notes'] == "submit") {
                            if (isset($_POST['title']) && mb_strlen($_POST['title']) > 3 && isset($_POST['type']) && is_numeric($_POST['type'])) {
                                $note = $clientModel->newClientNote($id, $_POST, $_SESSION['user_id']);
                                if ($note) {
                                    header('Content-Type: application/json; charset=utf-8');
                                    echo json_encode(['status' => 'success', 'message' => 'Note was added']);
                                    exit;
                                } else {
                                    header('Content-Type: application/json; charset=utf-8');
                                    echo json_encode(['status' => 'error', 'message' => 'Error trying to add note']);
                                    exit;
                                }
                            } else {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
                                exit;
                            }
                        } elseif ($_GET['notes'] == "details" && isset($_POST['id']) && is_numeric($_POST['id'])) {
                            $note = $clientModel->getClientNoteByID($_POST['id'], $_SESSION['user_id'], $id);
                            if ($note) {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'success', 'data' => $note]);
                                exit;
                            } else {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'error', 'message' => 'Error trying to add note']);
                                exit;
                            }
                        } elseif ($_GET['notes'] == "edit" && isset($_GET['id']) && is_numeric($_GET['id'])) {
                            if (isset($_POST['title']) && mb_strlen($_POST['title']) > 3 && isset($_POST['type']) && is_numeric($_POST['type'])) {
                                $note = $clientModel->editClientNoteById($_GET['id'], $_POST);
                                if ($note) {
                                    header('Content-Type: application/json; charset=utf-8');
                                    echo json_encode(['status' => 'success', 'message' => 'Note was edited']);
                                    exit;
                                } else {
                                    header('Content-Type: application/json; charset=utf-8');
                                    echo json_encode(['status' => 'error', 'message' => 'Error trying to edit note']);
                                    exit;
                                }
                            } else {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
                                exit;
                            }
                        } elseif ($_GET['notes'] == "delete" && isset($_POST['id']) && is_numeric($_POST['id'])) {
                            $note = $clientModel->removeClientNote($_POST['id'], $_SESSION['user_id']);
                         
                            if ($note) {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'success', 'message' => 'Note was deleted']);
                                exit;
                            } else {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'error', 'message' => 'Error trying to delete note']);
                                exit;
                            }
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
                        $filename = uniqid() . "-" . time();
                        $extension = $allowedTypes[$fileType];
                        $targetDirectory = 'uploads/';
                        $newFilepath = $targetDirectory . $filename . "." . $extension;
                        if (!copy($filepath, $newFilepath)) {
                            die("Error copying file");
                        }
                        unlink($filepath);
                        $data = $clientModel->newFile($id, $_POST['name'], $newFilepath);
            
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
            
                                                <a class="cursor-pointer d-block text-dark-grey f-13 pt-3 px-3 " target="_blank" href="'.ROOT."/".$data['filename'].'">'.G_VIEW.'</a>
            
                                                <a class="cursor-pointer d-block text-dark-grey f-13 py-3 px-3 " href="'.ROOT."/".$data['filename'].'">Download</a>
            
                                                <a class="cursor-pointer d-block text-dark-grey f-13 pb-3 px-3 delete-file" data-row-id="1" href="javascript:;">'.G_DELETE.'</a>
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
                    } elseif (isset($_GET['action']) && $_GET["action"] == "deletefile") {
                        $file = $clientModel->deleteFile($_POST['id'], $client['user_id']);
                        if ($file) {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'success', 'message' => "Ok"]);
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error', 'message' => "Error"]);
                        }
                    }
                } else {
                    $projects = $projectsModel->getProjectByClientID($id);
                    $notes = $clientModel->getClientNotes($id, $_SESSION['user_id']);
                    $files = $clientModel->getFiles($client['user_id']);
                    $title = G_CLIENT . ' • ' . $client['name'];
                    require("views/client/clientdetails.view.php");
                }
            } elseif (isset($_GET['edit']) && $_SESSION['user_role'] <= 1) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    foreach ($_POST as $key=>$value) {
                        if (is_array($_POST[$key])) {
                            foreach ($_POST[$key] as $k=>$v) {
                                $_POST[$key][$k] = htmlspecialchars($v);
                            }
                        } else {
                            $_POST[$key] = htmlspecialchars($value);
                        }
                    }
                    if (isset($_GET['submit'])) {
                        if (isset($_POST["name"]) && mb_strlen($_POST["name"]) > 0 &&
                        isset($_POST["email"]) && mb_strlen($_POST["email"]) > 0 && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
                        isset($_POST["country_id"]) && is_numeric($_POST["country_id"]) &&
                        isset($_POST["category_id"]) && is_numeric($_POST["category_id"])) {
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
                                $filename = uniqid() . "-" . time();
                                $extension = $allowedTypes[$fileType];
                                $targetDirectory = 'uploads/';
                                $newFilepath = $targetDirectory . $filename . "." . $extension;
                                if (!copy($filepath, $newFilepath)) {
                                    die(json_encode(['status' => 'error', 'message' => 'File upload failed']));
                                }
                                unlink($filepath);
                            } else {
                                $newFilepath = $client["image"] ? $client["image"] : null;
                            }
                            $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) :  $client['password'];
                            
                            if ($_POST["login"] != $client["login"] && $_POST["login"] == "enable") {
                                $body = "<p>Hi " . $client["name"] . ",</p>
                                <p>Your account has been activated to login by an admin</p>
                                <p>If this was a mistake, just ignore this email and nothing will happen.</p>
                                <p>To finish this action ask for reset password, visit the following address:</p>
                                <p><a href='http://localhost/".ROOT."/forgotpassword'>http://localhost/".ROOT."/forgotpassword</a></p>";
                                $subject = "Account Activated";
                                $to = $_POST["email"];
                                $mail->sendMail($to, $subject, $body);
                            }
        

                            $client = $clientModel->editClient($_POST, $client["user_id"], $newFilepath, $password);
                          
                            if ($client["status"]) {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'success', 'message' => 'Client changed successfully', 'id' => $id]);
                            } else {
                                header('Content-Type: application/json; charset=utf-8');
                                echo json_encode(['status' => 'error', 'message' => 'Client was not changed']);
                            }
                        } else {
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode(['status' => 'error', 'message' => 'Fill all fields']);
                        }
                    }
                } else {
                    $title = G_EDIT .' '.G_CLIENT." &bull; ".$client["name"];
                    require("views/client/editclient.view.php");
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

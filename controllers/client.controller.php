<?php
if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"])) {
        require("models/client.model.php");
        require("models/project.model.php");
        require("models/employee.model.php");
        $clientModel = new Client();
        $employeeModel = new Employee();
        $projectsModel = new Project();
        $clientCategories = $clientModel->getCategories();
        $countries = $clientModel->getCountries();
        if (isset($id) && $id == null &&  $_SESSION["user_role"] == 1) {
            if ($_SESSION["user_role"] == 1) {
                $clients = $clientModel->getClients();
            }
            $title = "Client List";
            require("views/client/clients.view.php");
        } elseif ($_SESSION["user_role"] <= 1 && isset($id) && $id == "create") {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                        $client = $clientModel->newClient($_POST, $newFilepath);
                      
                        if ($client["status"]) {
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
                $title = "Create Client";
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
                        $html .= '<form method="POST" id="process-client-data-form">';
                        $html .= '<div class="add-client bg-white rounded">';
                        $html .= '<h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">Import Clients</h4>';
                        $html .= '<div class="col-12">';
                        $html .= '<p class="mt-3"><p class="mt-3">Please sort the data you have uploaded by matching the columns in the CSV to the fields in the associated fields.</p>';
                        $html .= '<div class="alert alert-warning" id="requiredColumnsUnmatched" style="">Following fields are required and must be matched: <strong>Client Name, Email</strong></div>';
                        $html .= '</div>';
                        $html .= '<div class="col-12">';
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
                                                <label class="control-label">Column Name</label>
                                                <div id=selectOptionList_'.$count .'>
                                                    <select class="form-control selectpicker mb-2 dropup" name="columnName_'.($count + 1).'" title="Choose Column Name" data-size="5" data-live-search="true"  id="columnName_'.($count + 1).'">
                                                   
                                                        <option value="name">Client Name</option>
                                                        <option value="email">Email</option>
                                                        <option value="mobile">Mobile</option>
                                                        <option value="gender">Gender</option>
                                                        <option value="company_name">Company Name</option>
                                                        <option value="address">Company Address</option>
                                                        <option value="city">City</option>
                                                        <option value="state">State</option>
                                                        <option value="postal_code">Postal code</option>
                                                        <option value="company_phone">Office Phone Number</option>
                                                        <option value="company_website">Official Website</option>
                                                        <option value="gst_number">GST/VAT Number</option>
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
                            Submit
                        </button>
                      
                        <a href="" class="btn-cancel rounded f-14 p-2 border-0">
                        Cancel
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
                        echo json_encode(['status' => 'error', 'message' => 'Something went wrong, please try again']);
                    }
                }
            } else {
                $title = "Import client";
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
                                } else {
                                    header('Content-Type: application/json; charset=utf-8');
                                    echo json_encode(['status' => 'error', 'message' => 'Error trying to delete']);
                                }
                            }
                        }
                    }
                } else {
                    $projects = $projectsModel->getProjectByClientID($id);
                    $title = "Client Details &bull; ".$client["name"];
                    require("views/client/clientdetails.view.php");
                }
            } elseif (isset($_GET['edit']) && $_SESSION['user_role'] <= 1) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                                $filename = basename($filepath);
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
                    $title = "Edit Client &bull; ".$client["name"];
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

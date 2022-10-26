<?php
    if (!isset($_SESSION["user_id"])) {
        header("Location: " . ROOT . "/login");
        exit;
    } else {
        if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 1) {
            require("models/client.model.php");
            $clientModel = new Client();
            $clientCategories = $clientModel->getCategories();
            $countries = $clientModel->getCountries();
            if (isset($id) && $id != null && $id == "save" && $_SERVER["REQUEST_METHOD"] == "POST") {
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
                    } else {
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['status' => 'error', 'message' => 'Client not added']);
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
                    } else {
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['status' => 'error']);
                    }
                }
            } elseif (isset($_GET['clientCategory']) &&  $_GET['clientCategory'] == 'add') {
                if (isset($_POST['category_name']) && !empty($_POST['category_name'])) {
                    $category = $clientModel->newCategory($_POST['category_name']);
                    if ($category) {
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['status' => 'success', 'catId' => $category , 'catName' => $_POST['category_name'] ]);
                    }
                }
            } elseif (isset($_GET['clientCategory']) &&  $_GET['clientCategory'] == 'delete') {
                if (isset($_POST['catId']) && !empty($_POST['catId'])) {
                    $category_id = $_POST['catId'];
                    $category = $clientModel->deleteCategory($category_id);
                    if ($category) {
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['status' => 'success', 'catId' => $category]);
                    }
                }
            } else {
                $title = "Add Client";
                require("views/addclient.view.php");
            }
        } else {
            header("Location: " . ROOT . "");
            exit;
        }
    }

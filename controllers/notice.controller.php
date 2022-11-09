<?php

if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"])) {
        require_once("models/notices.model.php");
        require_once("models/employee.model.php");
        $noticeModel = new Notices();
        $employeeModel = new Employee();

        if (isset($_SESSION["user_role"]) && isset($id) && $id == null) {
            if ($_SESSION["user_role"] == 1) {
                $notices = $noticeModel->getNoticesAdmin();
            } else {
                $notices = $noticeModel->getNotices($_SESSION["user_role"], $_SESSION["user_id"]);
            }
            
            $title = G_NOTICES;
            require_once("views/notice/notice.view.php");
        } elseif ($_SESSION["user_role"] == "1" && isset($id) && $id == "create") {
            $teams = $employeeModel->getDepartments();
            $title = G_ADD." ".G_NOTICE;
            require_once("views/notice/addnotice.view.php");
        } elseif ($_SESSION["user_role"] == "1" && isset($id) && $id == "save") {
            if (isset($_POST["to"]) && isset($_POST["heading"]) && !empty($_POST["heading"]) && mb_strlen($_POST["heading"]) >= 3) {
                $_POST['to'] = $_POST['to'] == "employee" ? 2 : 3;
           
                $result = $noticeModel->newNotice($_POST, $_SESSION["user_id"]);

                if ($result) {
                    header('Content-Type: application/json; charset=utf-8');

                    echo json_encode(['status' => 'success', 'message' => 'Notice added successfully', 'id' => $result]);
                } else {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['status' => 'error', 'message' => 'Error adding notice']);
                }
            } else {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['status' => 'error', 'message' => 'Fill all required fields']);
            }
        } elseif ($_SESSION["user_role"] == "1" && isset($id) && is_numeric($id) && isset($_GET['edit'])) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                foreach ($_POST as $key=>$value) {
                    if (is_array($_POST[$key])) {
                        foreach ($_POST[$key] as $k=>$v) {
                            $_POST[$key][$k] = htmlspecialchars($v);
                        }
                    } else {
                        $_POST[$key] = htmlspecialchars($value);
                    }
                }
                if (isset($_POST["to"]) && isset($_POST["heading"]) && !empty($_POST["heading"]) && mb_strlen($_POST["heading"]) >= 3) {
                    $_POST['to'] = $_POST['to'] == "employee" ? 2 : 3;
                    $result = $noticeModel->editNotice($_POST, $id);
                 
                    if ($result) {
                        header('Content-Type: application/json; charset=utf-8');
                        
                        echo json_encode(['status' => 'success', 'message' => 'Notice edited successfully']);
                    } else {
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['status' => 'error', 'message' => 'Error adding notice']);
                    }
                }
            } else {
                $notice = $noticeModel->getNoticeAdmin($id);
                $teams = $employeeModel->getDepartments();
                $title = G_EDIT." ".G_NOTICE;
                require_once("views/notice/editnotice.view.php");
            }
        } elseif ($_SESSION["user_role"] == "1" && isset($id) && is_numeric($id) && isset($_GET['delete'])) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                foreach ($_POST as $key=>$value) {
                    if (is_array($_POST[$key])) {
                        foreach ($_POST[$key] as $k=>$v) {
                            $_POST[$key][$k] = htmlspecialchars($v);
                        }
                    } else {
                        $_POST[$key] = htmlspecialchars($value);
                    }
                }
                if (isset($_POST["id"]) && !empty($_POST["id"]) && is_numeric($_POST["id"])) {
                    $result = $noticeModel->deleteNotice($_POST["id"]);
                 
                    if ($result) {
                        header('Content-Type: application/json; charset=utf-8');
                    
                        echo json_encode(['status' => 'success', 'message' => 'Notice deleted successfully']);
                    } else {
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(['status' => 'error', 'message' => 'Error deleting notice']);
                    }
                }
            }
        } elseif (isset($id) && is_numeric($id) && !isset($_GET['edit'])) {
            $title = G_NOTICE;
            if ($_SESSION["user_role"] == "1") {
                $notice = $noticeModel->getNoticeAdmin($id);
            } else {
                $notice = $noticeModel->getNotice($_SESSION["user_role"], $_SESSION["user_id"], $id);
            }
            if (empty($notice)) {
                http_response_code(404);
                $title = "Not Found";
                require_once("views/notice/error404.view.php");
                exit;
            }
           
            require_once("views/notice/noticesdetails.view.php");
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

<?php



if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 1) {
        require("models/project.model.php");
        require("models/client.model.php");
        $projectsModel = new Project();
        $client = new Client();
        $projectCategory = $projectsModel->getProjectCategory();
        $clients = $client->getClients();
       
        $departments = $projectsModel->getDepartments();
        
        if (isset($id) && $id != null && $id == "save" && $_SERVER["REQUEST_METHOD"] == "POST") {
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
                } else {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['status' => 'error', 'message' => $project["message"]]);
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
        } else {
            $title = "Add Project";
            require("views/addproject.view.php");
        }
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

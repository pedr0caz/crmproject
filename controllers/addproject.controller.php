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
        
        if (isset($_POST["submit"])) {
            if (isset($_POST["project_name"]) && isset($_POST["project_summary"]) && isset($_POST["start_date"]) && isset($_POST["deadline"]) && isset($_POST["notes"]) && isset($_POST["category_id"]) && isset($_POST["client_id"]) && isset($_POST["team_id"]) && isset($_POST["team_id"])) {
                $project_name = $_POST["project_name"];
                $project_summary = $_POST["project_summary"];
                $project_admin = $_SESSION["user_id"];
                $_POST['status'] = "Not started";
                $start_date = $_POST["start_date"];
                $deadline = $_POST["deadline"];
                $notes = $_POST["notes"];
                $category_id = $_POST["category_id"];
                $client_id = $_POST["client_id"];
                $team_id = $_POST["team_id"];
   
                $Insert = $projectsModel->newProject($_POST);
                if ($Insert) {
                    header("Location: " . ROOT . "/addproject");
                    exit;
                } else {
                    $error = "Error adding project";
                }
            }
        }

        if ($id === 0) {
            $data = [
             
                "projectCategory" => $projectCategory,
                "clients" => $clients,
                "departments" => $departments,
            ];
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        } else {
            $title = "Add Project";
            require("views/addproject.view.php");
        }
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

<?php

if (empty($id) || !is_numeric($id)) {
    http_response_code(400);
    $title = "Bad Request";
    require("views/error400.view.php");
    exit;
}

if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 1) {
        require("models/client.model.php");
        require("models/project.model.php");
        require("models/employee.model.php");
        $model = new Client();
        $employeeModel = new Employee();
        $projectsModel = new Project();
        $client = $model->getClient($id);
        $projects = $projectsModel->getProjectByClientID($id);
       
        if (empty($client)) {
            http_response_code(404);
            $title = "Not found";
            require("views/error404.view.php");
            exit;
        }
        $title = "Client Details &bull; ".$client["name"];
        require("views/clientdetails.view.php");
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

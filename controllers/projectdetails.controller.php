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
        require("models/project.model.php");

        $projectsModel = new Project();
        $project = $projectsModel->getProject($id);
        $getProjectActivity = $projectsModel->getProjectActivity($id);
        $getProjectTasks = $projectsModel->getProjectTasks($id);
       
        $title = "Projects";
        require("views/projectdetails.view.php");
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

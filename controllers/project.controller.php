<?php



if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 1) {
        require("models/project.model.php");

        $projectsModel = new Project();
        $projects = $projectsModel->getProjects();
        
       
        $title = "Projects";
        require("views/projects.view.php");
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

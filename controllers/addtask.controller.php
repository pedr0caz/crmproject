<?php

if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 1) {
        require("models/employee.model.php");
        require("models/users.model.php");
        require("models/task.model.php");
        require("models/project.model.php");
        $projectsModel = new Project();
        $projects = $projectsModel->getProjects();
        $employeesModel = new Employee();
        $employees = $employeesModel->getEmployees();
        $taskModel = new Task();
        $taskLabels = $taskModel->getLabels();

        if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {
            $project_id = $_GET['project_id'];
            $employees = $employeesModel->getMembersOfProject($project_id);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($employees);
        } elseif (isset($_GET['noproject'])) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($employees);
        } else {
            $title = "Add Task";
            require("views/addtask.view.php");
        }
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

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
        require("models/employee.model.php");
        $employeeModel = new Employee();
        $employee = $employeeModel->getEmployee($id);
        if (empty($employee)) {
            http_response_code(404);
            $title = "Not Found";
            require("views/error404.view.php");
            exit;
        }
        $teams = $employeeModel->getEmployeeTeams($id);
        $NumberOfProjects = $employeeModel->getNumberOfProjects($id);
        $NumberOfIncompleteTasks = $employeeModel->getNumberOfTasks($id);
        $getUserActivity = $employeeModel->getActivity($id);
        $projects = $employeeModel->getProjectsOfEmployee($id);

    

        $title = "Employee Details";
   
        require("views/employeedetails.view.php");
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

<?php
if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    $title = "Dashboard";

    require("models/users.model.php");
    require("models/task.model.php");
    require("models/project.model.php");
    require("models/employee.model.php");
    $usersModel = new User();
    $taskModel = new Task();
    $projectModel = new Project();
    $employeeModel = new Employee();
    $department = $usersModel->getDepartment($_SESSION["user_id"]);
 
    $birthdays = $usersModel->getBirthdays();
    $notices = $usersModel->getNotices($_SESSION["user_id"], $_SESSION["user_role"]);
    if ($_SESSION["user_role"] <= 2) {
        $tasks = $taskModel->getTasks($_SESSION["user_id"]);
        $projects = $employeeModel->getProjectsOfEmployee($_SESSION["user_id"]);
    } else {
        $tasks = $taskModel->getTasksOfProjects($_SESSION["user_client_id"]);
        $projects = $projectModel->getProjectByClientID($_SESSION["user_client_id"]);
    }

    $overdueTasks = 0;
    $incompleteTasks = 0;
    $overdueProjects = 0;
    $incompleteProjects = 0;
    if (!empty($tasks)) {
        foreach ($tasks as $task) {
            $diff = date_diff(date_create('now'), date_create($task['due_date']));
            if ($task['slug'] == 'incomplete') {
                $incompleteTasks++;
            } elseif ($diff->format('%R%a') < 0) {
                if ($diff->format('%R%a') < 0) {
                    $overdueTasks++;
                }
            }
        }
    }
   
    if (!empty($projects)) {
        foreach ($projects as $project) {
            $diff = date_diff(date_create('now'), date_create($project['deadline']));
            if ($project['status'] == 'in complete') {
                $incompleteProjects++;
            } elseif ($diff->format('%R%a') < 0) {
                if ($diff->format('%R%a') < 0) {
                    $overdueProjects++;
                }
            }
        }
    }
   

    require("views/dashboard/home.view.php");
}

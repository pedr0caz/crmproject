<?php

if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 1) {
        require("models/task.model.php");
        require("models/employee.model.php");
        $employeeModel = new Employee();
    
        $task = new Task();
        $tasks = $task->getTasks();
        $taskLabels = $task->getLabels();
     
        $title = "Task List";
        require("views/task.view.php");
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

<?php
if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    $title = "Dashboard";

    require("models/users.model.php");
    require("models/task.model.php");
    $usersModel = new User();
    $taskModel = new Task();
    $department = $usersModel->getDepartment($_SESSION["user_id"]);
 
    $birthdays = $usersModel->getBirthdays();
    $notices = $usersModel->getNotices($_SESSION["user_id"], $_SESSION["user_role"]);
    $tasks = $taskModel->getOwnTasks($_SESSION["user_id"]);

    require("views/home.view.php");
}

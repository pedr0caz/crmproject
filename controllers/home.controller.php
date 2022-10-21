<?php
if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    $title = "Dashboard";

    require("models/users.model.php");

    $usersModel = new User();
    $department = $usersModel->getDepartment($_SESSION["user_id"]);
 
    $birthdays = $usersModel->getBirthdays();
    $notices = $usersModel->getNotices($_SESSION["user_id"], $_SESSION["user_role"]);

    require("views/home.view.php");
}

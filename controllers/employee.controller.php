<?php

if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    require("models/users.model.php");
    $model = new User();
    $role = $model->getRole($_SESSION["user_id"]);
    if (!empty($role) && $role["role"] == "admin") {
        $modelEmployee = new Employee();
        $title = "employee list";
        require("views/employee.view.php");
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

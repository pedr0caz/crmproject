<?php

if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 1) {
        require("models/employee.model.php");
        $modelEmployee = new Employee();
        $employees = $modelEmployee->getEmployees();
        $roles = $modelEmployee->getRoles();
        $title = "Employee List";
        require("views/employee.view.php");
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

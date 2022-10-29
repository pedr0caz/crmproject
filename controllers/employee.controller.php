<?php

if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"])) {
        require("models/employee.model.php");
        $modelEmployee = new Employee();
        $roles = $modelEmployee->getRoles();
        $designations = $modelEmployee->getDesignations();
        $departments = $modelEmployee->getDepartments();
        if (isset($id) && $id == null && $_SESSION['user_role'] <= 1) {
            $title = "Employees";
            $employees = $modelEmployee->getEmployees();
            require_once("views/employee.view.php.view.php");
        }
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

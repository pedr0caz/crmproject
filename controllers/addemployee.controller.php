<?php

if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 1) {
        require("models/employee.model.php");
        require("models/users.model.php");

        $user = new User();
        $modelEmployee = new Employee();
        $countries = $user->getCountries();
        $designations = $modelEmployee->getDesignations();
        $departments = $modelEmployee->getDepartments();
        if (isset($_POST["submit"])) {
            if ($_POST["name"] == "" || $_POST["email"] == "") {
                $error = "All fields are required";
            } else {
                $uploaddir = 'uploads/';
                $uploadfile = $uploaddir . basename($_FILES['uploadfile']['name']);

                if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile)) {
                    $image = $uploadfile;
                    $modelEmployee->newEmployee($_POST, $image);
                } else {
                    $image = "";
                    $modelEmployee->newEmployee($_POST, $image);
                }
            }
        }
        require("views/addemployee.view.php");
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

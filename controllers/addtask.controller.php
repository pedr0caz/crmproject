<?php

if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 1) {
        require("models/employee.model.php");
        require("models/users.model.php");

        require("views/addtask.view.php");
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}

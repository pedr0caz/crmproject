<?php


if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"])) {
        $title = "Profile";
        require("views/profile.view.php");
    }
}

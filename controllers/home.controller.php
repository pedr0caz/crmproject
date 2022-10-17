<?php
if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    $title = "Dashboard";
    require("views/home.view.php");
}

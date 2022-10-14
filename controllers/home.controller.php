<?php
if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    require("models/users.model.php");
    $model = new User();
    $user = $model->getUser($_SESSION["user_id"]);
    if (empty($user)) {
        header("Location: " . ROOT . "/login");
        exit;
    }
}

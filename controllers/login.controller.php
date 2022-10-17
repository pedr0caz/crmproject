<?php
$title = "Efectuar login";

if (!isset($_SESSION["user_id"])) {
    if (isset($_POST["send"])) {
        if (!empty($_POST["email"]) &&
        !empty($_POST["password"]) &&
        filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
        mb_strlen($_POST["password"]) >= 8 &&
        mb_strlen($_POST["password"]) <= 1000
        ) {
            require("models/users.model.php");
            $model = new User();
            $user = $model->login($_POST);
           
            if (!empty($user)) {
                $getUser = $model->getUser($user["id"]);
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["user_name"] = $user["name"];
                $_SESSION["user_role"] = $getUser["role_id"];

                header("Location: " . ROOT . "/");
                exit;
            } else {
                $error = "User or password incorrect";
            }
        }
        $error_message = "Email ou password estão errados";
    }


    require("views/login.view.php");
} else {
    header("Location: " . ROOT . "/");
}

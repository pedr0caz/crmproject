<?php
require_once("controllers/captcha.controller.php");
$captcha = new Captcha();




if (isset($_POST["submit"]) && !isset($_SESSION["user_id"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if ($captcha->checkCaptcha()) {
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
                $_SESSION["user_name"] = $getUser["name"];
                $_SESSION["user_email"] = $getUser["email"];
                $_SESSION["user_image"] = $getUser["image"];
                $_SESSION["user_role"] = $getUser["role_id"];
                if ($getUser["role_id"] == 3) {
                    $_SESSION["user_client_id"] = $getUser["client_id"];
                }
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(["status" => "success", "message" => "Login successful"]);
            } else {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(["status" => "error", "message" => "Invalid email or password"]);
            }
        } else {
            $generate_captcha = $captcha->generateCaptcha();
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(["status" => "error", "message" => "Invalid email or password"]);
        }
    } else {
        $generate_captcha = $captcha->generateCaptcha();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(["status" => "error", "message" => "Invalid captcha"]);
    }
} elseif (isset($id) && $id == "captcha") {
    $generate_captcha = $captcha->generateCaptcha();
    $captcha->showCaptcha();
} elseif (!isset($_SESSION["user_id"])) {
    require("views/login.view.php");
} else {
    header("Location: " . ROOT);
}

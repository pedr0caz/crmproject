<?php
require_once("controllers/captcha.controller.php");
$captcha = new Captcha();




if (isset($_POST["email"]) && !isset($_SESSION["user_id"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if ($captcha->checkCaptcha()) {
        if (!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            require("models/users.model.php");
            $model = new User();
            $user = $model->forgotPassword($_POST);
       
            if (!empty($user)) {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(["status" => "success", "message" => "Email was sent to your email address"]);
            } else {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(["status" => "success", "message" => "Email was sent to your email address"]);
            }
        } else {
            $generate_captcha = $captcha->generateCaptcha();
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(["status" => "error", "message" => "Invalid email"]);
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
    require("views/forgotpassword.view.php");
}

<?php
require_once("lib/captcha.php");
require("models/users.model.php");
$captcha = new Captcha();


if (isset($_POST["submit"]) && !isset($_SESSION["user_id"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if ($captcha->checkCaptcha()) {
        if (!empty($_POST["email"]) &&
        !empty($_POST["password"]) &&
        filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
        mb_strlen($_POST["password"]) >= 3 &&
        mb_strlen($_POST["password"]) <= 1000
        ) {
            $model = new User();
            $user = $model->login($_POST);
          
            if (!empty($user)) {
                if (isset($_POST["remember"]) &&  $_POST["remember"] == 1) {
                    $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);
                  
                    $baseUser = base64_encode($user["email"]);
                    setcookie("member_login", $baseUser, time() + (30 * 24 * 60 * 60));
                    $random_password_key = hash('sha256', uniqid(mt_rand(1, mt_getrandmax()), true));
                    setcookie("random_password", $random_password_key, time() + (30 * 24 * 60 * 60));
                    $result = $model->updateRememberToken($user["id"], $random_password_key, $ip);
                }
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
    if (isset($_COOKIE["member_login"]) && isset($_COOKIE["random_password"])) {
        $model = new User();
        $unbase64 = base64_decode($_COOKIE["member_login"]);
        $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);
                    
        $user = $model->getUserByRememberToken($_COOKIE["random_password"], $unbase64, $ip);
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
            header("Location: " . ROOT . "/home");
            exit;
        } else {
            setcookie("member_login", '', 1);
            setcookie("member_login", '', 1, '/');
            setcookie("random_password", '', 1);
            setcookie("random_password", '', 1, '/');
        }
    }
    require("views/login.view.php");
} else {
    header("Location: " . ROOT);
}

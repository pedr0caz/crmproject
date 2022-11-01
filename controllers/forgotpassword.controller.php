<?php


require_once("lib/captcha.php");
require_once("lib/mail.php");
require("models/users.model.php");
$captcha = new Captcha();
$model = new User();
$mail = new MailTemplate();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        if (isset($_POST["email"])) {
            if ($captcha->checkCaptcha()) {
                if (!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $user = $model->forgotPassword($_POST);
                    if (!empty($user)) {
                        $token = md5(uniqid(rand(), true));
                        $model->updateToken($user["id"], $token);
                        $url = "http://localhost" . ROOT . "/forgotpassword/reset?token=" . $token;
                        $body = "<p>Hi " . $user["name"] . ",</p>
                        <p>Someone requested that the password be reset for the following account:</p>
                        <p>" . $user["email"] . "</p>
                        <p>If this was a mistake, just ignore this email and nothing will happen.</p>
                        <p>To reset your password, visit the following address:</p>
                        <p><a href='" . $url . "'>" . $url . "</a></p>";
                        $mail->sendMail($user["email"], "Password Reset", $body);
                        $generate_captcha = $captcha->generateCaptcha();
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(["status" => "success", "message" => "Email was sent to your email address"]);
                    } else {
                        $generate_captcha = $captcha->generateCaptcha();
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
        } elseif (isset($_POST["password"]) && isset($_POST["token"]) && mb_strlen($_POST["token"]) == 32 && isset($id) && $id == "reset") {
            if ($captcha->checkCaptcha()) {
                if (!empty($_POST["password"]) && mb_strlen($_POST["password"]) >= 8) {
                    $user = $model->getUserByToken($_POST["token"]);
                    if (!empty($user)) {
                        $model->updatePassword($user["id"], $_POST["password"]);
                        $model->updateToken($user["id"], "");
                        $generate_captcha = $captcha->generateCaptcha();
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(["status" => "success", "message" => "Password was changed"]);
                    } else {
                        $generate_captcha = $captcha->generateCaptcha();
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(["status" => "error", "message" => "Invalid token"]);
                    }
                } else {
                    $generate_captcha = $captcha->generateCaptcha();
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(["status" => "error", "message" => "Invalid password"]);
                }
            } else {
                $generate_captcha = $captcha->generateCaptcha();
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(["status" => "error", "message" => "Invalid captcha"]);
            }
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (!isset($_SESSION['user_id'])) {
        if (isset($id) && $id == "captcha") {
            $generate_captcha = $captcha->generateCaptcha();
            $captcha->showCaptcha();
        } elseif (isset($id) && $id == "reset" && isset($_GET['token']) && mb_strlen($_GET['token']) == 32) {
            $user = $model->getUserByToken($_GET['token']);
            if (!empty($user)) {
                $generate_captcha = $captcha->generateCaptcha();
                require("views/forgotpassword.view.php");
            } else {
                header("Location: " . ROOT . "/login");
            }
        } else {
            $generate_captcha = $captcha->generateCaptcha();
            require("views/forgotpassword.view.php");
        }
    }
}

<?php
session_start();
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
} elseif (!$_SESSION['lang']) {
    $_SESSION['lang'] = 'en';
}
include('lib/locale/pt.php');

date_default_timezone_set('Europe/Lisbon');
define("ENV", parse_ini_file(".env"));

define("ROOT", rtrim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/"));


$url = explode("/", $_SERVER['REQUEST_URI']);

$controller = $url[2] ?: "home";
$id = (array_key_exists(3, $url)) ? $url[3] : null;

$id = explode("?", $id)[0];

$controllers = [
    "home",
    "login",
    "client",
    "project",
    "employee",
    "task",
    "logout",
    "messages",
    "notice",
    "event",
    "forgotpassword",
    "profile",

];

if (!in_array($controller, $controllers)) {
    http_response_code(404);
    $title = "Not Found";
    require("views/error404.view.php");
    exit;
}

require("controllers/" . $controller . ".controller.php");

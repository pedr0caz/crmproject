<?php

date_default_timezone_set('Europe/Lisbon');


session_start();
if (isset($_COOKIE["lang"])) {
    $lang = $_COOKIE["lang"];
} else {
    $lang = "en";
}
include('lib/locale/'.$lang.'.php');


setlocale(LC_ALL, LANG_ISO);
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

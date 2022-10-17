<?php
session_start();

define("ENV", parse_ini_file(".env"));

define("ROOT", rtrim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/"));


$url = explode("/", $_SERVER['REQUEST_URI']);

$controller = $url[2] ?: "home";
$id = (array_key_exists(3, $url)) ? intval($url[3]) : null;
$tabs = (array_key_exists(4, $url)) ? $url[4] : null;


$controllers = [
    "home",
    "login",
    "client",
    "clientcreate",
    "clientdetails",
    "logout",

];

if (!in_array($controller, $controllers)) {
    http_response_code(404);
    die("Página não encontrada");
}

require("controllers/" . $controller . ".controller.php");

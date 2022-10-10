<?php
session_start();

define("ENV", parse_ini_file(".env"));

define("ROOT", rtrim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/"));


$url = explode("/", $_SERVER['REQUEST_URI']);

$controller = $url[2] ?: "home";
$id = $url[3] ?? "";

$controllers = [
    "home",
    "login",

    "logout",

];

if (!in_array($controller, $controllers)) {
    http_response_code(404);
    die("Página não encontrada");
}

require("controllers/" . $controller . ".controller.php");

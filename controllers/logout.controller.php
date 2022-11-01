<?php
require("models/users.model.php");
$user = new User();
if (isset($_SESSION["user_id"])) {
    $user->logout($_SESSION["user_id"]);
    if (isset($_COOKIE)) {
        foreach ($_COOKIE as $name => $value) {
            if ($name != "preservecookie") {
                setcookie($name, '', 1);
                setcookie($name, '', 1, '/');
            }
        }
    }
    session_destroy();
    header("Location: " . ROOT . "/");
}

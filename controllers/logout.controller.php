<?php

if (isset($_SESSION["user_id"])) {
    session_destroy();
    if (isset($_COOKIE)) {
        foreach ($_COOKIE as $name => $value) {
            if ($name != "preservecookie") {
                setcookie($name, '', 1);
                setcookie($name, '', 1, '/');
            }
        }
    }
    header("Location: " . ROOT . "/");
}

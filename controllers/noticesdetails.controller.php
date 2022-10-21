<?php
 if (!isset($_SESSION["user_id"])) {
     header("Location: " . ROOT . "/login");
     exit;
 } else {
     require("views/clients.view.php");
 }

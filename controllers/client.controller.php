<?php


    if (!isset($_SESSION["user_id"])) {
        header("Location: " . ROOT . "/login");
        exit;
    } else {
        if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 1) {
            require("models/client.model.php");
            $modelClient = new Client();
            
            $clients = $modelClient->getClients($id);
            $title = "Client List";
            require("views/clients.view.php");
        } else {
            header("Location: " . ROOT . "");
            exit;
        }
    }

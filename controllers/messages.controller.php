<?php
    if (!isset($_SESSION["user_id"])) {
        header("Location: " . ROOT . "/login");
        exit;
    } else {
        require("models/chat.model.php");
        require("models/users.model.php");
        $user = new User();
        $chat = new Messages();
        $chats = $chat->getChats($_SESSION["user_id"], $id);
        if ($id === 'getUsers') {
            $users = $user->searchUser($_POST["key"], $_SESSION["user_id"]);
            foreach ($users as $user) {
                if ($user['user_id'] == $_SESSION['user_id']) {
                    continue;
                }
                echo '<li class="list-group-item">
                  <a href="'.ROOT.'/messages/'.$user['user_id'].'"
                     class="d-flexjustify-content-between align-items-center p-2">
                      <div class="d-flex
                                  align-items-center">

                          <img src="uploads/'.$user['image'].'"
                               class="w-10 rounded-circle">

                          <h3 class="fs-xs m-2">
                          '.$user['name'].'
                          </h3>
                      </div>
                   </a>
                 </li>';
            }
        } elseif ($id === 'getMessages') {
            $chats= $chat->getChatAjax($_SESSION["user_id"], $_POST["id_2"]);
            if ($chats != null) {
                echo '<p class="ltext border rounded p-2 mb-1">'.$chats['message'].'<small class="d-block">'.$chats['created_at'].'</small></p>';
            }
        } elseif ($id === 'sendMessage') {
            $chat->insertMessage($_SESSION["user_id"], $_POST["to_id"], $_POST["message"]);
            $time = date("h:i:s a");
            echo '<p class="rtext align-self-end
             border rounded p-2 mb-1">
      '.$_POST["message"].'
      <small class="d-block">'.$time.'</small>
  </p>';
        } else {
            $title = "Add Project";
            require("views/messages.view.php");
        }
    }

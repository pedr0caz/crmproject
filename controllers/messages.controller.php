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
            $users = $user->searchUser($_POST["key"], $_SESSION["user_id"], $_SESSION["user_role"]);
            
            foreach ($users as $user) {
                if ($user['user_id'] == $_SESSION['user_id']) {
                    continue;
                }
                if ($user['image']) {
                    $image = $user['image'];
                } else {
                    $image = 'https://www.gravatar.com/avatar/a456ed61bc3c5d05f3ad79d85069098a.png?s=200&d=mp';
                }
                echo '<li class="list-group-item">
                  <a href="'.ROOT.'/messages/'.$user['user_id'].'"
                     class="d-flexjustify-content-between align-items-center p-2">
                      <div class="d-flex
                                  align-items-center">

                          <img src="'.$image.'" style="width: 2%; height: 2%; border-radius: 2%;"
                               class="w-5 rounded-circle">

                          <h3 class="fs-xs m-2">
                          '.$user['name'].'
                          </h3>
                      </div>
                   </a>
                 </li>';
            }
        } elseif ($id === 'getMessages') {
            $chats = $chat->getChatAjax($_SESSION["user_id"], $_POST["id_2"]);
  
            if ($chats != null) {
                $chats['created_at'] = 	ucwords(strftime('%d %b %Y %T', strtotime($chats['created_at'])));
                header("Content-Type: application/json");
                echo json_encode($chats);
            }
        } elseif ($id === 'sendMessage') {
            foreach ($_POST as $key=>$value) {
                if (is_array($_POST[$key])) {
                    foreach ($_POST[$key] as $k=>$v) {
                        $_POST[$key][$k] = htmlspecialchars($v);
                    }
                } else {
                    $_POST[$key] = htmlspecialchars($value);
                }
            }
            $chat->insertMessage($_SESSION["user_id"], $_POST["to_id"], $_POST["message"]);
            $time = ucwords(strftime('%d %b %Y %T', strtotime(date('Y-m-d H:i:s'))));
            echo '<p class="rtext align-self-end
             border rounded p-2 mb-1">
      '.$_POST["message"].'
      <small class="d-block">'.$time.'</small>
  </p>';
        } else {
            $title = G_MESSENGER;
            require("views/message/messages.view.php");
        }
    }

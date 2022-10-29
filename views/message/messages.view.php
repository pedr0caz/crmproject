<?php require_once("views/layout/header.php"); ?>
<?php require_once("views/layout/navbar.php"); ?>
<?php
if (isset($_SESSION['user_id'])) {
    # Getting User data data
    $userOwn = $user->getUser($_SESSION['user_id']);
    
    # Getting User conversations
    $conversations = $chat->getConversation($userOwn['user_id']);
    
    ?>
<style>
    .vh-100 {
        min-height: 100vh;
    }

    .w-400 {
        width: 400px;
    }

    .fs-xs {
        font-size: 1rem;
    }

    .w-10 {
        width: 10%;
    }

    a {
        text-decoration: none;
    }

    .fs-big {
        font-size: 5rem !important;
    }

    .online {
        width: 10px;
        height: 10px;
        background: green;
        border-radius: 50%;
    }

    .w-15 {
        width: 15%;
    }

    .fs-sm {
        font-size: 1.4rem;
    }

    small {
        color: #bbb;
        font-size: 0.7rem;
        text-align: right;
    }

    .chat-box {
        overflow-y: auto;
        overflow-x: hidden;
        min-height: 50vh;
        max-height: 50vh;
    }

    .rtext {
        width: 65%;
        background: #f8f9fa;
        color: #444;
    }

    .ltext {
        width: 65%;
        background: #3289c8;
        color: #fff;
    }

    /* width */
    *::-webkit-scrollbar {
        width: 3px;
    }

    /* Track */
    *::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    *::-webkit-scrollbar-thumb {
        background: #aaa;
    }

    /* Handle on hover */
    *::-webkit-scrollbar-thumb:hover {
        background: #3289c8;
    }

    textarea {
        resize: none;
    }
</style>
<?php if (isset($id) && $id > 0) {
    $chatWith = $user->getUser($id);
    
    ?>
<section class="main-container bg-additional-grey" id="fullscreen">
    <div class="content-wrapper">
        <div class="">
            <a href="<?=ROOT?>/messages"
                class="fs-4 link-dark">&#8592;</a>
            <div class="d-flex align-items-center">
                <img src="<?=$chatWith['image'] ? ROOT."/".$chatWith['image'] : 'https://www.gravatar.com/avatar/a456ed61bc3c5d05f3ad79d85069098a.png?s=200&d=mp'?>"
                    style="width: 3%;" class="w-10 rounded-circle">
                <h3 class="display-4 fs-sm m-2">
                    <?=$chatWith['name']?> <br>
                    <div class="d-flex
						align-items-center" title="online">
                        <?php
                            if ($chat->last_seen($chatWith['last_seen']) == "Active") {
                                ?>
                        <div class="online"></div>
                        <small class="d-block p-1">Online</small>
                        <?php } else { ?>
                        <small class="d-block p-1">
                            Last seen:
                            <?=$chat->last_seen($chatWith['last_seen'])?>
                        </small>
                        <?php } ?>
                    </div>
                </h3>
            </div>
            <div class="shadow p-4 rounded
				d-flex flex-column
				mt-2 chat-box" id="chatBox">
                <?php
                    if (!empty($chats)) {
                        foreach ($chats as $chat) {
                            if ($chat['from_id'] == $_SESSION['user_id']) { ?>
                <p class="rtext align-self-end
					border rounded p-2 mb-1">
                    <?=$chat['message']?>
                    <small class="d-block">
                        <?=$chat['created_at']?>
                    </small>
                </p>
                <?php } else { ?>
                <p class="ltext border 
					rounded p-2 mb-1">
                    <?=$chat['message']?>
                    <small class="d-block">
                        <?=$chat['created_at']?>
                    </small>
                </p>
                <?php }
                }
                    } else { ?>
                <div class="alert alert-info 
					text-center">
                    <i class="fa fa-comments d-block fs-big"></i>
                    No messages yet, Start the conversation
                </div>
                <?php } ?>
            </div>
            <div class="input-group mb-3">
                <textarea cols="3" id="message" class="form-control"></textarea>
                <button class="btn btn-primary" id="sendBtn">
                    <i class="bi bi-arrow-90deg-right"></i>
                </button>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            var scrollDown = function() {
                let chatBox = document.getElementById('chatBox');
                chatBox.scrollTop = chatBox.scrollHeight;
            }

            scrollDown();

            $(document).ready(function() {

                $("#sendBtn").on('click', function() {
                    message = $("#message").val();
                    if (message == "") return;

                    $.post("<?=ROOT;?>/messages/sendMessage", {
                            message: message,
                            to_id: <?=$chatWith['user_id']?>
                        },
                        function(data, status) {
                            $("#message").val("");
                            $("#chatBox").append(data);
                            scrollDown();
                        });
                });





                // auto refresh / reload
                let fechData = function() {
                    $.post("<?=ROOT;?>" + "/messages/getMessages", {
                            id_2: <?=$chatWith['user_id']?>
                        },
                        function(data, status) {

                            $("#chatBox").append(data);
                            if (data != "") scrollDown();
                        });
                }

                fechData();
                /** 
                auto update last seen 
                every 0.5 sec
                **/
                setInterval(fechData, 1000);

            });
        </script>
    </div>
</section>
<?php } else { ?>
<section class="main-container bg-additional-grey" id="fullscreen">
    <div class="content-wrapper">
        <div class="">
            <div>
                <div class="input-group mb-3">
                    <input type="text" placeholder="Search..." id="searchText" class="form-control">
                    <button class="btn btn-primary" id="serachBtn">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                <ul id="chatList" class="list-group mvh-50 overflow-auto">
                    <?php if (!empty($conversations)) { ?>
                    <?php
                        foreach ($conversations as $conversation) {
                            ?>
                    <li class="list-group-item">
                        <a href="<?=ROOT?>/messages/<?=$conversation['user']['user_id']?>"
                            class="d-flex
							justify-content-between
							align-items-center p-2">
                            <div class="d-flex
								align-items-center">
                                <img style="max-width: 75px;"
                                    src="<?=$conversation['user']['image'] ? ROOT."/".$conversation['user']['image'] : 'https://www.gravatar.com/avatar/a456ed61bc3c5d05f3ad79d85069098a.png?s=200&d=mp'?>"
                                    class=" rounded-circle">
                                <h3 class="fs-xs m-2">
                                    <?=$conversation['user']['name']?><br>
                                    <small>
                                        <?php
                                        echo $chat->lastChat($_SESSION['user_id'], $conversation['chat']['to_id']);
                            ?>
                                    </small>
                                </h3>
                            </div>
                            <?php if ($chat->last_seen($conversation['user']['last_seen']) == "Active") { ?>
                            <div title="online">
                                <div class="online"></div>
                            </div>
                            <?php } ?>
                        </a>
                    </li>
                    <?php } ?>
                    <ul id="chatList2" class="list-group mvh-50 overflow-auto">
                    </ul>
                    <?php } else { ?>
                    <div class="alert alert-info 
						text-center">
                        <i class="fa fa-comments d-block fs-big"></i>
                        No messages yet, Start the conversation
                    </div>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <script>
            $(document).ready(function() {

                // Search
                $("#searchText").on("input", function() {
                    var searchText = $(this).val();
                    if (searchText == "") {
                        $("#chatList2").html("");
                        return;
                    }
                    $.post('messages/getUsers', {
                            key: searchText
                        },
                        function(data, status) {

                            $("#chatList2").html(data);

                        });
                });

                // Search using the button
                $("#serachBtn").on("click", function() {
                    var searchText = $("#searchText").val();
                    if (searchText == "") return;
                    $.post('<?=ROOT?>messages/getUsers', {
                            key: searchText
                        },
                        function(data, status) {
                            $("#chatList").html(data);
                        });
                });



            });
        </script>
    </div>
</section>
<?php } ?>
<?php }
require_once("views/layout/footer.php");
?>
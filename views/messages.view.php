<?php require_once("layout/header.php"); ?>
<?php require_once("layout/navbar.php"); ?>


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
                <img src="uploads/<?=$chatWith['image']?>"
                    class="w-15 rounded-circle">

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
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-people" viewBox="0 0 16 16">
                        <path
                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z">
                        </path>
                    </svg>
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
                        <svg class="svg-inline--fa fa-search fa-w-16 f-16 " aria-hidden="true" focusable="false"
                            data-prefix="fa" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                            </path>
                        </svg>
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
                                <img src="uploads/<?=$conversation['user']['image']?>"
                                    class="w-10 rounded-circle">
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


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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

require_once("layout/footer.php");

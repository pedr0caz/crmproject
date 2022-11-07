<?php
require_once("base.model.php");

class Messages extends Base
{
    public function getChats($id_1, $id_2)
    {
        $query = $this->db->prepare("
        SELECT * FROM chats
        WHERE (from_id = :id_1 AND to_id = :id_2)
        OR (from_id = :id_2 AND to_id = :id_1)
        ORDER BY chat_id ASC");
        $query->execute([
            "id_1" => $id_1,
            "id_2" => $id_2
        ]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChatAjax($id_1, $id_2)
    {
        $query = $this->db->prepare("
        SELECT * FROM chats
        WHERE to_id =  ? AND from_id = ? 
        ORDER BY chat_id ASC");
        $query->execute([$id_1, $id_2]);
        $chats = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($chats) {
            foreach ($chats as $chat) {
                if ($chat['opened'] == 0) {
                    $opened = 1;
                    $chat_id = $chat['chat_id'];
                    $query = $this->db->prepare("
                    UPDATE chats SET opened = ? WHERE chat_id = ?");
                    $query->execute([$opened, $chat_id]);
                    return $chat;
                }
            }
        }
    }


    public function insertMessage($from_id, $to_id, $message)
    {
        $date = date("Y-m-d H:i:s");
        $query = $this->db->prepare("
        INSERT INTO chats (from_id, to_id, message, created_at)
        VALUES (?, ?, ?, ?)");
        $query->execute([
            $from_id,
            $to_id,
            $message,
            $date
        ]);
        $id = $this->db->lastInsertId();
        if ($id) {
            $query = $this->db->prepare("
            SELECT * FROM conversations
            WHERE (user_1 = :id_1 AND user_2 = :id_2)
            OR (user_1 = :id_2 AND user_2 = :id_1)");
            $query->execute([
                "id_1" => $from_id,
                "id_2" => $to_id
            ]);
            $conversation = $query->fetch(PDO::FETCH_ASSOC);
            if ($query->rowCount() == 0) {
                $query = $this->db->prepare("
                INSERT INTO
                conversations (user_1, user_2) VALUES (?, ?)");
                $query->execute([
                    $from_id,
                    $to_id
                ]);

                $query = $this->db->prepare("
                UPDATE users SET last_seen = ? WHERE id = ?");
                $query->execute([$date, $from_id]);
            }
        }
    }

    public function getUser($id)
    {
        $query = $this->db->prepare("
            SELECT 
                u.id AS user_id,
                u.name,
                u.image,
                u.last_seen
               
            
            FROM users u
            WHERE u.id = ?

        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }


    public function getConversation($user_id)
    {
        $query = $this->db->prepare("
        SELECT * FROM conversations
        WHERE user_1 = :user_id OR user_2 = :user_id
        ORDER BY conversation_id DESC");
        $query->execute([
            "user_id" => $user_id
        ]);
        $conversationss = $query->fetchAll(PDO::FETCH_ASSOC);
        $conversations = [];
        foreach ($conversationss as $conversation) {
            if ($conversation['user_1'] == $user_id) {
                $user = $this->getUser($conversation['user_2']);
            } else {
                $user = $this->getUser($conversation['user_1']);
            }
            $query = $this->db->prepare("
            SELECT * FROM chats
            WHERE (from_id = :id_1 AND to_id = :id_2)
            OR (from_id = :id_2 AND to_id = :id_1)
            ORDER BY chat_id DESC LIMIT 1");
            $query->execute([
                "id_1" => $user_id,
                "id_2" => $user['user_id']
            ]);
            $chat = $query->fetch(PDO::FETCH_ASSOC);
            $conversations[] = [
                "user" => $user,
                "chat" => $chat
            ];
        }

        $query = $this->db->prepare("
        UPDATE users SET last_seen = ? WHERE id = ?");
        $query->execute([
            date("Y-m-d H:i:s"),
            $user_id]);

        return $conversations;
    }

    public function lastChat($id_1, $id_2)
    {
        $query = $this->db->prepare("
        SELECT * FROM chats
        WHERE (from_id = :id_1 AND to_id = :id_2)
        OR (from_id = :id_2 AND to_id = :id_1)
        ORDER BY chat_id DESC LIMIT 1");
        $query->execute([
            "id_1" => $id_1,
            "id_2" => $id_2
        ]);
        $chat = $query->fetch(PDO::FETCH_ASSOC);
        return $chat['message'];
    }

    public function opened($id_1, $chats)
    {
        foreach ($chats as $chat) {
            if ($chat['opened'] == 0) {
                $opened = 1;
                $chat_id = $chat['chat_id'];

                $query = $this->db->prepare("
                UPDATE chats
                SET opened = :opened
                WHERE from_id = :chat_id AND chat_id = :id_1");
                $query->execute([
                    "opened" => $opened,
                    "chat_id" => $chat_id,
                    "id_1" => $id_1
                ]);
            }
        }
    }
    

    public function last_seen($date_time)
    {
        $timestamp = strtotime($date_time);
   
        $strTime = array(G_SECONDS, G_MINUTES, G_HOURS, G_DAYS, "month", "year");
        $length = array("60","60","24","30","12","10");
     
        $currentTime = time();
        if ($currentTime >= $timestamp) {
            $diff     = time()- $timestamp;
            for ($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
                $diff = $diff / $length[$i];
            }
     
            $diff = round($diff);
            if ($diff < 59 && $strTime[$i] == "second") {
                return 'Active';
            } else {
                return $diff . " " . $strTime[$i] . " ". G_AGO;
            }
        }
    }
}

<?php

require_once("base.model.php");

class Discussion extends Base
{
    public function newChat($message, $project_id, $user_id)
    {
        $query = $this->db->prepare("
        INSERT INTO discussions (message, project_id, user_id, created_at)
        VALUES (?, ?, ?, ?)");
        $query->execute([
            $message,
            $project_id,
            $user_id,
            date("Y-m-d H:i:s")
        ]);
        $id = $this->db->lastInsertId();
        if ($id) {
            $query = $this->db->prepare("
            SELECT * FROM discussions
            WHERE id = ?");
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function getChat($project_id)
    {
        $query = $this->db->prepare("
            SELECT 
                discussions.id,
                discussions.message,
                discussions.created_at,
                users.id AS user_id,
                users.name,
                users.image
            FROM discussions
            INNER JOIN users ON discussions.user_id = users.id
            WHERE discussions.project_id = ?
            ORDER BY discussions.created_at ASC
        ");
        $query->execute([$project_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChatAjax($id, $lastid)
    {
        $query = $this->db->prepare("
        SELECT 
            discussions.id,
            discussions.message,
            discussions.created_at,
            users.id AS user_id,
            users.name,
            users.image
        FROM discussions
        INNER JOIN users ON discussions.user_id = users.id
        WHERE discussions.project_id = ? AND discussions.id > ?
        ORDER BY discussions.created_at ASC
        ");
        $query->execute([
            $id,
            $lastid
        ]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChatCount($id)
    {
        $query = $this->db->prepare("
        SELECT COUNT(*) AS count FROM discussions
        WHERE discussions.project_id = ?
        ");
        $query->execute([
            $id
        ]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }
}

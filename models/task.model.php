<?php

require_once("base.model.php");

class Task extends Base
{
    public function newCategoryTask($data)
    {
        $query = $this->db->prepare("
            INSERT INTO task_category (category_name)
            VALUES (?)
        ");
        $query->execute([$data["category_name"]]);
        return $this->db->lastInsertId();
    }
    
    public function deleteCategoryTask($id)
    {
        $query = $this->db->prepare("
            DELETE FROM task_category
            WHERE id = ?
        ");
        $query->execute([$id]);
    }
    public function getProjectTasks($id)
    {
        $query = $this->db->prepare("
            SELECT
               t.id AS task_id,
               t.heading,
                t.description,
                t.due_date,
                t.start_date,
                
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLabels()
    {
        $query = $this->db->prepare("
            SELECT *
            FROM taskboard_columns
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTask($id)
    {
        $query = $this->db->prepare("
        SELECT 
        t.id AS task_id,
        t.heading,
        t.description,
        t.due_date,
        t.start_date,
        t.board_column_id,
        t.project_id,
        p.project_name,
        t.task_category_id,
        t.priority AS task_priority,
        t.status,
   
        t.created_by,
        t.created_at,
        t.updated_at,
        
        u.id AS user_id,
        u.name AS user_name,
        u.email AS user_email,
        u.image AS user_image,
        tc.id AS task_label_id,
        tc.column_name,
        tc.slug,
        tc.label_color,
        tc.priority,
        tcat.id AS task_category_id,
        tcat.category_name

        FROM tasks t
        INNER JOIN users u ON u.id = t.created_by
        INNER JOIN taskboard_columns tc ON tc.id = t.board_column_id
        INNER JOIN task_category tcat ON tcat.id = t.task_category_id
        INNER JOIN projects p ON t.project_id = p.id
        WHERE t.id = ?

        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getEmployeeAssignedToTask($id)
    {
        $query = $this->db->prepare("
            SELECT
                u.id AS user_id,
                u.name AS user_name,
                u.email AS user_email,
                u.image AS user_image
            FROM task_users te
            INNER JOIN users u ON u.id = te.user_id
            WHERE te.task_id = ?
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function changeTaskStatus($id, $status)
    {
        $query = $this->db->prepare("
            UPDATE tasks
            SET board_column_id = ?
            WHERE id = ?
        ");
        $result = $query->execute([$status,$id]);
        if ($result) {
            $query = $this->db->prepare("
            INSERT INTO task_history (task_id, details, created_at ,user_id, board_column_id)
            VALUES (?, ?, ?, ?, ?)
            ");
            $query->execute([
                $id,
                "Task status changed by " . $_SESSION["user_name"],
                date("Y-m-d H:i:s"),
                $_SESSION["user_id"],
                $status
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function getTaskFiles($id)
    {
        $query = $this->db->prepare("
        SELECT
        tf.id,
        tf.filename,
        tf.name,
        tf.created_at,
        u.id AS user_id,
        u.name AS user_name,
        u.email AS user_email,
        u.image AS user_image
    FROM task_files tf
    INNER JOIN users u ON u.id = tf.added_by
    WHERE tf.task_id = ?
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function newFile($id, $user_id, $filename, $newFilepath)
    {
        $query = $this->db->prepare("
            INSERT INTO task_files (task_id, user_id , added_by, filename, name)
            VALUES (?,?,?,?,?)
        ");
        $query->execute([$id,$user_id,$user_id,$newFilepath,$filename]);
        $idfile = $this->db->lastInsertId();
        if ($idfile) {
            $query = $this->db->prepare("
            INSERT INTO task_history (task_id,details, created_at, user_id)
            VALUES (?, ?, ?, ?)
            ");
            $query->execute([
                $id,
                "New file uploaded by " . $_SESSION["user_name"],
                date("Y-m-d H:i:s"),
                $user_id
            ]);

            $query = $this->db->prepare("
             SELECT name, id, filename, created_at FROM task_files WHERE id = ?
            ");
            $query->execute([$idfile]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function deleteFile($id, $taskid)
    {
        $query = $this->db->prepare("
            DELETE FROM task_files
            WHERE id = ?
        ");
        $result = $query->execute([$id]);
        if ($result) {
            $query = $this->db->prepare("
            INSERT INTO task_history (task_id,details, created_at, user_id)
            VALUES (?, ?, ?, ?)
            ");
            $query->execute([
                $taskid,
                "File deleted by " . $_SESSION["user_name"],
                date("Y-m-d H:i:s"),
                $_SESSION["user_id"],
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function addCommentTask($id, $user_id, $comment)
    {
        $query = $this->db->prepare("
            INSERT INTO task_comments (task_id, user_id, comment)
            VALUES (?, ?, ?)
        ");
        $query->execute([$id, $user_id, $comment]);
        $result = $this->db->lastInsertId();
        if ($result) {
            $query = $this->db->prepare("
            INSERT INTO task_history (task_id,details, created_at, user_id)
            VALUES (?, ?, ?, ?)
            ");
            $query->execute([
                $id,
                "New comment by " . $_SESSION["user_name"],
                date("Y-m-d H:i:s"),
                $user_id,
            ]);
            $idcomment = $this->db->lastInsertId();
            if ($idcomment) {
                $query = $this->db->prepare("
                SELECT
                    tc.id,
                    tc.comment,
                    tc.created_at,
                    u.id AS user_id,
                    u.name AS user_name,
                    u.email AS user_email,
                    u.image AS user_image
                FROM task_comments tc
                INNER JOIN users u ON u.id = tc.user_id
                WHERE tc.id = ?
                ");
                $query->execute([$result]);
                return $query->fetch(PDO::FETCH_ASSOC);
            } else {
                return "123";
            }
        } else {
            return "bla";
        }
    }

    public function getCommentsTask($id)
    {
        $query = $this->db->prepare("
            SELECT
                tc.id,
                tc.comment,
                tc.created_at,
                u.id AS user_id,
                u.name AS user_name,
                u.email AS user_email,
                u.image AS user_image
            FROM task_comments tc
            INNER JOIN users u ON u.id = tc.user_id
            WHERE tc.task_id = ?
            ORDER BY tc.created_at DESC
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTaskHistory($id)
    {
        $query = $this->db->prepare("
        SELECT
        th.id,
        th.details,
        th.created_at,
        u.id AS user_id,
        u.name AS user_name,
        u.email AS user_email,
        u.image AS user_image,
        bc.column_name AS board_column_name,
        bc.label_color AS board_column_color
    FROM task_history th
    INNER JOIN users u ON u.id = th.user_id
    LEFT JOIN taskboard_columns bc ON bc.id = th.board_column_id
    WHERE th.task_id = ?
    ORDER BY th.created_at DESC
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteCommentTask($id)
    {
        $query = $this->db->prepare("
            DELETE FROM task_comments
            WHERE id = ? AND user_id = ?
        ");
        $result = $query->execute([$id, $_SESSION["user_id"]]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}

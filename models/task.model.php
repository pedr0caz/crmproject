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
        $query->execute([$data]);
        return $this->db->lastInsertId();
    }
    
    public function deleteCategoryTask($id)
    {
        $query = $this->db->prepare("
            DELETE FROM task_category
            WHERE id = ?
        ");
        $result = $query->execute([$id]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getCategoriesTask()
    {
        $query = $this->db->prepare("
            SELECT * FROM task_category
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editCategoryTask($id, $category_name)
    {
        $query = $this->db->prepare("
            UPDATE task_category
            SET category_name = ?
            WHERE id = ?
        ");
        $result = $query->execute([ $category_name, $id]);
        if ($result) {
            return true;
        } else {
            return false;
        }
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
        t.board_column_id,
        t.project_id,
        p.project_name,
        t.task_category_id,
        t.priority AS task_priority,
        t.status,
   
        t.created_by,
        t.created_at,
        t.updated_at,
        t.added_by,
        
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
        LEFT JOIN projects p ON t.project_id = p.id
        WHERE t.project_id = ?;
                
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLabels()
    {
        $query = $this->db->prepare("
            SELECT *
            FROM taskboard_columns
            ORDER by priority ASC
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTaskAdmin($id)
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
        t.added_by,
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
        LEFT JOIN projects p ON t.project_id = p.id
        WHERE t.id = ?

        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getTask($id, $user_id)
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
        t.added_by,
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
        LEFT JOIN projects p ON t.project_id = p.id
        WHERE t.id = ? AND (t.id IN (SELECT task_id FROM task_users WHERE user_id = ?) OR t.created_by = ?);

        ");
        $query->execute([$id, $user_id, $user_id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getTasksAdmin()
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
        t.added_by,
        
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
        LEFT JOIN users u ON u.id = t.created_by
        LEFT JOIN taskboard_columns tc ON tc.id = t.board_column_id
        LEFT JOIN task_category tcat ON tcat.id = t.task_category_id
        LEFT JOIN projects p ON t.project_id = p.id

        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTasks($user_id)
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
        t.added_by,
        
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
        LEFT JOIN users u ON u.id = t.created_by
        LEFT JOIN taskboard_columns tc ON tc.id = t.board_column_id
        LEFT JOIN task_category tcat ON tcat.id = t.task_category_id
        LEFT JOIN task_users tu ON tu.task_id = t.id
        LEFT JOIN projects p ON t.project_id = p.id 
        WHERE t.created_by = ? OR tu.user_id = ?
        GROUP BY t.id

        ");
        $query->execute([$user_id, $user_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getTasksOfProjects($user_id)
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
        t.added_by,

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
        LEFT JOIN users u ON u.id = t.created_by
        LEFT JOIN taskboard_columns tc ON tc.id = t.board_column_id
        LEFT JOIN task_category tcat ON tcat.id = t.task_category_id
        LEFT JOIN task_users tu ON tu.task_id = t.id
        LEFT JOIN projects p ON t.project_id = p.id 
        WHERE p.client_id = ?

        ");
        $query->execute([$user_id, $user_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
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

    public function deleteFile($id, $taskid, $user_id)
    {
        $query = $this->db->prepare("
            DELETE FROM task_files
            WHERE id = ? AND user_id = ?
        ");
        $result = $query->execute([$id, $user_id]);
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

    public function deleteFileAdmin($id, $taskid)
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

    public function addTask($heading, $description, $due_date, $start_date, $project_id, $priority, $board_column_id, $added_by, $users_assigned, $task_cat_id)
    {
        $query = $this->db->prepare("
            INSERT INTO tasks (heading, description, due_date, start_date, project_id, priority, board_column_id, added_by, task_category_id, created_at, created_by)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $query->execute([$heading, $description, $due_date, $start_date, $project_id, $priority, $board_column_id, $added_by, $task_cat_id, date("Y-m-d H:i:s"), $added_by]);
        $id = $this->db->lastInsertId();
        if ($id) {
            $query = $this->db->prepare("
            INSERT INTO task_history (task_id,details, created_at, user_id)
            VALUES (?, ?, ?, ?)
            ");
            $query->execute([
                $id,
                "Task created by " . $_SESSION["user_name"],
                date("Y-m-d H:i:s"),
                $added_by,
            ]);

            if ($project_id) {
                $query = $this->db->prepare("
                INSERT INTO project_activity (project_id,activity, created_at)
                VALUES (?, ?, ?)
                ");
                $query->execute([
                    $project_id,
                    "Task Assigned to Project by " . $_SESSION["user_name"],
                    date("Y-m-d H:i:s")
                ]);
            }
            
            foreach ($users_assigned as $user) {
                $query = $this->db->prepare("
                INSERT INTO task_users (task_id, user_id)
                VALUES (?, ?)
                ");
                $query->execute([$id, $user]);
            }
            return $id;
        } else {
            return false;
        }
    }

    public function editTask($id, $heading, $description, $due_date, $start_date, $project_id, $priority, $board_column_id, $added_by, $users_assigned, $task_cat_id)
    {
        $query = $this->db->prepare("
            UPDATE tasks
            SET heading = ?,
                description = ?,
                due_date = ?,
                start_date = ?,
                project_id = ?,
                priority = ?,
                board_column_id = ?,
                added_by = ?,
                task_category_id = ?
            WHERE id = ?
        ");
        $result = $query->execute([$heading, $description, $due_date, $start_date, $project_id, $priority, $board_column_id, $added_by, $task_cat_id, $id]);
        if ($result) {
            $query = $this->db->prepare("
            INSERT INTO task_history (task_id,details, created_at, user_id)
            VALUES (?, ?, ?, ?)
            ");
            $query->execute([
                $id,
                "Task edited by " . $_SESSION["user_name"],
                date("Y-m-d H:i:s"),
                $added_by,
            ]);
            $query = $this->db->prepare("
            DELETE FROM task_users
            WHERE task_id = ?
            ");
            $query->execute([$id]);
            foreach ($users_assigned as $user) {
                $query = $this->db->prepare("
                INSERT INTO task_users (task_id, user_id)
                VALUES (?, ?)
                ");
                $query->execute([$id, $user]);
            }
            return true;
        } else {
            return false;
        }
    }

    public function deleteTaskAdmin($id)
    {
        $query = $this->db->prepare("
            SELECT 
                project_id
            FROM tasks
            WHERE id = ?

        ");
        $query->execute([$id]);
        $project_id = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($project_id) {
            $query = $this->db->prepare("
            INSERT INTO project_activity (project_id,activity, created_at)
            VALUES (?, ?, ?)
            ");
            $query->execute([
                $project_id["project_id"],
                "Task deleted from Project by " . $_SESSION["user_name"],
                date("Y-m-d H:i:s"),
        
            ]);
        }

        $query = $this->db->prepare("
            DELETE FROM tasks
            WHERE id = ?
        ");
        $result = $query->execute([$id]);

        if ($result) {
            $query = $this->db->prepare("
            DELETE FROM task_users
            WHERE task_id = ?
            ");
            $query->execute([$id]);
            $query = $this->db->prepare("
            DELETE FROM task_comments
            WHERE task_id = ?
            ");
            $query->execute([$id]);
            $query = $this->db->prepare("
            DELETE FROM task_history
            WHERE task_id = ?
            ");
            $query->execute([$id]);
            return true;
        } else {
            return false;
        }
    }

    public function deleteTask($id, $user_id)
    {
        $query = $this->db->prepare("
            SELECT 
                project_id
            FROM tasks
            WHERE id = ? AND added_by = ?

        ");
        $query->execute([$id, $user_id]);
        $project_id = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($project_id) {
            $query = $this->db->prepare("
            INSERT INTO project_activity (project_id,activity, created_at)
            VALUES (?, ?, ?)
            ");
            $query->execute([
                $project_id["project_id"],
                "Task deleted from Project by " . $_SESSION["user_name"],
                date("Y-m-d H:i:s"),
        
            ]);
        }

        $query = $this->db->prepare("
            DELETE FROM tasks
            WHERE id = ?
        ");
        $result = $query->execute([$id]);

        if ($result) {
            $query = $this->db->prepare("
            DELETE FROM task_users
            WHERE task_id = ?
            ");
            $query->execute([$id]);
            $query = $this->db->prepare("
            DELETE FROM task_comments
            WHERE task_id = ?
            ");
            $query->execute([$id]);
            $query = $this->db->prepare("
            DELETE FROM task_history
            WHERE task_id = ?
            ");
            $query->execute([$id]);
            return true;
        } else {
            return false;
        }
    }

    public function getOwnTasks($id)
    {
        $query = $this->db->prepare("
        SELECT  
        tasks.id,
        tasks.heading,
        tasks.description,
        tasks.due_date,
        tasks.start_date,
        tasks.project_id,
        tasks.priority,
        tasks.board_column_id,
        tasks.added_by,
        tasks.task_category_id,
        tasks.created_at,
        tasks.created_by,
        tasks.updated_at,
    
        task_category.category_name as task_category_name,

        task_category.id as task_category_id,
     



        taskboard_columns.column_name as board_column_name,
        taskboard_columns.slug as board_column_slug,
        taskboard_columns.label_color as board_column_color,
        taskboard_columns.id as board_column_id
       
 
    FROM tasks
    LEFT JOIN task_category ON tasks.task_category_id =  task_category.id

    LEFT JOIN taskboard_columns ON tasks.board_column_id =  taskboard_columns.id

    WHERE tasks.id IN (
        SELECT task_id
        FROM task_users
        WHERE user_id = ?
    ) AND tasks.board_column_id IN ( 1, 3 )
    ORDER BY tasks.id DESC;
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLabelCount($id)
    {
        $query = $this->db->prepare("
        SELECT 
            COUNT(*) as count
        FROM tasks
        WHERE board_column_id = :id
        ");
        $query->bindParam(':id', $id);
        $query->execute();
        $result = $query->fetchColumn();
  
        return intval($result);
    }
}

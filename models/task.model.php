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
}

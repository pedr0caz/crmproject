<?php
require_once("base.model.php");

class Events extends Base
{
    public function getProjectsOfEmployee($id)
    {
        $query = $this->db->prepare("
        
        SELECT 
        p.id AS project_id,
        p.project_name,
        p.deadline,
        p.start_date
    FROM projects p
    LEFT JOIN project_teams pt ON p.id = pt.project_id
    LEFT JOIN teams t ON pt.team_id = t.id
    LEFT JOIN client_details c ON p.client_id = c.id
    LEFT JOIN users u ON c.user_id = u.id

    WHERE pt.team_id IN ( SELECT team_id FROM employee_teams WHERE user_id = ? );

        
       
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjectByClientID($id)
    {
        $query = $this->db->prepare("
        SELECT
        p.id AS project_id,
        p.project_name,
        p.start_date,
        p.deadline
        
    
    FROM projects p
    LEFT JOIN project_category c ON p.category_id = c.id
    LEFT JOIN client_details cd ON p.client_id = cd.id
    LEFT JOIN users u ON cd.user_id = u.id
    LEFT JOIN teams t ON p.team_id = t.id
    LEFT JOIN users uc ON cd.user_id = uc.id

    
    WHERE client_id = ?;
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjects()
    {
        $query = $this->db->prepare("
        SELECT
        p.id AS project_id,
        p.project_name,

        p.start_date,
        p.deadline
       
    
    FROM projects p
    LEFT JOIN project_category c ON p.category_id = c.id
    LEFT JOIN client_details cd ON p.client_id = cd.id

    LEFT JOIN users u ON cd.user_id = u.id
    LEFT JOIN teams t ON p.team_id = t.id
            
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTasks()
    {
        $query = $this->db->prepare("
        SELECT 
        t.id AS task_id,
        t.heading,
        t.description,
        t.due_date,
        t.start_date,

        t.project_id,
        p.project_name
        

        FROM tasks t
        INNER JOIN users u ON u.id = t.created_by
        INNER JOIN taskboard_columns tc ON tc.id = t.board_column_id
        INNER JOIN task_category tcat ON tcat.id = t.task_category_id
        LEFT JOIN projects p ON t.project_id = p.id
        WHERE t.board_column_id IN (1, 3)
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTasksOfEmployee($id)
    {
        $query = $this->db->prepare("
        SELECT 
        t.id AS task_id,
        t.heading,
        t.description,
        t.due_date,
        t.start_date,

        t.project_id,
        p.project_name
        

        FROM tasks t
        INNER JOIN users u ON u.id = t.created_by
        INNER JOIN taskboard_columns tc ON tc.id = t.board_column_id
        INNER JOIN task_category tcat ON tcat.id = t.task_category_id
        LEFT JOIN projects p ON t.project_id = p.id
        WHERE t.board_column_id IN (1, 3) AND t.id IN (SELECT task_id FROM task_users WHERE user_id = ?)
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

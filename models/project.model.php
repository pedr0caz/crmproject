<?php

require_once("base.model.php");

class Project extends Base
{
    public function getProjects()
    {
        $query = $this->db->prepare("
            SELECT
                p.id AS project_id,
                p.project_name,
                p.project_summary,
                p.project_admin,
                p.status,
                p.start_date,
                p.deadline,
                p.notes,
                c.category_name,
                u.name,
                u.email,
                u.id AS user_id,
                t.team_name,
                t.id AS team_id


            FROM projects p
            INNER JOIN project_category c ON p.category_id = c.id
            INNER JOIN users u ON p.client_id = u.id
            INNER JOIN teams t ON p.team_id = t.id
            
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProject($id)
    {
        $query = $this->db->prepare("
            SELECT
                p.id AS project_id,
                p.project_name,
                p.project_summary,
                p.project_admin,
                p.status,
                p.start_date,
                p.deadline,
                p.notes,
                c.category_name,
                u.name,
                u.email,
                u.id AS user_id,
                t.team_name,
                t.id AS team_id
            
            FROM projects p
            INNER JOIN project_category c ON p.category_id = c.id
            INNER JOIN users u ON p.client_id = u.id
            INNER JOIN teams t ON p.team_id = t.id
            WHERE p.id = ?
        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function newProject($data)
    {
        $query = $this->db->prepare("
            INSERT INTO projects (project_name, project_summary, project_admin, status, start_date, deadline, notes, category_id, client_id, team_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $query->execute([
            $data["project_name"],
            $data["project_summary"],
            $data["project_admin"],
            $data["status"],
            $data["start_date"],
            $data["deadline"],
            $data["notes"],
            $data["category_id"],
            $data["client_id"],
            $data["team_id"]
        ]);
        return $this->db->lastInsertId();
    }

    public function updateProject($data)
    {
        $query = $this->db->prepare("
            UPDATE projects
            SET
                project_name = ?,
                project_summary = ?,
                project_admin = ?,
                status = ?,
                start_date = ?,
                deadline = ?,
                notes = ?,
                category_id = ?,
                client_id = ?,
                team_id = ?
            WHERE id = ?
        ");
        $query->execute([
            $data["project_name"],
            $data["project_summary"],
            $data["project_admin"],
            $data["status"],
            $data["start_date"],
            $data["deadline"],
            $data["notes"],
            $data["category_id"],
            $data["client_id"],
            $data["team_id"],
            $data["id"]
        ]);
    }
}

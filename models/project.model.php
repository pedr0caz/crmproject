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
            LEFT JOIN project_category c ON p.category_id = c.id
            LEFT JOIN users u ON p.client_id = u.id
            LEFT JOIN teams t ON p.team_id = t.id
            
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

    public function getProjectByClient($id)
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
            WHERE client_id = ?
        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getProjectMembers($id)
    {
        $query = $this->db->prepare("
            SELECT
                pm.user_id,
                u.name,
                u.image,
            FROM project_members pm
            INNER JOIN users u ON pm.user_id = u.id
            WHERE project_id = ?
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

    public function deleteProject($id)
    {
        $query = $this->db->prepare("
            DELETE FROM projects
            WHERE id = ?
        ");
        $query->execute([$id]);
    }

    public function getProjectActivity($id)
    {
        $query = $this->db->prepare("
            SELECT
                id as activity_id,
                activity
            FROM project_activity
            WHERE project_id = ?

        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function newProjectActivity($data)
    {
        $query = $this->db->prepare("
            INSERT INTO project_activity (activity, project_id)
            VALUES (?, ?)
        ");
        $query->execute([
            $data["activity"],
            $data["project_id"]
        ]);
        return $this->db->lastInsertId();
    }

    public function uploadProjectFile($data)
    {
        $query = $this->db->prepare("
            INSERT INTO project_files (
                user_id,
                project_id,
                filename,
                hashname,
                size,
                description,
                added_by,

            )
            VALUES (?, ?, ?)
        ");
        $query->execute([
            $data["user_id"],
            $data["project_id"],
            $data["filename"],
            $data["hashname"],
            $data["size"],
            $data["description"],
            $data["added_by"]

        ]);
        return $this->db->lastInsertId();
    }
    public function getProjectFiles($id)
    {
        $query = $this->db->prepare("
            SELECT
                id as file_id,
                user_id,
                project_id,
                filename,
                hashname,
                size,
                description,
                added_by,
                added_on
            FROM project_files
            WHERE project_id = ?

        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getFileProject($id)
    {
        $query = $this->db->prepare("
            SELECT
                id as file_id,
                user_id,
                project_id,
                filename,
                hashname,
                size,
                description,
                added_by,
                added_on
            FROM project_files
            WHERE id = ?

        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getProjectNotes($id)
    {
        $query = $this->db->prepare("
            SELECT
                n.title,
                n.type,
                u.name,
                u.email,
                n.is_client_show,
                n.details,
                n.updated_at
            FROM project_notes n
            INNER JOIN users u ON n.user_id = u.id
            WHERE n.project_id = ?
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function newProjectNote($data)
    {
        $query = $this->db->prepare("
            INSERT INTO project_notes (title, type, user_id, is_client_show, details, project_id)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $query->execute([
            $data["title"],
            $data["type"],
            $data["user_id"],
            $data["is_client_show"],
            $data["details"],
            $data["project_id"]
        ]);
        return $this->db->lastInsertId();
    }

    public function getProjectCategory()
    {
        $query = $this->db->prepare("
            SELECT category_name, id
            FROM project_category

        ");

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDepartments()
    {
        $query = $this->db->prepare("
            SELECT
                id,
                team_name
            FROM 
                teams
        ");

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

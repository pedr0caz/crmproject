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
        p.completion_percent,
        p.client_id,
        p.status,
        p.start_date,
        p.deadline,
        p.notes,
        c.category_name,
        u.name,
        u.email,
        u.image,
        cd.company_name,
        u.id AS user_id,
        t.team_name,
        t.id AS team_id
    
    FROM projects p
    LEFT JOIN project_category c ON p.category_id = c.id
    LEFT JOIN client_details cd ON p.client_id = cd.id

    LEFT JOIN users u ON cd.user_id = u.id
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
        p.completion_percent,
        p.client_id,
        p.status,
        p.start_date,
        p.deadline,
        p.notes,
        p.category_id,
        c.category_name,
        u.name,
        u.email,
        u.image,
        cd.company_name,
        u.id AS user_id,
        CONCAT('[', GROUP_CONCAT(pt.team_id SEPARATOR ','), ']') as teams_id
    
    FROM projects p
    LEFT JOIN project_category c ON p.category_id = c.id
    LEFT JOIN client_details cd ON p.client_id = cd.id
    LEFT JOIN project_teams pt ON p.id = pt.project_id
    LEFT JOIN users u ON cd.user_id = u.id
    LEFT JOIN teams t ON pt.id = t.id
    WHERE p.id = ?;
        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getProjectIDClient($id, $user_id)
    {
        $query = $this->db->prepare("
        SELECT
        p.id AS project_id,
        p.project_name,
        p.project_summary,
        p.project_admin,
        p.completion_percent,
        p.client_id,
        p.status,
        p.start_date,
        p.deadline,
        p.notes,
        p.category_id,
        c.category_name,
        u.name,
        u.email,
        u.image,
        cd.company_name,
        u.id AS user_id,
        CONCAT('[', GROUP_CONCAT(pt.team_id SEPARATOR ','), ']') as teams_id
    
    FROM projects p
    LEFT JOIN project_category c ON p.category_id = c.id
    LEFT JOIN client_details cd ON p.client_id = cd.id
    LEFT JOIN project_teams pt ON p.id = pt.project_id
    LEFT JOIN users u ON cd.user_id = u.id
    LEFT JOIN teams t ON pt.id = t.id
    WHERE p.id = ? AND p.client_id = ?;
        ");
        $query->execute([$id, $user_id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }


    public function getProjectID($id, $user_id)
    {
        $query = $this->db->prepare("
        SELECT
        p.id AS project_id,
        p.project_name,
        p.project_summary,
        p.project_admin,
        p.completion_percent,
        p.client_id,
        p.status,
        p.start_date,
        p.deadline,
        p.notes,
        p.category_id,
        c.category_name,
        u.name,
        u.email,
        u.image,
        cd.company_name,
        u.id AS user_id,
		CONCAT('[', GROUP_CONCAT(pt.team_id SEPARATOR ','), ']') as teams_id
        
    FROM projects p
    LEFT JOIN project_category c ON p.category_id = c.id
    LEFT JOIN client_details cd ON p.client_id = cd.id
    LEFT JOIN project_teams pt ON p.id = pt.project_id
    LEFT JOIN users u ON cd.user_id = u.id
    LEFT JOIN teams t ON pt.id = t.id
    WHERE p.id = ? AND p.id IN ( SELECT project_id FROM project_teams WHERE team_id IN (SELECT team_id FROM employee_teams WHERE user_id = ?) )
    GROUP BY p.id;
        ");
        $query->execute([$id, $user_id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }


    public function getTaskColumns()
    {
        $query = $this->db->prepare("
        SELECT * FROM taskboard_columns
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTaskStatus($id)
    {
        $query = $this->db->prepare("
        SELECT COUNT(t.board_column_id) AS status_count, 
      		
        tb.column_name,
        tb.slug,
        tb.label_color
        FROM tasks t
        INNER JOIN taskboard_columns tb ON t.board_column_id = tb.id
        WHERE t.project_id = ?
        GROUP BY tb.column_name
        ORDER BY tb.priority;
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjectProgress($id)
    {
        $query = $this->db->prepare("
         SELECT COUNT(t.board_column_id) AS status_count,
            tb.column_name,
            tb.slug,
            tb.label_color
            FROM tasks t
            INNER JOIN taskboard_columns tb ON t.board_column_id = tb.id
            WHERE t.project_id = ?
            GROUP BY tb.column_name

        ");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $total = 0;
        $completed = 0;
        foreach ($result as $row) {
            $total += $row["status_count"];
            if ($row["slug"] == "completed") {
                $completed = $row["status_count"];
            }
        }
        if ($total == 0) {
            $query= $this->db->prepare("UPDATE projects SET completion_percent = 0 WHERE id = ?");
            $query->execute([$id]);

            return 0;
        } else {
            $value = round(($completed / $total) * 100);
            $query= $this->db->prepare("UPDATE projects SET completion_percent = $value WHERE id = ?");
            $query->execute([$id]);
            return $value;
        }
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
            LEFT JOIN project_category c ON p.category_id = c.id
            LEFT JOIN users u ON p.client_id = u.id
            LEFT JOIN teams t ON p.team_id = t.id
            WHERE client_id = ?
        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getProjectByClientID($id)
    {
        $query = $this->db->prepare("
        SELECT
        p.id AS project_id,
        p.project_name,
        p.project_summary,
        p.project_admin,
        p.completion_percent,
        p.client_id,
        p.status,
        p.start_date,
        p.deadline,
        p.notes,
        c.category_name,
        u.name,
        u.email,
        u.image,
        cd.company_name,
        u.id AS user_id,
        t.team_name,
        t.id AS team_id,
        cd.id AS client_id,

        uc.name AS client_name
    
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

    public function getProjectTeamMembers($id)
    {
        $query = $this->db->prepare("
        SELECT DISTINCT
        pt.team_id,
        et.user_id,
        u.id AS user_id,
        u.name,
        u.email,
        u.image,
        d.name as employee_designation,
        ed.designation_id,
        t.team_name
        
    FROM employee_teams et   
    LEFT JOIN users u ON et.user_id = u.id
    LEFT JOIN employee_details ed ON et.user_id = ed.user_id
    LEFT JOIN designations d ON ed.designation_id = d.id
    LEFT JOIN project_teams pt ON et.team_id = pt.team_id
    LEFT JOIN teams t ON et.team_id = t.id
    WHERE pt.project_id = ?

        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function newProject($data)
    {
        $query = $this->db->prepare("
            INSERT INTO projects (project_name, project_summary, start_date, deadline, notes, category_id, client_id, team_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $query->execute([
            $data["project_name"],
            $data["project_description"],

            $data["start_date"],
            $data["deadline"],
            $data["notes"],
            $data["category_id"],
            $data["client_id"],
            $data["team_id"][0]
        ]);
        
        $project_id = $this->db->lastInsertId();
        if ($project_id) {
            foreach ($data["team_id"] as $team_id) {
                $query = $this->db->prepare("
                    INSERT INTO project_teams (project_id, team_id)
                    VALUES (?, ?)
                ");
                $query->execute([
                    $project_id,
                    $team_id
                ]);
            }

            $query = $this->db->prepare("
            INSERT INTO project_activity (project_id, activity) 
            VALUES (?, ?)
            ");
            $query->execute([
                $project_id,
                "Project Created"
            ]);

            return [
                "status" => true,
                "message" => "Project created successfully",
                "id" => $project_id
            ];
        } else {
            return [
                "status" => false,
                "message" => "Project creation failed"
            ];
        }
    }

    public function editProject($id, $data)
    {
        $query = $this->db->prepare("
            UPDATE projects SET
            project_name = ?,
            project_summary = ?,
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
            $data["project_description"],
            $data["start_date"],
            $data["deadline"],
            $data["notes"],
            $data["category_id"],
            $data["client_id"],
            $data["team_id"][0],
            $id
        ]);
        $project_id = $id;
        if ($project_id) {
            $query = $this->db->prepare("
                DELETE FROM project_teams WHERE project_id = ?
            ");
            $query->execute([$project_id]);
            foreach ($data["team_id"] as $team_id) {
                $query = $this->db->prepare("
                    INSERT INTO project_teams (project_id, team_id)
                    VALUES (?, ?)
                ");
                $query->execute([
                    $project_id,
                    $team_id
                ]);
            }

            $query = $this->db->prepare("
            INSERT INTO project_activity (project_id, activity) 
            VALUES (?, ?)
            ");
            $query->execute([
                $project_id,
                "Project Details Updated"
            ]);

            return [
                "status" => true,
                "message" => "Project updated successfully",
                "id" => $project_id
            ];
        } else {
            return [
                "status" => false,
                "message" => "Project update failed"
            ];
        }
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
                activity,
                created_at
            FROM project_activity
            WHERE project_id = ?
            ORDER BY created_at DESC

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
    public function getFiles($id)
    {
        $query = $this->db->prepare("
        SELECT name, id, filename, created_at,user_id FROM project_files WHERE project_id = ?
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function newFile($id, $userid, $name, $file)
    {
        $query = $this->db->prepare("
        INSERT INTO project_files (user_id, project_id, name, filename, created_at)
        VALUES (?, ?, ?, ?, ?)
        ");
        $query->execute([
            $userid,
            $id,
            
            $name,
            $file,
            date("Y-m-d H:i:s")
        ]);
        $idfile = $this->db->lastInsertId();
        if ($idfile) {
            $query = $this->db->prepare("
            INSERT INTO project_activity (project_id, activity, created_at)
            VALUES (?, ?, ?)
            ");
            $query->execute([
                $id,
                "New file uploaded by " . $_SESSION["user_name"],
                date("Y-m-d H:i:s")
            ]);

            $query = $this->db->prepare("
             SELECT name, id, filename, created_at FROM project_files WHERE id = ?
            ");
            $query->execute([$idfile]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
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


    public function getProjectTasks($id)
    {
        $query = $this->db->prepare("
        SELECT
        t.id,
        t.heading,
        t.description,
        t.due_date,
        t.start_date,
        t.project_id,
        t.task_category_id,
        t.priority,
        t.status,
        t.board_column_id,
        t.column_priority,
        t.completed_on,
        t.created_by,
        t.updated_at,
        t.is_private,
        t.added_by,
        t.last_updated_by,
        t.event_id,
        tc.category_name,
        bc.column_name,
        bc.slug,
        bc.label_color,
        bc.priority,
        u.name,
        u.email,
        u.image,
        u.id as user_id
    FROM tasks t
    INNER JOIN task_category tc ON t.task_category_id = tc.id
    INNER JOIN taskboard_columns bc ON t.board_column_id = bc.id
    INNER JOIN users u ON t.created_by = u.id
    WHERE t.project_id = ?;
            
                
                
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteFile($id, $user_id)
    {
        $query = $this->db->prepare("
        DELETE FROM project_files WHERE id = ? AND user_id = ?
        ");
        $result = $query->execute([$id, $user_id]);
        if ($result) {
            $query = $this->db->prepare("
            INSERT INTO project_activity (project_id, activity, created_at)
            VALUES (?, ?, ?)

            ");
            $query->execute([
                $id,
                "File deleted by " . $_SESSION["user_name"],
                date("Y-m-d H:i:s")
            ]);

            return true;
        } else {
            return false;
        }
    }

    public function deleteFileAdmin($id)
    {
        $query = $this->db->prepare("
        DELETE FROM project_files WHERE id = ?
        ");
        $result = $query->execute([$id]);
        if ($result) {
            $query = $this->db->prepare("
            INSERT INTO project_activity (project_id, activity, created_at)
            VALUES (?, ?, ?)

            ");
            $query->execute([
                $id,
                "File deleted by " . $_SESSION["user_name"],
                date("Y-m-d H:i:s")
            ]);

            return true;
        } else {
            return false;
        }
    }

    public function newCategory($name)
    {
        $query = $this->db->prepare("
        INSERT INTO project_category (category_name)
        VALUES (?)
        ");
        $query->execute([$name]);
        return $this->db->lastInsertId();
    }

    public function editCategory($id, $name)
    {
        $query = $this->db->prepare("
        UPDATE project_category SET category_name = ? WHERE id = ?
        ");
        $query->execute([$name, $id]);
        return $query->rowCount();
    }
    public function deleteCategory($id)
    {
        $query = $this->db->prepare("
            DELETE FROM project_category WHERE id = ?
        ");
        $query->execute([$id]);
        return $query->rowCount();
    }

    public function changeProjectStatus($name, $id)
    {
        $query = $this->db->prepare("
        UPDATE projects SET status = ? WHERE id = ?
        ");
        $result = $query->execute([$name, $id]);
        if ($result) {
            $query = $this->db->prepare("
            INSERT INTO project_activity (project_id, activity, created_at)
            VALUES (?, ?, ?)
            ");
            $query->execute([
                $id,
                "Project status changed to " . ucwords($name),
                date("Y-m-d H:i:s")
            ]);
            return [
                "status" => true,
                "message" => "Project status changed successfully"
            ];
        }
    }

    public function deleteMemberFromProject($id, $user_id)
    {
        $query = $this->db->prepare("
            DELETE FROM employee_teams
            WHERE team_id = ? AND user_id = ?
        ");
        $result = $query->execute([$id, $user_id]);
        if ($result) {
            $query = $this->db->prepare("
            INSERT INTO project_activity (project_id, activity, created_at)
            VALUES (?, ?, ?)
            ");
            $query->execute([
                $id,
                "Member removed from project",
                date("Y-m-d H:i:s")
            ]);
            return [
                "status" => true,
                "message" => "Member removed from project successfully"
            ];
        }
    }

    public function editTeamsOnProject($id, $teams)
    {
        $query = $this->db->prepare("
            DELETE FROM project_teams
            WHERE project_id = ?
        ");
        $result = $query->execute([$id]);
        if ($result) {
            foreach ($teams as $team) {
                $query = $this->db->prepare("
                    INSERT INTO project_teams (project_id, team_id)
                    VALUES (?, ?)
                ");
                $query->execute([$id, $team]);
            }
            $query = $this->db->prepare("
            INSERT INTO project_activity (project_id, activity, created_at)
            VALUES (?, ?, ?)
            ");
            $query->execute([
                $id,
                "Teams updated on project",
                date("Y-m-d H:i:s")
            ]);
            return [
                "status" => true,
                "message" => "Teams updated on project successfully"
            ];
        } else {
            return [
                "status" => false,
                "message" => "Something went wrong"
            ];
        }
    }
}

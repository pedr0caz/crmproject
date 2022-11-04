<?php
require_once("base.model.php");

class Notices extends Base
{
    public function getNotices($user_role, $user_id)
    {
        $query = $this->db->prepare("
        SELECT 
        n.id,
        n.toGroup,
        n.heading,
        n.description,
        n.created_at,
        n.department_id,
        n.added_by,
        r.display_name,
        t.team_name
            FROM notices n
            INNER JOIN roles r ON r.id = n.toGroup
            LEFT JOIN teams t ON t.id = n.department_id
            WHERE (toGroup = ? AND (n.department_id IN ( SELECT team_id FROM employee_teams WHERE user_id = ?) OR department_id IS NULL) OR toGroup = ?)
            ORDER BY n.created_at DESC;

        ");
        $query->execute([$user_role, $user_id, $user_role]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNoticesAdmin()
    {
        $query = $this->db->prepare("
        SELECT 
        n.id,
        n.toGroup,
        n.heading,
        n.description,
        n.created_at,
        n.department_id,
        n.added_by,
        r.display_name,
        t.team_name
            FROM notices n
            LEFT JOIN roles r ON r.id = n.toGroup
            LEFT JOIN teams t ON t.id = n.department_id
        
            ORDER BY n.created_at DESC

        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNotice($user_role, $user_id, $id)
    {
        $query = $this->db->prepare("
        SELECT 
        n.id,
        n.toGroup,
        n.heading,
        n.description,
        n.created_at,
        n.department_id,
        n.added_by,
        r.display_name,
        t.team_name
    FROM notices n
    INNER JOIN roles r ON r.id = n.toGroup
    LEFT JOIN teams t ON t.id = n.department_id
    WHERE (toGroup = ? AND n.department_id IN ( SELECT team_id FROM employee_teams WHERE user_id = ? )) OR (n.toGroup = ? AND  n.id = ?);
        

        ");
        $query->execute([$user_role, $user_id, $user_role, $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getNoticeAdmin($id)
    {
        $query = $this->db->prepare("
            SELECT 
                n.id,
                n.toGroup,
                n.heading,
                n.description,
                n.created_at,
                n.department_id,
                n.added_by,
                r.display_name,
                t.team_name
            FROM notices n
            LEFT JOIN roles r ON r.id = n.toGroup
            LEFT JOIN teams t ON t.id = n.department_id
            WHERE n.id = ?

        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function newNotice($data, $user_id)
    {
        $data['team_id'] = $data['team_id'] == "" ? null : $data['team_id'];
        $query = $this->db->prepare("
            INSERT INTO notices (toGroup, heading, description, department_id, added_by)
            VALUES (?, ?, ?, ?, ?)
        ");
        $query->execute([$data["to"], $data["heading"], $data["description"], $data["team_id"], $user_id]);
        return $this->db->lastInsertId();
    }

    public function editNotice($data, $id)
    {
        $query = $this->db->prepare("
            UPDATE notices
            SET toGroup = ?, heading = ?, description = ?, department_id = ?
            WHERE id = ?
        ");
        $result = $query->execute([$data["to"], $data["heading"], $data["description"], $data["team_id"], $id]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteNotice($id)
    {
        $query = $this->db->prepare("
            DELETE FROM notices
            WHERE id = ?
        ");
        $result = $query->execute([$id]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}

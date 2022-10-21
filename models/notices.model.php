<?php
require_once("base.model.php");

class Notices extends Base
{
    public function getNotice($id, $user_id, $user_role)
    {
        $query = $this->db->prepare("
            SELECT
                n.id AS notice_id,
                n.heading,
                n.description
                n.updated_at,
                u.name,
                u.email,
                u.id AS user_id,
                t.team_name,
                t.id AS team_id

            FROM notices n
            INNER JOIN users u ON n.notice_admin = u.id
            INNER JOIN teams t ON n.team_id = t.id
            WHERE n.id = ? AND n.notice_admin = ? AND n.notice_status = 'active'
        ");
        $query->execute([$id, $user_id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}

<?php
require_once("base.model.php");

class User extends Base
{
    public function newUser($data)
    {
        $query = $this->db->prepare("
            INSERT INTO users (name, email, password)
            VALUES (?, ?, ?, ?)
        ");
        $query->execute([
            $data["name"],
            $data["email"],
            password_hash($data["password"], PASSWORD_DEFAULT)
        ]);
        return $this->db->lastInsertId();
    }
    public function login($data)
    {
        $query = $this->db->prepare("
            SELECT password, id, name
            FROM users
            WHERE email = ? and status = 'active' and login = 'enable'
        ");
        $query->execute([$data["email"]]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($user) && password_verify($data["password"], $user["password"])) {
            return $user;
        }
        return [];
    }

    public function getUser($id)
    {
        $query = $this->db->prepare("INSERT user_activities(user_id, activity, created_at) VALUES(?, ?, ?)");
        $query->execute([$id, "Logged in", date("Y-m-d H:i:s")]);

        $query = $this->db->prepare("
            SELECT 
                u.id AS user_id,
                u.name,
                u.email,
                r.role_id,
                c.name AS role_name
            
            FROM users u
            INNER JOIN role_user r ON u.id = r.user_id
            INNER JOIN roles c ON r.role_id = c.id
            WHERE u.id = ?

        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getCountries()
    {
        $query = $this->db->prepare("
            SELECT
                id,
                nicename
            FROM countries
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

/*     public function getRole($id)
    {
        $query = $this->db->prepare("
            SELECT
                role
            FROM users
            WHERE id = ?
        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    } */
}

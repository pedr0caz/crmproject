<?php
require_once("base.model.php");

class User extends Base
{
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
        $query = $this->db->prepare("
            SELECT
                id,
                name,
                email,
      

            FROM users
            WHERE id = ?
        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getRole($id)
    {
        $query = $this->db->prepare("
            SELECT
                role
            FROM users
            WHERE id = ?
        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}

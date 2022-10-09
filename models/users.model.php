<?php
require_once("base.model.php");

class User extends Base
{
    public function newUser($data)
    {
        $query = $this->db->prepare("
            INSERT INTO
            users
            (name, email, password, street, postal_code, city, country)
            VALUES
            ( ?, ?, ?, ?, ?, ?, ? )
        ");
        $password_hash = password_hash($data["password"], PASSWORD_DEFAULT);
        try {
            $query->execute([
                $data["name"],
                $data["email"],
                $password_hash,
                $data["street"],
                $data["postal_code"],
                $data["city"],
                $data["country"]
            ]);
            $user_id = $this->db->lastInsertId();
            return $user_id;
        } catch (PDOException $erro) {
            if ($erro->errorInfo[1] == 1062) {
                return false;
            } else {
                return false;
            }
        }
    }

    public function login($data)
    {
        $query = $this->db->prepare("
            SELECT password, user_id, name
            FROM users
            WHERE email = ?
        ");
        $query->execute([$data["email"]]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($user) && password_verify($data["password"], $user["password"])) {
            return $user;
        }
        return [];
    }
}

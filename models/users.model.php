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
            SELECT password, id, name, email
            FROM users
            WHERE email = ? and status = 'active' and login = 'enable'
        ");
        $query->execute([$data["email"]]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($user) && password_verify($data["password"], $user["password"])) {
            $query = $this->db->prepare("INSERT user_activities(user_id, activity, created_at) VALUES(?, ?, ?)");
            $query->execute([
                $user['id'],
                json_encode([
                    "en" => "Logged in",
                    "pt" => "Fez login",
                ]),
                date("Y-m-d H:i:s")
            ]);
            $query = $this->db->prepare("UPDATE users SET last_login = ? AND SET last_seen = ? WHERE id = ?");
            $query->execute([date("Y-m-d H:i:s"),date("Y-m-d H:i:s") ,$user['id']]);

            return $user;
        }
        return [];
    }


    public function forgotPassword($data)
    {
        $query = $this->db->prepare("
            SELECT id, name, email
            FROM users
            WHERE email = ? and status = 'active' and login = 'enable'
        ");
        $query->execute([$data["email"]]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($user)) {
            return $user;
        }
        return [];
    }

    public function updateToken($id, $token)
    {
        $query = $this->db->prepare("
            UPDATE users
            SET token = ?
            WHERE id = ?
        ");
        $query->execute([$token, $id]);
    }

    public function getUserByToken($token)
    {
        $query = $this->db->prepare("
            SELECT id, name, email
            FROM users
            WHERE token = ? and status = 'active' and login = 'enable'
        ");
        $query->execute([$token]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($user)) {
            return $user;
        }
        return [];
    }

    public function updatePassword($id, $password)
    {
        $query = $this->db->prepare("
            UPDATE users
            SET password = ?
            WHERE id = ?
        ");
        $result = $query->execute([password_hash($password, PASSWORD_DEFAULT), $id]);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getUser($id)
    {
        $query = $this->db->prepare("
        SELECT 
        u.id AS user_id,
        u.name,
        u.email,
        u.image,
        u.password,
        u.mobile,
        u.country_id,
        u.last_seen,
        u.last_login,
        u.status,
        u.login,
        r.role_id,

        c.name AS role_name,
        cd.id AS client_id

    
    FROM users u
    LEFT JOIN role_user r ON u.id = r.user_id
    LEFT JOIN roles c ON r.role_id = c.id
    LEFT JOIN client_details cd ON u.id = cd.user_id
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
                nicename,
                iso,
                iso3
            FROM countries
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function chatUsers($id)
    {
        $query = $this->db->prepare("
            SELECT
                u.id AS user_id,
                u.name,
                u.email,
                u.image,
                u.online,
                r.role_id,
                c.name AS role_name
            FROM users u
            INNER JOIN role_user r ON u.id = r.user_id
            INNER JOIN roles c ON r.role_id = c.id
            WHERE u.id != ?
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchUser($name, $id, $role)
    {
        if ($role == 3) {
            $query = $this->db->prepare("
            SELECT
                users.id AS user_id,
                users.name,
                users.email,
                users.image,
                role_user.user_id

              
            FROM users
            INNER JOIN role_user ON users.id = role_user.user_id
            WHERE name LIKE concat('%', ?, '%') AND id != ? AND status = 'active' AND login = 'enable' AND role_id IN (1,2)
        ");
        } else {
            $query = $this->db->prepare("
            SELECT
                users.id AS user_id,
                users.name,
                users.email,
                users.image

              
            FROM users
            WHERE name LIKE concat('%', ?, '%') AND id != ? AND status = 'active' AND login = 'enable'");
        }
        $query->execute([$name, $id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNotices($id, $role)
    {
        $query = $this->db->prepare("
            SELECT
                id,
                heading,
                description,
                created_at
            FROM notices
            WHERE department_id IN ( SELECT team_id FROM employee_teams WHERE user_id = ? ) OR toGroup = ?
            ORDER BY created_at DESC
            LIMIT 5
        ");

        $query->execute([$id, $role]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        return $results;
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

    public function getDepartment($id)
    {
        $query = $this->db->prepare("
            SELECT 
                et.team_id,
                t.team_name
            FROM employee_teams et
            INNER JOIN teams t ON et.team_id = t.id
            WHERE et.user_id = ?
        ");
        $query->execute([$id]);
        $departments = $query->fetchAll(PDO::FETCH_ASSOC);
        return $departments;
    }

    public function getDesignation($id)
    {
        $query = $this->db->prepare("
            SELECT 
                d.name
            FROM designations d
            INNER JOIN employee_details ed ON d.id = ed.designation_id
            WHERE ed.user_id = ?
        ");
        $query->execute([$id]);
        $designations = $query->fetch(PDO::FETCH_ASSOC);
        return $designations;
    }

    public function getBirthdays()
    {
        $query = $this->db->prepare("
            SELECT
                u.id,
                u.name,
                u.email,
                u.image,
                e.date_of_birth,
                d.name AS designation
            FROM users u
            INNER JOIN employee_details e ON u.id = e.user_id
            INNER JOIN designations d ON e.designation_id = d.id
            WHERE MONTH(e.date_of_birth) = MONTH(CURDATE()) 
            ORDER BY e.date_of_birth ASC

        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateRememberToken($id, $token, $ip)
    {
        $query = $this->db->prepare("
            UPDATE users
            SET remember_token = ?, 
            IP = ?
            WHERE id = ?
        ");
        $result = $query->execute([$token, $ip , $id]);
        return $result;
    }

    public function getUserByRememberToken($token, $email, $ip)
    {
        $query = $this->db->prepare("
            SELECT id, name, email
            FROM users
            WHERE remember_token = ? AND email = ? AND status = 'active' and login = 'enable' AND IP = ?
        ");
        $query->execute([$token, $email, $ip]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($user)) {
            return $user;
        }
        return [];
    }

    public function logout($id)
    {
        $query = $this->db->prepare("
            UPDATE users
            SET remember_token = NULL , IP = NULL
            WHERE id = ?
        ");
        $result = $query->execute([$id]);
        return $result;
    }

    public function updateUser($id, $name, $email, $mobile, $country_id, $image)
    {
        $query = $this->db->prepare("
            UPDATE users
            SET name = ?, email = ?, mobile = ?, country_id = ?, image = ?
            WHERE id = ?
        ");
        $result = $query->execute([$name, $email, $mobile, $country_id, $image, $id]);
        if ($result) {
            return [
                'status' => true,
                'message' => 'Profile updated successfully'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Profile update failed'
            ];
        }
    }
}

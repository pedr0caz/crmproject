<?php
require_once("base.model.php");

class Employee extends Base
{
    public function getEmployees()
    {
        /*  $query = $this->db->prepare("
         SELECT
         u.id AS user_id,
          u.name,
          u.email,
          u.image,
          u.status,
          e.id AS employee_id,
          e.address,
          e.date_of_birth,
          r.role_id,
          c.name AS role_name,
          et.team_id,
          t.team_name

     FROM users u
     INNER JOIN role_user r ON u.id = r.user_id
     INNER JOIN roles c ON r.role_id = c.id
     INNER JOIN employee_details e ON u.id = e.user_id
         INNER JOIN employee_teams et ON u.id = et.user_id
         INNER JOIN teams t ON et.team_id = t.id;





         "); */

        $query = $this->db->prepare("
        SELECT
        u.id AS user_id,
         u.name,
         u.email,
         u.image,
         u.status,
         e.id AS employee_id,
         e.address,
         e.date_of_birth,
         r.role_id,
         c.name AS role_name,
         e.designation_id,
            d.name AS designation_name
        
        FROM users u
        INNER JOIN role_user r ON u.id = r.user_id
        INNER JOIN roles c ON r.role_id = c.id
        INNER JOIN employee_details e ON u.id = e.user_id
        INNER JOIN designations d ON e.designation_id = d.id;
        ");
           
     
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmployee($id)
    {
        $query = $this->db->prepare("
        SELECT
        u.id AS user_id,
         u.name,
         u.email,
         u.mobile,
         u.gender,
         u.image,
         u.status,
         e.id AS employee_id,
         e.address,
         e.slack_username,
         e.skills,
         e.date_of_birth,
         r.role_id,
         c.name AS role_name,
         e.designation_id,
            d.name AS designation_name
        
        FROM users u
        INNER JOIN role_user r ON u.id = r.user_id
        INNER JOIN roles c ON r.role_id = c.id
        INNER JOIN employee_details e ON u.id = e.user_id
        INNER JOIN designations d ON e.designation_id = d.id
        WHERE u.id = ?;
        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getDesignations()
    {
        $query = $this->db->prepare("
            SELECT
                id,
                name
            FROM designations
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
            FROM teams
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function newEmployee($data, $image_file)
    {
        $query = $this->db->prepare("
        INSERT INTO users (name, email, password, image , login, country_id, gender, mobile) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
        $query->execute([
            $data["name"],
            $data["email"],
            $data["password"],
            $image_file,
            $data["login"],
            $data['country_id'],
            $data['gender'],
            $data['mobile']
        ]);

        $id = $this->db->lastInsertId();
        if ($id) {
            $query = $this->db->prepare("
                INSERT INTO employee_details (user_id, address, department_id, designation_id, date_of_birth) 
                VALUES (?, ?, ?, ?, ?)
            ");
            $query->execute([
                $id,
                $data["address"],
                $data["department_id"],
                $data["designation_id"],
                $data["date_of_birth"]

            ]);

            $employeeid = $this->db->lastInsertId();
            if ($employeeid) {
                $query = $this->db->prepare("
                INSERT INTO role_user (user_id, role_id)
                VALUES (?, ?)
                ");
                $query->execute([
                    $id,
                    2
                ]);

                $query = $this->db->prepare("
                INSERT INTO employee_teams (team_id, user_id)
                VALUES (?, ?)
                ");
                $query->execute([
                    $data["department_id"],
                    $id
                ]);
            }
        }
    }

    public function getRoles()
    {
        $query = $this->db->prepare("
            SELECT
                id,
                name
            FROM roles
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmployeeTeams($id)
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
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNumberOfProjects($id)
    {
        $query = $this->db->prepare("
        SELECT COUNT(id) AS project_count
        FROM projects
        WHERE team_id IN ( SELECT team_id FROM employee_teams WHERE user_id = ? );
        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getProjectsOfEmployee($id)
    {
        $query = $this->db->prepare("
        SELECT 
        p.id AS project_id,
       p.project_name,
       p.deadline,
       p.team_id,
       p.client_id,
       p.status,
       p.completion_percent,
       u.name AS client_name,
       u.image,
       t.team_name,
       c.company_name
   FROM projects p
   INNER JOIN teams t ON p.team_id = t.id
   INNER JOIN client_details c ON p.client_id = p.client_id
   INNER JOIN users u ON c.user_id = u.id
   WHERE p.team_id IN ( SELECT team_id FROM employee_teams WHERE user_id = ? );
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMembersOfProject($id)
    {
        $query = $this->db->prepare("
        SELECT
         p.team_id,
            t.team_name,
            u.id AS user_id,
            u.name,
            u.email,
        
            u.image,
            u.status
        FROm projects p
        INNER JOIN teams t ON p.team_id = t.id
        INNER JOIN employee_teams et ON t.id = et.team_id
        INNER JOIN users u ON et.user_id = u.id
        WHERE p.id = ?
        ");
        $query->execute([$id]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNumberOfTasks($id)
    {
        $query = $this->db->prepare("
        SELECT COUNT(id) AS task_count
        FROM tasks
        WHERE status = 'incomplete' AND id IN ( SELECT task_id FROM task_users WHERE user_id = ? );
        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getActivity($id)
    {
        $query = $this->db->prepare("
            SELECT 
                activity,
                created_at
            FROM user_activities
            WHERE user_id = ? ORDER BY created_at DESC LIMIT 30
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function newFile($id, $name, $file)
    {
        $query = $this->db->prepare("
        INSERT INTO employee_docs (user_id, name, filename, created_at)
        VALUES (?, ?, ?, ?)
        ");
        $query->execute([
            $id,
            $name,
            $file,
            date("Y-m-d H:i:s")
        ]);
        $idfile = $this->db->lastInsertId();
        if ($idfile) {
            $query = $this->db->prepare("
            INSERT INTO user_activities (user_id, activity, created_at)
            VALUES (?, ?, ?)
            ");
            $query->execute([
                $id,
                "New file uploaded",
                date("Y-m-d H:i:s")
            ]);

            $query = $this->db->prepare("
             SELECT name, id, filename, created_at FROM employee_docs WHERE id = ?
            ");
            $query->execute([$idfile]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function getFiles($id)
    {
        $query = $this->db->prepare("
        SELECT name, id, filename, created_at FROM employee_docs WHERE user_id = ?
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

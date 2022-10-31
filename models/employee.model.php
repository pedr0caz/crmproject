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
            d.name AS designation_name,
       GROUP_CONCAT(t.team_name SEPARATOR ',') as team_name
        
        FROM users u
        INNER JOIN role_user r ON u.id = r.user_id
        LEFT JOIN employee_teams et ON u.id = et.user_id
        LEFT JOIN teams t ON et.team_id = t.id
        INNER JOIN roles c ON r.role_id = c.id
        INNER JOIN employee_details e ON u.id = e.user_id
        LEFT JOIN designations d ON e.designation_id = d.id;
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
         u.password,
         u.gender,
         u.image,
         e.joining_date,
         u.country_id,
         u.login,
         u.status,
         e.id AS employee_id,
         e.address,
         e.slack_username,
         e.skills,
         e.date_of_birth,
         r.role_id,
         c.name AS role_name,
         e.designation_id,
        d.name AS designation_name,
        GROUP_CONCAT(et.team_id SEPARATOR ',') as department_id
        
        FROM users u
        INNER JOIN role_user r ON u.id = r.user_id
        INNER JOIN roles c ON r.role_id = c.id
        INNER JOIN employee_details e ON u.id = e.user_id
        INNER JOIN designations d ON e.designation_id = d.id
        INNER JOIN employee_teams et ON u.id = et.user_id
        WHERE u.id = ?;
        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteEmployee($id)
    {
        $query = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $result = $query->execute([$id]);
        if ($result) {
            $query = $this->db->prepare("DELETE FROM role_user WHERE user_id = ?");
            $result = $query->execute([$id]);
            if ($result) {
                $query = $this->db->prepare("DELETE FROM employee_details WHERE user_id = ?");
                $result = $query->execute([$id]);
                if ($result) {
                    $query = $this->db->prepare("DELETE FROM employee_teams WHERE user_id = ?");
                    $result = $query->execute([$id]);
                    if ($result) {
                        $query = $this->db->prepare("DELETE FROM employee_docs WHERE user_id = ?");
                        $result = $query->execute([$id]);
                        if ($result) {
                            return [
                                "status" => true,
                                "message" => "Employee was deleted"
                            ];
                        } else {
                            return [
                                "status" => false,
                                "message" => "Error trying to delete"
                            ];
                        }
                    }
                }
            }
        }
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

    public function editDesignation($id, $name)
    {
        $query = $this->db->prepare("
            UPDATE designations
            SET name = ?
            WHERE id = ?
        ");
        $result = $query->execute([$name, $id]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function newDesignation($name)
    {
        $query = $this->db->prepare("
            INSERT INTO designations (name)
            VALUES (?)
        ");
        $result = $query->execute([$name]);
        if ($result) {
            $result = $this->db->lastInsertId();
            return $result;
        } else {
            return false;
        }
    }

    public function deleteDesignation($id)
    {
        $query = $this->db->prepare("
            DELETE FROM designations
            WHERE id = ?
        ");
        $result = $query->execute([$id]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getDepartments()
    {
        $query = $this->db->prepare("
            SELECT
                id,
                team_name AS name
            FROM teams
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editDepartment($id, $name)
    {
        $query = $this->db->prepare("
            UPDATE teams
            SET team_name = ?
            WHERE id = ?
        ");
        $result = $query->execute([$name, $id]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteDepartment($id)
    {
        $query = $this->db->prepare("
            DELETE FROM teams
            WHERE id = ?
        ");
        $result = $query->execute([$id]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function newDepartment($name)
    {
        $query = $this->db->prepare("
            INSERT INTO teams (team_name)
            VALUES (?)
        ");
        $result = $query->execute([$name]);
        if ($result) {
            $result = $this->db->lastInsertId();
            return $result;
        } else {
            return false;
        }
    }

    public function newEmployee($data, $image_file)
    {
        $query = $this->db->prepare("
        INSERT INTO users (name, email, password, image , login, country_id, gender, mobile) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
        $result = $query->execute([
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
        
        if ($result) {
            $query = $this->db->prepare("
                INSERT INTO employee_details (user_id, address, department_id, designation_id, date_of_birth, joining_date, skills, slack_username)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $query->execute([
                $id,
                $data["address"],
                $data["department_id"][0],
                $data["designation_id"],
                $data["date_of_birth"],
                $data["joining_date"],
                $data["skills"],
                $data["slack_username"]

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
                foreach ($data["department_id"] as $department_id) {
                    $query = $this->db->prepare("
                    INSERT INTO employee_teams (user_id, team_id)
                    VALUES (?, ?)
                    ");
                    $query->execute([
                        $id,
                        $department_id
                    ]);
                }
                return [
                    "status" => true,
                    "message" => "Email already exists or user already exists"
                ];
            }
        } else {
            return [
                "status" => false,
                "message" => "Email already exists or user already exists"
            ];
        }
    }

    public function editEmployee($id, $data, $image)
    {
        $query = $this->db->prepare("
            UPDATE users
            SET name = ?, 
            email = ?, 
            password = ?, 
            image = ?, 
            login = ?, 
            country_id = ?, 
            gender = ?, 
            mobile = ?,
            login = ?
            WHERE id = ?
            ");
        $result = $query->execute([
            $data["name"],
            $data["email"],
            $data["password"],
            $image,
            $data["login"],
            $data['country_id'],
            $data['gender'],
            $data['mobile'],
            $data['login'],
            $id
        ]);
        if ($result) {
            $query = $this->db->prepare("
                UPDATE employee_details
                SET address = ?, 
                department_id = ?, 
                designation_id = ?,
                joining_date = ?, 
                date_of_birth = ?,
                skills = ?,
                slack_username = ?
                
                WHERE user_id = ?
            ");
            $result = $query->execute([
                $data["address"],
                $data["department_id"][0],
                $data["designation_id"],
                $data["joining_date"],
                $data["date_of_birth"],
                $data["skills"],
                $data["slack_username"],

                $id
            ]);
            if ($result) {
                $query = $this->db->prepare("
                DELETE FROM employee_teams
                WHERE user_id = ?
                ");
                $result = $query->execute([$id]);
                if ($result) {
                    foreach ($data["department_id"] as $department_id) {
                        $query = $this->db->prepare("
                        INSERT INTO employee_teams (user_id, team_id)
                        VALUES (?, ?)
                        ");
                        $query->execute([
                            $id,
                            $department_id
                        ]);
                    }
                    return [
                        "status" => true,
                        "message" => "Changed Successfully"
                    ];
                }
            } else {
                return [
                    "status" => false,
                    "message" => "Something went wrong"
                ];
            }
        } else {
            return [
                "status" => false,
                "message" => "Something went wrong"
            ];
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

    public function changeRole($id, $role_id)
    {
        $query = $this->db->prepare("
            UPDATE role_user
            SET role_id = ?
            WHERE user_id = ?
        ");
        $result = $query->execute([$role_id, $id]);
        if ($result) {
            return [
                "status" => true,
                "message" => "Role changed successfully"
            ];
        } else {
            return [
                "status" => false,
                "message" => "Something went wrong"
            ];
        }
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
        FROM project_teams
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
        p.client_id,
        p.status,
        p.completion_percent,
        u.name as client_name,
        u.image,
        pt.team_id,
        t.team_name,
        c.company_name,
        u.name AS name
    FROM projects p
    LEFT JOIN project_teams pt ON p.id = pt.project_id
    LEFT JOIN teams t ON pt.team_id = t.id
    LEFT JOIN client_details c ON p.client_id = c.id
    LEFT JOIN users u ON c.user_id = u.id

    WHERE pt.team_id IN ( SELECT team_id FROM employee_teams WHERE user_id = ? );

        
       
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMembersOfProject($id)
    {
        $query = $this->db->prepare("
        SELECT
            pt.team_id,
            t.team_name,
            u.id AS user_id,
            u.name,
            u.email,
        
            u.image,
            u.status
        FROM project_teams pt
        LEFT JOIN teams t ON pt.team_id = t.id
        INNER JOIN employee_teams et ON t.id = et.team_id
        LEFT JOIN users u ON et.user_id = u.id
        WHERE pt.project_id = ?
        ");
        $query->execute([$id]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMembersOfMyProjects($id, $user_id)
    {
        $query = $this->db->prepare("
        SELECT
            pt.team_id,
            t.team_name,
            u.id AS user_id,
            u.name,
            u.email,
        
            u.image,
            u.status
        FROM project_teams pt
        LEFT JOIN teams t ON pt.team_id = t.id
        INNER JOIN employee_teams et ON t.id = et.team_id
        LEFT JOIN users u ON et.user_id = u.id
        WHERE pt.project_id = ? and u.id IN (SELECT user_id FROM employee_teams WHERE team_id IN (SELECT team_id FROM employee_teams WHERE user_id = ?))
        ");
        $query->execute([$id, $user_id]);

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

    public function getEmployeeTasks($id)
    {
        $query = $this->db->prepare("
        SELECT 
        tu.task_id,
        t.heading,
        t.description,
        t.due_date,
        t.added_by,
        t.board_column_id,
        p.id AS project_id,
        p.project_name,
        u.id AS user_id,
        u.name AS employee_name,
        ut.id AS asigned_id,
        ut.name as asigned_by_name

    FROM task_users tu
    INNER JOIN tasks t ON tu.task_id = t.id
    INNER JOIN users u ON tu.user_id = u.id
    INNER JOIN users ut ON t.added_by = ut.id
    INNER JOIN projects p ON t.project_id = p.id

    WHERE tu.user_id = ?;

        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTaskEmployees($id)
    {
        $query = $this->db->prepare("
        SELECT 
      
        u.id AS user_id,
        u.name AS employee_name,
        u.image AS employee_image,
        ut.id AS asigned_id,
        ut.name as asigned_by_name,
        ut.image as asigned_by_image,
        t.added_by


    FROM task_users tu
    INNER JOIN tasks t ON tu.task_id = t.id
    INNER JOIN users u ON tu.user_id = u.id
    INNER JOIN users ut ON t.added_by = ut.id
    LEFT JOIN projects p ON t.project_id = p.id

    WHERE tu.task_id = ?;

        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

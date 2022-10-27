<?php
require_once("base.model.php");

class Client extends Base
{
    public function getClients()
    {
        $query = $this->db->prepare("
            SELECT
                c.id AS client_id,
                c.user_id,
                u.name,
                u.email,
                u.image,
                u.created_at,
                u.status,
                c.company_name,
                c.address,
                c.postal_code,
                c.state,
                c.city,
                c.office,
                c.website,
                c.note,
                s.category_name,
                b.category_name AS business_category
        
            FROM client_details c
            INNER JOIN users u ON c.user_id = u.id
            LEFT JOIN client_categories s ON c.category_id = s.id
            LEFT JOIN client_sub_categories b ON c.sub_category_id = b.id
     
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClient($id)
    {
        $query = $this->db->prepare("
            SELECT
                c.id AS client_id,
                c.user_id,
                u.name,
                u.email,
                u.mobile,
                u.image,
                u.last_login,
                u.gender,
                c.company_name,
                c.address,
                c.postal_code,
                c.state,
                c.city,

                c.office,
                c.website,
                c.note,
                s.category_name,
                b.category_name AS business_category
        
            FROM client_details c
            INNER JOIN users u ON c.user_id = u.id
            LEFT JOIN client_categories s ON c.category_id = s.id
            LEFT JOIN client_sub_categories b ON c.sub_category_id = b.id
            WHERE c.id = ?
        ");
        $query->execute([$id]);
        $clientinfo = $query->fetch(PDO::FETCH_ASSOC);
        if ($clientinfo) {
            $query = $this->db->prepare("
            SELECT COUNT(id)
            FROM projects
            WHERE client_id = ?
        ");
            $query->execute([$id]);
            $projectclient = $query->fetchColumn();

            $clientinfo['project_count'] = $projectclient;

            return $clientinfo;
        }
    }

    public function newClient($data, $file)
    {
        $query = $this->db->prepare("
            INSERT INTO users (name, email, password, mobile, gender, login, image, country_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $result = $query->execute([
            $data['name'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['mobile'],
            $data['gender'],
            $data['login'],
            $file,
            $data['country_id']
        ]);
        if ($result) {
            $user_id = $this->db->lastInsertId();
            $query = $this->db->prepare("
                INSERT INTO client_details (user_id, company_name, address, postal_code, state, city, office, website, note, category_id, added_by, gst_number)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $result = $query->execute([
                $user_id,
                $data['company_name'],
                $data['address'],
                $data['postal_code'],
                $data['state'],
                $data['city'],
                $data['office'],
                $data['website'],
                $data['note'],
                $data['category_id'],
                $_SESSION['user_id'],
                $data['gst_number']

            ]);
            if ($result) {
                return [
                    'status' => true,
                    'message' => 'Client added successfully',
                    'id' => $this->db->lastInsertId()
                ];
            }
        } else {
            return [
                'status' => false,
                'message' => 'Client already exists'
            ];
        }
    }

    public function newCategory($name)
    {
        $query = $this->db->prepare("
            INSERT INTO client_categories (category_name)
            VALUES (?)
        ");
        $result = $query->execute([$name]);
        if ($result) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function editCategory($id, $name)
    {
        $query = $this->db->prepare("
            UPDATE client_categories
            SET category_name = ?
            WHERE id = ?
        ");
        $result = $query->execute([$name, $id]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCategory($id)
    {
        $query = $this->db->prepare("
            DELETE FROM client_categories
            WHERE id = ?
        ");
        $result = $query->execute([$id]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getCategories()
    {
        $query = $this->db->prepare("
            SELECT id, category_name AS name
            FROM client_categories
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCountries()
    {
        $query = $this->db->prepare("
            SELECT id, name, nicename
            FROM countries
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function importClient($data)
    {
        $stringspassword = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz%!@#$%';
        $entries = 0;
        $sucessfullEntries = 0;
        for ($i = 0; $i < count($data['name']); $i++) {
            try {
                $query = $this->db->prepare("
                INSERT INTO users (name, email, password)
                VALUES (?, ?, ?)
            ");
        
                $password = substr(str_shuffle($stringspassword), 0, 8);
                $result = $query->execute([
                    $data["name"][$i],
                    $data['email'][$i],
                    isset($data['password'][$i]) ? $data['password'][$i] : password_hash($password, PASSWORD_DEFAULT)
                ]);

                if ($result) {
                    $user_id = $this->db->lastInsertId();
                    $query = $this->db->prepare("
                    INSERT INTO client_details (user_id, company_name, address, postal_code, state, city, office, website, note, category_id, added_by)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
                    $result = $query->execute([
                        $user_id,
                        isset($data['company_name'][$i]) ? $data['company_name'][$i] : null,
                        isset($data['address'][$i]) ? $data['address'][$i] : null,
                        isset($data['postal_code'][$i])  ? $data['postal_code'][$i] : null,
                        isset($data['state'][$i]) ? $data['state'][$i] : null,
                        isset($data['city'][$i]) ? $data['city'][$i] : null,
                        isset($data['office'][$i]) ? $data['office'][$i] : null,
                        isset($data['website'][$i]) ? $data['website'][$i] : null,
                        isset($data['note'][$i]) ? $data['note'][$i] : null,
                        1,
                        $_SESSION['user_id']
                    ]);
                    if ($result) {
                        $sucessfullEntries++;
                    }
                } else {
                    $entries++;
                    continue;
                }
            } catch (PDOException $e) {
                continue;
            }
        }

        if ($entries == 0) {
            return [
                'status' => true,
                'message' => 'All entries added successfully'
            ];
        } else {
            return [
                'status' => true,
                'message' => $sucessfullEntries . ' entries added successfully and ' . $entries . ' entries already exists'
            ];
        }
    }
}

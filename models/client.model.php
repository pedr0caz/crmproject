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
                s.category_name
               
        
            FROM client_details c
            INNER JOIN users u ON c.user_id = u.id
            LEFT JOIN client_categories s ON c.category_id = s.id
     
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
                u.login,
                u.status,
                u.country_id,
                u.password,
                u.last_login,
                u.gender,
                c.company_name,
                c.address,
                c.postal_code,
                c.state,
                c.city,
                c.category_id,
                c.gst_number,
                c.shipping_address,

                c.office,
                c.website,
                c.note,
                s.category_name
        
            FROM client_details c
            INNER JOIN users u ON c.user_id = u.id
            LEFT JOIN client_categories s ON c.category_id = s.id
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
            $client_id = $this->db->lastInsertId();
            if ($result) {
                $query = $this->db->prepare("
                INSERT INTO role_user (user_id, role_id)
                VALUES (?, ?)");
                $result = $query->execute([
                    $user_id,
                    3
                ]);
                if ($result) {
                    return [
                        'status' => true,
                        'message' => 'Client added successfully',
                        'id' => $client_id
                    ];
                } else {
                    return [
                        'status' => false,
                        'message' => G_SOMETHING_WENT_WRONG
                    ];
                }
            }
        } else {
            return [
                'status' => false,
                'message' => 'Client already exists'
            ];
        }
    }

    public function editClient($data, $id, $image, $password)
    {
        $query = $this->db->prepare("
            UPDATE users
            SET name = ?,
                email = ?,
                mobile = ?,
                gender = ?,
                login = ?,
                image = ?,
                country_id = ?,
                password = ?
            WHERE id = ?
        ");
        $result = $query->execute([
            $data['name'],
            $data['email'],
            $data['mobile'],
            $data['gender'],
            $data['login'],
            $image,
            $data['country_id'],
            $password,
            $id
        ]);

        if ($result) {
            $query = $this->db->prepare("
                UPDATE client_details
                SET company_name = ?,
                    address = ?,
                    postal_code = ?,
                    state = ?,
                    city = ?,
                    office = ?,
                    website = ?,
                    note = ?,
                    category_id = ?,
                    gst_number = ?
                WHERE user_id = ?
            ");
            $result = $query->execute([
                $data['company_name'],
                $data['address'],
                $data['postal_code'],
                $data['state'],
                $data['city'],
                $data['office'],
                $data['website'],
                $data['note'],
                $data['category_id'],
                $data['gst_number'],
                $id
            ]);
            if ($result) {
                return [
                    'status' => true,
                    'message' => 'Client updated successfully'
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Client update failed'
                ];
            }
        } else {
            return [
                'status' => false,
                'message' => 'Error changing client'
            ];
        }
    }

    public function deleteClient($id)
    {
        $query = $this->db->prepare("
            DELETE FROM client_details
            WHERE user_id = ?
        ");
        $result = $query->execute([$id]);

        if ($result) {
            $query = $this->db->prepare("
                DELETE FROM users
                WHERE id = ?
            ");
            $result = $query->execute([$id]);
            if ($result) {
                return [
                    'status' => true,
                    'message' => 'Client deleted successfully'
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Client delete failed'
                ];
            }
        } else {
            return [
                'status' => false,
                'message' => 'Error deleting client'
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
                        $query = $this->db->prepare("
                        INSERT INTO role_user (user_id, role_id)
                        VALUES (?, ?)
                        ");
                        $result = $query->execute([
                            $user_id,
                            3
                        ]);
                        if ($result) {
                            $sucessfullEntries++;
                        }
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

    public function newClientNote($id, $data, $user_id)
    {
        $query = $this->db->prepare("
            INSERT INTO client_notes (client_id, details, title, type,  added_by)
            VALUES (?, ?, ?, ?, ?)
        ");
        $result = $query->execute([$id, $data['notedetail'], $data['title'], $data['type'], $user_id]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function removeClientNote($id, $user_id)
    {
        $query = $this->db->prepare("
            DELETE FROM client_notes
            WHERE id = ? AND added_by = ?
        ");
        $result = $query->execute([$id, $user_id]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getClientNotes($id, $user_id)
    {
        $query = $this->db->prepare("
            SELECT id, details, title, type, added_by
            FROM client_notes
            WHERE (client_id = ? AND type = 0 ) OR (client_id = ? AND type = 1 AND added_by = ?)
        ");
        $query->execute([$id, $id, $user_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClientNoteById($id, $user_id, $client_id)
    {
        $query = $this->db->prepare("
            SELECT id, details, title, type, added_by
            FROM client_notes
            WHERE (id = ? AND type = 0 AND client_id = ? ) OR (id = ? AND type = 1 AND added_by = ? AND client_id = ?)
        ");
        $query->execute([$id, $client_id, $id, $user_id, $client_id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getFiles($id)
    {
        $query = $this->db->prepare("
        SELECT name, id, filename, created_at FROM client_docs WHERE user_id = ?
        ");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function newFile($id, $name, $file)
    {
        $query = $this->db->prepare("
        INSERT INTO client_docs (user_id, name, filename, created_at)
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
                json_encode([
                    "en" => "New file added",
                    "pt" => "Novo ficheiro adicionado"
                ]),
                date("Y-m-d H:i:s")
            ]);

            $query = $this->db->prepare("
             SELECT name, id, filename, created_at FROM client_docs WHERE id = ?
            ");
            $query->execute([$idfile]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function deleteFile($id, $user_id)
    {
        $query = $this->db->prepare("
        DELETE FROM client_docs WHERE id = ? AND user_id = ?
        ");
        $query->execute([$id, $user_id]);
        if ($query->rowCount()) {
            $query = $this->db->prepare("
            INSERT INTO user_activities (user_id, activity, created_at)
            VALUES (?, ?, ?)
            ");
            $query->execute([
                $user_id,
                json_encode([
                    "en" => "File deleted by ".$_SESSION['user_name'],
                    "pt" => "Ficheiro eliminado por ".$_SESSION['user_name']
                ]),
                date("Y-m-d H:i:s")
            ]);
            return true;
        }
    }
}

<?php
require_once("base.model.php");

class Client extends Base
{
    public function getClients()
    {
        $query = $this->db->prepare("
            SELECT
                c.id AS client_id,
                u.name,
                u.email,
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
                u.name,
                u.email,
                u.mobile,
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

    public function newClient($data)
    {
        $query = $this->db->prepare("
            INSERT INTO client_details (client_id, company_name, address, postal_code, state, city, office, website, note, category_id, sub_category_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $query->execute([
            $data["client_id"],
            $data["company_name"],
            $data["address"],
            $data["postal_code"],
            $data["state"],
            $data["city"],
            $data["office"],
            $data["website"],
            $data["note"],
            $data["category_id"],
            $data["sub_category_id"]
        ]);
        return $this->db->lastInsertId();
    }
}

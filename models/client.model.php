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
                b.category_name AS business_category,
        
            FROM client_details c
            INNER JOIN users u ON c.client_id = u.id
            INNER JOIN client_category s ON c.category_id = s.id
            INNER JOIN client_sub_category b ON c.sub_category_id = b.id
     
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
                c.company_name,
                c.address,
                c.postal_code,
                c.state,
                c.city,
                c.office,
                c.website,
                c.note,
                s.category_name,
                b.category_name AS business_category,
        
            FROM client_details c
            INNER JOIN users u ON c.client_id = u.id
            INNER JOIN client_category s ON c.category_id = s.id
            INNER JOIN client_sub_category b ON c.sub_category_id = b.id
            WHERE c.id = ?
        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
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

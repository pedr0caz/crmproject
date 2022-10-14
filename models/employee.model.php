<?php
require_once("base.model.php");

class Employee extends Base
{
    public function getEmployees()
    {
        $query = $this->db->prepare("
            SELECT
                id,
                name,
                email,
                phone,
                address,
                city,
                state,
                zip,
                country,
                role
            FROM users
            WHERE role = 'employee'
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

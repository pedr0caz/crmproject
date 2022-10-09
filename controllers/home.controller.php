<?php
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $query = $this->db->prepare("
        SELECT name, email, street, postal_code, city, country
        FROM users
        WHERE user_id = ?
    ");
    $query->execute([$user_id]);
    $user = $query->fetch(PDO::FETCH_ASSOC);
    if (!empty($user)) {
        return $user;
    }
} else {
    header("Location: " . ROOT . "/login");
    exit;
}

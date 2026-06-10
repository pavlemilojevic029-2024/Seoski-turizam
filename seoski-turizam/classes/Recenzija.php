<?php
require_once __DIR__ . '/../config/database.php';

class Recenzija {
    private $conn;
    private $table = "recenzije";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($soba_id, $user_id, $gost_ime, $ocena, $komentar) {
        $query = "INSERT INTO " . $this->table . " 
                 (soba_id, user_id, gost_ime, ocena, komentar) 
                 VALUES (:soba_id, :user_id, :gost_ime, :ocena, :komentar)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':soba_id', $soba_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':gost_ime', $gost_ime);
        $stmt->bindParam(':ocena', $ocena);
        $stmt->bindParam(':komentar', $komentar);

        return $stmt->execute();
    }

    public function getAllByUser($user_id) {
        $query = "SELECT r.*, s.naziv as soba_naziv 
                  FROM " . $this->table . " r 
                  JOIN sobe s ON r.soba_id = s.id 
                  WHERE r.user_id = :user_id 
                  ORDER BY r.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
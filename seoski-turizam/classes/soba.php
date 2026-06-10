<?php
require_once __DIR__ . '/../config/database.php';

class Soba {
    private $conn;
    private $table = "sobe";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    
    public function getAllByUser($user_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function create($user_id, $naziv, $tip_sobe, $broj_kreveta, $cena_po_noci, $opis) {
        $query = "INSERT INTO " . $this->table . " 
                 (user_id, naziv, tip_sobe, broj_kreveta, cena_po_noci, opis) 
                 VALUES (:user_id, :naziv, :tip_sobe, :broj_kreveta, :cena_po_noci, :opis)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':naziv', $naziv);
        $stmt->bindParam(':tip_sobe', $tip_sobe);
        $stmt->bindParam(':broj_kreveta', $broj_kreveta);
        $stmt->bindParam(':cena_po_noci', $cena_po_noci);
        $stmt->bindParam(':opis', $opis);

        return $stmt->execute();
    }
    
    public function getById($id, $user_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id AND user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public function update($id, $user_id, $naziv, $tip_sobe, $broj_kreveta, $cena_po_noci, $opis) {
        $query = "UPDATE " . $this->table . " SET 
                    naziv = :naziv,
                    tip_sobe = :tip_sobe,
                    broj_kreveta = :broj_kreveta,
                    cena_po_noci = :cena_po_noci,
                    opis = :opis 
                  WHERE id = :id AND user_id = :user_id";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':naziv', $naziv);
        $stmt->bindParam(':tip_sobe', $tip_sobe);
        $stmt->bindParam(':broj_kreveta', $broj_kreveta);
        $stmt->bindParam(':cena_po_noci', $cena_po_noci);
        $stmt->bindParam(':opis', $opis);

        return $stmt->execute();
    }

    
    public function delete($id, $user_id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id AND user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }
}
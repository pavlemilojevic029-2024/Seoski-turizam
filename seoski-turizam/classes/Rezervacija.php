<?php
require_once __DIR__ . '/../config/database.php';

class Rezervacija {
    private $conn;
    private $table = "rezervacije";

    public function __construct() {
    $database = new Database();
    $this->conn = $database->getConnection();
}

    public function create($soba_id, $user_id, $gost_ime, $gost_prezime, $gost_email, $gost_telefon, $datum_dolaska, $datum_odlaska, $broj_osoba) {
        

        $query = "INSERT INTO " . $this->table . " 
                 (soba_id, user_id, gost_ime, gost_prezime, gost_email, gost_telefon, 
                  datum_dolaska, datum_odlaska, broj_osoba, ukupna_cena) 
                 VALUES (:soba_id, :user_id, :gost_ime, :gost_prezime, :gost_email, :gost_telefon, 
                         :datum_dolaska, :datum_odlaska, :broj_osoba, :ukupna_cena)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':soba_id', $soba_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':gost_ime', $gost_ime);
        $stmt->bindParam(':gost_prezime', $gost_prezime);
        $stmt->bindParam(':gost_email', $gost_email);
        $stmt->bindParam(':gost_telefon', $gost_telefon);
        $stmt->bindParam(':datum_dolaska', $datum_dolaska);
        $stmt->bindParam(':datum_odlaska', $datum_odlaska);
        $stmt->bindParam(':broj_osoba', $broj_osoba);
        $stmt->bindParam(':ukupna_cena', $ukupna_cena);

        return $stmt->execute();
    }

    public function getAllByUser($user_id) {
        $query = "SELECT r.*, s.naziv as soba_naziv 
                  FROM " . $this->table . " r 
                  JOIN sobe s ON r.soba_id = s.id 
                  WHERE r.user_id = :user_id 
                  ORDER BY r.datum_dolaska DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
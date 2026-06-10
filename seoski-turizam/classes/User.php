<?php
require_once __DIR__ . '/../config/database.php';

class User {
    private $conn;
    private $table = "users";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    
    public function register($username, $email, $password, $ime, $prezime, $selo, $telefon) {
        $query = "INSERT INTO " . $this->table . " 
                 (username, email, password, ime, prezime, selo, telefon) 
                 VALUES (:username, :email, :password, :ime, :prezime, :selo, :telefon)";
        
        $stmt = $this->conn->prepare($query);
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':ime', $ime);
        $stmt->bindParam(':prezime', $prezime);
        $stmt->bindParam(':selo', $selo);
        $stmt->bindParam(':telefon', $telefon);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    
    public function login($username, $password) {
        $query = "SELECT id, username, password, ime, prezime FROM " . $this->table . " 
                  WHERE username = :username OR email = :username";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
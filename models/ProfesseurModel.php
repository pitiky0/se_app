<?php

class ProfesseurModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($name, $email, $password) {
        $query = "INSERT INTO professeur (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(":password", $hashed_password);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password) {
        $query = "SELECT * FROM professeur WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            return true;
        } else {
            return false;
        }
    }
}

$servername = "localhost";
$username = 'root';
$password = '';
$database = 'se_app_database';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$professeur = new ProfesseurModel($conn);

// Example usage:
$professeur->create("John Doe", "john.doe@example.com", "password123");
$professeur->login("john.doe@example.com", "password123");

?>

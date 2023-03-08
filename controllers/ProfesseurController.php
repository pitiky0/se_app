<?php

require_once 'models/ProfesseurModel.php';

class ProfesseurController {
    private $professeurModel;
    
    public function __construct($db) {
        $this->professeurModel = new ProfesseurModel($db);
    }

    public function createProfesseur($name, $email, $password) {
        $result = $this->professeurModel->create($name, $email, $password);
        if ($result) {
            return "Professeur created successfully.";
        } else {
            return "Error creating professeur.";
        }
    }

    public function loginProfesseur($email, $password) {
        $result = $this->professeurModel->login($email, $password);
        if ($result) {
            return "Professeur logged in successfully.";
        } else {
            return "Error logging in.";
        }
    }
}





///////////////////////
//Examples

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

$professeurController = new ProfesseurController($conn);
// Example usage:
echo $professeurController->createProfesseur("John Doe", "john.doe@example.com", "password123");
echo $professeurController->loginProfesseur("john.doe@example.com", "password123");


?>

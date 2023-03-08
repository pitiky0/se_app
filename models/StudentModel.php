<?php

class StudentModel {
  private $conn;
  private $table_name;
  public $id;
  public $name;
  public $email;
  public $card_id;
  public $filliere;
  
  // Define the database table name
  public function __construct($conn, $table_name) {
    $this->conn = $conn;
    $this->table_name = $table_name;
  }

  // Method to read all student records
  public function read_all() {
    $query = "SELECT * FROM $this->table_name";
    $result = $this->conn->query($query);
    return $result;
  }

  // Method to read a single student record by ID
  public function read_one() {
    $query = "SELECT * FROM $this->table_name WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $this->id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $this->name = $row['name'];
    $this->email = $row['email'];
    $this->card_id = $row['card_id'];
    $this->filliere = $row['filliere'];
  }

  // Method to create a new student record
  public function create() {
    $query = "INSERT INTO $this->table_name (name, email, card_id, filliere) VALUES (?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssss", $this->name, $this->email, $this->card_id, $this->filliere);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Method to update an existing student record
  public function update() {
    $query = "UPDATE $this->table_name SET name=?, email=?, card_id=?, filliere=? WHERE id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssssi", $this->name, $this->email, $this->card_id, $this->filliere, $this->id);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Method to delete an existing student record
  public function delete() {
    $query = "DELETE FROM $this->table_name WHERE id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $this->id);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
}

// Define the database connection variables
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'se_app_database';

// Create a new mysqli connection
$conn = new mysqli($host, $user, $password, $database);

// Define the database table name
$table_name = 'students';

// Create a new instance of the StudentModel class
$student_model = new StudentModel($conn, $table_name);

?>
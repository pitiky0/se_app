<?php
// Define the database table name
$table_name = 'users';

// Define the database columns
$columns = array(
    'id' => 'INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
    'name' => 'VARCHAR(255) NOT NULL',
    'email' => 'VARCHAR(255) NOT NULL',
    'password' => 'VARCHAR(255) NOT NULL',
    'created_at' => 'DATETIME DEFAULT CURRENT_TIMESTAMP',
    'updated_at' => 'DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
);

// Define the database model class
class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function get_users() {
        $query = 'SELECT * FROM ' . $table_name;
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_user($id) {
        $query = 'SELECT * FROM ' . $table_name . ' WHERE id = ' . $id;
        $result = $this->db->query($query);
        return $result->fetch_assoc();
    }

    public function create_user($name, $email, $password) {
        $query = 'INSERT INTO ' . $table_name . ' (name, email, password) VALUES (?, ?, ?)';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $name, $email, $password);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function update_user($id, $name, $email, $password) {
        $query = '';
    }
}
?>

<?php

class User {
  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function get_users() {
    $sql = "SELECT * FROM users";
    $result = $this->conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function get_user_by_id($id) {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }

  public function create_user($name, $email, $password) {
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $password);
    $stmt->execute();
    return $stmt->insert_id;
  }

  public function update_user($id, $name, $email, $password) {
    $sql = "UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $password, $id);
    $stmt->execute();
    return $stmt->affected_rows;
  }

  public function delete_user($id) {
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->affected_rows;
  }
}


?>
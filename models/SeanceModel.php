<?php

class Seance {
    private $conn;
    private $table_name = "Seance";

    public $id;
    public $module_id;
    public $date;
    public $numero;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create(){
        $query = "INSERT INTO " . $this->table_name . " SET module_id=:module_id, date=:date, numero=:numero";
        $stmt = $this->conn->prepare($query);

        $this->module_id=htmlspecialchars(strip_tags($this->module_id));
        $this->date=htmlspecialchars(strip_tags($this->date));
        $this->numero=htmlspecialchars(strip_tags($this->numero));

        $stmt->bindParam(":module_id", $this->module_id);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":numero", $this->numero);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function readOne(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->module_id = $row['module_id'];
        $this->date = $row['date'];
        $this->numero = $row['numero'];
    }

    function update(){
        $query = "UPDATE " . $this->table_name . " SET module_id=:module_id, date=:date, numero=:numero WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->module_id=htmlspecialchars(strip_tags($this->module_id));
        $this->date=htmlspecialchars(strip_tags($this->date));
        $this->numero=htmlspecialchars(strip_tags($this->numero));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":module_id", $this->module_id);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":numero", $this->numero);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}

?>
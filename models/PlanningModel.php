<?php

class Planning {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addPlanning($seance_id, $start_date, $end_date) {
        $query = "INSERT INTO Planning (seance_id, start_date, end_date) VALUES (:seance_id, :start_date, :end_date)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":seance_id", $seance_id);
        $stmt->bindParam(":start_date", $start_date);
        $stmt->bindParam(":end_date", $end_date);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPlanningById($id) {
        $query = "SELECT * FROM Planning WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePlanning($id, $seance_id, $start_date, $end_date) {
        $query = "UPDATE Planning SET seance_id = :seance_id, start_date = :start_date, end_date = :end_date WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":seance_id", $seance_id);
        $stmt->bindParam(":start_date", $start_date);
        $stmt->bindParam(":end_date", $end_date);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePlanning($id) {
        $query = "DELETE FROM Planning WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllPlanning() {
        $query = "SELECT * FROM Planning";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
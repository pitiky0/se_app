<?php

class Attendance {
  // database connection and table name
  private $conn;
  private $table_name = "Attendance";

  // object properties
  public $id;
  public $etudiant_id;
  public $seance_id;
  public $date;
  public $status;

  // constructor with $db as database connection
  public function __construct($db) {
    $this->conn = $db;
  }

  public function addAttendance($etudiant_id, $seance_id, $date, $status) {
    $stmt = $this->db->prepare("INSERT INTO Attendance (etudiant_id, seance_id, date, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $etudiant_id, $seance_id, $date, $status);
    $stmt->execute();
    return $stmt->insert_id;
  }
 
  // update the attendance status for a given attendance ID
  public function updateAttendance($attendance_id, $status) {
      $stmt = $this->conn->prepare("UPDATE $this->table_name SET status=? WHERE id=?");
      $stmt->bind_param("si", $status, $attendance_id);
      $stmt->execute();
      return $stmt->affected_rows;
  }

  // mark the attendance as present
  public function markPresent() {
      return $this->updateAttendance($this->id, 'present');
  }

  // mark the attendance as absent
  public function markAbsent() {
      return $this->updateAttendance($this->id, 'absent');
  }

  // get a map of attendance status for all students in a given session
  public function getAttendance() {
      $query = "SELECT Etudiant.name, Attendance.status FROM $this->table_name JOIN Etudiant ON Attendance.etudiant_id = Etudiant.id WHERE seance_id=?";
      $stmt = $this->conn->prepare($query);
      $stmt->bind_param("i", $this->seance_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $attendance_map = array();
      while ($row = $result->fetch_assoc()) {
          $attendance_map[$row['name']] = $row['status'];
      }
      return $attendance_map;
  }

  public function getAttendanceBySeance($seance_id) {
    $stmt = $this->db->prepare("SELECT * FROM Attendance WHERE seance_id=?");
    $stmt->bind_param("i", $seance_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getAttendanceByEtudiant($etudiant_id) {
    $stmt = $this->db->prepare("SELECT * FROM Attendance WHERE etudiant_id=?");
    $stmt->bind_param("i", $etudiant_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function deleteAttendance($attendance_id) {
    $stmt = $this->db->prepare("DELETE FROM Attendance WHERE id=?");
    $stmt->bind_param("i", $attendance_id);
    $stmt->execute();
    return $stmt->affected_rows;
  }

  // Get the attendance status of all students for a given seance and date
  public function getAttendance2() {
    $query = "SELECT etudiant_id, status FROM " . $this->table_name . " WHERE seance_id=:seance_id AND date=:date";
    $stmt = $this->conn->prepare($query);

    $this->seance_id=htmlspecialchars(strip_tags($this->seance_id));
    $this->date=htmlspecialchars(strip_tags($this->date));

    $stmt->bindParam(":seance_id", $this->seance_id);
    $stmt->bindParam(":date", $this->date);

    if($stmt->execute()) {
        $attendance_map = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $attendance_map[$row['etudiant_id']] = $row['status'];
        }
        return $attendance_map;
    }
    return null;
  }
}

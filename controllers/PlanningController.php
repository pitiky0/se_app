<?php
class PlanningController {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function addPlanning($seance_id, $start_date, $end_date) {
        $planning = new Planning($this->db);
        return $planning->addPlanning($seance_id, $start_date, $end_date);
    }

    public function getPlanningById($id) {
        $planning = new Planning($this->db);
        return $planning->getPlanningById($id);
    }

    public function updatePlanning($id, $seance_id, $start_date, $end_date) {
        $planning = new Planning($this->db);
        return $planning->updatePlanning($id, $seance_id, $start_date, $end_date);
    }

    public function deletePlanning($id) {
        $planning = new Planning($this->db);
        return $planning->deletePlanning($id);
    }

    public function getAllPlanning() {
        $planning = new Planning($this->db);
        return $planning->getAllPlanning();
    }
}



///////////////////////////////////

//Examples

$db = new PDO('mysql:host=localhost;dbname=mydb;charset=utf8', 'username', 'password');
$planningController = new PlanningController($db);


// Add a new planning record
$planningController->addPlanning(1, '2023-03-08 09:00:00', '2023-03-08 10:00:00');

// Retrieve a planning record by ID
$planning = $planningController->getPlanningById(1);

// Update a planning record
$planningController->updatePlanning(1, 2, '2023-03-08 10:00:00', '2023-03-08 11:00:00');

// Delete a planning record
$planningController->deletePlanning(1);

// Retrieve all planning records
$planningRecords = $planningController->getAllPlanning();

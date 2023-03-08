<?php
require_once 'Seance.php';

class SeanceController {
    private $seance;

    public function __construct($db){
        $this->seance = new Seance($db);
    }

    public function getAllSeances(){
        return $this->seance->read()->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createSeance($module_id, $date, $numero){
        $this->seance->module_id = $module_id;
        $this->seance->date = $date;
        $this->seance->numero = $numero;

        if($this->seance->create()){
            return array('message' => 'Seance created successfully');
        }
        return array('message' => 'Unable to create seance');
    }

    public function getSeanceById($id){
        $this->seance->id = $id;
        $this->seance->readOne();

        return array(
            'id' => $this->seance->id,
            'module_id' => $this->seance->module_id,
            'date' => $this->seance->date,
            'numero' => $this->seance->numero
        );
    }

    public function updateSeance($id, $module_id, $date, $numero){
        $this->seance->id = $id;
        $this->seance->module_id = $module_id;
        $this->seance->date = $date;
        $this->seance->numero = $numero;

        if($this->seance->update()){
            return array('message' => 'Seance updated successfully');
        }
        return array('message' => 'Unable to update seance');
    }

    public function deleteSeance($id){
        $this->seance->id = $id;

        if($this->seance->delete()){
            return array('message' => 'Seance deleted successfully');
        }
        return array('message' => 'Unable to delete seance');
    }
}
?>

<?php
class ModuleController {
  private $db;
  private $module;

  public function __construct($db) {
    $this->db = $db;
    $this->module = new Module($db);
  }

  public function createModule($name, $description, $professor_id) {
    $this->module->name = $name;
    $this->module->description = $description;
    $this->module->professor_id = $professor_id;

    if ($this->module->create()) {
      return true;
    } else {
      return false;
    }
  }

  public function readModules() {
    $result = $this->module->read();

    return $result;
  }

  public function readModuleById($id) {
    $this->module->id = $id;
    $this->module->read_one();
    $module = array(
      "id" => $this->module->id,
      "name" => $this->module->name,
      "description" => $this->module->description,
      "professor_id" => $this->module->professor_id
    );

    return $module;
  }

  public function updateModule($id, $name, $description, $professor_id) {
    $this->module->id = $id;
    $this->module->name = $name;
    $this->module->description = $description;
    $this->module->professor_id = $professor_id;

    if ($this->module->update()) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteModule($id) {
    $this->module->id = $id;

    if ($this->module->delete()) {
      return true;
    } else {
      return false;
    }
  }
}

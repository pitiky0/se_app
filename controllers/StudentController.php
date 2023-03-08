<?php
class StudentController {
  private $db;
  private $student_model;

  public function __construct($db) {
    $this->db = $db;
    $this->student_model = new StudentModel($db);
  }

  public function create_student($name, $email, $card_id, $filliere) {
    $this->student_model->name = $name;
    $this->student_model->email = $email;
    $this->student_model->card_id = $card_id;
    $this->student_model->filliere = $filliere;

    if ($this->student_model->create()) {
      return true;
    } else {
      return false;
    }
  }

  public function get_student($id) {
    $this->student_model->id = $id;
    if ($student = $this->student_model->read_one()) {
      return $student;
    } else {
      return false;
    }
  }

  public function update_student($id, $name, $email, $card_id, $filliere) {
    $this->student_model->id = $id;
    $this->student_model->name = $name;
    $this->student_model->email = $email;
    $this->student_model->card_id = $card_id;
    $this->student_model->filliere = $filliere;

    if ($this->student_model->update()) {
      return true;
    } else {
      return false;
    }
  }

  public function delete_student($id) {
    $this->student_model->id = $id;

    if ($this->student_model->delete()) {
      return true;
    } else {
      return false;
    }
  }

  public function get_all_students() {
    $students = $this->student_model->read();
    return $students;
  }
}

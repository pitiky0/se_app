<?php
class AttendanceController {
  private $db;
  private $attendance;

  public function __construct($db) {
    $this->db = $db;
    $this->attendance = new Attendance($db);
  }

  public function updateAttendance($attendance_id, $status) {
    $updated = $this->attendance->updateAttendance($attendance_id, $status);
    if ($updated) {
      http_response_code(200);
      echo json_encode(array("message" => "Attendance status updated."));
    } else {
      http_response_code(503);
      echo json_encode(array("message" => "Unable to update attendance status."));
    }
  }

  public function markPresent($attendance_id) {
    $updated = $this->attendance->markPresent($attendance_id);
    if ($updated) {
      http_response_code(200);
      echo json_encode(array("message" => "Attendance status updated to 'present'."));
    } else {
      http_response_code(503);
      echo json_encode(array("message" => "Unable to update attendance status."));
    }
  }

  public function markAbsent($attendance_id) {
    $updated = $this->attendance->markAbsent($attendance_id);
    if ($updated) {
      http_response_code(200);
      echo json_encode(array("message" => "Attendance status updated to 'absent'."));
    } else {
      http_response_code(503);
      echo json_encode(array("message" => "Unable to update attendance status."));
    }
  }

  public function getAttendance($seance_id) {
    $attendance_map = $this->attendance->getAttendance($seance_id);
    if ($attendance_map) {
      http_response_code(200);
      echo json_encode(array("attendance" => $attendance_map));
    } else {
      http_response_code(404);
      echo json_encode(array("message" => "No attendance records found."));
    }
  }
}

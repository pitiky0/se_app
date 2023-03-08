<?php
require_once('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Handle form submission
  if (isset($_POST['add_student'])) {
    // Add a new student to the database
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $sql = "INSERT INTO students (name, email, phone) VALUES ('$name', '$email', '$phone')";
    mysqli_query($conn, $sql);
    header('Location: student.php');
    exit();
  } elseif (isset($_POST['edit_student'])) {
    // Edit an existing student in the database
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $sql = "UPDATE students SET name='$name', email='$email', phone='$phone' WHERE id='$id'";
    mysqli_query($conn, $sql);
    header('Location: student.php');
    exit();
  } elseif (isset($_POST['remove_student'])) {
    // Remove a student from the database
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $sql = "DELETE FROM students WHERE id='$id'";
    mysqli_query($conn, $sql);
    header('Location: student.php');
    exit();
  }
}

// Fetch all students from the database
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Management</title>
</head>
<body>

  <h1>Student Management</h1>

  <h2>Add Student</h2>
  <form method="POST">
    <label>Name:</label>
    <input type="text" name="name">
    <br>
    <label>Email:</label>
    <input type="email" name="email">
    <br>
    <label>Phone:</label>
    <input type="text" name="phone">
    <br>
    <button type="submit" name="add_student">Add</button>
  </form>

  <h2>Edit Student</h2>
  <form method="POST">
    <label>ID:</label>
    <input type="text" name="id">
    <br>
    <label>Name:</label>
    <input type="text" name="name">
    <br>
    <label>Email:</label>
    <input type="email" name="email">
    <br>
    <label>Phone:</label>
    <input type="text" name="phone">
    <br>
    <button type="submit" name="edit_student">Save</button>
  </form>

  <h2>Remove Student</h2>
  <form method="POST">
    <label>ID:</label>
    <input type="text" name="id">
    <br>
    <button type="submit" name="remove_student">Remove</button>
  </form>

  <h2>All Students</h2>
  <table>
    <thead>
      <tr>
      <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
  </tr>
</thead>
<tbody>
  <?php foreach ($students as $student): ?>
    <tr>
      <td><?= $student['id'] ?></td>
      <td><?= $student['name'] ?></td>
      <td><?= $student['email'] ?></td>
      <td><?= $student['phone'] ?></td>
    </tr>
  <?php endforeach; ?>
</tbody>
</table>
</body>
</html>
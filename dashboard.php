<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style>
		.sidebar {
			height: 100%;
			width: 200px;
			position: fixed;
			top: 0;
			left: 0;
			background-color: #f5f5f5;
			overflow-x: hidden;
			padding-top: 20px;
		}

		.sidebar a {
			display: block;
			color: #000;
			padding: 16px;
			text-decoration: none;
		}

		.sidebar a.active {
			background-color: #4CAF50;
			color: white;
		}

		.content {
			margin-left: 200px;
			padding: 20px;
			background-color: #fff;
			height: 1000px;
		}
	</style>
</head>
<body>

<div class="sidebar">
	<a href="#" class="active">Dashboard</a>
	<a href="/app/student.php">Students</a>
	<a href="#">Teachers</a>
	<a href="#">Courses</a>
</div>

<div class="content">
	<h1>Welcome to the Dashboard</h1>
	<p>Here you can see an overview of your system and access various features.</p>
	<div class="row">
		<div class="col-sm-4">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Total Students</h5>
					<?php
						// Connect to the database
						$conn = mysqli_connect("localhost", "username", "password", "dbname");

						// Check connection
						if (!$conn) {
						    die("Connection failed: " . mysqli_connect_error());
						}

						// Get the total number of students
						$sql = "SELECT COUNT(*) AS total_students FROM students";
						$result = mysqli_query($conn, $sql);

						if (mysqli_num_rows($result) > 0) {
						    while($row = mysqli_fetch_assoc($result)) {
						        echo "<p class='card-text'>" . $row["total_students"] . "</p>";
						    }
						} else {
						    echo "0";
						}

						// Close the database connection
						mysqli_close($conn);
					?>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Total Teachers</h5>
					<?php
						// Connect to the database
						$conn = mysqli_connect("localhost", "username", "password", "dbname");

						// Check connection
						if (!$conn) {
						    die("Connection failed: " . mysqli_connect_error());
						}

						// Get the total number of teachers
						$sql = "SELECT COUNT(*) AS total_teachers FROM teachers";
						$result = mysqli_query($conn, $sql);

						if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_assoc($result)) {
								echo "<p class='card-text'>" . $row["total_teachers"] . "</p>";
							}
						} else {
								echo "0";
								}
						// Close the database connection
						mysqli_close($conn);
					?>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Total Courses</h5>
					<?php
						// Connect to the database
						$conn = mysqli_connect("localhost", "username", "password", "dbname");

						// Check connection
						if (!$conn) {
							die("Connection failed: " . mysqli_connect_error());
						}

						// Get the total number of courses
						$sql = "SELECT COUNT(*) AS total_courses FROM courses";
						$result = mysqli_query($conn, $sql);

						if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_assoc($result)) {
								echo "<p class='card-text'>" . $row["total_courses"] . "</p>";
							}
						} else {
							echo "0";
						}

						// Close the database connection
						mysqli_close($conn);
					?>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
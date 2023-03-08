<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "se_app_database";

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<?php

// Database connection settings
define('DB_HOST', 'localhost');
define('DB_NAME', 'se_app_database');
define('DB_USER', 'username');
define('DB_PASSWORD', 'password');

// Function to establish database connection
function db_connect() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

<?php
// Include the db_connection.php file
include 'db_connection.php';

// Write a query to fetch data from the database
$sql = "SELECT * FROM mytable";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Loop through the rows and display the data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Name: " . $row["name"] . " - Email: " . $row["email"] . "<br>";
    }
} else {
    echo "No results found";
}

// Close the database connection
mysqli_close($conn);
?>

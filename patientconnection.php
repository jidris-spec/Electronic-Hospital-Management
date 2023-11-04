<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "hospital";

// Create a connection
$connection = mysqli_connect($hostname, $username, $password, $database);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
// Create the "patient" table if it does not exist
$sql = "CREATE TABLE IF NOT EXISTS patient (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    problem VARCHAR(50) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    contact VARCHAR(50) NOT NULL,
    nationality VARCHAR(50) NOT NULL,

    date_of_visit VARCHAR(10) NOT NULL
)";


if (!mysqli_query($connection, $sql)) {
    echo "Error creating table: " . mysqli_error($connection);
}

?>
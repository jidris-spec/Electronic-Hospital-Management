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
// Create the "hospital" table if it does not exist
$tableName = "hospital";
$sql = "CREATE TABLE IF NOT EXISTS $tableName (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    profession VARCHAR(50) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    email VARCHAR(50) NOT NULL,
    nationality VARCHAR(50) NOT NULL,

    cnp VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL
)";
if (!mysqli_query($connection, $sql)) {
    echo "Error creating table: " . mysqli_error($connection);
}

?>
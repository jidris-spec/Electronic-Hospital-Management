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

?>

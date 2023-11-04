<?php
session_start();

if (!($_SESSION['username'])) {
    // Redirect to the home page or any other authenticated page
    header("Location: login.php");
    exit();
}

// Assuming you have a database connection established
include 'patientconnection.php';

// Check if the record ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Retrieve the record from the "hospital" table
    $sql = "SELECT * FROM patient WHERE id = $id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

    // Check if the record exists
    if (!$row) {
        // Redirect to the page where you list all records or display an error message
        header("Location: staffdashboard.php");
        exit();
    }
}

// Delete the record if the user confirms
if (isset($_POST['confirm'])) {
    $deleteSql = "DELETE FROM patient WHERE id = $id";

    if (mysqli_query($connection, $deleteSql)) {
        // Record deleted successfully
        header("Location: staffdashboard.php");
        exit();
    } else {
        // Error deleting record
        echo "Error deleting record: " . mysqli_error($connection);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Delete Record</h2>
        <p>Are you sure you want to delete this record?</p>
        <p>First Name: <?php echo $row['first_name']; ?></p>
        <p>Last Name: <?php echo $row['last_name']; ?></p>

        <form method="POST" action="">
            <button type="submit" name="confirm" class="btn btn-danger">Delete</button>
            <a href="patientdashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

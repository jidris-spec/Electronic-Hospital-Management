<?php
session_start();

if (!($_SESSION['username'])) {
    // Redirect to the home page or any other authenticated page
    header("Location: login.php");
    exit();
}

// Assuming you have a database connection established
include 'patientconnection.php';

// Check if the record ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the record from the "hospital" table based on the provided ID
    $sql = "SELECT * FROM patient WHERE id = $id";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // You can access the record fields as $row['field_name']
    } else {
        // Redirect to the page where you list all records or display an error message
        header("Location: staffdashboard.php");
        exit();
    }
} else {
    // Redirect to the page where you list all records or display an error message
    header("Location: staffdashboard.php");
    exit();
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Retrieve form data
    $id = $_POST["id"];
    $date = $_POST["date_of_visit"];

    // Update the record in the "patient" table
    $sql = "UPDATE patient SET date_of_visit = '$date' WHERE id = $id";

    if (mysqli_query($connection, $sql)) {
        // Record updated successfully
        header("Location: staffdashboard.php");
        exit();
    } else {
        // Error updating record
        echo "Error updating record: " . mysqli_error($connection);
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Menu Bootstrap 5 -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="admindashboard.php">Hospital Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="admindashboard.php">Dashboard</a>
                </li>   
                <li class="nav-item">
                    <a class="nav-link" href="addstaff.php">Add Staff</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End of navigation menu bootstrap 5 -->

    <!-- Bootstrap 5 Css class that gives container spacing -->
    <div class="container mt-5">
        <h2>Edit Record</h2>
        <form action="" method="post">
            <div class="div">
                <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            </div>
            <div class="mb-3">
                <b><label for="FirstName" class="form-label">First Name</label></b>
                <label class="form-label"><?php echo $row['first_name']; ?></label>
            </div>
            <div class="mb-3">
                <b><label for="lastName" class="form-label">Last Name</label></b>
                <label class="form-label"><?php echo $row['last_name']; ?></label>
            </div>
            <div class="mb-3">
                <b><label for="problem" class="form-label">Problem</label></b>
               <label class="form-label"><?php echo $row['problem']; ?></label>
            </div>
            
            <div class="mb-3">
                <b><label for="Gender" class="form-label">Gender</label></b>
                <label class="form-label"><?php echo $row['gender']; ?></label>
            </div>
            <div class="mb-3">
                <b><label for="contact" class="form-label">Phone number</label></b>
                <label class="form-label"><?php echo $row['contact']; ?></label>
            </div>
            <div class="mb-3">
                <b><label for="datePicker" class="form-label">Date of Visit</label></b>
                <input type="text" data-date-format="dd-mm-yyyy" data-provide="datepicker" name="date_of_visit" class="form-control datepicker" id="datePicker" value="<?php echo $row['date_of_visit']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="staffdashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
      <script>
        $(document).ready(function() {
            $('#datePicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true
            });
        });
    </script>
</body>
</html>

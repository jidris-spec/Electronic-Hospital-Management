<?php

// Assuming you have already established a MySQL database connection

include 'patientconnection.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Retrieve form data
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$problem = $_POST["problem"];
	$gender = $_POST["gender"];
	$contact = $_POST["contact"];
    $nationality = $_POST["nationality"];

    $date = $_POST["date_of_visit"];

	// Validate the data (you can add more validation if needed)
	if (empty($fname) || empty($lname) || empty($problem) || empty($gender) || empty($contact) || empty($date) || empty($nationality )) {
		$error = "Please fill in all the required fields.";
		// You can redirect back to the form or display an error message as per your requirement
	}  else {
		// Data is valid, proceed to save it in the database
		// Assuming you have a "hospital" table with the required fields (adjust the table name and column names as per your database structure)
		$sql = "INSERT INTO patient (first_name, last_name, problem, gender, contact, nationality, date_of_visit) VALUES ('$fname', '$lname', '$problem', '$gender', '$contact','$nationality', '$date')";

		if (mysqli_query($connection, $sql)) {
			$success =  "Patient added successfully. The Doctor will call you sooner";
			// You can redirect to a success page or display a success message as per your requirement
		} else {
			$error= "Error: " . $sql . "<br>" . mysqli_error($connection);
			// Handle the database error, redirect back to the form, or display an error message as per your requirement
		}
	}

	// Close the database connection
	mysqli_close($connection);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor - Patient Registeration</title>
    <link rel="stylesheet" href="Add-patient.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">
    
</head>
<body>
        <!-- Navigation Menu -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="container navbar-brand" href="index.php">Hospital Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home Page</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Welcome to the patient page</h2>
        <form action="addpatient.php" method="post">

            <?php 
                if (isset($error)) { ?>
                    <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
                    </div>
            <?php }elseif(isset($success))  {?>
                    <div class="alert alert-success" role="alert">
            <?php echo $success; ?>
                    </div>
            <?php } ?>

            <div class="mb-3">
                <label for="FirstName" class="form-label">First Name</label>
                <input type="text" name="fname" class="form-control" id="FirstName">
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" name="lname" class="form-control" id="lastName">
            </div>

            
            <div class="mb-3">
                <label for="problem" class="form-label">symptoms</label>
                <input type="te" name="problem" class="form-control" id="problem">
            </div>
            <div class="mb-3">
                <label for="Gender" class="form-label">Gender</label>
                <select name="gender" class="form-select mb-3" aria-label="Default select example">
                    <option selected>Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Phone number</label>
                <input type="number" name="contact" class="form-control" id="contact">
            </div>
            <div class="mb-3">
                <label for="nationality" class="form-label">nationality</label>
                <input type="text" name="nationality" class="form-control" id="nationality">
            </div>

            <div class="mb-3">
                <label for="datePicker" class="form-label">Date of Visit</label>
                <input type="text" data-date-format="dd-mm-yyyy" data-provide="datepicker" name="date_of_visit" class="form-control datepicker" id="datePicker">
            </div>
            <input class="btn btn-success" type="submit" value="Submit">
            <input class="btn btn-warning" type="reset" value="Cancel">  
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
<?php
session_start(); 

if(!($_SESSION['username']=="admin"))
{
    // Redirect to the home page or any other authenticated page
    header("Location: login.php");
    exit();
}

// Assuming you have already established a MySQL database connection
include 'connection.php';
include 'staffconnection.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Retrieve form data
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$profession = $_POST["profession"];
	$gender = $_POST["gender"];
	$email = $_POST["email"];
    $nationality = $_POST["nationality"];

	$cnp = $_POST["cnp"];
	$pass = $_POST["pass"];
	$cpass = $_POST["cpass"];

	// Validate the data (you can add more validation if needed)
	if (empty($fname) || empty($lname) || empty($profession) || empty($gender) || empty($email) || empty($cnp) || empty($pass) || empty($cpass)) {
		$error = "Please fill in all the required fields.";
		// You can redirect back to the form or display an error message as per your requirement
	} elseif ($pass !== $cpass) {
		$error = "Passwords do not match.";
		// You can redirect back to the form or display an error message as per your requirement
	} else {
		// Data is valid, proceed to save it in the database
		// Assuming you have a "hospital" table with the required fields (adjust the table name and column names as per your database structure)
		$sql = "INSERT INTO hospital (first_name, last_name, profession, gender, email, nationality, cnp, password) VALUES ('$fname', '$lname', '$profession', '$gender', '$email',  '$nationality', '$cnp', '$pass')";

		if (mysqli_query($connection, $sql)) {
			$success =  "Staff added successfully.";

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
</head>
<body>
    <!-- Navigation Menu Bootstrap 5 -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class=" navbar-brand" href="index.php">Hospital Management</a>
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
        </div>
    </nav>
    <!-- End of navigation menu bootstrap 5 -->

    <div class="container mt-4">
        <h2>Doctor/Nurse Registeration System</h2>
        <form action="addstaff.php" method="post">

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
                <label for="profession" class="form-label">Profession</label>
                <select name="profession" class="form-select" aria-label="Default select example">
                    <option selected>Proffession</option>
                    <option value="Doctor">Doctor</option>
                    <option value="Nurse">Nurse</option>
                </select>
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
                <label for="Email" class="form-label">Email </label>
                <input type="email" name="email" class="form-control" id="Email">
            </div>

            <div class="mb-3">
                <label for="Nationality" class="form-label">nationality </label>
                <input type="nationality" name="nationality" class="form-control" id="nationality">
            </div>
            <div class="mb-3">
                <label for="cnp" class="form-label">C.N.P</label>
                <input type="text" name="cnp" class="form-control" id="cnp">
            </div>
            <div class="mb-3">
                <label for="passwd" class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" id="passwd">
            </div>
            <div class="mb-3">
                <label for="rpasswd" class="form-label">Confirm Password</label>
                <input type="password" name="cpass" class="form-control" id="rpasswd">
            </div>
            <input class="btn btn-success" type="submit" value="Submit">
            <input class="btn btn-warning" type="reset" value="Cancel">  
        </form>
    </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
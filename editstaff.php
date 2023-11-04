<?php
session_start();

if (!($_SESSION['username'] == "admin")) {
    // Redirect to the home page or any other authenticated page
    header("Location: login.php");
    exit();
}

// Assuming you have a database connection established
include 'staffconnection.php';

// Check if the record ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the record from the "hospital" table based on the provided ID
    $sql = "SELECT * FROM hospital WHERE id = $id";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // You can access the record fields as $row['field_name']
    } else {
        // Redirect to the page where you list all records or display an error message
        header("Location: admindashboard.php");
        exit();
    }
} else {
    // Redirect to the page where you list all records or display an error message
    header("Location: admindashboard.php");
    exit();
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $profession = $_POST["profession"];
    $gender = $_POST["gender"];
    $cnp = $_POST["cnp"];

    // Update the record in the "hospital" table
    $sql = "UPDATE hospital SET first_name = '$first_name', last_name = '$last_name', email = '$email', profession = '$profession', gender = '$gender', cnp = '$cnp' WHERE id = $id";

    if (mysqli_query($connection, $sql)) {
        // Record updated successfully
        header("Location: admindashboard.php");
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
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo $row['first_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" id="last_name" value="<?php echo $row['last_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="<?php echo $row['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="profession" class="form-label">Profession</label>
                <select name="profession" class="form-select" aria-label="Default select example">
                    <option selected>Proffession</option>
                    <option value="Doctor" <?php if($row['profession']=="Doctor"){echo 'selected';}; ?>>Doctor</option>
                    <option value="Nurse" <?php if($row['profession']=="Nurse"){echo 'selected';}; ?>>Nurse</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" class="form-control" id="gender">
                    <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="cnp" class="form-label">CNP</label>
                <input type="text" name="cnp" class="form-control" id="cnp" value="<?php echo $row['cnp']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="admindashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

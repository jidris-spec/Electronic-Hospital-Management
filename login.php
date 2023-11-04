<?php
session_start();
// Assuming you have already established a MySQL database connection
include 'connection.php';
if(isset($_SESSION['username'])){
    // Check if the user is already logged in
    if ($_SESSION['username']=='admin') {
        // Redirect to the home page or any other authenticated page
        header("Location: admindashboard.php");
        exit();
    }elseif(isset($_SESSION['username'])){
        // Redirect to the home page or any other authenticated page
        header("Location: staffdashboard.php");
        exit();
    }
}

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["email"];
    $password = $_POST["password"];


    // admin credentials
    if($username=="admin@gmail.com" && $password=="admin")
    {
        // Authentication successful
        $_SESSION['username'] = "admin";
        // Redirect to the home page or any other authenticated page
        header("Location: admindashboard.php");
        exit();
    }


    // Perform authentication by querying the database (replace this with your own authentication logic)
    $sql = "SELECT * FROM hospital WHERE email = '$username' AND password = '$password'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Authentication successful
        $_SESSION['username'] = $username;
        // Redirect to the home page or any other authenticated page
        header("Location: staffdashboard.php");
        exit();
    } else {
        // Authentication failed
        $error = "Invalid username or password.";
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
    <title>Logine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <!-- Navigation Menu -->
    <nav class=" navbar navbar-expand-lg navbar-light bg-light">
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
                    <a class="nav-link" href="addpatient.php">SignUp</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <form action="" method="post">
            <div class="container mt-5">
    <h2>Welcome</h2>
    <p>You can login either as a staff or the admin 
</p>

</div>

            <?php if (isset($error)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <div class="mb-3">
                <label for="email" class="form-label">Enter Your Email Id </label>
                <input type="email" name="email" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

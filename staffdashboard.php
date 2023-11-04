<?php 
session_start(); 

if(!isset($_SESSION['username']))
{
    // Redirect to the home page or any other authenticated page
    header("Location: login.php");
    exit();
}

// Assuming you have a database connection established
include 'patientconnection.php';
// Select all records from the "hospital" table
$sql = "SELECT * FROM patient";
$result = mysqli_query($connection, $sql);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <!-- Navigation Menu Bootstrap 5 -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class=" container navbar-brand" href="index.php">Hospital Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End of navigation menu bootstrap 5 -->

<!-- Bootstrap 5 Css class that gives container spacing -->
<div class="container mt-5">
    <!-- Welcome message -->
    <h2>Welcome <?php echo $_SESSION['username']; ?></h2>
   
            <?php    
                if (mysqli_num_rows($result) > 0) 
                { 
            ?>
                <!-- Doctors nurses list -->
                <table class="table mt-5">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">problem</th>
                        <th scope="col">Gender</th>
                        <th scope="col">contact</th>
                        <th scope="col">nationality</th>
                        <th scope="col">available visit</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php    
                // Output data of each row
                while ($row = mysqli_fetch_assoc($result)) 
                {
            ?>
            <tr>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['problem']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['contact']; ?></td>
                <td><?php echo $row['nationality']; ?></td>
                <td><?php echo $row['date_of_visit']; ?></td>
                <td>
                    <a href="editpatient.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="deletepatient.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php } }else {?>
                    <h2> No records found !</h2>
               <?php }
                // Close the database connection
                mysqli_close($connection);
            ?>
        </tbody>
    </table>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
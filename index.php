<?php 
session_start(); // initiation of  new or existing session.
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
     <!-- Navigation Menu -->
     <nav class=" navbar navbar-expand-lg navbar-light bg-light">
        <a class="container navbar-brand" href="index.php">ELECTRONIC HEALTH RECORD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <?php 
            if(isset($_SESSION['username'])){
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php }else{?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                    
                </li>
            <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="addpatient.php">patient page</a>
                </li>
            </ul>
        </div>
    </nav>
<div class="hero-image">
  <div class="hero-text">
    <h1>LAGOS STATE TEACHING HOSPITAL</h1>
  </div>
</div>
<div class="container mt-5">
    <h2>Welcome</h2>
    <p>You can login either as a doctor or a nurse to enter into your page Else, if your are a patient , please fill the form explaining your condition to us and also choose a convinient date  to book an appointment with us.</p>
</div>
<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Unset the session variable
    unset($_SESSION['username']);

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other desired page
    header("Location: login.php");
    exit();
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}
?>

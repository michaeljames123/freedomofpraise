<!DOCTYPE html>
<?php
// Database connection settings
// Database connection
$servername = "sql300.infinityfree.com";
$username = "if0_37791093";
$password = "TH4SkiIihz";
$dbname = "if0_37791093_bookings";       // Your database name


// Establish the MySQL connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

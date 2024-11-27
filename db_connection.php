<?php
// Database connection settings
$servername = "sql300.infinityfree.com";
$username = "if0_37791093";
$password = "TH4SkiIihz";
$dbname = "if0_37791093_bookings";

// Create a connection to the MySQL database
$conn = new mysqli($host, $user, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>

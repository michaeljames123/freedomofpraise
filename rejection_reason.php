<?php
// Database connection
$servername = "sql300.infinityfree.com";
$username = "if0_37791093";
$password = "TH4SkiIihz";
$dbname = "if0_37791093_bookings";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];
    $rejection_reason = $conn->real_escape_string($_POST['rejection_reason']);

    // Update booking with rejection reason
    $sql = "UPDATE bookings SET status='Rejected', rejection_reason='$rejection_reason' WHERE id=$booking_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: bookings.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

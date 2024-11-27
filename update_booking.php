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

// Get the booking ID and new status
$booking_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$new_status = isset($_GET['status']) ? $_GET['status'] : '';

if ($booking_id > 0 && ($new_status == 'Accepted' || $new_status == 'Rejected')) {
    // Update the booking status in the database
    $sql = "UPDATE bookings SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_status, $booking_id);

    if ($stmt->execute()) {
        echo "<script>alert('Booking status updated successfully!'); window.location.href = 'bookings.php';</script>";
    } else {
        echo "<script>alert('Failed to update booking status.'); window.location.href = 'bookings.php';</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href = 'bookings.php';</script>";
}

$conn->close();
?>

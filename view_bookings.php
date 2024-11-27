<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please log in to view your bookings.'); window.location.href='login.php';</script>";
    exit();
}

// Get the logged-in user's username from the session
$loggedInUser = $_SESSION['username'];

// Database connection
$servername = "sql300.infinityfree.com";
$username = "if0_37791093";
$password = "TH4SkiIihz";
$dbname = "if0_37791093_bookings"; // Ensure the database name is correct

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the `bookings` table (Baptism bookings) for the logged-in user
$baptismBookings = [];
$baptismQuery = "SELECT id, name, email, booking_date, booking_time, username, type, status, rejection_reason 
                 FROM bookings WHERE username = ?";
$baptismStmt = $conn->prepare($baptismQuery);
$baptismStmt->bind_param("s", $loggedInUser);
$baptismStmt->execute();
$baptismResult = $baptismStmt->get_result();
if ($baptismResult && $baptismResult->num_rows > 0) {
    $baptismBookings = $baptismResult->fetch_all(MYSQLI_ASSOC);
}

// Fetch data from the `child_dedication_bookings` table for the logged-in user
$dedicationBookings = [];
$dedicationQuery = "SELECT id, parent_name AS name, parent_email AS email, child_name, dedication_date AS booking_date, dedication_time AS booking_time, username, type, status, rejection 
                    FROM child_dedication_bookings WHERE username = ?";
$dedicationStmt = $conn->prepare($dedicationQuery);
$dedicationStmt->bind_param("s", $loggedInUser);
$dedicationStmt->execute();
$dedicationResult = $dedicationStmt->get_result();
if ($dedicationResult && $dedicationResult->num_rows > 0) {
    $dedicationBookings = $dedicationResult->fetch_all(MYSQLI_ASSOC);
}

// Fetch data from the `funeral_service_bookings` table for the logged-in user
$funeralBookings = [];
$funeralQuery = "SELECT id, deceased_name AS name, contact_email AS email, contact_person AS family_contact, service_date AS booking_date, service_time AS booking_time, username, type, status, rejection 
                 FROM funeral_service_bookings WHERE username = ?";
$funeralStmt = $conn->prepare($funeralQuery);
$funeralStmt->bind_param("s", $loggedInUser);
$funeralStmt->execute();
$funeralResult = $funeralStmt->get_result();
if ($funeralResult && $funeralResult->num_rows > 0) {
    $funeralBookings = $funeralResult->fetch_all(MYSQLI_ASSOC);
}

// Combine all bookings into one array
$allBookings = array_merge($baptismBookings, $dedicationBookings, $funeralBookings);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #444;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
            color: #333;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
        }
        .btn-back:hover {
            background: #0056b3;
        }
        .no-bookings {
            text-align: center;
            margin: 30px 0;
            font-size: 18px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Bookings</h1>
        <?php if (!empty($allBookings)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Booking Date</th>
                        <th>Booking Time</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Rejection Reason</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allBookings as $booking): ?>
                        <tr>
                            <td><?= htmlspecialchars($booking['id']) ?></td>
                            <td><?= htmlspecialchars($booking['name']) ?></td>
                            <td><?= htmlspecialchars($booking['email']) ?></td>
                            <td><?= htmlspecialchars($booking['booking_date']) ?></td>
                            <td><?= htmlspecialchars($booking['booking_time'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($booking['type']) ?></td>
                            <td><?= htmlspecialchars($booking['status']) ?></td>
                            <td><?= htmlspecialchars($booking['rejection_reason'] ?? $booking['rejection'] ?? 'N/A') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-bookings">No bookings found for your account.</p>
        <?php endif; ?>

        <a href="book.php" class="btn-back">Back to Bookings</a>
    </div>
</body>
</html>

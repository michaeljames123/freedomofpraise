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

// Fetch bookings grouped by type
$types = ['Baptism', 'Dedication', 'Funeral'];
$bookings = [];

foreach ($types as $type) {
    $sql = "SELECT id, name, email, booking_date, booking_time, username, type, status, rejection_reason 
            FROM bookings WHERE type = '$type' ORDER BY booking_date DESC";
    $result = $conn->query($sql);
    $bookings[$type] = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings - Admin Panel</title>
    <style>
        body {
            display: flex;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            color: #fff;
            width: 200px;
            padding-left: 20px;
            height: 100vh;
            background-image: linear-gradient(30deg, #11cf4d, #055e21);
        }
        .sidebar h2 {
            padding: 40px 0 0 0;
        }
        .sidebar a {
            font-size: 14px;
            color: #fff;
            display: block;
            padding: 12px;
            padding-left: 30px;
            text-decoration: none;
        }
        .sidebar a:hover {
            color: #56ff38;
            background: #fff;
            border-top-left-radius: 22px;
            border-bottom-left-radius: 22px;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        h3 {
            margin-top: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4A90E2;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status {
            font-weight: bold;
        }
        .pending {
            color: orange;
        }
        .accepted {
            color: green;
        }
        .rejected {
            color: red;
        }
        .action-buttons {
            display: flex;
            justify-content: space-around;
            gap: 5px;
        }
        .action-button {
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
        }
        .accept-button {
            background-color: #28a745;
        }
        .reject-button {
            background-color: #dc3545;
        }
        #rejectModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
            border-radius: 8px;
        }
        #rejectModal textarea {
            width: 100%;
            height: 80px;
            margin-bottom: 10px;
        }
        #rejectModal button {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Admin</h2>
    <a href="bookings.php">Bookings</a>
    <a href="schedules.php">Schedules</a>
    <a href="users.php">Users</a>
    <a href="log_out.php">Log out</a>
</div>

<div class="main-content">
    <h2>All Bookings</h2>

    <?php foreach ($bookings as $type => $rows): ?>
        <h3><?php echo $type; ?> Bookings</h3>
        <?php if (count($rows) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Booking Date</th>
                        <th>Booking Time</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo $row['booking_date']; ?></td>
                            <td><?php echo $row['booking_time']; ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td class="status 
                                <?php 
                                    if ($row['status'] == 'Pending') echo 'pending'; 
                                    elseif ($row['status'] == 'Accepted') echo 'accepted'; 
                                    elseif ($row['status'] == 'Rejected') echo 'rejected'; 
                                ?>">
                                <?php echo htmlspecialchars($row['status']); ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="update_booking.php?id=<?php echo $row['id']; ?>&status=Accepted" class="action-button accept-button">Accept</a>
                                    <button class="action-button reject-button" onclick="openModal(<?php echo $row['id']; ?>)">Reject</button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No bookings found for <?php echo $type; ?>.</p>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<!-- Rejection Reason Modal -->
<div id="rejectModal">
    <form id="rejectForm" method="POST" action="rejection_reason.php">
        <input type="hidden" name="booking_id" id="bookingId">
        <label for="rejectionReason">Rejection Reason:</label>
        <textarea name="rejection_reason" id="rejectionReason" required></textarea>
        <button type="submit">Submit</button>
        <button type="button" onclick="closeModal()">Cancel</button>
    </form>
</div>

<script>
function openModal(bookingId) {
    document.getElementById('bookingId').value = bookingId;
    document.getElementById('rejectModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('rejectModal').style.display = 'none';
}
</script>

</body>
</html>

<?php
$conn->close();
?>

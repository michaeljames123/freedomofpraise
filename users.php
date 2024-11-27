<?php 
session_start();
include 'adminpage.php'; // Include the admin header

// Database connection
$servername = "sql300.infinityfree.com"; 
$username = "if0_37791093"; 
$password = "TH4SkiIihz"; 
$dbname = "if0_37791093_user_auth"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include shared CSS -->
    <style>
        /* Sidebar Styles */
        body {
            display: flex;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        div.sidebar {
            color: #fff;
            width: 200px;
            padding-left: 20px;
            height: 100vh;
            background-image: linear-gradient(30deg, #11cf4d, #055e21);
            position: fixed;
            top: 0;
            left: 0;
        }

        div.sidebar h2 {
            padding: 40px 0 0 0;
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        div.sidebar a {
            font-size: 16px;
            color: #fff;
            display: block;
            padding: 12px;
            padding-left: 30px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        div.sidebar a:hover {
            background-color: #fff;
            color: #56ff38;
            border-radius: 22px;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }

        h2.page-title {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            color: black;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .button {
            padding: 8px 12px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .edit-button {
            background-color: #4CAF50;
            color: white;
        }

        .edit-button:hover {
            background-color: #45a049;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
        }

        .delete-button:hover {
            background-color: #d32f2f;
        }

        .message {
            text-align: center;
            font-size: 16px;
            color: #666;
        }

        .success-message {
            color: #2ecc71;
        }

        .error-message {
            color: #e74c3c;
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
        <h2 class="page-title">User Management</h2>

        <?php
        // Display success or error messages
        if (isset($_SESSION['success_message'])) {
            echo '<p class="message success-message">' . htmlspecialchars($_SESSION['success_message']) . '</p>';
            unset($_SESSION['success_message']);
        }

        if (isset($_SESSION['error_message'])) {
            echo '<p class="message error-message">' . htmlspecialchars($_SESSION['error_message']) . '</p>';
            unset($_SESSION['error_message']);
        }
        ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['create_at']}</td>
                            <td>
                                <form action='edit_user.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button type='submit' class='button edit-button'>Edit</button>
                                </form>
                                <form action='delete_user.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button type='submit' class='button delete-button'>Delete Account</button>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found.</td></tr>";
            }
            ?>
        </table>

    </div>

</body>
</html>

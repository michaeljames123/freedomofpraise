<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baptism Booking Form</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link external stylesheet -->
    <style>
        /* Your existing styles */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: white;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            max-width: 90%; /* Use almost the full window width */
            width: 1200px; /* Define a max-width for large screens */
            margin: auto;
        }

        .form-container h1 {
            text-align: center;
            color: #4A90E2;
            margin-bottom: 20px;
        }

        .form-container form {
            display: grid;
            grid-template-columns: 1fr 1fr; /* Two columns */
            gap: 20px;
        }

        .form-container label {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .form-container input,
        .form-container select,
        .form-container button {
            font-size: 1rem;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 100%;
        }

        .form-container input:focus,
        .form-container select:focus {
            border-color: #4A90E2;
            box-shadow: 0 0 8px rgba(74, 144, 226, 0.3);
            outline: none;
        }

        .form-container button {
            background-color: #4A90E2;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .form-container button:hover {
            background-color: #3f7fc2;
            transform: translateY(-3px);
        }

        .form-container .price-info {
            text-align: left;
            grid-column: span 2; /* Make price-info span both columns */
            margin-top: 10px;
            font-size: 1rem;
            color: #666;
        }

        .form-container button {
            grid-column: span 2; /* Make the button span both columns */
            justify-self: center; /* Center the button horizontally */
            padding: 15px 40px; /* Add some padding for better aesthetics */
        }

        .back-button {
            display: inline-block;
            padding: 10px 15px;
            margin: 20px auto;
            background-color: #4A90E2;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #357ABD;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <a href="book.php" class="back-button">Back</a>
        <h1>Baptism Booking</h1>
        <form action="process_booking.php" method="POST">
            <!-- Hidden field to specify booking type -->
            <input type="hidden" name="type" value="Baptism">

            <!-- Full Name -->
            <div>
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            </div>

            <!-- Email -->
            <div>
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <!-- Username (Pre-filled) -->
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($_SESSION['username']); ?>" readonly>
            </div>

            <!-- Baptism Date -->
            <div>
                <label for="date">Preferred Baptism Date</label>
                <input type="date" id="date" name="date" required>
            </div>

            <!-- Baptism Time -->
            <div>
                <label for="time">Preferred Baptism Time</label>
                <input type="time" id="time" name="time" required>
            </div>

            <!-- Price Information -->
            <div class="price-info">
                Service Fee: <strong>$700</strong>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-button">Submit Baptism Booking</button>
        </form>
    </div>
</body>
</html>

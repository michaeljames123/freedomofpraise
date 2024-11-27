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
    <title>Funeral Service Booking Form</title>
    <style>
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
            max-width: 90%;
            width: 1200px;
            margin: auto;
        }

        .form-container h1 {
            text-align: center;
            color: #4A90E2;
            margin-bottom: 20px;
        }

        .form-container form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-container label {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .form-container input,
        .form-container textarea,
        .form-container select,
        .form-container button {
            font-size: 1rem;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 100%;
        }

        .form-container input:focus,
        .form-container textarea:focus,
        .form-container select:focus {
            border-color: #4A90E2;
            box-shadow: 0 0 8px rgba(74, 144, 226, 0.3);
            outline: none;
        }

        .form-container textarea {
            resize: none;
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
            grid-column: span 2;
            margin-top: 10px;
            font-size: 1rem;
            color: #666;
        }

        .form-container button {
            grid-column: span 2;
            justify-self: center;
            padding: 15px 40px;
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
        <h1>Funeral Service Booking</h1>
        <form action="process_booking.php" method="POST">
    <input type="hidden" name="type" value="Funeral">
    
    <!-- Other form fields like deceased name, contact person, email, etc. -->
    <label for="deceased_name">Deceased Name:</label>
    <input type="text" name="deceased_name" id="deceased_name" required>

    <label for="family_name">Contact Person Name:</label>
    <input type="text" name="family_name" id="family_name" required>

    <label for="email">Contact Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="service_date">Service Date:</label>
    <input type="date" name="service_date" id="service_date" required>

    <label for="service_time">Service Time:</label>
    <input type="time" name="service_time" id="service_time" required>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?= htmlspecialchars($_SESSION['username']); ?>" readonly>

    <button type="submit">Book Funeral Service</button>
</form>

    </div>
</body>
</html>

<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not, redirect to the login page
    header('Location: login.php');
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Now - Freedom of Praise Church</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include shared CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            scroll-behavior: smooth;
            background-color: white; 
        }

        main {
            padding: 110px 50px;
            margin-top: 50px; /* Prevent overlap with header */
            background-image: url('white-background.jpg');
        }

        /* Booking Container */
        .booking-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
            padding: 10px;
        }

        /* Booking Card Styling */
        .booking-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: white;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 90%;
            max-width: 400px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .booking-card:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .booking-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .booking-content {
            padding: 20px;
        }

        .booking-content h2 {
            font-size: 1.8rem;
            margin: 10px 0;
            color: #333;
        }

        .booking-content p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 20px;
        }

        .booking-button {
            background-color: #4A90E2;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .booking-button:hover {
            background-color: #3f7fc2;
            transform: translateY(-3px);
        }

        /* Responsive Design */
        @media (min-width: 768px) {
            .booking-container {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: space-around;
            }
        }

        dialog {
            padding: 2rem;
            background: white;
            max-width: 400px;
            border-radius: 20px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
        }

        dialog::backdrop {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .close-button {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 15px;
        }
        .service-button {
            display: block;
            margin: 20px auto;
            padding: 15px 30px;
            font-size: 1.1rem;
            background-color: #4A90E2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .service-button:hover {
            background-color: #3f7fc2;
        }

        .booking-form-container {
            position: fixed;
            top: -100%;
            left: 0;
            width: 100%;
            background-color: #f8f8f8;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 0 0 20px 20px;
            transition: top 0.5s ease;
            z-index: 9999;
        }

        .booking-form-container.active {
            top: 0;
        }

        .close-button {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            position: absolute;
            top: 15px;
            right: 20px;
            color: #555;
        }

        .close-button:hover {
            color: #000;
        }

        .booking-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 40px;
        }

        .booking-form input,
        .booking-form select,
        .submit-button {
            padding: 12px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .booking-form input:focus,
        .booking-form select:focus {
            border-color: #4A90E2;
            box-shadow: 0 0 8px rgba(74, 144, 226, 0.4);
        }

        .submit-button {
            background-color: #4A90E2;
            color: white;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #3f7fc2;
        }
    .view-bookings-button {
    position: absolute; /* Position relative to the main section */
    bottom: 20px; /* Distance from the top */
    right: 680px; /* Distance from the right */
    z-index: 1000; /* Ensure it appears above other elements */
    top: 100px;
}

.view-bookings-button button {
    background-color: #4A90E2; /* Button color (blue) */
    color: white; /* Button text color */
    padding: 10px 20px; /* Button padding */
    border: none; /* No border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    font-size: 1rem; /* Font size */
    transition: background-color 0.3s ease; /* Transition effect */
}

.view-bookings-button button:hover {
    background-color: #3f7fc2; /* Darker blue on hover */
}

        /* Billing Section */
        .billing-info {
            text-align: center;
            margin: 20px 0;
        }

        .billing-info h2 {
            color: #4A90E2;
        }

        .billing-info table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%;
        }

        .billing-info th, .billing-info td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .billing-info th {
            background-color: #f5f5f5;
        }

        
    </style>
</head>
<body>

<?php include 'header.php'; ?> <!-- Include header without changes -->

<main>
    <!-- View Bookings Button -->
    <div class="view-bookings-button">
        <button onclick="window.location.href='view_bookings.php';">View Bookings</button>
    </div>
    

    
    <section class="booking-container">
        <!-- Booking Card 1 -->
        <div class="booking-card">
            <img src="baptism.jpg" alt="Baptism">
            <div class="booking-content">
                <h2>Baptism</h2>
                <p>Baptism symbolizes a new beginning in Christ...</p>
                <button class="booking-button" onclick="window.location.href='baptism_form.php';">Baptise Now!</button>
                <button class="booking-button" onclick="window.location.href='details.php';">Details</button>
            </div>
        </div>

        <!-- Booking Card 2 -->
        <div class="booking-card">
            <img src="dedication1.jpeg" alt="Child Dedication">
            <div class="booking-content">
                <h2>Child Dedication</h2>
                <p>Child dedication is a special ceremony...</p>
                <button class="booking-button" onclick="window.location.href='dedication_form.php';">Reserve Now!</button>
                <button class="booking-button" onclick="window.location.href='details.php';">Details</button>
            </div>
        </div>

        <!-- Booking Card 3 -->
        <div class="booking-card">
            <img src="Fservice.jpg" alt="Funeral Service">
            <div class="booking-content">
                <h2>Funeral Service</h2>
                <p>A funeral service is a time to honor...</p>
                <button class="booking-button" onclick="window.location.href='funeral_form.php';">Get a Service!</button>
                <button class="booking-button" onclick="window.location.href='details.php';">Details</button>
            </div>
        </div>
    </section>
    
</main>

        <!-- Billing Information -->
        <div class="billing-info">
        <h2>Billing Cost Range Information </h2>
        <table>
            <tr>
                <th>Service</th>
                <th>Price</th>
            </tr>
            <tr>
                <td>Baptism</td>
                <td>$500-2500</td>
            </tr>
            <tr>
                <td>Child Dedication</td>
                <td>$500-3000</td>
            </tr>
            <tr>
                <td>Funeral Service</td>
                <td>$2000-10,000</td>
            </tr>
        </table>
    </div>
</main>

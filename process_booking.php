<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookings"; // Make sure the database name is correct

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process booking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the type of booking (Baptism, Dedication, or Funeral)
    $type = $_POST['type'];

    $stmt = null; // Initialize $stmt variable

    // Validate the booking type
    if (empty($type)) {
        $_SESSION['error_message'] = "Booking type is required!";
        echo "<script>alert('Booking type is required!'); window.location.href='book.php';</script>";
        exit();
    }

    // Handle Baptism Booking
    if ($type == "Baptism") {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $date = $_POST['date'];
        $time = $_POST['time'];
        $username = $_POST['username'];

        // Check required fields
        if (empty($name) || empty($email) || empty($date) || empty($time) || empty($username)) {
            $_SESSION['error_message'] = "All fields are required!";
            echo "<script>alert('All fields are required!'); window.location.href='book.php';</script>";
            exit();
        }

        // Prepare and execute query for Baptism
        $stmt = $conn->prepare(
            "INSERT INTO bookings (name, email, booking_date, booking_time, username, type) 
            VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssssss", $name, $email, $date, $time, $username, $type);
    }
    // Handle Child Dedication Booking
    elseif ($type == "Dedication") {
        $parent_name = trim($_POST['parent_name']);
        $child_name = trim($_POST['child_name']);
        $parent_email = trim($_POST['email']);  // Assuming the email is the parent's email
        $dedication_date = $_POST['dedication_date'];
        $dedication_time = $_POST['dedication_time'];
        $username = $_POST['username'];
         // Added time input

        // Check required fields
        if (empty($parent_name) || empty($child_name) || empty($parent_email) || empty($dedication_date) || empty($dedication_time) || empty($username)) {
            $_SESSION['error_message'] = "All fields are required!";
            echo "<script>alert('All fields are required!'); window.location.href='book.php';</script>";
            exit();
        }

        // Prepare and execute query for Dedication
        $stmt = $conn->prepare(
            "INSERT INTO bookings (name, email, booking_date, booking_time, username, type) 
            VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssssss", $parent_name, $parent_email, $dedication_date, $dedication_time, $username, $type);
    }
    // Handle Funeral Service Booking
    elseif ($type == "Funeral") {
        $family_name = trim($_POST['family_name']);
        $email = trim($_POST['email']);
        $service_date = $_POST['service_date'];
        $service_time = $_POST['service_time']; // Capturing the service time
        $deceased_name = trim($_POST['deceased_name']);
        $username = $_POST['username']; // Assuming this is the logged-in user's username

        // Check required fields
        if (empty($family_name) || empty($email) || empty($service_date) || empty($service_time) || empty($deceased_name) || empty($username)) {
            $_SESSION['error_message'] = "All fields are required!";
            echo "<script>alert('All fields are required!'); window.location.href='funeral_form.php';</script>";
            exit();
        }

        // Prepare and execute query for Funeral Service
        $stmt = $conn->prepare(
            "INSERT INTO bookings (name, email, booking_date, booking_time, username, type) 
            VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssssss", $deceased_name, $family_name, $service_date, $service_time, $username, $type); // Insert data into bookings table
    } else {
        $_SESSION['error_message'] = "Invalid booking type!";
        echo "<script>alert('Invalid booking type!'); window.location.href='book.php';</script>";
        exit();
    }

    // Execute the statement
    if ($stmt) {
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Booking successful! Your reservation for a " . $type . " has been confirmed.";
            echo "<script>alert('Booking successful!'); window.location.href='book.php';</script>";
        } else {
            $_SESSION['error_message'] = "Error: " . $stmt->error;
            echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='book.php';</script>";
        }
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>

<?php
// Database connection
$servername = "sql300.infinityfree.com"; 
$username = "if0_37791093"; 
$password = "TH4SkiIihz"; 
$dbname = "if0_37791093_user_auth"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle registration
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Check if the username already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) { // Username doesn't exist
            $stmt->close();

            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password);
            if ($stmt->execute()) {
                $stmt->close();
                // Redirect to login page after successful registration
                header("Location: login.php");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        } else {
            $error = "Username already exists. Please choose another.";
        }
    }

    // Handle login
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Start session and set session variable
                $_SESSION['username'] = $username;

                // Redirect to home.php
                header("Location: home.php");
                exit();
            } else {
                $error = "Invalid credentials.";
            }
        } else {
            $error = "No user found.";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration and Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('fop5.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }
        .container {
            background: rgba(255, 255, 255, 0.85);
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 350px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }
        .container:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            margin-bottom: 0.5em;
            color: #333;
            font-size: 2rem;
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5em;
            color: #333;
            font-size: 1.5rem;
        }
        input[type="text"], input[type="password"] {
            width: 93%;
            padding: 12px;
            margin: 0.5em 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #007BFF;
            background-color: #e8f0fe;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: black;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .form-group {
            margin-bottom: 1em;
        }
        .link {
            text-align: center;
            margin-top: 20px;
        }
        .link a {
            color: #FFFFFF;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .link a:hover {
            color: #0056b3;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        .logo {
            display: block;
            margin: 0 auto 1.5em auto;
            width: 150px;
            height: auto;
        }
    </style>
</head>
<body>

<img src="fop2.PNG" alt="Logo" class="logo">
<h1>Information Management System</h1>
<h2>for Freedom of Praise Church</h2>

<div class="container">
    <h2>Register</h2>
    <form method="POST">
        <div class="form-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <?php if (isset($error)): ?>
            <div class="error"><?= $error; ?></div>
        <?php endif; ?>
        <button type="submit" name="register">Register</button>
    </form>
</div>

<div class="link">
    <a href="login.php">Already have an account? Login here.</a>
</div>

</body>
</html>

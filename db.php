<?php
$host = 'sql300.infinityfree.com';
$dbname = 'if0_37791093_church_website';
$username = 'if0_37791093'; // Use your database username
$password = 'TH4SkiIihz'; // Use your database password

try {
    // Create a new PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
<?php
// Database credentials
$servername = "localhost"; // Change to your server name if it's not localhost
$username = "root"; // Change to your MySQL username
$password = ""; // Change to your MySQL password
$dbname = "chatdb"; // Change to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>

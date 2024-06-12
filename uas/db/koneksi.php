<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Adjust as necessary
$password = ""; // Adjust as necessary
$dbname = "uas_coba";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

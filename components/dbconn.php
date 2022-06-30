<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "20212_wp2_412020004";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

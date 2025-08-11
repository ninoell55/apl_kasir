<?php
// Database connection settings
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'apl_kasir';


// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
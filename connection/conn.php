<?php
// Database connection settings
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'apl_kasir';
$port = 3309;


// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
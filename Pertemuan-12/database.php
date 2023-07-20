<?php
// Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your actual database credentials
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'vsga';

// Create a database connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$conn) {
    die('Database connection error: ' . mysqli_connect_error());
}
?>

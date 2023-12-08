<?php

$host = 'localhost';
$username = 'root';
$password = ' ';
$database = 'zitfuse';

// Create a database connection
// $conn = new mysqli($host, $username, $password, $database);

$conn = new mysqli('localhost', 'root', '', 'zitfuse');


// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

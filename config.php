<?php

$servername = "localhost";
$username = "pdf";
$password = "7388139606";
$dbname = "pdf";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


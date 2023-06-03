<?php
include './../config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create "games" table if it does not exist
$sql = "CREATE TABLE IF NOT EXISTS customer (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255), 
    reference VARCHAR(255),
    mobile VARCHAR(255),
    balance DECIMAL(10, 2)
)";

if ($conn->query($sql) === FALSE) {
    echo "Error creating table: " . $conn->error;
    die();
}

// Retrieve data from the URL parameters 
$name = $_GET['name'];
$reference = $_GET['reference'];
$mobile = $_GET['mobile'];

// Insert data into the "games" table
$sql = "INSERT INTO customer (name, reference, mobile, balance) 
        VALUES ('$name', '$reference', '$mobile', 0)";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the database connection
$conn->close();

//
header("Location: ./../customer.php");

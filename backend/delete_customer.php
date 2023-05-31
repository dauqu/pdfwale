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

//get id from url
$id = $_GET['id'];

//delete ledger from the "ledger" table
$sql = "DELETE FROM customer WHERE id = $id";

//Return to ledger.php
if ($conn->query($sql) === TRUE) {
    header("Location: ./../customer.php");
} else {
    echo "Error deleting ledger: " . $conn->error;
}
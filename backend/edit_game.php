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

// Retrieve data from the URL parameters
$id = $_GET['id']; // Assuming you pass the game ID through the URL parameter
$result = $_GET['result']; // Assuming you pass the updated game result through the URL parameter

// Update the "games" table with the new result based on the provided ID
$sql = "UPDATE games SET result = '$result' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Game result updated successfully";
} else {
    echo "Error updating game result: " . $conn->error;
}

// Close the database connection
$conn->close();

// Redirect back to the game page
header("Location: ./../game.php");

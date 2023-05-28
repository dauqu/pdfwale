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

// Create "games" table if it does not exist
$sql = "CREATE TABLE IF NOT EXISTS games (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    date DATE,
    details VARCHAR(255),
    amount DECIMAL(10, 2),
    team_1 VARCHAR(255),
    team_2 VARCHAR(255),
    result VARCHAR(255)
)";

if ($conn->query($sql) === FALSE) {
    echo "Error creating table: " . $conn->error;
    die();
}

// Retrieve data from the URL parameters 
$date = $_GET['date'];
$details = $_GET['details'];
$amount = $_GET['amount'];
$team_1 = $_GET['team_1'];
$team_2 = $_GET['team_2'];

// Insert data into the "games" table
$sql = "INSERT INTO games (date, details, amount, team_1, team_2, result) 
        VALUES ('$date', '$details', '$amount', '$team_1', '$team_2', 'pending')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the database connection
$conn->close();

//
header("Location: ./../game.php");

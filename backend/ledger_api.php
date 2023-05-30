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

// Retrieve data from the database
$name = $_GET['name']; // Assuming you pass the name through the URL parameter



$sql = "SELECT * FROM ledger WHERE party='$name'";
$result = $conn->query($sql);

// Check if any data was found
if ($result->num_rows > 0) {
    // Create an array to store the data
    $data = array();

    // Fetch the data and add it to the array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Set the appropriate headers for JSON response
    header('Content-Type: application/json');

    // Convert the data array to JSON
    $json = json_encode($data);

    // Output the JSON data
    echo $json;
} else {
    echo "No data found for the given name.";
}

// Close the database connection
$conn->close();

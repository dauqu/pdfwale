<?php
include './../config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the database
$date = $_GET['date']; // Assuming you pass the name through the URL parameter

// Prepare the SQL statement with a placeholder for the date
$sql = "SELECT * FROM ledger WHERE date = ?";
$stmt = $conn->prepare($sql);

// Bind the date parameter to the prepared statement
$stmt->bind_param("s", $date);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

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

// Close the prepared statement
$stmt->close();

// Close the database connection
$conn->close();

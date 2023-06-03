<?php
include './../config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM customer";
$result = $conn->query($sql);

// Check if any data was found
if ($result->num_rows > 0) {
    // Create a string to store the data
    $text = "";

    // Fetch the data and append it to the string
    while ($row = $result->fetch_assoc()) {
        // Exclude the "id" field
        unset($row['id']);
        unset($row['mobile']);

        $text .= implode("\t", $row) . "\n";
    }

    // Set the appropriate headers for plain text response
    header('Content-Type: text/plain');

    // Output the plain text data
    echo $text;
} else {
    echo "No data found for the given name.";
}

// Close the database connection
$conn->close();

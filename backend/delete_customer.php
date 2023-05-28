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

// Check if the customer ID is provided in the request
if (!isset($_GET['id'])) {
    $response = array(
        'success' => false,
        'message' => 'Customer ID is required.'
    );
    echo json_encode($response);
    exit;
}

// Get the customer ID from the request
$customerID = $_GET['id'];

// Delete the customer from the "customer" table
$sql = "DELETE FROM customer WHERE id = $customerID";

if ($conn->query($sql) === TRUE) {
    $response = array(
        'success' => true,
        'message' => 'Customer deleted successfully.'
    );
} else {
    $response = array(
        'success' => false,
        'message' => 'Error deleting customer: ' . $conn->error
    );
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the connection
$conn->close();
?>

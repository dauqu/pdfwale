<?php
include './../config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve all customers from the "customer" table
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $customers = array();
    while ($row = $result->fetch_assoc()) {
        $customer = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'reference' => $row['reference'],
            'mobile' => $row['mobile']
        );
        $customers[] = $customer;
    }
    $response = array(
        'success' => true,
        'customers' => $customers
    );
} else {
    $response = array(
        'success' => false,
        'message' => 'No customers found.'
    );
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the connection
$conn->close();
?>

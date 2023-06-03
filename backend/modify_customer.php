<?php
include './../config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the request body
    $requestData = json_decode(file_get_contents('php://input'), true);
    
    // Check if the required parameters are present
    if (isset($requestData['id']) && isset($requestData['name']) && isset($requestData['reference']) && isset($requestData['mobile'])) {
        // Retrieve the customer details from the request
        $customerID = $requestData['id'];
        $newName = $requestData['name'];
        $newReference = $requestData['reference'];
        $newMobile = $requestData['mobile'];
        
        // Update the customer record
        $sql = "UPDATE customer SET name='$newName', reference='$newReference', mobile='$newMobile' WHERE id=$customerID";
        
        if ($conn->query($sql) === TRUE) {
            $response = array(
                'success' => true,
                'message' => "Customer record with ID $customerID has been updated successfully."
            );
        } else {
            $response = array(
                'success' => false,
                'message' => "Error updating customer record: " . $conn->error
            );
        }
    } else {
        $response = array(
            'success' => false,
            'message' => 'Missing required parameters.'
        );
    }
} else {
    $response = array(
        'success' => false,
        'message' => 'Invalid request method.'
    );
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the connection
$conn->close();
?>

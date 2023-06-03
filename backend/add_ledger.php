<?php
include './../config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create "games" table if it does not exist
$sql = "CREATE TABLE IF NOT EXISTS ledger (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    date DATE,
    party VARCHAR(255),
    amount VARCHAR(255),
    type VARCHAR(255),
    narration VARCHAR(255),
    clossing VARCHAR(255)
)";

if ($conn->query($sql) === FALSE) {
    echo "Error creating table: " . $conn->error;
    die();
}

// Retrieve data from the URL parameters 
// $date = $_GET['date'];
$party = $_GET['party'];
$amount = $_GET['amount'];
$type = $_GET['type'];
$narration = $_GET['narration'];
$clossing = $_GET['amount'];

//Add amount to customer 
$sql = "SELECT * FROM customer WHERE name='$party'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $balance = $row['balance'];
    //If balance is less than amount than die
    if ($balance < $amount && $type == 'debit') {
        # code...
        //Die program 
        //Echo in heading center
        echo "<h1 style='text-align: center;'>$party have not enough balance to pay $amount</h1>";
        die();
    }
    if ($type == 'credit') {
        $balance = $balance + $amount;
    } else {
        $balance = $balance - $amount;
    }
    $sql = "UPDATE customer SET balance='$balance' WHERE name='$party'";
    if ($conn->query($sql) === FALSE) {
        echo "Error updating table: " . $conn->error;
        die();
    }
} else {
    echo "Error updating table 1: " . $conn->error;
    die();
}


//Get current balance of party 
$sql = "SELECT * FROM customer WHERE name='$party'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $balance = $row['balance'];

    // Insert data into the "games" table
    $sql = "INSERT INTO ledger (date, party, amount, type, narration, clossing) 
VALUES (CURDATE(), '$party', '$amount', '$type', '$narration', '$balance')";
} else {
    echo "Error updating table: " . $conn->error;
    die();
}

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the database connection
$conn->close();

header("Location: ./../ledger.php");

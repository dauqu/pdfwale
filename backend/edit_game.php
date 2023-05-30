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
$result = $_GET['result'];
$result2 = $_GET['result2'];
$type = "credit";
$narration = "$result won the game";


// ==================== Add amount to customer ====================
//Select amount from games
$sql = "SELECT * FROM games WHERE id=$id";
$check_bal = $conn->query($sql);

//Get amount from games
if ($check_bal->num_rows > 0) {
    $row = $check_bal->fetch_assoc();
    $amount = $row['amount'];

    //Add amount to customer 
    $sql = "SELECT * FROM customer WHERE name='$result'";
    $customerResult = $conn->query($sql);
    if ($customerResult->num_rows > 0) {
        $row = $customerResult->fetch_assoc();
        $balance = $row['balance'];

        $balance = $balance + $amount;

        $sql = "UPDATE customer SET balance='$balance' WHERE name='$result'";
        if ($conn->query($sql) === FALSE) {
            echo "Error updating table: " . $conn->error;
            die();
        }
    } else {
        echo "Error updating table: " . $conn->error;
        die();
    }

    //Decrease amount from customer
    $sql = "SELECT * FROM customer WHERE name='$result2'";
    $customerResult2 = $conn->query($sql);
    if ($customerResult2->num_rows > 0) {
        $row = $customerResult2->fetch_assoc();
        $balance = $row['balance'];

        $balance = $balance - $amount;

        $sql = "UPDATE customer SET balance='$balance' WHERE name='$result2'";
        if ($conn->query($sql) === FALSE) {
            echo "Error updating table: " . $conn->error;
            die();
        }
    } else {
        echo "Error updating table: " . $conn->error;
        die();
    }
} else {
    echo "Error updating table: " . $conn->error;
    die();
}

//==================Add Ledger===================
// Add data in ledger table
// Insert data into the "games" table
$sql = "INSERT INTO ledger (date, party, amount, type, narration, clossing) 
        VALUES (CURDATE(), '$result', '$amount', '$type', '$narration', '$result')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}



// ==================== Update the "games" table ====================
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

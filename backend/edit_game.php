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
$type2 = "debit";
$narration = "$result won the game";
$narration2 = "$result2 loose the game";

echo $id;
echo $result;
echo $result2;
echo $type;
echo $narration;
echo $narration2;


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

        // $balance = $balance + $amount;

        //Add amount with 2% commission
        $balance = $balance + ($amount * 0.98);

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

//Get balance from customer 
$customersql = "SELECT * FROM customer WHERE name='$result'";
$customerResult = $conn->query($customersql);

if ($customerResult) {
    if ($customerResult->num_rows > 0) {
        $row = $customerResult->fetch_assoc();
        $balance = $row['balance'];
        echo $balance;

        // Insert data into the "ledger" table for the first time
        $sql1 = "INSERT INTO ledger (date, party, amount, type, narration, clossing) VALUES (CURDATE(), '$result', '$amount', '$type', '$narration', '$balance')";
        if ($conn->query($sql1) === TRUE) {
            echo "First record inserted successfully into the ledger table.";
        } else {
            echo "Error inserting first record into the ledger table: " . $conn->error;
        }

        // Insert data into the "ledger" table for the second time
        // $sql2 = "INSERT INTO ledger (date, party, amount, type, narration, clossing) VALUES (CURDATE(), '$result2', '$amount', '$type2', '$narration2', '$balance')";
        // if ($conn->query($sql2) === TRUE) {
        //     echo "Second record inserted successfully into the ledger table.";
        // } else {
        //     echo "Error inserting second record into the ledger table: " . $conn->error;
        // }
    } else {
        echo "No customer found with the name: $result";
    }
} else {
    echo "Error executing query: " . $conn->error;
}


//Get balance from customer 
$customersql2 = "SELECT * FROM customer WHERE name='$result2'";
$customerResult2 = $conn->query($customersql2);

if ($customerResult2) {
    if ($customerResult2->num_rows > 0) {
        $row = $customerResult2->fetch_assoc();
        $balance = $row['balance'];
        echo $balance;

        // Insert data into the "ledger" table for the first time
        // $sql1 = "INSERT INTO ledger (date, party, amount, type, narration, clossing) VALUES (CURDATE(), '$result', '$amount', '$type', '$narration', '$balance')";
        // if ($conn->query($sql1) === TRUE) {
        //     echo "First record inserted successfully into the ledger table.";
        // } else {
        //     echo "Error inserting first record into the ledger table: " . $conn->error;
        // }

        // Insert data into the "ledger" table for the second time
        $sql2 = "INSERT INTO ledger (date, party, amount, type, narration, clossing) VALUES (CURDATE(), '$result2', '$amount', '$type2', '$narration2', '$balance')";
        if ($conn->query($sql2) === TRUE) {
            echo "Second record inserted successfully into the ledger table.";
        } else {
            echo "Error inserting second record into the ledger table: " . $conn->error;
        }
    } else {
        echo "No customer found with the name: $result";
    }
} else {
    echo "Error executing query: " . $conn->error;
}


// if ($conn->query($sql) === TRUE) {
//     echo "Data inserted successfully";
// } else {
//     echo "Error inserting data: " . $conn->error;
// }



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

<?php
include './../config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//get id from url
$id = $_GET['id'];
$resultData = $_GET['result'];

//delete ledger from the "ledger" table
// $sql = "DELETE FROM games WHERE id = $id";

// Retrieve game result data
$sql = "SELECT * FROM games";
$result = $conn->query($sql);

//Check if result is not pending
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['id'] == $id) {
            if ($row['result'] != "pending") {
                echo "Error: Game already played.";
                die();
            }
        }
    }
} else {
    echo "Error: No games found.";
    die();
}

$updateSql = "UPDATE games SET result='$resultData' WHERE id='$id'";
if ($conn->query($updateSql) === FALSE) {
    echo "Error updating table: " . $conn->error;
    die();
}

// Close the database connection
$conn->close();

//
header("Location: ./../game.php");
?>

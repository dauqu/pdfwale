<?php
include './../config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//get id from url
$id = $_GET['id'];

//delete ledger from the "ledger" table
$sql = "DELETE FROM games WHERE id = $id";

//Return to ledger.php
if ($conn->query($sql) === TRUE) {
    header("Location: ./../game.php");
} else {
    echo "Error deleting ledger: " . $conn->error;
}
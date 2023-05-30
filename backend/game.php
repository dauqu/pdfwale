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

// Create "games" table if it does not exist
$sql = "CREATE TABLE IF NOT EXISTS games (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    date DATE,
    details VARCHAR(255),
    amount DECIMAL(10, 2),
    team_1 VARCHAR(255),
    team_2 VARCHAR(255),
    result VARCHAR(255)
)";

if ($conn->query($sql) === FALSE) {
    echo "Error creating table: " . $conn->error;
    die();
}


// Retrieve data from the URL parameters 
$date = $_GET['date'];
$details = $_GET['details'];
$amount = $_GET['amount'];
$team_1 = $_GET['team_1'];
$team_2 = $_GET['team_2'];

//Both team name is same return 
if ($team_1 == $team_2) {
?>
    <div class="w-full h-screen text-center item-center justify-center flex">
        <h1 class="flex w-full item-center justify-center">
            Both team name is same
        </h1>
        <!-- Return to home -->
        <a href="./../game.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Return to home
        </a>
    </div>
<?php
    die();
}

//Select name where $team_1 $team_2 from customer table and check if it exists
$sql = "SELECT name FROM customer WHERE name='$team_1' OR name='$team_2'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
?>
    <div class="w-full h-screen text-center item-center justify-center flex">
        <h1 class="flex w-full item-center justify-center">
            Please enter valid team names
        </h1>
        <!-- Return to home -->
        <a href="./../game.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Return to home
        </a>
    </div>
    <?php
    die();
}

//Select balance from customer table where name is $team_1
$sql = "SELECT balance FROM customer WHERE name='$team_1'";
$result = $conn->query($sql);
//Check if team_1 have sufficient balance
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $balance = $row['balance'];
    if ($balance < $amount) {
    ?>
        <div class="w-full h-screen text-center item-center justify-center flex">
            <h1 class="flex w-full item-center justify-center">
                <?php echo $team_1; ?> have insufficient balance
            </h1>
            <!-- Return to home -->
            <a href="./../game.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Return to home
            </a>
        </div>
    <?php
        die();
    }
}

//Select balance from customer table where name is $team_2
$sql = "SELECT balance FROM customer WHERE name='$team_2'";
$result = $conn->query($sql);
//Check if team_2 have sufficient balance
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $balance = $row['balance'];
    if ($balance < $amount) {
    ?>
        <div class="w-full h-screen text-center item-center justify-center flex">
            <h1 class="flex w-full item-center justify-center">
                <?php echo $team_2; ?> have insufficient balance
            </h1>
            <!-- Return to home -->
            <a href="./../game.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Return to home
            </a>
        </div>
<?php
        die();
    }
}



// Insert data into the "games" table
$sql = "INSERT INTO games (date, details, amount, team_1, team_2, result) 
        VALUES ('$date', '$details', '$amount', '$team_1', '$team_2', 'pending')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the database connection
$conn->close();

//
header("Location: ./../game.php");

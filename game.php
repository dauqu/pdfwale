<?php

include './components/header.php';

$servername = "localhost";
$username = "pdf";
$password = "7388139606";
$dbname = "pdf";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// SQL query to retrieve data
$sql = "SELECT * FROM games";
$result = $conn->query($sql);

?>

<div class="w-full h-full justify-center items-center flex mt-10">

    <div class="w-full max-w-[90%] p-1 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-600 dark:border-gray-700">
        <form class="space-y-6" action="#">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg h-[50vh]">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center">
                                <input type="checkbox" class="checkbox" />
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Table
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Details
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Team 1
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Team 2
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Result
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $serialNumber = 1;
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">

                                        </div>
                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo $serialNumber; ?>
                                    </th>
                                    <td class="px-6 py-4">
                                        <?php echo $row["date"]; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $row["details"]; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $row["team_1"]; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $row["team_1"]; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo "$ " . $row["amount"]; ?>
                                    </td>
                                </tr>
                                <?php $serialNumber++;  ?>
                        <?php
                            }
                        } else {
                            echo "No data found";
                        }
                        ?>

                    </tbody>
                </table>
            </div>


        </form>

        <div class="justify-between mt-5">
            <form action="./backend/game.php" method="get">
                <div class="flex justify-between">
                    <div class="w-full">
                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                        <input type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm input-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="w-full ml-10">
                        <label for="details" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Details</label>
                        <input type="text" name="details" id="details" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm input-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                </div>
                <div class="flex justify-between mt-5">
                    <div class="w-full">
                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                        <input type="number" name="amount" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm input-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="w-full ml-10">
                        <label for="team_1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Team 1</label>
                        <input type="text" name="team_1" id="team_1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm input-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="w-full ml-10">
                        <label for="team_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Team 2</label>
                        <input type="text" name="team_2" id="team_2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm input-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                </div>
                <div class="flex mt-5 justify-start">
                    <div>

                        <button class="btn rounded-none btn-sm btn-wide btn-primary">
                            Save
                        </button>
                    </div>
                    <div class="ml-10">
                        <button class="btn rounded-none btn-sm btn-wide btn-primary" type="submit">
                            Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


</body>

</html>
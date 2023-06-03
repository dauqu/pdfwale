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

    <div class="w-full max-w-[95%] p-1 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-600 dark:border-gray-700">
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
                            <th scope="col" class="px-6 py-3">
                                Action
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
                                <tr class="bg-green-600 border-b dark:bg-green-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 <?php if ($row["result"] != "pending") {
                                                                                                                                                    echo "dark:bg-slate-800";
                                                                                                                                                } else {
                                                                                                                                                    echo "dark:bg-slate-800";
                                                                                                                                                } ?>">
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
                                    <td class="px-6 py-4 hover:bg-slate-900 cursor-pointer">
                                        <?php
                                        //check if result is not pending
                                        if ($row["result"] != "pending") {
                                            //Show green background and name 
                                            echo "<div class='text-white'>" . $row["team_1"] . "</div>";
                                        } else {
                                            echo "<a href='./backend/edit_game.php?id=" . $row["id"] . "&result=" . $row["team_1"] . "&result2=" . $row["team_2"] . "' class='text-white hover:text-blue-600 bg-green'>" . $row["team_1"] . "</a>";
                                        }
                                        ?>
                                    </td>
                                    <td class="px-6 py-4 hover:bg-slate-900 cursor-pointer">
                                        <?php
                                        //check if result is not pending
                                        if ($row["result"] != "pending") {
                                            //Show green background and name 
                                            echo "<div class='text-white'>" . $row["team_2"] . "</div>";
                                        } else {
                                            echo "<a href='./backend/edit_game.php?id=" . $row["id"] . "&result=" . $row["team_1"] . "&result2=" . $row["team_2"] . "' class='text-white hover:text-blue-600 bg-green'>" . $row["team_2"] . "</a>";
                                        }
                                        ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $row["result"]; ?>
                                    </td>
                                    <td class="px-6 py-4">

                                        <!-- The button to open modal -->
                                        <label for="my-modal" class="btn btn-sm rounded btn-active btn-error">Delete </label>

                                        <!-- Put this part before </body> tag -->
                                        <input type="checkbox" id="my-modal" class="modal-toggle" />
                                        <div class="modal">
                                            <div class="modal-box">
                                                <h3 class="font-bold text-lg">
                                                    Are you sure you want to delete this game?
                                                </h3>
                                                <p class="py-4">
                                                    This action cannot be undone.
                                                </p>
                                                <div class="modal-action">
                                                    <label for="my-modal" class="btn btn-primary rounded btn-sm btn-active">Cancel</label>
                                                    <?php
                                                    //Delete by id
                                                    // echo "<a href='./backend/delete_game.php?id=" . $row["id"] . "' class='btn btn-sm btn-outline btn-error btn-active rounded uppercase'>Delete</a>";
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
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
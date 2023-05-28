<?php

include './components/header.php';

$servername = "localhost";
$username = "pdf";
$password = "7388139606";
$dbname = "pdf";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// SQL query to retrieve data
$sql = "SELECT * FROM ledger";
$result = $conn->query($sql);

// SQL query to retrieve data
$sql2 = "SELECT * FROM customer";
$result2 = $conn->query($sql2);

// Calculate total amount based on type
$sql_credit = "SELECT SUM(amount) AS total_credit FROM ledger WHERE type = 'credit'";
$result_credit = $conn->query($sql_credit);
$row_credit = $result_credit->fetch_assoc();
$total_credit = $row_credit['total_credit'];

$sql_debit = "SELECT SUM(amount) AS total_debit FROM ledger WHERE type = 'debit'";
$result_debit = $conn->query($sql_debit);
$row_debit = $result_debit->fetch_assoc();
$total_debit = $row_debit['total_debit'];

$total_amount = $total_credit - $total_debit;
?>

<div class="w-full h-full justify-center items-center flex mt-10">

    <div class="w-full max-w-[90%] p-1 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-600 dark:border-gray-700">
        <form class="space-y-6" action="./backend/add_ledger.php">

            <div class="flex justify-between">
                <div class="w-full mr-2">
                    <label for="opening_bal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opening
                        Bal.</label>
                    <input type="text" name="opening_bal" id="opening_bal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm input-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                </div>
                <div class="w-full mr-2">
                    <label for="party" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Party</label>
                    <select class="select rounded select-sm w-full" id="party" name="party" require>
                        <?php
                        if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                        ?>
                                <option>
                                    <?php echo $row["name"]; ?>
                                </option>
                        <?php
                            }
                        } else {
                            echo "No data found";
                        }
                        ?>
                    </select>
                    <!-- <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm input-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required> -->
                </div>
                <div class="mr-2">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Leader</label>
                    <button class="btn rounded-none btn-sm btn-wide btn-primary btn-disabled">
                        Full Leader
                    </button>
                </div>
                <div class="mr-2">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Clear Data</label>
                    <button class="btn rounded-none btn-sm btn-wide btn-primary">
                        Clear Data
                    </button>
                </div>
                <div class="mr-2">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Taily</label>
                    <button class="btn rounded-none btn-sm btn-primary btn-disabled">
                        Taily
                    </button>
                </div>
                <div class="mr-2">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">MF</label>
                    <button class="btn rounded-none btn-sm btn-primary btn-disabled">
                        MF
                    </button>
                </div>
                <div class="w-full mr-2">
                    <label for="closing_bal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Closing Bal.</label>
                    <input type="text" name="closing_bal" id="closing_bal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm input-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                </div>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5 overflow-y-scroll h-[40vh]">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center">

                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Party
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Debit
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Credit
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Narration
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Clossing
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
                                $id = $row["id"]; // Assuming the ID column name is "id"
                        ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <?php echo $serialNumber; ?>
                                        </div>
                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo $row["date"]; ?>
                                    </th>
                                    <td class="px-6 py-4">
                                        <?php echo $row["party"]; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php
                                        echo $row["type"] == "debit" ? $row["amount"] : "0";
                                        ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php
                                        echo $row["type"] == "credit" ? $row["amount"] : "0";
                                        ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $row["narration"]; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $row["clossing"]; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php
                                        //Delete by id
                                        echo "<a href='./backend/delete_ledger.php?id=" . $id . "' class='btn btn-sm btn-outline btn-error btn-active rounded'>Delete</a>";
                                        ?>
                                    </td>
                                </tr>
                        <?php $serialNumber++;
                            }
                        } else {
                            echo "No data found";
                        }
                        ?>


                    </tbody>
                </table>
            </div>

            <div class="flex justify-between">
                <div class="w-full mr-2">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                    <p class="text-white text-md">
                        <?php
                        //Harsha
                        echo "Total Amount: " . $total_amount . "<br/>";
                        echo "Total Debit: " . $total_debit . "<br/>";
                        echo "Total Credit: " . $total_credit . "<br/>";
                        ?>
                    </p>
                </div>
                <div class="w-full flex flex-col mr-5">
                    <div class="form-control">
                        <label class="label cursor-pointer w-[100px]">
                            <span class="label-text text-white">
                                Debit
                            </span>
                            <input type="radio" name="type" value="debit" class="radio checked:bg-red-500" checked require />
                        </label>
                    </div>
                    <div class="form-control">
                        <label class="label cursor-pointer w-[100px]">
                            <span class="label-text text-white">
                                Credit
                            </span>
                            <input type="radio" name="type" value="credit" class="radio checked:bg-green-500" require />
                        </label>
                    </div>
                </div>
                <div class="w-full mr-2">
                    <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                    <input type="number" name="amount" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm input-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <div class="w-full mr-2">
                    <label for="narration" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Narration</label>
                    <input type="text" name="narration" id="narration" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm input-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Save Data</label>
                    <button class="btn rounded-none btn-sm btn-wide btn-success btn-active">
                        Submit
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>


</body>

</html>
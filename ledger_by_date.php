<?php

include './components/header.php';
include './config.php';

$date = $_GET['date'];

//Select customer table if exists
$sql = "SELECT * FROM ledger WHERE date='$date'";
$result = $conn->query($sql);

?>

<div class="w-full h-full justify-center items-center flex mt-[5vh]">
    <div class="w-full max-w-[80%] p-4 bg-white border rounded-lg border-gray-200 shadow sm:p-6 md:p-8 dark:bg-gray-600 dark:border-gray-700">

        <div class="box-content h-[40vh] w-90 border-2 border-gray-100 bg-gray-100 overflow-y-scroll mt-5">
            <div class="rounded-none">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center">

                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Table
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Party
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Amount
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Type
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Narration
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Clossing
                            </th>
                        </tr>
                    </thead>
                    <tbody class="rounded-none">
                        <?php
                        if ($result->num_rows > 0) {
                            $serialNumber = 1;
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $id = $row["id"]; // Assuming the ID column name is "id"
                        ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4">

                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo $serialNumber; ?>
                                    </th>
                                    <td class="px-6 py-4">
                                        <?php echo $row["date"]; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $row["party"]; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $row["amount"]; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $row["type"]; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $row["narration"]; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $row["clossing"]; ?>
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
        </div>
    </div>
</div>

</body>

</html>
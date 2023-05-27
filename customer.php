<?php

include './components/header.php';
?>

<div class="w-full h-full justify-center items-center flex mt-[20vh]">
    <div class="w-full max-w-[40%] p-4 bg-white border rounded-lg border-gray-200 shadow sm:p-6 md:p-8 dark:bg-gray-600 dark:border-gray-700">
        <form class="space-y-6" action="./backend/customer.php">

            <div class="flex justify-between items-end w-full">
                <div class="w-full mr-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NAME</label>
                    <input type="name" name="name" id="name" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <button class="w-[150px] text-black btn-sm bg-white border-white-200 shadow h-10 dark:bg-white-600 pl-2 pr-2 dark:border-white-700 ">Addittion</button>
            </div>
            <div class="flex justify-between items-end">
                <div class="w-full mr-5">
                    <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reference</label>
                    <input type="reference" name="reference" id="reference" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <button class="w-[150px] text-black btn-sm bg-white border-white-200 shadow h-10 dark:bg-white-600 pl-2 pr-2 dark:border-white-700 ">Modification</button>
            </div>
            <div class="flex justify-between items-end">
                <div class="w-full mr-5">
                    <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile
                        No.</label>
                    <input type="number" name="mobile" id="mobile" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <button class="w-[150px] text-black btn-sm bg-white border-white-200 shadow h-10 dark:bg-white-600 pl-2 pr-2 dark:border-white-700 ">Delete</button>
            </div>
            <div class="box-content h-[200px] w-90 border-2 border-gray-100 bg-gray-100">
                <div class="overflow-x-auto rounded-none">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <!-- <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Reference</th>
                                <th>Mobile Number</th>
                            </tr>
                        </thead> -->
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
                                Details
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Team 1
                            </th>
                        </tr>
                    </thead>
                        <tbody class="rounded-none">
                            <!-- row 1 -->
                            <!-- <tr>
                                <th>1</th>
                                <td>Rishi</td>
                                <td>Harsh</td>
                                <td>9999999999</td>
                            </tr> -->
                            <!-- row 2 -->
                            <!-- <tr>
                                <th>2</th>
                                <td>Rishi</td>
                                <td>Harsh</td>
                                <td>9999999999</td>
                            </tr> -->
                            <!-- row 3 -->
                            <!-- <tr>
                                <th>3</th>
                                <td>Rishi</td>
                                <td>Harsh</td>
                                <td>9999999999</td>
                            </tr> -->
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">

                                        </div>
                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <!-- <?php echo $serialNumber; ?> --> 1
                                    </th>
                                    <td class="px-6 py-4">
                                        <!-- <?php echo $row["date"]; ?> --> Rishi
                                    </td>
                                    <td class="px-6 py-4">
                                        <!-- <?php echo $row["details"]; ?> --> Harsh
                                    </td>
                                    <td class="px-6 py-4">
                                        <!-- <?php echo $row["team_1"]; ?> --> 7388139606
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>



</body>

</html>
<?php

include './components/header.php';
?>

<div class="w-full h-full justify-center items-center flex mt-[20vh]">
    <div class="w-full max-w-[40%] p-4 bg-white border rounded-lg border-gray-200 shadow sm:p-6 md:p-8 dark:bg-gray-600 dark:border-gray-700">
        <form class="space-y-6" action="#">

            <div class="flex justify-between items-end w-full">
                <div class="w-full mr-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NAME</label>
                    <input type="name" name="name" id="name" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <button class="w-[150px] text-black btn-sm bg-white border-white-200 shadow h-10 dark:bg-white-600 pl-2 pr-2 dark:border-white-700 ">Addittion</button>
            </div>
            <div class="flex justify-between items-end">
                <div class="w-full mr-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reference</label>
                    <input type="name" name="name" id="name" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <button class="w-[150px] text-black btn-sm bg-white border-white-200 shadow h-10 dark:bg-white-600 pl-2 pr-2 dark:border-white-700 ">Modification</button>
            </div>
            <div class="flex justify-between items-end">
                <div class="w-full mr-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile
                        No.</label>
                    <input type="number" name="number" id="number" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <button class="w-[150px] text-black btn-sm bg-white border-white-200 shadow h-10 dark:bg-white-600 pl-2 pr-2 dark:border-white-700 ">Delete</button>
            </div>
            <div class="box-content h-[200px] w-90 border-2 border-gray-100 bg-gray-100">
                <div class="overflow-x-auto rounded-none">
                    <table class="table w-full rounded-none">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Reference</th>
                                <th>Mobile Number</th>
                            </tr>
                        </thead>
                        <tbody class="rounded-none">
                            <!-- row 1 -->
                            <tr>
                                <th>1</th>
                                <td>Rishi</td>
                                <td>Harsh</td>
                                <td>9999999999</td>
                            </tr>
                            <!-- row 2 -->
                            <tr>
                                <th>2</th>
                                <td>Rishi</td>
                                <td>Harsh</td>
                                <td>9999999999</td>
                            </tr>
                            <!-- row 3 -->
                            <tr>
                                <th>3</th>
                                <td>Rishi</td>
                                <td>Harsh</td>
                                <td>9999999999</td>
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
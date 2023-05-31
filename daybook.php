<?php

include './components/header.php';
?>


</body>
<div class="w-full h-full justify-center items-center flex mt-[20vh]"> 
    <div class="w-full max-w-[30%] p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-600 dark:border-gray-700">
        <form class="space-y-6" action="./ledger_by_date.php" method="get">
            <h5 class="text-xl font-small text-gray-900 dark:text-white">Working Date</h5>
            <div>
                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Validating Working Date</label>
                <input type="date" name="date" id="date" class="input w-full rounded input-sm"required>
            </div>
            <div class="flex justify-end">
            <button type="submit" class="btn rounded btn-sm btn-active btn-success mr-2">Ok</button>
        </div>
    </div>
    </div>
    
    </body>
    </html>


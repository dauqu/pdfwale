<?php

include './components/header.php';

$servername = "localhost";
$username = "pdf";
$password = "7388139606";
$dbname = "pdf";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// SQL query to retrieve data
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);

?>

<div class="w-full h-full justify-center items-center flex mt-[5vh]">
    <div class="w-full max-w-[80%] p-4 bg-white border rounded-lg border-gray-200 shadow sm:p-6 md:p-8 dark:bg-gray-600 dark:border-gray-700">
        <form class="space-y-6" action="./backend/customer.php" method="get">

            <div class="flex justify-between items-end w-full">
                <div class="w-full mr-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NAME</label>
                    <input type="name" name="name" id="name" class="input input-sm w-full rounded input-bordered" required>
                </div>
            </div>
            <div class="flex justify-between items-end">
                <div class="w-full mr-5">
                    <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reference</label>
                    <input type="reference" name="reference" id="reference" class="input input-sm w-full rounded input-bordered" required>
                </div>
            </div>
            <div class="flex justify-between items-end">
                <div class="w-full mr-5">
                    <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile
                        No.</label>
                    <input type="number" name="mobile" id="mobile" class="input input-sm w-full rounded input-bordered" required>
                </div>

            </div>
            <button class="w-[150px] text-black btn-sm border-white-200 shadow h-10 pl-2 pr-2 btn btn-primary rounded btn-success btn-active" type="submit">Addittion</button>
            <div class="w-[150px] text-black btn-sm border-white-200 shadow h-10 pl-2 pr-2 btn btn-primary rounded btn-active" value="update" id="update">Modification</div>
            <div class="w-[150px] text-black btn-sm border-white-200 shadow h-10 pl-2 pr-2 btn btn-secondary rounded btn-active" value="delete">Delete</div>

            <div class="box-content h-[40vh] w-90 border-2 border-gray-100 bg-gray-100">
                <div class="overflow-x-auto rounded-none">
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
                                    Details
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Team 1
                                </th>
                            </tr>
                        </thead>
                        <tbody class="rounded-none">
                            <?php
                            if ($result->num_rows > 0) {
                                $serialNumber = 1;
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input type="checkbox" class="checkbox checkbox-secondary" />
                                            </div>
                                        </td>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <?php echo $serialNumber; ?>
                                        </th>
                                        <td class="px-6 py-4">
                                            <?php echo $row["name"]; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo $row["reference"]; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo $row["mobile"]; ?>
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
            </div>
        </form>
    </div>
</div>


<script>
    const update_btn = document.getElementById('update');

    // Update button click
    update_btn.addEventListener('click', () => {
        console.log("Clicked")
        //Add classname to the form
        document.getElementById('update').classList.add('loading');
        // Get the values from the form
        const name = document.getElementById('name').value;
        const reference = document.getElementById('reference').value;
        const mobile = document.getElementById('mobile').value;

        // Make a URL-encoded string for passing POST data:
        const data = {
            'name': name,
            'reference': reference,
            'mobile': mobile
        };

        // Send a POST request
        fetch('./backend/customer.php', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'content-type': 'application/json'
                }
            }).then(response => response.json())
            .then(data => {
                console.log(data)
            })
            .catch(error => console.error('Error:', error))
    });
</script>

</body>

</html>
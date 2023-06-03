<?php

include './components/header.php';
include './config.php';

//Select customer table if exists
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
            <div class="w-[150px] text-black btn-sm border-white-200 shadow h-10 pl-2 pr-2 btn btn-primary rounded btn-active" value="update" id="c_update">Modification</div>
            <!-- <div class="w-[150px] text-black btn-sm border-white-200 shadow h-10 pl-2 pr-2 btn btn-secondary rounded btn-active" value="delete">Delete</div> -->
        </form>
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
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Reference
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Mobile No.
                            </th>
                            <!-- <th scope="col" class="px-6 py-3">
                                Balance
                            </th> -->
                            <th scope="col" class="px-6 py-3">
                                Action
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
                                        <div class="flex items-center">
                                            <input type="radio" name="customer" id="<?php echo $id; ?>" value="<?php echo $id; ?>" class="checkbox checkbox-secondary" id="checkbox" name="selected_id[]" />
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
                                    <!-- <td class="px-6 py-4">
                                        <?php echo $row["balance"]; ?>
                                    </td> -->
                                    <td class="px-6 py-4">
                                        <!-- <button class="text-black btn-sm btn btn-secondary rounded btn-active" id="delete_btn" onclick="deleteData(<?php echo $id; ?>)">Delete</button> -->
                                        <!-- The button to open modal -->
                                        <label for="my-modal-<?php echo $id; ?>" class="btn btn-sm rounded btn-active btn-error">Delete </label>

                                        <!-- Put this part before </body> tag -->
                                        <input type="checkbox" id="my-modal-<?php echo $id; ?>" class="modal-toggle" />
                                        <div class="modal">
                                            <div class="modal-box">
                                                <h3 class="font-bold text-lg">
                                                    Are you sure you want to delete this game?
                                                </h3>
                                                <p class="py-4">
                                                    This action cannot be undone. <?php echo $row["name"]; ?> will be deleted.
                                                </p>
                                                <div class="modal-action">
                                                    <label for="my-modal-<?php echo $id; ?>" class="btn btn-primary rounded btn-sm btn-active">Cancel</label>
                                                    <?php
                                                    //Delete by id
                                                    echo "<a href='./backend/delete_customer.php?id=" . $row["id"] . "' class='btn btn-sm btn-outline btn-error btn-active rounded uppercase'>Delete</a>";
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
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


<script>
    const update_btn = document.getElementById('update');
    const selected_checkbox = document.getElementById('checkbox');
    const delete_button = document.getElementById('delete_btn');

    function deleteData(id) {
        //Post request to delete data 
        fetch(`./backend/delete_customer.php?id=${id}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Customer deleted successfully.');
                    //Reload page 
                    window.location.reload();
                } else {
                    console.error('Error deleting customer:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

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
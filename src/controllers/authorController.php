<?php 
require '../../database/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <title>Author</title>
</head>

<body>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bio
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM auteurs";
                $result = $conn->query($sql);
                if (!$result) {
                    die("Invalid query:" . $conn->error);
                }

                //read data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "
                     <tr
                    class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>
                    <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                        $row[id]
                    </th>
                    <td class='px-6 py-4'>
                      
                        $row[email]
                    </td>
                    <td class='px-6 py-4'>
                        $row[name]
                    </td>
                    <td class='px-6 py-4'>
                        $row[bio]
                    </td>
                    <td class='px-6 py-4 text-right'>
                        <a href='#' class='font-medium text-blue-600 dark:text-blue-500 hover:underline'>Edit</a>
                    </td>
                </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
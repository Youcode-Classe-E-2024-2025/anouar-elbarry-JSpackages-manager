<?php
require_once 'database/config.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}
?>
<div class="hidden mt-14 Addversion-modal h-screen sm:ml-64 overflow-x-auto shadow-md sm:rounded-lg px-8">
        <h2 class="text-2xl font-bold mb-4">version Information</h2>
        <form action="./../src/controllers/versionController.php" method="POST">
            <div class="mb-4">
                <label for="Version_number" class="block text-gray-700 font-medium mb-2">Version_number</label>
                <input type="text" id="Version_number" name="Version_number" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="Release_date" class="block text-gray-700 font-medium mb-2">Release_date</label>
                <input type="date" id="Release_date" name="Release_date" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="package_name" class="block text-gray-700 font-medium mb-2">package name</label>
                <select name="package_name" id="package_name"  class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="choose an Author" selected>choose a package</option>
                    <?php
                $sql = "SELECT package_name FROM packages";
                $result = $conn->query($sql);
                if (!$result) {
                    die("Invalid query:" . $conn->error);
                }
                //read data of each row
                while ($option = $result->fetch_assoc()) {
                    echo "
                   <option id='$option[package_name]'>$option[package_name]</option>
                    ";
                }
                ?>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Submit</button>
            </div>
        </form>
    </div>    
<?php
require_once 'database/config.php';
require_once 'src/controllers/authorController.php';
require_once 'src/controllers/packageController.php';
require_once 'src/controllers/versionController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src\output.css">
    <title>Login</title>
</head>
<body class=" h-screen flex flex-col justify-between">
<div class="container mx-auto h-full ">
        <!-- Welcome Section -->
        <div class="text-center py-8 bg-blue-50">
          <h1 class="text-4xl font-bold text-blue-700">Welcome to the Package Management System</h1>
          <p class="mt-2 text-lg text-gray-600">Please select your roll.</p>
        </div>

        <!-- Navigation Cards -->
        <div class="grid grid-cols-1 gap-4 px-4 py-8 md:grid-cols-3 md:h-1/2">
          <a href="#" class="p-6 text-center bg-white rounded shadow hover:shadow-lg self-center min-h-fit h-1/2">
            <h2 class="text-2xl font-semibold text-blue-600">Author</h2>
          </a>
          <a href="#" class="p-6 text-center bg-white rounded shadow hover:shadow-lg self-center min-h-fit h-1/2">
            <h2 class="text-2xl font-semibold text-blue-600">Admin</h2>
          </a>
          <a href="#" class="p-6 text-center bg-white rounded shadow hover:shadow-lg self-center min-h-fit h-1/2">
            <h2 class="text-2xl font-semibold text-blue-600">User</h2>
          </a>
        </div>
      </div>
      <footer class="py-4 bg-gray-800 text-gray-400">
        <p class="text-center">© 2024 Package Management System. All Rights Reserved.</p>
      </footer>
     
</body>
</html>
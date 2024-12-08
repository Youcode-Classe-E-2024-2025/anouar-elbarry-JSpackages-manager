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
      <title>Package Management System</title>
      <link rel="stylesheet" href="src\output.css">
    </head>
    <body class="bg-gray-50">
      <div class="container mx-auto">
        <!-- Welcome Section -->
        <div class="text-center py-8 bg-blue-50">
          <h1 class="text-4xl font-bold text-blue-700">Welcome to the Package Management System</h1>
          <p class="mt-2 text-lg text-gray-600">Easily manage authors, packages, and versions.</p>
        </div>

        <!-- Navigation Cards -->
        <div class="grid grid-cols-1 gap-4 px-4 py-8 md:grid-cols-3">
          <a href="index.php?action=list_authors" class="p-6 text-center bg-white rounded shadow hover:shadow-lg">
            <h2 class="text-2xl font-semibold text-blue-600">Authors</h2>
            <p class="mt-2 text-gray-500">Manage authors and contributors.</p>
          </a>
          <a href="index.php?action=list_packages" class="p-6 text-center bg-white rounded shadow hover:shadow-lg">
            <h2 class="text-2xl font-semibold text-blue-600">Packages</h2>
            <p class="mt-2 text-gray-500">View and manage packages.</p>
          </a>
          <a href="index.php?action=list_versions" class="p-6 text-center bg-white rounded shadow hover:shadow-lg">
            <h2 class="text-2xl font-semibold text-blue-600">Versions</h2>
            <p class="mt-2 text-gray-500">Track package versions.</p>
          </a>
        </div>
      </div>
      <footer class="py-4 bg-gray-800 text-gray-400">
        <p class="text-center">© 2024 Package Management System. All Rights Reserved.</p>
      </footer>
     
    </body>
    </html>
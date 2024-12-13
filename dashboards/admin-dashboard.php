<?php
require_once 'src\models\Author.php';
require_once 'database/config.php';
require_once 'src\models\Package.php';
require_once 'src\models\version.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src\output.css">
    <title>Admin Dashboard</title>
</head>
<body>

<nav class="fixed top-0 z-50 w-full bg-black border-b border-gray-600">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div  class="flex items-center justify-start rtl:justify-end">
        <button id="menu"  data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <a href="#" class="flex ms-2 md:me-24">
         
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-white">Admin Dashboard</span>
        </a>
      </div>
      <div class="flex items-center">
          <div class="flex items-center ms-3">
            <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="data:image/png;base64,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" alt="user photo">
              </button>
            </div>
          </div>
        </div>
    </div>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="admin-dashboard.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-orange-600 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
               </svg>
               <span class="ms-3">Home</span>
            </a>
         </li>
         <li>
            <a href="index.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-orange-600 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                  <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Roles</span>
            </a>
         </li>
         <li id="addPackage" class="hidden">
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="currentColor" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-orange-600 dark:group-hover:text-white" >
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
</svg>

               <span class="flex-1 ms-3 whitespace-nowrap"> Add Package</span>
            </a>
         </li>
         <li id="addAuthor" class="hidden">
         <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="currentColor" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-orange-600 dark:group-hover:text-white" >
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
</svg>

               <span class="flex-1 ms-3 whitespace-nowrap"> Add Author</span>
            </a>
         </li>
         <li id="addVersion" class="hidden">
         <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="currentColor" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-orange-600 dark:group-hover:text-white" >
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
</svg>

               <span class="flex-1 ms-3 whitespace-nowrap"> Add Version</span>
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-orange-600 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Sign Out</span>
            </a>
         </li>
        
      </ul>
   </div>
</aside>

<div class="controll_cards p-4 h-screen sm:ml-64 ">
    <!-- Navigation Cards -->
    <div class="grid grid-cols-1 gap-14  px-4 pt-10 h-full">
          <a href="#" id="authors" class="card p-6 text-center bg-white rounded shadow hover:shadow-lg self-center min-h-fit">
            <h2 class="text-2xl font-semibold text-orange-600">Authors</h2>
            <p class="mb-3 text-gray-500 dark:text-gray-400">Manage and Organize Authors</p>
          </a>
          <a href="#" id="packages" class="card p-6 text-center bg-white rounded shadow hover:shadow-lg self-center min-h-fit">
            <h2 class="text-2xl font-semibold text-orange-600">Packages</h2>
            <p class="mb-3 text-gray-500 dark:text-gray-400">Explore and Customize Packages</p>
          </a>
          <a href="#" id="versions" class="card p-6 text-center bg-white rounded shadow hover:shadow-lg self-center min-h-fit">
            <h2 class="text-2xl font-semibold text-orange-600">Versions</h2>
            <p class="mb-3 text-gray-500 dark:text-gray-400">Track and Control Package Versions</p>
          </a>
        </div>
</div>
<!-- Authors table -->
<div class="hidden mt-14 authors_table h-screen sm:ml-64 overflow-x-auto shadow-md sm:rounded-lg">
   
 <h2 class="text-5xl font-bold ml-4 mb-5 dark:text-white">Authors Table</h2>

        <table class="w-full text-sm text-left rtl:text-center text-gray-500 dark:text-gray-400">
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
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Delet</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM auteurs";
                $result = $conn->query(query: $sql);
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
                        $row[Author_name]
                    </td>
                    <td class='px-6 py-4'>
                        $row[bio]
                    </td>
                                   <td class='px-2 py-4 text-right'>
                        <a href='#' class='font-medium text-blue-600 dark:text-blue-500 hover:underline'>Edit</a>
                    </td>
                    <td class='px-2 py-4 text-right'>
                        <a href='src\controllers\authorController.php?id=" . $row['id'] . "'  class='font-medium text-red-600 dark:text-red-500 hover:underline'>delet</a>
                    </td>
                </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
<!-- Packages table -->
<div class="hidden mt-14 packages_table h-screen sm:ml-64 overflow-x-auto shadow-md sm:rounded-lg">
<h2 class="text-5xl font-bold ml-4 mb-5 dark:text-white">Packages Table</h2>
        <table class="w-full text-sm text-left rtl:text-center text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3">
                    Author name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                 $sql = "
                 SELECT 
                     packages.id,
                     packages.package_name,
                     packages.pack_description,
                     packages.created_at,
                     auteurs.Author_name
                 FROM 
                     packages
                 INNER JOIN 
                     auteurs ON packages.auteurs_id = auteurs.id
             ";
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
                      
                        $row[package_name]
                    </td>
                    <td class='px-6 py-4'>
                        $row[pack_description]
                    </td>
                    <td class='px-6 py-4'>
                        $row[created_at]
                    </td>
                    <td class='px-6 py-4'>
                        $row[Author_name]
                    </td>
                                  <td class='px-2 py-4 text-right'>
                        <a href='#' class='font-medium text-blue-600 dark:text-blue-500 hover:underline'>Edit</a>
                    </td>
                    <td class='px-2 py-4 text-right'>
                        <a href='./src/controllers/packageController.php?id=" . $row['id'] . "' class='font-medium text-red-600 dark:text-red-500 hover:underline'>delet</a>
                    </td>
                </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
<!-- Versions table -->
<div class="hidden mt-14 versions_table h-screen sm:ml-64 overflow-x-auto shadow-md sm:rounded-lg">
<h2 class="text-5xl font-bold ml-4 mb-5 dark:text-white">Versions Table</h2>
        <table class="w-full text-sm text-left rtl:text-center text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                     Version number
                    </th>
                    <th scope="col" class="px-6 py-3">
                     Release date
                    </th>
                    <th scope="col" class="px-6 py-3">
                     Package Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">delet</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
           $sql = "
           SELECT 
               versions.id,
               versions.version_number,
               versions.release_date,
               packages.package_name
           FROM 
               versions
           INNER JOIN 
               packages ON versions.package_id = packages.id
       ";
       $result = $conn->query($sql);
       
                if (!$result) {
                    die("Invalid query:" . $conn->error);
                }
                //read data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "
                     <tr
                    class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>
                    <td class='px-6 py-4'>
                        $row[version_number]
                    </td>
                    <td class='px-6 py-4'>
                        $row[release_date]
                    </td>
                    <td class='px-6 py-4'>
                        $row[package_name]
                    </td>
                    <td class='px-2 py-4 text-right'>
                        <a href='#' class='font-medium text-blue-600 dark:text-blue-500 hover:underline'>Edit</a>
                    </td>
                    <td class='px-2 py-4 text-right'>
                        <a href='./src/controllers/versionController.php?id=" . $row['id'] . "' class='font-medium text-red-600 dark:text-red-500 hover:underline'>delet</a>
                    </td>
                </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>

<!-- script -->
    <script>
      const versions = document.getElementById('versions');
      const packages = document.getElementById('packages');
      const authors = document.getElementById('authors');

      const addPackage = document.getElementById('addPackage');
      const addAuthor = document.getElementById('addAuthor');
      const addVersion = document.getElementById('addVersion');

      const menu = document.getElementById('menu');
      const sidebar = document.getElementById('logo-sidebar');

      const authorsTable = document.querySelector('.authors_table');
      const packagesTable = document.querySelector('.packages_table');
      const versionsTable = document.querySelector('.versions_table');
      const controllCards = document.querySelector('.controll_cards');

      const authorModal = document.querySelector('.addAuthor-modal');
      const packageModal = document.querySelector('.Addpackage-modal');
      const versionModal = document.querySelector('.Addversion-modal');

      authors.addEventListener('click',()=> {
             authorsTable.classList.toggle('hidden');
             controllCards.classList.toggle('hidden');
             addAuthor.classList.toggle('hidden');
      })
      packages.addEventListener('click',()=> {
             packagesTable.classList.toggle('hidden');
             controllCards.classList.toggle('hidden');
             addPackage.classList.toggle('hidden');
      })
      versions.addEventListener('click',()=> {
             versionsTable.classList.toggle('hidden');
             controllCards.classList.toggle('hidden');
             addVersion.classList.toggle('hidden');
      })
      addAuthor.addEventListener('click',()=> {
             authorModal.classList.toggle('hidden');
             authorsTable.classList.add('hidden');
             controllCards.classList.add('hidden');
      })
      addPackage.addEventListener('click',()=> {
             packageModal.classList.toggle('hidden');
             packagesTable.classList.add('hidden');
             controllCards.classList.add('hidden');
      })
      addVersion.addEventListener('click',()=> {
             versionModal.classList.toggle('hidden');
             versionsTable.classList.add('hidden');
             controllCards.classList.add('hidden');
      })
      menu.addEventListener('click',()=> {
        console.log("hhbd");
        sidebar.classList.toggle('sm:translate-x-0');
        sidebar.classList.toggle('-translate-x-full');
      })
    </script>
</body>
</html>

<?php
require_once 'database/config.php';
require_once 'src\models\Package.php';
require_once 'src\models\version.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'author') {
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
    <title>Author Dashboard</title>
</head>
<body>

<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <a href="https://flowbite.com" class="flex ms-2 md:me-24">
         
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Author Dashboard</span>
        </a>
      </div>
      <div class="flex items-center">
          <div class="flex items-center ms-3">
            <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
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
            <a href="author-dashboard.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
               </svg>
               <span class="ms-3">Home</span>
            </a>
         </li>
         <li>
            <a href="index.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                  <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Roles</span>
            </a>
         </li>
         <li id="addPackage" class="hidden">
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="currentColor" class="size-6  text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" " >
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
</svg>

               <span class="flex-1 ms-3 whitespace-nowrap"> Add Package</span>
            </a>
         </li>
         <li id="addVersion" class="hidden">
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="currentColor" class="size-6  text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" " >
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
</svg>

               <span class="flex-1 ms-3 whitespace-nowrap"> Add Version</span>
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
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
    <div class="grid grid-cols-1 gap-14  px-4 py-10 h-full">
          <a href="#" id="authors" class="card p-6 text-center bg-white rounded shadow hover:shadow-lg self-center min-h-fit">
            <h2 class="text-2xl font-semibold text-blue-600">Authors</h2>
            <p class="mb-3 text-gray-500 dark:text-gray-400">explore the authors</p>
          </a>
          <a href="#" id="packages" class="card p-6 text-center bg-white rounded shadow hover:shadow-lg self-center min-h-fit">
            <h2 class="text-2xl font-semibold text-blue-600">Packages</h2>
            <p class="mb-3 text-gray-500 dark:text-gray-400">Explore and Customize Packages</p>
          </a>
          <a href="#" id="versions" class="card p-6 text-center bg-white rounded shadow hover:shadow-lg self-center min-h-fit">
            <h2 class="text-2xl font-semibold text-blue-600">Versions</h2>
            <p class="mb-3 text-gray-500 dark:text-gray-400">Track and Control Package Versions</p>
          </a>
        </div>
</div>
<!-- Authors table -->
<div class="hidden mt-14 authors_table h-screen sm:ml-64 overflow-x-auto shadow-md sm:rounded-lg">
   
 <h2 class="text-5xl font-bold ml-4 mb-5 dark:text-white">Authors Table</h2>

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
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Delet</span>
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
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                        Authors_Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM packages";
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
                      
                        $row[name]
                    </td>
                    <td class='px-6 py-4'>
                        $row[description]
                    </td>
                    <td class='px-6 py-4'>
                        $row[created_at]
                    </td>
                    <td class='px-6 py-4'>
                        $row[auteurs_id]
                    </td>
                                  <td class='px-2 py-4 text-right'>
                        <a href='#' class='font-medium text-blue-600 dark:text-blue-500 hover:underline'>Edit</a>
                    </td>
                    <td class='px-2 py-4 text-right'>
                        <a href='#' class='font-medium text-red-600 dark:text-red-500 hover:underline'>delet</a>
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
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                     ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                     Version_number
                    </th>
                    <th scope="col" class="px-6 py-3">
                     Release_date
                    </th>
                    <th scope="col" class="px-6 py-3">
                     Package_id
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
                $sql = "SELECT * FROM versions";
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
                      
                        $row[version_number]
                    </td>
                    <td class='px-6 py-4'>
                        $row[release_date]
                    </td>
                    <td class='px-6 py-4'>
                        $row[package_id]
                    </td>
                    <td class='px-2 py-4 text-right'>
                        <a href='#' class='font-medium text-blue-600 dark:text-blue-500 hover:underline'>Edit</a>
                    </td>
                    <td class='px-2 py-4 text-right'>
                        <a href='#' class='font-medium text-red-600 dark:text-red-500 hover:underline'>delet</a>
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

      const authorsTable = document.querySelector('.authors_table');
      const packagesTable = document.querySelector('.packages_table');
      const versionsTable = document.querySelector('.versions_table');
      const controllCards = document.querySelector('.controll_cards');

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
    </script>
</body>
</html>


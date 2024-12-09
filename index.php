<?php
require_once 'database/config.php';
require_once 'process-login.php';
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
<body class="h-screen flex flex-col justify-between">
<div class="container mx-auto h-full ">
        <!-- Welcome Section -->
        <div class="text-center py-8 bg-blue-50">
          <h1 class="text-4xl font-bold text-blue-700">Welcome to the Package Management System</h1>
          <p class="mt-2 text-lg text-gray-600">Please select your roll.</p>
        </div>

        <!-- Navigation Cards -->
        <div class="grid grid-cols-1 gap-4 px-4 py-8 md:grid-cols-3 md:h-1/2">
          <a href="#" class="card p-6 text-center bg-white rounded shadow hover:shadow-lg self-center min-h-fit h-1/2">
            <h2 class="text-2xl font-semibold text-blue-600">Author</h2>
          </a>
          <a href="#" class="card p-6 text-center bg-white rounded shadow hover:shadow-lg self-center min-h-fit h-1/2">
            <h2 class="text-2xl font-semibold text-blue-600">Admin</h2>
          </a>
          <a href="#" class="card p-6 text-center bg-white rounded shadow hover:shadow-lg self-center min-h-fit h-1/2">
            <h2 class="text-2xl font-semibold text-blue-600">User</h2>
          </a>
        </div>
      </div>
      
      <!-- form container -->
      <section id="modal" class="bg-gray-50 dark:bg-gray-900 hidden left-0 top-0 h-screen w-full">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
          Access to your dashboard    
      </a>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Sign in to your account
              </h1>
              <!-- form -->
              <form class="space-y-4 md:space-y-6" action="process-login.php" method="POST">
                  <div>
                      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User name</label>
                      <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username" required="">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <div class="flex items-center justify-between">
                      <div class="flex items-start">
                          <div class="flex items-center h-5">
                            <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                          </div>
                          <div class="ml-3 text-sm">
                            <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                          </div>
                      </div>
                      <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
                  </div>
                  <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>
                 
              </form>
          </div>
      </div>
  </div>
</section>

<!-- script JS-->
<script>
  const cards =document.querySelectorAll(".card");
  const modal =document.getElementById("modal");
  cards.forEach(card => {
        card.addEventListener('click',()=>{
          console.log("hhhhhh");
          
          modal.classList.toggle('hidden');
          modal.classList.toggle('absolute');
        })
  })
</script>
      <footer class="py-4 bg-gray-800 text-gray-400">
        <p class="text-center">© 2024 Package Management System. All Rights Reserved.</p>
      </footer>
</body>
</html>
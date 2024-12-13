<?php
require_once 'database/config.php';
require_once 'process-login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src\output.css">
    <title>Pack Man</title>
</head>
<body class="h-screen flex flex-col justify-between">
<div class="container mx-auto h-full " >
        <!-- Welcome Section -->
        <div class="text-center py-8 bg-gray-100">
          <h1 class="text-4xl font-bold text-black">Welcome to <span class="text-orange-600">Pack Man</span>  System</h1>
          <p class="mt-2 text-lg text-gray-600">Please select your role.</p>
        </div>

        <!-- Navigation Cards -->
        <div class="grid grid-cols-1 gap-4 px-4 py-8 md:grid-cols-3 md:h-1/2">
          <a href="#" class="card p-1 text-center rounded-md bg-gradient-to-tr from-orange-600 to-red-600 shadow hover:shadow-xl self-center min-h-fit ">
          <div class="w-full h-full rounded-md bg-white flex items-center justify-center">
          <h2 class="text-2xl font-bold text-transparent bg-gradient-to-tr from-orange-600 to-red-600 bg-clip-text p-7">Author</h2>
          </div>
          </a>
          <a href="#" class="card p-1 text-center rounded-md bg-gradient-to-tr from-red-600 to-gray-600  shadow hover:shadow-xl self-center min-h-fit ">
          <div class="w-full h-full rounded-md bg-white flex items-center justify-center">
          <h2 class="text-2xl font-bold text-transparent bg-gradient-to-tr from-red-600 to-gray-600 bg-clip-text p-7">Admin</h2>
          </div>
          </a>
          <a href="#" class="card p-1 text-center rounded-md bg-gradient-to-tr from-orange-600 to-red-600 shadow hover:shadow-xl self-center min-h-fit ">
          <div class="w-full h-full rounded-md bg-white flex items-center justify-center">
          <h2 class="text-2xl font-bold text-transparent bg-gradient-to-tr from-orange-600 to-red-600 bg-clip-text p-7">User</h2>
          </div>
          </a>
        </div>
      </div>
      <section id="modal" style="background-image: url('src/imges/cool-background.png'); background-position:center; background-size: cover;" class=" hidden left-0 top-0 h-screen w-full">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-4xl font-bold text-gray-900 dark:text-white">
          Access to your Dashboard    
      </a>
      <div class="w-full bg-transparent shadow-[0_3px_10px_rgb(0,0,0,0.2)] rounded-lg  dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-transparent bg-gradient-to-tr from-black to-blue-600 bg-clip-text md:text-2xl dark:text-white">
                  Sign in to your account
              </h1>
              <form class="space-y-4 md:space-y-6" action="process-login.php" method="POST">
                  <div>
                      <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User name</label>
                      <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="user name" required="">
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
                            <label for="remember" class="text-white dark:text-gray-300">Remember me</label>
                          </div>
                      </div>
                  </div>
                  <button type="submit" class="w-full text-white bg-gradient-to-tr from-orange-600 to-gray-600  border hover:bg-gradient-to-tr hover:from-red-600 hover:to-gray-600  font-bold rounded-lg text-sm px-5 py-2.5 text-center">Sign in</button>
                  <p class="text-sm font-light text-white dark:text-gray-400">
                      click <a href="index.php" class="font-medium text-black hover:underline ">here</a> to return back 
                  </p>
              </form>
          </div>
      </div>
  </div>
</section>
<script>
  const cards =document.querySelectorAll(".card");
  const modal =document.getElementById("modal");
  cards.forEach(card => {
        card.addEventListener('click',()=>{
          
          modal.classList.toggle('hidden');
          modal.classList.toggle('absolute');
        })
  })
</script>
      <footer class="py-4 bg-gradient-to-tr from-red-600 to-gray-600  text-white">
        <p class="text-center">© 2024 Pack Man System. All Rights Reserved.</p>
      </footer>
</body>
</html>
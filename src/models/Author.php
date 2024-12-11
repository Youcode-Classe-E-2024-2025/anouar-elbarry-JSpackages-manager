<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src\output.css">
    <title>add player</title>
</head>
<body>
<div class="addAuthor-modal  absolute z-10  h-full w-full  justify-center items-center overflow-y-auto hidden">


<!-- global information Section -->
<form id="AddAuthor_form" class="bg-cyan-950 w-3/6 h-4/5 overflow-y-auto rounded p-7">
<div class="space-y-12">

<!-- Section Title and Description -->
<div class="border-b border-gray-400/10 pb-12">
<h2 class="text-lg font-semibold text-gray-400">Author form</h2>
</div>

<!-- Player Information Form -->
<div class="mt-2 grid grid-cols-1 gap-x-3 gap-y-8 sm:grid-cols-6">

<!-- Name Input -->
<div class="sm:col-span-3">
  <label for="Playername" class="block text-sm font-medium text-gray-400">Name</label>
  <div class="mt-2 inputControl">
    <input type="text"  name="name"
      id="Playername"
      class="block w-full rounded-md  shadow-sm "
      >
      <div class="error"></div>
  </div>
</div>

<!-- Email Input -->
<div class="sm:col-span-3 sm:row-start-1">
  <label for="email" class="block text-sm font-medium text-gray-400">Email</label>
  <div class="mt-2 inputControl">
    <input type="email" name="email" id="email"
      class="block w-full rounded-md  shadow-sm "
      >
      <div class="error"></div>
  </div>
</div>

<!-- bio Input -->
<div class="sm:col-span-3 sm:row-start-2">
  <label for="bio" class="block text-sm font-medium text-gray-400">Bio</label>
  <div class="mt-2 inputControl">
  <textarea name="bio" id="bio" class="block w-full rounded-md  shadow-sm ">

  </textarea>
      <div class="error"></div>
  </div>
</div>
</div>  
</div>
</form>
</div>      
</body>
</html>
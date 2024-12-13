<div class="hidden mt-14 addAuthor-modal h-screen sm:ml-64 overflow-x-auto shadow-md sm:rounded-lg px-8">
        <h2 class="text-2xl font-bold mb-4">Author Information</h2>
        <form action="./../src/controllers/authorController.php" method="POST">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="bio" class="block text-gray-700 font-medium mb-2">Biography</label>
                <textarea id="bio" name="bio" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Submit</button>
            </div>
        </form>
    </div>    
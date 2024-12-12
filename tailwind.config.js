/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js}","./index.php","src/models/Author.php","src/models/Package.php","src/models/version.php",
    "src/viewsa/ddVersion.html","src/views/addPackage.html","src/views/addAuthor.html","src/public/scripts.js","admin-dashboard.php","author-dashboard.php","user-dashboard.php"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}


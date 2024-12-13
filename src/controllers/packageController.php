<?php 
require_once './../../database/config.php';

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../src/output.css">
    <title>add</title>
</head>
<body class="flex justify-center items-center">

<div
  id="success-modal"
  class="fixed inset-0 z-[60] flex items-center justify-center bg-black/50"
>
  <div
    class="bg-white rounded-2xl p-6 w-full max-w-sm transform translate-y-0 opacity-100 transition-all duration-500"
  >
    <div class="flex items-center justify-between pb-4 border-b border-gray-200">
      <h4 class="text-lg font-medium text-gray-900">Message</h4>
      <button
        class="text-gray-500 hover:text-gray-700 focus:outline-none"
        onclick="document.getElementById('success-modal').remove();"
      >
        <svg
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M7.75732 7.75739L16.2426 16.2427M16.2426 7.75739L7.75732 16.2427"
            stroke="black"
            stroke-width="1.6"
            stroke-linecap="round"
          ></path>
        </svg>
      </button>
    </div>
    <div class="py-4 text-center">
      <p class="text-gray-600 text-sm">
      <?php 
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); 
    
        try {
            // Delete the author (with cascading effect configured in database schema)
            $stmt = $conn->prepare("DELETE FROM `packages` WHERE `id` = ?");
            $stmt->bind_param("i", $id);
    
            if ($stmt->execute()) {
                echo " the package and related versions, have been deleted successfully.";
            } else {
                echo "Failed to delete package: " . $conn->error;
            }
            
            $stmt->close();
    
        } catch (mysqli_sql_exception $e) {
            echo "Database error: " . $e->getMessage();
        }
    }
    
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $name = $_POST['name'];
        $bio = $_POST['bio'];
        $date = $_POST['date'];
        $Authorname = $_POST['Authorname'];
    
        // Validate and sanitize data
        $name = $conn->real_escape_string(trim($name));
        $bio = $conn->real_escape_string(trim($bio));
        $date = $conn->real_escape_string(trim($date));
        $Authorname = $conn->real_escape_string(trim($Authorname));
    
        // Fetch the author's ID based on the provided name
        $sql = "SELECT id FROM auteurs WHERE Author_name = '$Authorname'";
        $resultId = $conn->query($sql);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        if ($resultId->num_rows > 0) {
            // Author exists, fetch the ID
            $row = $resultId->fetch_assoc();
            $authorId = $row['id'];
    
            // Insert data into the table
            $insertSql = "INSERT INTO packages (package_name, pack_description, created_at, auteurs_id) 
                          VALUES ('$name', '$bio', '$date', $authorId)";
           if ($conn->query($insertSql) === TRUE) {
        echo "Package added successfully!";
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
        } 
    }
      ?>
      </p>

    </div>
    <div class="flex justify-end pt-4 border-t border-gray-200">
    <a href="./../../dashboards/admin-dashboard.php">
        <button
        class="py-2 px-4 text-xs bg-orange-500 text-white rounded-full cursor-pointer font-semibold text-center shadow-sm transition-all duration-300 hover:bg-orange-700"
        onclick="document.getElementById('success-modal').remove();"
      >
        go to Dashboard
      </button>
        </a>
      
    </div>
  </div>
</div>

</body>
</html>
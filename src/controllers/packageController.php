<?php 
// require_once './../../database/config.php';
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

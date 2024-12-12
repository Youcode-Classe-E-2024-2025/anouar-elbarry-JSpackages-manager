<?php 
session_start();
require_once './../../database/config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    try {
        // Delete the author (with cascading effect configured in database schema)
        $stmt = $conn->prepare("DELETE FROM `auteurs` WHERE `id` = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Author, their packages, and versions have been deleted successfully.";
        } else {
            echo "Failed to delete author: " . $conn->error;
        }
        
        $stmt->close();

    } catch (mysqli_sql_exception $e) {
        echo "Database error: " . $e->getMessage();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];

    // Validate and sanitize data
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $bio = $conn->real_escape_string($bio);

    // Insert data into the existing table
    $sql = "INSERT INTO auteurs (Author_name,email,bio) VALUES ('$name', '$email','$bio')";
    if ($conn->query($sql) === TRUE) {
        echo "Author added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

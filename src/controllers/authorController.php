<?php 
session_start();
require_once './../../database/config.php';
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

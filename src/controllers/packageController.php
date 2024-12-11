<?php 
session_start();
require_once './../../database/config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $date = $_POST['date'];
    $Authorname = $_POST['Authorname'];

    // Validate and sanitize data
    $name = $conn->real_escape_string($name);
    $bio = $conn->real_escape_string($bio);
    $date = $conn->real_escape_string($date);
    $Authorname = $conn->real_escape_string($Authorname);

    // Insert data into the existing table
    $sql = "INSERT INTO auteurs (Author_name,email,bio) VALUES ('$name', '$bio', '$date','$Authorname')";
}

?>

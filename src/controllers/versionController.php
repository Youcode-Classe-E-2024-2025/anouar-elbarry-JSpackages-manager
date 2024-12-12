<?php 
require_once './../../database/config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $verNumber = $_POST['Version_number'];
    $releaseDate = $_POST['Release_date'];
    $packname = $_POST['package_name'];

    // Validate and sanitize data
    $verNumber = $conn->real_escape_string(trim($verNumber));
    $releaseDate = $conn->real_escape_string(trim($releaseDate));
    $packname = $conn->real_escape_string(trim($packname));

    // Fetch the author's ID based on the provided name
    $sql = "SELECT id FROM packages WHERE package_name = '$packname'";
    $resultId = $conn->query($sql);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($resultId->num_rows > 0) {
        // Author exists, fetch the ID
        $row = $resultId->fetch_assoc();
        $packId = $row['id'];

        // Insert data into the table
        $insertSql = "INSERT INTO versions (Version_number, release_date, package_id) 
                      VALUES ('$verNumber', '$releaseDate', '$packId')";
       if ($conn->query($insertSql) === TRUE) {
    echo "Version added successfully!";
} else {
    echo "Error: " . $insertSql . "<br>" . $conn->error;
}
    } 
}
?>

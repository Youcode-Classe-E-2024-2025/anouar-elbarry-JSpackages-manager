<?php
require_once 'database/config.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'author') {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome, author!</h1>
    <p>Here is your author panel.</p>
</body>
</html>

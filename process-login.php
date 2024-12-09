<?php
session_start();
require_once 'database/config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the query to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    // Compare plain-text password
    if ($user && $password === $user['password']) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role']
        ];

        switch ($user['role']) {
            case 'admin':
                header('Location: admin-dashboard.php');
                break;
            case 'author':
                header('Location: author-dashboard.php');
                break;
            case 'user':
                header('Location: user-dashboard.php');
                break;
        }
        exit;
    } else {
        echo "Invalid credentials!";
    }
}
?>

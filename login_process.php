<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Simple authentication (replace with database authentication in production)
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit();
    } else {
        $_SESSION['error'] = 'Invalid credentials';
        header('Location: index.php');
        exit();
    }
}

header('Location: index.php');
exit();
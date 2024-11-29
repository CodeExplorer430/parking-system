<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'] ?? 'sticker';
    $plate_number = $_POST['plate_number'] ?? '';
    $vehicle_type = $_POST['vehicle_type'] ?? '';

    // Here you would typically save to a database
    // For now, we'll just redirect back with a success message
    $_SESSION['success'] = 'Vehicle saved successfully';
    header("Location: parking.php?type=$type");
    exit();
}

header('Location: dashboard.php');
exit();
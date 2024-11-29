<?php
session_start();
require_once 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

// Get parking statistics
$stmt = $pdo->query("SELECT 
    COUNT(*) as total_vehicles,
    SUM(CASE WHEN has_sticker = 1 THEN 1 ELSE 0 END) as sticker_vehicles,
    SUM(CASE WHEN has_sticker = 0 THEN 1 ELSE 0 END) as visitor_vehicles
    FROM vehicles WHERE status = 'parked'");
$stats = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Parking System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            background-image: url('assets/images/parking-bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }
        .modal-content {
            background: white;
            margin: 15% auto;
            padding: 20px;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
        }
    </style>
</head>
<body class="min-h-screen p-4">
    <div class="max-w-7xl mx-auto space-y-6">
        <?php include 'components/dashboard/Header.php'; ?>
        <?php include 'components/dashboard/Statistics.php'; ?>
        <?php include 'components/dashboard/MainActions.php'; ?>
        <?php include 'components/dashboard/TimeOutActions.php'; ?>
        <?php include 'components/dashboard/Modals.php'; ?>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Modal functions
        function showModal(type) {
            document.getElementById(type + 'Modal').style.display = 'block';
        }

        function hideModal(type) {
            document.getElementById(type + 'Modal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }
    </script>
</body>
</html>
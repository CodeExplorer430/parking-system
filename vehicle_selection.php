<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

$type = $_GET['type'] ?? 'guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Vehicle Type - Parking System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
    </style>
</head>
<body class="min-h-screen p-4">
    <div class="max-w-7xl mx-auto">
        <div class="mb-6 flex justify-between items-center">
            <a href="dashboard.php" class="text-gray-600 hover:text-gray-800">
                ← Back to Dashboard
            </a>
        </div>

        <?php if ($type === 'sticker'): ?>
        <!-- Sticker Number Entry -->
        <div class="glass-panel p-6 rounded-lg shadow-lg max-w-md mx-auto">
            <h2 class="text-2xl font-bold mb-4">Enter Sticker Number</h2>
            <form action="register_vehicle.php" method="POST">
                <input type="hidden" name="type" value="sticker">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Sticker Number</label>
                    <input type="text" name="sticker_number" required class="w-full p-2 border rounded">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Continue
                </button>
            </form>
        </div>
        <?php else: ?>
        <!-- Vehicle Type Selection -->
        <div class="glass-panel p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-center">Select Vehicle Type</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <a href="register_vehicle.php?type=guest&vehicle_type=2wheels" class="block">
                    <div class="aspect-square rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                        <img src="assets/images/2wheels.jpg" alt="2 Wheels" class="w-full h-full object-cover">
                        <div class="p-2 text-center bg-white">
                            <span class="font-medium">2 Wheels</span>
                        </div>
                    </div>
                </a>
                
                <a href="register_vehicle.php?type=guest&vehicle_type=3wheels" class="block">
                    <div class="aspect-square rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                        <img src="assets/images/3wheels.jpg" alt="3 Wheels" class="w-full h-full object-cover">
                        <div class="p-2 text-center bg-white">
                            <span class="font-medium">3 Wheels</span>
                        </div>
                    </div>
                </a>
                
                <a href="register_vehicle.php?type=guest&vehicle_type=4wheels" class="block">
                    <div class="aspect-square rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                        <img src="assets/images/4wheels.jpg" alt="4 Wheels" class="w-full h-full object-cover">
                        <div class="p-2 text-center bg-white">
                            <span class="font-medium">4 Wheels</span>
                        </div>
                    </div>
                </a>
                
                <a href="register_vehicle.php?type=guest&vehicle_type=6wheels" class="block">
                    <div class="aspect-square rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                        <img src="assets/images/6wheels.jpg" alt="6+ Wheels" class="w-full h-full object-cover">
                        <div class="p-2 text-center bg-white">
                            <span class="font-medium">6+ Wheels</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
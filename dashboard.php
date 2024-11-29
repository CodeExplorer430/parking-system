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
        <!-- Navigation -->
        <nav class="glass-panel rounded-lg shadow-lg p-4 mb-6 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <img src="assets/images/logo.png" alt="Parking System Logo" class="h-10">
                <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
            </div>
            <a href="logout.php" class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-800">
                <i data-lucide="log-out" class="w-4 h-4"></i>
                Logout
            </a>
        </nav>

        <!-- Statistics Cards -->
        <div class="grid md:grid-cols-3 gap-4 mb-6">
            <div class="glass-panel p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">Total Vehicles</h3>
                <p class="text-2xl font-bold text-blue-600"><?php echo $stats['total_vehicles']; ?></p>
            </div>
            <div class="glass-panel p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">With Sticker</h3>
                <p class="text-2xl font-bold text-green-600"><?php echo $stats['sticker_vehicles']; ?></p>
            </div>
            <div class="glass-panel p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">Visitors</h3>
                <p class="text-2xl font-bold text-purple-600"><?php echo $stats['visitor_vehicles']; ?></p>
            </div>
        </div>

        <!-- Main Actions -->
        <div class="grid md:grid-cols-2 gap-4 mb-6">
            <div class="glass-panel p-6 rounded-lg shadow-md cursor-pointer hover:shadow-lg transition-shadow"
                 onclick="window.location.href='vehicle_selection.php?type=sticker'">
                <div class="flex items-center gap-4">
                    <i data-lucide="car" class="w-8 h-8 text-blue-600"></i>
                    <div>
                        <h2 class="text-xl font-semibold">With Sticker</h2>
                        <p class="text-sm text-gray-500">Manage vehicles with parking stickers</p>
                    </div>
                </div>
            </div>

            <div class="glass-panel p-6 rounded-lg shadow-md cursor-pointer hover:shadow-lg transition-shadow"
                 onclick="window.location.href='vehicle_selection.php?type=guest'">
                <div class="flex items-center gap-4">
                    <i data-lucide="car" class="w-8 h-8 text-blue-600"></i>
                    <div>
                        <h2 class="text-xl font-semibold">Without Sticker</h2>
                        <p class="text-sm text-gray-500">Manage visitor vehicles</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Time Out Actions -->
        <div class="grid md:grid-cols-3 gap-4">
            <div class="glass-panel p-6 rounded-lg shadow-md cursor-pointer hover:shadow-lg transition-shadow bg-red-500 text-white"
                 onclick="showModal('guestOut')">
                <div class="flex items-center gap-4">
                    <i data-lucide="log-out" class="w-8 h-8"></i>
                    <div>
                        <h2 class="text-xl font-semibold">Guest Out</h2>
                        <p class="text-sm opacity-80">Time out guest vehicle</p>
                    </div>
                </div>
            </div>

            <div class="glass-panel p-6 rounded-lg shadow-md cursor-pointer hover:shadow-lg transition-shadow bg-red-500 text-white"
                 onclick="showModal('vipOut')">
                <div class="flex items-center gap-4">
                    <i data-lucide="star" class="w-8 h-8"></i>
                    <div>
                        <h2 class="text-xl font-semibold">VIP Out</h2>
                        <p class="text-sm opacity-80">Time out VIP vehicle</p>
                    </div>
                </div>
            </div>

            <div class="glass-panel p-6 rounded-lg shadow-md cursor-pointer hover:shadow-lg transition-shadow bg-red-500 text-white"
                 onclick="showModal('stickerOut')">
                <div class="flex items-center gap-4">
                    <i data-lucide="ticket" class="w-8 h-8"></i>
                    <div>
                        <h2 class="text-xl font-semibold">Sticker Out</h2>
                        <p class="text-sm opacity-80">Time out sticker vehicle</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div id="guestOutModal" class="modal">
        <div class="modal-content">
            <h2 class="text-xl font-bold mb-4">Guest Vehicle Time Out</h2>
            <form action="time_out.php" method="POST">
                <input type="hidden" name="type" value="guest">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Reference Number</label>
                    <input type="text" name="reference_number" required class="w-full p-2 border rounded">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="hideModal('guestOut')" class="px-4 py-2 bg-gray-200 rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Time Out</button>
                </div>
            </form>
        </div>
    </div>

    <div id="vipOutModal" class="modal">
        <div class="modal-content">
            <h2 class="text-xl font-bold mb-4">VIP Vehicle Time Out</h2>
            <form action="time_out.php" method="POST">
                <input type="hidden" name="type" value="vip">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">VIP Number</label>
                    <input type="text" name="vip_number" required class="w-full p-2 border rounded">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="hideModal('vipOut')" class="px-4 py-2 bg-gray-200 rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Time Out</button>
                </div>
            </form>
        </div>
    </div>

    <div id="stickerOutModal" class="modal">
        <div class="modal-content">
            <h2 class="text-xl font-bold mb-4">Sticker Vehicle Time Out</h2>
            <form action="time_out.php" method="POST">
                <input type="hidden" name="type" value="sticker">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Sticker Number</label>
                    <input type="text" name="sticker_number" required class="w-full p-2 border rounded">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="hideModal('stickerOut')" class="px-4 py-2 bg-gray-200 rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Time Out</button>
                </div>
            </form>
        </div>
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
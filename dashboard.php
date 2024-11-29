<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Parking System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 p-4">
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold">Dashboard</h1>
            <a href="logout.php" class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-800">
                <i data-lucide="log-out" class="w-4 h-4"></i>
                Logout
            </a>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="p-6 bg-white rounded-lg shadow-md cursor-pointer hover:shadow-lg transition-shadow"
                 onclick="window.location.href='parking.php?type=sticker'">
                <div class="flex items-center gap-4">
                    <i data-lucide="car" class="w-8 h-8 text-blue-600"></i>
                    <div>
                        <h2 class="text-xl font-semibold">With Sticker</h2>
                        <p class="text-sm text-gray-500">Manage vehicles with parking stickers</p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white rounded-lg shadow-md cursor-pointer hover:shadow-lg transition-shadow"
                 onclick="window.location.href='parking.php?type=no-sticker'">
                <div class="flex items-center gap-4">
                    <i data-lucide="car" class="w-8 h-8 text-blue-600"></i>
                    <div>
                        <h2 class="text-xl font-semibold">Without Sticker</h2>
                        <p class="text-sm text-gray-500">Manage visitor vehicles</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>
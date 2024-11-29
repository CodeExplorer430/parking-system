<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

$type = $_GET['type'] ?? 'sticker';
$title = $type === 'sticker' ? 'Vehicles with Sticker' : 'Visitor Vehicles';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - Parking System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 p-4">
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold"><?php echo $title; ?></h1>
            <a href="dashboard.php" class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-800">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Dashboard
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="save_vehicle.php" method="POST" class="space-y-4">
                <input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">
                
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Plate Number</label>
                        <input type="text" name="plate_number" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Vehicle Type</label>
                        <select name="vehicle_type" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="car">Car</option>
                            <option value="motorcycle">Motorcycle</option>
                            <option value="truck">Truck</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                            class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
                        Save Vehicle
                    </button>
                </div>
            </form>
        </div>

        <!-- Parking slots would be displayed here -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Available Parking Slots</h2>
            <div class="grid grid-cols-5 gap-4">
                <?php for($i = 1; $i <= 10; $i++): ?>
                    <div class="aspect-square bg-green-100 rounded-lg flex items-center justify-center">
                        <span class="text-green-800 font-medium">Slot <?php echo $i; ?></span>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>
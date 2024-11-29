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
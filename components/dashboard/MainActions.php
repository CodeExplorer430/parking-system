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
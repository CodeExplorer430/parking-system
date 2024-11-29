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
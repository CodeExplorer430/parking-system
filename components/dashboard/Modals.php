<!-- Guest Out Modal -->
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

<!-- VIP Out Modal -->
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

<!-- Sticker Out Modal -->
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
<?php
require_once 'includes/header.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: pages/dashboard.php');
    exit();
}
?>

<div class="min-h-screen flex items-center justify-center">
    <div class="glass-panel p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Parking System Login</h1>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <form action="login_process.php" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       id="username" name="username" type="text" required>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                       id="password" name="password" type="password" required>
            </div>
            
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full"
                        type="submit">
                    Sign In
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
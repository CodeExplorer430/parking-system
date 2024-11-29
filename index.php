<?php
session_start();

// Redirect to dashboard if already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking System - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-50 p-4">
    <div class="w-full max-w-md p-6 space-y-6 bg-white rounded-lg shadow-md">
        <div class="space-y-2 text-center">
            <h1 class="text-3xl font-bold tracking-tight">Parking System</h1>
            <p class="text-sm text-gray-500">Enter your credentials to continue</p>
        </div>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="login_process.php" method="POST" class="space-y-4">
            <div class="space-y-2">
                <input type="text" 
                       name="username" 
                       placeholder="Username" 
                       required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div class="space-y-2">
                <input type="password" 
                       name="password" 
                       placeholder="Password" 
                       required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <button type="submit" 
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
                Login
            </button>
        </form>
    </div>
</body>
</html>
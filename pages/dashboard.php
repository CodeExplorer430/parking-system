<?php
require_once '../includes/header.php';
require_once '../includes/db_connect.php';

// Get parking statistics
$stmt = $pdo->query("SELECT 
    COUNT(*) as total_vehicles,
    SUM(CASE WHEN has_sticker = 1 THEN 1 ELSE 0 END) as sticker_vehicles,
    SUM(CASE WHEN has_sticker = 0 THEN 1 ELSE 0 END) as visitor_vehicles
    FROM vehicles WHERE status = 'parked'");
$stats = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="max-w-7xl mx-auto space-y-6">
    <?php 
    include '../components/dashboard/Header.php';
    include '../components/dashboard/Statistics.php';
    include '../components/dashboard/MainActions.php';
    include '../components/dashboard/TimeOutActions.php';
    include '../components/dashboard/Modals.php';
    ?>
</div>

<?php require_once '../includes/footer.php'; ?>
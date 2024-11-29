<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];
    $where_clause = '';
    $params = [];
    
    switch ($type) {
        case 'guest':
            $where_clause = 'reference_number = ? AND has_sticker = 0';
            $params[] = $_POST['reference_number'];
            break;
        case 'vip':
            $where_clause = 'vip_number = ?';
            $params[] = $_POST['vip_number'];
            break;
        case 'sticker':
            $where_clause = 'sticker_number = ? AND has_sticker = 1';
            $params[] = $_POST['sticker_number'];
            break;
    }

    try {
        $pdo->beginTransaction();

        // Update vehicle status
        $stmt = $pdo->prepare("UPDATE vehicles SET status = 'left', exit_time = CURRENT_TIMESTAMP 
                              WHERE $where_clause AND status = 'parked'");
        $stmt->execute($params);

        if ($stmt->rowCount() > 0) {
            // Free up the parking slot
            $stmt = $pdo->prepare("UPDATE parking_slots SET is_occupied = 0, vehicle_id = NULL 
                                 WHERE vehicle_id IN (SELECT id FROM vehicles WHERE $where_clause)");
            $stmt->execute($params);
            
            $pdo->commit();
            $_SESSION['success'] = 'Vehicle successfully timed out';
        } else {
            $pdo->rollBack();
            $_SESSION['error'] = 'No matching vehicle found or already timed out';
        }
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = 'Error processing time out: ' . $e->getMessage();
    }
}

header('Location: dashboard.php');
exit();
<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'] ?? 'sticker';
    $plate_number = $_POST['plate_number'] ?? '';
    $vehicle_type = $_POST['vehicle_type'] ?? '';
    $has_sticker = $type === 'sticker' ? 1 : 0;

    try {
        // Find first available parking slot
        $stmt = $pdo->query("SELECT id, slot_number FROM parking_slots WHERE is_occupied = 0 LIMIT 1");
        $slot = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$slot) {
            $_SESSION['error'] = 'No available parking slots';
            header("Location: parking.php?type=$type");
            exit();
        }

        // Begin transaction
        $pdo->beginTransaction();

        // Insert vehicle
        $stmt = $pdo->prepare("INSERT INTO vehicles (plate_number, vehicle_type, has_sticker, slot_number) VALUES (?, ?, ?, ?)");
        $stmt->execute([$plate_number, $vehicle_type, $has_sticker, $slot['slot_number']]);
        $vehicle_id = $pdo->lastInsertId();

        // Update parking slot
        $stmt = $pdo->prepare("UPDATE parking_slots SET is_occupied = 1, vehicle_id = ? WHERE id = ?");
        $stmt->execute([$vehicle_id, $slot['id']]);

        $pdo->commit();
        $_SESSION['success'] = 'Vehicle successfully parked in slot ' . $slot['slot_number'];
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = 'Error saving vehicle: ' . $e->getMessage();
    }

    header("Location: parking.php?type=$type");
    exit();
}

header('Location: dashboard.php');
exit();
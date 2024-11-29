CREATE DATABASE IF NOT EXISTS parking_system;
USE parking_system;

CREATE TABLE IF NOT EXISTS vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plate_number VARCHAR(20) NOT NULL,
    vehicle_type ENUM('car', 'motorcycle', 'truck') NOT NULL,
    has_sticker BOOLEAN DEFAULT FALSE,
    entry_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    slot_number INT NOT NULL,
    status ENUM('parked', 'left') DEFAULT 'parked'
);

CREATE TABLE IF NOT EXISTS parking_slots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slot_number INT NOT NULL,
    is_occupied BOOLEAN DEFAULT FALSE,
    vehicle_id INT NULL,
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id)
);

-- Initialize parking slots (10 slots)
INSERT INTO parking_slots (slot_number, is_occupied)
SELECT number, FALSE FROM (
    SELECT 1 AS number UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5
    UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10
) numbers
WHERE number NOT IN (SELECT slot_number FROM parking_slots);
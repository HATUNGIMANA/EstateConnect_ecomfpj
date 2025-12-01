<?php
// controllers/agent_controller.php
// Provides helper functions for agent registration requests.
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../settings/connection.php';

function ensure_agent_table() {
    global $pdo;
    $sql = "CREATE TABLE IF NOT EXISTS agent_requests (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) DEFAULT NULL,
        phone VARCHAR(50) DEFAULT NULL,
        id_upload VARCHAR(1024) DEFAULT NULL,
        licence_upload VARCHAR(1024) DEFAULT NULL,
        status ENUM('pending','approved','rejected') DEFAULT 'pending',
        admin_notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    $pdo->exec($sql);
}

function add_agent_request($data) {
    global $pdo;
    ensure_agent_table();
    $stmt = $pdo->prepare('INSERT INTO agent_requests (full_name, email, phone, id_upload, licence_upload, status) VALUES (:fn, :email, :phone, :idu, :lic, :st)');
    $stmt->execute([
        ':fn' => $data['full_name'],
        ':email' => $data['email'] ?? null,
        ':phone' => $data['phone'] ?? null,
        ':idu' => $data['id_upload'] ?? null,
        ':lic' => $data['licence_upload'] ?? null,
        ':st' => 'pending'
    ]);
    return $pdo->lastInsertId();
}

function get_pending_agent_requests() {
    global $pdo;
    ensure_agent_table();
    $stmt = $pdo->query("SELECT * FROM agent_requests WHERE status = 'pending' ORDER BY created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function update_agent_status($id, $status, $admin_notes = null) {
    global $pdo;
    ensure_agent_table();
    $stmt = $pdo->prepare('UPDATE agent_requests SET status = :st, admin_notes = :notes WHERE id = :id');
    return $stmt->execute([':st' => $status, ':notes' => $admin_notes, ':id' => (int)$id]);
}

function get_all_agent_requests() {
    global $pdo;
    ensure_agent_table();
    $stmt = $pdo->query('SELECT * FROM agent_requests ORDER BY created_at DESC');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
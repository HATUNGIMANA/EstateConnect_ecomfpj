<?php
// actions/approve_agent.php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header('Location: ../login_Register/login.php');
    exit;
}
require_once __DIR__ . '/../controllers/agent_controller.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../admin/admin_dashboard.php');
    exit;
}
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$notes = trim($_POST['notes'] ?? '');
if ($id) {
    update_agent_status($id, 'approved', $notes);
}
header('Location: ../admin/admin_dashboard.php');
exit;
?>
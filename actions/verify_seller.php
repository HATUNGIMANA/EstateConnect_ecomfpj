<?php
// actions/verify_seller.php
// Admin action to approve a seller verification. Expects POST with seller_id and admin session.

if (session_status() === PHP_SESSION_NONE) session_start();

// Simple admin check
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header('Location: ../login_Register/login.php');
    exit;
}

require_once __DIR__ . '/../settings/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../admin/admin_dashboard.php');
    exit;
}

$seller_id = intval($_POST['seller_id'] ?? 0);
if ($seller_id <= 0) {
    header('Location: ../admin/admin_dashboard.php?msg=invalid');
    exit;
}

$stmt = $pdo->prepare('UPDATE users SET is_verified = 1 WHERE user_id = :id AND role_id = 3');
$stmt->execute(['id' => $seller_id]);

header('Location: ../admin/admin_dashboard.php?msg=verified');
exit;

<?php
// actions/check_email_action.php
// Accepts POST 'email' and returns JSON {available: true|false}

if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../controllers/user_controller.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['available' => false, 'error' => 'Invalid request']);
    exit;
}

$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
if (!$email) {
    echo json_encode(['available' => false, 'error' => 'Invalid email']);
    exit;
}

$user = find_user_by_email($email);
if ($user) {
    echo json_encode(['available' => false]);
} else {
    echo json_encode(['available' => true]);
}

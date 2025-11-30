<?php
// actions/login_action.php
// Handles login POST. Expects email and password. Includes special hardcoded admin credentials.

if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../controllers/user_controller.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login_Register/login.php');
    exit;
}

$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    $_SESSION['login_error'] = 'Please provide email and password.';
    header('Location: ../login_Register/login.php');
    exit;
}

// Hardcoded/admin-file-based admin check (stored server-side, not in DB)
// Prefer reading admin credentials from admin/admin_credentials.txt if present.
$adminEmail = 'admin@estateconnect.com';
$adminPass = 'SecurePass!2025';
$credFile = __DIR__ . '/../admin/admin_credentials.txt';
if (is_readable($credFile)) {
    $txt = file($credFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($txt as $line) {
        $line = trim($line);
        if (stripos($line, 'Email:') === 0) {
            $adminEmail = trim(substr($line, strlen('Email:')));
        } elseif (stripos($line, 'Password:') === 0) {
            $adminPass = trim(substr($line, strlen('Password:')));
        }
    }
}

if ($email === $adminEmail && $password === $adminPass) {
    $_SESSION['user'] = [
        'user_id' => 'admin',
        'name' => 'Administrator',
        'email' => $email,
        'role' => 'admin',
        'is_verified' => 1,
    ];
    $_SESSION['user_id'] = 'admin';
    $_SESSION['role'] = 1;
    $_SESSION['is_verified'] = 1;
    header('Location: ../admin/admin_dashboard.php');
    exit;
}

// verify credentials against DB
$user = verify_user_password($email, $password);
if (!$user) {
    $_SESSION['login_error'] = 'Invalid credentials.';
    header('Location: ../login_Register/login.php');
    exit;
}

// Set session values
// store a structured user object in session so the UI can greet by name
$_SESSION['user'] = [
    'user_id' => $user['user_id'],
    'name' => $user['full_name'] ?? $user['fullName'] ?? '',
    'email' => $user['email'],
    'role' => isset($user['role_id']) && intval($user['role_id']) === 3 ? 'seller' : (isset($user['role_id']) && intval($user['role_id'])===1 ? 'admin' : 'buyer'),
    'is_verified' => intval($user['is_verified']),
];

// Backwards-compatible keys
$_SESSION['user_id'] = $user['user_id'];
$_SESSION['role'] = $user['role_id'];
$_SESSION['is_verified'] = intval($user['is_verified']);

// Redirect based on role
if (intval($user['role_id']) === 3) { // seller
    header('Location: ../admin/seller_dashboard.php');
    exit;
}

header('Location: ../index.php');
exit;

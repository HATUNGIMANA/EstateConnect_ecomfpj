<?php
// actions/register_action.php
// Handles registration POST requests. Expects: full_name, email, password, phone, role (optional)

if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../controllers/user_controller.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login_Register/register.php');
    exit;
}

// Helper to send JSON responses for AJAX requests
function send_json($data, $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

// Simple server-side error logger (append)
function log_server_error($msg) {
    $logDir = __DIR__ . '/../logs';
    if (!is_dir($logDir)) @mkdir($logDir, 0755, true);
    $file = $logDir . '/server_errors.log';
    error_log("[".date('c')."] " . $msg . "\n", 3, $file);
}

// Accept both form field naming conventions (legacy and the current register form)
$full_name = trim($_POST['full_name'] ?? $_POST['customer_name'] ?? '');
$email = filter_var($_POST['email'] ?? $_POST['customer_email'] ?? '', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? $_POST['customer_pass'] ?? '';
$phone = trim($_POST['phone'] ?? $_POST['customer_contact'] ?? '');
$country = trim($_POST['customer_country'] ?? $_POST['country'] ?? '');
$city = trim($_POST['customer_city'] ?? $_POST['city'] ?? '');
$role = isset($_POST['role']) && $_POST['role'] === 'seller' ? 3 : 2; // sellers = 3, buyers = 2

$errors = [];
if (!$full_name) $errors[] = 'Full name is required.';
if (!$email) $errors[] = 'A valid email is required.';
if (strlen($password) < 6) $errors[] = 'Password must be at least 6 characters.';

if (find_user_by_email($email)) {
    $errors[] = 'Email is already registered.';
}

// If request is AJAX (fetch sets X-Requested-With), return JSON responses
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';

if (!empty($errors)) {
    if ($isAjax) {
        send_json(['success' => false, 'message' => implode(" ", $errors), 'errors' => $errors], 400);
    }
    $_SESSION['register_errors'] = $errors;
    header('Location: ../login_Register/register.php');
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);
try {
    $user_id = create_user($full_name, $email, $hash, $phone, $role);

    // Map numeric role to text for session (2=buyer,3=seller)
    $role_name = $role === 3 ? 'seller' : 'buyer';

    // Auto-login after registration (mark seller as not verified)
    $_SESSION['user'] = [
        'user_id' => $user_id,
        'name' => $full_name,
        'email' => $email,
        'role' => $role_name,
        'is_verified' => 0,
    ];

    // Backward-compatible individual session keys (some pages use these)
    $_SESSION['user_id'] = $user_id;
    $_SESSION['role'] = $role;
    $_SESSION['is_verified'] = 0;
} catch (Exception $e) {
    log_server_error('Register error: ' . $e->getMessage());
    if ($isAjax) send_json(['success' => false, 'message' => 'Server error during registration.'], 500);
    $_SESSION['register_errors'] = ['Server error during registration.'];
    header('Location: ../login_Register/register.php');
    exit;
}

if ($isAjax) {
    send_json(['success' => true, 'message' => 'Registered successfully'], 201);
}

// Redirect sellers to a verification upload page (not yet implemented)
if ($role === 3) {
    header('Location: ../login_Register/seller_verify.php');
    exit;
}

header('Location: ../index.php');
exit;

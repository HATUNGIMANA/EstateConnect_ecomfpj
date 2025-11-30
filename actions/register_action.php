<?php
// actions/register_action.php
// Handles registration POST requests. Expects: full_name, email, password, phone, role (optional)

if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../controllers/user_controller.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login_Register/register.php');
    exit;
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
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => implode(" ", $errors), 'errors' => $errors]);
        exit;
    }
    $_SESSION['register_errors'] = $errors;
    header('Location: ../login_Register/register.php');
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);
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

if ($isAjax) {
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Registered successfully']);
    exit;
}

// Redirect sellers to a verification upload page (not yet implemented)
if ($role === 3) {
    header('Location: ../login_Register/seller_verify.php');
    exit;
}

header('Location: ../index.php');
exit;

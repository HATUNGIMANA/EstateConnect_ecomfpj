<?php
// actions/submit_agent_request.php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../controllers/agent_controller.php';

// Simple POST handler — validate inputs and store files
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../agent_register.php');
    exit;
}

$full_name = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');

$errors = [];
if ($full_name === '') $errors[] = 'Full name is required.';

$uploadDir = __DIR__ . '/../uploads/agents';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

// Handle file uploads: id_upload and licence_upload
$idUploadPath = null;
$licenceUploadPath = null;

if (!empty($_FILES['id_upload']) && $_FILES['id_upload']['error'] === UPLOAD_ERR_OK) {
    $tmp = $_FILES['id_upload']['tmp_name'];
    $name = basename($_FILES['id_upload']['name']);
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    $safeName = preg_replace('/[^a-zA-Z0-9\-_.]/', '_', pathinfo($name, PATHINFO_FILENAME));
    $newName = $safeName . '_' . time() . '.' . $ext;
    $dest = $uploadDir . '/' . $newName;
    if (move_uploaded_file($tmp, $dest)) {
        $idUploadPath = 'uploads/agents/' . $newName;
    } else {
        $errors[] = 'Could not save ID upload.';
    }
} else {
    $errors[] = 'ID upload is required.';
}

if (!empty($_FILES['licence_upload']) && $_FILES['licence_upload']['error'] === UPLOAD_ERR_OK) {
    $tmp = $_FILES['licence_upload']['tmp_name'];
    $name = basename($_FILES['licence_upload']['name']);
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    $safeName = preg_replace('/[^a-zA-Z0-9\-_.]/', '_', pathinfo($name, PATHINFO_FILENAME));
    $newName = $safeName . '_' . time() . '.' . $ext;
    $dest = $uploadDir . '/' . $newName;
    if (move_uploaded_file($tmp, $dest)) {
        $licenceUploadPath = 'uploads/agents/' . $newName;
    } else {
        $errors[] = 'Could not save Licence upload.';
    }
} else {
    $errors[] = 'Ghana Lands Commission ID / Licence upload is required.';
}

if (!empty($errors)) {
    $_SESSION['agent_request_errors'] = $errors;
    header('Location: ../agent_register.php');
    exit;
}

// Insert into DB
$data = [
    'full_name' => $full_name,
    'email' => $email,
    'phone' => $phone,
    'id_upload' => $idUploadPath,
    'licence_upload' => $licenceUploadPath,
];
try {
    $id = add_agent_request($data);
    $_SESSION['agent_request_success'] = 'Your verification is in progress — we will contact you shortly.';
    header('Location: ../agent_register.php');
    exit;
} catch (Exception $e) {
    $_SESSION['agent_request_errors'] = ['Server error: ' . $e->getMessage()];
    header('Location: ../agent_register.php');
    exit;
}

?>
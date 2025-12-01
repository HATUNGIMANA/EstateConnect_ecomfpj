<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// Ensure POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: add_property.php');
    exit;
}

// Basic helper to sanitize file names
function safe_filename($name){
    $name = preg_replace('/[^A-Za-z0-9._-]/', '_', $name);
    return $name;
}

$uploadsDir = __DIR__ . '/../uploads';
$imagesDir = $uploadsDir . '/properties_images';
$videosDir = $uploadsDir . '/properties_videos';
if (!is_dir($imagesDir)) mkdir($imagesDir, 0755, true);
if (!is_dir($videosDir)) mkdir($videosDir, 0755, true);

$data = [];
$data['title'] = $_POST['title'] ?? '';
$data['description'] = $_POST['description'] ?? '';
$data['type'] = $_POST['type'] ?? '';
$data['price'] = $_POST['price'] ?? '';
$data['location'] = $_POST['location'] ?? '';
$data['beds'] = $_POST['beds'] ?? '';
$data['baths'] = $_POST['baths'] ?? '';
$data['area'] = $_POST['area'] ?? '';
$data['amenities'] = $_POST['amenities'] ?? '';
$data['availability'] = $_POST['availability'] ?? '';
$data['premium_id'] = $_POST['premium_id'] ?? '';
$data['created_at'] = date('c');

// Validate and save uploads with basic checks
$savedImages = [];
$maxImageBytes = 5 * 1024 * 1024; // 5 MB per image
$allowedImageTypes = ['image/jpeg','image/png','image/webp'];
if (!empty($_FILES['images'])) {
    $files = $_FILES['images'];
    for ($i = 0; $i < count($files['name']); $i++) {
        if ($files['error'][$i] !== UPLOAD_ERR_OK) continue;
        $tmp = $files['tmp_name'][$i];
        $finfoType = mime_content_type($tmp) ?: $files['type'][$i];
        if (!in_array($finfoType, $allowedImageTypes)) {
            $_SESSION['property_error'] = 'One or more uploaded images are not valid image types.';
            header('Location: add_property_premium.php'); exit;
        }
        if (filesize($tmp) > $maxImageBytes) {
            $_SESSION['property_error'] = 'Each image must be 5MB or smaller.';
            header('Location: add_property_premium.php'); exit;
        }
        $orig = basename($files['name'][$i]);
        $safe = time() . '_' . safe_filename($orig);
        $dest = $imagesDir . '/' . $safe;
        if (move_uploaded_file($tmp, $dest)) {
            $savedImages[] = 'uploads/properties_images/' . $safe;
        }
    }
}

$savedVideo = '';
$maxVideoBytes = 50 * 1024 * 1024; // 50 MB
$allowedVideoTypes = ['video/webm','video/mp4'];
if (!empty($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
    $tmp = $_FILES['video']['tmp_name'];
    $finfoType = mime_content_type($tmp) ?: $_FILES['video']['type'];
    if (!in_array($finfoType, $allowedVideoTypes)) {
        $_SESSION['property_error'] = 'Uploaded video must be webm or mp4.';
        header('Location: add_property_premium.php'); exit;
    }
    if (filesize($tmp) > $maxVideoBytes) {
        $_SESSION['property_error'] = 'Video must be 50MB or smaller.';
        header('Location: add_property_premium.php'); exit;
    }
    $orig = basename($_FILES['video']['name']);
    $safe = time() . '_' . safe_filename($orig);
    $dest = $videosDir . '/' . $safe;
    if (move_uploaded_file($tmp, $dest)) {
        $savedVideo = 'uploads/properties_videos/' . $safe;
    }
}

$data['images'] = $savedImages;
$data['video'] = $savedVideo;

// Try to insert into the database when a user is logged in
$didInsertToDb = false;
try {
    require_once __DIR__ . '/../settings/connection.php'; // provides $pdo
    if (!empty($_SESSION['user_id'])) {
        $sellerId = (int)$_SESSION['user_id'];
        $mediaType = $savedVideo ? 'video' : 'image';
        $stmt = $pdo->prepare('INSERT INTO properties (seller_id, cat_id, title, description, price, location, media_type, status, is_premium) VALUES (:seller, NULL, :title, :desc, :price, :loc, :media, "Available", 1)');
        $stmt->execute([
            ':seller' => $sellerId,
            ':title' => $data['title'],
            ':desc' => $data['description'],
            ':price' => (float)$data['price'],
            ':loc' => $data['location'],
            ':media' => $mediaType
        ]);
        $propertyId = $pdo->lastInsertId();
        // store images and video paths in property_images (demo convenience)
        $ins = $pdo->prepare('INSERT INTO property_images (property_id, image_path) VALUES (:pid, :path)');
        foreach ($savedImages as $p) { $ins->execute([':pid' => $propertyId, ':path' => $p]); }
        if ($savedVideo) { $ins->execute([':pid' => $propertyId, ':path' => $savedVideo]); }
        $didInsertToDb = true;
    }
} catch (Exception $e) {
    // Log and fall back to JSON storage
    error_log('Premium property DB insert failed: ' . $e->getMessage());
    $didInsertToDb = false;
}

// Append to a JSON file for demo persistence (always keep a copy)
$storeFile = $uploadsDir . '/properties_data.json';
$all = [];
if (file_exists($storeFile)) {
    $txt = file_get_contents($storeFile);
    $all = json_decode($txt, true) ?: [];
}
$all[] = $data;
file_put_contents($storeFile, json_encode($all, JSON_PRETTY_PRINT));

// Set a session message and redirect to properties page
$_SESSION['property_success'] = 'Property added as premium seller successfully.';
header('Location: ../properties.php');
exit;

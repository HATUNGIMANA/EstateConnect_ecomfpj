<?php
/*
  tools/quick_setup.php
  One-time helper to create minimal tables (roles, users) and seed an admin user.
  Usage: visit in browser: /tools/quick_setup.php?run=1
  WARNING: remove this file after use.
*/
ini_set('display_errors',1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../settings/db_cred.php';

$host = defined('SERVER') ? SERVER : 'localhost';
$user = defined('USERNAME') ? USERNAME : 'root';
$pass = defined('PASSWD') ? PASSWD : '';
$db   = defined('DATABASE') ? DATABASE : '';

echo '<h2>Quick Setup</h2>';
echo '<p>Target DB: <strong>' . htmlspecialchars($db) . '</strong> on host <strong>' . htmlspecialchars($host) . '</strong></p>';

if (!isset($_GET['run']) || $_GET['run'] != '1') {
    echo '<p>This script will attempt to create the minimal schema and seed an admin user.</p>';
    echo '<p>To run, append <code>?run=1</code> to this URL. Remove this file after use.</p>';
    exit;
}

$mysqli = @new mysqli($host, $user, $pass);
if ($mysqli->connect_errno) {
    echo '<p style="color:red">Connection to MySQL server failed: ' . htmlspecialchars($mysqli->connect_error) . '</p>';
    exit;
}

// Create DB if not exists
$sql = "CREATE DATABASE IF NOT EXISTS `" . $mysqli->real_escape_string($db) . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if (!$mysqli->query($sql)) {
    echo '<p style="color:red">Failed to create database: ' . htmlspecialchars($mysqli->error) . '</p>';
    exit;
}
echo '<p style="color:green">Database ensured.</p>';

if (!$mysqli->select_db($db)) {
    echo '<p style="color:red">Failed to select database: ' . htmlspecialchars($mysqli->error) . '</p>';
    exit;
}

// Create roles table
$roles_sql = "CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `role_name` VARCHAR(50) NOT NULL,
  UNIQUE KEY (`role_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
if ($mysqli->query($roles_sql)) echo '<p>Roles table created or already exists.</p>';
else echo '<p style="color:red">Roles table error: ' . htmlspecialchars($mysqli->error) . '</p>';

// Seed roles
$seed_roles = [ 'admin', 'buyer', 'seller' ];
foreach ($seed_roles as $r) {
    $stmt = $mysqli->prepare('INSERT INTO roles (role_name) VALUES (?) ON DUPLICATE KEY UPDATE role_name = VALUES(role_name)');
    $stmt->bind_param('s', $r);
    if ($stmt->execute()) {
        // ok
    } else {
        echo '<p style="color:red">Seed role error: ' . htmlspecialchars($mysqli->error) . '</p>';
    }
    $stmt->close();
}
echo '<p>Roles seeded.</p>';

// Create users table
$users_sql = "CREATE TABLE IF NOT EXISTS `users` (
  `user_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `role_id` INT UNSIGNED NOT NULL DEFAULT 2,
  `full_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `phone_number` VARCHAR(50),
  `is_verified` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`role_id`) REFERENCES `roles`(`role_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
if ($mysqli->query($users_sql)) echo '<p>Users table created or already exists.</p>';
else echo '<p style="color:red">Users table error: ' . htmlspecialchars($mysqli->error) . '</p>';

// Read admin credentials file if exists
$adminEmail = 'admin@estateconnect.com';
$adminPassPlain = 'Adm!nEstCon123@@';
$credFile = __DIR__ . '/../admin/admin_credentials.txt';
if (is_readable($credFile)) {
    $lines = file($credFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (stripos($line, 'Email:') === 0) $adminEmail = trim(substr($line, strlen('Email:')));
        if (stripos($line, 'Password:') === 0) $adminPassPlain = trim(substr($line, strlen('Password:')));
    }
}

// Insert admin user if not exists
$check = $mysqli->prepare('SELECT user_id FROM users WHERE email = ? LIMIT 1');
$check->bind_param('s', $adminEmail);
$check->execute();
$check->store_result();
if ($check->num_rows > 0) {
    echo '<p>Admin user already exists. No changes made to users.</p>';
} else {
    $hashed = password_hash($adminPassPlain, PASSWORD_DEFAULT);
    // get admin role id
    $ridRes = $mysqli->query("SELECT role_id FROM roles WHERE role_name = 'admin' LIMIT 1");
    $rid = 1;
    if ($ridRes && $row = $ridRes->fetch_assoc()) $rid = intval($row['role_id']);

    $ins = $mysqli->prepare('INSERT INTO users (role_id, full_name, email, password, phone_number, is_verified, created_at) VALUES (?, ?, ?, ?, ?, 1, NOW())');
    $name = 'Administrator';
    $phone = '';
    $ins->bind_param('issss', $rid, $name, $adminEmail, $hashed, $phone);
    if ($ins->execute()) echo '<p style="color:green">Admin user created with email: ' . htmlspecialchars($adminEmail) . '</p>';
    else echo '<p style="color:red">Failed to create admin user: ' . htmlspecialchars($mysqli->error) . '</p>';
    $ins->close();
}
$check->close();

// List tables
$res = $mysqli->query("SHOW TABLES");
if ($res) {
    echo '<h3>Tables in ' . htmlspecialchars($db) . '</h3><ul>';
    while ($r = $res->fetch_array()) echo '<li>' . htmlspecialchars($r[0]) . '</li>';
    echo '</ul>';
} else {
    echo '<p style="color:red">Could not list tables: ' . htmlspecialchars($mysqli->error) . '</p>';
}

echo '<p>Quick setup complete. Remove this file after use.</p>';

$mysqli->close();

?>

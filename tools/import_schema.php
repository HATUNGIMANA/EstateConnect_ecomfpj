<?php
// tools/import_schema.php
// Simple helper: attempts to create the configured database and import the SQL schema
// Usage: open in browser: http://localhost/.../EstateConnect/tools/import_schema.php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../settings/db_cred.php';

$host = defined('SERVER') ? SERVER : 'localhost';
$user = defined('USERNAME') ? USERNAME : 'root';
$pass = defined('PASSWD') ? PASSWD : '';
$db   = defined('DATABASE') ? DATABASE : 'EstateConn_db';

echo "<h2>EstateConnect Schema Import Tool</h2>";
echo "<p>Host: <strong>".htmlspecialchars($host)."</strong> DB: <strong>".htmlspecialchars($db)."</strong></p>";

$mysqli = @new mysqli($host, $user, $pass);
if ($mysqli->connect_errno) {
    echo '<p style="color:red">Connection to MySQL server failed: ' . htmlspecialchars($mysqli->connect_error) . '</p>';
    exit;
}

// Create database if not exists
$sqlCreate = "CREATE DATABASE IF NOT EXISTS `" . $mysqli->real_escape_string($db) . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if (!$mysqli->query($sqlCreate)) {
    echo '<p style="color:red">Failed to create database: ' . htmlspecialchars($mysqli->error) . '</p>';
    exit;
}

// Select DB
if (!$mysqli->select_db($db)) {
    echo '<p style="color:red">Failed to select database: ' . htmlspecialchars($mysqli->error) . '</p>';
    exit;
}

$schemaPath = __DIR__ . '/../db/db_fin_project.sql';
if (!file_exists($schemaPath)) {
    echo '<p style="color:red">Schema file not found at ' . htmlspecialchars($schemaPath) . '</p>';
    exit;
}

$sql = file_get_contents($schemaPath);
// Remove CREATE DATABASE / USE lines and comments
$lines = preg_split("/\r\n|\n|\r/", $sql);
$clean = '';
foreach ($lines as $line) {
    $trim = trim($line);
    if ($trim === '' || strpos($trim, '--') === 0 || strpos($trim, '/*') === 0 || strpos($trim, '*/') === 0) continue;
    if (stripos($trim, 'CREATE DATABASE') === 0) continue;
    if (stripos($trim, 'USE ') === 0) continue;
    $clean .= $line . "\n";
}

echo '<h3>Importing schema...</h3>';

$errors = [];
if ($mysqli->multi_query($clean)) {
    do {
        if ($res = $mysqli->store_result()) {
            $res->free();
        }
        if ($mysqli->more_results()) {
            // continue
        }
    } while ($mysqli->more_results() && $mysqli->next_result());
    if ($mysqli->errno) {
        $errors[] = $mysqli->error;
    }
} else {
    $errors[] = $mysqli->error;
}

if (!empty($errors)) {
    echo '<p style="color:red">Import finished with errors:</p><ul>';
    foreach ($errors as $er) echo '<li>' . htmlspecialchars($er) . '</li>';
    echo '</ul>';
} else {
    echo '<p style="color:green">Schema import completed (or statements executed). Listing tables:</p>';
}

// List tables in the database
$tblRes = $mysqli->query("SELECT table_name FROM information_schema.tables WHERE table_schema = '" . $mysqli->real_escape_string($db) . "'");
if ($tblRes) {
    echo '<ul>';
    while ($row = $tblRes->fetch_assoc()) {
        echo '<li>' . htmlspecialchars($row['table_name']) . '</li>';
    }
    echo '</ul>';
} else {
    echo '<p style="color:red">Could not list tables: ' . htmlspecialchars($mysqli->error) . '</p>';
}

echo '<p><a href="../../index.php">Back to site</a></p>';

$mysqli->close();

?>

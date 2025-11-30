<?php
// tools/check_db.php
// Quick diagnostic: shows selected DB and lists tables using credentials from db_cred.php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../settings/db_cred.php';
$host = defined('SERVER') ? SERVER : 'localhost';
$user = defined('USERNAME') ? USERNAME : 'root';
$pass = defined('PASSWD') ? PASSWD : '';
$db   = defined('DATABASE') ? DATABASE : 'EstateConn_db';
echo "<h2>DB Diagnostic</h2>";
echo "<p>Host: <strong>".htmlspecialchars($host)."</strong></p>";
echo "<p>Database: <strong>".htmlspecialchars($db)."</strong></p>";
$mysqli = @new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    echo '<p style="color:red">Connection failed: ' . htmlspecialchars($mysqli->connect_error) . '</p>';
    exit;
}
echo '<p style="color:green">Connected to MySQL and selected database.</p>';
$res = $mysqli->query("SHOW TABLES");
if (!$res) {
    echo '<p style="color:red">SHOW TABLES failed: ' . htmlspecialchars($mysqli->error) . '</p>';
    exit;
}
echo '<h3>Tables in ' . htmlspecialchars($db) . '</h3>';
echo '<ul>';
while ($row = $res->fetch_array()) {
    echo '<li>' . htmlspecialchars($row[0]) . '</li>';
}
echo '</ul>';
echo '<p><a href="import_schema.php">Run import_schema.php</a></p>';
$mysqli->close();
?>

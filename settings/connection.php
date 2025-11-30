<?php
// settings/connection.php
// Central PDO connection used by controllers. Uses credentials from db_cred.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db_cred.php';
// Try connecting to the configured database. If the database does not exist
// attempt to create it by applying the SQL schema file (helpful for local dev).
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $dsn = "mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8mb4";
    $pdo = new PDO($dsn, USERNAME, PASSWD, $options);
} catch (PDOException $e) {
    // If the database is missing (SQLSTATE 3D000), try to create it using the SQL file
    error_log('Initial DB connection error: ' . $e->getMessage());
    try {
        // Connect to server without selecting a database
        $dsnServer = "mysql:host=" . SERVER . ";charset=utf8mb4";
        $pdoServer = new PDO($dsnServer, USERNAME, PASSWD, $options);

        // Ensure the database exists
        $createDbSql = "CREATE DATABASE IF NOT EXISTS `" . DATABASE . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        $pdoServer->exec($createDbSql);

        // Reconnect to the server but with the database selected so CREATE TABLE runs in the right DB
        $pdoServerDb = new PDO($dsn, USERNAME, PASSWD, $options);

        // If a schema file exists, try to apply it (skip CREATE/USE lines)
        $schemaPath = __DIR__ . '/../db/db_fin_project.sql';
        if (file_exists($schemaPath) && is_readable($schemaPath)) {
            $sql = file_get_contents($schemaPath);
            // Remove comment-only lines
            $lines = preg_split("/\r\n|\n|\r/", $sql);
            $clean = '';
            foreach ($lines as $line) {
                $trim = trim($line);
                if ($trim === '' || strpos($trim, '--') === 0 || strpos($trim, '/*') === 0 || strpos($trim, '*/') === 0) continue;
                // Skip CREATE DATABASE and USE statements as we've already created the DB
                if (stripos($trim, 'CREATE DATABASE') === 0) continue;
                if (stripos($trim, 'USE ') === 0) continue;
                $clean .= $line . "\n";
            }

            // Split statements on semicolon followed by newline for safer execution
            $statements = preg_split('/;\s*\n/', $clean);
            foreach ($statements as $stmt) {
                $stmt = trim($stmt);
                if ($stmt === '') continue;
                try {
                    $pdoServerDb->exec($stmt);
                } catch (PDOException $innerEx) {
                    // Log the error but continue — some statements may duplicate or fail harmlessly
                    error_log('Schema exec error: ' . $innerEx->getMessage() . ' -- Statement: ' . substr($stmt, 0, 200));
                }
            }
        }

        // Finally connect to the newly created/ensured database
        $pdo = new PDO($dsn, USERNAME, PASSWD, $options);
    } catch (PDOException $inner) {
        error_log('DB setup/connection failed: ' . $inner->getMessage());
        // Provide a slightly more actionable message for local devs
        die('Database connection failed. Please ensure MySQL is running and import `db/db_fin_project.sql`. Details logged.');
    }
}

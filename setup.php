<?php
// ─────────────────────────────────────────
//  Run this file ONCE to set up the database
//  Visit: http://localhost/php-app/setup.php
// ─────────────────────────────────────────
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'bitcot-db');


$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
if ($conn->connect_error) {
    die("<pre style='color:red'>Connection failed: " . $conn->connect_error . "</pre>");
}

// Create database
$conn->query("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
$conn->select_db(DB_NAME);

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS `users` (
    `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `full_name`  VARCHAR(120)  NOT NULL,
    `email`      VARCHAR(180)  NOT NULL UNIQUE,
    `phone`      VARCHAR(20)   DEFAULT NULL,
    `subject`    VARCHAR(120)  NOT NULL,
    `message`    TEXT          NOT NULL,
    `created_at` TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql)) {
    echo "
    <html><head><title>Setup</title>
    <style>
        body { font-family: monospace; background: #0d0d0d; color: #c8f5c8; padding: 2rem; }
        h2 { color: #7fff7f; }
        a { color: #7fdfff; }
    </style></head><body>
    <h2>✅ Setup Complete!</h2>
    <p>Database <strong>" . DB_NAME . "</strong> and table <strong>users</strong> created successfully.</p>
    <p><a href='index.php'>→ Go to the app</a></p>
    </body></html>";
} else {
    echo "<pre style='color:red'>Error: " . $conn->error . "</pre>";
}

$conn->close();

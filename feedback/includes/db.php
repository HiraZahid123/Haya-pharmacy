<?php
// includes/db.php

require_once __DIR__ . '/../../config/config.php';

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Sync MySQL timezone with PHP timezone
    $pdo->exec("SET time_zone = '" . date('P') . "'");
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

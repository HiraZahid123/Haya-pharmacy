<?php
require_once __DIR__ . '/config/config.php';

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS standalone_survey_results (
        id INT AUTO_INCREMENT PRIMARY KEY,
        gender VARCHAR(50) NULL,
        age_category VARCHAR(50) NULL,
        thyroid_score INT DEFAULT 0,
        thyroid_risk VARCHAR(50) NULL,
        diabetes_score INT DEFAULT 0,
        diabetes_risk VARCHAR(50) NULL,
        bp_score INT DEFAULT 0,
        bp_risk VARCHAR(50) NULL,
        vitamin_score INT DEFAULT 0,
        vitamin_risk VARCHAR(50) NULL,
        survey_data JSON NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    
    $pdo->exec($sql);
    echo "standalone_survey_results table created successfully.\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>

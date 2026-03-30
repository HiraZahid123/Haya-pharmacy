<?php
require_once 'includes/db.php';

try {
    $stmt = $pdo->query("SELECT * FROM branches");
    $branches = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "SUCCESS: " . count($branches) . " branches found.";
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
?>

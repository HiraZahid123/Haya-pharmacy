<?php
require_once 'includes/db.php';
try {
    getDB();
    echo "SUCCESS: Database connected.";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}

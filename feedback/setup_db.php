<?php
// setup_db.php
$host = '127.0.0.1';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("DROP DATABASE IF EXISTS pharmacy_survey");
    $pdo->exec("CREATE DATABASE pharmacy_survey");
    $pdo->exec("USE pharmacy_survey");

    $sql = file_get_contents('feedback.sql');
    $pdo->exec($sql);
    echo "Recreated DB from scratch successfully!";
} catch (PDOException $e) {
    echo "Error Creating Database: " . $e->getMessage();
}
?>

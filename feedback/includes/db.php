<?php
// includes/db.php

$host = '127.0.0.1';
$dbname = 'ranafdnl_ecomlecoindesbarons';
$username = 'ranafdnl_ecomlecoindesbarons'; // default Laragon/XAMPP username
$password = 'zCJnQiOD#jE)'; // default Laragon/XAMPP password

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
// Set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Set default fetch mode to associative array
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

<?php
session_start();
$branch = $_GET['branch'] ?? 'main-branch';
$type = $_GET['type'] ?? 'visit';
header("Location: question1.php?branch=" . urlencode($branch) . "&type=" . urlencode($type));
exit();

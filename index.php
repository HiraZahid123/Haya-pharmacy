<?php
// index.php — Entry point, redirect to the designed Landing Page
require_once __DIR__ . '/config/config.php';
header('Location: ' . SITE_URL . '/pages/partners.php');
exit;

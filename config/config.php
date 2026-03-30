<?php
// ============================================================
// Haya Pharmacy — Site Configuration
// ============================================================

/**
 * Simple .env loader
 */
function loadEnv($path) {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        $name  = trim($name);
        $value = trim($value);
        
        // Strip quotes
        if (preg_match('/^["\'](.*)["\']$/', $value, $matches)) {
            $value = $matches[1];
        }

        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

// Load environment variables
loadEnv(__DIR__ . '/../.env');

// Database settings
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'haya_pharmacy');
define('DB_CHARSET', getenv('DB_CHARSET') ?: 'utf8mb4');

// Site settings
define('SITE_NAME', getenv('SITE_NAME') ?: 'صيدلية حيا');
define('SITE_NAME_EN', getenv('SITE_NAME_EN') ?: 'Haya Pharmacy');
define('SITE_URL', getenv('SITE_URL') ?: 'http://localhost/haya-pharmacy');

// Timezone
define('SITE_TIMEZONE', getenv('SITE_TIMEZONE') ?: 'Asia/Baghdad');
date_default_timezone_set(SITE_TIMEZONE);

// Card number prefixes
define('PIONEER_PREFIX', 'HAY-P');
define('PARTNER_PREFIX', 'HAY-S'); // شريك

// Admin session key
define('ADMIN_SESSION_KEY', 'haya_admin_logged_in');

// Environment
define('ENVIRONMENT', getenv('ENVIRONMENT') ?: 'development');

// Error reporting
if (ENVIRONMENT === 'production') {
    error_reporting(0);
    ini_set('display_errors', 0);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}


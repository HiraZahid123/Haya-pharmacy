<?php
require_once __DIR__ . '/includes/db.php';

$sql = "CREATE TABLE IF NOT EXISTS `standalone_survey_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `responses` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conn->query($sql) === TRUE) {
    echo "Table standalone_survey_results created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
?>

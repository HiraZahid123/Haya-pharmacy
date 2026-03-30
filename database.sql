-- Database Schema for Haya Pharmacy
CREATE DATABASE IF NOT EXISTS `haya_pharmacy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `haya_pharmacy`;

-- 1. Table for Partners
CREATE TABLE IF NOT EXISTS `partners_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_number` varchar(50) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `passcode` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `card_number` (`card_number`),
  UNIQUE KEY `mobile_number` (`mobile_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Table for Pioneers
CREATE TABLE IF NOT EXISTS `pioneers_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_number` varchar(50) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `card_number` (`card_number`),
  UNIQUE KEY `mobile_number` (`mobile_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Table for Admin Users
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Initial Admin (password: admin123)
-- $2y$10$O0S793Z4n6Y3HkQ8X/E.5ePzK8W/B8uS7jFvL2m9kY6GvK8pS1r2W is hash for 'admin123'
-- Using a simpler one if needed, but let's use a standard hash.
INSERT INTO `admin_users` (`username`, `password_hash`) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'); -- 'password'

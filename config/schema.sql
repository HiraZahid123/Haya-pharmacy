-- ============================================================
-- Haya Pharmacy — Full Database Schema
-- Run this in phpMyAdmin or MySQL CLI
-- Database: haya_pharmacy
-- ============================================================

USE haya_pharmacy;

-- ── Pioneers Card ──────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS pioneers_cards (
    id            INT        AUTO_INCREMENT PRIMARY KEY,
    card_number   VARCHAR(25) UNIQUE NOT NULL  COMMENT 'رقم الكارت',
    full_name     VARCHAR(255) NOT NULL         COMMENT 'الاسم',
    mobile_number VARCHAR(20) NOT NULL          COMMENT 'رقم التليفون',
    gender        ENUM('male','female') NOT NULL COMMENT 'جنس',
    date_of_birth DATE NOT NULL                 COMMENT 'تاريخ الميلاد',
    created_at    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'التاريخ والوقت'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Partners Card ──────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS partners_cards (
    id            INT        AUTO_INCREMENT PRIMARY KEY,
    card_number   VARCHAR(25) UNIQUE NOT NULL  COMMENT 'رقم الكارت',
    full_name     VARCHAR(255) NOT NULL         COMMENT 'الاسم',
    mobile_number VARCHAR(20) NOT NULL          COMMENT 'رقم التليفون',
    gender        ENUM('male','female') NOT NULL COMMENT 'جنس',
    date_of_birth DATE NOT NULL                 COMMENT 'تاريخ الميلاد',
    passcode      VARCHAR(50) NULL              COMMENT 'الرقم السري',
    created_at    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'التاريخ والوقت'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Feedback Responses ─────────────────────────────────────────
CREATE TABLE IF NOT EXISTS feedback_responses (
    id            INT        AUTO_INCREMENT PRIMARY KEY,
    branch_id     VARCHAR(50) NOT NULL          COMMENT 'الفرع',
    feedback_type ENUM('visit','delivery') NOT NULL DEFAULT 'visit',
    q1_emoji      ENUM('happy','neutral','sad') NOT NULL COMMENT 'كيف كانت زيارتك',
    q2_emoji      ENUM('happy','neutral','sad') NOT NULL COMMENT 'كيف كان تعاون الفريق',
    comment       TEXT NULL                     COMMENT 'تعليق اختياري',
    phone_number  VARCHAR(20) NULL              COMMENT 'رقم الهاتف اختياري',
    submitted_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'وقت الإرسال (UTC)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Disease Questionnaire Submissions ──────────────────────────
CREATE TABLE IF NOT EXISTS questionnaire_submissions (
    id                      INT AUTO_INCREMENT PRIMARY KEY,
    gender                  ENUM('male','female') NOT NULL,
    age                     INT NOT NULL,
    bmi                     DECIMAL(5,2) NULL,
    pre_existing_conditions JSON NULL               COMMENT 'diseases user already has',

    -- Vitamin Deficiency
    vitamin_score           INT NOT NULL DEFAULT 0,
    vitamin_risk_level      ENUM('low','moderate','high') NOT NULL,

    -- Thyroid (NULL for males)
    thyroid_score           INT NULL,
    thyroid_risk_level      ENUM('low','low_moderate','moderate','high') NULL,

    -- Diabetes (point-based)
    diabetes_score          INT NOT NULL DEFAULT 0,
    diabetes_risk_level     ENUM('low','slightly_elevated','moderate','high','very_high') NOT NULL,

    -- Hypertension
    hypertension_score      INT NOT NULL DEFAULT 0,
    hypertension_risk_level ENUM('low','moderate','high') NOT NULL,

    -- Raw answers JSON for auditing
    answers_json            JSON NOT NULL,
    submitted_at            DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'وقت الإرسال (UTC)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Admin Users ────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS admin_users (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Default admin user (username: admin, password: haya2026) ──
-- Change this password immediately after setup!
INSERT IGNORE INTO admin_users (username, password_hash)
VALUES ('admin', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
-- Default password hash above is: haya2026
-- Generated with: password_hash('haya2026', PASSWORD_BCRYPT)

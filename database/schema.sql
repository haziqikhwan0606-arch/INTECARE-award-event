-- =============================================================================
-- INTECARE EXCELLENCE AWARD 2026 — DATABASE SCHEMA
-- Compatible with MySQL 5.7+ / 8.0+ / MariaDB 10.3+ (XAMPP environment)
-- =============================================================================

CREATE DATABASE IF NOT EXISTS `intecare`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `intecare`;

-- -----------------------------------------------------------------------------
-- 1. Table: nominations
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `nominations` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `tracking_reference` VARCHAR(32) NOT NULL,
  `nominee_type` ENUM('individual', 'corporate') NOT NULL,
  `category` VARCHAR(255) NOT NULL,
  `nominee_name` VARCHAR(255) DEFAULT NULL,
  `nominee_designation` VARCHAR(255) DEFAULT NULL,
  `company_name` VARCHAR(255) DEFAULT NULL,
  `company_reg` VARCHAR(255) DEFAULT NULL,
  `nominator_email` VARCHAR(255) NOT NULL,
  `nominator_phone` VARCHAR(64) NOT NULL,
  `rationale` TEXT NOT NULL,
  `status` ENUM('Pending Review', 'Under Review', 'Shortlisted', 'Approved', 'Rejected') NOT NULL DEFAULT 'Pending Review',
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `user_agent` VARCHAR(512) DEFAULT NULL,
  `email_sent_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `uk_tracking_reference` (`tracking_reference`),
  INDEX `idx_nominee_type` (`nominee_type`),
  INDEX `idx_category` (`category`),
  INDEX `idx_status` (`status`),
  INDEX `idx_nominator_email` (`nominator_email`),
  INDEX `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- 2. Table: admin_users
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(64) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `full_name` VARCHAR(128) NOT NULL,
  `role` ENUM('superadmin', 'admin', 'reviewer') NOT NULL DEFAULT 'admin',
  `last_login_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `uk_username` (`username`),
  INDEX `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- 3. Table: submission_rate_limits
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `submission_rate_limits` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `ip_address` VARCHAR(45) NOT NULL,
  `action` VARCHAR(32) NOT NULL,
  `attempted_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_ip_action_time` (`ip_address`, `action`, `attempted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

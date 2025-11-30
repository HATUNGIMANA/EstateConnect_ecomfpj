-- EstateConnect consolidated SQL schema (rewritten)
-- Creates database `EstateConn_db` and all tables used by the app.
-- Safe to re-run; uses IF NOT EXISTS where appropriate.

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Create database
CREATE DATABASE IF NOT EXISTS `EstateConn_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `EstateConn_db`;

-- Roles table
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `role_name` VARCHAR(50) NOT NULL,
  UNIQUE KEY (`role_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed roles
INSERT INTO `roles` (`role_name`) VALUES
  ('admin'), ('buyer'), ('seller')
ON DUPLICATE KEY UPDATE role_name = VALUES(role_name);

-- Users table
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `role_id` INT UNSIGNED NOT NULL DEFAULT 2,
  `full_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `phone_number` VARCHAR(50),
  `is_verified` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`role_id`) REFERENCES `roles`(`role_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Property categories
CREATE TABLE IF NOT EXISTS `property_categories` (
  `cat_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `cat_name` VARCHAR(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Properties table
CREATE TABLE IF NOT EXISTS `properties` (
  `property_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `seller_id` INT UNSIGNED NOT NULL,
  `cat_id` INT UNSIGNED DEFAULT NULL,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `price` DECIMAL(12,2) DEFAULT 0,
  `location` VARCHAR(255),
  `media_type` ENUM('image','video','audio') DEFAULT 'image',
  `status` ENUM('Available','Sold','Rented') DEFAULT 'Available',
  `is_premium` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`seller_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`cat_id`) REFERENCES `property_categories`(`cat_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Property images
CREATE TABLE IF NOT EXISTS `property_images` (
  `image_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `property_id` INT UNSIGNED NOT NULL,
  `image_path` VARCHAR(1024) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`property_id`) REFERENCES `properties`(`property_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Subscriptions table
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `sub_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `plan_type` ENUM('Free','Premium') DEFAULT 'Free',
  `start_date` DATE,
  `end_date` DATE,
  `status` ENUM('Active','Expired') DEFAULT 'Active',
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Verifications table
CREATE TABLE IF NOT EXISTS `verifications` (
  `ver_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `document_path` VARCHAR(1024),
  `status` ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Cart / Shortlist table
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `property_id` INT UNSIGNED NOT NULL,
  `added_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `user_property_unique` (`user_id`,`property_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`property_id`) REFERENCES `properties`(`property_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inquiries table
CREATE TABLE IF NOT EXISTS `inquiries` (
  `inq_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `property_id` INT UNSIGNED NOT NULL,
  `from_user_id` INT UNSIGNED NOT NULL,
  `message` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`property_id`) REFERENCES `properties`(`property_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`from_user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Helpful indexes
CREATE INDEX IF NOT EXISTS idx_properties_location ON `properties` (`location`(100));
CREATE INDEX IF NOT EXISTS idx_properties_price ON `properties` (`price`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

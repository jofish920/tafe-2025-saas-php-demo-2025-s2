DROP DATABASE IF EXISTS `jfm_php_demo_2025_s2`;
CREATE DATABASE `jfm_php_demo_2025_s2` /*!40100 COLLATE 'utf8mb4_general_ci' */;

USE `jfm_php_demo_2025_s2`;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `description` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
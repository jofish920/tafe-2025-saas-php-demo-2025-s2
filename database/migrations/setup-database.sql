DROP DATABASE IF EXISTS `xxx_php_demo_2025_s2`;
CREATE DATABASE `xxx_php_demo_2025_s2` /*!40100 COLLATE 'utf8mb4_general_ci' */;

USE `xxx_php_demo_2025_s2`;

DROP TABLE IF EXISTS `xxx_php_demo_2025_s2`.`categories`;

CREATE TABLE IF NOT EXISTS `xxx_php_demo_2025_s2`.`categories` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(32) NOT NULL,
    `description` VARCHAR(255) NULL,
    UNIQUE INDEX `title` (`title`),
    PRIMARY KEY (`id`)
    );

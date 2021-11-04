-- Adminer 4.8.1 MySQL 8.0.26-0ubuntu0.20.04.2 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `views`;
CREATE TABLE `views` (
  `hash` varchar(40) NOT NULL,
  `ip_address` int unsigned DEFAULT NULL,
  `user_agent` text,
  `view_date` timestamp NULL DEFAULT NULL,
  `page_url` varchar(255) DEFAULT NULL,
  `views_count` int unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


-- 2021-11-04 14:40:58

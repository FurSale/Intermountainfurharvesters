-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 17, 2019 at 03:02 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intermountain_fur`
--

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

DROP TABLE IF EXISTS `bid`;
CREATE TABLE IF NOT EXISTS `bid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer_id` int(11) NOT NULL,
  `seller_item_id` int(11) NOT NULL,
  `bid_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `bid_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unconfirmed',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `seller_item_id` (`seller_item_id`),
  KEY `buyer_id` (`buyer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

DROP TABLE IF EXISTS `buyer`;
CREATE TABLE IF NOT EXISTS `buyer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `commission` decimal(12,2) NOT NULL,
  `fur_buyer_license_num` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_last_logged_in` timestamp NULL DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trapper_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `commission` decimal(12,2) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller_item`
--

DROP TABLE IF EXISTS `seller_item`;
CREATE TABLE IF NOT EXISTS `seller_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) NOT NULL,
  `lot` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item` varchar(255) COLLATE utf8_unicode_ci NULL,
  `unit_of_measure` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Count',
  `count` decimal(12,2) NOT NULL,
  `tag_id` varchar(255) COLLATE utf8_unicode_ci NULL,
  `asking` decimal(12,2) NOT NULL DEFAULT '0.00',
  `origin_state` varchar(255) COLLATE utf8_unicode_ci NULL,
  `bid_start` datetime NOT NULL,
  `bid_end` datetime NOT NULL,
  `sale_made` tinyint(1) NOT NULL DEFAULT '0',
  `seller_item` decimal(12,2) NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lot` (`lot`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NULL,
  `password_one_time` varchar(255) COLLATE utf8_unicode_ci NULL,
  `deletable` tinyint(1) NOT NULL DEFAULT '1',
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'administrator',
  `date_last_logged_in` timestamp NULL DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_unique` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `user` (`id`, `username`, `password`, `password_one_time`, `deletable`, `role`, `date_last_logged_in`, `date_created`) VALUES
(1, 'admin', '$2y$10$aFuHxhyY6PnrGjdCrQC5ZeFTatoFcGcM6iq.udEyja00rTE9u6WAS', NULL, 0, 'administrator', '2019-12-30 00:39:37', '2019-12-11 19:23:14');
-- --------------------------------------------------------

--
-- Table structure for table `site_info`
--

DROP TABLE IF EXISTS `site_info`;
CREATE TABLE IF NOT EXISTS `site_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) COLLATE utf8_unicode_ci NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'America/Los_Angeles',
  `bid_cutoff_days` int(11) NOT NULL DEFAULT '7',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `site_info` (`id`, `site_name`, `timezone`, `bid_cutoff_days`) VALUES
(1, 'Intermountain Fur', 'America/Los_Angeles', 7);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `fk_bid_buyer` FOREIGN KEY (`buyer_id`) REFERENCES `buyer` (`id`),
  ADD CONSTRAINT `fk_bid_seller_item` FOREIGN KEY (`seller_item_id`) REFERENCES `seller_item` (`id`);

--
-- Constraints for table `seller_item`
--
ALTER TABLE `seller_item`
  ADD CONSTRAINT `fk_seller_seller_id` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`id`);
COMMIT;

DROP TABLE IF EXISTS `item_type`;
CREATE TABLE IF NOT EXISTS `item_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

INSERT INTO `item_type` (`id`, `name`, `date_created`) VALUES
(1, 'Antlers', '2020-01-17 03:40:11'),
(2, 'Artic Fox', '2020-01-17 03:40:11'),
(3, 'Baculum', '2020-01-17 03:40:11'),
(4, 'Badger', '2020-01-17 03:40:11'),
(5, 'Bear Parts', '2020-01-17 03:40:11'),
(6, 'Bear rug', '2020-01-17 03:40:11'),
(7, 'Beaver', '2020-01-17 03:40:11'),
(8, 'Beaver Darts', '2020-01-17 03:40:11'),
(9, 'Beaver Skulls', '2020-01-17 03:40:11'),
(10, 'Beaver Tails', '2020-01-17 03:40:11'),
(11, 'Bee Hive', '2020-01-17 03:40:11'),
(12, 'Blue Fox', '2020-01-17 03:40:11'),
(13, 'Bobcat', '2020-01-17 03:40:11'),
(14, 'Bobcat Bones', '2020-01-17 03:40:11'),
(15, 'Bobcat Paws', '2020-01-17 03:40:11'),
(16, 'Bobcat Skull', '2020-01-17 03:40:11'),
(17, 'Castor', '2020-01-17 03:40:11'),
(18, 'Cougar', '2020-01-17 03:40:11'),
(19, 'Coyote', '2020-01-17 03:40:11'),
(20, 'Coyote Paws', '2020-01-17 03:40:11'),
(21, 'Coyote Skulls', '2020-01-17 03:40:11'),
(22, 'Cross Fox', '2020-01-17 03:40:11'),
(23, 'Earings', '2020-01-17 03:40:11'),
(24, 'Ermine', '2020-01-17 03:40:11'),
(25, 'Ermine Skull', '2020-01-17 03:40:11'),
(26, 'Fox Paws', '2020-01-17 03:40:11'),
(27, 'Fur Coat', '2020-01-17 03:40:11'),
(28, 'Fur Headband', '2020-01-17 03:40:11'),
(29, 'Fur Pieces', '2020-01-17 03:40:11'),
(30, 'Goat Skulls', '2020-01-17 03:40:11'),
(31, 'Goat / Sheep Horns', '2020-01-17 03:40:11'),
(32, 'Grey Fox', '2020-01-17 03:40:11'),
(33, 'Grouse Tails', '2020-01-17 03:40:11'),
(34, 'Hoop Art', '2020-01-17 03:40:11'),
(35, 'Indian Leather Jacket', '2020-01-17 03:40:11'),
(36, 'Indian Shield', '2020-01-17 03:40:11'),
(37, 'Lion Skull', '2020-01-17 03:40:11'),
(38, 'Lynx Feet', '2020-01-17 03:40:11'),
(39, 'Marten', '2020-01-17 03:40:11'),
(40, 'Mink', '2020-01-17 03:40:11'),
(41, 'Misc Bones', '2020-01-17 03:40:11'),
(42, 'Misc Skulls', '2020-01-17 03:40:11'),
(43, 'Muskrat', '2020-01-17 03:40:11'),
(44, 'Necklace', '2020-01-17 03:40:11'),
(45, 'Opossum', '2020-01-17 03:40:11'),
(46, 'Otter', '2020-01-17 03:40:11'),
(47, 'Porky Claws', '2020-01-17 03:40:11'),
(48, 'Porky Hair', '2020-01-17 03:40:11'),
(49, 'Porky Quills', '2020-01-17 03:40:11'),
(50, 'Raccoon', '2020-01-17 03:40:11'),
(51, 'Raccoon Paws', '2020-01-17 03:40:11'),
(52, 'Raccoon Skulls', '2020-01-17 03:40:11'),
(53, 'Red Fox', '2020-01-17 03:40:11'),
(54, 'Silver Fox', '2020-01-17 03:40:11'),
(55, 'Skunk', '2020-01-17 03:40:11'),
(56, 'Skunk Essence', '2020-01-17 03:40:11'),
(57, 'Skunk Skulls', '2020-01-17 03:40:11'),
(58, 'Tanned Lamb Skin', '2020-01-17 03:40:11'),
(59, 'Traps', '2020-01-17 03:40:11'),
(60, 'Turkey Beard', '2020-01-17 03:40:11'),
(61, 'Turkey Tails', '2020-01-17 03:40:11'),
(62, 'White fox', '2020-01-17 03:40:11'),
(63, 'Wolf', '2020-01-17 03:40:11'),
(64, 'Wolf Skull', '2020-01-17 03:40:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

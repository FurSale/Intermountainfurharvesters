-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 21, 2019 at 07:02 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`id`, `buyer_id`, `seller_item_id`, `bid_amount`, `bid_status`, `date_created`) VALUES
(1, 1, 1, '18.00', 'Confirmed', '2019-11-13 18:09:21'),
(3, 1, 3, '50.00', 'Confirmed', '2019-12-18 04:10:31'),
(4, 1, 5, '214.00', 'Confirmed', '2019-12-18 04:17:19'),
(6, 1, 8, '234.00', 'Unconfirmed', '2019-12-15 02:31:30'),
(7, 1, 9, '22.00', 'Confirmed', '2019-12-20 02:31:34'),
(16, 2, 1, '22.00', 'Confirmed', '2019-12-21 06:14:47'),
(17, 2, 9, '101.00', 'Confirmed', '2019-12-21 06:15:13'),
(18, 2, 3, '50.00', 'Confirmed', '2019-12-21 06:18:40');

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
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commission` decimal(12,2) NOT NULL,
  `fur_buyer_license_num` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_last_logged_in` timestamp NULL DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`id`, `first_name`, `last_name`, `company_name`, `address_1`, `address_2`, `city`, `state`, `zip`, `phone`, `email`, `commission`, `fur_buyer_license_num`, `date_last_logged_in`, `date_created`) VALUES
(1, 'one', 'last', 'comapny', 'address1', 'address2', 'city', 'ID', '83814', '1243213234', 'test@test.com', '2.00', '131313123', NULL, '2019-11-17 17:55:37'),
(2, 'two', 'last', 'test', '132213sdfdsf', '2432sdfsdf', 'wfdwfsdfsd', 'WA', '12323', '2342342342', 'test@test.com', '2.00', '123123', NULL, '2019-12-17 04:13:21');

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
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commission` decimal(12,2) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `trapper_id`, `first_name`, `last_name`, `address_1`, `address_2`, `city`, `state`, `zip`, `phone`, `email`, `commission`, `date_created`) VALUES
(1, '00001', 'testttt', 'btestificate2', 'sdfsdf', 'fdsfsdfsd', 'Coeur d\' Alene', 'ID', '13321', '', '', '6.00', '2019-11-17 17:44:57'),
(2, '00002', 'test2', 'testificate2', 'sdfsdf', 'fdsfsdfsd', '324r32432', 'WA', '13321', '', '', '0.00', '2019-12-02 07:05:35'),
(3, '00003', 'test', 'atest', '123231', '1321312', 'Spokane', 'WA', '21334', '2313124123', 'test@test.com', '0.00', '2019-12-02 07:16:34'),
(4, '00003', 'testfirst', 'testlast', '123231', '1321312', 'Spokane', 'WA', '21334', '2313124123', 'test@test.com', '0.00', '2019-12-02 07:17:51');

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
  `item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit_of_measure` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Count',
  `count` decimal(12,2) NOT NULL,
  `tag_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `asking` decimal(12,2) NOT NULL DEFAULT '0.00',
  `origin_state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bid_start` datetime NOT NULL,
  `bid_end` datetime NOT NULL,
  `sale_made` tinyint(1) NOT NULL DEFAULT '0',
  `sale_amount` decimal(12,2) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lot` (`lot`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seller_item`
--

INSERT INTO `seller_item` (`id`, `seller_id`, `lot`, `type`, `item`, `unit_of_measure`, `count`, `tag_id`, `asking`, `origin_state`, `bid_start`, `bid_end`, `sale_made`, `sale_amount`, `date_created`) VALUES
(1, 1, '1001', NULL, 'Artic Fox', 'Count', '10.00', '', '20.00', '', '2019-11-17 00:00:00', '2019-11-18 00:00:00', 0, NULL, '2019-11-17 18:08:51'),
(3, 1, '1002', NULL, 'Artic Fox', 'Count', '15.00', '', '50.00', '', '2019-11-17 00:00:00', '2019-11-18 00:00:00', 0, NULL, '2019-11-17 19:15:58'),
(4, 3, '10002', NULL, 'Badger', 'Count', '10.00', '10', '25.00', '', '2019-12-05 03:46:57', '2019-12-05 03:46:57', 0, NULL, '2019-12-05 03:46:57'),
(5, 3, '1003', NULL, 'Bear rug', 'Count', '23.00', '13', '123.00', '', '2019-12-05 03:49:29', '2019-12-05 03:49:29', 1, NULL, '2019-12-05 03:49:29'),
(6, 3, '2001', NULL, 'Beaver Darts', 'Count', '123123.00', '123', '12.00', '', '2019-12-05 03:49:29', '2019-12-05 03:49:29', 0, NULL, '2019-12-05 03:49:29'),
(7, 3, '3001', NULL, 'Beaver Tails', 'Count', '31231.00', '21312', '22.50', '', '2019-12-05 03:49:29', '2019-12-05 03:49:29', 0, NULL, '2019-12-05 03:49:29'),
(8, 3, '1004', NULL, 'Beaver Darts', 'Count', '224.00', '2423', '23.47', '', '2019-12-05 03:55:13', '2019-12-05 03:55:13', 0, NULL, '2019-12-05 03:55:13'),
(9, 1, '1005', NULL, 'Bear rug', 'Count', '1.00', '57655', '100.00', 'GA', '2019-12-10 04:02:09', '2019-12-10 04:02:09', 0, NULL, '2019-12-10 04:02:09'),
(10, 1, '1006', NULL, 'test', 'Count', '2.00', '12323', '5.00', 'ID', '2019-12-10 05:03:02', '2019-12-10 05:03:02', 1, NULL, '2019-12-10 05:03:02'),
(11, 2, '2423', NULL, 'Beaver Skulls', 'Count', '23.00', '2342fss', '20.00', 'DE', '2019-12-19 04:34:46', '2019-12-19 04:34:46', 0, NULL, '2019-12-19 04:34:46'),
(12, 2, '2423423', NULL, 'Bear Parts', 'Lbs', '24.00', '23432', '3.00', 'DC', '2019-12-19 04:34:46', '2019-12-19 04:34:46', 0, NULL, '2019-12-19 04:34:46'),
(13, 2, '23432423', NULL, 'Artic Fox', 'Count', '24.00', '1, 12, 123 ,12345', '23.00', 'FL', '2019-12-19 04:37:41', '2019-12-19 04:37:41', 0, NULL, '2019-12-19 04:37:41'),
(15, 3, '1075', NULL, 'Bobcat', 'Count', '10.00', '1235', '120000.00', 'WA', '2019-12-19 04:45:30', '2019-12-19 04:45:30', 0, NULL, '2019-12-19 04:45:30'),
(16, 3, '1007', NULL, 'test', 'ct', '1.00', NULL, '10.00', 'WA', '2019-12-21 03:50:15', '2019-12-21 03:50:15', 0, NULL, '2019-12-21 03:50:15'),
(17, 3, '1008', NULL, 'Earings', 'ct', '1.00', NULL, '18.00', 'ID', '2019-12-21 04:05:35', '2019-12-21 04:05:35', 0, NULL, '2019-12-21 04:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `site_info`
--

DROP TABLE IF EXISTS `site_info`;
CREATE TABLE IF NOT EXISTS `site_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `site_info`
--

INSERT INTO `site_info` (`id`, `site_name`) VALUES
(1, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_one_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deletable` tinyint(1) NOT NULL DEFAULT '1',
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'administrator',
  `date_last_logged_in` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_unique` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `password_one_time`, `deletable`, `role`, `date_last_logged_in`, `date_created`) VALUES
(1, 'admin', '$2y$10$aFuHxhyY6PnrGjdCrQC5ZeFTatoFcGcM6iq.udEyja00rTE9u6WAS', NULL, 0, 'administrator', '2019-12-21 06:03:34', '2019-12-11 19:23:14'),
(2, '1', NULL, '141181', 1, 'buyer', '2019-12-21 06:16:34', '2019-12-17 03:41:37'),
(3, '2', NULL, '507387', 1, 'buyer', '2019-12-21 06:18:19', '2019-12-17 04:13:21');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

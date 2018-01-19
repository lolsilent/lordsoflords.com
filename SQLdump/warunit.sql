-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 19, 2018 at 02:10 AM
-- Server version: 5.7.19
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warunit`
--

-- --------------------------------------------------------

--
-- Table structure for table `war_board`
--

DROP TABLE IF EXISTS `war_board`;
CREATE TABLE IF NOT EXISTS `war_board` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `star` tinyint(4) NOT NULL DEFAULT '0',
  `clan` varchar(5) NOT NULL DEFAULT '',
  `sex` varchar(15) NOT NULL DEFAULT '',
  `charname` varchar(15) NOT NULL DEFAULT '',
  `race` varchar(15) NOT NULL DEFAULT '',
  `level` decimal(65,0) NOT NULL DEFAULT '0',
  `message` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `timer` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4607 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `war_credits`
--

DROP TABLE IF EXISTS `war_credits`;
CREATE TABLE IF NOT EXISTS `war_credits` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL DEFAULT '',
  `charname` varchar(16) NOT NULL DEFAULT '',
  `credits` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `charname` (`charname`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `war_kills`
--

DROP TABLE IF EXISTS `war_kills`;
CREATE TABLE IF NOT EXISTS `war_kills` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(16) NOT NULL DEFAULT '',
  `killed` varchar(32) NOT NULL DEFAULT '',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3439 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `war_members`
--

DROP TABLE IF EXISTS `war_members`;
CREATE TABLE IF NOT EXISTS `war_members` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sid` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(16) NOT NULL DEFAULT '',
  `rank` tinyint(3) NOT NULL DEFAULT '0',
  `race` varchar(16) NOT NULL DEFAULT '',
  `clan` char(3) NOT NULL DEFAULT '',
  `sex` varchar(16) NOT NULL DEFAULT '',
  `charname` varchar(16) NOT NULL DEFAULT '',
  `gold` bigint(20) NOT NULL DEFAULT '0',
  `land` bigint(10) NOT NULL DEFAULT '0',
  `stealth` bigint(10) NOT NULL DEFAULT '0',
  `b1` bigint(10) NOT NULL DEFAULT '0',
  `b2` bigint(10) NOT NULL DEFAULT '0',
  `b3` bigint(10) NOT NULL DEFAULT '0',
  `b4` bigint(10) NOT NULL DEFAULT '0',
  `b5` bigint(10) NOT NULL DEFAULT '0',
  `u1` bigint(10) NOT NULL DEFAULT '0',
  `u2` bigint(10) NOT NULL DEFAULT '0',
  `u3` bigint(10) NOT NULL DEFAULT '0',
  `u4` bigint(10) NOT NULL DEFAULT '0',
  `u5` bigint(10) NOT NULL DEFAULT '0',
  `s1` bigint(20) NOT NULL DEFAULT '0',
  `s2` bigint(20) NOT NULL DEFAULT '0',
  `s3` bigint(20) NOT NULL DEFAULT '0',
  `s4` bigint(20) NOT NULL DEFAULT '0',
  `s5` bigint(20) NOT NULL DEFAULT '0',
  `sb1` bigint(20) NOT NULL DEFAULT '0',
  `sb2` bigint(20) NOT NULL DEFAULT '0',
  `sb3` bigint(20) NOT NULL DEFAULT '0',
  `tsb1` bigint(20) NOT NULL DEFAULT '0',
  `tsb2` bigint(20) NOT NULL DEFAULT '0',
  `tsb3` bigint(20) NOT NULL DEFAULT '0',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sid` (`sid`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `charname` (`charname`)
) ENGINE=MyISAM AUTO_INCREMENT=5860 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `war_messages`
--

DROP TABLE IF EXISTS `war_messages`;
CREATE TABLE IF NOT EXISTS `war_messages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(15) NOT NULL DEFAULT '',
  `receiver` varchar(15) NOT NULL DEFAULT '',
  `message` mediumtext NOT NULL,
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `receiver` (`receiver`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `war_news`
--

DROP TABLE IF EXISTS `war_news`;
CREATE TABLE IF NOT EXISTS `war_news` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(16) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=82832 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `war_paypal`
--

DROP TABLE IF EXISTS `war_paypal`;
CREATE TABLE IF NOT EXISTS `war_paypal` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `server` varchar(64) NOT NULL DEFAULT '',
  `amount` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `day` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `month` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `year` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `war_updater`
--

DROP TABLE IF EXISTS `war_updater`;
CREATE TABLE IF NOT EXISTS `war_updater` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hour` tinyint(4) NOT NULL DEFAULT '0',
  `minutes` tinyint(4) NOT NULL DEFAULT '0',
  `updated` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

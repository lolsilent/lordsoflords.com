-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 19, 2018 at 10:14 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messaging`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL DEFAULT '0',
  `mid` bigint(20) NOT NULL DEFAULT '0',
  `rid` bigint(20) NOT NULL DEFAULT '0',
  `body` text NOT NULL,
  `importance` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `dater` varchar(32) NOT NULL DEFAULT '',
  `delay_timer` int(11) NOT NULL DEFAULT '0',
  `timer` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`),
  KEY `mid` (`mid`),
  KEY `rid` (`rid`),
  KEY `timer` (`timer`),
  KEY `delay_timer` (`delay_timer`)
) ENGINE=MyISAM AUTO_INCREMENT=20300 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages_dragonorigin`
--

DROP TABLE IF EXISTS `messages_dragonorigin`;
CREATE TABLE IF NOT EXISTS `messages_dragonorigin` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL DEFAULT '0',
  `mid` bigint(20) NOT NULL DEFAULT '0',
  `rid` bigint(20) NOT NULL DEFAULT '0',
  `body` text NOT NULL,
  `importance` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `dater` varchar(32) NOT NULL DEFAULT '',
  `delay_timer` int(11) NOT NULL DEFAULT '0',
  `timer` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`),
  KEY `mid` (`mid`),
  KEY `rid` (`rid`),
  KEY `timer` (`timer`),
  KEY `delay_timer` (`delay_timer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Database: `silent_chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_content`
--

DROP TABLE IF EXISTS `chat_content`;
CREATE TABLE IF NOT EXISTS `chat_content` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `channel` varchar(15) NOT NULL DEFAULT '',
  `star` tinyint(4) NOT NULL DEFAULT '0',
  `guild` varchar(5) NOT NULL DEFAULT '',
  `sex` varchar(15) NOT NULL DEFAULT '',
  `charname` varchar(15) NOT NULL DEFAULT '',
  `level` int(10) NOT NULL DEFAULT '0',
  `receiver` varchar(15) NOT NULL DEFAULT '',
  `content` varchar(255) NOT NULL DEFAULT '',
  `gamename` varchar(15) NOT NULL DEFAULT '',
  `ip` varchar(25) NOT NULL DEFAULT '',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32519 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

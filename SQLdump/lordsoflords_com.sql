-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 19, 2018 at 02:11 AM
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
-- Database: `lordsoflords_com`
--

-- --------------------------------------------------------

--
-- Table structure for table `lofl_bio`
--

DROP TABLE IF EXISTS `lofl_bio`;
CREATE TABLE IF NOT EXISTS `lofl_bio` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `oke` tinyint(4) NOT NULL DEFAULT '0',
  `info` text NOT NULL,
  `timer` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=301 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lofl_gts`
--

DROP TABLE IF EXISTS `lofl_gts`;
CREATE TABLE IF NOT EXISTS `lofl_gts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `logs` mediumtext NOT NULL,
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12699 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lofl_guides`
--

DROP TABLE IF EXISTS `lofl_guides`;
CREATE TABLE IF NOT EXISTS `lofl_guides` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `cat` varchar(32) NOT NULL DEFAULT '',
  `sub` varchar(32) NOT NULL DEFAULT '',
  `date` varchar(64) NOT NULL DEFAULT '',
  `news` mediumtext NOT NULL,
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lofl_news`
--

DROP TABLE IF EXISTS `lofl_news`;
CREATE TABLE IF NOT EXISTS `lofl_news` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nid` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `date` varchar(64) NOT NULL DEFAULT '',
  `news` mediumtext NOT NULL,
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lofl_servers`
--

DROP TABLE IF EXISTS `lofl_servers`;
CREATE TABLE IF NOT EXISTS `lofl_servers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `server` varchar(50) NOT NULL DEFAULT '',
  `players` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `alive` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sdate` varchar(50) NOT NULL DEFAULT '',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55051 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

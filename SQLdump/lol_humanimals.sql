-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 19, 2018 at 10:12 PM
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
-- Database: `lol_humanimals`
--

-- --------------------------------------------------------

--
-- Table structure for table `hum_animals`
--

DROP TABLE IF EXISTS `hum_animals`;
CREATE TABLE IF NOT EXISTS `hum_animals` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(16) NOT NULL DEFAULT '',
  `a` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `b` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `c` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `d` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `e` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `g` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `h` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `l` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `m` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `r` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `s` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `t` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `w` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `timer` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `charname` (`charname`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hum_animals`
--

INSERT INTO `hum_animals` (`id`, `charname`, `a`, `b`, `c`, `d`, `e`, `g`, `h`, `l`, `m`, `r`, `s`, `t`, `w`, `timer`) VALUES
(1, 'Silent', 13, 10, 10, 5, 5, 5, 5, 5, 10, 5, 5, 36, 203, 0),
(2, 'violin', 167, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1171502900);

-- --------------------------------------------------------

--
-- Table structure for table `hum_areas`
--

DROP TABLE IF EXISTS `hum_areas`;
CREATE TABLE IF NOT EXISTS `hum_areas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(16) NOT NULL DEFAULT '',
  `a` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `b` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `c` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `d` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `e` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `g` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `h` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `l` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `m` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `r` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `s` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `t` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `w` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `timer` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `charname` (`charname`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hum_areas`
--

INSERT INTO `hum_areas` (`id`, `charname`, `a`, `b`, `c`, `d`, `e`, `g`, `h`, `l`, `m`, `r`, `s`, `t`, `w`, `timer`) VALUES
(1, 'Silent', 16, 10, 10, 10, 10, 10, 20, 10, 10, 10, 10, 10, 15, 0),
(2, 'violin', 99, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1131913870);

-- --------------------------------------------------------

--
-- Table structure for table `hum_members`
--

DROP TABLE IF EXISTS `hum_members`;
CREATE TABLE IF NOT EXISTS `hum_members` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL DEFAULT '',
  `password` varchar(16) NOT NULL DEFAULT '',
  `email` varchar(64) NOT NULL DEFAULT '',
  `sex` varchar(16) NOT NULL DEFAULT '',
  `charname` varchar(16) NOT NULL DEFAULT '',
  `province` varchar(16) NOT NULL DEFAULT '',
  `runes` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `food` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `water` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `wood` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `land` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `gold` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `power` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `k` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `i` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `honor` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `dead` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `vote` varchar(16) NOT NULL DEFAULT '',
  `king` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `session` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `timer` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `since` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `charname` (`charname`),
  UNIQUE KEY `province` (`province`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hum_paper`
--

DROP TABLE IF EXISTS `hum_paper`;
CREATE TABLE IF NOT EXISTS `hum_paper` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `news` varchar(255) NOT NULL DEFAULT '',
  `k` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `i` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `timer` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

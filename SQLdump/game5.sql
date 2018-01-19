-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 19, 2018 at 02:09 AM
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
-- Database: `game5`
--

-- --------------------------------------------------------

--
-- Table structure for table `lol_board`
--

DROP TABLE IF EXISTS `lol_board`;
CREATE TABLE IF NOT EXISTS `lol_board` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(15) NOT NULL DEFAULT '',
  `receiver` varchar(15) NOT NULL DEFAULT '',
  `news` mediumtext NOT NULL,
  `timer` decimal(20,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_charms`
--

DROP TABLE IF EXISTS `lol_charms`;
CREATE TABLE IF NOT EXISTS `lol_charms` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(15) NOT NULL DEFAULT '',
  `name` varchar(25) NOT NULL DEFAULT '',
  `life` tinyint(3) NOT NULL DEFAULT '0',
  `mana` tinyint(3) NOT NULL DEFAULT '0',
  `stamina` tinyint(3) NOT NULL DEFAULT '0',
  `strength` tinyint(3) NOT NULL DEFAULT '0',
  `dexterity` tinyint(3) NOT NULL DEFAULT '0',
  `agility` tinyint(3) NOT NULL DEFAULT '0',
  `intelligence` tinyint(3) NOT NULL DEFAULT '0',
  `concentration` tinyint(3) NOT NULL DEFAULT '0',
  `contravention` tinyint(3) NOT NULL DEFAULT '0',
  `timer` decimal(20,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5101 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_credits`
--

DROP TABLE IF EXISTS `lol_credits`;
CREATE TABLE IF NOT EXISTS `lol_credits` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL DEFAULT '',
  `charname` varchar(15) NOT NULL DEFAULT '',
  `credits` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `charname` (`charname`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_fight`
--

DROP TABLE IF EXISTS `lol_fight`;
CREATE TABLE IF NOT EXISTS `lol_fight` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `x` int(10) NOT NULL DEFAULT '0',
  `y` int(10) NOT NULL DEFAULT '0',
  `charname` int(11) NOT NULL DEFAULT '0',
  `life` int(10) NOT NULL DEFAULT '0',
  `mana` int(10) NOT NULL DEFAULT '0',
  `stamina` int(10) NOT NULL DEFAULT '0',
  `ocharname` varchar(15) NOT NULL DEFAULT '',
  `dupe` float NOT NULL DEFAULT '0',
  `timer` decimal(20,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=127647 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_inventory`
--

DROP TABLE IF EXISTS `lol_inventory`;
CREATE TABLE IF NOT EXISTS `lol_inventory` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(15) NOT NULL DEFAULT '',
  `used` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `itemname` varchar(25) NOT NULL DEFAULT '',
  `class` varchar(10) NOT NULL DEFAULT '0',
  `kind` varchar(15) NOT NULL DEFAULT '0',
  `damaged` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `durability` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `multi` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `rlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `rstrength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rintelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `min` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a1` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `a2` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `a3` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `a4` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `a5` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `a6` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `a7` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `a8` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `a9` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `timer` decimal(20,2) UNSIGNED NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=359830 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_kingdoms`
--

DROP TABLE IF EXISTS `lol_kingdoms`;
CREATE TABLE IF NOT EXISTS `lol_kingdoms` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `x` bigint(20) NOT NULL DEFAULT '0',
  `y` bigint(20) NOT NULL DEFAULT '0',
  `charname` varchar(15) NOT NULL DEFAULT '',
  `kingdom` varchar(15) NOT NULL DEFAULT '',
  `guards` bigint(20) NOT NULL DEFAULT '0',
  `elites` bigint(20) NOT NULL DEFAULT '0',
  `tax` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `gold` decimal(200,0) NOT NULL DEFAULT '0',
  `timer` decimal(20,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `kingdom` (`kingdom`)
) ENGINE=MyISAM AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_members`
--

DROP TABLE IF EXISTS `lol_members`;
CREATE TABLE IF NOT EXISTS `lol_members` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `sex` varchar(10) NOT NULL DEFAULT '',
  `charname` varchar(10) NOT NULL DEFAULT '',
  `class` varchar(10) NOT NULL DEFAULT '0',
  `level` bigint(10) UNSIGNED NOT NULL DEFAULT '0',
  `exp` decimal(200,0) UNSIGNED NOT NULL DEFAULT '0',
  `gold` decimal(200,0) UNSIGNED NOT NULL DEFAULT '0',
  `stash` decimal(200,0) UNSIGNED NOT NULL DEFAULT '0',
  `honor` float NOT NULL DEFAULT '0',
  `life` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `mana` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `stamina` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `plife` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `pmana` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `pstamina` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `strength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `dexterity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `agility` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `intelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `concentration` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `contravention` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `battleskill` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `magicskill` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `defenseskill` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `freeplay` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `x` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `y` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `kid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `location` varchar(16) NOT NULL DEFAULT '',
  `quests` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `auto` tinyint(4) NOT NULL DEFAULT '0',
  `evade` tinyint(4) NOT NULL DEFAULT '0',
  `onoff` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `jail` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `timer` decimal(20,2) UNSIGNED NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `charname` (`charname`)
) ENGINE=MyISAM AUTO_INCREMENT=5030 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_paper`
--

DROP TABLE IF EXISTS `lol_paper`;
CREATE TABLE IF NOT EXISTS `lol_paper` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nid` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `charname` varchar(15) NOT NULL DEFAULT '',
  `date` varchar(50) NOT NULL DEFAULT '',
  `news` mediumtext NOT NULL,
  `timer` decimal(20,2) UNSIGNED NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1036751 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_paypal`
--

DROP TABLE IF EXISTS `lol_paypal`;
CREATE TABLE IF NOT EXISTS `lol_paypal` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `server` varchar(15) NOT NULL DEFAULT '',
  `amount` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `day` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `month` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `year` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_reset`
--

DROP TABLE IF EXISTS `lol_reset`;
CREATE TABLE IF NOT EXISTS `lol_reset` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `day` tinyint(4) NOT NULL DEFAULT '0',
  `month` tinyint(4) NOT NULL DEFAULT '0',
  `updated` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_trade`
--

DROP TABLE IF EXISTS `lol_trade`;
CREATE TABLE IF NOT EXISTS `lol_trade` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(15) NOT NULL DEFAULT '',
  `ocharname` varchar(15) NOT NULL DEFAULT '',
  `tid` int(10) NOT NULL DEFAULT '0',
  `oid` int(10) NOT NULL DEFAULT '0',
  `timer` decimal(20,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `oid` (`oid`),
  UNIQUE KEY `tid` (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

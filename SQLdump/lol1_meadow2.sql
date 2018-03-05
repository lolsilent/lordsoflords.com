-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 05, 2018 at 12:55 AM
-- Server version: 5.7.19
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lol1_meadow2`
--

-- --------------------------------------------------------

--
-- Table structure for table `lol_allopass`
--

DROP TABLE IF EXISTS `lol_allopass`;
CREATE TABLE IF NOT EXISTS `lol_allopass` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `server` varchar(64) NOT NULL DEFAULT '',
  `amount` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `day` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `month` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `year` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(128) NOT NULL DEFAULT '',
  `charname` varchar(64) NOT NULL DEFAULT '',
  `sid` varchar(128) NOT NULL DEFAULT '',
  `recall` varchar(64) NOT NULL DEFAULT '',
  `obja` varchar(64) NOT NULL DEFAULT '',
  `objb` varchar(64) NOT NULL DEFAULT '',
  `objc` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `charname` (`charname`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_board`
--

DROP TABLE IF EXISTS `lol_board`;
CREATE TABLE IF NOT EXISTS `lol_board` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Guild` varchar(5) NOT NULL,
  `Sex` varchar(15) NOT NULL,
  `Charname` varchar(25) NOT NULL,
  `Race` varchar(15) NOT NULL,
  `Level` decimal(65,0) UNSIGNED NOT NULL DEFAULT '0',
  `Message` text NOT NULL,
  `ip` varchar(25) NOT NULL,
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8538 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_charms`
--

DROP TABLE IF EXISTS `lol_charms`;
CREATE TABLE IF NOT EXISTS `lol_charms` (
  `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Charname` varchar(25) NOT NULL DEFAULT '',
  `Name` varchar(25) NOT NULL DEFAULT '',
  `Strength` tinyint(3) NOT NULL DEFAULT '0',
  `Dexterity` tinyint(3) NOT NULL DEFAULT '0',
  `Agility` tinyint(3) NOT NULL DEFAULT '0',
  `Intelligence` tinyint(3) NOT NULL DEFAULT '0',
  `Concentration` tinyint(3) NOT NULL DEFAULT '0',
  `Contravention` tinyint(3) NOT NULL DEFAULT '0',
  `Time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Charname` (`Charname`),
  KEY `Name` (`Name`),
  KEY `Strength` (`Strength`),
  KEY `Dexterity` (`Dexterity`),
  KEY `Agility` (`Agility`),
  KEY `Intelligence` (`Intelligence`),
  KEY `Concentration` (`Concentration`),
  KEY `Contravention` (`Contravention`),
  KEY `Time` (`Time`)
) ENGINE=MyISAM AUTO_INCREMENT=1555973 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_councils`
--

DROP TABLE IF EXISTS `lol_councils`;
CREATE TABLE IF NOT EXISTS `lol_councils` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Sex` varchar(15) NOT NULL DEFAULT '0',
  `Apply` varchar(15) NOT NULL DEFAULT '',
  `Charname` varchar(25) NOT NULL DEFAULT '0',
  `Admin` int(10) NOT NULL DEFAULT '0',
  `Cop` int(10) NOT NULL DEFAULT '0',
  `Mod` int(10) NOT NULL DEFAULT '0',
  `Support` int(10) NOT NULL DEFAULT '0',
  `Time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Charname` (`Charname`)
) ENGINE=MyISAM AUTO_INCREMENT=13274 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_credits`
--

DROP TABLE IF EXISTS `lol_credits`;
CREATE TABLE IF NOT EXISTS `lol_credits` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Username` varchar(10) NOT NULL DEFAULT '',
  `Charname` varchar(25) NOT NULL DEFAULT '',
  `Credits` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Charname` (`Charname`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=MyISAM AUTO_INCREMENT=3706 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_deads`
--

DROP TABLE IF EXISTS `lol_deads`;
CREATE TABLE IF NOT EXISTS `lol_deads` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `News` text NOT NULL,
  `Date` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2518 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_duel`
--

DROP TABLE IF EXISTS `lol_duel`;
CREATE TABLE IF NOT EXISTS `lol_duel` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Challenger` varchar(25) NOT NULL DEFAULT '',
  `Mylevel` bigint(20) NOT NULL DEFAULT '0',
  `Opponent` varchar(25) NOT NULL DEFAULT '',
  `Level` bigint(20) NOT NULL DEFAULT '0',
  `Time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Challenger` (`Challenger`),
  KEY `Opponent` (`Opponent`),
  KEY `Time` (`Time`)
) ENGINE=MyISAM AUTO_INCREMENT=3440 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_graves`
--

DROP TABLE IF EXISTS `lol_graves`;
CREATE TABLE IF NOT EXISTS `lol_graves` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `News` text NOT NULL,
  `Date` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3563 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_guilds`
--

DROP TABLE IF EXISTS `lol_guilds`;
CREATE TABLE IF NOT EXISTS `lol_guilds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Sex` varchar(15) NOT NULL DEFAULT '',
  `Charname` varchar(25) NOT NULL DEFAULT '',
  `Password` varchar(55) NOT NULL DEFAULT '',
  `Guild` varchar(25) NOT NULL DEFAULT '',
  `Name` varchar(25) NOT NULL DEFAULT '',
  `Special` enum('Hidden Den','Honor Castle','Rune Temple') NOT NULL DEFAULT 'Hidden Den',
  `Won` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Lost` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Tied` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Tournament` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `Time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Charname` (`Charname`),
  UNIQUE KEY `Guild` (`Guild`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=MyISAM AUTO_INCREMENT=4664 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_history`
--

DROP TABLE IF EXISTS `lol_history`;
CREATE TABLE IF NOT EXISTS `lol_history` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Charname` varchar(25) NOT NULL DEFAULT '',
  `Kills` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Deads` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Duelsw` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Duelsl` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Charname` (`Charname`)
) ENGINE=MyISAM AUTO_INCREMENT=81440 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_index`
--

DROP TABLE IF EXISTS `lol_index`;
CREATE TABLE IF NOT EXISTS `lol_index` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` varchar(10) NOT NULL DEFAULT '',
  `fights` bigint(20) NOT NULL DEFAULT '0',
  `timer` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`),
  KEY `fights` (`fights`)
) ENGINE=MyISAM AUTO_INCREMENT=3273 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_items`
--

DROP TABLE IF EXISTS `lol_items`;
CREATE TABLE IF NOT EXISTS `lol_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL DEFAULT '0',
  `kind` tinyint(4) NOT NULL DEFAULT '0',
  `sub` tinyint(4) NOT NULL DEFAULT '0',
  `value` tinyint(4) NOT NULL DEFAULT '0',
  `timer` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_market`
--

DROP TABLE IF EXISTS `lol_market`;
CREATE TABLE IF NOT EXISTS `lol_market` (
  `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cid` bigint(20) NOT NULL DEFAULT '0',
  `Charname` varchar(25) NOT NULL DEFAULT '',
  `Name` varchar(25) NOT NULL DEFAULT '',
  `Strength` tinyint(3) NOT NULL DEFAULT '0',
  `Dexterity` tinyint(3) NOT NULL DEFAULT '0',
  `Agility` tinyint(3) NOT NULL DEFAULT '0',
  `Intelligence` tinyint(3) NOT NULL DEFAULT '0',
  `Concentration` tinyint(3) NOT NULL DEFAULT '0',
  `Contravention` tinyint(3) NOT NULL DEFAULT '0',
  `Gold` decimal(200,0) NOT NULL DEFAULT '0',
  `Credits` smallint(6) NOT NULL DEFAULT '0',
  `Bidder` varchar(25) NOT NULL DEFAULT '',
  `Bids` int(11) NOT NULL DEFAULT '0',
  `Time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cid` (`cid`),
  KEY `Charname` (`Charname`)
) ENGINE=MyISAM AUTO_INCREMENT=8472 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_members`
--

DROP TABLE IF EXISTS `lol_members`;
CREATE TABLE IF NOT EXISTS `lol_members` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Username` varchar(10) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Guild` varchar(5) NOT NULL,
  `Sex` varchar(15) NOT NULL,
  `Charname` varchar(25) NOT NULL,
  `Race` varchar(15) NOT NULL,
  `Level` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Exp` decimal(65,0) NOT NULL DEFAULT '0',
  `Gold` decimal(65,0) NOT NULL DEFAULT '0',
  `Life` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Strength` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Dexterity` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Agility` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Intelligence` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Concentration` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Contravention` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Weapon` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Attackspell` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Healspell` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Helmet` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Shield` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Amulet` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Ring` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Armor` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Belt` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Pants` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Hand` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Feet` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Dead` int(1) UNSIGNED NOT NULL DEFAULT '0',
  `Jail` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Stealth` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Freeplay` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Stash` decimal(65,0) UNSIGNED NOT NULL DEFAULT '0',
  `Onoff` int(1) UNSIGNED NOT NULL DEFAULT '0',
  `Mute` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Time` decimal(20,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `Loginfail` tinyint(4) NOT NULL DEFAULT '0',
  `Loginfailip` varchar(55) NOT NULL,
  `Friend` varchar(55) NOT NULL,
  `ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Charname` (`Charname`),
  KEY `Password` (`Password`),
  KEY `Level` (`Level`),
  KEY `Exp` (`Exp`),
  KEY `Gold` (`Gold`),
  KEY `Onoff` (`Onoff`),
  KEY `Time` (`Time`)
) ENGINE=MyISAM AUTO_INCREMENT=105554 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_messages`
--

DROP TABLE IF EXISTS `lol_messages`;
CREATE TABLE IF NOT EXISTS `lol_messages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Charname` varchar(25) NOT NULL DEFAULT '',
  `Receiver` varchar(25) NOT NULL DEFAULT '',
  `Message` text NOT NULL,
  `Date` varchar(100) NOT NULL DEFAULT '',
  `Time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Charname` (`Charname`),
  KEY `Receiver` (`Receiver`),
  KEY `Time` (`Time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_paper`
--

DROP TABLE IF EXISTS `lol_paper`;
CREATE TABLE IF NOT EXISTS `lol_paper` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `News` text NOT NULL,
  `Date` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12740 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_paypal`
--

DROP TABLE IF EXISTS `lol_paypal`;
CREATE TABLE IF NOT EXISTS `lol_paypal` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `server` varchar(64) NOT NULL DEFAULT '',
  `amount` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `day` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `month` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `year` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3789 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_politics`
--

DROP TABLE IF EXISTS `lol_politics`;
CREATE TABLE IF NOT EXISTS `lol_politics` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Sex` varchar(15) NOT NULL DEFAULT '0',
  `Charname` varchar(25) NOT NULL DEFAULT '0',
  `Praise` varchar(25) NOT NULL DEFAULT '0',
  `Vote` tinyint(4) NOT NULL DEFAULT '0',
  `Time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Charname` (`Charname`),
  UNIQUE KEY `ip` (`ip`),
  KEY `Praise` (`Praise`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
-- Table structure for table `lol_smembers`
--

DROP TABLE IF EXISTS `lol_smembers`;
CREATE TABLE IF NOT EXISTS `lol_smembers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Username` varchar(10) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Guild` varchar(5) NOT NULL,
  `Sex` varchar(15) NOT NULL,
  `Charname` varchar(25) NOT NULL,
  `Race` varchar(15) NOT NULL,
  `Level` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Exp` decimal(65,0) NOT NULL DEFAULT '0',
  `Gold` decimal(65,0) NOT NULL DEFAULT '0',
  `Life` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Strength` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Dexterity` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Agility` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Intelligence` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Concentration` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Contravention` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Weapon` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Attackspell` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Healspell` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Helmet` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Shield` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Amulet` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Ring` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Armor` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Belt` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Pants` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Hand` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Feet` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Dead` int(1) UNSIGNED NOT NULL DEFAULT '0',
  `Jail` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Stealth` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Freeplay` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Stash` decimal(65,0) UNSIGNED NOT NULL DEFAULT '0',
  `Onoff` int(1) UNSIGNED NOT NULL DEFAULT '0',
  `Mute` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Time` decimal(20,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `Loginfail` tinyint(4) NOT NULL DEFAULT '0',
  `Loginfailip` varchar(55) NOT NULL,
  `Friend` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Password` (`Password`),
  KEY `Level` (`Level`),
  KEY `Exp` (`Exp`),
  KEY `Gold` (`Gold`),
  KEY `Onoff` (`Onoff`),
  KEY `Time` (`Time`),
  KEY `Username` (`Username`),
  KEY `Charname` (`Charname`)
) ENGINE=MyISAM AUTO_INCREMENT=252727 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_steals`
--

DROP TABLE IF EXISTS `lol_steals`;
CREATE TABLE IF NOT EXISTS `lol_steals` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Charname` varchar(25) NOT NULL,
  `Item` varchar(255) NOT NULL,
  `Amount` decimal(65,0) UNSIGNED NOT NULL DEFAULT '0',
  `Date` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Charname` (`Charname`)
) ENGINE=MyISAM AUTO_INCREMENT=598965 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_support`
--

DROP TABLE IF EXISTS `lol_support`;
CREATE TABLE IF NOT EXISTS `lol_support` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `M` varchar(15) NOT NULL DEFAULT '',
  `Y` varchar(15) NOT NULL DEFAULT '',
  `Exp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Gold` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Strength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Dexterity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Agility` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Intelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Concentration` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Contravention` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Weapon` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Attackspell` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Healspell` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Helmet` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Shield` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Amulet` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Ring` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Armor` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Belt` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Pants` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Hand` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Feet` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Maxgold` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `30days` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `5days` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `month` (`M`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_tournament`
--

DROP TABLE IF EXISTS `lol_tournament`;
CREATE TABLE IF NOT EXISTS `lol_tournament` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Teama` varchar(5) NOT NULL DEFAULT '',
  `Teamb` varchar(5) NOT NULL DEFAULT '',
  `Winner` varchar(5) NOT NULL DEFAULT '',
  `Starts` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Ends` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Teamb` (`Teamb`),
  UNIQUE KEY `Teama` (`Teama`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_tourpaper`
--

DROP TABLE IF EXISTS `lol_tourpaper`;
CREATE TABLE IF NOT EXISTS `lol_tourpaper` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Versus` varchar(100) NOT NULL DEFAULT '',
  `News` text NOT NULL,
  `Date` varchar(55) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_tourwinner`
--

DROP TABLE IF EXISTS `lol_tourwinner`;
CREATE TABLE IF NOT EXISTS `lol_tourwinner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Winner` varchar(5) NOT NULL DEFAULT '',
  `Time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_world`
--

DROP TABLE IF EXISTS `lol_world`;
CREATE TABLE IF NOT EXISTS `lol_world` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Charname` varchar(25) NOT NULL DEFAULT '',
  `Item` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Charname` (`Charname`)
) ENGINE=MyISAM AUTO_INCREMENT=275592 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_zlogs`
--

DROP TABLE IF EXISTS `lol_zlogs`;
CREATE TABLE IF NOT EXISTS `lol_zlogs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `charname` varchar(55) NOT NULL DEFAULT '',
  `logs` mediumtext NOT NULL,
  `file` varchar(25) NOT NULL DEFAULT '',
  `date` varchar(55) NOT NULL DEFAULT '',
  `ip` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `charname` (`charname`)
) ENGINE=MyISAM AUTO_INCREMENT=22955 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

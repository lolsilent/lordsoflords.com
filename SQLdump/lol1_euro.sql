-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 05, 2018 at 12:54 AM
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
-- Database: `lol1_euro`
--

-- --------------------------------------------------------

--
-- Table structure for table `lol_board`
--

DROP TABLE IF EXISTS `lol_board`;
CREATE TABLE IF NOT EXISTS `lol_board` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `star` tinyint(4) NOT NULL DEFAULT '0',
  `clan` varchar(5) NOT NULL DEFAULT '',
  `sex` varchar(15) NOT NULL DEFAULT '',
  `charname` varchar(15) NOT NULL DEFAULT '',
  `race` varchar(15) NOT NULL DEFAULT '',
  `level` bigint(20) NOT NULL DEFAULT '0',
  `message` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `timer` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=357283 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_charms`
--

DROP TABLE IF EXISTS `lol_charms`;
CREATE TABLE IF NOT EXISTS `lol_charms` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(15) NOT NULL DEFAULT '',
  `finder` varchar(15) NOT NULL DEFAULT '',
  `name` varchar(15) NOT NULL DEFAULT '',
  `str` tinyint(3) NOT NULL DEFAULT '0',
  `dex` tinyint(3) NOT NULL DEFAULT '0',
  `agi` tinyint(3) NOT NULL DEFAULT '0',
  `intel` tinyint(3) NOT NULL DEFAULT '0',
  `conc` tinyint(3) NOT NULL DEFAULT '0',
  `cont` tinyint(3) NOT NULL DEFAULT '0',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `charname` (`charname`)
) ENGINE=MyISAM AUTO_INCREMENT=46312 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_clans`
--

DROP TABLE IF EXISTS `lol_clans`;
CREATE TABLE IF NOT EXISTS `lol_clans` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sex` varchar(15) NOT NULL DEFAULT '',
  `charname` varchar(15) NOT NULL DEFAULT '',
  `password` varchar(15) NOT NULL DEFAULT '',
  `clan` varchar(5) NOT NULL DEFAULT '',
  `name` varchar(15) NOT NULL DEFAULT '',
  `won` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lost` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `tied` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `points` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `tourney` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `charname` (`charname`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `clan` (`clan`)
) ENGINE=MyISAM AUTO_INCREMENT=496 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_councils`
--

DROP TABLE IF EXISTS `lol_councils`;
CREATE TABLE IF NOT EXISTS `lol_councils` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sex` varchar(15) NOT NULL DEFAULT '',
  `apply` varchar(15) NOT NULL DEFAULT '',
  `charname` varchar(15) NOT NULL DEFAULT '',
  `admin` int(11) NOT NULL DEFAULT '0',
  `cop` int(11) NOT NULL DEFAULT '0',
  `mod` int(11) NOT NULL DEFAULT '0',
  `support` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(11) NOT NULL DEFAULT '',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1660 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_credits`
--

DROP TABLE IF EXISTS `lol_credits`;
CREATE TABLE IF NOT EXISTS `lol_credits` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL DEFAULT '',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `credits` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `charname` (`charname`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=149 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_duel`
--

DROP TABLE IF EXISTS `lol_duel`;
CREATE TABLE IF NOT EXISTS `lol_duel` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `challenger` varchar(15) NOT NULL DEFAULT '',
  `opponent` varchar(15) NOT NULL DEFAULT '',
  `kind` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `challenger` (`challenger`),
  KEY `opponent` (`opponent`)
) ENGINE=MyISAM AUTO_INCREMENT=84262 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_history`
--

DROP TABLE IF EXISTS `lol_history`;
CREATE TABLE IF NOT EXISTS `lol_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `charname` varchar(15) NOT NULL DEFAULT '',
  `kills` bigint(20) NOT NULL DEFAULT '0',
  `deads` bigint(20) NOT NULL DEFAULT '0',
  `duelsw` bigint(20) NOT NULL DEFAULT '0',
  `duelsl` bigint(20) NOT NULL DEFAULT '0',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `charname` (`charname`)
) ENGINE=MyISAM AUTO_INCREMENT=6979 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_index`
--

DROP TABLE IF EXISTS `lol_index`;
CREATE TABLE IF NOT EXISTS `lol_index` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` varchar(10) NOT NULL DEFAULT '',
  `fights` bigint(20) NOT NULL DEFAULT '0',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`)
) ENGINE=MyISAM AUTO_INCREMENT=1596 DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_market`
--

DROP TABLE IF EXISTS `lol_market`;
CREATE TABLE IF NOT EXISTS `lol_market` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cid` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `charname` varchar(15) NOT NULL DEFAULT '',
  `gold` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `credits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_marketxp`
--

DROP TABLE IF EXISTS `lol_marketxp`;
CREATE TABLE IF NOT EXISTS `lol_marketxp` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `xp` decimal(65,0) UNSIGNED NOT NULL DEFAULT '0',
  `charname` varchar(15) NOT NULL DEFAULT '',
  `credits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `bids` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ends` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cid` (`xp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_members`
--

DROP TABLE IF EXISTS `lol_members`;
CREATE TABLE IF NOT EXISTS `lol_members` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sid` varchar(64) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `clan` varchar(5) NOT NULL,
  `sex` varchar(15) NOT NULL,
  `charname` varchar(15) NOT NULL,
  `race` varchar(15) NOT NULL,
  `level` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `xp` decimal(65,0) NOT NULL DEFAULT '0',
  `gold` decimal(65,0) NOT NULL DEFAULT '0',
  `stash` decimal(65,0) NOT NULL DEFAULT '0',
  `life` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `str` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `dex` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `agi` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `intel` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `conc` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `cont` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `weapon` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `spell` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `heal` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `helm` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `shield` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `amulet` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `ring` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `armor` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `belt` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `pants` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `hand` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `feet` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `jail` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `stealth` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `twin` tinyint(4) NOT NULL DEFAULT '0',
  `fp` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `mute` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `vote` varchar(15) NOT NULL,
  `timer` decimal(20,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `fail` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `friend` varchar(25) NOT NULL,
  `ip` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `charname` (`charname`),
  UNIQUE KEY `sid` (`sid`),
  KEY `sex` (`sex`),
  KEY `race` (`race`),
  KEY `level` (`level`),
  KEY `xp` (`xp`),
  KEY `gold` (`gold`),
  KEY `timer` (`timer`)
) ENGINE=MyISAM AUTO_INCREMENT=5150 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_messages`
--

DROP TABLE IF EXISTS `lol_messages`;
CREATE TABLE IF NOT EXISTS `lol_messages` (
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
-- Table structure for table `lol_papers`
--

DROP TABLE IF EXISTS `lol_papers`;
CREATE TABLE IF NOT EXISTS `lol_papers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` tinyint(4) NOT NULL DEFAULT '0',
  `news` text NOT NULL,
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1002533 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=313 DEFAULT CHARSET=latin1;

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
-- Table structure for table `lol_save`
--

DROP TABLE IF EXISTS `lol_save`;
CREATE TABLE IF NOT EXISTS `lol_save` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `charname` varchar(15) NOT NULL,
  `level` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `xp` decimal(65,0) NOT NULL DEFAULT '0',
  `gold` decimal(65,0) NOT NULL DEFAULT '0',
  `stash` decimal(65,0) NOT NULL DEFAULT '0',
  `life` bigint(20) NOT NULL DEFAULT '0',
  `str` bigint(20) NOT NULL DEFAULT '0',
  `dex` bigint(20) NOT NULL DEFAULT '0',
  `agi` bigint(20) NOT NULL DEFAULT '0',
  `intel` bigint(20) NOT NULL DEFAULT '0',
  `conc` bigint(20) NOT NULL DEFAULT '0',
  `cont` bigint(20) NOT NULL DEFAULT '0',
  `weapon` bigint(20) NOT NULL DEFAULT '0',
  `spell` bigint(20) NOT NULL DEFAULT '0',
  `heal` bigint(20) NOT NULL DEFAULT '0',
  `helm` bigint(20) NOT NULL DEFAULT '0',
  `shield` bigint(20) NOT NULL DEFAULT '0',
  `amulet` bigint(20) NOT NULL DEFAULT '0',
  `ring` bigint(20) NOT NULL DEFAULT '0',
  `armor` bigint(20) NOT NULL DEFAULT '0',
  `belt` bigint(20) NOT NULL DEFAULT '0',
  `pants` bigint(20) NOT NULL DEFAULT '0',
  `hand` bigint(20) NOT NULL DEFAULT '0',
  `feet` bigint(20) NOT NULL DEFAULT '0',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `timer` (`timer`)
) ENGINE=MyISAM AUTO_INCREMENT=31707 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_steals`
--

DROP TABLE IF EXISTS `lol_steals`;
CREATE TABLE IF NOT EXISTS `lol_steals` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sex` varchar(15) NOT NULL DEFAULT '',
  `charname` varchar(15) NOT NULL DEFAULT '',
  `item` varchar(32) NOT NULL DEFAULT '',
  `amount` bigint(20) NOT NULL DEFAULT '0',
  `timer` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=128503 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_tourney`
--

DROP TABLE IF EXISTS `lol_tourney`;
CREATE TABLE IF NOT EXISTS `lol_tourney` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `clana` varchar(5) NOT NULL DEFAULT '',
  `clanb` varchar(5) NOT NULL DEFAULT '',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_tourprice`
--

DROP TABLE IF EXISTS `lol_tourprice`;
CREATE TABLE IF NOT EXISTS `lol_tourprice` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `clan` varchar(5) NOT NULL,
  `xp` decimal(65,0) UNSIGNED NOT NULL DEFAULT '0',
  `gold` decimal(65,0) UNSIGNED NOT NULL DEFAULT '0',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_zlogs`
--

DROP TABLE IF EXISTS `lol_zlogs`;
CREATE TABLE IF NOT EXISTS `lol_zlogs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(15) NOT NULL DEFAULT '',
  `logs` mediumtext NOT NULL,
  `file` varchar(15) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20504 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

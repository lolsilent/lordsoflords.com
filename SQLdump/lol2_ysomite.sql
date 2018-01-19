-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 19, 2018 at 02:08 AM
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
-- Database: `lol2_ysomite`
--

-- --------------------------------------------------------

--
-- Table structure for table `lol2_board`
--

DROP TABLE IF EXISTS `lol2_board`;
CREATE TABLE IF NOT EXISTS `lol2_board` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `creator` varchar(100) NOT NULL DEFAULT '',
  `crintel` varchar(100) NOT NULL DEFAULT '',
  `news` mediumtext NOT NULL,
  `date` varchar(100) NOT NULL DEFAULT '',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4041 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_bugs`
--

DROP TABLE IF EXISTS `lol2_bugs`;
CREATE TABLE IF NOT EXISTS `lol2_bugs` (
  `id` int(16) UNSIGNED NOT NULL AUTO_INCREMENT,
  `news` mediumtext NOT NULL,
  `date` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=201 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_credits`
--

DROP TABLE IF EXISTS `lol2_credits`;
CREATE TABLE IF NOT EXISTS `lol2_credits` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Username` varchar(10) NOT NULL DEFAULT '',
  `Charname` varchar(25) NOT NULL DEFAULT '',
  `Credits` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Charname` (`Charname`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_deads`
--

DROP TABLE IF EXISTS `lol2_deads`;
CREATE TABLE IF NOT EXISTS `lol2_deads` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `news` mediumtext NOT NULL,
  `date` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=276 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_duel`
--

DROP TABLE IF EXISTS `lol2_duel`;
CREATE TABLE IF NOT EXISTS `lol2_duel` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(25) NOT NULL DEFAULT '0',
  `level` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `opponent` varchar(25) NOT NULL DEFAULT '0',
  `levelo` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `charname` (`charname`),
  KEY `opponent` (`opponent`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_history`
--

DROP TABLE IF EXISTS `lol2_history`;
CREATE TABLE IF NOT EXISTS `lol2_history` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cid` varchar(10) NOT NULL DEFAULT '0',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `kills` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `deads` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `duelsw` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `duelsl` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `goldw` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `goldl` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `expw` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `expl` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `charname` (`charname`),
  UNIQUE KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=4495 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_inventory`
--

DROP TABLE IF EXISTS `lol2_inventory`;
CREATE TABLE IF NOT EXISTS `lol2_inventory` (
  `id` int(16) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cid` varchar(10) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '0',
  `charname` varchar(25) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `name` varchar(25) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `power` bigint(32) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29268 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_market`
--

DROP TABLE IF EXISTS `lol2_market`;
CREATE TABLE IF NOT EXISTS `lol2_market` (
  `id` int(16) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cid` varchar(10) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '0',
  `charname` varchar(25) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `name` varchar(25) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `power` bigint(32) UNSIGNED NOT NULL DEFAULT '0',
  `price` bigint(32) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(16) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16979 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_mdeads`
--

DROP TABLE IF EXISTS `lol2_mdeads`;
CREATE TABLE IF NOT EXISTS `lol2_mdeads` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `news` mediumtext NOT NULL,
  `date` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=188010 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_members`
--

DROP TABLE IF EXISTS `lol2_members`;
CREATE TABLE IF NOT EXISTS `lol2_members` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cid` varchar(10) NOT NULL DEFAULT '0',
  `username` varchar(10) NOT NULL DEFAULT '',
  `password` varchar(10) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `sex` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `race` varchar(25) NOT NULL DEFAULT 'Human',
  `class` varchar(25) NOT NULL DEFAULT '0',
  `k` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `i` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `dead` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `jail` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `stealth` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `stash` decimal(200,0) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(100) NOT NULL DEFAULT '',
  `dollars` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `onoff` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `since` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cid` (`cid`),
  UNIQUE KEY `charname` (`charname`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=5561 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_messages`
--

DROP TABLE IF EXISTS `lol2_messages`;
CREATE TABLE IF NOT EXISTS `lol2_messages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(25) NOT NULL DEFAULT '0',
  `receiver` varchar(25) NOT NULL DEFAULT '0',
  `message` mediumtext NOT NULL,
  `date` varchar(100) NOT NULL DEFAULT '',
  `Time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_monsters`
--

DROP TABLE IF EXISTS `lol2_monsters`;
CREATE TABLE IF NOT EXISTS `lol2_monsters` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cid` varchar(10) NOT NULL DEFAULT '0',
  `sex` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `race` varchar(25) NOT NULL DEFAULT 'Troll',
  `class` varchar(25) NOT NULL DEFAULT '0',
  `k` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `i` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(15) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `charname` (`charname`),
  UNIQUE KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=1448051 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_mstats`
--

DROP TABLE IF EXISTS `lol2_mstats`;
CREATE TABLE IF NOT EXISTS `lol2_mstats` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cid` varchar(10) NOT NULL DEFAULT '0',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `level` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `exp` decimal(200,0) NOT NULL DEFAULT '0',
  `gold` decimal(200,0) NOT NULL DEFAULT '250',
  `life` bigint(20) UNSIGNED NOT NULL DEFAULT '100',
  `mana` bigint(20) UNSIGNED NOT NULL DEFAULT '10',
  `stamina` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `strength` bigint(20) UNSIGNED NOT NULL DEFAULT '25',
  `dexterity` bigint(20) UNSIGNED NOT NULL DEFAULT '10',
  `agility` bigint(20) UNSIGNED NOT NULL DEFAULT '5',
  `intelligence` bigint(20) UNSIGNED NOT NULL DEFAULT '15',
  `concentration` bigint(20) UNSIGNED NOT NULL DEFAULT '5',
  `contravention` bigint(20) UNSIGNED NOT NULL DEFAULT '5',
  `charisma` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `weapon` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `attackspell` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `healspell` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `helmet` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `shield` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `belt` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `armor` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `ring` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `amulet` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cid` (`cid`),
  UNIQUE KEY `charname` (`charname`)
) ENGINE=MyISAM AUTO_INCREMENT=1451945 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_paper`
--

DROP TABLE IF EXISTS `lol2_paper`;
CREATE TABLE IF NOT EXISTS `lol2_paper` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `news` mediumtext NOT NULL,
  `date` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2295 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_paypal`
--

DROP TABLE IF EXISTS `lol2_paypal`;
CREATE TABLE IF NOT EXISTS `lol2_paypal` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `server` varchar(25) NOT NULL DEFAULT '',
  `amount` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `day` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `month` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `year` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_quest`
--

DROP TABLE IF EXISTS `lol2_quest`;
CREATE TABLE IF NOT EXISTS `lol2_quest` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cid` varchar(10) NOT NULL DEFAULT '0',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `q1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q6` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q7` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q8` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q9` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q10` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q11` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q12` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q13` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q14` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q15` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q16` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q17` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q18` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q19` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q20` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q21` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q22` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q23` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q24` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q25` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q26` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q27` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q28` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q29` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q30` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q31` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q32` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q33` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q34` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q35` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q36` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q37` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q38` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q39` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q40` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q41` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q42` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q43` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q44` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q45` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q46` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q47` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q48` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q49` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `q50` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `charname` (`charname`),
  UNIQUE KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=4494 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_skills`
--

DROP TABLE IF EXISTS `lol2_skills`;
CREATE TABLE IF NOT EXISTS `lol2_skills` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cid` varchar(10) NOT NULL DEFAULT '0',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `s1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s6` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s7` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s8` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s9` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s10` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s11` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s12` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s13` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s14` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s15` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s16` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s17` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s18` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s19` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `s20` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `charname` (`charname`),
  UNIQUE KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=4495 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_stash`
--

DROP TABLE IF EXISTS `lol2_stash`;
CREATE TABLE IF NOT EXISTS `lol2_stash` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cid` varchar(10) NOT NULL DEFAULT '0',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `gold` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `weapon` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `attackspell` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `healspell` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `helmet` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `shield` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `belt` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `armor` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `ring` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `amulet` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `charname` (`charname`),
  UNIQUE KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=4495 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_support`
--

DROP TABLE IF EXISTS `lol2_support`;
CREATE TABLE IF NOT EXISTS `lol2_support` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `month` varchar(15) NOT NULL DEFAULT '',
  `exp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `gold` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `strength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `dexterity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `agility` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `intelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `concentration` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `contravention` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `charisma` int(10) NOT NULL DEFAULT '0',
  `weapon` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `attackspell` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `healspell` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `helmet` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `shield` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `amulet` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ring` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `armor` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `belt` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `pants` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `hand` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `feet` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `maxgold` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `30days` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `5days` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `month` (`month`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_trades`
--

DROP TABLE IF EXISTS `lol2_trades`;
CREATE TABLE IF NOT EXISTS `lol2_trades` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `news` mediumtext NOT NULL,
  `date` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2470 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol2_zlogs`
--

DROP TABLE IF EXISTS `lol2_zlogs`;
CREATE TABLE IF NOT EXISTS `lol2_zlogs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `charname` varchar(55) NOT NULL DEFAULT '',
  `logs` mediumtext NOT NULL,
  `file` varchar(25) NOT NULL DEFAULT '',
  `date` varchar(55) NOT NULL DEFAULT '',
  `ip` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

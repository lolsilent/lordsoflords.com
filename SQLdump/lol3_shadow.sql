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
-- Database: `lol3_shadow`
--

-- --------------------------------------------------------

--
-- Table structure for table `lol3_bingo`
--

DROP TABLE IF EXISTS `lol3_bingo`;
CREATE TABLE IF NOT EXISTS `lol3_bingo` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(15) NOT NULL DEFAULT '',
  `n0` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `n1` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `n2` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `n3` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `n4` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `n5` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `n6` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `n7` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `n8` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `n9` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `charname` (`charname`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_board`
--

DROP TABLE IF EXISTS `lol3_board`;
CREATE TABLE IF NOT EXISTS `lol3_board` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `star` tinyint(4) NOT NULL DEFAULT '0',
  `sex` varchar(15) NOT NULL DEFAULT '',
  `charname` varchar(15) NOT NULL DEFAULT '',
  `class` varchar(15) NOT NULL DEFAULT '',
  `level` int(10) NOT NULL DEFAULT '0',
  `receiver` varchar(15) NOT NULL DEFAULT '',
  `news` mediumtext NOT NULL,
  `gamename` varchar(15) NOT NULL DEFAULT '',
  `ip` varchar(25) NOT NULL DEFAULT '',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2843 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_charms`
--

DROP TABLE IF EXISTS `lol3_charms`;
CREATE TABLE IF NOT EXISTS `lol3_charms` (
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
  `time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13506 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_councils`
--

DROP TABLE IF EXISTS `lol3_councils`;
CREATE TABLE IF NOT EXISTS `lol3_councils` (
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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_credits`
--

DROP TABLE IF EXISTS `lol3_credits`;
CREATE TABLE IF NOT EXISTS `lol3_credits` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Username` varchar(10) NOT NULL DEFAULT '',
  `Charname` varchar(25) NOT NULL DEFAULT '',
  `Credits` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Charname` (`Charname`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_deads`
--

DROP TABLE IF EXISTS `lol3_deads`;
CREATE TABLE IF NOT EXISTS `lol3_deads` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` varchar(25) NOT NULL DEFAULT '',
  `news` mediumtext NOT NULL,
  `fid` varchar(25) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `fid` (`fid`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_fight`
--

DROP TABLE IF EXISTS `lol3_fight`;
CREATE TABLE IF NOT EXISTS `lol3_fight` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `x` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `y` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `location` varchar(25) NOT NULL DEFAULT '',
  `game` varchar(25) NOT NULL DEFAULT '',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `life` int(10) NOT NULL DEFAULT '0',
  `mana` int(10) NOT NULL DEFAULT '0',
  `stamina` int(10) NOT NULL DEFAULT '0',
  `ocharname` varchar(25) NOT NULL DEFAULT '',
  `olife` int(10) NOT NULL DEFAULT '0',
  `omana` int(10) NOT NULL DEFAULT '0',
  `ostamina` int(10) NOT NULL DEFAULT '0',
  `dupe` float NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25233992 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_fights`
--

DROP TABLE IF EXISTS `lol3_fights`;
CREATE TABLE IF NOT EXISTS `lol3_fights` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fid` varchar(25) NOT NULL DEFAULT '0',
  `news` text NOT NULL,
  `time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=165388565 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_floor`
--

DROP TABLE IF EXISTS `lol3_floor`;
CREATE TABLE IF NOT EXISTS `lol3_floor` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `x` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `y` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `location` varchar(25) NOT NULL DEFAULT '',
  `game` varchar(25) NOT NULL DEFAULT '',
  `itemname` varchar(25) NOT NULL DEFAULT '',
  `class` varchar(10) NOT NULL DEFAULT '0',
  `kind` varchar(15) NOT NULL DEFAULT '0',
  `damaged` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `durability` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `multi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rlevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rstrength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rintelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `min` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a6` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a7` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a8` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a9` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1071172 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_floorc`
--

DROP TABLE IF EXISTS `lol3_floorc`;
CREATE TABLE IF NOT EXISTS `lol3_floorc` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `x` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `y` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `location` varchar(25) NOT NULL DEFAULT '',
  `game` varchar(25) NOT NULL DEFAULT '',
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
  `time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=95215 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_gamble`
--

DROP TABLE IF EXISTS `lol3_gamble`;
CREATE TABLE IF NOT EXISTS `lol3_gamble` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gold` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_games`
--

DROP TABLE IF EXISTS `lol3_games`;
CREATE TABLE IF NOT EXISTS `lol3_games` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gamename` varchar(15) NOT NULL DEFAULT '',
  `password` varchar(15) NOT NULL DEFAULT '',
  `players` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `maxlevel` int(10) NOT NULL DEFAULT '0',
  `creator` varchar(15) NOT NULL DEFAULT '',
  `started` int(15) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(15) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `gamename` (`gamename`)
) ENGINE=MyISAM AUTO_INCREMENT=995 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_graves`
--

DROP TABLE IF EXISTS `lol3_graves`;
CREATE TABLE IF NOT EXISTS `lol3_graves` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` varchar(25) NOT NULL DEFAULT '',
  `news` mediumtext NOT NULL,
  `fid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47549528 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_history`
--

DROP TABLE IF EXISTS `lol3_history`;
CREATE TABLE IF NOT EXISTS `lol3_history` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(15) NOT NULL DEFAULT '',
  `kills` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `deads` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `won` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lost` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `logins` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `charname` (`charname`)
) ENGINE=MyISAM AUTO_INCREMENT=3804 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_inventory`
--

DROP TABLE IF EXISTS `lol3_inventory`;
CREATE TABLE IF NOT EXISTS `lol3_inventory` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(15) NOT NULL DEFAULT '',
  `used` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `itemname` varchar(25) NOT NULL DEFAULT '',
  `class` varchar(10) NOT NULL DEFAULT '0',
  `kind` varchar(15) NOT NULL DEFAULT '0',
  `damaged` float UNSIGNED NOT NULL DEFAULT '0',
  `durability` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `multi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rlevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rstrength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rintelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `min` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a6` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a7` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a8` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a9` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=97304 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_it_amulet`
--

DROP TABLE IF EXISTS `lol3_it_amulet`;
CREATE TABLE IF NOT EXISTS `lol3_it_amulet` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `itemname` varchar(25) NOT NULL DEFAULT '',
  `cdrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `udrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `class` varchar(10) NOT NULL DEFAULT '0',
  `kind` varchar(10) NOT NULL DEFAULT '0',
  `durability` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `multi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rlevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rstrength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rintelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `min` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a6` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a7` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a8` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a9` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `itemname` (`itemname`)
) ENGINE=MyISAM AUTO_INCREMENT=744 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_it_armor`
--

DROP TABLE IF EXISTS `lol3_it_armor`;
CREATE TABLE IF NOT EXISTS `lol3_it_armor` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `itemname` varchar(25) NOT NULL DEFAULT '',
  `cdrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `udrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `class` varchar(10) NOT NULL DEFAULT '0',
  `kind` varchar(10) NOT NULL DEFAULT '0',
  `durability` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `multi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rlevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rstrength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rintelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `min` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a6` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a7` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a8` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a9` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `itemname` (`itemname`)
) ENGINE=MyISAM AUTO_INCREMENT=228 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_it_attackspell`
--

DROP TABLE IF EXISTS `lol3_it_attackspell`;
CREATE TABLE IF NOT EXISTS `lol3_it_attackspell` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `itemname` varchar(25) NOT NULL DEFAULT '',
  `cdrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `udrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `class` varchar(10) NOT NULL DEFAULT '0',
  `kind` varchar(15) NOT NULL DEFAULT '0',
  `durability` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `multi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rlevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rstrength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rintelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `min` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a6` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a7` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a8` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a9` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `itemname` (`itemname`)
) ENGINE=MyISAM AUTO_INCREMENT=1493 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_it_belt`
--

DROP TABLE IF EXISTS `lol3_it_belt`;
CREATE TABLE IF NOT EXISTS `lol3_it_belt` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `itemname` varchar(25) NOT NULL DEFAULT '',
  `cdrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `udrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `class` varchar(10) NOT NULL DEFAULT '0',
  `kind` varchar(10) NOT NULL DEFAULT '0',
  `durability` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `multi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rlevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rstrength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rintelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `min` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a6` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a7` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a8` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a9` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `itemname` (`itemname`)
) ENGINE=MyISAM AUTO_INCREMENT=274 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_it_feet`
--

DROP TABLE IF EXISTS `lol3_it_feet`;
CREATE TABLE IF NOT EXISTS `lol3_it_feet` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `itemname` varchar(25) NOT NULL DEFAULT '',
  `cdrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `udrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `class` varchar(10) NOT NULL DEFAULT '0',
  `kind` varchar(10) NOT NULL DEFAULT '0',
  `durability` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `multi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rlevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rstrength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rintelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `min` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a6` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a7` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a8` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a9` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `itemname` (`itemname`)
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_it_hand`
--

DROP TABLE IF EXISTS `lol3_it_hand`;
CREATE TABLE IF NOT EXISTS `lol3_it_hand` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `itemname` varchar(25) NOT NULL DEFAULT '',
  `cdrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `udrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `class` varchar(10) NOT NULL DEFAULT '0',
  `kind` varchar(10) NOT NULL DEFAULT '0',
  `durability` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `multi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rlevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rstrength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rintelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `min` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a6` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a7` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a8` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a9` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `itemname` (`itemname`)
) ENGINE=MyISAM AUTO_INCREMENT=208 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_it_healspell`
--

DROP TABLE IF EXISTS `lol3_it_healspell`;
CREATE TABLE IF NOT EXISTS `lol3_it_healspell` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `itemname` varchar(25) NOT NULL DEFAULT '',
  `cdrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `udrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `class` varchar(10) NOT NULL DEFAULT '0',
  `kind` varchar(10) NOT NULL DEFAULT '0',
  `durability` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `multi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rlevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rstrength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rintelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `min` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a6` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a7` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a8` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a9` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `itemname` (`itemname`)
) ENGINE=MyISAM AUTO_INCREMENT=723 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_it_helmet`
--

DROP TABLE IF EXISTS `lol3_it_helmet`;
CREATE TABLE IF NOT EXISTS `lol3_it_helmet` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `itemname` varchar(25) NOT NULL DEFAULT '',
  `cdrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `udrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `class` varchar(10) NOT NULL DEFAULT '0',
  `kind` varchar(10) NOT NULL DEFAULT '0',
  `durability` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `multi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rlevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rstrength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rintelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `min` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a6` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a7` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a8` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a9` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `itemname` (`itemname`)
) ENGINE=MyISAM AUTO_INCREMENT=284 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_it_pant`
--

DROP TABLE IF EXISTS `lol3_it_pant`;
CREATE TABLE IF NOT EXISTS `lol3_it_pant` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `itemname` varchar(25) NOT NULL DEFAULT '',
  `cdrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `udrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `class` varchar(10) NOT NULL DEFAULT '0',
  `kind` varchar(10) NOT NULL DEFAULT '0',
  `durability` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `multi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rlevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rstrength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rintelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `min` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a6` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a7` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a8` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a9` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `itemname` (`itemname`)
) ENGINE=MyISAM AUTO_INCREMENT=220 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_it_ring`
--

DROP TABLE IF EXISTS `lol3_it_ring`;
CREATE TABLE IF NOT EXISTS `lol3_it_ring` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `itemname` varchar(25) NOT NULL DEFAULT '',
  `cdrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `udrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `class` varchar(10) NOT NULL DEFAULT '0',
  `kind` varchar(10) NOT NULL DEFAULT '0',
  `durability` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `multi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rlevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rstrength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rintelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `min` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a6` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a7` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a8` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a9` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `itemname` (`itemname`)
) ENGINE=MyISAM AUTO_INCREMENT=876 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_it_shield`
--

DROP TABLE IF EXISTS `lol3_it_shield`;
CREATE TABLE IF NOT EXISTS `lol3_it_shield` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `itemname` varchar(25) NOT NULL DEFAULT '',
  `cdrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `udrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `class` varchar(10) NOT NULL DEFAULT '0',
  `kind` varchar(10) NOT NULL DEFAULT '0',
  `durability` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `multi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rlevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rstrength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rintelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `min` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a6` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a7` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a8` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a9` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `itemname` (`itemname`)
) ENGINE=MyISAM AUTO_INCREMENT=260 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_it_weapon`
--

DROP TABLE IF EXISTS `lol3_it_weapon`;
CREATE TABLE IF NOT EXISTS `lol3_it_weapon` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `itemname` varchar(25) NOT NULL DEFAULT '',
  `cdrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `udrop` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `class` varchar(10) NOT NULL DEFAULT '0',
  `kind` varchar(10) NOT NULL DEFAULT '0',
  `durability` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `multi` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rlevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rstrength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rintelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `min` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a6` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a7` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a8` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a9` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `itemname` (`itemname`)
) ENGINE=MyISAM AUTO_INCREMENT=657 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_market`
--

DROP TABLE IF EXISTS `lol3_market`;
CREATE TABLE IF NOT EXISTS `lol3_market` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(25) NOT NULL DEFAULT '',
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
  `gold` int(11) NOT NULL DEFAULT '0',
  `credits` int(11) NOT NULL DEFAULT '0',
  `bidder` varchar(25) NOT NULL DEFAULT '',
  `bids` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_members`
--

DROP TABLE IF EXISTS `lol3_members`;
CREATE TABLE IF NOT EXISTS `lol3_members` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `sex` varchar(15) NOT NULL DEFAULT '',
  `charname` varchar(15) NOT NULL DEFAULT '',
  `class` varchar(15) NOT NULL DEFAULT '0',
  `level` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `exp` decimal(200,0) UNSIGNED NOT NULL DEFAULT '0',
  `gold` decimal(200,0) UNSIGNED NOT NULL DEFAULT '0',
  `stash` decimal(200,0) UNSIGNED NOT NULL DEFAULT '0',
  `honor` float NOT NULL DEFAULT '0',
  `life` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `mana` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `stamina` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `plife` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `pmana` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `pstamina` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `strength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `dexterity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `agility` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `intelligence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `concentration` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `contravention` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `weapon` varchar(10) NOT NULL DEFAULT '',
  `attackspell` varchar(10) NOT NULL DEFAULT '',
  `healspell` varchar(10) NOT NULL DEFAULT '',
  `helmet` varchar(10) NOT NULL DEFAULT '',
  `shield` varchar(10) NOT NULL DEFAULT '',
  `amulet` varchar(10) NOT NULL DEFAULT '',
  `ring` varchar(10) NOT NULL DEFAULT '',
  `armor` varchar(10) NOT NULL DEFAULT '',
  `belt` varchar(10) NOT NULL DEFAULT '',
  `pant` varchar(10) NOT NULL DEFAULT '',
  `hand` varchar(10) NOT NULL DEFAULT '',
  `feet` varchar(10) NOT NULL DEFAULT '',
  `freeplay` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `multi` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `x` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `y` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `charms` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `items` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `wp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `location` varchar(15) NOT NULL DEFAULT '',
  `game` varchar(15) NOT NULL DEFAULT '',
  `dead` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `onoff` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(50) NOT NULL DEFAULT '',
  `since` varchar(25) NOT NULL DEFAULT '',
  `jail` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `vote` varchar(32) NOT NULL DEFAULT '',
  `time` decimal(20,2) UNSIGNED NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `charname` (`charname`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3804 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_messages`
--

DROP TABLE IF EXISTS `lol3_messages`;
CREATE TABLE IF NOT EXISTS `lol3_messages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(25) NOT NULL DEFAULT '0',
  `receiver` varchar(25) NOT NULL DEFAULT '0',
  `message` mediumtext NOT NULL,
  `date` varchar(100) NOT NULL DEFAULT '',
  `time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4466 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_monsters`
--

DROP TABLE IF EXISTS `lol3_monsters`;
CREATE TABLE IF NOT EXISTS `lol3_monsters` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `x` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `y` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `charname` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `charname` (`charname`)
) ENGINE=MyISAM AUTO_INCREMENT=284 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_mute`
--

DROP TABLE IF EXISTS `lol3_mute`;
CREATE TABLE IF NOT EXISTS `lol3_mute` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(15) NOT NULL DEFAULT '',
  `muter` varchar(15) NOT NULL DEFAULT '',
  `time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `charname` (`charname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_paper`
--

DROP TABLE IF EXISTS `lol3_paper`;
CREATE TABLE IF NOT EXISTS `lol3_paper` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` varchar(50) NOT NULL DEFAULT '',
  `news` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14095 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_paypal`
--

DROP TABLE IF EXISTS `lol3_paypal`;
CREATE TABLE IF NOT EXISTS `lol3_paypal` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `server` varchar(64) NOT NULL DEFAULT '',
  `amount` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `day` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `month` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `year` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_skills`
--

DROP TABLE IF EXISTS `lol3_skills`;
CREATE TABLE IF NOT EXISTS `lol3_skills` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(15) NOT NULL DEFAULT '',
  `name` varchar(25) NOT NULL DEFAULT '',
  `kind` varchar(15) NOT NULL DEFAULT '0',
  `power` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17009 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_trade`
--

DROP TABLE IF EXISTS `lol3_trade`;
CREATE TABLE IF NOT EXISTS `lol3_trade` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(15) NOT NULL DEFAULT '',
  `ocharname` varchar(15) NOT NULL DEFAULT '',
  `kind` varchar(15) NOT NULL DEFAULT '',
  `tid` int(10) NOT NULL DEFAULT '0',
  `oid` int(10) NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tid` (`tid`),
  UNIQUE KEY `oid` (`oid`)
) ENGINE=MyISAM AUTO_INCREMENT=160 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol3_zlogs`
--

DROP TABLE IF EXISTS `lol3_zlogs`;
CREATE TABLE IF NOT EXISTS `lol3_zlogs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `charname` varchar(55) NOT NULL DEFAULT '',
  `logs` mediumtext NOT NULL,
  `file` varchar(25) NOT NULL DEFAULT '',
  `date` varchar(55) NOT NULL DEFAULT '',
  `ip` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=556 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

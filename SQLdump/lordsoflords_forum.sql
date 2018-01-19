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
-- Database: `lordsoflords_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum_blog_comments`
--

DROP TABLE IF EXISTS `forum_blog_comments`;
CREATE TABLE IF NOT EXISTS `forum_blog_comments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `blid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `comments` blob NOT NULL,
  `timer` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5122 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_blog_pic`
--

DROP TABLE IF EXISTS `forum_blog_pic`;
CREATE TABLE IF NOT EXISTS `forum_blog_pic` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comments` mediumtext NOT NULL,
  `blid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=698 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_lol_blog`
--

DROP TABLE IF EXISTS `forum_lol_blog`;
CREATE TABLE IF NOT EXISTS `forum_lol_blog` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `date` varchar(64) NOT NULL DEFAULT '',
  `blog` mediumtext NOT NULL,
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2833 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_lol_contents`
--

DROP TABLE IF EXISTS `forum_lol_contents`;
CREATE TABLE IF NOT EXISTS `forum_lol_contents` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sex` varchar(15) NOT NULL DEFAULT '',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `date` varchar(25) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `see` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=109867 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_lol_forums`
--

DROP TABLE IF EXISTS `forum_lol_forums`;
CREATE TABLE IF NOT EXISTS `forum_lol_forums` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(55) NOT NULL DEFAULT '',
  `decription` varchar(255) NOT NULL DEFAULT '',
  `topics` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `posts` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `last` varchar(255) NOT NULL DEFAULT '',
  `sex` varchar(25) NOT NULL DEFAULT '',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `see` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `level` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_lol_logs`
--

DROP TABLE IF EXISTS `forum_lol_logs`;
CREATE TABLE IF NOT EXISTS `forum_lol_logs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(25) NOT NULL DEFAULT '',
  `deleted` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5846 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_lol_news`
--

DROP TABLE IF EXISTS `forum_lol_news`;
CREATE TABLE IF NOT EXISTS `forum_lol_news` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nid` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `news` tinytext NOT NULL,
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24265 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_lol_polls`
--

DROP TABLE IF EXISTS `forum_lol_polls`;
CREATE TABLE IF NOT EXISTS `forum_lol_polls` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sex` varchar(15) NOT NULL DEFAULT '',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `see` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `question` varchar(255) NOT NULL DEFAULT '0',
  `a1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a` varchar(100) NOT NULL DEFAULT '',
  `b` varchar(100) NOT NULL DEFAULT '',
  `c` varchar(100) NOT NULL DEFAULT '',
  `d` varchar(100) NOT NULL DEFAULT '',
  `e` varchar(100) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=397 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_lol_topics`
--

DROP TABLE IF EXISTS `forum_lol_topics`;
CREATE TABLE IF NOT EXISTS `forum_lol_topics` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sticky` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `sex` varchar(15) NOT NULL DEFAULT '',
  `csex` varchar(15) NOT NULL DEFAULT '',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `ccharname` varchar(25) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `replies` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `last` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `first` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `see` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8713 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_lol_votes`
--

DROP TABLE IF EXISTS `forum_lol_votes`;
CREATE TABLE IF NOT EXISTS `forum_lol_votes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `pid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3502 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_members`
--

DROP TABLE IF EXISTS `forum_members`;
CREATE TABLE IF NOT EXISTS `forum_members` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sid` varchar(32) NOT NULL DEFAULT '',
  `username` varchar(25) NOT NULL DEFAULT '',
  `password` varchar(25) NOT NULL DEFAULT '',
  `sex` varchar(25) NOT NULL DEFAULT '',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `ev` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `ec` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `msn` varchar(25) NOT NULL DEFAULT '',
  `icq` varchar(25) NOT NULL DEFAULT '',
  `aim` varchar(25) NOT NULL DEFAULT '',
  `yahoo` varchar(25) NOT NULL DEFAULT '',
  `avatar` varchar(255) NOT NULL DEFAULT '',
  `signature` varchar(255) NOT NULL DEFAULT '',
  `posts` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `level` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `last` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `session` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `since` varchar(25) NOT NULL DEFAULT '0',
  `mute` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `charname` (`charname`)
) ENGINE=MyISAM AUTO_INCREMENT=33147 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_sil_blog`
--

DROP TABLE IF EXISTS `forum_sil_blog`;
CREATE TABLE IF NOT EXISTS `forum_sil_blog` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `date` varchar(64) NOT NULL DEFAULT '',
  `blog` mediumtext NOT NULL,
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_sil_contents`
--

DROP TABLE IF EXISTS `forum_sil_contents`;
CREATE TABLE IF NOT EXISTS `forum_sil_contents` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sex` varchar(15) NOT NULL DEFAULT '',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `date` varchar(25) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `see` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=924 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_sil_forums`
--

DROP TABLE IF EXISTS `forum_sil_forums`;
CREATE TABLE IF NOT EXISTS `forum_sil_forums` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(55) NOT NULL DEFAULT '',
  `decription` varchar(255) NOT NULL DEFAULT '',
  `topics` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `posts` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `last` varchar(255) NOT NULL DEFAULT '',
  `sex` varchar(25) NOT NULL DEFAULT '',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `see` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `level` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_sil_logs`
--

DROP TABLE IF EXISTS `forum_sil_logs`;
CREATE TABLE IF NOT EXISTS `forum_sil_logs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charname` varchar(25) NOT NULL DEFAULT '',
  `deleted` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_sil_news`
--

DROP TABLE IF EXISTS `forum_sil_news`;
CREATE TABLE IF NOT EXISTS `forum_sil_news` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nid` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `news` tinytext NOT NULL,
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=653 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_sil_polls`
--

DROP TABLE IF EXISTS `forum_sil_polls`;
CREATE TABLE IF NOT EXISTS `forum_sil_polls` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sex` varchar(15) NOT NULL DEFAULT '',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `see` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `question` varchar(255) NOT NULL DEFAULT '0',
  `a1` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a2` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a3` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a4` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a5` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `a` varchar(100) NOT NULL DEFAULT '',
  `b` varchar(100) NOT NULL DEFAULT '',
  `c` varchar(100) NOT NULL DEFAULT '',
  `d` varchar(100) NOT NULL DEFAULT '',
  `e` varchar(100) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_sil_topics`
--

DROP TABLE IF EXISTS `forum_sil_topics`;
CREATE TABLE IF NOT EXISTS `forum_sil_topics` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sticky` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `sex` varchar(15) NOT NULL DEFAULT '',
  `csex` varchar(15) NOT NULL DEFAULT '',
  `charname` varchar(25) NOT NULL DEFAULT '',
  `ccharname` varchar(25) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `replies` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `last` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `first` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `timer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `see` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forum_lol_contents`
--
ALTER TABLE `forum_lol_contents` ADD FULLTEXT KEY `body` (`body`);

--
-- Indexes for table `forum_sil_contents`
--
ALTER TABLE `forum_sil_contents` ADD FULLTEXT KEY `body` (`body`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

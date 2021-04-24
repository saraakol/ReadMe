-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 24, 2021 at 09:42 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `readme`
--
CREATE DATABASE IF NOT EXISTS `readme` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `readme`;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `IdB` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Authors` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `Description` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `Image` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`IdB`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookgenres`
--

DROP TABLE IF EXISTS `bookgenres`;
CREATE TABLE IF NOT EXISTS `bookgenres` (
  `IdB` int(11) NOT NULL,
  `IdG` int(11) NOT NULL,
  PRIMARY KEY (`IdB`,`IdG`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `IdG` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdG`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quote`
--

DROP TABLE IF EXISTS `quote`;
CREATE TABLE IF NOT EXISTS `quote` (
  `IdQ` int(11) NOT NULL AUTO_INCREMENT,
  `IdU` int(11) NOT NULL,
  `IdB` int(11) NOT NULL,
  `Text` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdQ`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

DROP TABLE IF EXISTS `rate`;
CREATE TABLE IF NOT EXISTS `rate` (
  `IdU` int(11) NOT NULL,
  `IdB` int(11) NOT NULL,
  `Rate` float NOT NULL,
  PRIMARY KEY (`IdU`,`IdB`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `IdRev` int(11) NOT NULL AUTO_INCREMENT,
  `IdB` int(11) NOT NULL,
  `IdU` int(11) NOT NULL,
  `Text` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdRev`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE IF NOT EXISTS `subscription` (
  `IdU` int(11) NOT NULL,
  `IdG` int(11) NOT NULL,
  PRIMARY KEY (`IdU`,`IdG`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `IdU` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Image` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Status` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `PersonalGoal` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdU`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userbooks`
--

DROP TABLE IF EXISTS `userbooks`;
CREATE TABLE IF NOT EXISTS `userbooks` (
  `IdU` int(11) NOT NULL,
  `IdB` int(11) NOT NULL,
  `Type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdU`,`IdB`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

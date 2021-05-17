-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 15, 2021 at 08:27 AM
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
  `Description` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `Image` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`IdB`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`IdB`, `Name`, `Authors`, `Description`, `Image`) VALUES
(1, 'Harry Potter and the Philosopher\'s stone', 'J.K. Rowling', 'Harry Potter has never even heard of Hogwarts when the letters start dropping on the doormat at number four, Privet Drive. Addressed in green ink on yellowish parchment with a purple seal, they are swiftly confiscated by his grisly aunt and uncle. Then, on Harry\'s eleventh birthday, a great beetle-eyed giant of a man called Rubeus Hagrid bursts in with some astonishing news: Harry Potter is a wizard, and he has a place at Hogwarts School of Witchcraft and Wizardry. An incredible adventure is about to begin!', NULL),
(2, 'The Master and Margarita', 'Mikhail Bulgakov', 'One hot spring, the devil arrives in Moscow, accompanied by a retinue that includes a beautiful naked witch and an immense talking black cat with a fondness for chess and vodka. The visitors quickly wreak havoc in a city that refuses to believe in either God or Satan. But they also bring peace to two unhappy Muscovites: one is the Master, a writer pilloried for daring to write a novel about Christ and Pontius Pilate; the other is Margarita, who loves the Master so deeply that she is willing literally to go to hell for him. What ensues is a novel of inexhaustible energy, humor, and philosophical depth, a work whose nuances emerge for the first time in Diana Burgin\'s and Katherine Tiernan O\'Connor\'s splendid English version.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookgenres`
--

DROP TABLE IF EXISTS `bookgenres`;
CREATE TABLE IF NOT EXISTS `bookgenres` (
  `IdB` int(11) NOT NULL,
  `IdG` int(11) NOT NULL,
  PRIMARY KEY (`IdB`,`IdG`),
  KEY `idG` (`IdG`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `IdG` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdG`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  PRIMARY KEY (`IdQ`),
  KEY `IdU` (`IdU`),
  KEY `IdB` (`IdB`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

DROP TABLE IF EXISTS `rate`;
CREATE TABLE IF NOT EXISTS `rate` (
  `IdR` int(11) NOT NULL AUTO_INCREMENT,
  `IdU` int(11) NOT NULL,
  `IdB` int(11) NOT NULL,
  `rate` float NOT NULL,
  PRIMARY KEY (`IdR`),
  KEY `IdU` (`IdU`),
  KEY `IdB` (`IdB`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  PRIMARY KEY (`IdRev`),
  KEY `IdU` (`IdU`),
  KEY `IdB` (`IdB`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE IF NOT EXISTS `subscription` (
  `IdU` int(11) NOT NULL,
  `IdG` int(11) NOT NULL,
  PRIMARY KEY (`IdU`,`IdG`),
  KEY `IdG` (`IdG`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`IdU`, `Username`, `Password`, `FirstName`, `LastName`, `Email`, `Image`, `Type`, `Status`, `PersonalGoal`) VALUES
(1, 'andrejjokic', 'andrej123', 'Andrej', 'Jokic', 'andrejjokic00@gmail.com', NULL, 'administrator', 'registered', NULL),
(2, 'nikolakrstic', 'nikola123', 'Nikola', 'Krstic', 'nikolakrstic99@gmail.com', NULL, 'administrator', 'registered', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userbooks`
--

DROP TABLE IF EXISTS `userbooks`;
CREATE TABLE IF NOT EXISTS `userbooks` (
  `IdUB` int(11) NOT NULL AUTO_INCREMENT,
  `IdU` int(11) NOT NULL,
  `IdB` int(11) NOT NULL,
  `Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdUB`),
  KEY `IdU` (`IdU`),
  KEY `IdB` (`IdB`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookgenres`
--
ALTER TABLE `bookgenres`
  ADD CONSTRAINT `bookgenres_ibfk_1` FOREIGN KEY (`IdB`) REFERENCES `book` (`IdB`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookgenres_ibfk_2` FOREIGN KEY (`IdG`) REFERENCES `genre` (`IdG`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quote`
--
ALTER TABLE `quote`
  ADD CONSTRAINT `quote_ibfk_1` FOREIGN KEY (`IdU`) REFERENCES `user` (`IdU`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quote_ibfk_2` FOREIGN KEY (`IdB`) REFERENCES `book` (`IdB`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`IdU`) REFERENCES `user` (`IdU`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rate_ibfk_2` FOREIGN KEY (`IdB`) REFERENCES `book` (`IdB`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`IdU`) REFERENCES `user` (`IdU`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`IdB`) REFERENCES `book` (`IdB`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`IdG`) REFERENCES `genre` (`IdG`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscription_ibfk_2` FOREIGN KEY (`IdU`) REFERENCES `user` (`IdU`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userbooks`
--
ALTER TABLE `userbooks`
  ADD CONSTRAINT `userbooks_ibfk_1` FOREIGN KEY (`IdU`) REFERENCES `user` (`IdU`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userbooks_ibfk_2` FOREIGN KEY (`IdB`) REFERENCES `book` (`IdB`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

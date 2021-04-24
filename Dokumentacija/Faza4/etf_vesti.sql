-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 24, 2021 at 09:28 AM
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
-- Database: `etf_vesti`
--
CREATE DATABASE IF NOT EXISTS `etf_vesti` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `etf_vesti`;

-- --------------------------------------------------------

--
-- Table structure for table `autor`
--

DROP TABLE IF EXISTS `autor`;
CREATE TABLE IF NOT EXISTS `autor` (
  `korime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefon` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`korime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `autor`
--

INSERT INTO `autor` (`korime`, `lozinka`, `ime`, `prezime`, `mail`, `telefon`, `admin`) VALUES
('admin', 'admin123', 'Admin', 'Admin', 'admin@etf.bg.ac.rs', NULL, 1),
('drazen', 'drazen123', 'Drazen', 'Draskovic', 'drazen@etf.bg.ac.rs', NULL, 0),
('tasha', 'tasha123', 'Tamara', 'Sekularac', 'tasha@etf.bg.ac.rs', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vest`
--

DROP TABLE IF EXISTS `vest`;
CREATE TABLE IF NOT EXISTS `vest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sadrzaj` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `autor` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `datum` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `autor` (`autor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vest`
--

INSERT INTO `vest` (`id`, `naslov`, `sadrzaj`, `autor`, `datum`) VALUES
(1, 'Nastava na daljinu', 'Tokom traja vanrednog stanja vezbe cemo drzati na Teams platformi', 'drazen', '2020-03-16'),
(2, 'Univerzijada 2020', 'Olimpijada je pomerena, ali odluka o odrzavanju Univerzijade jos nije doneta ', 'tasha', '2020-03-20'),
(3, 'Treca lab.vezba', 'Na trecoj laboratorijskoj vezbi cemo raditi najnoviju verziju CodeIgniter-a koja je izasla pocetkom ove godine', 'drazen', '2020-04-02'),
(4, 'Termin konsultacija', 'Pitanja vezana za drugu laboratorijsku vezbu cete moci da postavljate u terminu u ponedeljak 6.4. u 12:15', 'tasha', '2020-04-03');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vest`
--
ALTER TABLE `vest`
  ADD CONSTRAINT `autor` FOREIGN KEY (`autor`) REFERENCES `autor` (`korime`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

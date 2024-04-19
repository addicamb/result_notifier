-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2021 at 10:36 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `results`
--

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `id` int(11) NOT NULL,
  `program_code` varchar(25) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `college` varchar(10) DEFAULT NULL,
  `webhook_link` varchar(255) DEFAULT NULL,
  `period` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `query`
--

INSERT INTO `query` (`id`, `program_code`, `semester`, `college`, `webhook_link`, `period`) VALUES
(1, '1T00727', 7, 'SAKEC', 'https://discordapp.com/api/webhooks/815125218711961611/jAS1FGUtHXGsNkb1ugesicDxM6atXygDnqyi05K339vnLS5UkgHR-eibh-ZI5VYvhNEe', 'S20'),
(2, '1T01327', 7, 'RAIT', 'https://discordapp.com/api/webhooks/815125218711961611/jAS1FGUtHXGsNkb1ugesicDxM6atXygDnqyi05K339vnLS5UkgHR-eibh-ZI5VYvhNEe', 'S20'),
(3, '1T01127', 7, 'VESIT', 'https://discordapp.com/api/webhooks/815125218711961611/jAS1FGUtHXGsNkb1ugesicDxM6atXygDnqyi05K339vnLS5UkgHR-eibh-ZI5VYvhNEe', 'S20'),
(4, '1T00428', 8, 'MGMCET', 'https://discordapp.com/api/webhooks/815125218711961611/jAS1FGUtHXGsNkb1ugesicDxM6atXygDnqyi05K339vnLS5UkgHR-eibh-ZI5VYvhNEe', 'F21'),
(24, '1T00727', 7, 'SIES', 'https://discord.com/api/webhooks/815125218711961611/jAS1FGUtHXGsNkb1ugesicDxM6atXygDnqyi05K339vnLS5UkgHR-eibh-ZI5VYvhNEe', 'S20'),
(29, '1T00728', 8, 'SIES', 'https://discord.com/api/webhooks/815125218711961611/jAS1FGUtHXGsNkb1ugesicDxM6atXygDnqyi05K339vnLS5UkgHR-eibh-ZI5VYvhNEe', 'F21'),
(30, '1T01227', 7, 'SIES', 'https://discord.com/api/webhooks/815125218711961611/jAS1FGUtHXGsNkb1ugesicDxM6atXygDnqyi05K339vnLS5UkgHR-eibh-ZI5VYvhNEe', 'S20'),
(33, '1T00727', 7, 'SAKEC', 'https://discordapp.com/api/webhooks/815125218711961611/jAS1FGUtHXGsNkb1ugesicDxM6atXygDnqyi05K339vnLS5UkgHR-eibh-ZI5VYvhNEe', 'S20'),
(34, '1T01327', 7, 'RAIT', 'https://discordapp.com/api/webhooks/815125218711961611/jAS1FGUtHXGsNkb1ugesicDxM6atXygDnqyi05K339vnLS5UkgHR-eibh-ZI5VYvhNEe', 'S20'),
(35, '1T01127', 7, 'VESIT', 'https://discordapp.com/api/webhooks/815125218711961611/jAS1FGUtHXGsNkb1ugesicDxM6atXygDnqyi05K339vnLS5UkgHR-eibh-ZI5VYvhNEe', 'S20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `query`
--
ALTER TABLE `query`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `query`
--
ALTER TABLE `query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

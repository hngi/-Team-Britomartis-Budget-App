-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2019 at 10:11 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gobudget`
--

-- --------------------------------------------------------

--
-- Table structure for table `transportation`
--

CREATE TABLE IF NOT EXISTS `transportation` (
  `id` int(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `names` varchar(500) NOT NULL,
  `prices` varchar(500) NOT NULL,
  `total` int(11) NOT NULL,
  `priority` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `housing`
--

CREATE TABLE IF NOT EXISTS `housing` (
  `id` int(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `names` varchar(500) NOT NULL,
  `prices` varchar(500) NOT NULL,
  `total` int(11) NOT NULL,
  `priority` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE IF NOT EXISTS `food` (
  `id` int(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `names` varchar(500) NOT NULL,
  `prices` varchar(500) NOT NULL,
  `total` int(11) NOT NULL,
  `priority` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `personalcare`
--

CREATE TABLE IF NOT EXISTS `personalcare` (
  `id` int(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `names` varchar(500) NOT NULL,
  `prices` varchar(500) NOT NULL,
  `total` int(11) NOT NULL,
  `priority` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` varchar(25) NOT NULL,
  `currency` text NOT NULL,
  `userpass` varchar(255) NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `currency`, `userpass`, `reg_date`) VALUES
(1, 'John', 'Doe', 'johndoe@example.com', 'NGN', '$2y$12$VBsRwr/wPjAL3r7dqayF3ufKK2BNj2k7aqc5oAeEMPdTio/VDiG6e', '2019-09-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transportation`
--
ALTER TABLE `transportation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `housing`
--
ALTER TABLE `housing`
  ADD PRIMARY KEY (`id`);

  --
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personalcare`
--
ALTER TABLE `personalcare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

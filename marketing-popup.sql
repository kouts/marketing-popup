-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 19, 2020 at 09:01 PM
-- Server version: 5.7.30
-- PHP Version: 7.1.33-15+0~20200419.36+debian8~1.gbp2384b3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketing-popup`
--

-- --------------------------------------------------------

--
-- Table structure for table `list_of_values`
--

CREATE TABLE `list_of_values` (
  `id` int(11) NOT NULL,
  `seq_no` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `list_of_values`
--

INSERT INTO `list_of_values` (`id`, `seq_no`, `name`, `value`, `text`) VALUES
(1, 1, 'timer', '0.25', '15 seconds'),
(2, 2, 'timer', '0.5', '30 seconds'),
(3, 3, 'timer', '60', '1 minute'),
(4, 4, 'timer', '120', '1 minutes'),
(5, 1, 'scrolling_trigger', '25', '25% of page'),
(6, 2, 'scrolling_trigger', '50', '50% of page'),
(7, 3, 'scrolling_trigger', '75', '75% of page'),
(8, 1, 'frequency', '10', '10 seconds'),
(9, 2, 'frequency', '86400', '1 day'),
(10, 3, 'frequency', '172800', '2 days'),
(11, 4, 'frequency', '604800', '1 week');

-- --------------------------------------------------------

--
-- Table structure for table `popup`
--

CREATE TABLE `popup` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `timer_enable` tinyint(1) NOT NULL,
  `timer_value` varchar(255) NOT NULL,
  `scrolling_trigger_enable` tinyint(1) NOT NULL,
  `scrolling_trigger_value` varchar(255) NOT NULL,
  `exit_intent_enable` tinyint(1) NOT NULL,
  `frequency_value` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `popup`
--

INSERT INTO `popup` (`id`, `title`, `timer_enable`, `timer_value`, `scrolling_trigger_enable`, `scrolling_trigger_value`, `exit_intent_enable`, `frequency_value`, `content`, `created_at`, `updated_at`) VALUES
(8, 'First popup edit', 0, '', 1, '25', 1, '172800', 'First popup edit', '2020-08-19 14:52:30', '2020-08-19 15:34:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list_of_values`
--
ALTER TABLE `list_of_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popup`
--
ALTER TABLE `popup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_of_values`
--
ALTER TABLE `list_of_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `popup`
--
ALTER TABLE `popup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

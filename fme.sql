-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2017 at 09:52 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fme`
--

-- --------------------------------------------------------

--
-- Table structure for table `absent`
--

CREATE TABLE `absent` (
  `serial` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `reason` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `serial` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `message` text NOT NULL,
  `time` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE TABLE `dashboard` (
  `serial` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `serial` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_name` text NOT NULL,
  `server` text NOT NULL,
  `source` text NOT NULL,
  `destination` text NOT NULL,
  `time` int(11) NOT NULL,
  `trailer` text NOT NULL,
  `route_map` text NOT NULL,
  `event_page` text NOT NULL,
  `save_file` text,
  `notes` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_roles`
--

CREATE TABLE `event_roles` (
  `serial` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `confirm` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `other_events`
--

CREATE TABLE `other_events` (
  `id` int(11) NOT NULL,
  `planner` text NOT NULL,
  `server` text NOT NULL,
  `source` text NOT NULL,
  `destination` text NOT NULL,
  `trailer` text NOT NULL,
  `event_page` text NOT NULL,
  `time` int(11) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Lead'),
(2, 'Co-Lead'),
(3, 'CC1'),
(4, 'CC2'),
(5, 'CC3'),
(6, 'CC4'),
(7, 'CC5'),
(8, 'CC6'),
(9, 'Middle'),
(10, 'Tail'),
(11, 'Reserve'),
(12, 'CC7'),
(13, 'CC8'),
(14, 'CC9'),
(15, 'CC10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `steam_id` varchar(255) NOT NULL,
  `truckersmp_id` varchar(255) NOT NULL,
  `steam_name` text NOT NULL,
  `avatar` text NOT NULL,
  `truckersmp_joindate` text NOT NULL,
  `register_time` text NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `cookie` text,
  `ip` text,
  `role` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absent`
--
ALTER TABLE `absent`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `dashboard`
--
ALTER TABLE `dashboard`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_roles`
--
ALTER TABLE `event_roles`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `other_events`
--
ALTER TABLE `other_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`,`steam_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absent`
--
ALTER TABLE `absent`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dashboard`
--
ALTER TABLE `dashboard`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_roles`
--
ALTER TABLE `event_roles`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `other_events`
--
ALTER TABLE `other_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

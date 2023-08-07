-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 23, 2023 at 12:33 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coursework1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(1) NOT NULL DEFAULT '0',
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `username`, `password`, `email`, `gender`, `dob`) VALUES
(0, 'administrator', '$2y$10$RE8r/RSIItVEBKFQMrc8HeTKgp4QSB6qKhZGD/C3k5nmhbDLya0fm', 'admin@gmail.com', 'male', '2013-06-05');

-- --------------------------------------------------------

--
-- Table structure for table `admin_inbox`
--

CREATE TABLE `admin_inbox` (
  `msg_id` int(11) NOT NULL,
  `body` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `staffID` int(11) NOT NULL,
  `admnID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_inbox`
--

INSERT INTO `admin_inbox` (`msg_id`, `body`, `date`, `staffID`, `admnID`) VALUES
(1, 'hey', '2023-07-23', 1, 0),
(2, 'Muwanguzi is not there', '2023-07-23', 1, 0),
(3, 'How are you', '2023-07-23', 2, 0),
(4, 'i can not find joan', '2023-07-23', 2, 0),
(5, 'please send the correct location', '2023-07-23', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `p_o_box` varchar(50) DEFAULT NULL,
  `mail_status` int(1) DEFAULT '0',
  `date_Delivered` date DEFAULT NULL,
  `date_Added` date DEFAULT NULL,
  `adminID` int(1) DEFAULT '1',
  `staffID` int(11) DEFAULT NULL,
  `mailID` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`p_o_box`, `mail_status`, `date_Delivered`, `date_Added`, `adminID`, `staffID`, `mailID`, `client_name`, `contact`) VALUES
('897, old town road', 1, '2023-07-23', '2023-07-23', 1, 1, 1, 'muwanguzi', '0756764671'),
('909, namungoona', 1, '2023-07-23', '2023-07-23', 1, 2, 2, 'kenard eddy', '0756643681'),
('789, old street house', 0, NULL, '2023-07-23', 1, NULL, 3, 'joan ndagire', '0777764671');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `password` varchar(255) DEFAULT NULL,
  `staffID` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`password`, `staffID`, `email`, `gender`, `username`, `dob`) VALUES
('$2y$10$HNhwhGiGPfAeKSxK8hKOeuX5g3U4nSFq/47EN1f5D2PD31dbSogNK', 1, 'wilfred456@gmail.com', 'male', 'wilfred kato', '2023-07-04'),
('$2y$10$s2lrgfJ3fiX0idGK6cDmyuik1NzbgNgw52Ursjv/joSvp5P1iKqZ6', 2, 'drikky@gmail.com', 'male', 'derrick', '2023-07-20'),
('$2y$10$TWMsN50FWDhZCXcAJH7mMO1H7WdBm3okAuAeI0mFcsn0AiwLNso7y', 3, 'jovic@gmail.com', NULL, 'jovics', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `admin_inbox`
--
ALTER TABLE `admin_inbox`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`mailID`),
  ADD KEY `adminID` (`adminID`),
  ADD KEY `staffID` (`staffID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_inbox`
--
ALTER TABLE `admin_inbox`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `mailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

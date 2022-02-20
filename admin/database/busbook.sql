-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2021 at 01:33 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `busbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `buscoordinator`
--

CREATE TABLE `buscoordinator` (
  `codID` int(11) NOT NULL,
  `codName` text NOT NULL,
  `codSurname` text NOT NULL,
  `codEmail` text NOT NULL,
  `codPassword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buscoordinator`
--

INSERT INTO `buscoordinator` (`codID`, `codName`, `codSurname`, `codEmail`, `codPassword`) VALUES
(1, 'Sipho', 'Mthethwa', 'sipho.coordinator@tut.ac.za', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `loacation`
--

CREATE TABLE `loacation` (
  `locID` int(10) NOT NULL,
  `locAddress` text NOT NULL,
  `locCampName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loacation`
--

INSERT INTO `loacation` (`locID`, `locAddress`, `locCampName`) VALUES
(1, '175 Nelson Mandela Dr, Arcadia, Pretoria, 0083', 'Arcadia Campus'),
(2, '2 Aubrey Matlakala St, Soshanguve - K, Soshanguve, 0001', 'Soshanguve South Campus'),
(3, 'TUT soshanguve North Campus, New Entrance, Aubrey Matlakala St, Soshanguve - H, Soshanguve, 0152', 'Soshanguve North Campus'),
(4, 'Staatsartillerie Rd, Pretoria West, Pretoria, 0183', 'Pretoria Campus');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studID` int(11) NOT NULL,
  `studName` text NOT NULL,
  `studSurname` text NOT NULL,
  `studNo` text NOT NULL,
  `studEmail` text NOT NULL,
  `studGender` text NOT NULL,
  `studPassword` text NOT NULL,
  `campusName` text NOT NULL,
  `facultyName` text NOT NULL,
  `studAltE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tripbook`
--

CREATE TABLE `tripbook` (
  `tripID` int(11) NOT NULL,
  `tripName` text NOT NULL,
  `tripTime` text NOT NULL,
  `studID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buscoordinator`
--
ALTER TABLE `buscoordinator`
  ADD PRIMARY KEY (`codID`);

--
-- Indexes for table `loacation`
--
ALTER TABLE `loacation`
  ADD PRIMARY KEY (`locID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studID`);

--
-- Indexes for table `tripbook`
--
ALTER TABLE `tripbook`
  ADD PRIMARY KEY (`tripID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loacation`
--
ALTER TABLE `loacation`
  MODIFY `locID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tripbook`
--
ALTER TABLE `tripbook`
  MODIFY `tripID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

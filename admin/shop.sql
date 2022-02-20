-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2021 at 11:31 AM
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
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `adminName` text NOT NULL,
  `adminEmail` text NOT NULL,
  `adminPwd` text NOT NULL,
  `storeNumber` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL,
  `customerName` text NOT NULL,
  `customerSurname` text NOT NULL,
  `customerGender` text NOT NULL,
  `customerEmail` text NOT NULL,
  `customerPwd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customerorder`
--

CREATE TABLE `customerorder` (
  `orderID` int(11) NOT NULL,
  `orderNumber` text NOT NULL,
  `orderName` text NOT NULL,
  `orderTotal` text NOT NULL,
  `customerID` int(11) NOT NULL,
  `orderDate` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customerorderitem`
--

CREATE TABLE `customerorderitem` (
  `orderItemID` int(11) NOT NULL,
  `orderNumber` text NOT NULL,
  `orderItemPrice` text NOT NULL,
  `orderItemName` text NOT NULL,
  `orderItemDestr` text NOT NULL,
  `orderItemImg` text NOT NULL,
  `orderItemQuant` text NOT NULL,
  `orderItemTotal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(11) NOT NULL,
  `paymentName` text NOT NULL,
  `paymentMethod` text NOT NULL,
  `paymentAmount` text NOT NULL,
  `paymentDate` text NOT NULL,
  `customerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prodID` int(11) NOT NULL,
  `productNo` text NOT NULL,
  `productName` text NOT NULL,
  `productPrice` text NOT NULL,
  `prodQuantity` text NOT NULL,
  `prodImg` text NOT NULL,
  `storeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `storeID` int(11) NOT NULL,
  `storeName` text NOT NULL,
  `storeEmail` text NOT NULL,
  `storeTel` text NOT NULL,
  `storeNumber` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `customerorder`
--
ALTER TABLE `customerorder`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `customerorderitem`
--
ALTER TABLE `customerorderitem`
  ADD PRIMARY KEY (`orderItemID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prodID`),
  ADD KEY `storeID` (`storeID`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`storeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customerorder`
--
ALTER TABLE `customerorder`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customerorderitem`
--
ALTER TABLE `customerorderitem`
  MODIFY `orderItemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prodID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `storeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customerorder`
--
ALTER TABLE `customerorder`
  ADD CONSTRAINT `customerorder_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2021 at 11:56 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

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
  `storeID` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminName`, `adminEmail`, `adminPwd`, `storeID`) VALUES
(1, 'Sipho', 'sipho@pnp.co.za', 'admin', '1'),
(2, 'Zama', 'zama@woolworths.co.za', 'admin', '2');

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

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `customerName`, `customerSurname`, `customerGender`, `customerEmail`, `customerPwd`) VALUES
(3, 'Simphiwe', 'Mthanti', 'Male', 'simphiwemthanti76@gmail.com', '$2y$10$gYfYJhzgrSZghqa69fv/BeiARCfvTxGC0T5bs2QWMsNiUzz8KVX.y'),
(6, 'Sipho', 'Gama', 'Male', 'gama@gmail.com', '$2y$10$PY9OYE6Z/XR1lhUklVsqJ.FX0CXTNjh6aSqc1J.XkiseAH6l//5ZG');

-- --------------------------------------------------------

--
-- Table structure for table `customerorder`
--

CREATE TABLE `customerorder` (
  `orderID` int(11) NOT NULL,
  `orderNumber` text NOT NULL,
  `orderTotal` text NOT NULL,
  `customerID` int(11) NOT NULL,
  `orderDate` text NOT NULL,
  `storeID` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customerorder`
--

INSERT INTO `customerorder` (`orderID`, `orderNumber`, `orderTotal`, `customerID`, `orderDate`, `storeID`) VALUES
(2, '905938', '32.67', 3, '10-12-2021', '2'),
(3, '987201', '32.67', 3, '10-12-2021', '2'),
(4, '618858', '32.67', 3, '10-12-2021', '2'),
(5, '723645', '32.67', 3, '10-12-2021', '2');

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

--
-- Dumping data for table `customerorderitem`
--

INSERT INTO `customerorderitem` (`orderItemID`, `orderNumber`, `orderItemPrice`, `orderItemName`, `orderItemDestr`, `orderItemImg`, `orderItemQuant`, `orderItemTotal`) VALUES
(2, '905938', '32.67', 'Hake', 'Hake', '61ae33cfbddf25.64580367.jpg', '1', '32.67'),
(3, '987201', '32.67', 'Hake', 'Hake', '61ae33cfbddf25.64580367.jpg', '1', '32.67'),
(4, '618858', '32.67', 'Hake', 'Hake', '61ae33cfbddf25.64580367.jpg', '1', '32.67'),
(5, '723645', '32.67', 'Hake', 'Hake', '61ae33cfbddf25.64580367.jpg', '1', '32.67');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(11) NOT NULL,
  `paymentMethod` text NOT NULL,
  `paymentAmount` text NOT NULL,
  `orderNumber` text NOT NULL,
  `paymentDate` text NOT NULL,
  `customerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `paymentMethod`, `paymentAmount`, `orderNumber`, `paymentDate`, `customerID`) VALUES
(1, 'Cash', '32.67', '', '10-12-2021', 3),
(2, 'Cash', '32.67', '618858', '10-12-2021', 3),
(3, 'Cash', '32.67', '723645', '10-12-2021', 3);

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

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prodID`, `productNo`, `productName`, `productPrice`, `prodQuantity`, `prodImg`, `storeID`) VALUES
(1, '45376437', 'Hake', '32.67', '20', '61ae33cfbddf25.64580367.jpg', 1),
(4, '76875643', 'Hake', '32.67', '2', '61ae33cfbddf25.64580367.jpg', 2),
(5, '87985643', 'Sesame Chicken Strips', '32.67', '19', '61ae3d3acc4479.24025036.jpg', 2),
(6, '86548756', 'Vitagen Puppy Size Chunks', '13.97', '24', '61ae780b8f6e85.82039314.jpg', 1),
(7, '76877656', 'Gten', '27.7', '40', '61af43e5ab80e9.48688067.jpg', 2);

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
-- Dumping data for table `store`
--

INSERT INTO `store` (`storeID`, `storeName`, `storeEmail`, `storeTel`, `storeNumber`) VALUES
(1, 'Pick n Pay', 'customercare@pnp.co.za', '0860303030', '1'),
(2, 'Woolworth', 'custserv@woolworths.co.za', '0860022002', '2');

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
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customerorder`
--
ALTER TABLE `customerorder`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customerorderitem`
--
ALTER TABLE `customerorderitem`
  MODIFY `orderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `storeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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

-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2019 at 06:44 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodshale`
--

-- --------------------------------------------------------

--
-- Table structure for table `customertable`
--

CREATE TABLE `customertable` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `choice` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customertable`
--

INSERT INTO `customertable` (`user_id`, `name`, `email`, `choice`, `type`, `password`) VALUES
(3, 'Hunny', 'hunny04021997@gmail.com', 'Veg', 'customer', '$2y$10$QZR8eMXc7TBkhlfYO/eSF.aeprafMtI7X9S8DWYDRU/p4zFuo8G1y'),
(4, 'hunny', 'devinhunny04021997@gmail.com', 'Non-Veg', 'customer', '$2y$10$PaKe6UHY7cc5Ei0s/ZKyiuH3aMJdcgQulx2YoavfuKRj9rQeN/33y');

-- --------------------------------------------------------

--
-- Table structure for table `itemtable`
--

CREATE TABLE `itemtable` (
  `itemS.no` int(11) NOT NULL,
  `itemName` char(255) NOT NULL,
  `itemType` char(255) NOT NULL,
  `itemCusion` char(255) NOT NULL,
  `itemDescription` varchar(255) NOT NULL,
  `itemImage` varchar(255) NOT NULL,
  `itemPrice` int(11) NOT NULL,
  `itemRating` float NOT NULL,
  `itemDate` datetime NOT NULL,
  `itemRatecount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemtable`
--

INSERT INTO `itemtable` (`itemS.no`, `itemName`, `itemType`, `itemCusion`, `itemDescription`, `itemImage`, `itemPrice`, `itemRating`, `itemDate`, `itemRatecount`) VALUES
(7, 'russain dog', 'Veg', '', 'qwertyuiopasdfghj', 'upload/Screenshot (3).png', 40, 0, '0000-00-00 00:00:00', 0),
(8, 'Aloo tikki', 'Veg', '', 'aloo tickie and fun', 'upload/aloo_tikki_burger_50.JPG', 10, 0, '2011-08-27 00:00:00', 0),
(9, 'honeychille', 'Veg', '', 'honey chilly is great', 'upload/honey_chilli_noodles_70.JPG', 50, 0, '0000-00-00 00:00:00', 0),
(10, 'ricebowl', 'Veg', '', 'Soft crisped fired rice', 'upload/veg_rice_bowl_50.JPG', 70, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderid`
--

CREATE TABLE `orderid` (
  `orderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderid`
--

INSERT INTO `orderid` (`orderId`) VALUES
(20);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `customerEmail` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `customerAddress` varchar(255) NOT NULL,
  `customerContact` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stafftable`
--

CREATE TABLE `stafftable` (
  `staff_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stafftable`
--

INSERT INTO `stafftable` (`staff_id`, `name`, `email`, `password`, `type`) VALUES
(4, 'Hunny', 'devinhunny@gmail.com', '$2y$10$ehtDsyyij/5b5LY6Pon6eelYxgucjdn9e75zU6OiEAxaOprFwGx9O', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customertable`
--
ALTER TABLE `customertable`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `itemtable`
--
ALTER TABLE `itemtable`
  ADD PRIMARY KEY (`itemS.no`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `stafftable`
--
ALTER TABLE `stafftable`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customertable`
--
ALTER TABLE `customertable`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `itemtable`
--
ALTER TABLE `itemtable`
  MODIFY `itemS.no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stafftable`
--
ALTER TABLE `stafftable`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

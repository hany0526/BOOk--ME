-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2017 at 08:52 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `offerID` int(255) NOT NULL,
  `offerName` varchar(255) NOT NULL,
  `hotelID` int(255) NOT NULL,
  `noUser` int(11) NOT NULL DEFAULT '2',
  `Price` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `Approve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`offerID`, `offerName`, `hotelID`, `noUser`, `Price`, `start`, `end`, `description`, `Approve`) VALUES
(1, 'Honey', 2, 0, 1200, '2017-04-24', '2017-04-28', 'first offer', 1),
(7, 'mama', 2, 2, 1200, '2017-05-08', '2017-05-31', 'mam mam', 1),
(11, 'Honey', 22, 2, 30, '2017-05-08', '2017-05-08', 'Quiet', 1),
(12, 'Nile Room', 22, 2, 35, '2017-05-08', '2017-05-08', 'Quiet', 1),
(14, 'air', 21, 2, 400, '2017-05-09', '2017-05-09', 'air', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentID` int(11) NOT NULL,
  `offerID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentID`, `offerID`, `userID`) VALUES
(3, 11, 23),
(4, 13, 23),
(5, 14, 23),
(6, 11, 24),
(7, 11, 24);

-- --------------------------------------------------------

--
-- Table structure for table `typeuser`
--

CREATE TABLE `typeuser` (
  `typeUserID` int(11) NOT NULL,
  `typeName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `typeuser`
--

INSERT INTO `typeuser` (`typeUserID`, `typeName`) VALUES
(1, 'traveler'),
(2, 'manger'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `typeUserID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` int(11) NOT NULL,
  `phone` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `RegStatus` int(11) NOT NULL DEFAULT '0',
  `avatar` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `typeUserID`, `userName`, `email`, `password`, `phone`, `location`, `RegStatus`, `avatar`, `description`) VALUES
(2, 3, 'mohamed', 'mohamed@info', 601, 123123, '', 1, '', ''),
(20, 2, 'Cairo Marriott Hotel', 'marrriott@gmail.com', 601, 12345678, ' 16 Saraya El Gezira, Zamalek, 11211 Cairo, Egypt ', 1, '34306_43637488.jpg', 'very good'),
(21, 2, 'Sofitel Cairo Nile', 'Sofitel@gmail.com', 601, 12345678, '3 El Thawra Council St Zamalek, 11518 Cairo, Egypt', 1, '92212_41450723.jpg', 'very good'),
(22, 2, 'The Nile', 'nile@gmail.com', 601, 12345678, '1113 Corniche El Nil, 12344 Cairo, Egypt', 1, '76109_55629025.jpg', 'very good'),
(23, 1, 'asmaa', 'asmaa@outlook.com', 601, 0, '', 1, '', ''),
(24, 1, 'alshaymaa', 'shay@gmail.com', 601, 0, '', 1, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`offerID`),
  ADD KEY `UserID` (`hotelID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `offerID` (`offerID`),
  ADD KEY `user` (`userID`);

--
-- Indexes for table `typeuser`
--
ALTER TABLE `typeuser`
  ADD PRIMARY KEY (`typeUserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `first` (`typeUserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `offerID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `typeuser`
--
ALTER TABLE `typeuser`
  MODIFY `typeUserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `offer_ibfk_1` FOREIGN KEY (`hotelID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `first` FOREIGN KEY (`typeUserID`) REFERENCES `typeuser` (`typeUserID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

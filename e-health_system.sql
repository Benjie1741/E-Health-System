-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2020 at 07:57 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-health system`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `DoctorID` int(11) NOT NULL,
  `Licence Revalidation Date` date NOT NULL,
  `Specialty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Clearance Level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `PatientID` int(11) NOT NULL,
  `Blood Type` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Medical History` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Illness` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Allergies` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Assigned Doctor` int(11) NOT NULL,
  `Prescriptions` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `First Name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Last Name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date of Birth` date NOT NULL,
  `Age` int(3) NOT NULL,
  `Address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone Number` bigint(11) NOT NULL,
  `Email Address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `First Name`, `Last Name`, `Date of Birth`, `Age`, `Address`, `Phone Number`, `Email Address`, `Password`) VALUES
(7, 'Kenneth', 'Alegria', '1997-11-17', 22, 'Flat 58, Leadmill Point', 9876543219, 'Testing@test.com', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`DoctorID`),
  ADD UNIQUE KEY `DoctorID_2` (`DoctorID`),
  ADD KEY `DoctorID` (`DoctorID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`PatientID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserID_2` (`UserID`),
  ADD KEY `UserID` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `DoctorID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

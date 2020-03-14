-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2020 at 11:33 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ehealth3`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatmessages`
--

CREATE TABLE `chatmessages` (
  `message` varchar(1000) NOT NULL,
  `date` varchar(100) NOT NULL,
  `displayName` varchar(100) NOT NULL,
  `pID` int(100) NOT NULL,
  `dID` int(100) NOT NULL,
  `seen` int(11) NOT NULL,
  `sentBy` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatmessages`
--

INSERT INTO `chatmessages` (`message`, `date`, `displayName`, `pID`, `dID`, `seen`, `sentBy`) VALUES
('HELLO', 'March 14, 2020 11:13:27 PM', 'Ken', 7, 7, 1, 'P'),
('sdasad', 'March 14, 2020 11:19:52 PM', 'Ken', 7, 7, 1, 'P'),
('dsadsadsdadsadadsad', 'March 14, 2020 11:23:02 PM', 'LukeD', 7, 7, 1, 'D'),
('dsadd', 'March 14, 2020 11:31:30 PM', 'LukeD', 7, 7, 1, 'D');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `DoctorID` int(11) NOT NULL,
  `firstName` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateOfBirth` date NOT NULL,
  `age` tinyint(3) NOT NULL,
  `userAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` bigint(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userPassword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `licenseRevalidationDate` date NOT NULL,
  `specialty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clearanceLevel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`DoctorID`, `firstName`, `lastName`, `dateOfBirth`, `age`, `userAddress`, `phoneNumber`, `email`, `userPassword`, `licenseRevalidationDate`, `specialty`, `clearanceLevel`) VALUES
(7, 'LukeD', '', '0000-00-00', 0, '', 0, 'test@test.co.uk', '$2y$10$ckD8t4gbS7HCdX4FnW2ls.tHoy6bg5eIWoEmErfnw1XYrEP3Qx4uq', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `healthdata`
--

CREATE TABLE `healthdata` (
  `HealthDataID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `hoursOfSleep` int(255) NOT NULL,
  `hoursOfExercise` int(255) NOT NULL,
  `heartRate` int(255) NOT NULL,
  `exerciseDone` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateOfExercise` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `healthdata`
--

INSERT INTO `healthdata` (`HealthDataID`, `userID`, `hoursOfSleep`, `hoursOfExercise`, `heartRate`, `exerciseDone`, `dateOfExercise`) VALUES
(1, 7, 1, 1, 80, '2', '2020-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `PatientID` int(11) NOT NULL,
  `firstName` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateOfBirth` date NOT NULL,
  `age` int(3) NOT NULL,
  `userAddress` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` bigint(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userPassword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bloodType` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medicalHistory` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `illness` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allergies` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctorID` int(11) NOT NULL,
  `prescription` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`PatientID`, `firstName`, `lastName`, `dateOfBirth`, `age`, `userAddress`, `phoneNumber`, `email`, `userPassword`, `bloodType`, `medicalHistory`, `illness`, `allergies`, `doctorID`, `prescription`) VALUES
(7, 'Ken', 'Midgely', '1998-04-22', 21, 'address', 7777, 'luke@test.co.uk', '$2y$10$u3FOysZAp3JsfbsWRkyCwOP/Gufbd76p6UO452/CRHAqNPnQ.X9ga', 'B-', 'MH', 'ILL', 'ALLER', 7, 'PRES');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`DoctorID`),
  ADD KEY `DoctorID` (`DoctorID`);

--
-- Indexes for table `healthdata`
--
ALTER TABLE `healthdata`
  ADD PRIMARY KEY (`HealthDataID`),
  ADD KEY `UserID` (`userID`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`PatientID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `DoctorID` (`doctorID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `DoctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `healthdata`
--
ALTER TABLE `healthdata`
  MODIFY `HealthDataID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `healthdata`
--
ALTER TABLE `healthdata`
  ADD CONSTRAINT `healthdata_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `patients` (`PatientID`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `doctors` (`DoctorID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

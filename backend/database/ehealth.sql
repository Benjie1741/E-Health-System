-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2020 at 05:05 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ehealth`
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
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userPassword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `licenseRevalidationDate` date NOT NULL,
  `specialty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clearanceLevel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`DoctorID`, `firstName`, `lastName`, `dateOfBirth`, `age`, `userAddress`, `phoneNumber`, `email`, `userPassword`, `licenseRevalidationDate`, `specialty`, `clearanceLevel`) VALUES
(1, 'Gustavo', 'Sanchez', '1998-01-02', 22, '26 Leadmill Road', 7845287335, 'g@g.com', '$2y$10$l8lz.HNR4oM3B3gHuEtB4eFzDx2K4Ebu.vHA1I2fUy.7n5ZBj/pVS', '2027-09-09', 'Oncologist', '5');

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
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userPassword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bloodType` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medicalHistory` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `illness` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allergies` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctorID` int(11) NOT NULL,
  `prescription` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `textSize` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `font` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`DoctorID`),
  ADD UNIQUE KEY `email` (`email`),
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
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `DoctorID` (`doctorID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `DoctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `healthdata`
--
ALTER TABLE `healthdata`
  MODIFY `HealthDataID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT;

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

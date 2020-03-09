-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2020 at 05:53 PM
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
-- Database: `e-healthsystem`
--

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
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` bigint(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `licenseRevalidationDate` date NOT NULL,
  `specialty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clearanceLevel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`DoctorID`, `firstName`, `lastName`, `dateOfBirth`, `age`, `address`, `phoneNumber`, `email`, `password`, `licenseRevalidationDate`, `specialty`, `clearanceLevel`) VALUES
(1, 'Ken', 'Alegria', '2020-03-01', 22, 'Flat 58, Leadmill POint', 1234567891, 'Testing@test.com', 'Ken123', '2020-03-31', 'Surgeon', '5'),
(2, 'Arj', 'Grewal', '2020-03-08', 21, 'Somewhere in Leicester', 9876543219, 'TestThisEmail@test.com', 'Arj123', '2020-03-27', 'Radiology', '4'),
(3, 'Gus', 'Sanchez', '2020-03-02', 22, 'Caceres, Spain', 6598732199, 'Tapas@test.com', 'Gus123', '2020-03-17', 'Gastronomy', '3'),
(4, 'Luke', 'Midgley', '2020-03-08', 21, 'Manchester', 1234567895, 'Bet365@PlsGiveMeAJob.com', 'Luke123', '2020-03-30', 'Oncology', '2'),
(5, 'Greg', 'Smith', '2020-03-11', 21, 'Snakes pass, Sheffield', 9854751236, 'GregsWhip@RideMeDaddy.com', 'Greg123', '2020-03-26', 'Pediatrician', '1');

-- --------------------------------------------------------

--
-- Table structure for table `healthdata`
--

CREATE TABLE `healthdata` (
  `HealthDataID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `hoursOfSleep` int(255) NOT NULL,
  `hourOfExercise` int(255) NOT NULL,
  `heartRate` int(255) NOT NULL,
  `exerciseDone` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateOfExercise` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `healthdata`
--

INSERT INTO `healthdata` (`HealthDataID`, `userID`, `hoursOfSleep`, `hourOfExercise`, `heartRate`, `exerciseDone`, `dateOfExercise`) VALUES
(1, 1, 7, 1, 75, 'Running', '2020-03-08'),
(2, 2, 8, 0, 74, 'N/A', '2020-03-08'),
(3, 3, 10, 2, 78, 'Weight lifting, Running', '2020-03-06'),
(4, 4, 7, 1, 75, 'Yoga', '2020-03-08'),
(5, 5, 3, 0, 75, 'N/A', '2020-03-08');

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
  `address` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` bigint(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `patients` (`PatientID`, `firstName`, `lastName`, `dateOfBirth`, `age`, `address`, `phoneNumber`, `email`, `password`, `bloodType`, `medicalHistory`, `illness`, `allergies`, `doctorID`, `prescription`) VALUES
(1, 'Constance', 'Witmann', '2020-03-06', 21, 'Reutlingen, Germany', 1254789632, 'exchangeStudent@test.com', 'Const123', 'AB+', 'N/A', 'Corona Virus', 'Peanuts', 1, 'Paracetamol'),
(2, 'Juan', 'Juarez', '2020-03-01', 42, 'Mexico City, Mexico', 1258964736, 'CoronaIsADrink@NotAVirus.com', 'Juan23', 'A+', 'Medical History:\r\nMeningitis - 2012\r\nLeft arm amputation - 2018', 'Ebola', 'None', 4, 'Tequila'),
(3, 'Andros', 'Konstantinos', '2020-03-05', 47, 'Athens, Greece', 2574819463, 'AK-47@MyInitials.com', 'ak47', 'O-', 'Medical History:\r\nAlcoholism - 1980\r\nSubstance Abuse - 1990\r\n', 'Early onset of frostbite', 'None', 2, 'A heat pack. RIP'),
(4, 'Amy', 'Whitley', '2020-03-06', 28, 'Fort Worth, Texas, USA', 1299854763, 'MakeAmerica@ConnectedAgain.com', 'MAGA123', 'B+', 'Medical History:\r\nRemoval of two wisdom teeth - 2011\r\n', 'High fever, Burning eyes, nose bleeds, nausea, aches and pains, hair loss, Random anaphylaxis', 'Dogs, cats, grass, peanut butter, fun', 3, 'Glass of water'),
(5, 'Anatoly', 'Karpov', '2020-03-04', 44, 'Svastopol, Russia', 1258947635, 'Vodka@me.com', 'Ana123', 'AB-', 'Medical History:\r\nSEVERE alcohol poisoning: 2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010', 'Alcohol Posioning', 'Water', 1, 'Blood transfusion');

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
  MODIFY `DoctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `healthdata`
--
ALTER TABLE `healthdata`
  MODIFY `HealthDataID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2021 at 12:43 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bursary`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `ApplicantID` int(25) NOT NULL,
  `FirstName` varchar(128) NOT NULL,
  `SurName` varchar(128) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `UserName` varchar(128) NOT NULL,
  `Password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`ApplicantID`, `FirstName`, `SurName`, `Email`, `UserName`, `Password`) VALUES
(23232323, 'John', 'Doe', 'jdoe@gmail.com', 'jdoe', '$2y$10$Ns3846837CHa8p9KUDNHx.g6QihJyCkUhZsj/8emA67Q6tf67U7tq');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `ApplicationID` int(25) NOT NULL,
  `ApplicantID` int(25) NOT NULL,
  `ApplicantUni` int(25) NOT NULL,
  `AdmissionNumber` int(25) NOT NULL,
  `AmountNeeded` int(25) NOT NULL,
  `IDPictureUrl` varchar(128) NOT NULL,
  `ApplicationStatus` varchar(128) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`ApplicationID`, `ApplicantID`, `ApplicantUni`, `AdmissionNumber`, `AmountNeeded`, `IDPictureUrl`, `ApplicationStatus`) VALUES
(1, 23232323, 34343434, 1212122, 687687, '76558', 'accepted'),
(2, 23232323, 34343434, 1212122, 687687, '76558', 'pending'),
(3, 23232323, 34343434, 1212122, 687687, '../uploads/IMG-612956ac6df873.15846257.png', 'accepted'),
(4, 23232323, 45454545, 1212122, 687687, '../uploads/IMG-612b5f7ec9cab2.67388818.png', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `bursaryadmins`
--

CREATE TABLE `bursaryadmins` (
  `BursID` int(20) NOT NULL,
  `FirstName` varchar(128) NOT NULL,
  `SurName` varchar(128) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `UserName` varchar(128) NOT NULL,
  `Password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bursaryadmins`
--

INSERT INTO `bursaryadmins` (`BursID`, `FirstName`, `SurName`, `Email`, `UserName`, `Password`) VALUES
(44444444, 'James', 'Bond', 'jbond@gmail.com', 'jbond', '$2y$10$7e1UWRNg.wh5Q8wGrZDBGu3mmjUeYcIlimh2qD7vpls4tXE8ftFB6');

-- --------------------------------------------------------

--
-- Table structure for table `familydetails`
--

CREATE TABLE `familydetails` (
  `DetailID` int(20) NOT NULL,
  `ApplicantID` int(20) NOT NULL,
  `FamilyStatus` varchar(128) NOT NULL,
  `CPFullName` varchar(128) NOT NULL,
  `PhoneNumber` int(20) NOT NULL,
  `Occupation` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `familydetails`
--

INSERT INTO `familydetails` (`DetailID`, `ApplicantID`, `FamilyStatus`, `CPFullName`, `PhoneNumber`, `Occupation`) VALUES
(1, 23232323, 'Mother and Father', 'Full Name', 897654, 'Doctor'),
(2, 23232323, 'Mother and Father', 'Full Name', 897654, 'Doctor'),
(3, 23232323, 'Mother and Father', 'Full Name', 98765678, 'Doctor'),
(4, 23232323, 'Mother and Father', 'Full Name', 756284930, 'Doctor');

-- --------------------------------------------------------

--
-- Table structure for table `systemadmins`
--

CREATE TABLE `systemadmins` (
  `SysID` int(20) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `UserName` varchar(128) NOT NULL,
  `Password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `systemadmins`
--

INSERT INTO `systemadmins` (`SysID`, `Email`, `UserName`, `Password`) VALUES
(11111111, 'sharleen@gmail.com', 'sharleen', 'sharleen@2021');

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `UniID` int(15) NOT NULL,
  `UniName` varchar(128) NOT NULL,
  `UniEmail` varchar(128) NOT NULL,
  `UniLocation` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`UniID`, `UniName`, `UniEmail`, `UniLocation`) VALUES
(45454545, 'Techincal University of Kenya', 'email@tuk.co.ke', 'Nairobi'),
(23232323, 'University of Nairobi', 'email@uon.co.ke', 'Nairobi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`ApplicantID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`ApplicationID`);

--
-- Indexes for table `familydetails`
--
ALTER TABLE `familydetails`
  ADD PRIMARY KEY (`DetailID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `ApplicantID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23232324;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `ApplicationID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `familydetails`
--
ALTER TABLE `familydetails`
  MODIFY `DetailID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

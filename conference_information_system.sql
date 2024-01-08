-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2024 at 05:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `conference_information_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `conference_participant`
--

CREATE TABLE `conference_participant` (
  `Pid` int(11) NOT NULL,
  `Pssn` varchar(20) DEFAULT NULL,
  `Pfname` varchar(50) DEFAULT NULL,
  `Plname` varchar(50) DEFAULT NULL,
  `Pbod` date DEFAULT NULL,
  `P_project_name` varchar(100) DEFAULT NULL,
  `Psex` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conf_admin`
--

CREATE TABLE `conf_admin` (
  `Aid` int(11) NOT NULL,
  `Auname` varchar(50) DEFAULT NULL,
  `Apassowrd` varchar(50) DEFAULT NULL,
  `Aemail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conf_admin`
--

INSERT INTO `conf_admin` (`Aid`, `Auname`, `Apassowrd`, `Aemail`) VALUES
(0, 'majed', 'admin123456', 'majedjameel@gmail.com'),
(123, 'majed1', '12345', 'majedjameel2@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `participant_username`
--

CREATE TABLE `participant_username` (
  `PID` int(11) NOT NULL,
  `Pemail` varchar(50) DEFAULT NULL,
  `Ppassword` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participant_username`
--

INSERT INTO `participant_username` (`PID`, `Pemail`, `Ppassword`) VALUES
(1, 'majedalqudah@gmail.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conference_participant`
--
ALTER TABLE `conference_participant`
  ADD PRIMARY KEY (`Pid`);

--
-- Indexes for table `conf_admin`
--
ALTER TABLE `conf_admin`
  ADD PRIMARY KEY (`Aid`);

--
-- Indexes for table `participant_username`
--
ALTER TABLE `participant_username`
  ADD PRIMARY KEY (`PID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

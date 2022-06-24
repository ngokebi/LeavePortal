-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2022 at 10:45 AM
-- Server version: 8.0.29
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employeeleavedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `Email` varchar(55) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `Fullname`, `Email`, `DateCreated`) VALUES
(1, 'Ngozi', 'e3bcc392db02857ac29973cc4630a81d', 'Ikeaba Ngozi', 'kebidegozi@gmail.com', '2022-05-18 11:46:27');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int NOT NULL,
  `DepartmentName` varchar(150) DEFAULT NULL,
  `DepartmentShortName` varchar(100) NOT NULL,
  `DepartmentCode` varchar(50) DEFAULT NULL,
  `DepartmentHead` varchar(50) DEFAULT NULL,
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `DepartmentName`, `DepartmentShortName`, `DepartmentCode`, `DepartmentHead`, `DateCreated`) VALUES
(1, 'Innovation and Technology', 'IT', 'DPT000001', 'nikeaba@pagefinancials.com', '2022-05-20 13:32:26'),
(2, 'Personal Lending', 'PL', 'DPT000002', 'ocoker@pagefinancials.com', '2022-05-20 13:34:02'),
(3, 'Internal Control', 'IC', 'DPT000003', 'bomore@pagefinancials.com', '2022-05-20 13:34:33'),
(4, 'Finance', 'FI', 'DPT000004', 'inweke@pagefinancials.com', '2022-05-20 13:35:28'),
(5, 'Marketing', 'MK', 'DPT000005', 'ckalu@pagefinancials.com', '2022-05-20 13:36:06'),
(6, 'Transcation Center', 'TC', 'DPT000006', 'oawesu@pagefinancials.com', '2022-05-20 13:37:00'),
(7, 'Customer Services', 'CS', 'DPT000009', 'qokoro@pagefinancials.com', '2022-05-20 13:37:35'),
(8, 'Cooperate Services', 'COS', 'DPT000007', 'cawotoye@pagefinancials.com', '2022-05-20 13:38:22'),
(9, 'Risk Management', 'RM', 'DPT000008', 'sgodson@pagefinancials.com', '2022-05-20 13:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int NOT NULL,
  `EmployeeId` varchar(100) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Dob` varchar(100) NOT NULL,
  `DeptHead` varchar(100) DEFAULT NULL,
  `Department` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Country` varchar(150) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `Status` enum('Active','Deleted','Inactive') NOT NULL DEFAULT 'Active',
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `EmployeeId`, `FirstName`, `LastName`, `Email`, `Password`, `Gender`, `Dob`, `DeptHead`, `Department`, `Address`, `City`, `Country`, `Phonenumber`, `Status`, `DateCreated`) VALUES
(1, 'EMP000101', 'Uche', 'Dike', 'udike@pagefinancials.com', '90d0b6c53b294944e67689a6816f8e91', 'Female', '1995-03-08', 'ocoker@pagefinancials.com', 'Personal Lending', '23, Norman William, Ikoyi', 'Lagos', 'Nigeria', '8134596776', 'Inactive', '2022-05-20 13:52:21'),
(2, 'EMP000203', 'Victor', 'Ajayi', 'vajayi@pagefinancials.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', '1987-03-18', 'nikeaba@pagefinancials.com', 'Innovation and Technology', '23, Norman Williams', 'Lagos', 'Nigeria', '7034556787', 'Active', '2022-05-20 13:54:53'),
(3, 'EMP000345', 'Ngozichukwuka', 'Ikeaba', 'nikeaba@pagefinancials.com', 'e3bcc392db02857ac29973cc4630a81d', 'Male', '1994-03-16', 'nikeaba@pagefinancials.com', 'Innovation and Technology', '57, Palm Avenue', 'Lagos', 'Nigeria', '8141131223', 'Active', '2022-05-20 13:58:30'),
(4, 'EMP000407', 'Olatunde', 'Coker', 'ocoker@pagefinancials.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', '2022-05-01', 'ocoker@pagefinancials.com', 'Personal Lending', '23, Akin Street, Mushin', 'Lagos', 'Nigeria', '0834634636', 'Active', '2022-05-20 13:59:50');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int NOT NULL,
  `LeaveType` varchar(110) NOT NULL,
  `StartDate` varchar(120) NOT NULL,
  `EndDate` varchar(120) NOT NULL,
  `Description` mediumtext NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AdminRemark` mediumtext,
  `AdminRemarkDate` varchar(120) DEFAULT NULL,
  `DeptHeadRemark` mediumtext,
  `DeptHeadRemarkDate` varchar(120) DEFAULT NULL,
  `Status` int NOT NULL,
  `IsRead` int NOT NULL,
  `EmpID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leavetype`
--

CREATE TABLE `leavetype` (
  `id` int NOT NULL,
  `LeaveType` varchar(200) DEFAULT NULL,
  `Description` mediumtext,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leavetype`
--

INSERT INTO `leavetype` (`id`, `LeaveType`, `Description`, `DateCreated`) VALUES
(1, 'Casual Leave', 'Provided for urgent or unforeseen matters to the employees.', '2020-11-01 12:07:56'),
(2, 'Medical Leave', 'Related to Health Problems of Employee', '2020-11-06 13:16:09'),
(3, 'Restricted Holiday', 'Holiday that is optional', '2020-11-06 13:16:38'),
(4, 'Paternity Leave', 'To take care of newborns', '2021-03-03 10:46:31'),
(5, 'Bereavement Leave', 'Grieve their loss of losing loved ones', '2021-03-03 10:47:48'),
(6, 'Compensatory Leave', 'For Overtime workers', '2021-03-03 10:48:37'),
(7, 'Maternity Leave', 'Taking care of newborn ,recoveries', '2021-03-03 10:50:17'),
(8, 'Religious Holidays', 'Based on employee\'s followed religion', '2021-03-03 10:51:26'),
(9, 'Adverse Weather Leave', 'In terms of extreme weather conditions', '2021-03-03 13:18:26'),
(10, 'Voting Leave', 'For official election day', '2021-03-03 13:19:06'),
(11, 'Self-Quarantine Leave', 'Related to COVID-19 issues', '2021-03-03 13:19:48'),
(12, 'Personal Time Off', 'To manage some private matters', '2021-03-03 13:21:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserEmail` (`DeptHead`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserEmail` (`EmpID`);

--
-- Indexes for table `leavetype`
--
ALTER TABLE `leavetype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leavetype`
--
ALTER TABLE `leavetype`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

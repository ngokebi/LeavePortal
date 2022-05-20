-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2022 at 01:53 PM
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
(1, 'Ngozi', 'e3bcc392db02857ac29973cc4630a81d', 'Ikeaba Ngozi', 'admin@mail.com', '2022-05-18 11:46:27');

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
(1, 'Human Resource', 'HR', 'HR160', 'it_unit', '2020-11-01 07:16:25'),
(2, 'Information Technology', 'IT', 'IT807', 'it_unit2', '2020-11-01 07:19:37'),
(3, 'Operations', 'OP', 'OP640', 'it_unit3', '2020-12-02 21:28:56'),
(4, 'Volunteer', 'VL', 'VL9696', 'it_unit4', '2021-03-03 08:27:52'),
(5, 'Marketing', 'MK', 'MK369', 'it_unit5', '2021-03-03 10:53:52'),
(6, 'Finance', 'FI', 'FI123', 'it_unit6', '2021-03-03 10:54:27'),
(7, 'Sales', 'SS', 'SS469', 'it_unit7', '2021-03-03 10:55:24'),
(8, 'Research', 'RS', 'RS666', 'it_unit8', '2021-03-03 16:39:03');

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
(1, 'ASTR001245', 'Johnny', 'Scott', 'johnny@mail.com', 'e3bcc392db02857ac29973cc4630a81d', 'Male', '1996-06-12', 'johnny@mail.com', 'Information Technology', '49 Arron Smith Drive', 'Honolulu', 'US', '7854785477', 'Active', '2020-11-10 11:29:59'),
(2, 'ASTR001369', 'Milton', 'Doe', 'milt@mail.com', 'e3bcc392db02857ac29973cc4630a81d', 'Male', '1990-02-02', 'johnny@mail.com', 'Operations', '15 Kincheloe Road', 'Salem', 'US', '8587944255', 'Active', '2020-11-10 13:40:02'),
(3, 'ASTR004699', 'Shawn', 'Den', 'Shawnden@mail.com', '3b87c97d15e8eb11e51aa25e9a5770e9', 'Male', '1995-03-22', 'johnny@mail.com', 'Human Resource', '239 Desert Court', 'Wayne', 'US', '7458887169', 'Active', '2021-03-03 07:24:17'),
(4, 'ASTR002996', 'Carol', 'Reed', 'carol@mail.com', '723e1489a45d2cbaefec82eee410abd5', 'Female', '1989-03-23', NULL, 'Volunteer', 'Demo Address', 'Demo City', 'Demo Country', '7854448550', 'Active', '2021-03-03 10:44:13'),
(5, 'ASTR001439', 'Danny', 'Wood', 'danny@mail.com', 'b7bee6b36bd35b773132d4e3a74c2bb5', 'Male', '1986-03-12', NULL, 'Research', '11 Rardin Drive', 'San Francisco', 'US', '4587777744', 'Active', '2021-03-04 17:14:48'),
(6, 'ASTR006946', 'Shawn', 'Martin', 'shawn@mail.com', 'a3cceba83235dc95f750108d22c14731', 'Male', '1992-08-28', NULL, 'Finance', '3259 Ray Court', 'Wilmington', 'US', '8520259670', 'Active', '2021-03-04 17:46:02'),
(7, 'ASTR000084', 'Jennifer', 'Foltz', 'jennifer@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Female', '1992-12-11', NULL, 'Marketing', '977 Smithfield Avenue', 'Elkins', 'US', '7401256696', 'Active', '2022-02-09 15:29:00'),
(8, 'ASTR012447', 'Will', 'Williams', 'williams@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Male', '1992-02-15', NULL, 'Research', '366 Cemetery Street', 'Houston', 'US', '7854000065', 'Active', '2022-02-10 15:52:32');

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
  `Status` int NOT NULL,
  `IsRead` int NOT NULL,
  `EmpID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `LeaveType`, `StartDate`, `EndDate`, `Description`, `DateCreated`, `AdminRemark`, `AdminRemarkDate`, `Status`, `IsRead`, `EmpID`) VALUES
(1, 'Casual Leave', '30/11/2020', '29/10/2020', 'Test Test Demo Test Test Demo Test Test Demo', '2020-11-19 13:11:21', 'A demo Admin Remarks for Testing!', '2020-12-02 23:26:27 ', 0, 1, 1),
(2, 'Medical Leave', '21/10/2020', '25/10/2020', 'Test Test Demo Test Test Demo Test Test Demo Test Test Demo', '2020-11-20 11:14:14', 'A demo Admin Remarks for Testing!', '2020-12-02 23:24:39 ', 0, 1, 2),
(3, 'Medical Leave', '08/12/2020', '12/12/2020', 'This is a demo description for testing purpose', '2020-12-02 18:26:01', 'All good make your time and hope you\'ll be fine and get back to work asap! Best Regards, Admin.', '2021-03-03 11:19:29 ', 0, 0, 2),
(4, 'Restricted Holiday', '25/12/2020', '25/12/2020', 'This is a demo description for testing purpose', '2020-12-03 08:29:07', 'A demo Admin Remarks for Testing!', '2020-12-03 14:06:12 ', 0, 1, 2),
(5, 'Medical Leave', '02/12/2020', '06/12/2020', 'This is a demo description for testing purpose', '2020-04-29 15:01:14', 'A demo Admin Remarks for Testing!', '2020-04-29 20:33:21 ', 0, 1, 1),
(6, 'Casual Leave', '02/02/2020', '03/03/2020', 'This is a demo description for testing purpose', '2020-07-03 08:11:11', 'go', '2022-05-19 17:13:11 ', 2, 2, 1),
(7, 'Medical Leave', '2020-03-05', '2020-06-05', 'This is a demo description for testing purpose', '2021-03-02 09:31:01', NULL, NULL, 3, 1, 2),
(8, 'Casual Leave', '2021-03-15', '2021-03-05', 'None, Testing', '2021-03-02 09:32:42', 'casual leave not allowed for a week, the company\'s gotta huge project which should be completed within this week.', '2021-03-03 11:47:33 ', 2, 1, 1),
(9, 'Paternity Leave', '2021-03-03', '2021-03-10', 'Being a father i\'ve got to look after my new borns and spend some time with my families too!', '2021-03-03 10:58:18', NULL, NULL, 0, 1, 3),
(10, 'Medical Leave', '2021-03-04', '2021-03-05', 'i\'ve to go for my body checkup. got an appointment for tommorow', '2021-03-03 12:09:44', 'nah', '2022-05-19 17:13:22 ', 3, 2, 4),
(11, 'Compensatory Leave', '2021-03-05', '2021-03-06', 'been working over time since last night, so i\'d like a day off', '2021-03-03 12:24:15', NULL, NULL, 0, 1, 1),
(12, 'Casual Leave', '2022-02-09', '2022-02-12', 'None, Test Mode', '2022-02-09 15:31:15', NULL, NULL, 0, 1, 7),
(13, 'Self-Quarantine Leave', '2022-02-11', '2022-02-18', 'This is just a demo condition for testing purpose!!', '2022-02-10 16:05:30', 'you can go', '2022-05-19 17:10:01 ', 2, 1, 8);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `leavetype`
--
ALTER TABLE `leavetype`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

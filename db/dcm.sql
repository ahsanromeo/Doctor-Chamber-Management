-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2016 at 11:45 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dcm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'cseku', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(100) NOT NULL,
  `app_id` varchar(100) NOT NULL,
  `patient_id` varchar(100) NOT NULL,
  `test` varchar(100) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(20) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `state` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `app_id`, `patient_id`, `test`, `date`, `time`, `amount`, `status`, `state`) VALUES
(4, 'A001', 'P002', 'T001,T002,T004,T005', '28-10-2016', '4:00pm - 08:00pm', '1600 tk', 'Paid', 2),
(5, 'A002', 'P001', 'T002,T003', '15-10-2016', '8:00am - 10:00am', '600 tk', 'Due', 0),
(6, 'A003', 'P001', 'T001,T004', '17-11-2016', '4:00pm - 08:00pm', '750 tk', 'Paid', 0),
(7, 'A004', 'P001', 'T003', '12-10-2016', '4:00pm - 08:00pm', '250 tk', 'Paid', 2);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(100) NOT NULL,
  `doctor_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `doctor_id`, `name`, `department`, `contact`) VALUES
(3, 'D001', 'Dr Abir Hasan', 'Blood Specialist', 'abir@gmail.com'),
(4, 'D002', 'Dr. Amjad', 'Head neck', 'amjad@ymail.com'),
(5, 'D003', 'Dr Shayla', 'Bone Specialist', 'shayla@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(100) NOT NULL,
  `p_id` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `age` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `p_id`, `name`, `address`, `age`, `sex`, `email`, `username`, `pass`) VALUES
(2, 'P001', 'Procheta Nag', 'Madaripur, Khulna', '22', 'female', 'nag@gmail.com', 'p1', '12345'),
(3, 'P002', 'Nayan', 'Satkhira, Khulna', '24', 'male', 'nayan@hotmail.com', 'p2', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(20) NOT NULL,
  `app_id` varchar(20) NOT NULL,
  `patient_id` varchar(100) NOT NULL,
  `result` varchar(200) NOT NULL,
  `doctor` varchar(60) NOT NULL,
  `report_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `app_id`, `patient_id`, `result`, `doctor`, `report_date`) VALUES
(2, 'A001', 'P002', '60,45,62,42', 'Dr Abir Hasan', '10-11-2016'),
(3, 'A004', 'P001', '12', 'Dr Abir Hasan', '10-11-2016');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(100) NOT NULL,
  `test_id` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `cost` varchar(20) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `test_id`, `type`, `cost`, `status`) VALUES
(3, 'T001', 'Hemoglobin Test', '150', 1),
(4, 'T002', 'Red Cell Test', '350', 1),
(5, 'T003', 'White Cell Test', '250', 1),
(6, 'T004', 'X-Ray', '600', 1),
(7, 'T005', 'Heart Rate', '500', 1);

-- --------------------------------------------------------

--
-- Table structure for table `test_details`
--

CREATE TABLE `test_details` (
  `id` int(100) NOT NULL,
  `test_id` varchar(20) NOT NULL,
  `test_type` varchar(100) NOT NULL,
  `min` varchar(100) NOT NULL,
  `avg` varchar(100) NOT NULL,
  `max` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_details`
--

INSERT INTO `test_details` (`id`, `test_id`, `test_type`, `min`, `avg`, `max`) VALUES
(3, 'T001', 'Hemoglobin Test', '30,Problematic', '50,Good', '85,Dangerous'),
(4, 'T002', 'Red Cell Test', '25,Low', '55,Normal', '75,Good'),
(5, 'T003', 'White Cell Test', '35,Low', '55,Good', '82,High'),
(6, 'T004', 'X-Ray', '10,Low', '45,Normal', '92,High'),
(7, 'T005', 'Heart Rate', '36,Low', '65,Good', '85,Danger');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_details`
--
ALTER TABLE `test_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `test_details`
--
ALTER TABLE `test_details`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

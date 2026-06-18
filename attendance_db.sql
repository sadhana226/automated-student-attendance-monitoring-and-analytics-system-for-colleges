-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2026 at 05:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'admin', 'admin555');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `status` enum('Present','Absent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `attendance_date`, `status`) VALUES
(1, 5, '2026-06-18', 'Absent'),
(2, 6, '2026-06-18', 'Absent'),
(3, 7, '2026-06-18', 'Absent'),
(4, 8, '2026-06-18', 'Absent'),
(5, 9, '2026-06-18', 'Present'),
(6, 10, '2026-06-18', 'Present'),
(7, 11, '2026-06-18', 'Present'),
(8, 12, '2026-06-18', 'Present'),
(9, 13, '2026-06-18', 'Present'),
(10, 14, '2026-06-18', 'Present'),
(11, 15, '2026-06-18', 'Present'),
(12, 16, '2026-06-18', 'Present'),
(13, 17, '2026-06-18', 'Present'),
(14, 18, '2026-06-18', 'Present'),
(15, 19, '2026-06-18', 'Present'),
(16, 20, '2026-06-18', 'Present'),
(17, 21, '2026-06-18', 'Present'),
(18, 22, '2026-06-18', 'Present'),
(19, 23, '2026-06-18', 'Present'),
(20, 24, '2026-06-18', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL,
  `faculty_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `reg_no` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department` varchar(50) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `reg_no`, `name`, `department`, `year`) VALUES
(5, '101', 'Arun', 'CSE', 2),
(6, '102', 'Priya', 'CSE', 2),
(7, '103', 'Kumar', 'CSE', 2),
(8, '104', 'Siva', 'CSE', 2),
(9, '105', 'Rani', 'CSE', 2),
(10, '106', 'Vijay', 'CSE', 2),
(11, '107', 'Deepa', 'CSE', 2),
(12, '108', 'Karthi', 'CSE', 2),
(13, '109', 'Meena', 'CSE', 2),
(14, '110', 'Hari', 'CSE', 2),
(15, '111', 'John', 'CSE', 2),
(16, '112', 'Sara', 'CSE', 2),
(17, '113', 'Ajay', 'CSE', 2),
(18, '114', 'Nila', 'CSE', 2),
(19, '115', 'Rohit', 'CSE', 2),
(20, '116', 'Anu', 'CSE', 2),
(21, '117', 'Bala', 'CSE', 2),
(22, '118', 'Vino', 'CSE', 2),
(23, '119', 'Ram', 'CSE', 2),
(24, '120', 'Kavi', 'CSE', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD UNIQUE KEY `unique_attendance` (`student_id`,`attendance_date`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

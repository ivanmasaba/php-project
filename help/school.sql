-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2022 at 08:14 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `class_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class_name`) VALUES
(1, 'senior one'),
(2, 'senior two'),
(3, 'senior three'),
(4, 'senior four');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `reg_num` int(11) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` enum('student','teacher','staff','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `reg_num`, `uname`, `password`, `level`) VALUES
(1, 1, 'musamali', '2', 'student'),
(2, 2, 'isaac', '1', 'student'),
(3, 3, 'george', '1', 'student'),
(4, 4, 'henry', '1', 'student'),
(5, 5, 'alexander', '1', 'student'),
(6, 6, 'martha', '1', 'student'),
(7, 7, 'mathew', '2', 'teacher');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `reg_num` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `test_score` int(11) DEFAULT 0,
  `exam_score` int(11) DEFAULT 0,
  `total_score` int(11) DEFAULT 0,
  `grade` varchar(30) DEFAULT 'F'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `reg_num`, `subj_id`, `test_score`, `exam_score`, `total_score`, `grade`) VALUES
(1, 1, 1, 0, 0, 0, 'F'),
(2, 1, 2, 0, 0, 0, 'F'),
(3, 1, 3, 0, 0, 0, 'F'),
(4, 1, 4, 0, 0, 0, 'F'),
(5, 1, 5, 0, 0, 0, 'F'),
(6, 1, 6, 0, 0, 0, 'F'),
(7, 1, 7, 0, 0, 0, 'F'),
(8, 2, 1, 0, 0, 0, 'F'),
(9, 2, 2, 0, 0, 0, 'F'),
(10, 2, 3, 0, 0, 0, 'F'),
(11, 2, 4, 0, 0, 0, 'F'),
(12, 2, 5, 0, 0, 0, 'F'),
(13, 2, 6, 0, 0, 0, 'F'),
(14, 2, 7, 0, 0, 0, 'F'),
(15, 3, 1, 0, 0, 0, 'F'),
(17, 3, 2, 0, 0, 0, 'F'),
(18, 3, 3, 0, 0, 0, 'F'),
(19, 3, 4, 0, 0, 0, 'F'),
(20, 3, 5, 0, 0, 0, 'F'),
(21, 3, 6, 0, 0, 0, 'F'),
(22, 3, 7, 0, 0, 0, 'F'),
(23, 4, 1, 0, 0, 0, 'F'),
(24, 4, 2, 0, 0, 0, 'F'),
(25, 4, 3, 0, 0, 0, 'F'),
(26, 4, 4, 0, 0, 0, 'F'),
(27, 4, 5, 0, 0, 0, 'F'),
(28, 4, 6, 0, 0, 0, 'F'),
(29, 4, 7, 0, 0, 0, 'F'),
(30, 5, 1, 0, 0, 0, 'F'),
(31, 5, 2, 0, 0, 0, 'F'),
(32, 5, 3, 0, 0, 0, 'F'),
(33, 5, 4, 0, 0, 0, 'F'),
(34, 5, 5, 0, 0, 0, 'F'),
(35, 5, 6, 0, 0, 0, 'F'),
(36, 5, 7, 0, 0, 0, 'F');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `gender` enum('male','female','','') NOT NULL,
  `birth_date` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff_id`, `class_id`, `subj_id`, `fname`, `lname`, `gender`, `birth_date`, `email`, `phone`, `address`) VALUES
(3, 7, 1, 1, 'mathew', 'vaughn', 'male', '2019-07-24', 'matvaughn@yh.com', '0778465853', 'kampala');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `reg_num` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `class_id` int(11) NOT NULL,
  `gender` enum('male','female','','') NOT NULL,
  `birth_date` date NOT NULL,
  `father_name` varchar(30) NOT NULL,
  `mother_name` varchar(30) NOT NULL,
  `parent_phone` text NOT NULL,
  `parent_address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `reg_num`, `fname`, `lname`, `class_id`, `gender`, `birth_date`, `father_name`, `mother_name`, `parent_phone`, `parent_address`) VALUES
(1, 1, 'musamali', 'derik', 1, 'male', '2022-05-11', 'musimbi', 'esther', '0774049096', 'mbale'),
(4, 2, 'isaac', 'phillip', 1, 'male', '2022-05-04', 'tom', 'winnie', '0789674563', 'mbale'),
(5, 3, 'george', 'fredrik', 1, 'male', '2022-05-27', 'yoweri', 'monica', '0778965432', 'kabarole'),
(6, 4, 'henry', 'larson', 2, 'male', '2022-05-07', 'bob', 'alice', '0709786542', 'mpigi'),
(7, 5, 'alexander', 'mary', 2, 'female', '2022-05-13', 'quinton', 'sandra', '0706759842', 'kampala'),
(8, 6, 'martha', 'catharine', 1, 'male', '2018-01-31', '6', 'elizabeth', '07068867666', 'kampala');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subj_name` enum('english','mathematics','chemistry','biology','physics','history','geography') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subj_name`) VALUES
(1, 'english'),
(2, 'mathematics'),
(3, 'chemistry'),
(4, 'biology'),
(5, 'physics'),
(6, 'history'),
(7, 'geography');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

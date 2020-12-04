-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2020 at 06:31 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schooldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id_course` int(6) NOT NULL,
  `title` varchar(30) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `description` text,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id_course`, `title`, `unit`, `description`, `update_at`, `create_at`) VALUES
(9, 'art', '5', 'something for art', '2020-06-09 21:46:47', '2020-06-09 21:46:47'),
(10, 'math1', '4', 'f', '2020-06-18 18:04:40', '2020-06-09 22:12:17'),
(14, 'vasayaye emam', '3', 'emam', '2020-06-11 18:55:49', '2020-06-11 18:55:49'),
(22, 'physic', '8', 'this is so hard', '2020-06-11 20:41:17', '2020-06-11 20:41:17'),
(25, 'art2', '8', 'description for art2', '2020-07-22 18:31:21', '2020-07-22 18:31:21');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id_student` int(6) NOT NULL,
  `id_course` int(6) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`id_student`, `id_course`, `update_at`, `create_at`) VALUES
(39, 9, '2020-07-22 18:42:23', '2020-07-22 18:42:23'),
(39, 10, '2020-07-22 18:42:23', '2020-07-22 18:42:23'),
(39, 14, '2020-07-22 18:42:23', '2020-07-22 18:42:23'),
(40, 9, '2020-06-18 18:56:48', '2020-06-18 18:56:48'),
(41, 10, '2020-06-18 18:05:53', '2020-06-18 18:05:53'),
(41, 25, '2020-07-22 18:32:21', '2020-07-22 18:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id_student` int(6) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id_student`, `firstName`, `lastName`, `birthday`, `gender`, `email`, `phone`, `update_at`, `create_at`) VALUES
(39, 'Ramin', 'jor', '2020-06-03', 'm', 'ram@gmail.com', '5148826010', '2020-06-13 03:28:49', '2020-06-13 03:28:49'),
(40, 'sima', 'aliaa', '2020-07-10', '', 'nsn.mohamadi@gmail.com', '5149771659', '2020-06-17 18:54:13', '2020-06-17 18:54:13'),
(41, 'sahar', 'bahrami', '2020-06-23', '', 'nsn.mohamadi@gmail.com', '5149771659', '2020-06-18 18:05:54', '2020-06-17 18:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(6) NOT NULL,
  `id_student` int(6) DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `imageUrl` varchar(255) NOT NULL,
  `token` varchar(32) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `imageUrl`, `token`, `update_at`, `create_at`) VALUES
(1, 'nasrin', 'mohamadi', 'nasrin@yahoo.com', 'db657c505faf836ddbded4ed4b788b58', 'uploads/woman-pic12.jpg', '', '2020-07-22 18:25:01', '2020-06-22 20:09:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id_course`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id_student`,`id_course`),
  ADD KEY `id_course` (`id_course`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_student`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_student` (`id_student`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id_course` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id_student` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `student` (`id_student`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`id_course`) REFERENCES `course` (`id_course`);

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `student` (`id_student`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

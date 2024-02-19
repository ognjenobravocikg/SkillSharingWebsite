-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 19, 2024 at 01:06 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekat`
--

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

DROP TABLE IF EXISTS `professors`;
CREATE TABLE IF NOT EXISTS `professors` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `skill` enum('IT','Ekonomija','Inzenjering','Poljoprivreda') NOT NULL,
  `freeTime` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `professor_id` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`id`, `name`, `lastName`, `email`, `password`, `skill`, `freeTime`, `professor_id`) VALUES
(1, 'Dubroje', 'Prezentijevic', 'dubroje@gmail.com', 'dubroje', 'IT', '21:50 - 22:50', 31743043),
(2, 'Mirjana', 'Obradovic', 'mirjanaobradovic@gmail.com', 'pegla', 'Ekonomija', '20:30 - 23:30', 98701),
(3, 'Penii', 'Anii', 'aniianii@gmail.com', 'anii', 'Ekonomija', '01:39 - 12:16', 225331469745);

-- --------------------------------------------------------

--
-- Table structure for table `professor_student`
--

DROP TABLE IF EXISTS `professor_student`;
CREATE TABLE IF NOT EXISTS `professor_student` (
  `professor_id` int NOT NULL,
  `student_id` bigint NOT NULL,
  `request_id` int NOT NULL,
  PRIMARY KEY (`professor_id`,`student_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `professor_student`
--

INSERT INTO `professor_student` (`professor_id`, `student_id`, `request_id`) VALUES
(98701, 7928068246, 1),
(31743043, 7928068246, 2),
(31743043, 826224994511976501, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `skill` enum('IT','Ekonomija','Inzenjering','Poljoprivreda') NOT NULL,
  `interests` enum('IT','Ekonomija','Inzenjering','Poljoprivreda') NOT NULL,
  `education` varchar(100) NOT NULL,
  `user_id` bigint NOT NULL,
  `professorId` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `lastName`, `skill`, `interests`, `education`, `user_id`, `professorId`) VALUES
(10, 'kravoje@gmail.com', 'kravoje', 'Kravoje', 'Dubrovnik', 'IT', 'Ekonomija', 'BSc', 26310469, 0),
(11, 'misamisic@gmail.com', 'misa', 'Misa', 'Misic', 'Ekonomija', 'Inzenjering', 'BSc', 7928068246, 0),
(12, 'aniianii@gmail.com', 'peny', 'Anii', 'Anii', 'Poljoprivreda', 'IT', 'Doktor', 826224994511976501, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

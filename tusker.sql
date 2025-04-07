-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 07, 2025 at 12:06 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tusker`
--

-- --------------------------------------------------------

--
-- Table structure for table `content_calendar`
--

DROP TABLE IF EXISTS `content_calendar`;
CREATE TABLE IF NOT EXISTS `content_calendar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `designer` varchar(255) DEFAULT NULL,
  `month_year` varchar(10) DEFAULT NULL,
  `calendar_file` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `comment` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `project_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `status` enum('active','paused','completed') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `client_name`, `status`, `created_at`, `description`) VALUES
(1, 'Personal', NULL, 'active', '2025-04-07 12:02:25', 'hahifh'),
(2, 'Personal', NULL, 'active', '2025-04-07 12:02:29', 'aaf'),
(3, 'fafa', NULL, 'active', '2025-04-07 12:02:35', 'fasf'),
(4, 'afafa', NULL, 'active', '2025-04-07 12:02:52', 'fafasf');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `assigned_to` varchar(255) DEFAULT NULL,
  `role` enum('designer','developer','marketer') DEFAULT NULL,
  `status` enum('pending','in_progress','review','approved','completed') DEFAULT 'pending',
  `due_date` date DEFAULT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `project_id` int DEFAULT NULL,
  `task_name` varchar(255) NOT NULL,
  `assignee` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `assigned_to`, `role`, `status`, `due_date`, `comment`, `created_at`, `project_id`, `task_name`, `assignee`) VALUES
(1, 'HB Post', 'Design the HB Poster', 'Sathees', 'designer', 'approved', '2025-04-11', '', '2025-04-07 11:34:22', NULL, '', ''),
(5, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, '2025-04-07 12:05:53', 3, 'sgsg', 'gssd'),
(4, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, '2025-04-07 12:05:13', 1, 'Tj Plan', 'Umesh');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 04:32 AM
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
-- Database: `office`
--

-- --------------------------------------------------------

--
-- Table structure for table `time_record`
--

CREATE TABLE `time_record` (
  `id` int(11) NOT NULL,
  `time_in` varchar(40) NOT NULL,
  `break_start` varchar(40) NOT NULL,
  `break_end` varchar(40) NOT NULL,
  `time_out` varchar(40) NOT NULL,
  `totaltime` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_record`
--

INSERT INTO `time_record` (`id`, `time_in`, `break_start`, `break_end`, `time_out`, `totaltime`) VALUES
(1, '2024-10-01 21:12:39', '2024-11-02 18:31:51', '2024-11-01 21:31:03', '2024-11-02 11:58:30', '758hrs 45min'),
(46, '2024-11-02 12:06:38', '', '', '', ''),
(47, '2024-11-02 12:07:31', '', '', '', ''),
(48, '2024-11-02 18:49:17', '', '', '', ''),
(49, '2024-11-02 19:06:17', '', '', '', ''),
(50, '2024-11-02 19:06:58', '', '', '', ''),
(51, '2024-11-02 19:13:02', '', '', '', ''),
(52, '2024-11-02 19:13:16', '', '', '', ''),
(53, '2024-11-02 19:13:38', '', '', '', ''),
(54, '2024-11-02 19:14:00', '', '', '', ''),
(55, '2024-11-02 19:17:32', '', '', '', ''),
(56, '2024-11-02 19:18:17', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `username`, `password`, `fname`, `lname`, `contact`, `created_at`, `updated_at`) VALUES
(1, '', 'y', '$2y$10$/spVdZ0EnOoyj/4HhokOFuKuttj1zpyM/8w1NQp2920cq/F1qxKZW', 'y', 'y', 'y', '2024-10-29 14:05:15', '2024-10-29 14:05:15'),
(2, '', 'q', '$2y$10$heKSwyWEoO3D1xHYWCdFFOUEAIOnGqxo/LNGE6fgqX74OMwe199pe', 'q', 'q', 'q', '2024-10-29 14:07:51', '2024-10-29 14:07:51'),
(4, 'user', 'kclaguna@kpl.com', '$2y$10$5oD9awG9pBGiSAGJLVMCM.6ZXdX37Cm7fw74mwnJF82SIRQuuTVrq', 'KC PHILIP ', 'LAGUNA', '09947393060', '2024-10-31 05:55:04', '2024-10-31 05:55:04'),
(5, 'admin', 'admin', '$2y$10$gnlGxtQtu9386p6sjbWYGezdMBcCZ3VO/VQ5IXtmTSmxnJPAknF.q', 'admin', 'admin', 'admin', '2024-10-31 06:02:14', '2024-10-31 06:02:14'),
(6, 'user', 'user', '$2y$10$d8bxrxYhVddn3rmMIzwbTOY7cvosVUaCnZpnojCQMDITumloJvkW2', 'user', 'user', 'user', '2024-10-31 06:02:49', '2024-10-31 06:02:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `time_record`
--
ALTER TABLE `time_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `time_record`
--
ALTER TABLE `time_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

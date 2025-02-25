-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2025 at 07:29 PM
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
-- Database: `namaz_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `pass`) VALUES
(4, 'Ayesha', 'ayeshauni99@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `prayers_log`
--

CREATE TABLE `prayers_log` (
  `id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `prayer_name` enum('Fajr','Dhuhr','Asr','Maghrib','Isha') NOT NULL,
  `status` enum('completed','missed') NOT NULL,
  `date` date NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prayers_log`
--

INSERT INTO `prayers_log` (`id`, `user_id`, `prayer_name`, `status`, `date`, `updated_at`) VALUES
(6, 2, 'Fajr', 'missed', '2025-02-24', '2025-02-25 01:05:50'),
(7, 2, 'Asr', 'completed', '2025-02-24', '2025-02-25 01:05:52'),
(8, 2, 'Dhuhr', 'completed', '2025-02-24', '2025-02-25 01:05:54'),
(9, 2, 'Maghrib', 'missed', '2025-02-24', '2025-02-25 01:05:57'),
(10, 2, 'Isha', 'completed', '2025-02-24', '2025-02-25 01:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `qaza_prayers`
--

CREATE TABLE `qaza_prayers` (
  `qaza_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `prayer_name` enum('Fajr','Dhuhr','Asr','Maghrib','Isha') NOT NULL,
  `original_date` date NOT NULL,
  `qaza_date` date DEFAULT NULL,
  `status` enum('pending','completed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qaza_prayers`
--

INSERT INTO `qaza_prayers` (`qaza_id`, `user_id`, `prayer_name`, `original_date`, `qaza_date`, `status`) VALUES
(3, 2, 'Fajr', '2025-02-24', NULL, 'pending'),
(4, 2, 'Maghrib', '2025-02-24', '2025-02-24', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_join` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `date_join`) VALUES
(2, 'Ayesha', 'ayeshauni99@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2025-02-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prayers_log`
--
ALTER TABLE `prayers_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qaza_prayers`
--
ALTER TABLE `qaza_prayers`
  ADD PRIMARY KEY (`qaza_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prayers_log`
--
ALTER TABLE `prayers_log`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `qaza_prayers`
--
ALTER TABLE `qaza_prayers`
  MODIFY `qaza_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2023 at 03:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fabric_stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `exports`
--

CREATE TABLE `exports` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `current_address` varchar(255) DEFAULT NULL,
  `export_address` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exports`
--

INSERT INTO `exports` (`id`, `type`, `color`, `price`, `current_address`, `export_address`, `date_created`) VALUES
(1, '1', 'Cotton', 0, 'San Isidro Tomas Oppus', 'San France', '2023-11-13 22:54:43'),
(2, 'Wool', 'Light Green', 230, '', '', '2023-11-21 00:14:24'),
(3, 'Leather', 'Brown', 200, 'TO', 'New addr', '2023-11-21 00:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `fabric`
--

CREATE TABLE `fabric` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `current_stock_address` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fabric`
--

INSERT INTO `fabric` (`id`, `type`, `color`, `price`, `current_stock_address`, `image_name`, `date_inserted`, `date_updated`) VALUES
(44, 'Cotton', 'White', 200, 'TO', 'cotton.jpg', '2023-11-19 22:32:49', NULL),
(45, 'Wool', 'Light Green', 230, 'TO', 'wool.jpg', '2023-11-20 19:34:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `type_of_user` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type_of_user`, `firstname`, `lastname`, `email`, `contact`, `pwd`, `image_name`, `date_inserted`, `date_updated`) VALUES
(1, '1', 'Dorian', 'Patera', 'dorian2@gmail.com', '091231232233', '123', 'Dorian Patera.jpg', '2023-11-10 19:00:37', NULL),
(2, '1', 'Graham', 'Mackro', 'graham@gmail.com', '091231232233', '123', 'Graham Kremski.jpg', '2023-11-10 19:00:37', '2023-11-21 20:28:46'),
(3, '1', 'Pete', 'Serkes', 'pete@gmail.com', '091231232233', '123', 'Pete Serkes.jpg', '2023-11-10 19:00:37', NULL),
(5, '1', 'Seth', 'Lalim', 'seth@gmail.com', '091231232233', '123', 'Seth Lalim.jpg', '2023-11-10 19:00:37', NULL),
(20, '2', 'Angelica', 'Samon', 'ange@gmail.com', '091231231322', '123', 'll.jpeg', '2023-11-18 11:48:29', '2023-11-20 12:39:15'),
(23, '2', 'Daniel', 'Rojas', 'goodan7777777@gmail.com', '09123312984', '123', 'Screenshot_2023-04-05_195714-removebg-preview.png', '2023-11-19 22:35:50', '2023-11-21 10:26:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `activities` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `user_id`, `date_inserted`, `date_updated`, `activities`) VALUES
(1, 1, '2023-11-10 19:09:30', NULL, 'Delete a column in users table'),
(2, 1, '2023-11-10 19:09:30', NULL, 'Updated a column in users table'),
(3, 2, '2023-11-10 19:09:30', NULL, 'Updated a column in users table'),
(4, 3, '2023-11-10 19:09:30', NULL, 'Updated a column in users table'),
(5, 1, '2023-11-10 19:09:30', NULL, 'Updated a column in users table'),
(6, 1, '2023-11-10 19:17:03', NULL, 'Delete a column in users table'),
(7, 1, '2023-11-10 19:17:03', NULL, 'Updated a column in users table'),
(8, 2, '2023-11-10 19:17:03', NULL, 'Updated a column in users table'),
(9, 3, '2023-11-10 19:17:03', NULL, 'Updated a column in users table'),
(10, 1, '2023-11-10 19:17:03', NULL, 'Updated a column in users table'),
(35, 1, '2023-11-13 09:35:27', NULL, 'Deleted a row'),
(37, 1, '2023-11-13 13:08:57', NULL, 'Updated a row'),
(38, 1, '2023-11-13 22:54:43', NULL, 'Updated a row'),
(39, 1, '2023-11-14 15:34:21', NULL, 'Deleted a row'),
(40, 1, '2023-11-14 15:54:25', NULL, 'Added a row'),
(41, 1, '2023-11-14 15:56:57', NULL, 'Added a row'),
(42, 1, '2023-11-14 15:59:46', NULL, 'Deleted a row'),
(43, 1, '2023-11-14 17:31:20', NULL, 'Added a row'),
(44, 1, '2023-11-14 17:31:23', NULL, 'Deleted a row'),
(45, 1, '2023-11-14 17:32:10', NULL, 'Added a row'),
(46, 1, '2023-11-14 19:32:31', NULL, 'Deleted a row'),
(47, 1, '2023-11-14 19:32:55', NULL, 'Added a row'),
(48, 1, '2023-11-14 19:49:28', NULL, 'Deleted a row'),
(49, 1, '2023-11-14 19:49:37', NULL, 'Added a row'),
(50, 1, '2023-11-14 19:50:45', NULL, 'Added a row'),
(51, 1, '2023-11-14 19:50:48', NULL, 'Deleted a row'),
(52, 1, '2023-11-14 19:50:50', NULL, 'Deleted a row'),
(53, 1, '2023-11-14 19:51:11', NULL, 'Added a row'),
(54, 1, '2023-11-14 19:51:55', NULL, 'Added a row'),
(55, 1, '2023-11-14 19:52:17', NULL, 'Deleted a row'),
(56, 1, '2023-11-14 19:52:18', NULL, 'Deleted a row'),
(57, 1, '2023-11-14 19:52:26', NULL, 'Added a row'),
(58, 1, '2023-11-14 19:54:33', NULL, 'Deleted a row'),
(59, 1, '2023-11-14 19:54:41', NULL, 'Added a row'),
(60, 1, '2023-11-15 10:26:48', NULL, 'Deleted a row'),
(61, 1, '2023-11-15 10:28:06', NULL, 'Added a row'),
(62, 1, '2023-11-15 10:33:15', NULL, 'Updated a row'),
(63, 1, '2023-11-15 10:33:32', NULL, 'Added a row'),
(64, 1, '2023-11-15 10:57:43', NULL, 'Deleted a row'),
(65, 1, '2023-11-15 10:57:44', NULL, 'Deleted a row'),
(66, 1, '2023-11-15 10:57:45', NULL, 'Deleted a row'),
(67, 1, '2023-11-15 10:57:47', NULL, 'Deleted a row'),
(83, 1, '2023-11-15 11:13:21', NULL, 'Deleted a row'),
(84, 1, '2023-11-15 11:13:22', NULL, 'Deleted a row'),
(85, 1, '2023-11-15 11:13:23', NULL, 'Deleted a row'),
(86, 1, '2023-11-15 11:13:23', NULL, 'Deleted a row'),
(87, 1, '2023-11-15 11:13:24', NULL, 'Deleted a row'),
(88, 1, '2023-11-15 11:13:24', NULL, 'Deleted a row'),
(89, 1, '2023-11-15 11:13:24', NULL, 'Deleted a row'),
(90, 1, '2023-11-15 11:13:25', NULL, 'Deleted a row'),
(91, 1, '2023-11-15 11:13:25', NULL, 'Deleted a row'),
(92, 1, '2023-11-15 11:13:26', NULL, 'Deleted a row'),
(93, 1, '2023-11-15 11:13:26', NULL, 'Deleted a row'),
(94, 1, '2023-11-15 11:13:26', NULL, 'Deleted a row'),
(95, 1, '2023-11-15 11:13:27', NULL, 'Deleted a row'),
(96, 1, '2023-11-15 11:13:27', NULL, 'Deleted a row'),
(97, 1, '2023-11-15 11:13:27', NULL, 'Deleted a row'),
(98, 1, '2023-11-15 11:13:28', NULL, 'Deleted a row'),
(101, 1, '2023-11-15 11:15:40', NULL, 'Deleted a row'),
(102, 1, '2023-11-15 11:15:41', NULL, 'Deleted a row'),
(103, 1, '2023-11-15 11:15:55', NULL, 'Added a row'),
(104, 1, '2023-11-15 11:19:21', NULL, 'Updated a row'),
(105, 1, '2023-11-15 11:23:01', NULL, 'Updated a row'),
(106, 1, '2023-11-16 12:27:38', NULL, 'Updated a row'),
(107, 1, '2023-11-16 12:27:55', NULL, 'Updated a row'),
(108, 1, '2023-11-16 12:29:39', NULL, 'Updated a row'),
(109, 1, '2023-11-16 12:30:01', NULL, 'Updated a row'),
(110, 1, '2023-11-16 12:30:11', NULL, 'Updated a row'),
(111, 1, '2023-11-16 12:36:08', NULL, 'Updated a row'),
(112, 1, '2023-11-16 13:17:38', NULL, 'Added a row'),
(113, 1, '2023-11-16 13:18:19', NULL, 'Updated a row'),
(114, 1, '2023-11-16 13:20:01', NULL, 'Updated a row'),
(115, 1, '2023-11-16 13:21:19', NULL, 'Updated a row'),
(116, 1, '2023-11-16 13:21:34', NULL, 'Updated a row'),
(117, 1, '2023-11-16 13:21:45', NULL, 'Updated a row'),
(118, 1, '2023-11-16 13:23:54', NULL, 'Added a row'),
(119, 1, '2023-11-16 13:25:35', NULL, 'Updated a row'),
(120, 1, '2023-11-16 13:28:10', NULL, 'Updated a row'),
(121, 1, '2023-11-16 13:32:49', NULL, 'Updated a row'),
(122, 1, '2023-11-16 13:34:03', NULL, 'Updated a row'),
(123, 1, '2023-11-17 12:36:39', NULL, 'Deleted a row'),
(124, 20, '2023-11-19 21:36:10', NULL, 'Added a row'),
(125, 1, '2023-11-19 22:26:55', NULL, 'Deleted a row'),
(126, 1, '2023-11-19 22:27:07', NULL, 'Added a row'),
(127, 2, '2023-11-19 22:32:49', NULL, 'Added a row'),
(128, 2, '2023-11-19 22:35:17', NULL, 'Deleted a row'),
(129, 2, '2023-11-19 22:35:50', NULL, 'Added a row'),
(131, 2, '2023-11-19 22:50:33', NULL, 'Updated a row'),
(132, 20, '2023-11-19 23:02:00', NULL, 'Updated a row'),
(133, 20, '2023-11-19 23:03:04', NULL, 'Updated a row'),
(134, 20, '2023-11-19 23:04:22', NULL, 'Updated a row'),
(135, 20, '2023-11-19 23:13:45', NULL, 'Updated a row'),
(136, 20, '2023-11-19 23:19:06', NULL, 'Updated a row'),
(137, 1, '2023-11-19 23:20:34', NULL, 'Updated a row'),
(138, 20, '2023-11-20 10:02:26', NULL, 'Updated a row'),
(139, 20, '2023-11-20 10:02:46', NULL, 'Updated a row'),
(140, 20, '2023-11-20 10:10:28', NULL, 'Updated a row'),
(141, 20, '2023-11-20 10:12:05', NULL, 'Updated a row'),
(142, 20, '2023-11-20 10:12:19', NULL, 'Updated a row'),
(143, 20, '2023-11-20 10:12:32', NULL, 'Updated a row'),
(144, 20, '2023-11-20 12:11:39', NULL, 'Updated a row'),
(145, 20, '2023-11-20 12:11:53', NULL, 'Updated a row'),
(146, 2, '2023-11-20 12:12:19', NULL, 'Updated a row'),
(147, 20, '2023-11-20 12:26:44', NULL, 'Updated a row'),
(148, 2, '2023-11-20 12:27:35', NULL, 'Updated a row'),
(149, 20, '2023-11-20 12:32:17', NULL, 'Updated a row'),
(150, 20, '2023-11-20 12:34:20', NULL, 'Updated a row'),
(151, 20, '2023-11-20 12:35:18', NULL, 'Updated a row'),
(152, 20, '2023-11-20 12:38:14', NULL, 'Updated a row'),
(153, 20, '2023-11-20 12:39:16', NULL, 'Updated a row'),
(154, 20, '2023-11-20 12:40:01', NULL, 'Updated a row'),
(155, 20, '2023-11-20 13:00:38', NULL, 'Exported a fabric'),
(156, 20, '2023-11-20 13:00:48', NULL, 'Exported a fabric'),
(157, 20, '2023-11-20 13:01:11', NULL, 'Exported a fabric'),
(158, 20, '2023-11-20 13:07:45', NULL, 'Exported a fabric'),
(159, 20, '2023-11-20 13:08:00', NULL, 'Exported a fabric'),
(160, 20, '2023-11-20 19:34:26', NULL, 'Added a row'),
(161, 20, '2023-11-20 19:34:39', NULL, 'Updated a row'),
(162, 20, '2023-11-20 19:37:15', NULL, 'Exported a fabric'),
(163, 20, '2023-11-20 19:37:59', NULL, 'Exported a fabric'),
(164, 20, '2023-11-20 19:38:28', NULL, 'Exported a fabric'),
(165, 20, '2023-11-20 19:40:15', NULL, 'Exported a fabric'),
(166, 20, '2023-11-20 19:40:54', NULL, 'Exported a fabric'),
(167, 20, '2023-11-20 22:30:24', NULL, 'Exported a fabric'),
(168, 20, '2023-11-20 22:33:13', NULL, 'Exported a fabric'),
(169, 20, '2023-11-20 22:34:10', NULL, 'Exported a fabric'),
(172, 20, '2023-11-20 22:42:06', NULL, 'Exported a fabric'),
(173, 2, '2023-11-21 00:40:58', NULL, 'Deleted a row'),
(174, 2, '2023-11-21 00:41:05', NULL, 'Deleted a row'),
(175, 2, '2023-11-21 00:57:37', NULL, 'Updated a row'),
(176, 2, '2023-11-21 01:02:56', NULL, 'Updated a row'),
(177, 2, '2023-11-21 18:44:41', NULL, 'Updated a row'),
(178, 2, '2023-11-21 20:28:46', NULL, 'Updated a row');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exports`
--
ALTER TABLE `exports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fabric`
--
ALTER TABLE `fabric`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exports`
--
ALTER TABLE `exports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fabric`
--
ALTER TABLE `fabric`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `user_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

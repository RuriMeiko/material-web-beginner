-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 06:57 PM
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
-- Database: `member_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatroom`
--

INSERT INTO `chatroom` (`id`, `name`, `created_at`) VALUES
(1, 'hhhh', '2024-05-15 09:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE `friendship` (
  `id` int(11) NOT NULL,
  `user1_id` varchar(255) DEFAULT NULL,
  `user2_id` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friendship`
--

INSERT INTO `friendship` (`id`, `user1_id`, `user2_id`, `status`) VALUES
(3, 'admin', 'user1', 0),
(4, 'admin', 'user1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_member`
--

CREATE TABLE `room_member` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `gender` int(3) NOT NULL,
  `location` varchar(255) NOT NULL,
  `avt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`username`, `name`, `birthday`, `gender`, `location`, `avt`) VALUES
('admin', 'NGUYEN TRAN HOANG LONG', '2024-04-03', 1, '753/Tan Phuoc 1', NULL),
('user1', 'User 1', '1990-01-01', 0, 'Location 1', NULL),
('user10', 'User 10', '1990-10-10', 1, 'Location 10', NULL),
('user2', 'User 2', '1990-02-02', 1, 'Location 2', NULL),
('user3', 'User 3', '1990-03-03', 0, 'Location 3', NULL),
('user4', 'User 4', '1990-04-04', 1, 'Location 4', NULL),
('user5', 'User 5', '1990-05-05', 2, 'Location 5', NULL),
('user6', 'User 6', '1990-06-06', 2, 'Location 6', NULL),
('user7', 'User 7', '1990-07-07', 1, 'Location 7', NULL),
('user8', 'User 8', '1990-08-08', 0, 'Location 8', NULL),
('user9', 'User 9', '1990-09-09', 2, 'Location 9', NULL),
('xa', 'haha', '2014-07-02', 1, 'gần', 'https://p21-ad-sg.ibyteimg.com/obj/ad-site-i18n-sg/202404245d0d17ea1c85fbc14b458efe');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `username` varchar(255) NOT NULL,
  `hashpassword` varchar(255) NOT NULL,
  `role` int(3) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`username`, `hashpassword`, `role`) VALUES
('admin', '$2y$10$uZOcGsRIz1s.986cQrn5CuNgppIwgPEAo2p9Jl7IjxUmZ0/YxPNWm', 0),
('dragonccm', '$2y$10$CLqlqDpvG1zuL4VaHqwVjOniOqxznuhCQLaLst1mr4ysNt7/HBY2K', 0),
('user1', '$2y$10$8qVtUNyLwWZBKne/YpN/V.f8edFl9owddSxRNHW5jxE6ADr3rGo0a', 1),
('user10', '$2y$10$koP3EdSwvTtMAnA6LJ0nR.nERsD1/5doLQsHuC5Sz3gwL69kcDAua', 0),
('user2', '$2y$10$4oqRlZq1eIJwBVy4.XksWubw0noNzCy7V50BbeoC9Y693hvcJZP9G', 0),
('user3', '$2y$10$J/WQf3LDBEMl7y/rOAsCFu9i2tCqyc7XAL2GQEwCdt8E2Wx1GQ4dK', 0),
('user4', '$2y$10$U8z0bLi/I/C8oST2g1sWte7LLmGQP2fZKcMcuisWTwl5r.VL0ia7e', 0),
('user5', '$2y$10$YhKKiV2P7HTATDw8PwSXQe2o10rCPXcCJ1Fqf6ph6VmASgANnvL/q', 1),
('user6', '$2y$10$70HTiRH6YMQTg5m2p8UzFersnLhLvyB81R3a.ACHHJ3A1GU7bUiHC', 1),
('user7', '$2y$10$1fObQPWL2N8zAzEebwqFouFm6.Ts5WoSCBphSQ2moRJT6fFoV8R8q', 0),
('user8', '$2y$10$jp2kNX5rKbO3jjVtaOp0xODwlj6rFz8.EqwpzYXgMn/v3KdJdc4tK', 0),
('user9', '$2y$10$dRuJyBRuW4rKrPjvUfiH1uBb7UBsEbSaJpy8tswBN7xUxIR7R2eUS', 1),
('xa', '$2y$10$IBhStNo/mv9EBjZ1gNN9M.NQuYll238zACLbYVwbwjDIpD.B1xmMS', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friendship`
--
ALTER TABLE `friendship`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user1_id` (`user1_id`),
  ADD KEY `user2_id` (`user2_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_userIfoChat` (`sender`),
  ADD KEY `FK_userIfoChat2` (`receiver`);

--
-- Indexes for table `room_member`
--
ALTER TABLE `room_member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatroom`
--
ALTER TABLE `chatroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `friendship`
--
ALTER TABLE `friendship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_member`
--
ALTER TABLE `room_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friendship`
--
ALTER TABLE `friendship`
  ADD CONSTRAINT `friendship_ibfk_1` FOREIGN KEY (`user1_id`) REFERENCES `user_info` (`username`),
  ADD CONSTRAINT `friendship_ibfk_2` FOREIGN KEY (`user2_id`) REFERENCES `user_info` (`username`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_userIfoChat` FOREIGN KEY (`sender`) REFERENCES `user_info` (`username`),
  ADD CONSTRAINT `FK_userIfoChat2` FOREIGN KEY (`receiver`) REFERENCES `user_info` (`username`);

--
-- Constraints for table `room_member`
--
ALTER TABLE `room_member`
  ADD CONSTRAINT `room_member_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `chatroom` (`id`),
  ADD CONSTRAINT `room_member_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_login` (`username`);

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user_login` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 02:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `state` int(11) NOT NULL,
  `avt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatroom`
--

INSERT INTO `chatroom` (`id`, `name`, `created_at`, `state`, `avt`) VALUES
(1, 'hhhh', '2024-05-15 09:13:59', 1, ''),
(2, 'tao đây', '2024-05-16 14:24:55', 1, ''),
(3, 'Phòng Chat 1', '2024-05-30 06:42:03', 1, ''),
(4, 'Phòng Chat 2', '2024-05-30 06:42:03', 0, ''),
(5, 'Phòng Chat 3', '2024-05-30 06:42:03', 0, ''),
(6, 'Phòng Chat 4', '2024-05-30 06:42:03', 0, ''),
(7, 'Phòng Chat 5', '2024-05-30 06:42:03', 0, ''),
(8, 'Phòng Chat 6', '2024-05-30 06:42:03', 0, ''),
(9, 'Phòng Chat 7', '2024-05-30 06:42:03', 0, ''),
(10, 'Phòng Chat 8', '2024-05-30 06:42:03', 0, ''),
(11, 'Phòng Chat 9', '2024-05-30 06:42:03', 0, ''),
(12, 'Phòng Chat 10', '2024-05-30 06:42:03', 0, ''),
(13, 'aaa', '2024-05-30 23:58:08', 0, '');

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
(4, 'admin', 'user1', 0),
(5, 'admin', 'user1', 0),
(6, 'admin', 'user1', 0),
(7, 'admin', 'user1', 0),
(8, 'admin', 'user1', 0),
(9, 'admin', 'user1', 0),
(10, 'admin', 'user1', 0),
(11, 'admin', 'user1', 0),
(12, 'admin', 'user1', 0),
(13, 'admin', 'user1', 0),
(14, 'admin', 'user1', 0),
(15, 'admin', 'user1', 0),
(16, 'admin', 'user1', 0),
(17, 'admin', 'user1', 0),
(18, 'admin', 'user1', 0),
(19, 'admin', 'user1', 0),
(20, 'admin', 'user1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `id_mess` varchar(255) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `room_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `id_mess`, `sender`, `receiver`, `content`, `room_id`, `timestamp`) VALUES
(342, '', 'admin', 'user2', '432', 2, '2024-05-16 14:25:23'),
(2121, '', 'admin', 'user1', 'haha e iu', 1, '2024-05-16 13:49:07'),
(3127, '', 'admin', 'user2', 'huhu', 2, '2024-05-16 14:25:46'),
(3221, '', 'user1', 'admin', 'gádasdasdas', 1, '2024-05-16 13:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `room_member`
--

CREATE TABLE `room_member` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_member`
--

INSERT INTO `room_member` (`id`, `room_id`, `user_id`) VALUES
(1, 1, 'admin'),
(2, 1, 'user1'),
(3, 2, 'admin'),
(4, 3, 'admin'),
(5, 4, 'admin'),
(6, 5, 'admin'),
(7, 5, 'user1'),
(8, 6, 'admin'),
(9, 7, 'admin'),
(10, 8, 'admin'),
(11, 8, 'user1'),
(12, 9, 'admin'),
(13, 10, 'admin'),
(14, 10, 'user1'),
(341, 1, 'user1'),
(2131, 1, 'admin'),
(4532, 2, 'admin'),
(21324, 13, 'admin'),
(21325, 13, 'hn');

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
('admin', 'CHÚ CHÓ CÔ ĐỐC ', '2024-04-03', 1, '753/Tan Phuoc 1', NULL),
('hn', 'Nguyễn Thị Hồng Nguyên', '2024-05-02', 2, 'xa', NULL),
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
  `role` int(3) DEFAULT 1,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`username`, `hashpassword`, `role`, `state`) VALUES
('admin', '$2y$10$uZOcGsRIz1s.986cQrn5CuNgppIwgPEAo2p9Jl7IjxUmZ0/YxPNWm', 0, 0),
('dragonccm', '$2y$10$CLqlqDpvG1zuL4VaHqwVjOniOqxznuhCQLaLst1mr4ysNt7/HBY2K', 0, 0),
('hn', '$2y$10$3F4YEu3MRKU8D4K.yEvaIOC6rhjeYbkeyoHB8QEWoL4chMhSGlzQi', 1, 0),
('user1', '$2y$10$8qVtUNyLwWZBKne/YpN/V.f8edFl9owddSxRNHW5jxE6ADr3rGo0a', 1, 0),
('user10', '$2y$10$koP3EdSwvTtMAnA6LJ0nR.nERsD1/5doLQsHuC5Sz3gwL69kcDAua', 0, 0),
('user2', '$2y$10$4oqRlZq1eIJwBVy4.XksWubw0noNzCy7V50BbeoC9Y693hvcJZP9G', 0, 0),
('user3', '$2y$10$J/WQf3LDBEMl7y/rOAsCFu9i2tCqyc7XAL2GQEwCdt8E2Wx1GQ4dK', 0, 1),
('user4', '$2y$10$U8z0bLi/I/C8oST2g1sWte7LLmGQP2fZKcMcuisWTwl5r.VL0ia7e', 0, 1),
('user5', '$2y$10$YhKKiV2P7HTATDw8PwSXQe2o10rCPXcCJ1Fqf6ph6VmASgANnvL/q', 1, 1),
('user6', '$2y$10$70HTiRH6YMQTg5m2p8UzFersnLhLvyB81R3a.ACHHJ3A1GU7bUiHC', 1, 0),
('user7', '$2y$10$1fObQPWL2N8zAzEebwqFouFm6.Ts5WoSCBphSQ2moRJT6fFoV8R8q', 0, 0),
('user8', '$2y$10$jp2kNX5rKbO3jjVtaOp0xODwlj6rFz8.EqwpzYXgMn/v3KdJdc4tK', 0, 0),
('user9', '$2y$10$dRuJyBRuW4rKrPjvUfiH1uBb7UBsEbSaJpy8tswBN7xUxIR7R2eUS', 1, 0),
('xa', '$2y$10$IBhStNo/mv9EBjZ1gNN9M.NQuYll238zACLbYVwbwjDIpD.B1xmMS', 1, 0);

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
  ADD KEY `FK_userIfoChat2` (`receiver`),
  ADD KEY `room_ibfk_9` (`room_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `friendship`
--
ALTER TABLE `friendship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3222;

--
-- AUTO_INCREMENT for table `room_member`
--
ALTER TABLE `room_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21326;

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
  ADD CONSTRAINT `FK_userIfoChat2` FOREIGN KEY (`receiver`) REFERENCES `user_info` (`username`),
  ADD CONSTRAINT `room_ibfk_9` FOREIGN KEY (`room_id`) REFERENCES `chatroom` (`id`);

--
-- Constraints for table `room_member`
--
ALTER TABLE `room_member`
  ADD CONSTRAINT `room_member_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`username`),
  ADD CONSTRAINT `room_member_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `chatroom` (`id`);

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user_login` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

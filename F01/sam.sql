-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2025 at 03:19 AM
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
-- Database: `sam`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `content` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `image`, `content`) VALUES
(5, 'img/content_img_2.png', 'The streets came alive as thousands of supporters joined the Victory Parade to honor our athletes’ remarkable achievements. With pride and joy radiating through the crowd, this event was more than a celebration—it was a heartfelt display of the Filipino spirit. From the waving of flags to the cheering of fans, the day showcased how sports can unite a nation. Each athlete shared their gratitude for the overwhelming support, promising to continue striving for excellence and inspiring the next gene'),
(6, 'img/content_img_3.png', 'Our athletes took center stage on the international platform, making history with their incredible performances. Bringing home multiple gold medals, they demonstrated resilience, dedication, and the unwavering Filipino fighting spirit. As confetti rained down during the awarding ceremony, it was a reminder of the countless hours of hard work and sacrifices that made this moment possible. Their victories inspire hope and ambition, motivating others to chase their dreams and contribute to the Phil'),
(8, 'img/content_img_1.png', 'We are proud to celebrate the dedication, resilience, and world-class talent of our Filipino Olympians! These exceptional athletes have brought honor to the Philippines, representing the country with unmatched spirit and determination on the global stage. Join us at the Filipino Olympians Parade on January 15, 2025 at Quirino Grand Stand as we honor their hard work and incredible achievements. Let’s come together as one nation to cheer for our champions and show them the support they truly deser'),
(28, 'img/apple.jpg', '123');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `id` int(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`id`, `image`, `content`) VALUES
(2, 'img/trImg2.png', 'Train with Aira on January 22, 2025\r\nin Training Hall B Iloilo Sports Arena, Iloilo City. '),
(3, 'img/trImg3.png', 'Train with EJ on January 25, 2025 in Conference Room 3 Cebu City Sports Center, Cebu City.\r\n'),
(4, 'img/trImg4.png', 'Train with Hidilyn on January 27, 2025\r\nin Multi-Purpose Hall Davao City Recreation Center, Davao City.\r\n'),
(5, 'img/trImg5.png', 'Train with Nesthy on January 30, 2025 in  Indoor Training Court Rizal Memorial Sports Complex, Manila.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` int(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `number`, `password`, `role`) VALUES
(2, 'Ryan paul', 'palomo', 'ryanpalomo@gmail.com', 2147483647, '$2y$10$OIXMhCoX1vlfYUs5hO6gYe6nuGAKhwnc.Y/rjd75b0aNrtuIutcru', 'user'),
(3, 'ryan', 'pogi', 'r@gmail.com', 2147483647, '$2y$10$Ds5f.O9PQxI6ZGLR9eXkdekEOascpV93KTNeXq6GXDG7uEeE8DiYm', 'user'),
(6, 'admin', 'admin', 'admin@gmail.com', 12312312, '$2y$10$nPv/.5RMvGf3AWVFcRt2Je4E1KF8JZ7JNKE/tSCePm3OnrsK69YD6', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

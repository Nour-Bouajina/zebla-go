-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 07:24 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_events`
--

CREATE TABLE `enrolled_events` (
  `enroll_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `enroll_date` date NOT NULL DEFAULT current_timestamp(),
  `points` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrolled_events`
--

INSERT INTO `enrolled_events` (`enroll_id`, `user_id`, `event_id`, `enroll_date`, `points`) VALUES
(11, 2, 12, '2023-04-28', 0),
(12, 2, 13, '2023-05-01', 0),
(13, 2, 1, '2023-05-01', 0),
(14, 2, 2, '2023-05-02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `region_name` varchar(100) NOT NULL,
  `longi` float NOT NULL,
  `lat` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `name`, `description`, `creation_date`, `start_date`, `end_date`, `user_id`, `location`, `region_name`, `longi`, `lat`) VALUES
(1, 'Test_Event_Active', 'This events is really need to be in acrive', '2023-04-12 18:13:20', '2026-12-01 19:10:49', '2032-04-30 19:10:49', 2, 'bardo', 'Nabeul', 0, 0),
(2, 'past_event_test', 'THIS EVENT IS POGGERS', '2023-04-12 19:36:43', '2023-04-12 21:36:06', '2023-04-11 21:36:06', 2, 'manzah', 'Tunis', 0, 0),
(12, 'created_event', 'THIS EVENT IS POGGERS', '2023-04-22 18:41:21', '2023-04-12 21:36:06', '2027-12-07 21:36:06', 4, 'manzah', 'Tunis', 0, 0),
(13, 'created_event2', 'THIS EVENT IS POGGERS', '2023-04-30 23:11:29', '2023-04-12 21:36:06', '2027-12-07 21:36:06', 2, 'manzah', 'Tunis', 10, 36),
(14, 'Test_Event_Active1', 'This events is really need to be in acrive', '2023-04-30 23:12:22', '2026-12-01 19:10:49', '2032-04-30 19:10:49', 2, 'bardo', 'Nabeul', 10, 36),
(15, 'past_event_test1', 'THIS EVENT IS POGGERS', '2023-04-30 23:13:59', '2023-04-12 21:36:06', '2023-04-11 21:36:06', 2, 'manzah', 'Tunis', 10.2003, 36.8431),
(16, 'Test_Event_Active15', 'This events is really need to be in acrive', '2023-04-30 23:35:32', '2026-12-01 19:10:49', '2032-04-30 19:10:49', 2, 'bardo', 'Nabeul', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pic_links`
--

CREATE TABLE `pic_links` (
  `pic_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pic_links`
--

INSERT INTO `pic_links` (`pic_id`, `event_id`, `link`) VALUES
(1, 1, 'https://upload.wikimedia.org/wikipedia/en/5/51/Overwatch_cover_art.jpg'),
(2, 2, 'https://aniyuki.com/wp-content/uploads/2022/03/aniyuki-cute-anime-avatar-profile-picture-41.jpg'),
(3, 2, 'https://upload.wikimedia.org/wikipedia/en/5/51/Overwatch_cover_art.jpg'),
(9, 12, './event_pics/created_event.jpg'),
(10, 13, ''),
(11, 14, './event_pics/Test_Event_Active1.jpg'),
(12, 15, './event_pics/past_event_test1.jpg'),
(13, 16, './event_pics/Test_Event_Active15.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `pic_link` varchar(20) NOT NULL,
  `bio` varchar(250) DEFAULT '',
  `lastname` varchar(100) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `password`, `date`, `pic_link`, `bio`, `lastname`, `points`) VALUES
(1, 'a', 'a@a.a', '$2y$10$hXYjKShuM1.RJB0JlOvZ4OIe/QH4pnRf98z9L0tGX6csycanfa3j2', '2023-05-01 20:15:45.473907', '', '', '', 1),
(2, 'louay', 'louaybensir01@gmail.com', '$2y$10$IjSnPl0IKRD/aVpI7fjdd.ugUlPFZTRU9rg66vf4ocjJ8aglNfFCG', '2023-05-01 20:15:41.967264', '', 'i am soooooooo good @php', 'ben nessir', 5),
(4, 'test', 'test@test.test', '$2y$10$jW5ZGWcxPg2VOYF22c9ZLeTqYrSzyTzXmXvb2NKIkg9Nk7TraIR5K', '2023-05-01 20:15:47.737417', './profile_pics/4.jpg', '', 'test', 3),
(5, 'louay', 'aa@aa.aa', '$2y$10$NzsdPfz1BkZL.uh4Am0ideg8BEQqJAZMnrWrJSoHf6n/wTEkc/Pvu', '2023-05-01 20:15:49.755315', '', '', 'bensir', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enrolled_events`
--
ALTER TABLE `enrolled_events`
  ADD PRIMARY KEY (`enroll_id`),
  ADD KEY `event_fk` (`event_id`),
  ADD KEY `user_fk` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `pic_links`
--
ALTER TABLE `pic_links`
  ADD PRIMARY KEY (`pic_id`),
  ADD KEY `event_id_FK` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `date` (`date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enrolled_events`
--
ALTER TABLE `enrolled_events`
  MODIFY `enroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pic_links`
--
ALTER TABLE `pic_links`
  MODIFY `pic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pic_links`
--
ALTER TABLE `pic_links`
  ADD CONSTRAINT `event_id_FK` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

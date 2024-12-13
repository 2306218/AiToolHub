-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 01:30 PM
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
-- Database: `aitools`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `published` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `published`) VALUES
(1, 'Music', '2024-12-08 02:10:28'),
(2, 'Sports', '2024-12-08 02:10:28'),
(3, 'Technology', '2024-12-08 02:11:48'),
(4, 'Art', '2024-12-08 02:11:48'),
(5, 'Science', '2024-12-08 02:11:48'),
(6, 'Travel', '2024-12-08 02:11:48'),
(7, 'Cooking', '2024-12-08 02:11:48'),
(8, 'Literature', '2024-12-08 02:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `published` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `published`) VALUES
(1, 'Umar Farooq Ghori', 'johndoe@gmail.com', 'Hi\r\nHow are you?\r\nThanks', '2024-12-08 00:46:27'),
(2, 'Umar Farooq Ghori', 'johndoe@gmail.com', 'Hi\r\nHow are you?\r\nThanks', '2024-12-08 00:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE `interest` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `interestId` int(11) NOT NULL,
  `published` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interest`
--

INSERT INTO `interest` (`id`, `userId`, `interestId`, `published`) VALUES
(5, 1, 1, '2024-12-08 23:43:53'),
(6, 1, 3, '2024-12-08 23:43:53'),
(7, 1, 5, '2024-12-08 23:43:53'),
(8, 1, 7, '2024-12-08 23:43:53'),
(9, 2, 1, '2024-12-11 00:40:28'),
(10, 2, 3, '2024-12-11 00:40:29'),
(11, 2, 5, '2024-12-11 00:40:29'),
(12, 2, 7, '2024-12-11 00:40:29'),
(16, 3, 1, '2024-12-11 19:51:43'),
(17, 3, 3, '2024-12-11 19:51:43'),
(18, 3, 6, '2024-12-11 19:51:43'),
(19, 3, 7, '2024-12-11 19:51:43');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `published` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `username`, `fullName`, `email`, `password`, `profile_image`, `published`) VALUES
(1, 'JohnDoe', 'John Doe', 'johndoe@gmail.com', '$2y$10$ptxvBUiIYqNB3oGc1QEWEuRpPGdaAfkyXnnC/mEbGqtlD1Dma/xF2', 'assets/images/67559566baa4d_Ellipse 7.png', '2024-12-08 00:06:54'),
(2, 'test1', '', 'test1@gmail.com', '$2y$10$8idTbWjlujIJfVQo08NZnuX8Z93hKBWpFEnVG8Bp.IFVo7znhj3AG', '', '2024-12-11 00:39:38'),
(3, 'test', 'John Doe', 'test@gmail.com', '$2y$10$9CrRu.rbujtGxLazSsiH6.miKiE0B8s/dQ4N1fwLFGKDzvIzCAsti', 'assets/images/67589f39f259a_VAPORGRAM_IMG_1729252595517.jpg', '2024-12-11 00:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `toolName` varchar(255) NOT NULL,
  `toolURL` varchar(255) NOT NULL,
  `toolImage` varchar(255) NOT NULL,
  `toolCategory` bigint(20) NOT NULL,
  `toolDescription` varchar(255) NOT NULL,
  `published` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`id`, `userId`, `toolName`, `toolURL`, `toolImage`, `toolCategory`, `toolDescription`, `published`) VALUES
(1, 1, 'Chat GPT', 'https://chatgpt.com/', 'assets/images/6755a034a4f9d_chatgpt.png', 3, 'Advanced code completion and generation tool.', '2024-12-08 18:33:40'),
(4, 1, 'DishGen', 'https://www.dishgen.com/', 'assets/images/6755e6ea84aa8_dishgen.png', 7, 'DishGen is the revolutionary AI recipe generator.', '2024-12-08 23:35:22'),
(5, 3, 'Gemini', 'https://gemini.google.com/app', 'assets/images/6759a02962d2b_gemini.png', 3, 'Gemini is a generative artificial intelligence chatbot developed by Google. ', '2024-12-11 19:22:33'),
(6, 3, 'Blackbox', 'https://www.blackbox.ai/', 'assets/images/6759a0e5b1449_images.png', 3, 'BLACKBOX AI is the Best AI Model for Code. Millions of developers use Blackbox Code Chat to answer coding questions', '2024-12-11 19:25:41'),
(7, 3, 'GitHub Copilot', 'https://github.com/features/copilot', 'assets/images/6759a1c604705_images (1).png', 3, 'GitHub Copilot is a code completion and automatic programming tool developed by GitHub.', '2024-12-11 19:29:26'),
(8, 3, 'CodeWP', 'https://codewp.ai/', 'assets/images/6759a2e1a53e9_images (2).png', 3, 'It a fantastic tool for generating WordPress code snippets.', '2024-12-11 19:34:09'),
(9, 3, 'Midjourney', 'https://www.midjourney.com/', 'assets/images/6759a3c28cfa6_1704255099294.png', 3, 'An independent research lab exploring new mediums of thought and expanding the imaginative powers of the human species.', '2024-12-11 19:37:54'),
(10, 3, 'H2O.ai', 'https://h2o.ai/', 'assets/images/6759a5a3eacbe_images (3).png', 3, 'H2O.ai is a machine learning platform that helps companies approach business challenges', '2024-12-11 19:45:55'),
(11, 3, 'Microsoft Copilot', 'https://copilot.microsoft.com/', 'assets/images/6759a620354cb_codepilot.jpeg', 3, 'Microsoft Copilot is your companion to inform, entertain, and inspire. Get advice, feedback, and answers.', '2024-12-11 19:48:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interest`
--
ALTER TABLE `interest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `interest`
--
ALTER TABLE `interest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

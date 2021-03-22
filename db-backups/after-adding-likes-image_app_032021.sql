-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2021 at 04:27 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `image_app_032021`
--
CREATE DATABASE IF NOT EXISTS `image_app_032021` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `image_app_032021`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` mediumint(9) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Portraits'),
(2, 'Landscapes'),
(3, 'Pet Photos'),
(4, 'Macro Photos');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `body` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  `post_id` mediumint(9) NOT NULL,
  `is_approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `body`, `date`, `post_id`, `is_approved`) VALUES
(1, 1, 'user number 1\'s comment on post number 2!', '2021-03-03 11:04:52', 2, 1),
(2, 2, 'this is user 2 posting on post 1', '2021-03-02 11:05:22', 1, 1),
(3, 1, 'trapper keepers forever!', '2021-03-19 09:45:24', 23, 1),
(4, 13, 'not melissa', '2021-03-19 09:51:13', 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `like_id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `post_id` mediumint(9) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `user_id`, `post_id`, `date`) VALUES
(1, 1, 17, '2021-03-22 08:23:08'),
(2, 1, 18, '2021-03-22 08:26:11'),
(3, 1, 22, '2021-03-22 08:26:11'),
(4, 1, 20, '2021-03-22 08:26:11'),
(5, 2, 18, '2021-03-22 08:26:11'),
(6, 2, 21, '2021-03-22 08:26:11'),
(7, 3, 17, '2021-03-22 08:26:11'),
(8, 3, 18, '2021-03-22 08:26:11'),
(9, 3, 23, '2021-03-22 08:26:11'),
(10, 4, 17, '2021-03-22 08:26:11');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `post_id` mediumint(9) NOT NULL,
  `image` varchar(200) NOT NULL,
  `title` varchar(50) NOT NULL,
  `category_id` mediumint(9) NOT NULL,
  `body` varchar(2000) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `allow_comments` tinyint(1) NOT NULL,
  `is_published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `image`, `title`, `category_id`, `body`, `date`, `user_id`, `allow_comments`, `is_published`) VALUES
(17, '20d307767a05c47207c86ef7cd6ca70b2d8ac3d3', 'finishing up this post', 2, 'yay, it seems to work', '2021-03-16 09:25:20', 1, 1, 1),
(18, '317ec134916b6df181f5f6d4ff939477cfa6dc04', 'new title', 3, 'this should be filled in!!!', '2021-03-16 09:57:54', 1, 0, 1),
(19, 'b55fb87b532afc441793430379821de7e44cf50d', '', 0, '', '2021-03-16 09:58:45', 1, 0, 0),
(20, '4b3370b5c34f96123d7493ab7efca3186bcc4c5c', '', 0, '', '2021-03-17 08:18:44', 1, 0, 0),
(21, '1ed28b9cacb3b3a7d0b9c01dca4aa16b83381a59', 'some kind of fern', 4, 'sample image. this is the description', '2021-03-19 09:09:38', 1, 1, 1),
(22, '7441365fee7b40a61d604d17189ca1e84609ec4b', 'petrified crystals', 4, 'I thought it was ribs at first', '2021-03-19 09:10:33', 1, 1, 1),
(23, '5d9f9addb63aedd6b1fdc9db0cc6b7d2ca8989c8', 'Unicorn', 4, 'I had a trapper keeper with this image on it once!!!', '2021-03-19 09:11:22', 1, 1, 1),
(24, '0c99bb66cad31009d66275bc0bc006c42fe007b5', 'my post', 2, 'I edited!', '2021-03-19 09:56:03', 13, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `tag_id` mediumint(9) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `name`) VALUES
(1, 'tag1'),
(2, 'tag2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` mediumint(9) NOT NULL,
  `username` varchar(30) NOT NULL,
  `profile_pic` varchar(200) DEFAULT NULL,
  `bio` varchar(1000) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(256) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `join_date` datetime NOT NULL DEFAULT current_timestamp(),
  `access_token` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `profile_pic`, `bio`, `email`, `password`, `is_admin`, `join_date`, `access_token`) VALUES
(1, 'Melissa', 'https://randomuser.me/api/portraits/lego/9.jpg', 'I like snacks', 'melissa@mail.com', '$2y$10$TRl.O8PW10kVKzSnswn5.O/UBdS9uo/Gq2YimcLs.CjNcE1foo4bu', 1, '2021-03-10 10:49:47', 'f67e513e71be4d6273a3b88b7e23b5253c2df6806a84da07427f9dffccff'),
(2, 'Pearl Mitchelle', 'https://randomuser.me/api/portraits/women/19.jpg', 'This is a sample user account for testing', 'fakeemail@mail.com', '$2y$10$YH0IFPsvzPXt24wRIhKLsubsacDHZVCOvu43D2kbykOo9ZmeVQo1.', 0, '2021-03-10 10:49:47', ''),
(3, 'Dennis Elliott', 'https://randomuser.me/api/portraits/men/54.jpg', 'This is another sample user account for testing', 'deniniselliott@mail.com', '$2y$10$Mjbq8Fz.ObuxXMtXCMlKCOGj8a8QASsYH/b8dXIBsH4W0Q/KYEy5G', 0, '2021-03-11 07:37:39', ''),
(4, 'Edna Steward', 'https://randomuser.me/api/portraits/women/2.jpg', 'This is another sample user account for testing', 'EdnaS@mail.com', '$2y$10$JD7JNCkI.VzGpF8XCqjKrujsTYmCdGhl1Z5Vu6qWKX2x3iLd6fV1K', 0, '2021-03-11 07:38:39', ''),
(12, 'testing10', NULL, NULL, 'test10@mail.com', '$2y$10$6U3YV2EtlxGC596aYzI0nuRBnJjYnH1zngoP9HCykcHfwiyEPZOb.', 0, '2021-03-12 09:41:57', '39e62e4e34babaf0e498b367991058961a2a1a0e9a0370efe17beb77ff4c'),
(13, 'test 11', NULL, NULL, 'test11@mail.com', '$2y$10$vE3ny6QCc1sMhCKflVYHre1UldTqFb5GXl6Y75ujXeErYv68XI/bC', 0, '2021-03-12 09:46:48', '51f86e3f244c16594f9173eee9e71c376958f003e03fde2e055b1d51878f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

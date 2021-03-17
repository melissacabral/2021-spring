-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2021 at 05:58 PM
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
(2, 2, 'this is user 2 posting on post 1', '2021-03-02 11:05:22', 1, 1);

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
(1, 'https://picsum.photos/id/1003/400/400', 'A deer', 3, 'this is a sample post for testing\r\n\r\nline break test\r\n\r\nanother break', '2021-03-03 11:00:15', 1, 1, 1),
(2, 'https://picsum.photos/id/1062/400/400', 'Blanket Pug', 1, 'It\'s a pug in a blanket. It\'s in category 1 and written by user 2. comments are off. I posted it on Monday March 1', '2021-03-01 11:01:15', 2, 0, 1),
(3, 'https://picsum.photos/id/1011/400/400', 'Canoe', 2, 'It\'s a person in a canoe', '2021-03-01 11:01:15', 2, 1, 1),
(4, 'https://picsum.photos/id/1016/400/400', 'Canyon at Sunset', 2, 'Look at this view!', '2021-03-01 11:01:15', 1, 1, 1),
(5, 'https://picsum.photos/id/102/400/400', 'Raspberries on a fence', 4, 'Weird place to keep your raspberries', '2021-03-11 07:31:00', 1, 1, 1),
(6, 'https://picsum.photos/id/1025/400/400', 'Blanket Pug Part 2', 2, 'Another little burrito pug', '2021-03-11 07:34:27', 2, 1, 1),
(7, 'https://picsum.photos/id/1023/400/400', 'Mountain Bike', 1, 'Going out to get some air', '2021-03-11 07:35:25', 2, 1, 1),
(8, 'https://picsum.photos/id/1022/400/400', 'Aurora Borealis', 1, 'The northern lights', '2021-03-11 07:35:56', 1, 0, 1),
(9, 'https://picsum.photos/id/1024/400/400', 'Vulture', 3, 'Pretty sure that\'s a vulture', '2021-03-11 07:43:37', 3, 1, 1),
(10, 'https://picsum.photos/id/104/400/400', 'Dream Catcher', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent risus nunc, mattis in metus quis, luctus accumsan justo. Aenean eget lacus mauris. Integer iaculis mattis ullamcorper. Nam at tristique magna, at faucibus ex. Donec ut porta turpis, sed laoreet magna. Fusce non quam vel magna cursus facilisis nec vehicula nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent eros elit, ornare ac dui porta, lobortis auctor ipsum. Proin ac metus dapibus, semper dolor ac, dictum sem. Proin pharetra convallis tempor. Morbi ante diam, vestibulum ut tellus ac, suscipit bibendum quam. Nulla vitae quam tellus. Aliquam id volutpat quam, non accumsan elit. Proin laoreet, mi id pretium varius, leo mi cursus augue, nec rhoncus est nisl vel odio.\r\n\r\n', '2021-03-11 07:43:37', 4, 0, 1),
(11, 'https://picsum.photos/id/1042/400/400', 'Long exposure at night', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent risus nunc, mattis in metus quis, luctus accumsan justo. Aenean eget lacus mauris. Integer iaculis mattis ullamcorper. Nam at tristique magna, at faucibus ex. Donec ut porta turpis, sed laoreet magna. Fusce non quam vel magna cursus facilisis nec vehicula nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent eros elit, ornare ac dui porta, lobortis auctor ipsum. Proin ac metus dapibus, semper dolor ac, dictum sem. Proin pharetra convallis tempor. Morbi ante diam, vestibulum ut tellus ac, suscipit bibendum quam. Nulla vitae quam tellus. Aliquam id volutpat quam, non accumsan elit. Proin laoreet, mi id pretium varius, leo mi cursus augue, nec rhoncus est nisl vel odio.\r\n', '2021-03-11 07:43:37', 2, 1, 1),
(12, 'https://picsum.photos/id/1053/400/400', 'Waves Crashing', 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent risus nunc, mattis in metus quis, luctus accumsan justo. Aenean eget lacus mauris. Integer iaculis mattis ullamcorper. Nam at tristique magna, at faucibus ex. Donec ut porta turpis, sed laoreet magna. Fusce non quam vel magna cursus facilisis nec vehicula nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent eros elit, ornare ac dui porta, lobortis auctor ipsum. Proin ac metus dapibus, semper dolor ac, dictum sem. Proin pharetra convallis tempor. Morbi ante diam, vestibulum ut tellus ac, suscipit bibendum quam. Nulla vitae quam tellus. Aliquam id volutpat quam, non accumsan elit. Proin laoreet, mi id pretium varius, leo mi cursus augue, nec rhoncus est nisl vel odio.\r\n\r\n', '2021-03-11 07:43:37', 3, 1, 1),
(13, 'https://picsum.photos/id/1040/400/400', 'Castle', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent risus nunc, mattis in metus quis, luctus accumsan justo. Aenean eget lacus mauris. Integer iaculis mattis ullamcorper. Nam at tristique magna, at faucibus ex. Donec ut porta turpis, sed laoreet magna. Fusce non quam vel magna cursus facilisis nec vehicula nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent eros elit, ornare ac dui porta, lobortis auctor ipsum. Proin ac metus dapibus, semper dolor ac, dictum sem. Proin pharetra convallis tempor. Morbi ante diam, vestibulum ut tellus ac, suscipit bibendum quam. Nulla vitae quam tellus. Aliquam id volutpat quam, non accumsan elit. Proin laoreet, mi id pretium varius, leo mi cursus augue, nec rhoncus est nisl vel odio.\r\n\r\n', '2021-03-11 07:43:37', 3, 1, 0),
(14, 'https://picsum.photos/id/1047/400/400', 'Back Alley', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent risus nunc, mattis in metus quis, luctus accumsan justo. Aenean eget lacus mauris. Integer iaculis mattis ullamcorper. Nam at tristique magna, at faucibus ex. Donec ut porta turpis, sed laoreet magna. Fusce non quam vel magna cursus facilisis nec vehicula nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent eros elit, ornare ac dui porta, lobortis auctor ipsum. Proin ac metus dapibus, semper dolor ac, dictum sem. Proin pharetra convallis tempor. Morbi ante diam, vestibulum ut tellus ac, suscipit bibendum quam. Nulla vitae quam tellus. Aliquam id volutpat quam, non accumsan elit. Proin laoreet, mi id pretium varius, leo mi cursus augue, nec rhoncus est nisl vel odio.\r\n\r\n', '2021-03-11 07:43:37', 4, 1, 1),
(15, 'https://picsum.photos/id/106/400/400', 'Flowers against the sky', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent risus nunc, mattis in metus quis, luctus accumsan justo. Aenean eget lacus mauris. Integer iaculis mattis ullamcorper. Nam at tristique magna, at faucibus ex. Donec ut porta turpis, sed laoreet magna. Fusce non quam vel magna cursus facilisis nec vehicula nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent eros elit, ornare ac dui porta, lobortis auctor ipsum. Proin ac metus dapibus, semper dolor ac, dictum sem. Proin pharetra convallis tempor. Morbi ante diam, vestibulum ut tellus ac, suscipit bibendum quam. Nulla vitae quam tellus. Aliquam id volutpat quam, non accumsan elit. Proin laoreet, mi id pretium varius, leo mi cursus augue, nec rhoncus est nisl vel odio.\r\n\r\n', '2021-03-11 07:35:25', 1, 1, 1),
(16, 'https://picsum.photos/id/1060/400/400', 'Coffee Time', 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent risus nunc, mattis in metus quis, luctus accumsan justo. Aenean eget lacus mauris. Integer iaculis mattis ullamcorper. Nam at tristique magna, at faucibus ex. Donec ut porta turpis, sed laoreet magna. Fusce non quam vel magna cursus facilisis nec vehicula nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent eros elit, ornare ac dui porta, lobortis auctor ipsum. Proin ac metus dapibus, semper dolor ac, dictum sem. Proin pharetra convallis tempor. Morbi ante diam, vestibulum ut tellus ac, suscipit bibendum quam. Nulla vitae quam tellus. Aliquam id volutpat quam, non accumsan elit. Proin laoreet, mi id pretium varius, leo mi cursus augue, nec rhoncus est nisl vel odio.\r\n\r\n', '2021-03-11 07:43:37', 4, 0, 1),
(17, '20d307767a05c47207c86ef7cd6ca70b2d8ac3d3', 'finishing up this post', 2, 'yay, it seems to work', '2021-03-16 09:25:20', 1, 1, 1),
(18, '317ec134916b6df181f5f6d4ff939477cfa6dc04', 'new title', 3, 'this should be filled in!!!', '2021-03-16 09:57:54', 1, 0, 1),
(19, 'b55fb87b532afc441793430379821de7e44cf50d', '', 0, '', '2021-03-16 09:58:45', 1, 0, 0),
(20, '4b3370b5c34f96123d7493ab7efca3186bcc4c5c', '', 0, '', '2021-03-17 08:18:44', 1, 0, 0);

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
(1, 'Melissa', 'https://randomuser.me/api/portraits/lego/9.jpg', 'I like snacks', 'melissa@mail.com', '$2y$10$TRl.O8PW10kVKzSnswn5.O/UBdS9uo/Gq2YimcLs.CjNcE1foo4bu', 1, '2021-03-10 10:49:47', 'c564387f219bfd62d6cf253440c642aa3e1416b1c0b74d10dddb08628bf8'),
(2, 'Pearl Mitchelle', 'https://randomuser.me/api/portraits/women/19.jpg', 'This is a sample user account for testing', 'fakeemail@mail.com', '$2y$10$YH0IFPsvzPXt24wRIhKLsubsacDHZVCOvu43D2kbykOo9ZmeVQo1.', 0, '2021-03-10 10:49:47', ''),
(3, 'Dennis Elliott', 'https://randomuser.me/api/portraits/men/54.jpg', 'This is another sample user account for testing', 'deniniselliott@mail.com', '$2y$10$Mjbq8Fz.ObuxXMtXCMlKCOGj8a8QASsYH/b8dXIBsH4W0Q/KYEy5G', 0, '2021-03-11 07:37:39', ''),
(4, 'Edna Steward', 'https://randomuser.me/api/portraits/women/2.jpg', 'This is another sample user account for testing', 'EdnaS@mail.com', '$2y$10$JD7JNCkI.VzGpF8XCqjKrujsTYmCdGhl1Z5Vu6qWKX2x3iLd6fV1K', 0, '2021-03-11 07:38:39', ''),
(12, 'testing10', NULL, NULL, 'test10@mail.com', '$2y$10$6U3YV2EtlxGC596aYzI0nuRBnJjYnH1zngoP9HCykcHfwiyEPZOb.', 0, '2021-03-12 09:41:57', '39e62e4e34babaf0e498b367991058961a2a1a0e9a0370efe17beb77ff4c'),
(13, 'test 11', NULL, NULL, 'test11@mail.com', '$2y$10$vE3ny6QCc1sMhCKflVYHre1UldTqFb5GXl6Y75ujXeErYv68XI/bC', 0, '2021-03-12 09:46:48', NULL);

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
  MODIFY `comment_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2021 at 04:44 PM
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
(13, 'https://picsum.photos/id/1040/400/400', 'Castle', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent risus nunc, mattis in metus quis, luctus accumsan justo. Aenean eget lacus mauris. Integer iaculis mattis ullamcorper. Nam at tristique magna, at faucibus ex. Donec ut porta turpis, sed laoreet magna. Fusce non quam vel magna cursus facilisis nec vehicula nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent eros elit, ornare ac dui porta, lobortis auctor ipsum. Proin ac metus dapibus, semper dolor ac, dictum sem. Proin pharetra convallis tempor. Morbi ante diam, vestibulum ut tellus ac, suscipit bibendum quam. Nulla vitae quam tellus. Aliquam id volutpat quam, non accumsan elit. Proin laoreet, mi id pretium varius, leo mi cursus augue, nec rhoncus est nisl vel odio.\r\n\r\n', '2021-03-11 07:43:37', 3, 1, 1),
(14, 'https://picsum.photos/id/1047/400/400', 'Back Alley', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent risus nunc, mattis in metus quis, luctus accumsan justo. Aenean eget lacus mauris. Integer iaculis mattis ullamcorper. Nam at tristique magna, at faucibus ex. Donec ut porta turpis, sed laoreet magna. Fusce non quam vel magna cursus facilisis nec vehicula nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent eros elit, ornare ac dui porta, lobortis auctor ipsum. Proin ac metus dapibus, semper dolor ac, dictum sem. Proin pharetra convallis tempor. Morbi ante diam, vestibulum ut tellus ac, suscipit bibendum quam. Nulla vitae quam tellus. Aliquam id volutpat quam, non accumsan elit. Proin laoreet, mi id pretium varius, leo mi cursus augue, nec rhoncus est nisl vel odio.\r\n\r\n', '2021-03-11 07:43:37', 4, 1, 1),
(15, 'https://picsum.photos/id/106/400/400', 'Flowers against the sky', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent risus nunc, mattis in metus quis, luctus accumsan justo. Aenean eget lacus mauris. Integer iaculis mattis ullamcorper. Nam at tristique magna, at faucibus ex. Donec ut porta turpis, sed laoreet magna. Fusce non quam vel magna cursus facilisis nec vehicula nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent eros elit, ornare ac dui porta, lobortis auctor ipsum. Proin ac metus dapibus, semper dolor ac, dictum sem. Proin pharetra convallis tempor. Morbi ante diam, vestibulum ut tellus ac, suscipit bibendum quam. Nulla vitae quam tellus. Aliquam id volutpat quam, non accumsan elit. Proin laoreet, mi id pretium varius, leo mi cursus augue, nec rhoncus est nisl vel odio.\r\n\r\n', '2021-03-11 07:35:25', 1, 1, 1),
(16, 'https://picsum.photos/id/1060/400/400', 'Coffee Time', 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent risus nunc, mattis in metus quis, luctus accumsan justo. Aenean eget lacus mauris. Integer iaculis mattis ullamcorper. Nam at tristique magna, at faucibus ex. Donec ut porta turpis, sed laoreet magna. Fusce non quam vel magna cursus facilisis nec vehicula nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent eros elit, ornare ac dui porta, lobortis auctor ipsum. Proin ac metus dapibus, semper dolor ac, dictum sem. Proin pharetra convallis tempor. Morbi ante diam, vestibulum ut tellus ac, suscipit bibendum quam. Nulla vitae quam tellus. Aliquam id volutpat quam, non accumsan elit. Proin laoreet, mi id pretium varius, leo mi cursus augue, nec rhoncus est nisl vel odio.\r\n\r\n', '2021-03-11 07:43:37', 4, 0, 1);

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
  `bio` varchar(1000) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `join_date` datetime NOT NULL DEFAULT current_timestamp(),
  `access_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `profile_pic`, `bio`, `email`, `password`, `is_admin`, `join_date`, `access_token`) VALUES
(1, 'Melissa', 'https://randomuser.me/api/portraits/lego/9.jpg', 'I like snacks', 'melissa@mail.com', 'password', 1, '2021-03-10 10:49:47', ''),
(2, 'Pearl Mitchelle', 'https://randomuser.me/api/portraits/women/19.jpg', 'This is a sample user account for testing', 'fakeemail@mail.com', 'password', 0, '2021-03-10 10:49:47', ''),
(3, 'Dennis Elliott', 'https://randomuser.me/api/portraits/men/54.jpg', 'This is another sample user account for testing', 'deniniselliott@mail.com', 'password', 0, '2021-03-11 07:37:39', ''),
(4, 'Edna Steward', 'https://randomuser.me/api/portraits/women/2.jpg', 'This is another sample user account for testing', 'EdnaS@mail.com', 'password', 0, '2021-03-11 07:38:39', '');

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
  MODIFY `post_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2024 at 03:54 AM
-- Server version: 10.11.6-MariaDB-0+deb12u1
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum_anon`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `parent_comment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `content`, `created_by`, `created_at`, `parent_comment_id`) VALUES
(7, 11, 'dang,,, i know how you feel bro', 'Anon-ZKqxW6GO', '2024-10-02 06:14:45', NULL),
(8, 16, 'just go and touch some grass broo', 'Anon-xgy1rhp5', '2024-10-02 11:31:55', NULL),
(9, 16, 'now people are getting nervous about it', 'Anon-xgy1rhp5', '2024-10-02 11:32:28', NULL),
(12, 14, 'try youtube', 'Anon-1lsr8u4z', '2024-10-03 01:01:59', NULL),
(13, 23, 'turns out yeah, it is. see https://www.lighttpd.net/', 'Anon-xQWXGJSK', '2024-10-03 06:50:32', NULL),
(14, 24, 'locked in bruh', 'Anon-kU76Gawm', '2024-10-03 08:01:35', NULL),
(15, 18, 'bruh', 'Anon-9NzYUsTA', '2024-10-04 03:35:13', NULL),
(16, 14, 'you have to try skillvul, it mostly free', 'Anon-5ig4vyrd', '2024-10-04 10:18:24', NULL),
(17, 26, 'it\'s hard i indonesia, the government rules are strict about weapon in there..', 'Anon-S3zEiJgw', '2024-10-05 02:14:28', NULL),
(18, 2, 'it\'s a symbolic', 'Anon-tyjhq7kl', '2024-10-05 02:49:50', NULL),
(19, 33, 'it\'s work like bootstrap', 'Anon-8dfg0x21', '2024-10-05 12:51:57', NULL),
(26, 33, 'have you ever tried bootstrap yet?', 'Anon-8dfg0x21', '2024-10-05 12:55:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `category`, `user_id`, `created_at`, `image`) VALUES
(2, 'hello world philosopy', 'what is hello world meaning, why always hello world?', 'Entertainment', 'Anon-FJRHiyvO', '2024-10-01 10:47:25', NULL),
(3, 'why people like programmingh', 'just whyy??', 'Hobbies & interest', 'Anon-LKjIvUJ2', '2024-10-01 10:48:35', NULL),
(7, 'halo', 'testing', 'Entertainment', 'Anon-dRKzQhHM', '2024-10-01 11:57:49', NULL),
(11, 'oh. how people are gay?', 'i mean why so many people like to be gay or lesbian, it\' just gross', 'Entertainment', 'Anon-G6qHALMa', '2024-10-02 05:13:53', NULL),
(14, 'how i can learn to code', 'i\'m struggling to learn code. i\'m in computer science.', 'Education', 'Anon-cxrbetUC', '2024-10-02 05:38:22', NULL),
(15, 'how many people like to code in here?', 'coding is hard, i\'ve thaught to got bt my dads', 'Hobbies & interest', 'Anon-zXwSdj8Z', '2024-10-02 05:40:55', NULL),
(16, 'i like watching movies', 'now movies are shit and boring', 'Entertainment', 'Anon-zA1qbdY2', '2024-10-02 05:41:31', NULL),
(18, 'how much do you need to travel around the world?', 'i seen many people that like to travel, they were so fucking rich', 'Around the world', 'Anon-W7xRl1eJ', '2024-10-02 05:44:46', NULL),
(20, 'dark web experience, just asking', 'does anyone here have experience with diving to some dark internet?', 'Misc.', 'Anon-Jave0rWx', '2024-10-03 02:08:24', NULL),
(22, 'why so many meme about php?', 'php is sick, i don\'t even like it. but why it have so many meme in internet about it? dangg', 'Entertainment', 'Anon-qfMOdu9H', '2024-10-03 02:36:47', NULL),
(23, 'is lighthttpd server still active developed?', 'there are apache2, nginx, and more, but lighthttpd looks like old lol!!', 'Education', 'Anon-xQWXGJSK', '2024-10-03 06:49:32', NULL),
(24, 'my friend get a girlfriend', 'now i\'m lonely,, what i have to do??', 'Misc.', 'Anon-kU76Gawm', '2024-10-03 08:01:25', NULL),
(25, 'do you guys like mecha?', 'i like it', 'Mecha', 'Anon-Kr1Fobd4', '2024-10-04 03:19:54', NULL),
(26, 'where i can buy weapons in indonesia?', 'i\'d like to buy one, i\'m on vacation in indonesia!', 'Weapons', 'Anon-9NzYUsTA', '2024-10-04 03:23:41', NULL),
(27, 'what is the most secure os to dive into dark web?', 'hey, i know this is a stupid question, but i\'m new to dark web stuff. any answer is helping. thanks!', 'OperatingSystem', 'Anon-ZjasoULE', '2024-10-04 08:50:28', NULL),
(28, 'is there an alternative for adobe app in linux?', 'i\'m just switched to linux 1 month ago, i was a graphic designner.', 'Graphic Design', 'Anon-oeFnj6O4', '2024-10-05 02:00:16', NULL),
(30, 'is developing cryptocurrency is worth?', 'the crypto world is trending now, should i all in?', 'Business', 'Anon-S3zEiJgw', '2024-10-05 02:12:33', NULL),
(33, 'how tailwind work?', 'i\'ve been using tailwind for  years and still don\'t know how it works', 'Technology', 'Anon-0S7IdJf8', '2024-10-05 04:01:39', 'uploads/ekorangin.png'),
(34, 'The Evolution of Comics: From Print to Digital', 'Comics have been a significant part of popular culture for decades, evolving from simple, black-and-white strips in newspapers to complex, full-color graphic novels and digital comics. Here’s a brief look at how comics have transformed over the years:\r\n\r\n1. The Golden Age of Comics (1930s - 1950s)\r\nThe Golden Age marked the rise of superhero comics, with iconic characters like Superman and Batman making their debut. These stories often reflected the societal issues of the time, offering escapism during the Great Depression and World War II.\r\n\r\n2. The Silver Age (1950s - 1970s)\r\nWith the introduction of new characters and a more sophisticated narrative style, the Silver Age saw the popularity of comics expand even further. This period brought us Marvel superheroes like Spider-Man and the X-Men, who dealt with real-world issues like prejudice and personal struggles.\r\n\r\n3. The Bronze Age (1970s - 1990s)\r\nThis era was characterized by darker themes and more complex storylines. Comics began addressing social issues such as drug abuse, mental health, and politics. Titles like \"Green Lantern/Green Arrow\" tackled these subjects head-on.\r\n\r\n4. The Digital Age (2000s - Present)\r\nWith the rise of the internet, comics have found a new home online. Digital comics are more accessible than ever, with platforms like Webtoon and Tapas allowing independent creators to share their work with global audiences. Additionally, the integration of multimedia elements, like animations and sound, has transformed the reading experience.\r\n\r\nConclusion\r\nThe world of comics continues to evolve, embracing new technologies and storytelling techniques. Whether you prefer classic superhero tales or modern graphic novels, there\'s a comic out there for everyone. What are your favorite comics, and how do you think they will evolve in the future?\r\n\r\n', 'Comics', 'Anon-mAj1tRaB', '2024-10-05 04:37:46', 'uploads/rick.png'),
(35, 'rtfret', 'erwtwrt', 'Entertainment', 'Anon-gE0HQiU2', '2024-10-05 04:40:20', NULL),
(36, 'why nazi\'s hate jew?', 'we know it all, just asking', 'Weapons', 'Anon-9ugfWC6F', '2024-10-05 04:47:38', NULL),
(37, 'is it recommended to use vpn while diving in the dark web?', 'i\'ve seen a youtube video talking about this', 'Weapons', 'Anon-z4QLTqds', '2024-10-18 09:39:10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

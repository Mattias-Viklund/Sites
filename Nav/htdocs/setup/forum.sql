-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 21 mars 2019 kl 14:19
-- Serverversion: 10.1.36-MariaDB
-- PHP-version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `forum`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE `comments` (
  `comment_id` bigint(20) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_username` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_replyto` bigint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `following`
--

CREATE TABLE `following` (
  `user_id` bigint(20) NOT NULL,
  `sub_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `friends`
--

CREATE TABLE `friends` (
  `user_id` bigint(20) NOT NULL,
  `friend_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `moderators`
--

CREATE TABLE `moderators` (
  `sub_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `posts`
--

CREATE TABLE `posts` (
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `post_id` bigint(20) NOT NULL,
  `post_username` varchar(50) NOT NULL,
  `post_text` varchar(2500) NOT NULL,
  `post_title` varchar(50) NOT NULL,
  `post_sub` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `subs`
--

CREATE TABLE `subs` (
  `sub_id` bigint(20) NOT NULL,
  `sub_name` varchar(50) NOT NULL,
  `sub_owner` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(5, 'Mew_', '$2y$10$Y0tDRRObK2E2l2l87wJEq.9Kc4jHo9KXbzJxl85LVonKeeXMr16QS', '2019-02-22 12:25:39');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Index för tabell `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `username` (`post_username`),
  ADD KEY `title` (`post_title`) USING BTREE;

--
-- Index för tabell `subs`
--
ALTER TABLE `subs`
  ADD PRIMARY KEY (`sub_id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT för tabell `subs`
--
ALTER TABLE `subs`
  MODIFY `sub_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

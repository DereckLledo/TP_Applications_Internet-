-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 11, 2018 at 04:21 PM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estate_agents`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `path`, `created`, `modified`, `status`) VALUES
(11, 'maison1.jpg', 'uploads/files/', '2018-10-11 01:05:26', '2018-10-11 01:05:26', 1),
(12, 'maison3.jpg', 'uploads/files/', '2018-10-11 01:05:32', '2018-10-11 01:05:32', 1),
(13, 'maison2.jpg', 'uploads/files/', '2018-10-11 01:06:20', '2018-10-11 01:06:20', 1),
(14, 'maison4.jpg', 'uploads/files/', '2018-10-11 01:06:28', '2018-10-11 01:06:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `i18n`
--

CREATE TABLE IF NOT EXISTS `i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proprietes`
--

CREATE TABLE IF NOT EXISTS `proprietes` (
  `id` int(11) NOT NULL,
  `vendeur_id` int(11) NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prix` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `efface` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proprietes`
--

INSERT INTO `proprietes` (`id`, `vendeur_id`, `adresse`, `prix`, `description`, `image`, `created`, `modified`, `efface`) VALUES
(26, 7, '220', '333', '32424', NULL, '2018-10-11', '2018-10-11', 0),
(27, 14, '123', '444', 'dwedew', NULL, '2018-10-11', '2018-10-11', 0),
(28, 15, 'rewrw', 'rewrw', 'rewr', NULL, '2018-10-11', '2018-10-11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `proprietes_files`
--

CREATE TABLE IF NOT EXISTS `proprietes_files` (
  `id` int(11) NOT NULL,
  `propriete_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proprietes_files`
--

INSERT INTO `proprietes_files` (`id`, `propriete_id`, `file_id`) VALUES
(12, 26, 11),
(13, 27, 13),
(14, 28, 11);

-- --------------------------------------------------------

--
-- Table structure for table `proprietes_tags`
--

CREATE TABLE IF NOT EXISTS `proprietes_tags` (
  `propriete_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proprietes_tags`
--

INSERT INTO `proprietes_tags` (`propriete_id`, `tag_id`) VALUES
(26, 7),
(28, 7),
(27, 9),
(26, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `created`, `modified`) VALUES
(7, 'Grande', '2018-10-11 01:03:30', '2018-10-11 01:03:30'),
(8, 'Luxe', '2018-10-11 01:03:34', '2018-10-11 01:03:34'),
(9, 'Petite', '2018-10-11 01:03:41', '2018-10-11 01:03:41'),
(10, 'Intergeneration', '2018-10-11 01:03:57', '2018-10-11 01:03:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `type`, `created`, `modified`) VALUES
(1, 'test@test.com', '$2y$10$dJh94TZPlBc/GybBGCQu/u7.nnAM7y4ZihQbBPFtJVXg4mdh7Chs2', 'test', '0', '2018-10-06 20:24:49', '2018-10-06 22:04:35'),
(19, 'lledo@yopmail.com', '$2y$10$YnD2pmeWDN0z88AxH/5ho.oW2H1h9Uy060QBj6y8apEpVFePykd0O', 'testyoup', '0', '2018-10-10 22:52:07', '2018-10-10 23:03:44'),
(21, 'admin@admin.com', '$2y$10$6L4AIo9bjaSPOcNX2o3Vf.lHrLLkJQR3rInRxnU7CAJErVFL1n17e', 'admin', '1', '2018-10-11 01:01:30', '2018-10-11 01:01:30'),
(23, 'derecklledo@gmail.com', '$2y$10$DXY6XpfR7zBljnGglZoMPuoC8JC8jv.A2ih3ZjkitvSc1pKF0bSsS', 'tester', '0', '2018-10-11 01:21:16', '2018-10-11 01:22:00'),
(24, 'notRegister@test.com', '$2y$10$7umz3Keg9UGn393A4BPBROg5ixWhqImTpeDn.26PK979J4EEyoIPS', 'notR', '0a102346-16ba-4106-8932-320fe9670bb8', '2018-10-11 03:14:00', '2018-10-11 03:14:00');

-- --------------------------------------------------------

--
-- Table structure for table `vendeurs`
--

CREATE TABLE IF NOT EXISTS `vendeurs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `efface` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vendeurs`
--

INSERT INTO `vendeurs` (`id`, `user_id`, `nom`, `prenom`, `phone`, `email`, `slug`, `created`, `modified`, `efface`) VALUES
(7, 21, 'Jean', 'Luc', '1235673456', 'jeanluc@vendeur.com', '', '2018-10-11', '2018-10-11', 0),
(13, 21, 'Chantal', 'Test', '3442432', 'derejr@gfmgrem.com', 'ad8c4afd-9261-485d-904e-092cf053a224', '2018-10-11', '2018-10-11', 0),
(14, 21, 'test_edit', 'Test_edit123', '3432341', 'test@testedit.com', '15b84d98-058c-4e44-9b48-4804c1f4b5d5', '2018-10-11', '2018-10-11', 0),
(15, 23, 'test', 'Esso', '12341234', 'tytrytr@yopmail.com', 'd15beca6-e6c4-4339-a8a9-e027d7b5eceb', '2018-10-11', '2018-10-11', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `i18n`
--
ALTER TABLE `i18n`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`,`foreign_key`,`field`),
  ADD KEY `I18N_FIELD` (`model`,`foreign_key`,`field`);

--
-- Indexes for table `proprietes`
--
ALTER TABLE `proprietes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendeur_id` (`vendeur_id`);

--
-- Indexes for table `proprietes_files`
--
ALTER TABLE `proprietes_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propriete_id` (`propriete_id`),
  ADD KEY `file_id` (`file_id`);

--
-- Indexes for table `proprietes_tags`
--
ALTER TABLE `proprietes_tags`
  ADD PRIMARY KEY (`propriete_id`,`tag_id`),
  ADD KEY `tag_key` (`tag_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendeurs`
--
ALTER TABLE `vendeurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `i18n`
--
ALTER TABLE `i18n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `proprietes`
--
ALTER TABLE `proprietes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `proprietes_files`
--
ALTER TABLE `proprietes_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `vendeurs`
--
ALTER TABLE `vendeurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `proprietes`
--
ALTER TABLE `proprietes`
  ADD CONSTRAINT `proprietes_ibfk_1` FOREIGN KEY (`vendeur_id`) REFERENCES `vendeurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proprietes_files`
--
ALTER TABLE `proprietes_files`
  ADD CONSTRAINT `proprietes_files_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proprietes_files_ibfk_2` FOREIGN KEY (`propriete_id`) REFERENCES `proprietes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proprietes_tags`
--
ALTER TABLE `proprietes_tags`
  ADD CONSTRAINT `proprietes_tags_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proprietes_tags_ibfk_2` FOREIGN KEY (`propriete_id`) REFERENCES `proprietes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendeurs`
--
ALTER TABLE `vendeurs`
  ADD CONSTRAINT `vendeurs_ifbk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2016 at 06:35 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2.info`
--

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

CREATE TABLE `agency` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `des` text COLLATE utf8_unicode_ci,
  `create_by` int(11) NOT NULL,
  `status` smallint(6) DEFAULT '1',
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`id`, `name`, `des`, `create_by`, `status`, `website`, `token`, `created_at`, `updated_at`) VALUES
(12, 'Holidigi', 'This is a Holidigi Team', 1, 1, 'holidigi.info', '7QVmkuplYkgZNGYoZpu9jQhlXPkzDH', 1469552860, 1469552860),
(13, '55CNTT1', 'This is a 55TH1 Leader Team', 1, 1, '55th1.info', 'PpOB7VLCXPVgzZh8EIhkrSUqEODwvm', 1469605790, 1469605790);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_by` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_by` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1469424321),
('m130524_201442_init', 1469424326),
('m160725_053154_create_agency', 1469430856),
('m160725_055236_create_site_owner', 1469430909),
('m160725_055247_create_website', 1469430976),
('m160725_055305_create_task', 1469431230),
('m160725_055313_create_file', 1469431310),
('m160725_055329_create_comment', 1469431291),
('m160725_055339_create_time', 1469431294),
('m160729_022905_create_plan', 1469759708);

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agency_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id`, `name`, `type`, `cost`, `hour`, `agency_id`, `created_at`, `updated_at`) VALUES
(1, 'Plan default', 'agency', '100', '5', NULL, 1469760424, 1469760424);

-- --------------------------------------------------------

--
-- Table structure for table `site_owner`
--

CREATE TABLE `site_owner` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `des` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_by` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agency_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `site_owner`
--

INSERT INTO `site_owner` (`id`, `name`, `des`, `create_by`, `status`, `website`, `agency_id`, `created_at`, `updated_at`) VALUES
(5, 'My Pham Online', 'My Pham Online', 5, 1, 'hien.info', 12, 1469811822, 1469811822),
(8, 'Ban Hang Da Cap', 'Ban Hang Da Cap', 5, 1, 'duyit.info', 12, 1469812785, 1469812785),
(9, 'Site Owner 1', 'This is a Site Owner 1', 7, 1, 'siteowner1.info', 13, 1469885621, 1469885621);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `des` text COLLATE utf8_unicode_ci,
  `create_by` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `website_id` int(11) NOT NULL,
  `site_owner_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `comment` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `title`, `des`, `create_by`, `status`, `website_id`, `site_owner_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'task 1', 'task 1', 5, 1, 5, 5, 11, 0, 1469896917, 1469896917),
(2, 'task 2', 'task 2', 5, 1, 5, 5, 10, 0, 1469897595, 1469897595),
(3, 'task 3', 'task 3', 5, 1, 5, 5, 13, 0, 1470025379, 1470025379);

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `id` int(11) NOT NULL,
  `hour` float NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_by` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `is_supper` smallint(6) NOT NULL DEFAULT '0',
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `last_login` int(11) DEFAULT '0',
  `site_owner_id` int(11) DEFAULT NULL,
  `agency_id` int(11) DEFAULT NULL,
  `is_owner` int(11) DEFAULT '0',
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `is_supper`, `first_name`, `last_name`, `username`, `phone`, `email`, `auth_key`, `password_hash`, `password_reset_token`, `create_by`, `status`, `last_login`, `site_owner_id`, `agency_id`, `is_owner`, `role`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hoang', 'Huy', 'admin', '0165 982 6645', 'admin@gmail.com', 'ToVrr8UzeiFfU78QMZulL_7wUIzrVBnZ', '$2y$13$FQQG4b.8Chu88yo/olHKieA5rJILE8E8IkYC7is9Hhr0NVl02QSyG', NULL, NULL, 1, 1469884726, NULL, NULL, 0, 'Admin', 1469424423, 1469884726),
(5, 0, 'Huy', 'Hoang', 'holidigi', ' 113', 'holidigi@gmail.com', 'MT9Ci-at1hUv20xEjABilHo5fvWWL_O0', '$2y$13$xdMDc9nJi7fr6E2do.avRO5k/cAQIAxzK65R.aL3HkZMUxGTcrkua', NULL, 1, 1, 1469894304, NULL, 12, 1, 'Agency', 1469552862, 1469894304),
(7, 0, 'Chủ', 'Nguyễn Tất', 'itChu', '113', 'itChu@gmail.com', '-T7ArkfXULuzTYVC3rufQ7mSgy-7fHkG', '$2y$13$fjFnXUtZog5Is9ImznXXKuf6uycZsk7sVy9uTkwPMZdiTgNoSFXwS', NULL, 1, 1, 1469894089, NULL, 13, 1, 'Agency', 1469605790, 1469894089),
(10, 0, 'Nguyen', 'Hong', 'hongit', '23456789', 'ithong@gmail.com', 'xkqM49e703Hod_mSL1Sr7tM4-bRhBrGt', '$2y$13$Y4qEIGfF8i0eW5XT.J7.I.JsRU5zgGbvFFUtmstR89mjOzX0zPXla', NULL, 5, 1, 0, NULL, NULL, 0, 'Tester', 1469792561, 1469792561),
(11, 0, 'Hoang Ngoc', 'Huy', 'ithuy', '0165 982 6645', 'ithuy@gmail.com', '1Nv8fzsV9PG95YdmYYd7ZX7--oUs_8oB', '$2y$13$OjoGKSK97WNt9hTdZooFJOnH1eckbNAaqc/7Ako8HHk.8GrNC6JtS', NULL, 5, 1, 1469894147, NULL, NULL, 0, 'Devoloper', 1469793038, 1469894147),
(12, 0, 'Hoang Kim', 'Troi', 'ittroi', '1234567890', 'ittroi@gmail.com', 'WCgsh1MHJFmUWNGsdSvKN46Vluh8ynoP', '$2y$13$4NAHatFseF01RqXpR58gHulvc3s1jUjPg7Ba/HhTIb1d71Uuu/HS6', NULL, 5, 1, 0, NULL, NULL, 0, 'Project Manager', 1469793752, 1469793752),
(13, 0, 'Anh', 'Phuong', 'itphuong', '123456', 'itphuong@gmail.com', 'O94NkKZkvSSi2-jQuYZP-A4V0QQIQP0q', '$2y$13$FXnLLDJN2Kcrcvnl2GyBQeoSCwT0nnb4a4eHtZDfnmGI3k.6uP.lS', NULL, 5, 1, 0, NULL, NULL, 0, 'Designer', 1469793850, 1469793850),
(14, 0, 'Nguyen', 'Vu', 'itvu', '123456', 'itvu@gmail.com', 'vm1AcGmxudvGd5nm22YL9wZAyMUmuSoW', '$2y$13$Vk33DSt2zVSCti.3a/4EjuQDhB9KBVO.Iitx23C6ClVN2YbCVtEWm', NULL, 5, 1, 0, NULL, NULL, 0, 'Devoloper', 1469794015, 1469794015),
(15, 0, 'Nguyen', 'Map', 'itanh', '123456789', 'itanh@gmail.com', 'Wsfeycr8KBf_U0C-CPgoRT9TzFSzKDg3', '$2y$13$i6MXuzcrH3e6XAFvxb8YveDQP9MRgPTmu/E8awiCNZen2oIGRrYIK', NULL, 5, 1, 0, NULL, NULL, 0, 'Devoloper', 1469806475, 1469806475),
(18, 0, 'Nguyen Thi Thu', 'Hien', 'ntthien', '1234567890', 'hien@gmail.com', '9m4UXjLmlyJDPDTjNEtRnxaNRQkfH4oR', '$2y$13$wP4Lk4.f25yjIiV64qu7nuygfzK3Bw2GkrBF1eH1YyFPegidUVj/6', NULL, 5, 1, 0, 5, NULL, 1, 'Site Owner', 1469811822, 1469811822),
(19, 0, 'Phuong', 'Thao', 'thaoit', '1234567', 'thaoit@gmail.com', 'S_5sV_yFbfysQAbxBzNvEwcDJ7R02uGO', '$2y$13$dvR/kvRr91ubZ.PqT.mNMeb1GqWBqPWj.dBdoxRzFC9rDcJXgtaZS', NULL, 5, 1, 0, NULL, NULL, 0, 'Tester', 1469812485, 1469812485),
(21, 0, 'Phan', 'Duy', 'duyit', '1234567', 'duy@gmail.com', 'leG30EPtBVQaY-YfQNsCThFCVpyQVMIf', '$2y$13$NNnnWThLgto8DwCbes/sjOU4VFiSDuDVGPzScvv8jgutlIzOhTPUS', NULL, 5, 1, 0, 8, NULL, 1, 'Site Owner', 1469812785, 1469812785),
(22, 0, 'Site Owner', '1', 'siteowner1', '1234567890', 'siteowner1@gmail.com', 'PsPQQf7Y6GEe_VJ5vG4-6aRfSubtlwuM', '$2y$13$xEzSF4u3iKG5VygNhPQgzu8uhbC6ePC24zQsxJO4pZ1VhCpehFkX.', NULL, 7, 1, 0, 9, NULL, 1, 'Site Owner', 1469885621, 1469885621),
(23, 0, 'User', '1', 'user1', '123456', 'user1@gmail.com', 'v7xDTRP4RTlzUeQwgEWiZ6xj1Ss0tQjm', '$2y$13$gMdWceRtiOa7ABr6xuPe7uqm5Cs1TxPvIzp7GaO/5aNqKMDyTQXg2', NULL, 7, 1, 0, NULL, NULL, 0, 'Project Manager', 1469885836, 1469885836),
(24, 0, 'User', '2', 'user2', '1234567', 'user2@gmail.com', 'p39mHUB-LBjHst7ErF_nYH0mj2nmluIK', '$2y$13$EC6gPY8lOmh9ZfgPj0C.XeaLSBqkfLbpFJt8/DqOcHXHZgJCPn1m2', NULL, 7, 1, 0, NULL, NULL, 0, 'Designer', 1469885910, 1469885910);

-- --------------------------------------------------------

--
-- Table structure for table `website`
--

CREATE TABLE `website` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `des` text COLLATE utf8_unicode_ci,
  `create_by` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `site_owner_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `website`
--

INSERT INTO `website` (`id`, `name`, `des`, `create_by`, `status`, `site_owner_id`, `created_at`, `updated_at`) VALUES
(3, 'hien.info', 'hien.info', 5, 1, 5, 1469811824, 1469811824),
(5, 'duyit.info', 'duyit.info', 5, 1, 8, 1469812787, 1469812787),
(6, 'siteowner1.info', 'siteowner1.info', 7, 1, 9, 1469885622, 1469885622);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-agency-create_by` (`create_by`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-comment-create_by` (`create_by`),
  ADD KEY `idx-comment-task_id` (`task_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-file-create_by` (`create_by`),
  ADD KEY `idx-file-comment_id` (`comment_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-plan-agency_id` (`agency_id`);

--
-- Indexes for table `site_owner`
--
ALTER TABLE `site_owner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-site_owner-create_by` (`create_by`),
  ADD KEY `idx-site_owner-agency_id` (`agency_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-task-create_by` (`create_by`),
  ADD KEY `idx-task-website_id` (`website_id`),
  ADD KEY `idx-task-site_owner_id` (`site_owner_id`),
  ADD KEY `idx-task-user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-time-create_by` (`create_by`),
  ADD KEY `idx-time-task_id` (`task_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-website-create_by` (`create_by`),
  ADD KEY `idx-website-site_owner_id` (`site_owner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agency`
--
ALTER TABLE `agency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `site_owner`
--
ALTER TABLE `site_owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `website`
--
ALTER TABLE `website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `agency`
--
ALTER TABLE `agency`
  ADD CONSTRAINT `fk-agency-create_by` FOREIGN KEY (`create_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk-comment-create_by` FOREIGN KEY (`create_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-comment-task_id` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `fk-file-comment_id` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-file-create_by` FOREIGN KEY (`create_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `fk-plan-agency_id` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `site_owner`
--
ALTER TABLE `site_owner`
  ADD CONSTRAINT `fk-site_owner-agency_id` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-site_owner-create_by` FOREIGN KEY (`create_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `fk-task-create_by` FOREIGN KEY (`create_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-task-site_owner_id` FOREIGN KEY (`site_owner_id`) REFERENCES `site_owner` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-task-website_id` FOREIGN KEY (`website_id`) REFERENCES `website` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `time`
--
ALTER TABLE `time`
  ADD CONSTRAINT `fk-time-create_by` FOREIGN KEY (`create_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-time-task_id` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `website`
--
ALTER TABLE `website`
  ADD CONSTRAINT `fk-website-create_by` FOREIGN KEY (`create_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-website-site_owner_id` FOREIGN KEY (`site_owner_id`) REFERENCES `site_owner` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

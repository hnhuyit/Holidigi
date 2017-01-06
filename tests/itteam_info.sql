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
-- Database: `itteam.info`
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
  `plan_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `status` smallint(6) DEFAULT '1',
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`id`, `name`, `des`, `create_by`, `plan_id`, `bill_id`, `status`, `avatar`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Holidigi', 'This is a Holidigi Team', 1, 1, 0, 1, NULL, 'S3oEe9cGbBXfPDwiMXek5NVhnSXEKo', 1470112657, 1470113557),
(2, '55CNTT1', 'This is a ', 1, 1, 0, 1, NULL, '7Nox43sGB617qjxVLw0Jl3RAmL66zZ', 1470113224, 1470113224),
(3, 'Mr San', 'This is a agency Mr San', 1, 3, 0, 1, NULL, '8IyF8ur37uER9X32RAY3kBgT9JfZpc', 1470234719, 1470234719);

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `card_type` varchar(255) DEFAULT NULL,
  `card_name` varchar(255) DEFAULT NULL,
  `card_number` varchar(255) DEFAULT NULL,
  `expiration_date` varchar(255) DEFAULT NULL,
  `security_code` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_by` int(11) NOT NULL,
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
  `user_by` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `object_id` int(11) DEFAULT NULL,
  `object_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `sent` int(11) DEFAULT NULL,
  `agency_id` int(11) DEFAULT NULL,
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
('m000000_000000_base', 1470070769),
('m130524_201442_init', 1470070771),
('m140506_102106_rbac_init', 1470149947),
('m160725_053154_create_agency', 1470070771),
('m160725_055236_create_site_owner', 1470070773),
('m160725_055247_create_website', 1470070773),
('m160725_055305_create_task', 1470070775),
('m160725_055313_create_file', 1470070775),
('m160725_055329_create_comment', 1470070776),
('m160725_055339_create_time', 1470070777),
('m160729_022905_create_plan', 1470070779),
('m160731_141401_create_bill', 1470070779),
('m160731_141427_create_invoice', 1470070781);

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
  `create_by` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id`, `name`, `type`, `cost`, `hour`, `agency_id`, `create_by`, `created_at`, `updated_at`) VALUES
(1, 'Plan default', 'agency', '100', '5', NULL, 1, 1470111190, 1470111202),
(3, 'Plan default 2', 'agency', '50', '5', NULL, 1, 1470111240, 1470111240),
(4, 'Plan default 3', 'agency', '200', '5', NULL, 1, 1470112260, 1470112260),
(5, 'Site Owner 1', 'site owner', '50', '5', 1, 2, 1470116368, 1470116368),
(6, 'Site Owner 2', 'site owner', '200', '5', 1, 2, 1470116424, 1470116424),
(7, 'Chu Plan', 'site owner', '1000', '10', 2, 3, 1470116784, 1470116784),
(8, 'Chu Plan 1', 'site owner', '2000', '15', 2, 3, 1470116812, 1470116832),
(9, 'Plan default 4', 'agency', '1', '1', NULL, 1, 1470117513, 1470117513),
(10, 'Plan default 5', 'agency', '2', '2', NULL, 1, 1470117809, 1470117809),
(11, 'Site Owner 3', 'site owner', '300', '3', 1, 2, 1470117839, 1470117839);

-- --------------------------------------------------------

--
-- Table structure for table `site_owner`
--

CREATE TABLE `site_owner` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `des` text COLLATE utf8_unicode_ci,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_by` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agency_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `site_owner`
--

INSERT INTO `site_owner` (`id`, `name`, `des`, `avatar`, `create_by`, `status`, `website`, `agency_id`, `plan_id`, `bill_id`, `created_at`, `updated_at`) VALUES
(1, 'Site Owner Nguyen Hien', 'This is a Site Owner Hien', 'ahihi', 2, 1, 'siteowner1.info', 1, 5, NULL, 1470120610, 1470243905),
(2, 'Site Owner 2', 'This is a ', NULL, 2, 1, 'siteowner2.info', 1, 6, NULL, 1470120838, 1470120838),
(3, 'My Pham Online', 'Đây là Shop Ban My Pham', NULL, 2, 1, 'itshop.info', 1, 5, NULL, 1470121345, 1470121345),
(4, 'Shop Luu Niem', 'Shop Luu Niem', NULL, 3, 1, 'shopluuniem.info', 2, 7, NULL, 1470122287, 1470122287);

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
  `user_id` int(11) NOT NULL,
  `comment` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `title`, `des`, `create_by`, `status`, `website_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'Create task for you', 'Create task for you', 2, 1, 1, 6, 0, 1470124938, 1470124938),
(2, 'Create task for you 2', 'Create task for you 2', 2, 1, 1, 9, 0, 1470125035, 1470125035),
(3, 'Create task for you 3', 'Create task for you 3', 2, 1, 1, 6, 0, 1470125110, 1470125110),
(4, 'Create task for you 4', 'Create task for you 4', 2, 1, 1, 4, 0, 1470125278, 1470125278),
(5, 'What the help????', 'What the help????', 3, 1, 4, 11, 0, 1470125691, 1470125691),
(6, 'I can help for you.', 'I can help for you.', 3, 1, 4, 11, 0, 1470125722, 1470125722),
(9, 'create task 2', 'This is', 2, 1, 1, 9, 0, 1470496857, 1470496857),
(10, 'aaaaa', 'aaaaaaaaaa', 2, 1, 1, 4, 0, 1470496921, 1470496921);

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `id` int(11) NOT NULL,
  `hour` float NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_by` int(11) NOT NULL,
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
(1, 1, 'Hoang', 'Huy', 'admin', '0165 982 6645', 'admin@gmail.com', 'ToVrr8UzeiFfU78QMZulL_7wUIzrVBnZ', '$2y$13$FQQG4b.8Chu88yo/olHKieA5rJILE8E8IkYC7is9Hhr0NVl02QSyG', NULL, NULL, 1, 1470497173, NULL, NULL, 0, 'Admin', 1469424423, 1470497173),
(2, 0, 'Huy', 'Hoang', 'holidigi', '123456789', 'holidigi@gmail.com', 'Fp2JJeNNxqeUCyy7qggg8ORqE8RSlKiJ', '$2y$13$YmfQrs0lTAS0CNj0Xrgyt.GaPUzLEXNycDqRgmRG8Iss2ozyIXaOS', NULL, 1, 1, 1471238913, NULL, 1, 1, 'Agency', 1470112657, 1471238913),
(3, 0, 'Chủ', 'Nguyễn Tất', 'itChu', '123456789', 'itChu@gmail.com', 'GBg3jTBgihZUaP0YmYsKzsvsTaWNgYsi', '$2y$13$6zIP0ek.yfTp4sU7aIFhzu4fj7BqeiH0kDbknBphRQfVSCSGn7Ov2', NULL, 1, 1, 1470125358, NULL, 2, 1, 'Agency', 1470113224, 1470125358),
(4, 0, 'Hoang Ngoc', 'Huy', 'ithuy', '12345643567', 'ithuy@gmail.com', 'WZdqw6cRoKfGErwgLnCsmKdLzsgNnNt0', '$2y$13$qXAkEjLO2QCvxZmRFSigXONET07vbOtVfvEFN1GdXm1iIhQmj06S.', NULL, 2, 1, 1470496941, NULL, NULL, 0, 'Project Manager', 1470115069, 1470496941),
(5, 0, 'Nguyen', 'Hien', 'ithien', '123456', 'ithien@gmail.com', 'qp0kn25fyLbkpu1z_c3kksdFP2NrbS6V', '$2y$13$v5pcJYaBgBriR0/figJHLO9yU8tkKVjkci1nJ4q4oZ2VjDk8ES7uO', NULL, 2, 1, 1470497679, NULL, NULL, 0, 'Tester', 1470115275, 1470497679),
(6, 0, 'Nguyen', 'Huyen', 'ithuyen', '12312345', 'ithuyen@gmail.com', '7tbElJi334jPfw9N2dHbyZ31ICSoVd_k', '$2y$13$xGnYatKMbHYSh.zYWurP9ej61FgR0cpjFfha1xvuyCMmgS2BmrItW', NULL, 2, 1, 0, NULL, NULL, 0, 'Designer', 1470116902, 1470116902),
(7, 0, 'Hien', 'Nguyen', 'Hien Shop My Pham', '01659826645', 'hien@gmail.com', 'RHvrxI4uvNbPKS80xoy8MAQ9WzJLY7_6', '$2y$13$xGnYatKMbHYSh.zYWurP9ej61FgR0cpjFfha1xvuyCMmgS2BmrItW', NULL, 2, 1, 1471238973, 1, NULL, 1, 'Site Owner', 1470120611, 1471238973),
(8, 0, 'Hoang', 'Huy', 'hoanghyhi', '0165 982 6645', 'hoanghyhi@gmail.com', '507zt8kglU7MfWN2UM1LzfZKeMj_VXWc', '$2y$13$Cuz6hQw3BR4.qIm8n4JkI.LwO6ZIULBUuwDvyG.AJGZM514967ofS', NULL, 2, 1, 1470237655, 2, NULL, 1, 'Site Owner', 1470120839, 1470237655),
(9, 0, 'Nguyen', 'Vu', 'itvu', '12345', 'itvu@gmail.com', 'wg0HvUZwYqsgVGHQoUv21ilo1VbA-QX8', '$2y$13$Fyvc3j/ZVTJZLr35DbYkrOpf46dLX7A8o45asfnZ5shBL8QrUFnk2', NULL, 2, 1, 1470496675, NULL, NULL, 0, 'Devoloper', 1470122800, 1470496675),
(11, 0, 'Huy', 'Hoang', 'huyhn', '123123', 'huyhn@gmail.com', 'LJJZgQfgsO6nSaNwHYWLsgeso_uZQVDb', '$2y$13$TSBz0.K9trC0SJawsFyIVOcZ0OXTmnD7LPa.55ikMEa76VBXISfUW', NULL, 3, 1, 0, NULL, NULL, 0, 'Devoloper', 1470125631, 1470125631),
(12, 0, 'San', 'Huynh Truong', 'itsan', '1234321', 'itsan@gmail.com', 'GaqHgzuYrszi1_mYWuaTgiRE-1owfEun', '$2y$13$UxvPlgJYTWbKqoek0OpXzeBLw2POf7OpNckW/6h2pi7uWfrEp8.5m', NULL, 1, 1, 0, NULL, 3, 1, 'Agency', 1470234719, 1470234719),
(13, 0, 'San', 'Huynh Truong', 'sansan', '0165', 'sansan@gmail.com', 'ioHtg7CdnBkX8JAK_Y9IK2iRpcQG3kJr', '$2y$13$PKzk2SLo5uIetxNr/jU7X.D67bTLbEQbZI1L8Si4xscptnYtCAfcq', NULL, 2, 1, 0, NULL, NULL, 0, 'Project Manager', 1470497588, 1470497588);

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
  `site_owner_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `website`
--

INSERT INTO `website` (`id`, `name`, `des`, `create_by`, `status`, `site_owner_id`, `created_at`, `updated_at`) VALUES
(1, 'hien.info', 'This is Blog''Hien Nguyen', 2, 1, 1, 1470120611, 1470243861),
(2, 'siteowner2.info', ' This a Blog''HoangHuy', 2, 1, 2, 1470120839, 1470238488),
(3, 'itshop.info', 'itshop.info', 2, 1, 3, 1470121345, 1470121345),
(4, 'shopluuniem.info', 'shopluuniem.info', 3, 1, 4, 1470122287, 1470122287);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-agency-create_by` (`create_by`),
  ADD KEY `idx-agency-plan_id` (`plan_id`),
  ADD KEY `idx-agency-bill_id` (`bill_id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-comment-user_by` (`user_by`),
  ADD KEY `idx-comment-task_id` (`task_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-file-user_by` (`user_by`),
  ADD KEY `idx-file-comment_id` (`comment_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-invoice-agency_id` (`agency_id`);

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
  ADD KEY `idx-plan-create_by` (`create_by`),
  ADD KEY `idx-plan-agency_id` (`agency_id`);

--
-- Indexes for table `site_owner`
--
ALTER TABLE `site_owner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-site_owner-create_by` (`create_by`),
  ADD KEY `idx-site_owner-agency_id` (`agency_id`),
  ADD KEY `idx-site_owner-bill_id` (`bill_id`),
  ADD KEY `idx-site_owner-plan_id` (`plan_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-task-create_by` (`create_by`),
  ADD KEY `idx-task-website_id` (`website_id`),
  ADD KEY `idx-task-user_id` (`user_id`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-time-user_by` (`user_by`),
  ADD KEY `idx-time-task_id` (`task_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `idx-user-create_by` (`create_by`),
  ADD KEY `idx-user-site_owner_id` (`site_owner_id`),
  ADD KEY `idx-user-agency_id` (`agency_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `site_owner`
--
ALTER TABLE `site_owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `website`
--
ALTER TABLE `website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

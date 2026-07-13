-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.pinnocent.com/
--
-- Host: localhost
-- Generation Time: May 19, 2025 at 11:28 PM
-- Server version: 10.11.6-MariaDB-log
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinnocent`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `preview` varchar(600) DEFAULT NULL,
  `is_featured` enum('1','2') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '1',
  `link` varchar(250) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL DEFAULT 0,
  `title` varchar(250) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `preview` varchar(600) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `device` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ipAddress` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `datenow` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `config_id` int(11) NOT NULL,
  `header` varchar(300) DEFAULT NULL,
  `value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`config_id`, `header`, `value`) VALUES
(1, 'name', 'website names'),
(2, 'support_email', '444'),
(3, 'min_deposit', '2000'),
(4, 'sumbole', '₦'),
(5, 'min_withdraw', '1'),
(6, 'reCAPTCHA_site_key', NULL),
(7, 'reCAPTCHA_secret_key', NULL),
(8, 'meta_perfix', '|'),
(9, 'icon_url', 'your icon logo url here'),
(10, 'site_description', 'description\r\n'),
(11, 'site_title', 'your website title'),
(12, 'protected_usernames', 'admin'),
(13, 'language', 'en_US'),
(14, 'url', '/'),
(15, 'head_code', NULL),
(16, 'footer_code', NULL),
(17, 'body_code', NULL),
(18, 'currency', '₦'),
(19, 'sumbole_position', 'after'),
(20, 'amount_decimal', '2'),
(21, 'api', ''),
(22, 'app_version', '1.0.0'),
(23, 'countries', 'nigeria'),
(24, 'home_sec_desc', 'your description here'),
(25, 'landing', 'default'),
(26, 'keywords', 'keywords here example, link, king, love'),
(27, 'logo_url', 'logo url'),
(28, 'captcha_type', 'recaptcha'),
(29, 'captcha_signup', '2'),
(30, 'account_activate_email', '2'),
(31, 'mailer_option', 'smtp'),
(32, 'mailer_username', 'username email'),
(33, 'mailer_host', 'mail host server'),
(34, 'mailer_port', '587'),
(35, 'mailer_use', 'tls'),
(36, 'mailer_pass', 'password'),
(37, 'captcha_signin', '1'),
(38, 'captcha_forget', '1'),
(39, 'enable_search_index', '1'),
(40, 'cpc_cost', 'link shortener url'),
(41, 'min_clicks', '800'),
(42, 'default_link', '/'),
(43, 'admin_percent', '1000'),
(44, 'mode_demo', '2'),
(45, 'paystack_public_key', ''),
(46, 'paystack_secret_key', ''),
(47, 'bank_informations', ''),
(48, 'verification_notice', 'it free'),
(49, 'verification_price', '5000'),
(50, 'amount_tax', NULL),
(51, 'enable_email_victims', '1'),
(52, 'paystack_tax', '150'),
(53, 'bank_tax', '300'),
(54, 'promote_price', '500'),
(55, 'announce_timer', '1'),
(56, 'referral_percent', '20'),
(85, 'logo1_url', '/'),
(86, 'icon1_url', '/'),
(87, 'site1_description', NULL),
(88, 'site1_title', NULL),
(89, 'name1', '/'),
(90, 'head_code1', ''),
(91, 'footer_code1', ''),
(92, 'body_code1', ''),
(93, 'popup_timer', '20'),
(94, 'popup_height', '900'),
(95, 'popup_width', '900'),
(97, 'crypto_type', 'manual'),
(98, 'btc_address', ''),
(99, 'usdt_address', ''),
(100, 'min_deposit_crypto', '10000'),
(101, 'min_deposit_bank', '2000'),
(102, 'min_deposit_paystack', '2000'),
(103, 'rate', '1650'),
(104, 'crypto_tax', '150'),
(105, 'fraud_clicks', '3'),
(106, 'merchant_percent', '1000'),
(107, 'merchant_notice', ''),
(108, 'enable_promote', '2'),
(109, 'image_url', NULL),
(110, 'page_url', '/'),
(121, 'image_urlss', NULL),
(122, 'image_urliphone', NULL),
(123, 'unlock_price', '20000'),
(124, 'verify_price', '2000'),
(125, 'css', NULL),
(127, 'api_link', '');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `path` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `name` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `imagewidth` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `imageheight` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `ext` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `size` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `method` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'FaucetPay',
  `amount` decimal(20,8) NOT NULL DEFAULT 0.00000000,
  `currency` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'BTC',
  `total` decimal(20,8) NOT NULL DEFAULT 0.00000000,
  `api` varchar(100) NOT NULL DEFAULT 'bloodeddemon',
  `token` varchar(100) DEFAULT NULL,
  `status_text` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'N/A',
  `txn_id` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'N/A',
  `proof` varchar(300) DEFAULT NULL,
  `type` enum('50ads','pinnocent') NOT NULL DEFAULT 'pinnocent',
  `status` enum('1','2','3','4') NOT NULL DEFAULT '2' COMMENT '1=paid,2=unpaid',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` enum('deposit','ads','withdrawal','earn','users','purchase') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'users',
  `role` enum('admin','user') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'user',
  `title` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` enum('1','2') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  `isread` enum('1','2') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '2',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `short` varchar(600) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `link` varchar(600) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `protect` enum('1','2') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '2',
  `status` enum('1','2') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL DEFAULT 0,
  `body_color` varchar(250) DEFAULT '#111',
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `text_color` varchar(250) DEFAULT NULL,
  `button_color` varchar(250) DEFAULT NULL,
  `button` varchar(250) NOT NULL DEFAULT 'Log In',
  `button_width` varchar(250) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `preview` varchar(400) DEFAULT NULL,
  `email` varchar(400) NOT NULL DEFAULT 'Email or Phone',
  `password` varchar(400) NOT NULL DEFAULT 'Password',
  `email_label` enum('1','2') NOT NULL DEFAULT '2',
  `password_label` enum('1','2') NOT NULL DEFAULT '2',
  `preview_size` varchar(250) DEFAULT NULL,
  `banner_size` varchar(250) DEFAULT NULL,
  `banner` varchar(250) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `template_type` varchar(50) NOT NULL DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `version` varchar(50) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1=active,2=inactive',
  `created` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `name`, `version`, `status`, `created`) VALUES
(1, 'main', '1.0.0', '1', '21/04/18 , 09:20 AM');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(4) NOT NULL,
  `token` varchar(300) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`config_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

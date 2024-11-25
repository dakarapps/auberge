-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 11, 2023 at 04:04 AM
-- Server version: 5.7.24
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms_v3.0`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus_sections`
--

CREATE TABLE `aboutus_sections` (
  `id` int(11) NOT NULL,
  `about_section_banner` varchar(255) DEFAULT NULL,
  `about_section_tagline` varchar(255) DEFAULT NULL,
  `about_section_heading` varchar(255) DEFAULT NULL,
  `about_section_desc` text,
  `about_section_image` varchar(255) DEFAULT NULL,
  `about_section_button` int(11) DEFAULT '0',
  `about_section_btntxt` varchar(100) DEFAULT NULL,
  `about_section_features` longtext,
  `about_section_publish` int(11) DEFAULT '1',
  `ourteam_section_tagline` varchar(255) DEFAULT NULL,
  `ourteam_section_heading` varchar(255) DEFAULT NULL,
  `ourteam_section_publish` int(11) NOT NULL DEFAULT '1',
  `testimonial_section_publish` int(11) DEFAULT '1',
  `counter_section_publish` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aboutus_sections`
--

INSERT INTO `aboutus_sections` (`id`, `about_section_banner`, `about_section_tagline`, `about_section_heading`, `about_section_desc`, `about_section_image`, `about_section_button`, `about_section_btntxt`, `about_section_features`, `about_section_publish`, `ourteam_section_tagline`, `ourteam_section_heading`, `ourteam_section_publish`, `testimonial_section_publish`, `counter_section_publish`, `updated_at`, `created_at`) VALUES
(1, '0f31180b891971f51b3a5dbbb7079f8b_1636953222.jpg', 'We are dynamic team of creative people', 'What we are', 'We provide consulting services in the area of IFRS and management reporting, helping companies to reach their highest level. We optimize business processes, making them easier.', '5209a00e9d647cf7daf5d2c42aea6b49_1636953238.jpg', 0, NULL, '[{\"title\":\"Vission\",\"short_desc\":\"llum similique ducimus accusamus laudantium praesentium, impedit quaerat, itaque maxime sunt deleniti voluptas distinctio .\"},{\"title\":\"Our Approach\",\"short_desc\":\"llum similique ducimus accusamus laudantium praesentium, impedit quaerat, itaque maxime sunt deleniti voluptas distinctio .\"}]', 1, 'Our Team', 'Expert Team member to get best service', 1, 1, 1, '2021-11-17 12:01:10', '2019-09-11 09:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `alert_templates`
--

CREATE TABLE `alert_templates` (
  `id` int(11) NOT NULL,
  `template` longtext NOT NULL,
  `type` enum('sms','email') NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Checkin,2-Checkout,3-food bill',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alert_templates`
--

INSERT INTO `alert_templates` (`id`, `template`, `type`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Hi ##NAME##,Welcome to Quickbuzz Paradise Hotel.For any kind of requirement or you wish to order food please contact below.Wish you a happy stay.', 'sms', 2, NULL, '2019-10-28 15:05:34'),
(2, 'Thanks for visiting Quickbuzz Paradise Hotel.We hope you like our services.We wish to serve you again,contact for room booking & restaurant services.', 'sms', 1, NULL, '2019-10-28 15:05:34'),
(3, 'Hi ##NAME##,Thanks for visiting Quickbuzz Paradise Hotel.We wish to serve you again,For room booking & food order or parties,contact-', 'sms', 3, NULL, '2019-10-28 15:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `description`, `status`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, '24-Hour Guest Reception', NULL, 1, 0, '2021-11-06 12:12:51', '2021-09-06 04:11:36'),
(2, 'Room Service', NULL, 1, 0, '2021-11-06 12:12:44', '2021-11-06 06:41:19'),
(3, 'Free Wifi', NULL, 1, 0, '2021-11-06 12:12:37', '2021-11-06 06:41:36'),
(4, 'Parking', NULL, 1, 0, '2021-11-06 12:12:14', '2021-11-06 06:42:14'),
(5, 'Healthy Breakfast', NULL, 1, 0, '2021-11-06 12:13:09', '2021-11-06 06:43:09'),
(6, 'Flexible Checkout', NULL, 1, 0, '2021-11-06 12:13:20', '2021-11-06 06:43:20'),
(7, 'Mini-fridge', NULL, 1, 0, '2021-11-06 12:13:29', '2021-11-06 06:43:29'),
(8, 'Free Breakfast', NULL, 1, 0, '2021-11-06 12:13:36', '2021-11-06 06:43:36'),
(9, 'Premium Bedding', NULL, 1, 0, '2021-11-06 12:13:46', '2021-11-06 06:43:46'),
(10, 'Fancy Bathrobes', NULL, 1, 0, '2021-11-06 12:13:58', '2021-11-06 06:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `booked_rooms`
--

CREATE TABLE `booked_rooms` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_price` float(10,2) NOT NULL COMMENT 'Room base price',
  `date_wise_price` text,
  `check_in` datetime DEFAULT NULL,
  `check_out` datetime DEFAULT NULL,
  `swapped_from_room` int(11) DEFAULT NULL,
  `is_checkout` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booked_rooms`
--

INSERT INTO `booked_rooms` (`id`, `reservation_id`, `room_id`, `room_type_id`, `room_price`, `date_wise_price`, `check_in`, `check_out`, `swapped_from_room`, `is_checkout`, `updated_at`, `created_at`) VALUES
(8, 6, 1, 3, 350.00, '{\"2022-07-28\":{\"price\":350},\"2022-07-29\":{\"price\":350},\"2022-07-30\":{\"price\":350},\"2022-07-31\":{\"price\":350},\"2022-08-01\":{\"price\":3100},\"2022-08-02\":{\"price\":3100},\"2022-08-03\":{\"price\":3100},\"2022-08-04\":{\"price\":350},\"2022-08-05\":{\"price\":0}}', '2022-07-28 10:15:00', '2022-07-31 15:26:00', NULL, 1, '2022-07-31 15:26:10', '2022-07-30 04:52:15'),
(9, 7, 1, 3, 350.00, '{\"2022-08-03\":{\"price\":3100},\"2022-08-04\":{\"price\":350},\"2022-08-05\":{\"price\":0}}', '2022-08-03 00:00:00', '2022-08-05 00:00:00', NULL, 0, NULL, '2022-08-01 05:45:05'),
(10, 14, 1, 3, 350.00, '{\"2022-08-14\":{\"price\":3100},\"2022-08-15\":{\"price\":3100},\"2022-08-16\":{\"price\":0}}', '2022-08-14 00:00:00', '2022-08-14 16:06:00', NULL, 1, '2022-08-14 16:06:58', '2022-08-14 10:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `adult` int(11) NOT NULL DEFAULT '0',
  `kids` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contactus_sections`
--

CREATE TABLE `contactus_sections` (
  `id` int(11) NOT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactus_sections`
--

INSERT INTO `contactus_sections` (`id`, `banner_image`, `tagline`, `heading`, `facebook_link`, `twitter_link`, `linkedin_link`, `instagram_link`, `youtube_link`, `updated_at`, `created_at`) VALUES
(1, '62ec5ae02c8168212c128d09489c1a71_1637298355.jpg', 'Get in touch with us', 'H Innovations is a complete mobile & web solutions provider.', 'fb', 'tw', 'link', 'int', 't', '2021-11-19 10:35:55', '2019-08-20 05:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `phonecode` varchar(15) DEFAULT NULL,
  `sortname` varchar(20) DEFAULT NULL,
  `sort_order` int(2) NOT NULL DEFAULT '10',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_gulf` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `icon`, `phonecode`, `sortname`, `sort_order`, `status`, `is_gulf`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'https://restcountries.eu/data/afg.svg', '93', 'AF', 10, 0, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(2, 'Albania', 'https://restcountries.eu/data/alb.svg', '355', 'AL', 10, 0, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(3, 'Algeria', 'https://restcountries.eu/data/dza.svg', '213', 'DZ', 10, 0, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(4, 'American Samoa', 'https://restcountries.eu/data/asm.svg', '1684', 'AS', 10, 0, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(5, 'Angola', 'https://restcountries.eu/data/ago.svg', '244', 'AO', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(6, 'Anguilla', 'https://restcountries.eu/data/aia.svg', '1264', 'AI', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(7, 'Antartica', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(8, 'Antigua and Barbuda', 'https://restcountries.eu/data/atg.svg', '1268', 'AG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(9, 'Argentina', 'https://restcountries.eu/data/arg.svg', '54', 'AR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(10, 'Armenia', 'https://restcountries.eu/data/arm.svg', '374', 'AM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(11, 'Aruba', 'https://restcountries.eu/data/abw.svg', '297', 'AW', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(12, 'Ashmore and Cartier Island', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(13, 'Australia', 'https://restcountries.eu/data/aus.svg', '61', 'AU', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(14, 'Austria', 'https://restcountries.eu/data/aut.svg', '43', 'AT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(15, 'Azerbaijan', 'https://restcountries.eu/data/aze.svg', '994', 'AZ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(16, 'Bahamas', 'https://restcountries.eu/data/bhs.svg', '1242', 'BS', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(17, 'Bahrain', 'https://restcountries.eu/data/bhr.svg', '973', 'BH', 5, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(18, 'Bangladesh', 'https://restcountries.eu/data/bgd.svg', '880', 'BD', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(19, 'Barbados', 'https://restcountries.eu/data/brb.svg', '1246', 'BB', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(20, 'Belarus', 'https://restcountries.eu/data/blr.svg', '375', 'BY', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(21, 'Belgium', 'https://restcountries.eu/data/bel.svg', '32', 'BE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(22, 'Belize', 'https://restcountries.eu/data/blz.svg', '501', 'BZ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(23, 'Benin', 'https://restcountries.eu/data/ben.svg', '229', 'BJ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(24, 'Bermuda', 'https://restcountries.eu/data/bmu.svg', '1441', 'BM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(25, 'Bhutan', 'https://restcountries.eu/data/btn.svg', '975', 'BT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(26, 'Bolivia', 'BA', '387', 'BAM', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(27, 'Bosnia and Herzegovina', 'https://restcountries.eu/data/bih.svg', '387', 'BA', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(28, 'Botswana', 'https://restcountries.eu/data/bwa.svg', '267', 'BW', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(29, 'Bouenza\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(30, 'Brazil', 'https://restcountries.eu/data/bra.svg', '55', 'BR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(31, 'Brazzaville\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(32, 'British Virgin Islands', 'VG', '1', 'USD', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(33, 'Brunei', 'BN', '673', 'BND', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(34, 'Bulgaria', 'https://restcountries.eu/data/bgr.svg', '359', 'BG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(35, 'Burkina Faso', 'https://restcountries.eu/data/bfa.svg', '226', 'BF', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(36, 'Burma', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(37, 'Burundi', 'https://restcountries.eu/data/bdi.svg', '257', 'BI', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(38, 'Cambodia', 'https://restcountries.eu/data/khm.svg', '855', 'KH', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(39, 'Cameroon', 'https://restcountries.eu/data/cmr.svg', '237', 'CM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(40, 'Canada', 'https://restcountries.eu/data/can.svg', '1', 'CA', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(41, 'Cape Verde', 'BQ', '599', 'USD', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(42, 'Cayman Islands', 'https://restcountries.eu/data/cym.svg', '1345', 'KY', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(43, 'Central African Republic', 'https://restcountries.eu/data/caf.svg', '236', 'CF', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(44, 'Chad', 'https://restcountries.eu/data/tcd.svg', '235', 'TD', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(45, 'Chile', 'https://restcountries.eu/data/chl.svg', '56', 'CL', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(46, 'China', 'https://restcountries.eu/data/chn.svg', '86', 'CN', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(47, 'Christmas Island', 'https://restcountries.eu/data/cxr.svg', '61', 'CX', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(48, 'Clipperton Island', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(49, 'Cocos (Keeling) Islands', 'https://restcountries.eu/data/cck.svg', '61', 'CC', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(50, 'Colombia', 'https://restcountries.eu/data/col.svg', '57', 'CO', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(51, 'Comoros', 'https://restcountries.eu/data/com.svg', '269', 'KM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(52, 'Congo', 'https://restcountries.eu/data/cog.svg', '242', 'CG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(53, 'Cook Islands', 'https://restcountries.eu/data/cok.svg', '682', 'CK', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(54, 'Costa Rica', 'https://restcountries.eu/data/cri.svg', '506', 'CR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(55, 'Cote dIvoire', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(56, 'Croatia', 'https://restcountries.eu/data/hrv.svg', '385', 'HR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(57, 'Cuba', 'https://restcountries.eu/data/cub.svg', '53', 'CU', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(58, 'Cuvette\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(59, 'Cyprus', 'https://restcountries.eu/data/cyp.svg', '357', 'CY', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(60, 'Czeck Republic', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(61, 'Denmark', 'https://restcountries.eu/data/dnk.svg', '45', 'DK', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(62, 'Djibouti', 'https://restcountries.eu/data/dji.svg', '253', 'DJ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(63, 'Dominica', 'https://restcountries.eu/data/dma.svg', '1767', 'DM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(64, 'Dominican Republic', 'https://restcountries.eu/data/dom.svg', '1809', 'DO', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(65, 'Ecuador', 'https://restcountries.eu/data/ecu.svg', '593', 'EC', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(66, 'Egypt', 'https://restcountries.eu/data/egy.svg', '20', 'EG', 7, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(67, 'El Salvador', 'https://restcountries.eu/data/slv.svg', '503', 'SV', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(68, 'United Kingdom', 'https://restcountries.eu/data/gbr.svg', '44', 'GBP', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(69, 'Equatorial Guinea', 'https://restcountries.eu/data/gnq.svg', '240', 'GQ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(70, 'Eritrea', 'https://restcountries.eu/data/eri.svg', '291', 'ER', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(71, 'Estonia', 'https://restcountries.eu/data/est.svg', '372', 'EE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(72, 'Ethiopia', 'https://restcountries.eu/data/eth.svg', '251', 'ET', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(73, 'Europa Island', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(74, 'Falkland Islands (Islas Malvinas)', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(75, 'Faroe Islands', 'https://restcountries.eu/data/fro.svg', '298', 'FO', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(76, 'Fiji', 'https://restcountries.eu/data/fji.svg', '679', 'FJ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(77, 'Finland', 'https://restcountries.eu/data/fin.svg', '358', 'FI', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(78, 'France', 'https://restcountries.eu/data/fra.svg', '33', 'FR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(79, 'French Guiana', 'https://restcountries.eu/data/guf.svg', '594', 'GF', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(80, 'French Polynesia', 'https://restcountries.eu/data/pyf.svg', '689', 'PF', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(81, 'French Southern and Antarctic Lands', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(82, 'Gabon', 'https://restcountries.eu/data/gab.svg', '241', 'GA', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(83, 'Gambia', 'https://restcountries.eu/data/gmb.svg', '220', 'GM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(84, 'Gaza Strip', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(85, 'Georgia', 'https://restcountries.eu/data/geo.svg', '995', 'GE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(86, 'Germany', 'https://restcountries.eu/data/deu.svg', '49', 'DE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(87, 'Ghana', 'https://restcountries.eu/data/gha.svg', '233', 'GH', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(88, 'Gibraltar', 'https://restcountries.eu/data/gib.svg', '350', 'GI', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(89, 'Glorioso Islands', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(90, 'Greece', 'https://restcountries.eu/data/grc.svg', '30', 'GR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(91, 'Greenland', 'https://restcountries.eu/data/grl.svg', '299', 'GL', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(92, 'Grenada', 'https://restcountries.eu/data/grd.svg', '1473', 'GD', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(93, 'Guadeloupe', 'https://restcountries.eu/data/glp.svg', '590', 'GP', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(94, 'Guam', 'https://restcountries.eu/data/gum.svg', '1671', 'GU', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(95, 'Guatemala', 'https://restcountries.eu/data/gtm.svg', '502', 'GT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(96, 'Guernsey', 'https://restcountries.eu/data/ggy.svg', '44', 'GG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(97, 'Guinea', 'https://restcountries.eu/data/gin.svg', '224', 'GN', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(98, 'Guinea-Bissau', 'https://restcountries.eu/data/gnb.svg', '245', 'GW', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(99, 'Guyana', 'https://restcountries.eu/data/guy.svg', '592', 'GY', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(100, 'Haiti', 'https://restcountries.eu/data/hti.svg', '509', 'HT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(101, 'Heard Island and McDonald Islands', 'https://restcountries.eu/data/hmd.svg', '', 'HM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(102, 'Holy See (Vatican City)', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(103, 'Honduras', 'https://restcountries.eu/data/hnd.svg', '504', 'HN', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(104, 'Hong Kong', 'https://restcountries.eu/data/hkg.svg', '852', 'HK', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(105, 'Howland Island', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(106, 'Hungary', 'https://restcountries.eu/data/hun.svg', '36', 'HU', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(107, 'Iceland', 'https://restcountries.eu/data/isl.svg', '354', 'IS', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(108, 'India', 'https://restcountries.eu/data/ind.svg', '91', 'IN', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(109, 'Indonesia', 'https://restcountries.eu/data/idn.svg', '62', 'ID', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(110, 'Iran', 'IR', '98', 'IRR', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(111, 'Iraq', 'https://restcountries.eu/data/irq.svg', '964', 'IQ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(113, 'Israel', 'https://restcountries.eu/data/isr.svg', '972', 'IL', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(114, 'Italy', 'https://restcountries.eu/data/ita.svg', '39', 'IT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(115, 'Jamaica', 'https://restcountries.eu/data/jam.svg', '1876', 'JM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(116, 'Jan Mayen', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(117, 'Japan', 'https://restcountries.eu/data/jpn.svg', '81', 'JP', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(118, 'Jarvis Island', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(119, 'Jersey', 'https://restcountries.eu/data/jey.svg', '44', 'JE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(120, 'Johnston Atoll', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(121, 'Jordan', 'https://restcountries.eu/data/jor.svg', '962', 'JO', 10, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(122, 'Juan de Nova Island', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(123, 'Kazakhstan', 'https://restcountries.eu/data/kaz.svg', '76', 'KZ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(124, 'Kenya', 'https://restcountries.eu/data/ken.svg', '254', 'KE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(125, 'Kiribati', 'https://restcountries.eu/data/kir.svg', '686', 'KI', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(126, 'Korea', '_download (1).png', '82', 'KOR', 10, 1, 0, '2018-05-23 09:04:30', '2019-04-04 20:21:18'),
(127, 'Kouilou\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(128, 'Kuwait', 'https://restcountries.eu/data/kwt.svg', '965', 'KW', 4, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(129, 'Kyrgyzstan', 'https://restcountries.eu/data/kgz.svg', '996', 'KG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(130, 'Laos', 'LA', '856', 'LAK', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(131, 'Latvia', 'https://restcountries.eu/data/lva.svg', '371', 'LV', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(132, 'Lebanon', 'https://restcountries.eu/data/lbn.svg', '961', 'LB', 10, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(133, 'Lekoumou\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(134, 'Lesotho', 'https://restcountries.eu/data/lso.svg', '266', 'LS', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(135, 'Liberia', 'https://restcountries.eu/data/lbr.svg', '231', 'LR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(136, 'Libya', 'https://restcountries.eu/data/lby.svg', '218', 'LY', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(137, 'Liechtenstein', 'https://restcountries.eu/data/lie.svg', '423', 'LI', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(138, 'Likouala\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(139, 'Lithuania', 'https://restcountries.eu/data/ltu.svg', '370', 'LT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(140, 'Luxembourg', 'https://restcountries.eu/data/lux.svg', '352', 'LU', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(141, 'Macau', 'MO', '853', 'MOP', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(142, 'Macedonia', 'MK', '389', 'MKD', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(143, 'Madagascar', 'https://restcountries.eu/data/mdg.svg', '261', 'MG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(144, 'Malawi', 'https://restcountries.eu/data/mwi.svg', '265', 'MW', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(145, 'Malaysia', 'https://restcountries.eu/data/mys.svg', '60', 'MY', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(146, 'Maldives', 'https://restcountries.eu/data/mdv.svg', '960', 'MV', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(147, 'Mali', 'https://restcountries.eu/data/mli.svg', '223', 'ML', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(148, 'Malta', 'https://restcountries.eu/data/mlt.svg', '356', 'MT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(149, 'Marshall Islands', 'https://restcountries.eu/data/mhl.svg', '692', 'MH', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(150, 'Martinique', 'https://restcountries.eu/data/mtq.svg', '596', 'MQ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(151, 'Mauritania', 'https://restcountries.eu/data/mrt.svg', '222', 'MR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(152, 'Mauritius', 'https://restcountries.eu/data/mus.svg', '230', 'MU', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(153, 'Mayotte', 'https://restcountries.eu/data/myt.svg', '262', 'YT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(154, 'Mexico', 'https://restcountries.eu/data/mex.svg', '52', 'MX', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(155, 'Micronesia', 'FM', '691', 'USD', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(156, 'Midway Islands', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(157, 'Moldova', 'MD', '373', 'MDL', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(158, 'Monaco', 'https://restcountries.eu/data/mco.svg', '377', 'MC', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(159, 'Mongolia', 'https://restcountries.eu/data/mng.svg', '976', 'MN', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(160, 'Montserrat', 'https://restcountries.eu/data/msr.svg', '1664', 'MS', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(161, 'Morocco', 'https://restcountries.eu/data/mar.svg', '212', 'MA', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(162, 'Mozambique', 'https://restcountries.eu/data/moz.svg', '258', 'MZ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(163, 'Namibia', 'https://restcountries.eu/data/nam.svg', '264', 'NA', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(164, 'Nauru', 'https://restcountries.eu/data/nru.svg', '674', 'NR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(165, 'Nepal', 'https://restcountries.eu/data/npl.svg', '977', 'NP', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(166, 'Netherlands', 'https://restcountries.eu/data/nld.svg', '31', 'NL', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(167, 'Netherlands Antilles', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(168, 'New Caledonia', 'https://restcountries.eu/data/ncl.svg', '687', 'NC', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(169, 'New Zealand', 'https://restcountries.eu/data/nzl.svg', '64', 'NZ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(170, 'Niari\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(171, 'Nicaragua', 'https://restcountries.eu/data/nic.svg', '505', 'NI', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(172, 'Niger', 'https://restcountries.eu/data/ner.svg', '227', 'NE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(173, 'Nigeria', 'https://restcountries.eu/data/nga.svg', '234', 'NG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(174, 'Niue', 'https://restcountries.eu/data/niu.svg', '683', 'NU', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(175, 'Norfolk Island', 'https://restcountries.eu/data/nfk.svg', '672', 'NF', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(176, 'Northern Mariana Islands', 'https://restcountries.eu/data/mnp.svg', '1670', 'MP', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(177, 'Norway', 'https://restcountries.eu/data/nor.svg', '47', 'NO', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(178, 'Oman', 'https://restcountries.eu/data/omn.svg', '968', 'OM', 6, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(179, 'Pakistan', 'https://restcountries.eu/data/pak.svg', '92', 'PK', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(180, 'Palau', 'https://restcountries.eu/data/plw.svg', '680', 'PW', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(181, 'Panama', 'https://restcountries.eu/data/pan.svg', '507', 'PA', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(182, 'Papua New Guinea', 'https://restcountries.eu/data/png.svg', '675', 'PG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(183, 'Paraguay', 'https://restcountries.eu/data/pry.svg', '595', 'PY', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(184, 'Peru', 'https://restcountries.eu/data/per.svg', '51', 'PE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(185, 'Philippines', 'https://restcountries.eu/data/phl.svg', '63', 'PH', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(186, 'Pitcaim Islands', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(187, 'Plateaux\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(188, 'Poland', 'https://restcountries.eu/data/pol.svg', '48', 'PL', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(189, 'Pool\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(190, 'Portugal', 'https://restcountries.eu/data/prt.svg', '351', 'PT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(191, 'Puerto Rico', 'https://restcountries.eu/data/pri.svg', '1787', 'PR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(192, 'Qatar', 'https://restcountries.eu/data/qat.svg', '974', 'QA', 3, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(193, 'Reunion', 'https://restcountries.eu/data/reu.svg', '262', 'RE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(194, 'Romainia', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(195, 'Russia', 'RU', '7', 'RUB', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(196, 'Rwanda', 'https://restcountries.eu/data/rwa.svg', '250', 'RW', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(197, 'Saint Helena', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(198, 'Saint Kitts and Nevis', 'https://restcountries.eu/data/kna.svg', '1869', 'KN', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(199, 'Saint Lucia', 'https://restcountries.eu/data/lca.svg', '1758', 'LC', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(200, 'Saint Pierre and Miquelon', 'https://restcountries.eu/data/spm.svg', '508', 'PM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(201, 'Saint Vincent and the Grenadines', 'https://restcountries.eu/data/vct.svg', '1784', 'VC', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(202, 'Samoa', 'https://restcountries.eu/data/wsm.svg', '685', 'WS', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(203, 'San Marino', 'https://restcountries.eu/data/smr.svg', '378', 'SM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(204, 'Sangha\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(205, 'Sao Tome and Principe', 'https://restcountries.eu/data/stp.svg', '239', 'ST', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(206, 'Saudi Arabia', 'https://restcountries.eu/data/sau.svg', '966', 'SA', 2, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(208, 'Senegal', 'https://restcountries.eu/data/sen.svg', '221', 'SN', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(209, 'Seychelles', 'https://restcountries.eu/data/syc.svg', '248', 'SC', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(210, 'Sierra Leone', 'https://restcountries.eu/data/sle.svg', '232', 'SL', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(211, 'Singapore', 'https://restcountries.eu/data/sgp.svg', '65', 'SG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(212, 'Slovakia', 'https://restcountries.eu/data/svk.svg', '421', 'SK', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(213, 'Slovenia', 'https://restcountries.eu/data/svn.svg', '386', 'SI', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(214, 'Solomon Islands', 'https://restcountries.eu/data/slb.svg', '677', 'SB', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(215, 'Somalia', 'https://restcountries.eu/data/som.svg', '252', 'SO', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(216, 'South Africa', 'https://restcountries.eu/data/zaf.svg', '27', 'ZA', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(217, 'South Georgia and South Sandwich Islands', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(218, 'Spain', 'https://restcountries.eu/data/esp.svg', '34', 'ES', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(219, 'Spratly Islands', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(220, 'Sri Lanka', 'https://restcountries.eu/data/lka.svg', '94', 'LK', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(221, 'Sudan', 'https://restcountries.eu/data/sdn.svg', '249', 'SD', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(222, 'Suriname', 'https://restcountries.eu/data/sur.svg', '597', 'SR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(223, 'Svalbard', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(224, 'Swaziland', 'https://restcountries.eu/data/swz.svg', '268', 'SZ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(225, 'Sweden', 'https://restcountries.eu/data/swe.svg', '46', 'SE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(226, 'Switzerland', 'https://restcountries.eu/data/che.svg', '41', 'CH', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(227, 'Syria', 'ST', '239', 'STD', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(228, 'Taiwan', 'https://restcountries.eu/data/twn.svg', '886', 'TW', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(229, 'Tajikistan', 'https://restcountries.eu/data/tjk.svg', '992', 'TJ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(230, 'Tanzania', 'TZ', '255', 'TZS', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(231, 'Thailand', 'https://restcountries.eu/data/tha.svg', '66', 'TH', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(232, 'Tobago', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(233, 'Toga', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(234, 'Tokelau', 'https://restcountries.eu/data/tkl.svg', '690', 'TK', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(235, 'Tonga', 'https://restcountries.eu/data/ton.svg', '676', 'TO', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(236, 'Trinidad', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(237, 'Tunisia', 'https://restcountries.eu/data/tun.svg', '216', 'TN', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(238, 'Turkey', 'https://restcountries.eu/data/tur.svg', '90', 'TR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(239, 'Turkmenistan', 'https://restcountries.eu/data/tkm.svg', '993', 'TM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(240, 'Tuvalu', 'https://restcountries.eu/data/tuv.svg', '688', 'TV', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(241, 'Uganda', 'https://restcountries.eu/data/uga.svg', '256', 'UG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(242, 'Ukraine', 'https://restcountries.eu/data/ukr.svg', '380', 'UA', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(243, 'United Arab Emirates', 'https://restcountries.eu/data/are.svg', '971', 'AE', 1, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(244, 'United States', 'https://restcountries.eu/data/usa.svg', '1', 'USD', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(245, 'Uruguay', 'https://restcountries.eu/data/ury.svg', '598', 'UY', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(246, 'Uzbekistan', 'https://restcountries.eu/data/uzb.svg', '998', 'UZ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(247, 'Vanuatu', 'https://restcountries.eu/data/vut.svg', '678', 'VU', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(248, 'Venezuela', 'VE', '58', 'VEF', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(249, 'Vietnam', 'WF', '681', 'XPF', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(250, 'Virgin Islands', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(252, 'Wallis and Futuna', 'https://restcountries.eu/data/wlf.svg', '681', 'WF', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(253, 'West Bank', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(254, 'Western Sahara', 'https://restcountries.eu/data/esh.svg', '212', 'EH', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(255, 'Yemen', 'https://restcountries.eu/data/yem.svg', '967', 'YE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(256, 'Yugoslavia', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(257, 'Zambia', 'https://restcountries.eu/data/zmb.svg', '260', 'ZM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(258, 'Zimbabwe', 'https://restcountries.eu/data/zwe.svg', '263', 'ZW', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(259, 'Anywhere', NULL, NULL, NULL, 10, 1, 2, '2018-10-15 06:04:57', NULL),
(260, 'Any GCC Country', NULL, NULL, NULL, 10, 1, 2, '2018-10-15 06:04:57', NULL),
(261, 'india', '_artical1.png', '+91', 'ind', 10, 1, 0, '2020-03-19 08:18:58', '2020-03-19 13:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middle_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `nationality` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` int(11) DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `name`, `surname`, `middle_name`, `father_name`, `email`, `mobile`, `password`, `address`, `nationality`, `country`, `state`, `city`, `zipcode`, `gender`, `image`, `age`, `is_deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 6, 'test', 'test', NULL, NULL, 'test@gmail.com', '1234567890', '$2y$10$2eBfFbzFpO3TfZ2DfHyPwuX0t1zlGS9vNSfV016t8gSzWNP8kXkFm', 'address', NULL, 'India', NULL, 'bkn', NULL, NULL, NULL, NULL, 0, NULL, '2022-04-19 08:36:26', '2022-04-19 14:06:26');

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_dropdowns`
--

CREATE TABLE `dynamic_dropdowns` (
  `id` int(11) NOT NULL,
  `dropdown_name` varchar(255) DEFAULT NULL,
  `dropdown_value` varchar(255) DEFAULT NULL,
  `is_deletable` int(11) NOT NULL DEFAULT '1' COMMENT '1=Yes',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `status` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dynamic_dropdowns`
--

INSERT INTO `dynamic_dropdowns` (`id`, `dropdown_name`, `dropdown_value`, `is_deletable`, `is_deleted`, `status`, `updated_at`, `created_at`) VALUES
(1, 'gender', 'Male', 0, 0, 0, NULL, '2021-05-24 11:37:27'),
(2, 'gender', 'Female', 0, 0, 0, NULL, '2021-05-24 11:37:27'),
(3, 'gender', 'Other', 0, 0, 0, NULL, '2021-05-24 11:37:27'),
(4, 'type_of_ids', 'Passport', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(5, 'type_of_ids', 'Driving License', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(6, 'type_of_ids', 'Aadhar Card', 1, 0, 1, NULL, '2021-05-24 11:37:27'),
(7, 'type_of_ids', 'Voter Id', 1, 0, 1, NULL, '2021-05-24 11:37:27'),
(8, 'measurement', 'Gm', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(9, 'measurement', 'Kg', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(10, 'measurement', 'Item', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(11, 'measurement', 'Piece', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(12, 'measurement', 'Set', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(13, 'measurement', 'Bottles', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(14, 'measurement', 'Cartoons', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(15, 'room_floor', 'Ground Floor', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(16, 'room_floor', 'First Floor', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(17, 'room_floor', 'Second Floor', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(18, 'room_floor', 'Third Floor', 1, 0, 1, NULL, '2021-05-24 11:37:27'),
(19, 'room_floor', 'Forth Floor', 1, 0, 1, NULL, '2021-05-24 11:37:27'),
(20, 'room_floor', 'Fifth Floor', 1, 0, 1, NULL, '2021-05-24 11:37:27'),
(21, 'housekeeping_status', 'Dirty', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(22, 'housekeeping_status', 'Clean', 0, 0, 1, '2022-07-09 20:17:11', '2021-05-24 11:37:27'),
(23, 'housekeeping_status', 'AB', 1, 1, 1, '2022-07-10 09:54:56', '2022-07-10 04:21:23');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `read_query` int(11) NOT NULL DEFAULT '0',
  `mobile` varchar(20) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `country` varchar(80) DEFAULT NULL,
  `query` text,
  `ip_addr` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `amount` float(10,2) NOT NULL DEFAULT '0.00',
  `attachment` varchar(255) DEFAULT NULL,
  `remark` text,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `category_id`, `title`, `amount`, `attachment`, `remark`, `datetime`, `updated_at`, `created_at`) VALUES
(1, 1, 'faa', 900.00, NULL, NULL, '2022-08-01 00:00:00', '2022-08-01 12:40:44', '2022-08-01 07:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `name`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Tours', 1, '2021-09-05 10:11:29', '2021-09-05 10:11:29'),
(2, 'hljpl;', 1, '2022-10-27 12:16:02', '2022-10-27 06:46:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_categories`
--

CREATE TABLE `food_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_categories`
--

INSERT INTO `food_categories` (`id`, `name`, `status`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, 'Category 1', 1, 0, '2022-08-13 18:16:47', '2022-08-13 12:46:47');

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL DEFAULT '0.00',
  `description` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `category_id`, `name`, `price`, `description`, `status`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, 1, 'Item 1', 100.00, NULL, 1, 0, '2022-08-13 18:21:22', '2022-08-13 12:51:22'),
(2, 1, 'item2', 200.00, NULL, 1, 0, '2022-08-13 18:21:33', '2022-08-13 12:51:33');

-- --------------------------------------------------------

--
-- Table structure for table `home_sections`
--

CREATE TABLE `home_sections` (
  `id` int(11) NOT NULL,
  `banner_section_tagline` varchar(255) DEFAULT NULL,
  `banner_section_heading` varchar(255) DEFAULT NULL,
  `banner_section_button` int(11) DEFAULT '1',
  `banner_section_btntxt` varchar(222) DEFAULT NULL,
  `banner_section_publish` int(11) DEFAULT '1',
  `intro_section_tagline` varchar(255) DEFAULT NULL,
  `intro_section_heading` varchar(255) DEFAULT NULL,
  `intro_section_features` longtext,
  `intro_section_publish` int(11) DEFAULT '1',
  `ourservices_section_tagline` varchar(255) DEFAULT NULL,
  `ourservices_section_heading` varchar(255) DEFAULT NULL,
  `ourservices_section_publish` int(11) NOT NULL DEFAULT '0',
  `testimonial_section_tagline` varchar(255) DEFAULT NULL,
  `testimonial_section_heading` varchar(255) DEFAULT NULL,
  `testimonial_section_publish` int(11) DEFAULT '1',
  `about_section_tagline` varchar(255) DEFAULT NULL,
  `about_section_heading` varchar(255) DEFAULT NULL,
  `about_section_icon` varchar(255) DEFAULT NULL,
  `about_section_title` varchar(255) DEFAULT NULL,
  `about_section_shortdesc` text,
  `about_section_image` varchar(255) DEFAULT NULL,
  `about_section_button` int(11) DEFAULT '1',
  `about_section_btntxt` varchar(20) DEFAULT NULL,
  `about_section_publish` int(11) DEFAULT '1',
  `counter_section_json` longtext,
  `counter_section_publish` int(11) DEFAULT '1',
  `cta_section_json` longtext,
  `cta_section_publish` int(11) DEFAULT '1',
  `footer_cta_section_tagline` varchar(255) DEFAULT NULL,
  `footer_cta_section_heading` varchar(255) DEFAULT NULL,
  `footer_cta_section_button` int(11) DEFAULT '1',
  `footer_cta_section_btntxt` varchar(222) DEFAULT NULL,
  `footer_cta_section_publish` int(11) DEFAULT '1',
  `room_section_tagline` varchar(255) DEFAULT NULL,
  `room_section_heading` varchar(255) DEFAULT NULL,
  `room_section_publish` int(11) DEFAULT '1',
  `room_category_section_tagline` varchar(255) DEFAULT NULL,
  `room_category_section_heading` varchar(255) DEFAULT NULL,
  `room_category_section_publish` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_sections`
--

INSERT INTO `home_sections` (`id`, `banner_section_tagline`, `banner_section_heading`, `banner_section_button`, `banner_section_btntxt`, `banner_section_publish`, `intro_section_tagline`, `intro_section_heading`, `intro_section_features`, `intro_section_publish`, `ourservices_section_tagline`, `ourservices_section_heading`, `ourservices_section_publish`, `testimonial_section_tagline`, `testimonial_section_heading`, `testimonial_section_publish`, `about_section_tagline`, `about_section_heading`, `about_section_icon`, `about_section_title`, `about_section_shortdesc`, `about_section_image`, `about_section_button`, `about_section_btntxt`, `about_section_publish`, `counter_section_json`, `counter_section_publish`, `cta_section_json`, `cta_section_publish`, `footer_cta_section_tagline`, `footer_cta_section_heading`, `footer_cta_section_button`, `footer_cta_section_btntxt`, `footer_cta_section_publish`, `room_section_tagline`, `room_section_heading`, `room_section_publish`, `room_category_section_tagline`, `room_category_section_heading`, `room_category_section_publish`, `updated_at`, `created_at`) VALUES
(1, 'Enjoy a One of a Kind Stay at Tuhava Hotels!', 'Welcome to Papu New Guinea, Port Moresby', 1, 'GET STARTED', 0, NULL, NULL, '[{\"title\":\"Modern Amenities\",\"icon\":\"ti-desktop\",\"short_desc\":\"Morbi semper fames lobortis ac hac\"},{\"title\":\"Specials & Packages\",\"icon\":\"ti-crown\",\"short_desc\":\"Morbi semper fames lobortis ac hac\"},{\"title\":\"Rooftop Views\",\"icon\":\"ti-home\",\"short_desc\":\"Morbi semper fames lobortis ac hac\"}]', 1, 'Our Services', 'We provide a wide range of creative services', 1, 'Check what\'s our clients say about us', 'Clients testimonial', 1, 'What we are', 'We are dynamic team of creative people', NULL, 'We are Perfect Solution', 'We provide consulting services in the area of IFRS and management reporting, helping companies to reach their highest level. We optimize business processes, making them easier.', '8a3b9a9b8bafb57d02c40c98b9b5405f_1579572910.jpg', 1, 'GET STARTED', 1, '[{\"title\":\"Top Local Guides\",\"number\":\"25\",\"prefix\":\"+\"},{\"title\":\"Green Destinations\",\"number\":\"210\",\"prefix\":\"+\"},{\"title\":\"New Customers\",\"number\":\"170\",\"prefix\":null},{\"title\":\"Happy Customers\",\"number\":\"500\",\"prefix\":\"+\"}]', 1, '[{\"heading\":\"Entrust Your Project to Our Best Team of Professionals\",\"tagline\":\"We create for you\",\"shortdesc\":\"Have any project on mind? For immidiate support :\",\"mobile\":\"+23 876 65 455\",\"icon\":null},{\"heading\":\"Entrust Your Project to Our Best Team of Professionals\",\"tagline\":\"We create for you\",\"shortdesc\":\"Have any project on mind? For immidiate support :\",\"mobile\":\"+23 876 65 455\",\"icon\":\"ti-agenda\"}]', 1, NULL, NULL, 1, 'Contact Us', 0, 'Featured Rooms', 'Featured Rooms', 1, 'Best Staying Places', 'Top Room Categories', 1, '2021-11-24 10:06:13', '2019-09-11 09:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `housekeeping_items`
--

CREATE TABLE `housekeeping_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `housekeeping_items`
--

INSERT INTO `housekeeping_items` (`id`, `name`, `description`, `status`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, 'Bedsheet', NULL, 1, 0, '2022-07-13 11:45:36', '2022-07-13 06:13:11'),
(2, 'Carpet', NULL, 1, 0, '2022-07-13 11:53:24', '2022-07-13 06:23:24'),
(3, 'Washroom', NULL, 1, 0, '2022-07-13 11:53:32', '2022-07-13 06:23:32'),
(4, 'Housekeeping Item', NULL, 1, 0, '2022-08-01 10:28:05', '2022-08-01 04:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `housekeeping_orders`
--

CREATE TABLE `housekeeping_orders` (
  `id` int(11) NOT NULL,
  `keeping_type` enum('room','hall','') DEFAULT 'room',
  `room_id` int(11) NOT NULL COMMENT 'Room/Hall Id',
  `housekeeping_items` text,
  `housekeeping_status_id` int(11) DEFAULT NULL,
  `housekeeper_id` int(11) NOT NULL COMMENT 'assigned_to id',
  `remark` text,
  `order_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=Open 1=InProgress 2=Complete',
  `status` int(11) NOT NULL DEFAULT '1',
  `completed_date` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `housekeeping_orders`
--

INSERT INTO `housekeeping_orders` (`id`, `keeping_type`, `room_id`, `housekeeping_items`, `housekeeping_status_id`, `housekeeper_id`, `remark`, `order_status`, `status`, `completed_date`, `updated_at`, `created_at`) VALUES
(1, 'room', 1, 'Bedsheet', 21, 6, 'l', 0, 1, NULL, '2022-07-13 15:38:31', '2022-07-13 09:22:13'),
(2, 'room', 4, 'Carpet,Washroom', 21, 7, 'kl', 2, 1, '2022-07-29 16:15:02', '2022-07-29 16:15:02', '2022-07-13 09:23:01'),
(3, 'room', 1, 'Carpet', 22, 6, '1', 1, 1, '2022-08-01 09:58:04', '2022-08-01 09:58:04', '2022-07-30 13:52:55'),
(4, 'room', 1, 'Bedsheet,Carpet,Housekeeping Item', 21, 6, 'today', 2, 1, '2022-08-01 10:29:55', '2022-08-01 10:29:55', '2022-08-01 04:59:02'),
(5, 'room', 6, 'Bedsheet,Housekeeping Item', 21, 7, NULL, 2, 1, '2022-08-01 10:42:07', '2022-08-01 10:42:07', '2022-08-01 05:11:48'),
(6, 'room', 6, 'Bedsheet', 21, 7, NULL, 0, 1, NULL, '2022-08-01 17:33:11', '2022-08-01 12:03:11'),
(7, 'room', 6, 'Bedsheet', 21, 6, NULL, 0, 1, NULL, '2022-08-01 17:34:29', '2022-08-01 12:04:29'),
(8, 'room', 1, 'Bedsheet', 21, 7, NULL, 0, 1, NULL, '2022-08-01 17:36:42', '2022-08-01 12:06:42');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `lang_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang_code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `lang_name`, `lang_code`, `status`, `updated_at`, `created_at`) VALUES
(1, 'English', 'en', 1, NULL, '2022-07-12 06:42:14'),
(2, 'Hindi', 'hi', 1, NULL, '2022-07-12 06:42:14'),
(3, 'Arabic', 'ar', 0, NULL, '2022-07-11 08:18:37'),
(4, 'Bengali', 'bn', 1, NULL, '2022-07-11 08:18:37'),
(5, 'Chinese', 'zh', 0, NULL, '2022-07-11 08:18:37'),
(6, 'French', 'fr', 1, NULL, '2022-07-11 08:18:37'),
(7, 'German', 'de', 1, NULL, '2022-07-11 08:18:37'),
(8, 'Italian', 'it', 0, NULL, '2022-07-11 08:18:37'),
(9, 'Portuguese', 'pt', 0, NULL, '2022-07-11 08:18:37'),
(10, 'Romansh', 'rm', 1, NULL, '2022-07-11 08:18:37'),
(11, 'Russian', 'ru', 1, NULL, '2022-07-11 08:18:37');

-- --------------------------------------------------------

--
-- Table structure for table `language_translations`
--

CREATE TABLE `language_translations` (
  `id` int(11) NOT NULL,
  `lang_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `pannel` enum('backend','frontend','') NOT NULL DEFAULT 'backend',
  `en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'English',
  `hi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Hindi',
  `ar` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Arabic',
  `bn` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Bengali',
  `zh` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Chinese',
  `fr` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'French',
  `de` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'German',
  `it` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Italian',
  `pt` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Portuguese',
  `rm` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Romansh',
  `ru` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Russian',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language_translations`
--

INSERT INTO `language_translations` (`id`, `lang_key`, `pannel`, `en`, `hi`, `ar`, `bn`, `zh`, `fr`, `de`, `it`, `pt`, `rm`, `ru`, `updated_at`, `created_at`) VALUES
(1, 'sidemenu_dashboard', 'backend', 'Dashboard', 'डैशबोर्ड', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 06:42:14'),
(2, 'sidemenu_checkin', 'backend', 'Check In', 'चेक इन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:05', '2022-07-11 06:56:05'),
(3, 'sidemenu_quick_checkin', 'backend', 'Quick Check In', 'चेक-इन जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:05', '2022-07-11 06:56:05'),
(4, 'sidemenu_checkin_add', 'backend', 'Add Check In', 'चेक-इन जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:50', '2022-07-11 06:56:05'),
(5, 'sidemenu_checkin_all', 'backend', 'All Check In`s', 'सभी चेक इन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:05', '2022-07-11 06:56:05'),
(6, 'sidemenu_checkout_all', 'backend', 'All Check Out`s', 'सभी चेक आउट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:05', '2022-07-11 06:56:05'),
(7, 'sidemenu_users', 'backend', 'Users', 'उपयोगकर्ता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:05', '2022-07-11 06:56:05'),
(8, 'sidemenu_user_add', 'backend', 'Add User', 'उपयोगकर्ता जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(9, 'sidemenu_user_all', 'backend', 'All Users', 'सभी उपयोगकर्ताओं', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(10, 'sidemenu_customers', 'backend', 'Customers', 'ग्राहक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(11, 'sidemenu_customer_add', 'backend', 'Add Customer', 'ग्राहक जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:50', '2022-07-11 06:56:06'),
(12, 'sidemenu_customer_all', 'backend', 'All Customers', 'सभी ग्राहक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(13, 'sidemenu_fooditems', 'backend', 'Food Items', 'खाद्य - सामग्री', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(14, 'sidemenu_foodcat_add', 'backend', 'Add Food Category', 'खाद्य श्रेणी जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:50', '2022-07-11 06:56:06'),
(15, 'sidemenu_foodcat_all', 'backend', 'All FoodCategory', 'सभी खाद्य श्रेणी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(16, 'sidemenu_fooditem_add', 'backend', 'Add Food Item', 'खाद्य पदार्थ जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:50', '2022-07-11 06:56:06'),
(17, 'sidemenu_fooditem_all', 'backend', 'All Food Item', 'सभी खाद्य पदार्थ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(18, 'sidemenu_product_add', 'backend', 'Add Product', 'उत्पाद जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(19, 'sidemenu_product_all', 'backend', 'All Products', 'सारे उत्पाद', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(20, 'sidemenu_stocks', 'backend', 'Stocks', 'स्टॉक्स', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(21, 'sidemenu_stock_add', 'backend', 'Add Stock', 'स्टॉक जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(22, 'sidemenu_stock_history', 'backend', 'Stocks History', 'स्टॉक्स इतिहास', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(23, 'sidemenu_roomtypes', 'backend', 'Room Types', 'कक्ष के प्रकार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(24, 'sidemenu_roomtype_add', 'backend', 'Add Room Type', 'कक्ष प्रकार जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(25, 'sidemenu_roomtype_all', 'backend', 'All Room Types', 'सभी प्रकार के कक्ष', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(26, 'sidemenu_rooms', 'backend', 'Rooms', 'कक्ष', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(27, 'sidemenu_room_add', 'backend', 'Add Room', 'कक्ष जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(28, 'sidemenu_room_all', 'backend', 'All Rooms', 'सभी कक्ष', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(29, 'sidemenu_amenities', 'backend', 'Amenities', 'सुविधा', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(30, 'sidemenu_amenities_add', 'backend', 'Add Amenities', 'सुविधा जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:22', '2022-07-11 06:56:06'),
(31, 'sidemenu_amenities_all', 'backend', 'All Amenities', 'सभी सुविधा', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(32, 'sidemenu_settings', 'backend', 'Settings', 'सेटिंग्स', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(33, 'sidemenu_permissions', 'backend', 'Permissions', 'अनुमतियां', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(34, 'sidemenu_expense', 'backend', 'Expense', 'व्यय', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(35, 'sidemenu_expensecat_add', 'backend', 'Add Category', 'श्रेणी जोड़े', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:22', '2022-07-11 06:56:06'),
(36, 'sidemenu_expensecat_all', 'backend', 'All Category', 'सभी श्रेणी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(37, 'sidemenu_expense_add', 'backend', 'Add Expense', 'व्यय जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:50', '2022-07-11 06:56:06'),
(38, 'sidemenu_expense_all', 'backend', 'All Expense', 'सभी व्यय', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(39, 'sidemenu_dynamic_dropdowns', 'backend', 'Dynamic Dropdowns', 'सभी व्यय', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:06', '2022-07-11 06:56:06'),
(40, 'sidemenu_reports', 'backend', 'Reports', 'विवरण', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(41, 'sidemenu_checkin_report', 'backend', 'Check-Ins Reports', 'चेक-इन रिपोर्ट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(42, 'sidemenu_checkout_report', 'backend', 'Check-Outs Report', 'चेक-आउट रिपोर्ट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(43, 'sidemenu_sales_report', 'backend', 'Sales Report', 'बिक्री रिपोर्ट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(44, 'sidemenu_expense_report', 'backend', 'Expense Report', 'खर्च रिपोर्ट्', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(45, 'sidemenu_transactions_report', 'backend', 'Transactions Report', 'लेनदेन रिपोर्ट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(46, 'heading_login', 'backend', 'Login', 'लॉग इन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(47, 'heading_site_settings', 'backend', 'Site Settings', 'साइट सेटिंग्स', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(48, 'heading_gst_settings', 'backend', 'GST Settings', 'जीएसटी सेटिंग्स', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(49, 'heading_smsapi_settings', 'backend', 'SMS Api Settings', 'एसएमएस एपीआई सेटिंग्स', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(50, 'heading_currency_settings', 'backend', 'Currency Settings', 'मुद्रा सेटिंग्स', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(51, 'heading_default_settings', 'backend', 'Default Settings', 'डिफ़ॉल्ट सेटिंग्स', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(52, 'heading_food_category', 'backend', 'Food Category', 'खाद्य श्रेणी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(53, 'heading_food_category_list', 'backend', 'List Food Category', 'सूची खाद्य श्रेणी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(54, 'heading_food_item', 'backend', 'Food Item', 'खाद्य - सामग्री', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(55, 'heading_food_item_list', 'backend', 'List Food Items', 'सूची खाद्य पदार्थ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(56, 'heading_expense_category', 'backend', 'Expense Category', 'व्यय की श्रेणी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(57, 'heading_expense_category_list', 'backend', 'List Expense Category', 'सूची व्यय श्रेणी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(58, 'heading_expense', 'backend', 'Expenses', 'व्यय', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(59, 'heading_filter_expense', 'backend', 'Filter Expense', 'फ़िल्टर व्यय', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(60, 'heading_filter_customer', 'backend', 'Filter Customer', 'फ़िल्टर ग्राहक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(61, 'heading_expense_list', 'backend', 'List Expenses', 'सूची व्यय', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(62, 'heading_customer_info', 'backend', 'Customer Information', 'ग्राहक सूचना', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(63, 'heading_filter_orders', 'backend', 'Filter Orders', 'फ़िल्टर ऑर्डर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(64, 'heading_all_orders', 'backend', 'All Orders', 'सभी ऑर्डर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(65, 'heading_add_product', 'backend', 'Add Product', 'उत्पाद जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(66, 'heading_update_product', 'backend', 'Update Product', 'अद्यतन उत्पाद', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(67, 'heading_list_product', 'backend', 'List Products', 'उत्पादों की सूची', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(68, 'heading_guest_type', 'backend', 'Guest Type', 'अतिथि प्रकार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(69, 'heading_existing_guest_list', 'backend', 'Existing Guest List', 'मौजूदा अतिथि सूची', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(70, 'heading_guest_info', 'backend', 'Guest Information', 'अतिथि जानकारी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(71, 'heading_checkin_info', 'backend', 'Check In Information', 'चेक-इन सूचना', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(72, 'heading_idcard_info', 'backend', 'ID Card Information', 'आईडी कार्ड की जानकारी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(73, 'heading_person_info', 'backend', 'Information of Other Person', 'अन्य व्यक्ति की जानकारी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(74, 'heading_payment_info', 'backend', 'Payment Information', 'भुगतान की जानकारी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(75, 'heading_filter_checkouts', 'backend', 'Filter Checkouts', 'फ़िल्टर चेकआउट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(76, 'heading_checkin_list', 'backend', 'Check In List', 'चेक-इन सूची', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(77, 'heading_checkout_list', 'backend', 'Check Out List', 'चेक-आउट सूची', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(78, 'heading_checkInOut_info', 'backend', 'Check In/Out Information', 'चेक इन/आउट सूचना', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(79, 'heading_additional_info', 'backend', 'Additional Information', 'अतिरिक्त जानकारी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(80, 'heading_update_password', 'backend', 'Update Password', 'पासवर्ड अपडेट करें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(81, 'heading_update_profile', 'backend', 'Update Profile', 'प्रोफ़ाइल अपडेट करें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(82, 'heading_stock_history', 'backend', 'Stocks History', 'स्टॉक्स इतिहास', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(83, 'heading_filter_stock_history', 'backend', 'Filter Stocks History', 'फ़िल्टर स्टॉक इतिहास', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(84, 'heading_manage_inventory', 'backend', 'Manage Inventory', 'इन्वेंटरी का प्रबंधन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(85, 'heading_term_and_conditions', 'backend', 'Term & Conditions', 'नियम और शर्तें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(86, 'heading_list_roomtypes', 'backend', 'List Room Type', 'सभी प्रकार के कमरे', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(87, 'heading_list_permission', 'backend', 'All Permissions', 'सभी अनुमतियां', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(88, 'heading_list_dynamic_dropdowns', 'backend', 'All Dropdowns', 'सभी ड्रॉपडाउन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(89, 'heading_bank_settings', 'backend', 'Bank Settings', 'बैंक सेटिंग्स', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(90, 'heading_website_settings', 'backend', 'Website Settings', 'वेबसाइट सेटिंग्स', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(91, 'btn_repeat_order', 'backend', 'Repeat Order', 'दुबारा ऑर्डर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(92, 'btn_view_order', 'backend', 'View Order', 'ऑर्डर देखें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(93, 'btn_pay', 'backend', 'Pay', 'वेतन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(94, 'btn_submit', 'backend', 'Submit', 'प्रस्तुत', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(95, 'btn_add', 'backend', 'Add', 'जोड़ना', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:22', '2022-07-11 06:56:08'),
(96, 'btn_update', 'backend', 'Update', 'अपडेट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(97, 'btn_save', 'backend', 'Save', 'सहेजें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(98, 'btn_cancel', 'backend', 'Cancel', 'रद्द', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(99, 'btn_delete', 'backend', 'Delete', 'हटाएं', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(100, 'btn_reset', 'backend', 'Reset', 'रीसेट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(101, 'btn_print', 'backend', 'Print', 'छाप', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(102, 'btn_go_back', 'backend', 'Go To Back', 'वापस जाएं', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(103, 'btn_login', 'backend', 'Log in', 'लॉग इन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(104, 'btn_search', 'backend', 'Search', 'खोज', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(105, 'btn_export', 'backend', 'Export', 'निर्यात', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(106, 'btn_view_item', 'backend', 'View Items', 'आइटम देखें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(107, 'btn_view', 'backend', 'View', 'देखें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(108, 'btn_view_all', 'backend', 'View All', 'देखें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(109, 'btn_invoice_food', 'backend', 'Invoice Food', 'रसीद खाना', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(110, 'btn_invoice_room', 'backend', 'Invoice Room', 'रसीद कक्ष', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(111, 'btn_invoice_room_org', 'backend', 'Inv Room Original', 'रसीद कक्ष', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(112, 'btn_invoice_room_dup', 'backend', 'Inv Room Duplicate', 'रसीद कक्ष', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(113, 'btn_food_order', 'backend', 'Food Order', 'खाद्य ऑर्डर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:08', '2022-07-11 06:56:08'),
(114, 'btn_checkin', 'backend', 'Check In', 'चेक इन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(115, 'btn_checkout', 'backend', 'Check Out', 'चेक आउट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(116, 'btn_advance_slip', 'backend', 'Advance Slip', 'अग्रिम पर्ची', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(117, 'btn_advance_pay', 'backend', 'Advance Pay', 'अग्रिम भुगतान', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(118, 'btn_swap_room', 'backend', 'Swap Room', 'स्वैप रूम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(119, 'btn_mark_as_paid', 'backend', 'Mark as Paid', 'भुगतान के रूप में चिह्नित करें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(120, 'btn_update_customer_info', 'backend', 'Update Guest Info', 'अतिथि जानकारी अपडेट करें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(121, 'ph_enter', 'backend', 'Enter ', 'दर्ज', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(122, 'ph_select', 'backend', '--Select--', '--चयन--', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:22', '2022-07-11 06:56:09'),
(123, 'ph_qty', 'backend', 'Enter Qty', 'मात्रा दर्ज करें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(124, 'ph_date', 'backend', 'Select Date', 'तारीख़ चुनें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(125, 'ph_date_from', 'backend', 'Select Date From', 'से दिनांक का चयन करें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(126, 'ph_date_to', 'backend', 'Select Date To', 'दिनांक का चयन करें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(127, 'ph_day_night', 'backend', 'Enter Number of Days/Night', 'दिन/रात की संख्या दर्ज करें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(128, 'ph_any_discount', 'backend', 'Enter Any Discount', 'कोई भी छूट दर्ज करें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(129, 'txt_welcome', 'backend', 'Welcome', 'स्वागत', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(130, 'txt_profile', 'backend', 'Profile', 'प्रोफ़ाइल', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(131, 'txt_logout', 'backend', 'Logout', 'लॉग आउट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(132, 'txt_rights_res', 'backend', 'All Rights Reserved', 'सभी अधिकार सुरक्षित', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(133, 'txt_today_checkin', 'backend', 'Today`s Check-Ins', 'आज चेक इन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(134, 'txt_today_checkout', 'backend', 'Today`s Check-Outs', 'आज चेक आउट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(135, 'txt_today_orders', 'backend', 'Today`s Occupancy', 'आज ऑर्डर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(136, 'txt_add_new_orders', 'backend', 'Add New Order', 'नया ऑर्डर जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:50', '2022-07-11 06:56:09'),
(137, 'txt_latest_orders', 'backend', 'Latest Orders', 'नवीनतम ऑर्डर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(138, 'txt_sno', 'backend', 'S.No', 'S.No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(139, 'txt_customer_name', 'backend', 'Customer Name', 'ग्राहक का नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(140, 'txt_customer_email', 'backend', 'Customer E-mail', 'ग्राहक ईमेल', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(141, 'txt_customer_mobile', 'backend', 'Customer Mobile', 'ग्राहक मोबाइल', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(142, 'txt_table_num', 'backend', 'Table No.', 'तालिका संख्या', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(143, 'txt_room_num', 'backend', 'Room No.', 'कमरा क्रमांक।', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(144, 'txt_order_amount', 'backend', 'Order Amount', 'ऑर्डर करने की राशि', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(145, 'txt_action', 'backend', 'Action', 'कार्य', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:22', '2022-07-11 06:56:09'),
(146, 'txt_order_details', 'backend', 'Order Details', 'ऑर्डर का विवरण', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(147, 'txt_datetime', 'backend', 'Datetime', 'दिनांक और समय', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(148, 'txt_orderitem_qty', 'backend', 'Order Items & Quantity', 'ऑर्डर आइटम और मात्रा', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(149, 'txt_stock', 'backend', 'Stock', 'भण्डार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(150, 'txt_product_stocks', 'backend', 'Product Stocks', 'उत्पाद स्टॉक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:09', '2022-07-11 06:56:09'),
(151, 'txt_current_stocks', 'backend', 'Current Stocks', 'वर्तमान स्टॉक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(152, 'txt_product', 'backend', 'Product', 'उत्पाद', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(153, 'txt_unit', 'backend', 'Unit', 'इकाई', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(154, 'txt_site_page_title', 'backend', 'Site Page Title', 'साइट पेज शीर्षक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(155, 'txt_site_lang', 'backend', 'Site Language', 'साइट की भाषा', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(156, 'txt_hotel_name', 'backend', 'Hotel Name', 'होटल का नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(157, 'txt_hotel_tagline', 'backend', 'Hotel Tagline', 'होटल टैगलाइन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(158, 'txt_hotel_email', 'backend', 'Hotel E-mail', 'होटल ईमेल', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(159, 'txt_hotel_phone', 'backend', 'Hotel Phone', 'होटल फोन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(160, 'txt_hotel_mobile', 'backend', 'Hotel Mobile', 'होटल मोबाइल', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(161, 'txt_hotel_website', 'backend', 'Hotel Website', 'होटल की वेबसाइट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(162, 'txt_hotel_address', 'backend', 'Hotel Address', 'होटल का पता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(163, 'txt_gstin', 'backend', 'GSTIN', 'जीएसटीआईएन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(164, 'txt_room_rent_gst', 'backend', 'Room Rent GST', 'कमरे का किराया जी.एस.टी.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(165, 'txt_food_gst', 'backend', 'Food GST', 'खाद्य जी.एस.टी.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(166, 'txt_gst', 'backend', 'GST', 'जी.एस.टी.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(167, 'txt_sgst_', 'backend', 'SGST', 'एस.जी.एस.टी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(168, 'txt_sgst', 'backend', 'GST', 'जी.एस.टी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(169, 'txt_cgst', 'backend', 'CGST', 'सी.जी.एस.टी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(170, 'txt_gst_apply', 'backend', 'GST Apply', 'जीएसटी लागू', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(171, 'txt_category_name', 'backend', 'Category Name', 'श्रेणी नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(172, 'txt_status', 'backend', 'Status', 'स्थिति', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(173, 'txt_category', 'backend', 'Category', 'श्रेणी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(174, 'txt_item_name', 'backend', 'Item Name', 'वस्तु का नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(175, 'txt_price', 'backend', 'Price', 'कीमत', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(176, 'txt_desc', 'backend', 'Description', 'विवरण', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(177, 'txt_invoice', 'backend', 'Invoice', 'रसीद', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(178, 'txt_name', 'backend', 'Name', 'नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(179, 'txt_fullname', 'backend', 'Full name', 'पूरा नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(180, 'txt_father_name', 'backend', 'Father Name', 'पिता का नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(181, 'txt_mobile_num', 'backend', 'Mobile No.', 'मोबाइल नंबर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(182, 'txt_city', 'backend', 'City', 'शहर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(183, 'txt_state', 'backend', 'State', 'राज्य', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(184, 'txt_country', 'backend', 'Country', 'देश', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:10', '2022-07-11 06:56:10'),
(185, 'txt_nationality', 'backend', 'Nationality', 'राष्ट्रीयता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(186, 'txt_ph', 'backend', 'Ph', 'Ph', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(187, 'txt_mob', 'backend', 'M', 'M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(188, 'txt_num', 'backend', 'No.', 'संख्या', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(189, 'txt_dated', 'backend', 'Dated', 'दिनांक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(190, 'txt_date', 'backend', 'Date', 'दिनांक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(191, 'txt_cust_name', 'backend', 'Customer Name', 'ग्राहक का नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(192, 'txt_address', 'backend', 'Address', 'पता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(193, 'txt_waiter', 'backend', 'Waiter', 'वेटर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(194, 'txt_item_details', 'backend', 'Item Details', 'आइटम विवरण', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(195, 'txt_item_qty', 'backend', 'Item Qty', 'आइटम मात्रा', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(196, 'txt_item_price', 'backend', 'Item Price', 'सामान की क़ीमत', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(197, 'txt_amount', 'backend', 'Amount', 'रकम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(198, 'txt_no_orders', 'backend', 'No Orders', 'कोई ऑर्डर नहीं', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(199, 'txt_discount', 'backend', 'Discount', 'छूट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(200, 'txt_total_amount', 'backend', 'Total Amount', 'कुल रकम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(201, 'txt_subtotal', 'backend', 'Subtotal', 'उपयोग', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(202, 'txt_total', 'backend', 'Total', 'संपूर्ण', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(203, 'txt_grand_total', 'backend', 'Grand Total', 'कुल योग', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(204, 'txt_amount_words', 'backend', 'Amount in Words', 'राशि शब्दों में', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(205, 'txt_customer_sign', 'backend', 'Customer Signature', 'ग्राहक के हस्ताक्षर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(206, 'txt_manager_sign', 'backend', 'Manager Signature', 'प्रबंधक के हस्ताक्षर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(207, 'txt_num_of_persons', 'backend', 'No. of Persons', 'व्यक्तियों की संख्या', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(208, 'txt_waiter_name', 'backend', 'Waiter Name', 'वेटर का नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(209, 'txt_payment_mode', 'backend', 'Payment Mode', 'भुगतान का प्रकार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(210, 'txt_payment_status', 'backend', 'Payment Status', 'भुगतान की स्थिति', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(211, 'txt_inv_applicable', 'backend', 'Invoice Applicable', 'चालान लागू', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(212, 'txt_website', 'backend', 'Website', 'वेबसाइट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(213, 'txt_bill_to', 'backend', 'Bill To', 'बिल प्राप्तकर्ता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(214, 'txt_orderd_items', 'backend', 'Ordered Items', 'आइटम ऑर्डर किए गए', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(215, 'txt_token_num', 'backend', 'KOT No.', 'टोकन नंबर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(216, 'txt_type', 'backend', 'Type', 'प्रकार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(217, 'txt_date_from', 'backend', 'Date From', 'तारीख से', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(218, 'txt_date_to', 'backend', 'Date To', 'की तारीख', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(219, 'txt_order_by', 'backend', 'Order By', 'द्वारा ऑर्डर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:11', '2022-07-11 06:56:11'),
(220, 'txt_inv_num', 'backend', 'Invoice No.', 'रसीद संख्या', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(221, 'txt_tbl_room_num', 'backend', 'Table/Room No.', 'टेबल / कमरा नं', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(222, 'txt_order_date', 'backend', 'Order Date', 'ऑर्डर की तारीख', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(223, 'txt_pay_date', 'backend', 'Pay Date', 'भुगतान की तिथि', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(224, 'txt_order_list', 'backend', 'Order List', 'ऑर्डर सूची', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(225, 'txt_room_order', 'backend', 'Room Order', 'कक्ष ऑर्डर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(226, 'txt_tbl_order', 'backend', 'Table Order', 'टेबल ऑर्डर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(227, 'txt_curr_stock', 'backend', 'Current Stock', 'वर्तमान स्टॉक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(228, 'txt_product_name', 'backend', 'Product Name', 'उत्पाद का नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(229, 'txt_qty', 'backend', 'Quantity', 'मात्रा', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(230, 'txt_currency', 'backend', 'Currency', 'मुद्रा', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(231, 'txt_currency_symbol', 'backend', 'Currency Symbol', 'मुद्रा चिन्ह', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(232, 'txt_api_url', 'backend', 'Api URL', 'एपीआई URL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(233, 'txt_api_username', 'backend', 'Username', 'उपयोगकर्ता नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(234, 'txt_api_senderid', 'backend', 'Sender Id', 'प्रेषक आईडी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(235, 'txt_api_key', 'backend', 'Api Key', 'एपीआई Key', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(236, 'txt_api_active', 'backend', 'Api Active', 'एपीआई सक्रिय', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(237, 'txt_email', 'backend', 'E-mail', 'ईमेल', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(238, 'txt_permission', 'backend', 'Permission', 'अनुमति', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(239, 'txt_superadmin', 'backend', 'Super Admin', 'सुपर एडमिन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(240, 'txt_admin', 'backend', 'Admin', 'एडमिन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(241, 'txt_receptionist', 'backend', 'Receptionist', 'रिसेप्शनिस्ट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(242, 'txt_store_manager', 'backend', 'Store Manager', 'स्टोर प्रबंधक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(243, 'txt_financial_manager', 'backend', 'Financial Manager', 'वित्तीय प्रबंधक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(244, 'txt_housekeeper', 'backend', 'Housekeeper', 'हाउसकीपर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(245, 'txt_advance_payment', 'backend', 'Advance Payment', 'अग्रिम भुगतान', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(246, 'txt_age', 'backend', 'Age', 'आयु', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(247, 'txt_gender', 'backend', 'Gender', 'लिंग', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(248, 'txt_type_id', 'backend', 'Type of ID', 'आईडी का प्रकार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(249, 'txt_id_number', 'backend', 'ID No.', 'पहचान संख्या', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(250, 'txt_upload_idcard', 'backend', 'Upload ID Card', 'आईडी कार्ड अपलोड करें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(251, 'txt_multiple', 'backend', 'Multiple', 'विभिन्न', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(252, 'txt_adults', 'backend', 'Adults', 'वयस्क', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(253, 'txt_kids', 'backend', 'Kids', 'बच्चे', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:12', '2022-07-11 06:56:12'),
(254, 'txt_booked_by', 'backend', 'Booked By', 'द्वारा बुक किया', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(255, 'txt_vehicle_number', 'backend', 'Vehicle Number', 'गाडी नंबर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(256, 'txt_referred_by', 'backend', 'Referred By', 'द्वारा उल्लिखित', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(257, 'txt_referred_by_name', 'backend', 'Referred By Name', 'नाम से संदर्भित', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(258, 'txt_reason_of_visit', 'backend', 'Reason of Visit/Stay', 'यात्रा/रहने का कारण', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(259, 'txt_remark_amount', 'backend', 'Remark Amount', 'रिमार्क राशि', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(260, 'txt_remark', 'backend', 'Remark', 'टिप्पणी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(261, 'txt_select', 'backend', 'Select', 'चयन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(262, 'txt_select_rooms', 'backend', 'Select Rooms', 'कमरे का चयन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(263, 'txt_room_type', 'backend', 'Room Type', 'कक्ष के प्रकार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(264, 'txt_duration_of_stay', 'backend', 'Duration of Stay', 'रहने की अवधि', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(265, 'txt_checkout', 'backend', 'Check Out', 'चेक आउट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(266, 'txt_checkin', 'backend', 'Check In', 'चेक इन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(267, 'txt_guest', 'backend', 'Guest', 'मेहमान', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(268, 'txt_new_guest', 'backend', 'New Guest', 'नए मेहमान', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(269, 'txt_existing_guest', 'backend', 'Existing Guest', 'मौजूदा अतिथि', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(270, 'txt_guest_name', 'backend', 'Guest Name', 'मेहमान का नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(271, 'txt_room', 'backend', 'Room', 'कक्ष', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(272, 'txt_final_amount', 'backend', 'Final Amount', 'अंतिम राशी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(273, 'txt_no_record', 'backend', 'No Records Found', 'कोई रिकॉर्ड नहीं', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-15 13:59:54', '2022-07-11 06:56:13'),
(274, 'txt_food_orders', 'backend', 'Food Orders', 'खाद्य आदेश', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(275, 'txt_advance_amount', 'backend', 'Advance Amount', 'अग्रिम राशि', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(276, 'txt_base_price', 'backend', 'Base Price', 'आधार मूल्य', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(277, 'txt_room_qty', 'backend', 'Room Qty', 'कक्ष मात्रा', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(278, 'txt_no_file', 'backend', 'No Files Uploaded', 'कोई फ़ाइल अपलोड नहीं की गई', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(279, 'txt_idcard', 'backend', 'Id Card', 'आईडी कार्ड', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(280, 'txt_idcard_uploaded', 'backend', 'Uploaded Id Cards', 'अपलोड किए गए आईडी कार्ड', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(281, 'txt_idcard_type', 'backend', 'ID Card Type', 'आईडी कार्ड का प्रकार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(282, 'txt_idcard_num', 'backend', 'ID Card Number', 'परिचय - पत्र संख्या', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(283, 'txt_company_gst_num', 'backend', 'Company GST No.', 'कंपनी जीएसटी नं.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(284, 'txt_persons', 'backend', 'Person`s', 'व्यक्ति', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:13', '2022-07-11 06:56:13'),
(285, 'txt_checkin_from_date', 'backend', 'Check In Form Date', 'चेक-इन फॉर्म की तारीख', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(286, 'txt_checkout_from_date', 'backend', 'Check Out Form Date', 'चेक-आउट फॉर्म की तारीख', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(287, 'txt_years', 'backend', 'Years', 'वर्ष', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(288, 'txt_yes', 'backend', 'Yes', 'Yes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(289, 'txt_no', 'backend', 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(290, 'txt_uploaded_files', 'backend', 'Uploaded Files', 'अपलोड की गई फाइलें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(291, 'txt_user', 'backend', 'User', 'उपयोगकर्ता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(292, 'txt_password', 'backend', 'Password', 'पासवर्ड', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(293, 'txt_password_new', 'backend', 'New Password', 'नया पासवर्ड', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(294, 'txt_password_conf', 'backend', 'Confirm Password', 'पासवर्ड की पुष्टि', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(295, 'txt_user_role', 'backend', 'User Role', 'उपयोगकर्ता भूमिका', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(296, 'txt_role', 'backend', 'Role', 'भूमिका', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(297, 'txt_description', 'backend', 'Description', 'विवरण', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(298, 'txt_amenities', 'backend', 'Amenities', 'सुविधाएँ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(299, 'txt_list_amenities', 'backend', 'List Amenities', 'सुविधाओं की सूची', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(300, 'txt_floor', 'backend', 'Floor', 'मंज़िल', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(301, 'txt_list_room', 'backend', 'List Rooms', 'कमरों की सूची', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14');
INSERT INTO `language_translations` (`id`, `lang_key`, `pannel`, `en`, `hi`, `ar`, `bn`, `zh`, `fr`, `de`, `it`, `pt`, `rm`, `ru`, `updated_at`, `created_at`) VALUES
(302, 'txt_title', 'backend', 'Title', 'शीर्षक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(303, 'txt_short_code', 'backend', 'Short Code', 'छोटा संकेत', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(304, 'txt_adult_capacity', 'backend', 'Adult Capacity', 'वयस्क क्षमता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(305, 'txt_kids_capacity', 'backend', 'Kids Capacity', 'बच्चों की क्षमता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(306, 'txt_capacity', 'backend', 'Capacity', 'क्षमता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(307, 'txt_by', 'backend', 'By', 'द्वारा', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(308, 'txt_customer', 'backend', 'Customer', 'ग्राहक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(309, 'txt_list_users', 'backend', 'List Users', 'उपयोगकर्ता सूची', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(310, 'txt_list_customers', 'backend', 'List Customers', 'ग्राहकों की सूची', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(311, 'txt_invoice_tnc', 'backend', 'Invoice Term & Conditions', 'रसीद नियम और शर्तें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(312, 'txt_attachment', 'backend', 'Attachment', 'रसीदें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(313, 'txt_available', 'backend', 'Available', 'उपलब्ध', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(314, 'txt_booked', 'backend', 'Booked', 'बुक किया', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(315, 'txt_no_rooms', 'backend', 'No Rooms: ', 'कोई कमरा नहीं', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(316, 'txt_add_new_rooms', 'backend', 'Add New', 'नया कक्ष जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:50', '2022-07-11 06:56:14'),
(317, 'txt_company_name', 'backend', 'Company Name', 'कंपनी का नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(318, 'txt_room_plan', 'backend', 'Room Plan', 'कक्ष योजना', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(319, 'txt_heading_select_rooms', 'backend', 'Select Rooms', 'कमरे चुनें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(320, 'txt_heading_select_room_for_swap', 'backend', 'Select Room For Swap', 'स्वैप के लिए कक्ष चुनें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(321, 'txt_swapped_room', 'backend', 'Swapped Room', 'अदला-बदली कक्ष', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(322, 'txt_heading_booked_rooms', 'backend', 'Booked Rooms', 'बुक किए गए कमरे', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(323, 'txt_dropdown_values', 'backend', 'Dropdown Values', 'ड्रॉपडाउन मान', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:14', '2022-07-11 06:56:14'),
(324, 'txt_dropdown_gender', 'backend', 'Gender Dropdown', 'जेंडर ड्रॉपडाउन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(325, 'txt_dropdown_type_of_ids', 'backend', 'Type of Ids Dropdown', 'आईडी ड्रॉपडाउन का प्रकार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(326, 'txt_dropdown_room_floor', 'backend', 'Room Floor Dropdowns', 'रूम फ्लोर ड्रॉपडाउन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(327, 'txt_dropdown_measurement', 'backend', 'Measurement Dropdowns', 'मापन ड्रॉपडाउन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(328, 'txt_dropdown_housekeeping_status', 'backend', 'Housekeeping Status Dropdowns', 'हाउसकीपिंग स्थिति ड्रॉपडाउन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(329, 'txt_default_rec_days', 'backend', 'Default Filter Dates Range (Days)', 'डिफ़ॉल्ट फ़िल्टर दिनांक सीमा (दिन)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(330, 'txt_site_favicon', 'backend', 'Site Favicon', 'साइट फ़ेविकॉन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(331, 'txt_site_logo', 'backend', 'Site Logo', 'साइट लोगो', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(332, 'txt_site_logo_width', 'backend', 'Logo Width (px)', 'लोगो की चौड़ाई (px)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(333, 'txt_site_logo_height', 'backend', 'Logo Height (px)', 'लोगो की ऊंचाई (px)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(334, 'txt_bank_name', 'backend', 'Bank Name', 'बैंक का नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(335, 'txt_bank_ifsc_code', 'backend', 'IFSC Code', 'आईएफएससी कोड', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(336, 'txt_bank_acc_name', 'backend', 'Account Name', 'खाता नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:22', '2022-07-11 06:56:15'),
(337, 'txt_bank_acc_num', 'backend', 'Account No.', 'खाता नंबर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:22', '2022-07-11 06:56:15'),
(338, 'txt_bank_branch', 'backend', 'Bank & Branch', 'बैंक शाखा', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(339, 'txt_additional_amount', 'backend', 'Additional Amount', 'अतिरिक्त राशि', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(340, 'txt_additional_amount_reason', 'backend', 'Reason of Additional Amount', 'अतिरिक्त राशि का कारण', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(341, 'txt_order_num', 'backend', 'Order No.', 'आदेश संख्या', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:23:20', '2022-07-11 06:56:15'),
(342, 'txt_images', 'backend', 'Image', 'छवि', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(343, 'txt_firstname', 'backend', 'First Name', 'पहला नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(344, 'txt_middlename', 'backend', 'Middle Name', 'मध्य नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(345, 'txt_surname', 'backend', 'Surname', 'उपनाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(346, 'txt_section_1', 'backend', 'Section 1', 'अनुभाग', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(347, 'txt_section_2', 'backend', 'Section 2', 'अनुभाग', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(348, 'txt_section_3', 'backend', 'Section 3', 'अनुभाग', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(349, 'txt_section_4', 'backend', 'Section 4', 'अनुभाग', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(350, 'txt_section_5', 'backend', 'Section 5', 'अनुभाग', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(351, 'txt_section_6', 'backend', 'Section 6', 'अनुभाग', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(352, 'txt_section_7', 'backend', 'Section 7', 'अनुभाग', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(353, 'txt_section_8', 'backend', 'Section 8', 'अनुभाग', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:15', '2022-07-11 06:56:15'),
(354, 'txt_section_9', 'backend', 'Section 9', 'अनुभाग', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:16', '2022-07-11 06:56:16'),
(355, 'txt_section_10', 'backend', 'Section 10', 'अनुभाग', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:16', '2022-07-11 06:56:16'),
(356, 'txt_banner_title', 'backend', 'Banner Title', 'बैनर शीर्षक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:16', '2022-07-11 06:56:16'),
(357, 'txt_banner_subtitle', 'backend', 'Banner Subtitle', 'बैनर उपशीर्षक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:16', '2022-07-11 06:56:16'),
(358, 'txt_checkin_report', 'backend', 'Check-Ins Reports', 'चेक-इन रिपोर्ट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:16', '2022-07-11 06:56:16'),
(359, 'txt_checkout_report', 'backend', 'Check-Outs Report', 'चेक-आउट रिपोर्ट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:16', '2022-07-11 06:56:16'),
(360, 'txt_sales_report', 'backend', 'Sales Report', 'बिक्री रिपोर्ट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:16', '2022-07-11 06:56:16'),
(361, 'txt_expense_report', 'backend', 'Expense Report', 'खर्च रिपोर्ट्', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:16', '2022-07-11 06:56:16'),
(362, 'txt_transactions_report', 'backend', 'Transactions Report', 'लेनदेन रिपोर्ट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:16', '2022-07-11 06:56:16'),
(363, 'txt_total_income', 'backend', 'Total Income', 'कुल आय', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:16', '2022-07-11 06:56:16'),
(364, 'txt_total_expense', 'backend', 'Total Expense', 'कुल खर्च', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:16', '2022-07-11 06:56:16'),
(365, 'txt_total_netamount', 'backend', 'Net Amount', 'शुद्ध राशि', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:16', '2022-07-11 06:56:16'),
(366, 'txt_activity', 'backend', 'Activity', 'गतिविधि', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:22', '2022-07-11 06:56:16'),
(367, 'txt_transaction_id', 'backend', 'Transaction Id', 'लेन-देन आईडी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:16', '2022-07-11 06:56:16'),
(368, 'txt_user_name', 'backend', 'User Name', 'उपयोगकर्ता नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:16', '2022-07-11 06:56:16'),
(369, 'txt_expiry_date', 'backend', 'Expiry Date', 'अंतिम तारीख', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:16', '2022-07-11 06:56:16'),
(370, 'txt_no_notifi', 'backend', 'No notifications found', 'कोई सूचना नहीं मिली', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:16', '2022-07-11 06:56:16'),
(371, 'txt_develop_by', 'backend', '2022 Designd & Develop By CodexEco. All Rights Reserved', '2022 Designd & Develop By CodexEco. All Rights Reserved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:22', '2022-07-11 06:56:16'),
(372, 'heading_language_translations', 'backend', 'Language Translations', 'भाषा अनुवाद', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 15:20:38', '2022-07-11 06:42:14'),
(373, 'sidemenu_vendor', 'backend', 'Vendors', 'विक्रेता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 15:20:38', '2022-07-11 06:42:14'),
(374, 'sidemenu_vendorcat_add', 'backend', 'Add Category', 'श्रेणी जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:22', '2022-07-11 06:42:14'),
(375, 'sidemenu_vendorcat_all', 'backend', 'All Category', 'सभी श्रेणी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 15:20:38', '2022-07-11 06:42:14'),
(376, 'sidemenu_vendor_add', 'backend', 'Add Vendor', 'विक्रेता जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 15:20:38', '2022-07-11 06:42:14'),
(377, 'sidemenu_vendor_all', 'backend', 'All Vendor', 'सभी विक्रेता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 15:20:38', '2022-07-11 06:42:14'),
(378, 'heading_vendor_category', 'backend', 'Vendor Category', 'विक्रेता श्रेणी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(379, 'heading_vendor_category_list', 'backend', 'List Vendor Category', 'सूची विक्रेता श्रेणी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(380, 'heading_vendor', 'backend', 'Vendors', 'विक्रेता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(381, 'heading_filter_vendor', 'backend', 'Filter Vendor', 'फ़िल्टर विक्रेता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(382, 'heading_vendor_list', 'backend', 'List Vendors', 'सूची विक्रेता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-11 12:26:07', '2022-07-11 06:56:07'),
(383, 'txt_phone_num', 'backend', 'Phone No.', 'फ़ोन नंबर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-12 14:23:36', '2022-07-12 08:53:36'),
(384, 'txt_gst_num', 'backend', 'GST No.', 'जीएसटी नं.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-12 14:23:37', '2022-07-12 08:53:37'),
(385, 'txt_contact_person_name', 'backend', 'Contact Person Name', 'संपर्क व्यक्ति का नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-12 14:23:37', '2022-07-12 08:53:37'),
(386, 'txt_contact_person_email', 'backend', 'Contact Person Email', 'संपर्क व्यक्ति का ईमेल', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-12 14:23:37', '2022-07-12 08:53:37'),
(387, 'txt_contact_person_mobile', 'backend', 'Contact Person Mobile', 'संपर्क व्यक्ति का मोबाइल', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-12 14:23:37', '2022-07-12 08:53:37'),
(388, 'heading_vendor_info', 'backend', 'Vendor Information', 'विक्रेता की जानकारी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-13 11:03:58', '2022-07-13 05:33:58'),
(389, 'heading_orders', 'backend', 'All Orders', 'सभी ऑर्डर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 18:15:36', '2022-07-13 05:33:58'),
(390, 'heading_order_info', 'backend', 'Order Information', 'ऑर्डर की जानकारी', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 18:15:36', '2022-07-13 05:33:59'),
(391, 'sidemenu_housekeeping', 'backend', 'Housekeeping', 'हाउसकीपिंग', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-13 11:03:59', '2022-07-13 05:33:59'),
(392, 'sidemenu_item_add', 'backend', 'Add Item', 'सामान जोडें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:50', '2022-07-13 05:33:59'),
(393, 'sidemenu_item_all', 'backend', 'All Items', 'सभी आइटम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-13 11:03:59', '2022-07-13 05:33:59'),
(394, 'sidemenu_order_add', 'backend', 'Add Order', 'आदेश जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:50', '2022-07-13 05:33:59'),
(395, 'sidemenu_order_all', 'backend', 'All Orders', 'सभी ऑर्डर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-13 11:03:59', '2022-07-13 05:33:59'),
(396, 'txt_housekeeping_item', 'backend', 'Housekeeping Item', 'हाउसकीपिंग सामान', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-13 11:38:49', '2022-07-13 06:08:49'),
(397, 'txt_housekeeping_status', 'backend', 'Housekeeping Status', 'हाउसकीपिंग स्थिति', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-13 14:05:22', '2022-07-13 08:35:22'),
(398, 'txt_add_new', 'backend', 'Add New', 'नया जोड़ो', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 16:22:50', '2022-07-13 08:35:22'),
(399, 'txt_assigned_to', 'backend', 'Assigned to', 'को सौंपना', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-13 14:11:34', '2022-07-13 08:41:34'),
(400, 'sidemenu_seasons', 'backend', 'Seasons', 'मौसम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 12:45:51', '2022-07-14 07:15:51'),
(401, 'heading_season', 'backend', 'Season', 'मौसम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 12:45:51', '2022-07-14 07:15:51'),
(402, 'sidemenu_season_add', 'backend', 'Add Season', 'मौसम जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 12:45:51', '2022-07-14 07:15:51'),
(403, 'sidemenu_season_all', 'backend', 'All Season', 'सब मौसम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 12:45:51', '2022-07-14 07:15:51'),
(404, 'txt_season_name', 'backend', 'Season Name', 'मौसम का नाम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 12:45:51', '2022-07-14 07:15:51'),
(405, 'txt_start_date', 'backend', 'Start Date', 'आरंभ करने की तिथि', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 12:45:51', '2022-07-14 07:15:51'),
(406, 'txt_end_date', 'backend', 'End Date', 'अंतिम तिथि', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 12:45:52', '2022-07-14 07:15:52'),
(407, 'txt_days', 'backend', 'Days', 'दिन', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 12:45:52', '2022-07-14 07:15:52'),
(408, 'txt_day_mon', 'backend', 'Monday', 'सोमवार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 12:45:52', '2022-07-14 07:15:52'),
(409, 'txt_day_tue', 'backend', 'Tuesday', 'मंगलवार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 12:45:52', '2022-07-14 07:15:52'),
(411, 'txt_day_thu', 'backend', 'Thursday', 'गुरुवार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 12:45:52', '2022-07-14 07:15:52'),
(412, 'txt_day_fri', 'backend', 'Friday', 'शुक्रवार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 12:45:52', '2022-07-14 07:15:52'),
(413, 'txt_day_sat', 'backend', 'Saturday', 'शनिवार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 12:45:52', '2022-07-14 07:15:52'),
(414, 'txt_day_sun', 'backend', 'Sunday', 'रविवार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 12:45:52', '2022-07-14 07:15:52'),
(415, 'heading_season_list', 'backend', 'All Season', 'सब मौसम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 12:48:37', '2022-07-14 07:18:37'),
(417, 'sidemenu_seasons_all', 'backend', 'All Season', 'सब मौसम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 14:07:55', '2022-07-14 08:37:55'),
(418, 'txt_day_full_mon', 'backend', 'Monday', 'सोमवार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 14:07:55', '2022-07-14 08:37:55'),
(419, 'txt_day_full_tue', 'backend', 'Tuesday', 'मंगलवार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 14:07:55', '2022-07-14 08:37:55'),
(420, 'txt_day_full_wed', 'backend', 'Wednesday', 'बुधवार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 14:07:55', '2022-07-14 08:37:55'),
(421, 'txt_day_full_thu', 'backend', 'Thursday', 'गुरुवार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 14:07:55', '2022-07-14 08:37:55'),
(422, 'txt_day_full_fri', 'backend', 'Friday', 'शुक्रवार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 14:07:55', '2022-07-14 08:37:55'),
(423, 'txt_day_full_sat', 'backend', 'Saturday', 'शनिवार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 14:07:55', '2022-07-14 08:37:55'),
(424, 'txt_day_full_sun', 'backend', 'Sunday', 'रविवार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 14:07:55', '2022-07-14 08:37:55'),
(425, 'txt_day_short_mon', 'backend', 'Monday', 'सोमवार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 14:07:55', '2022-07-14 08:37:55'),
(426, 'txt_day_short_tue', 'backend', 'Tue', 'मंगल', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 14:07:55', '2022-07-14 08:37:55'),
(427, 'txt_day_short_wed', 'backend', 'Wed', 'बुध', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 14:07:56', '2022-07-14 08:37:56'),
(428, 'txt_day_short_thu', 'backend', 'Thu', 'गुरु', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 14:07:56', '2022-07-14 08:37:56'),
(429, 'txt_day_short_fri', 'backend', 'Fri', 'शुक्र', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 14:07:56', '2022-07-14 08:37:56'),
(430, 'txt_day_short_sat', 'backend', 'Sat', 'शनि', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 14:07:56', '2022-07-14 08:37:56'),
(431, 'txt_day_short_sun', 'backend', 'Sun', 'रवि', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 14:07:56', '2022-07-14 08:37:56'),
(432, 'txt_price_rules', 'backend', 'Price Rules', 'मूल्य नियम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-14 14:48:54', '2022-07-14 09:18:54'),
(433, 'btn_next', 'backend', 'Next', 'अगला', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-15 13:59:54', '2022-07-15 08:29:54'),
(434, 'btn_prev', 'backend', 'Previous', 'पिछला', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-20 11:57:46', '2022-07-20 06:27:46'),
(435, 'btn_back', 'backend', 'Back', 'पीछे', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-20 11:57:46', '2022-07-20 06:27:46'),
(436, 'txt_per_room', 'backend', 'per room', 'प्रति कमरा', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-20 11:57:46', '2022-07-20 06:27:46'),
(437, 'txt_date_wise_price_info', 'backend', 'Date wise Price', 'तिथिवार मूल्य', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-22 10:42:15', '2022-07-22 05:12:15'),
(438, 'txt_fill_basic_info', 'backend', 'Fill Basic Info', 'बुनियादी जानकारी भरें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-22 10:42:15', '2022-07-22 05:12:15'),
(439, 'sidemenu_stock_report', 'backend', 'Stock Report', 'स्टॉक रिपोर्ट्', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-29 12:48:46', '2022-07-29 07:18:46'),
(440, 'btn_set_complete', 'backend', 'Set Complete', 'पूरा सेट करें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-29 15:56:26', '2022-07-29 10:26:26'),
(441, 'btn_set_inprogress', 'backend', 'Set InProgress', 'प्रगति पर सेट करें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-29 15:56:26', '2022-07-29 10:26:26'),
(442, 'btn_price_break', 'backend', 'Price Break', 'कीमत को तोड़ना', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 10:32:11', '2022-07-30 05:02:11'),
(443, 'txt_stock_date', 'backend', 'Stock Date', 'स्टॉक तिथि', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 10:46:01', '2022-07-30 05:16:01'),
(444, 'txt_perm_profile', 'backend', 'Profile Permission', 'प्रोफ़ाइल', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:21', '2022-07-30 08:31:50'),
(445, 'txt_perm_season', 'backend', 'Season Permission', 'मौसम', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:21', '2022-07-30 08:31:50'),
(446, 'txt_perm_laundry', 'backend', 'Laundry Permission', 'लॉन्ड्री', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:21', '2022-07-30 08:31:50'),
(447, 'txt_perm_housekeeping', 'backend', 'Housekeeping Permission', 'हाउसकीपिंग', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:22', '2022-07-30 08:31:50'),
(448, 'txt_perm_language', 'backend', 'Language Permission', 'भाषा', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:22', '2022-07-30 08:31:50'),
(449, 'txt_perm_vendor', 'backend', 'Vendor Permission', 'विक्रेता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:22', '2022-07-30 08:31:51'),
(450, 'txt_perm_report', 'backend', 'Report Permission', 'रिपोर्ट्', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:22', '2022-07-30 08:31:51'),
(451, 'txt_perm_website_page', 'backend', 'Website Permission', 'वेबसाइट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:22', '2022-07-30 08:31:51'),
(452, 'txt_perm_other', 'backend', 'Other Permission', 'अन्य', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:22', '2022-07-30 08:31:51'),
(453, 'txt_perm_inventory', 'backend', 'inventory Permission', 'भंडार', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:22', '2022-07-30 08:31:51'),
(454, 'txt_perm_food', 'backend', 'Food Permission', 'डैशबोर्ड', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:22', '2022-07-30 08:31:51'),
(455, 'txt_perm_expense', 'backend', 'Expense Permission', 'खर्च', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:22', '2022-07-30 08:31:51'),
(456, 'txt_perm_customer', 'backend', 'Customer Permission', 'ग्राहक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:22', '2022-07-30 08:31:51'),
(457, 'txt_perm_user', 'backend', 'User Permission', 'उपयोगकर्ता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:22', '2022-07-30 08:31:51'),
(458, 'txt_perm_settings', 'backend', 'Settings', 'सेटिंग्स', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 14:01:51', '2022-07-30 08:31:51'),
(459, 'txt_perm_room', 'backend', 'Room Permission', 'कक्ष', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:22', '2022-07-30 08:31:51'),
(460, 'txt_perm_room_reservation', 'backend', 'Room Res. Permission', 'कक्ष आरक्षण', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:22', '2022-07-30 08:31:51'),
(461, 'txt_perm_dashboard', 'backend', 'Dashboard Permission', 'डैशबोर्ड', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:21', '2022-07-30 08:48:48'),
(462, 'sidemenu_contactus_page', 'backend', 'Contact Us Page', 'संपर्क पेज', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 17:38:17', '2022-07-30 12:08:17'),
(463, 'sidemenu_aboutus_page', 'backend', 'About Us Page', 'हमारे बारे में पेज', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 17:38:17', '2022-07-30 12:08:17'),
(464, 'sidemenu_home_page', 'backend', 'Home Page', 'होम पेज', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 17:38:17', '2022-07-30 12:08:17'),
(465, 'sidemenu_website', 'backend', 'Website', 'वेबसाइट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 17:38:17', '2022-07-30 12:08:17'),
(466, 'txt_laundry_status', 'backend', 'Laundry Status', 'लॉन्ड्री स्थिति', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 18:16:49', '2022-07-30 12:45:35'),
(467, 'txt_laundry_item', 'backend', 'Laundry Item', 'लॉन्ड्री सामान', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 18:16:49', '2022-07-30 12:45:36'),
(468, 'sidemenu_laundry', 'backend', 'Laundry', 'लॉन्ड्री', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 18:16:49', '2022-07-30 12:45:36'),
(469, 'txt_order', 'backend', 'Order', 'ऑर्डर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 18:21:49', '2022-07-30 12:51:49'),
(470, 'txt_laundry_order_status', 'backend', 'Laundry Order Status', 'आदेश की स्थिति', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 21:16:43', '2022-07-30 15:46:43'),
(471, 'txt_select_vendor', 'backend', 'Select Vendor', 'विक्रेता का चयन करें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 21:16:43', '2022-07-30 15:46:43'),
(472, 'txt_sent_qty', 'backend', 'Sent Quantity', 'भेजी गई मात्रा', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 22:27:14', '2022-07-30 16:57:14'),
(473, 'txt_rcv_qty', 'backend', 'Received Quantity', 'प्राप्त मात्रा', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 22:27:14', '2022-07-30 16:57:14'),
(474, 'txt_rcv_date', 'backend', 'Received Date', 'प्राप्त की तारीख', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 22:54:51', '2022-07-30 17:24:51'),
(475, 'txt_rcvd_invoice_num', 'backend', 'Received Invoice No.', 'प्राप्त चालान संख्या', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 23:00:27', '2022-07-30 17:30:27'),
(476, 'txt_rcvd_invoice', 'backend', 'Received Invoice', 'प्राप्त चालान', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-30 23:00:27', '2022-07-30 17:30:27'),
(477, 'txt_sort_order_num', 'backend', 'Sort Order', 'क्रमबद्ध करेन का आदेश', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:23:20', '2022-07-31 04:53:20'),
(478, 'txt_vendor', 'backend', 'Vendor', 'विक्रेता', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:26:21', '2022-07-31 04:56:21'),
(479, 'txt_order_status', 'backend', 'Order Status', 'आदेश की स्थिति', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 10:28:41', '2022-07-31 04:58:41'),
(480, 'txt_set', 'backend', 'Set', 'सेट', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 11:47:01', '2022-07-31 06:17:01'),
(481, 'txt_tax', 'backend', 'Tax', 'कर', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 12:23:24', '2022-07-31 06:53:24'),
(482, 'txt_laundry_gst', 'backend', 'Laundry GST', 'लॉन्ड्री जी.एस.टी.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 12:28:23', '2022-07-31 06:58:23'),
(483, 'btn_complete_order', 'backend', 'Complete Order', 'आदेश पूरा', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 13:58:27', '2022-07-31 08:28:27'),
(484, 'heading_filter_laundry_orders', 'backend', 'Filter Laundry Orders', 'लॉन्ड्री आदेश फ़िल्टर करें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 18:57:09', '2022-07-31 13:27:09'),
(485, 'sidemenu_lang_settings', 'backend', 'Language Settings', 'भाषा सेटिंग्स', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 20:33:44', '2022-07-31 15:03:44'),
(486, 'sidemenu_general_settings', 'backend', 'General Settings', 'सामान्य सेटिंग्स', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 20:33:44', '2022-07-31 15:03:44'),
(487, 'sidemenu_permissions_settings', 'backend', 'Permission Settings', 'अनुमति सेटिंग्स', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 20:35:27', '2022-07-31 15:05:27'),
(488, 'txt_download', 'backend', 'Download', 'डाउनलोड', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 22:56:24', '2022-07-31 17:26:24'),
(489, 'sidemenu_seasons_add', 'backend', 'Add Season', 'मौसम जोड़ें', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-31 22:56:24', '2022-07-31 17:26:24'),
(490, 'txt_complete_date', 'backend', 'Complete Date', 'पूर्ण दिनांक', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-01 10:56:04', '2022-08-01 05:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_items`
--

CREATE TABLE `laundry_items` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL DEFAULT '0.00',
  `min_qty` int(11) NOT NULL DEFAULT '1',
  `max_qty` int(11) NOT NULL DEFAULT '10',
  `description` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laundry_items`
--

INSERT INTO `laundry_items` (`id`, `vendor_id`, `name`, `price`, `min_qty`, `max_qty`, `description`, `status`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, NULL, 'Shirt', 0.00, 1, 10, NULL, 1, 0, '2022-07-30 19:48:01', '2022-07-30 14:18:01'),
(2, NULL, 'T-Shirt', 0.00, 1, 10, NULL, 1, 0, '2022-07-30 19:49:17', '2022-07-30 14:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_orders`
--

CREATE TABLE `laundry_orders` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_mobile` varchar(15) DEFAULT NULL,
  `customer_address` text,
  `customer_gender` varchar(10) DEFAULT NULL,
  `gst_apply` int(11) DEFAULT '0' COMMENT '1=Yes',
  `gst_perc` float(10,2) DEFAULT '0.00',
  `gst_amount` float(10,2) DEFAULT '0.00',
  `cgst_perc` float(10,2) DEFAULT '0.00',
  `cgst_amount` float(10,2) DEFAULT '0.00',
  `discount` float(10,2) DEFAULT '0.00',
  `total_amount` float(10,2) DEFAULT '0.00',
  `invoice_prefix` varchar(100) DEFAULT NULL,
  `invoice_num` int(11) DEFAULT NULL,
  `order_num` int(11) DEFAULT '0',
  `order_num_prefix` varchar(100) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `payment_mode` int(11) DEFAULT NULL,
  `order_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=Open',
  `status` int(11) NOT NULL DEFAULT '1',
  `remark` text,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laundry_orders`
--

INSERT INTO `laundry_orders` (`id`, `vendor_id`, `room_id`, `customer_name`, `customer_email`, `customer_mobile`, `customer_address`, `customer_gender`, `gst_apply`, `gst_perc`, `gst_amount`, `cgst_perc`, `cgst_amount`, `discount`, `total_amount`, `invoice_prefix`, `invoice_num`, `order_num`, `order_num_prefix`, `order_date`, `received_date`, `payment_mode`, `order_status`, `status`, `remark`, `updated_at`, `created_at`) VALUES
(1, 1, 1, 'test test', 'test@gmail.com', '1234567890', 'address', NULL, 0, 6.00, 0.00, 6.00, 0.00, 0.00, 100.00, NULL, 9000011, 1, NULL, '2022-07-26 00:00:00', '2022-07-31', NULL, 2, 1, '090', '2022-07-31 18:44:58', '2022-07-31 04:43:07'),
(2, 1, 6, 'Bheem Swami', 'bheemswami808@gmail.com', '09001456808', 'H.No.439, Near simla cold store, sharma colony, Rani Bazar', 'Male', 1, 6.00, 311.40, 6.00, 311.40, 900.00, 4912.80, NULL, 90909, 1, NULL, '2022-07-31 00:00:00', '2022-07-31', NULL, 3, 1, 'oioio', '2022-07-31 22:48:09', '2022-07-31 04:44:52'),
(3, 1, NULL, 'Bheem Swami', 'bheemswami808@gmail.com', '09001456808', 'H.No.439, Near simla cold store, sharma colony, Rani Bazar', 'Male', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 2, NULL, '2022-07-31 00:00:00', NULL, NULL, 1, 1, NULL, '2022-07-31 23:15:04', '2022-07-31 10:29:26'),
(5, 1, NULL, 'Bheem Swami', 'bheemswami808@gmail.com', '09001456808', 'H.No.439, Near simla cold store, sharma colony, Rani Bazar', 'Male', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 2, NULL, '2022-07-29 00:00:00', NULL, NULL, 0, 1, NULL, '2022-07-31 16:28:28', '2022-07-31 10:58:28'),
(6, 1, NULL, 'Bheem Swami', 'bheemswami808@gmail.com', '09001456808', 'H.No.439, Near simla cold store, sharma colony, Rani Bazar', 'Male', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 2, NULL, '2022-07-31 00:00:00', NULL, NULL, 0, 1, NULL, '2022-07-31 16:29:07', '2022-07-31 10:59:07'),
(7, 1, NULL, 'Bheem Swami', 'bheemswami808@gmail.com', '09001456808', 'H.No.439, Near simla cold store, sharma colony, Rani Bazar', 'Male', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 2, NULL, '2022-07-31 00:00:00', NULL, NULL, 0, 1, NULL, '2022-07-31 16:31:24', '2022-07-31 11:01:24'),
(9, 1, NULL, 'Uma Swami', 'jaiswami808@gmail.com', '9001456808', 'Akhey Raj Puri Bagechi,Sharma Colony\r\nRani Bazar', 'Male', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 2, NULL, '2022-07-31 00:00:00', NULL, NULL, 0, 1, NULL, '2022-07-31 16:35:33', '2022-07-31 11:05:33'),
(10, 1, NULL, 'Uma Swami', 'jaiswami808@gmail.com', '9001456808', 'Akhey Raj Puri Bagechi,Sharma Colony\r\nRani Bazar', 'Male', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 2, NULL, '2022-07-31 00:00:00', NULL, NULL, 0, 1, NULL, '2022-07-31 16:36:11', '2022-07-31 11:06:11'),
(11, 1, NULL, 'Uma Swami', 'jaiswami808@gmail.com', '9001456808', 'Akhey Raj Puri Bagechi,Sharma Colony\r\nRani Bazar', 'Male', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 2, NULL, '2022-07-31 00:00:00', NULL, NULL, 0, 1, NULL, '2022-07-31 16:37:06', '2022-07-31 11:07:06'),
(12, 1, 6, 'test test', 'test@gmail.com', '1234567890', 'address', NULL, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 2, NULL, '2022-07-31 00:00:00', NULL, NULL, 0, 1, NULL, '2022-07-31 23:10:41', '2022-07-31 17:40:41'),
(13, 1, 1, 'test test', 'test@gmail.com', '1234567890', 'address', NULL, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 2, NULL, '2022-07-31 00:00:00', NULL, NULL, 0, 1, NULL, '2022-07-31 23:12:22', '2022-07-31 17:42:22'),
(14, 1, NULL, 'test test', 'test@gmail.com', '1234567890', 'address', NULL, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 3, NULL, '2022-07-31 00:00:00', NULL, NULL, 2, 1, NULL, '2022-07-31 23:15:44', '2022-07-31 17:43:19'),
(15, 1, 1, 'test test', 'test@gmail.com', '1234567890', 'address', 'Male', 1, 6.00, 6.60, 6.00, 6.60, 2.00, 121.20, NULL, 1009, 4, NULL, '2022-08-01 00:00:00', '2022-08-01', NULL, 3, 1, NULL, '2022-08-01 10:33:37', '2022-08-01 05:01:42'),
(16, 1, 6, 'test test', 'test@gmail.com', '1234567890', 'address', 'Male', 1, 6.00, 19.50, 6.00, 19.50, 60.00, 304.00, NULL, 10010, 5, NULL, '2022-08-01 00:00:00', '2022-08-01', NULL, 3, 1, NULL, '2022-08-01 10:39:53', '2022-08-01 05:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_order_items`
--

CREATE TABLE `laundry_order_items` (
  `id` int(11) NOT NULL,
  `laundry_order_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_price` float(10,2) NOT NULL,
  `sent_item_qty` int(11) NOT NULL,
  `rcv_item_qty` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laundry_order_items`
--

INSERT INTO `laundry_order_items` (`id`, `laundry_order_id`, `item_id`, `item_name`, `item_price`, `sent_item_qty`, `rcv_item_qty`, `updated_at`, `created_at`) VALUES
(27, 4, 1, NULL, 0.00, 9, 0, NULL, '2022-07-31 10:30:43'),
(28, 11, 1, NULL, 0.00, 1, 0, NULL, '2022-07-31 11:07:06'),
(29, 11, 1, NULL, 0.00, 1, 0, NULL, '2022-07-31 11:07:06'),
(33, 1, 1, NULL, 10.00, 10, 10, NULL, '2022-07-31 13:14:58'),
(34, 2, 1, NULL, 30.00, 90, 90, NULL, '2022-07-31 17:18:09'),
(35, 2, 2, NULL, 10.00, 89, 89, NULL, '2022-07-31 17:18:09'),
(36, 2, 1, NULL, 20.00, 80, 80, NULL, '2022-07-31 17:18:09'),
(41, 3, 1, NULL, 0.00, 90, 0, NULL, '2022-07-31 17:39:16'),
(42, 12, 1, NULL, 0.00, 80, 0, NULL, '2022-07-31 17:40:41'),
(43, 13, 1, NULL, 0.00, 90, 0, NULL, '2022-07-31 17:42:23'),
(44, 14, 2, NULL, 0.00, 900, 0, NULL, '2022-07-31 17:43:19'),
(47, 15, 1, NULL, 5.00, 10, 10, NULL, '2022-08-01 05:03:37'),
(48, 15, 2, NULL, 3.00, 20, 20, NULL, '2022-08-01 05:03:37'),
(51, 16, 2, NULL, 10.00, 10, 10, NULL, '2022-08-01 05:09:53'),
(52, 16, 1, NULL, 15.00, 15, 15, NULL, '2022-08-01 05:09:53');

-- --------------------------------------------------------

--
-- Table structure for table `media_files`
--

CREATE TABLE `media_files` (
  `id` int(11) NOT NULL,
  `tbl_id` int(11) NOT NULL,
  `type` enum('id_cards','expenses','home_banner','room_image','room_type_image','laundry_invoice','') NOT NULL DEFAULT 'id_cards',
  `file` varchar(255) DEFAULT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media_files`
--

INSERT INTO `media_files` (`id`, `tbl_id`, `type`, `file`, `original_name`, `updated_at`, `created_at`) VALUES
(2, 1, 'room_type_image', 'ff4e4e4e0f62bc83ef07204d2582bb73_1636180770.jpeg', NULL, NULL, '2021-11-06 06:39:30'),
(5, 2, 'room_image', '2937b4987e7bacdb0be6962716726cca_1636183651.jpeg', NULL, NULL, '2021-11-06 07:27:31'),
(6, 3, 'room_image', '32f10201c33fa2019d3e8251739eb1f7_1636185434.jpeg', NULL, NULL, '2021-11-06 07:57:14'),
(9, 5, 'room_image', '20472c540d05088b2a29ab5f93727d24_1636185530.jpeg', NULL, NULL, '2021-11-06 07:58:50'),
(10, 2, 'room_image', '46ef52d27e10b3bb0581c200fecbf972_1636185504.jpeg', NULL, NULL, '2021-11-06 07:27:31'),
(11, 2, 'room_image', '46ef52d27e10b3bb0581c200fecbf972_1636185504.jpeg', NULL, NULL, '2021-11-06 07:27:31'),
(13, 3, 'room_type_image', 'bdb9fb3a25b377ad3ea8e4c384942d15_1637669641.jpg', NULL, NULL, '2021-11-23 12:14:01'),
(14, 3, 'room_type_image', '14f97d97498ecd5a36b256de3e674f57_1637669838.jpg', NULL, NULL, '2021-11-23 12:17:18'),
(16, 2, 'room_type_image', '721700bed00356aeb25afd7478adb4fa_1637669914.jpg', NULL, NULL, '2021-11-23 12:18:34'),
(17, 2, 'room_type_image', 'cce8ad9409990888ea4af690c5fcbb79_1637669962.jpg', NULL, NULL, '2021-11-23 12:19:22'),
(18, 1, 'room_image', '14f97d97498ecd5a36b256de3e674f57_1637670039.jpg', NULL, NULL, '2021-11-23 12:20:39'),
(19, 4, 'room_image', '721700bed00356aeb25afd7478adb4fa_1637670085.jpg', NULL, NULL, '2021-11-23 12:21:25'),
(21, 1, 'home_banner', '4b88868fc17844cbfda6646b2c22d75e_1637727766.jpg', NULL, NULL, '2021-11-24 04:22:46'),
(22, 1, 'home_banner', '205b77cf61fc31d3099c652c1b35e1ce_1637727766.jpg', NULL, NULL, '2021-11-24 04:22:46'),
(23, 1, 'home_banner', '6115685e833c57281bf9c21f39903644_1637728573.jpg', NULL, NULL, '2021-11-24 04:36:13'),
(24, 2, 'laundry_invoice', '8a008d88e22b011992a9e63145dbe982_1659287889.pdf', NULL, NULL, '2022-07-31 17:18:09'),
(25, 15, 'laundry_invoice', '768cd605bc77a80d4cdc7b3fd552f803_1659330217.png', NULL, NULL, '2022-08-01 05:03:37'),
(26, 16, 'laundry_invoice', 'e3741967972c6d89df0a378711e81fd4_1659330593.png', NULL, NULL, '2022-08-01 05:09:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `json_data` text,
  `notifi_from` int(11) DEFAULT NULL,
  `notifi_to` int(11) DEFAULT NULL,
  `notifi_type` varchar(100) DEFAULT NULL,
  `notifi_datetime` datetime DEFAULT NULL,
  `notifi_msg` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=Unread 1=Read 2=deleted',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `invoice_prefix` varchar(100) DEFAULT NULL,
  `invoice_num` int(11) DEFAULT NULL,
  `table_num` varchar(10) DEFAULT NULL,
  `gst_apply` int(11) DEFAULT '0' COMMENT '1=Yes',
  `gst_perc` float(10,2) DEFAULT '0.00',
  `gst_amount` float(10,2) DEFAULT '0.00',
  `cgst_perc` float(10,2) DEFAULT '0.00',
  `cgst_amount` float(10,2) DEFAULT '0.00',
  `discount` float(10,2) DEFAULT '0.00',
  `total_amount` float(10,2) DEFAULT '0.00',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` text,
  `mobile` varchar(15) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `payment_mode` int(11) DEFAULT NULL,
  `num_of_person` int(11) DEFAULT NULL,
  `waiter_name` varchar(255) DEFAULT NULL,
  `waiter_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `original_date` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `reservation_id`, `invoice_prefix`, `invoice_num`, `table_num`, `gst_apply`, `gst_perc`, `gst_amount`, `cgst_perc`, `cgst_amount`, `discount`, `total_amount`, `name`, `email`, `gender`, `address`, `mobile`, `invoice_date`, `payment_mode`, `num_of_person`, `waiter_name`, `waiter_id`, `status`, `original_date`, `updated_at`, `created_at`) VALUES
(1, NULL, NULL, NULL, '11', NULL, 0.00, 0.00, 0.00, 0.00, NULL, 1600.00, 'Bheem', 'bheem@gmail.com', NULL, 'BKN', '09001456808', '2022-08-13', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2022-08-13 12:51:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_histories`
--

CREATE TABLE `order_histories` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `table_num` varchar(10) NOT NULL,
  `is_book` int(11) NOT NULL DEFAULT '1' COMMENT '1=Booked',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_histories`
--

INSERT INTO `order_histories` (`id`, `order_id`, `table_num`, `is_book`, `updated_at`, `created_at`) VALUES
(1, 1, '11', 1, NULL, '2022-08-13 12:51:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_history_id` int(11) DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` float(10,2) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `json_data` text,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=Pending,2=Process,3=Delivered,4=Cancelled',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `order_history_id`, `reservation_id`, `item_name`, `item_price`, `item_qty`, `json_data`, `status`, `updated_at`, `created_at`) VALUES
(1, 1, 1, NULL, 'Item 1', 100.00, 4, '{\"category_id\":\"1\",\"category_name\":\"Category 1\",\"item_name\":\"Item 1\",\"item_id\":1}', 3, NULL, '2022-08-13 12:51:55'),
(2, 1, 1, NULL, 'item2', 200.00, 6, '{\"category_id\":\"1\",\"category_name\":\"Category 1\",\"item_name\":\"item2\",\"item_id\":2}', 3, NULL, '2022-08-13 12:51:55');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `payment_amount` double DEFAULT NULL,
  `payment_type` varchar(128) DEFAULT NULL,
  `cheque_num` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL COMMENT 'user_id',
  `transaction_id` text,
  `purpose` varchar(255) DEFAULT NULL,
  `credit_debit` enum('Credit','Debit','') DEFAULT NULL,
  `remark` text,
  `tbl_id` int(11) DEFAULT NULL,
  `tbl_name` varchar(60) DEFAULT NULL,
  `json_data` text,
  `order_id` varchar(255) DEFAULT NULL,
  `payment_of` enum('cr','dr','') DEFAULT NULL COMMENT 'for admin use only',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`id`, `user_id`, `customer_id`, `payment_amount`, `payment_type`, `cheque_num`, `bank_name`, `payment_date`, `added_by`, `transaction_id`, `purpose`, `credit_debit`, `remark`, `tbl_id`, `tbl_name`, `json_data`, `order_id`, `payment_of`, `updated_at`, `created_at`) VALUES
(1, 6, 1, 22, 'Cash', NULL, NULL, '2022-07-12 15:55:42', 1, 'zY1nM1rX', 'ROOM_ADVANCE', 'Debit', NULL, 1, 'reservations', NULL, NULL, 'cr', '2022-07-12 15:55:42', '2022-07-12 10:25:42'),
(2, 6, 1, 10, 'Cash', NULL, NULL, '2022-07-12 15:57:38', 1, 'nvssROQ1', 'ROOM_ADVANCE', 'Debit', NULL, 1, 'reservations', NULL, NULL, 'cr', NULL, '2022-07-12 10:27:38'),
(3, 6, 1, 1090, 'Cash', NULL, NULL, '2022-07-22 11:04:33', 1, 'QmC2H6pF', 'ROOM_ADVANCE', 'Debit', NULL, 23, 'reservations', NULL, NULL, 'cr', '2022-07-22 11:04:33', '2022-07-22 05:34:33'),
(4, 6, 1, 58464, 'Cash', NULL, NULL, '2022-07-22 11:29:21', 1, '4wslaHZo', 'ROOM_AMOUNT', 'Debit', NULL, 1, 'reservations', NULL, NULL, 'cr', '2022-07-22 11:29:21', '2022-07-22 05:59:21'),
(5, 6, 1, 58464, 'Cash', NULL, NULL, '2022-07-22 12:01:17', 1, 'f2iwh12O', 'ROOM_AMOUNT', 'Debit', NULL, 2, 'reservations', NULL, NULL, 'cr', '2022-07-22 12:01:17', '2022-07-22 06:31:17'),
(6, 6, 1, 4368, 'Cash', NULL, NULL, '2022-07-26 20:25:20', 1, '2hUD0Oar', 'ROOM_AMOUNT', 'Debit', NULL, 3, 'reservations', NULL, NULL, 'cr', '2022-07-26 20:25:20', '2022-07-26 14:55:20'),
(7, 6, 1, 6000, 'Cash', NULL, NULL, '2022-07-29 20:29:34', 1, 'I1VcV9J4', 'ROOM_ADVANCE', 'Debit', NULL, 5, 'reservations', NULL, NULL, 'cr', '2022-07-29 20:29:34', '2022-07-29 14:59:34'),
(8, 6, 1, 6000, 'Cash', NULL, NULL, '2022-07-30 10:22:15', 1, 'F49F7hsY', 'ROOM_ADVANCE', 'Debit', NULL, 6, 'reservations', NULL, NULL, 'cr', '2022-07-30 10:22:15', '2022-07-30 04:52:15'),
(9, NULL, NULL, 4912.8, 'Cash', NULL, NULL, '2022-07-31 22:48:09', 1, 'RedxN4N1', 'LAUNDRY_AMOUNT', 'Debit', NULL, 2, 'laundry_orders', NULL, NULL, 'cr', '2022-07-31 22:48:10', '2022-07-31 09:12:44'),
(10, 6, 1, 6376, 'Cash', NULL, NULL, '2022-07-31 15:26:10', 1, 'MSR11J2n', 'ROOM_AMOUNT', 'Debit', NULL, 6, 'reservations', NULL, NULL, 'cr', '2022-07-31 15:26:10', '2022-07-31 09:56:10'),
(11, NULL, NULL, 121.2, 'Cash', NULL, NULL, '2022-08-01 10:33:37', 1, '8Mxn5e9m', 'LAUNDRY_AMOUNT', 'Debit', NULL, 15, 'laundry_orders', NULL, NULL, 'cr', '2022-08-01 10:33:37', '2022-08-01 05:03:37'),
(12, NULL, NULL, 304, 'Cash', NULL, NULL, '2022-08-01 10:39:53', 1, 'aaoromuc', 'LAUNDRY_AMOUNT', 'Debit', NULL, 16, 'laundry_orders', NULL, NULL, 'cr', '2022-08-01 10:39:53', '2022-08-01 05:09:53'),
(13, 1, NULL, 900, 'Cash', NULL, NULL, '2022-08-01 00:00:00', 1, 'm1nTsBmx', 'EXPENSE', '', NULL, 1, 'expenses', NULL, NULL, 'dr', '2022-08-01 12:40:44', '2022-08-01 07:10:44'),
(14, 6, 1, 6944, 'Cash', NULL, NULL, '2022-08-14 16:06:58', 1, 'bn3c1958', 'ROOM_AMOUNT', 'Debit', NULL, 14, 'reservations', NULL, NULL, 'cr', '2022-08-14 16:06:58', '2022-08-14 10:36:58'),
(15, 6, 1, 0, 'Cash', NULL, NULL, '2022-08-14 16:07:10', 1, 'dy8YNeF6', 'ROOM_AMOUNT', 'Debit', NULL, 15, 'reservations', NULL, NULL, 'cr', '2022-08-14 16:07:10', '2022-08-14 10:37:10'),
(16, 6, 1, 0, 'Cash', NULL, NULL, '2022-08-14 16:07:20', 1, 'xR4C7sch', 'ROOM_AMOUNT', 'Debit', NULL, 16, 'reservations', NULL, NULL, 'cr', '2022-08-14 16:07:20', '2022-08-14 10:37:20'),
(17, 6, 1, 0, 'Cash', NULL, NULL, '2022-08-14 16:14:13', 1, 'r5aa37TO', 'ROOM_AMOUNT', 'Debit', NULL, 17, 'reservations', NULL, NULL, 'cr', '2022-08-14 16:14:13', '2022-08-14 10:44:13');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `description` text,
  `slug` varchar(255) NOT NULL,
  `category` enum('dashboard','room_reservation','room','settings','user','customer','expense','food','inventory','website','report','vendor','language','housekeeping','laundry','season','profile','other','') DEFAULT NULL,
  `super_admin` int(11) NOT NULL DEFAULT '1',
  `admin` int(11) NOT NULL DEFAULT '1',
  `receptionist` int(11) NOT NULL DEFAULT '1',
  `store_manager` int(11) NOT NULL DEFAULT '0',
  `financial_manager` int(11) NOT NULL DEFAULT '0',
  `customer` int(11) NOT NULL DEFAULT '0',
  `housekeeper` int(11) NOT NULL DEFAULT '0',
  `permission_type` enum('menu','route') NOT NULL DEFAULT 'route',
  `status` int(11) NOT NULL DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `parent_id`, `description`, `slug`, `category`, `super_admin`, `admin`, `receptionist`, `store_manager`, `financial_manager`, `customer`, `housekeeper`, `permission_type`, `status`, `updated_at`, `created_at`) VALUES
(1, NULL, 'Dashboard', 'dashboard', 'dashboard', 1, 1, 1, 0, 0, 0, 1, 'route', 1, '2022-08-01 09:33:56', '2019-09-07 13:07:07'),
(2, NULL, 'Profile', 'profile', 'profile', 1, 1, 1, 1, 1, 0, 1, 'route', 1, '2022-08-01 09:31:06', '2019-09-07 13:07:07'),
(3, NULL, 'Profile: Save', 'save-profile', 'profile', 1, 1, 1, 1, 1, 0, 1, 'route', 1, '2022-08-01 09:31:06', '2019-09-07 13:07:07'),
(4, NULL, 'Users: Add', 'add-user', 'user', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-08-01 09:31:38', '2019-09-07 14:24:04'),
(5, NULL, 'Users: Edit', 'edit-user', 'user', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-08-01 09:31:38', '2019-09-07 14:24:42'),
(6, NULL, 'Users: Save', 'save-user', 'user', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-08-01 09:31:38', '2019-09-07 14:24:42'),
(7, NULL, 'Users: List', 'list-user', 'user', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-08-01 09:31:38', '2019-09-07 14:25:56'),
(8, NULL, 'Users: Delete', 'delete-user', 'user', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-08-01 09:31:38', '2019-09-07 14:25:56'),
(9, NULL, 'Rooms: Add', 'add-room', 'room', 1, 0, 0, 0, 0, 0, 0, 'route', 1, '2022-07-11 14:38:25', '2019-09-07 14:25:56'),
(10, NULL, 'Rooms: Edit', 'edit-room', 'room', 1, 0, 0, 0, 0, 0, 0, 'route', 1, '2022-07-11 14:38:17', '2019-09-07 14:25:56'),
(11, NULL, 'Rooms: Save', 'save-room', 'room', 1, 0, 0, 0, 0, 0, 0, 'route', 1, '2022-07-11 14:38:28', '2019-09-07 14:26:41'),
(12, NULL, 'Rooms: List', 'list-room', 'room', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 14:26:41'),
(13, NULL, 'Delete Room', 'delete-room', 'room', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 14:26:41'),
(14, NULL, 'Room Types: Add', 'add-room-types', 'room', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 14:26:41'),
(15, NULL, 'Room Types: Edit', 'edit-room-types', 'room', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 14:27:50'),
(16, NULL, 'Room Types: Save', 'save-room-types', 'room', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 14:27:50'),
(17, NULL, 'Room Types: List', 'list-room-types', 'room', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 14:27:50'),
(18, NULL, 'Delete Room Types', 'delete-room-types', 'room', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 14:27:50'),
(19, NULL, 'Amenities: Add', 'add-amenities', 'room', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 14:29:41'),
(20, NULL, 'Amenities: Edit', 'edit-amenities', 'room', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 14:29:41'),
(21, NULL, 'Amenities: Save', 'save-amenities', 'room', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:25', '2019-09-07 14:29:41'),
(22, NULL, 'Amenities: List', 'list-amenities', 'room', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:25', '2019-09-07 14:29:41'),
(23, NULL, 'Amenities: Delete', 'delete-amenities', 'room', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:25', '2019-09-07 14:29:41'),
(24, NULL, 'Check In: Room Reservation', 'room-reservation', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:41', '2019-09-07 14:29:41'),
(25, NULL, 'Check In: Edit Reservation', 'edit-reservation', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 0, '2020-11-14 10:40:37', '2019-09-07 14:29:41'),
(26, NULL, 'Check In: Save Reservation', 'save-reservation', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:41', '2019-09-07 14:29:41'),
(27, NULL, 'Check Out', 'check-out-room', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:41', '2019-09-07 14:29:41'),
(28, NULL, 'Check Out: List', 'check-out', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:41', '2019-09-07 14:29:41'),
(29, NULL, 'Check In: List Reservation', 'list-reservation', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:41', '2019-09-07 14:31:49'),
(30, NULL, 'Check In: View Reservation', 'view-reservation', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:41', '2019-09-07 14:31:49'),
(31, NULL, 'Check In: Delete Reservation', 'delete-reservation', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:41', '2019-09-07 14:31:49'),
(32, NULL, 'Food Category: Add', 'add-food-category', 'food', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:38', '2019-09-07 14:31:49'),
(33, NULL, 'Food Category: Save', 'save-food-category', 'food', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:38', '2019-09-07 14:31:49'),
(34, NULL, 'Food Category: List', 'list-food-category', 'food', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:38', '2019-09-07 14:31:49'),
(35, NULL, 'Food Category: Delete', 'delete-food-category', 'food', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:38', '2019-09-07 14:31:49'),
(36, NULL, 'Food Item: Add', 'add-food-item', 'food', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:38', '2019-09-07 14:31:49'),
(37, NULL, 'Foot Item: Edit', 'edit-food-item', 'food', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:38', '2019-09-07 14:31:49'),
(38, NULL, 'Food Item: Save', 'save-food-item', 'food', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:38', '2019-09-07 14:31:49'),
(39, NULL, 'Food Item: List', 'list-food-item', 'food', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:38', '2019-09-07 14:32:43'),
(40, NULL, 'Food Item: Delete', 'delete-food-item', 'food', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:38', '2019-09-07 14:32:43'),
(41, NULL, 'Food Orders: Add', 'food-order', 'food', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:39', '2019-09-07 14:34:54'),
(42, NULL, 'Food Orders: Save', 'save-food-order', 'food', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:39', '2019-09-07 14:34:54'),
(43, NULL, 'Food Orders: List', 'orders-list', 'food', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:39', '2019-09-07 14:34:54'),
(44, NULL, 'Product: Add', 'add-product', 'inventory', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:50', '2019-09-07 14:34:54'),
(45, NULL, 'Product: Edit', 'edit-product', 'inventory', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:50', '2019-09-07 14:34:54'),
(46, NULL, 'Product: Save', 'save-product', 'inventory', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:50', '2019-09-07 14:34:54'),
(47, NULL, 'Product: List', 'list-product', 'inventory', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:50', '2019-09-07 14:34:54'),
(48, NULL, 'Product: Delete', 'delete-product', 'inventory', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:50', '2019-09-07 14:34:54'),
(49, NULL, 'IO Stock', 'io-stock', 'inventory', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:51', '2019-09-07 14:34:54'),
(50, NULL, 'Stocks: Save', 'save-stock', 'inventory', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:51', '2019-09-07 14:34:54'),
(51, NULL, 'Stock History: List', 'stock-history', 'inventory', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:51', '2019-09-07 14:34:54'),
(52, NULL, 'Invoice', 'invoice', 'room_reservation', 1, 0, 0, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:41', '2019-09-07 15:20:44'),
(53, NULL, 'Settings', 'settings', 'other', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:38:07', '2019-09-07 15:20:44'),
(54, NULL, 'Settings: Save', 'save-settings', 'other', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:38:07', '2019-09-07 15:20:44'),
(55, NULL, 'Check Out: List', 'list-check-outs', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:42', '2019-09-07 15:20:44'),
(56, NULL, 'Invoice Order', 'order-invoice', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:42', '2019-09-07 15:20:44'),
(57, NULL, 'Invoice: Final Order', 'order-invoice-final', 'food', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:39', '2019-09-07 15:20:44'),
(58, NULL, 'Food order: Final', 'food-order-final', 'food', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:39', '2019-09-07 15:20:44'),
(59, NULL, 'Food Orders Table', 'food-order-table', 'food', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:39', '2019-09-07 15:20:44'),
(60, NULL, 'Invoice: kitchen', 'kitchen-invoice', 'food', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:39', '2019-09-07 15:20:44'),
(61, NULL, 'Food Order: Delete Item', 'delete-order-item', 'food', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:39', '2019-09-07 15:20:44'),
(62, NULL, 'Orders: Search', 'search-orders', 'food', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:39', '2019-09-07 15:20:44'),
(63, NULL, 'Orders: Export', 'export-orders', 'food', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:39', '2019-09-07 15:20:44'),
(64, NULL, 'Stock History: Search', 'search-stocks', 'inventory', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:51', '2019-09-07 15:20:44'),
(65, NULL, 'Stock History: Export', 'export-stocks', 'inventory', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:51', '2019-09-07 15:20:44'),
(66, NULL, 'Check In: Search', 'search-checkins', 'room_reservation', 1, 0, 0, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:42', '2019-09-07 15:20:44'),
(67, NULL, 'Check In: Export', 'export-checkins', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:42', '2019-09-07 15:20:44'),
(68, NULL, 'Check Out: Search', 'search-checkouts', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:42', '2019-09-07 15:20:44'),
(69, NULL, 'Check Out: Export', 'export-checkouts', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:42', '2019-09-07 15:20:44'),
(70, NULL, 'Media Files: Delete', 'delete-mediafile', 'other', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:38:07', '2019-09-07 15:20:44'),
(71, NULL, 'Permission: Update', 'save-permissions', 'other', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:38:07', '2019-09-07 15:20:44'),
(72, NULL, 'Permission: List', 'permissions-list', 'other', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:38:07', '2019-09-07 15:20:44'),
(73, NULL, 'Customer: Add', 'add-customer', 'customer', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(74, NULL, 'Customers: Edit', 'edit-customer', 'customer', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(75, NULL, 'Customer: Save', 'save-customer', 'customer', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(76, NULL, 'Customer: List', 'list-customer', 'customer', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(77, NULL, 'Customers: Delete', 'delete-customer', 'customer', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(78, NULL, 'Expense: Add', 'add-expense', 'expense', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:24', '2019-09-07 15:20:44'),
(79, NULL, 'Expense: Edit', 'edit-expense', 'expense', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:24', '2019-09-07 15:20:44'),
(80, NULL, 'Expense: Save', 'save-expense', 'expense', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:24', '2019-09-07 15:20:44'),
(81, NULL, 'Expense: List', 'list-expense', 'expense', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:24', '2019-09-07 15:20:44'),
(82, NULL, 'Expense: Delete', 'delete-expense', 'expense', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:24', '2019-09-07 15:20:44'),
(83, NULL, 'Expense: Add Category', 'add-expense-category', 'expense', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:24', '2019-09-07 15:20:44'),
(84, NULL, 'Expense Category: Edit', 'edit-expense-category', 'expense', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:24', '2019-09-07 15:20:44'),
(85, NULL, 'Expense Category: Save', 'save-expense-category', 'expense', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:24', '2019-09-07 15:20:44'),
(86, NULL, 'Expense Category: List', 'list-expense-category', 'expense', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:24', '2019-09-07 15:20:44'),
(87, NULL, 'Expense Category: Delete', 'delete-expense-category', 'expense', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:24', '2019-09-07 15:20:44'),
(88, NULL, 'Expense: Search', 'search-expenses', 'expense', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:24', '2019-09-07 15:20:44'),
(89, NULL, 'Expense: Export', 'export-expenses', 'expense', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:24', '2019-09-07 15:20:44'),
(90, NULL, 'Quick Check In', 'quick-check-in', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:42', '2019-09-07 14:29:41'),
(91, NULL, 'Check In: Advance Pay', 'advance-pay', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:42', '2019-09-07 08:59:41'),
(92, NULL, 'Check In: Swap Room', 'swap-room', 'room_reservation', 1, 0, 0, 0, 0, 0, 0, 'route', 0, '2022-07-11 14:38:31', '2019-09-07 08:59:41'),
(93, NULL, 'Check In: Swap Room Save', 'save-swap-room', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 0, '2022-07-10 12:50:26', '2019-09-07 08:59:41'),
(94, NULL, 'Dynamic Dropdowns', 'save-dynamic-dropdowns', 'other', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:38:07', '2019-09-07 09:50:44'),
(95, NULL, 'Dynamic Dropdowns: List', 'dynamic-dropdown-list', 'other', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:38:07', '2019-09-07 09:50:44'),
(96, NULL, 'Check Out: Mark As Paid', 'mark-as-paid', 'room_reservation', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-30 14:25:42', '2019-09-07 08:59:41'),
(97, NULL, 'Customer: Search', 'search-customer', 'customer', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:27', '2019-09-07 09:50:44'),
(98, NULL, 'Customer: Export', 'export-customer', 'customer', 1, 1, 1, 0, 0, 0, 0, 'route', 0, '2020-11-14 10:40:38', '2019-09-07 09:50:44'),
(99, NULL, 'Home Page ', 'home-page', 'website', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:27', '2019-09-07 06:29:02'),
(100, NULL, 'About Page ', 'about-page', 'website', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:27', '2019-09-07 06:29:02'),
(101, NULL, 'Contact Page ', 'contact-page', 'website', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:27', '2019-09-07 06:29:02'),
(102, NULL, 'Home Page Update', 'update-home-page', 'website', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:27', '2019-09-07 06:29:02'),
(103, NULL, 'About Page Update', 'update-about-page', 'website', 1, 0, 0, 0, 0, 0, 0, 'route', 1, '2022-07-11 14:38:13', '2019-09-07 06:29:02'),
(104, NULL, 'Contact Page Update', 'update-contact-page', 'website', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:27', '2019-09-07 06:29:02'),
(105, NULL, 'Reports', 'reports', 'other', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:38:07', '2019-09-07 15:20:44'),
(106, NULL, 'Payment History: Search', 'search-payment-history', 'other', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:38:07', '2019-09-07 09:50:44'),
(107, NULL, 'Payment History: Export', 'export-payment-history', 'other', 1, 1, 1, 0, 0, 0, 0, 'route', 0, '2020-11-14 10:40:38', '2019-09-07 09:50:44'),
(108, NULL, 'User Dashboard', 'user-dashboard', 'user', 1, 1, 1, 1, 1, 1, 1, 'route', 1, '2022-08-01 09:31:38', '2022-04-19 08:54:50'),
(109, NULL, 'Booked Rooms', 'book-rooms', 'room', 1, 1, 1, 1, 1, 1, 0, 'route', 1, '2022-07-10 12:50:27', '2022-04-19 08:54:50'),
(110, NULL, 'Web: User Profile', 'user-profile', 'website', 1, 1, 1, 1, 1, 1, 0, 'route', 1, '2022-07-10 12:50:27', '2022-04-19 08:54:50'),
(111, NULL, 'Web: Update Profile Details', 'update-profile-details', 'website', 1, 1, 1, 1, 1, 1, 0, 'route', 1, '2022-07-10 12:50:27', '2022-04-19 08:54:50'),
(112, NULL, 'Web: Change Password', 'change-password', 'website', 1, 1, 1, 1, 1, 1, 0, 'route', 1, '2022-07-10 12:50:27', '2022-04-19 08:54:50'),
(113, NULL, 'Web: Update Password', 'update-password', 'website', 1, 1, 1, 1, 1, 1, 0, 'route', 1, '2022-07-10 12:50:27', '2022-04-19 08:54:50'),
(114, NULL, 'Vendor: Add', 'add-vendor', 'vendor', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(115, NULL, 'Vendor: Edit', 'edit-vendor', 'vendor', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(116, NULL, 'Vendor: Save', 'save-vendor', 'vendor', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(117, NULL, 'Vendor: List', 'list-vendor', 'vendor', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(118, NULL, 'Vendor: Delete', 'delete-vendor', 'vendor', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(119, NULL, 'Vendor: Add Category', 'add-vendor-category', 'vendor', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(120, NULL, 'Vendor Category: Edit', 'edit-vendor-category', 'vendor', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(121, NULL, 'Vendor Category: Save', 'save-vendor-category', 'vendor', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(122, NULL, 'Vendor Category: List', 'list-vendor-category', 'vendor', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(123, NULL, 'Vendor Category: Delete', 'delete-vendor-category', 'vendor', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(124, NULL, 'Vendor: Search', 'search-vendor', 'vendor', 1, 1, 1, 0, 0, 0, 0, 'route', 0, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(125, NULL, 'Vendor: Export', 'export-vendor', 'vendor', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(126, NULL, 'Language Translations: Update', 'save-language-translations', 'language', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(127, NULL, 'Language Translations: List', 'language-translations', 'language', 1, 1, 0, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(128, NULL, 'Vendor: View', 'view-vendor', 'vendor', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:26', '2019-09-07 15:20:44'),
(129, NULL, 'Housekeeping Item: Add', 'add-housekeeping-item', 'housekeeping', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-08-01 09:30:42', '2019-09-07 06:29:02'),
(130, NULL, 'Housekeeping Item: Edit', 'edit-housekeeping-item', 'housekeeping', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-08-01 09:30:42', '2019-09-07 06:29:02'),
(131, NULL, 'Housekeeping Item: Save', 'save-housekeeping-item', 'housekeeping', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-08-01 09:30:42', '2019-09-07 06:29:02'),
(132, NULL, 'Housekeeping Item: All', 'list-housekeeping-item', 'housekeeping', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-08-01 09:30:42', '2019-09-07 06:29:02'),
(133, NULL, 'Housekeeping Item: Delete', 'delete-housekeeping-item', 'housekeeping', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-08-01 09:30:42', '2019-09-07 06:29:02'),
(134, NULL, 'Housekeeping Item: View', 'view-housekeeping-item', 'housekeeping', 1, 1, 1, 1, 1, 0, 0, 'route', 0, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(135, NULL, 'Housekeeping Order: Add', 'add-housekeeping-order', 'housekeeping', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-08-01 09:30:42', '2019-09-07 06:29:02'),
(136, NULL, 'Housekeeping Order: Edit', 'edit-housekeeping-order', 'housekeeping', 1, 1, 1, 1, 1, 0, 1, 'route', 1, '2022-08-01 09:30:42', '2019-09-07 06:29:02'),
(137, NULL, 'Housekeeping Order: Save', 'save-housekeeping-order', 'housekeeping', 1, 1, 1, 1, 1, 0, 1, 'route', 1, '2022-08-01 09:30:42', '2019-09-07 06:29:02'),
(138, NULL, 'Housekeeping Order: All', 'list-housekeeping-order', 'housekeeping', 1, 1, 1, 1, 1, 0, 1, 'route', 1, '2022-08-01 09:30:42', '2019-09-07 06:29:02'),
(139, NULL, 'Housekeeping Order: Delete', 'delete-housekeeping-order', 'housekeeping', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-08-01 09:30:42', '2019-09-07 06:29:02'),
(140, NULL, 'Housekeeping Order: View', 'view-housekeeping-order', 'housekeeping', 1, 1, 1, 1, 1, 0, 0, 'route', 0, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(141, NULL, 'Season: Add', 'add-season', 'season', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(142, NULL, 'Season: Edit', 'edit-season', 'season', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(143, NULL, 'Season: Save', 'save-season', 'season', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(144, NULL, 'Season: All', 'list-season', 'season', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(145, NULL, 'Season: Delete', 'delete-season', 'season', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(146, NULL, 'Season: View', 'view-season', 'season', 1, 1, 1, 1, 1, 0, 0, 'route', 0, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(147, NULL, 'Room Types: View', 'view-room-type', 'room', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 14:27:50'),
(148, NULL, 'Room Types: Price Rule', 'room-types-price-rule', 'room', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 14:27:50'),
(149, NULL, 'Room Types: Save Price Rule', 'save-room-types-price-rule', 'room', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 14:27:50'),
(150, NULL, 'Housekeeping Order: Update Order Status', 'update-housekeeping-order-status', 'housekeeping', 1, 1, 1, 1, 1, 0, 1, 'route', 1, '2022-08-01 09:30:42', '2019-09-07 06:29:02'),
(151, NULL, 'Laundry Item: Add', 'add-laundry-item', 'laundry', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(152, NULL, 'Laundry Item: Edit', 'edit-laundry-item', 'laundry', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(153, NULL, 'Laundry Item: Save', 'save-laundry-item', 'laundry', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(154, NULL, 'Laundry Item: All', 'list-laundry-item', 'laundry', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(155, NULL, 'Laundry Item: Delete', 'delete-laundry-item', 'laundry', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(156, NULL, 'Laundry Item: View', 'view-laundry-item', 'laundry', 1, 1, 1, 1, 1, 0, 0, 'route', 0, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(157, NULL, 'Laundry Order: Add', 'add-laundry-order', 'laundry', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(158, NULL, 'Laundry Order: Edit', 'edit-laundry-order', 'laundry', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(159, NULL, 'Laundry Order: Save', 'save-laundry-order', 'laundry', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(160, NULL, 'Laundry Order: All', 'list-laundry-order', 'laundry', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(161, NULL, 'Laundry Order: Delete', 'delete-laundry-order', 'laundry', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(162, NULL, 'Laundry Order: View', 'view-laundry-order', 'laundry', 1, 1, 1, 1, 1, 0, 0, 'route', 0, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(163, NULL, 'Laundry Order: Update Order Status', 'update-laundry-order-status', 'laundry', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(164, NULL, 'Laundry Order: Invoice', 'invoice-laundry-order', 'laundry', 1, 1, 1, 1, 1, 0, 0, 'route', 0, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(165, NULL, 'Laundry Order: Search', 'search-laundry-order', 'laundry', 1, 1, 1, 1, 1, 0, 0, 'route', 1, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(166, NULL, 'Laundry Order: Export', 'export-laundry-order', 'laundry', 1, 1, 1, 1, 1, 0, 0, 'route', 0, '2022-07-10 12:50:24', '2019-09-07 06:29:02'),
(167, NULL, 'Stock History: Delete', 'delete-stock-history', 'inventory', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-07-31 23:37:51', '2019-09-07 15:20:44'),
(168, NULL, 'Dashboard: Total Today CheckIns', 'dashboard-total-today-checkins', 'dashboard', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-08-01 09:33:56', '2019-09-07 13:07:07'),
(169, NULL, 'Dashboard: Total Today Checkouts', 'dashboard-total-today-checkouts', 'dashboard', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-08-01 09:33:56', '2019-09-07 13:07:07'),
(170, NULL, 'Dashboard: Total Today Orders', 'dashboard-total-today-orders', 'dashboard', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-08-01 09:33:56', '2019-09-07 13:07:07'),
(171, NULL, 'Dashboard: Booking Calendar', 'dashboard-booking-cal', 'dashboard', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-08-01 09:33:56', '2019-09-07 13:07:07'),
(172, NULL, 'Dashboard: Latest Food Orders', 'dashboard-latest-food-orders', 'dashboard', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-08-01 09:33:56', '2019-09-07 13:07:07'),
(173, NULL, 'Dashboard: Room List', 'dashboard-room-list', 'dashboard', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-08-01 09:33:57', '2019-09-07 13:07:07'),
(174, NULL, 'Dashboard: Product Stocks', 'dashboard-product-stocks', 'dashboard', 1, 1, 1, 0, 0, 0, 0, 'route', 1, '2022-08-01 09:33:57', '2019-09-07 13:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `person_lists`
--

CREATE TABLE `person_lists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `address` text,
  `idcard_type` int(11) DEFAULT NULL,
  `idcard_no` varchar(80) DEFAULT NULL,
  `reservation_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `measurement` int(11) DEFAULT NULL,
  `stock_qty` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `expiry_date` date DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `measurement`, `stock_qty`, `status`, `is_deleted`, `expiry_date`, `updated_at`, `created_at`) VALUES
(1, 'Ab', 8, 97, 1, 0, '2022-10-29', '2022-07-31 20:06:51', '2022-03-26 06:10:02'),
(2, 'Bed Cover', 11, 4, 1, 0, '2022-07-29', '2022-07-31 20:06:31', '2022-07-29 15:11:06'),
(3, 'Sheet', 10, 909, 1, 0, NULL, '2022-07-30 10:49:57', '2022-07-30 05:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `invoice_prefix` varchar(100) DEFAULT NULL,
  `invoice_num` int(11) DEFAULT NULL,
  `guest_type` enum('new','existing') DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime DEFAULT NULL,
  `duration_of_stay` int(11) DEFAULT '0',
  `adult` int(11) NOT NULL DEFAULT '0',
  `kids` int(11) DEFAULT '0',
  `booked_by` varchar(255) DEFAULT NULL,
  `referred_by` varchar(80) DEFAULT NULL,
  `referred_by_name` varchar(100) DEFAULT NULL,
  `checked_out_by` varchar(255) DEFAULT NULL,
  `vehicle_number` varchar(80) DEFAULT NULL,
  `idcard_type` int(11) DEFAULT NULL,
  `idcard_no` varchar(255) DEFAULT NULL,
  `idcard_image` varchar(255) DEFAULT NULL,
  `booking_type` enum('Online','Offline') NOT NULL DEFAULT 'Offline',
  `payment_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=Pending 1=Success',
  `payment_mode` int(11) DEFAULT NULL,
  `reason_visit_stay` text,
  `amount_json` text,
  `gst_perc` float(10,2) DEFAULT '0.00',
  `cgst_perc` float(10,2) DEFAULT '0.00',
  `discount` float(10,2) NOT NULL DEFAULT '0.00',
  `gst_amount` float(10,2) NOT NULL DEFAULT '0.00',
  `cgst_amount` float(10,2) NOT NULL DEFAULT '0.00',
  `sub_total` float(10,2) NOT NULL DEFAULT '0.00',
  `grand_total` float(10,2) NOT NULL DEFAULT '0.00',
  `addtional_amount` float(10,2) NOT NULL DEFAULT '0.00',
  `additional_amount_reason` varchar(255) DEFAULT NULL,
  `advance_payment` float(10,2) DEFAULT '0.00',
  `remark_amount` float(10,2) DEFAULT NULL,
  `remark` text,
  `company_gst_num` varchar(255) DEFAULT NULL,
  `room_plan` varchar(10) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `is_checkout` int(11) NOT NULL DEFAULT '0' COMMENT '1=Yes',
  `is_confirmed` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at_checkin` datetime DEFAULT NULL,
  `created_at_checkout` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `invoice_prefix`, `invoice_num`, `guest_type`, `customer_id`, `check_in`, `check_out`, `duration_of_stay`, `adult`, `kids`, `booked_by`, `referred_by`, `referred_by_name`, `checked_out_by`, `vehicle_number`, `idcard_type`, `idcard_no`, `idcard_image`, `booking_type`, `payment_status`, `payment_mode`, `reason_visit_stay`, `amount_json`, `gst_perc`, `cgst_perc`, `discount`, `gst_amount`, `cgst_amount`, `sub_total`, `grand_total`, `addtional_amount`, `additional_amount_reason`, `advance_payment`, `remark_amount`, `remark`, `company_gst_num`, `room_plan`, `company_name`, `is_deleted`, `is_checkout`, `is_confirmed`, `status`, `created_at_checkin`, `created_at_checkout`, `updated_at`, `created_at`) VALUES
(6, NULL, 1, 'existing', 1, '2022-07-28 00:00:00', '2022-07-31 15:26:00', 8, 1, 0, NULL, 'Self', 'WALK-IN', NULL, NULL, 6, '8888888', NULL, 'Offline', 0, NULL, 'oio', '{\"per_room_price\":\"11050\",\"total_room_amount\":\"11050.00\",\"total_room_amount_gst\":\"663\",\"total_room_amount_cgst\":\"663\",\"total_room_advance_amount\":\"6000\",\"total_room_final_amount\":\"6376.00\",\"order_amount\":\"0\",\"order_amount_gst\":\"0.00\",\"order_amount_cgst\":\"0.00\",\"order_final_amount\":\"0.00\",\"total_final_amount\":\"6376.00\",\"room_amount_discount\":\"0\",\"additional_amount\":\"0\"}', 6.00, 6.00, 0.00, 663.00, 663.00, 11050.00, 6376.00, 0.00, NULL, 6000.00, NULL, NULL, NULL, 'AP', NULL, 0, 1, 1, 1, '2022-07-30 10:22:15', '2022-07-31 15:26:10', '2022-07-31 15:26:10', '2022-07-30 04:52:15'),
(7, NULL, 2, 'existing', 1, '2022-08-03 00:00:00', '2022-08-05 00:00:00', 2, 1, 0, NULL, 'Self', 'WALK-IN', NULL, NULL, 5, '8888888', NULL, 'Offline', 0, NULL, '8', NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, 'CP', NULL, 0, 0, 1, 1, '2022-08-01 11:15:05', NULL, '2022-08-01 11:15:05', '2022-08-01 05:45:05'),
(8, NULL, 3, 'existing', 1, '2022-08-03 00:00:00', '2022-08-05 00:00:00', 2, 1, 0, NULL, 'Self', 'WALK-IN', NULL, NULL, 5, '8888888', NULL, 'Offline', 0, NULL, '8', NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, 'CP', NULL, 0, 0, 1, 1, '2022-08-01 11:15:05', NULL, '2022-08-01 11:15:05', '2022-08-01 05:45:05'),
(9, NULL, 4, 'existing', 1, '2022-08-03 00:00:00', '2022-08-05 00:00:00', 2, 1, 0, NULL, 'Self', 'WALK-IN', NULL, NULL, 5, '8888888', NULL, 'Offline', 0, NULL, '8', NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, 'CP', NULL, 0, 0, 1, 1, '2022-08-01 11:15:05', NULL, '2022-08-01 11:15:05', '2022-08-01 05:45:05'),
(10, NULL, 5, 'existing', 1, '2022-08-03 00:00:00', '2022-08-05 00:00:00', 2, 1, 0, NULL, 'Self', 'WALK-IN', NULL, NULL, 5, '8888888', NULL, 'Offline', 0, NULL, '8', NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, 'CP', NULL, 0, 0, 1, 1, '2022-08-01 11:15:05', NULL, '2022-08-01 11:15:05', '2022-08-01 05:45:05'),
(11, NULL, 6, 'existing', 1, '2022-08-03 00:00:00', '2022-08-05 00:00:00', 2, 1, 0, NULL, 'Self', 'WALK-IN', NULL, NULL, 5, '8888888', NULL, 'Offline', 0, NULL, '8', NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, 'CP', NULL, 0, 0, 1, 1, '2022-08-01 11:15:05', NULL, '2022-08-01 11:15:05', '2022-08-01 05:45:05'),
(12, NULL, 7, 'existing', 1, '2022-08-03 00:00:00', '2022-08-05 00:00:00', 2, 1, 0, NULL, 'Self', 'WALK-IN', NULL, NULL, 5, '8888888', NULL, 'Offline', 0, NULL, '8', NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, 'CP', NULL, 0, 0, 1, 1, '2022-08-01 11:15:05', NULL, '2022-08-01 11:15:05', '2022-08-01 05:45:05'),
(13, NULL, 8, 'existing', 1, '2022-08-03 00:00:00', '2022-08-05 00:00:00', 2, 1, 0, NULL, 'Self', 'WALK-IN', NULL, NULL, 5, '8888888', NULL, 'Offline', 0, NULL, '8', NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, 'CP', NULL, 0, 0, 1, 1, '2022-08-01 11:15:05', NULL, '2022-08-01 11:15:05', '2022-08-01 05:45:05'),
(14, NULL, 9, 'existing', 1, '2022-08-14 00:00:00', '2022-08-14 16:06:00', 2, 1, 0, NULL, 'Self', 'WALK-IN', NULL, NULL, 4, '7890', NULL, 'Offline', 0, NULL, '89898', '{\"per_room_price\":\"6200\",\"total_room_amount\":\"6200.00\",\"total_room_amount_gst\":\"372\",\"total_room_amount_cgst\":\"372\",\"total_room_advance_amount\":\"0\",\"total_room_final_amount\":\"6944.00\",\"order_amount\":\"0\",\"order_amount_gst\":\"0.00\",\"order_amount_cgst\":\"0.00\",\"order_final_amount\":\"0.00\",\"total_final_amount\":\"6944.00\",\"room_amount_discount\":\"0\",\"additional_amount\":\"0\"}', 6.00, 6.00, 0.00, 372.00, 372.00, 6200.00, 6944.00, 0.00, NULL, NULL, NULL, NULL, NULL, 'MAP', NULL, 0, 1, 1, 1, '2022-08-14 16:05:54', '2022-08-14 16:06:58', '2022-08-14 16:06:58', '2022-08-14 10:35:54'),
(15, NULL, 10, 'existing', 1, '2022-08-14 00:00:00', '2022-08-14 16:07:00', 2, 1, 0, NULL, 'Self', 'WALK-IN', NULL, NULL, 4, '7890', NULL, 'Offline', 0, NULL, '89898', '{\"total_room_amount\":\"0.00\",\"total_room_amount_gst\":\"0\",\"total_room_amount_cgst\":\"0\",\"total_room_advance_amount\":\"0\",\"total_room_final_amount\":\"0.00\",\"order_amount\":\"0\",\"order_amount_gst\":\"0.00\",\"order_amount_cgst\":\"0.00\",\"order_final_amount\":\"0.00\",\"total_final_amount\":\"0.00\",\"room_amount_discount\":\"0\",\"additional_amount\":\"0\"}', 6.00, 6.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, 'MAP', NULL, 0, 1, 1, 1, '2022-08-14 16:05:54', '2022-08-14 16:07:10', '2022-08-14 16:07:10', '2022-08-14 10:35:54'),
(16, NULL, 10, 'existing', 1, '2022-08-14 00:00:00', '2022-08-14 16:07:00', 2, 1, 0, NULL, 'Self', 'WALK-IN', NULL, NULL, 4, '7890', NULL, 'Offline', 0, NULL, '89898', '{\"total_room_amount\":\"0.00\",\"total_room_amount_gst\":\"0\",\"total_room_amount_cgst\":\"0\",\"total_room_advance_amount\":\"0\",\"total_room_final_amount\":\"0.00\",\"order_amount\":\"0\",\"order_amount_gst\":\"0.00\",\"order_amount_cgst\":\"0.00\",\"order_final_amount\":\"0.00\",\"total_final_amount\":\"0.00\",\"room_amount_discount\":\"0\",\"additional_amount\":\"0\"}', 6.00, 6.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, 'MAP', NULL, 0, 1, 1, 1, '2022-08-14 16:05:54', '2022-08-14 16:07:20', '2022-08-14 16:07:20', '2022-08-14 10:35:54'),
(17, NULL, 11, 'existing', 1, '2022-08-14 00:00:00', '2022-08-14 16:14:00', 2, 1, 0, NULL, 'Self', 'WALK-IN', NULL, NULL, 4, '7890', NULL, 'Offline', 0, NULL, '89898', '{\"total_room_amount\":\"0.00\",\"total_room_amount_gst\":\"0\",\"total_room_amount_cgst\":\"0\",\"total_room_advance_amount\":\"0\",\"total_room_final_amount\":\"0.00\",\"order_amount\":\"0\",\"order_amount_gst\":\"0.00\",\"order_amount_cgst\":\"0.00\",\"order_final_amount\":\"0.00\",\"total_final_amount\":\"0.00\",\"room_amount_discount\":\"0\",\"additional_amount\":\"0\"}', 6.00, 6.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, 'MAP', NULL, 0, 1, 1, 1, '2022-08-14 16:05:54', '2022-08-14 16:14:13', '2022-08-14 16:14:13', '2022-08-14 10:35:54'),
(18, NULL, NULL, 'existing', 1, '2022-08-14 00:00:00', '2022-08-16 00:00:00', 2, 1, 0, NULL, 'Self', 'WALK-IN', NULL, NULL, 4, '7890', NULL, 'Offline', 0, NULL, '89898', NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, 'MAP', NULL, 0, 0, 1, 1, '2022-08-14 16:05:54', NULL, '2022-08-14 16:05:54', '2022-08-14 10:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `slug`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Super Admin', 'super_admin', 1, NULL, '2019-08-27 05:12:15'),
(2, 'Admin', 'admin', 1, NULL, '2019-08-27 05:12:15'),
(3, 'Receptionist', 'receptionist', 1, NULL, '2019-08-27 05:12:45'),
(4, 'Store Manager', 'store_manager', 1, NULL, '2019-08-27 05:12:45'),
(5, 'Financial Manager', 'financial_manager', 1, NULL, '2019-08-27 05:12:45'),
(6, 'Customer', 'customer', 0, NULL, '2021-11-20 05:45:06'),
(7, 'Housekeeper', 'housekeeper', 1, NULL, '2021-11-20 05:45:06');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_no` varchar(80) NOT NULL,
  `room_name` varchar(255) DEFAULT NULL,
  `floor` int(11) NOT NULL,
  `order_num` int(11) NOT NULL DEFAULT '100000',
  `description` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_type_id`, `room_no`, `room_name`, `floor`, `order_num`, `description`, `status`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, 3, '101', 'Executive Room', 15, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, 0, '2021-11-23 17:50:39', '2021-09-06 04:12:20'),
(2, 3, '102', 'PRM-Double', 15, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, 1, '2021-11-23 17:50:04', '2021-11-06 07:27:31'),
(3, 3, '103', 'PRM-Double', 15, 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, 1, '2021-11-23 17:50:00', '2021-11-06 07:27:31'),
(4, 2, '102', 'Standard Room', 16, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, 0, '2021-11-23 17:51:25', '2021-11-06 07:58:24'),
(5, 1, '301', 'DLX-Single', 17, 5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, 1, '2021-11-23 17:49:54', '2021-11-06 07:58:50'),
(6, 3, '103', 'AC Room', 16, 10, NULL, 1, 0, '2022-07-19 16:44:52', '2022-07-19 11:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `room_carts`
--

CREATE TABLE `room_carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `room_id` int(11) NOT NULL,
  `date_from` datetime DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `duration_of_stay` int(11) NOT NULL DEFAULT '1',
  `adults` int(11) NOT NULL DEFAULT '0',
  `children` int(11) NOT NULL DEFAULT '0',
  `location` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_carts`
--

INSERT INTO `room_carts` (`id`, `user_id`, `room_id`, `date_from`, `date_to`, `duration_of_stay`, `adults`, `children`, `location`, `updated_at`, `created_at`) VALUES
(10, 1, 1, '2022-08-10 00:00:00', '2022-08-31 00:00:00', 21, 1, 0, 'Port moresby, India', NULL, '2022-07-29 15:03:30');

-- --------------------------------------------------------

--
-- Table structure for table `room_prices`
--

CREATE TABLE `room_prices` (
  `id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `season_id` int(11) NOT NULL,
  `price` float(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_prices`
--

INSERT INTO `room_prices` (`id`, `room_type_id`, `season_id`, `price`) VALUES
(5, 3, 3, 3300.00),
(6, 3, 1, 3100.00),
(7, 2, 1, 2100.00),
(8, 3, 2, 3200.00),
(9, 2, 2, 2200.00),
(10, 2, 3, 2300.00);

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `is_type` enum('room','hall','') NOT NULL DEFAULT 'room',
  `title` varchar(255) NOT NULL,
  `short_code` varchar(10) NOT NULL,
  `adult_capacity` int(11) DEFAULT '0',
  `kids_capacity` int(11) NOT NULL DEFAULT '0',
  `base_price` float(10,2) DEFAULT '0.00',
  `amenities` varchar(255) DEFAULT NULL,
  `description` longtext,
  `order_num` int(11) NOT NULL DEFAULT '100000',
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `is_type`, `title`, `short_code`, `adult_capacity`, `kids_capacity`, `base_price`, `amenities`, `description`, `order_num`, `status`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, 'room', 'Delux Rooms', 'DLX', 2, 2, 777.00, '1,3,5,4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 3, 1, 1, '2021-11-23 17:47:52', '2021-09-06 04:12:00'),
(2, 'room', 'Standard', 'STD', 2, 2, 250.00, '1,10,3,5,7,4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 2, 1, 0, '2021-11-23 17:48:34', '2021-11-06 06:41:02'),
(3, 'hall', 'Executive', 'EXE', 2, 2, 350.00, '1,10,6,8,3,5,7,4,9,2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, 1, 0, '2021-11-23 17:47:41', '2021-11-06 06:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `days` varchar(255) NOT NULL,
  `is_every_year` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`id`, `name`, `start_date`, `end_date`, `days`, `is_every_year`, `status`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, 'Rainy', '2022-08-01 00:00:00', '2022-08-31 00:00:00', 'mon,tue,wed,fri,sun', 0, 1, 0, '2022-07-29 20:23:34', '2022-07-14 08:51:14'),
(2, 'Summer', '2022-09-01 00:00:00', '2022-09-30 00:00:00', 'mon,tue,wed,thu,fri', 0, 1, 0, '2022-07-28 18:16:17', '2022-07-14 10:14:24'),
(3, 'Season 1', '2022-10-01 00:00:00', '2022-10-30 00:00:00', 'mon,tue,wed,thu', 0, 1, 0, '2022-07-29 11:14:44', '2022-07-26 14:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `updated_at`, `created_at`) VALUES
(1, 'site_page_title', 'CodexEco Hotel & Resort', '2022-07-31 12:29:29', '2020-07-19 06:16:19'),
(2, 'site_language', 'en', '2022-07-31 12:29:29', '2020-07-19 06:16:19'),
(3, 'hotel_name', 'CodexEco Hotel & Resort', '2022-07-31 12:29:29', '2020-07-19 06:16:19'),
(4, 'hotel_tagline', 'Codex Resort', '2022-07-31 12:29:29', '2020-07-19 06:16:19'),
(5, 'hotel_email', 'codexeco@gmail.com', '2022-07-31 12:29:29', '2020-07-19 06:16:19'),
(6, 'hotel_phone', '1234567890', '2022-07-31 12:29:29', '2020-07-19 06:16:19'),
(7, 'hotel_mobile', '9087654321', '2022-07-31 12:29:29', '2020-07-19 06:16:19'),
(8, 'hotel_website', 'https://codexeco.com/', '2022-07-31 12:29:29', '2020-07-19 06:16:19'),
(9, 'hotel_address', 'Colony Road, near Bikash Bharati High School.Jangal Khas.', '2022-07-31 12:29:29', '2020-07-19 06:16:19'),
(10, 'gst_num', '19ABQFA0476P1ZO', '2022-07-31 12:29:29', '2020-07-19 06:16:19'),
(11, 'gst', '6', '2022-07-31 12:29:29', '2020-07-19 06:16:19'),
(12, 'cgst', '6', '2022-07-31 12:29:29', '2020-07-19 06:16:19'),
(13, 'food_gst', '2.5', '2022-07-31 12:29:29', '2020-07-19 06:16:19'),
(14, 'food_cgst', '2.5', '2022-07-31 12:29:29', '2020-07-19 06:16:19'),
(15, 'currency', 'INR', '2022-07-31 12:29:29', '2020-11-10 00:41:22'),
(16, 'currency_symbol', '₹', '2022-07-31 12:29:29', '2020-11-10 00:41:22'),
(17, 'sms_api_active', '0', '2022-07-31 12:29:29', '2020-11-15 02:25:55'),
(18, 'default_nationality', '81', '2022-07-31 12:29:29', '2020-11-15 02:25:55'),
(19, 'default_country', 'India', '2022-07-31 12:29:29', '2020-11-15 02:25:55'),
(20, 'invoice_term_condition', '<h1 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">Terms and Conditions</h1><h1 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">General Site Usage</h1><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">Last Revised: january 16, 2021.</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">Welcome to www.lorem-ipsum.info. This site is provided as a service to our visitors and may be used for informational purposes only. Because the Terms and Conditions contain legal obligations, please read them carefully.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">1. YOUR AGREEMENT</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">By using this Site, you agree to be bound by, and to comply with, these Terms and Conditions. If you do not agree to these Terms and Conditions, please do not use this site.</p><blockquote style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">PLEASE NOTE: We reserve the right, at our sole discretion, to change, modify or otherwise alter these Terms and Conditions at any time. Unless otherwise indicated, amendments will become effective immediately. Please review these Terms and Conditions periodically. Your continued use of the Site following the posting of changes and/or modifications will constitute your acceptance of the revised Terms and Conditions and the reasonableness of these standards for notice of changes. For your information, this page was last updated as of the date at the top of these terms and conditions.</blockquote><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">2. PRIVACY</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">Please review our Privacy Policy, which also governs your visit to this Site, to understand our practices.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">3. LINKED SITES</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">This Site may contain links to other independent third-party Web sites (\"Linked Sites”). These Linked Sites are provided solely as a convenience to our visitors. Such Linked Sites are not under our control, and we are not responsible for and does not endorse the content of such Linked Sites, including any information or materials contained on such Linked Sites. You will need to make your own independent judgment regarding your interaction with these Linked Sites.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">4. FORWARD LOOKING STATEMENTS</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">All materials reproduced on this site speak as of the original date of publication or filing. The fact that a document is available on this site does not mean that the information contained in such document has not been modified or superseded by events or by a subsequent document or filing. We have no duty or policy to update any information or statements contained on this site and, therefore, such information or statements should not be relied upon as being current as of the date you access this site.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">5. DISCLAIMER OF WARRANTIES AND LIMITATION OF LIABILITY</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">A. THIS SITE MAY CONTAIN INACCURACIES AND TYPOGRAPHICAL ERRORS. WE DOES NOT WARRANT THE ACCURACY OR COMPLETENESS OF THE MATERIALS OR THE RELIABILITY OF ANY ADVICE, OPINION, STATEMENT OR OTHER INFORMATION DISPLAYED OR DISTRIBUTED THROUGH THE SITE. YOU EXPRESSLY UNDERSTAND AND AGREE THAT: (i) YOUR USE OF THE SITE, INCLUDING ANY RELIANCE ON ANY SUCH OPINION, ADVICE, STATEMENT, MEMORANDUM, OR INFORMATION CONTAINED HEREIN, SHALL BE AT YOUR SOLE RISK; (ii) THE SITE IS PROVIDED ON AN \"AS IS\" AND \"AS AVAILABLE\" BASIS; (iii) EXCEPT AS EXPRESSLY PROVIDED HEREIN WE DISCLAIM ALL WARRANTIES OF ANY KIND, WHETHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, WORKMANLIKE EFFORT, TITLE AND NON-INFRINGEMENT; (iv) WE MAKE NO WARRANTY WITH RESPECT TO THE RESULTS THAT MAY BE OBTAINED FROM THIS SITE, THE PRODUCTS OR SERVICES ADVERTISED OR OFFERED OR MERCHANTS INVOLVED; (v) ANY MATERIAL DOWNLOADED OR OTHERWISE OBTAINED THROUGH THE USE OF THE SITE IS DONE AT YOUR OWN DISCRETION AND RISK; and (vi) YOU WILL BE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR FOR ANY LOSS OF DATA THAT RESULTS FROM THE DOWNLOAD OF ANY SUCH MATERIAL.</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">B. YOU UNDERSTAND AND AGREE THAT UNDER NO CIRCUMSTANCES, INCLUDING, BUT NOT LIMITED TO, NEGLIGENCE, SHALL WE BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, PUNITIVE OR CONSEQUENTIAL DAMAGES THAT RESULT FROM THE USE OF, OR THE INABILITY TO USE, ANY OF OUR SITES OR MATERIALS OR FUNCTIONS ON ANY SUCH SITE, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. THE FOREGOING LIMITATIONS SHALL APPLY NOTWITHSTANDING ANY FAILURE OF ESSENTIAL PURPOSE OF ANY LIMITED REMEDY.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">6. EXCLUSIONS AND LIMITATIONS</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF CERTAIN WARRANTIES OR THE LIMITATION OR EXCLUSION OF LIABILITY FOR INCIDENTAL OR CONSEQUENTIAL DAMAGES. ACCORDINGLY, OUR LIABILITY IN SUCH JURISDICTION SHALL BE LIMITED TO THE MAXIMUM EXTENT PERMITTED BY LAW.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">7. OUR PROPRIETARY RIGHTS</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">This Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">The framing, mirroring, scraping or data mining of the Site or any of its content in any form and by any method is expressly prohibited.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">8. INDEMNITY</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">By using the Site web sites you agree to indemnify us and affiliated entities (collectively \"Indemnities\") and hold them harmless from any and all claims and expenses, including (without limitation) attorney\'s fees, arising from your use of the Site web sites, your use of the Products and Services, or your submission of ideas and/or related materials to us or from any person\'s use of any ID, membership or password you maintain with any portion of the Site, regardless of whether such use is authorized by you.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">9. COPYRIGHT AND TRADEMARK NOTICE</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">Except our generated dummy copy, which is free to use for private and commercial use, all other text is copyrighted. generator.lorem-ipsum.info © 2013, all rights reserved</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">10. INTELLECTUAL PROPERTY INFRINGEMENT CLAIMS</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">It is our policy to respond expeditiously to claims of intellectual property infringement. We will promptly process and investigate notices of alleged infringement and will take appropriate actions under the Digital Millennium Copyright Act (\"DMCA\") and other applicable intellectual property laws. Notices of claimed infringement should be directed to:</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">generator.lorem-ipsum.info</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">126 Electricov St.</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">Kiev, Kiev 04176</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">Ukraine</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">contact@lorem-ipsum.info</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">11. PLACE OF PERFORMANCE</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">This Site is controlled, operated and administered by us from our office in Kiev, Ukraine. We make no representation that materials at this site are appropriate or available for use at other locations outside of the Ukraine and access to them from territories where their contents are illegal is prohibited. If you access this Site from a location outside of the Ukraine, you are responsible for compliance with all local laws.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">12. GENERAL</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">B. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.</p>', '2022-07-31 12:29:29', '2020-11-15 02:25:55'),
(21, 'files', NULL, '2021-05-26 02:30:24', '2020-11-15 02:25:55'),
(22, 'bank_acc_name', 'CodexEco Resort', '2022-07-31 12:29:29', '2021-03-27 07:20:01'),
(23, 'bank_ifsc_code', 'SIN0031123', '2022-07-31 12:29:29', '2021-03-27 07:20:01'),
(24, 'bank_acc_num', '51012412345', '2022-07-31 12:29:29', '2021-03-27 07:20:01'),
(25, 'bank_name', 'State Bank of India', '2022-07-31 12:29:29', '2021-03-27 07:20:01'),
(26, 'bank_branch', 'Raj', '2022-07-31 12:29:29', '2021-03-27 07:20:01'),
(27, 'default_rec_days', '15', '2022-07-31 12:29:29', '2021-05-26 08:58:29'),
(28, 'site_logo', 'd76e10d2292d1bfa9f000545009607c6_1640682030.png', '2021-12-28 14:30:30', '2021-05-26 10:07:30'),
(29, 'site_logo_height', '100', '2022-07-31 12:29:29', '2021-05-26 10:21:03'),
(30, 'site_logo_width', '100', '2022-07-31 12:29:29', '2021-05-26 10:21:03'),
(31, 'laundry_gst', '6', '2022-07-31 12:29:29', '2022-07-31 06:59:29'),
(32, 'laundry_cgst', '5', '2022-07-31 12:29:29', '2022-07-31 06:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `stock_history`
--

CREATE TABLE `stock_history` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `price` float(10,2) DEFAULT NULL,
  `stock_is` enum('add','subtract') DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `remark` text,
  `added_by` int(11) NOT NULL,
  `stock_date` date DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_history`
--

INSERT INTO `stock_history` (`id`, `product_id`, `room_id`, `price`, `stock_is`, `qty`, `remark`, `added_by`, `stock_date`, `updated_at`, `created_at`) VALUES
(2, 1, 1, NULL, 'subtract', 1, 'user', 1, NULL, NULL, '2022-07-29 06:58:30');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `client_image` varchar(255) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_position` varchar(100) DEFAULT NULL,
  `client_comment` text,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `client_image`, `client_name`, `client_position`, `client_comment`, `updated_at`, `created_at`) VALUES
(2, '54a57f869ca72cdd959e331410a9ba42_1636889202.png', 'Rakesh Sahu', NULL, 'Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem velit nisi non pharetra in dui.', '2021-11-24 10:06:13', '2019-09-12 07:02:30'),
(3, '54a57f869ca72cdd959e331410a9ba42_1636889202.png', 'Jayson', 'Excutive Director', 'Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem velit nisi non pharetra in dui.', '2021-11-24 10:06:13', '2019-09-12 07:02:30'),
(4, '54a57f869ca72cdd959e331410a9ba42_1636889216.png', 'Priyanka', NULL, 'Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem velit nisi non pharetra in dui.', '2021-11-24 10:06:13', '2021-11-14 11:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1=Deleted',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, 'Gm', 0, NULL, '2019-11-26 17:23:48'),
(2, 'Kg', 0, NULL, '2019-11-26 17:23:48'),
(3, 'Item', 0, NULL, '2019-11-26 17:24:03'),
(4, 'Piece', 0, NULL, '2019-11-26 17:24:03'),
(5, 'Set', 0, NULL, '2019-11-26 17:24:23'),
(6, 'Bottles', 0, NULL, '2019-11-26 17:24:23'),
(7, 'Cartoons', 0, NULL, '2019-11-26 17:24:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `gender`, `email`, `email_verified_at`, `password`, `mobile`, `address`, `status`, `is_deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Admin', 'Male', 'codexeco@gmail.com', NULL, '$2y$10$jV8scZTAi7OcZyhc2ZPBnuimt2M.WUAUdC/MLNFerhZhfZkQhSRG6', '9038000818', NULL, 1, 0, NULL, NULL, '2021-12-19 12:43:25'),
(2, 2, 'Admin', 'Male', 'admin@gmail.com', NULL, '$2y$10$yb8Bsf15kZfPgyR.NpFAy.Dr.6nBh99lLcCjBINooWEdu9.2boQYC', '9001456808', 'H.No.439 Rani Bazar', 1, 0, NULL, '2019-09-07 03:53:13', '2019-09-07 09:41:18'),
(3, 3, 'Receptionist', 'Male', 'receptionist@gmail.com', NULL, '$2y$10$6F7Oyw9K/ZPT8r.X8ll4xOqZXrKpJL1kz4IABIJ0OGHgrCvMFhG0a', '1234567890', 'HNo 56', 1, 0, NULL, '2019-09-07 09:42:29', '2021-03-11 03:02:17'),
(4, 2, 'Store Manager', 'Male', 'sales@connexionsweb.com', NULL, '$2y$10$vkAjTzGoqzVX0QD4I85qeur5UwoOilLzk64STBaGx40sD9Z0J6Tuq', '9038000818', 'N-186B, Mudialy First lane. PO - Garden Reach', 1, 0, NULL, '2021-03-11 05:01:15', '2021-03-11 05:01:15'),
(5, 6, 'Bheem Swami', NULL, 'bheem@gmail.com', NULL, '$2y$10$TWbnFXsuZ9XKVL5jHEycwO6gJPUAU.knwwD3ZdPrrYCm.MEiDaYmO', '9001456808', 'H.No.439, Near simla cold store, sharma colony, Rani Bazar', 1, 0, NULL, NULL, NULL),
(6, 7, 'houseKeeper 1', NULL, 'housekeeper1@gmail.com', NULL, '$2y$10$2eBfFbzFpO3TfZ2DfHyPwuX0t1zlGS9vNSfV016t8gSzWNP8kXkFm', '1234567890', 'address', 1, 0, NULL, NULL, NULL),
(7, 7, 'houseKeeper 2', NULL, 'housekeeper2@gmail.com', NULL, '$2y$10$2eBfFbzFpO3TfZ2DfHyPwuX0t1zlGS9vNSfV016t8gSzWNP8kXkFm', '1234567890', 'address', 1, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_emails`
--

CREATE TABLE `user_emails` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_addr` varchar(255) DEFAULT NULL,
  `verified` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_emails`
--

INSERT INTO `user_emails` (`id`, `email`, `ip_addr`, `verified`, `updated_at`, `created_at`) VALUES
(1, 'vinj@mailinator.com', '::1', 0, NULL, '2021-11-19 06:33:37'),
(2, 'cyanitytechnologies@gmail.com', '::1', 0, NULL, '2021-11-19 06:34:32'),
(3, 'a@gmail.com', '::1', 0, NULL, '2022-07-29 08:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uri` varchar(255) DEFAULT NULL,
  `action_as` varchar(255) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `counts` int(11) NOT NULL DEFAULT '1',
  `json_data` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `log_type` varchar(200) DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `title`, `uri`, `action_as`, `controller`, `method`, `counts`, `json_data`, `log_type`, `log_date`, `updated_at`, `created_at`) VALUES
(1, 1, NULL, 'admin/dashboard', 'dashboard', 'App\\Http\\Controllers\\AdminController@index', 'GET', 5, NULL, NULL, '2022-10-20', '2022-10-20 11:54:32', '2022-10-20 05:38:13'),
(2, 1, NULL, 'admin/quick-check-in/{step}', 'quick-check-in', 'App\\Http\\Controllers\\AdminController@roomReservation', 'GET', 8, NULL, NULL, '2022-10-20', '2022-10-20 11:13:42', '2022-10-20 05:38:26'),
(3, 1, NULL, 'admin/check-in/{step}', 'room-reservation', 'App\\Http\\Controllers\\AdminController@roomReservation', 'GET', 1, NULL, NULL, '2022-10-20', '2022-10-20 11:14:06', '2022-10-20 05:44:06'),
(4, 1, NULL, 'admin/permissions-list', 'permissions-list', 'App\\Http\\Controllers\\AdminController@listPermission', 'GET', 16, NULL, NULL, '2022-10-20', '2022-10-20 11:45:58', '2022-10-20 05:48:22'),
(5, 1, NULL, 'admin/save-permissions', 'save-permissions', 'App\\Http\\Controllers\\AdminController@savePermission', 'POST', 1, '{\"_token\":\"42hGXP6j7RPAIMVpOOpsPn12GynPJbezrO705WZN\",\"ids\":[\"73\",\"74\",\"75\",\"76\",\"77\",\"97\"],\"super_admin\":{\"73\":\"on\",\"74\":\"on\",\"75\":\"on\",\"76\":\"on\",\"77\":\"on\",\"97\":\"on\"},\"admin\":{\"73\":\"on\",\"74\":\"on\",\"75\":\"on\",\"76\":\"on\",\"77\":\"on\",\"97\":\"on\"},\"receptionist\":{\"73\":\"on\",\"74\":\"on\",\"75\":\"on\",\"76\":\"on\",\"77\":\"on\",\"97\":\"on\"}}', NULL, '2022-10-20', '2022-10-20 11:18:27', '2022-10-20 05:48:27'),
(6, 1, NULL, 'admin/dashboard', 'dashboard', 'App\\Http\\Controllers\\AdminController@index', 'GET', 2, NULL, NULL, '2022-10-27', '2022-10-27 12:02:52', '2022-10-27 05:54:43'),
(7, 1, NULL, 'admin/add-season', 'add-season', 'App\\Http\\Controllers\\SeasonController@add', 'GET', 2, NULL, NULL, '2022-10-27', '2022-10-27 11:28:37', '2022-10-27 05:56:20'),
(8, 1, NULL, 'admin/add-room-types', 'add-room-types', 'App\\Http\\Controllers\\AdminController@addRoomType', 'GET', 1, NULL, NULL, '2022-10-27', '2022-10-27 11:29:13', '2022-10-27 05:59:13'),
(9, 1, NULL, 'admin/add-expense-category', 'add-expense-category', 'App\\Http\\Controllers\\AdminController@addExpenseCategory', 'GET', 15, NULL, NULL, '2022-10-27', '2022-10-27 12:22:56', '2022-10-27 05:59:26'),
(10, 1, NULL, 'admin/list-expense-category', 'list-expense-category', 'App\\Http\\Controllers\\AdminController@listExpenseCategory', 'GET', 12, NULL, NULL, '2022-10-27', '2022-10-27 12:03:20', '2022-10-27 06:01:51'),
(11, 1, NULL, 'admin/edit-expense-category/{id}', 'edit-expense-category', 'App\\Http\\Controllers\\AdminController@editExpenseCategory', 'GET', 88, NULL, NULL, '2022-10-27', '2022-10-27 12:13:18', '2022-10-27 06:04:33'),
(12, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"id\":\"1\",\"name\":\"Tours\",\"status\":\"1\"}', NULL, '2022-10-27', '2022-10-27 11:34:36', '2022-10-27 06:04:36'),
(13, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"id\":\"1\",\"name\":\"Tours\",\"status\":\"1\"}', NULL, '2022-10-27', '2022-10-27 11:35:32', '2022-10-27 06:05:32'),
(14, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"id\":\"1\",\"name\":\"Tours\",\"status\":\"1\"}', NULL, '2022-10-27', '2022-10-27 11:56:46', '2022-10-27 06:26:46'),
(15, 1, NULL, 'admin/quick-check-in/{step}', 'quick-check-in', 'App\\Http\\Controllers\\AdminController@roomReservation', 'GET', 1, NULL, NULL, '2022-10-27', '2022-10-27 12:02:57', '2022-10-27 06:32:57'),
(16, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"id\":\"1\",\"name\":\"Tours\",\"status\":\"1\"}', NULL, '2022-10-27', '2022-10-27 12:03:53', '2022-10-27 06:33:53'),
(17, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"id\":\"1\",\"name\":\"Tours\",\"status\":\"1\"}', NULL, '2022-10-27', '2022-10-27 12:04:45', '2022-10-27 06:34:45'),
(18, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"id\":\"1\",\"name\":\"Tours\",\"status\":\"1\"}', NULL, '2022-10-27', '2022-10-27 12:05:04', '2022-10-27 06:35:04'),
(19, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"id\":\"1\",\"name\":\"Tours\",\"status\":\"1\"}', NULL, '2022-10-27', '2022-10-27 12:05:09', '2022-10-27 06:35:09'),
(20, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"id\":\"1\",\"name\":\"Tours\",\"status\":\"1\"}', NULL, '2022-10-27', '2022-10-27 12:12:27', '2022-10-27 06:42:27'),
(21, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"id\":\"1\",\"name\":\"Tours2\",\"status\":\"1\"}', NULL, '2022-10-27', '2022-10-27 12:13:07', '2022-10-27 06:43:07'),
(22, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"id\":\"1\",\"name\":\"Tours2\",\"status\":\"1\"}', NULL, '2022-10-27', '2022-10-27 12:13:18', '2022-10-27 06:43:18'),
(23, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"name\":\"h\",\"status\":\"1\"}', NULL, '2022-10-27', '2022-10-27 12:15:43', '2022-10-27 06:45:43'),
(24, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"name\":\"h\",\"status\":\"1\"}', NULL, '2022-10-27', '2022-10-27 12:15:52', '2022-10-27 06:45:52'),
(25, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"name\":\"hljpl;\",\"status\":\"1\"}', NULL, '2022-10-27', '2022-10-27 12:16:02', '2022-10-27 06:46:02'),
(26, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"name\":\"hj\",\"status\":\"1\"}', NULL, '2022-10-27', '2022-10-27 12:16:09', '2022-10-27 06:46:09'),
(27, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"name\":\"hj\",\"status\":\"0\"}', NULL, '2022-10-27', '2022-10-27 12:16:14', '2022-10-27 06:46:14'),
(28, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"name\":\"hj\",\"status\":\"0\"}', NULL, '2022-10-27', '2022-10-27 12:16:19', '2022-10-27 06:46:19'),
(29, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"name\":\"hj\",\"status\":\"0\"}', NULL, '2022-10-27', '2022-10-27 12:19:28', '2022-10-27 06:49:28'),
(30, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"name\":\"hj\",\"status\":\"0\"}', NULL, '2022-10-27', '2022-10-27 12:19:30', '2022-10-27 06:49:30'),
(31, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"name\":\"hj\",\"status\":\"0\"}', NULL, '2022-10-27', '2022-10-27 12:19:32', '2022-10-27 06:49:32'),
(32, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"name\":\"hj\",\"status\":\"0\"}', NULL, '2022-10-27', '2022-10-27 12:19:44', '2022-10-27 06:49:44'),
(33, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"name\":\"hj\",\"status\":\"0\"}', NULL, '2022-10-27', '2022-10-27 12:22:46', '2022-10-27 06:52:46'),
(34, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"name\":\"hj\",\"status\":\"0\"}', NULL, '2022-10-27', '2022-10-27 12:22:49', '2022-10-27 06:52:49'),
(35, 1, NULL, 'admin/save-expense-category', 'save-expense-category', 'App\\Http\\Controllers\\AdminController@saveExpenseCategory', 'POST', 1, '{\"_token\":\"SrTw7hQC6BgtPFmSP51M04PKV9yASHB3DzSgELsZ\",\"name\":\"hj\",\"status\":\"0\"}', NULL, '2022-10-27', '2022-10-27 12:22:56', '2022-10-27 06:52:56'),
(36, 1, NULL, 'admin/dashboard', 'dashboard', 'App\\Http\\Controllers\\AdminController@index', 'GET', 1, NULL, NULL, '2022-12-27', '2022-12-27 14:40:07', '2022-12-27 09:10:07'),
(37, 1, NULL, 'admin/quick-check-in/{step}', 'quick-check-in', 'App\\Http\\Controllers\\AdminController@roomReservation', 'GET', 2, NULL, NULL, '2022-12-27', '2022-12-27 14:42:45', '2022-12-27 09:10:23'),
(38, 1, NULL, 'admin/check-in/{step}', 'room-reservation', 'App\\Http\\Controllers\\AdminController@roomReservation', 'GET', 1, NULL, NULL, '2022-12-27', '2022-12-27 14:41:03', '2022-12-27 09:11:03'),
(39, 1, NULL, 'admin/settings', 'settings', 'App\\Http\\Controllers\\AdminController@settingsForm', 'GET', 1, NULL, NULL, '2022-12-27', '2022-12-27 14:42:16', '2022-12-27 09:12:16'),
(40, 1, NULL, 'admin/dashboard', 'dashboard', 'App\\Http\\Controllers\\AdminController@index', 'GET', 7, NULL, NULL, '2023-01-09', '2023-01-09 12:02:48', '2023-01-09 06:00:55'),
(41, 1, NULL, 'admin/list-user', 'list-user', 'App\\Http\\Controllers\\AdminController@listUser', 'GET', 1, NULL, NULL, '2023-01-09', '2023-01-09 12:03:03', '2023-01-09 06:33:03'),
(42, 1, NULL, 'admin/settings', 'settings', 'App\\Http\\Controllers\\AdminController@settingsForm', 'GET', 1, NULL, NULL, '2023-01-09', '2023-01-09 12:03:13', '2023-01-09 06:33:13'),
(43, 1, NULL, 'admin/dashboard', 'dashboard', 'App\\Http\\Controllers\\AdminController@index', 'GET', 1, NULL, NULL, '2023-01-11', '2023-01-11 04:03:03', '2023-01-10 22:33:03');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `vendor_address` text,
  `vendor_country` int(11) DEFAULT NULL,
  `vendor_city` varchar(100) DEFAULT NULL,
  `vendor_state` varchar(100) DEFAULT NULL,
  `vendor_gst_num` varchar(50) DEFAULT NULL,
  `vendor_email` varchar(255) DEFAULT NULL,
  `vendor_phone` varchar(100) DEFAULT NULL,
  `vendor_mobile` varchar(100) DEFAULT NULL,
  `contact_person_name` varchar(255) DEFAULT NULL,
  `contact_person_email` varchar(255) DEFAULT NULL,
  `contact_person_mobile` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `category_id`, `vendor_name`, `vendor_address`, `vendor_country`, `vendor_city`, `vendor_state`, `vendor_gst_num`, `vendor_email`, `vendor_phone`, `vendor_mobile`, `contact_person_name`, `contact_person_email`, `contact_person_mobile`, `status`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, 2, 'Abhi', 'arpb, bkn', 261, 'bikaner', NULL, '797987979797', 'abhi@gmail.com', '151-124345', '900000', 'abhi sharma', 'abhs@gmail.com', '900900', 1, 0, '2022-07-12 14:38:07', '2022-07-12 09:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_categories`
--

CREATE TABLE `vendor_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_categories`
--

INSERT INTO `vendor_categories` (`id`, `name`, `status`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, 'Laundry', 1, 0, '2022-07-12 13:46:15', '2022-07-12 08:16:15'),
(2, 'Electrical', 1, 0, '2022-07-12 13:49:41', '2022-07-12 08:16:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus_sections`
--
ALTER TABLE `aboutus_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alert_templates`
--
ALTER TABLE `alert_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booked_rooms`
--
ALTER TABLE `booked_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus_sections`
--
ALTER TABLE `contactus_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `countries` ADD FULLTEXT KEY `IndexName` (`name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynamic_dropdowns`
--
ALTER TABLE `dynamic_dropdowns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `food_categories`
--
ALTER TABLE `food_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_sections`
--
ALTER TABLE `home_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `housekeeping_items`
--
ALTER TABLE `housekeeping_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `housekeeping_orders`
--
ALTER TABLE `housekeeping_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language_translations`
--
ALTER TABLE `language_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_items`
--
ALTER TABLE `laundry_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_orders`
--
ALTER TABLE `laundry_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_order_items`
--
ALTER TABLE `laundry_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_files`
--
ALTER TABLE `media_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_histories`
--
ALTER TABLE `order_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `person_lists`
--
ALTER TABLE `person_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_carts`
--
ALTER TABLE `room_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_prices`
--
ALTER TABLE `room_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_history`
--
ALTER TABLE `stock_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_emails`
--
ALTER TABLE `user_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_categories`
--
ALTER TABLE `vendor_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus_sections`
--
ALTER TABLE `aboutus_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `booked_rooms`
--
ALTER TABLE `booked_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactus_sections`
--
ALTER TABLE `contactus_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dynamic_dropdowns`
--
ALTER TABLE `dynamic_dropdowns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_categories`
--
ALTER TABLE `food_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home_sections`
--
ALTER TABLE `home_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `housekeeping_items`
--
ALTER TABLE `housekeeping_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `housekeeping_orders`
--
ALTER TABLE `housekeeping_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `language_translations`
--
ALTER TABLE `language_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=491;

--
-- AUTO_INCREMENT for table `laundry_items`
--
ALTER TABLE `laundry_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `laundry_orders`
--
ALTER TABLE `laundry_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `laundry_order_items`
--
ALTER TABLE `laundry_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `media_files`
--
ALTER TABLE `media_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_histories`
--
ALTER TABLE `order_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `person_lists`
--
ALTER TABLE `person_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `room_carts`
--
ALTER TABLE `room_carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `room_prices`
--
ALTER TABLE `room_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `stock_history`
--
ALTER TABLE `stock_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_emails`
--
ALTER TABLE `user_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor_categories`
--
ALTER TABLE `vendor_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

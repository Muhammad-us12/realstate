-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2023 at 10:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realstate`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `balance` float NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `picture` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `client_assigns` tinyint(1) NOT NULL DEFAULT 0,
  `opening_bal` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `display_on_web` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `balance`, `fname`, `lname`, `email`, `password`, `picture`, `country`, `city`, `phone`, `address`, `user_id`, `status`, `client_assigns`, `opening_bal`, `created_at`, `updated_at`, `display_on_web`) VALUES
(2, 200, 'Muhammad', 'Ali', 'ali@gmail.com', '$2y$10$wAeVty9Ap27HR.3WjJIkSOc5WuCgkfe1VAIdQQLFpt7Kegiptp.Dq', '1771018875405404.png', 'PAKISTAN', 'Sheikhupura', '0333-2323232', 'Test Address', 16, 'active', 0, 200, '2023-07-10 07:46:55', '2023-07-10 07:46:55', '1');

-- --------------------------------------------------------

--
-- Table structure for table `agent_balances`
--

CREATE TABLE `agent_balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `balance` double(12,2) NOT NULL,
  `agent_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agent_ledegers`
--

CREATE TABLE `agent_ledegers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment` varchar(50) DEFAULT NULL,
  `received` varchar(50) DEFAULT NULL,
  `commission` varchar(50) DEFAULT NULL,
  `balance` varchar(50) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `recevied_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `agent_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `block_name` varchar(255) NOT NULL,
  `scoiety` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `description` longtext NOT NULL,
  `blog_category` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `CNIC` varchar(255) NOT NULL,
  `buyer_type` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `opening_bal` double(12,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buyer_balances`
--

CREATE TABLE `buyer_balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `balance` double(12,2) NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_accountledgers`
--

CREATE TABLE `cash_accountledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment` varchar(50) DEFAULT NULL,
  `received` varchar(50) DEFAULT NULL,
  `balance` varchar(50) NOT NULL,
  `deposit_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `recevied_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `expense_id` int(11) DEFAULT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `insevter_name` varchar(300) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_accounts`
--

CREATE TABLE `cash_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `opening_bal` double(12,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_accounts_bals`
--

CREATE TABLE `cash_accounts_bals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `balance` double(12,2) NOT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_account_deposits`
--

CREATE TABLE `cash_account_deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deposit_amount` double(12,2) NOT NULL,
  `deposit_by` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `insevter_name` varchar(300) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `client_type` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `client_resource` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Open',
  `assign_to` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(30) DEFAULT NULL,
  `update_by_id` int(11) DEFAULT NULL,
  `dealer_name` varchar(255) DEFAULT NULL,
  `client_profession` varchar(255) DEFAULT NULL,
  `client_address` varchar(255) DEFAULT NULL,
  `other_phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `phone`, `client_type`, `country`, `city`, `client_resource`, `status`, `assign_to`, `created_by`, `created_at`, `updated_at`, `updated_by`, `update_by_id`, `dealer_name`, `client_profession`, `client_address`, `other_phone`, `email`) VALUES
(1, 'Muhammad', 'Usama', '0333-2323232', 'Dealer', 'PAKISTAN', 'Sheikhupura', 'Personal Client', 'Open', 2, 2, '2023-07-10 08:00:18', '2023-07-10 08:00:18', NULL, NULL, 'TEst Dealer', 'Laravel Developer', 'This is Cleint Address', '+9230432423423', 'usama.asghar7868@gmail.com'),
(2, 'Muhammad', 'Ali', '+9230203499393', 'Dealer', 'PAKISTAN', 'Sheikhupura', 'Personal Client', 'In Progress', 2, 2, '2023-07-10 08:06:24', '2023-07-10 08:24:52', NULL, NULL, 'TEst Dealer', 'Laravel Developer', 'This is Cleint Address', '+9230432423423', 'usama.asghar7868@gmail.com'),
(3, 'Muhammad', 'Aslam', '+9230203499393', 'Dealer', 'PAKISTAN', 'Sheikhupura', 'Personal Client', 'Open', 2, 2, '2023-07-10 08:07:06', '2023-07-10 08:07:06', NULL, NULL, 'TEst Dealer', 'Laravel Developer', 'This is Cleint Address', '+9230432423423', 'usama.asghar7868@gmail.com'),
(4, 'Muhammad', 'Saqib', '+9230203499393', 'Dealer', 'PAKISTAN', 'Sarhgodah', 'Personal Client', 'Open', 2, 2, '2023-07-10 08:08:30', '2023-07-10 08:08:30', NULL, NULL, 'TEst Dealer', 'Laravel Developer', 'This is Cleint Address', '+9230432423423', 'usama.asghar7868@gmail.com'),
(5, 'Muhammad', 'Irfan', '+9230203499393', 'Dealer', 'PAKISTAN', 'Sarhgodah', 'Personal Client', 'Open', 2, 16, '2023-07-10 08:17:02', '2023-07-10 08:23:07', NULL, NULL, 'TEst Dealer', 'Laravel Developer', 'This is Cleint Address', '+9230432423423', 'usama.asghar78688@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `clients_follow_ups`
--

CREATE TABLE `clients_follow_ups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `next_follow_up_time` datetime DEFAULT NULL,
  `sub_category_id` int(11) NOT NULL,
  `follow_up_message` text NOT NULL,
  `follow_up_by` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients_follow_ups`
--

INSERT INTO `clients_follow_ups` (`id`, `client_id`, `next_follow_up_time`, `sub_category_id`, `follow_up_message`, `follow_up_by`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 1, 'Agree', '2', '2023-07-10 08:24:52', '2023-07-10 08:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us_queries`
--

CREATE TABLE `contact_us_queries` (
  `id` int(11) NOT NULL,
  `message` varchar(3000) DEFAULT NULL,
  `name` varchar(300) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `subject` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `curren_follow_ups`
--

CREATE TABLE `curren_follow_ups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `follow_up_time` datetime NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'false',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `curren_follow_ups`
--

INSERT INTO `curren_follow_ups` (`id`, `client_id`, `follow_up_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-07-10 14:00:18', 'false', NULL, NULL),
(2, 2, '2023-07-10 14:06:24', 'true', NULL, '2023-07-10 08:24:52'),
(3, 3, '2023-07-10 14:07:06', 'false', NULL, NULL),
(4, 4, '2023-07-10 14:08:30', 'false', NULL, NULL),
(5, 5, '2023-07-10 14:23:07', 'false', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customerledgers`
--

CREATE TABLE `customerledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment` varchar(50) DEFAULT NULL,
  `received` varchar(50) DEFAULT NULL,
  `balance` varchar(50) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `recevied_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custfname` varchar(255) NOT NULL,
  `custlname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `CNIC` varchar(255) NOT NULL,
  `customer_type` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `opening_bal` double(12,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_balances`
--

CREATE TABLE `customer_balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `balance` double(12,2) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exp_name` varchar(255) NOT NULL,
  `total_amount` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exp_category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_sub_categories`
--

CREATE TABLE `expense_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exp_sub_category` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `registration_no` varchar(255) NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `society_id` bigint(20) UNSIGNED NOT NULL,
  `block_id` bigint(20) UNSIGNED NOT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `account_id_recv` bigint(20) UNSIGNED DEFAULT NULL,
  `marala_type` bigint(20) UNSIGNED NOT NULL,
  `purchase_amount` double(12,2) NOT NULL,
  `sale_amount` float DEFAULT NULL,
  `recevied_amount` double(12,2) DEFAULT NULL,
  `remaining_amount` double(12,2) DEFAULT NULL,
  `commission_amount` double(12,2) DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `sold_date` date DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `agent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `state_type` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `purc_post_status` tinyint(1) NOT NULL DEFAULT 0,
  `sale_post_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follow_up_categories`
--

CREATE TABLE `follow_up_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `follow_up_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follow_up_categories`
--

INSERT INTO `follow_up_categories` (`id`, `follow_up_name`, `created_at`, `updated_at`) VALUES
(1, 'Follow Up', '2023-07-10 08:17:35', '2023-07-10 08:17:35'),
(2, 'Lost', '2023-07-10 08:17:46', '2023-07-10 08:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `follow_up_sub_categories`
--

CREATE TABLE `follow_up_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `follow_up_sub_category` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follow_up_sub_categories`
--

INSERT INTO `follow_up_sub_categories` (`id`, `follow_up_sub_category`, `category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Seem Agree', 1, 16, '2023-07-10 08:18:05', '2023-07-10 08:18:05'),
(2, 'Wrong Number', 2, 16, '2023-07-10 08:18:20', '2023-07-10 08:18:20');

-- --------------------------------------------------------

--
-- Table structure for table `lead_users`
--

CREATE TABLE `lead_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `local_properties`
--

CREATE TABLE `local_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `img` varchar(300) DEFAULT NULL,
  `title` varchar(300) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `society_id` int(11) NOT NULL,
  `state_type` varchar(255) NOT NULL,
  `property_type` varchar(255) NOT NULL,
  `area` varchar(255) DEFAULT NULL,
  `road_size` varchar(255) DEFAULT NULL,
  `street_size` varchar(255) DEFAULT NULL,
  `owner_name` varchar(255) NOT NULL,
  `demand_amount` double(12,2) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `agent_id` bigint(20) UNSIGNED NOT NULL,
  `marala_type` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_amount` double(12,2) DEFAULT NULL,
  `recevied_amount` double(12,2) DEFAULT NULL,
  `remaining_amount` double(12,2) DEFAULT NULL,
  `commission_amount` double(12,2) DEFAULT NULL,
  `agent_commission` float DEFAULT NULL,
  `account_id_recv` bigint(20) UNSIGNED DEFAULT NULL,
  `buyer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sold_date` date DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `purc_post_status` tinyint(1) NOT NULL DEFAULT 0,
  `sale_post_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `taken_amount` float NOT NULL DEFAULT 0,
  `commission_paid` float NOT NULL DEFAULT 0,
  `owner_phone_no` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maralas`
--

CREATE TABLE `maralas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `marala` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `description` text NOT NULL,
  `offer_category` bigint(20) UNSIGNED NOT NULL,
  `offer_location` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers_categories`
--

CREATE TABLE `offers_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `prev_balance` varchar(50) DEFAULT NULL,
  `updated_balance` varchar(50) DEFAULT NULL,
  `total_payments` varchar(50) NOT NULL,
  `Criteria` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Criteria`)),
  `Content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Content`)),
  `Content_Ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Content_Ids`)),
  `Amount` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Amount`)),
  `remarks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`remarks`)),
  `payment_from` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recevied_payments`
--

CREATE TABLE `recevied_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `prev_balance` varchar(50) DEFAULT NULL,
  `updated_balance` varchar(50) DEFAULT NULL,
  `total_received` varchar(50) NOT NULL,
  `Criteria` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Criteria`)),
  `Content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Content`)),
  `Content_Ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Content_Ids`)),
  `Amount` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Amount`)),
  `remarks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`remarks`)),
  `received_from` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `societies`
--

CREATE TABLE `societies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `society_name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `location` bigint(20) UNSIGNED NOT NULL,
  `display_on_web` varchar(10) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `super_admins`
--

CREATE TABLE `super_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_rights` text NOT NULL,
  `img` varchar(300) NOT NULL,
  `role` varchar(300) NOT NULL DEFAULT 'user',
  `agent_id` int(11) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_rights`, `img`, `role`, `agent_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Shafique', 'saddiquecarpet@gmail.com', NULL, '$2y$10$ba8VyfqgiIrG8PkHkH48ROCxMZij/EEU.2NVQzkrJhgSf9txY8xra', 'null', '1765394584387109.jpeg', 'admin', 0, 'active', 'qzjOaztQqRFPYvtQ5aEfb65HRbr4nsEMa9JvM4UDif6VuwbOvMEmuXMQWeTQ', '2022-09-17 03:30:12', '2023-05-24 19:08:04'),
(2, 'Muhammad Ali', 'ali@gmail.com', NULL, '$2y$10$D08BK9gCdLyOup9gAFMhL.pow1F95Qo0hNp8oMx7rN9P4V8w07Mh2', '[\"Locations\",\"Scoieties\",\"Files\",\"Local Property\",\"Agents\",\"Customer\",\"Buyers\",\"Accounts\",\"Payments\",\"Received\",\"Expense\"]', '1751782324790787.jpg', 'user', 12, 'active', NULL, '2022-12-09 23:50:11', '2022-12-09 23:50:11'),
(3, 'test agent', 'agent@gmail.com', NULL, '$2y$10$5XOwwVD7ltqQXR7GPDqNf.apQchjZwlMyu6z1H39y5RcYMLJohk/i', '[\"Blogs\",\"Videos\",\"Offers\"]', '1751784052897849.jpg', 'user', 13, 'active', NULL, '2022-12-10 00:17:39', '2022-12-10 00:17:39'),
(4, 'Test Agent Ass', 'agj@gmail.com', NULL, '$2y$10$LkV3f1oXM72QeJn728njm.dpvN9zQxKYpQGDrciYSIwwxM3t2gZUq', '[\"Blogs\",\"Videos\",\"Offers\",\"Locations\",\"Scoieties\",\"Files\",\"Local Property\",\"Agents\",\"Customer\",\"Buyers\",\"Accounts\",\"Payments\",\"Received\",\"Expense\"]', '1755756514541518.jpg', 'user', 14, 'active', NULL, '2023-01-22 20:38:13', '2023-01-22 20:38:13'),
(5, 'Musarat Bano', 'musarat@gmail.com', NULL, '$2y$10$YA0cWKk3xZsSVq.ljQNykeDPMk0rfrAespA9beb8SRgc09iFewj02', '[\"Blogs\",\"Videos\",\"Offers\",\"Locations\",\"Scoieties\",\"Files\",\"Files_post\",\"Local Property\",\"Agents\",\"Customer\",\"Buyers\",\"Accounts\",\"Payments\",\"Received\",\"Expense\",\"day_book\",\"Expense_report\",\"pay_&_recv_report\",\"ledger_reports\",\"Files_reports\",\"local_reports\"]', '1755994727603571.png', 'user', 1, 'block', NULL, '2023-01-25 21:44:31', '2023-05-30 22:45:10'),
(6, 'Faria Ashraf', 'faria@gmail.com', NULL, '$2y$10$4W6u6jiif4z6/zrWgPovwuq9QKASzAs4sb2Uk0FJhGtcQz49646O2', '[\"Blogs\",\"Videos\",\"Offers\",\"Locations\",\"Scoieties\",\"Files\",\"Files_post\",\"Local Property\",\"Agents\",\"Customer\",\"Buyers\",\"Accounts\",\"Payments\",\"Received\",\"Expense\",\"day_book\",\"Expense_report\",\"pay_&_recv_report\",\"ledger_reports\",\"Files_reports\",\"local_reports\"]', '1756249043426312.png', 'user', 2, 'block', 'I0Uwu7KEfcrfvZcMRyLmWbACaTFCcbjo5RiRV7TGplVRFY9HbpGvQAgvBAIa', '2023-01-28 17:06:45', '2023-05-30 22:45:53'),
(7, 'Muhammad Usama', 'usama.asghar78688@gmail.com', NULL, '$2y$10$wnRWkwTsKkgtV1lYNbyYOO7bM8RxHo/lkDFmDOkHmsWFYOxeCL1SS', '[\"Blogs\",\"Videos\",\"Offers\",\"Locations\",\"Scoieties\",\"Files\",\"Files_post\",\"Local Property\",\"Agents\",\"Customer\",\"Buyers\",\"Accounts\",\"Payments\",\"Received\",\"Expense\",\"day_book\",\"Expense_report\",\"pay_&_recv_report\",\"ledger_reports\",\"Files_reports\",\"local_reports\"]', '1756897964932313.png', 'user', 3, 'active', NULL, '2023-02-04 21:01:05', '2023-03-23 05:16:26'),
(8, 'Bushra Shafi', 'bushra@gmail.com', NULL, '$2y$10$W7m/yh.qblWGuTM9pGW6I.89lR1..swtkJwDiLOWRYYXbGIWsAQQ6', '[\"Blogs\",\"Videos\",\"Offers\"]', '1756905800265296.png', 'user', 4, 'active', NULL, '2023-02-04 23:05:38', '2023-02-20 17:04:31'),
(12, 'Bushra Shafi Shafi', 'bushra1@gmail.com', NULL, '$2y$10$J5E9.1Q0HzGtITBVSmi/QeFgr1S2bgNVly9uxdtA6n.PK0bfCnvJW', '[\"Blogs\",\"Videos\",\"Offers\",\"Locations\",\"Scoieties\",\"Files\",\"Users\",\"Files_post\",\"Local Property\",\"Agents\",\"Customer\",\"Buyers\",\"Accounts\",\"Payments\",\"Received\",\"Expense\",\"day_book\",\"Expense_report\",\"pay_&_recv_report\",\"ledger_reports\",\"Files_reports\",\"local_reports\"]', '1757349607212662.jpeg', 'user', 8, 'active', NULL, '2023-02-09 20:39:45', '2023-05-24 17:37:38'),
(13, 'Qasim Khan', 'qasimrazakhan24@gmail.com', NULL, '$2y$10$0w14kWtnAWo3qtiwu0oDnuJY2/G.UrHIg5UT8cWxUyILo3wtY/gHS', '[\"Blogs\",\"Videos\",\"Offers\",\"Locations\",\"Scoieties\"]', '1758341674203284.jpg', 'user', 9, 'active', '6kZhMd6wMO3I09ohrbbdzgTfLp2X6Zhovm25465xGRrk7KSYR3retLXKSVvW', '2023-02-20 19:28:14', '2023-03-30 16:55:20'),
(14, 'Arham Ali', 'arhamali4006@gmail.com', NULL, '$2y$10$/6VjcbwG7NTKRcVh9dT0VuJsrtrpgn/TZgq.UIDVf13uJzUB2PcRu', '[\"Blogs\",\"Videos\",\"Offers\",\"Locations\",\"Scoieties\",\"Local Property\",\"local_reports\"]', '1760600921977024.jpg', 'user', 10, 'block', 'q0CCuRvOITw1oifi3uxONiEUwDwaMfUzgs2dW8hkbqARypnq4bmLS9PK35Ik', '2023-03-17 16:58:00', '2023-05-31 14:43:03'),
(15, 'Test Agent Add Usama', 'test7868@gmail.com', NULL, '$2y$10$Ggpb/TcdaGQfYPTJU85inO9vCmFI6.pETr34Qrohhv7zxNj2LdFHC', '[\"Blogs\",\"Videos\",\"Offers\",\"Locations\",\"Scoieties\",\"Files\",\"Files_post\",\"Local Property\",\"Agents\",\"Customer\",\"Buyers\",\"Accounts\",\"Payments\",\"Received\",\"day_book\",\"Expense_report\",\"pay_&_recv_report\",\"ledger_reports\",\"Files_reports\",\"local_reports\"]', '1762822857108825.png', 'user', 11, 'active', NULL, '2023-04-11 05:34:43', '2023-04-11 05:34:43'),
(16, 'Muhammad Usama', 'usama.asghar7868@gmail.com', NULL, '$2y$10$wnRWkwTsKkgtV1lYNbyYOO7bM8RxHo/lkDFmDOkHmsWFYOxeCL1SS', 'null', '1765869360695701.jpeg', 'admin', 0, 'active', 'rFGENGQnNGFtPlPap5cwgnBFTmXtqlVQ2EV5NNSZ50jLkjmT604VXjjwb6It', '2022-09-17 03:30:12', '2023-05-30 22:44:34'),
(19, 'Aneeza Rahman', 'aneeza54770@gmail.com', NULL, '$2y$10$i2xKSvGg94mkKpLBCK5DWeLElEDJ7GJdQwtjjw7PY4z3h8eFcEoBC', '[\"Blogs\",\"Videos\",\"Offers\",\"Locations\",\"Scoieties\",\"Files\",\"Files_post\",\"Agents\",\"Customer\",\"Buyers\",\"Accounts\",\"Payments\",\"Received\",\"Expense\",\"day_book\",\"Expense_report\",\"pay_&_recv_report\",\"ledger_reports\",\"Files_reports\"]', '1767397827745322.jpg', 'user', NULL, 'active', NULL, NULL, '2023-05-31 17:32:30'),
(20, 'Sajid Muhammad', 'Muhammadsajid0115@gmail.com', NULL, '$2y$10$gS6pARZIM1aBCpc7e7p/LuhSPtnhDoa19tGNAqLqLodmvqJf7XcZ2', '[\"Blogs\",\"Videos\",\"Offers\",\"Locations\",\"Scoieties\",\"Files\",\"Files_post\",\"Local Property\",\"Agents\",\"Customer\",\"Buyers\",\"Accounts\",\"Payments\",\"Received\",\"day_book\",\"Expense_report\",\"pay_&_recv_report\",\"ledger_reports\",\"Files_reports\",\"local_reports\"]', '1770483336624465.jpeg', 'user', NULL, 'active', NULL, NULL, '2023-07-04 18:54:45');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `video_link` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `description` text NOT NULL,
  `video_category` bigint(20) UNSIGNED NOT NULL,
  `scoiety_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video_categories`
--

CREATE TABLE `video_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agents_email_unique` (`email`);

--
-- Indexes for table `agent_balances`
--
ALTER TABLE `agent_balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_balances_agent_id_foreign` (`agent_id`);

--
-- Indexes for table `agent_ledegers`
--
ALTER TABLE `agent_ledegers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_ledegers_agent_id_foreign` (`agent_id`);

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blocks_scoiety_foreign` (`scoiety`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_blog_category_foreign` (`blog_category`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `buyers_cnic_unique` (`CNIC`);

--
-- Indexes for table `buyer_balances`
--
ALTER TABLE `buyer_balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyer_balances_buyer_id_foreign` (`buyer_id`);

--
-- Indexes for table `cash_accountledgers`
--
ALTER TABLE `cash_accountledgers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_accountledgers_account_id_foreign` (`account_id`);

--
-- Indexes for table `cash_accounts`
--
ALTER TABLE `cash_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cash_accounts_account_name_unique` (`account_name`);

--
-- Indexes for table `cash_accounts_bals`
--
ALTER TABLE `cash_accounts_bals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_accounts_bals_account_id_foreign` (`account_id`);

--
-- Indexes for table `cash_account_deposits`
--
ALTER TABLE `cash_account_deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_account_deposits_account_id_foreign` (`account_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_follow_ups`
--
ALTER TABLE `clients_follow_ups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us_queries`
--
ALTER TABLE `contact_us_queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curren_follow_ups`
--
ALTER TABLE `curren_follow_ups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerledgers`
--
ALTER TABLE `customerledgers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerledgers_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_cnic_unique` (`CNIC`);

--
-- Indexes for table `customer_balances`
--
ALTER TABLE `customer_balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_balances_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_account_id_foreign` (`account_id`),
  ADD KEY `expenses_category_id_foreign` (`category_id`),
  ADD KEY `expenses_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_sub_categories`
--
ALTER TABLE `expense_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_location_id_foreign` (`location_id`),
  ADD KEY `files_society_id_foreign` (`society_id`),
  ADD KEY `files_block_id_foreign` (`block_id`),
  ADD KEY `files_account_id_foreign` (`account_id`),
  ADD KEY `files_account_id_recv_foreign` (`account_id_recv`),
  ADD KEY `files_marala_type_foreign` (`marala_type`),
  ADD KEY `files_customer_id_foreign` (`customer_id`),
  ADD KEY `files_agent_id_foreign` (`agent_id`);

--
-- Indexes for table `follow_up_categories`
--
ALTER TABLE `follow_up_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow_up_sub_categories`
--
ALTER TABLE `follow_up_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_users`
--
ALTER TABLE `lead_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lead_users_email_unique` (`email`);

--
-- Indexes for table `local_properties`
--
ALTER TABLE `local_properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `local_properties_location_id_foreign` (`location_id`),
  ADD KEY `local_properties_customer_id_foreign` (`customer_id`),
  ADD KEY `local_properties_agent_id_foreign` (`agent_id`),
  ADD KEY `local_properties_marala_type_foreign` (`marala_type`),
  ADD KEY `local_properties_account_id_recv_foreign` (`account_id_recv`),
  ADD KEY `local_properties_buyer_id_foreign` (`buyer_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maralas`
--
ALTER TABLE `maralas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_offer_category_foreign` (`offer_category`),
  ADD KEY `offers_offer_location_foreign` (`offer_location`);

--
-- Indexes for table `offers_categories`
--
ALTER TABLE `offers_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_payment_from_foreign` (`payment_from`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `recevied_payments`
--
ALTER TABLE `recevied_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recevied_payments_received_from_foreign` (`received_from`);

--
-- Indexes for table `societies`
--
ALTER TABLE `societies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `societies_location_foreign` (`location`);

--
-- Indexes for table `super_admins`
--
ALTER TABLE `super_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `super_admins_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_video_category_foreign` (`video_category`),
  ADD KEY `videos_scoiety_id_foreign` (`scoiety_id`);

--
-- Indexes for table `video_categories`
--
ALTER TABLE `video_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agent_balances`
--
ALTER TABLE `agent_balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agent_ledegers`
--
ALTER TABLE `agent_ledegers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buyer_balances`
--
ALTER TABLE `buyer_balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_accountledgers`
--
ALTER TABLE `cash_accountledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_accounts`
--
ALTER TABLE `cash_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_accounts_bals`
--
ALTER TABLE `cash_accounts_bals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_account_deposits`
--
ALTER TABLE `cash_account_deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clients_follow_ups`
--
ALTER TABLE `clients_follow_ups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_us_queries`
--
ALTER TABLE `contact_us_queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `curren_follow_ups`
--
ALTER TABLE `curren_follow_ups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customerledgers`
--
ALTER TABLE `customerledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_balances`
--
ALTER TABLE `customer_balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_sub_categories`
--
ALTER TABLE `expense_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follow_up_categories`
--
ALTER TABLE `follow_up_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `follow_up_sub_categories`
--
ALTER TABLE `follow_up_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lead_users`
--
ALTER TABLE `lead_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `local_properties`
--
ALTER TABLE `local_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maralas`
--
ALTER TABLE `maralas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers_categories`
--
ALTER TABLE `offers_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recevied_payments`
--
ALTER TABLE `recevied_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `societies`
--
ALTER TABLE `societies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `super_admins`
--
ALTER TABLE `super_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_categories`
--
ALTER TABLE `video_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agent_balances`
--
ALTER TABLE `agent_balances`
  ADD CONSTRAINT `agent_balances_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `agent_ledegers`
--
ALTER TABLE `agent_ledegers`
  ADD CONSTRAINT `agent_ledegers_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blocks`
--
ALTER TABLE `blocks`
  ADD CONSTRAINT `blocks_scoiety_foreign` FOREIGN KEY (`scoiety`) REFERENCES `societies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_blog_category_foreign` FOREIGN KEY (`blog_category`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `buyer_balances`
--
ALTER TABLE `buyer_balances`
  ADD CONSTRAINT `buyer_balances_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `buyers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cash_accountledgers`
--
ALTER TABLE `cash_accountledgers`
  ADD CONSTRAINT `cash_accountledgers_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `cash_accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cash_accounts_bals`
--
ALTER TABLE `cash_accounts_bals`
  ADD CONSTRAINT `cash_accounts_bals_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `cash_accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cash_account_deposits`
--
ALTER TABLE `cash_account_deposits`
  ADD CONSTRAINT `cash_account_deposits_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `cash_accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customerledgers`
--
ALTER TABLE `customerledgers`
  ADD CONSTRAINT `customerledgers_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_balances`
--
ALTER TABLE `customer_balances`
  ADD CONSTRAINT `customer_balances_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `cash_accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `expense_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `expense_sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expense_sub_categories`
--
ALTER TABLE `expense_sub_categories`
  ADD CONSTRAINT `expense_sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `expense_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `cash_accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `files_account_id_recv_foreign` FOREIGN KEY (`account_id_recv`) REFERENCES `cash_accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `files_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `files_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `files_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `files_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `files_marala_type_foreign` FOREIGN KEY (`marala_type`) REFERENCES `maralas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `files_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `societies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_offer_category_foreign` FOREIGN KEY (`offer_category`) REFERENCES `offers_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `offers_offer_location_foreign` FOREIGN KEY (`offer_location`) REFERENCES `locations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_payment_from_foreign` FOREIGN KEY (`payment_from`) REFERENCES `cash_accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recevied_payments`
--
ALTER TABLE `recevied_payments`
  ADD CONSTRAINT `recevied_payments_received_from_foreign` FOREIGN KEY (`received_from`) REFERENCES `cash_accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `societies`
--
ALTER TABLE `societies`
  ADD CONSTRAINT `societies_location_foreign` FOREIGN KEY (`location`) REFERENCES `locations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_scoiety_id_foreign` FOREIGN KEY (`scoiety_id`) REFERENCES `societies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `videos_video_category_foreign` FOREIGN KEY (`video_category`) REFERENCES `video_categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

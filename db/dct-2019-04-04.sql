-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2019 at 02:29 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dct`
--

-- --------------------------------------------------------

--
-- Table structure for table `designs`
--

CREATE TABLE `designs` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designs`
--

INSERT INTO `designs` (`id`, `parent_id`, `name`, `image`, `created_at`) VALUES
(1, NULL, 'Kids Birthday Cakes', 'kids-bd-cakes.jpg', '2019-03-15 18:50:59'),
(2, NULL, 'Adults Birthday Cakes', 'adult-bd-cakes.jpg', '2019-03-15 08:04:26'),
(3, NULL, 'Cupcakes/ Mini Cakes', 'cupcakes-mini-cakes.jpg', '2019-03-15 08:04:26'),
(4, NULL, 'Wedding Cakes', 'wedding-cakes.jpg', '2019-03-15 08:04:26'),
(5, NULL, 'Christening Cakes', 'christening-cakes.jpg', '2019-03-15 08:04:26'),
(6, NULL, 'Naming & Baby Shower Cakes', 'naming-baby-shower-cakes.jpg', '2019-03-15 08:04:26'),
(7, 0, 'All Kids Birthday Cakes ', 'all-kids-birthday-cakes.jpg', '2019-03-17 09:27:52'),
(8, 1, 'Girls Birthday Cakes ', 'girls-birthday-cakes.jpg', '2019-03-17 09:27:38'),
(9, 1, 'Boys Birthday Cakes ', 'boys-birthday-cakes.jpg', '2019-03-17 09:27:44'),
(10, 1, 'Twins Birthday Cakes ', 'twins-birthday-cakes.jpg', '2019-03-17 09:27:48'),
(11, 0, 'All Adult Birthday Cakes ', 'all-adult-birthday-cakes.jpg', '2019-04-04 06:18:59'),
(12, 2, 'Female Birthday Cakes ', 'female-birthday-cakes.jpg', '2019-03-15 08:04:26'),
(13, 2, 'Male Birthday Cakes ', 'male-birthday-cakes.jpg', '2019-03-15 08:04:26'),
(14, 2, 'Twins Birthday Cakes ', 'twins-adult-birthday-cakes.jpg', '2019-03-15 08:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `fillings`
--

CREATE TABLE `fillings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fillings`
--

INSERT INTO `fillings` (`id`, `name`, `slug`, `image`, `created_at`) VALUES
(1, 'Vanilla ', 'vanilla ', 'vanilla.jpg', '2019-03-25 05:52:41'),
(2, 'Cream Cheese', 'cream-cheese', 'vanilla.jpg', '2019-03-25 05:52:58'),
(3, 'Chocolate', 'chocolate', 'vanilla.jpg', '2019-03-25 05:53:21'),
(4, 'Chocolate Hazelnut', 'chocolate-hazelnut', 'vanilla.jpg', '2019-03-25 05:53:21'),
(5, 'Strawberry', 'strawberry', 'vanilla.jpg', '2019-03-25 05:53:21'),
(6, 'Passion Fruit', 'passion-fruit', 'vanilla.jpg', '2019-03-25 05:53:21'),
(7, 'Pineapple and Peach with Vanilla ', 'pineapple-and-peach-with-vanilla ', 'vanilla.jpg', '2019-03-25 05:53:21'),
(8, 'Passion Fruit and Peach with Vanilla ', 'passion-fruit-and-peach-with-vanilla ', 'vanilla.jpg', '2019-03-25 05:53:21'),
(9, 'Black forest filling with Chocolate', 'black-forest-filling-with-chocolate', 'vanilla.jpg', '2019-03-25 05:53:21'),
(10, 'Strawberry Jam with Vanilla', 'strawberry-jam-with-vanilla', 'vanilla.jpg', '2019-03-25 05:53:21'),
(11, 'Rum Flavoured', 'rum-flavoured', 'vanilla.jpg', '2019-03-25 05:53:21'),
(12, 'Blueberry Flavoured', 'blueberry-flavoured', 'vanilla.jpg', '2019-03-25 05:53:21'),
(13, 'Butterscotch Flavoured', 'butterscotch-flavoured', 'vanilla.jpg', '2019-03-25 05:53:21'),
(14, 'Caramel Flavoured', 'caramel-flavoured', 'vanilla.jpg', '2019-03-25 05:53:21'),
(15, 'Lime Flavoured', 'lime-flavoured', 'vanilla.jpg', '2019-03-25 05:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `flavours`
--

CREATE TABLE `flavours` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flavours`
--

INSERT INTO `flavours` (`id`, `parent_id`, `name`, `slug`, `image`, `created_at`) VALUES
(1, NULL, 'Sponge Cake', 'sponge-cake', 'sponge-cake.jpg', '2019-03-21 13:15:15'),
(2, NULL, 'Carrot Cake', 'carrot-cake', 'carrot-cake.jpg', '2019-03-21 13:15:21'),
(3, NULL, 'Chocolate Mud Cake', 'chocolate-mud-cake', 'chocolate-mud-cake.jpg', '2019-03-21 13:15:26'),
(4, NULL, 'Red Velvet Cake', 'red-velvet-cake', 'red-velvet-cake.jpg', '2019-03-21 13:15:31'),
(5, NULL, 'Sri Lankan Cake', 'sri-lankan-cake', 'sri-lankan-cake.jpg', '2019-03-21 13:15:36'),
(6, NULL, 'Dietary Requirement Cakes', 'dietary-requirements-cake', 'dietary-requirements-cake.jpg', '2019-03-21 13:15:44'),
(7, 1, 'Vanilla', 'sponge-cake-vanilla', 'sponge-cake-vanilla.jpg', '2019-03-21 13:15:56'),
(8, 1, 'Chocolate', 'sponge-cake-chocolate', 'sponge-cake-chocolate.jpg', '2019-03-21 13:16:03'),
(9, 1, 'Strawberry', 'sponge-cake-strawberry', 'sponge-cake-strawberry.jpg', '2019-03-21 13:16:11'),
(10, 1, 'Coffee', 'sponge-cake-coffee', 'sponge-cake-coffee.jpg', '2019-03-21 13:16:16'),
(11, 5, 'Vanilla Butter Cake', 'sri-lankan-cake-vanilla-butter', '1.jpg', '2019-03-21 13:27:04'),
(12, 5, 'Chocolate Cake', 'sri-lankan-cake-chocolate', '1.jpg', '2019-03-21 13:27:14'),
(13, 5, 'Ribbon Cake', 'sri-lankan-cake-ribbon', '1.jpg', '2019-03-21 13:27:21'),
(14, 6, 'Vanilla - Eggless Cake', 'dietary-requirements-cake-vanilla-eggless', '1.jpg', '2019-03-21 13:27:49'),
(15, 6, 'Chocolate - Eggless Cake', 'dietary-requirements-cake-chocolate-eggless', '1.jpg', '2019-03-21 13:27:57'),
(16, 6, 'Vanilla - Gluten Free Cake', 'dietary-requirements-cake-vanilla-gluten-free', '1.jpg', '2019-03-21 13:28:11'),
(17, 6, 'Chocolate - Gluten Free Cake', 'dietary-requirements-cake-chocolate-gluten-free', '1.jpg', '2019-03-21 13:28:20'),
(18, 6, 'Vanilla - Lactose Free Cake', 'dietary-requirements-cake-vanilla-lactose-free', '1.jpg', '2019-03-21 13:28:26'),
(19, 6, 'Chocolate - Lactose Free Cake', 'dietary-requirements-cake-chocolate-lactose-free', '1.jpg', '2019-03-21 13:28:36'),
(20, 6, 'Vanilla - Vegan Cake', 'dietary-requirements-cake-vanilla-vegan', '1.jpg', '2019-03-21 13:28:45'),
(21, 6, 'Chocolate - Vegan Cake', 'dietary-requirements-cake-chocolate-vegan', '1.jpg', '2019-03-21 13:28:57');

-- --------------------------------------------------------

--
-- Table structure for table `flavour_filling`
--

CREATE TABLE `flavour_filling` (
  `id` int(10) UNSIGNED NOT NULL,
  `flavour_id` int(10) UNSIGNED NOT NULL,
  `filling_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flavour_filling`
--

INSERT INTO `flavour_filling` (`id`, `flavour_id`, `filling_id`, `created_at`) VALUES
(1, 7, 1, '2019-03-15 09:02:45'),
(2, 7, 2, '2019-03-15 09:04:20'),
(3, 7, 3, '2019-03-15 09:04:20'),
(4, 7, 4, '2019-03-15 09:04:20'),
(5, 7, 5, '2019-03-15 09:04:20'),
(6, 7, 6, '2019-03-15 09:04:20'),
(7, 7, 7, '2019-03-15 09:04:20'),
(8, 7, 8, '2019-03-15 09:04:20'),
(9, 7, 9, '2019-03-15 09:04:20'),
(10, 7, 10, '2019-03-15 09:04:20'),
(11, 7, 11, '2019-03-15 09:04:20'),
(12, 7, 12, '2019-03-15 09:04:20'),
(13, 7, 13, '2019-03-15 09:04:20'),
(14, 7, 14, '2019-03-15 09:04:20'),
(15, 7, 15, '2019-03-15 09:04:20'),
(16, 8, 1, '2019-03-15 09:06:26'),
(17, 8, 3, '2019-03-15 09:06:26'),
(18, 8, 4, '2019-03-15 09:06:26'),
(19, 8, 9, '2019-03-15 09:06:26'),
(20, 8, 10, '2019-03-15 09:06:26'),
(21, 8, 11, '2019-03-15 09:06:26'),
(22, 9, 1, '2019-03-15 09:08:22'),
(23, 9, 2, '2019-03-15 09:08:22'),
(24, 9, 5, '2019-03-15 09:08:22'),
(25, 9, 9, '2019-03-15 09:08:22'),
(26, 9, 11, '2019-03-15 09:08:22'),
(27, 10, 1, '2019-03-15 09:10:47'),
(28, 10, 3, '2019-03-15 09:10:47'),
(29, 10, 4, '2019-03-15 09:10:47'),
(30, 10, 9, '2019-03-15 09:10:47'),
(31, 10, 10, '2019-03-15 09:10:47'),
(32, 10, 11, '2019-03-15 09:10:47'),
(33, 10, 12, '2019-03-15 09:10:47'),
(34, 10, 13, '2019-03-15 09:10:47'),
(35, 2, 1, '2019-03-15 09:13:30'),
(36, 2, 2, '2019-03-15 09:13:30'),
(37, 11, 1, '2019-03-15 09:37:03'),
(38, 11, 2, '2019-03-15 09:37:03'),
(39, 11, 3, '2019-03-15 09:37:03'),
(40, 11, 4, '2019-03-15 09:37:03'),
(41, 11, 5, '2019-03-15 09:37:03'),
(42, 11, 6, '2019-03-15 09:37:03'),
(43, 11, 7, '2019-03-15 09:37:03'),
(44, 11, 8, '2019-03-15 09:37:03'),
(45, 11, 9, '2019-03-15 09:37:03'),
(46, 11, 10, '2019-03-15 09:37:03'),
(47, 11, 11, '2019-03-15 09:37:03'),
(48, 11, 12, '2019-03-15 09:37:03'),
(49, 11, 13, '2019-03-15 09:37:03'),
(50, 11, 14, '2019-03-15 09:37:03'),
(51, 11, 15, '2019-03-15 09:37:03'),
(52, 3, 1, '2019-03-15 09:37:03'),
(53, 3, 3, '2019-03-15 09:37:03'),
(54, 3, 4, '2019-03-15 09:37:03'),
(55, 3, 9, '2019-03-15 09:37:03'),
(56, 3, 10, '2019-03-15 09:37:03'),
(57, 3, 11, '2019-03-15 09:37:03'),
(58, 4, 2, '2019-03-15 09:37:03'),
(59, 12, 1, '2019-03-15 09:37:03'),
(60, 12, 3, '2019-03-15 09:37:03'),
(61, 12, 4, '2019-03-15 09:37:03'),
(62, 12, 9, '2019-03-15 09:37:03'),
(63, 12, 10, '2019-03-15 09:37:03'),
(64, 12, 11, '2019-03-15 09:37:03'),
(65, 13, 1, '2019-03-15 09:37:03'),
(66, 13, 3, '2019-03-15 09:37:03'),
(67, 13, 6, '2019-03-15 09:37:03'),
(68, 13, 7, '2019-03-15 09:37:03'),
(69, 13, 8, '2019-03-15 09:37:03'),
(70, 14, 1, '2019-03-15 09:37:03'),
(71, 14, 2, '2019-03-15 09:37:03'),
(72, 14, 3, '2019-03-15 09:37:03'),
(73, 14, 4, '2019-03-15 09:37:03'),
(74, 14, 5, '2019-03-15 09:37:03'),
(75, 14, 6, '2019-03-15 09:37:03'),
(76, 14, 7, '2019-03-15 09:37:03'),
(77, 14, 8, '2019-03-15 09:37:03'),
(78, 14, 9, '2019-03-15 09:37:03'),
(79, 14, 10, '2019-03-15 09:37:03'),
(80, 14, 11, '2019-03-15 09:37:03'),
(81, 14, 12, '2019-03-15 09:37:03'),
(82, 14, 13, '2019-03-15 09:37:03'),
(83, 14, 14, '2019-03-15 09:37:03'),
(84, 14, 15, '2019-03-15 09:37:03'),
(85, 15, 1, '2019-03-15 09:37:03'),
(86, 15, 3, '2019-03-15 09:37:03'),
(87, 15, 4, '2019-03-15 09:37:03'),
(88, 15, 9, '2019-03-15 09:37:03'),
(89, 15, 10, '2019-03-15 09:37:03'),
(90, 15, 11, '2019-03-15 09:37:03'),
(91, 16, 1, '2019-03-15 09:37:03'),
(92, 16, 2, '2019-03-15 09:37:03'),
(93, 16, 3, '2019-03-15 09:37:03'),
(94, 16, 4, '2019-03-15 09:37:03'),
(95, 16, 5, '2019-03-15 09:37:03'),
(96, 16, 6, '2019-03-15 09:37:03'),
(97, 16, 7, '2019-03-15 09:37:03'),
(98, 16, 8, '2019-03-15 09:37:03'),
(99, 16, 9, '2019-03-15 09:37:03'),
(100, 16, 10, '2019-03-15 09:37:03'),
(101, 16, 11, '2019-03-15 09:37:03'),
(102, 16, 12, '2019-03-15 09:37:03'),
(103, 16, 13, '2019-03-15 09:37:03'),
(104, 16, 14, '2019-03-15 09:37:03'),
(105, 16, 15, '2019-03-15 09:37:03'),
(106, 17, 1, '2019-03-15 09:37:03'),
(107, 17, 3, '2019-03-15 09:37:03'),
(108, 17, 4, '2019-03-15 09:37:03'),
(109, 17, 9, '2019-03-15 09:37:03'),
(110, 17, 10, '2019-03-15 09:37:03'),
(111, 17, 11, '2019-03-15 09:37:03'),
(112, 18, 1, '2019-03-15 09:37:03'),
(113, 18, 2, '2019-03-15 09:37:03'),
(114, 18, 3, '2019-03-15 09:37:03'),
(115, 18, 4, '2019-03-15 09:37:03'),
(116, 18, 5, '2019-03-15 09:37:03'),
(117, 18, 6, '2019-03-15 09:37:03'),
(118, 18, 7, '2019-03-15 09:37:03'),
(119, 18, 8, '2019-03-15 09:37:03'),
(120, 18, 9, '2019-03-15 09:37:03'),
(121, 18, 10, '2019-03-15 09:37:03'),
(122, 18, 11, '2019-03-15 09:37:03'),
(123, 18, 12, '2019-03-15 09:37:03'),
(124, 18, 13, '2019-03-15 09:37:03'),
(125, 18, 14, '2019-03-15 09:37:03'),
(126, 18, 15, '2019-03-15 09:37:03'),
(127, 19, 1, '2019-03-15 09:37:03'),
(128, 19, 3, '2019-03-15 09:37:03'),
(129, 19, 4, '2019-03-15 09:37:03'),
(130, 19, 9, '2019-03-15 09:37:03'),
(131, 19, 10, '2019-03-15 09:37:03'),
(132, 19, 11, '2019-03-15 09:37:03'),
(133, 20, 1, '2019-03-15 09:37:03'),
(134, 20, 2, '2019-03-15 09:37:03'),
(135, 20, 3, '2019-03-15 09:37:03'),
(136, 20, 4, '2019-03-15 09:37:03'),
(137, 20, 5, '2019-03-15 09:37:03'),
(138, 20, 6, '2019-03-15 09:37:03'),
(139, 20, 7, '2019-03-15 09:37:03'),
(140, 20, 8, '2019-03-15 09:37:03'),
(141, 20, 9, '2019-03-15 09:37:03'),
(142, 20, 10, '2019-03-15 09:37:03'),
(143, 20, 11, '2019-03-15 09:37:03'),
(144, 20, 12, '2019-03-15 09:37:03'),
(145, 20, 13, '2019-03-15 09:37:03'),
(146, 20, 14, '2019-03-15 09:37:03'),
(147, 20, 15, '2019-03-15 09:37:03'),
(148, 21, 1, '2019-03-15 09:37:03'),
(149, 21, 3, '2019-03-15 09:37:03'),
(150, 21, 4, '2019-03-15 09:37:03'),
(151, 21, 9, '2019-03-15 09:37:03'),
(152, 21, 10, '2019-03-15 09:37:03'),
(153, 21, 11, '2019-03-15 09:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `flavour_id` int(10) UNSIGNED NOT NULL,
  `sub_flavour_id` int(10) UNSIGNED DEFAULT NULL,
  `filling_id` int(10) UNSIGNED NOT NULL,
  `tier_id` int(10) UNSIGNED NOT NULL,
  `multiple_tier_id` int(10) UNSIGNED DEFAULT NULL,
  `size_id` int(10) UNSIGNED NOT NULL,
  `shape_id` int(10) UNSIGNED NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `delivery_date` date NOT NULL,
  `method` varchar(20) NOT NULL,
  `venue_address` varchar(300) DEFAULT NULL,
  `add_details_on_cake` tinyint(1) NOT NULL,
  `cake_name` varchar(100) DEFAULT NULL,
  `cake_age` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `flavour_id`, `sub_flavour_id`, `filling_id`, `tier_id`, `multiple_tier_id`, `size_id`, `shape_id`, `f_name`, `l_name`, `email`, `phone`, `delivery_date`, `method`, `venue_address`, `add_details_on_cake`, `cake_name`, `cake_age`, `created_at`) VALUES
(6, 1, 4, 0, 2, 1, NULL, 2, 2, 'Shafna', 'Mikdar', 'johndoe@gmail.com', '8888888888', '2019-04-10', 'deliver', '102 West Main St', 1, 'Shafna Mikdar', '15', '2019-04-04 12:17:48'),
(7, 3, 1, 7, 7, 1, NULL, 6, 2, 'Shafna', 'Mikdar', 'johndoe@gmail.com', '8888888888', '2019-04-10', 'deliver', '1st cross street', 1, 'Shafna', '45', '2019-04-04 12:17:46'),
(8, 3, 5, 13, 7, 1, NULL, 6, 2, 'Shafna', 'Mikdar', 'johndoe@gmail.com', '8888888888', '2019-04-20', 'deliver', '1st cross street', 1, 'Shafna', '28', '2019-04-04 12:16:04'),
(9, 4, 1, 10, 4, 2, NULL, 10, 1, 'Raveen', 'Weerasinghe', 'johndoe@gmail.com', '114062220', '2019-04-25', 'pick-up', NULL, 0, NULL, NULL, '2019-04-04 12:21:00'),
(10, 4, 4, NULL, 2, 2, 4, 12, 1, 'Raveen', 'Weerasinghe', 'johndoe@gmail.com', '114062220', '2019-04-26', 'pick-up', NULL, 1, 'Shashimal', '4', '2019-04-04 12:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `design_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `design_id`, `name`, `created_at`) VALUES
(1, 8, 'Emma Wiggles Cake', '2019-03-17 09:04:50'),
(2, 8, 'Hatchimals Cake', '2019-03-17 09:04:56'),
(3, 9, 'Paw Patrol Cake', '2019-03-17 09:05:00'),
(4, 9, 'Gekko Cake', '2019-03-17 09:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`) VALUES
(1, 1, '1.jpg', '2019-03-17 02:52:23'),
(2, 1, '2.jpg', '2019-03-17 02:52:24'),
(3, 1, '3.jpg', '2019-03-17 02:52:25'),
(4, 1, '4.jpg', '2019-03-17 02:52:26'),
(5, 2, '5.jpg', '2019-03-17 02:52:28'),
(6, 2, '6.jpg', '2019-03-17 02:52:29'),
(7, 2, '7.jpg', '2019-03-17 02:52:32'),
(8, 2, '8.jpg', '2019-03-17 02:52:34'),
(9, 3, '9.jpg', '2019-03-17 02:52:31'),
(10, 3, '10.jpg', '2019-03-17 02:52:38'),
(11, 3, '11.jpg', '2019-03-17 02:52:40'),
(12, 3, '12.jpg', '2019-03-17 02:52:45'),
(13, 4, '13.jpg', '2019-03-17 07:03:53'),
(14, 4, '14.jpg', '2019-03-17 07:03:56'),
(15, 4, '15.jpg', '2019-03-17 07:03:58'),
(16, 4, '16.jpg', '2019-03-17 07:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `servings`
--

CREATE TABLE `servings` (
  `id` int(10) UNSIGNED NOT NULL,
  `tier_id` int(10) UNSIGNED NOT NULL,
  `shape_id` int(10) UNSIGNED NOT NULL,
  `size_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servings`
--

INSERT INTO `servings` (`id`, `tier_id`, `shape_id`, `size_id`, `name`, `created_at`) VALUES
(1, 1, 1, 1, '8', '2019-03-15 10:31:16'),
(2, 1, 1, 2, '11', '2019-03-15 10:31:16'),
(3, 1, 1, 3, '15', '2019-03-15 10:31:16'),
(4, 1, 1, 4, '20', '2019-03-15 10:31:16'),
(5, 1, 1, 5, '27', '2019-03-15 10:31:16'),
(6, 1, 1, 6, '38', '2019-03-15 10:31:16'),
(7, 1, 1, 7, '45', '2019-03-15 10:31:16'),
(8, 1, 1, 8, '56', '2019-03-15 10:31:16'),
(9, 1, 1, 9, '64', '2019-03-15 10:31:16'),
(10, 1, 2, 1, '8', '2019-03-15 10:31:16'),
(11, 1, 2, 2, '18', '2019-03-15 10:31:16'),
(12, 1, 2, 3, '24', '2019-03-15 10:31:16'),
(13, 1, 2, 4, '32', '2019-03-15 10:31:16'),
(14, 1, 2, 5, '35', '2019-03-15 10:31:16'),
(15, 1, 2, 6, '50', '2019-03-15 10:31:16'),
(16, 1, 2, 7, '56', '2019-03-15 10:31:16'),
(17, 1, 2, 8, '72', '2019-03-15 10:31:16'),
(18, 1, 2, 9, '98', '2019-03-15 10:31:16'),
(19, 1, 3, 1, '6', '2019-03-15 10:31:16'),
(20, 1, 3, 2, '12', '2019-03-15 10:31:16'),
(21, 1, 3, 3, '16', '2019-03-15 10:31:16'),
(22, 1, 3, 4, '24', '2019-03-15 10:31:16'),
(23, 1, 3, 5, '28', '2019-03-15 10:31:16'),
(24, 1, 3, 6, '30', '2019-03-15 10:31:16'),
(25, 1, 3, 7, '35', '2019-03-15 10:31:16'),
(26, 1, 3, 8, '40', '2019-03-15 10:31:16'),
(27, 1, 3, 9, '45', '2019-03-15 10:31:16'),
(28, 3, 1, 10, '49', '2019-03-26 07:18:51'),
(29, 3, 1, 11, '76', '2019-03-26 07:20:31'),
(30, 4, 1, 12, '69', '2019-03-26 07:20:54'),
(31, 4, 1, 13, '94', '2019-03-26 07:26:05'),
(32, 4, 1, 14, '114', '2019-03-26 07:26:34'),
(33, 5, 1, 15, '125', '2019-03-26 07:27:15'),
(34, 5, 1, 16, '169', '2019-03-26 07:27:33'),
(35, 6, 1, 17, '189', '2019-03-26 07:27:43'),
(36, 3, 2, 10, '68', '2019-03-26 07:18:38'),
(37, 3, 2, 11, '104', '2019-03-26 07:20:34'),
(38, 4, 2, 12, '100', '2019-03-26 07:20:56'),
(39, 4, 2, 13, '125', '2019-03-26 07:26:02'),
(40, 4, 2, 14, '154', '2019-03-26 07:26:32'),
(41, 5, 2, 15, '172', '2019-03-26 07:27:14'),
(42, 5, 2, 16, '308', '2019-03-26 07:27:34'),
(43, 6, 2, 17, '326', '2019-03-26 07:27:44'),
(44, 3, 3, 10, '42', '2019-03-26 07:18:47'),
(45, 3, 3, 11, '64', '2019-03-26 07:20:29'),
(46, 4, 3, 12, '90', '2019-03-26 07:20:58'),
(47, 4, 3, 14, '120', '2019-03-26 07:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `shapes`
--

CREATE TABLE `shapes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shapes`
--

INSERT INTO `shapes` (`id`, `name`, `slug`, `image`, `created_at`) VALUES
(1, 'Round', 'round', 'round.jpg', '2019-03-25 12:09:48'),
(2, 'Square', 'square', 'square.jpg', '2019-03-25 12:09:53'),
(3, 'Heart', 'heart', 'heart.jpg', '2019-03-25 12:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `tier_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `tier_id`, `name`, `created_at`) VALUES
(1, 1, '5', '2019-03-25 09:37:09'),
(2, 1, '6', '2019-03-25 09:37:12'),
(3, 1, '7', '2019-03-25 09:37:14'),
(4, 1, '8', '2019-03-25 09:37:16'),
(5, 1, '9', '2019-03-25 09:37:18'),
(6, 1, '10', '2019-03-25 09:37:20'),
(7, 1, '11', '2019-03-25 09:37:22'),
(8, 1, '12', '2019-03-25 09:37:24'),
(9, 1, '14', '2019-03-25 09:37:26'),
(10, 3, '6,10', '2019-03-25 09:37:44'),
(11, 3, '8,12', '2019-03-25 09:37:46'),
(12, 4, '6,8,10', '2019-03-25 09:37:50'),
(13, 4, '6,9,12', '2019-03-25 09:37:57'),
(14, 4, '8,10,12', '2019-03-25 09:38:00'),
(15, 5, '6,8,10,12', '2019-03-25 09:38:02'),
(16, 5, '8,10,12,14', '2019-03-25 09:38:06'),
(17, 6, '6,8,10,12,14', '2019-03-25 09:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `tiers`
--

CREATE TABLE `tiers` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiers`
--

INSERT INTO `tiers` (`id`, `parent_id`, `name`, `slug`, `image`, `created_at`) VALUES
(1, NULL, 'Single', 'single', 'single-tier.jpg', '2019-03-25 06:41:58'),
(2, NULL, 'Multiple', 'multiple', 'multiple-tier.jpg', '2019-03-25 06:41:54'),
(3, 2, 'Two', 'two', 'two.jpg', '2019-03-25 09:40:25'),
(4, 2, 'Three', 'three', 'three.jpg', '2019-03-25 09:40:25'),
(5, 2, 'Four', 'four', 'four.jpg', '2019-03-25 09:40:25'),
(6, 2, 'Five', 'five', 'five.jpg', '2019-03-25 09:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin@dct.com', '$2y$10$SeY2Jq2YEnqKgLkWHGo3iOmiQ7LHSAOGRKjnJz9AKxQqRu5GOjtTW', '2018-10-15 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `designs`
--
ALTER TABLE `designs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fillings`
--
ALTER TABLE `fillings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flavours`
--
ALTER TABLE `flavours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flavour_filling`
--
ALTER TABLE `flavour_filling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servings`
--
ALTER TABLE `servings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shapes`
--
ALTER TABLE `shapes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiers`
--
ALTER TABLE `tiers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `designs`
--
ALTER TABLE `designs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `fillings`
--
ALTER TABLE `fillings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `flavours`
--
ALTER TABLE `flavours`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `flavour_filling`
--
ALTER TABLE `flavour_filling`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `servings`
--
ALTER TABLE `servings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `shapes`
--
ALTER TABLE `shapes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tiers`
--
ALTER TABLE `tiers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

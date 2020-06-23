-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2020 at 12:17 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodgasm`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(5) NOT NULL,
  `restaurant_id` int(5) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `image` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `restaurant_id`, `item_name`, `price`, `type`, `image`) VALUES
(3, 7, 'Pasta', 30, 1, NULL),
(4, 7, 'Chicken Pasta', 50, 2, NULL),
(5, 7, 'Noodles', 70, 2, NULL),
(6, 7, 'Fried Noodles', 60, 1, NULL),
(7, 5, 'Chole Bhature', 100, 1, NULL),
(8, 5, 'Pizza', 100, 1, NULL),
(9, 5, 'Burger', 100, 1, NULL),
(10, 5, 'Cheese Burger', 150, 1, NULL),
(11, 6, 'Tandoori', 200, 2, NULL),
(12, 6, 'Moghlai', 150, 2, NULL),
(13, 6, 'Chicken Chilly', 180, 2, NULL),
(14, 6, 'Omelette ', 100, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(5) NOT NULL,
  `orders` longtext NOT NULL,
  `ordered_on` datetime NOT NULL,
  `restaurant_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `total` int(11) NOT NULL,
  `in_cart` int(1) NOT NULL,
  `order_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `orders`, `ordered_on`, `restaurant_id`, `user_id`, `total`, `in_cart`, `order_status`) VALUES
(4, '[{\"name\":\"Pasta\",\"price\":\"30\",\"qty\":\"2\",\"type\":\"Veg\"},{\"name\":\"Fried Noodles\",\"price\":\"60\",\"qty\":\"4\",\"type\":\"Veg\"}]', '2020-06-22 19:02:47', 7, 22, 300, 0, 1),
(5, '[{\"name\":\"Chole Bhature\",\"price\":\"100\",\"qty\":\"3\",\"type\":\"Veg\"},{\"name\":\"Pizza\",\"price\":\"100\",\"qty\":\"4\",\"type\":\"Veg\"}]', '2020-06-22 22:08:51', 5, 22, 700, 0, 2),
(10, '[{\"name\":\"Tandoori\",\"price\":\"200\",\"qty\":\"3\",\"type\":\"Non-Veg\"},{\"name\":\"Moghlai\",\"price\":\"150\",\"qty\":\"2\",\"type\":\"Non-Veg\"}]', '2020-06-22 23:26:50', 6, 17, 900, 0, 1),
(11, '[{\"name\":\"Pizza\",\"price\":\"100\",\"qty\":\"1\",\"type\":\"Veg\"}]', '2020-06-23 00:07:35', 5, 22, 100, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(5) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `food_type_id` int(1) NOT NULL,
  `city` varchar(50) NOT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `email`, `contact`, `password`, `food_type_id`, `city`, `image`) VALUES
(5, 'rest', 'new@rest3.com', 12341234, 'ed2b1f468c5f915f3f1cf75d7068baae', 1, 'Pune', NULL),
(6, 'rest2', 'new@rest2.com', 12341234, 'ed2b1f468c5f915f3f1cf75d7068baae', 2, 'Pune', NULL),
(7, 'last rest', 'last@rest.com', 12341234, 'ed2b1f468c5f915f3f1cf75d7068baae', 3, 'rjdkt', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(151) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `food_type_id` int(1) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `image` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact`, `password`, `food_type_id`, `city`, `image`) VALUES
(2, 'Madhav', 'madhavtrivedi.77@gmail.com', 123456, 'e10adc3949ba59ab', 1, 'Pune', NULL),
(3, '', '', 0, 'd41d8cd98f00b204', 1, '', NULL),
(4, '', 'madhavtrivedi.77@gmail.co', 1234, 'ed2b1f468c5f915f', 1, 'Pune', NULL),
(5, 'Madhav Trivedi', 'madhavtrivedi.77@gmail.co', 1234, 'ed2b1f468c5f915f', 1, 'Pune', NULL),
(6, 'Madhav Trivedi', 'testing@cust.com', 12341234, 'ed2b1f468c5f915f', 1, 'Pune', NULL),
(7, 'Madhav Trivedi', 'testing@cust.com', 12341234, 'ed2b1f468c5f915f', 1, 'Pune', NULL),
(8, 'Madhav Trivedi', 'testing@cust.com', 12341234, 'ed2b1f468c5f915f', 1, 'Pune', NULL),
(9, 'New Rest', 'new@rest.com', 12341234, 'ed2b1f468c5f915f', 1, 'Rajkot', NULL),
(10, 'New Rest', 'new@rest.com', 12341234, 'ed2b1f468c5f915f', 1, 'Rajkot', NULL),
(11, 'New Rest', 'new@rest.com', 12341234, 'ed2b1f468c5f915f', 1, 'Rajkot', NULL),
(12, 'New Rest', 'new@rest.com', 12341234, 'ed2b1f468c5f915f', 1, 'Rajkot', NULL),
(13, 'New Rest', 'new@rest.com', 12341234, 'ed2b1f468c5f915f', 1, 'Rajkot', NULL),
(14, 'New Rest', 'new@rest.com', 12341234, 'ed2b1f468c5f915f', 1, 'Rajkot', NULL),
(15, 'New Rest', 'new@rest.com', 12341234, 'ed2b1f468c5f915f', 1, 'Rajkot', NULL),
(16, '', '', 0, 'd41d8cd98f00b204', 0, '', NULL),
(17, 'ajaxtest', 'ajaxtest@aj.com', 12341234, 'ed2b1f468c5f915f3f1cf75d7068baae', 2, 'Pune', NULL),
(18, 'ajaxtest', 'ajaxtest@aj.com', 12341234, 'ed2b1f468c5f915f', 2, 'Pune', NULL),
(19, 'ajaxtest', 'ajaxtest@aj.com', 12341234, 'ed2b1f468c5f915f', 2, 'Pune', NULL),
(20, 'ajaxtest', 'ajaxtest@aj.com', 12341234, 'ed2b1f468c5f915f', 2, 'Pune', NULL),
(21, 'Madhav Trivedi', 'madhavtrivedi.77@gmail.comm', 12341234, 'ed2b1f468c5f915f', 1, 'Pune', NULL),
(22, 'Madhav Trivedi', 'madhavtrivedi.77@gmail.commm', 12341234, 'ed2b1f468c5f915f3f1cf75d7068baae', 1, 'Pune', NULL),
(23, 'md5check', 'md5@check.com', 12341234, 'ed2b1f468c5f915f3f1cf75d7068baae', 1, 'mad', NULL),
(24, 'Restaurant 1', 'rest@1.com', 12341234, 'ed2b1f468c5f915f3f1cf75d7068baae', 1, 'rjkt', NULL),
(25, 'rest1', 'rest@2.com', 12341234, 'ed2b1f468c5f915f3f1cf75d7068baae', 1, '12341234', NULL),
(26, 'rest1', 'rest@2.com', 12341234, 'ed2b1f468c5f915f3f1cf75d7068baae', NULL, '12341234', NULL),
(27, 'rest2', 'rest2@m.com', 12341234, 'ed2b1f468c5f915f3f1cf75d7068baae', NULL, 'rhjt', NULL),
(28, 'rest2', 'rest2@mm.com', 12341234, 'ed2b1f468c5f915f3f1cf75d7068baae', NULL, 'rjkt', NULL),
(29, 'rest2', 'rest2@mm.com', 12341234, 'ed2b1f468c5f915f3f1cf75d7068baae', NULL, 'rjkt', NULL),
(30, 'rest2', 'rest2@mm.com', 12341234, 'ed2b1f468c5f915f3f1cf75d7068baae', NULL, 'rjkt', NULL),
(31, 'last cust', 'last@cust.com', 12341234, 'ed2b1f468c5f915f3f1cf75d7068baae', 2, 'sjdlf;aj', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

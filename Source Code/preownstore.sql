-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 10, 2018 at 05:44 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `preownstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `addr` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `fname`, `mname`, `lname`, `email`, `phone`, `addr`, `city`, `state`, `zip`, `time`) VALUES
(1, 'preownseller', 'd7d8d92d0972ad764c72a6a7953bb31d', '', '', '', '', '', '', '', '', '', '2018-12-10 02:20:54'),
(2, 'preownbuyer', 'fef97dbbb536cc760eab5afa11ed6610', 'preown', '', 'buyer', 'pre@own.buyer', '0000000000', 'somewhere', 'earth', 'MA', '01853', '2018-12-10 02:52:10'),
(3, 'alex', 'e10adc3949ba59abbe56e057f20f883e', 'alex', '', 'alex', 'aelx@alex.com', '1111111111', 'University Ave', 'Lowell', 'MA', '01854', '2018-12-10 02:52:33'),
(4, 'david', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '', '', '', '', '', '2018-12-10 02:52:55');

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE `buy` (
  `id` int(11) NOT NULL,
  `orderid` varchar(17) NOT NULL,
  `itemid` int(11) NOT NULL,
  `item` varchar(100) NOT NULL,
  `buyer` varchar(20) NOT NULL,
  `seller` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `final_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`id`, `orderid`, `itemid`, `item`, `buyer`, `seller`, `price`, `status`, `order_time`, `final_time`) VALUES
(1, '20181210051702279', 1, 'Men Polo Ralph Lauren Half Zip Sweater All Sizes Assorted  Navy-Red', 'preownbuyer', 'preownseller', 45, 4, '2018-12-10 05:17:02', '2018-12-10 05:33:01'),
(2, '20181210052256210', 9, 'Connoisseur corkscrew', 'alex', 'preownbuyer', 15, 4, '2018-12-10 05:22:56', '2018-12-10 05:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `sender` varchar(20) NOT NULL,
  `receiver` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `sender`, `receiver`, `content`, `time`) VALUES
(1, 'preownbuyer', 'preownseller', 'Hello, I would like to buy <b><a href=\'detail.php?id=2\'>this product</a></b> in $45', '2018-12-10 04:50:09'),
(2, 'preownseller', 'preownbuyer', 'Ok, I\'ll get it', '2018-12-10 05:06:37'),
(3, 'preownseller', 'alex', '<b><a href=\'detail.php?id=7\'>RE: Pots</a></b>\nHi,\nHow big are the pots?', '2018-12-10 05:11:00'),
(4, 'preownbuyer', 'preownseller', '<b><a href=\'detail.php?id=2\'>RE: Men Polo Ralph Lauren Half Zip Sweater All Sizes Assorted Burgundy</a></b>\ntest', '2018-12-10 05:11:50'),
(5, 'preownseller', 'david', '<b><a href=\'detail.php?id=6\'>RE: Apple MacBook Air</a></b>\nhi', '2018-12-10 05:12:59'),
(6, 'alex', 'david', 'Hello, I would like to buy <b><a href=\'detail.php?id=6\'>this product</a></b> in $450', '2018-12-10 05:13:43'),
(7, 'david', 'preownseller', 'Hello, I would like to buy <b><a href=\'detail.php?id=1\'>this product</a></b> in $43', '2018-12-10 05:14:56'),
(8, 'preownbuyer', 'preownseller', 'Hello, I have placed an order(#<b>20181210051702279</b>), please confirm it for me, thanks.', '2018-12-10 05:17:02'),
(9, 'alex', 'preownbuyer', 'Hello, I have placed an order(#<b>20181210052256210</b>), please confirm it for me, thanks.', '2018-12-10 05:22:56'),
(10, 'preownbuyer', 'david', 'Hello, I would like to buy <b><a href=\'detail.php?id=6\'>this product</a></b> in $480', '2018-12-10 05:33:58'),
(11, 'david', 'preownbuyer', 'Ok', '2018-12-10 05:34:39');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `item_condition` varchar(30) NOT NULL,
  `seller` varchar(16) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(2) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `issold` int(1) NOT NULL,
  `buyer` varchar(16) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `item_condition`, `seller`, `city`, `state`, `pic`, `issold`, `buyer`, `time`) VALUES
(1, 'Men Polo Ralph Lauren Half Zip Sweater All Sizes Assorted  Navy-Red', 'All items are guaranteed to be authentic, we buy everything in person at local Ralph Lauren Stores.\n\nMen Polo Ralph Lauren Half Zip Long Sleeve Sweater.\n\nColors:\n-Alpine\n-Red\n-Andover Grey (Grey Htr.)\n-Cream (Faded Cream)\n-Gray (Winter Grey)\n-Blue (Blue Heather)\n-Burgundy (Classic Wine)\n-Black\n-Brown (Brown Heather)\n-Royal Blue (Fall Royal)\nSizes: S, M, L, XL, XXL\n100% Cotton, long sleeve sweater, 1/2 zip closure, logo embroidery at left chest, split even hem. Standard Fit.\n\n             Pit-pit                 \nS      20.5\"(52 cm)       \nM     22.5\"(57 cm)      \nL       24\"(60.5 cm)    \nXL    25.5\"(64.5 cm)    \nXXL  27\"(68.5 cm)    \n             Length\nS         27\"(68.5cm)\nM       27.5\"(69.5cm)\nL        28\"(71cm)\nXL     28.5\"(72.5cm)\nXXL  29\"(73.5cm)\n\nPlease note: I took the measurements with the sweaters laying flat on the table, so this is an approximate, thanks.\n\n\n                                         PAYMENT\n\nWe accept payment by PayPal only, thanks.\n\n                                          SHIPPING\n\nItem will be shipped to your PayPal address within 1 business day of cleared payment (except weekends and holidays)\n \nUS buyers: Please allow 2-5 business days to receive your item.\n\nInternational buyers: Delivery time varies depending on your location.\n\nPlease note: Import duties, taxes and charges are not included in the item price or shipping cost. These charges are the buyer\'s responsibility.', 45.99, 'Brand New', 'preownseller', 'westford', 'MA', '20181210022659474.jpg', 1, 'preownbuyer', '2018-12-10 02:27:05'),
(2, 'Men Polo Ralph Lauren Half Zip Sweater All Sizes Assorted Burgundy', 'All items are guaranteed to be authentic, we buy everything in person at local Ralph Lauren Stores.\n\nMen Polo Ralph Lauren Half Zip Long Sleeve Sweater.\n\nColors:\n-Alpine\n-Red\n-Andover Grey (Grey Htr.)\n-Cream (Faded Cream)\n-Gray (Winter Grey)\n-Blue (Blue Heather)\n-Burgundy (Classic Wine)\n-Black\n-Brown (Brown Heather)\n-Royal Blue (Fall Royal)\nSizes: S, M, L, XL, XXL\n100% Cotton, long sleeve sweater, 1/2 zip closure, logo embroidery at left chest, split even hem. Standard Fit.\n\n             Pit-pit                 \nS      20.5\"(52 cm)       \nM     22.5\"(57 cm)      \nL       24\"(60.5 cm)    \nXL    25.5\"(64.5 cm)    \nXXL  27\"(68.5 cm)    \n             Length\nS         27\"(68.5cm)\nM       27.5\"(69.5cm)\nL        28\"(71cm)\nXL     28.5\"(72.5cm)\nXXL  29\"(73.5cm)\n\nPlease note: I took the measurements with the sweaters laying flat on the table, so this is an approximate, thanks.\n\n\n                                         PAYMENT\n\nWe accept payment by PayPal only, thanks.\n\n                                          SHIPPING\n\nItem will be shipped to your PayPal address within 1 business day of cleared payment (except weekends and holidays)\n \nUS buyers: Please allow 2-5 business days to receive your item.\n\nInternational buyers: Delivery time varies depending on your location.\n\nPlease note: Import duties, taxes and charges are not included in the item price or shipping cost. These charges are the buyer\'s responsibility.', 46, 'Brand New', 'preownseller', 'Lowell', 'MA', '20181210022859301.jpg', 0, 'N/A', '2018-12-10 02:29:01'),
(3, 'Men Polo Ralph Lauren Half Zip Sweater All Sizes Assorted Red', 'All items are guaranteed to be authentic, we buy everything in person at local Ralph Lauren Stores.\n\nMen Polo Ralph Lauren Half Zip Long Sleeve Sweater.\n\nColors:\n-Alpine\n-Red\n-Andover Grey (Grey Htr.)\n-Cream (Faded Cream)\n-Gray (Winter Grey)\n-Blue (Blue Heather)\n-Burgundy (Classic Wine)\n-Black\n-Brown (Brown Heather)\n-Royal Blue (Fall Royal)\nSizes: S, M, L, XL, XXL\n100% Cotton, long sleeve sweater, 1/2 zip closure, logo embroidery at left chest, split even hem. Standard Fit.\n\n             Pit-pit                 \nS      20.5\"(52 cm)       \nM     22.5\"(57 cm)      \nL       24\"(60.5 cm)    \nXL    25.5\"(64.5 cm)    \nXXL  27\"(68.5 cm)    \n             Length\nS         27\"(68.5cm)\nM       27.5\"(69.5cm)\nL        28\"(71cm)\nXL     28.5\"(72.5cm)\nXXL  29\"(73.5cm)\n\nPlease note: I took the measurements with the sweaters laying flat on the table, so this is an approximate, thanks.\n\n\n                                         PAYMENT\n\nWe accept payment by PayPal only, thanks.\n\n                                          SHIPPING\n\nItem will be shipped to your PayPal address within 1 business day of cleared payment (except weekends and holidays)\n \nUS buyers: Please allow 2-5 business days to receive your item.\n\nInternational buyers: Delivery time varies depending on your location.\n\nPlease note: Import duties, taxes and charges are not included in the item price or shipping cost. These charges are the buyer\'s responsibility.', 47, 'Brand New', 'preownseller', 'Lowell', 'MA', '20181210023007264.jpg', 0, 'N/A', '2018-12-10 02:30:09'),
(4, 'BNW Acoustics 5.1 home theater system RS-9', 'New (never used)\nSurround sound home theater ', 1300, 'Refurbished', 'preownseller', 'Medford', 'MA', '20181210023505717.jpg', 0, 'N/A', '2018-12-10 02:35:07'),
(5, 'Apple iPad Pro 12.9-Inch 64GB Space Gray (WiFi Only, Mid 2017) MQDA2LL/A', 'Powering the large Retina display is the Apple A10X Six-Core chip with a M10 motion coprocessor. This 64-bit chip can pump out desktop-class CPU performance and console-class graphics. The faster performance allows you to multitask with ease, using iOS 10 features, such as Picture in Picture, Slide Over, and Split View. Also, the iPad Pro is capable of editing 4K video, rendering 3D models/images, creating/editing complex documents and presentations, and playing games.\n\nFeatures & details\n\n12.9-Inch Retina Display, 2732 x 2048 Resolution, True Tone Display\n\n64GB Flash Storage, 4GB RAM, 2.39GHz A10X Processor + M10 Coprocessor\n\n802.11ac Wi-Fi, Rear 12MP iSight Camera; Front 7MP FaceTime HD Camera\n\nTouch ID Fingerprint Sensor, Fingerprint-Resistant Oleophobic Coating\n\nUp to 10 Hours of Battery Life, Apple iOS 10\n\nNo charger ', 450, 'Used', 'david', 'Lancaster', 'CA', '20181210025521289.jpg', 0, 'N/A', '2018-12-10 02:55:23'),
(6, 'Apple MacBook Air', 'MacBook Air 11” Core i5\nMacBook Features, i5 Processor 11\", 1366x768 Display, 1.4 GHz, 4GB Ram, 128GB HD, Bluetooth, WiFi, OS X Mountain Lion or higher (Runs up to OS X 12.1 \"Yosemite\")', 500, 'Used', 'david', 'Franklinton', 'NC', '20181210025710697.jpg', 0, 'N/A', '2018-12-10 02:57:13'),
(7, 'Pots', 'Ceramic pots , barely used, $7.00 a piece \nNo nicks good condition ', 7, 'Used', 'alex', 'Shaker Heights', 'OH', '20181210025856989.jpg', 0, 'N/A', '2018-12-10 02:58:58'),
(8, '$140....14mm... 14 karat gold plated Cuban link chain and bracelet...will not fade or tarnish', 'Made from stainless steel', 140, 'Brand New', 'alex', 'Fort Lauderdale', 'FL', '20181210030033655.jpg', 0, 'N/A', '2018-12-10 03:00:35'),
(9, 'Connoisseur corkscrew', 'Connoisseur corkscrew new still in the box! ', 15, 'Brand New', 'preownbuyer', 'Rialto', 'CA', '20181210044435871.jpg', 1, 'alex', '2018-12-10 04:44:36'),
(10, 'Brand New Mitchell & Ness Hat', 'Fresh Hat (SnapBack) \nHard to find \nLegit', 32, 'Brand New', 'david', 'Long Beach', 'CA', '20181210053654339.jpg', 0, 'N/A', '2018-12-10 05:37:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `buy`
--
ALTER TABLE `buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

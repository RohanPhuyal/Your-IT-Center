-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 06:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `youritcenter`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `full_name`, `email`, `password`) VALUES
(1, 'Rohan Phuyal', 'rohanphuyal2@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`, `date_added`, `status`) VALUES
(1, 4, 3, 1, '2024-02-21 07:54:56', NULL),
(2, 5, 3, 1, '2024-02-23 15:24:50', NULL),
(3, 1, 3, 1, '2024-03-31 10:05:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `user_id`, `name`, `email`, `phone`, `address`, `shipping_address`) VALUES
(1, 1, 'Tulasha Karki', 'tulashakarki@gmail.com', '9812342818', 'Tarahara,Sunsari,Koshi1', 'Tarahara,Sunsari,Koshi1'),
(2, 2, 'Rohan Phuyal', 'rohanphuyal2@gmail.com', '9869598830', 'Tarakeshwor-02,Kathmandu,Bagmati', 'Tarakeshwor-02,Kathmandu,Bagmati'),
(3, 3, 'Mashhood Khan', 'mashhood@gmail.com', '9812345678', 'Test , kTM,Kathmandu,Bagmati', 'Test , kTM,Kathmandu,Bagmati'),
(4, 4, 'Rojal Manandar', 'rojal@gmail.com', NULL, NULL, NULL),
(5, 5, 'Test Name', 'test@gmail.com', '9800000003', 'Tarakeshwor-02, Kathmandu,Kathmandu,Bagmati', 'Tarakeshwor-02, Kathmandu,Kathmandu,Bagmati');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL,
  `order_status` varchar(250) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `time_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `quantity`, `name`, `customer_id`, `customer_email`, `price`, `payment_status`, `payment_method`, `order_status`, `transaction_id`, `time_created`) VALUES
(7, '1', '1', 'Razer Viper Mini', 1, 'tulashakarki@gmail.com', 800.00, 'Completed', 'COD', 'Delivered', 'cod65e027d236929', '2024-02-29 12:29:34'),
(8, '3', '2', 'Razer Kraken X', 1, 'tulashakarki@gmail.com', 1700.00, 'Completed', 'COD', 'Delivered', 'cod65e027d8a9d94', '2024-02-29 12:29:40'),
(9, '5,6', '1,1', 'Redragon Kumura K552,Razer Hybrid Mouse Mat', 1, 'tulashakarki@gmail.com', 1450.00, 'Completed', 'COD', 'Delivered', 'cod65e027deb7e6f', '2024-02-29 12:29:46'),
(10, '2', '1', 'XPG Lancer RGB DDR5 RAM', 1, 'tulashakarki@gmail.com', 900.00, 'Cash on Delivery', 'COD', 'Processing Order', 'cod65e039389b16b', '2024-02-29 13:43:48'),
(11, '7', '1', 'iCUE Cooler', 1, 'tulashakarki@gmail.com', 900.00, 'Completed', 'Khalti', 'Processing Order', 'eenjLs7y3JkGeMCrGYSKyF', '2024-02-29 13:45:01'),
(12, '5,1', '1,1', 'Redragon Kumura K552,Razer Viper Mini', 1, 'tulashakarki@gmail.com', 1500.00, 'Cash on Delivery', 'COD', 'Processing Order', 'cod65e192c62de37', '2024-03-01 14:18:10'),
(13, '1', '1', 'Razer Viper Mini', 1, 'tulashakarki@gmail.com', 800.00, 'Cash on Delivery', 'COD', 'Processing Order', 'cod65e192d3da17f', '2024-03-01 14:18:23'),
(14, '1', '1', 'Razer Viper Mini', 3, 'mashhood@gmail.com', 800.00, 'Completed', 'Khalti', 'Delivered', 'EmLALKZZYKMw79canVMkCe', '2024-03-18 17:07:17'),
(15, '3', '1', 'Razer Kraken X', 3, 'mashhood@gmail.com', 850.00, 'Completed', 'Khalti', 'Processing Order', 'QphVXy5ZcnK9Wy3MWxhaZA', '2024-04-03 16:19:20');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `sub_category` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image_path` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `category`, `sub_category`, `description`, `price`, `stock`, `image_path`) VALUES
(1, 'Razer Viper Mini', 'Peripherals', 'Mouse', '<p>Best Budget Gaming Mouse for gamers.</p>\r\n<table style=\"border-collapse: collapse; width: 100%; height: 89.5832px;\" border=\"1\"><colgroup><col style=\"width: 50.1166%;\"><col style=\"width: 50.1166%;\"></colgroup>\r\n<tbody>\r\n<tr style=\"height: 22.3958px;\">\r\n<td style=\"height: 22.3958px;\"><strong>Sensor</strong></td>\r\n<td style=\"height: 22.3958px;\">Optical</td>\r\n</tr>\r\n<tr style=\"height: 22.3958px;\">\r\n<td style=\"height: 22.3958px;\"><strong>DPI (MAX)</strong></td>\r\n<td style=\"height: 22.3958px;\">8500</td>\r\n</tr>\r\n<tr style=\"height: 22.3958px;\">\r\n<td style=\"height: 22.3958px;\"><strong>SWITCH LIFECYCLE</strong></td>\r\n<td style=\"height: 22.3958px;\">50 Million Clicks</td>\r\n</tr>\r\n<tr style=\"height: 22.3958px;\">\r\n<td style=\"height: 22.3958px;\"><strong>Response Time</strong></td>\r\n<td style=\"height: 22.3958px;\">1ms</td>\r\n</tr>\r\n<tr>\r\n<td><strong>RGB</strong></td>\r\n<td>Yes</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Buttons</strong></td>\r\n<td>6 Programmable Buttons</td>\r\n</tr>\r\n</tbody>\r\n</table>', 800.00, 4, 'uploads/65cb84cb024fa.png,uploads/65cb84cb0269b.png,uploads/65cb84cb02785.png,uploads/65cb84cb029c9.png'),
(2, 'XPG Lancer RGB DDR5 RAM', 'Components', 'RAM', '<p>Best RAM for your computer! High Speed DDR5 RAM</p>\r\n<table style=\"border-collapse: collapse; width: 100.077%;\" border=\"1\"><colgroup><col style=\"width: 49.884%;\"><col style=\"width: 49.884%;\"></colgroup>\r\n<tbody>\r\n<tr>\r\n<td><strong>SPEED</strong></td>\r\n<td>7200 Mhz</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Warrenty</strong></td>\r\n<td>Limited Lifetime Warrenty</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Test</strong></td>\r\n<td>Test</td>\r\n</tr>\r\n</tbody>\r\n</table>', 900.00, 3, 'uploads/65cb9335a79c9.png'),
(3, 'Razer Kraken X', 'Peripherals', 'Headphone', '<p>Best Mid Range Gaming Headset</p>\r\n<table style=\"border-collapse: collapse; width: 100.077%;\" border=\"1\"><colgroup><col style=\"width: 47.8721%;\"><col style=\"width: 52.0528%;\"></colgroup>\r\n<tbody>\r\n<tr>\r\n<td><strong>Test</strong></td>\r\n<td>Test</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Test</strong></td>\r\n<td>Test</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Test</strong></td>\r\n<td>Test</td>\r\n</tr>\r\n</tbody>\r\n</table>', 850.00, 0, 'uploads/65cb95c3b2a69.png'),
(4, 'Samsung 970 EVO M.2 1TB', 'Components', 'SSD', '<p>Samsung 970 EVO 1TB M.2</p>\r\n<table style=\"border-collapse: collapse; width: 100.077%;\" border=\"1\"><colgroup><col style=\"width: 49.884%;\"><col style=\"width: 49.884%;\"></colgroup>\r\n<tbody>\r\n<tr>\r\n<td><strong>Test</strong></td>\r\n<td>Test</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Test</strong></td>\r\n<td>Test</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Test</strong></td>\r\n<td>Test</td>\r\n</tr>\r\n</tbody>\r\n</table>', 990.00, 0, 'uploads/65cb961d8d0a3.webp'),
(5, 'Redragon Kumura K552', 'Peripherals', 'Keyboard', '<p>Best Gaming Keyboard! Budget Mechanical gaming keyboard</p>', 700.00, 15, 'uploads/65cb9881eb4f2.webp,uploads/65cb9881eb672.webp,uploads/65cb9881eb732.webp,uploads/65cb9881eb7cf.webp'),
(6, 'Razer Hybrid Mouse Mat', 'Peripherals', 'Mouse', '<p>Mouse mat with wireless charging for keyboard and mouse</p>', 750.00, 2, 'uploads/65cb98aab5aad.webp'),
(7, 'iCUE Cooler', 'Components', 'Cooler', '<p>Best AIO Coller in the market</p>', 900.00, 9, 'uploads/65cb98cc65e14.webp'),
(8, 'CX Series CX 450', 'Components', 'Power Supply', '<p>Best Fully Modular Power Supply</p>', 999.00, 0, 'uploads/65d8a763829cf.webp'),
(9, 'Test Product', 'Peripherals', 'Mouse', '<p>Write Description Here asd</p>', 123.00, 2, 'uploads/65d8bbfe10972.png');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `receipt_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`receipt_id`, `user_id`, `order_id`, `product_id`, `customer_email`, `customer_name`, `description`, `transaction_id`, `status`) VALUES
(5, 1, 7, '1', 'tulashakarki@gmail.com', 'Tulasha Karki', '<div class=\"receipt-container\"><h1 class=\"mt-4 mb-3\">Receipt</h1><div class=\"row\"><div class=\"col\"><p><strong>Date:</strong> 2024-02-29 07:44:34</p><p><strong>Receipt Number:</strong> #273103</p><p><strong>Ordered By:</strong> #Tulasha Karki</p><p><strong>Email:</strong> #tulashakarki@gmail.com</p><p><strong>Shipping Address:</strong> #Tarahara,Sunsari,Koshi1</p></div></div><h3 class=\"mt-4 mb-3\">Items:</h3><ul class=\"list-group mb-3\"><li class=\"list-group-item d-flex justify-content-between lh-condensed\"><div><h6 class=\"my-0\">Razer Viper Mini</h6><small class=\"text-muted\">Price: Rs.800.00   QTY: 1</small></div><span class=\"text-muted\">Rs.800</span></li><li class=\"list-group-item d-flex justify-content-between\"><span>Total (NRP)</span><strong>Rs.800</strong></li></ul><p><strong>Payment Method:</strong> Cash on Delivery', 'cod65e027d236929', 'Paid'),
(6, 1, 8, '3', 'tulashakarki@gmail.com', 'Tulasha Karki', '<div class=\"receipt-container\"><h1 class=\"mt-4 mb-3\">Receipt</h1><div class=\"row\"><div class=\"col\"><p><strong>Date:</strong> 2024-02-29 07:44:40</p><p><strong>Receipt Number:</strong> #841018</p><p><strong>Ordered By:</strong> #Tulasha Karki</p><p><strong>Email:</strong> #tulashakarki@gmail.com</p><p><strong>Shipping Address:</strong> #Tarahara,Sunsari,Koshi1</p></div></div><h3 class=\"mt-4 mb-3\">Items:</h3><ul class=\"list-group mb-3\"><li class=\"list-group-item d-flex justify-content-between lh-condensed\"><div><h6 class=\"my-0\">Razer Kraken X</h6><small class=\"text-muted\">Price: Rs.850.00   QTY: 2</small></div><span class=\"text-muted\">Rs.1700</span></li><li class=\"list-group-item d-flex justify-content-between\"><span>Total (NRP)</span><strong>Rs.1700</strong></li></ul><p><strong>Payment Method:</strong> Cash on Delivery', 'cod65e027d8a9d94', 'Paid'),
(7, 1, 9, '5,6', 'tulashakarki@gmail.com', 'Tulasha Karki', '<div class=\"receipt-container\"><h1 class=\"mt-4 mb-3\">Receipt</h1><div class=\"row\"><div class=\"col\"><p><strong>Date:</strong> 2024-02-29 07:44:46</p><p><strong>Receipt Number:</strong> #633514</p><p><strong>Ordered By:</strong> #Tulasha Karki</p><p><strong>Email:</strong> #tulashakarki@gmail.com</p><p><strong>Shipping Address:</strong> #Tarahara,Sunsari,Koshi1</p></div></div><h3 class=\"mt-4 mb-3\">Items:</h3><ul class=\"list-group mb-3\"><li class=\"list-group-item d-flex justify-content-between lh-condensed\"><div><h6 class=\"my-0\">Redragon Kumura K552</h6><small class=\"text-muted\">Price: Rs.700.00   QTY: 1</small></div><span class=\"text-muted\">Rs.700</span></li><li class=\"list-group-item d-flex justify-content-between lh-condensed\"><div><h6 class=\"my-0\">Razer Hybrid Mouse Mat</h6><small class=\"text-muted\">Price: Rs.750.00   QTY: 1</small></div><span class=\"text-muted\">Rs.750</span></li><li class=\"list-group-item d-flex justify-content-between\"><span>Total (NRP)</span><strong>Rs.1450</strong></li></ul><p><strong>Payment Method:</strong> Cash on Delivery', 'cod65e027deb7e6f', 'Paid'),
(8, 1, 10, '2', 'tulashakarki@gmail.com', 'Tulasha Karki', '<div class=\"receipt-container\"><h1 class=\"mt-4 mb-3\">Receipt</h1><div class=\"row\"><div class=\"col\"><p><strong>Date:</strong> 2024-02-29 08:58:48</p><p><strong>Receipt Number:</strong> #376705</p><p><strong>Ordered By:</strong> #Tulasha Karki</p><p><strong>Email:</strong> #tulashakarki@gmail.com</p><p><strong>Shipping Address:</strong> #Tarahara,Sunsari,Koshi1</p></div></div><h3 class=\"mt-4 mb-3\">Items:</h3><ul class=\"list-group mb-3\"><li class=\"list-group-item d-flex justify-content-between lh-condensed\"><div><h6 class=\"my-0\">XPG Lancer RGB DDR5 RAM</h6><small class=\"text-muted\">Price: Rs.900.00   QTY: 1</small></div><span class=\"text-muted\">Rs.900</span></li><li class=\"list-group-item d-flex justify-content-between\"><span>Total (NRP)</span><strong>Rs.900</strong></li></ul><p><strong>Payment Method:</strong> Cash on Delivery', 'cod65e039389b16b', 'Unpaid'),
(9, 1, 11, '7', 'tulashakarki@gmail.com', 'Tulasha Karki', '<div class=\"receipt-container\"><h1 class=\"mt-4 mb-3\">Receipt</h1><div class=\"row\"><div class=\"col\"><p><strong>Date:</strong> 2024-02-29 09:00:01</p><p><strong>Receipt Number:</strong> #559211</p><p><strong>Ordered By:</strong> #Tulasha Karki</p><p><strong>Email:</strong> #tulashakarki@gmail.com</p><p><strong>Shipping Address:</strong> #Tarahara,Sunsari,Koshi1</p></div></div><h3 class=\"mt-4 mb-3\">Items:</h3><ul class=\"list-group mb-3\"><li class=\"list-group-item d-flex justify-content-between lh-condensed\"><div><h6 class=\"my-0\">iCUE Cooler</h6><small class=\"text-muted\">Price: Rs.900.00   QTY: 1</small></div><span class=\"text-muted\">Rs.900</span></li><li class=\"list-group-item d-flex justify-content-between\"><span>Total (NRP)</span><strong>Rs.900</strong></li></ul><p><strong>Payment Method:</strong> Khalti', 'eenjLs7y3JkGeMCrGYSKyF', 'Paid'),
(10, 1, 12, '5,1', 'tulashakarki@gmail.com', 'Tulasha Karki', '<div class=\"receipt-container\"><h1 class=\"mt-4 mb-3\">Receipt</h1><div class=\"row\"><div class=\"col\"><p><strong>Date:</strong> 2024-03-01 09:33:10</p><p><strong>Receipt Number:</strong> #753264</p><p><strong>Ordered By:</strong> #Tulasha Karki</p><p><strong>Email:</strong> #tulashakarki@gmail.com</p><p><strong>Shipping Address:</strong> #Tarahara,Sunsari,Koshi1</p></div></div><h3 class=\"mt-4 mb-3\">Items:</h3><ul class=\"list-group mb-3\"><li class=\"list-group-item d-flex justify-content-between lh-condensed\"><div><h6 class=\"my-0\">Redragon Kumura K552</h6><small class=\"text-muted\">Price: Rs.700.00   QTY: 1</small></div><span class=\"text-muted\">Rs.700</span></li><li class=\"list-group-item d-flex justify-content-between lh-condensed\"><div><h6 class=\"my-0\">Razer Viper Mini</h6><small class=\"text-muted\">Price: Rs.800.00   QTY: 1</small></div><span class=\"text-muted\">Rs.800</span></li><li class=\"list-group-item d-flex justify-content-between\"><span>Total (NRP)</span><strong>Rs.1500</strong></li></ul><p><strong>Payment Method:</strong> Cash on Delivery', 'cod65e192c62de37', 'Unpaid'),
(11, 1, 13, '1', 'tulashakarki@gmail.com', 'Tulasha Karki', '<div class=\"receipt-container\"><h1 class=\"mt-4 mb-3\">Receipt</h1><div class=\"row\"><div class=\"col\"><p><strong>Date:</strong> 2024-03-01 09:33:24</p><p><strong>Receipt Number:</strong> #664174</p><p><strong>Ordered By:</strong> #Tulasha Karki</p><p><strong>Email:</strong> #tulashakarki@gmail.com</p><p><strong>Shipping Address:</strong> #Tarahara,Sunsari,Koshi1</p></div></div><h3 class=\"mt-4 mb-3\">Items:</h3><ul class=\"list-group mb-3\"><li class=\"list-group-item d-flex justify-content-between lh-condensed\"><div><h6 class=\"my-0\">Razer Viper Mini</h6><small class=\"text-muted\">Price: Rs.800.00   QTY: 1</small></div><span class=\"text-muted\">Rs.800</span></li><li class=\"list-group-item d-flex justify-content-between\"><span>Total (NRP)</span><strong>Rs.800</strong></li></ul><p><strong>Payment Method:</strong> Cash on Delivery', 'cod65e192d3da17f', 'Unpaid'),
(12, 3, 14, '1', 'mashhood@gmail.com', 'Mashhood Khan', '<div class=\"receipt-container\"><h1 class=\"mt-4 mb-3\">Receipt</h1><div class=\"row\"><div class=\"col\"><p><strong>Date:</strong> 2024-03-18 12:22:17</p><p><strong>Receipt Number:</strong> #309600</p><p><strong>Ordered By:</strong> #Mashhood Khan</p><p><strong>Email:</strong> #mashhood@gmail.com</p><p><strong>Shipping Address:</strong> #Test , kTM,Kathmandu,Bagmati</p></div></div><h3 class=\"mt-4 mb-3\">Items:</h3><ul class=\"list-group mb-3\"><li class=\"list-group-item d-flex justify-content-between lh-condensed\"><div><h6 class=\"my-0\">Razer Viper Mini</h6><small class=\"text-muted\">Price: Rs.800.00   QTY: 1</small></div><span class=\"text-muted\">Rs.800</span></li><li class=\"list-group-item d-flex justify-content-between\"><span>Total (NRP)</span><strong>Rs.800</strong></li></ul><p><strong>Payment Method:</strong> Khalti', 'EmLALKZZYKMw79canVMkCe', 'Paid'),
(13, 3, 15, '3', 'mashhood@gmail.com', 'Mashhood Khan', '<div class=\"receipt-container\"><h1 class=\"mt-4 mb-3\">Receipt</h1><div class=\"row\"><div class=\"col\"><p><strong>Date:</strong> 2024-04-03 12:34:20</p><p><strong>Receipt Number:</strong> #653009</p><p><strong>Ordered By:</strong> #Mashhood Khan</p><p><strong>Email:</strong> #mashhood@gmail.com</p><p><strong>Shipping Address:</strong> #Test , kTM,Kathmandu,Bagmati</p></div></div><h3 class=\"mt-4 mb-3\">Items:</h3><ul class=\"list-group mb-3\"><li class=\"list-group-item d-flex justify-content-between lh-condensed\"><div><h6 class=\"my-0\">Razer Kraken X</h6><small class=\"text-muted\">Price: Rs.850.00   QTY: 1</small></div><span class=\"text-muted\">Rs.850</span></li><li class=\"list-group-item d-flex justify-content-between\"><span>Total (NRP)</span><strong>Rs.850</strong></li></ul><p><strong>Payment Method:</strong> Khalti', 'QphVXy5ZcnK9Wy3MWxhaZA', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`) VALUES
(1, 'Tulasha Karki', 'tulashakarki@gmail.com', '$2y$10$clojYiyTegkn4qwWTsvIyONstzggzSPxhQ0uC6X5ZHxVCfVRZT70q'),
(2, 'Rohan Phuyal', 'rohanphuyal2@gmail.com', '$2y$10$zqTcbY1xhicMpgUKAz058uzuz/4fQCyjtAGQhTRpZozSqrgg1XNbC'),
(3, 'Mashhood Khan', 'mashhood@gmail.com', '$2y$10$D4b9hombyYf6st7VzVG0neRzaKtmvG9O8Rvums/./AtMSWVY6ZmYq'),
(4, 'Rojal Manandar', 'rojal@gmail.com', '$2y$10$9tBeLxIn7JDuzJ8DyH54VO2d7g6CX/cYiGwNY2jpkFgSqB/TxMp6G'),
(5, 'Test Name', 'test@gmail.com', '$2y$10$NJ3ctuwJDf38qfgk.I/y2Oqa66TbEF.Tmk6j6rJ5A3ApWjIrYswYm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `customer_email` (`customer_email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`receipt_id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `customers_ibfk_2` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customer_email`) REFERENCES `customers` (`email`);

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `receipt_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `receipt_ibfk_3` FOREIGN KEY (`transaction_id`) REFERENCES `orders` (`transaction_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2024 at 10:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hardware`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `nic_image_url` varchar(255) NOT NULL,
  `nic_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user_id`, `nic_image_url`, `nic_number`) VALUES
(1, 1, '1_nic.jpg', '205045005v');

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `bank_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `holder_name` varchar(255) NOT NULL,
  `account_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`bank_details_id`, `user_id`, `bank_name`, `branch`, `holder_name`, `account_no`) VALUES
(1, 3, 'com bank', 'colombo', 'a.t.r.d.s kulasinghe', '0708990403');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `technician_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `booked_date` date NOT NULL,
  `booked_time` time NOT NULL,
  `accept_date` date DEFAULT NULL,
  `accept_time` time DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `finished_date` date DEFAULT NULL,
  `finished_time` time DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `house_no` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `payment_status` varchar(50) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `cost` double DEFAULT NULL,
  `description` text DEFAULT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `technician_id`, `customer_id`, `status`, `booked_date`, `booked_time`, `accept_date`, `accept_time`, `start_date`, `start_time`, `finished_date`, `finished_time`, `photo_url`, `house_no`, `state`, `city`, `payment_status`, `payment_method`, `cost`, `description`, `latitude`, `longitude`) VALUES
(1, 1, 2, 'finish', '2024-02-17', '08:00:00', '2024-02-14', '23:16:58', '2024-02-14', '19:17:14', '2024-02-14', '23:19:21', '1_image.jpg', '91/A', 'North Central Province', 'Anuradhapura', 'paid', 'cash', 2017.638, '', '7.102255', '80.328598');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cashier`
--

CREATE TABLE `cashier` (
  `cashier_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `nic_number` varchar(255) NOT NULL,
  `nic_image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `user_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(50) NOT NULL,
  `delivery_boy_id` int(50) NOT NULL,
  `order_id` int(50) NOT NULL,
  `date_of_pickup` date DEFAULT NULL,
  `time_of_pickup` time DEFAULT NULL,
  `date_of_delivered` date DEFAULT NULL,
  `time_of_delivered` time DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `delivery_cost` double NOT NULL,
  `description` text DEFAULT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`delivery_id`, `delivery_boy_id`, `order_id`, `date_of_pickup`, `time_of_pickup`, `date_of_delivered`, `time_of_delivered`, `first_name`, `last_name`, `phone_no`, `status`, `house_no`, `state`, `city`, `delivery_cost`, `description`, `latitude`, `longitude`) VALUES
(1, 1, 1, '2024-02-14', '20:03:08', '2024-02-14', '20:06:07', 'Tharindu', 'Ruchiranga', '0786447343', 'delivered', '91/A', 'North Central Province', 'Anuradhapura', 200, NULL, '7.139048', '80.224915'),
(2, 1, 2, NULL, NULL, NULL, NULL, 'Tharindu', 'Ruchiranga', '0786447343', 'pending', '91/A', 'North Central Province', 'Anuradhapura', 200, NULL, '6.933073', '79.894810'),
(3, 1, 3, NULL, NULL, NULL, NULL, 'Tharindu', 'Ruchiranga', '0786447343', 'pending', '91/A', 'North Central Province', 'Anuradhapura', 200, NULL, '6.933073', '79.894810'),
(4, 1, 4, NULL, NULL, NULL, NULL, 'Tharindu', 'Ruchiranga', '0786447343', 'pending', '91/A', 'North Central Province', 'Anuradhapura', 200, NULL, '6.933073', '79.894810');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy`
--

CREATE TABLE `delivery_boy` (
  `delivery_boy_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `nic_number` varchar(50) NOT NULL,
  `nic_image_url` varchar(255) NOT NULL,
  `vehicle_type` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `vehicle_number` varchar(50) NOT NULL,
  `vehicle_model` varchar(50) NOT NULL,
  `balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_boy`
--

INSERT INTO `delivery_boy` (`delivery_boy_id`, `user_id`, `nic_number`, `nic_image_url`, `vehicle_type`, `status`, `vehicle_number`, `vehicle_model`, `balance`) VALUES
(1, 3, '10000000v', '3_nic.jpg', 'car', 'approved', 'ff', 'hh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy_feedback`
--

CREATE TABLE `delivery_boy_feedback` (
  `delivery_boy_feedback_id` int(50) NOT NULL,
  `delivery_boy_id` int(50) NOT NULL,
  `customer_id` int(50) NOT NULL,
  `description` int(255) NOT NULL,
  `number_of_stars` int(50) NOT NULL,
  `date` date NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(100) NOT NULL,
  `item_category` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(50) NOT NULL,
  `stock_quantity` int(50) NOT NULL,
  `creation_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `discount` int(50) DEFAULT NULL,
  `warranty` varchar(50) NOT NULL,
  `weight` int(100) DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_category`, `name`, `price`, `stock_quantity`, `creation_date`, `expiration_date`, `brand`, `discount`, `warranty`, `weight`, `manufacturer`, `description`) VALUES
(1, 1, 'fasdf', 100, 8, '2024-02-05', '2024-03-03', 'fads', 100, '10', 10, 'asfd', '  '),
(2, 1, 'desktop', 10, 18, '0000-00-00', '0000-00-00', 'fds', 0, '1', 10, 'fas', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `item_catagory_id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`item_catagory_id`, `name`, `description`, `image_url`) VALUES
(1, 'fasd', 'gh ghj ', '1_category_image.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `item_feedback`
--

CREATE TABLE `item_feedback` (
  `item_feedback_id` int(50) NOT NULL,
  `item_id` int(50) NOT NULL,
  `customer_id` int(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `number_of_stars` int(20) NOT NULL,
  `date` date NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_image`
--

CREATE TABLE `item_image` (
  `item_image_id` int(50) NOT NULL,
  `item_id` int(50) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_image`
--

INSERT INTO `item_image` (`item_image_id`, `item_id`, `image_url`) VALUES
(1, 1, '1_image1.jpg'),
(2, 1, '1_image2.jpg'),
(3, 1, '1_image3.jpg'),
(4, 1, '1_image4.jpg'),
(5, 1, '1_image5.jpg'),
(6, 2, '2_image1.jpg'),
(7, 2, '2_image2.jpg'),
(8, 2, '2_image3.jpg'),
(9, 2, '2_image4.jpg'),
(10, 2, '2_image5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(50) NOT NULL,
  `sender_id` int(50) NOT NULL,
  `receiver_id` int(50) NOT NULL,
  `message_type` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `timestamp` varchar(50) NOT NULL,
  `file_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `order_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `date`, `time`, `payment_method`, `payment_status`, `order_status`) VALUES
(1, 2, '2024-02-14', '00:07:42', 'cash', 'paid', 'active'),
(2, 2, '2024-02-14', '00:27:06', 'cash', 'pending', 'active'),
(3, 2, '2024-02-14', '00:35:45', 'cash', 'pending', 'pending'),
(4, 2, '2024-02-15', '15:51:20', 'cash', 'pending', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` int(50) NOT NULL,
  `order_id` int(50) NOT NULL,
  `item_id` int(50) NOT NULL,
  `order_type` varchar(50) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_details_id`, `order_id`, `item_id`, `order_type`, `quantity`) VALUES
(1, 1, 1, '', 1),
(2, 2, 1, '', 5),
(3, 3, 2, '', 2),
(4, 3, 1, '', 5),
(5, 4, 1, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `amount` double NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `user_id`, `date`, `time`, `amount`, `status`) VALUES
(1, 3, '2024-02-14', '20:08:24', 100, 'paid'),
(2, 3, '2024-02-14', '20:11:04', 100, 'pending'),
(3, 3, '2024-02-14', '20:12:41', 100, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `security_question`
--

CREATE TABLE `security_question` (
  `security_question_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `security_question`
--

INSERT INTO `security_question` (`security_question_id`, `question`) VALUES
(1, 'What is your childhood name?'),
(2, 'Who was your favorite teacher?'),
(3, 'What is the name of your first pet?'),
(4, 'In which city were you born?');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `subscriber_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `technical_team`
--

CREATE TABLE `technical_team` (
  `technical_team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nic_image_url` varchar(255) NOT NULL,
  `nic_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `technician`
--

CREATE TABLE `technician` (
  `technician_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `category` int(50) NOT NULL,
  `nic_number` varchar(100) NOT NULL,
  `nic_photo_url` varchar(255) NOT NULL,
  `work_experience` varchar(50) NOT NULL,
  `cost_per_day` double NOT NULL,
  `cost_per_hour` double NOT NULL,
  `status` varchar(50) NOT NULL,
  `balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technician`
--

INSERT INTO `technician` (`technician_id`, `user_id`, `category`, `nic_number`, `nic_photo_url`, `work_experience`, `cost_per_day`, `cost_per_hour`, `status`, `balance`) VALUES
(1, 4, 1, '10000000v', '4_nic.jpg', '10', 2000, 500, 'pending', 3236.2208);

-- --------------------------------------------------------

--
-- Table structure for table `technician_category`
--

CREATE TABLE `technician_category` (
  `technician_category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technician_category`
--

INSERT INTO `technician_category` (`technician_category_id`, `name`, `description`, `image_url`) VALUES
(1, 'Electrician', 'Specializes in electrical wiring of buildings, transmission lines, and related equipment. They install, maintain, and repair electrical systems in residential, commercial, and industrial settings.', '1_category_image.jpg'),
(2, 'Mason bricklayer', 'Also known as bricklayers or stonemasons, they work with bricks, concrete blocks, stone, and other materials to build structures like walls, sidewalks, and paths. They use mortar or other adhesives to bind the materials together.', '2_category_image.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `technician_feedback`
--

CREATE TABLE `technician_feedback` (
  `technician_feedback_id` int(50) NOT NULL,
  `technician_id` int(50) NOT NULL,
  `customer_id` int(50) NOT NULL,
  `number_of_stars` int(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `house_no` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `account_type` varchar(50) NOT NULL,
  `profile_url` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `security_question` int(11) DEFAULT NULL,
  `question_answer` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `activation_code` varchar(100) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `phone_number`, `dob`, `house_no`, `state`, `city`, `account_type`, `profile_url`, `password`, `security_question`, `question_answer`, `status`, `activation_code`, `latitude`, `longitude`) VALUES
(1, 'Nimal', 'Kumara', 'admin@gmail.com', '0786447343', '1992-02-10', '95/A', 'Abillawtta', 'Boralasgamuwa', 'admin', '1_profile.jpg', '$2y$10$TgeheTTvY32.zLzwyS0NsOY6NR5xNQPWL3C1GUJe0vWgQEePUP..G', 1, 'Nimal', 'active', '192255', NULL, NULL),
(2, 'Tharindu', 'Ruchiranga', 'tharinduruchiranga252@gmail.com', '0786447343', '1995-08-28', '91/A', 'North Central Province', 'Anuradhapura', 'customer', '2_profile.jpg', '$2y$10$Tp3hMdv7qvuY8RU.EOC6TOHSQFxXeo6QbpSRPgXzvZoUnX5Tf.Ht.', 1, 'tharindu', 'active', '100', '7.849778', '80.676551'),
(3, 'Tharindu', 'Ruchiranga', 'delivery@gmail.com', '0786447343', '2024-01-29', 'fasdf', 'North Central Province', 'Anuradhapura', 'delivery_boy', '3_profile.jpg', '$2y$10$PrciYGI2W3FZgSCDv1dN9.BKsl3zkbVoe0UhAq6nDS9p8Flx2crp6', 1, 'fasdfasdfsadf afads fa ff', 'active', '100', '6.941252', '79.892235'),
(4, 'Tharindu', 'Ruchiranga', 'technician@gmail.com', '0786447343', '2024-01-29', 'fasdf', 'North Central Province', 'Anuradhapura', 'technician', '4_profile.jpg', '$2y$10$Tp3hMdv7qvuY8RU.EOC6TOHSQFxXeo6QbpSRPgXzvZoUnX5Tf.Ht.', 1, 'fasdfasdfsadf afads fa ff', 'active', '100', '7.089990', '80.384216');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`bank_details_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `technision_id_fk` (`technician_id`),
  ADD KEY `customer_id_fk` (`customer_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `cashier`
--
ALTER TABLE `cashier`
  ADD PRIMARY KEY (`cashier_id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `delivery_boy_id_fk` (`delivery_boy_id`),
  ADD KEY `online_order_id_fk` (`order_id`);

--
-- Indexes for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  ADD PRIMARY KEY (`delivery_boy_id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `delivery_boy_feedback`
--
ALTER TABLE `delivery_boy_feedback`
  ADD PRIMARY KEY (`delivery_boy_feedback_id`),
  ADD KEY `delivery_boy_id_fk` (`delivery_boy_id`),
  ADD KEY `customer_id_fk` (`customer_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `item_category_fk` (`item_category`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`item_catagory_id`);

--
-- Indexes for table `item_feedback`
--
ALTER TABLE `item_feedback`
  ADD PRIMARY KEY (`item_feedback_id`),
  ADD KEY `item_id_fk` (`item_id`),
  ADD KEY `customer_id_fk` (`customer_id`);

--
-- Indexes for table `item_image`
--
ALTER TABLE `item_image`
  ADD PRIMARY KEY (`item_image_id`),
  ADD KEY `item_fk` (`item_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sender_id_fk` (`sender_id`),
  ADD KEY `receiver_id_fk` (`receiver_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `security_question`
--
ALTER TABLE `security_question`
  ADD PRIMARY KEY (`security_question_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`subscriber_id`);

--
-- Indexes for table `technical_team`
--
ALTER TABLE `technical_team`
  ADD PRIMARY KEY (`technical_team_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `technician`
--
ALTER TABLE `technician`
  ADD PRIMARY KEY (`technician_id`),
  ADD KEY `user_id_fk` (`user_id`),
  ADD KEY `technician_category_fk` (`category`);

--
-- Indexes for table `technician_category`
--
ALTER TABLE `technician_category`
  ADD PRIMARY KEY (`technician_category_id`);

--
-- Indexes for table `technician_feedback`
--
ALTER TABLE `technician_feedback`
  ADD PRIMARY KEY (`technician_feedback_id`),
  ADD KEY `technician_id_fk` (`technician_id`),
  ADD KEY `customer_id_fk` (`customer_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `security_question` (`security_question`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `bank_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cashier`
--
ALTER TABLE `cashier`
  MODIFY `cashier_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  MODIFY `delivery_boy_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_boy_feedback`
--
ALTER TABLE `delivery_boy_feedback`
  MODIFY `delivery_boy_feedback_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `item_catagory_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_feedback`
--
ALTER TABLE `item_feedback`
  MODIFY `item_feedback_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_image`
--
ALTER TABLE `item_image`
  MODIFY `item_image_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `security_question`
--
ALTER TABLE `security_question`
  MODIFY `security_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `subscriber_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `technical_team`
--
ALTER TABLE `technical_team`
  MODIFY `technical_team_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `technician`
--
ALTER TABLE `technician`
  MODIFY `technician_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `technician_category`
--
ALTER TABLE `technician_category`
  MODIFY `technician_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `technician_feedback`
--
ALTER TABLE `technician_feedback`
  MODIFY `technician_feedback_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `cashier`
--
ALTER TABLE `cashier`
  ADD CONSTRAINT `cashier_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `delivery_boy_feedback`
--
ALTER TABLE `delivery_boy_feedback`
  ADD CONSTRAINT `delivery_boy_feedback_ibfk_1` FOREIGN KEY (`delivery_boy_id`) REFERENCES `delivery_boy` (`delivery_boy_id`),
  ADD CONSTRAINT `delivery_boy_feedback_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`item_category`) REFERENCES `item_category` (`item_catagory_id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `technician`
--
ALTER TABLE `technician`
  ADD CONSTRAINT `technician_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `technician_ibfk_2` FOREIGN KEY (`category`) REFERENCES `technician_category` (`technician_category_id`);

--
-- Constraints for table `technician_feedback`
--
ALTER TABLE `technician_feedback`
  ADD CONSTRAINT `technician_feedback_ibfk_1` FOREIGN KEY (`technician_id`) REFERENCES `technician` (`technician_id`),
  ADD CONSTRAINT `technician_feedback_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

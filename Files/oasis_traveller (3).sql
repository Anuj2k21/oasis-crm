-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 08:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oasis_traveller`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_profile`
--

CREATE TABLE `admin_profile` (
  `id` int(11) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_profile`
--

INSERT INTO `admin_profile` (`id`, `profile_image`, `full_name`, `email`, `phone`, `company`, `address`, `password`, `created_at`, `updated_at`) VALUES
(1, 'uploads/1725886159_team-1.jpg', 'Atul K. Chaurasiya', 'account@oasistraveller', '+8756192516', 'Oasis Travellers', 'Lucknow', 'atul@123', '2024-09-06 10:45:07', '2024-09-13 06:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `gstin` varchar(255) DEFAULT NULL,
  `agent_type` varchar(50) NOT NULL,
  `document_upload` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `company`, `agent_name`, `address`, `country`, `city`, `email`, `contact`, `gstin`, `agent_type`, `document_upload`) VALUES
(42, 'Oasis Travellers', 'Nitesh Vishwakarma', 'Varanasi', 'India', 'Lucknow', 'niteshvishwakarma099@gmail.com', '8756192516', '0999', 'Agent Type 1', 'GATE (1).pdf'),
(43, 'ABCD', 'Arti', 'Lucknow', 'India', 'Lucknow', 'amzad@gmail.com', '9721382099', '09aagfo27951zh', 'Agent Type 2', 'generate_bill.sql'),
(44, 'Oasis Travellers', 'Anuj', 'Lucknow', 'India', 'Lucknow', 'anuj161999@gmail.com', '8756192516', '6773', 'Agent Type 1', 'AstroInvoice_6.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `agent_info`
--

CREATE TABLE `agent_info` (
  `id` int(11) NOT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `agent_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `sold_by` varchar(100) DEFAULT NULL,
  `guest_name` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `hotel` varchar(255) DEFAULT NULL,
  `hotel_address` varchar(255) DEFAULT NULL,
  `hotel_no` varchar(50) DEFAULT NULL,
  `room_no` varchar(50) DEFAULT NULL,
  `whatsapp_number` varchar(50) DEFAULT NULL,
  `emergency_number` varchar(50) DEFAULT NULL,
  `adult` int(11) DEFAULT NULL,
  `child` int(11) DEFAULT NULL,
  `infant` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agent_info`
--

INSERT INTO `agent_info` (`id`, `reference_number`, `company_name`, `agent_name`, `address`, `country`, `city`, `contact`, `sold_by`, `guest_name`, `destination`, `hotel`, `hotel_address`, `hotel_no`, `room_no`, `whatsapp_number`, `emergency_number`, `adult`, `child`, `infant`, `created_at`) VALUES
(0, '', '', '', '<br /><b>Warning</b>:  Undefined variable $address in <b>C:xampphtdocsOasis-crmgenerate_bill.php</b> on line <b>238</b><br />', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, '2024-09-16 07:32:00'),
(0, '', '', '', 'kanpur', 'India', 'Lucknow', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, '2024-09-16 10:28:58'),
(0, '', '', '', 'Varanasi', 'India', 'Lucknow', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, '2024-09-16 10:30:06'),
(0, '', '', '', 'Varanasi', 'India', 'Lucknow', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, '2024-09-16 10:31:33'),
(0, '', '', '', '<br /><b>Warning</b>:  Undefined variable $address in <b>C:xampphtdocsOasis-crmgenerate_bill.php</b> on line <b>238</b><br />', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, '2024-09-18 06:19:49'),
(0, '', '', '', '<br /><b>Warning</b>:  Undefined variable $address in <b>C:xampphtdocsOasis-crmgenerate_bill.php</b> on line <b>238</b><br />', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, '2024-09-18 06:21:40'),
(0, '', '', '', '<br /><b>Warning</b>:  Undefined variable $address in <b>C:xampphtdocsOasis-crmgenerate_bill.php</b> on line <b>238</b><br />', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, '2024-09-18 06:31:35'),
(0, '', '', '', '<br /><b>Warning</b>:  Undefined variable $address in <b>C:xampphtdocsOasis-crmgenerate_bill.php</b> on line <b>238</b><br />', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, '2024-09-18 06:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `hotel_name` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `country`, `city`, `hotel_name`, `category`, `address`, `phone`) VALUES
(23, 'India', 'Lucknow', 'Raw Palace', '7 Star', 'Lucknow', '8756192516'),
(30, 'United Arab Emirates', 'Dubai', 'Raw Palace', '7 Star', 'Dubai', '0875619251');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `country_name`, `city_name`, `created_at`, `updated_at`) VALUES
(21, 'United Arab Emirates', 'Dubai', '2024-09-16 06:10:48', '2024-09-16 06:10:48'),
(24, 'India', 'Lucknow', '2024-09-16 11:55:39', '2024-09-16 11:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `meal_type`
--

CREATE TABLE `meal_type` (
  `id` int(11) NOT NULL,
  `meal_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meal_type`
--

INSERT INTO `meal_type` (`id`, `meal_name`) VALUES
(28, 'Indian');

-- --------------------------------------------------------

--
-- Table structure for table `nationalities`
--

CREATE TABLE `nationalities` (
  `id` int(11) NOT NULL,
  `nationality` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otp_requests`
--

CREATE TABLE `otp_requests` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `status` enum('unverified','verified') DEFAULT 'unverified',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp_requests`
--

INSERT INTO `otp_requests` (`id`, `email`, `otp`, `status`, `created_at`) VALUES
(1, 'niteshvishwakarma099@gmail.com', '606515', 'verified', '2024-07-31 06:10:51'),
(2, 'v87nitesh@gmail.com', '115611', 'verified', '2024-08-01 05:28:57'),
(4, 'asoft6162@gmai.com', '296427', 'verified', '2024-08-01 07:33:28'),
(6, 'anandvermae4545@gmail.com', '704222', 'unverified', '2024-08-31 16:20:28'),
(7, 'anandverma4545@gmail.com', '479566', 'verified', '2024-08-31 16:21:37'),
(8, 'anuj161999@gmail.com', '574408', 'verified', '2024-09-06 08:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `supplier_address` varchar(255) NOT NULL,
  `supplier_gst_no` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `supplier_name`, `company_name`, `supplier_address`, `supplier_gst_no`, `created_at`, `updated_at`) VALUES
(15, 'Nitesh Vishwakarma', 'Oasis Traveller', 'Lucknow', 'NITE0987654321', '2024-09-13 12:23:08', '2024-09-13 12:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `id` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `tour_name` varchar(255) NOT NULL,
  `pickup_time` time NOT NULL,
  `duration` varchar(50) NOT NULL,
  `vehicle_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `country`, `city`, `tour_name`, `pickup_time`, `duration`, `vehicle_type`) VALUES
(4, 'United Arab Emirates', 'Dubai', 'Nepal Tour', '20:18:00', '7 Days', 'Sharing Basis Vehicle'),
(5, 'India', 'Lucknow', 'Srinagar Tour', '18:25:00', '7 Days', 'Private Basis Vehicle');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `image`, `full_name`, `contact`, `user_id`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'unnamed (1).jpg', 'NITESH VISHWAKARMA', '08756192516', 'account@oasistraveller', '$2y$10$3oIiDoxlIrmQWK2e6mc8quRteFFUoMtC6trc.ZarocyIs0lgEbRQK', '', '2024-09-11 08:25:30', '2024-09-11 08:25:30'),
(2, 'admin', 'school.jpg', 'Amzad Khan', '8756192516', 'amzad@gmail.com', '$2y$10$e6RWuSkLOjQrhmjHZQJxb.kmVVQ7/HS2VP8gOcDIJJFg3PTlGgjCm', '', '2024-09-11 08:27:06', '2024-09-11 08:27:06'),
(3, 'user', 'unnamed.jpg', 'Ranjan ', '8756192516', 'account@oasistraveller', '$2y$10$QxHjEUjpFv4ZDAhjFugxTOgchdFcwSnyTMNGiUbQAvNSclXgzngb6', '', '2024-09-11 08:27:29', '2024-09-11 08:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `vehicle_name` varchar(255) NOT NULL,
  `seating_capacity` int(11) NOT NULL,
  `vehicle_cost_price` decimal(10,2) NOT NULL,
  `vehicle_selling_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `vehicle_name`, `seating_capacity`, `vehicle_cost_price`, `vehicle_selling_price`) VALUES
(6, 'Swift Dzire', 6, 3400.00, 4000.00);

-- --------------------------------------------------------

--
-- Table structure for table `visa_types`
--

CREATE TABLE `visa_types` (
  `id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `visa_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visa_types`
--

INSERT INTO `visa_types` (`id`, `country`, `visa_type`) VALUES
(19, 'India', 'indian');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_profile`
--
ALTER TABLE `admin_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meal_type`
--
ALTER TABLE `meal_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_requests`
--
ALTER TABLE `otp_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visa_types`
--
ALTER TABLE `visa_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_profile`
--
ALTER TABLE `admin_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `meal_type`
--
ALTER TABLE `meal_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp_requests`
--
ALTER TABLE `otp_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `visa_types`
--
ALTER TABLE `visa_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

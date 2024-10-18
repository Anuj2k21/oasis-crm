-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2024 at 09:18 AM
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
-- Database: `generate_bill`
--

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
);

-- --------------------------------------------------------

--
-- Table structure for table `booking_hotel`
--

CREATE TABLE `booking_hotel` (
  `id` int(11) NOT NULL,
  `RefNo` varchar(50) NOT NULL,
  `Supplier` varchar(255) NOT NULL,
  `Hotel` varchar(255) NOT NULL,
  `Rooms` int(11) NOT NULL,
  `Room_Type` varchar(100) DEFAULT NULL,
  `Meal_Type` varchar(100) DEFAULT NULL,
  `Check_In` date DEFAULT NULL,
  `Check_Out` date DEFAULT NULL,
  `Deadline` date DEFAULT NULL,
  `Cost_AED` decimal(10,2) DEFAULT NULL,
  `Sell_AED` decimal(10,2) DEFAULT NULL,
  `Gross_Profit` decimal(10,2) GENERATED ALWAYS AS (`Sell_AED` - `Cost_AED`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_tour`
--

CREATE TABLE `booking_tour` (
  `id` int(11) NOT NULL,
  `RefNo` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Tour_Type` varchar(100) DEFAULT NULL,
  `Tour` varchar(255) DEFAULT NULL,
  `Adult` int(11) NOT NULL,
  `Child` int(11) NOT NULL,
  `Infant` int(11) NOT NULL,
  `Cost_AED` decimal(10,2) DEFAULT NULL,
  `Total_Selling_AED` decimal(10,2) DEFAULT NULL,
  `Gross_Profit` decimal(10,2) GENERATED ALWAYS AS (`Total_Selling_AED` - `Cost_AED`) STORED,
  `Remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_visa`
--

CREATE TABLE `booking_visa` (
  `id` int(11) NOT NULL,
  `RefNo` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `Supplier` varchar(255) NOT NULL,
  `Visa_Type` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Passport_No` varchar(50) DEFAULT NULL,
  `Adult_Child` varchar(10) DEFAULT NULL,
  `Nationality` varchar(100) DEFAULT NULL,
  `ECR` tinyint(1) DEFAULT NULL,
  `Cost_AED` decimal(10,2) DEFAULT NULL,
  `Sell_AED` decimal(10,2) DEFAULT NULL,
  `Gross_Profit` decimal(10,2) GENERATED ALWAYS AS (`Sell_AED` - `Cost_AED`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent_info`
--
ALTER TABLE `agent_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_hotel`
--
ALTER TABLE `booking_hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_tour`
--
ALTER TABLE `booking_tour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_visa`
--
ALTER TABLE `booking_visa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent_info`
--
ALTER TABLE `agent_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `booking_hotel`
--
ALTER TABLE `booking_hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_tour`
--
ALTER TABLE `booking_tour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_visa`
--
ALTER TABLE `booking_visa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

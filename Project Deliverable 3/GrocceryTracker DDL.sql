-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 19, 2024 at 01:01 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS cosc360;
USE cosc360;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `GPT`
--

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE `Categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`CategoryID`, `CategoryName`) VALUES
(5, 'Bakery'),
(8, 'Beverages'),
(6, 'Canned Goods'),
(10, 'Condiments'),
(3, 'Dairy'),
(7, 'Frozen Foods'),
(1, 'Fruits'),
(11, 'Household'),
(4, 'Meat'),
(12, 'Personal Care'),
(9, 'Snacks'),
(2, 'Vegetables');

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `CommentID` int(11) NOT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Comment` text NOT NULL,
  `CommentDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Prices`
--

CREATE TABLE `Prices` (
  `PriceID` int(11) NOT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `StoreID` int(11) DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `PriceDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Prices`
--

INSERT INTO `Prices` (`PriceID`, `ProductID`, `StoreID`, `Price`, `PriceDate`) VALUES
(26657, 1, 1, 8.43, '2024-01-01 08:00:00'),
(26658, 1, 1, 7.90, '2024-01-11 08:00:00'),
(26659, 1, 1, 9.19, '2024-01-21 08:00:00'),
(26660, 1, 1, 7.26, '2024-01-31 08:00:00'),
(26661, 1, 1, 8.75, '2024-02-10 08:00:00'),
(26662, 1, 1, 6.94, '2024-02-20 08:00:00'),
(26663, 1, 1, 8.46, '2024-03-01 08:00:00'),
(26664, 1, 1, 6.48, '2024-03-11 07:00:00'),
(26665, 1, 1, 7.04, '2024-03-21 07:00:00'),
(26672, 2, 2, 8.88, '2024-01-01 08:00:00'),
(26673, 2, 2, 7.20, '2024-01-11 08:00:00'),
(26674, 2, 2, 9.35, '2024-01-21 08:00:00'),
(26675, 2, 2, 5.18, '2024-01-31 08:00:00'),
(26676, 2, 2, 7.83, '2024-02-10 08:00:00'),
(26677, 2, 2, 8.61, '2024-02-20 08:00:00'),
(26678, 2, 2, 9.57, '2024-03-01 08:00:00'),
(26679, 2, 2, 7.02, '2024-03-11 07:00:00'),
(26680, 2, 2, 6.40, '2024-03-21 07:00:00'),
(26687, 3, 3, 5.66, '2024-01-01 08:00:00'),
(26688, 3, 3, 5.46, '2024-01-11 08:00:00'),
(26689, 3, 3, 5.33, '2024-01-21 08:00:00'),
(26690, 3, 3, 5.26, '2024-01-31 08:00:00'),
(26691, 3, 3, 5.31, '2024-02-10 08:00:00'),
(26692, 3, 3, 5.78, '2024-02-20 08:00:00'),
(26693, 3, 3, 7.97, '2024-03-01 08:00:00'),
(26694, 3, 3, 7.49, '2024-03-11 07:00:00'),
(26695, 3, 3, 8.57, '2024-03-21 07:00:00'),
(26702, 4, 1, 6.50, '2024-01-01 08:00:00'),
(26703, 4, 1, 7.33, '2024-01-11 08:00:00'),
(26704, 4, 1, 7.15, '2024-01-21 08:00:00'),
(26705, 4, 1, 8.76, '2024-01-31 08:00:00'),
(26706, 4, 1, 7.35, '2024-02-10 08:00:00'),
(26707, 4, 1, 5.48, '2024-02-20 08:00:00'),
(26708, 4, 1, 5.35, '2024-03-01 08:00:00'),
(26709, 4, 1, 5.31, '2024-03-11 07:00:00'),
(26710, 4, 1, 5.51, '2024-03-21 07:00:00'),
(26717, 5, 2, 9.23, '2024-01-01 08:00:00'),
(26718, 5, 2, 6.15, '2024-01-11 08:00:00'),
(26719, 5, 2, 8.04, '2024-01-21 08:00:00'),
(26720, 5, 2, 6.76, '2024-01-31 08:00:00'),
(26721, 5, 2, 9.67, '2024-02-10 08:00:00'),
(26722, 5, 2, 8.07, '2024-02-20 08:00:00'),
(26723, 5, 2, 6.35, '2024-03-01 08:00:00'),
(26724, 5, 2, 7.52, '2024-03-11 07:00:00'),
(26725, 5, 2, 8.56, '2024-03-21 07:00:00'),
(26732, 6, 3, 5.50, '2024-01-01 08:00:00'),
(26733, 6, 3, 5.34, '2024-01-11 08:00:00'),
(26734, 6, 3, 5.19, '2024-01-21 08:00:00'),
(26735, 6, 3, 9.94, '2024-01-31 08:00:00'),
(26736, 6, 3, 9.13, '2024-02-10 08:00:00'),
(26737, 6, 3, 5.81, '2024-02-20 08:00:00'),
(26738, 6, 3, 6.69, '2024-03-01 08:00:00'),
(26739, 6, 3, 6.02, '2024-03-11 07:00:00'),
(26740, 6, 3, 5.03, '2024-03-21 07:00:00'),
(26747, 7, 1, 5.10, '2024-01-01 08:00:00'),
(26748, 7, 1, 5.84, '2024-01-11 08:00:00'),
(26749, 7, 1, 8.91, '2024-01-21 08:00:00'),
(26750, 7, 1, 7.02, '2024-01-31 08:00:00'),
(26751, 7, 1, 8.37, '2024-02-10 08:00:00'),
(26752, 7, 1, 5.77, '2024-02-20 08:00:00'),
(26753, 7, 1, 8.75, '2024-03-01 08:00:00'),
(26754, 7, 1, 6.46, '2024-03-11 07:00:00'),
(26755, 7, 1, 6.02, '2024-03-21 07:00:00'),
(26762, 8, 2, 8.73, '2024-01-01 08:00:00'),
(26763, 8, 2, 7.53, '2024-01-11 08:00:00'),
(26764, 8, 2, 6.43, '2024-01-21 08:00:00'),
(26765, 8, 2, 9.59, '2024-01-31 08:00:00'),
(26766, 8, 2, 8.66, '2024-02-10 08:00:00'),
(26767, 8, 2, 9.53, '2024-02-20 08:00:00'),
(26768, 8, 2, 6.67, '2024-03-01 08:00:00'),
(26769, 8, 2, 9.77, '2024-03-11 07:00:00'),
(26770, 8, 2, 8.83, '2024-03-21 07:00:00'),
(26777, 9, 3, 9.84, '2024-01-01 08:00:00'),
(26778, 9, 3, 9.65, '2024-01-11 08:00:00'),
(26779, 9, 3, 8.74, '2024-01-21 08:00:00'),
(26780, 9, 3, 9.75, '2024-01-31 08:00:00'),
(26781, 9, 3, 7.53, '2024-02-10 08:00:00'),
(26782, 9, 3, 8.40, '2024-02-20 08:00:00'),
(26783, 9, 3, 9.39, '2024-03-01 08:00:00'),
(26784, 9, 3, 6.78, '2024-03-11 07:00:00'),
(26785, 9, 3, 5.72, '2024-03-21 07:00:00'),
(26792, 10, 1, 8.35, '2024-01-01 08:00:00'),
(26793, 10, 1, 8.51, '2024-01-11 08:00:00'),
(26794, 10, 1, 7.46, '2024-01-21 08:00:00'),
(26795, 10, 1, 6.79, '2024-01-31 08:00:00'),
(26796, 10, 1, 6.58, '2024-02-10 08:00:00'),
(26797, 10, 1, 7.52, '2024-02-20 08:00:00'),
(26798, 10, 1, 7.87, '2024-03-01 08:00:00'),
(26799, 10, 1, 6.77, '2024-03-11 07:00:00'),
(26800, 10, 1, 5.25, '2024-03-21 07:00:00'),
(26807, 11, 2, 9.48, '2024-01-01 08:00:00'),
(26808, 11, 2, 5.10, '2024-01-11 08:00:00'),
(26809, 11, 2, 7.04, '2024-01-21 08:00:00'),
(26810, 11, 2, 9.89, '2024-01-31 08:00:00'),
(26811, 11, 2, 8.35, '2024-02-10 08:00:00'),
(26812, 11, 2, 7.05, '2024-02-20 08:00:00'),
(26813, 11, 2, 5.23, '2024-03-01 08:00:00'),
(26814, 11, 2, 9.98, '2024-03-11 07:00:00'),
(26815, 11, 2, 9.22, '2024-03-21 07:00:00'),
(26822, 12, 3, 5.37, '2024-01-01 08:00:00'),
(26823, 12, 3, 5.14, '2024-01-11 08:00:00'),
(26824, 12, 3, 9.59, '2024-01-21 08:00:00'),
(26825, 12, 3, 7.51, '2024-01-31 08:00:00'),
(26826, 12, 3, 8.78, '2024-02-10 08:00:00'),
(26827, 12, 3, 6.37, '2024-02-20 08:00:00'),
(26828, 12, 3, 5.51, '2024-03-01 08:00:00'),
(26829, 12, 3, 8.45, '2024-03-11 07:00:00'),
(26830, 12, 3, 5.71, '2024-03-21 07:00:00'),
(26837, 13, 1, 6.25, '2024-01-01 08:00:00'),
(26838, 13, 1, 5.65, '2024-01-11 08:00:00'),
(26839, 13, 1, 9.49, '2024-01-21 08:00:00'),
(26840, 13, 1, 5.53, '2024-01-31 08:00:00'),
(26841, 13, 1, 9.16, '2024-02-10 08:00:00'),
(26842, 13, 1, 9.22, '2024-02-20 08:00:00'),
(26843, 13, 1, 8.62, '2024-03-01 08:00:00'),
(26844, 13, 1, 5.42, '2024-03-11 07:00:00'),
(26845, 13, 1, 6.26, '2024-03-21 07:00:00'),
(26852, 14, 2, 8.84, '2024-01-01 08:00:00'),
(26853, 14, 2, 9.45, '2024-01-11 08:00:00'),
(26854, 14, 2, 5.76, '2024-01-21 08:00:00'),
(26855, 14, 2, 5.43, '2024-01-31 08:00:00'),
(26856, 14, 2, 9.88, '2024-02-10 08:00:00'),
(26857, 14, 2, 8.11, '2024-02-20 08:00:00'),
(26858, 14, 2, 5.91, '2024-03-01 08:00:00'),
(26859, 14, 2, 5.20, '2024-03-11 07:00:00'),
(26860, 14, 2, 8.30, '2024-03-21 07:00:00'),
(26867, 15, 3, 9.61, '2024-01-01 08:00:00'),
(26868, 15, 3, 9.97, '2024-01-11 08:00:00'),
(26869, 15, 3, 6.02, '2024-01-21 08:00:00'),
(26870, 15, 3, 5.17, '2024-01-31 08:00:00'),
(26871, 15, 3, 7.79, '2024-02-10 08:00:00'),
(26872, 15, 3, 8.47, '2024-02-20 08:00:00'),
(26873, 15, 3, 8.95, '2024-03-01 08:00:00'),
(26874, 15, 3, 9.33, '2024-03-11 07:00:00'),
(26875, 15, 3, 9.82, '2024-03-21 07:00:00'),
(26882, 16, 1, 6.87, '2024-01-01 08:00:00'),
(26883, 16, 1, 9.70, '2024-01-11 08:00:00'),
(26884, 16, 1, 7.89, '2024-01-21 08:00:00'),
(26885, 16, 1, 5.34, '2024-01-31 08:00:00'),
(26886, 16, 1, 8.02, '2024-02-10 08:00:00'),
(26887, 16, 1, 9.07, '2024-02-20 08:00:00'),
(26888, 16, 1, 6.32, '2024-03-01 08:00:00'),
(26889, 16, 1, 9.36, '2024-03-11 07:00:00'),
(26890, 16, 1, 7.86, '2024-03-21 07:00:00'),
(26897, 17, 2, 5.85, '2024-01-01 08:00:00'),
(26898, 17, 2, 7.01, '2024-01-11 08:00:00'),
(26899, 17, 2, 7.50, '2024-01-21 08:00:00'),
(26900, 17, 2, 6.45, '2024-01-31 08:00:00'),
(26901, 17, 2, 9.77, '2024-02-10 08:00:00'),
(26902, 17, 2, 9.47, '2024-02-20 08:00:00'),
(26903, 17, 2, 8.07, '2024-03-01 08:00:00'),
(26904, 17, 2, 6.92, '2024-03-11 07:00:00'),
(26905, 17, 2, 5.39, '2024-03-21 07:00:00'),
(26912, 18, 3, 9.71, '2024-01-01 08:00:00'),
(26913, 18, 3, 9.99, '2024-01-11 08:00:00'),
(26914, 18, 3, 5.79, '2024-01-21 08:00:00'),
(26915, 18, 3, 8.99, '2024-01-31 08:00:00'),
(26916, 18, 3, 7.60, '2024-02-10 08:00:00'),
(26917, 18, 3, 6.02, '2024-02-20 08:00:00'),
(26918, 18, 3, 7.29, '2024-03-01 08:00:00'),
(26919, 18, 3, 8.38, '2024-03-11 07:00:00'),
(26920, 18, 3, 5.04, '2024-03-21 07:00:00'),
(26927, 19, 1, 6.01, '2024-01-01 08:00:00'),
(26928, 19, 1, 9.71, '2024-01-11 08:00:00'),
(26929, 19, 1, 5.50, '2024-01-21 08:00:00'),
(26930, 19, 1, 8.38, '2024-01-31 08:00:00'),
(26931, 19, 1, 5.40, '2024-02-10 08:00:00'),
(26932, 19, 1, 6.85, '2024-02-20 08:00:00'),
(26933, 19, 1, 8.04, '2024-03-01 08:00:00'),
(26934, 19, 1, 9.65, '2024-03-11 07:00:00'),
(26935, 19, 1, 9.14, '2024-03-21 07:00:00'),
(26942, 20, 2, 6.58, '2024-01-01 08:00:00'),
(26943, 20, 2, 8.10, '2024-01-11 08:00:00'),
(26944, 20, 2, 5.77, '2024-01-21 08:00:00'),
(26945, 20, 2, 9.53, '2024-01-31 08:00:00'),
(26946, 20, 2, 5.34, '2024-02-10 08:00:00'),
(26947, 20, 2, 8.13, '2024-02-20 08:00:00'),
(26948, 20, 2, 9.61, '2024-03-01 08:00:00'),
(26949, 20, 2, 8.68, '2024-03-11 07:00:00'),
(26950, 20, 2, 9.58, '2024-03-21 07:00:00'),
(26957, 21, 3, 5.72, '2024-01-01 08:00:00'),
(26958, 21, 3, 8.63, '2024-01-11 08:00:00'),
(26959, 21, 3, 6.03, '2024-01-21 08:00:00'),
(26960, 21, 3, 9.23, '2024-01-31 08:00:00'),
(26961, 21, 3, 8.05, '2024-02-10 08:00:00'),
(26962, 21, 3, 7.59, '2024-02-20 08:00:00'),
(26963, 21, 3, 8.78, '2024-03-01 08:00:00'),
(26964, 21, 3, 6.13, '2024-03-11 07:00:00'),
(26965, 21, 3, 9.33, '2024-03-21 07:00:00'),
(26972, 22, 1, 9.23, '2024-01-01 08:00:00'),
(26973, 22, 1, 7.01, '2024-01-11 08:00:00'),
(26974, 22, 1, 7.38, '2024-01-21 08:00:00'),
(26975, 22, 1, 5.88, '2024-01-31 08:00:00'),
(26976, 22, 1, 7.23, '2024-02-10 08:00:00'),
(26977, 22, 1, 8.53, '2024-02-20 08:00:00'),
(26978, 22, 1, 5.96, '2024-03-01 08:00:00'),
(26979, 22, 1, 9.20, '2024-03-11 07:00:00'),
(26980, 22, 1, 8.12, '2024-03-21 07:00:00'),
(26987, 23, 2, 6.28, '2024-01-01 08:00:00'),
(26988, 23, 2, 5.96, '2024-01-11 08:00:00'),
(26989, 23, 2, 5.96, '2024-01-21 08:00:00'),
(26990, 23, 2, 6.91, '2024-01-31 08:00:00'),
(26991, 23, 2, 6.66, '2024-02-10 08:00:00'),
(26992, 23, 2, 7.60, '2024-02-20 08:00:00'),
(26993, 23, 2, 8.02, '2024-03-01 08:00:00'),
(26994, 23, 2, 7.29, '2024-03-11 07:00:00'),
(26995, 23, 2, 7.37, '2024-03-21 07:00:00'),
(27002, 24, 3, 8.24, '2024-01-01 08:00:00'),
(27003, 24, 3, 8.81, '2024-01-11 08:00:00'),
(27004, 24, 3, 9.30, '2024-01-21 08:00:00'),
(27005, 24, 3, 5.09, '2024-01-31 08:00:00'),
(27006, 24, 3, 7.54, '2024-02-10 08:00:00'),
(27007, 24, 3, 7.44, '2024-02-20 08:00:00'),
(27008, 24, 3, 9.57, '2024-03-01 08:00:00'),
(27009, 24, 3, 5.53, '2024-03-11 07:00:00'),
(27010, 24, 3, 8.93, '2024-03-21 07:00:00'),
(27017, 25, 1, 5.16, '2024-01-01 08:00:00'),
(27018, 25, 1, 6.34, '2024-01-11 08:00:00'),
(27019, 25, 1, 6.20, '2024-01-21 08:00:00'),
(27020, 25, 1, 6.99, '2024-01-31 08:00:00'),
(27021, 25, 1, 6.35, '2024-02-10 08:00:00'),
(27022, 25, 1, 5.77, '2024-02-20 08:00:00'),
(27023, 25, 1, 9.82, '2024-03-01 08:00:00'),
(27024, 25, 1, 6.79, '2024-03-11 07:00:00'),
(27025, 25, 1, 9.47, '2024-03-21 07:00:00'),
(27032, 26, 2, 9.67, '2024-01-01 08:00:00'),
(27033, 26, 2, 5.97, '2024-01-11 08:00:00'),
(27034, 26, 2, 5.84, '2024-01-21 08:00:00'),
(27035, 26, 2, 6.32, '2024-01-31 08:00:00'),
(27036, 26, 2, 9.04, '2024-02-10 08:00:00'),
(27037, 26, 2, 6.28, '2024-02-20 08:00:00'),
(27038, 26, 2, 9.25, '2024-03-01 08:00:00'),
(27039, 26, 2, 7.40, '2024-03-11 07:00:00'),
(27040, 26, 2, 9.28, '2024-03-21 07:00:00'),
(27047, 27, 3, 6.95, '2024-01-01 08:00:00'),
(27048, 27, 3, 9.80, '2024-01-11 08:00:00'),
(27049, 27, 3, 8.16, '2024-01-21 08:00:00'),
(27050, 27, 3, 6.41, '2024-01-31 08:00:00'),
(27051, 27, 3, 7.56, '2024-02-10 08:00:00'),
(27052, 27, 3, 8.57, '2024-02-20 08:00:00'),
(27053, 27, 3, 5.18, '2024-03-01 08:00:00'),
(27054, 27, 3, 5.20, '2024-03-11 07:00:00'),
(27055, 27, 3, 5.46, '2024-03-21 07:00:00'),
(27062, 28, 1, 6.53, '2024-01-01 08:00:00'),
(27063, 28, 1, 8.65, '2024-01-11 08:00:00'),
(27064, 28, 1, 8.68, '2024-01-21 08:00:00'),
(27065, 28, 1, 7.44, '2024-01-31 08:00:00'),
(27066, 28, 1, 6.16, '2024-02-10 08:00:00'),
(27067, 28, 1, 8.49, '2024-02-20 08:00:00'),
(27068, 28, 1, 8.97, '2024-03-01 08:00:00'),
(27069, 28, 1, 9.38, '2024-03-11 07:00:00'),
(27070, 28, 1, 9.97, '2024-03-21 07:00:00'),
(27077, 29, 2, 8.20, '2024-01-01 08:00:00'),
(27078, 29, 2, 6.22, '2024-01-11 08:00:00'),
(27079, 29, 2, 6.50, '2024-01-21 08:00:00'),
(27080, 29, 2, 8.84, '2024-01-31 08:00:00'),
(27081, 29, 2, 9.70, '2024-02-10 08:00:00'),
(27082, 29, 2, 6.97, '2024-02-20 08:00:00'),
(27083, 29, 2, 5.77, '2024-03-01 08:00:00'),
(27084, 29, 2, 7.92, '2024-03-11 07:00:00'),
(27085, 29, 2, 7.31, '2024-03-21 07:00:00'),
(27092, 30, 3, 7.57, '2024-01-01 08:00:00'),
(27093, 30, 3, 8.36, '2024-01-11 08:00:00'),
(27094, 30, 3, 9.11, '2024-01-21 08:00:00'),
(27095, 30, 3, 5.45, '2024-01-31 08:00:00'),
(27096, 30, 3, 9.91, '2024-02-10 08:00:00'),
(27097, 30, 3, 8.22, '2024-02-20 08:00:00'),
(27098, 30, 3, 6.36, '2024-03-01 08:00:00'),
(27099, 30, 3, 7.15, '2024-03-11 07:00:00'),
(27100, 30, 3, 6.65, '2024-03-21 07:00:00'),

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL
  `Price` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`ProductID`, `ProductName`, `CategoryID`, `Photo`) VALUES
(1, 'Tomatoes', 2, 'img/1.jpg'),
(2, 'Tomatoes', 2, 'img/2.jpg'),
(3, 'Tomatoes', 2, 'img/3.jpg'),
(4, 'Bananas', 1, 'img/4.jpg'),
(5, 'Bananas', 1, 'img/5.jpg'),
(6, 'Bananas', 1, 'img/6.jpg'),
(7, 'Cheddar Cheese', 3, 'img/7.jpg'),
(8, 'Cheddar Cheese', 3, 'img/8.jpg'),
(9, 'Cheddar Cheese', 3, 'img/9.jpg'),
(10, 'Ribeye', 4, 'img/10.jpg'),
(11, 'Ribeye', 4, 'img/11.jpg'),
(12, 'Ribeye', 4, 'img/12.jpg'),
(13, 'Cookies', 5, 'img/13.jpg'),
(14, 'Cookies', 5, 'img/14.jpg'),
(15, 'Cookies', 5, 'img/15.jpg'),
(16, 'Dino Nuggets', 7, 'img/16.jpg'),
(17, 'Dino Nuggets', 7, 'img/17.jpg'),
(18, 'Dino Nuggets', 7, 'img/18.jpg'),
(19, 'Orange Juice', 8, 'img/19.jpg'),
(20, 'Orange Juice', 8, 'img/20.jpg'),
(21, 'Orange Juice', 8, 'img/21.jpg'),
(22, 'Potato Chips', 9, 'img/22.jpg'),
(23, 'Potato Chips', 9, 'img/23.jpg'),
(24, 'Potato Chips', 9, 'img/24.jpg'),
(25, 'Ketchup', 10, 'img/25.jpg'),
(26, 'Ketchup', 10, 'img/26.jpg'),
(27, 'Ketchup', 10, 'img/27.jpg'),
(28, 'Chickpeas', 6, 'img/28.jpg'),
(29, 'Chickpeas', 6, 'img/29.jpg'),
(30, 'Chickpeas', 6, 'img/30.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ProductStores`
--

CREATE TABLE `ProductStores` (
  `ProductID` int(11) NOT NULL,
  `StoreID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ProductStores`
--

INSERT INTO `ProductStores` (`ProductID`, `StoreID`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 1),
(5, 2),
(6, 3),
(7, 1),
(8, 2),
(9, 3),
(10, 1),
(11, 2),
(12, 3),
(13, 1),
(14, 2),
(15, 3),
(16, 1),
(17, 2),
(18, 3),
(19, 1),
(20, 2),
(21, 3),
(22, 1),
(23, 2),
(24, 3),
(25, 1),
(26, 2),
(27, 3),
(28, 1),
(29, 2),
(30, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Stores`
--

CREATE TABLE `Stores` (
  `StoreID` int(11) NOT NULL,
  `StoreName` varchar(100) NOT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `StorePhoto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Stores`
--

INSERT INTO `Stores` (`StoreID`, `StoreName`, `Location`, `StorePhoto`) VALUES
(1, 'Fresh Mart', '123 Main Street, Kelowna', 'img/31.jpg'),
(2, 'Green Basket', '456 Elm Avenue, Vernon', 'img/32.jpg'),
(3, 'Natures Harvest', '789 Oak Road, Richmond', 'img/33.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
-- DEFAULT USER: USERID - 1, Username - COSC360, Password - COSC360, Email - COSC360@ubc.ca

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL,
  `UserType` varchar(50) DEFAULT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `RegistrationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `ProfilePicture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--Default Admin: ID - 1, Username - Admin, Password - Admin, Email - Admin@ubc.ca 
CREATE TABLE `Admin` (
  `AdminID` int(11) NOT NULL,
  `AdminUserType` varchar(50) DEFAULT NULL,
  `AdminUsername` varchar(50) NOT NULL,
  `AdminPassword` varchar(100) NOT NULL,
  `AdminEmail` varchar(100) NOT NULL,
  `RegistrationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `ProfilePicture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`CategoryID`),
  ADD UNIQUE KEY `CategoryName` (`CategoryName`);

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Prices`
--
ALTER TABLE `Prices`
  ADD PRIMARY KEY (`PriceID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `StoreID` (`StoreID`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `ProductStores`
--
ALTER TABLE `ProductStores`
  ADD PRIMARY KEY (`ProductID`,`StoreID`),
  ADD KEY `StoreID` (`StoreID`);

--
-- Indexes for table `Stores`
--
ALTER TABLE `Stores`
  ADD PRIMARY KEY (`StoreID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Prices`
--
ALTER TABLE `Prices`
  MODIFY `PriceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27107;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `Stores`
--
ALTER TABLE `Stores`
  MODIFY `StoreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `Products` (`ProductID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `Prices`
--
ALTER TABLE `Prices`
  ADD CONSTRAINT `prices_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `Products` (`ProductID`),
  ADD CONSTRAINT `prices_ibfk_2` FOREIGN KEY (`StoreID`) REFERENCES `Stores` (`StoreID`);

--
-- Constraints for table `Products`
--
ALTER TABLE `Products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `Categories` (`CategoryID`);

--
-- Constraints for table `ProductStores`
--
ALTER TABLE `ProductStores`
  ADD CONSTRAINT `productstores_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `Products` (`ProductID`),
  ADD CONSTRAINT `productstores_ibfk_2` FOREIGN KEY (`StoreID`) REFERENCES `Stores` (`StoreID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


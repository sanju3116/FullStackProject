-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 10, 2024 at 12:20 PM
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
-- Database: `mydb2`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `mno` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` int(6) NOT NULL,
  `state` text NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `middlename`, `lastname`, `mno`, `city`, `pincode`, `state`, `filename`) VALUES
(69, 'sanjana', 'narendra', 'dasa', '9156819992', 'Pune', 411002, 'Maharashtra', ''),
(70, 'Arya', 'ashok', 'thakar', '9156819991', 'Pune', 411002, 'Maharashtra', ''),
(71, 'sanjana', 'ashok', 'keskar', '9854784510', 'hydrabad', 411002, 'Maharashtra', ''),
(72, 'sanjana', 'pavan', 'dasa', '8741501247', 'Pune', 411002, 'Maharashtra', ''),
(73, 'tanvi', 'narendra', 'dasa', '9874521057', 'Pune', 411002, 'Maharashtra', ''),
(80, 'anjali', 'ashok', 'thakar', '8985214785', 'Pune', 411002, 'Maharashtra', ''),
(81, 'sanjana', 'narendra', 'as', '9852015780', 'Pune', 411002, 'Himachal Pradesh', ''),
(82, 'sanjana', 'ss', 'ss', '8978546217', 'Pune', 411002, 'Maharashtra', ''),
(83, 'aa', 'dd', 'ww', '8952458752', 'Pune', 411002, 'Maharashtra', ''),
(84, 'ss', 'rr', 'ww', '9856547852', 'Pune', 411002, 'Maharashtra', ''),
(85, 'ss', 'vv', 'dd', '8475421025', 'Pune', 411002, 'Maharashtra', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

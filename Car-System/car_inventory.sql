-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2024 at 08:40 PM
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
-- Database: `car_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `carinfo`
--

CREATE TABLE `carinfo` (
  `id` int(20) NOT NULL,
  `carType` varchar(20) NOT NULL,
  `carName` varchar(20) NOT NULL,
  `carModel` varchar(20) NOT NULL,
  `releaseYear` int(20) NOT NULL,
  `batteryCapacity` int(20) DEFAULT NULL,
  `fuelEfficiency` int(20) DEFAULT NULL,
  `carImage` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carinfo`
--

INSERT INTO `carinfo` (`id`, `carType`, `carName`, `carModel`, `releaseYear`, `batteryCapacity`, `fuelEfficiency`, `carImage`) VALUES
(1, 'ElectricCar', 'Tesla', 'Model S', 2022, 100, 0, 'Uploads/images.jpeg'),
(8, 'GasCar', 'Toyeta', 'Camry', 2022, 0, 30, 'Uploads/camry.png'),
(12, 'GasCar', 'Honda', '2022 Honda Civic', 2022, 0, 40, 'Uploads/honda.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carinfo`
--
ALTER TABLE `carinfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carinfo`
--
ALTER TABLE `carinfo`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

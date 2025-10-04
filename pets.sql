-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2025 at 01:27 PM
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
-- Database: `vet_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `pet_name` varchar(100) NOT NULL,
  `species` varchar(100) NOT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `owner_name` varchar(100) NOT NULL,
  `health_status` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `pet_name`, `species`, `breed`, `owner_name`, `health_status`, `image`, `created_at`) VALUES
(1, 'Luna', 'Dog', 'Aspin', 'Queen', 'Under Treatment', 'puppy.jpeg', '2025-10-04 10:41:57'),
(2, 'Rocky', 'Cat', 'Siamese', 'Addam', 'Needs Vaccination', 'Siamese.jpg', '2025-10-04 10:42:50'),
(3, 'Nics', 'Bird', 'Parrot', 'Josh', 'Pet has sustained an injury.', 'parrot.jpg', '2025-10-04 10:43:26'),
(4, 'Summer', 'Dog', 'Golden Retriever', 'Christine', 'Need Booster shot', 'Golden Retriver.png', '2025-10-04 10:44:10'),
(5, 'Rambutan', 'Guinei Pig', '', 'Zion', 'Pet shows no signs of illness or injury.', 'guineapig.jpg', '2025-10-04 10:44:57'),
(6, ' Mans', 'Cat', 'Munchkin', 'Nelsan', 'Healthy', 'munchkin.jpg', '2025-10-04 10:45:48'),
(7, 'Kimpoy', 'Dog', 'Samoyed', 'Sofia', 'Pet is receiving ongoing medical care.', 'samoyed_puppy.jpg', '2025-10-04 10:46:43'),
(8, 'Chips', 'Atelerix albiventris', 'Hedgehog', 'Joy', 'Healthy', 'hedgehog.jpg', '2025-10-04 10:48:46'),
(9, 'Bambam', 'Rabbit', 'Mini Rex', 'Faye', 'Pregnant', 'Bunny.jpg', '2025-10-04 10:51:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

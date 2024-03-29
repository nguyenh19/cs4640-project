-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 27, 2022 at 03:42 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs4640proj`
--

-- --------------------------------------------------------

--
-- Table structure for table `clothing`
--

CREATE TABLE `clothing` (
  `clothing_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `picture` longtext NOT NULL,
  `wishlist` tinyint(1) DEFAULT 0,
  `link` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clothing`
--

INSERT INTO `clothing` (`clothing_id`, `user_id`, `category`, `color`, `brand`, `name`, `picture`, `wishlist`, `link`) VALUES
(14, 38, 'Shirt', 'Green', 'Shein', 'red shirt', '_38_red_shirt.jpeg', 0, NULL),
(15, 38, 'Shirt', 'Green', 'Shein', 'green shirt', '_38_g_shirt.jpeg', 0, NULL),
(16, 38, 'Pants', 'Tan', 'LLBean', 'cargos', '_38_cargos.jpeg', 0, NULL),
(18, 38, 'Dress', 'Black', 'Skims', 'black dress', '_38_dress.jpeg', 0, NULL),
(27, 38, 'Shoes', 'White', 'Adidas', 'superstars', '_38_shoes.jpeg', 0, NULL),
(28, 38, 'Hat', 'Red', 'tuff', 'red hat', '_38_hat.jpg', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `custom_tags`
--

CREATE TABLE `custom_tags` (
  `clothing_id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `outfits`
--

CREATE TABLE `outfits` (
  `outfit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hat_id` int(11) DEFAULT NULL,
  `shirt_id` int(11) DEFAULT NULL,
  `outerwear_id` int(11) DEFAULT NULL,
  `pants_id` int(11) DEFAULT NULL,
  `shoes_id` int(11) DEFAULT NULL,
  `dress_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(38, 'Hien Nguyen', 'htn9zzb@virginia.edu', '$2y$10$L98jrjmtIBYCiRFgiK7rcuQwl.hdAhFdhwlpFOdptKhVerOc1QbGa'),
(39, 'asdf', 'nguyen.h19t@gmail.com', '$2y$10$fba/5rPJUwpD8VkxRRFj1Oq122leGhAVPBxL568qVCun0YYDHv.sW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clothing`
--
ALTER TABLE `clothing`
  ADD PRIMARY KEY (`clothing_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `custom_tags`
--
ALTER TABLE `custom_tags`
  ADD KEY `clothing_id` (`clothing_id`);

--
-- Indexes for table `outfits`
--
ALTER TABLE `outfits`
  ADD PRIMARY KEY (`outfit_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clothing`
--
ALTER TABLE `clothing`
  MODIFY `clothing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `outfits`
--
ALTER TABLE `outfits`
  MODIFY `outfit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clothing`
--
ALTER TABLE `clothing`
  ADD CONSTRAINT `clothing_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `custom_tags`
--
ALTER TABLE `custom_tags`
  ADD CONSTRAINT `custom_tags_ibfk_1` FOREIGN KEY (`clothing_id`) REFERENCES `clothing` (`clothing_id`);

--
-- Constraints for table `outfits`
--
ALTER TABLE `outfits`
  ADD CONSTRAINT `outfits_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

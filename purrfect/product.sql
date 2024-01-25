-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 25, 2024 at 05:52 PM
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
-- Database: `purrfect`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `product_name` varchar(70) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_group` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `image_url`, `product_name`, `product_desc`, `product_price`, `product_group`) VALUES
(2, './images/Petfood/Canned Food/Special Cat - Beef and Liver.png', 'Special Cat - Beef and Liver', 'This is a delicious canned cat food made with beef and liver.', 19.99, 'food'),
(3, './images/Health and wellness products/Ascorbic Acid - Canicee.png', 'Ascorbic Acid - Canicee', 'Product description', 19.99, 'health'),
(4, './images/Others/Collars/Cat Harness and Leash - Black.png', 'Cat Harness and Leash - Black', 'Product description', 19.99, 'accessory'),
(6, './images/Grooming supplies/Bearing - Tick and Flea Dog Shampoo.png', 'Bearing - Tick and Flea Dog Shampoo', 'Product description', 19.99, 'supplies'),
(7, './images/Toys for various pets/Cat Toy Roller Ball Track Tower.png', 'Cat Toy Roller Ball Track Tower', 'Product Desc', 19.99, 'toy'),
(8, './images/Others/Collars/Cat Harness and Leash - Blue.png', 'Cat Harness and Leash - Blue', 'Product description', 29.99, 'accessory'),
(9, './images/Petfood/Canned Food/Pedigree - Beef.png', 'Pedigree - Beef', 'This is a delicious dog food made with beef.', 29.99, 'food'),
(10, './images/Petfood/Dry Food/Alpo Adult.png', 'Alpo Adult', 'Product description', 39.99, 'food'),
(11, './images/Petfood/Dry Food/Friskies - Kitten.png', 'Friskies - Kitten', 'Product description', 49.99, 'food'),
(12, './images/Petfood/Treats/Doggo Dog Treats.png', 'Doggo Dog Treats', 'Product Description', 9.99, 'food'),
(13, './images/Petfood/Treats/Dreamies - Tasty Chicken.png', 'Dreamies - Tasty Chicken', 'Product Description', 5.99, 'food'),
(14, './images/Health and wellness products/Beaphar - Multi-Vit Paste.png', 'Beaphar - Multi-Vit Paste', 'Product description', 29.99, 'health'),
(15, './images/Health and wellness products/LC-Vit Plus Syrup.png', 'LC-Vit Plus Syrup', 'Product description', 29.99, 'health'),
(16, './images/Health and wellness products/Nutri-Vet - Multi-Vite Cat Paw Gel.png', 'Nutri-Vet - Multi-Vite Cat Paw Gel', 'Product description', 29.99, 'health'),
(17, './images/Health and wellness products/Troy - Nutripet.png', 'Troy - Nutripet', 'Product description', 29.99, 'health'),
(18, 'https://assets.petco.com/petco/image/upload/c_pad,dpr_1.0,f_auto,q_auto,h_636,w_636/c_pad,h_636,w_636/3584056-center-1', 'VetriScience Laboratories Multivitamin for Cats', 'Product description', 29.99, 'health'),
(20, './images/Others/Collars/Cat Harness and Leash - Pink.png', 'Cat Harness and Leash - Pink', 'Product description', 29.99, 'accessory'),
(21, './images/Others/Collars/Dog Collar & Leash - Blue.png', 'Dog Collar and Leash - Blue', 'Product Description', 29.99, 'accessory'),
(22, './images/Others/Collars/Dog Collar & Leash - Pink.png', 'Dog Collar and Leash - Pink', 'Product description', 29.99, 'accessory'),
(23, './images/Others/Collars/Dog Collar & Leash - Purple.png', 'Dog Collar and Leash - Purple', 'Product description', 29.99, 'accessory'),
(25, './images/Toys for various pets/Knotted Rope Dog Toy.png', 'Knotted Rope Dog Toy', 'Product description', 29.99, 'toy'),
(26, './images/Toys for various pets/Kong Puppy Dog Toy.png', 'Kong Puppy Dog Toy', 'Product description', 29.99, 'toy'),
(27, './images/Toys for various pets/Linen Ball Cat Toy.png', 'Linen Ball Cat Toy', 'Pussy toy', 29.99, 'toy'),
(28, './images/Toys for various pets/Rubber Dog Ball.png', 'Rubber Dog Ball', 'Product Desc', 29.99, 'toy'),
(29, './images/Toys for various pets/Wooven and Feather Ball Cat Toy.png', 'Wooven and Feather Ball Cat Toy', 'Product description', 29.99, 'toy'),
(30, './images/Bedding and cages/Collapsible Pet Cage - Black.png', 'Collapsible Pet Cage - Black', 'Product description', 19.99, 'bedcage'),
(31, './images/Bedding and cages/Collapsible Pet Cage - Purple.png', 'Collapsible Pet Cage - Purple', 'Product Description', 29.99, 'bedcage'),
(32, './images/Bedding and cages/Cat Backpack - Pink.png', 'Cat Backpack - Pink', 'Product description', 29.99, 'bedcage'),
(33, './images/Bedding and cages/Cat Backpack - Black.png', 'Cat Backpack - Black', 'Product description', 29.99, 'bedcage'),
(34, './images/Bedding and cages/Pet Carrier - Black.png', 'Pet Carrier - Black', 'Product description', 29.99, 'bedcage'),
(35, './images/Bedding and cages/Pet Carrier - Brown.png', 'Pet Carrier - Brown', 'Product description', 29.99, 'bedcage'),
(36, './images/Grooming supplies/Nail Cutter and Trimmer - Blue.png', 'Nail Cutter and Trimmer - Blue', 'Product Description', 29.99, 'supplies'),
(37, './images/Grooming supplies/Oster Oatmeal Naturals - Dander Control.png', 'Oster Oatmeal Naturals - Dander Control', 'Product description', 29.99, 'supplies'),
(38, './images/Grooming supplies/Our Cat - Pink Rose Shampoo.png', 'Our Cat - Pink Rose Shampoo', 'Product description', 29.99, 'supplies'),
(39, './images/Grooming supplies/Our Dog - Aloe Vera Shampoo.png', 'Our Dog - Aloe Vera Shampoo', 'Product description', 29.99, 'supplies'),
(40, './images/Grooming supplies/Pet Hair Grooming Brush - Blue.png', 'Pet Hair Grooming Brush - Blue', 'Product Desc', 29.99, 'supplies'),
(41, './images/Others/Bowls/Ceramic Dog Bowl.png', 'Ceramic Dog Bowl', 'Product description', 19.99, 'utility'),
(42, './images/Others/Bowls/Concave Double Feeding Dog Bowl.png', 'Concave Double Feeding Dog Bowl', 'Product description', 29.99, 'utility'),
(43, './images/Others/Bowls/Elevated Cat Bowls.png', 'Elevated Cat Bowls', 'Product description', 29.99, 'utility'),
(44, './images/Others/Feline Fresh - Lavander.png', 'Feline Fresh - Lavander', 'adasdasdsa', 29.99, 'utility'),
(45, './images/Others/Jolly Cat - Espresso Cat Litter.png', 'Jolly Cat - Espresso Cat Litter', 'Product description', 29.99, 'utility'),
(46, './images/Others/Jolly Cat - Lemon Cat Litter.png', 'Jolly Cat - Lemon Cat Litter', 'Product description', 19.99, 'utility');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2024 at 11:11 AM
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
-- Database: `banhang_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `Username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `Username`, `Email`, `Password`, `Role`) VALUES
(4, 'admin', 'admin@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 2);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `BrandId` int(11) NOT NULL,
  `BrandName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`BrandId`, `BrandName`, `Image`, `Status`) VALUES
(102, 'VUS', '1680664151_cart-1.jpg', 1),
(103, 'FPT', '1680664167_thumb-3.jpg', 1),
(104, 'HUTECH', '1680664181_product-1.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryId` int(11) NOT NULL,
  `CategoryName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryId`, `CategoryName`, `status`) VALUES
(2, 'Cakes', 1),
(3, 'Donuts', 1),
(4, 'Butter Cakes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `ContactId` int(11) NOT NULL,
  `UserName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerId` int(11) NOT NULL,
  `Fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PhoneNumber` char(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `Email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Date_Login` datetime NOT NULL,
  `Date_Logout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerId`, `Fullname`, `Image`, `PhoneNumber`, `Address`, `Status`, `Email`, `Password`, `Date_Login`, `Date_Logout`) VALUES
(12, 'nguyen dinh hung', '', '', '', 0, '16.05.01h@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '2023-04-05 10:32:56', '2023-04-05 10:35:27'),
(14, 'an', '', '', '', 0, 'an@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', '2024-09-19 22:01:19', '0000-00-00 00:00:00'),
(15, 'nghia', '', '', '', 1, 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '2024-10-02 11:03:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `oders`
--

CREATE TABLE `oders` (
  `OderId` int(11) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `Note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order_date` datetime NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `number_phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `total_price` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `oders`
--

INSERT INTO `oders` (`OderId`, `CustomerId`, `Note`, `order_date`, `address`, `number_phone`, `status`, `total_price`) VALUES
(121, 15, ' ', '2024-09-20 11:29:50', 'cần thơ', '0123456789', 2, 195),
(123, 15, ' ', '2024-09-20 11:55:29', 'cần thơ', '0123456789', 2, 315),
(124, 15, ' ', '2024-09-30 20:48:49', 'cần thơ', '0123456789', 2, 195),
(132, 15, ' ', '2024-09-30 21:44:30', 'cần thơ', '0123456789', 2, 195),
(135, 15, ' ', '2024-09-30 21:50:13', 'cần thơ', '0123456789', 2, 195),
(136, 15, ' ', '2024-09-30 21:52:32', 'cần thơ', '0123456789', 2, 195),
(137, 15, ' ', '2024-09-30 21:52:52', 'cần thơ', '0123456789', 1, 195),
(143, 15, ' ', '2024-10-01 16:59:25', 'cần thơ', '0123456789', 2, 145000),
(144, 15, ' ', '2024-10-01 17:36:47', 'cần thơ', '0123456789', 0, 145000),
(145, 15, ' ', '2024-10-02 11:02:47', 'cần thơ', '0123456789', 0, 125000),
(146, 15, ' ', '2024-10-02 11:48:11', 'cần thơ', '0123456789', 0, 125000);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `Order_Detail_Id` int(11) NOT NULL,
  `Status` int(1) NOT NULL DEFAULT 1,
  `Price` float NOT NULL DEFAULT 0,
  `Quantity` int(11) NOT NULL DEFAULT 0,
  `ProductId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`Order_Detail_Id`, `Status`, `Price`, `Quantity`, `ProductId`) VALUES
(105, 1, 195, 2, 34),
(105, 1, 150, 1, 29),
(106, 1, 150, 1, 29),
(106, 1, 195, 1, 34),
(107, 1, 150, 1, 29),
(107, 1, 195, 1, 34),
(108, 1, 195, 1, 34),
(109, 1, 195, 1, 34),
(110, 1, 145, 1, 37),
(111, 1, 195, 1, 34),
(112, 1, 195, 1, 34),
(113, 1, 195, 1, 34),
(114, 1, 195, 1, 34),
(115, 1, 195, 1, 34),
(116, 1, 195, 1, 34),
(116, 1, 150, 1, 30),
(117, 1, 150, 1, 30),
(118, 1, 150, 1, 30),
(119, 1, 150, 1, 30),
(120, 1, 150, 1, 30),
(121, 1, 195, 1, 34),
(122, 1, 195, 1, 34),
(122, 1, 120, 1, 32),
(123, 1, 195, 1, 34),
(123, 1, 120, 1, 32),
(124, 1, 195, 1, 34),
(125, 1, 195, 2, 34),
(126, 1, 195, 1, 34),
(127, 1, 195, 1, 34),
(128, 1, 195, 1, 34),
(129, 1, 195, 1, 34),
(130, 1, 195, 2, 34),
(131, 1, 195, 1, 34),
(132, 1, 195, 1, 34),
(133, 1, 195000, 1, 34),
(134, 1, 195000, 1, 34),
(135, 1, 195, 1, 34),
(136, 1, 195, 1, 34),
(137, 1, 195, 1, 34),
(138, 1, 195, 1, 34),
(139, 1, 195000, 1, 34),
(140, 1, 145, 1, 36),
(141, 1, 195000, 1, 34),
(142, 1, 145000, 1, 36),
(143, 1, 145000, 1, 36),
(144, 1, 145000, 1, 36),
(145, 1, 125000, 1, 34),
(146, 1, 125000, 1, 34);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductId` int(11) NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `BuyPrice` float NOT NULL,
  `SellPrice` float NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `CountView` int(11) NOT NULL DEFAULT 0,
  `CategoriId` int(11) NOT NULL,
  `BrandId` int(11) NOT NULL,
  `is_accept` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductId`, `Name`, `Image`, `Quantity`, `Description`, `BuyPrice`, `SellPrice`, `Status`, `CountView`, `CategoriId`, `BrandId`, `is_accept`) VALUES
(29, 'DOZEN CUPCAKES', '78a12b39aa.product-12.jpg', 10, 'Các thành phần chính của bánh bao gồm: Bột mì đa dụng, rây mịn, cà phê, bột nở, bơ nhạt, ở nhiệt độ phòng.đường cát, trứng, sữa,chiết xuất vani.', 50000, 190000, 1, 14, 2, 102, 1),
(30, 'COOKIES AND CREAM', '1680664637_product-2.jpg', 10, 'Các thành phần chính của bánh bao gồm: Kem Cookies and Cream 2 thành phần này cực kỳ dễ làm và cực kỳ ngon. Kem béo ngậy, mịn màng và có nhiều bánh quy sô cô la giòn rải rác khắp nơi.', 50000, 195000, 1, 13, 3, 102, 1),
(31, 'GLUTEN FREE MINI DOZEN', '1680664680_product-3.jpg', 10, 'Các thành phần chính của bánh bao gồm: Dừa, đậu nành, yến mạch nguyên hạt, bơ đậu phộng, bí ngô, trứng.', 50000, 130000, 1, 9, 3, 103, 1),
(32, 'COOKIE DOUGH', '1680664712_product-4.jpg', 10, 'Các thành phần chính của bánh bao gồm: Bơ nhạt, đường cát, đường nâu nhạt, sữa, chiết xuất vani, bột mì đa dụng, muối,sô cô la chip nhỏ.', 50000, 120000, 1, 10, 4, 104, 1),
(33, 'GERMAN CHOCOLATE', '1680664758_product-6.jpg', 10, 'Các thành phần chính của bánh bao gồm: Bơ nhạt, trứng, bột mì tự nở, bột ca cao, cà phê bột nở, cà phê chiết xuất vani, sữa, đường cát vàng.', 50000, 160000, 1, 7, 2, 102, 1),
(34, 'DULCE DE LECHE', '1680664793_product-7.jpg', 10, 'Các thành phần chính của bánh bao gồm: Bột, đường, trứng, bơ hoặc dầu hoặc bơ thực vật, một chất lỏng và các chất men, như baking soda hoặc bột nở.', 50000, 125000, 1, 84, 2, 102, 1),
(35, 'SWEET CELTICS', '1680664829_product-10.jpg', 10, 'Các thành phần chính của bánh bao gồm: Bột mì thường, cà phê, bột ca cao, đường, trứng, xi-rô, dầu hướng dương,sữa.', 50000, 115000, 1, 8, 4, 102, 1),
(36, 'SWEET AUTUMN LEAVES', '1680664875_product-9.jpg', 10, 'Các thành phần chính của bánh bao gồm: Trứng, bơ, sữa, đường, vani, kem tươi, chocolate, trái cây tươi.', 50000, 110000, 1, 26, 2, 104, 1),
(37, 'PALE YELLOW SWEET', '1680664926_product-12.jpg', 10, 'Các thành phần chính của bánh bao gồm: Bột mì đa dụng, cà phê bột nở, cốc đường cát, bơ, cà phê vani, trứng, sữa.', 50000, 125000, 1, 7, 2, 103, 1),
(38, 'VEGAN/GLUTEN FREE', '1680664959_product-9.jpg', 10, 'Các thành phần chính của bánh bao gồm: Bột hạnh nhân, bánh mì đa dụng, đường, sữa, bột nở, muối, sữa hạnh nhân, vani.', 50000, 145000, 1, 4, 3, 102, 1),
(39, 'DOZEN CUPCAKES 01', '1680665022_product-big-4.jpg', 10, 'Các thành phần chính bao gồm: Bơ, đường, trứng, bột mì, sữa, kem chua, lòng trắng trứng, chiết xuất hạnh nhân.', 50000, 135000, 1, 2, 2, 103, 1),
(40, 'SWEET AUTUMN LEAVES', '1680665053_product-big-1.jpg', 10, 'Các thành phần chính của bánh bao gồm: Bột mì đa dụng, đường cát, cà phê bột nở, cà phê muối, cà phê quế xay, cà phê hạt nhục đậu khấu xay, bơ mềm, sữa, cà phê chiết xuất vani nguyên chất, trứng.', 50000, 185000, 1, 8, 3, 102, 1);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `ReceiptId` int(11) NOT NULL,
  `ImportDate` date NOT NULL,
  `Quantity` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `RoleId` int(11) NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`RoleId`, `Name`, `Description`) VALUES
(1, 'Admin', 'Control everything'),
(2, 'SubAdmin', 'Control less than Admin\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `WishListId` int(11) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Role` (`Role`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`BrandId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`ContactId`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerId`);

--
-- Indexes for table `oders`
--
ALTER TABLE `oders`
  ADD PRIMARY KEY (`OderId`),
  ADD KEY `FK_Customer_Id` (`CustomerId`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD KEY `ProductId` (`ProductId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductId`),
  ADD KEY `FK_Brand_Id` (`BrandId`),
  ADD KEY `FK_Categori_Id` (`CategoriId`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`ReceiptId`),
  ADD KEY `FK_Product_Id` (`ProductId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`RoleId`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`WishListId`),
  ADD KEY `CustomerId` (`CustomerId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `BrandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `ContactId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `oders`
--
ALTER TABLE `oders`
  MODIFY `OderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `ReceiptId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `RoleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `WishListId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`Role`) REFERENCES `roles` (`RoleId`);

--
-- Constraints for table `oders`
--
ALTER TABLE `oders`
  ADD CONSTRAINT `FK_Customer_Id` FOREIGN KEY (`CustomerId`) REFERENCES `customers` (`CustomerId`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `FK_Product_Id_01` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_Brand_Id` FOREIGN KEY (`BrandId`) REFERENCES `brands` (`BrandId`),
  ADD CONSTRAINT `FK_Categori_Id` FOREIGN KEY (`CategoriId`) REFERENCES `category` (`CategoryId`);

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `FK_Product_Id` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `CustomerId` FOREIGN KEY (`CustomerId`) REFERENCES `customers` (`CustomerId`),
  ADD CONSTRAINT `ProductId` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

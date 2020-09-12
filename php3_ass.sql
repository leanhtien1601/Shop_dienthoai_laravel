-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2020 at 06:30 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php3_ass`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `image` text NOT NULL,
  `gmail` varchar(250) NOT NULL,
  `id_role` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `image`, `gmail`, `id_role`) VALUES
(1, 'lê anh tiến', '$2y$10$cwbDtbgD/7DINjd3/1t4gObBkpbkZbCqpWkdOOCrGPudPF3FDCOyu', 'son-tung-m-tp_nnlq.jpg', 'a@gmail.com', 2),
(2, 'anhtien', '$2y$10$JX5wHUYGgnW4V64kxQi96u2y8mrQIZUK5INzeNcySLH/ZN1UqcwzO', 'Khac-Viet-Dong-Nhi-2830-1570957635.jpg', 'tien@gmail.com', 1),
(3, 'b@gmail.com', '$2y$10$B.ABY2/apSXNx/cecnfV4uxuIUAvwhlOUzJH8CGb.ap6QiPkvnuYS', 'Son-Tung-dung-hang-Justin-Bieber-JHope-BTS-DepOnline-03.jpg', 'b@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_cate` int(11) NOT NULL,
  `name_cate` varchar(250) NOT NULL,
  `images` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_cate`, `name_cate`, `images`) VALUES
(4, 'Samsung', '02.jpg'),
(5, 'Nokia VN', '04.jpg'),
(17, 'Vsmart', '5.jpg'),
(22, 'Xiaomi', '03.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date_comment` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `customer_name` text NOT NULL,
  `customer_phone` int(11) NOT NULL,
  `totalprice` float NOT NULL,
  `payment` float NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_detail`
--

CREATE TABLE `invoice_detail` (
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pms`
--

CREATE TABLE `pms` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pms`
--

INSERT INTO `pms` (`id`, `name`, `title`) VALUES
(1, 'User.show', 'Danh sách tài khoản'),
(2, 'product.show', 'danh sách sản phẩm'),
(3, 'product.add', 'thêm sản phẩm'),
(4, 'product.edit', 'sửa sản phẩm'),
(5, 'category.show', 'danh sách danh mục'),
(6, 'category.edit', 'sửa dnh mục'),
(7, 'category.delete', 'xóa danh mục'),
(8, 'category.add', 'thêm danh mục'),
(9, 'product.xoa', 'xoa sản phẩm'),
(10, 'slider.show', ''),
(12, 'slider.edit', ''),
(13, 'slider.xoa', ''),
(14, 'user.add', ''),
(15, 'user.edit', ''),
(16, 'slider.add', 'slider.add');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `image` text NOT NULL,
  `content` text NOT NULL,
  `creat_date` date NOT NULL,
  `id_category` int(11) NOT NULL,
  `des` text NOT NULL,
  `price_km` int(250) NOT NULL,
  `price` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `content`, `creat_date`, `id_category`, `des`, `price_km`, `price`) VALUES
(2, 'Samsung S20', 'samsung-galaxy-note-10-silver-400x460.png', 'Hàng chính hãng', '2020-06-06', 4, 'Giảm giá cực sâu', 15900000, 30000000),
(4, 'Samsung A71', 'samsung-galaxy-a71-selver-400x460-400x460.png', 'Sản phẩm chính hãng', '2020-06-07', 4, 'Hàng tàu chất lượng Việt Nam', 15900000, 19000000),
(6, 'Nokia 5.3', 'samsung-galaxy-a71-selver-400x460-400x460.png', 'Hàng mới căng', '2020-06-08', 5, 'Cung cấp mới nhất , chính hãng rẻ', 5900000, 7990000),
(8, 'Vsmart Active 3', 'vsmart-active-3-6gb-emerald-green-400x460-2-400x460.png', 'Hàng Việt Nam 100%', '2020-06-23', 17, 'Uy tín bền bỉ  . Giá cả hợp lí', 4590000, 7990000),
(9, 'Vsmart live', 'vsmart-live-6gb-white-400x460.png', 'Số lượng có hạn', '2020-06-23', 17, 'Cấu hình khủng , giá cả hợp lí', 3190000, 6900000),
(10, 'Xiaomi mi 10', 'xiaomi-mi-note-10-white-400x460.png', 'Hàng chính hãng xiaomi', '2020-06-23', 22, 'Vốn nổi tiếng giá rẻ cấu hình khủng', 10190000, 14590000),
(11, 'Vsmart Joy3', 'vsmart-joy-3-tim-400x460-400x460.png', 'Hàng Việt Nam full box', '2020-06-23', 17, 'Giá rẻ , cấu hình tầm trung', 2490000, 2900000);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `role_pms`
--

CREATE TABLE `role_pms` (
  `id_role` int(250) NOT NULL,
  `id_pms` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_pms`
--

INSERT INTO `role_pms` (`id_role`, `id_pms`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `logo` text NOT NULL,
  `address` text NOT NULL,
  `email` text NOT NULL,
  `sdt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `link_product` text NOT NULL,
  `status` text NOT NULL,
  `name_pro` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `image`, `link_product`, `status`, `name_pro`) VALUES
(9, '01.jpg', 'http://localhost/PT14313_WEB_php3/public/font_end/detail/9', '1', 'Vsmart Live'),
(10, '17.jpg', 'http://localhost/PT14313_WEB_php3/public/font_end/detail/8', '1', 'Vsmart Active3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_cate`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pms`
--
ALTER TABLE `pms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_pms`
--
ALTER TABLE `role_pms`
  ADD PRIMARY KEY (`id_role`,`id_pms`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_cate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms`
--
ALTER TABLE `pms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

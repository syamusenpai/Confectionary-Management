-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2024 at 03:57 AM
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
-- Database: `aneka_2.0`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` varchar(10) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `phone_number`, `first_name`, `last_name`, `username`, `password`, `email`, `role`) VALUES
(1, '01955631', 'Faiz', 'shaz', 'FIYREX', '12345678', 'fiyrex@gmail.com', 'admin'),
(3, '011533849', 'shaz', 'faiz', 'Shazreeq', '12345678', 'shaz@gmail.com', 'admin'),
(7, '01165012566', 'Aiman', 'danial', 'AD', '12345678', 'aiman@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `proof_of_purchase` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `proof_of_purchase`) VALUES
(31, 4, 'zany', '0305166141', 'zany@gmail.com', 'QR', 'shah alam', '6', 210, '0000-00-00', '', 0x89504e470d0a1a0a0000000d494844520000007a0000003e0806000000e4900f9e000000017352474200aece1ce90000000467414d410000b18f0bfc61050000000970485973000012740000127401de661f780000005f69545874536e69704d6574616461746100000000007b22636c6970506f696e7473223a5b7b2278223a302c2279223a307d2c7b2278223a3132332c2279223a307d2c7b2278223a3132332c2279223a36327d2c7b2278223a302c2279223a36327d5d7db1c2bf3c0000063b49444154785eed9c5f6c53551cc7bfb75b19ae5bc74be712830a5d58548c6c25d2f0200f04141e8c21034c1698569720643c9130d893268591f8469898e1e44f9ac89f107c1844080ff8b07486b110275ab2ce3fcb10d6445db12a906dfeceb9e7f6cffe74f7deb6db1df77c9293dd73ceeff4dedeeffdfdceef9cae555c65e513b0398af86bc51ba15d5bae28a5a52e29b4e2e07774627c5cb4580745a10b632547e81d4aac4cbebc500a6d71943c056f29b4c599c8934f4ba12d8ea53d7aef956124ee7561afa867e578af7e5b1b223dda2614d8a38fe1566218978f77e15ee26f245849f7ba66d64efdcda24eb4f7914ddf31514b239b2df3e61d3540c53a1c4ef4a25df44b52cc81475760dd8e2a5c7295c145e5d4031223df2176970fae331160f4060eb87cd82d9a2529e6648e8e9c49ddfcdd9d37305ab10a6fa579a664e19045e851dcff411c328efe82fbe4e555af88ba64412193319b90758ecef0dee6175135d9cb250b86ac1e5df3762af96a0fac43c5dd4bd87c942a228cafda2c7a29b37e67857a380523b69282913d197b5045cb1e7579d5f82c65c6b57b44cf1ed451b65cf1c62175e97500b8f4eda8e89bcc2cb6bbc288f0e555e6124c925f66f89892ada31b813365a8db259a9e62acfd31a57a6db992d5a3254f0f52689b20ffc38490a15bf2d42085b60952689b2085b60952689b2085b6098acfe7b3fdf2ca0e28ebabaa0a26f498a2e0f792523c72583b70141739e1702878fce4b168b10ec5c5ecda72bf7f0555a0686202958fff1535c97c5270575b343e8ec56363a226992fe624a63e332e859e6fac3d794af28614da2648a16d8214da2648a16d8214da2648a16d8214da2698daeb1e5bfc1c122fbc8f4795ebf1c4e5e56dce44142523d7e1faf54b14fd37ccdb34fe7096e04fe72251b31e76d8eb362cf43fcf37e0af970f532c708a96498c3fc1923b0750fa5b483448a173615e3ed4e022affc74669119d4c76c98adc43ae8169a856beec93a61b66c8c519a4237f173f4eed4d2771a4dc2262f044ee376f426420151374d10d7f2f23afa089cec46e4c7ef11e9fa58b4e843b7d06c4eceeac993215b3ec60cd1f358e65d9151cec6fc38986fb1171a8d27f0d19a725131866ea159e26514336366a2e5ab30e26e0f78eac7bc91440f5d15de7e35c86d32a3c115b4f1d6146d9a3d95dbef7a442be3135cfea91fd78e882ac15f2bfdc1e211206d3c7761e6cd5b510d37d6b6de4d8e4f3f4fe67530fb949d311a716acf1a3a9339740bad65d746303346376e3f56c6da548fdfd8ca8539e88fe1ac880087c21e6c4fbbc9ece66ff7847188f7b7a1dfe33570d348a0563f462e6811e63c46fc2d24582b36d0f100e2e80eaec086fdea03923a8fb88ee403c3ec553ba304bbf6c15ffe10e19e41d1620c43c9d8fc1140a8d90f77f4165a440be8e6f65fef14c7416cf3bb31706153b2bfa3a11ddd712f3609cff3d133377075273a786f271a8e5284e0c7b3d3147a13d5f130ce2505d22f5847c36a2cabd5ce6b92e0d7a85f4eefb8e7733466ae5c75a35b68b64e368a99311cefd6b4d0c74a0bd682bc843c775a024b5149b28d44449dd389a198389caebf730823e27036bc1ef2fdd8902eb13a1abec100459b83fcbaf391a4d1b4b285547ed883cfde3b25da8ca35b68b6196214336338d32463397bc59ca17a3b9b1ebae3eadc3d5dbea0970f4e6f54f392f235d8cfb26d263a63f91644be3b41b14e1fba85663b5e6c33443764cbc7cc05dc3bdda8ac11754e004bb57c6bba7eeee5fa88c628c87b961accf8697aa86582b339dc0b9fa9042c7fe8169a6d6bb21d2fbd30dbc95ba185a315e7c27154d7a73ca729b41b6bdd515c6960f3b8e8dfa8254562cee7c78c41302dab6bd5ec5d9bf335b470bc2d29168defd332ef4ca664eb47ea282b8fa2d74402c6f862a71f352fbd9a2a17453236781135af7f488f933e0c25636c5b7349ffbeec9ecdb640c9267d0b742e60498f9a69abf3ba9a81a72767abd5b5b898f32befa4276327d1d8de83783237a843ef85f4fc82c271308cca7af5b579ce103b8fd7c443d41b554334139e2781d0ce43a5de4319b9761db92caf54923fc64f7f1d4e4577911f6a100b61afdb41b7cf5966fe1bf105fda6868614da3c4c686769118a4b4583490c856ec93c404e9cabc80c29b4c5295e9c871f3021a4d016c7512c859618400a6d13a4d036410a6d13a4d0b600f81f78058e1e6426425c0000000049454e44ae426082);

-- --------------------------------------------------------

--
-- Table structure for table `orders_shipping`
--

CREATE TABLE `orders_shipping` (
  `order_id` int(100) NOT NULL,
  `shipping_method_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(100) NOT NULL,
  `order_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(25, 31, 8, 1, 50),
(26, 31, 9, 1, 100),
(27, 31, 10, 1, 1),
(28, 31, 13, 1, 53),
(29, 31, 12, 1, 5),
(30, 31, 11, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(10) NOT NULL DEFAULT 0,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `quantity`, `image`) VALUES
(8, 'Talam Ubi', 'Berubi', 50.00, 5, 'd18.jpg'),
(9, 'serimuka', 'hijau', 100.00, 10, 'd8.jpg'),
(10, 'pulut', 'aqil', 1.00, 69, 'd17.jpg'),
(11, 'Talam ubi', 'ubi', 1.00, 4, 'd2.jpg'),
(12, 'tah', 'tah', 5.00, 5, 'd4.jpg'),
(13, 'tah2', 'tah2', 53.00, 4, 'd13.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`) VALUES
(1, 'Kuih Tradisional'),
(2, 'Kuih Moden'),
(3, 'Talam series ');

-- --------------------------------------------------------

--
-- Table structure for table `product_category_mapping`
--

CREATE TABLE `product_category_mapping` (
  `product_id` int(100) NOT NULL,
  `category_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category_mapping`
--

INSERT INTO `product_category_mapping` (`product_id`, `category_id`) VALUES
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(11, 3),
(12, 1),
(13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(10) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `proof_of_purchase` blob DEFAULT NULL,
  `profit` decimal(10,2) NOT NULL,
  `sale_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `proof_of_purchase`, `profit`, `sale_date`) VALUES
(1, 7, 'Hisyam Bin Rosli', '0194415016', 'hisyamrosli50@gmail.com', 'QR', '18 8/5 jalan desa bandar country homes rawang selangor', '1', 2.00, '', 2.00, '2024-01-01'),
(2, 7, 'Hisyam Bin Rosli', '0194415016', 'hisyamrosli50@gmail.com', 'QR', '18 8/5 jalan desa bandar country homes rawang selangor', '3', 150.00, '', 450.00, '2024-01-10'),
(3, 7, 'Hisyam Bin Rosli', '0194415016', 'hisyamrosli50@gmail.com', 'QR', '18 8/5 jalan desa bandar country homes rawang selangor', '4', 200.00, '', 800.00, '2024-01-18'),
(4, 4, 'faris imadi', '0116520931', 'zany@gmail.com', 'QR', 'Keusma', '5', 154.00, '', 770.00, '2024-01-19'),
(10, 4, 'fiy', '0116520913', 'zany@gmail.com', 'QR', 'kesuma', '2', 150.00, '', 300.00, '2024-01-20'),
(11, 4, 'faris5', '06566515', 'zany@gmail.com', 'QR', 'sada', '4', 152.00, '', 608.00, '2024-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `sales_detail2`
--

CREATE TABLE `sales_detail2` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_detail2`
--

INSERT INTO `sales_detail2` (`id`, `sales_id`, `product_id`, `quantity`, `price`) VALUES
(1, 4, 8, 1, 1.00),
(3, 4, 9, 5, 100.00),
(5, 4, 10, 4, 100.00),
(7, 7, 12, 3, 5.00),
(8, 7, 13, 10, 53.00),
(11, 7, 11, 2, 1.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `id` int(100) NOT NULL,
  `sales_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(10) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `phone_number`, `password`, `role`) VALUES
(4, 'Azany', 'zany', 'aqil', 'zany@gmail.com', '01158631955', '12345678', 'user'),
(5, 'Imadi', 'aqil', 'zany', 'aqil@gmail.com', '601153572', '12345678', 'user'),
(6, 'faizudin', 'faiz', 'aqil', 'faiz@gmail.com', '01555348', '12345678', 'user'),
(7, 'Liquify', 'Hisyam', 'Bin Rosli', 'hisyamrosli50@gmail.com', '0194415016', 'goal1234', 'user'),
(8, 'mek', 'mek', 'rashnan', 'rashnan@gmail.com', '0123456789', 'goal1234', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `query` text NOT NULL,
  `answer` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders_shipping`
--
ALTER TABLE `orders_shipping`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `shipping_method_id` (`shipping_method_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category_mapping`
--
ALTER TABLE `product_category_mapping`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_detail2`
--
ALTER TABLE `sales_detail2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_id` (`sales_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders_shipping`
--
ALTER TABLE `orders_shipping`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sales_detail2`
--
ALTER TABLE `sales_detail2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders_shipping`
--
ALTER TABLE `orders_shipping`
  ADD CONSTRAINT `orders_shipping_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orders_shipping_ibfk_2` FOREIGN KEY (`shipping_method_id`) REFERENCES `shipping_methods` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_category_mapping`
--
ALTER TABLE `product_category_mapping`
  ADD CONSTRAINT `product_category_mapping_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_category_mapping_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`);

--
-- Constraints for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD CONSTRAINT `sales_details_ibfk_1` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

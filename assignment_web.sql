-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2022 at 05:26 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Giày nam', '2022-12-13 17:22:28'),
(2, 'Giày nữ', '2022-12-13 17:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `products_id`, `name`) VALUES
(1, 1, 'D:/Web/ltw-mvc/assignment-ltw/public/assets/img/4-1c14aee3-15db-46a4-9778-c325866d6744.jpg'),
(2, 1, 'D:/Web/ltw-mvc/assignment-ltw/public/assets/img/li-ning-2016-ph-n-running-shoes-breathable-l-i-thu-ch-y-b-sneakers-sport.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price` float(15,2) DEFAULT NULL,
  `shipping_cost` float(15,2) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`id`, `user_id`, `email`, `full_name`, `phone_number`, `address`, `created_at`, `note`, `total_price`, `shipping_cost`, `status`) VALUES
(2, 3, 'gregergh', 'gegwge', '287282', 'bregse', '2022-12-13 12:22:13', 'bêbewg', 5000000.00, 100000.00, 3);

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_unit` float(20,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`id`, `order_id`, `item_id`, `quantity`, `price_per_unit`) VALUES
(2, 2, 1, 2, 500000.000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `categories_id` int(11) NOT NULL,
  `sub_categories_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `brand`, `description`, `categories_id`, `sub_categories_id`, `created_at`) VALUES
(1, 'Giày Sneaker nữ gót thêu mèo dễ thương', 'Hapu', 'Là mẫu giày đang được các bạn nữ rất ưa chuộng hiện nay bởi những đặc tính nổi trội:\r\n- Kiểu dáng thời trang, năng động, dễ phối đồ.\r\n- Điểm nhấn là phần gót được thêu hình mèo con rất dễ thương.\r\n- Chất liệu da tổng hợp nhẹ, mềm và dễ làm sạch. \r\n- Đế cao su tổng hợp nên dẻo và rất êm chân\r\n- Phù hợp với mọi hoạt động: đi du lịch, đi dạo, đi học, chơi thể thao, đi làm... \r\n- Sản phẩm có 3 màu: trắng mèo đen, trắng mèo hồng, trắng mèo xanh\r\n\r\nThông tin cơ bản của sản phẩm:\r\nThương hiệu:    HAPU \r\nChất liệu: giả da mềm, dế làm sạch\r\nLớp lót trong:    Lớp đệm êm\r\nChất liệu đế:    Đế bằng cao su tổng hợp, xẻ rãnh chống trơn trượt.\r\nThiết kế:    classic nên rất đa dụng, kiểu dây buộc.\r\n\r\nHướng đến đối tượng là những bạn trẻ yêu thích vẻ đẹp năng động, tươi tắn, thương hiệu chúng tôi đã cho ra mắt bộ sưu tập giày với những thiết kế vừa hiện đại, vừa hợp xu hướng. Giày thể thao nữ  được làm từ chất liệu vải kết hợp da tổng hợp cao cấp với phần đế cao su chắc chắn, đảm bảo an toàn cho từng bước đi. Sở hữu kiểu dáng trẻ trung, giày thích hợp phối cùng nhiều trang phục khác nhau. \r\nĐẶC ĐIỂM NỔI BẬT\r\n Thiết kế đơn giản tinh tế, phù hợp với các bạn gái trẻ trung, hiện đại\r\nTrẻ trung, năng động cùng màu sắc đơn giản giúp dễ dàng phối hợp với mọi phong cách quần áo, từ cá tính đến năng động, trẻ trung khi bạn đi dã ngoại, dạo phố, đi làm.\r\nChất liệu cao cấp\r\nGiày sử dụng chất liệu vải kết hợp cao su cao cấp với đường may tỉ mỉ, chắc chắn cùng phần đế êm ái giúp đảm bào và tự tin trên từng bước đi của bạn\r\nPhù hợp nhiều phong cách trang phục\r\nCùng giày sneaker bạn có thể thoải mái phối hợp với những set trang phục khác nhau. Một chút nhấn nhá bằng các phụ kiện như túi xách, vòng tay, đồng hồ, hẳn bạn sẽ trở nên nổi bật và thu hút hơn trong mắt mọi người.\r\nThông tin bảo hàng: Bảo hàng 3 tháng bằng hóa đơn.\r\nHướng dẫn bảo quản giày\r\n - Bảo quản giày sau khi sử dụng\r\nBạn lưu ý khi mua hàng về, bạn đừng vứt hộp đi. Chẳng hạn, đôi giày đó bạn chỉ đi vào mùa lạnh, thì khi không dùng nữa, hãy nhét giấy vụn vào trong giày để giữ cho giày không bị biến dạng, rồi bỏ giày vào hộp. Như vậy, đôi giày của bạn sẽ yên vị trong hộp nhiều tháng trời mà không ảnh hưởng tới chất lượng của da.\r\n - Làm mềm giày da\r\nĐôi giày da để trong xó tủ nào đó, bỗng một ngày nọ bạn muốn dùng đến nó nhưng da đã bị cứng, co lại, khi đi có cảm giác đau chân. Để làm mềm da, hãy thoa một lớp kem vaseline lên giày trước khi đánh xi, giày sẽ mềm trở lại.\r\nHoặc sau khi lấy giày trong tủ ra, bạn dùng giẻ mềm thấm nước vắt khô, lau toàn bộ đôi giày rồi để sau một đêm, da giày sẽ mềm hơn. Để da giày bền lâu, bạn hạn chế làm ướt giày. Khi giày bị ướt không nên hơ trước ngọn lửa hoặc phơi nắng, nó sẽ làm giày bị cứng và co lại, chỉ nên phơi giày ướt ở nơi râm mát, sau khi giày khô thì đánh xi để làm cho da mềm trở lại.\r\n - Khử mùi hôi trong giày\r\nGiày dùng cả ngày thường bị mồ hôi làm ẩm ướt, gây mùi hôi. Nên đặt túi đựng viên chống ẩm vào trong giày để hút ẩm và rắc phấn rôm để khử mùi. Để hạn chế mùi hôi và sự ẩm ướt, hãy chọn tất chân loại tốt, có khả năng hút ẩm cao. Dùng lót giày khử mùi cũng là một phương pháp tốt.', 2, 6, '2022-12-13 17:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `products_sku`
--

CREATE TABLE `products_sku` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_price` float(15,2) DEFAULT NULL,
  `price` float(15,2) NOT NULL,
  `in_stock` int(11) NOT NULL DEFAULT 100,
  `size` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products_sku`
--

INSERT INTO `products_sku` (`id`, `product_id`, `color`, `discount_price`, `price`, `in_stock`, `size`, `created_at`) VALUES
(1, 1, 'Hồng', 1200000.00, 1500000.00, 100, 38, '2022-12-13 17:35:55'),
(4, 1, 'Xanh', 1200000.00, 1500000.00, 100, 38, '2022-12-13 17:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `categories_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `categories_id`, `created_at`) VALUES
(4, 'Giày tăng chiều cao', 1, '2022-12-13 17:26:05'),
(6, ' Sneaker', 2, '2022-12-13 17:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fullname`, `created_at`, `phone`, `address`, `role`) VALUES
(3, 'yer', 'vfvdrf', 'vẻgerg', '2022-12-13 18:22:08', '2783837', 'egwgwe', 'user'),
(5, 'nguyenthibichphuong3101@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'PHuong', '2022-12-16 00:16:07', '0347334972', '262/13 Lũy Bán Bích', 'user'),
(6, 'phuongabc@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Nguyễn Phương', '2022-12-15 23:21:17', '0909090909', 'bcons green view', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_id` (`products_id`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_orderdetail_user` (`user_id`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_orderitems_orderdetail` (`order_id`),
  ADD KEY `FK_orderitems_productsku` (`item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKproducts_sub_category` (`sub_categories_id`),
  ADD KEY `FKproducts_category` (`categories_id`);

--
-- Indexes for table `products_sku`
--
ALTER TABLE `products_sku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKproduct_sku` (`product_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categories_id` (`categories_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products_sku`
--
ALTER TABLE `products_sku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `FK_orderdetail_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `FK_orderitems_orderdetail` FOREIGN KEY (`order_id`) REFERENCES `orderdetail` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_orderitems_productsku` FOREIGN KEY (`item_id`) REFERENCES `products_sku` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FKproducts_category` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKproducts_sub_category` FOREIGN KEY (`sub_categories_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products_sku`
--
ALTER TABLE `products_sku`
  ADD CONSTRAINT `FKproduct_sku` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_ibfk_1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

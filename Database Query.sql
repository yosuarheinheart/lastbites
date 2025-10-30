-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 06:46 AM
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
-- Database: `lastbites`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `email`, `password`) VALUES
(1, 'Selena', 'selena@gmail.com', 'selena');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `created_at`) VALUES
(3, 1, '2024-11-11 05:44:20'),
(4, 6, '2024-11-16 16:46:33'),
(5, 7, '2024-11-16 16:53:30'),
(6, 8, '2024-11-16 17:26:20'),
(7, 2, '2024-11-16 18:12:46'),
(8, 10, '2024-11-19 14:34:52'),
(9, 3, '2024-11-19 17:57:59'),
(10, 26, '2024-11-20 03:54:16'),
(11, 12, '2024-11-20 04:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL,
  `category_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_picture`) VALUES
(1, 'Fruits & Vegetables', 'asset/fruit_vege.jpg'),
(2, 'Bakery & Pastry', 'asset/bakery.jpeg'),
(3, 'Ready-to-Eat Meals', 'asset/rtomeals.jpg'),
(4, 'Deli & Meats', 'asset/meat.jpg'),
(5, 'Condiments and Sauces', 'asset/conds.jpg'),
(6, 'Dessert', 'asset/dessert.jpeg'),
(7, 'Snack', 'asset/snack.jpg'),
(8, 'Beverages', 'asset/beverages.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `sender_id`, `receiver_id`, `message`, `sent_at`) VALUES
(2, 8, 2, 'Halo', '2024-11-16 17:31:13'),
(3, 1, 3, 'halo', '2024-11-21 06:29:54'),
(4, 1, 3, 'halo juga', '2024-11-21 06:30:10'),
(5, 3, 1, 'pp', '2024-11-21 06:30:15'),
(6, 3, 30, 'apakah prodduk tersedia?', '2024-11-21 07:03:24'),
(7, 30, 3, 'iya, sedang tersedia, silahkan dibeli', '2024-11-21 07:03:47'),
(8, 3, 10, 'Halo Bang', '2024-12-06 07:00:26'),
(9, 3, 10, 'Halo Bang', '2024-12-06 07:03:07'),
(10, 3, 10, 'Halo Bang', '2024-12-06 07:04:30'),
(11, 3, 10, 'Halo Bang 2', '2024-12-06 07:04:49'),
(12, 10, 3, 'iya bang?', '2024-12-06 07:17:17');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(25, '0001_01_01_000000_create_users_table', 1),
(26, '0001_01_01_000001_create_cache_table', 1),
(27, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_picture` varchar(255) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `status` enum('Available','Out of Stock') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `store_id`, `category_id`, `product_picture`, `product_name`, `product_description`, `price`, `stock`, `status`, `created_at`) VALUES
(1, 1, 1, 'asset/product.jpg', 'Organic Apples', 'Fresh organic apples', 10000.00, 100, 'Available', '2024-11-09 14:45:00'),
(2, 2, 2, 'asset/product.jpg', 'Sourdough Bread', 'Artisan sourdough bread', 25000.00, 50, 'Available', '2024-11-09 14:45:00'),
(3, 3, 3, 'asset/product.jpg', 'Nasi Ayam bakar', 'Ayam Bakar dibalut dengan bumbu khas resto yang diselimuti rasa smoky yang akan membuat anda merasa senang', 20000.00, 2, 'Available', '2024-11-09 14:45:00'),
(4, 4, 4, 'asset/product.jpg', 'Chicken Sausage (500gr)', 'Special Chicken Sausage', 10000.00, 30, 'Available', '2024-11-09 14:45:00'),
(5, 5, 5, 'upload/product/Product___1732021611.jpeg', 'Mayonaise', 'Delicious Mayonnaise to fulffil your energy', 15000.00, 3, 'Available', '2024-11-19 13:06:51'),
(6, 5, 5, 'upload/product/Product___1732021848.jpeg', 'Spicy Chili Sauce', 'Very Spicy Chili Sauce', 10000.00, 3, 'Available', '2024-11-19 13:10:48'),
(7, 6, 1, 'upload/product/Product___1732026331.jpeg', 'Eggplant', 'Delicious and Fresh Eggplant from My Village', 5000.00, 5, 'Available', '2024-11-19 14:25:31'),
(8, 6, 1, 'upload/product/Product___1732026391.jpg', 'Lemon', 'Fresh and Very Sour Lemon', 25000.00, 10, 'Available', '2024-11-19 14:26:31'),
(9, 7, 2, 'upload/product/Product___1732027626.jpeg', 'Roti Buaya', 'Roti bentuk buaya cocok untuk dijajalkan pada pernikahan', 5000.00, 20, 'Available', '2024-11-19 14:47:06'),
(10, 7, 2, 'upload/product/Product___1732027681.webp', 'Croissant', 'Real from France', 30000.00, 2, 'Available', '2024-11-19 14:48:01'),
(11, 8, 3, 'upload/product/Product___1732028471.jpeg', 'Nasi Ayam Geprek', 'Ayam Geprek Enak dan Pedas dibuat oleh Cristiano langsung', 12000.00, 3, 'Available', '2024-11-19 14:56:51'),
(12, 8, 3, 'upload/product/Product___1732028262.jpeg', 'Kentang Goreng Crispy', 'Kentang Manis Digoreng dengan Matang', 10000.00, 2, 'Available', '2024-11-19 14:57:42'),
(17, 9, 1, 'asset/product.jpg', 'Fresh Apples', 'Fresh and juicy apples', 12000.00, 100, 'Available', '2024-11-19 07:08:00'),
(18, 9, 1, 'asset/product.jpg', 'Organic Bananas', 'Sweet organic bananas', 8000.00, 50, 'Available', '2024-11-19 07:09:00'),
(19, 10, 1, 'asset/product.jpg', 'Carrots', 'Fresh and crunchy carrots', 5000.00, 200, 'Available', '2024-11-19 07:10:00'),
(20, 10, 1, 'asset/product.jpg', 'Spinach', 'Organic spinach leaves', 7000.00, 150, 'Available', '2024-11-19 07:11:00'),
(21, 11, 2, 'asset/product.jpg', 'Croissants', 'Golden, flaky croissants', 25000.00, 50, 'Available', '2024-11-19 07:12:00'),
(22, 11, 2, 'asset/product.jpg', 'Chocolate Cake', 'Decadent chocolate cake', 45000.00, 30, 'Available', '2024-11-19 07:13:00'),
(23, 12, 2, 'asset/product.jpg', 'Sourdough Bread', 'Artisan sourdough bread', 20000.00, 40, 'Available', '2024-11-19 07:14:00'),
(24, 12, 2, 'asset/product.jpg', 'Apple Pie', 'Delicious homemade apple pie', 30000.00, 25, 'Available', '2024-11-19 07:15:00'),
(25, 13, 3, 'asset/product.jpg', 'Nasi Goreng', 'Indonesian fried rice with toppings', 25000.00, 100, 'Available', '2024-11-19 07:16:00'),
(26, 13, 3, 'asset/product.jpg', 'Spaghetti Bolognese', 'Classic spaghetti with beef bolognese sauce', 30000.00, 80, 'Available', '2024-11-19 07:17:00'),
(27, 14, 3, 'asset/product.jpg', 'Chicken Rice', 'Delicious chicken rice served with side vegetables', 20000.00, 50, 'Available', '2024-11-19 07:18:00'),
(28, 14, 3, 'asset/product.jpg', 'Beef Steak', 'Grilled beef steak with mashed potatoes', 50000.00, 40, 'Available', '2024-11-19 07:19:00'),
(29, 15, 4, 'asset/product.jpg', 'Chicken Sausage', 'Delicious chicken sausages for grilling', 25000.00, 100, 'Available', '2024-11-19 07:20:00'),
(30, 15, 4, 'asset/product.jpg', 'Pork Sausage', 'Succulent pork sausages for BBQ', 30000.00, 80, 'Available', '2024-11-19 07:21:00'),
(31, 16, 4, 'asset/product.jpg', 'Ribeye Steak', 'Premium ribeye steak for grilling', 80000.00, 60, 'Available', '2024-11-19 07:22:00'),
(32, 16, 4, 'asset/product.jpg', 'Chicken Breast', 'Fresh chicken breast fillets', 25000.00, 120, 'Available', '2024-11-19 07:23:00'),
(33, 17, 5, 'upload/product/Product___1732021611.jpeg', 'Tomato Ketchup', 'Classic ketchup made from ripe tomatoes', 10000.00, 50, 'Available', '2024-11-19 15:30:21'),
(34, 17, 5, 'upload/product/Product___1732021848.jpeg', 'Barbecue Sauce', 'Smoky and spicy barbecue sauce', 15000.00, 30, 'Available', '2024-11-19 15:30:21'),
(35, 18, 5, 'upload/product/Product___1732026331.jpeg', 'Hot Chili Sauce', 'For those who love spicy flavors', 8000.00, 40, 'Available', '2024-11-19 15:30:21'),
(36, 18, 5, 'upload/product/Product___1732026391.jpg', 'Sweet Chili Sauce', 'Perfect balance of sweet and spicy', 12000.00, 20, 'Available', '2024-11-19 15:30:21'),
(37, 19, 6, 'upload/product/Product___1732026331.jpeg', 'Chocolate Cake', 'Rich and moist chocolate cake', 25000.00, 15, 'Available', '2024-11-19 15:30:21'),
(38, 19, 6, 'upload/product/Product___1732026391.jpg', 'Strawberry Cheesecake', 'Creamy cheesecake topped with fresh strawberries', 35000.00, 10, 'Available', '2024-11-19 15:30:21'),
(39, 20, 6, 'upload/product/Product___1732026331.jpeg', 'Vanilla Pudding', 'Sweet and smooth vanilla pudding', 12000.00, 30, 'Available', '2024-11-19 15:30:21'),
(40, 20, 6, 'upload/product/Product___1732026391.jpg', 'Tiramisu', 'Delicious tiramisu with a coffee flavor', 20000.00, 20, 'Available', '2024-11-19 15:30:21'),
(41, 21, 7, 'upload/product/Product___1732027626.jpeg', 'Potato Chips', 'Crispy potato chips in various flavors', 8000.00, 50, 'Available', '2024-11-19 15:30:21'),
(42, 21, 7, 'upload/product/Product___1732027681.webp', 'Cheese Sticks', 'Crunchy cheese-filled snacks', 15000.00, 30, 'Available', '2024-11-19 15:30:21'),
(43, 22, 7, 'upload/product/Product___1732027626.jpeg', 'Peanut Brittle', 'Sweet and crunchy peanut brittle', 10000.00, 20, 'Available', '2024-11-19 15:30:21'),
(44, 22, 7, 'upload/product/Product___1732027681.webp', 'Salty Pretzels', 'Salty and crunchy pretzels', 12000.00, 25, 'Available', '2024-11-19 15:30:21'),
(45, 23, 8, 'upload/product/Product___1732028471.jpeg', 'Iced Latte', 'Chilled latte with a hint of vanilla', 22000.00, 30, 'Available', '2024-11-19 15:30:21'),
(46, 23, 8, 'upload/product/Product___1732028262.jpeg', 'Fresh Lemonade', 'A refreshing lemonade for hot days', 15000.00, 50, 'Available', '2024-11-19 15:30:21'),
(47, 24, 8, 'upload/product/Product___1732028471.jpeg', 'Green Tea', 'Freshly brewed green tea with a natural flavor', 12000.00, 40, 'Available', '2024-11-19 15:30:21'),
(48, 24, 8, 'upload/product/Product___1732028262.jpeg', 'Orange Juice', 'Freshly squeezed orange juice', 18000.00, 25, 'Available', '2024-11-19 15:30:21'),
(49, 25, 2, 'upload/product/Product___1732159344.webp', 'Croissant', 'Maknyus rasanya, kenyang perutnya', 15000.00, 50, 'Available', '2024-11-21 03:22:24'),
(51, 26, 7, 'upload/product/Product___1732172530.jpg', 'Pempek Kapal Selam', 'Maknyus lah pokoknya', 45000.00, 50, 'Available', '2024-11-21 07:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `rating_review`
--

CREATE TABLE `rating_review` (
  `review_id` int(11) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `review` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating_review`
--

INSERT INTO `rating_review` (`review_id`, `transaction_id`, `product_id`, `user_id`, `rating`, `review`, `review_date`) VALUES
(1, 1, 1, 1, 5, 'Excellent apples, very fresh!', '2024-11-09 14:45:00'),
(2, 2, 2, 1, 4, 'Great bread, but a bit too crusty for me.', '2024-11-09 14:45:00'),
(8, 13, 1, 8, 2, 'to the moon', '2024-11-16 14:13:05'),
(10, 16, 1, 2, 2, 'Gacorrr', '2024-11-17 21:07:50'),
(11, 20, 2, 2, 3, 'Kurang Bagus', '2024-11-17 21:07:54'),
(15, 22, 1, 2, 1, 'Gacorrr', '2024-11-17 11:32:04'),
(16, 22, 1, 2, 1, 'Gacorrr', '2024-11-17 11:39:35'),
(17, 22, 1, 2, 3, 'Gacorrr', '2024-11-17 21:14:44'),
(18, 22, 1, 2, 5, 'Gacorrr', '2024-11-17 21:14:47'),
(19, 21, 2, 2, 5, 'Kurang Bagus', '2024-11-17 21:16:57'),
(20, 21, 2, 2, 4, 'Kurang Bagus', '2024-11-17 21:17:49'),
(21, 23, 1, 2, 4, 'Mantap Bang', '2024-11-17 21:19:32'),
(22, 25, 1, 2, 4, 'Kompas', '2024-11-18 01:04:59'),
(23, 15, 1, 8, 1, 'mantappp', '2024-11-18 01:13:02'),
(24, 15, 1, 8, 1, 'mantappp', '2024-11-18 01:13:33'),
(25, 15, 1, 8, 4, 'mantappp', '2024-11-18 01:13:37'),
(26, 15, 1, 8, 2, 'mantappp', '2024-11-18 01:13:49'),
(27, 15, 1, 8, 1, 'mantappp', '2024-11-18 01:13:57'),
(28, 15, 1, 8, 1, 'mantappp', '2024-11-18 01:14:02'),
(29, 15, 1, 8, 5, 'mantappp', '2024-11-18 01:14:08'),
(30, 28, 8, 3, 5, 'Buahnya segar dan berkualitas top.\r\nPastinya bakal beli lagi sih.', '2024-11-19 12:02:50'),
(31, 28, 8, 3, 5, 'Buahnya segar dan berkualitas top.\r\nPastinya bakal beli lagi sih.', '2024-11-19 12:06:31'),
(32, 28, 8, 3, 5, 'Buahnya segar dan berkualitas top.\r\nPastinya bakal beli lagi sih.', '2024-11-19 12:06:32'),
(40, 36, 1, 3, 2, 'Kurang Fresh', '2024-11-21 03:42:26'),
(41, 37, 49, 3, 5, 'Enakkk otw repeat order', '2024-11-21 03:43:46'),
(42, 38, 31, 3, 2, 'Saya pesannya medium rare, datangnya well done', '2024-11-21 03:57:52'),
(43, 39, 51, 3, 4, 'mantap bang', '2024-11-21 07:05:03');

--
-- Triggers `rating_review`
--
DELIMITER $$
CREATE TRIGGER `update_average_rating` AFTER INSERT ON `rating_review` FOR EACH ROW BEGIN
    DECLARE total_rating DECIMAL(10, 2);
    DECLARE rating_count INT;
    
    -- Calculate the total rating for all products of the store
    SELECT SUM(rr.rating), COUNT(rr.rating)
    INTO total_rating, rating_count
    FROM rating_review rr
    JOIN product p ON rr.product_id = p.product_id
    WHERE p.store_id = (SELECT store_id FROM product WHERE product_id = NEW.product_id);

    -- Update the average rating of the store
    UPDATE store
    SET average_rating = IF(rating_count > 0, total_rating / rating_count, 0)
    WHERE store_id = (SELECT store_id FROM product WHERE product_id = NEW.product_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7wmg0TNdhPBkVm0DABxJtrB8IaIAt5PyEcF7kUeZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiM25mQ2dSd09zMzlvcHBEaU5tZ0RkM3ZSQTVRZW5kbzdETGFnMGNociI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjM7czoxMDoiZmlyc3RfbmFtZSI7czo3OiJSYWRpdHlhIjt9', 1733503621),
('lv7m5GkfrrkYKiNgxSeSdxZCKqTwJwIO5YJnQj3Y', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiR2k1WGJHMEVnNVB6elRVQTNoRnhBSTlBWHZPVG44MEpFbWdIWFF5UyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGF0LzEwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjM7czoxMDoiZmlyc3RfbmFtZSI7czo3OiJSYWRpdHlhIjt9', 1733505203),
('nWONHUS4h1oLVYHYiciCJn3EFMEtcVhunUhiTtsk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWENnWUJyWHp0WG9qdkJISTRQd2tLTnBtdmdiZmNyZHNtZjlTZ1Y2VCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo3OiJ1c2VyX2lkIjtpOjExO3M6MTA6ImZpcnN0X25hbWUiO3M6OToiQWRoaXRnYW56Ijt9', 1733504527),
('phg0oUqlWpj9o2dcQVeerCrGZaTay6dSDWYFE3ZY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoic256ZUhad1N1UTVIbGlHRTFLODlCQ0RMbkY1UjNhUlZ5YW8ya2pLViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGF0LzEwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjM7czoxMDoiZmlyc3RfbmFtZSI7czo3OiJSYWRpdHlhIjt9', 1733500124),
('zXAiXymQQdhMgNuA8ycNfcJyMKXEzV4Yz1oJ6xdB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUnJLT0NKUWNQYTBTdWliUlVLZzliWnVmZGtQZzdKWEVOMkFqb2FHdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGF0LzIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO2k6MTA7czoxMDoiZmlyc3RfbmFtZSI7czo1OiJZb3N1YSI7fQ==', 1733505367);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(100) DEFAULT NULL,
  `store_description` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `store_picture` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `average_rating` decimal(3,2) DEFAULT 0.00,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `store_name`, `store_description`, `user_id`, `store_picture`, `address`, `average_rating`, `status`, `created_at`) VALUES
(1, 'Timothy’s Organic Produce', 'Fresh organic fruits and vegetables', 2, 'asset/store.jpg', '456 Elm St, Gotham, 54321', 2.59, 'Active', '2024-11-09 14:45:00'),
(2, 'Raditya’s Bakery', 'Delicious homemade breads and pastries', 3, 'asset/store.jpg', '789 Pine St, Star City, 67890', 4.00, 'Active', '2024-11-09 14:45:00'),
(3, 'Ferry’s Restaurant', 'Cozy Restaurant with a wide variety of meals', 4, 'asset/store.jpg', '321 Oak St, Central City, 98765', 0.00, 'Active', '2024-11-09 14:45:00'),
(4, 'Nagita’s Deli', 'Gourmet sandwiches and specialty meats', 5, 'asset/store.jpg', '654 Maple St, Coast City, 34567', 2.00, 'Inactive', '2024-11-09 14:45:00'),
(5, 'Ash Condiment Store', 'Selling best quality condiments to cook your meals', 9, 'upload/store/Store___1732021413.jpg', 'Jalan Allogio No.39', 0.00, 'Active', '2024-11-19 13:03:33'),
(6, 'Mr. Y Grocery', 'Best Grocery in Town', 10, 'upload/store/Store___1732026244.png', 'Ruko Allogio Timur No. 19, Kabupaten Tangerang, Banten', 4.40, 'Active', '2024-11-19 14:24:04'),
(7, 'Didit Bakery', 'Make Bread Every Day Just Only For You', 11, 'upload/store/Store___1732027539.jpeg', 'Kebangsaan Street Number 70, Menteng Residences', 0.00, 'Active', '2024-11-19 14:45:39'),
(8, 'Cristiano Fried Chicken', 'Fried Chicken Owner by Cristiano Ronaldo', 12, 'upload/store/Store___1732029032.png', 'Manchester Street, Number 7', 0.00, 'Active', '2024-11-19 14:51:35'),
(9, 'Maria’s Fruit Market', 'Fresh fruits and vegetables', 13, 'upload/store/store13.png', '123 Fruit St, Orchard City, 23456', 0.00, 'Active', '2024-11-19 07:00:00'),
(10, 'Tommy’s Veggie Shop', 'Organic vegetables', 14, 'upload/store/store14.png', '456 Veggie Ln, Green Valley, 23457', 0.00, 'Active', '2024-11-19 07:01:00'),
(11, 'Penny’s Bakery', 'Freshly baked goods and pastries', 15, 'asset/store.jpg', '789 Bread Ave, Bakerstown, 23458', 0.00, 'Active', '2024-11-19 07:02:00'),
(12, 'Randy’s Pastry Haven', 'Handmade artisanal pastries', 16, 'asset/store.jpg', '123 Cake St, Sweet Town, 23459', 0.00, 'Active', '2024-11-19 07:03:00'),
(13, 'Luna’s Ready Meals', 'Quick and tasty ready-to-eat meals', 7, 'upload/store/store13.png', '789 Meal Blvd, Fast City, 23460', 0.00, 'Active', '2024-11-19 07:04:00'),
(14, 'Olivia’s Meal Corner', 'Delicious meal options for all ages', 18, 'upload/store/store14.jpg', '123 Meal Ln, Comfort City, 23461', 0.00, 'Active', '2024-11-19 07:05:00'),
(15, 'Riko’s Meat Emporium', 'Premium deli meats and sausages', 19, 'upload/store/store15.jpg', '456 Meat St, Carnivore City, 23462', 0.00, 'Active', '2024-11-19 07:06:00'),
(16, 'Kevin’s Butcher Shop', 'Fresh cuts of meats and steaks', 20, 'upload/store/store16.png', '789 Steak Rd, Prime Town, 23463', 2.00, 'Active', '2024-11-19 07:07:00'),
(17, 'Sauce World', 'A store that offers a variety of sauces for all your cooking needs', 21, 'upload/store/store17.jpeg', 'Jl. Sauces No. 5, Gading Serpong', 0.00, 'Active', '2024-11-19 15:28:20'),
(18, 'The Spicy Shop', 'For lovers of spicy sauces', 22, 'upload/store/store18.jpg', 'Jl. Spicy No. 10, Gading Serpong', 0.00, 'Active', '2024-11-19 15:28:20'),
(19, 'Sweet Temptations', 'Delicious and irresistible desserts for all occasions', 23, 'upload/store/store19.jpg', 'Jl. Manis No. 8, Gading Serpong', 0.00, 'Active', '2024-11-19 15:28:20'),
(20, 'Sugar Rush', 'The best desserts in town, made with love', 24, 'upload/store/store20.jpeg', 'Jl. Gula No. 12, Gading Serpong', 0.00, 'Active', '2024-11-19 15:28:20'),
(21, 'Snack Attack', 'A wide variety of snacks from savory to sweet', 25, 'upload/store/store21.jpeg', 'Jl. Snack No. 3, Gading Serpong', 0.00, 'Active', '2024-11-19 15:28:20'),
(22, 'Crunchy Bites', 'Crunchy snacks to satisfy your cravings', 26, 'upload/store/store22.jpg', 'Jl. Crunch No. 7, Gading Serpong', 0.00, 'Active', '2024-11-19 15:28:20'),
(23, 'Beverage Bar', 'A selection of cold and hot beverages', 27, 'upload/store/store23.jpeg', 'Jl. Drink No. 2, Gading Serpong', 0.00, 'Active', '2024-11-19 15:28:20'),
(24, 'The Juice Spot', 'Fresh juices and smoothies made daily', 28, 'upload/store/store24.png', 'Jl. Juice No. 6, Gading Serpong', 0.00, 'Active', '2024-11-19 15:28:20'),
(25, 'Shani\'s Store', 'Menjual Berbagai Aneka Roti terenak di gading serpong', 29, 'upload/store/Store___1732159298.jpeg', 'Jln Pahlawan No. 55', 5.00, 'Active', '2024-11-21 03:21:38'),
(26, 'Wilsen\'s Store', 'Toko pempek terbaik di jambi', 30, 'upload/store/Store___1732172488.jpg', 'Jalan Pahlawan No. 29', 4.00, 'Active', '2024-11-21 07:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending',
  `status_updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `user_id`, `store_id`, `transaction_date`, `total_amount`, `payment_status`, `status_updated_at`, `payment_method`) VALUES
(1, 1, 1, '2024-11-09 14:45:00', 7.00, 'completed', '2024-11-09 14:45:00', ''),
(2, 1, 2, '2024-11-09 14:45:00', 5.00, 'completed', '2024-11-09 14:45:00', ''),
(9, 2, 1, '2024-11-16 18:48:48', 3.50, 'completed', '2024-11-16 18:48:48', 'cod'),
(10, 7, 1, '2024-11-16 18:52:20', 5.00, 'completed', '2024-11-16 18:52:20', 'cod'),
(11, 1, 1, '2024-11-16 19:18:54', 5.00, 'completed', '2024-11-16 19:18:54', 'qris'),
(12, 1, 1, '2024-11-16 19:39:09', 5.00, 'completed', '2024-11-16 19:39:09', 'cod'),
(13, 8, 1, '2024-11-16 19:48:29', 3.50, 'completed', '2024-11-16 19:48:29', 'qris'),
(14, 8, 1, '2024-11-16 19:59:15', 3.50, 'completed', '2024-11-16 19:59:15', 'cod'),
(15, 8, 1, '2024-11-16 20:05:55', 7.00, 'completed', '2024-11-16 20:05:55', 'qris'),
(16, 2, 1, '2024-11-17 03:36:53', 3.50, 'completed', '2024-11-17 03:36:53', 'cod'),
(17, 2, 1, '2024-11-17 03:41:35', 7.00, 'completed', '2024-11-17 03:41:35', 'cod'),
(18, 2, 1, '2024-11-17 03:44:37', 5.00, 'completed', '2024-11-17 03:44:37', 'cod'),
(19, 2, 1, '2024-11-17 03:46:48', 5.00, 'pending', '2024-11-17 03:46:48', 'cod'),
(20, 2, 2, '2024-11-17 04:04:21', 5.00, 'completed', '2024-11-17 04:04:21', 'cod'),
(21, 2, 2, '2024-11-17 04:05:14', 15.00, 'completed', '2024-11-17 04:05:14', 'cod'),
(22, 2, 1, '2024-11-17 11:31:46', 7.00, 'completed', '2024-11-17 11:31:46', 'cod'),
(23, 2, 1, '2024-11-18 03:19:08', 10.50, 'completed', '2024-11-18 03:19:08', 'cod'),
(24, 2, 2, '2024-11-18 03:26:33', 15.00, 'pending', '2024-11-18 03:26:33', 'cod'),
(25, 2, 1, '2024-11-18 07:03:45', 14.00, 'completed', '2024-11-18 07:03:45', 'cod'),
(26, 8, 1, '2024-11-18 07:10:23', 7.00, 'pending', '2024-11-18 07:10:23', 'cod'),
(27, 10, 6, '2024-11-19 14:37:10', 30000.00, 'pending', '2024-11-19 14:37:10', 'cod'),
(28, 3, 6, '2024-11-19 17:59:20', 30000.00, 'completed', '2024-11-19 17:59:20', 'cod'),
(30, 26, 6, '2024-11-20 03:54:20', 10000.00, 'completed', '2024-11-20 03:54:20', 'cod'),
(33, 12, 6, '2024-11-20 04:35:22', 30000.00, 'completed', '2024-11-20 04:35:22', 'cod'),
(34, 3, 25, '2024-11-21 03:26:52', 30000.00, 'completed', '2024-11-21 03:26:52', 'cod'),
(35, 3, 25, '2024-11-21 03:36:22', 30000.00, 'completed', '2024-11-21 03:36:22', 'cod'),
(36, 3, 1, '2024-11-21 03:39:40', 10000.00, 'completed', '2024-11-21 03:39:40', 'cod'),
(37, 3, 25, '2024-11-21 03:43:04', 15000.00, 'completed', '2024-11-21 03:43:04', 'cod'),
(38, 3, 16, '2024-11-21 03:56:39', 80000.00, 'completed', '2024-11-21 03:56:39', 'cod'),
(39, 3, 26, '2024-11-21 07:04:10', 90000.00, 'completed', '2024-11-21 07:04:10', 'cod');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_item`
--

CREATE TABLE `transaction_item` (
  `transaction_item_id` int(11) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_item`
--

INSERT INTO `transaction_item` (`transaction_item_id`, `transaction_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 2, 3.50),
(2, 2, 2, 1, 5.00),
(3, 13, 1, 1, 3.50),
(4, 14, 1, 1, 3.50),
(5, 15, 1, 2, 3.50),
(6, 16, 1, 1, 3.50),
(7, 17, 1, 2, 3.50),
(8, 18, 2, 1, 5.00),
(9, 19, 2, 1, 5.00),
(10, 20, 2, 1, 5.00),
(11, 21, 2, 3, 5.00),
(12, 22, 1, 2, 3.50),
(13, 23, 1, 3, 3.50),
(14, 24, 2, 3, 5.00),
(15, 25, 1, 4, 3.50),
(16, 26, 1, 2, 3.50),
(17, 27, 7, 1, 5000.00),
(18, 27, 8, 1, 25000.00),
(19, 28, 8, 1, 25000.00),
(20, 28, 7, 1, 5000.00),
(26, 33, 7, 1, 5000.00),
(27, 33, 8, 1, 25000.00),
(28, 34, 49, 2, 15000.00),
(29, 35, 49, 2, 15000.00),
(30, 36, 1, 1, 10000.00),
(31, 37, 49, 1, 15000.00),
(32, 38, 31, 1, 80000.00),
(33, 39, 51, 2, 45000.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `user_role` enum('Buyer','Seller') DEFAULT NULL,
  `siup` varchar(255) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `account_status` enum('Pending','Approved','Rejected') DEFAULT NULL,
  `admin_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `gender`, `date_of_birth`, `profile_picture`, `user_role`, `siup`, `registration_date`, `account_status`, `admin_notes`) VALUES
(1, 'Lucinta', 'Luna', 'luna@gmail.com', 'ba8a48b0e34226a2992d871c65600a7c', '085600552312', 'Female', '1989-06-16', 'upload/profile/user1.jpg', 'Buyer', NULL, '2024-11-09', NULL, NULL),
(2, 'Timothy', 'Ronald', 'ronald@gmail.com', '5af0a0feb2094f43bebb50c518c1ebfe', '08123456789', 'Male', '2000-09-22', 'upload/profile/user2.jpg', 'Seller', 'siup_document/SIUP_Timothy_1731160761.jpg', '2024-11-09', 'Approved', NULL),
(3, 'Raditya', 'Dika Nasution', 'dika@gmail.com', 'e9ce15bcebcedde2cb3cf9fe8f84fc0c', '0822778899', 'Male', '1984-12-28', 'upload/profile/Profile_RadityaDika_1732168501.jpg', 'Seller', 'siup_document/SIUP_Raditya_1731161001.jpg', '2024-11-09', 'Approved', NULL),
(4, 'Ferry', 'Irwandi', 'irwandi@gmailcom', '0e7b072697323530075cf492d0c5c121', '0899887766', 'Male', '1980-11-01', 'upload/profile/user4.jpg', 'Seller', 'siup_document/SIUP_Ferry_1731161411.jpg', '2024-11-09', 'Approved', NULL),
(5, 'Nagita', 'Slavina', 'slavina@gmail.com', 'eceea8ece9fadc3136be9b6993eb4103', '0866775544', 'Female', '1988-02-17', 'upload/profile/user5.jpeg', 'Seller', 'siup_document/SIUP_Nagita_1731162404.jpg', '2024-11-09', 'Approved', NULL),
(6, 'Pandji', 'Pragiwaksono', 'pandji.pragiwaksono@gmail.com', '482c811da5d5b4bc6d497ffa98491e38', '081342496844', 'Male', '2005-03-03', 'upload/profile/user6.jpg', 'Buyer', NULL, '2024-11-16', NULL, NULL),
(7, 'Abdur', 'Arsyad', 'abdur@gmail.com', '698d51a19d8a121ce581499d7b701668', '081342496843', 'Male', '2020-11-20', 'upload/profile/user7.jpg', 'Seller', 'siup_document/SIUP_Abdur_1731775700.png', '2024-11-16', 'Approved', NULL),
(8, 'Gabriela', 'Abigail', 'gabby@gmail.com', '698d51a19d8a121ce581499d7b701668', '081342496844', 'Female', '2006-08-07', 'upload/profile/user8.jpeg', 'Buyer', NULL, '2024-11-16', NULL, NULL),
(9, 'Ash', 'Ketchum', 'ash@gmail.com', '2852f697a9f8581725c6fc6a5472a2e5', '088888888888', 'Female', '2024-11-19', 'upload/profile/user9.jpeg', 'Seller', 'siup_document/SIUP_AshKetchum_1732018672.jpg', '0000-00-00', 'Approved', NULL),
(10, 'Yosua', 'Rheinheart', 'yosua@gmail.com', '0a810b127cc9448c08522476682769ca', '08123456789021', 'Male', '1998-12-25', 'profile_pictures/1h7YH3yWPzqmZ3miVrJ76iqmSvtKz7FRB5B5R4yI.jpg', 'Seller', 'siup_document/SIUP_YosuaRheinhart_1732026075.jpg', '0000-00-00', 'Approved', NULL),
(11, 'Adhitganz', 'Prasethio', 'adt@gmail.com', '018c0257ca7d132785ef77637a7e98c4', '0899999999999', 'Male', '2005-05-08', 'profile_pictures/Gz44TSdIRZhLaAMctL2rOW7Mbwnwv21RSGuBoSZh.jpg', 'Seller', 'siup_document/SIUP_AdhityaPrasetyo_1732027400.jpg', '0000-00-00', 'Approved', NULL),
(12, 'Cristiano', 'Ronaldo', 'cr7@gmail.com', 'c9178aa682eadb31aa6d77e85c8cd9c6', '7777777777', 'Male', '2007-07-07', 'upload/profile/user12.jpeg', 'Seller', 'siup_document/SIUP_CristianoRonaldo_1732027766.jpg', '0000-00-00', 'Approved', NULL),
(13, 'Maria', 'Angelina', 'maria@gmail.com', '263bce650e68ab4e23f28263760b9fa5', '08999999990', 'Female', '2007-10-09', 'upload/profile/user13.jpeg', 'Seller', 'siup_document/SIUP_MariaAngelina_1732030500.jpg', '0000-00-00', 'Approved', NULL),
(14, 'Tommy', 'Shelby', 'tommy@gmail.com', '65f185ec6bd47af8f082f8196d0b4d24', '0812903485720', 'Male', '1991-09-04', 'upload/profile/user14.jpg', 'Seller', 'siup_document/SIUP_TommyShelby_1732030542.jpg', '0000-00-00', 'Approved', NULL),
(15, 'Penny', 'Marselino', 'penny@gmail.com', '0af9964dc8540ea6f1eef1150bb3a717', '08765432190', 'Male', '1963-10-09', 'upload/profile/user15.jpg', 'Seller', 'siup_document/SIUP_PennyMarselino_1732030597.jpg', '0000-00-00', 'Approved', NULL),
(16, 'Randy', 'Orton', 'randy@gmail.com', '163218e536c13ff2fc9a4d76e34be085', '082954762093758', 'Male', '1988-12-14', 'upload/profile/user16.jpg', 'Seller', 'siup_document/SIUP_RandyOrton_1732030631.jpg', '0000-00-00', 'Approved', NULL),
(18, 'Olivia', 'Clarissa', 'olivia@gmail.com', '47bc17dc1a2f164967f55325d866c75c', '089034271823', 'Female', '2019-10-15', 'upload/profile/user18.jpeg', 'Seller', 'siup_document/SIUP_OliviaClarissa_1732030744.jpg', '0000-00-00', 'Approved', NULL),
(19, 'Riko', 'Simanjuntak', 'riko@gmail.com', '206e8e5e74a2a33379e0e2be7f2ce6d1', '089029384671894', 'Male', '2007-10-10', 'upload/profile/user19.jpg', 'Seller', 'siup_document/SIUP_RikoSimanjuntak_1732030777.png', '0000-00-00', 'Approved', NULL),
(20, 'Kevin', 'Antonius', 'kevin@gmail.com', '9d5e3ecdeb4cdb7acfd63075ae046672', '082738104921', 'Male', '2000-08-16', 'upload/profile/user20.jpg', 'Seller', 'siup_document/SIUP_KevinAntonius_1732030849.jpg', '0000-00-00', 'Approved', NULL),
(21, 'Meldean', 'Jonathan', 'meldean@gmail.com', 'c60a18fcdb33364aa3975ecadd5f0ce5', '081278392019', 'Male', '2005-12-26', 'upload/profile/user21.jpg', 'Seller', 'siup_document/SIUP_MeldeanJonathan_1732030907.jpg', '0000-00-00', 'Approved', NULL),
(22, 'Fransesco', 'Bagnaia', '1@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '089902930192', 'Male', '2003-10-15', 'upload/profile/user22.jpg', 'Seller', 'siup_document/SIUP_FransescoBagnaia_1732030971.png', '0000-00-00', 'Approved', NULL),
(23, 'Cussons', 'Baby', 'cussons@gmail.com', '8ee42aa5c2fc2cbdf0033a890e68cb20', '08192039475', 'Male', '2024-11-21', 'upload/profile/user23.jpg', 'Seller', 'siup_document/SIUP_CussonsBaby_1732031041.jpg', '0000-00-00', 'Approved', NULL),
(24, 'Clara', 'Kim', 'clara@gmail.com', '23d1e10df85ef805b442a922b240ce25', '08902319481903', 'Female', '1995-10-17', 'upload/profile/user24.jpeg', 'Seller', 'siup_document/SIUP_ClaraKim_1732031077.jpg', '0000-00-00', 'Approved', NULL),
(25, 'Jonathan', 'Liandi', 'jonathan@gmail.com', '78842815248300fa6ae79f7776a5080a', '08293482372852', 'Male', '1999-10-18', 'upload/profile/user25.jpg', 'Seller', 'siup_document/SIUP_JonathanLiandi_1732031127.jpg', '0000-00-00', 'Approved', NULL),
(26, 'Nastasia', 'Adeline', 'adel@gmail.com', '94c93d4f9686cfeae29e9cbc3230cbf9', '08293402848', 'Female', '2004-09-19', 'upload/profile/user26.jpeg', 'Seller', 'siup_document/SIUP_NastasiaAdeline_1732031178.png', '0000-00-00', 'Approved', NULL),
(27, 'Aldean', 'Tegar', 'deankt@gmail.com', '9bc93b2305f5ebaa2aa323d3965a24ec', '082934029472', 'Male', '2011-10-12', 'asset/profile.png', 'Seller', 'siup_document/SIUP_AldeanTegar_1732031208.png', '0000-00-00', 'Approved', NULL),
(28, 'Gabriella', 'Christine', 'gab@gmail.com', '639bee393eecbc62256936a8e64d17b1', '08293402948', 'Female', '2000-11-09', 'asset/profile.png', 'Seller', 'siup_document/SIUP_GabriellaChristine_1732031298.png', '0000-00-00', 'Approved', NULL),
(29, 'Shani', 'Indira', 'shani@gmail.com', 'e51676fc29af8a3cff40acab1e37a2ef', '082366438290', 'Female', '2005-12-21', 'upload/profile/Profile_ShaniIndira_1732159427.jpeg', 'Seller', 'siup_document/SIUP_ShaniIndira_1732159052.jpg', '0000-00-00', 'Approved', NULL),
(30, 'Wilsen', 'Oktavianus', 'wilsen@gmail.com', '480a30ed38bdc030ecb781585c6e49a1', '081342496876', 'Male', '2000-11-19', 'asset/profile.png', 'Seller', 'siup_document/SIUP_WilsenOktavianus_1732172386.jpg', '0000-00-00', 'Approved', NULL),
(42, 'Marsha', 'Lenathea', 'jkt48@gmail.com', '3af3b3221714103a593acc24ae213767', '088277778888', 'Male', '2024-12-04', NULL, 'Seller', 'siup_documents/S0rBBth56YPvecV81WLabgGmL8oxyQ5iGTY13FzM.png', '2024-12-04', 'Pending', NULL),
(43, 'lol', 'w', 'lol@gmail.com', 'c3ec0f7b054e729c5a716c8125839829', '22222222', 'Male', '2222-02-22', NULL, 'Buyer', NULL, '2024-12-04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `transaction_item`
--
ALTER TABLE `transaction_item`
  ADD PRIMARY KEY (`transaction_item_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `rating_review`
--
ALTER TABLE `rating_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `transaction_item`
--
ALTER TABLE `transaction_item`
  MODIFY `transaction_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`),
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD CONSTRAINT `rating_review_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`),
  ADD CONSTRAINT `rating_review_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `rating_review_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`);

--
-- Constraints for table `transaction_item`
--
ALTER TABLE `transaction_item`
  ADD CONSTRAINT `transaction_item_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`),
  ADD CONSTRAINT `transaction_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

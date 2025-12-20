-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2025 at 04:38 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keyboard_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keyboards`
--

CREATE TABLE `keyboards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `switch_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `layout` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `connection` enum('wired','wireless','hybrid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'wired',
  `hot_swappable` tinyint(1) NOT NULL DEFAULT '0',
  `price` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `release_date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keyboards`
--

INSERT INTO `keyboards` (`id`, `name`, `brand`, `switch_type`, `layout`, `connection`, `hot_swappable`, `price`, `stock`, `release_date`, `description`, `image_url`, `created_at`, `updated_at`) VALUES
(43, 'Aurora 65 Keyboard', 'GMK', 'Gateron Blue', '75%', 'wired', 0, 3219794, 4, '1979-08-05', 'Nihil explicabo in nihil reprehenderit. Quo praesentium non corporis eligendi ut aperiam. Consectetur enim doloribus ipsum recusandae aut.', 'keyboard-images/1765979714-keyboard_1.jpg', '2025-12-17 05:30:57', '2025-12-19 23:35:54'),
(44, 'Velvet 75 Keyboard', 'Razer', 'Gateron Blue', 'TKL', 'wireless', 1, 2399733, 27, '1979-07-28', 'Doloremque est explicabo natus asperiores rerum et. Illum tempora iusto iste accusantium perferendis nesciunt quo. Corporis voluptatum quaerat facere nihil.', 'keyboard-images/1765979728-keyboard_3.jpg', '2025-12-17 05:30:57', '2025-12-17 06:55:28'),
(45, 'Zenith 75 Keyboard', 'Keychron', 'Gateron Brown', 'Fullsize', 'hybrid', 1, 3313671, 48, '1971-06-10', 'Aut quam mollitia laboriosam ea cum vero. Quam nulla in numquam temporibus molestiae quisquam. Quo cupiditate harum qui. Vitae animi et et aliquid autem molestiae nam praesentium.', 'keyboard-images/1765979768-keyboard_7.jpg', '2025-12-17 05:30:57', '2025-12-17 06:56:08'),
(46, 'Zenith 75 Keyboard', 'Keychron', 'Gateron Brown', 'TKL', 'wireless', 1, 2660661, 4, '1981-08-08', 'Vero aliquid modi ullam earum. In autem rerum unde excepturi. Ut dolor nihil cum velit.', 'keyboard-images/1765979777-keyboard_12.jpg', '2025-12-17 05:30:57', '2025-12-17 06:56:17'),
(47, 'Zenith Full Keyboard', 'Razer', 'Gateron Brown', '60%', 'wireless', 1, 1970946, 3, '2019-08-02', 'Delectus officiis dolores incidunt molestiae vero. Nisi quasi excepturi et doloremque. Officia quod fugit distinctio officiis cum aut possimus. Et explicabo culpa dolor nobis et facere vitae.', 'keyboard-images/1765979786-keyboard_13.jpg', '2025-12-17 05:30:57', '2025-12-17 06:56:26'),
(48, 'Nimbus TKL Keyboard', 'Ducky', 'Holy Panda', 'TKL', 'wired', 0, 3051343, 34, '1976-08-13', 'Cumque magni et amet qui sit omnis. Qui vel dicta itaque. Veritatis voluptas vitae ut sint.', 'keyboard-images/1765979796-keyboard_14.jpg', '2025-12-17 05:30:57', '2025-12-17 10:11:07'),
(49, 'Velvet Full Keyboard', 'Akko', 'Holy Panda', '75%', 'wireless', 1, 960407, 0, '1987-08-01', 'Ratione quam quam tempora tempora fugit eveniet est. Voluptatem consequuntur voluptatem omnis repellendus porro quidem minima. Ex iste optio et doloribus. Cum quibusdam ut et et. Et et qui aut distinctio ducimus adipisci animi officiis.', 'keyboard-images/1765979807-keyboard_15.jpg', '2025-12-17 05:30:57', '2025-12-19 12:13:34'),
(52, 'Aurora 75 Keyboard', 'Razer', 'Holy Panda', 'Fullsize', 'wireless', 1, 2709894, 0, '2024-11-06', 'Vero molestiae perspiciatis magni blanditiis nemo voluptatem. Sunt sint deserunt neque sed. Ullam non quia accusamus et et. Qui laborum sint velit repellat ut.', 'keyboard-images/1765979836-keyboard_61.jpg', '2025-12-17 05:30:57', '2025-12-17 06:57:16'),
(53, 'Luminous 65 Keyboard', 'Keychron', 'Gateron Brown', 'Fullsize', 'wireless', 0, 2919870, 46, '1979-11-01', 'Aperiam cum maxime autem explicabo. Reiciendis possimus nihil natus ullam corrupti. Doloremque et perferendis vel dignissimos ex aut sint ipsam.', 'keyboard-images/1765979851-keyboard_63.jpg', '2025-12-17 05:30:57', '2025-12-17 06:57:31'),
(54, 'Nebula 75 Keyboard', 'Keychron', 'Gateron Brown', '60%', 'wired', 0, 2246314, 35, '2013-03-04', 'Sed dolor maiores officiis sed corporis eos qui. Voluptatum in dolorem eum cupiditate labore consectetur veniam at. Facilis quisquam fugit numquam molestias officia. Et quidem maxime aliquid ut earum magni ratione.', 'keyboard-images/1765986087-keyboard_52.jpg', '2025-12-17 05:30:57', '2025-12-17 08:41:27'),
(55, 'Nimbus 65 Keyboard', 'Keychron', 'Gateron Brown', '65%', 'wireless', 1, 1761877, 28, '1986-07-15', 'Laudantium ipsam aliquid sed aut quae enim itaque. Totam eius vel quidem dolores expedita nemo amet qui. Exercitationem voluptatum accusantium aut magni.', 'keyboard-images/1765986577-keyboard_94.jpg', '2025-12-17 05:30:57', '2025-12-17 08:49:37'),
(56, 'Velvet Full Keyboard', 'Razer', 'Holy Panda', 'Fullsize', 'wireless', 1, 3394087, 48, '1999-12-28', 'Ut maiores ea exercitationem. Voluptas itaque iusto dolor sed voluptatem. Asperiores qui dolore ducimus officia.', 'keyboard-images/1765986590-keyboard_89.jpg', '2025-12-17 05:30:57', '2025-12-19 23:34:30'),
(57, 'Zenith Full Keyboard', 'Akko', 'Gateron Blue', 'TKL', 'wireless', 0, 1903350, 44, '2010-12-12', 'Esse tempora minus sunt. Eaque et voluptatem non impedit reprehenderit repellendus. Libero laboriosam consequatur sit.', 'keyboard-images/1765986602-keyboard_90.jpg', '2025-12-17 05:30:57', '2025-12-17 08:50:02'),
(58, 'Nimbus Full Keyboard', 'Akko', 'Kailh Box White', 'Fullsize', 'hybrid', 1, 1611982, 14, '1987-06-11', 'Aut dolores quod qui cupiditate delectus. Numquam harum odit unde laudantium qui est ad. Magni est provident qui enim.', 'keyboard-images/1765986611-keyboard_99.jpg', '2025-12-17 05:30:57', '2025-12-17 08:50:11'),
(59, 'Nebula TKL Keyboard', 'Razer', 'Gateron Blue', '60%', 'wired', 0, 2890507, 17, '2019-02-05', 'Veritatis ut voluptate repudiandae officia. Ipsum fuga reiciendis nam et reiciendis perspiciatis. Repellendus totam recusandae odit optio dolorem est quo perferendis. Non soluta veritatis cupiditate quis dolorem quae.', 'keyboard-images/1765986619-keyboard_88.jpg', '2025-12-17 05:30:57', '2025-12-17 08:50:19'),
(60, 'Velvet 65 Keyboard', 'Keychron', 'Kailh Box White', '65%', 'wireless', 0, 1580680, 17, '1972-09-05', 'Id et quam cum ab amet. Inventore dolore ad cumque vel. Aliquam id exercitationem occaecati eum aut accusantium hic.', 'keyboard-images/1765986631-keyboard_82.jpg', '2025-12-17 05:30:57', '2025-12-17 08:50:31'),
(61, 'Nebula Full Keyboard', 'Logitech', 'Holy Panda', 'Fullsize', 'hybrid', 0, 2555774, 36, '1989-12-01', 'Saepe dolorum totam deserunt eligendi aut excepturi. Aliquid voluptas omnis aut quas. Quia neque totam laboriosam esse.', 'keyboard-images/1765986643-keyboard_95.jpg', '2025-12-17 05:30:57', '2025-12-17 08:50:43'),
(62, 'Zenith Full Keyboard', 'GMK', 'Gateron Blue', '60%', 'hybrid', 0, 2737180, 32, '2009-01-20', 'Itaque quas provident quia. Fuga doloribus in in quae. Provident praesentium et illum molestias velit.', 'keyboard-images/1765986685-keyboard_83.jpg', '2025-12-17 05:30:57', '2025-12-17 08:51:25'),
(63, 'Nebula 65 Keyboard', 'Akko', 'Cherry MX Red', '65%', 'wireless', 0, 1586356, 33, '2010-09-18', 'Nihil a ea accusamus et unde ut assumenda. Est pariatur qui voluptatibus repellendus rerum dolore. Sequi eum voluptatibus illo aperiam asperiores. Ratione assumenda voluptatum veritatis et et maiores hic.', 'keyboard-images/1765986696-keyboard_74.jpg', '2025-12-17 05:30:57', '2025-12-17 08:51:36'),
(64, 'Velvet 75 Keyboard', 'Logitech', 'Gateron Brown', '75%', 'wireless', 1, 895942, 0, '2019-08-13', 'Ut libero unde commodi magni id neque nostrum. Similique voluptas explicabo odio dicta. Ratione omnis nobis aliquam aut vel in voluptas. Numquam et ea perspiciatis vel sunt corrupti maxime quaerat.', 'keyboard-images/1765986710-keyboard_64.jpg', '2025-12-17 05:30:57', '2025-12-19 22:26:26'),
(65, 'Nimbus Full Keyboard', 'Logitech', 'Gateron Brown', '60%', 'wired', 0, 1838147, 19, '1997-01-21', 'Provident doloribus et ex reprehenderit quo recusandae illum. Repellat nulla praesentium ratione nihil iste. Error quos sit repudiandae est id corporis. Sunt voluptatem explicabo voluptatem id fuga eum.', 'keyboard-images/1765987212-keyboard_30.jpg', '2025-12-17 05:30:57', '2025-12-17 09:00:12'),
(66, 'Nimbus 65 Keyboard', 'GMK', 'Cherry MX Red', 'TKL', 'hybrid', 1, 2911031, 34, '2014-06-11', 'Tempore eos doloribus cupiditate illum quos. Ab consequatur ut quia quis laborum officia. Voluptas recusandae qui architecto quod expedita at est. Corrupti animi nam rem magnam. Eveniet nobis mollitia in temporibus voluptas sit sit.', 'keyboard-images/1765987017-keyboard_89.jpg', '2025-12-17 05:30:57', '2025-12-17 08:56:57'),
(67, 'Velvet 75 Keyboard', 'Keychron', 'Cherry MX Red', 'TKL', 'hybrid', 0, 2735346, 15, '2011-03-21', 'Natus ullam nobis itaque natus quasi ad fugiat accusamus. Cupiditate neque quibusdam laborum voluptas et. Aut ipsam dolorum dolorem tempora. Id corrupti est fugiat eos.', 'keyboard-images/1765987074-keyboard_83.jpg', '2025-12-17 05:30:57', '2025-12-17 08:57:54'),
(68, 'Aurora 65 Keyboard', 'Keychron', 'Holy Panda', '75%', 'wired', 0, 2317380, 17, '1977-09-07', 'Minus perspiciatis et laudantium nihil dolore. Labore vitae qui itaque aliquid architecto. Exercitationem tenetur voluptatem reiciendis magnam.', 'keyboard-images/1765987098-keyboard_95.jpg', '2025-12-17 05:30:57', '2025-12-17 08:58:18'),
(69, 'Nebula 75 Keyboard', 'Logitech', 'Kailh Box White', 'Fullsize', 'wired', 0, 1900544, 39, '1975-04-04', 'Tempore eum in facilis cupiditate et nihil asperiores. Omnis et repellendus sit ullam in. Quas aliquid quos molestiae soluta.', 'keyboard-images/1765987111-keyboard_36.jpg', '2025-12-17 05:30:57', '2025-12-17 08:58:31'),
(70, 'Nebula 65 Keyboard', 'Ducky', 'Holy Panda', '60%', 'wired', 1, 2357339, 8, '2004-11-23', 'Sapiente quia earum et ad voluptatibus quo sunt similique. Sed cupiditate aut quam rem repudiandae dicta atque. Nostrum accusantium veniam debitis quaerat.', 'keyboard-images/1765987120-keyboard_97.jpg', '2025-12-17 05:30:57', '2025-12-17 08:58:40'),
(71, 'Aurora Full Keyboard', 'Logitech', 'Gateron Brown', 'TKL', 'hybrid', 0, 1504410, 7, '1979-08-11', 'Ut aliquam quia et et sit. Ex ipsam adipisci et minus ut nulla. Non fugit suscipit et labore rerum labore. Animi consequuntur quia iure possimus non modi aspernatur voluptas.', 'keyboard-images/1765987131-keyboard_85.jpg', '2025-12-17 05:30:57', '2025-12-17 08:58:51'),
(72, 'Zenith 75 Keyboard', 'Keychron', 'Kailh Box White', '75%', 'wireless', 0, 1897200, 43, '1989-07-01', 'Veniam quis nostrum veritatis sint. Aut quia quidem dolor nihil qui. Id hic quod optio nemo fuga cupiditate.', 'keyboard-images/1765987145-keyboard_84.jpg', '2025-12-17 05:30:57', '2025-12-17 08:59:05'),
(73, 'Velvet 75 Keyboard', 'GMK', 'Cherry MX Red', '60%', 'wired', 1, 1882330, 1, '1995-01-26', 'Commodi veritatis est nemo quasi. Eveniet facere earum velit sed aut. Officiis enim omnis quia exercitationem in ratione non. Facilis voluptate expedita et excepturi voluptas.', 'keyboard-images/1765987059-keyboard_92.jpg', '2025-12-17 05:30:57', '2025-12-17 08:57:39'),
(74, 'Nebula 75 Keyboard', 'Logitech', 'Cherry MX Red', '65%', 'hybrid', 1, 2843012, 45, '2015-09-09', 'Illo officia ducimus enim magnam suscipit ratione. Magnam ab quis commodi repellat eum. Vitae ut et aut et commodi perspiciatis.', 'keyboard-images/1765987162-keyboard_86.jpg', '2025-12-17 05:30:57', '2025-12-17 08:59:22'),
(75, 'Velvet 65 Keyboard', 'Keychron', 'Gateron Brown', 'TKL', 'wired', 1, 1027619, 3, '1970-05-22', 'Velit modi consequatur animi libero aliquid. Aliquid voluptatem dolor nihil exercitationem eos. Doloremque nesciunt eligendi et aut nisi.', 'keyboard-images/1765986672-keyboard_24.jpg', '2025-12-17 05:30:57', '2025-12-17 08:51:12'),
(76, 'Aurora TKL Keyboard', 'Akko', 'Gateron Brown', '60%', 'wired', 0, 2675333, 14, '1978-08-04', 'Fugit et veniam et. Consequatur voluptatum quisquam nemo ipsum possimus natus voluptatem. Eius iure nostrum commodi ut dolorem sapiente qui labore.', 'keyboard-images/1765987191-keyboard_9.jpg', '2025-12-17 05:30:57', '2025-12-17 08:59:51'),
(77, 'Nimbus 75 Keyboard', 'Ducky', 'Gateron Blue', '65%', 'wired', 0, 3144221, 22, '1970-09-10', 'Voluptatibus veritatis blanditiis cum delectus. Porro et earum quis ex impedit natus qui.', 'keyboard-images/1765987199-keyboard_71.jpg', '2025-12-17 05:30:57', '2025-12-17 08:59:59'),
(78, 'Luminous TKL Keyboard', 'Razer', 'Kailh Box White', '65%', 'wireless', 0, 1862809, 33, '2006-09-22', 'Aperiam modi doloremque animi molestiae. Autem accusantium aut soluta dolor facere reprehenderit eum. Eligendi sint ipsam optio quo.', 'keyboard-images/1765987225-keyboard_82.jpg', '2025-12-17 05:30:57', '2025-12-17 09:00:25'),
(79, 'Velvet 75 Keyboard', 'Keychron', 'Gateron Brown', '75%', 'wireless', 0, 3250244, 40, '2022-10-18', 'Nam dicta eos quidem ipsa repellendus soluta harum. Aliquam cumque dolores ea similique. Molestias voluptatem voluptatem et magni aut. Nobis et earum aut magnam.', 'keyboard-images/1765987178-keyboard_32.jpg', '2025-12-17 05:30:57', '2025-12-17 08:59:38'),
(80, 'Velvet 75 Keyboard', 'Razer', 'Gateron Brown', '75%', 'wired', 0, 1029084, 49, '1988-06-03', 'Doloribus sunt accusamus architecto et quia quas nemo. Autem harum sit a vel dolor et qui temporibus. Quam molestiae consequuntur quaerat deleniti sint nam consequatur. Ut voluptatem voluptatem non.', 'keyboard-images/1765987241-keyboard_81.jpg', '2025-12-17 05:30:57', '2025-12-17 09:00:41'),
(81, 'Luminous TKL Keyboard', 'Akko', 'Holy Panda', 'Fullsize', 'wireless', 1, 1561338, 24, '1990-02-28', 'Itaque cum ut nisi facere non voluptatem. Dignissimos voluptate ea optio in fugiat tempore. Vitae natus est fugit eveniet qui debitis asperiores.', 'keyboard-images/1765987254-keyboard_75.jpg', '2025-12-17 05:30:57', '2025-12-17 09:00:54'),
(82, 'Nebula Full Keyboard', 'Ducky', 'Holy Panda', 'TKL', 'hybrid', 1, 1442732, 49, '1989-02-17', 'Aliquid ipsa nemo autem. Voluptatem accusantium est neque excepturi voluptas perspiciatis expedita enim. Dolor eum minus occaecati dolor dolor. Amet voluptatum non veritatis natus modi veritatis dolore.', 'keyboard-images/1765986657-keyboard_86.jpg', '2025-12-17 05:30:57', '2025-12-17 08:50:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2025_11_01_122850_create_keyboards_table', 1),
(5, '2025_12_15_143814_add_role_to_users_table', 2),
(6, '2025_12_15_194523_add_balance_and_address_to_users_table', 3),
(7, '2025_12_15_194536_create_topups_table', 3),
(8, '2025_12_15_194545_create_orders_table', 3),
(9, '2025_12_15_194551_create_notifications_table', 3),
(10, '2025_12_17_121014_add_stock_to_keyboards_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `title`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(16, 7, 'topup_requested', 'Permintaan Top-Up Dikirim', 'Permintaan top-up sebesar Rp5.000.000 telah dikirim. Menunggu persetujuan admin.', 1, '2025-12-17 06:04:09', '2025-12-17 09:34:34'),
(17, 7, 'topup_approved', 'Top-Up Disetujui', 'Permintaan top-up sebesar Rp5.000.000 telah disetujui. Saldo Anda telah ditambahkan.', 1, '2025-12-17 06:04:48', '2025-12-17 09:34:34'),
(18, 7, 'order_created', 'Pesanan Berhasil Dibuat', 'Pesanan #ORD-20251217-WQD7ZG untuk Velvet Full Keyboard (x1) berhasil dibuat. Total: Rp960.407', 1, '2025-12-17 06:08:10', '2025-12-17 09:34:34'),
(19, 7, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251217-WQD7ZG diperbarui menjadi: Dibatalkan. Saldo sebesar Rp960.407 telah dikembalikan ke akun Anda.', 1, '2025-12-17 06:10:06', '2025-12-17 09:34:34'),
(20, 7, 'order_created', 'Pesanan Berhasil Dibuat', 'Pesanan #ORD-20251217-GG8IYS untuk Zenith Full Keyboard (x1) berhasil dibuat. Total: Rp1.970.946', 1, '2025-12-17 06:11:41', '2025-12-17 09:34:34'),
(21, 7, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251217-GG8IYS diperbarui menjadi: Sedang Diproses.', 1, '2025-12-17 06:11:59', '2025-12-17 09:34:34'),
(22, 7, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251217-GG8IYS diperbarui menjadi: Sudah Dikirim.', 1, '2025-12-17 06:12:28', '2025-12-17 09:34:34'),
(23, 7, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251217-GG8IYS diperbarui menjadi: Dalam Distribusi.', 1, '2025-12-17 06:12:32', '2025-12-17 09:34:34'),
(24, 7, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251217-GG8IYS diperbarui menjadi: Sudah Sampai.', 1, '2025-12-17 06:12:36', '2025-12-17 09:34:34'),
(25, 7, 'order_created', 'Pesanan Berhasil Dibuat', 'Pesanan #ORD-20251217-ZOBKXC untuk Velvet Full Keyboard (x1) berhasil dibuat. Total: Rp960.407', 1, '2025-12-17 06:30:32', '2025-12-17 09:34:34'),
(26, 7, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251217-ZOBKXC diperbarui menjadi: Sedang Diproses.', 1, '2025-12-17 06:30:45', '2025-12-17 09:34:34'),
(27, 7, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251217-ZOBKXC diperbarui menjadi: Sudah Dikirim.', 1, '2025-12-17 06:31:27', '2025-12-17 09:34:34'),
(28, 7, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251217-ZOBKXC diperbarui menjadi: Dalam Distribusi.', 1, '2025-12-17 06:31:31', '2025-12-17 09:34:34'),
(29, 7, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251217-ZOBKXC diperbarui menjadi: Sudah Sampai.', 1, '2025-12-17 06:31:34', '2025-12-17 09:34:34'),
(30, 7, 'order_created', 'Pesanan Berhasil Dibuat', 'Pesanan #ORD-20251217-GBFVJ2 untuk Zenith Full Keyboard (x1) berhasil dibuat. Total: Rp1.903.350', 1, '2025-12-17 06:32:02', '2025-12-17 09:34:34'),
(31, 7, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251217-GBFVJ2 diperbarui menjadi: Dibatalkan. Saldo sebesar Rp1.903.350 telah dikembalikan ke akun Anda.', 1, '2025-12-17 06:32:20', '2025-12-17 09:34:34'),
(32, 7, 'order_created', 'Pesanan Berhasil Dibuat', 'Pesanan #ORD-20251217-CGTRZP untuk Zenith Full Keyboard (x1) berhasil dibuat. Total: Rp1.903.350', 1, '2025-12-17 06:32:34', '2025-12-17 09:34:34'),
(33, 7, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251217-CGTRZP diperbarui menjadi: Dibatalkan. Saldo sebesar Rp1.903.350 telah dikembalikan ke akun Anda.', 1, '2025-12-17 06:32:45', '2025-12-17 09:34:34'),
(34, 7, 'order_created', 'Pesanan Berhasil Dibuat', 'Pesanan #ORD-20251217-RAZPQD untuk Zenith Full Keyboard (x1) berhasil dibuat. Total: Rp1.903.350', 1, '2025-12-17 06:33:20', '2025-12-17 09:34:34'),
(35, 7, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251217-RAZPQD diperbarui menjadi: Sedang Diproses.', 1, '2025-12-17 06:33:51', '2025-12-17 09:34:27'),
(36, 7, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251217-RAZPQD diperbarui menjadi: Sudah Dikirim.', 1, '2025-12-17 09:50:29', '2025-12-17 09:50:45'),
(37, 7, 'order_created', 'Pesanan Berhasil Dibuat', 'Pesanan #ORD-20251217-D5T7IA untuk Nimbus TKL Keyboard (x1) berhasil dibuat. Total: Rp3.051.343', 1, '2025-12-17 10:10:32', '2025-12-17 10:10:42'),
(38, 7, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251217-D5T7IA diperbarui menjadi: Dibatalkan. Saldo sebesar Rp3.051.343 telah dikembalikan ke akun Anda.', 1, '2025-12-17 10:11:07', '2025-12-17 10:11:35'),
(39, 7, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251217-RAZPQD diperbarui menjadi: Dalam Distribusi.', 1, '2025-12-17 10:11:13', '2025-12-17 10:11:36'),
(40, 7, 'topup_requested', 'Permintaan Top-Up Dikirim', 'Permintaan top-up sebesar Rp200.000 telah dikirim. Menunggu persetujuan admin.', 1, '2025-12-17 10:12:31', '2025-12-17 10:13:06'),
(41, 7, 'topup_rejected', 'Top-Up Ditolak', 'Permintaan top-up sebesar Rp200.000 ditolak. Alasan: tidak masuk', 1, '2025-12-17 10:12:45', '2025-12-17 10:13:04'),
(42, 13, 'topup_requested', 'Permintaan Top-Up Dikirim', 'Permintaan top-up sebesar Rp5.000.000 telah dikirim. Menunggu persetujuan admin.', 1, '2025-12-19 11:37:45', '2025-12-19 11:40:43'),
(43, 13, 'topup_approved', 'Top-Up Disetujui', 'Permintaan top-up sebesar Rp5.000.000 telah disetujui. Saldo Anda telah ditambahkan.', 0, '2025-12-19 11:41:25', '2025-12-19 11:41:25'),
(44, 13, 'order_created', 'Pesanan Berhasil Dibuat', 'Pesanan #ORD-20251219-NKVPK7 untuk Zenith TKL Keyboard (x5) berhasil dibuat. Total: Rp4.306.270', 0, '2025-12-19 11:45:36', '2025-12-19 11:45:36'),
(45, 13, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251219-NKVPK7 diperbarui menjadi: Dibatalkan. Saldo sebesar Rp4.306.270 telah dikembalikan ke akun Anda.', 0, '2025-12-19 11:47:41', '2025-12-19 11:47:41'),
(46, 15, 'topup_requested', 'Permintaan Top-Up Dikirim', 'Permintaan top-up sebesar Rp5.000.000 telah dikirim. Menunggu persetujuan admin.', 1, '2025-12-19 12:05:54', '2025-12-19 12:06:04'),
(47, 15, 'topup_approved', 'Top-Up Disetujui', 'Permintaan top-up sebesar Rp5.000.000 telah disetujui. Saldo Anda telah ditambahkan.', 1, '2025-12-19 12:08:17', '2025-12-19 12:13:19'),
(48, 15, 'order_created', 'Pesanan Berhasil Dibuat', 'Pesanan #ORD-20251219-GWYNVI untuk Zenith TKL Keyboard (x4) berhasil dibuat. Total: Rp3.445.016', 1, '2025-12-19 12:09:32', '2025-12-19 12:13:19'),
(49, 7, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251217-RAZPQD diperbarui menjadi: Sudah Sampai.', 0, '2025-12-19 12:09:52', '2025-12-19 12:09:52'),
(50, 15, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251219-GWYNVI diperbarui menjadi: Dibatalkan. Saldo sebesar Rp3.445.016 telah dikembalikan ke akun Anda.', 1, '2025-12-19 12:10:08', '2025-12-19 12:13:19'),
(51, 15, 'order_created', 'Pesanan Berhasil Dibuat', 'Pesanan #ORD-20251219-8NH08V untuk Zenith TKL Keyboard (x4) berhasil dibuat. Total: Rp3.445.016', 1, '2025-12-19 12:11:19', '2025-12-19 12:13:19'),
(52, 15, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251219-8NH08V diperbarui menjadi: Sedang Diproses.', 1, '2025-12-19 12:11:29', '2025-12-19 12:13:19'),
(53, 15, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251219-8NH08V diperbarui menjadi: Sudah Dikirim.', 1, '2025-12-19 12:12:08', '2025-12-19 12:13:19'),
(54, 15, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251219-8NH08V diperbarui menjadi: Sudah Sampai.', 1, '2025-12-19 12:12:13', '2025-12-19 12:12:28'),
(55, 18, 'topup_requested', 'Permintaan Top-Up Dikirim', 'Permintaan top-up sebesar Rp5.000.000 telah dikirim. Menunggu persetujuan admin.', 1, '2025-12-19 20:14:01', '2025-12-19 20:16:34'),
(56, 18, 'topup_rejected', 'Top-Up Ditolak', 'Permintaan top-up sebesar Rp5.000.000 ditolak. Alasan: invalid', 1, '2025-12-19 20:17:24', '2025-12-19 20:19:02'),
(57, 18, 'topup_requested', 'Permintaan Top-Up Dikirim', 'Permintaan top-up sebesar Rp9.999.996 telah dikirim. Menunggu persetujuan admin.', 1, '2025-12-19 20:18:24', '2025-12-19 20:19:02'),
(58, 18, 'topup_approved', 'Top-Up Disetujui', 'Permintaan top-up sebesar Rp9.999.996 telah disetujui. Saldo Anda telah ditambahkan.', 1, '2025-12-19 20:18:46', '2025-12-19 20:19:02'),
(59, 18, 'order_created', 'Pesanan Berhasil Dibuat', 'Pesanan #ORD-20251220-2S69P7 untuk Zenith TKL Keyboard (x10) berhasil dibuat. Total: Rp8.612.540', 1, '2025-12-19 20:20:59', '2025-12-19 20:21:04'),
(60, 18, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251220-2S69P7 diperbarui menjadi: Dibatalkan. Saldo sebesar Rp8.612.540 telah dikembalikan ke akun Anda. Catatan: tidak bisa', 1, '2025-12-19 20:21:51', '2025-12-19 20:24:02'),
(61, 18, 'order_created', 'Pesanan Berhasil Dibuat', 'Pesanan #ORD-20251220-KKGIQM untuk Zenith TKL Keyboard (x10) berhasil dibuat. Total: Rp8.612.540', 1, '2025-12-19 20:24:23', '2025-12-19 20:24:45'),
(62, 18, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251220-KKGIQM diperbarui menjadi: Sudah Sampai. Catatan: asdasda', 0, '2025-12-19 20:24:40', '2025-12-19 20:24:40'),
(63, 21, 'topup_requested', 'Permintaan Top-Up Dikirim', 'Permintaan top-up sebesar Rp20.000.000 telah dikirim. Menunggu persetujuan admin.', 1, '2025-12-19 22:12:54', '2025-12-19 22:13:09'),
(64, 21, 'topup_rejected', 'Top-Up Ditolak', 'Permintaan top-up sebesar Rp20.000.000 ditolak. Alasan: invalid', 1, '2025-12-19 22:16:43', '2025-12-19 22:16:53'),
(65, 21, 'topup_requested', 'Permintaan Top-Up Dikirim', 'Permintaan top-up sebesar Rp20.000.000 telah dikirim. Menunggu persetujuan admin.', 1, '2025-12-19 22:17:41', '2025-12-19 22:18:10'),
(66, 21, 'topup_approved', 'Top-Up Disetujui', 'Permintaan top-up sebesar Rp20.000.000 telah disetujui. Saldo Anda telah ditambahkan.', 1, '2025-12-19 22:17:51', '2025-12-19 22:18:07'),
(67, 21, 'order_created', 'Pesanan Berhasil Dibuat', 'Pesanan #ORD-20251220-LFDICP untuk Velvet 75 Keyboard (x3) berhasil dibuat. Total: Rp2.687.826', 1, '2025-12-19 22:26:26', '2025-12-19 22:30:38'),
(68, 21, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251220-LFDICP diperbarui menjadi: Sedang Diproses. Catatan: asda', 1, '2025-12-19 22:28:38', '2025-12-19 22:30:38'),
(69, 21, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251220-LFDICP diperbarui menjadi: Sudah Sampai. Catatan: asda', 1, '2025-12-19 22:29:09', '2025-12-19 22:30:38'),
(70, 21, 'order_created', 'Pesanan Berhasil Dibuat', 'Pesanan #ORD-20251220-GWIC3L untuk Fantech Gaming Red (x1) berhasil dibuat. Total: Rp4.500.000', 0, '2025-12-19 22:34:43', '2025-12-19 22:34:43'),
(71, 21, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251220-GWIC3L diperbarui menjadi: Dibatalkan. Saldo sebesar Rp4.500.000 telah dikembalikan ke akun Anda.', 0, '2025-12-19 22:34:59', '2025-12-19 22:34:59'),
(72, 24, 'topup_requested', 'Permintaan Top-Up Dikirim', 'Permintaan top-up sebesar Rp10.000.000 telah dikirim. Menunggu persetujuan admin.', 1, '2025-12-19 23:22:13', '2025-12-19 23:27:21'),
(73, 24, 'topup_approved', 'Top-Up Disetujui', 'Permintaan top-up sebesar Rp10.000.000 telah disetujui. Saldo Anda telah ditambahkan.', 1, '2025-12-19 23:25:37', '2025-12-19 23:27:21'),
(74, 24, 'topup_requested', 'Permintaan Top-Up Dikirim', 'Permintaan top-up sebesar Rp100.000 telah dikirim. Menunggu persetujuan admin.', 1, '2025-12-19 23:26:47', '2025-12-19 23:27:21'),
(75, 24, 'topup_rejected', 'Top-Up Ditolak', 'Permintaan top-up sebesar Rp100.000 ditolak. Alasan: invalid', 1, '2025-12-19 23:27:03', '2025-12-19 23:27:15'),
(76, 24, 'order_created', 'Pesanan Berhasil Dibuat', 'Pesanan #ORD-20251220-INIH74 untuk Velvet Full Keyboard (x1) berhasil dibuat. Total: Rp3.394.087', 1, '2025-12-19 23:33:44', '2025-12-19 23:35:10'),
(77, 24, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251220-INIH74 diperbarui menjadi: Dibatalkan. Saldo sebesar Rp3.394.087 telah dikembalikan ke akun Anda. Catatan: tidak dijual', 1, '2025-12-19 23:34:30', '2025-12-19 23:35:03'),
(78, 24, 'order_created', 'Pesanan Berhasil Dibuat', 'Pesanan #ORD-20251220-0HSYPB untuk Aurora 65 Keyboard (x1) berhasil dibuat. Total: Rp3.219.794', 0, '2025-12-19 23:35:54', '2025-12-19 23:35:54'),
(79, 24, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251220-0HSYPB diperbarui menjadi: Sedang Diproses.', 0, '2025-12-19 23:36:41', '2025-12-19 23:36:41'),
(80, 24, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251220-0HSYPB diperbarui menjadi: Sudah Dikirim.', 0, '2025-12-19 23:37:46', '2025-12-19 23:37:46'),
(81, 24, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251220-0HSYPB diperbarui menjadi: Dalam Distribusi.', 0, '2025-12-19 23:37:58', '2025-12-19 23:37:58'),
(82, 24, 'order_status', 'Status Pesanan Diperbarui', 'Pesanan #ORD-20251220-0HSYPB diperbarui menjadi: Sudah Sampai.', 0, '2025-12-19 23:38:06', '2025-12-19 23:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `keyboard_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_item` decimal(15,2) NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','processing','shipped','in_distribution','delivered','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `keyboard_id`, `quantity`, `price_per_item`, `total_price`, `shipping_address`, `phone`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(4, 'ORD-20251217-WQD7ZG', 7, 49, 1, '960407.00', '960407.00', 'fghjkl;saflkjhdvbsanmc.;vawad', '0899087890876', 'cancelled', NULL, '2025-12-17 06:08:10', '2025-12-17 06:10:06'),
(5, 'ORD-20251217-GG8IYS', 7, 47, 1, '1970946.00', '1970946.00', 'fghjkl;saflkjhdvbsanmc.;vawad', '0899087890876', 'delivered', NULL, '2025-12-17 06:11:41', '2025-12-17 06:12:36'),
(6, 'ORD-20251217-ZOBKXC', 7, 49, 1, '960407.00', '960407.00', 'fghjkl;saflkjhdvbsanmc.;vawad', '0899087890876', 'delivered', NULL, '2025-12-17 06:30:32', '2025-12-17 06:31:34'),
(7, 'ORD-20251217-GBFVJ2', 7, 57, 1, '1903350.00', '1903350.00', 'fghjkl;saflkjhdvbsanmc.;vawad', '0899087890876', 'cancelled', NULL, '2025-12-17 06:32:02', '2025-12-17 06:32:20'),
(8, 'ORD-20251217-CGTRZP', 7, 57, 1, '1903350.00', '1903350.00', 'fghjkl;saflkjhdvbsanmc.;vawad', '0899087890876', 'cancelled', NULL, '2025-12-17 06:32:34', '2025-12-17 06:32:45'),
(9, 'ORD-20251217-RAZPQD', 7, 57, 1, '1903350.00', '1903350.00', 'fghjkl;saflkjhdvbsanmc.;vawad', '0899087890876', 'delivered', NULL, '2025-12-17 06:33:20', '2025-12-19 12:09:52'),
(10, 'ORD-20251217-D5T7IA', 7, 48, 1, '3051343.00', '3051343.00', 'fghjkl;saflkjhdvbsanmc.;vawad', '0899087890876', 'cancelled', NULL, '2025-12-17 10:10:32', '2025-12-17 10:11:07'),
(16, 'ORD-20251220-LFDICP', 21, 64, 3, '895942.00', '2687826.00', 'asdasdas', '08080080', 'delivered', 'asda', '2025-12-19 22:26:26', '2025-12-19 22:29:09'),
(18, 'ORD-20251220-INIH74', 24, 56, 1, '3394087.00', '3394087.00', 'asdasdasd as dasd as', '0812312312', 'cancelled', 'tidak dijual', '2025-12-19 23:33:44', '2025-12-19 23:34:30'),
(19, 'ORD-20251220-0HSYPB', 24, 43, 1, '3219794.00', '3219794.00', 'asdasdasd as dasd as', '0812312312', 'delivered', NULL, '2025-12-19 23:35:54', '2025-12-19 23:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topups`
--

CREATE TABLE `topups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `processed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `proof_image` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topups`
--

INSERT INTO `topups` (`id`, `user_id`, `amount`, `status`, `processed_by`, `reason`, `proof_image`, `created_at`, `updated_at`) VALUES
(4, 7, '5000000.00', 'approved', 2, 'Sesuai', 'topup-proofs/nEDOEfrat6k27oIGS0mFWHDpm7eo6RT9SjJNYQwv.jpg', '2025-12-17 06:04:09', '2025-12-17 06:04:48'),
(5, 7, '200000.00', 'rejected', 2, 'tidak masuk', 'topup-proofs/fyoi0eHS7bDmCybVMJaAsNKk5Bus3YPWjzaSKRsh.png', '2025-12-17 10:12:31', '2025-12-17 10:12:45'),
(6, 13, '5000000.00', 'approved', 14, 'Valid', 'topup-proofs/BPvJE0E9uePWKheBHDZm72NZJcBRXUs56VnFzogJ.png', '2025-12-19 11:37:45', '2025-12-19 11:41:25'),
(7, 15, '5000000.00', 'approved', NULL, 'Valid', 'topup-proofs/UhOlisgzXRAnMEpG7xHZfKBkzvhi7o38tGWdvRuG.png', '2025-12-19 12:05:54', '2025-12-19 12:08:17'),
(8, 18, '5000000.00', 'rejected', 19, 'invalid', 'topup-proofs/0e6edrjzcLckZGtzpwz2LDutmVeyJYREzYXTZuji.jpg', '2025-12-19 20:14:01', '2025-12-19 20:17:24'),
(9, 18, '9999996.00', 'approved', 19, 'valid', 'topup-proofs/NPMLzKoEorcyR24XwHL8cK06iWzk6xxq6BX4U9Ot.jpg', '2025-12-19 20:18:24', '2025-12-19 20:18:46'),
(10, 21, '20000000.00', 'rejected', 19, 'invalid', 'topup-proofs/gtakwhnIFI4gR84nvzAg1XgSpociBfAVeElYht4q.jpg', '2025-12-19 22:12:54', '2025-12-19 22:16:43'),
(11, 21, '20000000.00', 'approved', 19, 'ok', 'topup-proofs/ms9H4d0Q8TORQLBGglhPfCYVs7EiuucLMVG0pbIB.jpg', '2025-12-19 22:17:41', '2025-12-19 22:17:51'),
(12, 24, '10000000.00', 'approved', 2, 'ok', 'topup-proofs/GseRvjKQmfVlsgsDMmkexVTEiBnAozzxXSYmPYFx.jpg', '2025-12-19 23:22:13', '2025-12-19 23:25:37'),
(13, 24, '100000.00', 'rejected', 2, 'invalid', 'topup-proofs/j1qIH9tFJnaquDm11yL8BB1nanpigpRmQgfL6m7M.jpg', '2025-12-19 23:26:47', '2025-12-19 23:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','guest') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'guest',
  `balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `balance`, `address`, `phone`, `password`, `foto`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin@example.com', 'admin', '0.00', NULL, NULL, '$2y$10$kJXbYbU3lUKMj8MjwNAFMeOufwujr4ObQ6UqqM8VfTIhuFcOpgARq', NULL, '2025-12-07 01:49:33', '2025-12-07 01:49:33'),
(3, 'divamanik', 'diva@gmail.com', 'guest', '0.00', NULL, NULL, '$2y$10$iLTSjMlqKrJi/X1bTC29a.mmddl5ER0DHRS.HZ0xLuzQwFNpEZU6m', NULL, '2025-12-07 01:50:54', '2025-12-07 01:50:54'),
(4, 'Diva Manik', 'diva1@gmail.com', 'guest', '0.00', NULL, NULL, '$2y$10$5CS99eHyCX89zPY16AefUO5j9HLiVtSeWUeahIPckI2cF9aZ65xoO', NULL, '2025-12-15 07:26:52', '2025-12-15 07:26:52'),
(5, 'tes', 'tes@gmail.com', 'guest', '0.00', NULL, NULL, '$2y$10$GNZNgSKHcLoE7VtHF/Nopehx7aLBrSsb9Rg/RAzVAIwYcs7AMRgYW', NULL, '2025-12-15 07:45:52', '2025-12-15 07:45:52'),
(7, 'Fil', 'op@gmail.com', 'guest', '5000000.00', 'desadasdasdadas', '0899087890876', '$2y$10$zF7vcbsO.pdnzmiBrqlVUuCxRsupC0a5anZRHT9jApK84oBlRfYdC', 'user-photos/TW3emM9qkL9Es71TVwp6ehXIYK52K8A2Lzkx8DqS.jpg', '2025-12-15 08:19:50', '2025-12-17 10:12:14'),
(8, 'diva', 'tes2@gmail.com', 'guest', '0.00', 'sadsadasdad', '089090964467', '$2y$10$9WZp7klHSP.rHc3UsUdS7.ZfuFLjfb7rK1LatGOtLP0EKDQKG9BTu', 'user-photos/RT52z0naBRbPFOIzQztHcaIGx7fqwt9reGlgjhYZ.jpg', '2025-12-18 01:20:57', '2025-12-18 01:23:27'),
(11, 'op2', 'op2@gmail.com', 'guest', '0.00', NULL, NULL, '$2y$10$ximl5OyHrJR1tPpsfarI0udbu5Ny0krWpPD6/coJ79Jc.lqzQ7Kl2', NULL, '2025-12-18 23:27:44', '2025-12-18 23:27:44'),
(12, 'Rio', 'rio@gmail.com', 'guest', '0.00', NULL, NULL, '$2y$10$SOV80g4UKbnWPsNigaxLr.qW/mwENkBysdioSwNRBM4rf3I9N0Gda', NULL, '2025-12-19 11:22:28', '2025-12-19 11:22:28'),
(13, 'Tio', 'tio@gmail.com', 'guest', '5000000.00', 'asdasdasdasdasd', '081231231312', '$2y$10$/ZAv6VG4LWVprh1qyU/ntO0J28WEUT8aP2nGnnp5cDG9o43.p0FTS', 'user-photos/6EpsGM0OrdCNXAnRSTtCBwifvtYwKStrNLtygtOL.jpg', '2025-12-19 11:28:07', '2025-12-19 11:47:41'),
(14, 'adminganteng', 'admin2@gmail.com', 'admin', '0.00', NULL, NULL, '$2y$10$f1hMAwGCu0a1sJBiFcwWF..X8amA9dWzW3JOix92sozxnWMGNcXCS', 'user-photos/AkFQfeOgomf2g5d038Su3SN5zPnD0htErVy0bW0Z.jpg', '2025-12-19 11:36:02', '2025-12-19 11:36:02'),
(15, 'Budi', 'budi@gmai.com', 'guest', '1554984.00', 'adsasdasd', '08012312312', '$2y$10$qyzBJePxdV/TlYTAqnvBleoZFVzwu0is.jZk71SKhnDCN4v9CAFrK', 'user-photos/1IcUGnuhslUfY0ago75Q428g1qj7OCIQx5R5DlVb.jpg', '2025-12-19 11:55:22', '2025-12-19 12:11:19'),
(17, 'Yanto S', 'yanto@gmail.com', 'guest', '0.00', 'adhaskdhasjkdasdasd', '0812313132', '$2y$10$jsmmASTCf61ct2noNQH2Ses95YTJBQ/2oJO6vCIYr7Rw4SRY4iYKW', 'user-photos/MEvXc33c8lCfjAeECltZmgyhq26F5gn9FvhDEXB9.jpg', '2025-12-19 19:46:06', '2025-12-19 19:49:53'),
(18, 'Vito P', 'vito@gmail.com', 'guest', '1387456.00', 'asdaskdgasui gdkasdh jkas', '08081231212', '$2y$10$9DmW3YkIMb.QmwD1fSDxZeyhZ1bz8zp41h2WGsX87j0CIbXJUxDRW', 'user-photos/yVriqMeXepFEYU6YcPNryo6jQskYBDCfxqCtCkCQ.jpg', '2025-12-19 19:56:46', '2025-12-19 20:24:23'),
(19, 'admins', 'admins@gmail.com', 'admin', '0.00', NULL, NULL, '$2y$10$a8x8sc6LPyJXu.ef1htyXOhNgkl3qbh/oaaTsNQDPB/Z6/oi.yGZy', 'user-photos/7hAcHFAyVj0YRaCM5deoDv79ZbdnPZpLylGW6xtN.jpg', '2025-12-19 20:05:30', '2025-12-19 20:05:30'),
(20, 'Imona', 'imo@gmail.com', 'guest', '0.00', 'asdasdas', '0808080', '$2y$10$5.DZ6WobLPYzxpyWca0De.tVsd6NdkXZVpgHxgUYGhiB2EgyBX2FS', 'user-photos/qTsIndobPzRKGyxd7ALsPRiOJt02HIecSZvstRSG.jpg', '2025-12-19 20:45:11', '2025-12-19 20:47:07'),
(21, 'Yosep Kicep', 'yosep@gmail.com', 'guest', '17312174.00', 'asdasdas', '08080080', '$2y$10$Q.cDe1MHpGDmS.bMgQ/9NOrtEd6QZWVUEqYhktIqvvsraMY9fIMV2', 'user-photos/r5rBRtTzPASvAfwIUdumh7HnvW2QVu4r4Coojb6l.jpg', '2025-12-19 22:04:02', '2025-12-19 22:34:59'),
(22, 'asda', 'asd@gmail.com', 'guest', '5000000.00', NULL, NULL, '$2y$10$.x/DQF0U4tc99qPL5Pr0VOn39YSHoU56vfCFtBNSXga8GhPKRPi6G', NULL, '2025-12-19 22:09:47', '2025-12-19 22:09:47'),
(23, 'diva', 'divaganteng@gmail.com', 'admin', '0.00', NULL, NULL, '$2y$10$vkSfn51B12WkifBVeA52R.evZrh8jfYlMM6fcS0OgklmBQ9pa6fyy', 'user-photos/q0lTW6ZjNM8tnM3aIieqwZfjVGjME7hMsU4BjS34.jpg', '2025-12-19 22:23:37', '2025-12-19 22:23:37'),
(24, 'Pilos', 'pilo@gmail.com', 'guest', '6780206.00', 'asdasdasd as dasd as', '0812312312', '$2y$10$LbUmaIuadbXsqrqTbI/MH.jB8Iu4lo43RJjozBsb8LhTiwEaa.0py', 'user-photos/Tetqp4dYV9yuGZjM04m9JgqClrvfIwzxwk22HBPK.jpg', '2025-12-19 23:02:35', '2025-12-19 23:35:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keyboards`
--
ALTER TABLE `keyboards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_keyboard_id_foreign` (`keyboard_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `topups`
--
ALTER TABLE `topups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topups_user_id_foreign` (`user_id`),
  ADD KEY `topups_processed_by_foreign` (`processed_by`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keyboards`
--
ALTER TABLE `keyboards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `topups`
--
ALTER TABLE `topups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_keyboard_id_foreign` FOREIGN KEY (`keyboard_id`) REFERENCES `keyboards` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `topups`
--
ALTER TABLE `topups`
  ADD CONSTRAINT `topups_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `topups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

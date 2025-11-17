-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2025 at 02:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

DROP DATABASE IF EXISTS `datntravel`;
CREATE DATABASE IF NOT EXISTS `datntravel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `datntravel`;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datntravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `dat_tour`
--

CREATE TABLE `dat_tour` (
  `id` varchar(255) NOT NULL,
  `id_nguoidung` varchar(255) DEFAULT NULL,
  `id_khachhang` varchar(255) DEFAULT NULL,
  `id_tour` varchar(255) DEFAULT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `so_dien_thoai` varchar(20) NOT NULL,
  `so_nguoi` int(11) NOT NULL,
  `ngay_di` date NOT NULL,
  `trang_thai_dattour` varchar(50) NOT NULL,
  `ngay_dat_tour` datetime NOT NULL,
  `ngay_huy_tour` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dat_tour`
--

INSERT INTO `dat_tour` (`id`, `id_nguoidung`, `id_khachhang`, `id_tour`, `ho_ten`, `email`, `so_dien_thoai`, `so_nguoi`, `ngay_di`, `trang_thai_dattour`, `ngay_dat_tour`, `ngay_huy_tour`) VALUES
('DT-000', NULL, 'KH-002', 'T-002', '0923456789', 'ilovephuong122@gmail.com', '0923456789', 1, '2025-10-26', 'Chờ xác nhận', '2025-10-11 15:39:16', NULL),
('DT-001', NULL, 'KH-002', 'T-002', '0923456789', 'ilovephuong122@gmail.com', '0923456789', 1, '2025-10-12', 'Chờ xác nhận', '2025-10-11 15:04:19', NULL),
('DT-002', NULL, 'KH-002', 'T-002', '0923456789', 'ilovephuong122@gmail.com', '0923456789', 1, '2025-10-18', 'Chờ xác nhận', '2025-10-11 15:42:58', NULL),
('DT-004', 'admin', 'KH-002', 'T-001', '0923456789', 'ilovephuong122@gmail.com', '0923456789', 1, '2025-10-24', 'Đã Hủy', '2025-10-11 15:43:29', '2025-10-13 19:31:36'),
('DT-005', 'admin', 'KH-002', 'T-001', '0923456789', 'ilovephuong122@gmail.com', '0923456789', 1, '2025-10-26', 'Đã Xác Nhận', '2025-10-11 15:43:35', NULL),
('DT-006', 'admin', 'KH-002', 'T-001', '0923456789', 'ilovephuong122@gmail.com', '0923456789', 1, '2025-10-31', 'Đã Xác Nhận', '2025-10-11 15:43:40', NULL),
('DT-007', 'admin', 'KH-002', 'T-001', '0923456789', 'ilovephuong122@gmail.com', '0923456789', 1, '2025-10-17', 'Đã Xác Nhận', '2025-10-11 15:43:45', NULL),
('DT-008', 'admin', 'KH-002', 'T-001', '0923456789', 'ilovephuong122@gmail.com', '0923456789', 1, '2025-11-22', 'Đã Xác Nhận', '2025-10-11 15:43:51', NULL),
('DT-009', 'admin', 'KH-002', 'T-001', '0923456789', 'ilovephuong122@gmail.com', '0923456789', 1, '2025-10-26', 'Đã Xác Nhận', '2025-10-11 15:43:58', NULL),
('DT-010', 'admin', 'KH-002', 'T-001', '0923456789', 'ilovephuong122@gmail.com', '0923456789', 1, '2025-10-31', 'Đã Xác Nhận', '2025-10-11 15:44:18', NULL),
('DT-011', 'admin', 'KH-002', 'T-001', '0923456789', 'ilovephuong122@gmail.com', '0923456789', 1, '2025-10-31', 'Đã Xác Nhận', '2025-10-11 15:44:29', NULL),
('DT-012', 'admin', 'KH-012', 'T-001', 'Lê Đức Chiến', 'leducchien07023@gmail.com', '0123321123', 1, '2025-10-31', 'Đã Xác Nhận', '2025-10-12 08:31:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gop_y`
--

CREATE TABLE `gop_y` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `so_dien_thoai` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `noidung_gopy` text NOT NULL,
  `trangthai` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gop_y`
--

INSERT INTO `gop_y` (`id`, `ho_ten`, `so_dien_thoai`, `email`, `noidung_gopy`, `trangthai`, `created_at`, `updated_at`) VALUES
(1, 'chien', '0338869605', 'leducchien07023@gmail.com', 'okokokokok', 'Đã Phản Hồi', '2025-10-07 08:27:06', '2025-10-11 15:57:19'),
(3, 'chien', '0338869605', 'ilovephuong122@gmail.com', 'ádasdasd', 'Đã Phản Hồi', '2025-10-08 04:49:58', '2025-10-11 16:20:15'),
(4, 'Le Van Chien', '0338869605', 'leducchien07023@gmail.com', 'okokokok', 'Đã Phản Hồi', '2025-10-11 16:24:52', '2025-10-11 16:30:44'),
(5, 'lê văn nam', '0338869605', 'ilovephuong122@gmail.com', 'okok1', 'Đã Phản Hồi', '2025-10-11 16:32:43', '2025-10-11 16:48:16'),
(6, 'bùi kim ánh', '0228869605', 'ilovephuong122@gmail.com', 'test1', 'Đã Phản Hồi', '2025-10-11 16:54:06', '2025-10-11 16:54:20'),
(7, 'Bùi Thanh Phong', '0118869605', 'leducchien07023@gmail.com', 'test2', 'Đã Phản Hồi', '2025-10-11 17:08:29', '2025-10-11 17:08:53'),
(8, 'Nguyễn Nhật Linh', '0448869605', 'leducchien07023@gmail.com', 'test 3', 'Đã Phản Hồi', '2025-10-11 17:16:10', '2025-10-11 17:22:26'),
(9, 'Đỗ Hữu Phước', '0558869605', 'ilovephuong122@gmail.com', 'test 4', 'Đã Phản Hồi', '2025-10-11 17:17:07', '2025-10-11 17:22:19'),
(10, 'Nguyễn Thị Yến', '0338869605', 'ilovephuong122@gmail.com', 'test 5', 'Đã Phản Hồi', '2025-10-11 17:19:04', '2025-10-11 17:22:15'),
(11, 'Bùi Yến Nhi', '0338869605', 'ilovephuong122@gmail.com', 'test 6', 'Đã Phản Hồi', '2025-10-11 17:20:19', '2025-10-11 17:22:09'),
(12, 'Nguyễn Hoàng Phương', '0338869605', 'ilovephuong122@gmail.com', 'test7', 'Đã Phản Hồi', '2025-10-11 17:21:38', '2025-10-11 17:22:04');

-- --------------------------------------------------------

--
-- Table structure for table `hinhanh_tour`
--

CREATE TABLE `hinhanh_tour` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tour` varchar(255) DEFAULT NULL,
  `ten_anh` text NOT NULL,
  `url_anh` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hinhanh_tour`
--

INSERT INTO `hinhanh_tour` (`id`, `id_tour`, `ten_anh`, `url_anh`, `created_at`, `updated_at`) VALUES
(1, 'T-001', 'Hạ Long', 'imgTours/06L0zx2XuJiqCxY2W30VvoXElztH00DDklr8uN05.jpg', '2025-09-21 22:36:01', '2025-09-21 22:36:01'),
(2, 'T-001', 'Hạ Long', 'imgTours/Qd90bLbTwmnBqE2A16vE8xX0yVFIvBXjz5M7q2c1.jpg', '2025-09-21 22:46:42', '2025-09-21 22:46:42'),
(3, 'T-001', 'Hạ Long', 'imgTours/2QjvJT4Rx250zKbkv17x3yuupsiLosLDocQjiuIi.jpg', '2025-09-21 22:46:54', '2025-09-21 22:46:54'),
(4, 'T-001', 'Hạ Long', 'imgTours/AnxUwBGVgcqdwhDWCJ6uasU32TJJeyHppQjHPBnZ.jpg', '2025-09-21 22:47:06', '2025-09-21 22:47:06'),
(5, 'T-001', 'Hạ Long', 'imgTours/zPtaIaDqeuJx1ktBv3hApewykRq339iVirQvgZnf.jpg', '2025-09-21 22:47:19', '2025-09-21 22:47:19'),
(6, 'T-002', 'Nha Trang', 'imgTours/28zreFcKHLh6cZLiL17J0ngKp5iyU0X1joz00QkU.jpg', '2025-09-30 04:39:05', '2025-09-30 04:39:05'),
(7, 'T-002', 'Nha Trang', 'imgTours/9QXr98zGrGO0FQAyKXLTlWZ2a6PaBXrSRa5Ohfyp.jpg', '2025-09-30 04:39:20', '2025-09-30 04:39:20'),
(8, 'T-002', 'Nha Trang', 'imgTours/VvsF2rZpV4gF3h2RiPNXlaV2ISEC8S9Ry5ON0QDt.jpg', '2025-09-30 04:39:31', '2025-09-30 04:39:31'),
(9, 'T-002', 'Nha Trang', 'imgTours/PZtVoKTwSDgVaGZyKfJCR2q1S0M4Ip7RGppvo6Id.jpg', '2025-09-30 04:39:47', '2025-09-30 04:39:47'),
(10, 'T-002', 'Nha Trang', 'imgTours/kQAOVMmN7E2c8w2cGvSHdYt96GhkuzY4bBDuthFF.jpg', '2025-09-30 04:40:00', '2025-09-30 04:40:00'),
(11, 'T-003', 'Phú Quốc', 'imgTours/LVZKWwHZ4zoQk5P03jqnZfllcdt98bBrZAUgue3O.jpg', '2025-09-30 04:43:49', '2025-09-30 04:43:49'),
(12, 'T-003', 'Phú Quốc', 'imgTours/2uPeY4KwhjCh9Q08JfIWt9upmRY8ZZA2vOaTVhwo.jpg', '2025-09-30 04:47:37', '2025-09-30 04:47:37'),
(13, 'T-003', 'Phú Quốc', 'imgTours/Nq264YZhqf7GVa5FTRc0RpsVyAicbJb5vGYOhFeA.jpg', '2025-09-30 04:47:52', '2025-09-30 04:47:52'),
(14, 'T-003', 'Phú Quốc', 'imgTours/gwOHbJnhD8mc96KUwPKo62mtgn764bx96DJQqtFu.jpg', '2025-09-30 04:48:03', '2025-09-30 04:48:03'),
(15, 'T-003', 'Phú Quốc', 'imgTours/CJSvKrRQWKNz9sWTnmgTVqSNyXlj7akhpA98j80L.jpg', '2025-09-30 04:48:11', '2025-09-30 04:48:11'),
(16, 'T-004', 'Đà Nẵng', 'imgTours/QnsNlp8mFJttxcdY92EukTglNOE4JIAyoxoDHReF.jpg', '2025-09-30 04:52:08', '2025-09-30 04:52:08'),
(17, 'T-004', 'Đà Nẵng', 'imgTours/V76HNhUjh1HXatsdNmixxn0iK4CGGyoYf5nqOi7j.jpg', '2025-09-30 04:52:21', '2025-09-30 04:52:21'),
(18, 'T-004', 'Đà Nẵng', 'imgTours/M10Dr6Cpk2ZtdO9gFeAdN93IO4QwCIoVt7GUC17C.jpg', '2025-09-30 04:52:35', '2025-09-30 04:52:35'),
(19, 'T-004', 'Đà Nẵng', 'imgTours/M5NXCJqDxFoIBEcwoQhQ9xtL3RxCW6vHN38l7WOp.jpg', '2025-09-30 04:52:45', '2025-09-30 04:52:45'),
(20, 'T-004', 'Đà Nẵng', 'imgTours/ML4P8VsgePa2V8SNPmaxtO92ibL9FCELu5s1UGnk.jpg', '2025-09-30 04:52:55', '2025-09-30 04:52:55'),
(21, 'T-005', 'Quy nhơn', 'imgTours/QW9m0qvnFNEeNtVRkJdxyLW4NcM76NVQ5WH5xpz6.jpg', '2025-09-30 05:10:23', '2025-09-30 05:10:23'),
(22, 'T-005', 'Quy nhơn', 'imgTours/iDfacCZal4xZxsB5Sup1KRXpl1vIb7M3KIF69F7Q.jpg', '2025-09-30 05:10:34', '2025-09-30 05:10:34'),
(23, 'T-005', 'Quy nhơn', 'imgTours/Ok6Jq7v9BRmDphqIYf9NMrbEQNEnkaSzn76fxVm8.jpg', '2025-09-30 05:10:44', '2025-09-30 05:10:44'),
(24, 'T-005', 'Quy nhơn', 'imgTours/yEwBzNrBhGURYATYXyOWtrwGLoMxVWsRnoYjPVnh.jpg', '2025-09-30 05:10:52', '2025-09-30 05:10:52'),
(25, 'T-005', 'Quy nhơn', 'imgTours/23Ofd1tstbZ018TqstxCEVat2nbl3k423PI9Niga.png', '2025-09-30 05:11:04', '2025-09-30 05:11:04'),
(26, 'T-006', 'Hà Nội', 'imgTours/SlhE90ggkxPvq14wqjvnRoNHuNdBjeS1iTgaRi9v.jpg', '2025-09-30 05:15:16', '2025-09-30 05:15:16'),
(27, 'T-006', 'Hà Nội', 'imgTours/uG2OeTlY7JKrUIRIhcq1KvV1PwmU0UCrYNFr7S0X.jpg', '2025-09-30 05:15:45', '2025-09-30 05:15:45'),
(28, 'T-006', 'Hà Nội', 'imgTours/ziC9qxnN9FRqt6dG8QF83c0SRo1GiBbolP8mdNPm.jpg', '2025-09-30 05:15:58', '2025-09-30 05:15:58'),
(29, 'T-006', 'Hà Nội', 'imgTours/4AMzC2dfQIN2Xwl7hAX6ExltR2abAPEhOctJsmlA.jpg', '2025-09-30 05:16:13', '2025-09-30 05:16:13'),
(30, 'T-006', 'Hà Nội', 'imgTours/m9qyjeksIbrmxWWlJBKEqXYarAcNlbgQ2kNYdf4c.jpg', '2025-09-30 05:16:31', '2025-09-30 05:16:31'),
(32, 'T-008', 'Tây Nguyên', 'imgTours/0nazRVHinT9RdbS4bXwldGzKVKR1WmMf8dYILaQe.jpg', '2025-10-06 03:11:05', '2025-10-06 03:11:05'),
(33, 'T-008', 'Tây Nguyên', 'imgTours/ouXGs74nPxaAAj4h1S1ulPRwelvjDYZURsjFO4Ih.jpg', '2025-10-06 03:11:20', '2025-10-06 03:11:20'),
(34, 'T-008', 'Tây Nguyên', 'imgTours/ugDRmxmwzLaYo368f41Amag7HQHvj6ZLUMF0m60d.jpg', '2025-10-06 03:11:28', '2025-10-06 03:11:28'),
(35, 'T-008', 'Tây Nguyên', 'imgTours/AYRDLEKhO4MxHaNqb93wU9iBFyhPv76ypr2lEGX7.jpg', '2025-10-06 03:16:14', '2025-10-06 03:16:14'),
(36, 'T-008', 'Tây Nguyên', 'imgTours/fgP5fCEntSq2kJjwOL45T1coYHyy73djkXFKQrjD.jpg', '2025-10-06 03:16:27', '2025-10-06 03:16:27'),
(37, 'T-007', 'Huế', 'imgTours/g51kwpO5b8i4SFs5OaUJ0YDTHqM87TDjNXiusdxw.jpg', '2025-10-06 03:17:05', '2025-10-06 03:17:05'),
(38, 'T-007', 'Huế', 'imgTours/mbXKc6IUsHwn7c0xP7eLfJlGLO2bU1u4b4CurqZn.jpg', '2025-10-06 03:17:24', '2025-10-06 03:17:24'),
(39, 'T-007', 'Huế', 'imgTours/zX95un9FFlFmMVsLNpANCEc8FT2CyyR9gl3NA0n7.jpg', '2025-10-06 03:17:35', '2025-10-06 03:17:35'),
(40, 'T-007', 'Huế', 'imgTours/QE42WHv5JG89DcKZgacFR72CpvTn8Ymwm9OvzgJj.jpg', '2025-10-06 03:17:46', '2025-10-06 03:17:46'),
(41, 'T-007', 'Huế', 'imgTours/pQXJ9RkRoxoPsfN6hAMu5SqRdc7P7of311IfIf1U.jpg', '2025-10-06 03:17:54', '2025-10-06 03:17:54'),
(42, 'T-009', 'Sapa', 'imgTours/SEGDb1obrKqlapL3z3UvXPwZadhtfiC0zxv91kkO.jpg', '2025-10-06 03:18:32', '2025-10-06 03:18:32'),
(43, 'T-009', 'Sapa', 'imgTours/lkZ5yk5oSzNpJd6RFddwq0CzZUyH8ssK4vUOeGPU.jpg', '2025-10-06 03:18:41', '2025-10-06 03:18:41'),
(44, 'T-009', 'Sapa', 'imgTours/PqSFfkM8voAwGKUOOOq8GYqJyta5FQfUBLKTdxCF.jpg', '2025-10-06 03:18:50', '2025-10-06 03:18:50'),
(46, 'T-009', 'Sapa', 'imgTours/CRn5F1o9dfD4Wp3UgO4JwYoPEV3ZdzoubADdBr87.jpg', '2025-10-06 03:19:16', '2025-10-06 03:19:16'),
(47, 'T-009', 'Sapa', 'imgTours/EiFdMmLFqVWeiedhj0ijiC1GbBryChQRqwNA5riP.jpg', '2025-10-06 03:19:24', '2025-10-06 03:19:24'),
(48, 'T-010', 'Miền tây', 'imgTours/dSx02IdnrIJ9wiQPb58Vban2gkmgsNY08W1lJliH.jpg', '2025-10-06 03:19:50', '2025-10-06 03:19:50'),
(49, 'T-010', 'Miền tây', 'imgTours/zKP2cIsFNayj3Oknr9f1uLomQhx4aAC99R8dxCxp.jpg', '2025-10-06 03:20:09', '2025-10-06 03:20:09'),
(50, 'T-010', 'Miền tây', 'imgTours/1WShwhzHDdhulzgcsZ3iOvQsJkpPTve2mkorrNYW.jpg', '2025-10-06 03:20:21', '2025-10-06 03:20:21'),
(52, 'T-010', 'Miền tây', 'imgTours/A2pJDQFZQft23PeuOUmDs5VYCOlMbCrmKvoPX6Wc.jpg', '2025-10-06 03:20:45', '2025-10-06 03:20:45'),
(53, 'T-010', 'Miền tây', 'imgTours/Z2zWJpGVGXNwdZlxI6BArAggGWUhhOMr9NweoqwA.jpg', '2025-10-06 03:23:11', '2025-10-06 03:23:11'),
(54, 'T-011', 'Sơn đoòng', 'imgTours/PHQABJlWMVSsJm2fBNacmrUwmo6YrLED3zj7yrmc.jpg', '2025-10-06 03:23:45', '2025-10-06 03:23:45'),
(55, 'T-011', 'Sơn đoòng', 'imgTours/ywlbeG56JELLLNpdsANeW4S4c3gSwvnr9k2X3vup.jpg', '2025-10-06 03:23:56', '2025-10-06 03:23:56'),
(56, 'T-011', 'Sơn đoòng', 'imgTours/5XE9WrNHu2LnON9jv5Z4ugEI9w7Ri1kp46zOs45Y.jpg', '2025-10-06 03:26:39', '2025-10-06 03:26:39'),
(57, 'T-011', 'Sơn đoòng', 'imgTours/HZQ8ID4QyltNozgu4kYix6BLZe87YULVdxLPiTYf.jpg', '2025-10-06 03:27:06', '2025-10-06 03:27:06'),
(58, 'T-011', 'Sơn đoòng', 'imgTours/9yNUEYCR0BpwqNPYO3jFqGyeSm9yhFq1Wsn3zOQP.jpg', '2025-10-06 03:27:19', '2025-10-06 03:27:19'),
(59, 'T-012', 'Treeking', 'imgTours/UT9lYZfyYjgaw0qYPdjCbDx0DK16DzP1QDDMibj9.jpg', '2025-10-06 03:27:50', '2025-10-06 03:27:50'),
(60, 'T-012', 'Treeking', 'imgTours/QZfOdWe6odjOOzT5HXFDciV8Lr8QsZXgPYgWRC3b.jpg', '2025-10-06 03:28:02', '2025-10-06 03:28:02'),
(61, 'T-012', 'Treeking', 'imgTours/EKpLzQajxtEFiRvvMmZNQ4Wt5sV4ZyncBjOl2TGF.jpg', '2025-10-06 03:28:28', '2025-10-06 03:28:28'),
(62, 'T-012', 'Treeking', 'imgTours/BdNCLGmn9fF79gHVmr728d9lzSS175cKEiG4aT3l.jpg', '2025-10-06 03:28:41', '2025-10-06 03:28:41'),
(63, 'T-012', 'Treeking', 'imgTours/EGygzPEFcFJGtUqjvOs9a6hB09cBsE4E5mujeoYe.jpg', '2025-10-06 03:28:52', '2025-10-06 03:28:52'),
(64, 'T-013', 'Hà giang', 'imgTours/jao4N716JestSRQfVKk7k1iYPXxqaoImaF46wXC7.jpg', '2025-10-06 03:29:23', '2025-10-06 03:29:23'),
(65, 'T-013', 'Hà giang', 'imgTours/B6MLm0HtKolAlT3AmLHN4N1wvaA96fCWUa31gTF7.jpg', '2025-10-06 03:29:40', '2025-10-06 03:29:40'),
(66, 'T-013', 'Hà giang', 'imgTours/8fTHwKDkq4A6bFFjuGVNX1tDGs3hpyru6S2KIS14.jpg', '2025-10-06 03:29:50', '2025-10-06 03:29:50'),
(67, 'T-013', 'Hà giang', 'imgTours/msRjH1DBv20Y78YTED2Icyxr3fxfQdWB1RizwWWP.jpg', '2025-10-06 03:30:00', '2025-10-06 03:30:00'),
(68, 'T-013', 'Hà giang', 'imgTours/Y4QGz8P9v2f7B9PAj4hyzM4PKbFRGFne1AEXfTMs.jpg', '2025-10-06 03:30:11', '2025-10-06 03:30:11'),
(69, 'T-014', 'Mũi né', 'imgTours/Jyv3TubWQzAkbtVWmiUz9mMtNC6MjXyVidYEEr2O.jpg', '2025-10-06 03:30:33', '2025-10-06 03:30:33'),
(70, 'T-014', 'Mũi né', 'imgTours/ozSAzxZSUJSPopIOSlQzDAkSsmqu3riHWeXqznzA.jpg', '2025-10-06 03:30:42', '2025-10-06 03:30:42'),
(71, 'T-014', 'Mũi né', 'imgTours/LhYC2G4f7eHB3pOgtKqbV7iXDGAllnnB8vW5uHuT.jpg', '2025-10-06 03:33:51', '2025-10-06 03:33:51'),
(72, 'T-014', 'Mũi né', 'imgTours/CVHSvvbb49SpCXZkH8N7DPqegqtIPO90O5kn8dwo.jpg', '2025-10-06 03:34:07', '2025-10-06 03:34:07'),
(73, 'T-014', 'Mũi né', 'imgTours/3Rsv8Hxk8c515dkoSnjYBz0opUViF2ot9YQqhXUb.jpg', '2025-10-06 03:34:16', '2025-10-06 03:34:16'),
(74, 'T-015', 'Côn đảo', 'imgTours/9ruIy47SOXcD3MwLnLw7YCMJ3spd5jXF4f6afXKr.jpg', '2025-10-06 03:34:46', '2025-10-06 03:34:46'),
(75, 'T-015', 'Côn đảo', 'imgTours/6lklAE7nH9gxJz8lZ1exHl7eHiBNdSfBRWaKDXA8.jpg', '2025-10-06 03:34:56', '2025-10-06 03:34:56'),
(76, 'T-015', 'Côn đảo', 'imgTours/dqs2D84nLNMayKPEYBat3YVO1HZwbTYCsNVUVDYJ.jpg', '2025-10-06 03:35:08', '2025-10-06 03:35:08'),
(77, 'T-015', 'Côn đảo', 'imgTours/dI5nrBuL3GjsPvqzpIUNqryygeXexKAObsO4t2Sx.jpg', '2025-10-06 03:35:21', '2025-10-06 03:35:21'),
(78, 'T-015', 'Côn đảo', 'imgTours/ab14gxsgO95tPX27NxvxOMNft1nUG27nnPyBJL7w.jpg', '2025-10-06 03:36:35', '2025-10-06 03:36:35');

-- --------------------------------------------------------

--
-- Table structure for table `hoadondattour`
--

CREATE TABLE `hoadondattour` (
  `id` varchar(255) NOT NULL,
  `id_dattour` varchar(255) DEFAULT NULL,
  `phuong_thuc_thanh_toan` text NOT NULL,
  `trang_thai` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hoadondattour`
--

INSERT INTO `hoadondattour` (`id`, `id_dattour`, `phuong_thuc_thanh_toan`, `trang_thai`, `created_at`, `updated_at`) VALUES
('HD-1', 'DT-011', 'Thanh toán trực tiếp tại quầy', 'Chưa thanh toán', '2025-10-11 08:45:15', '2025-10-11 08:45:15'),
('HD-10', 'DT-012', 'Thanh toán trực tiếp tại quầy', 'Chưa thanh toán', '2025-10-12 01:32:59', '2025-10-12 01:32:59'),
('HD-2', 'DT-010', 'Thanh toán trực tiếp tại quầy', 'Chưa thanh toán', '2025-10-11 09:01:19', '2025-10-11 09:01:19'),
('HD-3', 'DT-009', 'Thanh toán trực tiếp tại quầy', 'Chưa thanh toán', '2025-10-11 09:02:24', '2025-10-11 09:02:24'),
('HD-4', 'DT-008', 'Thanh toán trực tiếp tại quầy', 'Chưa thanh toán', '2025-10-11 09:09:42', '2025-10-11 09:09:42'),
('HD-5', 'DT-007', 'Thanh toán trực tiếp tại quầy', 'Chưa thanh toán', '2025-10-11 09:16:25', '2025-10-11 09:16:25'),
('HD-6', 'DT-006', 'Thanh toán trực tiếp tại quầy', 'Chưa thanh toán', '2025-10-11 09:18:49', '2025-10-11 09:18:49'),
('HD-7', 'DT-005', 'Thanh toán chuyển khoản qua ngân hàng', 'Đã thanh toán', '2025-10-11 09:26:42', '2025-10-11 16:58:55'),
('HD-8', 'DT-004', 'Thanh toán trực tiếp tại quầy', 'Chưa thanh toán', '2025-10-11 17:02:40', '2025-10-11 17:02:40'),
('HD-9', 'DT-012', 'Thanh toán trực tiếp tại quầy', 'Chưa thanh toán', '2025-10-12 01:32:12', '2025-10-12 01:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `loai_tour`
--

CREATE TABLE `loai_tour` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten_loaitour` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loai_tour`
--

INSERT INTO `loai_tour` (`id`, `ten_loaitour`, `created_at`, `updated_at`) VALUES
(1, 'Tour Biển & Nghỉ Dưỡng', '2025-09-21 00:05:21', '2025-09-21 00:05:21'),
(2, 'Tour Văn Hóa & Lịch Sử', '2025-09-21 00:05:29', '2025-09-21 00:05:29'),
(3, 'Tour Mạo Hiểm & Thiên Nhiên', '2025-09-21 00:05:36', '2025-09-21 00:05:36'),
(4, 'Tour Ẩm Thực & Trải Nghiệm Địa Phương', '2025-09-21 00:05:49', '2025-09-21 00:05:49'),
(5, 'Tour Nghỉ Dưỡng Cao Cấp & Wellness', '2025-09-21 00:05:55', '2025-09-21 00:05:55');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_10_11_201651_create_nguoidung_table', 1),
(3, '2024_10_11_202349_create_gopy_table', 1),
(4, '2024_10_11_202426_create_theloai_table', 1),
(5, '2024_10_11_202432_create_loaitour_table', 1),
(6, '2024_10_11_202915_create_tour_table', 1),
(7, '2024_10_11_203104_create_hinhanhtour_table', 1),
(8, '2024_10_11_203136_create_dattour_table', 1),
(9, '2024_10_11_203718_create_trangtintuc_table', 1),
(10, '2024_10_24_105800_create_hoadondattour_table', 1),
(11, '2025_10_08_144608_add_ngay_bat_dau_to_tours_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `id` varchar(255) NOT NULL,
  `ho_ten` varchar(100) DEFAULT NULL,
  `tai_khoan` varchar(100) DEFAULT NULL,
  `mat_khau` longtext DEFAULT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `vai_tro` varchar(50) NOT NULL,
  `dang_nhap_qua` varchar(50) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`id`, `ho_ten`, `tai_khoan`, `mat_khau`, `so_dien_thoai`, `email`, `avatar`, `vai_tro`, `dang_nhap_qua`, `remember_token`, `created_at`, `updated_at`) VALUES
('admin', 'admin', 'admin', 'eyJpdiI6IjFBMnZYUk5POWZLSUVPOWtyQ1lndWc9PSIsInZhbHVlIjoiSGJ0b0tLUU42bzZlc0pEeUJlNXp1UT09IiwibWFjIjoiOGEzYzFiNDAxNWQxNTA0OThiZDNmZDhlYzI2YzcxYmI2OTQ3OWRiNmU3ODNhZTQ3MDFjN2ZiYzA5MjI1MzdiMyIsInRhZyI6IiJ9', '0123456789', 'admin@gmail.com', '', 'admin', NULL, NULL, '2025-09-15 18:34:13', '2025-09-15 18:34:13'),
('KH-001', '0912345678', '0912345678', 'eyJpdiI6Imd6Wmt2TjVLaEk0VFU2TTh3TncyNEE9PSIsInZhbHVlIjoiU2RZeUM5UE93SWtCb2N0a0drZTAzRkhHMm55Q2F4UHRsZzMzM1ZoYlBTWT0iLCJtYWMiOiIzYmFlYjcyNGNhMGEwZDBlZDc3MjJjNjdkYjMzNjc5NTQwOWE1N2I5MTE1ZjcxNzI1NDRiYzczNGE5NzFlNWZlIiwidGFnIjoiIn0=', '0912345678', 'admin1@gmail.com', '', 'Khách Hàng', NULL, NULL, '2025-09-20 23:35:57', '2025-09-20 23:35:57'),
('KH-002', '0923456789', '0923456789', 'eyJpdiI6Ik5iSGNjdHFnYkJWS2hrcDZZTXRnNUE9PSIsInZhbHVlIjoiNkpNWmVxK2hNZzN1bWVtUE5Qckg2NmhjOGJJZktQaVhId2o5TDRCSk5Kaz0iLCJtYWMiOiIxZDhiNjljZDVkMWVmYmI3YmRhMTUwNzkyN2RiOGE5YjE1OWQ1YjU0MGZlZmJhOWI1ZWJhOGRiMjlmNWIzYTJmIiwidGFnIjoiIn0=', '0923456789', 'ilovephuong122@gmail.com', 'avatars/SIVIILtwC3l4trPUnhftcFii4DtciId3alWm7ObV.jpg', 'Khách Hàng', NULL, NULL, '2025-09-20 23:37:14', '2025-10-08 04:57:17'),
('KH-003', '0934567890', '0934567890', 'eyJpdiI6InJ4enJON0hmU0ZtRWl5Q25SWEtxUGc9PSIsInZhbHVlIjoibHB2amRSS25odFk4UzI1aGo4Umlha3I3UXNmRUEvVHRUSFVjMmJlYmxKMD0iLCJtYWMiOiJmMTlmZjM5MjQ1ZWEyZjA4MjZlNGNiY2EyODk1Y2Q1YWExZjQ0ODBhYzdjYmY5ZTA0ZDVmYjhhZTE5OTY2MjMyIiwidGFnIjoiIn0=', '0934567890', 'admin3@gmail.com', '', 'Nhân Viên Thống Kê', NULL, NULL, '2025-09-20 23:37:27', '2025-10-07 07:47:52'),
('KH-004', '0945678901', '0945678901', 'eyJpdiI6InhTeU9HOUR5QVl0Rm04NldoMHMvQ3c9PSIsInZhbHVlIjoibHRObGQ4TVFheVo5akcwWWZnbkxER093bithVy9RM1o0VTRMTVBoR3lJcz0iLCJtYWMiOiJhMjllZjQxMzJlMmIzZmFlNzczNzk4MGE0Y2RkYzNlNGJmNDQyNGRkYWIyNTFjNThmOGEzMWYxODM4OWQzYzMyIiwidGFnIjoiIn0=', '0945678901', 'admin4@gmail.com', '', 'Khách Hàng', NULL, NULL, '2025-09-20 23:37:42', '2025-09-20 23:37:42'),
('KH-005', '0956789012', '0956789012', 'eyJpdiI6IkJqbE95bG5jZ0tvOEowVnpnT1NXQVE9PSIsInZhbHVlIjoiYWYvU3Q0alMrRlJmT3B5QTRBTVFYRDNTQ3dISTc4S0YxQW81WUVtUGF3MD0iLCJtYWMiOiJiZmQzMDAwNWE5ODE3Mjg3ZWY4NTBjNTY1ZTc3Mjg5NjVlODBlZjc1NGNiNGQwZDA2ZmY0MzdiNDI3NzI0YjdkIiwidGFnIjoiIn0=', '0956789012', 'admin5@gmail.com', '', 'Khách Hàng', NULL, NULL, '2025-09-20 23:37:57', '2025-09-20 23:37:57'),
('KH-006', '0967890123', '0967890123', 'eyJpdiI6IkljbDFoYWZIOERJUDBNc3pMMndZdlE9PSIsInZhbHVlIjoiUVFCcEVzV204QytGTVpDNlhEVmtXOFBubDd1UEJETEZMbEN1dklpN1lxQT0iLCJtYWMiOiI4NjAyOWZkZTcxYjc5NjRjOGFkNThjZGEwZjU2N2JlMDQ3YmI2ZWM2NTQ4ZTk5YzI1YzlkMzQyMmExYmEzZDgwIiwidGFnIjoiIn0=', '0967890123', 'admin6@gmail.com', '', 'Khách Hàng', NULL, NULL, '2025-09-20 23:38:12', '2025-09-20 23:38:12'),
('KH-007', '0978901234', '0978901234', 'eyJpdiI6IjVQM2l0UHBVZHp6a1pTVERyTlk2OFE9PSIsInZhbHVlIjoic2VvanRrTXZKTkZ6dDJBQy9ZaTNVbmZVNTBTL2hkeGY3VjQvZUhPcW5nND0iLCJtYWMiOiI1MDhhZWRiZmE0MjZlMjY1ZTk4ZWM3NDRjYTIwZDMzZmNmMWIzYmNjZmRlOGFkZmVlZTk3ZDczYzdhNzM2YTJmIiwidGFnIjoiIn0=', '0978901234', 'admin7@gmail.com', '', 'Nhân Viên Quản Lý Website', NULL, NULL, '2025-09-20 23:38:25', '2025-10-07 07:49:03'),
('KH-008', '0989012345', '0989012345', 'eyJpdiI6IjFUbk1SSm5hZkZuaDZJcXpTendiWkE9PSIsInZhbHVlIjoialRmUFZaR28xaGwvRkhHYlF0WjVrdldPamtwK0dpdXo3OHRCbloxV3krVT0iLCJtYWMiOiIyZDdiMmEyNzY5MTBiNmZlNTI2MmMwY2ZkOWY5Y2Y1ZmRmZGNmNDMxNjZjMGE1YTMyMjljMGNkNmVkM2Q3ZGMzIiwidGFnIjoiIn0=', '0989012345', 'admin8@gmail.com', '', 'Khách Hàng', NULL, NULL, '2025-09-20 23:38:39', '2025-09-20 23:38:39'),
('KH-009', '0990123456', '0990123456', 'eyJpdiI6InQvcWEvTGxmbTlOQjRQR255RklMYnc9PSIsInZhbHVlIjoiOG5UeDlFeU9lTGpGQXhZalc3ZnNvc2dMU2cvOFA4VUNJckRDaDRkcGxWcz0iLCJtYWMiOiJlZTE5ZTVkNjc0ODA1OTNmOTA3ZjcxYmQ1MGJjYTYwODJkM2JlYmNiOGQ0ZjI3YWNjOWI1Zjg5MDk5ZDMxOTVmIiwidGFnIjoiIn0=', '0990123456', 'admin9@gmail.com', '', 'Khách Hàng', NULL, NULL, '2025-09-20 23:38:55', '2025-09-20 23:38:55'),
('KH-010', '0901234567', '0901234567', 'eyJpdiI6IjJoNlVlSmVQdzRUWWhZdmlqa1JXS1E9PSIsInZhbHVlIjoiRXNkUlRWMlZROVF3Y09nMEtoWHBvRkJYK09TeCtnWHhCaG9ONHNYT2p2Zz0iLCJtYWMiOiIzNjJlMTMzM2JmMWRiNTI4ZDhkMWQ4ZGIxM2VhMzk5NDIzNjg2MWQ0YzVkYmVmYzc0OGZhNThhOTRiZjM3ZTU2IiwidGFnIjoiIn0=', '0901234567', 'admin10@gmail.com', '', 'Nhân Viên Chăm Sóc Khách Hàng', NULL, NULL, '2025-09-20 23:39:07', '2025-10-07 07:50:00'),
('KH-011', 'bùi kim ánh', 'kimanh', 'eyJpdiI6IjA4QjZsMkpYQmVTTXlTNUxWWC9WTnc9PSIsInZhbHVlIjoiYXl6N2dlSkFJeU1xaWJLbmdmR2o3QT09IiwibWFjIjoiNDkwZmJkODJlNzI1NjIyZjJmMzMwZjgxZTZhZDVkYzllNDhiNDhjMTE3Yjc1NjQwNDliZjhlMjZkMjJhZGNjOSIsInRhZyI6IiJ9', '0123443210', 'kimanh@gmail.com', '', 'Khách Hàng', NULL, NULL, '2025-10-10 06:41:23', '2025-10-10 06:41:23'),
('KH-012', 'Lê Đức Chiến', 'ducchien', 'eyJpdiI6Inl4UDVwMUZWR00wdHJzOEtZMUZ1NFE9PSIsInZhbHVlIjoiSW5NSDRkbnN4QW9zcENwM1AvOGd6Zz09IiwibWFjIjoiYjI1ZTYwNjUyOGUyNDA4ZWZjMTI3NGYzMGQ4YjVlOWJlNDBhY2JkOWRkY2NkNWUwMjdjMWRhZjMxODEzMDAyOCIsInRhZyI6IiJ9', '0123321123', 'leducchien07023@gmail.com', 'avatars/BRNmHLZX1yAL5NGYAU6I1gqOGyxDfWXk4GECOn9L.jpg', 'Khách Hàng', NULL, NULL, '2025-10-11 07:37:24', '2025-10-11 15:41:27'),
('KH-013', 'Bùi Thanh Phong', 'quanlywebsite', 'eyJpdiI6IkRIbk5yQ3R1NUVDeXJTN2ZlKzRSUGc9PSIsInZhbHVlIjoiTWJiaGptQmxIalZsWW93cFNiRVVhUT09IiwibWFjIjoiMmM5YzFjMGYxZWZlMjk1ODc1YjhmYmU2MDEyMWM0NzBhYTMxMWQ1MTYyZThjNDdiYjBiZjdjNWQ5NjAzOTY0NiIsInRhZyI6IiJ9', '0923456781', 'phong@gmail.com', '', 'Nhân Viên Quản Lý Website', NULL, NULL, '2025-10-11 17:00:34', '2025-10-11 17:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `the_loai`
--

CREATE TABLE `the_loai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten_the_loai` text NOT NULL,
  `slug` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `the_loai`
--

INSERT INTO `the_loai` (`id`, `ten_the_loai`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Cẩm nang du lịch', 'cam-nang-du-lich', '2025-10-07 05:40:10', '2025-10-07 05:40:10'),
(3, 'Review & Trải nghiệm tour thực tế', 'review-trai-nghiem-tour-thuc-te', '2025-10-07 05:40:20', '2025-10-07 05:40:20'),
(4, 'Ẩm thực & đặc sản vùng miền', 'am-thuc-dac-san-vung-mien', '2025-10-07 05:40:28', '2025-10-07 05:40:28'),
(5, 'Bí quyết du lịch thông minh', 'bi-quyet-du-lich-thong-minh', '2025-10-07 05:40:37', '2025-10-07 05:40:37'),
(6, 'Du lịch theo mùa & theo đối tượng', 'du-lich-theo-mua-theo-doi-tuong', '2025-10-07 05:40:50', '2025-10-07 05:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `id` varchar(255) NOT NULL,
  `id_LoaiTour` bigint(20) UNSIGNED NOT NULL,
  `ten_tour` text NOT NULL,
  `thoigian_tour` varchar(50) NOT NULL,
  `slug` text NOT NULL,
  `noi_khoi_hanh` varchar(100) NOT NULL,
  `ngay_bat_dau` date DEFAULT NULL,
  `gia` decimal(10,0) NOT NULL,
  `mo_ta` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`id`, `id_LoaiTour`, `ten_tour`, `thoigian_tour`, `slug`, `noi_khoi_hanh`, `ngay_bat_dau`, `gia`, `mo_ta`, `created_at`, `updated_at`) VALUES
('T-001', 1, 'Tour Khám Phá Vịnh Hạ Long – Kỳ Quan Thiên Nhiên Thế Giới', '3 ngày 2 đêm', 'tour-kham-pha-vinh-ha-long-ky-quan-thien-nhien-the-gioi', 'Hà Nội', '2025-10-16', 2500000, '<p>Nằm c&aacute;ch thủ đ&ocirc; H&agrave; Nội chưa đầy 2 giờ xe chạy &ocirc; t&ocirc;, qu&yacute; kh&aacute;ch c&oacute; mặt tại Vịnh Hạ Long &ndash; Kỳ quan thi&ecirc;n nhi&ecirc;n Thế giới.</p>\r\n\r\n<p>Với h&agrave;ng ng&agrave;n đảo đ&aacute; nhấp nh&ocirc;, ẩn hiện tr&ecirc;n s&oacute;ng nước, Vịnh Hạ Long được v&iacute; như &ldquo;Kỳ quan đất dựng giữa trời cao&rdquo;.</p>\r\n\r\n<p>Chiếc t&agrave;u rẽ s&oacute;ng nước, luồn l&aacute;ch qua những đảo đ&aacute; đưa du kh&aacute;ch từ bất ngờ n&agrave;y đến bất ngờ kh&aacute;c: H&ograve;n Trống M&aacute;i như đ&ocirc;i g&agrave; t&acirc;m t&igrave;nh giữa biển khơi; Tạo h&oacute;a kh&eacute;o sắp đặt để H&ograve;n Ch&oacute; Đ&aacute;, H&ograve;n Lư Hương vẫn trường tồn c&ugrave;ng s&oacute;ng nước Hạ Long&hellip;</p>\r\n\r\n<p><strong>NG&Agrave;Y 01: H&Agrave; NỘI &ndash; HẠ LONG (ĂN TRƯA, TỐI)</strong></p>\r\n\r\n<p><strong>08h30:</strong>&nbsp;Xe v&agrave; Hướng dẫn vi&ecirc;n (HDV) đ&oacute;n qu&yacute; kh&aacute;ch tại cổng C&ocirc;ng Vi&ecirc;n Thống Nhất &ndash; Đường Trần Nh&acirc;n T&ocirc;ng &ndash; Quận Hai B&agrave; Trưng &ndash; Tp H&agrave; Nội, khởi h&agrave;nh đi Hạ Long. Tr&ecirc;n đường qu&yacute; kh&aacute;ch dừng ch&acirc;n nghỉ ngơi tại Hải Dương.</p>\r\n\r\n<p><strong>11h00:</strong>&nbsp;Đến Hạ Long, qu&yacute; kh&aacute;ch d&ugrave;ng bữa trưa tại nh&agrave; h&agrave;ng.</p>\r\n\r\n<p><strong>12h30:&nbsp;</strong>Đo&agrave;n về kh&aacute;ch sạn 3 sao, nghỉ ngơi, nhận ph&ograve;ng.</p>\r\n\r\n<p><strong>15h00:</strong>&nbsp;Qu&yacute; kh&aacute;ch tự do tắm biển B&atilde;i Ch&aacute;y hoặc tham gia c&aacute;c hoạt động vui chơi tại Khu du lịch Hạ Long Park với h&agrave;ng chục tr&ograve; chơi hiện đại, cảm gi&aacute;c mạnh h&agrave;ng đầu Việt Nam (Chi ph&iacute; tham gia c&aacute;c tr&ograve; chơi tự t&uacute;c).</p>\r\n\r\n<p><strong>19h00:</strong>&nbsp;Ăn tối tại nh&agrave; h&agrave;ng.</p>\r\n\r\n<p><strong>20h30:</strong>&nbsp;Qu&yacute; kh&aacute;ch tự do dạo chơi phố biển về đ&ecirc;m, đi chợ đ&ecirc;m Hạ Long. Nghỉ đ&ecirc;m tại kh&aacute;ch sạn Tp Hạ Long.</p>\r\n\r\n<p><strong>NG&Agrave;Y 02: KH&Aacute;M PH&Aacute; VỊNH HẠ LONG (ĂN S&Aacute;NG, TRƯA, TỐI)</strong></p>\r\n\r\n<p><strong>07h00:</strong>&nbsp;Sau khi ăn s&aacute;ng, Xe đ&oacute;n qu&yacute; kh&aacute;ch ra bến t&agrave;u Tuần Ch&acirc;u. Đo&agrave;n l&ecirc;n t&agrave;u, thăm quan tuyến 4 tiếng với h&ograve;n Trống M&aacute;i, Đỉnh Hương, H&ograve;n Ch&oacute; Đ&aacute; v&agrave; dừng lại ở l&agrave;ng ch&agrave;i. Qu&yacute; kh&aacute;ch tiếp tục đến với Động Thi&ecirc;n Cung hoặc Hang Đầu Gỗ (lựa chọn 1 trong 2 hang động tr&ecirc;n).</p>\r\n\r\n<p>Đ&acirc;y l&agrave; một trong những hang động nổi tiếng nhất của Vịnh Hạ Long. Qu&yacute; kh&aacute;ch thăm quan v&agrave; kh&aacute;m ph&aacute; vẻ đẹp huyền b&iacute; của những hang động tr&ecirc;n Vịnh Hạ Long. Đo&agrave;n trở lại t&agrave;u v&agrave; d&ugrave;ng bữa trưa tr&ecirc;n t&agrave;u, thưởng thức hương vị hải sản Hạ Long.</p>\r\n\r\n<p><strong>12h00:&nbsp;</strong>T&agrave;u cập bến cảng Tuần Ch&acirc;u, xe đ&oacute;n đo&agrave;n về lại trung t&acirc;m th&agrave;nh phố Hạ Long. Qu&yacute; kh&aacute;ch nghỉ ngơi.</p>\r\n\r\n<p><strong>15h00:</strong>&nbsp;Qu&yacute; kh&aacute;ch tự do dạo chơi</p>\r\n\r\n<p><strong>19h00:&nbsp;</strong>Đo&agrave;n d&ugrave;ng bữa tối tại nh&agrave; h&agrave;ng. Đ&ecirc;m xuống, qu&yacute; kh&aacute;ch (tự t&uacute;c phương tiện) tham quan khu du lịch quốc tế Tuần Ch&acirc;u với c&aacute;c hoạt động vui chơi, giải tr&iacute; hấp dẫn như : Xiếc khỉ, biểu diễn c&aacute; heo,&nbsp;c&aacute; sấu, nhạc nước v&agrave; c&aacute;c tr&ograve; chơi cảm gi&aacute;c mạnh. (Chi ph&iacute; v&eacute; thăm quan tự t&uacute;c).</p>\r\n\r\n<p><strong>NG&Agrave;Y 03: HẠ LONG &ndash; H&Agrave; NỘI (ĂN S&Aacute;NG, TRƯA)</strong></p>\r\n\r\n<p><strong>07h00:</strong>&nbsp;Sau khi ăn s&aacute;ng, qu&yacute; kh&aacute;ch trả ph&ograve;ng.</p>\r\n\r\n<p><strong>08h30:</strong>&nbsp;Xe đ&oacute;n đo&agrave;n qua b&ecirc;n kia cầu B&atilde;i Ch&aacute;y, qu&yacute; kh&aacute;ch thăm quan Ch&ugrave;a Long Ti&ecirc;n &ndash; N&uacute;i B&agrave;i Thơ, đ&acirc;y l&agrave; một trong những thắng cảnh kh&ocirc;ng thể bỏ qua khi đến với Hạ Long.</p>\r\n\r\n<p>Tr&ecirc;n h&agrave;nh tr&igrave;nh, qu&yacute; kh&aacute;ch đi qua cầu B&atilde;i Ch&aacute;y, ngắm nh&igrave;n to&agrave;n cảnh đ&ocirc;i bờ Th&agrave;nh phố Hạ Long v&agrave; vịnh Hạ Long từ tr&ecirc;n cao.</p>\r\n\r\n<p><em>Qua cầu B&atilde;i Ch&aacute;y, ngắm nh&igrave;n to&agrave;n cảnh đ&ocirc;i bờ Th&agrave;nh phố Hạ Long</em></p>\r\n\r\n<p><strong>10h00:</strong>&nbsp;Xe &ocirc; t&ocirc; đưa đo&agrave;n trở lại th&agrave;nh phố Hạ Long, qu&yacute; kh&aacute;ch gh&eacute; thăm cơ sở sản xuất hải sản Hạ Long, qu&yacute; kh&aacute;ch mua đặc sản kh&ocirc; &ndash; tươi về l&agrave;m qu&agrave; cho gia đ&igrave;nh v&agrave; người th&acirc;n.</p>\r\n\r\n<p><strong>11h30:</strong>&nbsp;Đo&agrave;n d&ugrave;ng bữa trưa tại nh&agrave; h&agrave;ng, trước khi rời Hạ Long.</p>\r\n\r\n<p><strong>13h00:&nbsp;</strong>Qu&yacute; kh&aacute;ch l&ecirc;n xe về lại H&agrave; Nội. Tr&ecirc;n đường đo&agrave;n dừng ch&acirc;n tại trạm dừng ch&acirc;n đường cao tốc H&agrave; Nội &ndash; Hải Ph&ograve;ng, mua đặc sản b&aacute;nh đậu xanh, b&aacute;nh gai Hải Dương về l&agrave;m qu&agrave;.</p>\r\n\r\n<p><strong>16h00:&nbsp;</strong>Đo&agrave;n về đến địa điểm đ&oacute;n kh&aacute;ch ban đầu, trả kh&aacute;ch tại điểm đ&oacute;n. Chia tay qu&yacute; kh&aacute;ch v&agrave; hẹn gặp lại.</p>\r\n\r\n<p><strong>GI&Aacute; TOUR BAO GỒM:</strong></p>\r\n\r\n<p>&bull; Xe &ocirc; t&ocirc; 16,25,35,45 chỗ m&aacute;y lạnh, đời mới đưa đ&oacute;n theo chương tr&igrave;nh.</p>\r\n\r\n<p>&bull;&nbsp;Ph&ograve;ng kh&aacute;ch sạn theo ti&ecirc;u chuẩn 3 sao trung t&acirc;m th&agrave;nh phố Hạ Long, đầy đủ tiện nghi, nghỉ 2 người/ 1 ph&ograve;ng. Nếu lẻ nam hoặc nữ ngủ gh&eacute;p 3 người/1 ph&ograve;ng.</p>\r\n\r\n<p>&bull;&nbsp;Hướng dẫn vi&ecirc;n, l&aacute;i xe nhiệt t&igrave;nh v&agrave; kinh nghiệm theo đo&agrave;n suốt tuyến.</p>\r\n\r\n<p>&bull;&nbsp;T&agrave;u thăm vịnh an to&agrave;n, sạch đẹp tuyến 4 tiếng : Tuyến Thi&ecirc;n Cung &ndash; Đầu Gỗ.</p>\r\n\r\n<p>&bull;&nbsp;Ăn s&aacute;ng buffet 2 bữa theo ph&ograve;ng tại kh&aacute;ch sạn v&agrave; 05 bữa ch&iacute;nh thực đơn. Gồm 4 bữa 120.000đ/ 1 suất. 2 bữa thực đơn 150.000đ/ 1 suất.</p>\r\n\r\n<p>&bull;&nbsp;V&eacute; thăm quan Hạ Long.</p>\r\n\r\n<p>&bull;&nbsp;Bảo hiểm du lịch, mức đền b&ugrave; 20.000.000đ/ 1 trường hợp.</p>\r\n\r\n<p>&bull;&nbsp;Nước uống 1 chai/ 1 người/ 1 ng&agrave;y.</p>\r\n\r\n<p>&bull;&nbsp;Mũ du lịch.</p>\r\n\r\n<p><strong>GI&Aacute; TOUR KH&Ocirc;NG BAO GỒM:</strong></p>\r\n\r\n<p>&bull;&nbsp;Đồ uống trong bữa ăn.</p>\r\n\r\n<p>&bull;&nbsp;Chưa bao gồm thuế VAT 10%</p>\r\n\r\n<p>&bull;&nbsp;Chi ph&iacute; di chuyển từ Tp Hạ Long ra KDL Quốc tế Tuần Ch&acirc;u v&agrave; ngược lại.</p>\r\n\r\n<p>&bull;&nbsp;V&eacute; vui chơi tại KDL Hạ Long Park, KDL Quốc tế Tuần Ch&acirc;u.</p>\r\n\r\n<p>&bull;&nbsp;Chi ph&iacute; kh&ocirc;ng được đề cập trong chương tr&igrave;nh.</p>', '2025-09-21 02:33:21', '2025-10-08 08:04:22'),
('T-002', 1, 'Tour Nha Trang – Thiên Đường Biển Xanh & Cát Trắng', '4 ngày 3 đêm', 'tour-nha-trang-thien-duong-bien-xanh-cat-trang', 'Hà Nội', '2025-10-31', 2500000, '<p><strong>NG&Agrave;Y 01: H&Agrave; NỘI &ndash; CAM RANH &ndash; NINH THUẬN&nbsp;</strong><strong>(Ăn: Trưa / Tối</strong><strong>)</strong></p>\r\n\r\n<p><strong>S&aacute;ng</strong>: Xe &ocirc; t&ocirc; v&agrave; hướng dẫn vi&ecirc;n đ&oacute;n qu&yacute; kh&aacute;ch tại&nbsp;<strong>Cổng C&ocirc;ng Vi&ecirc;n Thống Nhất</strong>&nbsp;&ndash; Đường Trần Nh&acirc;n T&ocirc;ng &ndash; Q. Hai B&agrave; Trưng &ndash; Tp H&agrave; Nội, đi s&acirc;n bay Nội B&agrave;i, đ&aacute;p chuyến bay VN1557 l&uacute;c 08h45 hoặc VN1561 l&uacute;c 11h35 đi s&acirc;n bay Cam Ranh.</p>\r\n\r\n<p><strong>Trưa:&nbsp;</strong>Sau 2 tiếng bay, qu&yacute; kh&aacute;ch đến s&acirc;n bay Cam Ranh, xe v&agrave; HDV địa phương đ&oacute;n đo&agrave;n đi Ninh Thuận. Tr&ecirc;n đường qu&yacute; kh&aacute;ch d&ugrave;ng bữa trưa tại nh&agrave; h&agrave;ng.</p>\r\n\r\n<p><strong>Chiều:&nbsp;</strong>Đến Ninh Thuận (C&aacute;ch s&acirc;n bay Cam Ranh 70km), qu&yacute; kh&aacute;ch nhận ph&ograve;ng Resort - Kh&aacute;ch sạn 4*, nghỉ ngơi. Qu&yacute; kh&aacute;ch tự do dạo chơi, tắm biển Ninh Chữ.</p>\r\n\r\n<p><strong>Tối:&nbsp;</strong>Qu&yacute; kh&aacute;ch d&ugrave;ng bữa tối tại nh&agrave; h&agrave;ng, thưởng thức hải sản biển Ninh Chữ.</p>\r\n\r\n<p><strong>Nghỉ đ&ecirc;m kh&aacute;ch sạn 4* tại Ninh Chữ.</strong></p>\r\n\r\n<p><strong>NG&Agrave;Y 02: KH&Aacute;M PH&Aacute; NINH THUẬN&nbsp;</strong><strong>(Ăn</strong><strong>:</strong>&nbsp;<strong>S&aacute;ng/&nbsp;</strong><strong>Trưa/ Tối)</strong></p>\r\n\r\n<p><strong>S&aacute;ng</strong>: Ăn s&aacute;ng tại kh&aacute;ch sạn.</p>\r\n\r\n<p><strong>07h30:&nbsp;</strong>Xe đưa đo&agrave;n đi thăm quan:</p>\r\n\r\n<p><strong>L&agrave;ng Gốm B&agrave;u Tr&uacute;c :</strong>&nbsp;Ng&ocirc;i l&agrave;ng gốm cổ nhất của Đ&ocirc;ng Nam &Aacute;. Với kỹ thuật l&agrave;m gốm độc đ&aacute;o, đặc sắc bậc nhất Việt Nam khi kh&ocirc;ng d&ugrave;ng b&agrave;n xoay m&agrave; d&ugrave;ng ho&agrave;n to&agrave;n bằng đ&ocirc;i tay của người thợ Chăm. Từ nh&agrave;o đất, tạo h&igrave;nh, vẽ hoa văn&hellip;Gốm B&agrave;u Tr&uacute;c như mang cả 1 bảo tang Ninh Thuận v&agrave;o trong từng sản phẩm.</p>\r\n\r\n<p><strong>Đồng Cừu An H&ograve;a</strong>. C&ugrave;ng kh&aacute;m ph&aacute; cuộc sống du mục của đồng b&agrave;o Chăm nơi đ&acirc;y.</p>\r\n\r\n<p><strong>Trưa:&nbsp;</strong>Đo&agrave;n về lại Tp Phan Rang &ndash; Th&aacute;p Ch&agrave;m d&ugrave;ng bữa trưa tại nh&agrave; h&agrave;ng.</p>\r\n\r\n<p><strong>Chiều:&nbsp;</strong>Qu&yacute; kh&aacute;ch l&ecirc;n xe thăm quan:</p>\r\n\r\n<p><strong>Th&aacute;p Poklong Garai :</strong>&nbsp;Đ&acirc;y l&agrave; 1 c&ocirc;ng tr&igrave;nh kiến tr&uacute;c của đồng b&agrave;o Chăm, c&ograve;n s&oacute;t lại tại Ninh Thuận. Một trong những cụm th&aacute;p Chăm được đ&aacute;nh gi&aacute; l&agrave; đẹp nhất tại Việt Nam.</p>\r\n\r\n<p><strong>Đồi C&aacute;t Nam Cương</strong>. C&ugrave;ng trải nghiệm cảm gi&aacute;c đi những bước ch&acirc;n trần tr&ecirc;n c&aacute;t v&agrave; chụp ảnh với những đồi c&aacute;t như tiểu sa mạc.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Qu&yacute; kh&aacute;ch về lại kh&aacute;ch sạn, nghỉ ngơi, tắm biển.</p>\r\n\r\n<p><strong>Tối:</strong>&nbsp;Đo&agrave;n d&ugrave;ng bữa tối tại nh&agrave; h&agrave;ng. Tự do kh&aacute;m ph&aacute; th&agrave;nh phố Phan Rang &ndash; Th&aacute;p Ch&agrave;m về đ&ecirc;m</p>\r\n\r\n<p><strong>Nghỉ đ&ecirc;m tại Resort &ndash; Kh&aacute;ch sạn 4*.</strong></p>\r\n\r\n<p><strong>NG&Agrave;Y 03: NINH THUẬN &ndash; NHA TRANG&nbsp;&nbsp;(Ăn:</strong><strong>&nbsp;S&aacute;ng/ Trưa)</strong>&nbsp;</p>\r\n\r\n<p><strong>S&aacute;ng:</strong>&nbsp;Sau khi ăn s&aacute;ng, qu&yacute; kh&aacute;ch trả ph&ograve;ng đi Nha Trang. Tr&ecirc;n đường qu&yacute; kh&aacute;ch dừng ch&acirc;n thăm quan.</p>\r\n\r\n<p><strong>&bull; Hang R&aacute;i:</strong>&nbsp;Hang R&aacute;i l&agrave; một quần thể địa chất, sắp xếp t&agrave;i t&igrave;nh của h&agrave;ng trăm vi&ecirc;n đ&aacute; lớn nhỏ kh&aacute;c nhau, tạo n&ecirc;n những h&igrave;nh th&ugrave; đẹp mắt, những hang luồn chỉ đủ một người chui qua hay những v&aacute;ch đ&aacute; cheo leo thử th&aacute;ch sự can đảm của bạn. Kh&aacute;m ph&aacute; một v&ograve;ng c&ocirc;ng vi&ecirc;n đ&aacute;, bạn sẽ được chi&ecirc;m ngưỡng sự h&ugrave;ng vĩ của biển v&agrave; n&uacute;i, ngắm to&agrave;n cảnh tr&ecirc;n cao b&atilde;i san h&ocirc; cổ.</p>\r\n\r\n<p><strong>&bull;&nbsp;</strong><strong>Vườn nho:</strong>&nbsp;Dọc đường từ Ninh Thuận đi Vĩnh Hy, qu&yacute; kh&aacute;ch c&oacute; dịp gh&eacute; thăm c&aacute;c vườn nho, thưởng thức siro nho, rượu nho v&agrave; ăn trực tiếp nho tại vườn. Qu&yacute; kh&aacute;ch mua c&aacute;c sản phầm qu&agrave; tặng từ nho về l&agrave;m qu&agrave; cho người th&acirc;n v&agrave; gia đ&igrave;nh.</p>\r\n\r\n<p><strong>&bull;&nbsp;</strong><strong>Vịnh Vĩnh Hy:</strong>&nbsp;Vĩnh Hy l&agrave; vịnh biển nhỏ, nằm dưới ch&acirc;n n&uacute;i Ch&uacute;a cao 1040m so với mực nước biển. Qu&yacute; kh&aacute;ch thăm l&agrave;ng ch&agrave;i, l&ecirc;n t&agrave;u đ&aacute;y k&iacute;nh ngắm san h&ocirc; tr&ecirc;n vịnh Vĩnh Hy.</p>\r\n\r\n<p><strong>Trưa:&nbsp;</strong>Đo&agrave;n d&ugrave;ng bữa trưa tại nh&agrave; h&agrave;ng Vĩnh Hy, thưởng thức hải sản biển Ninh Thuận.</p>\r\n\r\n<p>Đo&agrave;n tiếp tục l&ecirc;n đường về Nha Trang.</p>\r\n\r\n<p>Đến Tp Nha Trang, qu&yacute; kh&aacute;ch nhận ph&ograve;ng kh&aacute;ch sạn 4* v&agrave; nghỉ ngơi.</p>\r\n\r\n<p><strong>Chiều:&nbsp;</strong>Xe đ&oacute;n đo&agrave;n đi thăm quan<strong>&nbsp;khu giải tr&iacute; Vinpearlland</strong>&nbsp;(chi ph&iacute; tự t&uacute;c) qu&yacute; kh&aacute;ch tham gia c&aacute;c tr&ograve; chơi:</p>\r\n\r\n<p>Tr&ograve; chơi cảm gi&aacute;c mạnh: Quay nh&agrave;o lộn, đu quay ngựa gỗ, đu quay voi</p>\r\n\r\n<p>Tr&ograve; chơi tĩnh như: t&agrave;u lượn, đua xe, kh&aacute;m ph&aacute; vũ trụ, trượt tuyết, lướt s&oacute;ng, xe điện đụng</p>\r\n\r\n<p>Tự do kh&aacute;m ph&aacute; cảm gi&aacute;c c&ocirc;ng nghệ chiếu phim 4D mới lạ, đặc sắc.</p>\r\n\r\n<p>Kh&aacute;m ph&aacute; thủy cung Vinpeal - với những sinh vật biển đa dạng phong ph&uacute;.</p>\r\n\r\n<p>Thưởng thức cung tr&igrave;nh biểu diễn nhạc nước v&ocirc; c&ugrave;ng th&uacute; vị - s&acirc;n khấu nơi từng diễn ra c&aacute;c hoạt đ&ocirc;ng văn h&oacute;a lớn: Hoa Hậu B&aacute;o Tiền Phong, Duy&ecirc;n d&aacute;ng Việt Nam &hellip;</p>\r\n\r\n<p><strong>Tối:&nbsp;</strong>Qu&yacute; kh&aacute;ch ăn tối tự t&uacute;c tại Vinpearlland.&nbsp;<strong>21:00</strong>&nbsp;Qu&yacute; kh&aacute;ch đi c&aacute;p treo trở về th&agrave;nh phố. Xe đ&oacute;n đo&agrave;n đưa Q&uacute;y kh&aacute;ch về kh&aacute;ch sạn.</p>\r\n\r\n<p><strong>Nghỉ đ&ecirc;m tại kh&aacute;ch sạn 4*ở Nha Trang.</strong></p>\r\n\r\n<p><strong>NG&Agrave;Y 04:&nbsp;</strong><strong>NHA TRANG &ndash; H&Agrave; NỘI</strong>&nbsp;<strong>(Ăn</strong><strong>:</strong><strong>&nbsp;S&aacute;ng/Trưa)</strong></p>\r\n\r\n<p>S&aacute;ng: Ăn s&aacute;ng v&agrave; trả ph&ograve;ng kh&aacute;ch sạn.</p>\r\n\r\n<p>Qu&yacute; kh&aacute;ch l&ecirc;n xe đi Cảng Cầu Đ&aacute; kh&aacute;m ph&aacute;&nbsp;<strong>Vịnh Nha Trang</strong>&nbsp;-&nbsp;<strong>một trong 29 vịnh đẹp nhất thế giới. Đo&agrave;n xuống Cano bắt đầu h&agrave;nh tr&igrave;nh kh&aacute;m ph&aacute; vịnh Nha Trang.</strong></p>\r\n\r\n<p><strong>&bull;&nbsp;</strong><strong>H&ograve;n Mun:&nbsp;</strong>Qu&yacute; kh&aacute;ch tham quan, bơi lặn trực tiếp hoặc đi t&agrave;u đ&aacute;y k&iacute;nh, lặn b&igrave;nh Oxy (chi ph&iacute; tự t&uacute;c) ngắm nh&igrave;n những mảng san h&ocirc; v&agrave; c&aacute;c lo&agrave;i sinh vật biển qu&yacute; hiếm tại khu Bảo tồn biển lớn nhất Việt Nam.</p>\r\n\r\n<p><strong>&bull;&nbsp;</strong><strong>H&ograve;n Một:</strong>&nbsp;Qu&yacute; kh&aacute;ch thăm quan, tắm biển v&agrave; chơi c&aacute;c tr&ograve; chơi lướt s&oacute;ng, cano tại đảo (Chi ph&iacute; tự t&uacute;c)</p>\r\n\r\n<p><strong>&bull;&nbsp;</strong><strong>H&ograve;n Sẻ Tre:</strong>&nbsp;Qu&yacute; kh&aacute;ch d&ugrave;ng bữa trưa tại nh&agrave; h&agrave;ng. Tự do nằm nghỉ tại ghế b&ecirc;n bờ biển.</p>\r\n\r\n<p><strong>Chiều:</strong>&nbsp;Cano đưa qu&yacute; kh&aacute;ch về lại cảng Cầu Đ&aacute;. Xe đ&oacute;n đo&agrave;n đi mua sắm h&agrave;ng h&oacute;a, đặc sản Nha Trang về l&agrave;m qu&agrave; cho người th&acirc;n v&agrave; gia đ&igrave;nh.</p>\r\n\r\n<p>Đo&agrave;n khởi h&agrave;nh ra s&acirc;n bay Cam Ranh, đ&aacute;p chuyến bay&nbsp;<strong>VN1564</strong>&nbsp;l&uacute;c 19h10 về lại H&agrave; Nội. Đo&agrave;n d&ugrave;ng bữa tối nhẹ tr&ecirc;n m&aacute;y bay.</p>\r\n\r\n<p><strong>Tối:&nbsp;</strong>Đến s&acirc;n bay Nội B&agrave;i, xe v&agrave; HDV đ&oacute;n đo&agrave;n về lại trung t&acirc;m H&agrave; Nội, trả kh&aacute;ch tại điểm đ&oacute;n, chia tay qu&yacute; kh&aacute;ch v&agrave; hẹn gặp lại.</p>\r\n\r\n<p><strong>GI&Aacute; TOUR BAO GỒM:</strong></p>\r\n\r\n<p>&bull; V&eacute; m&aacute;y bay v&agrave; lệ ph&iacute; s&acirc;n bay H&agrave; Nội - Nha Trang &ndash; H&agrave; Nội: đ&atilde; gồm 12kg h&agrave;nh l&yacute; x&aacute;ch tay + 23kg h&agrave;nh l&yacute; k&yacute; gửi.</p>\r\n\r\n<p>&bull;&nbsp;Kh&aacute;ch sạn ti&ecirc;u chuẩn 4 sao theo chương tr&igrave;nh. Ti&ecirc;u chuẩn 02 người lớn/ph&ograve;ng. Ph&ograve;ng 3 sẽ được bố tr&iacute; khi cần thiết v&igrave; l&yacute; do giới t&iacute;nh.</p>\r\n\r\n<p><strong>Tp Nha Trang :</strong>&nbsp;Isena Hotel &ndash; Ti&ecirc;u chuẩn 4 sao.</p>\r\n\r\n<p><strong>Tp Phan Rang &ndash;</strong>&nbsp;<strong>Th&aacute;p Ch&agrave;m :&nbsp;</strong>TTC Ninh Thuận Hotel &ndash; Ti&ecirc;u chuẩn 4 sao.&nbsp;<strong>Hoặc kh&aacute;ch sạn ti&ecirc;u chuẩn tương đương.</strong></p>\r\n\r\n<p>&bull;&nbsp;Xe &ocirc; t&ocirc; m&aacute;y lạnh đời mới theo lịch tr&igrave;nh tại Nha Trang &ndash; Ninh Thuận</p>\r\n\r\n<p>&bull;&nbsp;Xe &ocirc; t&ocirc; m&aacute;y lạnh đời mới đưa đ&oacute;n s&acirc;n bay Nội B&agrave;i</p>\r\n\r\n<p>&bull;&nbsp;Ăn uống theo chương tr&igrave;nh:</p>\r\n\r\n<p><strong>Mức ăn ch&iacute;nh:</strong>&nbsp;150,000đ/kh&aacute;ch x 06 bữa.</p>\r\n\r\n<p><strong>Ăn s&aacute;ng tại kh&aacute;ch sạn:</strong>&nbsp;03 bữa buffet.</p>\r\n\r\n<p>&bull;&nbsp;Hướng dẫn vi&ecirc;n nhiệt t&igrave;nh, kinh nghiệm đ&oacute;n tiễn, l&agrave;m thủ tục tại s&acirc;n bay Nội B&agrave;i</p>\r\n\r\n<p>&bull;&nbsp;Hướng dẫn vi&ecirc;n nhiệt t&igrave;nh, kinh nghiệm theo suốt h&agrave;nh tr&igrave;nh tại Nha Trang &ndash; Ninh Thuận</p>\r\n\r\n<p>&bull;&nbsp;Ph&iacute; thắng cảnh c&aacute;c điểm v&agrave;o cửa lần thứ nhất c&aacute;c điểm c&oacute; trong chương tr&igrave;nh.</p>\r\n\r\n<p>&bull;&nbsp;Cano thăm quan đảo theo chương tr&igrave;nh.</p>\r\n\r\n<p>&bull;&nbsp;T&agrave;u đ&aacute;y k&iacute;nh tại Vĩnh Hy &ndash; Ninh Thuận</p>\r\n\r\n<p>&bull;&nbsp;Bảo hiểm du lịch suốt tuyến (mức đền b&ugrave; tối đa 20,000,000đ/vụ).</p>\r\n\r\n<p>&bull;&nbsp;Nước uống: 1 chai/ng&agrave;y/ 1 người</p>\r\n\r\n<p>&bull;&nbsp;Mũ du lịch.</p>\r\n\r\n<p><strong>GI&Aacute; TOUR</strong><strong>&nbsp;KH&Ocirc;NG BAO GỒM:</strong></p>\r\n\r\n<p>&bull;&nbsp;Chi ph&iacute; v&agrave;o Vinpearlland Nha Trang.</p>\r\n\r\n<p>&bull;&nbsp;Chi ph&iacute; tham gia c&aacute;c tr&ograve; chơi tr&ecirc;n biển tại H&ograve;n Mun &ndash; H&ograve;n Một</p>\r\n\r\n<p>&bull;&nbsp;Chi ph&iacute; thuyền đ&aacute;y k&iacute;nh, lặn ngắm san h&ocirc;.</p>\r\n\r\n<p><strong>Chi ph&iacute; bữa tối ng&agrave;y đi thăm Vinpearlland.</strong></p>\r\n\r\n<p><strong>Chi ph&iacute; vui chơi c&ocirc;ng vi&ecirc;n nước tại TTC Hotel Ninh Thuận.</strong></p>\r\n\r\n<p>&bull;&nbsp;H&oacute;a đơn VAT 10%.</p>\r\n\r\n<p>&bull;&nbsp;Chi ph&iacute; c&aacute; nh&acirc;n v&agrave; c&aacute;c chi ph&iacute; kh&aacute;c ph&aacute;t sinh ngo&agrave;i chương tr&igrave;nh, ngủ ph&ograve;ng đơn, tiền đi lại ngo&agrave;i giờ, đồ uống, ...</p>', '2025-09-21 02:33:50', '2025-10-08 08:47:39'),
('T-003', 1, 'Tour Phú Quốc – Đảo Ngọc Ngàn Nắng', '3 ngày 2 đêm', 'tour-phu-quoc-dao-ngoc-ngan-nang', 'Hà Nội', '2025-10-18', 3000000, '<p>Ph&uacute; Quốc &ndash; h&ograve;n đảo lớn nhất Việt Nam, được mệnh danh l&agrave; &ldquo;Đảo Ngọc&rdquo; giữa vịnh Th&aacute;i Lan. Nơi đ&acirc;y sở hữu những b&atilde;i biển hoang sơ, l&agrave;n nước trong xanh như ngọc, rừng nguy&ecirc;n sinh xanh m&aacute;t v&agrave; những rạn san h&ocirc; tuyệt đẹp.</p>\r\n\r\n<p>Kh&ocirc;ng chỉ nổi tiếng về cảnh quan thi&ecirc;n nhi&ecirc;n, Ph&uacute; Quốc c&ograve;n hấp dẫn du kh&aacute;ch bởi nền ẩm thực đặc sắc với nước mắm, hồ ti&ecirc;u, hải sản tươi ngon v&agrave; n&eacute;t văn h&oacute;a địa phương mộc mạc, ch&acirc;n t&igrave;nh.</p>\r\n\r\n<p><strong>NG&Agrave;Y 01: H&Agrave; NỘI &ndash; PH&Uacute; QUỐC (ĂN TRƯA, TỐI)</strong><br />\r\nS&aacute;ng: Xe đ&oacute;n đo&agrave;n tại điểm hẹn, ra s&acirc;n bay Nội B&agrave;i, l&agrave;m thủ tục bay đến Ph&uacute; Quốc.<br />\r\n10h30: Đến s&acirc;n bay Ph&uacute; Quốc, xe đưa đo&agrave;n về kh&aacute;ch sạn, nhận ph&ograve;ng, nghỉ ngơi.<br />\r\n12h00: Ăn trưa tại nh&agrave; h&agrave;ng.<br />\r\nChiều: Tham quan L&agrave;ng Ch&agrave;i H&agrave;m Ninh, thưởng thức hải sản tươi sống.<br />\r\n19h00: Ăn tối, tự do dạo chợ đ&ecirc;m Dinh Cậu. Nghỉ đ&ecirc;m tại Ph&uacute; Quốc.</p>\r\n\r\n<p><strong>NG&Agrave;Y 02: KH&Aacute;M PH&Aacute; NAM ĐẢO &ndash; C&Acirc;U C&Aacute;, LẶN NGẮM SAN H&Ocirc; (ĂN S&Aacute;NG, TRƯA, TỐI)</strong><br />\r\n07h00: Ăn s&aacute;ng tại kh&aacute;ch sạn.<br />\r\n08h00: Xe đưa đo&agrave;n tham quan Nh&agrave; t&ugrave; Ph&uacute; Quốc, Thiền viện Tr&uacute;c L&acirc;m Hộ Quốc.<br />\r\n11h00: L&ecirc;n t&agrave;u du lịch ra khơi, trải nghiệm c&acirc;u c&aacute;, lặn ngắm san h&ocirc;.<br />\r\n12h30: Ăn trưa tr&ecirc;n t&agrave;u với c&aacute;c m&oacute;n hải sản tươi ngon.<br />\r\nChiều: Tham quan Sunset Sanato &ndash; địa điểm check-in nổi tiếng.<br />\r\n19h00: Ăn tối v&agrave; nghỉ đ&ecirc;m tại Ph&uacute; Quốc.</p>\r\n\r\n<p><strong>NG&Agrave;Y 03: PH&Uacute; QUỐC &ndash; H&Agrave; NỘI (ĂN S&Aacute;NG, TRƯA)</strong><br />\r\n07h00: Ăn s&aacute;ng, trả ph&ograve;ng.<br />\r\n08h00: Mua sắm đặc sản tại chợ Dương Đ&ocirc;ng (nước mắm, hải sản kh&ocirc;, hồ ti&ecirc;u...).<br />\r\n11h30: Ăn trưa tại nh&agrave; h&agrave;ng.<br />\r\n13h00: Xe đưa đo&agrave;n ra s&acirc;n bay, đ&aacute;p chuyến bay về H&agrave; Nội. Kết th&uacute;c tour.</p>\r\n\r\n<p><strong>GI&Aacute; TOUR BAO GỒM:</strong><br />\r\n&bull; V&eacute; m&aacute;y bay khứ hồi, xe đưa đ&oacute;n, kh&aacute;ch sạn 3 sao.<br />\r\n&bull; Ăn uống, v&eacute; tham quan, t&agrave;u lặn san h&ocirc;.<br />\r\n&bull; HDV, bảo hiểm du lịch, nước uống.</p>\r\n\r\n<h2><strong>KH&Ocirc;NG BAO GỒM:</strong><br />\r\n&bull; Chi ph&iacute; c&aacute; nh&acirc;n, VAT, đồ uống, v&eacute; vui chơi ngo&agrave;i chương tr&igrave;nh.</h2>', '2025-09-21 02:34:15', '2025-10-08 08:47:47'),
('T-004', 1, 'Tour Đà Nẵng – Hội An – Bà Nà Hills', '3 ngày 2 đêm', 'tour-da-nang-hoi-an-ba-na-hills', 'Hà Nội', '2025-10-22', 4000000, '<p>Đ&agrave; Nẵng &ndash; th&agrave;nh phố đ&aacute;ng sống nhất Việt Nam, kết hợp ho&agrave;n hảo giữa biển xanh, n&uacute;i cao v&agrave; con người th&acirc;n thiện. H&agrave;nh tr&igrave;nh đưa du kh&aacute;ch kh&aacute;m ph&aacute; vẻ đẹp của th&agrave;nh phố hiện đại, Hội An cổ k&iacute;nh v&agrave; B&agrave; N&agrave; Hills mộng mơ &ndash; nơi được mệnh danh l&agrave; &ldquo;ch&acirc;u &Acirc;u thu nhỏ giữa l&ograve;ng miền Trung&rdquo;.</p>\r\n\r\n<p><strong>NG&Agrave;Y 01: H&Agrave; NỘI &ndash; Đ&Agrave; NẴNG (ĂN TRƯA, TỐI)</strong><br />\r\nS&aacute;ng: Bay đến Đ&agrave; Nẵng, nhận ph&ograve;ng kh&aacute;ch sạn.<br />\r\nChiều: Tham quan B&aacute;n đảo Sơn Tr&agrave;, Ch&ugrave;a Linh Ứng, tắm biển Mỹ Kh&ecirc;.<br />\r\nTối: Ăn tối, tự do kh&aacute;m ph&aacute; Cầu Rồng, Cầu T&igrave;nh Y&ecirc;u, du thuyền s&ocirc;ng H&agrave;n. Nghỉ đ&ecirc;m tại Đ&agrave; Nẵng.</p>\r\n\r\n<p><strong>NG&Agrave;Y 02: KH&Aacute;M PH&Aacute; B&Agrave; N&Agrave; HILLS (ĂN S&Aacute;NG, TRƯA, TỐI)</strong><br />\r\n07h00: Ăn s&aacute;ng tại kh&aacute;ch sạn.<br />\r\n08h30: Khởi h&agrave;nh đi B&agrave; N&agrave; Hills &ndash; khu du lịch nổi tiếng với kh&iacute; hậu quanh năm m&aacute;t mẻ.<br />\r\nTrải nghiệm c&aacute;p treo, tham quan Cầu V&agrave;ng, Vườn Hoa Le Jardin, Hầm Rượu Debay.<br />\r\n12h00: Ăn trưa buffet tại nh&agrave; h&agrave;ng tr&ecirc;n đỉnh B&agrave; N&agrave;.<br />\r\nChiều: Tự do vui chơi Fantasy Park.<br />\r\n19h00: Ăn tối, nghỉ đ&ecirc;m tại Đ&agrave; Nẵng.</p>\r\n\r\n<p><strong>NG&Agrave;Y 03: HỘI AN &ndash; H&Agrave; NỘI (ĂN S&Aacute;NG, TRƯA)</strong><br />\r\n07h00: Ăn s&aacute;ng, trả ph&ograve;ng.<br />\r\n08h30: Khởi h&agrave;nh đi Hội An &ndash; phố cổ trầm mặc b&ecirc;n d&ograve;ng s&ocirc;ng Thu Bồn.<br />\r\nTham quan Ch&ugrave;a Cầu, Nh&agrave; Cổ, Hội qu&aacute;n Ph&uacute;c Kiến, dạo chợ Hội An.<br />\r\n12h00: Ăn trưa, thưởng thức cao lầu đặc sản.<br />\r\nChiều: Ra s&acirc;n bay, bay về H&agrave; Nội. Kết th&uacute;c tour.</p>\r\n\r\n<p><strong>GI&Aacute; TOUR BAO GỒM:</strong><br />\r\n&bull; V&eacute; m&aacute;y bay, xe du lịch, v&eacute; c&aacute;p treo B&agrave; N&agrave;.<br />\r\n&bull; Kh&aacute;ch sạn 3 sao, ăn theo chương tr&igrave;nh.<br />\r\n&bull; V&eacute; tham quan, HDV, bảo hiểm, nước uống.</p>\r\n\r\n<h2><strong>KH&Ocirc;NG BAO GỒM:</strong><br />\r\n&bull; VAT, chi ph&iacute; c&aacute; nh&acirc;n, đồ uống, v&eacute; vui chơi ngo&agrave;i chương tr&igrave;nh.</h2>', '2025-09-21 02:34:46', '2025-10-08 08:47:56'),
('T-005', 1, 'Tour Quy Nhơn – Kỳ Co – Eo Gió Tuyệt Đẹp', '3 ngày 2 đêm', 'tour-quy-nhon-ky-co-eo-gio-tuyet-dep', 'Hà Nội', '2025-11-27', 3000000, '<h3><strong>Tour Quy Nhơn &ndash; Kỳ Co &ndash; Eo Gi&oacute; Tuyệt Đẹp</strong></h3>\r\n\r\n<p>Quy Nhơn &ndash; vi&ecirc;n ngọc xanh của miền Trung, nổi bật với b&atilde;i biển hoang sơ, c&aacute;t trắng mịn v&agrave; l&agrave;n nước trong xanh. Đặc biệt, Kỳ Co &ndash; Eo Gi&oacute; được mệnh danh l&agrave; &ldquo;Maldives của Việt Nam&rdquo; với phong cảnh h&ugrave;ng vĩ v&agrave; hoang sơ tuyệt đẹp.</p>\r\n\r\n<p><strong>NG&Agrave;Y 01: H&Agrave; NỘI &ndash; QUY NHƠN (ĂN TRƯA, TỐI)</strong><br />\r\nS&aacute;ng: Bay đến Quy Nhơn, nhận ph&ograve;ng kh&aacute;ch sạn.<br />\r\nChiều: Tham quan Ghềnh R&aacute;ng &ndash; Ti&ecirc;n Sa, Mộ H&agrave;n Mặc Tử, B&atilde;i Trứng.<br />\r\n19h00: Ăn tối, dạo biển về đ&ecirc;m. Nghỉ đ&ecirc;m tại Quy Nhơn.</p>\r\n\r\n<p><strong>NG&Agrave;Y 02: KỲ CO &ndash; EO GI&Oacute; (ĂN S&Aacute;NG, TRƯA, TỐI)</strong><br />\r\n07h00: Ăn s&aacute;ng, khởi h&agrave;nh đi Kỳ Co &ndash; Eo Gi&oacute;.<br />\r\nL&ecirc;n cano ra b&atilde;i Kỳ Co, tắm biển, lặn ngắm san h&ocirc;.<br />\r\n12h00: Ăn trưa tại nh&agrave; h&agrave;ng hải sản địa phương.<br />\r\nChiều: Tham quan Eo Gi&oacute; &ndash; địa danh nổi tiếng với cảnh quan thi&ecirc;n nhi&ecirc;n ngoạn mục.<br />\r\n19h00: Ăn tối, nghỉ đ&ecirc;m tại Quy Nhơn.</p>\r\n\r\n<p><strong>NG&Agrave;Y 03: QUY NHƠN &ndash; H&Agrave; NỘI (ĂN S&Aacute;NG, TRƯA)</strong><br />\r\n07h00: Ăn s&aacute;ng, trả ph&ograve;ng.<br />\r\n08h30: Tham quan Th&aacute;p Đ&ocirc;i &ndash; di t&iacute;ch kiến tr&uacute;c Chăm Pa độc đ&aacute;o.<br />\r\n11h30: Ăn trưa, xe đưa ra s&acirc;n bay, bay về H&agrave; Nội. Kết th&uacute;c tour.</p>\r\n\r\n<p><strong>GI&Aacute; TOUR BAO GỒM:</strong><br />\r\n&bull; V&eacute; m&aacute;y bay, xe du lịch, cano ra đảo.<br />\r\n&bull; Kh&aacute;ch sạn 3 sao, ăn uống, v&eacute; tham quan.<br />\r\n&bull; HDV, bảo hiểm, nước uống, mũ du lịch.</p>\r\n\r\n<h2><strong>KH&Ocirc;NG BAO GỒM:</strong><br />\r\n&bull; VAT, đồ uống, chi ph&iacute; c&aacute; nh&acirc;n, v&eacute; tr&ograve; chơi.</h2>', '2025-09-21 02:35:20', '2025-10-08 08:48:08'),
('T-006', 2, 'Tour Hà Nội – Hành Trình Di Sản Ngàn Năm Văn Hiến', '2 ngày 1 đêm', 'tour-ha-noi-hanh-trinh-di-san-ngan-nam-van-hien', 'Hà Nội', '2025-10-30', 1000000, '<p>H&agrave; Nội &ndash; thủ đ&ocirc; ng&agrave;n năm văn hiến, nơi lưu giữ linh hồn d&acirc;n tộc qua từng con phố, m&aacute;i đ&igrave;nh, di t&iacute;ch v&agrave; những m&oacute;n ăn đậm đ&agrave; bản sắc. Du kh&aacute;ch sẽ được đắm m&igrave;nh trong kh&ocirc;ng gian cổ k&iacute;nh của phố cổ, lắng nghe &acirc;m thanh cuộc sống s&ocirc;i động nhưng vẫn mang n&eacute;t trầm mặc của qu&aacute; khứ.</p>\r\n\r\n<p>H&agrave;nh tr&igrave;nh kh&aacute;m ph&aacute; H&agrave; Nội l&agrave; cơ hội để du kh&aacute;ch cảm nhận vẻ đẹp dung h&ograve;a giữa hiện đại v&agrave; truyền thống, từ Hồ Gươm, Văn Miếu đến Ho&agrave;ng Th&agrave;nh Thăng Long &ndash; tất cả l&agrave;m n&ecirc;n bức tranh văn h&oacute;a đặc trưng của mảnh đất ng&agrave;n năm tuổi.</p>\r\n\r\n<p><strong>NG&Agrave;Y 01: Đ&Oacute;N KH&Aacute;CH &ndash; KH&Aacute;M PH&Aacute; PHỐ CỔ (ĂN TRƯA, TỐI)</strong><br />\r\n08h30: HDV đ&oacute;n qu&yacute; kh&aacute;ch tại điểm hẹn, khởi h&agrave;nh tham quan Hồ Ho&agrave;n Kiếm, Đền Ngọc Sơn v&agrave; Cầu Th&ecirc; H&uacute;c.<br />\r\n11h30: D&ugrave;ng bữa trưa tại nh&agrave; h&agrave;ng, thưởng thức đặc sản b&uacute;n chả, phở H&agrave; Nội.<br />\r\nChiều: Tham quan Phố Cổ, trải nghiệm văn h&oacute;a c&agrave; ph&ecirc; vỉa h&egrave; v&agrave; c&aacute;c tuyến phố nghề truyền thống.<br />\r\n19h00: Ăn tối, tự do dạo chơi phố đi bộ Hồ Gươm. Nghỉ đ&ecirc;m tại H&agrave; Nội.</p>\r\n\r\n<p><strong>NG&Agrave;Y 02: KH&Aacute;M PH&Aacute; DI T&Iacute;CH V&Agrave; VĂN H&Oacute;A (ĂN S&Aacute;NG, TRƯA, TỐI)</strong><br />\r\n07h00: Ăn s&aacute;ng tại kh&aacute;ch sạn.<br />\r\n08h00: Tham quan Lăng Chủ Tịch Hồ Ch&iacute; Minh, Ch&ugrave;a Một Cột, Phủ Chủ Tịch.<br />\r\n12h00: Ăn trưa tại nh&agrave; h&agrave;ng.<br />\r\nChiều: Gh&eacute; thăm Văn Miếu &ndash; Quốc Tử Gi&aacute;m, Bảo t&agrave;ng D&acirc;n tộc học, Ho&agrave;ng Th&agrave;nh Thăng Long.<br />\r\n19h00: Ăn tối, thưởng thức chương tr&igrave;nh m&uacute;a rối nước truyền thống. Nghỉ đ&ecirc;m tại kh&aacute;ch sạn.</p>\r\n\r\n<p><strong>NG&Agrave;Y 03: H&Agrave; NỘI &ndash; L&Agrave;NG NGHỀ &ndash; TIỄN KH&Aacute;CH (ĂN S&Aacute;NG, TRƯA)</strong><br />\r\n07h00: Ăn s&aacute;ng, trả ph&ograve;ng.<br />\r\n08h30: Tham quan L&agrave;ng gốm B&aacute;t Tr&agrave;ng, trải nghiệm l&agrave;m gốm.<br />\r\n11h30: Ăn trưa tại nh&agrave; h&agrave;ng, xe đưa đo&agrave;n về điểm hẹn ban đầu. Kết th&uacute;c tour.</p>\r\n\r\n<p><strong>GI&Aacute; TOUR BAO GỒM:</strong><br />\r\n&bull; Xe du lịch đời mới, v&eacute; tham quan theo chương tr&igrave;nh.<br />\r\n&bull; Kh&aacute;ch sạn 3 sao trung t&acirc;m, ăn uống đầy đủ.<br />\r\n&bull; HDV chuy&ecirc;n nghiệp, bảo hiểm du lịch, nước uống.</p>\r\n\r\n<h2><strong>KH&Ocirc;NG BAO GỒM:</strong><br />\r\n&bull; VAT, chi ph&iacute; c&aacute; nh&acirc;n, đồ uống, v&eacute; vui chơi ngo&agrave;i chương tr&igrave;nh.</h2>', '2025-09-21 02:35:41', '2025-10-08 08:48:24'),
('T-007', 2, 'Tour Huế – Kinh Thành Cổ & Nhã Nhạc Cung Đình', '3 ngày 2 đêm', 'tour-hue-kinh-thanh-co-nha-nhac-cung-dinh', 'Hà Nội', '2025-10-21', 3000000, '<p>Huế &ndash; cố đ&ocirc; của Việt Nam, nơi lưu giữ di sản văn h&oacute;a v&agrave; những c&ocirc;ng tr&igrave;nh kiến tr&uacute;c cung đ&igrave;nh tr&aacute;ng lệ. D&ograve;ng s&ocirc;ng Hương hiền h&ograve;a, cầu Trường Tiền cổ k&iacute;nh c&ugrave;ng tiếng nh&atilde; nhạc vang vọng khiến du kh&aacute;ch như lạc bước v&agrave;o kh&ocirc;ng gian ho&agrave;i cổ, đậm chất thơ.</p>\r\n\r\n<p>H&agrave;nh tr&igrave;nh kh&aacute;m ph&aacute; Huế l&agrave; cơ hội để cảm nhận vẻ đẹp trầm mặc v&agrave; thanh tao, h&ograve;a quyện giữa thi&ecirc;n nhi&ecirc;n, con người v&agrave; văn h&oacute;a cung đ&igrave;nh xưa.</p>\r\n\r\n<p><strong>NG&Agrave;Y 01: H&Agrave; NỘI &ndash; HUẾ (ĂN TRƯA, TỐI)</strong><br />\r\nS&aacute;ng: Bay đến Huế, nhận ph&ograve;ng kh&aacute;ch sạn.<br />\r\nChiều: Tham quan Đại Nội &ndash; Ho&agrave;ng Cung triều Nguyễn, Ngọ M&ocirc;n, Điện Th&aacute;i H&ograve;a.<br />\r\n19h00: Ăn tối, nghe ca Huế tr&ecirc;n s&ocirc;ng Hương. Nghỉ đ&ecirc;m tại Huế.</p>\r\n\r\n<p><strong>NG&Agrave;Y 02: KH&Aacute;M PH&Aacute; LĂNG TẨM &amp; CH&Ugrave;A THI&Ecirc;N MỤ (ĂN S&Aacute;NG, TRƯA, TỐI)</strong><br />\r\n07h00: Ăn s&aacute;ng, tham quan Lăng Khải Định, Lăng Minh Mạng, Ch&ugrave;a Thi&ecirc;n Mụ &ndash; biểu tượng xứ Huế.<br />\r\n12h00: Ăn trưa tại nh&agrave; h&agrave;ng với m&oacute;n cơm cung đ&igrave;nh.<br />\r\nChiều: Tham quan chợ Đ&ocirc;ng Ba, mua sắm đặc sản m&egrave; xửng, n&oacute;n l&aacute;, t&ocirc;m chua.<br />\r\n19h00: Ăn tối, dạo phố đ&ecirc;m cầu Trường Tiền. Nghỉ đ&ecirc;m tại Huế.</p>\r\n\r\n<p><strong>NG&Agrave;Y 03: HUẾ &ndash; H&Agrave; NỘI (ĂN S&Aacute;NG, TRƯA)</strong><br />\r\n07h00: Ăn s&aacute;ng, trả ph&ograve;ng.<br />\r\n08h30: Tham quan Đồi Vọng Cảnh, ngắm to&agrave;n cảnh th&agrave;nh phố Huế.<br />\r\n11h30: Ăn trưa, xe đưa ra s&acirc;n bay, bay về H&agrave; Nội. Kết th&uacute;c tour.</p>\r\n\r\n<p><strong>GI&Aacute; TOUR BAO GỒM:</strong><br />\r\n&bull; V&eacute; m&aacute;y bay, xe đưa đ&oacute;n, kh&aacute;ch sạn 3 sao.<br />\r\n&bull; Ăn uống, v&eacute; tham quan, HDV, bảo hiểm, nước uống.</p>\r\n\r\n<h2><strong>KH&Ocirc;NG BAO GỒM:</strong><br />\r\n&bull; VAT, chi ph&iacute; c&aacute; nh&acirc;n, đồ uống, v&eacute; ngo&agrave;i chương tr&igrave;nh.</h2>', '2025-09-21 02:36:05', '2025-10-08 08:48:33'),
('T-008', 2, 'Tour Tây Nguyên – Văn Hóa Cồng Chiêng & Núi Rừng', '3 ngày 2 đêm', 'tour-tay-nguyen-van-hoa-cong-chieng-nui-rung', 'Hà Nội', '2025-10-18', 1500000, '<p>T&acirc;y Nguy&ecirc;n &ndash; v&ugrave;ng đất đại ng&agrave;n huyền thoại, nơi cồng chi&ecirc;ng vang vọng c&ugrave;ng tiếng suối rừng hoang sơ. H&agrave;nh tr&igrave;nh đưa du kh&aacute;ch kh&aacute;m ph&aacute; vẻ đẹp h&ugrave;ng vĩ của n&uacute;i rừng, trải nghiệm văn h&oacute;a độc đ&aacute;o của đồng b&agrave;o d&acirc;n tộc v&agrave; thưởng thức hương vị c&agrave; ph&ecirc; Bu&ocirc;n Ma Thuột trứ danh.</p>\r\n\r\n<p><strong>NG&Agrave;Y 01: H&Agrave; NỘI &ndash; BU&Ocirc;N MA THUỘT (ĂN TRƯA, TỐI)</strong><br />\r\nS&aacute;ng: Bay đến Bu&ocirc;n Ma Thuột, nhận ph&ograve;ng kh&aacute;ch sạn.<br />\r\nChiều: Tham quan Bảo t&agrave;ng C&agrave; Ph&ecirc; Thế Giới, Hồ Lắk, Biệt điện Bảo Đại.<br />\r\n19h00: Ăn tối, thưởng thức rượu cần v&agrave; giao lưu văn h&oacute;a cồng chi&ecirc;ng T&acirc;y Nguy&ecirc;n. Nghỉ đ&ecirc;m tại Bu&ocirc;n Ma Thuột.</p>\r\n\r\n<p><strong>NG&Agrave;Y 02: KH&Aacute;M PH&Aacute; BU&Ocirc;N Đ&Ocirc;N &ndash; TH&Aacute;C DRAY NUR (ĂN S&Aacute;NG, TRƯA, TỐI)</strong><br />\r\n07h00: Ăn s&aacute;ng.<br />\r\n08h00: Khởi h&agrave;nh đi Bu&ocirc;n Đ&ocirc;n &ndash; nơi nổi tiếng với nghề săn voi v&agrave; c&acirc;y cầu treo huyền thoại.<br />\r\n12h00: Ăn trưa tại nh&agrave; s&agrave;n.<br />\r\nChiều: Tham quan th&aacute;c Dray Nur &ndash; một trong những th&aacute;c nước h&ugrave;ng vĩ nhất T&acirc;y Nguy&ecirc;n.<br />\r\n19h00: Ăn tối, nghỉ đ&ecirc;m tại Bu&ocirc;n Ma Thuột.</p>\r\n\r\n<p><strong>NG&Agrave;Y 03: BU&Ocirc;N MA THUỘT &ndash; H&Agrave; NỘI (ĂN S&Aacute;NG, TRƯA)</strong><br />\r\n07h00: Ăn s&aacute;ng, trả ph&ograve;ng.<br />\r\n08h30: Mua sắm c&agrave; ph&ecirc;, ti&ecirc;u, mật ong rừng tại chợ Bu&ocirc;n Ma Thuột.<br />\r\n11h30: Ăn trưa, ra s&acirc;n bay trở về H&agrave; Nội. Kết th&uacute;c tour.</p>\r\n\r\n<p><strong>GI&Aacute; TOUR BAO GỒM:</strong><br />\r\n&bull; V&eacute; m&aacute;y bay, xe đưa đ&oacute;n, kh&aacute;ch sạn 3 sao.<br />\r\n&bull; Ăn uống, v&eacute; tham quan, HDV, bảo hiểm.</p>\r\n\r\n<h2><strong>KH&Ocirc;NG BAO GỒM:</strong><br />\r\n&bull; VAT, đồ uống, chi ph&iacute; c&aacute; nh&acirc;n, v&eacute; ngo&agrave;i chương tr&igrave;nh.</h2>', '2025-09-21 02:36:30', '2025-10-08 08:48:42'),
('T-009', 2, 'Tour Sapa – Bản Làng & Văn Hóa Người H’Mông', '3 ngày 2 đêm', 'tour-sapa-ban-lang-van-hoa-nguoi-h-mong', 'Hà Nội', '2025-10-27', 2500000, '<p>Sapa &ndash; thị trấn trong m&acirc;y của v&ugrave;ng T&acirc;y Bắc, nổi tiếng với cảnh sắc thi&ecirc;n nhi&ecirc;n h&ugrave;ng vĩ, ruộng bậc thang uốn lượn v&agrave; nền văn h&oacute;a đa dạng của c&aacute;c d&acirc;n tộc thiểu số. Đ&acirc;y l&agrave; điểm đến l&yacute; tưởng cho du kh&aacute;ch y&ecirc;u th&iacute;ch kh&ocirc;ng kh&iacute; se lạnh, những cung đường uốn lượn v&agrave; trải nghiệm văn h&oacute;a v&ugrave;ng cao.</p>\r\n\r\n<p><strong>NG&Agrave;Y 01: H&Agrave; NỘI &ndash; SAPA (ĂN TRƯA, TỐI)</strong><br />\r\n06h30: Xe đ&oacute;n qu&yacute; kh&aacute;ch khởi h&agrave;nh đi Sapa theo cao tốc Nội B&agrave;i &ndash; L&agrave;o Cai.<br />\r\n11h30: Đến Sapa, nhận ph&ograve;ng kh&aacute;ch sạn, ăn trưa.<br />\r\nChiều: Tham quan bản C&aacute;t C&aacute;t &ndash; bản l&agrave;ng người H&rsquo;M&ocirc;ng, t&igrave;m hiểu nghề dệt thổ cẩm.<br />\r\n19h00: Ăn tối, tự do dạo phố, thưởng thức đồ nướng. Nghỉ đ&ecirc;m tại Sapa.</p>\r\n\r\n<p><strong>NG&Agrave;Y 02: CHINH PHỤC FANSIPAN &ndash; N&Oacute;C NH&Agrave; Đ&Ocirc;NG DƯƠNG (ĂN S&Aacute;NG, TRƯA, TỐI)</strong><br />\r\n07h00: Ăn s&aacute;ng.<br />\r\n08h00: Di chuyển ra ga c&aacute;p treo Fansipan, chinh phục &ldquo;n&oacute;c nh&agrave; Đ&ocirc;ng Dương&rdquo;.<br />\r\n12h00: Ăn trưa tại nh&agrave; h&agrave;ng địa phương.<br />\r\nChiều: Tham quan nh&agrave; thờ đ&aacute; cổ, quảng trường trung t&acirc;m Sapa.<br />\r\n19h00: Ăn tối, tự do kh&aacute;m ph&aacute; chợ đ&ecirc;m. Nghỉ đ&ecirc;m tại Sapa.</p>\r\n\r\n<p><strong>NG&Agrave;Y 03: SAPA &ndash; H&Agrave; NỘI (ĂN S&Aacute;NG, TRƯA)</strong><br />\r\n07h00: Ăn s&aacute;ng, trả ph&ograve;ng.<br />\r\n08h30: Tham quan bản Tả Van &ndash; Lao Chải, ngắm ruộng bậc thang h&ugrave;ng vĩ.<br />\r\n11h30: Ăn trưa, l&ecirc;n xe trở về H&agrave; Nội. Kết th&uacute;c chương tr&igrave;nh.</p>\r\n\r\n<p><strong>GI&Aacute; TOUR BAO GỒM:</strong><br />\r\n&bull; Xe du lịch, kh&aacute;ch sạn 3 sao, ăn uống theo chương tr&igrave;nh.<br />\r\n&bull; V&eacute; c&aacute;p treo Fansipan, HDV, bảo hiểm, nước uống.</p>\r\n\r\n<h2><strong>KH&Ocirc;NG BAO GỒM:</strong><br />\r\n&bull; VAT, chi ph&iacute; c&aacute; nh&acirc;n, v&eacute; tr&ograve; chơi, đồ uống.</h2>', '2025-09-21 02:37:01', '2025-10-08 08:48:52'),
('T-010', 2, 'Tour Miền Tây – Chợ Nổi Cái Răng & Miệt Vườn Sông Nước', '3 ngày 2 đêm', 'tour-mien-tay-cho-noi-cai-rang-miet-vuon-song-nuoc', 'Hà Nội', '2025-10-21', 4000000, '<p>Miền T&acirc;y &ndash; v&ugrave;ng đất được mệnh danh l&agrave; &ldquo;xứ sở s&ocirc;ng nước&rdquo;, nơi những d&ograve;ng k&ecirc;nh xanh mướt len lỏi giữa ruộng đồng, vườn c&acirc;y trĩu quả v&agrave; những con người ch&acirc;n chất hiền h&ograve;a. Tour du lịch Miền T&acirc;y 3 ng&agrave;y 2 đ&ecirc;m sẽ đưa du kh&aacute;ch kh&aacute;m ph&aacute; n&eacute;t đặc trưng văn h&oacute;a miền s&ocirc;ng nước, gh&eacute; thăm chợ nổi C&aacute;i Răng nổi tiếng, thưởng thức tr&aacute;i c&acirc;y miệt vườn v&agrave; cảm nhận kh&ocirc;ng gian thanh b&igrave;nh của miền T&acirc;y Nam Bộ.<br />\r\nH&agrave;nh tr&igrave;nh n&agrave;y l&agrave; sự h&ograve;a quyện giữa thi&ecirc;n nhi&ecirc;n, ẩm thực v&agrave; t&igrave;nh người &mdash; một trải nghiệm kh&oacute; qu&ecirc;n d&agrave;nh cho mọi du kh&aacute;ch.</p>\r\n\r\n<p>NG&Agrave;Y 01: TP.HCM &ndash; MỸ THO &ndash; BẾN TRE (ĂN TRƯA, TỐI)<br />\r\n07h30: Xe v&agrave; hướng dẫn vi&ecirc;n đ&oacute;n kh&aacute;ch tại điểm hẹn, khởi h&agrave;nh đi Mỹ Tho.<br />\r\n09h30: Đo&agrave;n tham quan ch&ugrave;a Vĩnh Tr&agrave;ng &ndash; ng&ocirc;i ch&ugrave;a cổ nổi tiếng nhất Tiền Giang.<br />\r\n10h30: L&ecirc;n thuyền kh&aacute;m ph&aacute; s&ocirc;ng Tiền, ngắm cảnh 4 c&ugrave; lao Long, L&acirc;n, Quy, Phụng.<br />\r\n11h30: Tham quan cơ sở sản xuất kẹo dừa, thưởng thức tr&agrave; mật ong.<br />\r\n12h30: D&ugrave;ng cơm trưa với c&aacute;c m&oacute;n đặc sản miền T&acirc;y.<br />\r\n14h30: Tham quan miệt vườn tr&aacute;i c&acirc;y, nghe đờn ca t&agrave;i tử Nam Bộ.<br />\r\n18h00: Nhận ph&ograve;ng kh&aacute;ch sạn tại Bến Tre, ăn tối v&agrave; tự do dạo phố.</p>\r\n\r\n<p>NG&Agrave;Y 02: BẾN TRE &ndash; CẦN THƠ &ndash; CHỢ NỔI C&Aacute;I RĂNG (ĂN S&Aacute;NG, TRƯA, TỐI)<br />\r\n06h30: Trả ph&ograve;ng, khởi h&agrave;nh đi Cần Thơ.<br />\r\n08h00: Tham quan chợ nổi C&aacute;i Răng &ndash; n&eacute;t văn h&oacute;a đặc trưng miền s&ocirc;ng nước.<br />\r\n10h00: Gh&eacute; l&agrave;ng nghề l&agrave;m hủ tiếu truyền thống, thưởng thức tại chỗ.<br />\r\n12h00: Ăn trưa tại nh&agrave; h&agrave;ng địa phương.<br />\r\n14h00: Tham quan nh&agrave; cổ B&igrave;nh Thủy &ndash; di t&iacute;ch kiến tr&uacute;c độc đ&aacute;o hơn 100 năm tuổi.<br />\r\n18h00: D&ugrave;ng bữa tối, nghỉ đ&ecirc;m tại Cần Thơ.</p>\r\n\r\n<p>NG&Agrave;Y 03: CẦN THƠ &ndash; VĨNH LONG &ndash; TP.HCM (ĂN S&Aacute;NG, TRƯA)<br />\r\n07h30: Tham quan vườn tr&aacute;i c&acirc;y tại Vĩnh Long, thưởng thức tr&aacute;i c&acirc;y theo m&ugrave;a.<br />\r\n10h00: Dừng ch&acirc;n tại l&agrave;ng gốm đỏ Mang Th&iacute;t.<br />\r\n12h00: Ăn trưa tại nh&agrave; h&agrave;ng ven s&ocirc;ng.<br />\r\n14h00: Khởi h&agrave;nh về TP.HCM, kết th&uacute;c chương tr&igrave;nh tour, chia tay v&agrave; hẹn gặp lại.</p>\r\n\r\n<p>Gi&aacute; tour bao gồm:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Xe du lịch đời mới đưa đ&oacute;n theo chương tr&igrave;nh</p>\r\n	</li>\r\n	<li>\r\n	<p>Hướng dẫn vi&ecirc;n chuy&ecirc;n nghiệp, nhiệt t&igrave;nh</p>\r\n	</li>\r\n	<li>\r\n	<p>V&eacute; tham quan theo chương tr&igrave;nh</p>\r\n	</li>\r\n	<li>\r\n	<p>Ăn uống theo ti&ecirc;u chuẩn, 2 đ&ecirc;m kh&aacute;ch sạn 3 sao</p>\r\n	</li>\r\n	<li>\r\n	<p>Bảo hiểm du lịch, nước suối, khăn lạnh</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Gi&aacute; tour kh&ocirc;ng bao gồm:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Chi ph&iacute; c&aacute; nh&acirc;n, đồ uống ngo&agrave;i chương tr&igrave;nh</p>\r\n	</li>\r\n	<li>\r\n	<p>Thuế VAT</p>\r\n	</li>\r\n	<li>\r\n	<p>Tiền tip cho hướng dẫn vi&ecirc;n v&agrave; t&agrave;i xế</p>\r\n	</li>\r\n</ul>', '2025-09-21 02:37:28', '2025-10-08 08:50:08'),
('T-011', 3, 'Tour Mạo Hiểm Hang Sơn Đoòng – Kỳ Quan Dưới Lòng Đất', '3 ngày 3 đêm', 'tour-mao-hiem-hang-son-doong-ky-quan-duoi-long-dat', 'Hà Nội', '2025-10-29', 5000000, '<p>Hang Sơn Đo&ograve;ng &ndash; kỳ quan thi&ecirc;n nhi&ecirc;n vĩ đại của Việt Nam v&agrave; thế giới, được mệnh danh l&agrave; &ldquo;hang động lớn nhất h&agrave;nh tinh&rdquo;. Tour mạo hiểm 3 ng&agrave;y sẽ đưa du kh&aacute;ch v&agrave;o h&agrave;nh tr&igrave;nh kh&aacute;m ph&aacute; đầy th&aacute;ch thức nhưng cũng v&ocirc; c&ugrave;ng kỳ diệu &mdash; nơi m&agrave; thi&ecirc;n nhi&ecirc;n tạo n&ecirc;n một thế giới huyền b&iacute;, ngoạn mục v&agrave; kh&ocirc;ng k&eacute;m phần tr&aacute;ng lệ.<br />\r\nTừng bước ch&acirc;n qua l&ograve;ng hang, bạn sẽ cảm nhận được sự nhỏ b&eacute; của con người trước sự h&ugrave;ng vĩ của tạo h&oacute;a.</p>\r\n\r\n<p>NG&Agrave;Y 01: ĐỒNG HỚI &ndash; PHONG NHA &ndash; KH&Aacute;M PH&Aacute; HỆ THỐNG HANG &Eacute;N (ĂN TRƯA, TỐI)<br />\r\n07h00: Xe đ&oacute;n tại s&acirc;n bay Đồng Hới, khởi h&agrave;nh về Phong Nha.<br />\r\n09h30: Tập huấn kỹ năng trekking, trang bị đồ bảo hộ.<br />\r\n11h00: Bắt đầu h&agrave;nh tr&igrave;nh đi bộ xuy&ecirc;n rừng, vượt suối v&agrave;o khu vực hang &Eacute;n.<br />\r\n12h30: Nghỉ trưa picnic giữa rừng.<br />\r\n15h00: Đến cửa hang &Eacute;n, chi&ecirc;m ngưỡng khung cảnh h&ugrave;ng vĩ.<br />\r\n18h00: Dựng trại, ăn tối, nghỉ đ&ecirc;m giữa l&ograve;ng hang.</p>\r\n\r\n<p>NG&Agrave;Y 02: HANG &Eacute;N &ndash; HANG SƠN ĐO&Ograve;NG (ĂN S&Aacute;NG, TRƯA, TỐI)<br />\r\n06h30: Ăn s&aacute;ng tại trại, chuẩn bị trang thiết bị.<br />\r\n08h00: Tiếp tục trekking đến cửa Hang Sơn Đo&ograve;ng.<br />\r\n11h00: Bắt đầu h&agrave;nh tr&igrave;nh kh&aacute;m ph&aacute; kỳ quan dưới l&ograve;ng đất.<br />\r\n12h30: Ăn trưa trong hang, ngắm &ldquo;vườn địa đ&agrave;ng&rdquo; &ndash; khu rừng nguy&ecirc;n sinh trong hang.<br />\r\n15h30: Tham quan &ldquo;Bức tường Việt Nam&rdquo; &ndash; khối đ&aacute; v&ocirc;i cao h&agrave;ng trăm m&eacute;t.<br />\r\n18h00: Nghỉ đ&ecirc;m trong hang, ngắm bầu trời qua hố sụt khổng lồ.</p>\r\n\r\n<p>NG&Agrave;Y 03: HANG SƠN ĐO&Ograve;NG &ndash; PHONG NHA &ndash; ĐỒNG HỚI (ĂN S&Aacute;NG, TRƯA)<br />\r\n07h30: Rời hang, trekking trở lại Phong Nha.<br />\r\n12h00: Ăn trưa tại bản Đo&ograve;ng.<br />\r\n14h00: L&ecirc;n xe về Đồng Hới, kết th&uacute;c h&agrave;nh tr&igrave;nh.</p>\r\n\r\n<p>Gi&aacute; tour bao gồm:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Hướng dẫn vi&ecirc;n chuy&ecirc;n nghiệp, thiết bị an to&agrave;n, porter</p>\r\n	</li>\r\n	<li>\r\n	<p>Ăn uống, lều trại, ph&iacute; tham quan Vườn Quốc Gia</p>\r\n	</li>\r\n	<li>\r\n	<p>Xe đưa đ&oacute;n theo chương tr&igrave;nh</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Gi&aacute; tour kh&ocirc;ng bao gồm:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>V&eacute; m&aacute;y bay, chi ph&iacute; c&aacute; nh&acirc;n</p>\r\n	</li>\r\n	<li>\r\n	<p>Bảo hiểm du lịch quốc tế</p>\r\n	</li>\r\n	<li>\r\n	<p>Tip cho hướng dẫn vi&ecirc;n</p>\r\n	</li>\r\n</ul>', '2025-09-21 02:38:23', '2025-10-08 08:49:01'),
('T-012', 3, 'Tour Trekking Fansipan – Nóc Nhà Đông Dương', '3 ngày 2 đêm', 'tour-trekking-fansipan-noc-nha-dong-duong', 'Hà Nội', '2025-10-31', 4000000, '<p>Fansipan &ndash; đỉnh n&uacute;i cao nhất Đ&ocirc;ng Dương, nơi mọi người đam m&ecirc; chinh phục đều mong một lần đặt ch&acirc;n. Tour trekking Fansipan 3 ng&agrave;y l&agrave; h&agrave;nh tr&igrave;nh thử th&aacute;ch nhưng v&ocirc; c&ugrave;ng đ&aacute;ng gi&aacute;, đưa du kh&aacute;ch vượt qua những c&aacute;nh rừng nguy&ecirc;n sinh, suối đ&aacute; v&agrave; sườn n&uacute;i để chạm tay v&agrave;o cột mốc &ldquo;N&oacute;c nh&agrave; Đ&ocirc;ng Dương&rdquo;.<br />\r\nMột trải nghiệm h&ograve;a m&igrave;nh c&ugrave;ng thi&ecirc;n nhi&ecirc;n v&agrave; cảm nhận niềm tự h&agrave;o khi đứng tr&ecirc;n đỉnh trời Tổ quốc.</p>\r\n\r\n<p>NG&Agrave;Y 01: SAPA &ndash; TRẠM T&Ocirc;N &ndash; CẮM TRẠI (ĂN TRƯA, TỐI)<br />\r\n08h00: Họp đo&agrave;n, nghe phổ biến an to&agrave;n.<br />\r\n09h30: Bắt đầu h&agrave;nh tr&igrave;nh từ Trạm T&ocirc;n, băng rừng vượt suối.<br />\r\n12h00: Dừng ch&acirc;n ăn trưa d&atilde; chiến.<br />\r\n15h30: Đến điểm cắm trại độ cao 2.800m, nghỉ ngơi.<br />\r\n18h00: Ăn tối, giao lưu v&agrave; nghỉ đ&ecirc;m giữa rừng.</p>\r\n\r\n<p>NG&Agrave;Y 02: CẮM TRẠI &ndash; ĐỈNH FANSIPAN &ndash; SAPA (ĂN S&Aacute;NG, TRƯA, TỐI)<br />\r\n04h30: Dậy sớm, ăn s&aacute;ng nhẹ, chuẩn bị leo đỉnh.<br />\r\n07h00: Chinh phục đỉnh Fansipan, check-in cột mốc 3.143m.<br />\r\n09h00: Xuống n&uacute;i bằng c&aacute;p treo, ngắm to&agrave;n cảnh d&atilde;y Ho&agrave;ng Li&ecirc;n Sơn.<br />\r\n12h00: Ăn trưa tại thị trấn Sapa.<br />\r\n14h30: Tham quan bản C&aacute;t C&aacute;t, tự do kh&aacute;m ph&aacute; phố n&uacute;i.<br />\r\n18h00: Ăn tối v&agrave; nghỉ đ&ecirc;m tại kh&aacute;ch sạn.</p>\r\n\r\n<p>NG&Agrave;Y 03: SAPA &ndash; L&Agrave;O CAI &ndash; H&Agrave; NỘI (ĂN S&Aacute;NG, TRƯA)<br />\r\n07h30: Dạo chợ Sapa, mua đặc sản địa phương.<br />\r\n10h00: Trả ph&ograve;ng, về L&agrave;o Cai.<br />\r\n12h30: Ăn trưa v&agrave; kết th&uacute;c tour.</p>\r\n\r\n<p>Gi&aacute; tour bao gồm:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Hướng dẫn vi&ecirc;n, porter khu&acirc;n v&aacute;c</p>\r\n	</li>\r\n	<li>\r\n	<p>V&eacute; c&aacute;p treo khứ hồi</p>\r\n	</li>\r\n	<li>\r\n	<p>Bữa ăn, lều trại, bảo hiểm du lịch</p>\r\n	</li>\r\n	<li>\r\n	<p>Xe đưa đ&oacute;n theo chương tr&igrave;nh</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Gi&aacute; tour kh&ocirc;ng bao gồm:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Chi ph&iacute; c&aacute; nh&acirc;n</p>\r\n	</li>\r\n	<li>\r\n	<p>Tip hướng dẫn vi&ecirc;n</p>\r\n	</li>\r\n	<li>\r\n	<p>Thuế VAT</p>\r\n	</li>\r\n</ul>', '2025-09-21 02:38:55', '2025-10-08 08:49:22'),
('T-013', 3, 'Tour Đồng Văn – Hà Giang – Cao Nguyên Đá Hùng Vĩ', '3 ngày 2 đêm', 'tour-dong-van-ha-giang-cao-nguyen-da-hung-vi', 'Hà Nội', '2025-10-13', 2000000, '<p>H&agrave; Giang &ndash; v&ugrave;ng đất nơi cực Bắc Tổ quốc, nổi tiếng với cao nguy&ecirc;n đ&aacute; Đồng Văn h&ugrave;ng vĩ v&agrave; những cung đường đ&egrave;o quanh co đẹp ngỡ ng&agrave;ng. Tour H&agrave; Giang 3 ng&agrave;y sẽ đưa du kh&aacute;ch chạm đến &ldquo;đỉnh đầu Tổ quốc&rdquo;, chi&ecirc;m ngưỡng cột cờ Lũng C&uacute;, M&atilde; P&igrave; L&egrave;ng huyền thoại v&agrave; bản l&agrave;ng y&ecirc;n b&igrave;nh ẩn hiện giữa n&uacute;i rừng.<br />\r\nMột h&agrave;nh tr&igrave;nh đầy cảm x&uacute;c, nơi cảnh đẹp v&agrave; con người h&ograve;a quyện tạo n&ecirc;n bức tranh tuyệt mỹ của v&ugrave;ng cao.</p>\r\n\r\n<p>NG&Agrave;Y 01: H&Agrave; NỘI &ndash; H&Agrave; GIANG &ndash; QUẢN BẠ (ĂN TRƯA, TỐI)<br />\r\n06h00: Khởi h&agrave;nh từ H&agrave; Nội đi H&agrave; Giang.<br />\r\n11h30: Ăn trưa tại Tuy&ecirc;n Quang.<br />\r\n15h00: Dừng ch&acirc;n tại Cổng Trời Quản Bạ, N&uacute;i Đ&ocirc;i C&ocirc; Ti&ecirc;n.<br />\r\n18h00: Nhận ph&ograve;ng, ăn tối, nghỉ đ&ecirc;m tại Quản Bạ.</p>\r\n\r\n<p>NG&Agrave;Y 02: QUẢN BẠ &ndash; ĐỒNG VĂN &ndash; LŨNG C&Uacute; (ĂN S&Aacute;NG, TRƯA, TỐI)<br />\r\n06h30: Ăn s&aacute;ng, khởi h&agrave;nh đi Đồng Văn.<br />\r\n09h00: Tham quan Dinh Vua M&egrave;o &ndash; di t&iacute;ch nổi tiếng của người M&ocirc;ng.<br />\r\n11h00: Gh&eacute; thăm cột cờ Lũng C&uacute; &ndash; điểm cực Bắc của Việt Nam.<br />\r\n12h30: Ăn trưa tại Đồng Văn.<br />\r\n15h00: Chinh phục đ&egrave;o M&atilde; P&igrave; L&egrave;ng &ndash; một trong &ldquo;tứ đại đỉnh đ&egrave;o&rdquo;.<br />\r\n18h00: Ăn tối, nghỉ đ&ecirc;m tại Đồng Văn.</p>\r\n\r\n<p>NG&Agrave;Y 03: ĐỒNG VĂN &ndash; H&Agrave; GIANG &ndash; H&Agrave; NỘI (ĂN S&Aacute;NG, TRƯA)<br />\r\n07h30: Dạo chợ phi&ecirc;n Đồng Văn (nếu tr&ugrave;ng ng&agrave;y họp).<br />\r\n10h00: Trả ph&ograve;ng, khởi h&agrave;nh về H&agrave; Giang.<br />\r\n12h00: Ăn trưa tại Bắc Quang.<br />\r\n18h00: Về tới H&agrave; Nội, kết th&uacute;c tour.</p>\r\n\r\n<p>Gi&aacute; tour bao gồm:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Xe du lịch đời mới, hướng dẫn vi&ecirc;n chuy&ecirc;n nghiệp</p>\r\n	</li>\r\n	<li>\r\n	<p>Ăn uống, kh&aacute;ch sạn ti&ecirc;u chuẩn 3 sao</p>\r\n	</li>\r\n	<li>\r\n	<p>V&eacute; tham quan, bảo hiểm du lịch</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Gi&aacute; tour kh&ocirc;ng bao gồm:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Chi ph&iacute; c&aacute; nh&acirc;n, đồ uống</p>\r\n	</li>\r\n	<li>\r\n	<p>Tip hướng dẫn vi&ecirc;n</p>\r\n	</li>\r\n	<li>\r\n	<p>VAT</p>\r\n	</li>\r\n</ul>', '2025-09-21 02:39:19', '2025-10-08 08:49:31');
INSERT INTO `tour` (`id`, `id_LoaiTour`, `ten_tour`, `thoigian_tour`, `slug`, `noi_khoi_hanh`, `ngay_bat_dau`, `gia`, `mo_ta`, `created_at`, `updated_at`) VALUES
('T-014', 3, 'Tour Mũi Né – Cung Đường Cát Bay & Lướt Gió Biển', '4 ngày 3 đêm', 'tour-mui-ne-cung-duong-cat-bay-luot-gio-bien', 'Hà Nội', '2025-10-30', 5000000, '<p>Mũi N&eacute; &ndash; thi&ecirc;n đường nghỉ dưỡng của tỉnh B&igrave;nh Thuận, nơi biển xanh, c&aacute;t trắng v&agrave; nắng v&agrave;ng h&ograve;a quyện tạo n&ecirc;n bức tranh tuyệt đẹp. Tour du lịch Mũi N&eacute; 3 ng&agrave;y sẽ mang đến cho du kh&aacute;ch trải nghiệm thư gi&atilde;n b&ecirc;n bờ biển, chinh phục đồi c&aacute;t bay v&agrave; thưởng thức hải sản tươi ngon trong kh&ocirc;ng gian biển lộng gi&oacute;.</p>\r\n\r\n<p>NG&Agrave;Y 01: TP.HCM &ndash; PHAN THIẾT &ndash; MŨI N&Eacute; (ĂN TRƯA, TỐI)<br />\r\n07h00: Khởi h&agrave;nh từ TP.HCM đi Phan Thiết.<br />\r\n11h30: Ăn trưa tại nh&agrave; h&agrave;ng ven biển.<br />\r\n14h00: Nhận ph&ograve;ng kh&aacute;ch sạn nghỉ ngơi.<br />\r\n16h00: Tham quan L&agrave;ng Ch&agrave;i Mũi N&eacute;, ngắm ho&agrave;ng h&ocirc;n tr&ecirc;n biển.<br />\r\n18h30: Ăn tối v&agrave; nghỉ đ&ecirc;m tại kh&aacute;ch sạn.</p>\r\n\r\n<p>NG&Agrave;Y 02: MŨI N&Eacute; &ndash; ĐỒI C&Aacute;T BAY &ndash; SUỐI TI&Ecirc;N (ĂN S&Aacute;NG, TRƯA, TỐI)<br />\r\n05h00: Khởi h&agrave;nh ngắm b&igrave;nh minh tr&ecirc;n Đồi C&aacute;t Trắng.<br />\r\n07h30: Ăn s&aacute;ng, tham quan Suối Ti&ecirc;n &ndash; kỳ quan thi&ecirc;n nhi&ecirc;n tuyệt đẹp.<br />\r\n12h00: Ăn trưa, nghỉ ngơi tại resort.<br />\r\n15h00: Tham quan B&agrave;u Trắng bằng xe jeep, chụp h&igrave;nh check-in.<br />\r\n18h00: Ăn tối hải sản, nghỉ đ&ecirc;m.</p>\r\n\r\n<p>NG&Agrave;Y 03: MŨI N&Eacute; &ndash; PHAN THIẾT &ndash; TP.HCM (ĂN S&Aacute;NG, TRƯA)<br />\r\n07h30: Ăn s&aacute;ng, tự do tắm biển.<br />\r\n11h00: Trả ph&ograve;ng, ăn trưa tại Phan Thiết.<br />\r\n14h00: Khởi h&agrave;nh về TP.HCM, kết th&uacute;c tour.</p>\r\n\r\n<p>Gi&aacute; tour bao gồm:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Xe du lịch, hướng dẫn vi&ecirc;n, kh&aacute;ch sạn 3 sao</p>\r\n	</li>\r\n	<li>\r\n	<p>Ăn uống theo chương tr&igrave;nh</p>\r\n	</li>\r\n	<li>\r\n	<p>V&eacute; tham quan, bảo hiểm du lịch</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Gi&aacute; tour kh&ocirc;ng bao gồm:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Chi ph&iacute; c&aacute; nh&acirc;n</p>\r\n	</li>\r\n	<li>\r\n	<p>Thuế VAT</p>\r\n	</li>\r\n	<li>\r\n	<p>Tip hướng dẫn vi&ecirc;n</p>\r\n	</li>\r\n</ul>', '2025-09-21 02:39:45', '2025-10-08 08:49:39'),
('T-015', 3, 'Tour Côn Đảo – Khám Phá Thiên Nhiên & Lịch Sử Bi Hùng', '3 ngày 3 đêm', 'tour-con-dao-kham-pha-thien-nhien-lich-su-bi-hung', 'Hà Nội', '2025-10-27', 3000000, '<p>C&ocirc;n Đảo &ndash; quần đảo huyền thoại giữa Biển Đ&ocirc;ng, vừa mang vẻ đẹp hoang sơ vừa chứa đựng những dấu ấn lịch sử thi&ecirc;ng li&ecirc;ng. Tour du lịch C&ocirc;n Đảo 3 ng&agrave;y sẽ đưa du kh&aacute;ch đến thăm c&aacute;c di t&iacute;ch lịch sử, kh&aacute;m ph&aacute; cảnh đẹp tự nhi&ecirc;n tuyệt mỹ v&agrave; trải nghiệm bầu kh&ocirc;ng kh&iacute; trong l&agrave;nh của h&ograve;n đảo linh thi&ecirc;ng.</p>\r\n\r\n<p>NG&Agrave;Y 01: TP.HCM &ndash; C&Ocirc;N ĐẢO &ndash; KH&Aacute;M PH&Aacute; THỊ TRẤN (ĂN TRƯA, TỐI)<br />\r\n07h00: Bay từ TP.HCM đến C&ocirc;n Đảo.<br />\r\n09h30: Đến nơi, nhận ph&ograve;ng kh&aacute;ch sạn.<br />\r\n11h00: Tham quan Dinh Ch&uacute;a Đảo, Bảo t&agrave;ng C&ocirc;n Đảo.<br />\r\n12h30: Ăn trưa, nghỉ ngơi.<br />\r\n15h00: Thăm nghĩa trang H&agrave;ng Dương, viếng mộ c&ocirc; V&otilde; Thị S&aacute;u.<br />\r\n18h00: Ăn tối, nghỉ đ&ecirc;m.</p>\r\n\r\n<p>NG&Agrave;Y 02: C&Ocirc;N ĐẢO &ndash; B&Atilde;I ĐẦM TRẦU &ndash; H&Ograve;N CAU (ĂN S&Aacute;NG, TRƯA, TỐI)<br />\r\n07h30: Tham quan b&atilde;i Đầm Trầu &ndash; một trong những b&atilde;i biển đẹp nhất đảo.<br />\r\n11h30: Ăn trưa picnic tr&ecirc;n b&atilde;i biển.<br />\r\n14h00: Đi t&agrave;u ra H&ograve;n Cau, tắm biển, lặn ngắm san h&ocirc;.<br />\r\n18h00: Trở về đất liền, ăn tối v&agrave; nghỉ đ&ecirc;m.</p>\r\n\r\n<p>NG&Agrave;Y 03: C&Ocirc;N ĐẢO &ndash; MUA SẮM &ndash; TRỞ VỀ (ĂN S&Aacute;NG, TRƯA)<br />\r\n07h30: Tham quan chợ C&ocirc;n Đảo, mua đặc sản địa phương.<br />\r\n11h00: Ăn trưa, trả ph&ograve;ng kh&aacute;ch sạn.<br />\r\n13h00: L&ecirc;n m&aacute;y bay trở về TP.HCM, kết th&uacute;c h&agrave;nh tr&igrave;nh.</p>\r\n\r\n<p>Gi&aacute; tour bao gồm:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>V&eacute; m&aacute;y bay khứ hồi, xe đưa đ&oacute;n, hướng dẫn vi&ecirc;n</p>\r\n	</li>\r\n	<li>\r\n	<p>Ăn uống, kh&aacute;ch sạn 3 sao</p>\r\n	</li>\r\n	<li>\r\n	<p>V&eacute; tham quan, bảo hiểm du lịch</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Gi&aacute; tour kh&ocirc;ng bao gồm:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Chi ph&iacute; c&aacute; nh&acirc;n, đồ uống</p>\r\n	</li>\r\n	<li>\r\n	<p>Thuế VAT</p>\r\n	</li>\r\n	<li>\r\n	<p>Tip hướng dẫn vi&ecirc;n</p>\r\n	</li>\r\n</ul>', '2025-09-21 02:40:20', '2025-10-08 08:49:47');

-- --------------------------------------------------------

--
-- Table structure for table `trang_tintuc`
--

CREATE TABLE `trang_tintuc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_theloai` bigint(20) UNSIGNED NOT NULL,
  `id_nguoidung` varchar(255) DEFAULT NULL,
  `tieu_de` text NOT NULL,
  `slug` text NOT NULL,
  `mo_ta` text NOT NULL,
  `noidung_rutgon` text NOT NULL,
  `hinh_anh` text NOT NULL,
  `doc` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trang_tintuc`
--

INSERT INTO `trang_tintuc` (`id`, `id_theloai`, `id_nguoidung`, `tieu_de`, `slug`, `mo_ta`, `noidung_rutgon`, `hinh_anh`, `doc`, `created_at`, `updated_at`) VALUES
(2, 2, 'admin', 'CẨM NANG DU LỊCH TỪNG ĐIỂM ĐẾN', 'cam-nang-du-lich-tung-diem-den', '<p>Cẩm Nang Du Lịch Việt Nam 2025 &ndash; Hướng Dẫn Chi Tiết Từng Điểm Đến</p>\r\n\r\n<p><strong>Meta Description:</strong><br />\r\nKh&aacute;m ph&aacute; 15 địa điểm du lịch nổi tiếng khắp Việt Nam c&ugrave;ng hướng dẫn chi tiết, lịch tr&igrave;nh gợi &yacute;, gi&aacute; v&eacute; v&agrave; b&iacute; quyết vui chơi tiết kiệm nhất 2025.</p>\r\n\r\n<p><strong>Từ kh&oacute;a ch&iacute;nh:</strong><br />\r\ncẩm nang du lịch, du lịch Việt Nam 2025, kinh nghiệm du lịch, hướng dẫn du lịch</p>\r\n\r\n<p><strong>Cấu tr&uacute;c b&agrave;i:</strong></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>H2:</strong> Cẩm nang du lịch miền Bắc</p>\r\n\r\n	<ul>\r\n		<li>\r\n		<p><strong>H3:</strong> Kinh nghiệm du lịch Hạ Long &ndash; Lịch tr&igrave;nh 3N2Đ</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong> Trekking Fansipan &ndash; Chuẩn bị g&igrave; cho h&agrave;nh tr&igrave;nh &ldquo;n&oacute;c nh&agrave; Đ&ocirc;ng Dương&rdquo;?</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong> Du lịch H&agrave; Giang &ndash; Khi cao nguy&ecirc;n đ&aacute; nở hoa</p>\r\n		</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>H2:</strong> Cẩm nang du lịch miền Trung</p>\r\n\r\n	<ul>\r\n		<li>\r\n		<p><strong>H3:</strong> Du lịch Đ&agrave; Nẵng &ndash; Hội An &ndash; Combo tuyệt vời</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong> Kh&aacute;m ph&aacute; Hang Sơn Đo&ograve;ng &ndash; kỳ quan dưới l&ograve;ng đất</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong> Tour Mũi N&eacute; &ndash; Check-in đồi c&aacute;t bay &amp; B&agrave;u Trắng</p>\r\n		</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>H2:</strong> Cẩm nang du lịch miền Nam</p>\r\n\r\n	<ul>\r\n		<li>\r\n		<p><strong>H3:</strong> Tour Miền T&acirc;y &ndash; Chợ nổi C&aacute;i Răng v&agrave; miệt vườn tr&aacute;i c&acirc;y</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong> Du lịch C&ocirc;n Đảo &ndash; Thi&ecirc;n nhi&ecirc;n &amp; lịch sử giao h&ograve;a</p>\r\n		</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<hr />\r\n<h2>🧭 <strong>MỤC 2: REVIEW &amp; TRẢI NGHIỆM TOUR THỰC TẾ</strong></h2>\r\n\r\n<p><strong>Title:</strong><br />\r\nTrải Nghiệm Thực Tế 15 Tour Hot Nhất Việt Nam &ndash; Review Chi Tiết Từ Du Kh&aacute;ch</p>\r\n\r\n<p><strong>Meta Description:</strong><br />\r\nĐọc review ch&acirc;n thực từ du kh&aacute;ch về 15 tour nổi tiếng như Hạ Long, Nha Trang, Sơn Đo&ograve;ng, Miền T&acirc;y... Cảm nhận thực tế, đ&aacute;nh gi&aacute; dịch vụ, h&igrave;nh ảnh v&agrave; chi ph&iacute;.</p>\r\n\r\n<p><strong>Từ kh&oacute;a:</strong><br />\r\nreview tour du lịch, trải nghiệm du lịch thực tế, đ&aacute;nh gi&aacute; tour Việt Nam</p>\r\n\r\n<p><strong>Cấu tr&uacute;c b&agrave;i:</strong></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>H2:</strong> Review tour miền Bắc</p>\r\n\r\n	<ul>\r\n		<li>\r\n		<p><strong>H3:</strong> Hạ Long &ndash; Di sản thi&ecirc;n nhi&ecirc;n giữa l&ograve;ng biển Đ&ocirc;ng</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong> Fansipan &ndash; H&agrave;nh tr&igrave;nh chạm m&acirc;y đầy cảm x&uacute;c</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong> H&agrave; Giang &ndash; Cao nguy&ecirc;n đ&aacute; v&agrave; những cung đường uốn lượn</p>\r\n		</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>H2:</strong> Review tour miền Trung</p>\r\n\r\n	<ul>\r\n		<li>\r\n		<p><strong>H3:</strong> Hang Sơn Đo&ograve;ng &ndash; Kỳ quan chưa từng thấy</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong> Đ&agrave; Nẵng &ndash; Th&agrave;nh phố đ&aacute;ng sống v&agrave; những b&atilde;i biển xanh</p>\r\n		</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>H2:</strong> Review tour miền Nam</p>\r\n\r\n	<ul>\r\n		<li>\r\n		<p><strong>H3:</strong> Miền T&acirc;y &ndash; L&ecirc;nh đ&ecirc;nh chợ nổi C&aacute;i Răng</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong> C&ocirc;n Đảo &ndash; B&igrave;nh y&ecirc;n giữa đại dương xanh</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong> Mũi N&eacute; &ndash; Nơi gi&oacute; v&agrave; c&aacute;t ho&agrave; quyện</p>\r\n		</li>\r\n	</ul>\r\n	</li>\r\n</ul>', 'REVIEW & TRẢI NGHIỆM TOUR THỰC TẾ', 'imgTrangTinTucs/5V59tb5hBY4U35fG1YgkydpNcyiAzXQzOl701Tyv.jpg', 4, '2025-10-07 05:51:02', '2025-10-11 14:08:31'),
(3, 4, 'admin', 'Ẩm Thực Việt Nam 2025 – Khám Phá Đặc Sản Ba Miền Từ Bắc Chí Nam', 'am-thuc-viet-nam-2025-kham-pha-dac-san-ba-mien-tu-bac-chi-nam', '<p>Ẩm Thực Việt Nam 2025 &ndash; Kh&aacute;m Ph&aacute; Đặc Sản Ba Miền Từ Bắc Ch&iacute; Nam</p>\r\n\r\n<p><strong>Meta Description:</strong><br />\r\nH&agrave;nh tr&igrave;nh thưởng thức ẩm thực Việt Nam 2025 với h&agrave;ng chục m&oacute;n ngon v&ugrave;ng miền: phở H&agrave; Nội, cao lầu Hội An, b&aacute;nh x&egrave;o miền T&acirc;y... K&egrave;m địa chỉ gợi &yacute; v&agrave; gi&aacute; tham khảo.</p>\r\n\r\n<p><strong>Từ kh&oacute;a:</strong><br />\r\nẩm thực Việt Nam, đặc sản v&ugrave;ng miền, m&oacute;n ngon ba miền, ẩm thực du lịch 2025</p>\r\n\r\n<hr />\r\n<h3>H2: Ẩm thực miền Bắc &ndash; Thanh tao v&agrave; tinh tế</h3>\r\n\r\n<p><strong>H3: Phở H&agrave; Nội &ndash; Linh hồn của ẩm thực Việt</strong><br />\r\nPhở H&agrave; Nội vẫn giữ nguy&ecirc;n vị truyền thống: nước d&ugrave;ng trong, ngọt từ xương, b&aacute;nh phở dẻo v&agrave; l&aacute;t thịt b&ograve; mềm. Gi&aacute; trung b&igrave;nh từ 35.000 &ndash; 60.000đ/t&ocirc;.<br />\r\n📍<strong>Gợi &yacute; địa điểm:</strong> Phở Th&igrave;n (L&ograve; Đ&uacute;c), Phở B&aacute;t Đ&agrave;n.</p>\r\n\r\n<p><strong>H3: B&uacute;n chả &amp; nem cua bể &ndash; M&oacute;n ngon kh&ocirc;ng thể bỏ lỡ</strong><br />\r\nSự h&ograve;a quyện của thịt nướng thơm lừng, b&uacute;n trắng v&agrave; nước chấm chua ngọt đậm đ&agrave; khiến b&uacute;n chả trở th&agrave;nh m&oacute;n ăn quốc d&acirc;n.</p>\r\n\r\n<p><strong>H3: Ẩm thực v&ugrave;ng cao &ndash; Hương vị T&acirc;y Bắc</strong><br />\r\nC&aacute;c m&oacute;n như thắng cố, lợn cắp n&aacute;ch, c&aacute; suối nướng mang đậm bản sắc d&acirc;n tộc. Khi đến Sa Pa hay H&agrave; Giang, đừng qu&ecirc;n thử rượu ng&ocirc; men l&aacute; đặc trưng.</p>\r\n\r\n<hr />\r\n<h3>H2: Ẩm thực miền Trung &ndash; Đậm đ&agrave; v&agrave; rực rỡ</h3>\r\n\r\n<p><strong>H3: M&igrave; Quảng &amp; Cao Lầu &ndash; Linh hồn xứ Quảng</strong><br />\r\nM&igrave; Quảng được ăn với nước d&ugrave;ng &iacute;t nhưng đậm vị, topping phong ph&uacute; từ t&ocirc;m, thịt, trứng c&uacute;t đến b&aacute;nh tr&aacute;ng nướng.<br />\r\n📍<strong>N&ecirc;n thử tại:</strong> M&igrave; Quảng B&agrave; Mua, Hội An.</p>\r\n\r\n<p><strong>H3: Huế &ndash; Thi&ecirc;n đường m&oacute;n ăn cung đ&igrave;nh</strong><br />\r\nB&uacute;n b&ograve; Huế, b&aacute;nh b&egrave;o, b&aacute;nh lọc, ch&egrave; hạt sen l&agrave; những m&oacute;n khiến thực kh&aacute;ch nhớ m&atilde;i.<br />\r\nHuế c&ograve;n nổi tiếng với c&aacute;ch tr&igrave;nh b&agrave;y cầu kỳ v&agrave; tinh tế.</p>\r\n\r\n<hr />\r\n<h3>H2: Ẩm thực miền Nam &ndash; Ph&oacute;ng kho&aacute;ng v&agrave; d&acirc;n d&atilde;</h3>\r\n\r\n<p><strong>H3: B&aacute;nh x&egrave;o, hủ tiếu &amp; b&uacute;n mắm &ndash; M&oacute;n ngon miền s&ocirc;ng nước</strong><br />\r\nHương vị đậm đ&agrave;, nguy&ecirc;n liệu phong ph&uacute; từ hải sản đến rau rừng tạo n&ecirc;n đặc trưng ri&ecirc;ng.<br />\r\n📍<strong>Gợi &yacute;:</strong> B&aacute;nh x&egrave;o Mười Xiềm (Cần Thơ), Hủ tiếu Mỹ Tho.</p>\r\n\r\n<p><strong>H3: Tr&aacute;i c&acirc;y miệt vườn &ndash; Hương vị ngọt ng&agrave;o quanh năm</strong><br />\r\nM&ugrave;a n&agrave;o thức nấy: sầu ri&ecirc;ng, ch&ocirc;m ch&ocirc;m, măng cụt... Bạn c&oacute; thể trải nghiệm h&aacute;i tr&aacute;i tại vườn ở Tiền Giang hoặc Vĩnh Long.</p>', 'ẨM THỰC & ĐẶC SẢN VÙNG MIỀN', 'imgTrangTinTucs/uIqRJ6HYJ6Uaad6YMlxXTmF2EkERC5A1sPUU03HY.jpg', 1, '2025-10-11 13:45:22', '2025-10-11 14:06:29'),
(4, 5, 'admin', 'Bí Quyết Du Lịch Thông Minh 2025 – Tiết Kiệm, An Toàn Và Trải Nghiệm Hơn', 'bi-quyet-du-lich-thong-minh-2025-tiet-kiem-an-toan-va-trai-nghiem-hon', '<p>B&iacute; Quyết Du Lịch Th&ocirc;ng Minh 2025 &ndash; Tiết Kiệm, An To&agrave;n V&agrave; Trải Nghiệm Hơn</p>\r\n\r\n<p><strong>Meta Description:</strong><br />\r\nTổng hợp 12 mẹo du lịch th&ocirc;ng minh năm 2025: săn v&eacute; rẻ, chọn tour uy t&iacute;n, quản l&yacute; chi ph&iacute;, v&agrave; ứng dụng c&ocirc;ng nghệ để du lịch dễ d&agrave;ng hơn.</p>\r\n\r\n<p><strong>Từ kh&oacute;a:</strong><br />\r\nb&iacute; quyết du lịch, mẹo du lịch th&ocirc;ng minh, du lịch tiết kiệm 2025, kinh nghiệm du lịch Việt Nam</p>\r\n\r\n<hr />\r\n<h3>H2: Trước khi đi &ndash; Chuẩn bị l&agrave; ch&igrave;a kh&oacute;a</h3>\r\n\r\n<p><strong>H3: Săn v&eacute; m&aacute;y bay v&agrave; ph&ograve;ng kh&aacute;ch sạn gi&aacute; rẻ</strong><br />\r\nH&atilde;y đặt v&eacute; trước 4&ndash;6 tuần, sử dụng c&aacute;c app như Traveloka, Skyscanner, hoặc Google Flights để so s&aacute;nh gi&aacute;.</p>\r\n\r\n<p><strong>H3: L&ecirc;n lịch tr&igrave;nh khoa học</strong><br />\r\nChia thời gian hợp l&yacute; giữa tham quan &ndash; nghỉ ngơi &ndash; trải nghiệm ẩm thực.<br />\r\nGợi &yacute; d&ugrave;ng Google My Maps để đ&aacute;nh dấu địa điểm.</p>\r\n\r\n<p><strong>H3: Chuẩn bị h&agrave;nh l&yacute; gọn nhẹ nhưng đủ d&ugrave;ng</strong><br />\r\nMang theo 3 nh&oacute;m đồ: trang phục, y tế cơ bản, giấy tờ &amp; sạc dự ph&ograve;ng.<br />\r\nTip: Cuộn quần &aacute;o thay v&igrave; gấp để tiết kiệm chỗ.</p>\r\n\r\n<hr />\r\n<h3>H2: Trong chuyến đi &ndash; Du lịch &ldquo;th&ocirc;ng minh số&rdquo;</h3>\r\n\r\n<p><strong>H3: Ứng dụng c&ocirc;ng nghệ hỗ trợ du lịch</strong><br />\r\nD&ugrave;ng Google Translate, Grab, MoMo, hoặc bản đồ offline của Maps.me gi&uacute;p tiết kiệm thời gian v&agrave; tr&aacute;nh rủi ro.</p>\r\n\r\n<p><strong>H3: Mẹo tiết kiệm chi ph&iacute; ăn uống &amp; di chuyển</strong><br />\r\nƯu ti&ecirc;n qu&aacute;n địa phương, di chuyển bằng xe bus, thu&ecirc; xe m&aacute;y hoặc đi bộ nếu khoảng c&aacute;ch ngắn.</p>\r\n\r\n<hr />\r\n<h3>H2: Sau chuyến đi &ndash; Ghi lại &amp; chia sẻ h&agrave;nh tr&igrave;nh</h3>\r\n\r\n<p><strong>H3: Ghi ch&eacute;p chi ph&iacute; để r&uacute;t kinh nghiệm</strong><br />\r\nTạo bảng thống k&ecirc; chi ti&ecirc;u để lần sau t&iacute;nh to&aacute;n ch&iacute;nh x&aacute;c hơn.</p>\r\n\r\n<p><strong>H3: Chia sẻ review &ndash; lan tỏa gi&aacute; trị du lịch xanh</strong><br />\r\nĐăng h&igrave;nh ảnh, đ&aacute;nh gi&aacute; trung thực gi&uacute;p người kh&aacute;c c&oacute; th&ecirc;m th&ocirc;ng tin v&agrave; th&uacute;c đẩy du lịch bền vững.</p>', 'BÍ QUYẾT DU LỊCH THÔNG MINH', 'imgTrangTinTucs/pP6gUK1R65N3nf5LYbS4tpn5ftjTHUXKFmjVMn2r.jpg', 0, '2025-10-11 13:46:01', '2025-10-11 13:46:01'),
(5, 6, 'admin', 'Du Lịch Việt Nam 2025 Theo Mùa & Đối Tượng – Gợi Ý Lịch Trình Hoàn Hảo Cho Mọi Nhà', 'du-lich-viet-nam-2025-theo-mua-doi-tuong-goi-y-lich-trinh-hoan-hao-cho-moi-nha', '<p>Du Lịch Việt Nam 2025 Theo M&ugrave;a &amp; Đối Tượng &ndash; Gợi &Yacute; Lịch Tr&igrave;nh Ho&agrave;n Hảo Cho Mọi Nh&agrave;</p>\r\n\r\n<p><strong>Meta Description:</strong><br />\r\nChọn điểm đến ph&ugrave; hợp theo m&ugrave;a v&agrave; nh&oacute;m du kh&aacute;ch: gia đ&igrave;nh, cặp đ&ocirc;i, nh&oacute;m bạn hay độc h&agrave;nh. Gợi &yacute; thời điểm đẹp nhất v&agrave; trải nghiệm đ&aacute;ng thử năm 2025.</p>\r\n\r\n<p><strong>Từ kh&oacute;a:</strong><br />\r\ndu lịch theo m&ugrave;a, lịch tr&igrave;nh du lịch Việt Nam 2025, điểm đến cho gia đ&igrave;nh, du lịch cặp đ&ocirc;i</p>\r\n\r\n<hr />\r\n<h3>H2: Du lịch theo m&ugrave;a &ndash; Mỗi thời điểm một vẻ đẹp</h3>\r\n\r\n<p><strong>H3: M&ugrave;a xu&acirc;n (1&ndash;3): Kh&aacute;m ph&aacute; lễ hội &amp; hoa nở miền Bắc</strong><br />\r\nDu xu&acirc;n Y&ecirc;n Tử, ngắm hoa đ&agrave;o H&agrave; Nội, hoa mận Mộc Ch&acirc;u.<br />\r\nThời tiết dễ chịu, rất th&iacute;ch hợp cho c&aacute;c tour văn h&oacute;a.</p>\r\n\r\n<p><strong>H3: M&ugrave;a h&egrave; (4&ndash;8): Du lịch biển miền Trung v&agrave; đảo Nam</strong><br />\r\nĐ&agrave; Nẵng, Nha Trang, Ph&uacute; Quốc l&agrave; lựa chọn &ldquo;hot&rdquo;.<br />\r\nThời điểm tuyệt vời cho hoạt động tắm biển, lặn ngắm san h&ocirc;.</p>\r\n\r\n<p><strong>H3: M&ugrave;a thu (9&ndash;10): Săn m&ugrave;a v&agrave;ng T&acirc;y Bắc</strong><br />\r\nRuộng bậc thang M&ugrave; Cang Chải, Ho&agrave;ng Su Ph&igrave; rực rỡ sắc l&uacute;a.<br />\r\nNhiệt độ m&aacute;t mẻ, cảnh quan n&ecirc;n thơ.</p>\r\n\r\n<p><strong>H3: M&ugrave;a đ&ocirc;ng (11&ndash;12): Sapa v&agrave; Đ&agrave; Lạt trong sương</strong><br />\r\nKh&ocirc;ng kh&iacute; lạnh, th&iacute;ch hợp cho du lịch nghỉ dưỡng, săn m&acirc;y v&agrave; thưởng tr&agrave;.</p>\r\n\r\n<hr />\r\n<h3>H2: Du lịch theo đối tượng &ndash; Trải nghiệm ph&ugrave; hợp cho từng nh&oacute;m</h3>\r\n\r\n<p><strong>H3: Du lịch gia đ&igrave;nh &ndash; An to&agrave;n &amp; vui học cho trẻ nhỏ</strong><br />\r\nGợi &yacute;: VinWonders Nha Trang, Safari Ph&uacute; Quốc, du lịch miệt vườn miền T&acirc;y.<br />\r\nKết hợp học &ndash; chơi gi&uacute;p trẻ mở mang trải nghiệm.</p>\r\n\r\n<p><strong>H3: Du lịch cặp đ&ocirc;i &ndash; L&atilde;ng mạn &amp; ri&ecirc;ng tư</strong><br />\r\nĐ&agrave; Lạt, Ph&uacute; Quốc, Hội An l&agrave; top 3 điểm hẹn cho t&igrave;nh y&ecirc;u.<br />\r\nGợi &yacute;: nghỉ dưỡng resort, du thuyền ho&agrave;ng h&ocirc;n, picnic ngoại &ocirc;.</p>\r\n\r\n<p><strong>H3: Du lịch nh&oacute;m bạn &ndash; Phi&ecirc;u lưu &amp; s&ocirc;i động</strong><br />\r\nTrekking T&agrave; Năng &ndash; Phan Dũng, tour phượt H&agrave; Giang, cắm trại Mũi Dinh.<br />\r\nHoạt động team building hoặc săn ảnh cực kỳ th&uacute; vị.</p>\r\n\r\n<p><strong>H3: Du lịch một m&igrave;nh &ndash; Tự do v&agrave; trải nghiệm bản th&acirc;n</strong><br />\r\nH&agrave; Nội, Huế, Đ&agrave; Lạt l&agrave; nơi l&yacute; tưởng cho h&agrave;nh tr&igrave;nh tự kh&aacute;m ph&aacute;.<br />\r\nTip: chọn homestay th&acirc;n thiện, tham gia tour gh&eacute;p để kết nối bạn mới.</p>', 'DU LỊCH THEO MÙA & THEO ĐỐI TƯỢNG', 'imgTrangTinTucs/NdcUaBmraG3Fpc966reVcqM2QGR8LfhnXwKML3tC.jpg', 0, '2025-10-11 13:46:39', '2025-10-11 13:46:39'),
(6, 2, 'admin', 'Review & Trải nghiệm tour thực tế', 'review-trai-nghiem-tour-thuc-te', '<p>Cẩm Nang Du Lịch Việt Nam 2025 &ndash; Hướng Dẫn Chi Tiết Từng Điểm Đến</p>\r\n\r\n<p><strong>Meta Description:</strong><br />\r\nKh&aacute;m ph&aacute; 15 địa điểm du lịch nổi tiếng khắp Việt Nam c&ugrave;ng hướng dẫn chi tiết, lịch tr&igrave;nh gợi &yacute;, gi&aacute; v&eacute; v&agrave; b&iacute; quyết vui chơi tiết kiệm nhất 2025.</p>\r\n\r\n<p><strong>Từ kh&oacute;a ch&iacute;nh:</strong><br />\r\ncẩm nang du lịch, du lịch Việt Nam 2025, kinh nghiệm du lịch, hướng dẫn du lịch</p>\r\n\r\n<p><strong>Cấu tr&uacute;c b&agrave;i:</strong></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>H2:</strong>&nbsp;Cẩm nang du lịch miền Bắc</p>\r\n\r\n	<ul>\r\n		<li>\r\n		<p><strong>H3:</strong>&nbsp;Kinh nghiệm du lịch Hạ Long &ndash; Lịch tr&igrave;nh 3N2Đ</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong>&nbsp;Trekking Fansipan &ndash; Chuẩn bị g&igrave; cho h&agrave;nh tr&igrave;nh &ldquo;n&oacute;c nh&agrave; Đ&ocirc;ng Dương&rdquo;?</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong>&nbsp;Du lịch H&agrave; Giang &ndash; Khi cao nguy&ecirc;n đ&aacute; nở hoa</p>\r\n		</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>H2:</strong>&nbsp;Cẩm nang du lịch miền Trung</p>\r\n\r\n	<ul>\r\n		<li>\r\n		<p><strong>H3:</strong>&nbsp;Du lịch Đ&agrave; Nẵng &ndash; Hội An &ndash; Combo tuyệt vời</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong>&nbsp;Kh&aacute;m ph&aacute; Hang Sơn Đo&ograve;ng &ndash; kỳ quan dưới l&ograve;ng đất</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong>&nbsp;Tour Mũi N&eacute; &ndash; Check-in đồi c&aacute;t bay &amp; B&agrave;u Trắng</p>\r\n		</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>H2:</strong>&nbsp;Cẩm nang du lịch miền Nam</p>\r\n\r\n	<ul>\r\n		<li>\r\n		<p><strong>H3:</strong>&nbsp;Tour Miền T&acirc;y &ndash; Chợ nổi C&aacute;i Răng v&agrave; miệt vườn tr&aacute;i c&acirc;y</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong>&nbsp;Du lịch C&ocirc;n Đảo &ndash; Thi&ecirc;n nhi&ecirc;n &amp; lịch sử giao h&ograve;a</p>\r\n		</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<hr />\r\n<h2>🧭&nbsp;<strong>MỤC 2: REVIEW &amp; TRẢI NGHIỆM TOUR THỰC TẾ</strong></h2>\r\n\r\n<p><strong>Title:</strong><br />\r\nTrải Nghiệm Thực Tế 15 Tour Hot Nhất Việt Nam &ndash; Review Chi Tiết Từ Du Kh&aacute;ch</p>\r\n\r\n<p><strong>Meta Description:</strong><br />\r\nĐọc review ch&acirc;n thực từ du kh&aacute;ch về 15 tour nổi tiếng như Hạ Long, Nha Trang, Sơn Đo&ograve;ng, Miền T&acirc;y... Cảm nhận thực tế, đ&aacute;nh gi&aacute; dịch vụ, h&igrave;nh ảnh v&agrave; chi ph&iacute;.</p>\r\n\r\n<p><strong>Từ kh&oacute;a:</strong><br />\r\nreview tour du lịch, trải nghiệm du lịch thực tế, đ&aacute;nh gi&aacute; tour Việt Nam</p>\r\n\r\n<p><strong>Cấu tr&uacute;c b&agrave;i:</strong></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>H2:</strong>&nbsp;Review tour miền Bắc</p>\r\n\r\n	<ul>\r\n		<li>\r\n		<p><strong>H3:</strong>&nbsp;Hạ Long &ndash; Di sản thi&ecirc;n nhi&ecirc;n giữa l&ograve;ng biển Đ&ocirc;ng</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong>&nbsp;Fansipan &ndash; H&agrave;nh tr&igrave;nh chạm m&acirc;y đầy cảm x&uacute;c</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong>&nbsp;H&agrave; Giang &ndash; Cao nguy&ecirc;n đ&aacute; v&agrave; những cung đường uốn lượn</p>\r\n		</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>H2:</strong>&nbsp;Review tour miền Trung</p>\r\n\r\n	<ul>\r\n		<li>\r\n		<p><strong>H3:</strong>&nbsp;Hang Sơn Đo&ograve;ng &ndash; Kỳ quan chưa từng thấy</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong>&nbsp;Đ&agrave; Nẵng &ndash; Th&agrave;nh phố đ&aacute;ng sống v&agrave; những b&atilde;i biển xanh</p>\r\n		</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>H2:</strong>&nbsp;Review tour miền Nam</p>\r\n\r\n	<ul>\r\n		<li>\r\n		<p><strong>H3:</strong>&nbsp;Miền T&acirc;y &ndash; L&ecirc;nh đ&ecirc;nh chợ nổi C&aacute;i Răng</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong>&nbsp;C&ocirc;n Đảo &ndash; B&igrave;nh y&ecirc;n giữa đại dương xanh</p>\r\n		</li>\r\n		<li>\r\n		<p><strong>H3:</strong>&nbsp;Mũi N&eacute; &ndash; Nơi gi&oacute; v&agrave; c&aacute;t ho&agrave; quyện</p>\r\n		</li>\r\n	</ul>\r\n	</li>\r\n</ul>', 'Review & Trải nghiệm tour thực tế', 'imgTrangTinTucs/gfWPihRQpj5ndiJJ1xeCDqeJWLp3FVE4YnKycxAo.jpg', 0, '2025-10-11 14:08:11', '2025-10-11 14:08:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dat_tour`
--
ALTER TABLE `dat_tour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dat_tour_id_nguoidung_foreign` (`id_nguoidung`),
  ADD KEY `dat_tour_id_khachhang_foreign` (`id_khachhang`),
  ADD KEY `dat_tour_id_tour_foreign` (`id_tour`);

--
-- Indexes for table `gop_y`
--
ALTER TABLE `gop_y`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hinhanh_tour`
--
ALTER TABLE `hinhanh_tour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hinhanh_tour_id_tour_foreign` (`id_tour`);

--
-- Indexes for table `hoadondattour`
--
ALTER TABLE `hoadondattour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hoadondattour_id_dattour_foreign` (`id_dattour`);

--
-- Indexes for table `loai_tour`
--
ALTER TABLE `loai_tour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nguoi_dung_email_unique` (`email`),
  ADD UNIQUE KEY `nguoi_dung_tai_khoan_unique` (`tai_khoan`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `the_loai`
--
ALTER TABLE `the_loai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_id_loaitour_foreign` (`id_LoaiTour`);

--
-- Indexes for table `trang_tintuc`
--
ALTER TABLE `trang_tintuc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trang_tintuc_id_theloai_foreign` (`id_theloai`),
  ADD KEY `trang_tintuc_id_nguoidung_foreign` (`id_nguoidung`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gop_y`
--
ALTER TABLE `gop_y`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hinhanh_tour`
--
ALTER TABLE `hinhanh_tour`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `loai_tour`
--
ALTER TABLE `loai_tour`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `the_loai`
--
ALTER TABLE `the_loai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trang_tintuc`
--
ALTER TABLE `trang_tintuc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dat_tour`
--
ALTER TABLE `dat_tour`
  ADD CONSTRAINT `dat_tour_id_khachhang_foreign` FOREIGN KEY (`id_khachhang`) REFERENCES `nguoi_dung` (`id`),
  ADD CONSTRAINT `dat_tour_id_nguoidung_foreign` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoi_dung` (`id`),
  ADD CONSTRAINT `dat_tour_id_tour_foreign` FOREIGN KEY (`id_tour`) REFERENCES `tour` (`id`);

--
-- Constraints for table `hinhanh_tour`
--
ALTER TABLE `hinhanh_tour`
  ADD CONSTRAINT `hinhanh_tour_id_tour_foreign` FOREIGN KEY (`id_tour`) REFERENCES `tour` (`id`);

--
-- Constraints for table `hoadondattour`
--
ALTER TABLE `hoadondattour`
  ADD CONSTRAINT `hoadondattour_id_dattour_foreign` FOREIGN KEY (`id_dattour`) REFERENCES `dat_tour` (`id`);

--
-- Constraints for table `tour`
--
ALTER TABLE `tour`
  ADD CONSTRAINT `tour_id_loaitour_foreign` FOREIGN KEY (`id_LoaiTour`) REFERENCES `loai_tour` (`id`);

--
-- Constraints for table `trang_tintuc`
--
ALTER TABLE `trang_tintuc`
  ADD CONSTRAINT `trang_tintuc_id_nguoidung_foreign` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoi_dung` (`id`),
  ADD CONSTRAINT `trang_tintuc_id_theloai_foreign` FOREIGN KEY (`id_theloai`) REFERENCES `the_loai` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

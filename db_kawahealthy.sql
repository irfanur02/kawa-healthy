-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 09:09 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kawahealthy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username_admin` varchar(255) NOT NULL,
  `password_admin` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username_admin`, `password_admin`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '123', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `email_akun` varchar(255) NOT NULL,
  `username_akun` varchar(255) NOT NULL,
  `password_akun` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `id_pelanggan`, `email_akun`, `username_akun`, `password_akun`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 'agus@gmail.com', 'agus', '321', '2024-09-05 18:14:38', '2024-09-06 18:39:33', NULL),
(2, 5, 'irfan@gmail.com', 'irfan', '123', '2024-09-10 15:56:57', NULL, NULL),
(3, 6, 'agus@gmail.com', 'agus1', '098', '2025-01-31 18:43:51', NULL, NULL),
(4, 7, 'bima@gmail.com', 'bima', 'bima!123', '2025-02-01 12:03:01', NULL, NULL),
(5, 8, 'sara@gmail.com', 'sara', 'sara!123', '2025-02-02 21:59:53', '2025-02-02 22:00:44', NULL),
(6, 9, 'andy@gmail.com', 'andyrachman248', 'andy!123', '2025-02-03 11:08:52', NULL, NULL),
(7, 10, 'dina@gmail.com', 'dina', 'dina!123', '2025-02-27 13:52:09', NULL, NULL),
(8, 11, 'fajar@gmail.com', 'fajar', 'fajar!123', '2025-03-01 13:33:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `catatan_pesanan`
--

CREATE TABLE `catatan_pesanan` (
  `id_catatan_pesanan` int(11) NOT NULL,
  `id_karbo` int(11) DEFAULT NULL,
  `pantangan_paketan` varchar(255) DEFAULT NULL,
  `tanggal_mulai_pesanan` date NOT NULL,
  `periode_hari_paketan` int(11) NOT NULL,
  `periode_hari_baru` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catatan_pesanan`
--

INSERT INTO `catatan_pesanan` (`id_catatan_pesanan`, `id_karbo`, `pantangan_paketan`, `tanggal_mulai_pesanan`, `periode_hari_paketan`, `periode_hari_baru`, `created_at`, `updated_at`, `deleted_at`) VALUES
(31, 1, 'asin', '2025-02-03', 3, NULL, '2025-02-01 16:23:22', NULL, NULL),
(32, NULL, '', '2025-02-05', 10, 9, '2025-02-04 11:11:34', '2025-02-04 11:16:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_catatan`
--

CREATE TABLE `detail_catatan` (
  `id_detail_catatan` int(11) NOT NULL,
  `id_paket_menu` int(11) NOT NULL,
  `id_catatan_pesanan` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_catatan`
--

INSERT INTO `detail_catatan` (`id_detail_catatan`, `id_paket_menu`, `id_catatan_pesanan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(46, 1, 31, '2025-02-01 16:23:22', NULL, NULL),
(47, 4, 31, '2025-02-01 16:23:22', NULL, NULL),
(48, 2, 32, '2025-02-04 11:11:34', NULL, NULL),
(49, 4, 32, '2025-02-04 11:11:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_jadwal_menu`
--

CREATE TABLE `detail_jadwal_menu` (
  `id_detail_jadwal_menu` int(11) NOT NULL,
  `id_jadwal_menu` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_jadwal_menu`
--

INSERT INTO `detail_jadwal_menu` (`id_detail_jadwal_menu`, `id_jadwal_menu`, `id_menu`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 20, 6, NULL, NULL, NULL),
(2, 20, 2, NULL, NULL, NULL),
(3, 21, 2, NULL, NULL, NULL),
(4, 22, 6, NULL, NULL, NULL),
(5, 25, 6, NULL, NULL, NULL),
(6, 26, 6, NULL, NULL, NULL),
(7, 26, 2, NULL, NULL, NULL),
(8, 27, 2, NULL, NULL, NULL),
(9, 29, 7, NULL, NULL, NULL),
(10, 29, 3, NULL, NULL, NULL),
(11, 30, 7, NULL, NULL, NULL),
(12, 30, 5, NULL, NULL, NULL),
(13, 31, 19, NULL, NULL, NULL),
(14, 32, 6, NULL, NULL, NULL),
(15, 33, 6, NULL, NULL, NULL),
(16, 34, 20, NULL, NULL, NULL),
(17, 35, 24, NULL, NULL, NULL),
(18, 36, 8, NULL, NULL, NULL),
(19, 36, 3, NULL, NULL, NULL),
(20, 37, 9, NULL, NULL, NULL),
(21, 37, 5, NULL, NULL, NULL),
(22, 38, 12, NULL, NULL, NULL),
(23, 38, 14, NULL, NULL, NULL),
(24, 39, 11, NULL, NULL, NULL),
(25, 39, 5, NULL, NULL, NULL),
(26, 40, 7, NULL, NULL, NULL),
(27, 40, 17, NULL, NULL, NULL),
(53, 58, 8, '2025-01-07 11:43:52', NULL, NULL),
(54, 58, 3, '2025-01-07 11:43:52', NULL, NULL),
(55, 59, 12, '2025-01-07 11:43:52', NULL, NULL),
(56, 59, 16, '2025-01-07 11:43:52', NULL, NULL),
(57, 60, 11, '2025-01-07 11:43:52', NULL, NULL),
(58, 60, 13, '2025-01-07 11:43:52', NULL, NULL),
(59, 61, 9, '2025-01-07 11:43:52', NULL, NULL),
(60, 61, 17, '2025-01-07 11:43:52', NULL, NULL),
(83, 73, 6, '2025-01-07 13:38:03', NULL, NULL),
(84, 73, 23, '2025-01-07 13:38:03', NULL, NULL),
(85, 74, 19, '2025-01-07 13:38:03', NULL, NULL),
(86, 74, 25, '2025-01-07 13:38:03', NULL, NULL),
(87, 75, 26, '2025-01-07 13:38:03', NULL, NULL),
(88, 75, 22, '2025-01-07 13:38:03', NULL, NULL),
(89, 76, 18, '2025-01-07 13:38:03', NULL, NULL),
(90, 76, 2, '2025-01-07 13:38:03', NULL, NULL),
(106, 85, 8, '2025-01-10 09:51:08', NULL, NULL),
(107, 85, 3, '2025-01-10 09:51:08', NULL, NULL),
(108, 85, NULL, '2025-01-10 09:51:08', NULL, NULL),
(109, 86, 10, '2025-01-10 09:51:08', NULL, NULL),
(110, 86, 13, '2025-01-10 09:51:08', NULL, NULL),
(111, 86, NULL, '2025-01-10 09:51:08', NULL, NULL),
(112, 87, 11, '2025-01-10 09:51:08', NULL, NULL),
(113, 87, 16, '2025-01-10 09:51:08', NULL, NULL),
(114, 87, NULL, '2025-01-10 09:51:08', NULL, NULL),
(115, 88, 7, '2025-01-10 09:51:08', NULL, NULL),
(116, 88, 5, '2025-01-10 09:51:08', NULL, NULL),
(117, 88, NULL, '2025-01-10 09:51:08', NULL, NULL),
(232, 136, 18, '2025-02-01 10:30:35', NULL, NULL),
(233, 136, 19, '2025-02-01 10:30:35', NULL, NULL),
(234, 137, 22, '2025-02-01 10:30:35', NULL, NULL),
(235, 137, 28, '2025-02-01 10:30:35', NULL, NULL),
(236, 138, 30, '2025-02-01 10:30:35', NULL, NULL),
(237, 138, 31, '2025-02-01 10:30:35', NULL, NULL),
(238, 139, 32, '2025-02-01 10:30:35', NULL, NULL),
(239, 139, 2, '2025-02-01 10:30:35', NULL, NULL),
(240, 140, 26, '2025-02-01 10:30:35', NULL, NULL),
(241, 140, 23, '2025-02-01 10:30:35', NULL, NULL),
(242, 141, 7, '2025-02-01 10:31:49', NULL, NULL),
(243, 141, 13, '2025-02-01 10:31:49', NULL, NULL),
(244, 141, NULL, '2025-02-01 10:31:49', NULL, NULL),
(245, 142, 8, '2025-02-01 10:31:49', NULL, NULL),
(246, 142, 14, '2025-02-01 10:31:49', NULL, NULL),
(247, 142, NULL, '2025-02-01 10:31:49', NULL, NULL),
(248, 143, 9, '2025-02-01 10:31:49', NULL, NULL),
(249, 143, 15, '2025-02-01 10:31:49', NULL, NULL),
(250, 143, NULL, '2025-02-01 10:31:49', NULL, NULL),
(251, 144, 11, '2025-02-01 10:31:49', NULL, NULL),
(252, 144, 16, '2025-02-01 10:31:49', NULL, NULL),
(253, 144, NULL, '2025-02-01 10:31:49', NULL, NULL),
(254, 145, 12, '2025-02-01 10:31:49', NULL, NULL),
(255, 145, 17, '2025-02-01 10:31:49', NULL, NULL),
(256, 145, NULL, '2025-02-01 10:31:49', NULL, NULL),
(275, 152, 2, '2025-02-08 11:28:19', NULL, NULL),
(276, 153, 18, '2025-02-08 11:28:19', NULL, '2025-02-08 20:54:18'),
(277, 154, 20, '2025-02-08 11:28:19', NULL, NULL),
(278, 155, 21, '2025-02-08 11:28:19', NULL, NULL),
(279, 156, 22, '2025-02-08 11:28:19', NULL, NULL),
(285, 153, 28, '2025-02-08 16:14:38', NULL, '2025-02-08 16:48:21'),
(286, 153, 21, '2025-02-08 16:14:38', NULL, '2025-02-08 16:48:21'),
(287, 153, 18, '2025-02-08 16:48:21', NULL, '2025-02-08 20:54:18'),
(288, 153, 19, '2025-02-08 20:54:18', NULL, NULL),
(289, 153, 34, '2025-02-08 20:54:18', NULL, NULL),
(290, 158, 20, '2025-02-08 20:57:58', NULL, NULL),
(291, 158, 29, '2025-02-08 20:57:58', NULL, NULL),
(292, 159, 8, '2025-02-08 21:20:45', NULL, NULL),
(293, 159, 13, '2025-02-08 21:20:45', NULL, NULL),
(294, 159, NULL, '2025-02-08 21:20:45', NULL, NULL),
(295, 160, 12, '2025-02-08 21:20:45', NULL, NULL),
(296, 160, 16, '2025-02-08 21:20:45', NULL, NULL),
(297, 160, NULL, '2025-02-08 21:20:45', NULL, NULL),
(298, 161, 9, '2025-02-08 21:20:45', NULL, NULL),
(299, 161, 13, '2025-02-08 21:20:45', NULL, NULL),
(300, 161, NULL, '2025-02-08 21:20:45', NULL, NULL),
(301, 162, 10, '2025-02-08 21:20:45', NULL, NULL),
(302, 162, 15, '2025-02-08 21:20:45', NULL, NULL),
(303, 162, NULL, '2025-02-08 21:20:45', NULL, NULL),
(304, 163, 7, '2025-02-08 21:20:45', NULL, NULL),
(305, 163, 3, '2025-02-08 21:20:45', NULL, NULL),
(306, 163, NULL, '2025-02-08 21:20:45', NULL, NULL),
(307, 164, 10, '2025-02-08 22:08:44', NULL, NULL),
(308, 164, 15, '2025-02-08 22:08:44', NULL, NULL),
(309, 164, NULL, '2025-02-08 22:08:44', NULL, NULL),
(310, 165, 11, '2025-02-08 22:08:44', NULL, NULL),
(311, 165, 17, '2025-02-08 22:08:44', NULL, NULL),
(312, 165, NULL, '2025-02-08 22:08:44', NULL, NULL),
(313, 166, 8, '2025-02-08 22:08:44', NULL, NULL),
(314, 166, 16, '2025-02-08 22:08:44', NULL, NULL),
(315, 166, NULL, '2025-02-08 22:08:44', NULL, NULL),
(316, 167, 10, '2025-02-08 22:08:44', NULL, NULL),
(317, 167, 3, '2025-02-08 22:08:44', NULL, NULL),
(318, 167, NULL, '2025-02-08 22:08:44', NULL, NULL),
(319, 168, 11, '2025-02-08 22:08:44', '2025-02-10 15:02:34', NULL),
(320, 168, 16, '2025-02-08 22:08:44', '2025-02-10 15:02:34', NULL),
(321, 168, NULL, '2025-02-08 22:08:44', NULL, NULL),
(322, 169, 7, '2025-02-10 15:03:02', NULL, NULL),
(323, 169, 15, '2025-02-10 15:03:02', NULL, NULL),
(324, 169, NULL, '2025-02-10 15:03:02', NULL, NULL),
(325, 170, 2, '2025-02-27 13:47:12', NULL, NULL),
(326, 170, 21, '2025-02-27 13:47:12', NULL, NULL),
(327, 171, 6, '2025-02-27 13:47:12', NULL, NULL),
(328, 171, 18, '2025-02-27 13:47:12', NULL, NULL),
(329, 172, 19, '2025-02-27 13:48:24', NULL, NULL),
(330, 172, 25, '2025-02-27 13:48:24', NULL, NULL),
(331, 173, 20, '2025-02-27 13:48:24', NULL, NULL),
(332, 173, 22, '2025-02-27 13:48:24', NULL, NULL),
(333, 174, 34, '2025-02-27 13:48:24', NULL, NULL),
(334, 174, 29, '2025-02-27 13:48:24', NULL, NULL),
(335, 175, 9, '2025-02-27 13:50:26', NULL, NULL),
(336, 175, 5, '2025-02-27 13:50:26', NULL, NULL),
(337, 175, NULL, '2025-02-27 13:50:26', NULL, NULL),
(338, 176, 12, '2025-02-27 13:50:26', NULL, NULL),
(339, 176, 16, '2025-02-27 13:50:26', NULL, NULL),
(340, 176, NULL, '2025-02-27 13:50:26', NULL, NULL),
(341, 177, 10, '2025-02-27 13:50:26', NULL, NULL),
(342, 177, 17, '2025-02-27 13:50:26', NULL, NULL),
(343, 177, NULL, '2025-02-27 13:50:26', NULL, NULL),
(344, 178, 8, '2025-02-27 13:50:26', NULL, NULL),
(345, 178, 13, '2025-02-27 13:50:26', NULL, NULL),
(346, 178, NULL, '2025-02-27 13:50:26', NULL, NULL),
(347, 179, 12, '2025-02-27 13:50:26', NULL, NULL),
(348, 179, 16, '2025-02-27 13:50:26', NULL, NULL),
(349, 179, NULL, '2025-02-27 13:50:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_menu_pesanan`
--

CREATE TABLE `detail_menu_pesanan` (
  `id_detail_menu_pesanan` int(11) NOT NULL,
  `id_detail_jadwal_menu` int(11) DEFAULT NULL,
  `id_menu_pesanan` int(11) NOT NULL,
  `batal` char(1) DEFAULT NULL,
  `id_karbo` int(11) DEFAULT NULL,
  `qty_menu` int(11) DEFAULT NULL,
  `qty_infuse` int(11) DEFAULT NULL,
  `pantangan_pesanan` varchar(255) DEFAULT NULL,
  `keterangan_pedas` char(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_menu_pesanan`
--

INSERT INTO `detail_menu_pesanan` (`id_detail_menu_pesanan`, `id_detail_jadwal_menu`, `id_menu_pesanan`, `batal`, `id_karbo`, `qty_menu`, `qty_infuse`, `pantangan_pesanan`, `keterangan_pedas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(371, 242, 205, NULL, 1, 1, NULL, 'asin', NULL, '2025-02-01 16:23:22', NULL, NULL),
(372, 244, 205, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-01 16:23:22', NULL, NULL),
(373, 245, 206, NULL, 1, 1, NULL, 'asin', NULL, '2025-02-01 16:23:22', NULL, NULL),
(374, 247, 206, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-01 16:23:22', NULL, NULL),
(375, 248, 207, NULL, 1, 1, NULL, 'asin', NULL, '2025-02-01 16:23:22', NULL, NULL),
(376, 250, 207, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-01 16:23:22', NULL, NULL),
(382, 242, 210, NULL, 1, 1, NULL, 'asin', NULL, '2025-02-02 11:45:27', NULL, NULL),
(383, 243, 210, NULL, NULL, 1, NULL, 'gula', NULL, '2025-02-02 11:45:27', NULL, NULL),
(384, 244, 210, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-02 11:45:27', NULL, NULL),
(385, 232, 211, NULL, NULL, 1, NULL, NULL, 't', '2025-02-02 11:45:40', NULL, NULL),
(386, 233, 211, NULL, NULL, 1, NULL, NULL, 't', '2025-02-02 11:45:40', NULL, NULL),
(387, 236, 212, 'b', NULL, 1, NULL, NULL, 'p', '2025-02-02 11:54:08', '2025-02-02 16:01:22', NULL),
(388, 237, 212, 'b', NULL, 1, NULL, NULL, 'p', '2025-02-02 11:54:08', '2025-02-02 16:01:22', NULL),
(389, 251, 213, NULL, 1, 1, NULL, 'sambal', NULL, '2025-02-02 12:35:19', NULL, '2025-02-02 12:36:05'),
(390, 253, 213, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-02 12:35:19', NULL, '2025-02-02 15:17:24'),
(391, 251, 214, NULL, 1, 1, NULL, '', NULL, '2025-02-02 12:38:44', NULL, '2025-02-02 12:39:12'),
(392, 253, 214, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-02 12:38:44', NULL, '2025-02-02 15:17:24'),
(393, 251, 215, NULL, 1, 1, NULL, 'asam', NULL, '2025-02-02 14:08:51', NULL, '2025-02-02 14:08:57'),
(394, 253, 215, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-02 14:08:51', NULL, '2025-02-02 15:17:24'),
(395, 252, 216, NULL, NULL, 1, NULL, 'asam', NULL, '2025-02-02 14:19:31', NULL, '2025-02-02 15:17:22'),
(396, 253, 216, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-02 14:19:31', NULL, '2025-02-02 15:17:24'),
(397, 252, 217, NULL, NULL, 1, NULL, 'asam', NULL, '2025-02-02 14:20:32', NULL, '2025-02-02 15:17:22'),
(398, 253, 217, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-02 14:20:32', NULL, '2025-02-02 15:17:24'),
(399, 252, 218, NULL, NULL, 1, NULL, 'asam', NULL, '2025-02-02 14:22:30', NULL, '2025-02-02 15:17:22'),
(400, 253, 218, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-02 14:22:30', NULL, '2025-02-02 15:17:24'),
(401, 252, 219, NULL, NULL, 1, NULL, '', NULL, '2025-02-02 14:23:51', NULL, '2025-02-02 14:35:40'),
(402, 253, 219, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-02 14:23:51', NULL, '2025-02-02 15:17:24'),
(403, 252, 220, NULL, NULL, 1, NULL, '', NULL, '2025-02-02 14:29:33', NULL, '2025-02-02 14:35:40'),
(404, 253, 220, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-02 14:29:33', NULL, '2025-02-02 15:17:24'),
(405, 252, 221, NULL, NULL, 1, NULL, '', NULL, '2025-02-02 14:35:30', NULL, '2025-02-02 14:35:40'),
(406, 251, 222, NULL, 1, 1, NULL, 'asin', NULL, '2025-02-02 14:37:42', NULL, '2025-02-02 15:17:22'),
(407, 251, 223, NULL, 1, 1, NULL, 'asin', NULL, '2025-02-02 14:37:42', NULL, '2025-02-02 15:17:22'),
(408, 252, 223, NULL, NULL, 1, NULL, 'asam', NULL, '2025-02-02 14:37:42', NULL, '2025-02-02 15:17:22'),
(409, 251, 224, NULL, 1, 1, NULL, 'asin', NULL, '2025-02-02 14:41:34', NULL, '2025-02-02 15:17:22'),
(410, 251, 225, NULL, 1, 1, NULL, 'asin', NULL, '2025-02-02 14:41:35', NULL, '2025-02-02 15:17:22'),
(411, 252, 225, NULL, NULL, 1, NULL, 'asam', NULL, '2025-02-02 14:41:35', NULL, '2025-02-02 15:17:22'),
(412, 251, 226, NULL, 1, 1, NULL, 'asin', NULL, '2025-02-02 14:44:09', NULL, '2025-02-02 15:17:22'),
(413, 251, 227, NULL, 1, 1, NULL, 'asin', NULL, '2025-02-02 14:44:10', NULL, '2025-02-02 15:17:22'),
(414, 252, 227, NULL, NULL, 1, NULL, 'asam', NULL, '2025-02-02 14:44:10', NULL, '2025-02-02 15:17:22'),
(415, 251, 228, NULL, 1, 1, NULL, 'asin', NULL, '2025-02-02 14:49:48', NULL, '2025-02-02 15:17:22'),
(416, 252, 228, NULL, NULL, 1, NULL, 'asam', NULL, '2025-02-02 14:49:48', NULL, '2025-02-02 15:17:22'),
(417, 253, 228, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-02 14:49:48', NULL, '2025-02-02 15:17:24'),
(418, 251, 229, NULL, 1, 1, NULL, 'asin', NULL, '2025-02-02 15:17:03', NULL, '2025-02-02 15:17:22'),
(419, 252, 229, NULL, NULL, 1, NULL, 'asam', NULL, '2025-02-02 15:17:03', NULL, '2025-02-02 15:17:22'),
(420, 253, 229, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-02 15:17:03', NULL, '2025-02-02 15:17:24'),
(421, 251, 230, NULL, 1, 1, NULL, 'asin', NULL, '2025-02-02 15:21:48', NULL, NULL),
(422, 252, 230, NULL, NULL, 1, NULL, 'asam', NULL, '2025-02-02 15:21:48', NULL, NULL),
(423, 253, 230, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-02 15:21:48', NULL, NULL),
(424, 237, 231, NULL, NULL, 1, NULL, NULL, 't', '2025-02-02 15:22:31', NULL, '2025-02-02 15:22:58'),
(425, 235, 232, NULL, NULL, 1, NULL, NULL, 't', '2025-02-02 15:23:13', NULL, '2025-02-02 15:23:25'),
(426, 237, 233, NULL, NULL, 1, NULL, NULL, 't', '2025-02-02 15:23:49', NULL, NULL),
(427, 254, 234, NULL, 1, 2, NULL, '', NULL, '2025-02-03 11:10:13', NULL, NULL),
(428, 254, 235, NULL, 1, 3, NULL, '', NULL, '2025-02-03 11:11:01', NULL, NULL),
(429, 248, 236, NULL, 2, 1, NULL, '', NULL, '2025-02-03 11:11:45', NULL, NULL),
(430, 249, 236, NULL, NULL, 1, NULL, '', NULL, '2025-02-03 11:11:45', NULL, NULL),
(431, 245, 237, NULL, 1, 1, NULL, '', NULL, '2025-02-03 11:16:19', NULL, NULL),
(432, 251, 238, NULL, 2, 1, NULL, '', NULL, '2025-02-04 11:23:17', NULL, NULL),
(433, 249, 239, NULL, NULL, 1, NULL, '', NULL, '2025-02-04 11:11:34', NULL, NULL),
(434, 250, 239, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-04 11:11:34', NULL, NULL),
(435, 252, 240, NULL, NULL, 1, NULL, '', NULL, '2025-02-04 11:11:34', NULL, NULL),
(436, 253, 240, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-04 11:11:34', NULL, NULL),
(437, 255, 241, NULL, NULL, 1, NULL, '', NULL, '2025-02-04 11:11:34', NULL, NULL),
(438, 256, 241, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-04 11:11:34', NULL, NULL),
(453, 293, 251, NULL, NULL, 1, NULL, NULL, NULL, '2025-02-08 21:20:45', NULL, NULL),
(454, 294, 251, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-08 21:20:45', NULL, NULL),
(455, 296, 252, NULL, NULL, 1, NULL, NULL, NULL, '2025-02-08 21:20:45', NULL, NULL),
(456, 297, 252, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-08 21:20:45', NULL, NULL),
(457, 299, 253, NULL, NULL, 1, NULL, NULL, NULL, '2025-02-08 21:20:45', NULL, NULL),
(458, 300, 253, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-08 21:20:45', NULL, NULL),
(459, 302, 254, NULL, NULL, 1, NULL, NULL, NULL, '2025-02-08 21:20:45', NULL, NULL),
(460, 303, 254, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-08 21:20:45', NULL, NULL),
(461, 305, 255, NULL, NULL, 1, NULL, NULL, NULL, '2025-02-08 21:20:45', NULL, NULL),
(462, 306, 255, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-08 21:20:45', NULL, NULL),
(463, 308, 256, NULL, NULL, 1, NULL, NULL, NULL, '2025-02-08 22:08:44', NULL, NULL),
(464, 309, 256, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-08 22:08:44', NULL, NULL),
(465, 311, 257, NULL, NULL, 1, NULL, NULL, NULL, '2025-02-08 22:08:44', NULL, NULL),
(466, 312, 257, NULL, NULL, NULL, 1, NULL, NULL, '2025-02-08 22:08:44', NULL, NULL),
(467, 326, 258, 'b', NULL, 1, NULL, NULL, 't', '2025-03-01 13:33:46', '2025-03-01 13:35:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembayaran`
--

CREATE TABLE `detail_pembayaran` (
  `id_detail_pembayaran` int(11) NOT NULL,
  `id_pembayaran` int(11) DEFAULT NULL,
  `id_pesanan` int(11) DEFAULT NULL,
  `gambar_transfer` varchar(255) DEFAULT NULL,
  `nominal_pembayaran` int(11) DEFAULT NULL,
  `atas_nama_pembayaran` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pembayaran`
--

INSERT INTO `detail_pembayaran` (`id_detail_pembayaran`, `id_pembayaran`, `id_pesanan`, `gambar_transfer`, `nominal_pembayaran`, `atas_nama_pembayaran`, `created_at`, `updated_at`, `deleted_at`) VALUES
(24, 27, 152, '1738401802_4fd3d25e45a79b912379.jpg', 195000, 'fina', '2025-02-01 16:23:22', NULL, NULL),
(25, 29, 154, '1738471581_75221c4123f0576413c4.jpg', 161000, 'fira', '2025-02-02 11:46:21', NULL, NULL),
(26, 30, 155, '1738472162_eb4031f55cb10d9eef38.jpg', 56000, 'bima', '2025-02-02 11:56:02', NULL, NULL),
(27, 31, 156, '1738484696_42bfa27e427e91e41d71.jpg', 140000, 'fina', '2025-02-02 15:24:56', NULL, NULL),
(28, 32, 157, '1738556077_7c6a001b48e053863b15.jpg', 341000, 'andy', '2025-02-03 11:14:37', NULL, NULL),
(29, 33, 159, '1738642295_31ff355fcf0df2204255.jpg', 550000, 'sara', '2025-02-04 11:11:34', NULL, NULL),
(30, 34, 160, '1740810882_1d168db654daf50ada90.jpg', 19000, 'fajar', '2025-03-01 13:34:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `tanggal_mulai`, `tanggal_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, '2024-08-10', '2024-08-11', '2024-08-10 12:36:26', '2024-08-10 12:36:26', NULL),
(18, '2024-08-15', '2024-08-16', '2024-08-10 12:37:20', '2024-08-10 12:37:20', NULL),
(21, '2024-08-12', '2024-08-15', NULL, NULL, NULL),
(22, '2024-09-02', '2024-09-03', NULL, NULL, NULL),
(23, '2024-09-09', '2024-09-13', NULL, NULL, NULL),
(24, '2024-09-09', '2024-09-13', NULL, NULL, NULL),
(39, '2025-01-07', '2025-01-10', '2025-01-07 11:43:52', NULL, NULL),
(47, '2025-01-07', '2025-01-10', '2025-01-07 13:38:03', NULL, NULL),
(53, '2025-01-11', '2025-01-15', '2025-01-10 09:51:08', NULL, NULL),
(54, '2025-01-11', '2025-01-15', '2025-01-11 16:34:28', NULL, NULL),
(56, '2025-01-20', '2025-01-24', '2025-01-20 11:33:47', NULL, NULL),
(57, '2025-01-20', '2025-01-24', '2025-01-20 12:00:42', NULL, NULL),
(58, '2025-01-27', '2025-01-31', '2025-01-23 17:29:46', NULL, NULL),
(59, '2025-01-27', '2025-01-31', '2025-01-23 17:30:49', NULL, NULL),
(67, '2025-02-03', '2025-02-07', '2025-02-01 10:30:35', NULL, NULL),
(68, '2025-02-03', '2025-02-07', '2025-02-01 10:31:49', NULL, NULL),
(74, '2025-02-10', '2025-02-14', '2025-02-08 11:28:19', '2025-02-08 21:02:35', NULL),
(75, '2025-02-10', '2025-02-14', '2025-02-08 21:20:45', NULL, NULL),
(76, '2025-02-17', '2025-02-21', '2025-02-08 22:08:44', '2025-02-10 15:05:49', NULL),
(77, '2025-03-03', '2025-03-07', '2025-02-27 13:47:12', '2025-02-27 13:48:24', NULL),
(78, '2025-03-03', '2025-03-07', '2025-02-27 13:50:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_menu`
--

CREATE TABLE `jadwal_menu` (
  `id_jadwal_menu` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `tanggal_menu` date NOT NULL,
  `infuse` char(1) DEFAULT NULL,
  `status_libur` char(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_menu`
--

INSERT INTO `jadwal_menu` (`id_jadwal_menu`, `id_jadwal`, `tanggal_menu`, `infuse`, `status_libur`, `created_at`, `updated_at`, `deleted_at`) VALUES
(19, 17, '2024-08-10', NULL, 'L', NULL, NULL, NULL),
(20, 17, '2024-08-11', NULL, 'B', NULL, NULL, NULL),
(21, 18, '2024-08-15', NULL, 'B', NULL, NULL, NULL),
(22, 18, '2024-08-16', NULL, 'B', NULL, NULL, NULL),
(25, 21, '2024-08-12', NULL, 'B', NULL, NULL, NULL),
(26, 21, '2024-08-13', NULL, 'B', NULL, NULL, NULL),
(27, 21, '2024-08-14', NULL, 'B', NULL, NULL, NULL),
(28, 21, '2024-08-15', NULL, 'L', NULL, NULL, NULL),
(29, 22, '2024-09-02', 'Y', 'B', NULL, NULL, NULL),
(30, 22, '2024-09-03', 'Y', 'B', NULL, NULL, NULL),
(31, 23, '2024-09-09', NULL, 'B', NULL, NULL, NULL),
(32, 23, '2024-09-10', NULL, 'B', NULL, NULL, NULL),
(33, 23, '2024-09-11', NULL, 'B', NULL, NULL, NULL),
(34, 23, '2024-09-12', NULL, 'B', NULL, NULL, NULL),
(35, 23, '2024-09-13', NULL, 'B', NULL, NULL, NULL),
(36, 24, '2024-09-09', 'Y', 'B', NULL, NULL, NULL),
(37, 24, '2024-09-10', 'Y', 'B', NULL, NULL, NULL),
(38, 24, '2024-09-11', 'Y', 'B', NULL, NULL, NULL),
(39, 24, '2024-09-12', 'Y', 'B', NULL, NULL, NULL),
(40, 24, '2024-09-13', 'Y', 'B', NULL, NULL, NULL),
(58, 39, '2025-01-07', 'Y', 'B', '2025-01-07 11:43:52', NULL, NULL),
(59, 39, '2025-01-08', 'Y', 'B', '2025-01-07 11:43:52', NULL, NULL),
(60, 39, '2025-01-09', 'Y', 'B', '2025-01-07 11:43:52', NULL, NULL),
(61, 39, '2025-01-10', 'Y', 'B', '2025-01-07 11:43:52', NULL, NULL),
(73, 47, '2025-01-07', NULL, 'B', '2025-01-07 13:38:03', NULL, NULL),
(74, 47, '2025-01-08', NULL, 'B', '2025-01-07 13:38:03', NULL, NULL),
(75, 47, '2025-01-09', NULL, 'B', '2025-01-07 13:38:03', NULL, NULL),
(76, 47, '2025-01-10', NULL, 'B', '2025-01-07 13:38:03', NULL, NULL),
(85, 53, '2025-01-11', 'Y', 'B', '2025-01-10 09:51:08', NULL, NULL),
(86, 53, '2025-01-12', 'Y', 'B', '2025-01-10 09:51:08', NULL, NULL),
(87, 53, '2025-01-13', 'Y', 'B', '2025-01-10 09:51:08', NULL, NULL),
(88, 53, '2025-01-14', 'Y', 'B', '2025-01-10 09:51:08', NULL, NULL),
(89, 53, '2025-01-15', 'Y', 'B', '2025-01-10 09:51:08', NULL, NULL),
(90, 54, '2025-01-11', NULL, 'B', '2025-01-11 16:34:28', NULL, NULL),
(91, 54, '2025-01-12', NULL, 'B', '2025-01-11 16:34:28', NULL, NULL),
(92, 54, '2025-01-13', NULL, 'B', '2025-01-11 16:34:28', NULL, NULL),
(93, 54, '2025-01-14', NULL, 'B', '2025-01-11 16:34:28', NULL, NULL),
(94, 54, '2025-01-15', NULL, 'B', '2025-01-11 16:34:28', NULL, NULL),
(96, 56, '2025-01-20', NULL, 'B', '2025-01-20 11:33:47', NULL, NULL),
(97, 56, '2025-01-21', NULL, 'B', '2025-01-20 11:33:47', NULL, NULL),
(98, 56, '2025-01-22', NULL, 'B', '2025-01-20 11:33:47', NULL, NULL),
(99, 56, '2025-01-23', NULL, 'B', '2025-01-20 11:33:47', NULL, NULL),
(100, 56, '2025-01-24', NULL, 'B', '2025-01-20 11:33:47', NULL, NULL),
(101, 57, '2025-01-20', 'Y', 'B', '2025-01-20 12:00:42', NULL, NULL),
(102, 57, '2025-01-21', 'Y', 'B', '2025-01-20 12:00:42', NULL, NULL),
(103, 57, '2025-01-22', 'Y', 'B', '2025-01-20 12:00:42', NULL, NULL),
(104, 57, '2025-01-23', 'Y', 'B', '2025-01-20 12:00:42', NULL, NULL),
(105, 57, '2025-01-24', 'Y', 'B', '2025-01-20 12:00:42', NULL, NULL),
(106, 58, '2025-01-27', NULL, 'B', '2025-01-23 17:29:46', NULL, NULL),
(107, 58, '2025-01-28', NULL, 'B', '2025-01-23 17:29:46', NULL, NULL),
(108, 58, '2025-01-29', NULL, 'B', '2025-01-23 17:29:46', NULL, NULL),
(109, 58, '2025-01-30', NULL, 'B', '2025-01-23 17:29:46', NULL, NULL),
(110, 58, '2025-01-31', NULL, 'B', '2025-01-23 17:29:46', NULL, NULL),
(111, 59, '2025-01-27', 'Y', 'B', '2025-01-23 17:30:49', NULL, NULL),
(112, 59, '2025-01-28', 'Y', 'B', '2025-01-23 17:30:49', NULL, NULL),
(113, 59, '2025-01-29', 'Y', 'B', '2025-01-23 17:30:49', NULL, NULL),
(114, 59, '2025-01-30', 'Y', 'B', '2025-01-23 17:30:49', NULL, NULL),
(115, 59, '2025-01-31', 'Y', 'B', '2025-01-23 17:30:49', NULL, NULL),
(136, 67, '2025-02-03', NULL, 'B', '2025-02-01 10:30:35', NULL, NULL),
(137, 67, '2025-02-04', NULL, 'B', '2025-02-01 10:30:35', NULL, NULL),
(138, 67, '2025-02-05', NULL, 'B', '2025-02-01 10:30:35', NULL, NULL),
(139, 67, '2025-02-06', NULL, 'B', '2025-02-01 10:30:35', NULL, NULL),
(140, 67, '2025-02-07', NULL, 'B', '2025-02-01 10:30:35', NULL, NULL),
(141, 68, '2025-02-03', 'Y', 'B', '2025-02-01 10:31:49', NULL, NULL),
(142, 68, '2025-02-04', 'Y', 'B', '2025-02-01 10:31:49', NULL, NULL),
(143, 68, '2025-02-05', 'Y', 'B', '2025-02-01 10:31:49', NULL, NULL),
(144, 68, '2025-02-06', 'Y', 'B', '2025-02-01 10:31:49', NULL, NULL),
(145, 68, '2025-02-07', 'Y', 'B', '2025-02-01 10:31:49', NULL, NULL),
(152, 74, '2025-02-10', NULL, 'B', '2025-02-08 11:28:19', '2025-02-08 21:02:35', NULL),
(153, 74, '2025-02-11', NULL, 'B', '2025-02-08 11:28:19', '2025-02-08 21:02:35', NULL),
(154, 74, '2025-02-12', NULL, 'B', '2025-02-08 11:28:19', '2025-02-08 21:02:35', NULL),
(155, 74, '2025-02-13', NULL, 'B', '2025-02-08 11:28:19', '2025-02-08 21:02:35', NULL),
(156, 74, '2025-02-14', NULL, 'B', '2025-02-08 11:28:19', '2025-02-08 21:02:35', NULL),
(158, 74, '2025-02-15', NULL, 'B', '2025-02-08 20:57:58', '2025-02-08 21:02:35', '2025-02-08 21:02:35'),
(159, 75, '2025-02-10', 'Y', 'B', '2025-02-08 21:20:45', NULL, NULL),
(160, 75, '2025-02-11', 'Y', 'B', '2025-02-08 21:20:45', NULL, NULL),
(161, 75, '2025-02-12', 'Y', 'B', '2025-02-08 21:20:45', NULL, NULL),
(162, 75, '2025-02-13', 'Y', 'B', '2025-02-08 21:20:45', NULL, NULL),
(163, 75, '2025-02-14', 'Y', 'B', '2025-02-08 21:20:45', NULL, NULL),
(164, 76, '2025-02-17', 'Y', 'B', '2025-02-08 22:08:44', '2025-02-10 15:05:49', NULL),
(165, 76, '2025-02-18', 'Y', 'B', '2025-02-08 22:08:44', '2025-02-10 15:05:49', NULL),
(166, 76, '2025-02-19', 'Y', 'B', '2025-02-08 22:08:44', '2025-02-10 15:05:49', NULL),
(167, 76, '2025-02-20', 'Y', 'B', '2025-02-08 22:08:44', '2025-02-10 15:05:49', NULL),
(168, 76, '2025-02-21', 'Y', 'B', '2025-02-08 22:08:44', '2025-02-10 15:05:49', NULL),
(169, 76, '2025-02-28', 'Y', 'B', '2025-02-10 15:03:02', '2025-02-10 15:05:49', '2025-02-10 15:05:49'),
(170, 77, '2025-03-03', NULL, 'B', '2025-02-27 13:47:12', '2025-02-27 13:48:24', NULL),
(171, 77, '2025-03-04', NULL, 'B', '2025-02-27 13:47:12', '2025-02-27 13:48:24', NULL),
(172, 77, '2025-03-05', NULL, 'B', '2025-02-27 13:48:24', NULL, NULL),
(173, 77, '2025-03-06', NULL, 'B', '2025-02-27 13:48:24', NULL, NULL),
(174, 77, '2025-03-07', NULL, 'B', '2025-02-27 13:48:24', NULL, NULL),
(175, 78, '2025-03-03', 'Y', 'B', '2025-02-27 13:50:26', NULL, NULL),
(176, 78, '2025-03-04', 'Y', 'B', '2025-02-27 13:50:26', NULL, NULL),
(177, 78, '2025-03-05', 'Y', 'B', '2025-02-27 13:50:26', NULL, NULL),
(178, 78, '2025-03-06', 'Y', 'B', '2025-02-27 13:50:26', NULL, NULL),
(179, 78, '2025-03-07', 'Y', 'B', '2025-02-27 13:50:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `karbo`
--

CREATE TABLE `karbo` (
  `id_karbo` int(11) NOT NULL,
  `nama_karbo` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karbo`
--

INSERT INTO `karbo` (`id_karbo`, `nama_karbo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nasi Merah', '2024-08-06 19:03:48', '2024-08-06 19:03:48', NULL),
(2, 'Maspotato', '2024-08-06 19:03:48', '2024-08-06 19:03:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `masa_hari_batal`
--

CREATE TABLE `masa_hari_batal` (
  `id_masa_hari_batal` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `masa_hari` int(11) NOT NULL,
  `uang_dikembalikan` char(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masa_hari_batal`
--

INSERT INTO `masa_hari_batal` (`id_masa_hari_batal`, `id_pesanan`, `masa_hari`, `uang_dikembalikan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 159, 1, 'y', NULL, '2025-02-04 11:17:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `id_paket_menu` int(11) DEFAULT NULL,
  `id_karbo` int(11) DEFAULT NULL,
  `id_pack` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `harga_menu` int(11) DEFAULT NULL,
  `gambar_menu` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `id_paket_menu`, `id_karbo`, `id_pack`, `nama_menu`, `harga_menu`, `gambar_menu`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, NULL, NULL, 1, 'kangkung sambel', 13000, '1741507138_7663c9f00aad77ddb25b.jpg', '2024-08-08 03:53:50', '2025-03-09 14:58:58', NULL),
(3, 2, 1, 2, 'scrammble egg sambal oseng', NULL, NULL, '2024-08-08 04:20:55', '2024-08-08 05:36:56', NULL),
(4, NULL, NULL, 1, 'tes', 123, NULL, '2024-08-08 05:55:16', '2024-08-08 05:55:23', '2024-08-08 05:55:23'),
(5, 2, 2, 2, 'noodle sauce spicy', NULL, NULL, '2024-08-08 08:52:48', '2024-08-08 08:52:48', NULL),
(6, NULL, NULL, 1, 'ayam balado ', 13000, NULL, '2024-08-10 07:37:29', '2024-08-10 07:37:29', NULL),
(7, 1, 1, 2, 'nasi merah brokoli carrot', NULL, NULL, '2024-08-12 09:32:36', '2024-08-12 09:32:36', NULL),
(8, 1, 1, 2, 'pepes ayam jamur telur bakar, sambal Cah sawi putih wortel', NULL, NULL, '2024-09-03 11:30:26', '2024-09-03 11:30:26', NULL),
(9, 1, 1, 2, 'sapo tahu, udang asam manis, acar', NULL, NULL, '2024-09-03 11:31:23', '2024-09-03 11:31:23', NULL),
(10, 1, 1, 2, 'ayam Suwir daun jeruk, terong bakar Sambal blimbing, tempe bacem', NULL, NULL, '2024-09-03 11:31:45', '2024-09-03 11:31:45', NULL),
(11, 1, 1, 2, 'tongkol rica kemangi, oseng toge putih Telur, sambal', NULL, NULL, '2024-09-03 11:32:06', '2024-09-03 11:32:06', NULL),
(12, 1, 1, 2, 'Spaghetti mie kuah ayam kecap, Pokcoy, acar', NULL, NULL, '2024-09-03 11:32:44', '2024-09-03 11:32:44', NULL),
(13, 2, 1, 2, 'Steam corn, schotel kembang kol, stir fry bean, fruit, chilli sauce', NULL, NULL, '2024-09-03 11:33:29', '2024-09-03 11:33:29', NULL),
(14, 2, 2, 2, 'Chicken quesadillas, slice lettuce Deviled egg, fruit, chilli sauce', NULL, NULL, '2024-09-03 11:33:50', '2024-09-03 11:33:50', NULL),
(15, 2, 2, 2, 'Grill potato, salad and dressing salisbury steak champignon sauce, chilli sauce', NULL, NULL, '2024-09-03 11:34:08', '2024-09-03 11:34:08', NULL),
(16, 2, 2, 2, 'Chicken Tjapcae korea, buah telur suwir, acar', NULL, NULL, '2024-09-03 11:34:24', '2024-09-03 11:34:24', NULL),
(17, 2, 2, 2, 'Crouton, chicken creamy soup, Egg muffin broccoli, chilli sauce', NULL, NULL, '2024-09-03 11:34:41', '2024-09-03 11:34:41', NULL),
(18, NULL, NULL, 1, 'Pepes ayam jmaur telur', 38000, NULL, '2024-09-03 11:35:45', '2024-09-03 11:35:45', NULL),
(19, NULL, NULL, 1, 'Cah sawi putih wortel', 18000, NULL, '2024-09-03 11:36:08', '2024-09-03 11:36:08', NULL),
(20, NULL, NULL, 1, 'Schotel kembang kol', 30000, NULL, '2024-09-03 11:36:26', '2024-09-03 11:36:26', NULL),
(21, NULL, NULL, 1, 'Stir fry bean', 18000, NULL, '2024-09-03 11:36:50', '2024-09-03 11:36:50', NULL),
(22, NULL, NULL, 1, 'Sapo tahu', 25000, '1740981829_80300a7b4d9a3f62793d.jpg', '2024-09-03 11:37:09', '2025-03-03 13:03:49', NULL),
(23, NULL, NULL, 1, 'Udang asam manis', 40000, NULL, '2024-09-03 11:37:21', '2024-09-03 11:37:21', NULL),
(24, NULL, NULL, 1, 'Chicken quesadillas', 35000, NULL, '2024-09-03 11:37:38', '2024-09-03 11:37:38', NULL),
(25, NULL, NULL, 1, 'Slice lettuce and devilled.egg', 25000, NULL, '2024-09-03 11:38:45', '2024-09-03 11:38:45', NULL),
(26, NULL, NULL, 1, 'Ayam suwir daun jeruk', 38000, NULL, '2024-09-03 11:39:00', '2024-09-03 11:39:00', NULL),
(27, NULL, NULL, 1, 'Terong bakar sambal belimbing', 18000, NULL, '2024-09-03 11:39:17', '2024-09-03 11:39:17', NULL),
(28, NULL, NULL, 1, 'Salisbury steak champignon sauce', 38000, NULL, '2024-09-03 11:39:30', '2024-09-03 11:39:30', NULL),
(29, NULL, NULL, 1, 'Tongkol rica kemangi', 38000, NULL, '2024-09-03 11:39:45', '2024-09-03 11:39:45', NULL),
(30, NULL, NULL, 1, 'Oseng toge putih telur', 20000, NULL, '2024-09-03 11:40:03', '2024-09-03 11:40:03', NULL),
(31, NULL, NULL, 1, 'Chicken tjapcae korea', 35000, NULL, '2024-09-03 11:40:18', '2024-09-03 11:40:18', NULL),
(32, NULL, NULL, 1, 'Spaghetti mie kuah ayam kecap', 40000, NULL, '2024-09-03 11:40:29', '2024-09-03 11:40:29', NULL),
(33, NULL, NULL, 1, 'Chicken creamy soup with crouton', 40000, NULL, '2024-09-03 11:40:46', '2024-09-03 11:40:46', NULL),
(34, NULL, NULL, 1, 'Egg muffin broccoli', 25000, NULL, '2024-09-03 11:41:01', '2024-09-03 11:41:01', NULL),
(41, NULL, NULL, 1, 'tes123', 1111, '1738508117_e08bfb3707b06ed3e905.jpg', '2025-02-02 20:37:20', '2025-02-02 21:55:17', '2025-02-02 21:56:15'),
(42, 1, NULL, 2, 'tes', NULL, '1738503465_e8cdd0b9f6b5ed7ab5c3.jpg', '2025-02-02 20:37:45', NULL, '2025-02-02 21:56:09'),
(43, NULL, NULL, 1, 'qwe', 1, '1738506600_95ef4887e6b3c29ee1c7.jpg', '2025-02-02 21:30:00', NULL, '2025-02-02 21:56:02'),
(44, NULL, NULL, 1, 'sdf', 345345, '1741507191_30015755ec1d75632782.jpg', '2025-03-09 14:59:51', NULL, '2025-03-09 15:14:45'),
(45, NULL, NULL, 1, 'wer', 4564, '1741508231_6b2dfc0eb0060abee1b9.jpg', '2025-03-09 15:17:12', NULL, '2025-03-09 15:17:20'),
(46, NULL, NULL, 1, 'hdrth', 5467, '1741508300_61e7ba6ff8b0aea78158.jpg', '2025-03-09 15:18:20', NULL, '2025-03-09 15:18:26'),
(47, NULL, NULL, 1, 'tfyj', 678, '1741508482_8a559e61684639136648.jpg', '2025-03-09 15:21:22', NULL, '2025-03-09 15:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `menu_pesanan`
--

CREATE TABLE `menu_pesanan` (
  `id_menu_pesanan` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_jadwal_menu` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_pesanan`
--

INSERT INTO `menu_pesanan` (`id_menu_pesanan`, `id_pesanan`, `id_jadwal_menu`, `created_at`, `updated_at`, `deleted_at`) VALUES
(205, 152, 141, '2025-02-01 16:23:22', NULL, NULL),
(206, 152, 142, '2025-02-01 16:23:22', NULL, NULL),
(207, 152, 143, '2025-02-01 16:23:22', NULL, NULL),
(210, 154, 141, '2025-02-02 11:45:27', NULL, NULL),
(211, 154, 136, '2025-02-02 11:45:39', NULL, NULL),
(212, 155, 138, '2025-02-02 11:54:08', NULL, NULL),
(213, 156, 144, '2025-02-02 12:35:19', NULL, NULL),
(214, 156, 144, '2025-02-02 12:38:44', NULL, NULL),
(215, 156, 144, '2025-02-02 14:08:51', NULL, NULL),
(216, 156, 144, '2025-02-02 14:19:31', NULL, NULL),
(217, 156, 144, '2025-02-02 14:20:32', NULL, NULL),
(218, 156, 144, '2025-02-02 14:22:30', NULL, NULL),
(219, 156, 144, '2025-02-02 14:23:51', NULL, NULL),
(220, 156, 144, '2025-02-02 14:29:33', NULL, NULL),
(221, 156, 144, '2025-02-02 14:35:29', NULL, NULL),
(222, 156, 144, '2025-02-02 14:37:42', NULL, NULL),
(223, 156, 144, '2025-02-02 14:37:42', NULL, NULL),
(224, 156, 144, '2025-02-02 14:41:34', NULL, NULL),
(225, 156, 144, '2025-02-02 14:41:35', NULL, NULL),
(226, 156, 144, '2025-02-02 14:44:09', NULL, NULL),
(227, 156, 144, '2025-02-02 14:44:10', NULL, NULL),
(228, 156, 144, '2025-02-02 14:49:48', NULL, NULL),
(229, 156, 144, '2025-02-02 15:17:03', NULL, NULL),
(230, 156, 144, '2025-02-02 15:21:48', NULL, NULL),
(231, 156, 138, '2025-02-02 15:22:30', NULL, NULL),
(232, 156, 137, '2025-02-02 15:23:13', NULL, NULL),
(233, 156, 138, '2025-02-02 15:23:49', NULL, NULL),
(234, 157, 145, '2025-02-03 11:10:13', NULL, NULL),
(235, 157, 145, '2025-02-03 11:11:01', NULL, NULL),
(236, 157, 143, '2025-02-03 11:11:45', NULL, NULL),
(237, 158, 142, '2025-02-03 11:16:19', NULL, NULL),
(238, 158, 144, '2025-02-04 11:23:17', NULL, NULL),
(239, 159, 143, '2025-02-04 11:11:34', NULL, NULL),
(240, 159, 144, '2025-02-04 11:11:34', NULL, NULL),
(241, 159, 145, '2025-02-04 11:11:34', NULL, NULL),
(251, 159, 159, '2025-02-08 21:20:45', NULL, NULL),
(252, 159, 160, '2025-02-08 21:20:45', NULL, NULL),
(253, 159, 161, '2025-02-08 21:20:45', NULL, NULL),
(254, 159, 162, '2025-02-08 21:20:45', NULL, NULL),
(255, 159, 163, '2025-02-08 21:20:45', NULL, NULL),
(256, 159, 164, '2025-02-08 22:08:44', NULL, NULL),
(257, 159, 165, '2025-02-08 22:08:44', NULL, NULL),
(258, 160, 170, '2025-03-01 13:33:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `ongkir_kota` varchar(255) NOT NULL,
  `biaya_ongkir` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `ongkir_kota`, `biaya_ongkir`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Gresik', 5000, '2024-08-07 09:02:56', '2024-08-07 09:08:27', NULL),
(2, 'Sidoarjo', 2000, '2024-08-07 09:03:10', '2024-09-05 15:21:20', NULL),
(3, 'Tes', 123, '2024-08-07 09:09:51', '2024-08-07 09:11:49', '2024-08-07 09:11:49'),
(4, 'Surabaya', 1000, '2024-09-05 03:09:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pack`
--

CREATE TABLE `pack` (
  `id_pack` int(11) NOT NULL,
  `nama_pack` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pack`
--

INSERT INTO `pack` (`id_pack`, `nama_pack`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'family', '2024-08-06 19:05:27', '2024-08-06 19:05:27', NULL),
(2, 'personal', '2024-08-06 19:05:27', '2024-08-06 19:05:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `paket_menu`
--

CREATE TABLE `paket_menu` (
  `id_paket_menu` int(11) NOT NULL,
  `nama_paket_menu` varchar(255) NOT NULL,
  `harga_paket_menu` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket_menu`
--

INSERT INTO `paket_menu` (`id_paket_menu`, `nama_paket_menu`, `harga_paket_menu`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'lunch', 50000, '2024-08-06 12:46:36', '2024-08-06 13:41:12', NULL),
(2, 'dinner', 40000, '2024-08-06 12:49:09', '2024-08-06 17:49:11', NULL),
(4, 'infuse', 10000, '2024-08-06 14:01:37', '2024-08-06 19:23:34', NULL),
(5, 'Tes', 123, '2024-08-06 18:52:41', '2024-08-06 18:59:01', '2024-08-06 18:59:01'),
(6, 'Tes', 321, '2024-08-06 19:07:20', '2024-08-06 19:07:30', '2024-08-06 19:07:30'),
(7, 'rtw', 5555, '2024-09-05 16:36:37', '2024-09-05 16:36:44', '2024-09-05 16:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `alamat_pelanggan` varchar(255) NOT NULL,
  `notelp_pelanggan` char(15) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_ongkir`, `nama_pelanggan`, `alamat_pelanggan`, `notelp_pelanggan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 2, 'agus', 'jl.nanas 12', '987654321', '2024-09-05 18:14:38', '2024-09-06 18:39:33', NULL),
(5, 4, 'irfan', 'jl.semangka 90', '123456789', '2024-09-10 15:56:57', NULL, NULL),
(6, 4, 'agus', 'peneleh', '08573456789', '2025-01-31 18:43:51', NULL, NULL),
(7, 1, 'bima', 'jl. banyumas no 13', '12345678909', '2025-02-01 12:03:01', NULL, NULL),
(8, 1, 'sara', 'jl. semarang no 14', '085345678345', '2025-02-02 21:59:53', '2025-02-02 22:00:44', NULL),
(9, 4, 'andy', 'tenggilis lama 4a no.8', '089611475102', '2025-02-03 11:08:52', NULL, NULL),
(10, 4, 'dina', 'perum. permai indah', '0817864598543', '2025-02-27 13:52:09', NULL, NULL),
(11, 4, 'fajar', 'perum. indah sari blok m/12', '085678434564', '2025-03-01 13:33:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_tipe_pembayaran` int(11) DEFAULT NULL,
  `id_transaksi` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_tipe_pembayaran`, `id_transaksi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(27, 2, 30, '2025-02-01 16:23:22', NULL, NULL),
(29, 2, 32, '2025-02-02 11:46:21', NULL, NULL),
(30, 2, 33, '2025-02-02 11:56:02', NULL, NULL),
(31, 2, 34, '2025-02-02 15:24:56', NULL, NULL),
(32, 2, 35, '2025-02-03 11:14:37', NULL, NULL),
(33, 2, 36, '2025-02-04 11:11:34', NULL, NULL),
(34, 2, 37, '2025-03-01 13:34:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_catatan_pesanan` int(11) DEFAULT NULL,
  `id_akun` int(11) NOT NULL,
  `approved` char(1) DEFAULT NULL,
  `masa_hari_batal` int(11) DEFAULT NULL,
  `berhenti_paketan` char(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_catatan_pesanan`, `id_akun`, `approved`, `masa_hari_batal`, `berhenti_paketan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(152, 31, 4, 'y', NULL, NULL, '2025-02-01 16:23:22', '2025-02-02 15:51:16', NULL),
(154, NULL, 4, 'y', NULL, NULL, '2025-02-02 11:45:27', '2025-02-02 15:51:36', NULL),
(155, NULL, 4, NULL, NULL, NULL, '2025-02-02 11:54:08', NULL, NULL),
(156, NULL, 4, NULL, NULL, NULL, '2025-02-02 12:35:19', NULL, NULL),
(157, NULL, 6, NULL, NULL, NULL, '2025-02-03 11:10:13', NULL, NULL),
(158, NULL, 6, NULL, NULL, NULL, '2025-02-03 11:16:19', NULL, NULL),
(159, 32, 4, 'y', NULL, NULL, '2025-02-04 11:11:34', '2025-02-04 11:12:15', NULL),
(160, NULL, 8, NULL, NULL, NULL, '2025-03-01 13:33:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_tunda`
--

CREATE TABLE `pesanan_tunda` (
  `id_detail_menu_pesanan` int(11) NOT NULL,
  `tanggal_baru_pesanan` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id_review` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_menu_pesanan` int(11) DEFAULT NULL,
  `keterangan_review` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `status_detail_menu_pesanan`
--

CREATE TABLE `status_detail_menu_pesanan` (
  `id_detail_menu_pesanan` int(11) NOT NULL,
  `id_status_pesanan` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_detail_menu_pesanan`
--

INSERT INTO `status_detail_menu_pesanan` (`id_detail_menu_pesanan`, `id_status_pesanan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(371, 6, '2025-02-01 16:23:22', '2025-02-03 12:07:02', NULL),
(372, 6, '2025-02-01 16:23:22', '2025-02-03 12:07:02', NULL),
(373, 6, '2025-02-01 16:23:22', '2025-02-04 11:07:43', NULL),
(374, 6, '2025-02-01 16:23:22', '2025-02-04 11:07:43', NULL),
(375, 2, '2025-02-01 16:23:22', NULL, NULL),
(376, 2, '2025-02-01 16:23:22', NULL, NULL),
(382, 6, '2025-02-02 11:45:27', '2025-02-03 12:07:02', NULL),
(383, 6, '2025-02-02 11:45:27', '2025-02-03 12:07:02', NULL),
(384, 6, '2025-02-02 11:45:27', '2025-02-03 12:07:02', NULL),
(385, 6, '2025-02-02 11:45:40', '2025-02-03 12:07:02', NULL),
(386, 6, '2025-02-02 11:45:40', '2025-02-03 12:07:02', NULL),
(387, 4, '2025-02-02 11:54:08', '2025-02-04 11:16:25', NULL),
(388, 4, '2025-02-02 11:54:08', '2025-02-04 11:16:25', NULL),
(389, 2, '2025-02-02 12:35:19', '2025-02-02 15:24:56', NULL),
(390, 2, '2025-02-02 12:35:19', '2025-02-02 15:24:56', NULL),
(391, 2, '2025-02-02 12:38:44', '2025-02-02 15:24:56', NULL),
(392, 2, '2025-02-02 12:38:44', '2025-02-02 15:24:56', NULL),
(393, 2, '2025-02-02 14:08:51', '2025-02-02 15:24:56', NULL),
(394, 2, '2025-02-02 14:08:51', '2025-02-02 15:24:56', NULL),
(395, 2, '2025-02-02 14:19:31', '2025-02-02 15:24:56', NULL),
(396, 2, '2025-02-02 14:19:31', '2025-02-02 15:24:56', NULL),
(397, 2, '2025-02-02 14:20:32', '2025-02-02 15:24:56', NULL),
(398, 2, '2025-02-02 14:20:32', '2025-02-02 15:24:56', NULL),
(399, 2, '2025-02-02 14:22:30', '2025-02-02 15:24:56', NULL),
(400, 2, '2025-02-02 14:22:30', '2025-02-02 15:24:56', NULL),
(401, 2, '2025-02-02 14:23:51', '2025-02-02 15:24:56', NULL),
(402, 2, '2025-02-02 14:23:51', '2025-02-02 15:24:56', NULL),
(403, 2, '2025-02-02 14:29:33', '2025-02-02 15:24:56', NULL),
(404, 2, '2025-02-02 14:29:33', '2025-02-02 15:24:56', NULL),
(405, 2, '2025-02-02 14:35:30', '2025-02-02 15:24:56', NULL),
(406, 2, '2025-02-02 14:37:42', '2025-02-02 15:24:56', NULL),
(407, 2, '2025-02-02 14:37:42', '2025-02-02 15:24:56', NULL),
(408, 2, '2025-02-02 14:37:42', '2025-02-02 15:24:56', NULL),
(409, 2, '2025-02-02 14:41:34', '2025-02-02 15:24:56', NULL),
(410, 2, '2025-02-02 14:41:35', '2025-02-02 15:24:56', NULL),
(411, 2, '2025-02-02 14:41:35', '2025-02-02 15:24:56', NULL),
(412, 2, '2025-02-02 14:44:09', '2025-02-02 15:24:56', NULL),
(413, 2, '2025-02-02 14:44:10', '2025-02-02 15:24:56', NULL),
(414, 2, '2025-02-02 14:44:10', '2025-02-02 15:24:56', NULL),
(415, 2, '2025-02-02 14:49:48', '2025-02-02 15:24:56', NULL),
(416, 2, '2025-02-02 14:49:48', '2025-02-02 15:24:56', NULL),
(417, 2, '2025-02-02 14:49:48', '2025-02-02 15:24:56', NULL),
(418, 2, '2025-02-02 15:17:03', '2025-02-02 15:24:56', NULL),
(419, 2, '2025-02-02 15:17:03', '2025-02-02 15:24:56', NULL),
(420, 2, '2025-02-02 15:17:03', '2025-02-02 15:24:56', NULL),
(421, 2, '2025-02-02 15:21:48', '2025-02-02 15:24:56', NULL),
(422, 2, '2025-02-02 15:21:48', '2025-02-02 15:24:56', NULL),
(423, 2, '2025-02-02 15:21:48', '2025-02-02 15:24:56', NULL),
(424, 2, '2025-02-02 15:22:31', '2025-02-02 15:24:56', NULL),
(425, 2, '2025-02-02 15:23:13', '2025-02-02 15:24:56', NULL),
(426, 2, '2025-02-02 15:23:49', '2025-02-02 15:24:56', NULL),
(427, 2, '2025-02-03 11:10:13', '2025-02-03 11:14:37', NULL),
(428, 2, '2025-02-03 11:11:01', '2025-02-03 11:14:37', NULL),
(429, 2, '2025-02-03 11:11:45', '2025-02-03 11:14:37', NULL),
(430, 2, '2025-02-03 11:11:45', '2025-02-03 11:14:37', NULL),
(431, 1, '2025-02-03 11:16:19', NULL, NULL),
(432, 1, '2025-02-04 11:23:17', NULL, NULL),
(433, 2, '2025-02-04 11:11:34', NULL, NULL),
(434, 2, '2025-02-04 11:11:34', NULL, NULL),
(435, 2, '2025-02-04 11:11:34', NULL, NULL),
(436, 2, '2025-02-04 11:11:34', NULL, NULL),
(437, 2, '2025-02-04 11:11:34', NULL, NULL),
(438, 2, '2025-02-04 11:11:34', NULL, NULL),
(453, 2, '2025-02-08 21:20:45', NULL, NULL),
(454, 2, '2025-02-08 21:20:45', NULL, NULL),
(455, 2, '2025-02-08 21:20:45', NULL, NULL),
(456, 2, '2025-02-08 21:20:45', NULL, NULL),
(457, 2, '2025-02-08 21:20:45', NULL, NULL),
(458, 2, '2025-02-08 21:20:45', NULL, NULL),
(459, 2, '2025-02-08 21:20:45', NULL, NULL),
(460, 2, '2025-02-08 21:20:45', NULL, NULL),
(461, 2, '2025-02-08 21:20:45', NULL, NULL),
(462, 2, '2025-02-08 21:20:45', NULL, NULL),
(463, 2, '2025-02-08 22:08:44', NULL, NULL),
(464, 2, '2025-02-08 22:08:44', NULL, NULL),
(465, 2, '2025-02-08 22:08:44', NULL, NULL),
(466, 2, '2025-02-08 22:08:44', NULL, NULL),
(467, 2, '2025-03-01 13:33:46', '2025-03-01 13:34:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status_pesanan`
--

CREATE TABLE `status_pesanan` (
  `id_status_pesanan` int(11) NOT NULL,
  `keterangan_status` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_pesanan`
--

INSERT INTO `status_pesanan` (`id_status_pesanan`, `keterangan_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'dikeranjang', '2024-09-11 09:48:04', NULL, NULL),
(2, 'terbayar', '2024-09-24 09:44:51', NULL, NULL),
(4, 'batal', '2024-09-11 09:48:18', NULL, NULL),
(5, 'dikirim', '2024-09-11 09:48:18', NULL, NULL),
(6, 'diterima', '2024-09-11 09:48:18', NULL, NULL),
(7, 'lunas', '2024-09-11 09:48:18', NULL, NULL),
(8, 'belum lunas', '2024-09-11 09:48:18', NULL, NULL),
(9, 'berhenti paketan', '2024-09-11 09:48:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_pembayaran`
--

CREATE TABLE `tipe_pembayaran` (
  `id_tipe_pembayaran` int(11) NOT NULL,
  `tipe_pembayaran` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipe_pembayaran`
--

INSERT INTO `tipe_pembayaran` (`id_tipe_pembayaran`, `tipe_pembayaran`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'lunas', '2025-02-01 16:19:43', '2025-02-01 10:19:42', '2025-02-01 10:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `alamat_pengiriman` varchar(150) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pesanan`, `tanggal_transaksi`, `id_ongkir`, `alamat_pengiriman`, `created_at`, `updated_at`, `deleted_at`) VALUES
(30, 152, '2025-02-01 16:23:22', 1, 'jl. banyumas no 13', '2025-02-01 16:23:22', NULL, NULL),
(32, 154, '2025-02-02 11:46:21', 1, 'jl. banyumas no 13', '2025-02-02 11:46:21', NULL, NULL),
(33, 155, '2025-02-02 11:56:02', 4, 'jl. banyumas no 13', '2025-02-02 11:56:02', NULL, NULL),
(34, 156, '2025-02-02 15:24:56', 1, 'jl. banyumas no 13', '2025-02-02 15:24:56', NULL, NULL),
(35, 157, '2025-02-03 11:14:37', 4, 'tenggilis lama 4a no.8', '2025-02-03 11:14:37', NULL, NULL),
(36, 159, '2025-02-04 11:11:34', 1, 'jl. banyumas no 13', '2025-02-04 11:11:34', NULL, NULL),
(37, 160, '2025-03-01 13:34:41', 4, 'perum. indah sari blok m/12', '2025-03-01 13:34:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tunda_pesanan`
--

CREATE TABLE `tunda_pesanan` (
  `id_tunda_pesanan` int(11) NOT NULL,
  `id_menu_pesanan` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `jumlah_tunda` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tunda_pesanan`
--

INSERT INTO `tunda_pesanan` (`id_tunda_pesanan`, `id_menu_pesanan`, `id_pesanan`, `jumlah_tunda`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 241, 159, 1, '2025-02-04 11:18:00', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD UNIQUE KEY `id_pelanggan` (`id_pelanggan`),
  ADD UNIQUE KEY `username_akun` (`username_akun`);

--
-- Indexes for table `catatan_pesanan`
--
ALTER TABLE `catatan_pesanan`
  ADD PRIMARY KEY (`id_catatan_pesanan`),
  ADD KEY `id_karbo` (`id_karbo`);

--
-- Indexes for table `detail_catatan`
--
ALTER TABLE `detail_catatan`
  ADD PRIMARY KEY (`id_detail_catatan`),
  ADD KEY `id_catatan_pesanan` (`id_catatan_pesanan`),
  ADD KEY `id_paket_menu` (`id_paket_menu`);

--
-- Indexes for table `detail_jadwal_menu`
--
ALTER TABLE `detail_jadwal_menu`
  ADD PRIMARY KEY (`id_detail_jadwal_menu`),
  ADD KEY `id_jadwal_menu` (`id_jadwal_menu`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `detail_menu_pesanan`
--
ALTER TABLE `detail_menu_pesanan`
  ADD PRIMARY KEY (`id_detail_menu_pesanan`),
  ADD KEY `id_karbo` (`id_karbo`),
  ADD KEY `id_pesanan` (`id_menu_pesanan`),
  ADD KEY `id_detail_jadwal_menu` (`id_detail_jadwal_menu`);

--
-- Indexes for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  ADD PRIMARY KEY (`id_detail_pembayaran`),
  ADD KEY `id_pembayaran` (`id_pembayaran`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `jadwal_menu`
--
ALTER TABLE `jadwal_menu`
  ADD PRIMARY KEY (`id_jadwal_menu`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `karbo`
--
ALTER TABLE `karbo`
  ADD PRIMARY KEY (`id_karbo`);

--
-- Indexes for table `masa_hari_batal`
--
ALTER TABLE `masa_hari_batal`
  ADD PRIMARY KEY (`id_masa_hari_batal`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_paket_menu` (`id_paket_menu`),
  ADD KEY `id_karbo` (`id_karbo`),
  ADD KEY `id_pack` (`id_pack`);

--
-- Indexes for table `menu_pesanan`
--
ALTER TABLE `menu_pesanan`
  ADD PRIMARY KEY (`id_menu_pesanan`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_jadwal_menu` (`id_jadwal_menu`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pack`
--
ALTER TABLE `pack`
  ADD PRIMARY KEY (`id_pack`);

--
-- Indexes for table `paket_menu`
--
ALTER TABLE `paket_menu`
  ADD PRIMARY KEY (`id_paket_menu`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `id_ongkir` (`id_ongkir`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_tipe_pembayaran` (`id_tipe_pembayaran`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_catatan_pesanan` (`id_catatan_pesanan`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `pesanan_tunda`
--
ALTER TABLE `pesanan_tunda`
  ADD KEY `id_detail_pesanan` (`id_detail_menu_pesanan`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_jadwal_menu` (`id_menu_pesanan`);

--
-- Indexes for table `status_detail_menu_pesanan`
--
ALTER TABLE `status_detail_menu_pesanan`
  ADD KEY `id_detail_pesanan` (`id_detail_menu_pesanan`),
  ADD KEY `id_status_pesanan` (`id_status_pesanan`);

--
-- Indexes for table `status_pesanan`
--
ALTER TABLE `status_pesanan`
  ADD PRIMARY KEY (`id_status_pesanan`);

--
-- Indexes for table `tipe_pembayaran`
--
ALTER TABLE `tipe_pembayaran`
  ADD PRIMARY KEY (`id_tipe_pembayaran`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_akun` (`id_pesanan`),
  ADD KEY `id_ongkir` (`id_ongkir`);

--
-- Indexes for table `tunda_pesanan`
--
ALTER TABLE `tunda_pesanan`
  ADD PRIMARY KEY (`id_tunda_pesanan`),
  ADD KEY `id_jadwal_menu` (`id_menu_pesanan`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `catatan_pesanan`
--
ALTER TABLE `catatan_pesanan`
  MODIFY `id_catatan_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `detail_catatan`
--
ALTER TABLE `detail_catatan`
  MODIFY `id_detail_catatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `detail_jadwal_menu`
--
ALTER TABLE `detail_jadwal_menu`
  MODIFY `id_detail_jadwal_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;

--
-- AUTO_INCREMENT for table `detail_menu_pesanan`
--
ALTER TABLE `detail_menu_pesanan`
  MODIFY `id_detail_menu_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=468;

--
-- AUTO_INCREMENT for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  MODIFY `id_detail_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `jadwal_menu`
--
ALTER TABLE `jadwal_menu`
  MODIFY `id_jadwal_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `karbo`
--
ALTER TABLE `karbo`
  MODIFY `id_karbo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `masa_hari_batal`
--
ALTER TABLE `masa_hari_batal`
  MODIFY `id_masa_hari_batal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `menu_pesanan`
--
ALTER TABLE `menu_pesanan`
  MODIFY `id_menu_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pack`
--
ALTER TABLE `pack`
  MODIFY `id_pack` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paket_menu`
--
ALTER TABLE `paket_menu`
  MODIFY `id_paket_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `status_pesanan`
--
ALTER TABLE `status_pesanan`
  MODIFY `id_status_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tipe_pembayaran`
--
ALTER TABLE `tipe_pembayaran`
  MODIFY `id_tipe_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tunda_pesanan`
--
ALTER TABLE `tunda_pesanan`
  MODIFY `id_tunda_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `akun_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Constraints for table `catatan_pesanan`
--
ALTER TABLE `catatan_pesanan`
  ADD CONSTRAINT `catatan_pesanan_ibfk_1` FOREIGN KEY (`id_karbo`) REFERENCES `karbo` (`id_karbo`);

--
-- Constraints for table `detail_catatan`
--
ALTER TABLE `detail_catatan`
  ADD CONSTRAINT `detail_catatan_ibfk_1` FOREIGN KEY (`id_paket_menu`) REFERENCES `paket_menu` (`id_paket_menu`),
  ADD CONSTRAINT `detail_catatan_ibfk_2` FOREIGN KEY (`id_catatan_pesanan`) REFERENCES `catatan_pesanan` (`id_catatan_pesanan`);

--
-- Constraints for table `detail_jadwal_menu`
--
ALTER TABLE `detail_jadwal_menu`
  ADD CONSTRAINT `detail_jadwal_menu_ibfk_1` FOREIGN KEY (`id_jadwal_menu`) REFERENCES `jadwal_menu` (`id_jadwal_menu`),
  ADD CONSTRAINT `detail_jadwal_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);

--
-- Constraints for table `detail_menu_pesanan`
--
ALTER TABLE `detail_menu_pesanan`
  ADD CONSTRAINT `detail_menu_pesanan_ibfk_2` FOREIGN KEY (`id_karbo`) REFERENCES `karbo` (`id_karbo`),
  ADD CONSTRAINT `detail_menu_pesanan_ibfk_3` FOREIGN KEY (`id_detail_jadwal_menu`) REFERENCES `detail_jadwal_menu` (`id_detail_jadwal_menu`),
  ADD CONSTRAINT `detail_menu_pesanan_ibfk_4` FOREIGN KEY (`id_menu_pesanan`) REFERENCES `menu_pesanan` (`id_menu_pesanan`);

--
-- Constraints for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  ADD CONSTRAINT `detail_pembayaran_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`),
  ADD CONSTRAINT `detail_pembayaran_ibfk_2` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id_pembayaran`);

--
-- Constraints for table `jadwal_menu`
--
ALTER TABLE `jadwal_menu`
  ADD CONSTRAINT `jadwal_menu_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`);

--
-- Constraints for table `masa_hari_batal`
--
ALTER TABLE `masa_hari_batal`
  ADD CONSTRAINT `masa_hari_batal_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_pack`) REFERENCES `pack` (`id_pack`),
  ADD CONSTRAINT `menu_ibfk_2` FOREIGN KEY (`id_karbo`) REFERENCES `karbo` (`id_karbo`),
  ADD CONSTRAINT `menu_ibfk_3` FOREIGN KEY (`id_paket_menu`) REFERENCES `paket_menu` (`id_paket_menu`);

--
-- Constraints for table `menu_pesanan`
--
ALTER TABLE `menu_pesanan`
  ADD CONSTRAINT `menu_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`),
  ADD CONSTRAINT `menu_pesanan_ibfk_2` FOREIGN KEY (`id_jadwal_menu`) REFERENCES `jadwal_menu` (`id_jadwal_menu`);

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`id_ongkir`) REFERENCES `ongkir` (`id_ongkir`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_tipe_pembayaran`) REFERENCES `tipe_pembayaran` (`id_tipe_pembayaran`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`),
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`id_catatan_pesanan`) REFERENCES `catatan_pesanan` (`id_catatan_pesanan`);

--
-- Constraints for table `pesanan_tunda`
--
ALTER TABLE `pesanan_tunda`
  ADD CONSTRAINT `pesanan_tunda_ibfk_1` FOREIGN KEY (`id_detail_menu_pesanan`) REFERENCES `detail_menu_pesanan` (`id_detail_menu_pesanan`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_menu_pesanan`) REFERENCES `menu_pesanan` (`id_menu_pesanan`);

--
-- Constraints for table `status_detail_menu_pesanan`
--
ALTER TABLE `status_detail_menu_pesanan`
  ADD CONSTRAINT `status_detail_menu_pesanan_ibfk_1` FOREIGN KEY (`id_detail_menu_pesanan`) REFERENCES `detail_menu_pesanan` (`id_detail_menu_pesanan`),
  ADD CONSTRAINT `status_detail_menu_pesanan_ibfk_2` FOREIGN KEY (`id_status_pesanan`) REFERENCES `status_pesanan` (`id_status_pesanan`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_ongkir`) REFERENCES `ongkir` (`id_ongkir`);

--
-- Constraints for table `tunda_pesanan`
--
ALTER TABLE `tunda_pesanan`
  ADD CONSTRAINT `tunda_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`),
  ADD CONSTRAINT `tunda_pesanan_ibfk_2` FOREIGN KEY (`id_menu_pesanan`) REFERENCES `menu_pesanan` (`id_menu_pesanan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

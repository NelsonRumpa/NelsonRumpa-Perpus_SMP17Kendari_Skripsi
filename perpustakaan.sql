-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 02:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `rak_id` bigint(20) UNSIGNED NOT NULL,
  `ISBN` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun_terbit` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `cover`, `kategori_id`, `rak_id`, `ISBN`, `jumlah`, `penulis`, `penerbit`, `tahun_terbit`, `created_at`, `updated_at`) VALUES
(1, 'Bahasa Indonesia kelas 8', 'http://127.0.0.1:8000/storage/cover/8M8zj8O2aOhTfQdzaMXI2Gvd5TzslUwMF8Fr2XMR.png', 1, 1, '978-602-1530-84-9', '34', 'E. Kosasih', 'Pusat Kurikulum dan Perbukuan, Balitbang, Kemendikbud', '2017', '2024-12-09 04:04:56', '2025-01-06 19:18:04'),
(2, 'Bahasa Inggris', 'http://127.0.0.1:8000/storage/cover/eniroMgFGh8whFE91ozz1eukh61DyWqig3fTU6Iq.jpg', 1, 1, '978-602-1530-84-8', '86', 'Ruslan', 'Pusat Kurikulum dan Perbukuan, Balitbang, Kemendikbud', '2017', '2024-12-09 04:11:31', '2025-01-07 23:42:27'),
(3, 'Bahasa Korea', 'http://127.0.0.1:8000/storage/cover/Qt8TNFfonEfCwVMVRhl8MjVBbKE4Wyk05FjDoqXJ.jpg', 1, 1, '9786026183118', '28', 'Setiawan Agung', 'Cemerlang Publishing', '2016', '2024-12-09 04:40:45', '2025-01-06 19:15:49');

-- --------------------------------------------------------

--
-- Table structure for table `dtl_peminjaman`
--

CREATE TABLE `dtl_peminjaman` (
  `peminjaman_id` varchar(255) NOT NULL,
  `buku_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_returned` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dtl_peminjaman`
--

INSERT INTO `dtl_peminjaman` (`peminjaman_id`, `buku_id`, `jumlah`, `created_at`, `updated_at`, `is_returned`) VALUES
('PSS-202410-154', 1, 1, '2024-12-09 15:50:14', '2024-12-09 15:50:14', 0),
('PSS-202410-154', 3, 1, '2024-12-09 15:50:14', '2024-12-09 15:50:14', 1),
('PSS-202413-011', 1, 1, '2024-12-12 21:20:42', '2024-12-12 21:20:42', 0),
('PSS-202413-017', 2, 1, '2024-12-12 21:31:37', '2024-12-12 21:31:37', 0),
('PG-202418-053', 1, 1, '2024-12-17 20:40:04', '2024-12-17 20:40:04', 0),
('PG-202418-053', 2, 1, '2024-12-17 20:40:04', '2024-12-17 20:40:04', 0),
('PSS-202411-002', 1, 1, '2024-12-17 20:42:24', '2024-12-17 20:42:24', 0),
('PSS-202411-002', 2, 1, '2024-12-17 20:42:24', '2024-12-17 20:42:24', 0),
('PSS-202418-080', 1, 1, '2024-12-17 21:00:05', '2024-12-17 21:00:05', 0),
('PSS-202418-080', 2, 1, '2024-12-17 21:00:05', '2024-12-17 21:00:05', 0),
('PSS-202418-033', 1, 1, '2024-12-17 23:32:34', '2024-12-17 23:32:34', 0),
('PSS-202418-033', 2, 1, '2024-12-17 23:32:34', '2024-12-17 23:32:34', 0),
('PSS-202418-035', 1, 1, '2024-12-17 23:34:58', '2024-12-17 23:34:58', 0),
('PSS-202418-035', 2, 1, '2024-12-17 23:34:58', '2024-12-17 23:34:58', 0),
('PSS-202418-035', 3, 1, '2024-12-17 23:34:58', '2024-12-17 23:34:58', 0),
('PSS-202418-034', 1, 1, '2024-12-17 23:40:09', '2024-12-17 23:40:09', 0),
('PSS-202418-034', 2, 1, '2024-12-17 23:40:09', '2024-12-17 23:40:09', 1),
('PSS-202418-034', 3, 1, '2024-12-17 23:40:09', '2024-12-17 23:40:09', 0),
('PG-202418-044', 1, 1, '2024-12-17 23:43:51', '2024-12-17 23:43:51', 0),
('PK-202418-046', 3, 20, '2024-12-17 23:46:33', '2024-12-17 23:46:33', 0),
('PSS-202507-012', 2, 1, '2025-01-06 18:27:20', '2025-01-06 18:27:20', 0),
('PSS-202507-014', 2, 1, '2025-01-06 18:28:38', '2025-01-06 18:28:38', 0),
('PSS-202507-030', 1, 1, '2025-01-06 19:15:49', '2025-01-06 19:15:49', 0),
('PSS-202507-030', 3, 1, '2025-01-06 19:15:49', '2025-01-06 19:15:49', 0),
('PSS-202507-032', 1, 1, '2025-01-06 19:18:04', '2025-01-06 19:18:04', 0),
('PSS-202507-032', 2, 1, '2025-01-06 19:18:04', '2025-01-06 19:18:04', 0),
('PSS-202507-037', 2, 1, '2025-01-06 19:25:08', '2025-01-06 19:25:08', 0),
('PSS-202507-041', 2, 1, '2025-01-06 19:31:20', '2025-01-06 19:31:20', 0),
('PSS-202507-044', 2, 1, '2025-01-06 19:35:36', '2025-01-06 19:35:36', 0),
('PSS-202508-002', 2, 1, '2025-01-07 23:42:15', '2025-01-07 23:42:15', 0),
('PSS-202508-003', 2, 1, '2025-01-07 23:42:27', '2025-01-07 23:42:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama`, `created_at`, `updated_at`) VALUES
('G-0000001', 'Yuliana S.Pd', '2024-12-09 03:56:04', '2024-12-09 03:56:04'),
('G-0000002', 'Asnawati S.Pd', '2024-12-09 13:35:56', '2024-12-09 13:35:56'),
('G-0000003', 'Suhardin S.Pd', '2024-12-09 13:36:08', '2024-12-09 13:36:08'),
('G-0000004', 'Ahmad Fauzi, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000005', 'Budi Hartono, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000006', 'Citra Anggraini, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000007', 'Dewi Sulastri, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000008', 'Eko Setiawan, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000009', 'Farhan Alamsyah, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000010', 'Gina Sari, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000011', 'Hadi Wijaya, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000012', 'Irma Mulyani, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000013', 'Joko Prabowo, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000014', 'Kartika Wijaya, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000015', 'Lukman Hakim, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000016', 'Maya Kusuma, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000017', 'Nina Yuliana, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000018', 'Omar Fadillah, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000019', 'Putri Wulandari, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000020', 'Rudi Santoso, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000021', 'Sari Pratiwi, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000022', 'Tari Kusumaningrum, S.Pd', '2024-12-18 03:33:04', NULL),
('G-0000023', 'Vela Rheandita, S.Pd', '2024-12-17 20:33:41', '2024-12-17 20:33:41'),
('G-0000024', 'Kristian, S.Pd', '2024-12-17 23:31:19', '2024-12-17 23:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kat` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kat`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Bahasa', '2024-12-09 03:56:32', '2024-12-12 01:52:19'),
(2, 'Filsafat', '2024-12-09 11:35:59', '2024-12-09 11:35:59'),
(3, 'Teknologi', '2024-12-09 11:36:22', '2024-12-09 11:36:22'),
(4, 'IPA', '2024-12-17 23:25:02', '2024-12-17 23:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `kunjungan`
--

CREATE TABLE `kunjungan` (
  `id_kunjungan` char(255) NOT NULL,
  `siswa_ku` varchar(255) DEFAULT NULL,
  `guru_ku` varchar(255) DEFAULT NULL,
  `kelas` char(255) DEFAULT NULL,
  `tujuan` varchar(255) NOT NULL,
  `buku_ku` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kunjungan`
--

INSERT INTO `kunjungan` (`id_kunjungan`, `siswa_ku`, `guru_ku`, `kelas`, `tujuan`, `buku_ku`, `keterangan`, `created_at`, `updated_at`) VALUES
('KG-202410-183', NULL, NULL, NULL, 'Menulis', NULL, NULL, '2024-12-09 16:46:21', '2024-12-09 16:46:21'),
('KS-202409-023', 'S-0000001', NULL, '7.1', 'Membaca', '2', NULL, '2024-12-09 04:36:28', '2024-12-09 04:36:28'),
('KS-202418-051', 'S-0000004', NULL, '7.3', 'Membaca', '1', NULL, '2024-12-17 23:49:48', '2024-12-17 23:49:48');

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
(1, '2024_11_29_192948_users', 1),
(2, '2024_10_01_220116_kategori', 2),
(3, '2024_10_02_102051_rakbuku', 3),
(4, '2024_10_02_152542_buku', 4),
(5, '2024_10_07_090045_siswa', 5),
(6, '2024_10_07_125002_guru', 6),
(7, '2024_10_06_194115_peminjaman', 7),
(8, '2024_11_27_100743_dtl_peminjaman', 8),
(9, '2024_11_27_195133_kunjungan', 9);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` varchar(255) NOT NULL,
  `siswa_id` varchar(255) DEFAULT NULL,
  `guru_id` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `siswa_id`, `guru_id`, `kelas`, `tgl_pinjam`, `tgl_kembali`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
('PG-202418-044', NULL, 'G-0000009', NULL, '2024-12-18', NULL, NULL, 'Dipinjam', '2024-12-17 23:43:51', '2024-12-17 23:43:51'),
('PG-202418-053', NULL, 'G-0000004', NULL, '2024-12-18', NULL, NULL, 'Dipinjam', '2024-12-17 20:39:07', '2024-12-17 20:39:07'),
('PK-202418-046', NULL, NULL, '7.5', '2024-12-18', NULL, 'Hasnwati', 'Dipinjam', '2024-12-17 23:46:33', '2024-12-17 23:46:33'),
('PSS-202410-154', 'S-0000001', NULL, NULL, '2024-12-10', '2024-12-13', NULL, 'Dikembalikan', '2024-12-09 15:09:01', '2024-12-09 15:51:30'),
('PSS-202411-002', 'S-0000001', NULL, NULL, '2024-12-18', '2025-12-18', 'bababababbabababa', 'Dipinjam', '2024-12-11 02:37:51', '2024-12-17 20:42:24'),
('PSS-202413-011', 'S-0000001', NULL, NULL, '2024-12-13', '2024-12-16', NULL, 'Dikembalikan', '2024-12-12 21:20:42', '2024-12-12 21:20:54'),
('PSS-202413-017', 'S-0000001', NULL, NULL, '2024-12-12', '2024-12-15', NULL, 'Dipinjam', '2024-12-12 21:31:37', '2024-12-12 21:31:37'),
('PSS-202418-033', 'S-0000017', NULL, NULL, '2024-12-18', '2024-12-21', NULL, 'Dipinjam', '2024-12-17 23:32:34', '2024-12-17 23:32:34'),
('PSS-202418-034', 'S-0000011', NULL, NULL, '2024-12-18', '2024-12-21', NULL, 'Dipinjam', '2024-12-17 23:33:48', '2024-12-17 23:33:48'),
('PSS-202418-035', 'S-0000014', NULL, NULL, '2024-12-18', '2024-12-21', NULL, 'Dikembalikan', '2024-12-17 23:34:58', '2024-12-17 23:37:37'),
('PSS-202418-080', 'S-0000005', NULL, NULL, '2024-12-15', '2024-12-18', NULL, 'Dipinjam', '2024-12-17 20:56:15', '2024-12-17 21:00:05'),
('PSS-202507-012', 'S-0000002', NULL, NULL, '2025-01-07', '2025-01-10', NULL, 'Dipinjam', '2025-01-06 18:27:20', '2025-01-06 18:27:20'),
('PSS-202507-014', 'S-0000006', NULL, NULL, '2025-01-07', '2025-01-10', NULL, 'Dipinjam', '2025-01-06 18:28:38', '2025-01-06 18:28:38'),
('PSS-202507-030', 'S-0000005', NULL, NULL, '2025-01-07', '2025-01-10', NULL, 'Dipinjam', '2025-01-06 19:15:49', '2025-01-06 19:15:49'),
('PSS-202507-032', 'S-0000008', NULL, NULL, '2025-01-07', '2025-01-10', NULL, 'Dipinjam', '2025-01-06 19:18:04', '2025-01-06 19:18:04'),
('PSS-202507-037', 'S-0000012', NULL, NULL, '2025-01-07', '2025-01-10', NULL, 'Dipinjam', '2025-01-06 19:25:08', '2025-01-06 19:25:08'),
('PSS-202507-041', 'S-0000021', NULL, NULL, '2025-01-07', '2025-01-10', NULL, 'Dipinjam', '2025-01-06 19:31:20', '2025-01-06 19:31:20'),
('PSS-202507-044', 'S-0000014', NULL, NULL, '2025-01-07', '2025-01-10', NULL, 'Dipinjam', '2025-01-06 19:35:36', '2025-01-06 19:35:36'),
('PSS-202508-002', 'S-0000013', NULL, NULL, '2025-01-08', '2025-01-11', NULL, 'Dipinjam', '2025-01-07 23:42:15', '2025-01-07 23:42:15'),
('PSS-202508-003', 'S-0000013', NULL, NULL, '2025-01-08', '2025-01-11', NULL, 'Dipinjam', '2025-01-07 23:42:27', '2025-01-07 23:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `rakbuku`
--

CREATE TABLE `rakbuku` (
  `id_rak` bigint(20) UNSIGNED NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rakbuku`
--

INSERT INTO `rakbuku` (`id_rak`, `lokasi`, `created_at`, `updated_at`) VALUES
(1, 'Kelas 8 - Bahasa', '2024-12-09 03:56:49', '2024-12-09 03:56:49'),
(2, 'Kelas 7 - IPS', '2024-12-09 11:38:37', '2024-12-09 11:53:38'),
(3, 'Kelas 8 - IPA', '2024-12-09 11:38:50', '2024-12-09 11:38:50'),
(4, 'Kelas 9 - IPA', '2024-12-17 23:25:27', '2024-12-17 23:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama`, `jenis_kelamin`, `alamat`, `created_at`, `updated_at`) VALUES
('S-0000001', 'Jamaludin', 'Laki-laki', 'Jalan mekar jaya 1 no.13', '2024-12-09 03:55:45', '2024-12-09 03:55:45'),
('S-0000002', 'Sepriwati', 'Perempuan', 'Jalan menteng raya barat no.10', '2024-12-09 13:34:49', '2024-12-09 13:34:49'),
('S-0000003', 'Ahmad Syafiq', 'Laki-laki', 'Jl. Raya No. 5, Jakarta', '2024-12-18 03:30:20', NULL),
('S-0000004', 'Budi Santoso', 'Laki-laki', 'Jl. Merdeka No. 12, Bandung', '2024-12-18 03:30:20', NULL),
('S-0000005', 'Citra Dewi', 'Perempuan', 'Jl. Sudirman No. 8, Surabaya', '2024-12-18 03:30:20', NULL),
('S-0000006', 'Dewi Lestari', 'Perempuan', 'Jl. Kenanga No. 3, Yogyakarta', '2024-12-18 03:30:20', NULL),
('S-0000007', 'Eko Prasetyo', 'Laki-laki', 'Jl. Kebon Jeruk No. 9, Jakarta', '2024-12-18 03:30:20', NULL),
('S-0000008', 'Farhan Fadhilah', 'Laki-laki', 'Jl. Raya No. 15, Semarang', '2024-12-18 03:30:20', NULL),
('S-0000009', 'Gina Puspita', 'Perempuan', 'Jl. Merdeka No. 18, Medan', '2024-12-18 03:30:20', NULL),
('S-0000010', 'Hadi Susanto', 'Laki-laki', 'Jl. Ahmad Yani No. 6, Surabaya', '2024-12-18 03:30:20', NULL),
('S-0000011', 'Ika Yuliana', 'Perempuan', 'Jl. Pantai No. 7, Bali', '2024-12-18 03:30:20', NULL),
('S-0000012', 'Joko Santosa', 'Laki-laki', 'Jl. Pahlawan No. 2, Makassar', '2024-12-18 03:30:20', NULL),
('S-0000013', 'Kartika Sari', 'Perempuan', 'Jl. Gajah Mada No. 1, Bandung', '2024-12-18 03:30:20', NULL),
('S-0000014', 'Lukman Hakim', 'Laki-laki', 'Jl. Raya No. 4, Batam', '2024-12-18 03:30:20', NULL),
('S-0000015', 'Maya Pratiwi', 'Perempuan', 'Jl. Merdeka No. 3, Medan', '2024-12-18 03:30:20', NULL),
('S-0000016', 'Nina Fitriani', 'Perempuan', 'Jl. Raya No. 14, Jakarta', '2024-12-18 03:30:20', NULL),
('S-0000017', 'Omar Fikri', 'Laki-laki', 'Jl. Taman Sari No. 11, Yogyakarta', '2024-12-18 03:30:20', NULL),
('S-0000018', 'Putri Anindya', 'Perempuan', 'Jl. Taman No. 6, Bali', '2024-12-18 03:30:20', NULL),
('S-0000019', 'Rudi Hartanto', 'Laki-laki', 'Jl. Imam Bonjol No. 8, Semarang', '2024-12-18 03:30:20', NULL),
('S-0000020', 'Sari Wulandari', 'Perempuan', 'Jl. Anggrek No. 4, Bandung', '2024-12-18 03:30:20', NULL),
('S-0000021', 'Tari Kusuma', 'Perempuan', 'Jl. Suka Makmur No. 12, Jakarta', '2024-12-18 03:30:20', NULL),
('S-0000022', 'Umar Farid', 'Laki-laki', 'Jl. Sutomo No. 9, Medan', '2024-12-18 03:30:20', NULL),
('S-0000023', 'Vivi Oktaviani', 'Perempuan', 'Jl. Mangga Dua No. 5, Makassar', '2024-12-18 03:30:20', NULL),
('S-0000024', 'Widi Rahmat', 'Laki-laki', 'Jl. Raya Timur No. 13, Surabaya', '2024-12-18 03:30:20', NULL),
('S-0000025', 'Xenia Dian', 'Perempuan', 'Jl. Hasyim Ashari No. 7, Yogyakarta', '2024-12-18 03:30:20', NULL),
('S-0000026', 'Yudi Setiawan', 'Laki-laki', 'Jl. Pasar Baru No. 2, Bali', '2024-12-18 03:30:20', NULL),
('S-0000027', 'Zahra Maharani', 'Perempuan', 'Jl. Sukajadi No. 4, Jakarta', '2024-12-18 03:30:20', NULL),
('S-0000028', 'Agus Wijaya', 'Laki-laki', 'Jl. Malabar No. 15, Batam', '2024-12-18 03:30:20', NULL),
('S-0000029', 'Beni Wira', 'Laki-laki', 'Jl. Raya Barat No. 8, Semarang', '2024-12-18 03:30:20', NULL),
('S-0000030', 'Cici Anggraini', 'Perempuan', 'Jl. Merdeka No. 10, Makassar', '2024-12-18 03:30:20', NULL),
('S-0000031', 'Dika Fajar', 'Laki-laki', 'Jl. Permai No. 6, Bandung', '2024-12-18 03:30:20', NULL),
('S-0000032', 'Endah Pertiwi', 'Perempuan', 'Jl. Raya No. 3, Surabaya', '2024-12-18 03:30:20', NULL),
('S-0000033', 'Fauzan Aditya', 'Laki-laki', 'Jl. Merdeka No. 12, Yogyakarta', '2024-12-18 03:30:20', NULL),
('S-0000034', 'Gita Mahendra', 'Perempuan', 'Jl. Raya Tengah No. 5, Jakarta', '2024-12-18 03:30:20', NULL),
('S-0000035', 'Hendra Santoso', 'Laki-laki', 'Jl. Cempaka No. 3, Makassar', '2024-12-18 03:30:20', NULL),
('S-0000036', 'Irma Farida', 'Perempuan', 'Jl. Sembada No. 9, Medan', '2024-12-18 03:30:20', NULL),
('S-0000037', 'Jemmy Prabowo', 'Laki-laki', 'Jl. Sudirman No. 6, Surabaya', '2024-12-18 03:30:20', NULL),
('S-0000038', 'Kiki Permata', 'Perempuan', 'Jl. Setiabudi No. 2, Bali', '2024-12-18 03:30:20', NULL),
('S-0000039', 'Lina Suryani', 'Perempuan', 'Jl. Tanjung No. 7, Bandung', '2024-12-18 03:30:20', NULL),
('S-0000040', 'Miko Fadillah', 'Laki-laki', 'Jl. Kemenangan No. 4, Jakarta', '2024-12-18 03:30:20', NULL),
('S-0000041', 'Nando Putra', 'Laki-laki', 'Jl. Suka Hati No. 5, Semarang', '2024-12-18 03:30:20', NULL),
('S-0000042', 'Oki Rahman', 'Laki-laki', 'Jl. Pahlawan No. 8, Makassar', '2024-12-18 03:30:20', NULL),
('S-0000043', 'Pipin Dwi', 'Perempuan', 'Jl. Merdeka No. 3, Batam', '2024-12-18 03:30:20', NULL),
('S-0000044', 'Qori Aulia', 'Perempuan', 'Jl. Raya No. 5, Yogyakarta', '2024-12-18 03:30:20', NULL),
('S-0000045', 'Rika Sulastri', 'Perempuan', 'Jl. Raya Selatan No. 6, Jakarta', '2024-12-18 03:30:20', NULL),
('S-0000046', 'Sigit Budi', 'Laki-laki', 'Jl. Wijaya No. 2, Surabaya', '2024-12-18 03:30:20', NULL),
('S-0000047', 'Tomi Fadli', 'Laki-laki', 'Jl. Raya Utama No. 7, Bali', '2024-12-18 03:30:20', NULL),
('S-0000048', 'Uli Mariana', 'Perempuan', 'Jl. Manggis No. 11, Bandung', '2024-12-18 03:30:20', NULL),
('S-0000049', 'Vera Kristina', 'Perempuan', 'Jl. Pantai No. 4, Jakarta', '2024-12-18 03:30:20', NULL),
('S-0000050', 'Wahyudi Saputra', 'Laki-laki', 'Jl. Kuningan No. 6, Makassar', '2024-12-18 03:30:20', NULL),
('S-0000051', 'Econ Sila', 'Laki-laki', 'Jalan Wayong p2id no.120', '2024-12-17 23:30:39', '2024-12-17 23:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'econ', '$2y$10$n60hLkvGqYZ0YOqkmEZ2kO4NNbsPf4hfVSt/OEC9HV.COydKkx/3O', NULL, '2024-12-09 03:28:18', '2024-12-09 03:28:18'),
(2, 'vela', '$2y$10$/mzr.UtvFSoqezZhFuxpJ.cjRPS2mohYTSBzHWgvgEHCpCMyCPc6u', NULL, '2024-12-17 08:23:39', '2024-12-17 08:23:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `fk_kategori` (`kategori_id`),
  ADD KEY `fk_rak` (`rak_id`);

--
-- Indexes for table `dtl_peminjaman`
--
ALTER TABLE `dtl_peminjaman`
  ADD KEY `fk_peminjaman` (`peminjaman_id`),
  ADD KEY `fk_buku_pem` (`buku_id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indexes for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`),
  ADD KEY `fk_siswa_kun` (`siswa_ku`),
  ADD KEY `fk_guru_kun` (`guru_ku`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `fk_siswa_pem` (`siswa_id`),
  ADD KEY `fk_guru_pem` (`guru_id`);

--
-- Indexes for table `rakbuku`
--
ALTER TABLE `rakbuku`
  ADD PRIMARY KEY (`id_rak`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rakbuku`
--
ALTER TABLE `rakbuku`
  MODIFY `id_rak` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id_kat`),
  ADD CONSTRAINT `fk_rak` FOREIGN KEY (`rak_id`) REFERENCES `rakbuku` (`id_rak`);

--
-- Constraints for table `dtl_peminjaman`
--
ALTER TABLE `dtl_peminjaman`
  ADD CONSTRAINT `fk_buku_pem` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `fk_peminjaman` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id_peminjaman`);

--
-- Constraints for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD CONSTRAINT `fk_guru_kun` FOREIGN KEY (`guru_ku`) REFERENCES `guru` (`id_guru`),
  ADD CONSTRAINT `fk_siswa_kun` FOREIGN KEY (`siswa_ku`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `fk_guru_pem` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id_guru`),
  ADD CONSTRAINT `fk_siswa_pem` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id_siswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

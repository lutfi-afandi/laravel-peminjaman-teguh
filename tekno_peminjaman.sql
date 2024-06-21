-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jun 2024 pada 09.09
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tekno_peminjaman`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `tersedia` double DEFAULT NULL,
  `ruangan_id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `penanggung_jawab` varchar(50) DEFAULT NULL,
  `tgl_perolehan` date DEFAULT NULL,
  `tahun_perolehan` year(4) DEFAULT NULL,
  `harga_perolehan` decimal(10,2) DEFAULT NULL,
  `kondisi` varchar(20) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barangs`
--

INSERT INTO `barangs` (`id`, `kode`, `nama`, `harga`, `jumlah`, `tersedia`, `ruangan_id`, `kategori_id`, `penanggung_jawab`, `tgl_perolehan`, `tahun_perolehan`, `harga_perolehan`, `kondisi`, `deskripsi`, `status`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'B001', 'Barang 2', 1000.00, 2, NULL, 1, 1, 'Pustik', '2010-08-01', '2020', 10000000.00, '1', 'test', 1, 'Barang 1-032709new.PNG', NULL, '2024-04-24 23:46:35'),
(3, 'KB01', 'Mic Wireless', NULL, 3, NULL, 1, 1, 'Pustik', '2024-03-20', NULL, 1000000.00, '1', 'Masih ok', 1, NULL, '2024-03-19 07:25:18', '2024-03-19 07:25:18'),
(4, 'KB02', 'Sound System', 100000.00, 2, NULL, 1, 1, 'Pustik', '2024-03-20', '2021', 10000000.00, NULL, NULL, 1, NULL, NULL, NULL),
(5, 'LCdP', 'LCD Proyektor', NULL, NULL, NULL, 3, 1, 'Pustik', '2024-03-25', NULL, NULL, '1', 'ok', 1, NULL, '2024-03-25 08:22:21', '2024-03-25 08:22:21'),
(6, 'BR-999', 'Barang Baru', NULL, 3, NULL, 10, 2, 'PUSTIK', '2024-06-09', NULL, 500000.00, '1', 'Keren', 1, NULL, '2024-06-21 04:53:26', '2024-06-21 04:53:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailpeminjaman_barangs`
--

CREATE TABLE `detailpeminjaman_barangs` (
  `id` bigint(20) NOT NULL,
  `pinjambarang_id` bigint(20) DEFAULT NULL,
  `barang_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jml_barang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detailpeminjaman_barangs`
--

INSERT INTO `detailpeminjaman_barangs` (`id`, `pinjambarang_id`, `barang_id`, `created_at`, `updated_at`, `jml_barang`) VALUES
(14, 8, 3, '2024-03-27 02:09:51', '2024-03-27 02:09:51', 2),
(15, 10, 3, '2024-03-27 03:05:22', '2024-03-27 03:05:22', 2),
(16, 10, 4, '2024-03-27 03:05:40', '2024-03-27 03:05:40', 1),
(18, 14, 3, '2024-04-11 14:35:42', '2024-04-11 14:35:42', 1),
(22, 22, 5, '2024-05-12 12:25:33', '2024-05-12 12:25:33', 3),
(24, 22, 4, '2024-05-17 17:46:33', '2024-05-17 17:46:33', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `gedungs`
--

CREATE TABLE `gedungs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `jumlah_lantai` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `sumber_dana` varchar(255) DEFAULT NULL,
  `besar_dana` decimal(20,2) DEFAULT NULL,
  `nilai_residu` decimal(20,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gedungs`
--

INSERT INTO `gedungs` (`id`, `kode`, `nama`, `lokasi`, `jumlah_lantai`, `foto`, `tahun`, `sumber_dana`, `besar_dana`, `nilai_residu`, `created_at`, `updated_at`) VALUES
(2, 'GA', 'Gedung A', 'Teknokrat', 4, 'Gedung A-234850new.jpg', '2010', 'tabungan2', 500000000.00, NULL, '2024-03-16 03:07:52', '2024-06-07 16:48:50'),
(12, 'GSG', 'Gedung Serba Guna', 'UTI', 4, 'Gedung Serba Guna-142633new.png', '2017', 'Mandiri', 500000000.00, NULL, '2024-03-16 07:26:01', '2024-03-16 07:26:33'),
(13, 'GD', 'Gedung D', 'PU', 1, NULL, '2018', 'Teknokrat', 500000000.00, NULL, '2024-03-25 08:43:40', '2024-06-02 12:23:58'),
(16, 'GB', 'Gedung B', 'Teknokrat', 4, NULL, '2014', 'Yayasan', 600000000.00, NULL, '2024-06-02 12:25:17', '2024-06-02 12:25:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id` int(11) NOT NULL,
  `kode` varchar(30) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategoris`
--

INSERT INTO `kategoris` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'K1', 'Aset Tetap', NULL, NULL),
(2, 'K2', 'Aset Bergerak', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatans`
--

CREATE TABLE `kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `deskripsi_kegiatan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kegiatans`
--

INSERT INTO `kegiatans` (`id`, `nama_kegiatan`, `deskripsi_kegiatan`, `created_at`, `updated_at`) VALUES
(1, 'okok', 'okok', '2024-03-16 02:35:35', '2024-05-03 09:04:11'),
(2, 'Buka Bareng', 'Ifthar', '2024-03-25 02:08:33', '2024-03-25 02:08:33'),
(3, 's', 's', '2024-03-25 02:09:01', '2024-03-25 02:09:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_14_133500_create_kegiatans_table', 1),
(6, '2024_03_15_092347_create_barangs_table', 1),
(7, '2024_03_15_105516_create_ruangans_table', 1),
(8, '2024_03_15_110057_create_gedungs_table', 1),
(9, '2024_03_15_111603_create_unitkerjas_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_barangs`
--

CREATE TABLE `peminjaman_barangs` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL COMMENT 'yang pinjam',
  `ruangan_id` bigint(20) DEFAULT NULL,
  `kegiatan` varchar(255) DEFAULT NULL,
  `waktu_peminjaman` datetime DEFAULT NULL,
  `waktu_pengembalian` datetime DEFAULT NULL,
  `nama_petugas` varchar(255) DEFAULT NULL COMMENT 'yang konfirmasi',
  `konfirmasi` int(11) DEFAULT 1 COMMENT '1: menunggu, 2. dikonfirmasi/sedang dipinjam, 3. Ditolah, 4. Dikembalikan',
  `keterangan` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `tgl_pemesanan` date DEFAULT NULL,
  `tgl_peminjaman` date DEFAULT NULL,
  `jam_peminjaman` time DEFAULT NULL,
  `tgl_pengembalian` date DEFAULT NULL,
  `jam_pengembalian` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman_barangs`
--

INSERT INTO `peminjaman_barangs` (`id`, `user_id`, `ruangan_id`, `kegiatan`, `waktu_peminjaman`, `waktu_pengembalian`, `nama_petugas`, `konfirmasi`, `keterangan`, `updated_at`, `created_at`, `tgl_pemesanan`, `tgl_peminjaman`, `jam_peminjaman`, `tgl_pengembalian`, `jam_pengembalian`) VALUES
(8, 2, 4, 'Pelantikan pejabat', '2024-03-27 10:43:00', '2024-03-27 11:37:00', NULL, 2, NULL, '2024-06-02 04:49:48', '2024-03-27 01:38:56', NULL, '2024-03-27', '09:00:00', '2024-03-27', '11:00:00'),
(9, 2, 1, 'Rapat Yayasan', '2024-03-27 09:43:00', '2024-03-29 10:37:00', NULL, 4, NULL, '2024-05-17 18:44:38', '2024-03-27 02:45:04', NULL, NULL, NULL, NULL, NULL),
(10, 2, 4, 'Rapat Yayasan', '2024-03-27 10:04:00', '2024-03-28 10:10:00', NULL, 4, NULL, '2024-06-02 03:44:04', '2024-03-27 03:04:59', NULL, NULL, NULL, NULL, NULL),
(14, 2, 4, 'Seminar', '2024-04-12 09:00:00', '2024-04-12 00:00:00', NULL, 4, NULL, '2024-04-14 02:03:21', '2024-04-11 14:27:02', NULL, NULL, NULL, NULL, NULL),
(22, 2, 5, 'rapat hima', '2024-05-13 07:24:00', '2024-05-13 09:24:00', NULL, 4, NULL, '2024-06-02 03:43:54', '2024-05-12 12:24:37', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_ruangans`
--

CREATE TABLE `peminjaman_ruangans` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL COMMENT 'Peminjam',
  `ruangan_id` bigint(20) NOT NULL COMMENT 'Ruangan yang dipinjam',
  `kegiatan` varchar(255) NOT NULL,
  `waktu_pinjam` datetime NOT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `jam_pinjam` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1: menunggu, 2. dikonfirmasi/sedang dipinjam, 3. Ditolak, 4. Dikembalikan',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman_ruangans`
--

INSERT INTO `peminjaman_ruangans` (`id`, `user_id`, `ruangan_id`, `kegiatan`, `waktu_pinjam`, `waktu_selesai`, `jam_pinjam`, `jam_selesai`, `status`, `created_at`, `updated_at`) VALUES
(22, 2, 1, 'rapat', '2024-05-04 13:00:00', '2024-05-04 16:00:00', NULL, NULL, 3, '2024-05-16 18:16:50', '2024-05-16 18:16:50'),
(24, 2, 1, 'rapat ukm', '2024-05-06 14:00:00', '2024-05-06 15:00:00', NULL, NULL, 4, '2024-05-16 16:28:26', '2024-05-16 16:28:26'),
(25, 2, 3, 'sidang skripsi', '2024-05-03 15:48:00', '2024-05-03 20:52:00', NULL, NULL, 3, '2024-05-10 16:08:02', '2024-05-03 08:51:12'),
(26, 2, 1, 'seminar', '2024-05-03 15:49:00', '2024-05-06 06:51:00', NULL, NULL, 4, '2024-05-17 16:51:41', '2024-05-17 16:51:41'),
(27, 2, 3, 'rapat hima', '2024-05-15 08:27:00', '2024-05-15 11:27:00', NULL, NULL, 4, '2024-06-01 15:22:05', '2024-06-01 15:22:05'),
(30, 2, 1, 'diseminasi prototipe', '2024-06-03 15:00:00', '2024-06-03 17:00:00', NULL, NULL, 2, '2024-06-01 15:28:34', '2024-06-01 15:28:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangans`
--

CREATE TABLE `ruangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_ruangan` varchar(50) NOT NULL,
  `nama_ruangan` varchar(255) NOT NULL,
  `gedung_id` bigint(20) UNSIGNED NOT NULL,
  `lantai` varchar(50) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `luas` decimal(10,2) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `kondisi` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `unit_kerja_id` bigint(20) DEFAULT NULL,
  `bisa_pinjam` tinyint(1) NOT NULL DEFAULT 0,
  `foto_ruangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ruangans`
--

INSERT INTO `ruangans` (`id`, `kode_ruangan`, `nama_ruangan`, `gedung_id`, `lantai`, `kapasitas`, `luas`, `tipe`, `kondisi`, `status`, `unit_kerja_id`, `bisa_pinjam`, `foto_ruangan`, `created_at`, `updated_at`) VALUES
(1, 'LBD', 'Lab Bisnis Digital', 2, '2', 30, 90.00, 'Lab', 'Baik', 1, 1, 1, 'Lab Bisnis Digital-233006new.jpg', NULL, '2024-06-02 16:30:06'),
(3, 'LAB1GSG', 'Lab Komputer 1 GSG', 12, '3', 40, 15.00, 'Lab', 'Baik', 1, 4, 1, 'Lab Komputer 1 GSG-232343new.webp', '2024-03-18 04:28:03', '2024-06-02 16:23:43'),
(4, 'AulaA', 'Aula A', 2, '4', 200, NULL, 'Auditorium', 'Baik', 1, 1, 1, 'Aula A-232431new.webp', '2024-03-18 04:29:20', '2024-06-02 16:24:31'),
(5, 'RR-A', '209 A', 2, '2', 40, NULL, 'Ruang Rapat', 'Baik', 1, 1, 1, '209 A-204625new.jpg', '2024-03-26 03:08:15', '2024-06-02 13:49:13'),
(8, 'LAB2GSG', 'Lab Komputer 2 GSG', 12, '2', 40, 20.00, 'Lab', 'Baik', 1, 4, 0, 'Lab Komputer 2 GSG-204227new.jpg', '2024-06-02 12:27:51', '2024-06-02 13:42:27'),
(9, '304B', 'Ruang 304 B', 16, '3', 40, 20.00, 'Ruang Kelas', 'Baik', 1, 5, 1, NULL, '2024-06-02 12:28:45', '2024-06-02 13:49:23'),
(10, '303B', 'Ruang 303 B', 16, '3', 40, 15.00, 'Ruang Kelas', 'Baik', 1, 5, 1, NULL, '2024-06-02 12:29:30', '2024-06-02 13:49:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `unitkerjas`
--

CREATE TABLE `unitkerjas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(30) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `unitkerjas`
--

INSERT INTO `unitkerjas` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'FEB', 'Fakultas Ekonomi dan Bisnis', NULL, NULL),
(2, 'SPMI', 'Satuan Penjamin Mutu Internal', NULL, NULL),
(3, 'KMS', 'Kemahasiswaan', NULL, NULL),
(4, 'FTIK', 'Fakultas Teknik dan Ilmu Komputer', NULL, NULL),
(5, 'FSIP', 'Fakultas Sastra dan Ilmu Pendidikan', NULL, NULL),
(6, 'PusTIK', 'PusTIK', NULL, '2024-04-24 23:18:22'),
(8, 'IF', 'Informatika', '2024-06-02 12:06:19', '2024-06-02 12:06:19'),
(9, 'SI', 'Sistem Informasi', '2024-06-02 12:06:32', '2024-06-02 12:06:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unitkerja_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `level` enum('admin','baak','mahasiswa') NOT NULL,
  `fakultas_kode` varchar(255) DEFAULT NULL,
  `no_telepon` varchar(255) DEFAULT NULL,
  `email_pribadi` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `unitkerja_id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `level`, `fakultas_kode`, `no_telepon`, `email_pribadi`, `foto`, `created_at`, `updated_at`) VALUES
(1, 6, 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$hKWv5IseaLeVdDHG0UXxrej/X3sF/Z.ibasKQkvAyH5xIiZFeeUGm', NULL, 'admin', NULL, '628000000000000', NULL, 'admin-192236new.png', NULL, '2024-06-02 12:22:36'),
(2, 8, 'Teguh Budiono', '19312213', 'teguh_budiono@teknokrat.ac.id', NULL, '$2y$10$hjOilWkOkZptI7W2q9YX0ejO3h29xw8olmRoHsVbadN0s9dSmzIn6', NULL, 'mahasiswa', NULL, '6280000700000', NULL, 'Teguh Budiono-190801new.JPG', NULL, '2024-06-02 12:08:01'),
(14, 4, 'teguh baak ftik', 'baak', 'testbaak@gmail.com', NULL, '$2y$10$7N3gK10WM16JGBAJA7oODug6gD0as16PX0.8CFkPiJGHXrDDW3kX2', NULL, 'baak', NULL, '628363636366633', NULL, 'teguh baak ftik-200825new.JPG', '2024-05-11 17:07:15', '2024-05-17 20:57:53'),
(17, 8, 'Muhammad Abdian', '19312195', 'muhan212223@gmail.com', NULL, '$2y$10$e4FUDpzmIHtqciySkrHKSu/dEl0YaGNaob6YtnGR3NAqdBkL7Qj1S', NULL, 'mahasiswa', NULL, '6280808080808', NULL, '19312195-191231.png', '2024-06-02 12:12:31', '2024-06-02 12:12:31'),
(18, 8, 'Muhammad Rasid', '19312228', 'rasyid.787898@gmail.com', NULL, '$2y$10$3P8ZRBVcTg1E3g5UMARtzOAKXjBXEe6EVpbb5qT9CGsqYYrS/2epC', NULL, 'mahasiswa', NULL, '6289999999999', NULL, '19312228-191335.png', '2024-06-02 12:13:36', '2024-06-02 12:13:36'),
(19, 8, 'Hanif Fayad Zabihullah', '19312122', 'hanif_fayad_zabihullah@teknokrat.ac.id', NULL, '$2y$10$prSKG/n6fCCHoVvnLxwLguG4B4w/D4XQ4Kd.wNtWZll9JhdAIVBhG', NULL, 'mahasiswa', NULL, '62877777777', NULL, '19312122-191515.png', '2024-06-02 12:15:16', '2024-06-02 12:15:16'),
(20, 8, 'M Ihsan Fadilah', '19312194', 'isanbayo@gmail.com', NULL, '$2y$10$cGtVb6Sx8eYcWPIbzrhNluVXXLaYgoGGvfM3nP5BwV3sbFBzW.Phi', NULL, 'mahasiswa', NULL, '62866666666', NULL, '19312194-191613.png', '2024-06-02 12:16:13', '2024-06-02 12:16:13'),
(21, 8, 'Fikho aldino', '19312235', 'aldinoalarthafizh24@gmail.com', NULL, '$2y$10$Xj5/Wu79pyCHjOY3wjntFu5z8z5vlClaJ8iCoJfY31m9DBitgdj7O', NULL, 'mahasiswa', NULL, '628333333333', NULL, '19312235-191659.png', '2024-06-02 12:16:59', '2024-06-02 12:16:59'),
(22, 8, 'Balget Duta Anaki', '19312107', 'balgetdutaanakii@gmail.com', NULL, '$2y$10$1/4ftY1NZPHaHYqgWuCiQuqGVPlAr.xZCuRbYhJObgA6Ezy7AU.JW', NULL, 'mahasiswa', NULL, '628222222222', NULL, '19312107-191743.png', '2024-06-02 12:17:43', '2024-06-02 12:17:43'),
(23, 8, 'Made Wiratama', '19312130', 'tamawira82@gmail.com', NULL, '$2y$10$uaG.2.E9so2RgnEjLmEJuuWFbdwM1QHsD5tcVSdCDSdFyYOJ4wrJi', NULL, 'mahasiswa', NULL, '628111111111', NULL, '19312130-191837.png', '2024-06-02 12:18:38', '2024-06-02 12:18:38'),
(24, 9, 'Ratih Siti Jamilah', '20311421', 'ratihsija10@gmail.com', NULL, '$2y$10$IN.Tt5p4zNLqXlDUnHRVieWrDD4nb.8gC7Cx2OC1bFtdEXWWkePk.', NULL, 'mahasiswa', NULL, '628744454444444', NULL, '20311421-191947.png', '2024-06-02 12:19:48', '2024-06-02 12:19:48'),
(25, 8, 'Zulfahmi Rahmat', '19312215', 'zulfahmirahmat2000@gmail.com', NULL, '$2y$10$x5MURYkMdB1Q5FfZaO4zu.hcFaITFZL1YvlI338olBWPZu9o9ide6', NULL, 'mahasiswa', NULL, '62833333333', NULL, '19312215-192026.png', '2024-06-02 12:20:26', '2024-06-02 12:20:26'),
(26, 8, 'Herlina', '19312125', 'linah9068@gmail.com', NULL, '$2y$10$l9bn1jw0qT/p7lOSkIM8LOSx/mFNQKL2OhrxZlmr5Rj5AL2zE99/y', NULL, 'mahasiswa', NULL, '628745645645645', NULL, '19312125-192109.png', '2024-06-02 12:21:09', '2024-06-02 12:21:09');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barangs_kode_unique` (`kode`);

--
-- Indeks untuk tabel `detailpeminjaman_barangs`
--
ALTER TABLE `detailpeminjaman_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pinjambarang_id` (`pinjambarang_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `gedungs`
--
ALTER TABLE `gedungs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gedungs_kode_unique` (`kode`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `peminjaman_barangs`
--
ALTER TABLE `peminjaman_barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman_ruangans`
--
ALTER TABLE `peminjaman_ruangans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `ruangans`
--
ALTER TABLE `ruangans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ruangans_kode_ruangan_unique` (`kode_ruangan`);

--
-- Indeks untuk tabel `unitkerjas`
--
ALTER TABLE `unitkerjas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `detailpeminjaman_barangs`
--
ALTER TABLE `detailpeminjaman_barangs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gedungs`
--
ALTER TABLE `gedungs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kegiatans`
--
ALTER TABLE `kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_barangs`
--
ALTER TABLE `peminjaman_barangs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_ruangans`
--
ALTER TABLE `peminjaman_ruangans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ruangans`
--
ALTER TABLE `ruangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `unitkerjas`
--
ALTER TABLE `unitkerjas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detailpeminjaman_barangs`
--
ALTER TABLE `detailpeminjaman_barangs`
  ADD CONSTRAINT `detailpeminjaman_barangs_ibfk_1` FOREIGN KEY (`pinjambarang_id`) REFERENCES `peminjaman_barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

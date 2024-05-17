-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Apr 2024 pada 19.09
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
(5, 'LCdP', 'LCD Proyektor', NULL, NULL, NULL, 3, 1, 'Pustik', '2024-03-25', NULL, NULL, '1', 'ok', 1, NULL, '2024-03-25 08:22:21', '2024-03-25 08:22:21');

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
(20, 20, 5, '2024-04-17 07:58:39', '2024-04-17 07:58:39', 2);

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
(2, 'GA', 'Gedung A', 'Kampus1', 4, 'Gedung A-103434new.jpg', '2010', 'tabungan2', 500000000.00, NULL, '2024-03-16 03:07:52', '2024-03-16 03:34:34'),
(12, 'GSG', 'Gedung Serba Guna', 'Kampus1', 4, 'Gedung Serba Guna-142633new.png', '2017', 'Mandiri', 500000000.00, NULL, '2024-03-16 07:26:01', '2024-03-16 07:26:33'),
(13, 'GD', 'Gedung D', 'PU', 1, NULL, '2018', NULL, NULL, NULL, '2024-03-25 08:43:40', '2024-03-25 08:43:40'),
(15, 'gg383939', 'wehduwheduew', 'saknknak', 4, 'gg383939-023727.png', NULL, 'kajskaj', 2828.00, NULL, '2024-04-16 19:37:27', '2024-04-16 19:37:27');

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
(1, 'ok', 'ok', '2024-03-16 02:35:35', '2024-04-24 22:08:27'),
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
(8, 2, 4, 'Pelantikan pejabat', '2024-03-27 10:43:00', '2024-03-27 11:37:00', NULL, 1, NULL, '2024-03-27 01:38:56', '2024-03-27 01:38:56', NULL, '2024-03-27', '09:00:00', '2024-03-27', '11:00:00'),
(9, 2, 1, 'Rapat Yayasan', '2024-03-27 09:43:00', '2024-03-29 10:37:00', NULL, 3, NULL, '2024-04-16 14:56:09', '2024-03-27 02:45:04', NULL, NULL, NULL, NULL, NULL),
(10, 2, 4, 'Rapat Yayasan', '2024-03-27 10:04:00', '2024-03-28 10:10:00', NULL, 2, NULL, '2024-04-16 12:30:35', '2024-03-27 03:04:59', NULL, NULL, NULL, NULL, NULL),
(14, 2, 4, 'lalalala', '2024-04-12 09:00:00', '2024-04-12 00:00:00', NULL, 4, NULL, '2024-04-14 02:03:21', '2024-04-11 14:27:02', NULL, NULL, NULL, NULL, NULL),
(20, 2, 5, 'tesst test', NULL, NULL, NULL, 1, NULL, '2024-04-17 07:22:07', '2024-04-17 07:22:07', NULL, '2024-04-19', '14:21:00', '2024-04-19', '17:21:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_ruangans`
--

CREATE TABLE `peminjaman_ruangans` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL COMMENT 'Peminjam',
  `ruangan_id` bigint(20) NOT NULL COMMENT 'Ruangan yang dipinjam',
  `kegiatan` varchar(255) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `jam_pinjam` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1: menunggu, 2. dikonfirmasi/sedang dipinjam, 3. Ditolak, 4. Dikembalikan',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman_ruangans`
--

INSERT INTO `peminjaman_ruangans` (`id`, `user_id`, `ruangan_id`, `kegiatan`, `tgl_pinjam`, `jam_pinjam`, `jam_selesai`, `status`, `created_at`, `updated_at`) VALUES
(6, 2, 3, 'kkkkkkkkkkkkkkkkkk', '2024-04-17', '08:36:00', '10:36:00', 2, '2024-04-16 23:28:43', '2024-04-16 23:28:43'),
(12, 2, 3, 'ahsbahshaS', '2024-04-17', '04:58:00', '10:52:00', 3, '2024-04-16 12:37:31', '2024-04-16 12:37:31'),
(15, 2, 3, 'ggggggggggggggggggg', '2024-05-02', '06:26:00', '08:26:00', 2, '2024-04-16 12:37:17', '2024-04-16 12:37:17'),
(16, 2, 3, 'rrrrrrrrrrrrrrrrrrrrrrrr', '2024-05-02', '06:26:00', '08:26:00', 4, '2024-04-16 12:38:00', '2024-04-16 12:38:00'),
(17, 2, 5, 'ppppppppppppppppp', '2024-04-17', '14:43:00', '17:44:00', 1, '2024-04-15 18:44:09', '2024-04-15 18:44:09'),
(18, 2, 1, 'tetstsststt', '2024-04-18', '08:28:00', '10:28:00', 4, '2024-04-16 23:22:41', '2024-04-16 23:22:41'),
(19, 2, 1, 'mmmmmmmmmmmmmmmmm', '2024-04-17', '08:36:00', '11:36:00', 1, '2024-04-16 13:36:34', '2024-04-16 13:36:34'),
(20, 2, 3, 'jhaSAHSUIAUISAU', '2024-04-17', '09:30:00', '11:30:00', 1, '2024-04-16 23:30:56', '2024-04-16 23:30:56');

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
(1, 'LBD', 'Lab Bisnis Digital', 2, '2', 30, 90.00, 'Lab', 'Baik', 1, 1, 1, NULL, NULL, '2024-04-28 16:36:44'),
(3, 'LAB1GSG', 'Lab Komputer 1 GSG', 12, '3', 40, 15.00, 'Lab', 'Baik', 1, 4, 1, 'Lab Komputer 1 GSG-112803.png', '2024-03-18 04:28:03', '2024-04-28 16:40:42'),
(4, 'AulaA', 'Aula A', 2, '4', 200, NULL, 'Auditorium', 'Baik', 1, 1, 0, 'Aula A-112920.png', '2024-03-18 04:29:20', '2024-03-18 04:29:20'),
(5, 'RR-A', '209 A', 2, '2', 40, NULL, 'Ruang Rapat', 'Baik', 1, 1, 0, NULL, '2024-03-26 03:08:15', '2024-03-26 03:08:15');

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
(6, 'PusTIK', 'PusTIK', NULL, '2024-04-24 23:18:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `level`, `fakultas_kode`, `no_telepon`, `email_pribadi`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$WB/uuiZIfE.x1COhfrQMEOLjh1WCLiTWyxstUb.ZKqmvayUyugoA6', NULL, 'admin', NULL, NULL, NULL, NULL, NULL, '2024-04-16 16:30:19'),
(2, 'mahasiswa', 'mahasiswa', 'mahasiswa@gmail.com', NULL, '$2y$10$d48xJp79HY85u0A/7hB7L.qNak3TDYVTLlOK3Hi9tZ1kbu6kGAvLy', NULL, 'mahasiswa', NULL, '6281313010613', NULL, NULL, NULL, '2024-04-16 12:43:28'),
(4, 'Teguh Budim', 'teguh', 'teguh@test.com', NULL, '$2y$10$d48xJp79HY85u0A/7hB7L.qNak3TDYVTLlOK3Hi9tZ1kbu6kGAvLy', NULL, 'mahasiswa', NULL, '6282281644670', NULL, 'Teguh Budiono-032523new.jpg', '2024-04-16 16:25:58', '2024-04-26 04:13:03'),
(10, 'Teguh Budionoooo', 'teguh000', 'teguh_budiono@gmail.co', NULL, '$2y$10$m/EoQdbXvBT2r0z6HOFtsO6xrZWaZJjKMWhBs.DslmMRwpKFTTsju', NULL, 'baak', NULL, '08226262626622', NULL, 'test888-143404.jpg', '2024-04-17 07:34:04', '2024-04-28 15:38:31');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `detailpeminjaman_barangs`
--
ALTER TABLE `detailpeminjaman_barangs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gedungs`
--
ALTER TABLE `gedungs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_ruangans`
--
ALTER TABLE `peminjaman_ruangans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ruangans`
--
ALTER TABLE `ruangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `unitkerjas`
--
ALTER TABLE `unitkerjas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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

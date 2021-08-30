-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Agu 2021 pada 11.37
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puprtesis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_jalan`
--

CREATE TABLE `bobot_jalan` (
  `id_bobot_jalan` int(11) NOT NULL,
  `id_jalan` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `table_lhr` int(3) DEFAULT NULL,
  `kondisi_jalan` int(3) DEFAULT NULL,
  `jenis_eksisting` int(3) DEFAULT NULL,
  `panjang_jalan` int(3) DEFAULT NULL,
  `pengaduan_masyarakat` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bobot_jalan`
--

INSERT INTO `bobot_jalan` (`id_bobot_jalan`, `id_jalan`, `created_at`, `created_by`, `table_lhr`, `kondisi_jalan`, `jenis_eksisting`, `panjang_jalan`, `pengaduan_masyarakat`) VALUES
(12, 2, '2021-05-19 19:04:00', 1, 4, 3, 2, 4, 1),
(14, 3, '2021-08-03 12:03:17', 1, 5, 3, 3, 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_kriteria`
--

CREATE TABLE `bobot_kriteria` (
  `id_bobot_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `pilihan_bobot` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `nilai_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id_bobot_kriteria`, `id_kriteria`, `pilihan_bobot`, `keterangan`, `nilai_kriteria`) VALUES
(31, 19, 5, '5000 - 4000', 5),
(32, 19, 4, '4000-3000', 4),
(33, 19, 3, '4000 - 3000', 3),
(34, 19, 2, '3000 - 2000', 2),
(35, 19, 1, '< 2000', 1),
(39, 20, 5, 'Rusak Berat ', 5),
(40, 20, 4, 'Rusak Sedang', 4),
(41, 20, 3, 'Rusak', 3),
(43, 20, 2, 'Rusak Biasa', 2),
(44, 20, 1, 'Normal', 1),
(45, 22, 1, 'Beton', 1),
(46, 22, 2, ' Aspal', 2),
(47, 22, 3, 'Krikil', 3),
(48, 22, 4, 'Batu', 4),
(49, 22, 5, 'Tanah', 5),
(52, 23, 1, '< 200 m', 1),
(53, 23, 2, '200 - 300 m', 2),
(54, 23, 3, '300 - 400 m', 3),
(55, 23, 4, '400 - 500 m', 4),
(56, 23, 5, '> 500 m', 5),
(57, 24, 2, 'Ada', 2),
(58, 24, 1, 'Tidak Ada', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jalan`
--

CREATE TABLE `jalan` (
  `id_jalan` int(11) NOT NULL,
  `nama_jalan` varchar(30) NOT NULL,
  `kecamatan` varchar(30) NOT NULL,
  `kelurahan` varchar(30) NOT NULL,
  `lat` varchar(10) NOT NULL,
  `lng` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jalan`
--

INSERT INTO `jalan` (`id_jalan`, `nama_jalan`, `kecamatan`, `kelurahan`, `lat`, `lng`, `created_by`, `created_at`) VALUES
(2, 'Jalan Purwakarta - Pengarengan', 'PENGARENGAN', 'PENGARENGAN', '-6.1604997', '106.243934', 1, '2021-04-17 00:10:46'),
(3, 'Jalan Sini', 'TAMANSARI', 'PENGARENGAN', '-6.1650385', '106.179808', 1, '2021-04-17 22:36:16'),
(4, 'Jalan Raya Cilegon', 'TAKTAKAN', 'DRANGONG', '-6.1084526', '106.139735', 1, '2021-08-30 14:43:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `bobot_kriteria` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot_kriteria`, `created_by`, `created_at`) VALUES
(19, 'Table LHR', 5, 1, '2021-04-16 21:31:13'),
(20, 'Kondisi Jalan', 5, 1, '2021-04-16 21:31:20'),
(22, 'Jenis Eksisting', 5, 1, '2021-05-19 18:55:36'),
(23, 'Panjang Jalan', 5, 1, '2021-05-19 18:55:51'),
(24, 'Pengaduan Masyarakat', 2, 1, '2021-05-19 18:56:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_lhr`
--

CREATE TABLE `kriteria_lhr` (
  `id` int(11) NOT NULL,
  `nama_kriteria_lhr` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria_lhr`
--

INSERT INTO `kriteria_lhr` (`id`, `nama_kriteria_lhr`) VALUES
(6, 'Jalan Kaki'),
(10, 'Pikulan/Gendongan'),
(11, 'Sepeda'),
(12, 'Sepeda+Barang'),
(13, 'Becak'),
(14, 'Sepeda Motor'),
(15, 'Pickup Penumpang'),
(16, 'Pickup Barang'),
(17, 'Bis'),
(18, 'Truk Ringan'),
(19, 'Truk Sedang'),
(20, 'Truk Berat'),
(22, 'Sedan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(150) NOT NULL,
  `link` varchar(200) NOT NULL,
  `icon` varchar(150) NOT NULL,
  `sub_menu` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `warna` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `nama_menu`, `link`, `icon`, `sub_menu`, `level`, `warna`) VALUES
(1, 'Dashboard', 'Dashboard', 'fas fa-tachometer-alt', 0, 1, 'text-warning'),
(2, 'Master Data', '', 'fas fa-tachometer-alt', 0, 1, 'text-primary'),
(3, 'Kriteria', 'kriteria', 'fas fa-tachometer-alt', 2, 1, 'text-danger'),
(5, 'Jalan', 'jalan', 'fas fa-tachometer-alt', 2, 1, 'text-danger'),
(20, 'Tabel LHR', 'table_lhr', 'fas fa-tachometer-alt', 0, 1, 'text-danger'),
(30, 'Normalisasi', 'normalisasi', 'fas fa-tachometer-alt', 0, 1, 'text-info'),
(40, 'Nilai Alternatif', 'nilaialternatif', 'fas fa-tachometer-alt', 0, 1, 'text-info'),
(50, 'Nilai Preferensi', 'nilaipreferensi', 'fas fa-tachometer-alt', 0, 1, 'text-info'),
(51, 'Pengguna', 'pengguna', '', 2, 1, 'text-danger');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_lhr`
--

CREATE TABLE `nilai_lhr` (
  `id_lhr` int(11) NOT NULL,
  `id_jalan` int(11) NOT NULL,
  `jalan_kaki` double DEFAULT NULL,
  `pikulan/gendongan` double DEFAULT NULL,
  `sepeda` double DEFAULT NULL,
  `sepeda+barang` double DEFAULT NULL,
  `becak` double DEFAULT NULL,
  `sepeda_motor` double DEFAULT NULL,
  `pickup_penumpang` double DEFAULT NULL,
  `pickup_barang` double DEFAULT NULL,
  `bis` double DEFAULT NULL,
  `truk_ringan` double DEFAULT NULL,
  `truk_sedang` double DEFAULT NULL,
  `truk_berat` double DEFAULT NULL,
  `sedan` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai_lhr`
--

INSERT INTO `nilai_lhr` (`id_lhr`, `id_jalan`, `jalan_kaki`, `pikulan/gendongan`, `sepeda`, `sepeda+barang`, `becak`, `sepeda_motor`, `pickup_penumpang`, `pickup_barang`, `bis`, `truk_ringan`, `truk_sedang`, `truk_berat`, `sedan`) VALUES
(6, 3, 20, 10, 10, 10, 30, 40, 30, 20, 10, 15, 20, 10, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `nama_jalan` varchar(50) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `hp` varchar(16) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `img1` text DEFAULT NULL,
  `img2` text DEFAULT NULL,
  `lat` varchar(10) NOT NULL,
  `lng` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `nama_jalan`, `nama_lengkap`, `hp`, `email`, `keterangan`, `img1`, `img2`, `lat`, `lng`, `created_at`) VALUES
(10, 'Jalan Ponogoro', 'Unicorn Gift', '089676490971', 'unicorngift15@gmail.com', 'LALALA', '9eeb3e97-3280-4d59-917c-093ccc4849e0.jpg', '9eeb3e97-3280-4d59-917c-093ccc4849e01.jpg', '0', '0', '2021-05-23 14:14:38'),
(13, 'Jalan Semuanya', 'Unicorn Gift', '089676490971', 'unicorngift15@gmail.com', 'asdasdas', '66e4a26e-7bae-4376-80c1-5627ea485d46.jpg', 'abstract-blue-geometric-shapes-background_1035-17545.jpg', '0', '0', '2021-05-23 14:46:10'),
(14, 'Jln Legok Assalam', 'Ahmad Fatoni', '089676490971', 'achmad.fatoni33@gmail.com', 'Jalan Rusak Bolong', 'feed1.png', 'Picture1.png', '-6.0769589', '106.114269', '2021-08-30 15:59:50'),
(15, 'JLN Ciceri Indah', 'Waluyo', '089676490971', 'waluyo@gmail.com', 'Jlan tidak teratur', '9eeb3e97-3280-4d59-917c-093ccc4849e02.jpg', 'Picture11.png', '-6.1079894', '106.139672', '2021-08-30 16:02:15'),
(16, 'Jalan Raya Cilegon', 'Fatoni', '081818181', 'ptfpl@ymail.com', 'Jalan penuh dengan lobang', '9eeb3e97-3280-4d59-917c-093ccc4849e03.jpg', 'abstract-blue-geometric-shapes-background_1035-175451.jpg', '-6.0790382', '106.111029', '2021-08-30 16:09:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` int(11) NOT NULL,
  `foto` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama_user`, `username`, `password`, `level`, `foto`, `status`, `created_at`) VALUES
(1, 'Ahmad Fatoni', 'admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 1, 'Logo_Unicorn_Giftdas.jpg', 1, '2020-11-08 03:12:18'),
(3, 'Ahmad', 'fatoni', '3f9f3d641b7f8edff713885cfcea49dd9f22272ba8180e5f7130b20dbc601041abcd499e6be4868d1594a766454637bc800759d4f539a493bc765b1f2b647a6d', 1, 'Logo_AFStore.png', 1, '2021-05-27 21:50:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_group`
--

CREATE TABLE `users_group` (
  `id` int(11) NOT NULL,
  `nama_group` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users_group`
--

INSERT INTO `users_group` (`id`, `nama_group`, `level`, `link`) VALUES
(1, 'Administrator', 1, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bobot_jalan`
--
ALTER TABLE `bobot_jalan`
  ADD PRIMARY KEY (`id_bobot_jalan`);

--
-- Indeks untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD PRIMARY KEY (`id_bobot_kriteria`);

--
-- Indeks untuk tabel `jalan`
--
ALTER TABLE `jalan`
  ADD PRIMARY KEY (`id_jalan`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `kriteria_lhr`
--
ALTER TABLE `kriteria_lhr`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_lhr`
--
ALTER TABLE `nilai_lhr`
  ADD PRIMARY KEY (`id_lhr`);

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users_group`
--
ALTER TABLE `users_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bobot_jalan`
--
ALTER TABLE `bobot_jalan`
  MODIFY `id_bobot_jalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  MODIFY `id_bobot_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `jalan`
--
ALTER TABLE `jalan`
  MODIFY `id_jalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `kriteria_lhr`
--
ALTER TABLE `kriteria_lhr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `nilai_lhr`
--
ALTER TABLE `nilai_lhr`
  MODIFY `id_lhr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users_group`
--
ALTER TABLE `users_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

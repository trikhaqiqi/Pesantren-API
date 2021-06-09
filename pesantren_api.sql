-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jun 2021 pada 01.40
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pesantren_api`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_users`
--

CREATE TABLE `api_users` (
  `email` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `hit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `api_users`
--

INSERT INTO `api_users` (`email`, `api_key`, `hit`) VALUES
('trikhaqiqi@kudangkoding.com', '123', 151);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan_tambahan`
--

CREATE TABLE `kegiatan_tambahan` (
  `id_kegiatan_tambahan` int(12) NOT NULL,
  `nama_kegiatan` varchar(30) NOT NULL,
  `lokasi_kegiatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kegiatan_tambahan`
--

INSERT INTO `kegiatan_tambahan` (`id_kegiatan_tambahan`, `nama_kegiatan`, `lokasi_kegiatan`) VALUES
(1, 'Futsal', 'Lapang futsal'),
(2, 'Voli', 'Gor binangkit'),
(3, 'Story telling', 'Kelas A'),
(5, 'Sepak bola', 'Lapangan Sepak Bola'),
(7, 'programming', 'lab. Komputer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pembelajaran`
--

CREATE TABLE `mata_pembelajaran` (
  `id_mata_pembelajaran` int(12) NOT NULL,
  `kode_pembelajaran` int(12) NOT NULL,
  `nama_pembelajaran` varchar(50) NOT NULL,
  `sks` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mata_pembelajaran`
--

INSERT INTO `mata_pembelajaran` (`id_mata_pembelajaran`, `kode_pembelajaran`, `nama_pembelajaran`, `sks`) VALUES
(1, 98, 'Al-qur\'an', 10),
(2, 76, 'Syafinah', 10),
(3, 8, 'Tijan', 5),
(6, 66, 'Jurumi\'ah', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelajaran`
--

CREATE TABLE `pembelajaran` (
  `id_pembelajaran` int(12) NOT NULL,
  `id_santri` int(12) NOT NULL,
  `id_pengajar` int(12) NOT NULL,
  `id_pengawas` int(12) NOT NULL,
  `id_mata_pembelajaran` int(12) NOT NULL,
  `id_kegiatan_tambahan` int(12) NOT NULL,
  `nilai` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelajaran`
--

INSERT INTO `pembelajaran` (`id_pembelajaran`, `id_santri`, `id_pengajar`, `id_pengawas`, `id_mata_pembelajaran`, `id_kegiatan_tambahan`, `nilai`) VALUES
(1, 1, 1, 2, 1, 1, 98),
(2, 2, 2, 1, 2, 2, 80),
(4, 2, 2, 2, 2, 2, 90),
(9, 3, 4, 4, 3, 5, 90);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajar`
--

CREATE TABLE `pengajar` (
  `id_pengajar` int(12) NOT NULL,
  `nama_pengajar` varchar(30) NOT NULL,
  `alamat_pengajar` varchar(50) NOT NULL,
  `jns_kelamin_pengajar` enum('L','P') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengajar`
--

INSERT INTO `pengajar` (`id_pengajar`, `nama_pengajar`, `alamat_pengajar`, `jns_kelamin_pengajar`) VALUES
(1, 'Ust. Yusuf Mansyur', 'jakarta', 'L'),
(2, 'Ust. Hanan Hataki', 'jakarta', 'L'),
(3, 'KH. Habib bahar', 'Jakarta', 'L'),
(4, 'KH. Enden Haetami', 'Jakarta', 'L'),
(6, 'KH. Abdurahman wahid', 'Jakarta', 'L'),
(8, 'Ustazah Oki Agustian', 'Jakarta', 'P'),
(9, 'Ustazah Oki Agustian', 'Padang', 'P');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengawas`
--

CREATE TABLE `pengawas` (
  `id_pengawas` int(12) NOT NULL,
  `nama_pengawas` varchar(30) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `alamat_pengawas` varchar(50) NOT NULL,
  `jns_kelamin_pengawas` enum('L','P') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengawas`
--

INSERT INTO `pengawas` (`id_pengawas`, `nama_pengawas`, `jabatan`, `alamat_pengawas`, `jns_kelamin_pengawas`) VALUES
(1, 'Abdul', 'pengawas', 'tasik', 'L'),
(2, 'H. Usup', 'Pengawas putra', 'Bandung', 'L'),
(3, 'H. Iksan Fadilah', 'Pengawas', 'Aceh', 'L'),
(4, 'H. Mabrur', 'Pengawas', 'Kalimantan', 'L'),
(9, 'viana', 'Pengawas', 'Padang', 'P');

-- --------------------------------------------------------

--
-- Struktur dari tabel `santri`
--

CREATE TABLE `santri` (
  `id_santri` int(12) NOT NULL,
  `nama_santri` varchar(30) NOT NULL,
  `alamat_santri` varchar(50) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `jns_kelamin_santri` enum('L','P') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `santri`
--

INSERT INTO `santri` (`id_santri`, `nama_santri`, `alamat_santri`, `kelas`, `jns_kelamin_santri`) VALUES
(1, 'M. Ilyas Tri Khaqiqi', 'Bandung', 'A', 'L'),
(2, 'Januar Fariz Hermawan', 'Bandung', '', 'L'),
(3, 'nunung', 'bogor', 'c', 'P'),
(4, 'David', 'Cicaheum', 'A', 'L'),
(5, 'Fikri', 'Cicaheum', 'A', 'L'),
(6, 'Wendy', 'Cicaheum', 'A', 'L'),
(7, 'Kuya', 'Jakarta', 'B', 'L'),
(9, 'Kevin', 'Jakarta', 'B', 'L'),
(10, 'Imanuel', 'Padang', 'A', 'L');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `api_users`
--
ALTER TABLE `api_users`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `api_key` (`api_key`);

--
-- Indeks untuk tabel `kegiatan_tambahan`
--
ALTER TABLE `kegiatan_tambahan`
  ADD PRIMARY KEY (`id_kegiatan_tambahan`);

--
-- Indeks untuk tabel `mata_pembelajaran`
--
ALTER TABLE `mata_pembelajaran`
  ADD PRIMARY KEY (`id_mata_pembelajaran`);

--
-- Indeks untuk tabel `pembelajaran`
--
ALTER TABLE `pembelajaran`
  ADD PRIMARY KEY (`id_pembelajaran`),
  ADD KEY `id_santri` (`id_santri`),
  ADD KEY `id_pengajar` (`id_pengajar`),
  ADD KEY `id_pengawas` (`id_pengawas`),
  ADD KEY `id_mata_pembelajaran` (`id_mata_pembelajaran`),
  ADD KEY `id_kegiatan_tambahan` (`id_kegiatan_tambahan`);

--
-- Indeks untuk tabel `pengajar`
--
ALTER TABLE `pengajar`
  ADD PRIMARY KEY (`id_pengajar`);

--
-- Indeks untuk tabel `pengawas`
--
ALTER TABLE `pengawas`
  ADD PRIMARY KEY (`id_pengawas`);

--
-- Indeks untuk tabel `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`id_santri`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kegiatan_tambahan`
--
ALTER TABLE `kegiatan_tambahan`
  MODIFY `id_kegiatan_tambahan` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `mata_pembelajaran`
--
ALTER TABLE `mata_pembelajaran`
  MODIFY `id_mata_pembelajaran` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pembelajaran`
--
ALTER TABLE `pembelajaran`
  MODIFY `id_pembelajaran` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pengajar`
--
ALTER TABLE `pengajar`
  MODIFY `id_pengajar` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pengawas`
--
ALTER TABLE `pengawas`
  MODIFY `id_pengawas` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `santri`
--
ALTER TABLE `santri`
  MODIFY `id_santri` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembelajaran`
--
ALTER TABLE `pembelajaran`
  ADD CONSTRAINT `pembelajaran_ibfk_1` FOREIGN KEY (`id_santri`) REFERENCES `santri` (`id_santri`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelajaran_ibfk_2` FOREIGN KEY (`id_pengawas`) REFERENCES `pengawas` (`id_pengawas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelajaran_ibfk_3` FOREIGN KEY (`id_pengajar`) REFERENCES `pengajar` (`id_pengajar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelajaran_ibfk_4` FOREIGN KEY (`id_mata_pembelajaran`) REFERENCES `mata_pembelajaran` (`id_mata_pembelajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelajaran_ibfk_5` FOREIGN KEY (`id_kegiatan_tambahan`) REFERENCES `kegiatan_tambahan` (`id_kegiatan_tambahan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

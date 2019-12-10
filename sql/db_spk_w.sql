-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Nov 2019 pada 17.56
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk_w`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_alternatif`
--

CREATE TABLE `t_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_alternatif`
--

INSERT INTO `t_alternatif` (`id_alternatif`, `nama_alternatif`) VALUES
(2, 'AFD – OA Blok 002'),
(3, 'AFD – OA Blok 003'),
(4, 'AFD – OA Blok 004'),
(5, 'AFD – OA Blok 005'),
(6, 'AFD – OA Blok 008'),
(7, 'AFD – OA Blok 009'),
(8, 'AFD – OA Blok 010'),
(9, 'AFD – OA Blok 015'),
(10, 'AFD – OD Blok 010'),
(11, 'AFD – OD Blok 016'),
(12, 'AFD – OD Blok 017'),
(13, 'AFD – OG Blok 002'),
(14, 'AFD – OG Blok 003'),
(15, 'AFD – OG Blok 008'),
(16, 'AFD – OG Blok 009'),
(17, 'AFD – OG Blok 010'),
(18, 'AFD – OG Blok 014'),
(19, 'AFD – OG Blok 015'),
(20, 'AFD – OG Blok 016'),
(21, 'AFD – OG Blok 021'),
(22, 'AFD – OG Blok 022'),
(23, 'AFD – OG Blok 023'),
(24, 'AFD – OG Blok 024'),
(25, 'AFD – OJ Blok 001'),
(26, 'AFD – OJ Blok 004'),
(27, 'AFD – OJ Blok 005'),
(28, 'AFD – OJ Blok 006');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_hasil`
--

CREATE TABLE `t_hasil` (
  `id` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `hasil` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_hasil`
--

INSERT INTO `t_hasil` (`id`, `id_alternatif`, `hasil`) VALUES
(5, 2, 2.55),
(6, 3, 0.85);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kriteria`
--

CREATE TABLE `t_kriteria` (
  `id_kriteria` int(10) NOT NULL,
  `nama_kriteria` varchar(30) NOT NULL,
  `rank` int(11) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_kriteria`
--

INSERT INTO `t_kriteria` (`id_kriteria`, `nama_kriteria`, `rank`, `bobot`) VALUES
(1, 'Luas Area', 1, 0.456667),
(2, 'Tekstur Tanah', 2, 0.256667),
(3, 'Curah Hujan', 3, 0.156667),
(4, 'Lereng', 4, 0.09),
(5, 'Topografi', 5, 0.04);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pegawai`
--

CREATE TABLE `t_pegawai` (
  `id_pegawai` int(10) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat` varchar(20) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_pegawai`
--

INSERT INTO `t_pegawai` (`id_pegawai`, `nama_pegawai`, `tanggal_lahir`, `tempat`, `jabatan`, `email`) VALUES
(1, 'anang', '2019-10-01', 'Dumai', 'Admin', 'annagfriendshell@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_perangkingan`
--

CREATE TABLE `t_perangkingan` (
  `id` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(10) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_perangkingan`
--

INSERT INTO `t_perangkingan` (`id`, `id_alternatif`, `id_kriteria`, `bobot`) VALUES
(1, 2, 1, 0.45),
(2, 2, 2, 0.45),
(3, 2, 3, 0.52),
(4, 2, 4, 0.52),
(5, 2, 5, 0.61),
(6, 3, 1, 0.16),
(7, 3, 2, 0.16),
(8, 3, 3, 0.14),
(9, 3, 4, 0.28),
(10, 3, 5, 0.11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_sub_kriteria`
--

CREATE TABLE `t_sub_kriteria` (
  `id_sub` int(11) NOT NULL,
  `id_kriteria` int(10) NOT NULL,
  `nama_sub_kriteria` varchar(50) NOT NULL,
  `rang` int(11) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_sub_kriteria`
--

INSERT INTO `t_sub_kriteria` (`id_sub`, `id_kriteria`, `nama_sub_kriteria`, `rang`, `bobot`) VALUES
(7, 1, '>51 ha', 1, 0.45),
(8, 1, '36-50 ha', 2, 0.26),
(9, 1, '26-35 ha', 3, 0.16),
(10, 1, '16-25 ha', 4, 0.09),
(11, 1, '<15 ha', 5, 0.04),
(12, 2, 'gambut', 1, 0.45),
(13, 2, 'gambut - liat', 2, 0.26),
(14, 2, 'liat', 3, 0.16),
(15, 2, 'liat - pasir', 4, 0.09),
(16, 2, 'pasir', 5, 0.04),
(17, 3, '2000-2500', 1, 0.52),
(18, 3, '1800-2000', 2, 0.28),
(19, 3, '1500-1800', 3, 0.14),
(20, 3, '<1500 atau >2500', 4, 0.06),
(21, 4, '0 - 15 %', 1, 0.52),
(22, 4, '16-25 %', 2, 0.28),
(23, 4, '26-36 %', 3, 0.14),
(24, 4, '37 > %', 4, 0.06),
(25, 5, '(DTR) datar', 1, 0.61),
(26, 5, '(Roll-1) datar-bergelombang', 2, 0.28),
(27, 5, '(Roll-2) bergelombang', 3, 0.11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `jabatan` enum('admin','manager','','') NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id_user`, `username`, `password`, `jabatan`, `nama`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_alternatif`
--
ALTER TABLE `t_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `t_hasil`
--
ALTER TABLE `t_hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_kriteria`
--
ALTER TABLE `t_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `t_pegawai`
--
ALTER TABLE `t_pegawai`
  ADD UNIQUE KEY `id_pegawai` (`id_pegawai`) USING BTREE;

--
-- Indeks untuk tabel `t_perangkingan`
--
ALTER TABLE `t_perangkingan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_sub_kriteria`
--
ALTER TABLE `t_sub_kriteria`
  ADD PRIMARY KEY (`id_sub`),
  ADD KEY `id_krit_idx` (`id_kriteria`);

--
-- Indeks untuk tabel `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_alternatif`
--
ALTER TABLE `t_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `t_hasil`
--
ALTER TABLE `t_hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `t_kriteria`
--
ALTER TABLE `t_kriteria`
  MODIFY `id_kriteria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `t_perangkingan`
--
ALTER TABLE `t_perangkingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `t_sub_kriteria`
--
ALTER TABLE `t_sub_kriteria`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_pegawai`
--
ALTER TABLE `t_pegawai`
  ADD CONSTRAINT `t_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

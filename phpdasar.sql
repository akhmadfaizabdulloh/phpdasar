-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 28 Sep 2023 pada 15.35
-- Versi server: 11.1.2-MariaDB
-- Versi PHP: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpdasar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nrp` char(8) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `nrp`, `email`, `jurusan`, `gambar`) VALUES
(1, 'Akhmad Faiz Abdulloh', '95221008', '95221008@student.itk.ac.id', 'informatika', 'dazai.jpeg'),
(2, 'pasuruan dev', '95221010', 'pasuruan.dev@student.itk.ac.id', 'ilmu komputer', 'pasdev.png'),
(5, 'Parida', '95221093', 'parida@gmail.com', 'teknik fisika', 'praida.png'),
(12, 'asasas', 'asa', '<h1>sandikgalih@gmail.com</h1>', 'as', 'sasa'),
(14, '&lt;div style=position:absolute;top:0;bottom:0;left:0;right:0;background-color:black;font-size:100px;color:red;text-align:center;&gt;HAHAHAHAA ANDA TELAH DI HACK!!!&lt;/div&gt;', '13131', 'qww', '111', 'w'),
(15, 'testing ubah data', '1231213', 'dsmdk', 'ddmwmd', 'mdkwmkmw'),
(16, 'yakin ubah ', '7776565', 'test', 'ddmwmd', 'mdkwmkmw'),
(17, '', 'as', '', '', '20220806_120823_798.jpg'),
(19, 'kawaii', 'kawai', 'kawai@gmail.com', 'Pendidikan Fisika', '64ef1a52d6ad9.jpg'),
(20, 'dkkd', 'an', 'djnj', 'djnj', '64ef157b273ec.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'faiz', '$2y$10$oBaCD.FnSlLTp3eQ8Ox5bez3a0goDFPLdrdTqVFc0HjFdz7i/nvoa'),
(2, 'admin', '$2y$10$DAYVIesBKjFLNdInzlitVegP02.yHcBdfy0jc2JiinUPtuh02Ftne'),
(3, ' ', '$2y$10$aF6b.BAzm6VH3/EbmF.T6OKrWITVYxdSqZBNhdoMHhiNWFAgWCv0G');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

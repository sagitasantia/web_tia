-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Apr 2024 pada 06.46
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_super` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `is_super`) VALUES
(1, 'telurgoreng', '$2y$10$R4tlHfKxC.eOCfWs8Ron3OrSSziRVKCizsdMr4/IkE5KQcc96kcCq', 1),
(4, 'tia', '$2y$10$DD3P9btudQ4er6DfGWP/NOHMx6MGMgA9Nv9wJMxuimJFwo10noURG', 0),
(5, 'tia', '$2y$10$DD3P9btudQ4er6DfGWP/NOHMx6MGMgA9Nv9wJMxuimJFwo10noURG', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` varchar(255) NOT NULL,
  `jenis_pengaduan` varchar(50) NOT NULL,
  `deskripsi_pengaduan` text NOT NULL,
  `berkas_pendukung` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'diproses',
  `Aksi` varchar(255) NOT NULL,
  `nim_mahasiswa` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id`, `jenis_pengaduan`, `deskripsi_pengaduan`, `berkas_pendukung`, `created_at`, `status`, `Aksi`, `nim_mahasiswa`) VALUES
('65f548657cbce', 'Fasilitas', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, accusantium molestiae. Odit error corrupti minus, qui ex adipisci deleniti laboriosam voluptatem architecto perspiciatis aut totam inventore, ipsum pariatur perferendis natus quae facilis obcaecati, magni nisi hic! Doloremque dicta laborum nostrum eaque suscipit officiis explicabo provident iure, recusandae impedit ullam natus alias facilis quisquam illum voluptate porro quas, quibusdam nisi eos reprehenderit! Voluptate sed perferendis tempora, eius, minima molestiae accusamus impedit voluptatum fugit aperiam, vitae fuga!', '65f548657cbce.jpeg', '2024-03-17 00:16:53', 'selesai', '', '2209106138'),
('65f56821b7cfd', 'Akademik', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis, blanditiis enim nisi commodi nam quis ad modi eaque dolores corporis voluptate facilis pariatur repudiandae, minus, adipisci consectetur dicta dolorum. Pariatur assumenda reprehenderit qui odit cum temporibus mollitia, dicta itaque culpa molestiae deserunt omnis ut maiores quisquam iste quidem officia! Laborum exercitationem dignissimos sunt id sint! Corrupti eius, mollitia aut blanditiis beatae pariatur reprehenderit obcaecati laboriosam, odit iusto iste illum corporis ratione omnis harum ad magni expedita sint voluptatem dolor! Repellat eos molestiae incidunt hic blanditiis rerum ullam quos quae quis obcaecati nulla vero, eveniet doloribus nobis. Animi quos natus veritatis!', '', '2024-03-17 00:16:53', 'selesai', '', '2209106138'),
('66095d67f3c68', 'UKT', 'mahal mahal gedungnya jelek', '', '2024-03-31 20:56:07', 'ditolak', 'ga sesuai', '2209116043'),
('660cb619d4bef', 'Akademik', 'mmm', '', '2024-04-03 09:51:21', 'diproses', '', '2209116043');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` char(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `prodi`, `password`) VALUES
('2209106138', 'Ali', 'Informatika', '$2y$10$sVYA2WAmcxgVXbYSd6Jhb./0qPMej268ve2oxPPd4q3V/s1V6ds0m'),
('2209116043', 'sagita santia', 'sistem informasi', '$2y$10$2R5BFpi95hsn8DCT1iG9auQZB3Iwyf1df46v8ixmwledY.ViWbhaK');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_laporan_mahasiswa` (`nim_mahasiswa`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `fk_laporan_mahasiswa` FOREIGN KEY (`nim_mahasiswa`) REFERENCES `mahasiswa` (`nim`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

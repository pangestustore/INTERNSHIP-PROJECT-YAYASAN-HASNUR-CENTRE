-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Agu 2024 pada 20.32
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
-- Database: `db_courseonline`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `duration` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `duration`) VALUES
(17, 'Kursus Pemrograman Web', 'Belajar dasar-dasar pemrograman web menggunakan HTML, CSS, dan JavaScript.', '3 Bulan'),
(18, 'Kursus Manajemen Proyek', 'Memahami prinsip-prinsip manajemen proyek untuk memastikan proyek berjalan sesuai rencana.', '4 Bulan'),
(19, 'Dasar-Dasar Pengembangan Web', 'Pelajari dasar-dasar pengembangan web termasuk HTML, CSS, dan JavaScript.', '6 minggu'),
(20, 'Pemrograman Python Lanjutan', 'Mendalami konsep-konsep lanjutan Python dan pustaka-pustakanya.', '8 minggu'),
(21, 'Ilmu Data dengan R', 'Pengenalan ilmu data menggunakan bahasa pemrograman R.', '7 minggu'),
(22, 'Pengenalan Pembelajaran Mesin', 'Pelajari konsep dasar pembelajaran mesin.', '10 minggu'),
(23, 'Dasar-Dasar Pemasaran Digital', 'Memahami dasar-dasar strategi dan alat pemasaran digital.', '5 minggu'),
(24, 'Komputasi Awan dengan AWS', 'Pelajari dasar-dasar komputasi awan menggunakan layanan AWS.', '9 minggu'),
(25, 'Kursus Pemrograman Web', 'Belajar dasar-dasar pemrograman web menggunakan HTML, CSS, dan JavaScript.', '3 Bulan'),
(26, 'Kursus Manajemen Proyek', 'Memahami prinsip-prinsip manajemen proyek untuk memastikan proyek berjalan sesuai rencana.', '4 Bulan'),
(27, 'Dasar-Dasar Pengembangan Web', 'Pelajari dasar-dasar pengembangan web termasuk HTML, CSS, dan JavaScript.', '6 minggu'),
(28, 'Pemrograman Python Lanjutan', 'Mendalami konsep-konsep lanjutan Python dan pustaka-pustakanya.', '8 minggu'),
(29, 'Ilmu Data dengan R', 'Pengenalan ilmu data menggunakan bahasa pemrograman R.', '7 minggu'),
(30, 'Pengenalan Pembelajaran Mesin', 'Pelajari konsep dasar pembelajaran mesin.', '10 minggu'),
(31, 'Dasar-Dasar Pemasaran Digital', 'Memahami dasar-dasar strategi dan alat pemasaran digital.', '5 minggu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `embed_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `materials`
--

INSERT INTO `materials` (`id`, `course_id`, `title`, `description`, `embed_link`) VALUES
(41, 17, 'Pengelolaan File dalam Python', 'Pelajari cara mengelola file dan direktori menggunakan Python.', 'https://www.example.com/embed/python-file-handling'),
(42, 19, 'CSS untuk Pemula', 'Panduan CSS untuk membuat tampilan web yang menarik.', 'https://www.youtube.com/embed/yfoY53QXEnI'),
(43, 25, 'Pengantar MySQL', 'Tutorial dasar mengenai penggunaan MySQL untuk pemula.', 'https://www.youtube.com/embed/9ylj9tZ2pFk'),
(44, 23, 'Desain Logo dengan Illustrator', 'Belajar membuat logo dengan Adobe Illustrator.', 'https://www.youtube.com/embed/4mUjEawN3TQ'),
(45, 27, 'Membangun Aplikasi Mobile dengan Flutter', 'Panduan untuk memulai pengembangan aplikasi mobile menggunakan Flutter.', 'https://www.youtube.com/embed/1gDhl4leH1I'),
(46, 19, 'Tutorial HTML Dasar', 'Belajar HTML dari dasar dengan tutorial ini.', 'https://www.youtube.com/embed/dD2EISBDjWM');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

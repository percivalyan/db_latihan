-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Okt 2024 pada 12.18
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
-- Database: `db_latihan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_dosen`
--

CREATE TABLE `tabel_dosen` (
  `kode_dosen` int(11) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tabel_dosen`
--

INSERT INTO `tabel_dosen` (`kode_dosen`, `nama_dosen`, `jenis_kelamin`, `alamat`, `telepon`) VALUES
(1, 'Ahmad', 'L', 'Jalan Raya Pahlawan No. 2, Depok', '081234567890'),
(2, 'Bella', 'P', 'Jalan Merdeka No. 4, Tangerang', '081234567891'),
(3, 'Candi', 'P', 'Jalan Kebon Jeruk No. 3, Bogor', '081234567892'),
(4, 'Deni', 'L', 'Jalan Raya Bogor No. 6, Depok', '081234567893'),
(5, 'Eni', 'P', 'Jalan Taman No. 8, Tangerang', '081234567894'),
(6, 'Fandi', 'L', 'Jalan Jendral Sudirman No. 1, Bogor', '081234567895'),
(7, 'Gita', 'P', 'Jalan Citra No. 7, Depok', '081234567896'),
(8, 'Hendra', 'L', 'Jalan Raya Malabar No. 10, Tangerang', '081234567897'),
(9, 'Indra', 'L', 'Jalan Siliwangi No. 5, Bogor', '081234567898'),
(10, 'Joko', 'L', 'Jalan Sudirman No. 9, Depok', '081234567899');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_jadwal`
--

CREATE TABLE `tabel_jadwal` (
  `id` int(11) NOT NULL,
  `kode_matakuliah` int(11) DEFAULT NULL,
  `kode_dosen` int(11) DEFAULT NULL,
  `hari` varchar(10) NOT NULL,
  `jam` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tabel_jadwal`
--

INSERT INTO `tabel_jadwal` (`id`, `kode_matakuliah`, `kode_dosen`, `hari`, `jam`) VALUES
(1, 1, 1, 'Senin', '08:00-10:00'),
(2, 2, 2, 'Selasa', '10:00-12:00'),
(3, 3, 3, 'Rabu', '08:00-10:00'),
(4, 4, 4, 'Kamis', '10:00-12:00'),
(5, 5, 5, 'Jumat', '08:00-10:00'),
(6, 6, 6, 'Senin', '10:00-12:00'),
(7, 7, 7, 'Selasa', '08:00-10:00'),
(8, 8, 8, 'Rabu', '10:00-12:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_krs`
--

CREATE TABLE `tabel_krs` (
  `id` int(11) NOT NULL,
  `nim` int(11) DEFAULT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `kode_semester` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tabel_krs`
--

INSERT INTO `tabel_krs` (`id`, `nim`, `id_jadwal`, `kode_semester`) VALUES
(1, 101, 1, 1),
(2, 102, 2, 1),
(3, 103, 3, 1),
(4, 104, 4, 1),
(5, 105, 5, 1),
(6, 106, 6, 1),
(7, 107, 7, 1),
(8, 108, 8, 1),
(9, 109, 1, 3),
(10, 110, 2, 3),
(11, 111, 3, 3),
(12, 112, 4, 3),
(13, 113, 5, 3),
(14, 114, 6, 3),
(15, 115, 7, 3),
(16, 116, 8, 3),
(17, 117, 1, 5),
(18, 118, 2, 5),
(19, 119, 3, 5),
(20, 120, 4, 5),
(21, 121, 5, 5),
(22, 122, 6, 5),
(23, 123, 7, 5),
(24, 124, 8, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_mahasiswa`
--

CREATE TABLE `tabel_mahasiswa` (
  `nim` int(11) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(2) NOT NULL,
  `alamat` text DEFAULT NULL,
  `jurusan` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tabel_mahasiswa`
--

INSERT INTO `tabel_mahasiswa` (`nim`, `nama_mahasiswa`, `jenis_kelamin`, `alamat`, `jurusan`) VALUES
(101, 'Andi Santoso', 'L', 'Jalan Margonda No. 5, Depok', 'TI'),
(102, 'Budi Setiawan', 'L', 'Jalan Raya Siliwangi No. 10, Bogor', 'SI'),
(103, 'Citra Melati', 'P', 'Jalan Cihampelas No. 8, Tangerang', 'TK'),
(104, 'Dewi Anjani', 'P', 'Jalan Duren Raya No. 15, Depok', 'TI'),
(105, 'Eko Prasetyo', 'L', 'Jalan Ciomas No. 3, Bogor', 'SI'),
(106, 'Fajar Ramadhan', 'L', 'Jalan Sudirman No. 25, Tangerang', 'TK'),
(107, 'Galih Rendra', 'L', 'Jalan M.H. Thamrin No. 12, Depok', 'TI'),
(108, 'Hani Lestari', 'P', 'Jalan Perintis Kemerdekaan No. 7, Bogor', 'SI'),
(109, 'Imam Subagyo', 'L', 'Jalan Jendral Sudirman No. 4, Tangerang', 'TK'),
(110, 'Jihan Khairani', 'P', 'Jalan Raya Bogor No. 20, Depok', 'TI'),
(111, 'Krisna Aditya', 'L', 'Jalan Siliwangi No. 11, Tangerang', 'SI'),
(112, 'Lutfi Rahman', 'L', 'Jalan Ir. H. Juanda No. 6, Bogor', 'TK'),
(113, 'Maya Intan', 'P', 'Jalan Raden Saleh No. 9, Depok', 'TI'),
(114, 'Nanda Pramesti', 'P', 'Jalan Raya Pahlawan No. 18, Tangerang', 'SI'),
(115, 'Oka Suryana', 'L', 'Jalan Suryakencana No. 13, Bogor', 'TK'),
(116, 'Pramudya Cahyo', 'L', 'Jalan Raya Juanda No. 5, Depok', 'TI'),
(117, 'Rizki Putra', 'L', 'Jalan Baranangsiang No. 2, Bogor', 'SI'),
(118, 'Sari Indah', 'P', 'Jalan Citra No. 14, Tangerang', 'TK'),
(119, 'Teguh Santoso', 'L', 'Jalan Koperasi No. 1, Depok', 'TI'),
(120, 'Untung Saputra', 'L', 'Jalan Keadilan No. 8, Tangerang', 'SI'),
(121, 'Vira Yuliana', 'P', 'Jalan Kenanga No. 3, Bogor', 'TK'),
(122, 'Wawan Agung', 'L', 'Jalan Sempur No. 6, Depok', 'TI'),
(123, 'Yuniar Desi', 'P', 'Jalan Sadar No. 5, Tangerang', 'SI'),
(124, 'Zaky Firmansyah', 'L', 'Jalan Raya Malabar No. 12, Bogor', 'TK'),
(125, 'Aji Prabowo', 'L', 'Jalan Raya Cibubur No. 14, Depok', 'TI'),
(126, 'Cinta Indriani', 'P', 'Jalan Kuningan No. 16, Tangerang', 'SI'),
(127, 'Dika Rahadian', 'L', 'Jalan Mangga No. 12, Bogor', 'TK'),
(128, 'Eva Kusumawati', 'P', 'Jalan Raya Sejahtera No. 20, Depok', 'TI'),
(129, 'Farhan Rizky', 'L', 'Jalan Raya Puncak No. 8, Bogor', 'SI'),
(130, 'Gina Lestari', 'P', 'Jalan Buah No. 5, Tangerang', 'TK'),
(131, 'Husni Alamsyah', 'L', 'Jalan Pahlawan No. 3, Depok', 'TI'),
(132, 'Ika Amalia', 'P', 'Jalan Bunga No. 9, Tangerang', 'SI'),
(133, 'Jaya Santoso', 'L', 'Jalan Jati No. 6, Bogor', 'TK'),
(134, 'Kiki Putri', 'P', 'Jalan Damai No. 11, Depok', 'TI'),
(135, 'Lina Ratnasari', 'P', 'Jalan Mentari No. 4, Tangerang', 'SI'),
(136, 'Mika Anindita', 'P', 'Jalan Rindang No. 7, Bogor', 'TK'),
(137, 'Niko Adi', 'L', 'Jalan Mawar No. 2, Depok', 'TI'),
(138, 'Omar Bayu', 'L', 'Jalan Rawa No. 13, Tangerang', 'SI'),
(139, 'Putri Ramadhani', 'P', 'Jalan Cendana No. 15, Bogor', 'TK'),
(140, 'Rizki Abdurrahman', 'L', 'Jalan Suka No. 18, Depok', 'TI'),
(141, 'Sari Wulandari', 'P', 'Jalan Kebon Nanas No. 21, Tangerang', 'SI'),
(142, 'Tama Perdana', 'L', 'Jalan Sejahtera No. 17, Bogor', 'TK'),
(143, 'Umi Kalsum', 'P', 'Jalan Cibubur No. 19, Depok', 'TI'),
(144, 'Vino Raharja', 'L', 'Jalan Biru No. 10, Tangerang', 'SI'),
(145, 'Wira Ananda', 'L', 'Jalan Sayang No. 24, Bogor', 'TK'),
(146, 'Yasmin Tania', 'P', 'Jalan Terang No. 22, Depok', 'TI'),
(147, 'Zara Hani', 'P', 'Jalan Mutiara No. 23, Tangerang', 'SI'),
(148, 'Anisa Pertiwi', 'P', 'Jalan Hujan No. 25, Bogor', 'TK'),
(149, 'Budi Santoso', 'L', 'Jalan Kenanga No. 26, Depok', 'TI'),
(150, 'Cahya Suryana', 'L', 'Jalan Pelangi No. 27, Tangerang', 'SI'),
(151, 'Dewi Hidayati', 'P', 'Jalan Gembira No. 28, Bogor', 'TK'),
(152, 'Eko Setiawan', 'L', 'Jalan Taman No. 29, Depok', 'TI'),
(153, 'Fahri Alamsyah', 'L', 'Jalan Puspa No. 30, Tangerang', 'SI'),
(154, 'Gita Yuliana', 'P', 'Jalan Bintang No. 31, Bogor', 'TK'),
(155, 'Hendi Prasetyo', 'L', 'Jalan Jaya No. 32, Depok', 'TI'),
(156, 'Iwan Maulana', 'L', 'Jalan Fajar No. 33, Tangerang', 'SI'),
(157, 'Jeni Sari', 'P', 'Jalan Bumi No. 34, Bogor', 'TK'),
(158, 'Kurniawan', 'L', 'Jalan Indah No. 35, Depok', 'TI'),
(159, 'Larasati', 'P', 'Jalan Harmoni No. 36, Tangerang', 'SI'),
(160, 'Milan Dhananjaya', 'L', 'Jalan Citra No. 37, Bogor', 'TK'),
(161, 'Nita Adisty', 'P', 'Jalan Tanjung No. 38, Depok', 'TI'),
(162, 'Oki Ferdiansyah', 'L', 'Jalan Suka No. 39, Tangerang', 'SI'),
(163, 'Putra Kuncoro', 'L', 'Jalan Air No. 40, Bogor', 'TK'),
(164, 'Rina Widiastuti', 'P', 'Jalan Mentari No. 41, Depok', 'TI'),
(165, 'Sandi Ahmad', 'L', 'Jalan Kembang No. 42, Tangerang', 'SI'),
(166, 'Tina Julianti', 'P', 'Jalan Sari No. 43, Bogor', 'TK'),
(167, 'Udin Slamet', 'L', 'Jalan Bahagia No. 44, Depok', 'TI'),
(168, 'Vira Melati', 'P', 'Jalan Murni No. 45, Tangerang', 'SI'),
(169, 'Wawan Kurnia', 'L', 'Jalan Pahlawan No. 46, Bogor', 'TK'),
(170, 'Yosep Mahardika', 'L', 'Jalan Palem No. 47, Depok', 'TI'),
(171, 'Zara Nayla', 'P', 'Jalan Teratai No. 48, Tangerang', 'SI'),
(172, 'Arief Aji', 'L', 'Jalan Mawar No. 49, Bogor', 'TK'),
(173, 'Bunga Permata', 'P', 'Jalan Air No. 50, Depok', 'TI'),
(174, 'Cahya Irawan', 'L', 'Jalan Cemara No. 51, Tangerang', 'SI'),
(175, 'Dinda Shafira', 'P', 'Jalan Sinar No. 52, Bogor', 'TK'),
(176, 'Eka Darmawan', 'L', 'Jalan Sejahtera No. 53, Depok', 'TI'),
(177, 'Ferry Nugraha', 'L', 'Jalan Harapan No. 54, Tangerang', 'SI'),
(178, 'Gina Safira', 'P', 'Jalan Cempaka No. 55, Bogor', 'TK'),
(179, 'Hendra Fadillah', 'L', 'Jalan Rinjani No. 56, Depok', 'TI'),
(180, 'Intan Arum', 'P', 'Jalan Kasih No. 57, Tangerang', 'SI'),
(181, 'Jaya Putra', 'L', 'Jalan Palapa No. 58, Bogor', 'TK'),
(182, 'Kiki Amelia', 'P', 'Jalan Kenangan No. 59, Depok', 'TI'),
(183, 'Lutfi Hasan', 'L', 'Jalan Terang No. 60, Tangerang', 'SI'),
(184, 'Mira Indri', 'P', 'Jalan Damai No. 61, Bogor', 'TK'),
(185, 'Nugroho', 'L', 'Jalan Cinta No. 62, Depok', 'TI'),
(186, 'Okti Jaya', 'L', 'Jalan Mulia No. 63, Tangerang', 'SI'),
(187, 'Putri Ayu', 'P', 'Jalan Mentari No. 64, Bogor', 'TK'),
(188, 'Randi Wijaya', 'L', 'Jalan Puspa No. 65, Depok', 'TI'),
(189, 'Siti Farida', 'P', 'Jalan Harapan No. 66, Tangerang', 'SI'),
(190, 'Tanto Aji', 'L', 'Jalan Jaya No. 67, Bogor', 'TK'),
(191, 'Uci Aprilia', 'P', 'Jalan Kebun No. 68, Depok', 'TI'),
(192, 'Vivi Nabila', 'P', 'Jalan Pahlawan No. 69, Tangerang', 'SI'),
(193, 'Wahyu Setiawan', 'L', 'Jalan Suka No. 70, Bogor', 'TK'),
(194, 'Yani Kusumawati', 'P', 'Jalan Sukacita No. 71, Depok', 'TI'),
(195, 'Zulfiqri', 'L', 'Jalan Harapan No. 72, Tangerang', 'SI'),
(196, 'Alva Ramadhan', 'L', 'Jalan Silang No. 73, Bogor', 'TK'),
(197, 'Bela Cinta', 'P', 'Jalan Pusat No. 74, Depok', 'TI'),
(198, 'Candra Pramono', 'L', 'Jalan Jaya No. 75, Tangerang', 'SI'),
(199, 'Dika Hendra', 'L', 'Jalan Agung No. 76, Bogor', 'TK'),
(200, 'Elisa Kirana', 'P', 'Jalan Mawar No. 77, Depok', 'TI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_matakuliah`
--

CREATE TABLE `tabel_matakuliah` (
  `kode_matakuliah` int(11) NOT NULL,
  `nama_matakuliah` varchar(50) NOT NULL,
  `sks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tabel_matakuliah`
--

INSERT INTO `tabel_matakuliah` (`kode_matakuliah`, `nama_matakuliah`, `sks`) VALUES
(1, 'Algoritma dan Pemrograman', 3),
(2, 'Basis Data', 3),
(3, 'Rekayasa Perangkat Lunak', 4),
(4, 'Jaringan Komputer', 3),
(5, 'Sistem Informasi', 3),
(6, 'Pengembangan Web', 4),
(7, 'Kecerdasan Buatan', 4),
(8, 'Analisis dan Perancangan Sistem', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_semester`
--

CREATE TABLE `tabel_semester` (
  `kode_semester` int(11) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tabel_semester`
--

INSERT INTO `tabel_semester` (`kode_semester`, `semester`, `status`) VALUES
(1, 'Semester 1', 1),
(2, 'Semester 2', 0),
(3, 'Semester 3', 1),
(4, 'Semester 4', 0),
(5, 'Semester 5', 1),
(6, 'Semester 6', 0),
(7, 'Semester 7', 1),
(8, 'Semester 8', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_user`
--

CREATE TABLE `tabel_user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tabel_dosen`
--
ALTER TABLE `tabel_dosen`
  ADD PRIMARY KEY (`kode_dosen`);

--
-- Indeks untuk tabel `tabel_jadwal`
--
ALTER TABLE `tabel_jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_matakuliah` (`kode_matakuliah`),
  ADD KEY `kode_dosen` (`kode_dosen`);

--
-- Indeks untuk tabel `tabel_krs`
--
ALTER TABLE `tabel_krs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`nim`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `kode_semester` (`kode_semester`);

--
-- Indeks untuk tabel `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `tabel_matakuliah`
--
ALTER TABLE `tabel_matakuliah`
  ADD PRIMARY KEY (`kode_matakuliah`);

--
-- Indeks untuk tabel `tabel_semester`
--
ALTER TABLE `tabel_semester`
  ADD PRIMARY KEY (`kode_semester`);

--
-- Indeks untuk tabel `tabel_user`
--
ALTER TABLE `tabel_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tabel_jadwal`
--
ALTER TABLE `tabel_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tabel_krs`
--
ALTER TABLE `tabel_krs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tabel_user`
--
ALTER TABLE `tabel_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tabel_jadwal`
--
ALTER TABLE `tabel_jadwal`
  ADD CONSTRAINT `tabel_jadwal_ibfk_1` FOREIGN KEY (`kode_matakuliah`) REFERENCES `tabel_matakuliah` (`kode_matakuliah`),
  ADD CONSTRAINT `tabel_jadwal_ibfk_2` FOREIGN KEY (`kode_dosen`) REFERENCES `tabel_dosen` (`kode_dosen`);

--
-- Ketidakleluasaan untuk tabel `tabel_krs`
--
ALTER TABLE `tabel_krs`
  ADD CONSTRAINT `tabel_krs_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `tabel_mahasiswa` (`nim`),
  ADD CONSTRAINT `tabel_krs_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `tabel_jadwal` (`id`),
  ADD CONSTRAINT `tabel_krs_ibfk_3` FOREIGN KEY (`kode_semester`) REFERENCES `tabel_semester` (`kode_semester`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

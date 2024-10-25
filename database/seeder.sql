USE universitas;

DELETE FROM tabel_mahasiswa;
DELETE FROM tabel_matakuliah;
DELETE FROM tabel_dosen;
DELETE FROM tabel_semester;
DELETE FROM tabel_jadwal;
DELETE FROM tabel_krs;

INSERT INTO tabel_mahasiswa (nim, nama_mahasiswa, jenis_kelamin, alamat, jurusan) VALUES
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
(124, 'Zaky Firmansyah', 'L', 'Jalan Raya Malabar No. 12, Bogor', 'TK');

INSERT INTO tabel_dosen (kode_dosen, nama_dosen, jenis_kelamin, alamat, telepon) VALUES
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

INSERT INTO tabel_matakuliah (kode_matakuliah, nama_matakuliah, sks) VALUES
(1, 'Algoritma dan Pemrograman', 3),
(2, 'Basis Data', 3),
(3, 'Rekayasa Perangkat Lunak', 4),
(4, 'Jaringan Komputer', 3),
(5, 'Sistem Informasi', 3),
(6, 'Pengembangan Web', 4),
(7, 'Kecerdasan Buatan', 4),
(8, 'Analisis dan Perancangan Sistem', 3);

INSERT INTO tabel_semester (kode_semester, semester, status) VALUES
(1, 'Semester 1', 1),
(2, 'Semester 2', 0),
(3, 'Semester 3', 1),
(4, 'Semester 4', 0),
(5, 'Semester 5', 1),
(6, 'Semester 6', 0),
(7, 'Semester 7', 1),
(8, 'Semester 8', 0);

INSERT INTO tabel_jadwal (kode_matakuliah, kode_dosen, hari, jam) VALUES
(1, 1, 'Senin', '08:00-10:00'),
(2, 2, 'Selasa', '10:00-12:00'),
(3, 3, 'Rabu', '08:00-10:00'),
(4, 4, 'Kamis', '10:00-12:00'),
(5, 5, 'Jumat', '08:00-10:00'),
(6, 6, 'Senin', '10:00-12:00'),
(7, 7, 'Selasa', '08:00-10:00'),
(8, 8, 'Rabu', '10:00-12:00');

INSERT INTO tabel_krs (nim, id_jadwal, kode_semester) VALUES
(101, 1, 1),
(102, 2, 1),
(103, 3, 1),
(104, 4, 1),
(105, 5, 1),
(106, 6, 1),
(107, 7, 1),
(108, 8, 1),
(109, 1, 3),
(110, 2, 3),
(111, 3, 3),
(112, 4, 3),
(113, 5, 3),
(114, 6, 3),
(115, 7, 3),
(116, 8, 3),
(117, 1, 5),
(118, 2, 5),
(119, 3, 5),
(120, 4, 5),
(121, 5, 5),
(122, 6, 5),
(123, 7, 5),
(124, 8, 5);

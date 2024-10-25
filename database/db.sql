-- CREATE DATABASE db_latihan;

USE db_latihan;

CREATE TABLE tabel_mahasiswa (
    nim INT(11) PRIMARY KEY,
    nama_mahasiswa VARCHAR(50) NOT NULL,
    jenis_kelamin VARCHAR(2) NOT NULL,
    alamat TEXT,
    jurusan VARCHAR(2) NOT NULL
);

CREATE TABLE tabel_matakuliah (
    kode_matakuliah INT(11) PRIMARY KEY,
    nama_matakuliah VARCHAR(50) NOT NULL,
    sks INT NOT NULL
);

CREATE TABLE tabel_dosen (
    kode_dosen INT(11) PRIMARY KEY,
    nama_dosen VARCHAR(50) NOT NULL,
    jenis_kelamin VARCHAR(1) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(15) NOT NULL
);

CREATE TABLE tabel_semester (
    kode_semester INT(11) PRIMARY KEY,
    semester VARCHAR(20) NOT NULL,
    status INT(11) NOT NULL
);

CREATE TABLE tabel_jadwal (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    kode_matakuliah INT(11),
    kode_dosen INT(11),
    hari VARCHAR(10) NOT NULL,
    jam VARCHAR(15) NOT NULL,
    FOREIGN KEY (kode_matakuliah) REFERENCES tabel_matakuliah(kode_matakuliah),
    FOREIGN KEY (kode_dosen) REFERENCES tabel_dosen(kode_dosen)
);

CREATE TABLE tabel_krs (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nim INT(11),
    id_jadwal INT(11),
    kode_semester INT(11),
    FOREIGN KEY (nim) REFERENCES tabel_mahasiswa(nim),
    FOREIGN KEY (id_jadwal) REFERENCES tabel_jadwal(id),
    FOREIGN KEY (kode_semester) REFERENCES tabel_semester(kode_semester)
);

CREATE TABLE tabel_user (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL,
    password VARCHAR(100) NOT NULL
);

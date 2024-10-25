<?php
$host = 'localhost';
$db   = 'universitas';
$user = 'root'; // Ganti dengan username database Anda
$pass = ''; // Ganti dengan password database Anda

// Membuat koneksi
$connection = mysqli_connect($host, $user, $pass, $db);

// Memeriksa koneksi
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Kode Anda selanjutnya dapat ditulis di sini

// Menutup koneksi
// mysqli_close($connection);
?>

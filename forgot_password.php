<?php
session_start();
require 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    // Implementasikan logika untuk reset password di sini
    // Biasanya, Anda mengirimkan email dengan link untuk reset password
    echo "Link untuk reset password telah dikirim!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <button type="submit">Kirim Link Reset Password</button>
    </form>
</body>
</html>

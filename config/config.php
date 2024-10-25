<?php
$host = 'localhost';
$db   = 'db_latihan';
$user = 'root';
$pass = '';

$connection = mysqli_connect($host, $user, $pass, $db);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
// mysqli_close($connection);
?>

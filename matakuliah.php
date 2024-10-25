<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'config/config.php';

if (isset($_POST['add'])) {
    $kode_matakuliah = $_POST['kode_matakuliah'];
    $nama_matakuliah = $_POST['nama_matakuliah'];
    $sks = $_POST['sks'];

    if (!ctype_digit($kode_matakuliah) || !ctype_digit($sks)) {
        echo "<script>alert('Kode Mata Kuliah dan SKS harus berupa angka!');</script>";
    } else {
        $stmt = $connection->prepare("INSERT INTO tabel_matakuliah (kode_matakuliah, nama_matakuliah, sks) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $kode_matakuliah, $nama_matakuliah, $sks);
        $stmt->execute();
        $stmt->close();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

if (isset($_GET['delete'])) {
    $kode_matakuliah = $_GET['delete'];
    $stmt = $connection->prepare("DELETE FROM tabel_matakuliah WHERE kode_matakuliah = ?");
    $stmt->bind_param("s", $kode_matakuliah);
    $stmt->execute();
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$result = $connection->query("SELECT * FROM tabel_matakuliah");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Mata Kuliah - Universitas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <?php include('layout/navbar.php'); ?>
    </nav>

    <div class="d-flex">
        <?php include('layout/sidebar.php'); ?>

        <main class="flex-grow-1">
            <div class="container mt-4">
                <h2 class="mb-4">Data Mata Kuliah</h2>
                <form method="POST" class="mb-4">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="kode_matakuliah">Kode Mata Kuliah</label>
                            <input type="text" class="form-control" name="kode_matakuliah" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nama_matakuliah">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" name="nama_matakuliah" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="sks">SKS</label>
                            <input type="number" class="form-control" name="sks" required>
                        </div>
                    </div>

                    <div class="py-2"></div>
                    <button type="submit" name="add" class="btn btn-primary">Tambah Mata Kuliah</button>
                </form>

                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['kode_matakuliah']) ?></td>
                                <td><?= htmlspecialchars($row['nama_matakuliah']) ?></td>
                                <td><?= htmlspecialchars($row['sks']) ?></td>
                                <td>
                                    <a href="?delete=<?= urlencode($row['kode_matakuliah']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <?php include('layout/footer.php'); ?>
</body>

</html>

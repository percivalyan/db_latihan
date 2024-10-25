<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'config/config.php';

if (isset($_POST['add'])) {
    $kode_dosen = $_POST['kode_dosen'];
    $nama_dosen = $_POST['nama_dosen'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    if (!ctype_digit($kode_dosen) || !preg_match('/^[0-9]{10,15}$/', $telepon)) {
        echo "<script>alert('Kode Dosen harus berupa angka dan Telepon harus valid!');</script>";
    } else {
        $stmt = $connection->prepare("INSERT INTO tabel_dosen (kode_dosen, nama_dosen, jenis_kelamin, alamat, telepon) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $kode_dosen, $nama_dosen, $jenis_kelamin, $alamat, $telepon);
        $stmt->execute();
        $stmt->close();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

if (isset($_GET['delete'])) {
    $kode_dosen = $_GET['delete'];
    $stmt = $connection->prepare("DELETE FROM tabel_dosen WHERE kode_dosen = ?");
    $stmt->bind_param("s", $kode_dosen);
    $stmt->execute();
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$result = $connection->query("SELECT * FROM tabel_dosen");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Dosen - Universitas</title>
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
                <h2 class="mb-4">Data Dosen</h2>
                <form method="POST" class="mb-4">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="kode_dosen">Kode Dosen</label>
                            <input type="text" class="form-control" name="kode_dosen" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nama_dosen">Nama Dosen</label>
                            <input type="text" class="form-control" name="nama_dosen" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" required>
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control" name="telepon" required>
                        </div>
                    </div>

                    <div class="py-2"></div>
                    <button type="submit" name="add" class="btn btn-primary">Tambah Dosen</button>
                </form>

                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Kode Dosen</th>
                            <th>Nama Dosen</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['kode_dosen']) ?></td>
                                <td><?= htmlspecialchars($row['nama_dosen']) ?></td>
                                <td><?= htmlspecialchars($row['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan') ?></td>
                                <td><?= htmlspecialchars($row['alamat']) ?></td>
                                <td><?= htmlspecialchars($row['telepon']) ?></td>
                                <td>
                                    <a href="?delete=<?= urlencode($row['kode_dosen']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus dosen ini?');">Hapus</a>
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

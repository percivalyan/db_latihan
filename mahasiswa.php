<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'config/config.php';

if (isset($_POST['add'])) {
    $nim = $_POST['nim'];
    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $jurusan = $_POST['jurusan'];

    if (!ctype_digit($nim)) {
        echo "<script>alert('NIM harus berupa angka!');</script>";
    } else {
        $stmt = $connection->prepare("INSERT INTO tabel_mahasiswa (nim, nama_mahasiswa, jenis_kelamin, alamat, jurusan) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nim, $nama_mahasiswa, $jenis_kelamin, $alamat, $jurusan);
        $stmt->execute();
        $stmt->close();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

if (isset($_GET['delete'])) {
    $nim = $_GET['delete'];
    $stmt = $connection->prepare("DELETE FROM tabel_mahasiswa WHERE nim = ?");
    $stmt->bind_param("s", $nim);
    $stmt->execute();
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$result = $connection->query("SELECT * FROM tabel_mahasiswa");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Mahasiswa - Universitas</title>
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
                <h2 class="mb-4">Data Mahasiswa</h2>
                <form method="POST" class="mb-4">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" name="nim" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="nama_mahasiswa">Nama Mahasiswa</label>
                            <input type="text" class="form-control" name="nama_mahasiswa" required>
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
                            <label for="jurusan">Jurusan</label>
                            <select class="form-control" name="jurusan" required>
                                <option value="" disabled selected>Pilih Jurusan</option>
                                <option value="TI">Teknik Informatika</option>
                                <option value="SI">Sistem Informasi</option>
                                <option value="TK">Teknik Komputer</option>
                            </select>
                        </div>
                    </div>

                    <div class="py-2"></div>
                    <button type="submit" name="add" class="btn btn-primary">Tambah Mahasiswa</button>
                </form>

                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nim']) ?></td>
                                <td><?= htmlspecialchars($row['nama_mahasiswa']) ?></td>
                                <td><?= htmlspecialchars($row['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan') ?></td>
                                <td><?= htmlspecialchars($row['alamat']) ?></td>
                                <td><?= htmlspecialchars($row['jurusan']) ?></td>
                                <td>
                                    <a href="?delete=<?= urlencode($row['nim']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?');">Hapus</a>
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
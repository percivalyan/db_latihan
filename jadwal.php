<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'config/config.php';

// Fetch matakuliah for dropdown
$matakuliah_result = $connection->query("SELECT * FROM tabel_matakuliah");
$matakuliah_options = '';
while ($row = $matakuliah_result->fetch_assoc()) {
    $matakuliah_options .= '<option value="' . htmlspecialchars($row['kode_matakuliah']) . '">' . htmlspecialchars($row['nama_matakuliah']) . '</option>';
}

// Fetch dosen for dropdown
$dosen_result = $connection->query("SELECT * FROM tabel_dosen");
$dosen_options = '';
while ($row = $dosen_result->fetch_assoc()) {
    $dosen_options .= '<option value="' . htmlspecialchars($row['kode_dosen']) . '">' . htmlspecialchars($row['nama_dosen']) . '</option>';
}

if (isset($_POST['add'])) {
    $kode_matakuliah = $_POST['kode_matakuliah'];
    $kode_dosen = $_POST['kode_dosen'];
    $hari = $_POST['hari'];
    $jam = $_POST['jam'];

    $stmt = $connection->prepare("INSERT INTO tabel_jadwal (kode_matakuliah, kode_dosen, hari, jam) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $kode_matakuliah, $kode_dosen, $hari, $jam);
    $stmt->execute();
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $connection->prepare("DELETE FROM tabel_jadwal WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$result = $connection->query("SELECT * FROM tabel_jadwal");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Jadwal - Universitas</title>
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
                <h2 class="mb-4">Jadwal Kuliah</h2>
                <form method="POST" class="mb-4">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="kode_matakuliah">Kode Matakuliah</label>
                            <select class="form-control" name="kode_matakuliah" required>
                                <option value="" disabled selected>Pilih Matakuliah</option>
                                <?= $matakuliah_options ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="kode_dosen">Kode Dosen</label>
                            <select class="form-control" name="kode_dosen" required>
                                <option value="" disabled selected>Pilih Dosen</option>
                                <?= $dosen_options ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="hari">Hari</label>
                            <input type="text" class="form-control" name="hari" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="jam">Jam</label>
                            <input type="text" class="form-control" name="jam" required>
                        </div>
                    </div>

                    <button type="submit" name="add" class="btn btn-primary">Tambah Jadwal</button>
                </form>

                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Kode Matakuliah</th>
                            <th>Kode Dosen</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['kode_matakuliah']) ?></td>
                                <td><?= htmlspecialchars($row['kode_dosen']) ?></td>
                                <td><?= htmlspecialchars($row['hari']) ?></td>
                                <td><?= htmlspecialchars($row['jam']) ?></td>
                                <td>
                                    <a href="?delete=<?= urlencode($row['id']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">Hapus</a>
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

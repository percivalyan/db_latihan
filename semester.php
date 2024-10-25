<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'config/config.php';

// Handle adding a semester
if (isset($_POST['add'])) {
    $kode_semester = $_POST['kode_semester'];
    $semester = $_POST['semester'];
    $status = $_POST['status'];

    $stmt = $connection->prepare("INSERT INTO tabel_semester (kode_semester, semester, status) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $kode_semester, $semester, $status);
    $stmt->execute();
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Handle deleting a semester
if (isset($_GET['delete'])) {
    $kode_semester = $_GET['delete'];
    $stmt = $connection->prepare("DELETE FROM tabel_semester WHERE kode_semester = ?");
    $stmt->bind_param("i", $kode_semester);
    $stmt->execute();
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Retrieve all semesters
$result = $connection->query("SELECT * FROM tabel_semester");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Semester - Universitas</title>
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
                <h2 class="mb-4">Data Semester</h2>
                <form method="POST" class="mb-4">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="kode_semester">Kode Semester</label>
                            <input type="text" class="form-control" name="kode_semester" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="semester">Semester</label>
                            <input type="text" class="form-control" name="semester" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary">Tambah Semester</button>
                </form>

                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Kode Semester</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['kode_semester']) ?></td>
                                <td><?= htmlspecialchars($row['semester']) ?></td>
                                <td><?= htmlspecialchars($row['status'] ? 'Aktif' : 'Tidak Aktif') ?></td>
                                <td>
                                    <a href="?delete=<?= urlencode($row['kode_semester']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus semester ini?');">Hapus</a>
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

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'config/config.php';

// Fetch mahasiswa for dropdown
$mahasiswa_result = $connection->query("SELECT * FROM tabel_mahasiswa");
$mahasiswa_options = '';
while ($row = $mahasiswa_result->fetch_assoc()) {
    $mahasiswa_options .= '<option value="' . htmlspecialchars($row['nim']) . '">' . htmlspecialchars($row['nama_mahasiswa']) . '</option>';
}

// Fetch jadwal for dropdown
$jadwal_result = $connection->query("SELECT * FROM tabel_jadwal");
$jadwal_options = '';
while ($row = $jadwal_result->fetch_assoc()) {
    $jadwal_options .= '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['kode_matakuliah']) . ' - ' . htmlspecialchars($row['kode_dosen']) . '</option>';
}

// Fetch semester for dropdown
$semester_result = $connection->query("SELECT * FROM tabel_semester");
$semester_options = '';
if ($semester_result->num_rows > 0) {
    while ($row = $semester_result->fetch_assoc()) {
        $semester_options .= '<option value="' . htmlspecialchars($row['kode_semester']) . '">' . htmlspecialchars($row['kode_semester']) . '</option>';
    }
} else {
    // Handle case where there are no semesters available
    $semester_options .= '<option value="" disabled>Tidak ada semester tersedia</option>';
}

// Handle adding new KRS entry
if (isset($_POST['add'])) {
    $nim = $_POST['nim'];
    $id_jadwal = $_POST['id_jadwal'];
    $kode_semester = $_POST['kode_semester'];

    $stmt = $connection->prepare("INSERT INTO tabel_krs (nim, id_jadwal, kode_semester) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $nim, $id_jadwal, $kode_semester);
    $stmt->execute();
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Handle deletion of KRS entry
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $connection->prepare("DELETE FROM tabel_krs WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Fetch KRS with course names and semester
$result = $connection->query("
    SELECT k.id, k.nim, j.kode_matakuliah, m.nama_matakuliah, k.kode_semester, s.kode_semester AS semester 
    FROM tabel_krs k 
    JOIN tabel_jadwal j ON k.id_jadwal = j.id 
    JOIN tabel_matakuliah m ON j.kode_matakuliah = m.kode_matakuliah
    JOIN tabel_semester s ON k.kode_semester = s.kode_semester
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KRS - Universitas</title>
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
                <h2 class="mb-4">Kartu Rencana Studi (KRS)</h2>
                <form method="POST" class="mb-4">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="nim">NIM Mahasiswa</label>
                            <select class="form-control" name="nim" required>
                                <option value="" disabled selected>Pilih Mahasiswa</option>
                                <?= $mahasiswa_options ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="id_jadwal">Jadwal Kuliah</label>
                            <select class="form-control" name="id_jadwal" required>
                                <option value="" disabled selected>Pilih Jadwal</option>
                                <?= $jadwal_options ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="kode_semester">Kode Semester</label>
                            <select class="form-control" name="kode_semester" required>
                                <option value="" disabled selected>Pilih Semester</option>
                                <?= $semester_options ?>
                            </select>
                        </div>
                    </div>

                    <button type="submit" name="add" class="btn btn-primary">Tambah KRS</button>
                </form>

                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>NIM</th>
                            <th>Jadwal Kuliah</th> <!-- Updated header -->
                            <th>Semester</th> <!-- Display only Semester -->
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['nim']) ?></td>
                                <td><?= htmlspecialchars($row['kode_matakuliah']) ?> - <?= htmlspecialchars($row['nama_matakuliah']) ?></td> <!-- Display course code and name -->
                                <td><?= htmlspecialchars($row['semester']) ?></td>
                                <td>
                                    <a href="?delete=<?= urlencode($row['id']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus KRS ini?');">Hapus</a>
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

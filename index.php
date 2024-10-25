<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'config/config.php';

$result = $connection->query("SELECT jurusan, COUNT(*) as jumlah FROM tabel_mahasiswa GROUP BY jurusan");
$chartData = [];
while ($row = $result->fetch_assoc()) {
    $chartData[] = $row;
}

$jurusan = json_encode(array_column($chartData, 'jurusan'));
$jumlah = json_encode(array_column($chartData, 'jumlah'));
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <?php include('layout/navbar.php'); ?>
    </nav>

    <div class="d-flex">
        <?php include('layout/sidebar.php'); ?>

        <main class="flex-grow-1">
            <div class="container mt-4">
                <h2>Chart Data Mahasiswa</h2>
                <canvas id="mahasiswaChart"></canvas>
            </div>
        </main>
    </div>

    <?php include('layout/footer.php'); ?>

    <script>
        const jurusan = <?php echo $jurusan; ?>;
        const jumlah = <?php echo $jumlah; ?>;

        const ctx = document.getElementById('mahasiswaChart').getContext('2d');
        const mahasiswaChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: jurusan,
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: jumlah,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>

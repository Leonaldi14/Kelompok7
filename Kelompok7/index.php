<?php
include('config.php');

// Query untuk menghitung jumlah fasilitas
$query_fasilitas_count = "SELECT COUNT(id_fasilitas) AS jumlah_fasilitas FROM fasilitas";
$result_fasilitas_count = mysqli_query($conn, $query_fasilitas_count);
$row_fasilitas = mysqli_fetch_assoc($result_fasilitas_count);
$jumlah_fasilitas = $row_fasilitas['jumlah_fasilitas'];

// Query untuk menghitung jumlah kegiatan
$query_kegiatan_count = "SELECT COUNT(id_kegiatan) AS jumlah_kegiatan FROM kegiatan";
$result_kegiatan_count = mysqli_query($conn, $query_kegiatan_count);
$row_kegiatan = mysqli_fetch_assoc($result_kegiatan_count);
$jumlah_kegiatan = $row_kegiatan['jumlah_kegiatan'];

// Query untuk menghitung jumlah pelaksanaan
$query_pelaksanaan_count = "SELECT COUNT(id_pelaksanaan) AS jumlah_pelaksanaan FROM pelaksanaan";
$result_pelaksanaan_count = mysqli_query($conn, $query_pelaksanaan_count);
$row_pelaksanaan = mysqli_fetch_assoc($result_pelaksanaan_count);
$jumlah_pelaksanaan = $row_pelaksanaan['jumlah_pelaksanaan'];

// Query untuk mengambil data fasilitas, kegiatan, dan pelaksanaan
$query_fasilitas = "SELECT * FROM fasilitas";
$result_fasilitas = mysqli_query($conn, $query_fasilitas);

$query_kegiatan = "SELECT * FROM kegiatan";
$result_kegiatan = mysqli_query($conn, $query_kegiatan);

$query_pelaksanaan = "SELECT * FROM pelaksanaan";
$result_pelaksanaan = mysqli_query($conn, $query_pelaksanaan);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bundaran Besar Palangkaraya</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Styling umum */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #004d40;
            color: #fff;
            padding: 40px 0;
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            font-size: 2.8em;
            color: #004d40;  /* Warna judul yang lebih gelap */
        }

        header p {
            font-size: 1.2em;
            margin-top: 10px;
            color: #d1d1d1;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .add-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .add-buttons button {
            padding: 10px 20px;
            background-color: #004d40;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
        }

        .add-buttons button:hover {
            background-color: #00796b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            text-align: center;
        }

        th, td {
            padding: 10px;
        }

        th {
            background-color: #004d40;
            color: white;
        }

        .actions a {
            padding: 5px 10px;
            background-color: #d32f2f;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .actions a:hover {
            background-color: #c2185b;
        }

        h2 {
            color: #004d40;
            font-size: 1.8em;
            margin-bottom: 10px;
        }

        #grafik {
            width: 100%;
            height: 400px;
            margin-top: 40px;
        }

        footer {
            background-color: #004d40;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Bundaran Besar Palangkaraya</h1>
            <p>Bundaran Besar Palangkaraya merupakan salah satu landmark ikonik di kota Palangkaraya, yang menjadi pusat aktivitas dan simbol kemajuan kota.</p>
        </div>
    </header>

    <div class="container">
        <!-- Tombol Tambah -->
        <div class="add-buttons">
            <a href="tambah_fasilitas.php"><button type="button">Tambah Fasilitas</button></a>
            <a href="tambah_kegiatan.php"><button type="button">Tambah Kegiatan</button></a>
            <a href="tambah_pelaksanaan.php"><button type="button">Tambah Pelaksanaan</button></a>
        </div>

        <!-- Daftar Fasilitas -->
        <h2>Daftar Fasilitas</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Fasilitas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_fasilitas)): ?>
                    <tr>
                        <td><?php echo $row['nama_fasilitas']; ?></td>
                        <td class="actions"><a href="delete_fasilitas.php?id=<?php echo $row['id_fasilitas']; ?>">Hapus</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Daftar Kegiatan -->
        <h2>Daftar Kegiatan</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Kegiatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_kegiatan)): ?>
                    <tr>
                        <td><?php echo $row['nama_kegiatan']; ?></td>
                        <td class="actions"><a href="delete_kegiatan.php?id=<?php echo $row['id_kegiatan']; ?>">Hapus</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Daftar Pelaksanaan -->
        <h2>Daftar Pelaksanaan</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Kegiatan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_pelaksanaan)): ?>
                    <tr>
                        <td><?php echo $row['id_kegiatan']; ?></td>
                        <td><?php echo $row['tanggal']; ?></td>
                        <td class="actions"><a href="delete_pelaksanaan.php?id=<?php echo $row['id_pelaksanaan']; ?>">Hapus</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Grafik -->
        <h2>Grafik Jumlah Fasilitas, Kegiatan, dan Pelaksanaan</h2>
        <canvas id="activityChart"></canvas>
        <script>
            const ctx = document.getElementById('activityChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Fasilitas', 'Kegiatan', 'Pelaksanaan'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [<?php echo $jumlah_fasilitas; ?>, <?php echo $jumlah_kegiatan; ?>, <?php echo $jumlah_pelaksanaan; ?>],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,  // Menentukan jarak antara angka di sumbu Y
                            }
                        }
                    }
                }
            });
        </script>
    </div>

    <footer>
        <p>Bundaran Besar Palangkaraya © 2024</p>
    </footer>
</body>
</html>

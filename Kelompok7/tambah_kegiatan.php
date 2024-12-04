<?php
include('config.php');

// Ambil data fasilitas untuk dropdown
$query_fasilitas = "SELECT * FROM fasilitas";
$result_fasilitas = mysqli_query($conn, $query_fasilitas);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $id_fasilitas = $_POST['id_fasilitas'];

    $query = "INSERT INTO kegiatan (nama_kegiatan, id_fasilitas) VALUES ('$nama_kegiatan', '$id_fasilitas')";
    mysqli_query($conn, $query);
    header('Location: index.php');
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Styling untuk seluruh halaman */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 60%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        header {
            background-color: #004d40;
            color: #fff;
            padding: 40px 0;
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            color: #004d40;
            font-size: 2.8em;
        }

        header p {
            font-size: 1.2em;
            margin-top: 10px;
            color: #d1d1d1;
        }

        .form-container {
            margin-bottom: 20px;
        }

        .form-container label {
            font-weight: bold;
            color: #004d40;
        }

        .form-container input, .form-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-container button {
            padding: 10px 20px;
            background-color: #004d40;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #00796b;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <header>
        <h1>Tambah Kegiatan</h1>
        <p>Tambahkan kegiatan baru yang akan dilaksanakan di Bundaran Besar Palangkaraya</p>
    </header>

    <div class="container">
        <div class="form-container">
            <form action="" method="POST">
                <label for="nama_kegiatan">Nama Kegiatan:</label>
                <input type="text" name="nama_kegiatan" id="nama_kegiatan" required>

                <label for="id_fasilitas">Fasilitas:</label>
                <select name="id_fasilitas" id="id_fasilitas" required>
                    <?php while ($row = mysqli_fetch_assoc($result_fasilitas)): ?>
                        <option value="<?php echo $row['id_fasilitas']; ?>"><?php echo $row['nama_fasilitas']; ?></option>
                    <?php endwhile; ?>
                </select>

                <button type="submit">Tambah Kegiatan</button>
            </form>
        </div>

        <a href="index.php" class="back-button">Kembali ke Halaman Utama</a>
    </div>
</body>
</html>
<?php
include('config.php');

// Cek apakah ID pelaksanaan diterima dari URL
if (isset($_GET['id'])) {
    $id_pelaksanaan = $_GET['id'];

    // Validasi ID pelaksanaan untuk memastikan adalah angka
    if (is_numeric($id_pelaksanaan)) {
        // Debugging: cetak ID yang diterima
        echo 'ID pelaksanaan yang diterima: ' . $id_pelaksanaan . '<br>';

        // Query untuk menghapus pelaksanaan berdasarkan id
        $query = "DELETE FROM pelaksanaan WHERE id_pelaksanaan = $id_pelaksanaan";

        // Debugging: cetak query yang dijalankan
        echo 'Query yang dijalankan: ' . $query . '<br>';

        if (mysqli_query($conn, $query)) {
            // Jika berhasil, arahkan kembali ke halaman daftar pelaksanaan
            header('Location: index.php');
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "ID pelaksanaan tidak valid!";
    }
} else {
    echo "ID pelaksanaan tidak ditemukan!";
}

mysqli_close($conn);
?>

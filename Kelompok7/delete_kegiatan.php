<?php
include('config.php');

// Pastikan ada id_kegiatan yang diterima dari URL
if (isset($_GET['id'])) {
    $id_kegiatan = $_GET['id'];

    // Hapus pelaksanaan yang terkait dengan kegiatan yang ingin dihapus
    $delete_pelaksanaan = "DELETE FROM pelaksanaan WHERE id_kegiatan = '$id_kegiatan'";

    if (mysqli_query($conn, $delete_pelaksanaan)) {
        // Setelah pelaksanaan dihapus, hapus kegiatan tersebut
        $delete_kegiatan = "DELETE FROM kegiatan WHERE id_kegiatan = '$id_kegiatan'";

        if (mysqli_query($conn, $delete_kegiatan)) {
            echo "Kegiatan berhasil dihapus.";
        } else {
            echo "Gagal menghapus kegiatan: " . mysqli_error($conn);
        }
    } else {
        echo "Gagal menghapus pelaksanaan: " . mysqli_error($conn);
    }
} else {
    echo "ID kegiatan tidak ditemukan.";
}

mysqli_close($conn);

// Redirect kembali ke halaman utama setelah operasi
header('Location: index.php');
exit;
?>

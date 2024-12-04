<?php
include('config.php');

// Pastikan ada id_fasilitas yang diterima dari URL
if (isset($_GET['id'])) {
    $id_fasilitas = $_GET['id'];

    // Hapus pelaksanaan yang terkait dengan fasilitas yang ingin dihapus
    $delete_pelaksanaan = "DELETE pelaksanaan FROM pelaksanaan 
                           INNER JOIN kegiatan ON pelaksanaan.id_kegiatan = kegiatan.id_kegiatan 
                           WHERE kegiatan.id_fasilitas = '$id_fasilitas'";

    if (mysqli_query($conn, $delete_pelaksanaan)) {
        // Hapus kegiatan yang terkait dengan fasilitas
        $delete_kegiatan = "DELETE FROM kegiatan WHERE id_fasilitas = '$id_fasilitas'";

        if (mysqli_query($conn, $delete_kegiatan)) {
            // Setelah pelaksanaan dan kegiatan dihapus, hapus fasilitas
            $delete_fasilitas = "DELETE FROM fasilitas WHERE id_fasilitas = '$id_fasilitas'";

            if (mysqli_query($conn, $delete_fasilitas)) {
                echo "Fasilitas berhasil dihapus.";
            } else {
                echo "Gagal menghapus fasilitas: " . mysqli_error($conn);
            }
        } else {
            echo "Gagal menghapus kegiatan: " . mysqli_error($conn);
        }
    } else {
        echo "Gagal menghapus pelaksanaan: " . mysqli_error($conn);
    }
} else {
    echo "ID fasilitas tidak ditemukan.";
}

mysqli_close($conn);

// Redirect kembali ke halaman utama setelah operasi
header('Location: index.php');
exit;
?>

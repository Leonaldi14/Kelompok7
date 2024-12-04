<?php
$servername = "localhost";
$username = "root";  // default XAMPP username
$password = "";      // default XAMPP password
$dbname = "bundaran_palangkaraya"; // nama database yang digunakan

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

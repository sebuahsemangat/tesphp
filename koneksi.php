<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tesphp";

// Meningkatkan pelaporan kesalahan
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Membuat koneksi
    $koneksi = new mysqli($servername, $username, $password, $dbname);
    // Mengatur karakter set ke utf8mb4 untuk mendukung karakter khusus
    $koneksi->set_charset("utf8mb4");
} catch (Exception $e) {
    // Mencatat kesalahan ke file log dan menampilkan pesan kesalahan generik ke pengguna
    error_log($e->getMessage());
    exit('Koneksi ke database gagal.');
}
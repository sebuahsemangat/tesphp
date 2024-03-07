<?php
// Memulai session
session_start();

// Memeriksa apakah pengguna sudah login
if(!isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirect ke halaman login jika belum login
    exit;
}

// Hapus semua data session
session_destroy();

// Redirect ke halaman login setelah logout
header("Location: index.php");
exit;
?>

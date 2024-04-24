<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tesphp";
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
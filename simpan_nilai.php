<?php
session_start();
include("koneksi.php");
$id_soal = $_POST['id_soal'];
$id_siswa = $_SESSION["siswa"];
$nilai = $_POST['nilai'];
$jawaban = $_POST['jawaban'];

$qrysoal = mysqli_query($koneksi, "SELECT * FROM soal where id_soal='$id_soal' LIMIT 1");
$datasoal = mysqli_fetch_assoc($qrysoal);
$id_ujian = $datasoal["id_ujian"];
$insert = mysqli_query($koneksi, "INSERT INTO hasil (id_soal, id_siswa, jawaban, nilai) VALUES ('$id_soal', '$id_siswa','$jawaban','$nilai')");
if ($insert) {
    // Mendapatkan URL dari halaman index.php
    $parent_url = $_SERVER['HTTP_REFERER'];

    // Menentukan lokasi home.php
    $home_url = 'home.php?page=soal&id_ujian=' . $id_ujian;

    // Script JavaScript untuk mengubah lokasi parent frame
    echo "<script>window.parent.location.href = '$home_url';</script>";
} else {
    echo "Kirim gagal";
}

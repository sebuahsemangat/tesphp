<?php
include "../koneksi.php";
$id_ujian = $_GET['id_ujian'];
if (!isset($id_ujian) or $id_ujian == '' or $id_ujian == 0) {
    echo "ERROR 404";
} else {
    $hapus_ujian = mysqli_query($koneksi, "DELETE FROM ujian WHERE id_ujian = '$id_ujian'");
    if ($hapus_ujian) {
        $hapus_ujian_kelas = mysqli_query($koneksi, "DELETE FROM ujian_kelas WHERE id_ujian = '$id_ujian'");
        if($hapus_ujian_kelas){
        header("location: home.php");
        exit();
        }
    } else {
        echo "Data gagal dihapus";
    }
}

<?php
include "../koneksi.php";
$action = $_GET["action"];
$id_ujian = $_GET["id_ujian"];

if($action == "active") {
    $status = "aktif";
}
else {
    $status = "tidak aktif";
}
$query = mysqli_query($koneksi, "UPDATE ujian SET status = '$status' WHERE id_ujian='$id_ujian'");
if($query) {
    header("location: home.php?page=ujian");
}
else {
    echo "Gagal mengubah status ujian";
}
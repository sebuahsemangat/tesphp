<?php
include "koneksi.php";
$kelas = $_GET['kelas'];
$sql ="DELETE FROM hasil where kelas='$kelas'";
$query = mysqli_query($konek, $sql);
if ($query)
{
    echo "data $kelas berhasil dihapus";
}
else {
    echo "gagal";
}
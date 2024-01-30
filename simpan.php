<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
<?php
include("koneksi.php");
$id_soal = $_POST['id_soal'];
$nama = addslashes($_POST['nama']);
$kelas = $_POST['kelas'];
$hasil = addslashes($_POST['hasil']);
$nilai = $_POST['nilai'];

$insert = mysqli_query($konek,"INSERT INTO hasil (id_soal, nama, kelas, hasil, nilai) VALUES ('$id_soal', '$nama','$kelas','$hasil','$nilai')");
if ($insert)
{
    echo "<h2>Hasil sudah terkirim. Ujian selesai</h2>";
}
else {
    echo "Kirim gagal";
}
?>
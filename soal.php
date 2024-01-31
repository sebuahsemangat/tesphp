<?php
session_start();
include "koneksi.php";
if (!isset($_SESSION['siswa']))
{
    header("location: index.php");
}
else
{
    //variabel session
    $id_siswa = $_SESSION["siswa"];
    //ambil data siswa
    $qry_siswa = mysqli_query($koneksi, "SELECT * FROM siswa where id_siswa='$id_siswa'");
    //pecah menjadi array
    $data_siswa = mysqli_fetch_assoc($qry_siswa);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Soal</title>
    <style>
      table,
      th,
      td {
        padding: 10px;
        border: 1px solid black;
        border-collapse: collapse;
      }
    </style>
</head>
<body>

    <?php
        //ambil id_ujian
        $id_ujian = addslashes($_GET['id_ujian']);
        //ambil judul ujian
        $qry_ujian=mysqli_query($koneksi, "SELECT id_ujian, nama_ujian FROM ujian where id_ujian='$id_siswa' AND status ='aktif'");
        //pecah array
        $data_ujian=mysqli_fetch_assoc($qry_ujian);
        echo "<h2>" . $data_ujian['nama_ujian'] . "</h2>";
    ?>
    <table>
        <tr>
            <th>No</th>
            <th>Judul Soal</th>
            <th>Durasi Waktu</th>
            <th></th>
        </tr>
    <?php
    //ambil data soal berdasarkan id_ujian dan status aktif
    $qry_soal = mysqli_query($koneksi, "SELECT * FROM soal where id_ujian='$id_ujian' AND status='aktif'");
    //pecah menjadi array dan looping
    $no = 0;
    while($data_soal=mysqli_fetch_assoc($qry_soal)){
        $no++;
    ?>
        <tr>
            <td><?= $no;?></td>
            <td><?= $data_soal['judul'];?></td>
            <td><?= $data_soal['waktu'];?></td>
            <td><?= "<a href='do-test.php?id_ujian=$data_ujian[id_ujian]&id_soal=$data_soal[id_soal]'>Kerjakan</a>";?></td>
        </tr>
    <?php
    //akhir looping soal
    }
    ?>
    </table>
</body>
</html>
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
    <title>Home | Tes PHP</title>
</head>
<body>
    <h2>Selamat Datang <?= $data_siswa["nama"];?></h2>
    <h4>List Ujian</h4>
    <ol>
    <?php
    //ambil data ujian berdasarkan kelas siswa dan statusnya aktif
    $qry_ujian = mysqli_query($koneksi, "SELECT * FROM ujian WHERE id_kelas='$data_siswa[id_kelas]' AND status='aktif'");
    // pecah menjadi array kemudian looping
    while($data_ujian=mysqli_fetch_assoc($qry_ujian))
    {
        echo "<li><a href='soal.php?id_ujian=" . $data_ujian['id_ujian'] . "'>" . $data_ujian['nama_ujian'] . "</a></li>";
    }    
    ?>
    </ol>
<p><a href="logout.php">Logout</a></p>
</body>
</html>
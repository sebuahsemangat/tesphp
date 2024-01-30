<?php
session_start();
include "koneksi.php";
if (!isset($_SESSION['siswa']))
{
    header("location: index.php");
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
    <h2>Selamat Datang <?= $_SESSION["siswa"];?></h2>
</body>
</html>
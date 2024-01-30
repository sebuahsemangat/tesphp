<?php
include ("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tes Praktikum PHP</title>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h2 align="center">Hasil Tes Praktikum PHP</h2>
    <form action="" method="get">

    <div align="center">
        Pilih Kelas: 
        <select name="kelas" id="" onchange="return submit()">
            <option value="0">--Pilih Kelas--</option>
            <option value="x7">X-RPL-7</option>
            <option value="x8">X-RPL-8</option>
            <option value="acp">X-ACP</option>
        </select>
    <div>
    </form>
<br>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Hasil</th>
            <th>Nilai</th>
            <th>Action</th>
        </tr>
    <?php
    if(!isset($_GET['kelas']))
    {
        echo "";
    }
    else {

    
    $no = 0;
    $kelas = $_GET['kelas'];
    $sql = "SELECT * FROM hasil where kelas='$kelas' order by nama asc";
    $select = mysqli_query($konek, $sql);
    while ($data = mysqli_fetch_assoc($select))
    {
        $no ++;
    ?>
        <tr>
            <td><?= $no;?></td>
            <td><?= $data['nama'];?></td>
            <td><?= $data['kelas'];?></td>
            <td><pre><?= htmlspecialchars($data['hasil']);?></pre></td>
            <td><?= $data['nilai'];?></td>
            <td>Lihat Hasil</td>
        </tr>
    <?php
    }
}
    ?>
    </table>
</body>
</html>
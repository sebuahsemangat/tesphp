<?php
if($_SESSION['level']=="guru") {
    echo "You don't have access to this page!";
    exit();
}
?>
<p><a href="home.php?page=input_kelas" class="btn btn-primary">Tambah Kelas</a></p>
<?php
$query = "
SELECT kelas.id_kelas, kelas.nama_kelas, guru.nama 
FROM kelas 
JOIN guru ON kelas.id_guru = guru.id_guru
";

// Menyiapkan statement
if ($stmt = mysqli_prepare($koneksi, $query)) {
// Mengeksekusi statement
mysqli_stmt_execute($stmt);

// Mengikat hasil ke variabel
mysqli_stmt_bind_result($stmt, $id_kelas, $nama_kelas, $nama_guru);
?>
<table id="myTable" class="table table-striped table-bordered">
<thead>
    <tr>
        <th>No</th>
        <th>Nama Kelas</th>
        <th>Pengajar</th>
        <th>Data Siswa</th>
    </tr>
</thead>
<tbody>
<?php
// Inisialisasi nomor urut
$no = 1;

// Fetching data
while (mysqli_stmt_fetch($stmt)) {
    ?>
    <tr>
        <td><?= $no;?></td>
        <td><?= htmlspecialchars($nama_kelas);?></td>
        <td><?= htmlspecialchars($nama_guru);?></td>
        <td><a href="home.php?page=siswa&id_kelas=<?= htmlspecialchars($id_kelas);?>">Data Siswa</a></td>
    </tr>
    <?php
    $no++;
}
?>
</tbody>
</table>
<?php
// Menutup statement
mysqli_stmt_close($stmt);
} else {
echo "Error: " . mysqli_error($koneksi);
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
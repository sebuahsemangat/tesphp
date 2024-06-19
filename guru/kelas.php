<p><a href="home.php">Kembali</a></p>
<?php
// Ambil id_guru dari session
$id_guru = $_SESSION['id_guru'];

// Query untuk mengambil data kelas berdasarkan id_guru
$query = "
    SELECT kelas.id_kelas, kelas.nama_kelas, guru.nama 
    FROM kelas 
    JOIN guru ON kelas.id_guru = guru.id_guru 
    WHERE kelas.id_guru = ?
";

// Menyiapkan statement
if ($stmt = mysqli_prepare($koneksi, $query)) {
    // Mengikat parameter ke statement
    mysqli_stmt_bind_param($stmt, "i", $id_guru);

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
            <td><?= $nama_kelas;?></td>
            <td><?= $nama_guru;?></td>
            <td><a href="home.php?page=siswa&id_kelas=<?= $id_kelas;?>">Data Siswa</a></td>
        </tr>
        <?php

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
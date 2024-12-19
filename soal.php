<?php
// Ambil dan validasi id_ujian
if (isset($_GET['id_ujian']) && is_numeric($_GET['id_ujian'])) {
    $id_ujian = intval($_GET['id_ujian']);
} else {
    // Jika id_ujian tidak valid, redirect atau tampilkan pesan error
    header("Location: home.php");
    exit();
}

// Prepared statement untuk mengambil judul ujian
$stmt = $koneksi->prepare("SELECT id_ujian, nama_ujian FROM ujian WHERE id_ujian = ? AND status = 'aktif'");
$stmt->bind_param("i", $id_ujian);
$stmt->execute();
$result = $stmt->get_result();
$data_ujian = $result->fetch_assoc();

if (!$data_ujian) {
    // Jika tidak ada ujian aktif dengan id_ujian yang diberikan
    echo "<p>Ujian tidak ditemukan atau tidak aktif.</p>";
    exit();
}

echo "<h2>" . htmlspecialchars($data_ujian['nama_ujian']) . "</h2>";
?>

<p><a href="home.php">Kembali</a></p>
<h4>List Soal</h4>
<table id="myTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Soal</th>
            <th>Pengerjaan</th>
            <th>Hasil</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Prepared statement untuk mengambil soal berdasarkan id_ujian dan status aktif
        $stmt = $koneksi->prepare("SELECT * FROM soal WHERE id_ujian = ? AND status = 'aktif'");
        $stmt->bind_param("i", $id_ujian);
        $stmt->execute();
        $result = $stmt->get_result();

        $no = 0;
        while ($data_soal = $result->fetch_assoc()) {
            $no++;
            // Prepared statement untuk mengecek hasil
            $stmt_nilai = $koneksi->prepare("SELECT * FROM hasil WHERE id_soal = ? AND id_siswa = ?");
            $stmt_nilai->bind_param("ii", $data_soal['id_soal'], $_SESSION['siswa']);
            $stmt_nilai->execute();
            $result_nilai = $stmt_nilai->get_result();
            $data_hasil = $result_nilai->fetch_assoc();
            $cek_jawaban = $result_nilai->num_rows;
        ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= htmlspecialchars($data_soal['judul']); ?></td>
                <td>
                    <?= ($cek_jawaban == 1) ? "Sudah dikerjakan" : "Belum dikerjakan"; ?>
                </td>
                <td>
                    <?= ($cek_jawaban == 1) ? ucfirst($data_hasil["test_result"]) : "Belum dikerjakan"; ?>
                </td>
                <td>
                    <?php if ($cek_jawaban == 1) { ?>
                        <a
                            href='home.php?page=lihat_jawaban&id_ujian=<?= $data_ujian['id_ujian']; ?>&id_soal=<?= $data_soal['id_soal']; ?>'>Lihat
                            Jawaban</a>
                    <?php } else { ?>
                        <a href='home.php?page=kerjakan&id_ujian=<?= $data_ujian['id_ujian']; ?>&id_soal=<?= $data_soal['id_soal']; ?>'><i class="fa-brands fa-php"></i></a>
                        <a href='home.php?page=kerjakan_py&id_ujian=<?= $data_ujian['id_ujian']; ?>&id_soal=<?= $data_soal['id_soal']; ?>'><i class="fa-brands fa-python"></i></a>
                    <?php } ?>
                </td>
            </tr>
        <?php
            // Menutup prepared statement untuk nilai
            $stmt_nilai->close();
            //akhir looping soal
        }
        ?>
    </tbody>
</table>

<?php
// Menutup prepared statement untuk ujian dan soal
$stmt->close();
?>
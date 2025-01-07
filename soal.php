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

echo "<h2> <a href='home.php'><i class='fa-solid fa-backward'></i></a>   " . htmlspecialchars($data_ujian['nama_ujian']) . "</h2>";
?>
<table id="myTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Soal</th>
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
                    <?php
                        if($cek_jawaban == 1){
                            if($data_hasil["test_result"]=="lulus"){
                                echo "<span style='color:green'><i class='fa-solid fa-circle-check'></i> Lulus</span>";
                            }
                            else {
                                echo "<span style='color:#cc0000'><i class='fa-solid fa-circle-exclamation'></i> Gagal</span>";
                            }
                        }
                        else {
                            echo "<i class='fa-solid fa-hourglass-start'></i> Belum Dikerjakan";
                        }
                    ?>
                </td>
                <td>
                    <?php if ($cek_jawaban == 1) { ?>
                        <a
                            href='home.php?page=lihat_jawaban&id_ujian=<?= $data_ujian['id_ujian']; ?>&id_soal=<?= $data_soal['id_soal']; ?>'>Lihat
                            Jawaban</a>
                    <?php } else { ?>
                        <a class="lang-icon" href='home.php?page=kerjakan&id_ujian=<?= $data_ujian['id_ujian']; ?>&id_soal=<?= $data_soal['id_soal']; ?>'><i class="fa-brands fa-php"></i></a>
                        <a class="lang-icon" href='home.php?page=kerjakan_py&id_ujian=<?= $data_ujian['id_ujian']; ?>&id_soal=<?= $data_soal['id_soal']; ?>'><i class="fa-brands fa-python"></i></a>
                        <a class="lang-icon" href='home.php?page=kerjakan_js&id_ujian=<?= $data_ujian['id_ujian']; ?>&id_soal=<?= $data_soal['id_soal']; ?>'><i class="fa-brands fa-js"></i></a>
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
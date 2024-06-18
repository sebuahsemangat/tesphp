<p><a href="#">Kembali</a>
    <?php
    // Ambil data dari URL
    $id_ujian = isset($_GET['id_ujian']) ? $_GET['id_ujian'] : 0;
    $id_kelas = isset($_GET['id_kelas']) ? $_GET['id_kelas'] : 0;

    // Ambil nama kelas dari tabel kelas
    $sql_kelas = "SELECT nama_kelas FROM kelas WHERE id_kelas = ?";
    $stmt_kelas = $koneksi->prepare($sql_kelas);
    $stmt_kelas->bind_param("i", $id_kelas);
    $stmt_kelas->execute();
    $result_kelas = $stmt_kelas->get_result();
    $row_kelas = $result_kelas->fetch_assoc();
    $nama_kelas = $row_kelas['nama_kelas'];
    $stmt_kelas->close();

    // Ambil data siswa dari tabel siswa
    $sql_siswa = "SELECT id_siswa, nis, nama FROM siswa WHERE id_kelas = ?";
    $stmt_siswa = $koneksi->prepare($sql_siswa);
    $stmt_siswa->bind_param("i", $id_kelas);
    $stmt_siswa->execute();
    $result_siswa = $stmt_siswa->get_result();

    // Hitung jumlah soal untuk id_ujian
    $sql_jumlah_soal = "SELECT COUNT(*) as jumlah_soal FROM soal WHERE id_ujian = ?";
    $stmt_jumlah_soal = $koneksi->prepare($sql_jumlah_soal);
    $stmt_jumlah_soal->bind_param("i", $id_ujian);
    $stmt_jumlah_soal->execute();
    $result_jumlah_soal = $stmt_jumlah_soal->get_result();
    $row_jumlah_soal = $result_jumlah_soal->fetch_assoc();
    $jumlah_soal = $row_jumlah_soal['jumlah_soal'];
    $stmt_jumlah_soal->close();
    ?>

<table id="myTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Nilai</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        while ($row_siswa = $result_siswa->fetch_assoc()) {
            $id_siswa = $row_siswa['id_siswa'];

            // Hitung jawaban benar untuk id_siswa dan id_ujian
            $sql_jawaban_benar = "SELECT COUNT(*) as jawaban_benar FROM hasil WHERE id_siswa = ? AND id_ujian = ? AND test_result = 'lulus'";
            $stmt_jawaban_benar = $koneksi->prepare($sql_jawaban_benar);
            $stmt_jawaban_benar->bind_param("ii", $id_siswa, $id_ujian);
            $stmt_jawaban_benar->execute();
            $result_jawaban_benar = $stmt_jawaban_benar->get_result();
            $row_jawaban_benar = $result_jawaban_benar->fetch_assoc();
            $jawaban_benar = $row_jawaban_benar['jawaban_benar'];
            $stmt_jawaban_benar->close();

            // Hitung nilai
            $nilai = ($jawaban_benar / $jumlah_soal) * 100;
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row_siswa['nis']; ?></td>
                <td><?php echo $row_siswa['nama']; ?></td>
                <td><?php echo $nama_kelas; ?></td>
                <td><?php echo number_format($nilai, 2); ?></td>
            </tr>
            <?php
        }
        $stmt_siswa->close();
        $koneksi->close();
        ?>
    </tbody>
</table>
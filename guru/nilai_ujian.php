<?php
// Ambil ID guru dari sesi
$id_guru = isset($_SESSION['id_guru']) ? intval($_SESSION['id_guru']) : 0;
$id_ujian = isset($_GET['id_ujian']) ? $_GET['id_ujian'] : 0;

// Periksa koneksi database
if (!$koneksi) {
    die("Koneksi database gagal!");
}

// Ambil data siswa dengan nama kelas untuk kelas yang dimiliki oleh guru
$sql_siswa = "
    SELECT 
        siswa.id_siswa, 
        siswa.nis, 
        siswa.nama, 
        kelas.nama_kelas 
    FROM 
        siswa 
    INNER JOIN 
        kelas 
    ON 
        siswa.id_kelas = kelas.id_kelas
    WHERE 
        kelas.id_guru = ?
";
$stmt_siswa = $koneksi->prepare($sql_siswa);
$stmt_siswa->bind_param("i", $id_guru);
$stmt_siswa->execute();
$result_siswa = $stmt_siswa->get_result();

// Hitung jumlah soal untuk id_ujian
$sql_jumlah_soal = "SELECT COUNT(*) AS jumlah_soal FROM soal WHERE id_ujian = ?";
$stmt_jumlah_soal = $koneksi->prepare($sql_jumlah_soal);
$stmt_jumlah_soal->bind_param("i", $id_ujian);
$stmt_jumlah_soal->execute();
$result_jumlah_soal = $stmt_jumlah_soal->get_result();
$row_jumlah_soal = $result_jumlah_soal->fetch_assoc();
$jumlah_soal = $row_jumlah_soal['jumlah_soal'] ?? 0;
$stmt_jumlah_soal->close();

// Ambil data ujian
$sql_ujian = "SELECT * FROM ujian WHERE id_ujian=?";
$stmt_ujian = $koneksi->prepare($sql_ujian);
$stmt_ujian->bind_param("i", $id_ujian);
$stmt_ujian->execute();
$result_ujian = $stmt_ujian->get_result();
$row_ujian = $result_ujian->fetch_assoc();

// Array untuk menyimpan data siswa dan nilai
$data_siswa = [];

if ($result_siswa->num_rows > 0) {
    while ($row_siswa = $result_siswa->fetch_assoc()) {
        $id_siswa = $row_siswa['id_siswa'];

        // Hitung jawaban benar untuk id_siswa dan id_ujian
        $sql_jawaban_benar = "
            SELECT COUNT(*) AS jawaban_benar 
            FROM hasil 
            WHERE id_siswa = ? AND id_ujian = ? AND test_result = 'lulus'
        ";
        $stmt_jawaban_benar = $koneksi->prepare($sql_jawaban_benar);
        $stmt_jawaban_benar->bind_param("ii", $id_siswa, $id_ujian);
        $stmt_jawaban_benar->execute();
        $result_jawaban_benar = $stmt_jawaban_benar->get_result();
        $row_jawaban_benar = $result_jawaban_benar->fetch_assoc();
        $jawaban_benar = $row_jawaban_benar['jawaban_benar'] ?? 0;
        $stmt_jawaban_benar->close();

        // Hitung nilai
        $nilai = $jumlah_soal > 0 ? ($jawaban_benar / $jumlah_soal) * 100 : 0;

        // Simpan data siswa dan nilai ke dalam array
        $data_siswa[] = [
            'nis' => $row_siswa['nis'],
            'nama' => $row_siswa['nama'],
            'nama_kelas' => $row_siswa['nama_kelas'],
            'nilai' => $nilai
        ];
    }
}

// Urutkan array berdasarkan nilai terbesar
usort($data_siswa, function ($a, $b) {
    return $b['nilai'] <=> $a['nilai'];
});
?>

<div class="row">
    <div class="col"><?php echo "<h3>Nilai: " . htmlspecialchars($row_ujian["nama_ujian"]) . "</h3>"; ?></div>
    <div class="col text-end">Reload Otomatis: <span id="countdown">60</span> detik</div>
</div>
<table class="table table-striped table-bordered" style="width:100%">
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
        if (!empty($data_siswa)) {
            $no = 1;
            foreach ($data_siswa as $siswa) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($siswa['nis']); ?></td>
                    <td><?php echo htmlspecialchars($siswa['nama']); ?></td>
                    <td><?php echo htmlspecialchars($siswa['nama_kelas']); ?></td>
                    <td><?php echo number_format($siswa['nilai'], 2); ?></td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='5' class='text-center'>Tidak ada data siswa</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
// Tutup koneksi database
$stmt_siswa->close();
$koneksi->close();
?>

<script>
    let countdown = 60; // Mulai dari 60 detik
    const countdownElement = document.getElementById('countdown');

    // Fungsi untuk memperbarui hitung mundur setiap detik
    const interval = setInterval(() => {
        countdown--;
        countdownElement.textContent = countdown;

        if (countdown <= 0) {
            clearInterval(interval); // Hentikan interval
            location.reload(); // Reload halaman
        }
    }, 1000); // Perbarui setiap 1000ms (1 detik)
</script>

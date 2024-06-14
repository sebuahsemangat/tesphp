<?php
include "koneksi.php";

// Mulai sesi (jika belum dimulai)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Pastikan data siswa ada di sesi
if (!isset($_SESSION['siswa'])) {
    // Jika data siswa tidak ada, arahkan ke halaman login atau beri pesan kesalahan
    echo "Data siswa tidak ditemukan. Silakan login kembali.";
    exit();
}
?>

<h2>Selamat Datang <?= htmlspecialchars($data_siswa["nama"], ENT_QUOTES, 'UTF-8'); ?></h2>

<table id="myTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Nama Ujian</th>
            <th>Jumlah Soal</th>
            <th>Nilai Akhir</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Menggunakan prepared statements untuk mengamankan query
        $stmt = $koneksi->prepare("
            SELECT ujian.id_ujian, ujian.nama_ujian, COUNT(soal.id_soal) AS jumlah_soal
            FROM ujian
            LEFT JOIN ujian_kelas ON ujian.id_ujian = ujian_kelas.id_ujian
            LEFT JOIN soal ON ujian.id_ujian = soal.id_ujian
            WHERE ujian_kelas.id_kelas = ? AND ujian.status = 'aktif'
            GROUP BY ujian.id_ujian, ujian.nama_ujian
            ORDER BY ujian.id_ujian DESC
        ");

        if ($stmt) {
            // Bind parameter
            $stmt->bind_param("i", $data_siswa['id_kelas']);
            $stmt->execute();
            $result = $stmt->get_result();

            // Looping melalui hasil query
            while ($data_ujian = $result->fetch_assoc()) {
        ?>
                <tr>
                    <td><?= htmlspecialchars($data_ujian['nama_ujian'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars($data_ujian['jumlah_soal'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>Di sini nilainya</td>
                    <td><a href='home.php?page=soal&id_ujian=<?= htmlspecialchars($data_ujian['id_ujian'], ENT_QUOTES, 'UTF-8'); ?>'>Kerjakan</a></td>
                </tr>
        <?php
            }
            $stmt->close();
        } else {
            echo "Gagal menyiapkan query: " . $koneksi->error;
        }
        ?>
    </tbody>
</table>

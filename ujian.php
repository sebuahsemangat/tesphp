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
                // Mengambil jumlah jawaban benar dari tabel hasil
                $stmt_jawaban_benar = $koneksi->prepare("
                    SELECT COUNT(*) AS jumlah_benar
                    FROM hasil
                    WHERE id_ujian = ? AND id_siswa = ? AND test_result = 'lulus'
                ");
                $stmt_jawaban_benar->bind_param("ii", $data_ujian['id_ujian'], $data_siswa['id_siswa']);
                $stmt_jawaban_benar->execute();
                $result_jawaban_benar = $stmt_jawaban_benar->get_result();
                $data_jawaban_benar = $result_jawaban_benar->fetch_assoc();
                $jumlah_benar = $data_jawaban_benar['jumlah_benar'];

                // Menghitung nilai akhir
                $nilai = 0;
                if ($data_ujian['jumlah_soal'] > 0) {
                    $nilai = ($jumlah_benar / $data_ujian['jumlah_soal']) * 100;
                }

                // Menampilkan data ujian dan nilai
        ?>
                <tr>
                    <td><?= htmlspecialchars($data_ujian['nama_ujian'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars($data_ujian['jumlah_soal'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars(number_format($nilai, 0), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a href='home.php?page=soal&id_ujian=<?= htmlspecialchars($data_ujian['id_ujian'], ENT_QUOTES, 'UTF-8'); ?>'>Kerjakan</a></td>
                </tr>
        <?php
                $stmt_jawaban_benar->close();
            }
            $stmt->close();
        } else {
            echo "Gagal menyiapkan query: " . $koneksi->error;
        }
        ?>
    </tbody>
</table>
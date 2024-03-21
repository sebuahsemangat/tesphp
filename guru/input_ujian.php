<?php
// Memeriksa apakah data dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['id_guru'])) {
        echo "Kamu belum login.";
        exit();
    }
    // Memastikan bahwa nama ujian tidak kosong dan menghindari serangan SQL Injection dengan menggunakan parameterized query
    if (!empty($_POST['nama_ujian'])) {

        $nama_ujian = $_POST['nama_ujian'];
        $kelas_terpilih = $_POST['kelas'];
        $status = "aktif";
        $id_guru = $_SESSION['id_guru']; // Ambil nilai id_guru dari sesi

        // Input data ujian ke tabel ujian dengan prepared statement
        $sql_insert_ujian = "INSERT INTO ujian (nama_ujian, status, id_guru) VALUES (?, ?, ?)";
        $stmt_insert_ujian = mysqli_prepare($koneksi, $sql_insert_ujian);
        mysqli_stmt_bind_param($stmt_insert_ujian, "sss", $nama_ujian, $status, $id_guru);

        if (mysqli_stmt_execute($stmt_insert_ujian)) {
            $id_ujian = mysqli_insert_id($koneksi); // Dapatkan id_ujian yang baru saja di-generate

            // Input data ujian_kelas ke tabel ujian_kelas untuk setiap kelas yang dipilih
            $sql_insert_ujian_kelas = "INSERT INTO ujian_kelas (id_ujian, id_kelas) VALUES (?, ?)";
            $stmt_insert_ujian_kelas = mysqli_prepare($koneksi, $sql_insert_ujian_kelas);
            mysqli_stmt_bind_param($stmt_insert_ujian_kelas, "ii", $id_ujian, $id_kelas);

            foreach ($kelas_terpilih as $id_kelas) {
                if (!mysqli_stmt_execute($stmt_insert_ujian_kelas)) {
                    echo "Error: " . mysqli_error($koneksi);
                    exit();
                }
            }

            echo "<div class='alert alert-success' role='alert'>Data ujian berhasil diinput.</div>";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }

    } else {
        echo "Nama ujian tidak boleh kosong";
    }
}
?>

<form action="" method="post">
    <div class="mb-3">
        <label for="namaujian" class="form-label">Nama Ujian</label>
        <!-- Input untuk memasukkan nama ujian -->
        <input type="text" class="form-control" id="namaujian" placeholder="Contoh: Ujian Tengah Semester" name="nama_ujian" required>
    </div>
    <div class="mb-3">
        <label for="kelas" class="form-label">Kelas</label>
        <br>
        <?php
        // Query untuk mendapatkan daftar kelas sesuai guru pengajar
        $query_kelas = "SELECT * FROM kelas WHERE id_guru='$_SESSION[id_guru]'";
        $result_kelas = mysqli_query($koneksi, $query_kelas);

        // Tampilkan checkbox untuk setiap kelas
        while ($row_kelas = mysqli_fetch_assoc($result_kelas)) {
            echo '<input type="checkbox" name="kelas[]" value="' . $row_kelas['id_kelas'] . '"> ' . $row_kelas['nama_kelas'] . '<br>';
        }

        // Tutup koneksi
        mysqli_close($koneksi);
        ?>
    </div>
    <div class="mb-3">
        <!-- Tombol submit untuk mengirimkan data form -->
        <button type="submit" class="btn btn-primary mb-3" name="submit">Simpan Ujian</button>
    </div>
</form>
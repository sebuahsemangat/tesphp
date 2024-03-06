<?php
// Memeriksa apakah data dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memastikan bahwa nama ujian tidak kosong dan menghindari serangan SQL Injection dengan menggunakan parameterized query
    if (!empty($_POST['nama_ujian'])) {
        
        // Menyiapkan pernyataan SQL menggunakan parameterized query untuk mencegah SQL Injection
        $query = mysqli_prepare($koneksi, "INSERT INTO ujian (nama_ujian, status, id_kelas) VALUES (?, ?, ?)");

        // Mengikat parameter ke pernyataan SQL
        mysqli_stmt_bind_param($query, "ssi", $nama_ujian, $status, $id_kelas);

        // Menginisialisasi variabel
        $nama_ujian = $_POST['nama_ujian'];
        $status = "aktif";
        $id_kelas = 1;

        // Mengeksekusi pernyataan SQL
        if (mysqli_stmt_execute($query)) {
            echo "<div class='alert alert-success' role='alert'>Ujian berhasil diinput</div>";
        } else {
            echo "Ujian gagal diinput";
        }

        // Menutup pernyataan dan koneksi database
        mysqli_stmt_close($query);
        mysqli_close($koneksi);
    } else {
        echo "Nama ujian tidak boleh kosong";
    }
}
?>

<form action="" method="post">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nama Ujian</label>
        <!-- Input untuk memasukkan nama ujian -->
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ujian Tengah Semester" name="nama_ujian" required>
    </div>
    <div class="mb-3">
        <!-- Tombol submit untuk mengirimkan data form -->
        <button type="submit" class="btn btn-primary mb-3" name="submit">Simpan Ujian</button>
    </div>
</form>

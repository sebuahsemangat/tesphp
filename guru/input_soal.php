<?php
// Memeriksa apakah data dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post'])) {
        // Menginisialisasi variabel dari data yang diterima
    $judul_soal = mysqli_real_escape_string($koneksi, $_POST['judul_soal']);
    $deskripsi_soal = mysqli_real_escape_string($koneksi, $_POST['deskripsi_soal']);
    $waktu = 0;
    $status = "aktif";
    $id_ujian = $_POST['id_ujian'];

    // Menyiapkan query untuk memasukkan data ke dalam tabel soal
    $query = mysqli_prepare($koneksi, "INSERT INTO soal (judul, soal, waktu, status, id_ujian) VALUES (?, ?, ?, ?, ?)");
    
    // Mengikat parameter ke pernyataan SQL
    mysqli_stmt_bind_param($query, "ssisi", $judul_soal, $deskripsi_soal, $waktu, $status, $id_ujian);

    // Mengeksekusi pernyataan SQL
    if (mysqli_stmt_execute($query)) {
        echo "<div class='alert alert-success' role='alert'>Soal berhasil disimpan</div>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

    // Menutup pernyataan dan koneksi database
    mysqli_stmt_close($query);
    mysqli_close($koneksi);
}
?>
<form action="" method="post">
    <input type="hidden" name="id_ujian" id="" value="<?= $_GET['id_ujian'];?>">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Judul Soal</label>
        <!-- Input untuk memasukkan nama soal -->
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Judul soal" name="judul_soal" required>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Deskripsi Soal</label>
        <!-- Input untuk memasukkan deskripsi soal -->
        <textarea name="deskripsi_soal" id="editor" cols="30" rows="10" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <!-- Tombol submit untuk mengirimkan data form -->
        <button type="submit" class="btn btn-primary mb-3" name="post">Simpan Soal</button>
    </div>
</form>
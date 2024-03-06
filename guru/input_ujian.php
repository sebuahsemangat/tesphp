<?php
if (!isset($_POST['submit'])) {
    echo "";
} else {
    // Jika tombol submit telah ditekan, kode di bawah ini akan dieksekusi.
    // Data yang diambil dari form akan disimpan dalam variabel.
    $nama_ujian = addslashes($_POST['nama_ujian']);
    $status = "aktif";
    $id_kelas = 1;

    // Melakukan query untuk memasukkan data ujian ke dalam database menggunakan mysqli_query.
    // Data yang dimasukkan adalah nama_ujian, status, dan id_kelas.
    $query = mysqli_query($koneksi, "INSERT INTO ujian (nama_ujian, status, id_kelas) VALUES ('$nama_ujian','$status','$id_kelas')");

    // Memeriksa apakah query berhasil dieksekusi atau tidak.
    if ($query) {
        // Jika query berhasil dieksekusi, tampilkan pesan sukses.
        echo "<div class='alert alert-success' role='alert'>Ujian berhasil diinput</div>";
    } else {
        // Jika query gagal dieksekusi, tampilkan pesan error.
        echo "Ujian gagal diinput";
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
<?php

// Cek level pengguna
if ($_SESSION['level'] == "guru") {
    echo "You don't have access to this page!";
    exit();
}

// Cek apakah form telah disubmit
if (isset($_POST['submit'])) {

    // Validasi file yang diupload
    $allowedExtensions = ['xls', 'xlsx'];
    $maxFileSize = 1 * 1024 * 1024; // 1 Megabyte
    $uploadDir = 'data_siswa/';

    // Ambil informasi file
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];

    // Ekstrak ekstensi file
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validasi ekstensi file
    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "<p class='alert alert-danger'>Hanya file dengan ekstensi .xls atau .xlsx yang diperbolehkan! Nama file anda: <strong>{$fileName}</strong></p>";
        exit();
    }

    // Validasi ukuran file
    if ($fileSize > $maxFileSize) {
        echo "<p class='alert alert-danger'>Ukuran file maksimal adalah 1 Megabyte!</p>";
        exit();
    }

    // Cek apakah ada error saat upload
    if ($fileError !== UPLOAD_ERR_OK) {
        echo "<p class='alert alert-danger'>Terjadi kesalahan saat mengunggah file!</p>";
        exit();
    }

    // Generate nama file yang unik untuk menghindari konflik
    $newFileName = uniqid('siswa_', true) . '.' . $fileExtension;

    // Tentukan path untuk menyimpan file
    $uploadPath = $uploadDir . $newFileName;

    // Pastikan folder upload ada, jika tidak, buat folder tersebut
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Pindahkan file dari temporary directory ke lokasi yang diinginkan
    if (move_uploaded_file($fileTmpName, $uploadPath)) {
        echo "<p class='alert alert-success'>File berhasil diunggah!</p>";
    } else {
        echo "<p class='alert alert-danger'>Gagal mengunggah file. Silakan coba lagi.</p>";
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="kelas" class="form-label">Kelas</label>
        <strong>X-R5</strong>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">File Excel</label>
        <input type="file" class="form-control" id="file" name="file" required>
        <small id="passwordHelpBlock" class="form-text text-muted">
            <a href="http://">Download Format di Sini</a>
        </small>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary mb-3" name="submit">Simpan</button>
    </div>
</form>

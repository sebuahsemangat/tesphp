<?php
if ($_SESSION['level'] == "guru") {
    echo "You don't have access to this page!";
    exit();
}

// Fungsi untuk membersihkan input
function cleanInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Memproses form saat disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kelas = cleanInput($_POST['nama_kelas']);
    $status = "aktif";
    $id_guru = cleanInput($_POST['id_guru']);

    // Menyiapkan statement untuk insert data ke tabel kelas
    $stmt = $koneksi->prepare("INSERT INTO kelas (nama_kelas, status, id_guru) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $nama_kelas, $status, $id_guru);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Data berhasil disimpan.</div>";
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan saat menyimpan data.</div>";
    }

    // Menutup statement
    $stmt->close();
}

// Mengambil data guru untuk pilihan pada select
$guru_query = "SELECT id_guru, nama FROM guru";
$guru_result = $koneksi->query($guru_query);

?>
<h3 class="mt-2">Input Data Kelas</h3>
<form action="" method="post">
    <div class="mb-3">
        <label for="nama_kelas" class="form-label">Nama Kelas</label>
        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
    </div>
    <div class="mb-3">
        <label for="id_guru" class="form-label">Guru Pengajar</label>
        <select class="form-control" id="id_guru" name="id_guru" required>
            <option value="">Pilih Guru</option>
            <?php
            if ($guru_result->num_rows > 0) {
                while ($row = $guru_result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row['id_guru']) . "'>" . htmlspecialchars($row['nama']) . "</option>";
                }
            } else {
                echo "<option value=''>Tidak ada data guru</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary mb-3">Simpan</button>
    </div>
</form>

</div>

<?php
// Menutup koneksi database
$koneksi->close();
?>
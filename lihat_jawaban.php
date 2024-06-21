<h2>Lihat Jawaban</h2>
<p><a href="home.php?page=soal&id_ujian=<?= htmlspecialchars($_GET['id_ujian']); ?>">Kembali</a></p>

<?php
// Validasi dan sanitasi input dari URL
$id_soal = filter_input(INPUT_GET, 'id_soal', FILTER_VALIDATE_INT);
$id_ujian = filter_input(INPUT_GET, 'id_ujian', FILTER_VALIDATE_INT);

// Pastikan id_soal dan id_ujian adalah integer
if ($id_soal === false || $id_ujian === false) {
  die("ID Soal atau ID Ujian tidak valid.");
}

// Ambil id_siswa dari session
$id_siswa = $_SESSION['siswa'];

// Query untuk mengambil data dari tabel hasil sesuai dengan id_soal dan id_siswa
$sql = "SELECT * FROM hasil WHERE id_soal = ? AND id_siswa = ? LIMIT 1";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("ii", $id_soal, $id_siswa);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

//Query untuk menampilkan soal
$sql_soal = "SELECT * FROM soal WHERE id_soal = ?";
$stmt_soal = $koneksi->prepare($sql_soal);
$stmt_soal->bind_param("i", $id_soal);
$stmt_soal->execute();
$result_soal = $stmt_soal->get_result();
$row_soal = $result_soal->fetch_assoc();
?>
<div class="mb-3 p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3">
  <p><?= htmlspecialchars($row_soal["soal"]); ?></p>
</div>
<textarea id="code" name="code" class="CodeMirror"><?php echo $row['jawaban']; ?></textarea>
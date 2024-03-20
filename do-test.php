<?php
if(isset($_GET['id_soal']) && is_numeric($_GET['id_soal'])) {
  // Gunakan prepared statement untuk menghindari SQL injection
  $id_soal = $_GET['id_soal'];
  $sql = "SELECT soal.*, COUNT(jawaban.id_jawaban) AS jumlah_jawaban
          FROM soal
          LEFT JOIN jawaban ON soal.id_soal = jawaban.id_soal
          WHERE soal.id_soal = ?
          GROUP BY soal.id_soal";

  // Persiapkan statement
  if($stmt = mysqli_prepare($koneksi, $sql)) {
      // Bind parameter ke statement
      mysqli_stmt_bind_param($stmt, "i", $id_soal);

      // Eksekusi statement
      mysqli_stmt_execute($stmt);

      // Simpan hasil
      $result = mysqli_stmt_get_result($stmt);

      // Ambil data dari hasil query
      $data = mysqli_fetch_assoc($result);

      // Periksa apakah soal memiliki jawaban
      if ($data['jumlah_jawaban'] == 0) {
          echo "<div class='alert alert-danger mt-2' role='alert'>
                    Maaf soal ini belum bisa diakses. Soal belum memiliki jawaban.
                    <a href='home.php?page=soal&id_ujian=$_GET[id_ujian]'>Kembali</a>
                </div>";
          exit();
      }

      // Bebaskan hasil dan tutup statement
      mysqli_stmt_close($stmt);
  } else {
      // Jika gagal mempersiapkan statement
      echo "Error: " . mysqli_error($koneksi);
  }
} else {
  // Jika parameter id_soal tidak ada atau tidak valid
  echo "Parameter id_soal tidak valid";
  exit();
}

// Tutup koneksi
mysqli_close($koneksi);
?>
<h4><?= $data["judul"]; ?></h4>

<div class="mb-3 p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3">
  <p><?= $data["soal"]; ?></p>
</div>
<form method="post" action="compile.php" target="compile" class="mb-2">
  <input type="hidden" name="id_soal" id="" value="<?php echo $data['id_soal'] ?>">
  <textarea id="code" name="code" class="CodeMirror"></textarea>
  <button class="btn btn-primary btn-md mt-2" type="submit" name="submit">Run Code</button>
</form>


<iframe name="compile" scrolling="no" src="" frameborder="0" width="100%" onload="resizeIframe(this)"></iframe>
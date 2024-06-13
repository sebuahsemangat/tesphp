<?php
// Mengambil parameter dari URL dan membersihkannya
$id_soal = filter_input(INPUT_GET, 'id_soal', FILTER_SANITIZE_NUMBER_INT);

// Memeriksa apakah id_soal ada
if ($id_soal) {
  // Query untuk mengambil data dari tabel soal
  $sql_soal = "SELECT id_soal, judul, soal, status, parameter, function_name, test_code 
                 FROM soal 
                 WHERE status = 'aktif' AND id_soal = ?";

  // Menyiapkan statement
  $stmt_soal = $koneksi->prepare($sql_soal);
  if ($stmt_soal) {
    // Bind parameter dan eksekusi statement
    $stmt_soal->bind_param("i", $id_soal);
    $stmt_soal->execute();
    $result_soal = $stmt_soal->get_result();

    // Memeriksa apakah data soal ditemukan
    if ($result_soal->num_rows > 0) {
      $soal = $result_soal->fetch_assoc();
    } else {
      echo "<p>Soal tidak ditemukan atau tidak aktif.</p>";
      exit();
    }
  } else {
    echo "<p>Gagal menyiapkan query soal.</p>";
    exit();
  }
} else {
  echo "<p>Parameter id_soal tidak valid.</p>";
  exit();
}


?>

<a href="#">Kembali</a>
<h4><?php echo $soal['judul']; ?></h4>

<div class="mb-3 p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3">
  <p><?php echo $soal['soal']; ?></p>
</div>
<div class="row align-items-start">
  <div class="col-md-7">
    <strong>Kode Anda</strong>
    <form method="post" action="execute.php" target="execute" class="mb-2">
      <input type="hidden" name="id_soal" id="" value="<?php echo $soal['id_soal'] ?>">
      <textarea id="code" name="code" class="CodeMirror"><?php
                                                          echo htmlspecialchars("
<?php
function " . $soal['function_name'] . "(" . $soal['parameter'] . "){
  //Masukkan kode di sini
}
?>");
                                                          ?>
      </textarea>
      <button class="btn btn-primary btn-md mt-2" type="submit" name="submit">Run Code</button>
    </form>
  </div>
  <div class="col">
    <strong>Test Results</strong>
    <!--<table class="table">
      <tr>
        <th scope="col">Input</th>
        <th scope="col">Output</th>
      </tr>
      <?php
      // $sql_testcase = "SELECT id_testcase, input, output 
      //                        FROM testcase 
      //                        WHERE id_soal = ?";

      // // Menyiapkan statement
      // $stmt_testcase = $koneksi->prepare($sql_testcase);
      // if ($stmt_testcase) {
      //   // Bind parameter dan eksekusi statement
      //   $stmt_testcase->bind_param("i", $id_soal);
      //   $stmt_testcase->execute();
      //   $result_testcase = $stmt_testcase->get_result();

      //   // Menampilkan data testcase
      //   if ($result_testcase->num_rows > 0) {
      //     while ($testcase = $result_testcase->fetch_assoc()) {
      //       echo "<tr>
      //                       <td>{$testcase['input']}</td>
      //                       <td>{$testcase['output']}</td>
      //                       </tr>";
      //     }
      //   } else {
      //     echo "<p>Tidak ada testcase untuk soal ini.</p>";
      //     exit();
      //   }
      // } else {
      //   echo "<p>Gagal menyiapkan query testcase.</p>";
      //   exit();
      // }
      // // Menutup koneksi
      // $koneksi->close();
      ?>

    </table>-->

    <!--Textarea untuk menampilkan kode test-->

    <iframe src="" name="execute" frameborder="0" width="100%" id="resultFrame" height="auto"></iframe>
  </div>

</div>
<div class="row">
  <strong>Sample Tests</strong>
  <form action="">
    <textarea name="" id="code2">
<?php echo htmlspecialchars("<?php
" .
  $soal["test_code"]); ?></textarea>
  </form>
</div>
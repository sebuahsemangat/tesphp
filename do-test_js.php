<?php

// Mengambil parameter dari URL dan membersihkannya
$id_soal = filter_input(INPUT_GET, 'id_soal', FILTER_SANITIZE_NUMBER_INT);

// Memeriksa apakah id_soal ada
if ($id_soal) {
  // Query untuk mengambil data dari tabel soal
  $sql_soal = "SELECT id_soal, judul, soal, status, id_ujian, parameter, function_name, test_code 
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

<a href="home.php?page=soal&id_ujian=<?php echo $soal['id_ujian'];?>">Kembali</a>
<h4><?php echo htmlspecialchars($soal['judul']); ?></h4>

<div class="mb-3 p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3">
  <p><?php echo $soal['soal']; ?></p>
</div>
<div class="row align-items-start">
  <div class="col-md-7">
    <strong>Kode Anda</strong>
    <form method="post" action="execute_js.php" target="execute" class="mb-2" onsubmit="disableButton(this)">
      <input type="hidden" name="id_soal" id="" value="<?php echo htmlspecialchars($soal['id_soal']); ?>">
      <textarea id="code" name="code" class="CodeMirror"><?php
                                                          echo htmlspecialchars("
function " . $soal['function_name'] . "(" . str_replace('$', '', $soal['parameter']) . "){
    //Masukkan kode di sini
}


//Jangan hapus baris ini:
module.exports = " . $soal['function_name'] .";
");
                                                          ?>
      </textarea>
      <button class="btn btn-primary btn-md mt-2" type="submit" name="submit" id="runCodeButton">Run Code</button>
    </form>
  </div>
  <div class="col">
    <strong>Sample Tests</strong>
    <table class="table">
      <tr>
        <th scope="col">Input</th>
        <th scope="col">Output</th>
      </tr>
      <?php
      $sql_testcase = "SELECT id_testcase, input, output 
                             FROM testcase 
                             WHERE id_soal = ?";

      // Menyiapkan statement
      $stmt_testcase = $koneksi->prepare($sql_testcase);
      if ($stmt_testcase) {
        // Bind parameter dan eksekusi statement
        $stmt_testcase->bind_param("i", $id_soal);
        $stmt_testcase->execute();
        $result_testcase = $stmt_testcase->get_result();

        // Menampilkan data testcase
        if ($result_testcase->num_rows > 0) {
          while ($testcase = $result_testcase->fetch_assoc()) {
            echo "<tr>
                            <td>" . htmlspecialchars($testcase['input']) . "</td>
                            <td>" . htmlspecialchars($testcase['output']) . "</td>
                            </tr>";
          }
        } else {
          echo "<p>Tidak ada testcase untuk soal ini.</p>";
          exit();
        }
      } else {
        echo "<p>Gagal menyiapkan query testcase.</p>";
        exit();
      }
      // Menutup koneksi
      $koneksi->close();
      ?>
    </table>
  </div>
</div>
<div class="row">
  <div class="col">
    <strong>Test Results</strong>
    <iframe src="" name="execute" width="100%" frameborder="1" scrolling="no" onload="resizeIframe(this)"></iframe>
  </div>
</div>

<script>
function disableButton(form) {
  const button = form.querySelector('#runCodeButton');
  button.disabled = true;
  button.textContent = 'Loading...';
  setTimeout(() => {
    button.disabled = false;
    button.textContent = 'Run Code';
  }, 3000);
}
</script>
